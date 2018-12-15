<?php

/**
 * 资金系统数据接口控制类
*
* @category	业务控制类
* @package    fundmanage.Action.Manage
* @copyright  Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
* @version    20141126
* @link       http://www.mitong.com
*/

class API_V1Action {

	/**
	 * 初始化函数
	 * @access public
	 */
	public function _initialize() {
		//继承
		parent::_initialize();
	}

	/**
	 * 关键词检测回调接口
	 * 1、首次达标就冻结30天的费用
	 * 2、达标的费用从冻结的资金中进行扣费，并且一个账号的全部冻结资金是公用的，如果冻结资金消耗完了，就从余额总进行扣除
	 *
	 * @return string 资金申请信息处理结果
	 * @author zhangss
	 */
	public function receive_keywords_rank(){
		Log::write("============================== 关键词检测接口调试 ==============================");
		// 关键词模型
		$modelKeyword 				= D('Biz/Keyword');
		// 关键词检测模型
		$modelKeyworddetectrecord 	= D('Biz/Keyworddetectrecord');
		// 关键词达标扣费模型
		$modelStandardfee 			= D('Biz/Standardfee');
		// 资金账户模型
		$modelFunds 				= D('Biz/Funds');
		// 资金账户冻结模型
		$modelFundsfreeze 			= D('Biz/Fundsfreeze');
	
		Log::write("---------------/--------------- 原始数据POST：".json_encode($_POST));
		Log::write("-----------------/------------- 原始数据REQUEST：".json_encode($_REQUEST));
		//Log::write("------------------------------ input：".json_encode(file_get_contents("php://input")));
		
		// 1.=========================== 从请求中获取参数 ===========================
		$token 		= $_POST['token'];
		$data_id	= $_POST['data_id'];
		$keywords	= $_POST['keywords'];
		$type		= $_POST['type'];
		$rank		= $_POST['rank'];
		$url		= $_POST['url'];
	
		$token 		= $_REQUEST['token'];
		$data_id	= $_REQUEST['data_id'];
		$keywords	= $_REQUEST['keywords'];
		$type		= $_REQUEST['type'];
		$rank		= $_REQUEST['rank'];
		$url		= $_REQUEST['url'];
		
		/*测试数据*/
		/*
		$token 		= "eadf855b997f06e7a236c3c7695a8954";
		$data_id	= 4;
		$keywords	= "seo";
		$type		= 1;
		$rank		= 15;
		$url		= "10jrw.com";
		*/
		
		
		// 没有任务ID
		if( !$data_id ){
			$return['ret'] 		= -1;
			$return['message'] 	= '任务ID为空';
			exit(json_encode( $return ));
		}
	
		// 2.=========================== 根据data_id来获取关键词的详细信息，并进行相关的校验 ===========================
		// 查询搜索任务：值查询满足条件的任务
		$map_kw['id'] 				= $data_id;
		$map_kw['status'] 			= 1;
		$map_kw['keywordstatus'] 	= '优化中';
		$data_kw = $modelKeyword -> selectOne( $map_kw );
		unset( $map_kw );
		//判断$token是否相同
		/*
		if( $token != $data_kw['detect_token']){
			$return['ret'] 		= -1;
			$return['message'] 	= 'token校验不正确';
			exit(json_encode( $return ));
		}
		//判断关键词是否相同
		if( $keywords != $data_kw['keyword']){
			$return['ret'] 		= -1;
			$return['message'] 	= '关键词校验不正确';
			exit(json_encode( $return ));
		}*/
		
		//判断url是否相同
// 		if( $url != $data['website']){
// 			$return['ret'] 		= -1;
// 			$return['message'] 	= 'url验证不正确';
// 			exit(json_encode( $return ));
// 		}
		// 当前的时间：达标时间
		$date_cur 		= date('Y-m-d H:i:s');
		// 判断最新达标日期是否是今天，如果是今天表示今日已经达标了，不能再重复进行扣费
		if( substr( $data_kw['standarddate'],0,10 ) == substr( $date_cur,0,10 ) ){
			$return['ret'] 		= 1;
			$return['message'] 	= '成功';
			exit(json_encode( $return ));
		}
		
		// 不是优化中的不检测
		if( $data_kw['keywordstatus'] != '优化中' ){
			$return['ret'] 		= 1;
			$return['message'] 	= '成功';
			exit(json_encode( $return ));
		}
		
		//Add by echo 2018-03-29 如果非初次检测,排名不在首页,10点之前 直接跳过
		
		if(date('H')<10 && !$data_kw['detectiondate'] && $rank>10){
			$return['ret'] 		= 1;
			$return['message'] 	= '成功';
			exit(json_encode( $return ));
		}
		
		// 3.=========================== 验证通过后，进行数据处理 ===========================
		// 真实排名
		$rank_real	= $rank;
		// 判断是否是首次进行关键词的检测
		if( !$data_kw['detectiondate'] ){
			
			// 如果是首次进行检测，需要更新初始排名,将排加上10
			// update By Richer 于2017年6月9日17:27:46 所有初始排名加10
			// update By Richer 于2017年7月25日10:43:23 所有的初始排名加10到15之间的随机数
			$num = rand(10, 15) ;
			if( $rank > 0 ){
				$rank 	= $rank + $num;//
			}
			// 设置初始排名
			$kw['initialranking'] 	= $rank;// 初始排名
		}
	
		// 4.=========================== 更新检测记录表中的数据  ===========================
		// 更新检测记录表中的数据
		$result = $modelKeyworddetectrecord -> updateRecord( $rank,$rank_real,$data_kw['id'], $data_kw['keyword'], $data_kw['website'], $data_kw['searchengine'], $data_kw['createuserid'] );
		//dump($modelKeyworddetectrecord -> _sql());
		// 5.=========================== 组合关键词公共信息  ===========================
		// 组合关键词公共部分
		$kw['id'] 				= $data_id;
		$kw['detectiondate'] 	= $date_cur;// 检测时间
		$kw['latestranking'] 	= $rank;// 最新排名
		$kw['is_detect'] 		= 1;// 已经通过检测接口进行了检测
	
		// 如果关键词达标
		if( $rank <= 10 && $rank  > 0){
				
			// 6.=========================== 获取资金账户信息  ===========================
			// 获取资金账户信息
			$data_funds  	= $modelFunds -> selectOne( array('userid' => $data_kw['createuserid'] ));
			
			// 7.=========================== 组合关键词其他信息  ===========================
			// 剩余冻结资金
			$freezefunds = $data_funds['freezefunds'];
			$kw['standarddate'] 		= $date_cur;// 达标时间
			$kw['standardstatus'] 		= '已达标';// 达标状态
			$kw['latestconsumption'] 	= $data_kw['price']; // 最新消费
			$kw['standarddays'] 		= $data_kw['standarddays'] + 1;// 达标天数
			$kw['totalconsumption'] 	= $data_kw['totalconsumption'] + $data_kw['price']; // 累计消费
			
			// 判断是否是首次达标
			if ( !$data_kw['firststandarddate'] ){
				// 如果关键词是首次达标，则需要冻结该关键词90天，90天内部能解冻，并且冻结30天的费用
				// 冻结费用
				// $freezefunds = $data_kw['price'] * 30;
				// 90天之后的日期:允许解冻日期
				$unfreezedate = date("Y-m-d H:i:s",strtotime("+90 day"));
	
				//冻结关键词90天 ====================================>
				$kw['firststandarddate'] 	= $date_cur;// 首次达标时间
				//$kw['standarddays'] 		= 1;// 达标天数
				$kw['unfreezedate'] 		= $unfreezedate;// 解冻日期
			}
				
			// 8.=========================== 更新关键词信息  ===========================
			// 更新关键词
			$result = $modelKeyword -> update($kw);
			//dump($modelKeyword -> _sql());
			Log::write("------------------------------ 更新关键词：". $modelKeyword -> _sql());
	
			
			// 9.=========================== 更新资金账户信息  ===========================
			
			// 更新资金账户更新消费记录 ================>
	
			// 更新资金账户 ：需要将冻结的资金全部消耗完毕，然后再从余额中进行消耗================>
			// 如果冻结资金已经小于当前的关键词单价，那么关键词的消耗要从资金余额中进行扣除
			// 判断是否还有冻结资金
			if( $freezefunds > 0 ){
				// 如果还有冻结资金，
				// 判断冻结资金是否已经小于关键词的单价
				if( $freezefunds <= $data_kw['price'] ){
						
					// 将冻结资金设置为 0
					$funds['freezefunds'] 			= 0;
					// 资金可用余额 :冻结资金消耗完之后从可用余额中扣除
					$funds['availablefunds'] 		= $data_funds['availablefunds']  - $data_kw['price'] + $freezefunds; //array('exp', "balancefunds - {$data_kw['price']}" );// 充值金额减去消费金额
	
				}else{
					// 冻结资金还未消耗完毕，从冻结资金中扣除，此时资金可用余额不变
					$funds['freezefunds'] 			= $data_funds['freezefunds'] 	- $data_kw['price'];// 关键词达标扣费需要从冻结费用中进行扣除
					$funds['availablefunds'] 		= $data_funds['availablefunds'] ;
					// $funds['balancefunds'] 			= $data_funds['balancefunds']   - $data_kw['price']; //array('exp', "balancefunds - {$data_kw['price']}" );// 充值金额减去消费金额
				}
					
			}else{
				// 资金可用余额 :冻结资金消耗完之后从可用余额中扣除
				$funds['availablefunds'] 		= $data_funds['availablefunds']  - $data_kw['price'] ; //array('exp', "balancefunds - {$data_kw['price']}" );// 充值金额减去消费金额
				$funds['freezefunds'] 			= 0;
					
			}
				
			// 资金余额：等于资金可用余额加上资金冻结金额
			$funds['balancefunds'] 			= $funds['availablefunds']  + $funds['freezefunds'];
	
			// update By Richer 于2017年9月1日16:59:37  解决冻结资金出现负数的问题
			if( $funds['freezefunds'] < 0 ){
				$funds['freezefunds']  = 0;
				$funds['availablefunds'] = $funds['balancefunds'] ;
			}
				
			$modelFunds -> where( array('id' => $data_funds['id'] )) -> save( $funds );
			//	dump($modelFunds -> _sql());
			Log::write("------------------------------ 更新资金账户：". $modelFunds -> _sql());
	
	
	
			// 往達標消費記錄中增加一條消費記錄 ================>
			$standardfee['siteid'] 			= $data_kw['siteid'];
			$standardfee['keywordid'] 		= $data_id;
			$standardfee['keyword'] 		= $keywords;
			$standardfee['price'] 			= $data_kw['price'];
			$standardfee['ownuserid'] 		= $data_kw['createuserid'];
			$standardfee['standarddate'] 	= $date_cur;
			$modelStandardfee -> insert( $standardfee );
			//dump($modelStandardfee -> _sql());
			Log::write("---------------/--------------- 达标消费记录中增加信息：". $modelStandardfee -> _sql());
	
		}else{
			$kw['standardstatus'] 		= '未达标';// 达标状态
			$kw['latestconsumption'] 	= 0; // 最新消费
			$result = $modelKeyword -> update($kw);
			Log::write($modelKeyword -> _sql());
		}
	
	
		$return['ret'] 		= 1;
		$return['message'] 	= '成功';
		exit(json_encode( $return ));
	}
	
	/**
	 * 关键词检测回调接口
	 * 1、首次达标就冻结30天的费用
	 * 2、达标的费用从冻结的资金中进行扣费，并且一个账号的全部冻结资金是公用的，如果冻结资金消耗完了，就从余额总进行扣除
	 *
	 * @return string 资金申请信息处理结果
	 * @author zhangss
	 */
	public function receiveKeywordsRank(){
		Log::write("============================== 关键词检测接口调试 ==============================");
		// 关键词模型
		$modelKeyword 				= D('Biz/Keyword');
		// 关键词检测模型
		$modelKeyworddetectrecord 	= D('Biz/Keyworddetectrecord');
		// 关键词达标扣费模型
		$modelStandardfee 			= D('Biz/Standardfee');
		// 资金账户模型
		$modelFunds 				= D('Biz/Funds');
		// 资金账户冻结模型
		$modelFundsfreeze 			= D('Biz/Fundsfreeze');

		Log::write("------------------------------ 原始数据POST：".json_encode($_POST));
		//Log::write("------------------------------ 原始数据REQUEST：".json_encode($_REQUEST));
		//Log::write("------------------------------ input：".json_encode(file_get_contents("php://input")));
		$token 		= $_POST['token'];
		$data_id	= $_POST['task_id'];
		$keywords	= $_POST['keywords'];
		$type		= $_POST['type'];
		$rank		= $_POST['rank'];
		$url		= $_POST['url'];

		$token 		= $_REQUEST['token'];
		$task_id	= $_REQUEST['task_id'];
		$keywords	= $_REQUEST['keywords'];
		$type		= $_REQUEST['type'];
		$rank		= $_REQUEST['rank'];
		$url		= $_REQUEST['url'];

		// 没有任务ID
		if( !$task_id ){
			$return['ret'] 		= -1;
			$return['message'] 	= '任务ID为空';
			exit(json_encode( $return ));
		}

		// 查询搜索任务
		$data = $modelKeyworddetectrecord -> selectOne( array('id' => $task_id ));

		//判断$token是否相同
		if( $token != $data['token']){
			$return['ret'] 		= -1;
			$return['message'] 	= 'token校验不正确';
			exit(json_encode( $return ));
		}

		//判断$token是否相同
		if( $keywords != $data['keyword']){
			$return['ret'] 		= -1;
			$return['message'] 	= '关键词校验不正确';
			exit(json_encode( $return ));
		}

		// 		switch ($type) {
		// 			case 1:
		// 				$data['rankbaidu']= $rank;
		// 			break;
		// 			case 2:
		// 				$data['rankbaidumobile']= $rank;
		// 			break;
		// 			case 3:
		// 				$data['rank360']= $rank;
		// 			break;
		// 			case 4:
		// 				$data['ranksougou']= $rank;
		// 			break;
		// 			case 5:
		// 				$data['rankshenma']= $rank;
		// 			break;
		// 			default:
		// 				$data['rankbaidu']= $rank;
		// 			break;
		// 		}
		
		//同时向对应的关键词中写入排名
		// 获取关键词信息
		$data_kw  		= $modelKeyword -> selectOne( array('id' => $data['keywordid'] ));
		
		// 当前的时间：达标时间
		$date_cur = date('Y-m-d H:i:s');
		
		// 判断最新达标日期是否是今天，如果是今天表示今日已经达标了，不能再重复进行扣费
		if( substr( $data_kw['standarddate'],0,10 ) == substr( $date_cur,0,10 ) ){
			$return['ret'] 		= 1;
			$return['message'] 	= '成功';
			exit(json_encode( $return ));
		}
		
		
		// 判断是否是首次进行关键词的检测
		if( !$data_kw['detectiondate'] ){
			// 如果是首次进行检测，需要更新初始排名,将排加上10
			// update By Richer 于2017年6月9日17:27:46 所有初始排名加10
			// update By Richer 于2017年7月25日10:43:23 所有的初始排名加10到15之间的随机数
			$num = rand(10, 15) ;
			if( $rank > 0 ){
				$rank 	= $rank + $num;//
			}
			// 设置初始排名
			$kw['initialranking'] 	= $rank;// 初始排名
		}
		
		// 更新检测记录表中的数据
		$record['rank']			= $rank;
		$record['rank_original']= $rank;
		$result = $modelKeyworddetectrecord -> where( array('id' => $task_id ) ) -> save($record);

		// 组合关键词公共部分
		$kw['id'] 					= $data['keywordid'];
		$kw['detectiondate'] 		= $date_cur;// 检测时间
		$kw['latestranking'] 		= $rank;// 最新排名
		
		// 如果关键词达标
		if( $rank <= 10 && $rank  > 0){
					
			// 获取资金账户信息
			$data_funds  	= $modelFunds -> selectOne( array('userid' => $data_kw['createuserid'] ));
			
			// 剩余冻结资金
			$freezefunds = $data_funds['freezefunds'];
			$kw['standarddate'] 		= $date_cur;// 达标时间
			$kw['standardstatus'] 		= '已达标';// 达标状态
			$kw['latestconsumption'] 	= $data_kw['price']; // 最新消费
			$kw['standarddays'] 		= $data_kw['standarddays'] + 1;// 达标天数
			$kw['totalconsumption'] 	= $data_kw['totalconsumption'] + $data_kw['price']; // 累计消费
			// 判断是否是首次达标
			if ( !$data_kw['firststandarddate'] ){
				// 如果关键词是首次达标，则需要冻结该关键词90天，90天内部能解冻，并且冻结30天的费用
				// 冻结费用
				// $freezefunds = $data_kw['price'] * 30;
				// 90天之后的日期:允许解冻日期
				$unfreezedate = date("Y-m-d H:i:s",strtotime("+90 day"));

				//冻结关键词90天 ====================================>
				$kw['firststandarddate'] 	= $date_cur;// 首次达标时间
				//$kw['standarddays'] 		= 1;// 达标天数
				$kw['unfreezedate'] 		= $unfreezedate;// 解冻日期
			}
			
			// 更新关键词
			$result = $modelKeyword -> update($kw);
			// dump($modelKeyword -> _sql());
			Log::write("-----------------/------------- 更新关键词：". $modelKeyword -> _sql());
				
			// 更新资金账户更新消费记录 ================>

			// 更新资金账户 ：需要将冻结的资金全部消耗完毕，然后再从余额中进行消耗================>
			// 如果冻结资金已经小于当前的关键词单价，那么关键词的消耗要从资金余额中进行扣除
			// 判断是否还有冻结资金
			if( $freezefunds > 0 ){
				// 如果还有冻结资金，
				// 判断冻结资金是否已经小于关键词的单价
				if( $freezefunds <= $data_kw['price'] ){
			
					// 将冻结资金设置为 0
					$funds['freezefunds'] 			= 0;
					// 资金可用余额 :冻结资金消耗完之后从可用余额中扣除
					$funds['availablefunds'] 		= $data_funds['availablefunds']  - $data_kw['price'] + $freezefunds; //array('exp', "balancefunds - {$data_kw['price']}" );// 充值金额减去消费金额			
						
				}else{
					// 冻结资金还未消耗完毕，从冻结资金中扣除，此时资金可用余额不变
					$funds['freezefunds'] 			= $data_funds['freezefunds'] 	- $data_kw['price'];// 关键词达标扣费需要从冻结费用中进行扣除
					$funds['availablefunds'] 		= $data_funds['availablefunds'] ;
					// $funds['balancefunds'] 			= $data_funds['balancefunds']   - $data_kw['price']; //array('exp', "balancefunds - {$data_kw['price']}" );// 充值金额减去消费金额
				}
					
			}else{
				// 资金可用余额 :冻结资金消耗完之后从可用余额中扣除
				$funds['availablefunds'] 		= $data_funds['availablefunds']  - $data_kw['price'] ; //array('exp', "balancefunds - {$data_kw['price']}" );// 充值金额减去消费金额
				$funds['freezefunds'] 			= 0;
					
			}
			
			// 资金余额：等于资金可用余额加上资金冻结金额
			$funds['balancefunds'] 			= $funds['availablefunds']  + $funds['freezefunds'];
				
			// update By Richer 于2017年9月1日16:59:37  解决冻结资金出现负数的问题
			if( $funds['freezefunds'] < 0 ){
				$funds['freezefunds']  = 0;
				$funds['availablefunds'] = $funds['balancefunds'] ;
			}
			
			$modelFunds -> where( array('id' => $data_funds['id'] )) -> save( $funds );
			// dump($modelFunds -> _sql());
			Log::write("------------------------------ 更新资金账户：". $modelFunds -> _sql());
				

				
			// 往達標消費記錄中增加一條消費記錄 ================>
			$standardfee['siteid'] 			= $data_kw['siteid'];
			$standardfee['keywordid'] 		= $data['keywordid'];
			$standardfee['keyword'] 		= $keywords;
			$standardfee['price'] 			= $data_kw['price'];
			$standardfee['ownuserid'] 		= $data_kw['createuserid'];
			$standardfee['standarddate'] 	= $date_cur;
			$modelStandardfee -> insert( $standardfee );
			//dump($modelStandardfee -> _sql());
			Log::write("------------------------------ 达标消费记录中增加信息：". $modelStandardfee -> _sql());
				
		}else{
			//$kw['id'] 					= $data['keywordid'];
			$kw['standardstatus'] 		= '未达标';// 达标状态
			//$kw['latestranking'] 		= $rank;// 最新排名
			//$kw['detectiondate'] 		= $date_cur;// 检测时间
			$result = $modelKeyword -> update($kw);
			Log::write($modelKeyword -> _sql());
		}


		$return['ret'] 		= 1;
		$return['message'] 	= '成功';
		exit(json_encode( $return ));
	}

}
?>