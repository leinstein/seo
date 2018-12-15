<?php

/**
 * 模型层：关键词检测模型类型
 *
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170905
 * @link        http://www.qisobao.com
 */
class KeyworddetectModel extends BaseModel {

	/**
	 * 不检查数据库
	 */
	protected $autoCheckFields = false;

	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
	}

	/**
	 * 检测关键词：新接口 2017年9月6日10:46:11
	 *
	 * 检测所有正在优化中的关键词：
	 * //SELECT tb1.* FROM tb1 LEFT JOIN tb2 ON tb1.id=tb2.id WHERE tb2.id IS NULL;
	 * 1、检测全部正在优化，无论是否达标都需要对该关键词进行检测，只有当前的最新排名在第一页，才会进行达标扣费
	 * 2、如果排名在第一页，修改该关键词的状态为已达标，并且判断是否是第一次达标，如果是第一次达标，就将该关键词进行绑定，并且90天内不能解冻
	 *
	 */
	function detect($list) {
		// 关键词模型
		$model_keyword = D('Biz/Keyword');
		// 关键词检测记录
		$modelKeyworddetectrecord = D('Biz/Keyworddetectrecord');

		// 获取接口参数
		// 当前系统运行环境
		$app_environment = C('APP_ENVIRONMENT');
		// 获取接口参数
		$keywor_detect_config_arr = C('KEYWORD_DETECT_CONFIG');
		// 获取接口参数
		$keywor_detect_config = $keywor_detect_config_arr[$app_environment];

		$app_id = $keywor_detect_config['APP_ID'];
		$app_key = $keywor_detect_config['APP_KEY'];

		// 获取还没进行检测的全部关键词
		// 1.=========================== 从系统中获获取还没进行检测的全部关键词 ===========================
		if (!$list) {

			// 获取优化中的关键词，并且检测时间不是今天的全部关键词
			//$map['keywordstatus'] 	= '优化中';
			//$map['is_detect'] 		= array(array('EXP', 'IS NULL'),array('EXP', 'IS NULL'),array('EXP', 'IS NULL'),'OR');0;
			//$map['is_detect'] 		= array('NEQ', 1);
			//$map['detectiondate'] 	= array('LT', date('Y-m-d'));
			//$map['status'] 			= 1;
			//$list = $model_keyword -> queryRecordAll( $map,'id,keyword,searchengine,website,createuserid,keywordstatus,is_detect' );

			//$sql ='SELECT ts_keyword.id,keywordstatus,ts_keyword.keyword,ts_keyword.searchengine,ts_keyword.website,ts_keyword.createuserid,is_detect,detect_token FROM ts_keyword LEFT JOIN ts_keyworddetectrecord ON ts_keyworddetectrecord.keywordid = ts_keyword.id  AND ts_keyword.status=1 AND ts_keyworddetectrecord.status=1 AND ts_keyworddetectrecord.createtime LIKE "'.date('Y-m-d').'%" WHERE ts_keyword.keywordstatus="优化中" AND ts_keyworddetectrecord.keywordid IS NULL';
			//$list = M() -> query($sql);

			// 获取优化中的关键词
			$map['keywordstatus'] = '优化中';
			//$map['is_detect'] 		= array(array('EXP', 'IS NULL'),array('EXP', 'IS NULL'),array('EXP', 'IS NULL'),'OR');0;
			$map['is_detect'] = array('NEQ', 1);
			//$map['detectiondate'] 	= array('LT', date('Y-m-d'));
			$map['status'] = 1;
			$list = $model_keyword->queryRecordAll($map, 'id,keyword,searchengine,website,createuserid,keywordstatus,is_detect');

			//dump($list);
			//dump(M()  -> _sql());
		}

		// 2.=========================== 获取接口推送地址和主机地址 ===========================
		// 获取接口地址
		$url_post = $keywor_detect_config['ADD_TASK_URL'];
		// 获取当前接口的主机地址
		$host = $this->yundanran_parse_host($url_post);

		// 3.=========================== 将关键词全部新增到检测记录表中 ===========================
		$record = $modelKeyworddetectrecord->addRecords($list, $app_id);

		// 循环对关键词进行处理
		foreach ($list as $vo) {

			// 组合url
			$url = str_ireplace(array('http://', 'https://'), '', $vo['website']);
			// 需要替换的前缀
			$prefixs = array('www.', 'm.', 'wap.', '3g.');
			// 判断是否已以下的几个开开头
			foreach ($prefixs as $vo_pf) {
				if (stripos($url, $vo_pf) === 0) {
					$url = substr($url, strlen($vo_pf));
				}
			}

			// 4.=========================== 对还未生成token的关键词生成token ===========================
			// 对还未生成token的关键词生成token
			if (!$vo['detect_token']) {

				// 获取token接口Token加密方式 :md5(url参数+data_id+APP_ID)
				$token = md5($url . $vo['id'] . $app_id);

				//将token插入都数据库
				$keyword['detect_token'] = $token;

				$model_keyword->where(array('id' => $vo['id']))->save($keyword);
			}

			// 5.=========================== 对还未进行检测的数据进行接口的推送 ===========================
			if ($vo['is_detect'] != 1) {

				// 生成分类
				switch ($vo['searchengine']) {
				case 'baidu':
					$type = 1;
					break;
				case 'baidu_mobile':
					$type = 2;
					break;
				case '360':
					$type = 3;
					break;
				case '360_mobile':
					$type = 4;
					break;
				case 'sougou':
					$type = 5;
					break;
				case 'sougou_mobile':
					$type = 6;
					break;
				case 'shenma':
					$type = 7;
					break;
				default:
					$type = 1;
					break;
				}

				// 组合最终的推送信息
				$postData['data_id'] = $vo['id']; // 数据ID(方便A方接收数据时处理相关逻辑)
				$postData['type'] = $type; // 类别(具体标准是：1或者参数为空：百度PC;2：百度移动；3：360PC；4：360移动;5:搜狗PC；6:搜狗移动；7:神马搜索；)
				$postData['url'] = $url; // 网站地址
				$postData['keywords'] = $vo['keyword']; // 关键词
				$postData['app_id'] = $app_id; // APP_ID（接入时由平台分配，请务必妥善保管）
				$postData['app_key'] = $app_key; // APP_KEY（接入时由平台分配，请务必妥善保管）
				// 6.=========================== 进行接口推送 ===========================
				// 本地测试环境不进行推送
				// TODO ==================>
				if ($app_environment == 3 || $app_environment == 4) {
					$result_post = API_V1Model::httpClientPostData($postData, $host, $url_post);
				}

				// 7.=========================== 判断操作结果，如果提交接口失败，那么需要滚回数据 ===========================
				// 判断操作结果，如果提交接口失败，那么需要滚回数据
				$response = json_decode($result_post['response'], true);
				if ($response['ret'] != 1) {
					// TODO
					$map_detect['keywordid'] = $vo['id'];
					$map_detect['createtime'] = array('LIKE', date('Y-m-d') . '%');
					$modelKeyworddetectrecord->deleteRecord($map_detect);
				}

				// 8.=========================== 显示页面trans ===========================
				if ($show_trans) {
					dump($postData);
					dump($response);
				}
			}
		}
	}

	/**
	 * 新增检测任务
	 *
	 * 在关键词审核通过后:将审核通过的关键词推送到接口中
	 * 1、在关键词的状态有优化中变为其他状态的时候，调用该接口
	 * 2、
	 *
	 */
	function add_task($keywordid, $keyword, $website, $searchengine, $createuserid, $detect_token) {

		Log::write("=========================== 新增检测任务begin ===========================");
		//header("Content-type: text/html; charset=utf-8");
		// 关键词模型
		$model_keyword = D('Biz/Keyword');

		// 当前系统运行环境
		$app_environment = C('APP_ENVIRONMENT');
		// 获取接口参数
		$keywor_detect_config_arr = C('KEYWORD_DETECT_CONFIG');
		// 获取接口参数
		$keywor_detect_config = $keywor_detect_config_arr[$app_environment];

		$app_id = $keywor_detect_config['APP_ID'];
		$app_key = $keywor_detect_config['APP_KEY'];
		$url_post = $keywor_detect_config['ADD_TASK_URL'];
		// 获取当前接口的主机地址
		$host = $this->yundanran_parse_host($url_post);

		// 1.=========================== 判断关键词主键是否存在 ===========================
		if (!$keywordid) {
			$this->error = '获取关键词信息失败';
			return false;
		}

		// 2.=========================== 组合url ===========================
		// 组合url
		$url = str_ireplace(array('http://', 'https://'), '', $website);
		// 需要替换的前缀
		$prefixs = array('www.', 'm.', 'wap.', '3g.');
		// 判断是否已以下的几个开开头
		foreach ($prefixs as $vo_pf) {
			if (stripos($url, $vo_pf) === 0) {
				$url = substr($url, strlen($vo_pf));
			}
		}

		// 3.=========================== 生成token ===========================
		// 获取token接口Token加密方式 :md5(url参数+data_id+APP_ID)
		$token = md5($url . $keywordid . $app_id);
		Log::write("------------------------------ 生成token：" . $token);

		// 4.=========================== 将token写入到关键词中 ===========================
		$data_keyword['detect_token'] = $token;
		$model_keyword->where(array('id' => $keywordid))->save($data_keyword);

		// 5.=========================== 关键词检测记录中增加一条记录 ===========================
		// 关键词检测记录
		$modelKeyworddetectrecord = D('Biz/Keyworddetectrecord');
		$modelKeyworddetectrecord->addRecord($keywordid, $keyword, $website, $searchengine, $createuserid);

		// 5.=========================== 生成分类 ===========================
		switch ($searchengine) {
		case 'baidu':
			$type = 1;
			break;
		case 'baidu_mobile':
			$type = 2;
			break;
		case '360':
			$type = 3;
			break;
		case '360_mobile':
			$type = 4;
			break;
		case 'sougou':
			$type = 5;
			break;
		case 'sougou_mobile':
			$type = 6;
			break;
		case 'shenma':
			$type = 7;
			break;
		default:
			$type = 1;
			break;
		}

		// 组合最终的推送信息
		$postData['data_id'] = $keywordid; // 数据ID(方便A方接收数据时处理相关逻辑)
		$postData['type'] = $type; // 类别(具体标准是：1或者参数为空：百度PC;2：百度移动；3：360PC；4：360移动;5:搜狗PC；6:搜狗移动；7:神马搜索；)
		$postData['url'] = $url; // 网站地址
		$postData['keywords'] = $keyword; // 关键词
		$postData['app_id'] = $app_id; // APP_ID（接入时由平台分配，请务必妥善保管）
		$postData['app_key'] = $app_key; // APP_KEY（接入时由平台分配，请务必妥善保管）
		Log::write("------------------------------ 组合最终的推送信息：" . json_encode($postData));

		// 6.=========================== 进行接口推送 ===========================
		// TODO 本地测试环境不进行推送==================>
		if ($app_environment != 3 && $app_environment != 4) {
			Log::write("=========================== 新增检测任务end ===========================");
			return true;
		}

		if ($app_environment == 3 || $app_environment == 4) {
			$result_post = API_V1Model::httpClientPostData($postData, $host, $url_post);

			// 6.=========================== 判断操作结果，如果提交接口失败，那么需要滚回数据 ===========================
			// 判断操作结果，如果提交接口失败，那么需要滚回数据
			$response = json_decode($result_post['response'], true);
			Log::write("------------------------------ 推送结果：" . json_encode($response));
			if ($response['ret'] != 1) {
				$this->error = '推送接口失败';
				Log::write("=========================== 新增检测任务end ===========================");
				return false;
			}
		}

		Log::write("=========================== 新增检测任务end ===========================");

		return true;
	}

	/**
	 * 删除检测任务
	 *
	 * 删除检测任务：调用接口，根据关键词id删除第三方的关键词检测任务
	 * 1、在关键词的状态有优化中变为其他状态的时候，调用该接口
	 * 2、
	 *
	 */
	function delete_task($keywordid) {

		Log::write("=========================== 删除检测任务begin ===========================");

		// 关键词模型
		$model_keyword = D('Biz/Keyword');

		// 当前系统运行环境
		$app_environment = C('APP_ENVIRONMENT');
		// 获取接口参数
		$keywor_detect_config_arr = C('KEYWORD_DETECT_CONFIG');
		// 获取接口参数
		$keywor_detect_config = $keywor_detect_config_arr[$app_environment];

		$app_id = $keywor_detect_config['APP_ID'];
		$app_key = $keywor_detect_config['APP_KEY'];
		$url_post = $keywor_detect_config['DELETE_TASK_URL2'];
		// 获取当前接口的主机地址
		$host = $this->yundanran_parse_host($url_post);

		// 1.=========================== 判断关键词主键是否存在 ===========================
		if (!$keywordid) {
			$this->error = '获取关键词信息失败';
			return false;
		}

		// 2.=========================== 组合最终的推送信息  ===========================
		// 组合最终的推送信息
		$postData['data_id'] = $keywordid; // 数据ID(方便A方接收数据时处理相关逻辑)
		$postData['app_id'] = $app_id; // APP_ID（接入时由平台分配，请务必妥善保管）
		$postData['app_key'] = $app_key; // APP_KEY（接入时由平台分配，请务必妥善保管）

		Log::write("------------------------------ 组合最终的推送信息：" . json_encode($postData));
		// 3.=========================== 进行接口推送 ===========================
		// TODO 本地测试环境不进行推送==================>
		if ($app_environment != 3 && $app_environment != 4) {
			Log::write("=========================== 删除检测任务end ===========================");
			return true;
		}

		if ($app_environment == 3 || $app_environment == 4) {
			$result_post = API_V1Model::httpClientPostData($postData, $host, $url_post);
			// 4.=========================== 判断操作结果，如果提交接口失败，那么需要滚回数据 ===========================
			// 判断操作结果，如果提交接口失败，那么需要滚回数据
			$response = json_decode($result_post['response'], true);
			Log::write("------------------------------ 推送结果：" . json_encode($response));
			if ($response['ret'] != 1) {
				$this->error = '推送接口失败';
				return false;
			}
		}
		Log::write("=========================== 删除检测任务end ===========================");
		return true;
	}

	/**
	 *
	 */

	/**
	 * 检测关键词：新接口 2017年9月6日10:46:11
	 *
	 * 检测所有正在优化中的关键词：
	 * //SELECT tb1.* FROM tb1 LEFT JOIN tb2 ON tb1.id=tb2.id WHERE tb2.id IS NULL;
	 * 1、检测全部正在优化，无论是否达标都需要对该关键词进行检测，只有当前的最新排名在第一页，才会进行达标扣费
	 * 2、如果排名在第一页，修改该关键词的状态为已达标，并且判断是否是第一次达标，如果是第一次达标，就将该关键词进行绑定，并且90天内不能解冻
	 *
	 */
	function detect1($list) {
		header("Content-type: text/html; charset=utf-8");
		// 关键词检测视图模型
		//$model_detect 	= D('Biz/KeyworddetectView');
		// 关键词检测记录
		$modelKeyworddetectrecord = D('Biz/Keyworddetectrecord');

		// 获取接口参数
		$keywor_detect_config = C('KEYWORD_DETECT_CONFIG');
		$app_id = $keywor_detect_config['APP_ID'];
		$app_key = $keywor_detect_config['APP_KEY'];

		// 获取还没进行检测的全部关键词
		// 1.=========================== 从系统中获获取还没进行检测的全部关键词 ===========================
		if (!$list) {

			$sql = 'SELECT ts_keyword.id,keywordstatus,ts_keyword.keyword,ts_keyword.searchengine,ts_keyword.website,ts_keyword.createuserid FROM ts_keyword LEFT JOIN ts_keyworddetectrecord ON ts_keyworddetectrecord.keywordid = ts_keyword.id  AND ts_keyword.status=1 AND ts_keyworddetectrecord.status=1 AND ts_keyworddetectrecord.createtime LIKE "' . date('Y-m-d') . '%" WHERE ts_keyword.keywordstatus="优化中" AND ts_keyworddetectrecord.keywordid IS NULL';
			$list = M()->query($sql);
			//dump($list);
			//	dump(M() -> _sql());
			//exit;
			// $map['standardstatus'] 	= array('NEQ', '已达标');
			//$map['keywordstatus'] 	= '优化中';
			//$map['status'] 			= 1;
			//$map['createtime2'] 	= array('LIKE', date('Y-m-d').'%');
			//$map['status2'] 		= 1;
			//$map['keywordid'] 		= array('EXP', 'IS NULL');
			//$list = $model_detect -> queryRecordAll( $map,'id' );

			//dump($model_detect -> _sql());
			//SELECT tb1.* FROM tb1 LEFT JOIN tb2 ON tb1.id=tb2.id WHERE tb2.id IS NULL;

			//	$show_trans = true;
		}

		// 2.=========================== 获取接口推送地址和主机地址 ===========================
		// 获取接口地址
		$url_post = $keywor_detect_config['ADD_TASK_URL'];
		// 获取当前接口的主机地址
		$host = $this->yundanran_parse_host($url_post);

		// 3.=========================== 循环对关键词进行处理：进行推送检测 ===========================
		// 循环对关键词进行处理
		foreach ($list as $vo) {

			// 4.=========================== 在检测记录中增加一条检测的记录 ===========================
			// 在检测记录中增加一条检测的记录
			$record = $modelKeyworddetectrecord->addRecord($vo['id'], $vo['keyword'], $vo['website'], $vo['searchengine'], $vo['createuserid']);

			// 如果新增成功才进行推送消息处理
			if ($record) {

				// 网站地址 去掉www. m.  Wap. 3g.  等前缀
				//$url = str_replace(array('www.','m.','Wap.', '3g.'),'',$vo['website']);

				//$url = str_ireplace(array('www.','Wap.', '3g.'),'',$vo['website']);

				// 新去掉http://
				$url = str_ireplace(array('http://', 'https://'), '', $vo['website']);

				// 需要替换的前缀
				$prefixs = array('www.', 'm.', 'wap.', '3g.');
				// 判断是否已以下的几个开开头
				foreach ($prefixs as $vo_pf) {
					if (stripos($url, $vo_pf) === 0) {
						$url = substr($url, strlen($vo_pf));
					}
				}

				// 5.=========================== 根据检测记录主键值生成token，并保存到检测记录中 ===========================
				// 获取token接口Token加密方式 :md5(url参数+data_id+APP_ID)
				$token = md5($url . $record . $app_id);

				//将token插入都数据库
				$data['token'] = $token;
				$r = $modelKeyworddetectrecord->where(array('id' => $record))->save($data);

				//调用关键词接口进行获取数据
				// 循环对关键词进行检测 ：  具体标准是：1或者参数为空：百度PC;2：百度移动；3：360PC；4：360移动;5:搜狗PC；6:搜狗移动；7:神马搜索；
				switch ($vo['searchengine']) {
				case 'baidu':
					$type = 1;
					break;
				case 'baidu_mobile':
					$type = 2;
					break;
				case '360':
					$type = 3;
					break;
				case '360_mobile':
					$type = 4;
					break;
				case 'sougou':
					$type = 5;
					break;
				case 'sougou_mobile':
					$type = 6;
					break;
				case 'shenma':
					$type = 7;
					break;
				default:
					$type = 1;
					break;
				}
				$postData['data_id'] = $record; // 数据ID(方便A方接收数据时处理相关逻辑)
				$postData['type'] = $type; // 类别(具体标准是：1或者参数为空：百度PC;2：百度移动；3：360PC；4：360移动;5:搜狗PC；6:搜狗移动；7:神马搜索；)
				$postData['url'] = $url; // 网站地址
				$postData['keywords'] = $vo['keyword']; // 关键词
				$postData['app_id'] = $app_id; // APP_ID（接入时由平台分配，请务必妥善保管）
				$postData['app_key'] = $app_key; // APP_KEY（接入时由平台分配，请务必妥善保管）

				// 6.=========================== 进行接口推送 ===========================
				// 本地测试环境不进行推送
				// TODO ==================>
				if ($app_environment != 3 && $app_environment != 4) {
					$result_post = API_V1Model::httpClientPostData($postData, $host, $url_post);
				}

				$response = json_decode($result_post['response'], true);

				// 7.=========================== 判断操作结果，如果提交接口失败，那么需要滚回数据 ===========================
				// 判断操作结果，如果提交接口失败，那么需要滚回数据
				if ($response['ret'] != 1) {
					//
					$modelKeyworddetectrecord->deleteRecord(array('id' => $record));

				}

				// 8.=========================== 显示页面trans ===========================
				if ($show_trans) {
					dump($postData);
					dump($response);
				}

			}
		}

	}

	/**
	 * 或的url的host
	 * 2013年4月26日20:33:25
	 * 2013年5月9日20:28:05
	 */
	function yundanran_parse_host($url) {
		if (!is_string($url) || $url == '') {
			return "";
		}

		$info = parse_url($url);
		$host = isset($info['host']) ? $info['host'] : "";
		if ($host == "") {
			return "";
		}

		if (preg_match("/^192\.168\.\d{1,3}\.\d{1,3}¦127\.\d{1,3}\.\d{1,3}\.\d{1,3}¦255\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $host)) {
			return "";
		}

		if (!preg_match("/\.[a-z]+$/i", $host) && !preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $host)) {
			return "";
		}

		return $host;
	}

/**
 * 检测关键词：新接口 2017年9月6日10:46:11
 *
 * 检测所有正在优化中的关键词：
 * //SELECT tb1.* FROM tb1 LEFT JOIN tb2 ON tb1.id=tb2.id WHERE tb2.id IS NULL;
 * 1、检测全部正在优化，无论是否达标都需要对该关键词进行检测，只有当前的最新排名在第一页，才会进行达标扣费
 * 2、如果排名在第一页，修改该关键词的状态为已达标，并且判断是否是第一次达标，如果是第一次达标，就将该关键词进行绑定，并且90天内不能解冻
 *
 */
	function detect_all($list) {

		Log::write("=========================== 推送接口 beign ===========================");

		// 关键词模型
		$model_keyword = D('Biz/Keyword');
		// 关键词检测记录
		$modelKeyworddetectrecord = D('Biz/Keyworddetectrecord');

		// 获取接口参数
		// 当前系统运行环境
		$app_environment = C('APP_ENVIRONMENT');
		// 获取接口参数
		$keywor_detect_config_arr = C('KEYWORD_DETECT_CONFIG');
		// 获取接口参数
		$keywor_detect_config = $keywor_detect_config_arr[$app_environment];

		$app_id = $keywor_detect_config['APP_ID'];
		$app_key = $keywor_detect_config['APP_KEY'];

		// 获取还没进行检测的全部关键词
		// 1.=========================== 从系统中获获取还没进行检测的全部关键词 ===========================
		if (!$list) {

			$show_trans = true;
			// 获取优化中的关键词，并且检测时间不是今天的全部关键词
			$sql = 'SELECT ts_keyword.id,keywordstatus,ts_keyword.keyword,ts_keyword.searchengine,ts_keyword.website,ts_keyword.createuserid,is_detect,ts_keyword.status FROM ts_keyword LEFT JOIN ts_keyworddetectrecord ON ts_keyworddetectrecord.keywordid = ts_keyword.id  AND ts_keyword.status=1 AND ts_keyworddetectrecord.status=1 AND ts_keyworddetectrecord.createtime LIKE "' . date('Y-m-d') . '%" WHERE ts_keyword.keywordstatus="优化中" AND ts_keyworddetectrecord.keywordid IS NULL';
			$list = M()->query($sql);
			//dump(M() -> _sql());
			//dump(count($list));
			foreach ($list as $k_t => &$vo_t) {
				if ($vo_t['status'] != 1) {
					unset($list[$k_t]);
				}
			}
			//dump(count($list));
			//$map['keywordstatus'] 	= '优化中';
			//$map['detectiondate'] 	= array('LT', date('Y-m-d'));
			//$map['status'] 			= 1;
			//$list = $model_keyword -> queryRecordAll( $map,'id,keyword,searchengine,website,createuserid,keywordstatus,is_detect' );
			//dump($list);

			//exit;
			// 查询还未在检测记录表中有数据的
			foreach ($list as $key_list => &$vo_list) {
				$map_temp['keywordid'] = $vo_list['id'];
				$map_temp['createtime'] = array('LIKE', date('Y-m-d') . '%');
				$temp = $modelKeyworddetectrecord->where($map_temp)->find();
				if ($temp) {
					unset($list[$key_list]);
				}
			}
		}

		// 2.=========================== 获取接口推送地址和主机地址 ===========================
		// 获取接口地址
		$url_post = $keywor_detect_config['PUSH_URL'];
		// 获取当前接口的主机地址
		$host = $this->yundanran_parse_host($url_post);

		// 3.=========================== 将关键词全部新增到检测记录表中 ===========================
		$record = $modelKeyworddetectrecord->addRecords($list, $app_id);

		// 循环对关键词进行处理
		foreach ($list as $vo) {
			$vo['website'] = trim($vo['website']);
			// 组合url
			$url = str_ireplace(array('http://', 'https://'), '', $vo['website']);
			// 需要替换的前缀
			$prefixs = array('www.', 'm.', 'wap.', '3g.');
			// 判断是否已以下的几个开开头
			foreach ($prefixs as $vo_pf) {
				if (stripos($url, $vo_pf) === 0) {
					$url = substr($url, strlen($vo_pf));
				}
			}

			$url = rtrim($url, '/');

			// 4.=========================== 对还未生成token的关键词生成token ===========================
			// 对还未生成token的关键词生成token
			if (!$vo['detect_token']) {

				// 获取token接口Token加密方式 :md5(url参数+data_id+APP_ID)
				$token = md5($url . $vo['id'] . $app_id);

				//将token插入都数据库
				$keyword['detect_token'] = $token;

				$model_keyword->where(array('id' => $vo['id']))->save($keyword);
			}

			// 5.=========================== 对还未进行检测的数据进行接口的推送 ===========================
			// 生成分类
			switch ($vo['searchengine']) {
			case 'baidu':
				$type = 1;
				break;
			case 'baidu_mobile':
				$type = 2;
				break;
			case '360':
				$type = 3;
				break;
			case '360_mobile':
				$type = 4;
				break;
			case 'sougou':
				$type = 5;
				break;
			case 'sougou_mobile':
				$type = 6;
				break;
			case 'shenma':
				$type = 7;
				break;
			default:
				$type = 1;
				break;
			}

			// 组合最终的推送信息
			$postData['data_id'] = $vo['id']; // 数据ID(方便A方接收数据时处理相关逻辑)
			$postData['type'] = $type; // 类别(具体标准是：1或者参数为空：百度PC;2：百度移动；3：360PC；4：360移动;5:搜狗PC；6:搜狗移动；7:神马搜索；)
			$postData['url'] = $url; // 网站地址
			$postData['keywords'] = $vo['keyword']; // 关键词
			$postData['app_id'] = $app_id; // APP_ID（接入时由平台分配，请务必妥善保管）
			$postData['app_key'] = $app_key; // APP_KEY（接入时由平台分配，请务必妥善保管）
			// 6.=========================== 进行接口推送 ===========================
			// 本地测试环境不进行推送
			// TODO ==================>
			Log::write("------------------------------ 组合最终的推送信息：" . json_encode($postData));
			if ($app_environment == 3 || $app_environment == 4) {
				$result_post = API_V1Model::httpClientPostData($postData, $host, $url_post);
				$response = json_decode($result_post['response'], true);
			} else {
				$response['ret'] = 1;
			}
			// 7.=========================== 判断操作结果，如果提交接口失败，那么需要滚回数据 ===========================

			Log::write("------------------------------ 推送结果数据：" . json_encode($response));
			Log::write("------------------------------ 推送结果：" . $response['msg']);
			if ($response['ret'] != 1) {

				$fail_num++;

				// TODO 推送失败删除
				$map_detect['keywordid'] = $vo['id'];
				$map_detect['createtime'] = array('LIKE', date('Y-m-d') . '%');
				$modelKeyworddetectrecord->deleteRecord($map_detect);

				$this->error = '推送接口失败，原因：' . $response['msg'];

				if (!$show_trans) {
					Log::write("=========================== 推送接口 end ===========================");
					return false;
				}
			} else {
				$succss_num++;
			}

			// 8.=========================== 显示页面trans ===========================
			if ($show_trans) {
				dump($postData);
				dump($url_post);
				dump($response);
			}

			Log::write("=========================== 推送接口 end ===========================");

		}

		if ($show_trans) {
			dump('成功数量：' . $succss_num);
			dump('失败数量：' . $fail_num);
		}
		return true;
	}

/**
 * 检测关键词：新接口 2017年9月6日10:46:11
 *
 * 检测所有正在优化中的关键词：
 * //SELECT tb1.* FROM tb1 LEFT JOIN tb2 ON tb1.id=tb2.id WHERE tb2.id IS NULL;
 * 1、检测全部正在优化，无论是否达标都需要对该关键词进行检测，只有当前的最新排名在第一页，才会进行达标扣费
 * 2、如果排名在第一页，修改该关键词的状态为已达标，并且判断是否是第一次达标，如果是第一次达标，就将该关键词进行绑定，并且90天内不能解冻
 *
 */
	function redetect($list) {
		// 关键词检测记录
		$modelKeyworddetectrecord = D('Biz/Keyworddetectrecord');

	}

	/**
	 * 修改者：郑永杰 2018年7月18日 6:17
	 *
	 * 查询昨日有排名今日没排名的关键词
	 *
	 */
	// function detect_differ() {
	// 	Log::write("=========================== 推送接口 beign ===========================");
	// 	$show_trans = true;
	// 	// 关键词模型
	// 	$model_keyword = D('Biz/Keyword');
	// 	// 关键词检测记录
	// 	$model_detectrecord = D('Biz/Keyworddetectrecord');

	// 	// 1.=========================== 获取接口推送参数 ===========================
	// 	// 当前系统运行环境
	// 	$app_environment = C('APP_ENVIRONMENT');
	// 	// 获取接口参数
	// 	$detect_config_arr = C('KEYWORD_DETECT_CONFIG');
	// 	// 获取接口参数
	// 	$detect_config = $detect_config_arr[$app_environment];
	// 	// 获取接口APP_ID
	// 	$app_id = $detect_config['APP_ID'];
	// 	// 获取接口APP_KEY
	// 	$app_key = $detect_config['APP_KEY'];
	// 	// 获取接口地址
	// 	$url_post = $detect_config['PUSH_URL'];
	// 	// 获取当前接口的主机地址
	// 	$host = $this->yundanran_parse_host($url_post);
	// 	// 2.=========================== 从系统中获取昨日有排名今日无排名的全部关键词 ===========================
	// 	$beignToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
	// 	$beginYesterday = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
	// 	$endYesterday = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - 1;
	// 	// 查询昨天处于1-10排名中的关键词
	// 	$search['rank'] = array(array('EGT', 1), array('ELT', 10), 'AND');
	// 	$search['regtime'] = array(array('GT', $beginYesterday), array('LT', $endYesterday), 'AND');
	// 	$yesterday = $model_detectrecord->where($search)->select();
	// 	// 比较今日数据
	// 	$search1['rank'] = array('GT', 10);
	// 	$search1['regtime'] = array('GT', $beignToday);
	// 	foreach ($yesterday as $k => $v) {
	// 		$search1['keywordid'] = $v['keywordid'];
	// 		$today = $model_detectrecord->where($search1)->find();
	// 		if ($today) {
	// 			$result[] = $v['keywordid'];
	// 		}
	// 	}

	// 	if (is_array($result)) {
	// 		$list = $model_keyword->where('id in (' . rtrim(implode(',', $result), ',') . ')')->field('id,keywordstatus,keyword,latestranking,detect_token,searchengine,website,createuserid,status')->select();
	// 	} else {
	// 		$list = '';
	// 	}
	// 	//断点排查数据是否正常
	// 	dump($list);exit;
	// 	if ($list) {
	// 		// 3.=========================== 获取接口推送地址和主机地址 ===========================
	// 		// 获取接口地址
	// 		$url_post = $detect_config['PUSH_URL'];
	// 		// 获取当前接口的主机地址
	// 		$host = $this->yundanran_parse_host($url_post);

	// 		// 4.=========================== 将关键词全部新增到检测记录表中 ===========================
	// 		$record = $model_detectrecord->addRecords($list, $app_id);
	// 		// 5.=========================== 循环对关键词进行处理 ===========================
	// 		foreach ($list as $vo) {
	// 			$vo['website'] = trim($vo['website']);
	// 			// 组合url
	// 			$url = str_ireplace(array('http://', 'https://'), '', $vo['website']);
	// 			// 需要替换的前缀
	// 			$prefixs = array('www.', 'm.', 'wap.', '3g.');
	// 			// 判断是否已以下的几个开开头
	// 			foreach ($prefixs as $vo_pf) {
	// 				if (stripos($url, $vo_pf) === 0) {
	// 					$url = substr($url, strlen($vo_pf));
	// 				}
	// 			}

	// 			$url = rtrim($url, '/');

	// 			// 6.=========================== 检验token ===========================
	// 			// 获取token接口Token加密方式 :md5(url参数+data_id+APP_ID)
	// 			$token = md5($url . $vo['id'] . $app_id);
	// 			// 对还未生成token的关键词生成token
	// 			if ($vo['detect_token'] != $token) {
	// 				//将token插入都数据库
	// 				$keyword['detect_token'] = $token;
	// 				$model_keyword->where(array('id' => $vo['id']))->save($keyword);
	// 			}

	// 			// 7.=========================== 对还未进行检测的数据进行接口的推送 ===========================
	// 			// 生成分类
	// 			switch ($vo['searchengine']) {
	// 			case 'baidu':
	// 				$type = 1;
	// 				break;
	// 			case 'baidu_mobile':
	// 				$type = 2;
	// 				break;
	// 			case '360':
	// 				$type = 3;
	// 				break;
	// 			case '360_mobile':
	// 				$type = 4;
	// 				break;
	// 			case 'sougou':
	// 				$type = 5;
	// 				break;
	// 			case 'sougou_mobile':
	// 				$type = 6;
	// 				break;
	// 			case 'shenma':
	// 				$type = 7;
	// 				break;
	// 			default:
	// 				$type = 1;
	// 				break;
	// 			}

	// 			// 组合最终的推送信息
	// 			$postData['data_id'] = $vo['id']; // 数据ID(方便A方接收数据时处理相关逻辑)
	// 			$postData['type'] = $type; // 类别(具体标准是：1或者参数为空：百度PC;2：百度移动；3：360PC；4：360移动;5:搜狗PC；6:搜狗移动；7:神马搜索；)
	// 			$postData['url'] = $url; // 网站地址
	// 			$postData['keywords'] = $vo['keyword']; // 关键词
	// 			$postData['app_id'] = $app_id; // APP_ID（接入时由平台分配，请务必妥善保管）
	// 			$postData['app_key'] = $app_key; // APP_KEY（接入时由平台分配，请务必妥善保管）
	// 			// 8.=========================== 进行接口推送 ===========================
	// 			// 本地测试环境不进行推送
	// 			// TODO ==================>
	// 			Log::write("------------------------------ 组合最终的推送信息：" . json_encode($postData));
	// 			if ($app_environment == 3 || $app_environment == 4) {
	// 				$result_post = API_V1Model::httpClientPostData($postData, $host, $url_post);
	// 				$response = json_decode($result_post['response'], true);
	// 			} else {
	// 				$response['ret'] = 1;
	// 			}
	// 			// 9.=========================== 判断操作结果，如果提交接口失败，那么需要滚回数据 ===========================
	// 			Log::write("------------------------------ 推送结果数据：" . json_encode($response));
	// 			Log::write("------------------------------ 推送结果：" . $response['msg']);
	// 			if ($response['ret'] != 1) {

	// 				$fail_num++;

	// 				// TODO 推送失败删除
	// 				$map_detect['keywordid'] = $vo['id'];
	// 				$map_detect['createtime'] = array('LIKE', date('Y-m-d') . '%');
	// 				$model_detectrecord->deleteRecord($map_detect);

	// 				$this->error = '推送接口失败，原因：' . $response['msg'];

	// 				if (!$show_trans) {
	// 					Log::write("=========================== 推送接口 end ===========================");
	// 					return false;
	// 				}
	// 			} else {
	// 				$succss_num++;
	// 			}

	// 			// 10.=========================== 显示页面trans ===========================
	// 			//if( $show_trans){
	// 			dump($postData);
	// 			dump($url_post);
	// 			dump($response);
	// 			//}

	// 			Log::write("=========================== 推送接口 end ===========================");

	// 		}

	// 		if ($show_trans) {
	// 			dump('成功数量：' . $succss_num);
	// 			dump('失败数量：' . $fail_num);
	// 		}
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}

	// }

	/**
	 * 检测关键词：新接口 2017年9月6日10:46:11
	 *
	 * 检测所有正在优化中的关键词
	 *
	 */
	function detect_again() {

		Log::write("=========================== 推送接口 beign ===========================");

		$show_trans = true;

		// 关键词模型
		$model_keyword = D('Biz/Keyword');
		// 关键词检测记录
		$model_detectrecord = D('Biz/Keyworddetectrecord');

		// 1.=========================== 获取接口推送参数 ===========================
		// 当前系统运行环境
		$app_environment = C('APP_ENVIRONMENT');
		// 获取接口参数
		$detect_config_arr = C('KEYWORD_DETECT_CONFIG');
		// 获取接口参数
		$detect_config = $detect_config_arr[$app_environment];
		// 获取接口APP_ID
		$app_id = $detect_config['APP_ID'];
		// 获取接口APP_KEY
		$app_key = $detect_config['APP_KEY'];
		// 获取接口地址
		$url_post = $detect_config['PUSH_URL'];
		// 获取当前接口的主机地址
		$host = $this->yundanran_parse_host($url_post);

		// 2.=========================== 从系统中获取还没有排名的全部关键词 ===========================
		$map_keyword['latestranking'] = array(array('LT', 1), array('GT', 10), array('EQ', ''), array('EXP', 'IS NULL'), 'OR');
		$map_keyword['keywordstatus'] = '优化中';
		$map_keyword['status'] = 1;
		$list = $model_keyword->where($map_keyword)->field('id,keywordstatus,keyword,latestranking,detect_token,searchengine,website,createuserid,status')->select($map_keyword);
		//dump( $model_keyword -> _sql());
		//dump( count($list));

		// 3.=========================== 将关键词全部新增到检测记录表中 ===========================
		$record = $model_detectrecord->addRecords($list, $app_id);

		// 4.=========================== 循环对关键词进行处理 ===========================
		foreach ($list as $vo) {
			$vo['website'] = trim($vo['website']);
			// 组合url
			$url = str_ireplace(array('http://', 'https://'), '', $vo['website']);
			// 需要替换的前缀
			$prefixs = array('www.', 'm.', 'wap.', '3g.');
			// 判断是否已以下的几个开开头
			foreach ($prefixs as $vo_pf) {
				if (stripos($url, $vo_pf) === 0) {
					$url = substr($url, strlen($vo_pf));
				}
			}

			$url = rtrim($url, '/');

			// 5.=========================== 检验token ===========================
			// 获取token接口Token加密方式 :md5(url参数+data_id+APP_ID)
			$token = md5($url . $vo['id'] . $app_id);
			// 对还未生成token的关键词生成token
			if ($vo['detect_token'] != $token) {
				//将token插入都数据库
				$keyword['detect_token'] = $token;
				$model_keyword->where(array('id' => $vo['id']))->save($keyword);
			}

			// 6.=========================== 对还未进行检测的数据进行接口的推送 ===========================
			// 生成分类
			switch ($vo['searchengine']) {
			case 'baidu':
				$type = 1;
				break;
			case 'baidu_mobile':
				$type = 2;
				break;
			case '360':
				$type = 3;
				break;
			case '360_mobile':
				$type = 4;
				break;
			case 'sougou':
				$type = 5;
				break;
			case 'sougou_mobile':
				$type = 6;
				break;
			case 'shenma':
				$type = 7;
				break;
			default:
				$type = 1;
				break;
			}

			// 组合最终的推送信息
			$postData['data_id'] = $vo['id']; // 数据ID(方便A方接收数据时处理相关逻辑)
			$postData['type'] = $type; // 类别(具体标准是：1或者参数为空：百度PC;2：百度移动；3：360PC；4：360移动;5:搜狗PC；6:搜狗移动；7:神马搜索；)
			$postData['url'] = $url; // 网站地址
			$postData['keywords'] = $vo['keyword']; // 关键词
			$postData['app_id'] = $app_id; // APP_ID（接入时由平台分配，请务必妥善保管）
			$postData['app_key'] = $app_key; // APP_KEY（接入时由平台分配，请务必妥善保管）
			// 7.=========================== 进行接口推送 ===========================
			// 本地测试环境不进行推送
			// TODO ==================>
			Log::write("------------------------------ 组合最终的推送信息：" . json_encode($postData));
			if ($app_environment == 3 || $app_environment == 4) {
				$result_post = API_V1Model::httpClientPostData($postData, $host, $url_post);
				$response = json_decode($result_post['response'], true);
			} else {
				$response['ret'] = 1;
			}
			// 8.=========================== 判断操作结果，如果提交接口失败，那么需要滚回数据 ===========================

			Log::write("------------------------------ 推送结果数据：" . json_encode($response));
			Log::write("------------------------------ 推送结果：" . $response['msg']);
			if ($response['ret'] != 1) {

				$fail_num++;

				// TODO 推送失败删除
				$map_detect['keywordid'] = $vo['id'];
				$map_detect['createtime'] = array('LIKE', date('Y-m-d') . '%');
				$modelKeyworddetectrecord->deleteRecord($map_detect);

				$this->error = '推送接口失败，原因：' . $response['msg'];

				if (!$show_trans) {
					Log::write("=========================== 推送接口 end ===========================");
					return false;
				}
			} else {
				$succss_num++;
			}

			// 9.=========================== 显示页面trans ===========================
			//if( $show_trans){
			dump($postData);
			dump($url_post);
			dump($response);
			//}

			Log::write("=========================== 推送接口 end ===========================");

		}

		if ($show_trans) {
			dump('成功数量：' . $succss_num);
			dump('失败数量：' . $fail_num);
		}

		return true;

	}

}

?>