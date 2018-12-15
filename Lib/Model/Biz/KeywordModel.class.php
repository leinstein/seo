<?php

/**
 * 模型层：关键词管理模型类
*
* @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
* @package     Model.Biz
* @version     20170419
* @link        http://www.qisobao.com
*/
class KeywordModel extends BaseModel{

	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		$this -> trueTableName= C('DB_PREFIX') . 'keyword';
	}


	/**
	 * 重写父类方法：获取单个申请单信息
	 *
	 * 根据查询条件查询数据库中的单条记录，并返回结果。
	 * 获取一个资金申请单的基本信息：
	 *   1、不包含明细信息；
	 *   2、将大字段进行转换。
	 *
	 * @param array $map 查询条件
	 * @return var 如果查询成功则返回对象信息，如果失败则返回false
	 */
	function selectOne( $map ,$field){

		//调用父类方法获取数据
		$data = parent:: selectOne( $map,$field );

		//将数据的中的大字段格式转化成php数组
		if( $data ){

			// 计算已经达标的天数
			if( $data['standarddate']) {
				//$data['standarddays'] = ( strtotime(date('Y-m-d')) - strtotime(format_date($data['standarddate'])))/ 86400 +1;
			}

			//判断时候能删除
			if( $data['keywordstatus'] == '待审核'){
				$data['isCanEdit'] = 1;
			}
			//计算达标总消费
			if( $data['standarddays'] >= 1 ){
				$data['total_consumption']  = $data['standarddays'] * $data['price'] ;
				$data['latest_consumption']  = $data['price'] ;
					
			}
			$SearchengineOptions = C('SearchengineOptions');
			$data['searchengine_ZH'] = $SearchengineOptions[$data['searchengine']];
			$data['searchengine_zh'] = $SearchengineOptions[$data['searchengine']];
			$data['consumption'] = $data['standarddays'] * $data['price'];
			$data['freezefunds_remain'] = $data['freezefunds'] - $data['consumption'] ;
			if( $data['freezefunds_remain'] < 0 ){
				$data['freezefunds_remain']  = 0;
			}
			// 搜索引擎打开地址
			$SearchengineSiteOptions = C('SearchengineSiteOptions');
			$searchengine_url = $SearchengineSiteOptions[$data['searchengine']];
			// 替换关键词
			$data['searchengine_url'] = str_replace('{keyword}',urlencode($data['keyword']),$searchengine_url);


			$data['latestranking_show'] = $vo['latestranking'] ;
			// 最新排名达标后显示为红色字体
			if( $data['latestranking'] > 0 AND  $vo['latestranking'] <= 10 ){
				$data['latestranking_show'] = '<span style="color:#E04806;font-weight:bold;;">' .$data['latestranking'] . '</span>';
			}
				
		}
		return $data;
	}


	/**
	 * 重写父类方法：根据查询条件查询符合条件的所有记录集合
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志以及最大记录数这几个条件对记录集进行过滤筛选并返回结果。
	 *   1、调用父类方法获取查询结果
	 *   2、将数据中的json格式大字段转换成php数据
	 *   3、其他数据的转换
	 *
	 * @param array $map 查询条件
	 * @param $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param boolean $Relation 表示是否采用关系模型来查询，可选值为:true,false，默认false。当采用关系模型时，会查询和当前模型有关系的数据，并放入到返回结果。
	 * @param int $maxCount 表示全部查询时取的最大记录数，一般情况为避免系统消耗太多性能，默认为10000，注意导出数据时修改此参数；
	 * @return var 查询结果
	 */
	public function queryRecordAll($map, $field = null, $order = null, $relation = false, $maxCount = 10000) {

		$list = parent:: queryRecordAll($map, $field, $order, $relation, $maxCount );
		$SearchengineOptions = C('SearchengineOptions');
		// 搜索引擎打开地址
		$SearchengineSiteOptions = C('SearchengineSiteOptions');
		foreach( $list as $key =>  &$vo ){
			$vo['No'] = $key + 1;
			// 计算已经达标的天数
			if( $vo['standarddate']) {
				//$vo['standarddays'] = ( strtotime(date('Y-m-d')) - strtotime(format_date($vo['standarddate'])))/ 86400 +1;
			}
			//计算达标总消费
			if( $vo['standarddays'] >= 1 ){
				$vo['total_consumption']  = $vo['standarddays'] * $vo['price'] ;
				$vo['latest_consumption']  = $vo['price'] ;
			}

			//查询网站信息
			//if( )

			//判断时候能删除
			if( $vo['keywordstatus'] == '待审核'){
				$vo['isCanEdit'] = 1;
			}

			$vo['searchengine_ZH'] = $SearchengineOptions[$vo['searchengine']];
			$vo['searchengine_zh'] = $SearchengineOptions[$vo['searchengine']];

			$vo['consumption'] = $vo['standarddays'] * $vo['price'];
			$vo['freezefunds_remain'] = $vo['freezefunds'] - $vo['consumption'] ;
			if( $vo['freezefunds_remain'] < 0 ){
				$vo['freezefunds_remain']  = 0;
			}
				
			$searchengine_url = $SearchengineSiteOptions[$vo['searchengine']];
			// 替换关键词
			$vo['searchengine_url'] = str_replace('{keyword}',urlencode($vo['keyword']),$searchengine_url);

			$vo['latestranking_show'] = $vo['latestranking'] ;
			// 最新排名达标后显示为红色字体
			if( $vo['latestranking'] > 0 AND  $vo['latestranking'] <= 10 ){
				$vo['latestranking_show'] = '<span style="color:#E04806;font-weight:bold;;">' .$vo['latestranking'] . '</span>';
			}
		}
		//返回记录集
		return $list;
	}

	/**
	 * 重写父类方法：根据查询条件查询符合条件的所有记录集合，以翻页模式返回数据
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志，每页记录数，翻页参数这几个条件对记录集进行过滤筛选并返回结果。
	 *   1、调用父类方法获取查询结果
	 *   2、将数据中的json格式大字段转换成php数据
	 *   3、其他数据的转换
	 *
	 * @param array $map 查询条件；
	 * @param string $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param array $queryOpts 查询参数配置，目前包括：'Relation', 'NumberPerPage', 'PageParameters'等等；
	 *  Relation　表示是否采用关系模型来查询，可选值为:true,false，默认false;
	 *  NumberPerPage  表示每页记录数，值为整数，默认读取配置文件中的NUM_PER_PAGE;
	 *  PageParameters  表示翻页后的参数，字符串类型默认为空;
	 * 　特别的：如果输入数值，那么直接表示每页个数；如果是真假值，那么表示关系；如果输入文本，那么表示PageParameters；
	 * @return var 查询结果
	 */
	public function queryRecord($map, $fields, $order = null, $queryOpts) {

		$list = parent:: queryRecord($map, $fields, $order, $queryOpts);
		//获取每页显示条数
		$numberPerPage = $queryOpts;//$queryOpts['NumberPerPage'];
		if( !$numberPerPage ) {
			$numberPerPage = $this -> pageNum;;
		}
		$SearchengineOptions = C('SearchengineOptions');
		// 搜索引擎打开地址
		$SearchengineSiteOptions = C('SearchengineSiteOptions');
		foreach( $list['data'] as $key => &$vo ){

			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $numberPerPage;
			$vo['No'] = $No;

			// 计算已经达标的天数
			if( $vo['standarddate']) {
				//$vo['standarddays'] = ( strtotime(date('Y-m-d')) - strtotime(format_date($vo['standarddate'])))/ 86400 +1;
			}
			//计算达标总消费
			if( $vo['standarddays'] >= 1 ){
				$vo['total_consumption']  = $vo['standarddays'] * $vo['price'] ;
				$vo['latest_consumption']  = $vo['price'] ;
					
			}

			//查询网站信息
			//if( )

			//判断时候能删除
			if( $vo['keywordstatus'] == '待审核'){
				$vo['isCanEdit'] = 1;
			}

			$vo['searchengine_ZH'] = $SearchengineOptions[$vo['searchengine']];
			$vo['searchengine_zh'] = $SearchengineOptions[$vo['searchengine']];

			$vo['consumption'] = $vo['standarddays'] * $vo['price'];
			$vo['freezefunds_remain'] = $vo['freezefunds'] - $vo['consumption'] ;
			if( $vo['freezefunds_remain'] < 0 ){
				$vo['freezefunds_remain']  = 0;
			}
				
			$searchengine_url = $SearchengineSiteOptions[$vo['searchengine']];
			// 替换关键词
			$vo['searchengine_url'] = str_replace('{keyword}',urlencode($vo['keyword']),$searchengine_url);

			$vo['latestranking_show'] = $vo['latestranking'] ;
			// 最新排名达标后显示为红色字体
			if( $vo['latestranking'] > 0 AND  $vo['latestranking'] <= 10 ){
				$vo['latestranking_show'] = '<span style="color:#E04806;font-weight:bold;;">' .$vo['latestranking'] . '</span>';
			}

		}
		return $list;
	}


	/**
	 * 根据查询条件查询符合条件的所有记录集合，以翻页模式返回数据
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志，每页记录数，翻页参数这几个条件对记录集进行过滤筛选并返回结果。
	 *
	 * @param array $map 查询条件；
	 * @param string $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param int $num_per_page  表示每页记录数，值为整数，默认读取配置文件中的NUM_PER_PAGE;
	 * @param string $url_param  表示翻页后的参数，字符串类型默认为空; 特别的：如果输入数值，那么直接表示每页个数；如果是真假值，那么表示关系；如果输入文本，那么表示PageParameters；
	 *
	 * @return mixed 查询结果
	 */
	public function queryRecordEx($map, $fields, $order = null,  $url_param = '', $num_per_page = 20) {

		if( !$num_per_page ){
			$num_per_page = $this -> pageNum;
		}
		$list = parent:: queryRecordEx($map, $fields, $order,  $url_param, $num_per_page);
		$SearchengineOptions = C('SearchengineOptions');
		// 搜索引擎打开地址
		$SearchengineSiteOptions = C('SearchengineSiteOptions');
		foreach( $list['data'] as  $key => &$vo ){
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $num_per_page;
			$vo['No'] = $No;
			// 计算已经达标的天数
			if( $vo['standarddate']) {
				//$vo['standarddays'] = ( strtotime(date('Y-m-d')) - strtotime(format_date($vo['standarddate'])))/ 86400 +1;
			}
			//计算达标总消费
			if( $vo['standarddays'] >= 1 ){
				$vo['total_consumption']  = $vo['standarddays'] * $vo['price'] ;
				$vo['latest_consumption']  = $vo['price'] ;

			}

			//查询网站信息
			//if( )

			//判断时候能删除
			if( $vo['keywordstatus'] == '待审核'){
				$vo['isCanEdit'] = 1;
			}

			$vo['searchengine_ZH'] = $SearchengineOptions[$vo['searchengine']];
			$vo['searchengine_zh'] = $SearchengineOptions[$vo['searchengine']];
				
			$vo['consumption'] = $vo['standarddays'] * $vo['price'];
			$vo['freezefunds_remain'] = $vo['freezefunds'] - $vo['consumption'] ;
			if( $vo['freezefunds_remain'] < 0 ){
				$vo['freezefunds_remain']  = 0;
			}
				

			$searchengine_url = $SearchengineSiteOptions[$vo['searchengine']];
			// 替换关键词
			$vo['searchengine_url'] = str_replace('{keyword}',urlencode($vo['keyword']),$searchengine_url);

			$vo['latestranking_show'] = $vo['latestranking'] ;
			// 最新排名达标后显示为红色字体
			if( $vo['latestranking'] > 0 AND  $vo['latestranking'] <= 10 ){
				$vo['latestranking_show'] = '<span style="color:#E04806;font-weight:bold;;">' .$vo['latestranking'] . '</span>';
			}

		}
		return $list;
	}

	/**
	 * 重写父类方法
	 *
	 * 新增
	 * {@inheritDoc}
	 * @see BaseModel::insert()
	 */
	function insert( $postData ){

		//组合其他相关参数
		$data = $postData;
		$data['createtime'] = date('Y-m-d H:i:s');
		$data['createuserid'] = $this -> getLoginUserId();
		$data['createusername'] = $this -> getloginUserName();
		$data['sitestatus'] = '待审核';

		return parent::insert($data);
	}


	/**
	 * 进入关键词详情
	 *
	 * @accesspublic
	 */
	public function detail( $id ){


		$map['id'] = $id;
		$data = $this -> selectOne( $map );

		// 获取站点信息
		$data['site'] = D('Biz/Site') -> selectOne( array('id' => $data['siteid']) );

		// 获取资金池信息
		$data['funds'] = D('Biz/Funds') -> selectOne( array('userid' => $data['createuserid']) );

		return $data;
	}

	/**
	 * 获取子用户关键词效果
	 */
	function getEffectForSub( $map, $fields, $order,  $url_param , $num_per_page, $userid ){
		$model_user = D('User/User');
		$modelFundsfreeze 	= D('Biz/Fundsfreeze');
		if( !$userid ){
			$userid =  $this-> getLoginUserId();
		}
		$map['createuserid'] 	= $userid;
		$map['status'] = 1;
		$map['status'] 			= 1;

		$list = $this -> queryRecordEx($map, $fields, $order,  $url_param, $num_per_page );

		$data['list']  = $list;

		// 站点模型
		$modelSite 	= D('Biz/Site');
		// 资金账户模型
		$modelFunds = D('Biz/Funds');
		// 达标消费模型
		$modelStandardfee = D('Biz/Standardfee');


		// 站点总数
		$site_num = $modelSite -> getSubSitesNum();
		$data['site_num'] =  $site_num;

		//优化关键词数量
		$optimize_num = $this -> getSubOptimizeNum();
		$data['optimize_num'] =  $optimize_num;

		// 达标关键词数量
		$standards_num = $this -> getSubStandardsNum();
		$data['standards_num'] =  $standards_num;

		// 获取资金统计请
		$funs_info = $modelFunds -> getFundsinfoForSubUser();
		$data['funs_info'] =  $funs_info;

		// 获取达标消费
		$date[] = date('Y-m-d');
		$standard_fee = $modelStandardfee -> getFeeForSubUser($userid,$date);
		$data['standard_fee'] =  $standard_fee[0]['consumption'];

		return $data;
	}


	/**
	 * 获取代理商关键词效果
	 */
	function getEffectForAgent( $map, $fields, $order,  $url_param , $num_per_page, $userid ){
		$model_user = D('User/User');
		if( !$userid ){
			$userid =  $this-> getLoginUserId();
		}
		$map_user['pid'] 	= $userid;
		$map_user['status'] 			= 1;
		$users = $model_user -> queryRecordAll( $map_user );

		foreach ($users as $vo_user ){
			$userids[] = $vo_user['id'];
		}
		$userids = array_unique( $userids );
		if( $userids ){

			$list = $this -> getEffect( $map, $fields, $order, $pageparam ,$num_per_page, $userids );

		}

		return $list;
	}


	/**
	 * 获取运维账号关键词效果
	 */
	function getEffectForOperation( $map, $fields, $order,  $url_param , $num_per_page, $userid ){

		$map['status'] 			= 1;

		$list = $this -> queryRecordEx( $map, $fields, $order,  $url_param,$num_per_page );
		$modelFundsfreeze 	= D('Biz/Fundsfreeze');
		//获取该站点的冻结jin'e
		foreach ($list['data'] as &$vo ){
			//$map['unfreezedate'] 	= '';
			$map1['siteid'] 			=  $vo['id'];
			$map1['status'] 			=  1;
			$initfreezefunds= $modelFundsfreeze -> where( $map1 ) -> sum( 'freezefunds');
			// 冻结初始金额
			$vo['initfreezefunds'] = $initfreezefunds;
			$fundsfreeze = $modelFundsfreeze -> queryRecordAll( $map1 );
			$vo['fundsfreeze'] = $fundsfreeze;
			$vo['freezefunds'] = $freezefunds;
		}

		$data['list']  = $list;
		$model_Statistics = D('Biz/Statistics');

		// 获取站点的数量
		$site_num = $model_Statistics -> getSiteNum( $userids );
		$data['site_num'] =  $site_num;
		// 获取优化中关键词总数量
		$purchased_kw_num = $model_Statistics -> getPurchasedKeywordNum( $userids );
		$data['optimize_num'] =  $purchased_kw_num;
		// 获取最新达标关键词数量
		$standard_kw_num = $model_Statistics -> getStandardKeywordNum( $userids );
		$data['standards_num'] =  $standard_kw_num;
		// 获取最新达标关键词消费
		$standardsFee = $model_Statistics -> getTodayFee( $userids );
		$data['standard_fee'] 			= $standardsFee;

		// 获取累计消费
		$consumptionfunds = $model_Statistics -> getAllConsumption( $userids );
		$data['total_consumption'] = $consumptionfunds;

		// 获取用户的资金池统计信息
		$funds_pool = $model_Statistics -> getFundsPool( $userids );
		$data['funs_info'] =  $funds_pool;

		return $data;
	}



	/**
	 * 获取销售经理的站点效果
	 *
	 * 根据销售经理用户的id来获取该经理客户的全部站点的效果监控
	 * 获取自己的客户以及员工的客户
	 *
	 * @param string $userid
	 * @return mixed
	 */
	function getEffectForSaleManager( $map, $fields, $order, $pageparam ,$num_per_page ){
		// 企业模型
		$model_epdir= D('Sys/Epdir');
		// y用户模型
		$model_user = D('User/User');

		$userid =  $this-> getLoginUserId();

		$sellerids[] = $userid;
		// 先获取自己的全部子用户
		$sellers = $model_user -> getChildrenUsers( $userid );
		foreach ($sellers as $vo_seller ){
			$sellerids[] = $vo_seller['id'];
		}

		$sellerids = array_unique( $sellerids );

		if( $sellerids ){
			$map_epdir['seller'] = array('IN',$sellerids);
			$map_epdir['status'] 			= 1;
			$epdirs = $model_epdir -> queryRecordAll( $map_epdir );

			foreach ($epdirs as $vo ){
				$epids[] = $vo['id'];
			}
			$epids = array_unique( $epids );
			if( $epids ){
				$map_user['epid'] = array('IN',$epids);
				$map_user['status'] 			= 1;
				$users = $model_user -> queryRecordAll( $map_user );

				foreach ($users as $vo_user ){
					$userids[] = $vo_user['id'];
				}
				$userids = array_unique( $userids );

				if( $userids ){


					$list = $this -> getEffect( $map, $fields, $order, $pageparam ,$num_per_page,$userids );

				}
			}
		}
		return $list;
	}

	/**
	 * 获取客服经理的站点效果
	 *
	 * 根据客服经理用户的id来获取该客服经理客户的全部站点的效果监控
	 * 获取自己的客户以及员工的客户
	 *
	 * @param string $userid
	 * @return mixed
	 */
	function getEffectForCustomerManager( $map, $fields, $order, $pageparam ,$num_per_page ){
		// 企业模型
		$model_epdir= D('Sys/Epdir');
		// y用户模型
		$model_user = D('User/User');

		if( !$userid ){
			$userid =  $this-> getLoginUserId();
		}

		$sellerids[] = $userid;
		// 先获取自己的全部子用户
		$sellers = $model_user -> getChildrenUsers( $userid );
		foreach ($sellers as $vo_seller ){
			$sellerids[] = $vo_seller['id'];
		}

		$sellerids = array_unique( $sellerids );

		if( $sellerids ){
			$map_epdir['customer'] = array('IN',$sellerids);
			$map_epdir['status'] 			= 1;
			$epdirs = $model_epdir -> queryRecordAll( $map_epdir );

			foreach ($epdirs as $vo ){
				$epids[] = $vo['id'];
			}
			$epids = array_unique( $epids );
			if( $epids ){
				$map_user['epid'] = array('IN',$epids);
				$map_user['status'] 			= 1;
				$users = $model_user -> queryRecordAll( $map_user );

				foreach ($users as $vo_user ){
					$userids[] = $vo_user['id'];
				}
				$userids = array_unique( $userids );

				if( $userids ){

					$list = $this -> getEffect( $map, $fields, $order, $pageparam ,$num_per_page,$userids );

				}
			}
		}
		return $list;
	}



	/**
	 * 获取销售的站点效果
	 *
	 * 根据销售用户的id来获取该销售用户的全部站点的效果监控
	 *
	 * @param string $userid
	 * @return mixed
	 */
	function getEffectForSeller( $map, $fields, $order, $pageparam ,$num_per_page ){
		// 企业模型
		$model_epdir= D('Sys/Epdir');
		// y用户模型
		$model_user = D('User/User');

		if( !$userid ){
			$userid =  $this-> getLoginUserId();
		}

		$map_epdir['seller'] = $userid;
		$map_epdir['status'] = 1;
		$epdirs = $model_epdir -> queryRecordAll( $map_epdir );
			
		foreach ($epdirs as $vo ){
			$epids[] = $vo['id'];
		}

		$epids = array_unique( $epids );
		if( $epids ){
			$map_user['epid'] = array('IN',$epids);
			$map_user['status'] 			= 1;
			$users = $model_user -> queryRecordAll( $map_user );

			foreach ($users as $vo_user ){
				$userids[] = $vo_user['id'];
			}
			$userids = array_unique( $userids );

			if( $userids ){

				$list = $this -> getEffect( $map, $fields, $order, $pageparam ,$num_per_page,$userids );

			}
		}
		return $list;
	}

	/**
	 * 获取客服的站点效果
	 *
	 * 根据销客服用户的id来获取该客服用户的全部站点的效果监控
	 *
	 * @param string $userid
	 * @return mixed
	 */
	function getEffectForCustomer( $map, $fields, $order, $pageparam ,$num_per_page ){
		// 企业模型
		$model_epdir= D('Sys/Epdir');
		// y用户模型
		$model_user = D('User/User');

		if( !$userid ){
			$userid =  $this-> getLoginUserId();
		}

		$map_epdir['customer'] = $userid;
		$map_epdir['status'] = 1;
		$epdirs = $model_epdir -> queryRecordAll( $map_epdir );
			
		foreach ($epdirs as $vo ){
			$epids[] = $vo['id'];
		}

		$epids = array_unique( $epids );
		if( $epids ){
			$map_user['epid'] = array('IN',$epids);
			$map_user['status'] 			= 1;
			$users = $model_user -> queryRecordAll( $map_user );

			foreach ($users as $vo_user ){
				$userids[] = $vo_user['id'];
			}
			$userids = array_unique( $userids );

			if( $userids ){
				$list = $this -> getEffect( $map, $fields, $order, $pageparam ,$num_per_page,$userids );
			}
		}
		return $list;
	}


	/**
	 * 获取运维账号关键词效果
	 */
	function getEffect( $map, $fields, $order,  $url_param , $num_per_page, $userids ){

		if( $userids ){
			if( $userids != 'all'){
				$map['createuserid'] 			= array('IN', $userids);
			}
			$map['status'] 			= 1;
				
			$list = $this -> queryRecordEx( $map, $fields, $order,  $url_param,$num_per_page );
				


			$modelFundsfreeze 	= D('Biz/Fundsfreeze');
			//获取该站点的冻结jin'e
			foreach ($list['data'] as &$vo ){
				//$map['unfreezedate'] 	= '';
				$map1['siteid'] 			=  $vo['id'];
				$map1['status'] 			=  1;
				$initfreezefunds= $modelFundsfreeze -> where( $map1 ) -> sum( 'freezefunds');
				// 冻结初始金额
				$vo['initfreezefunds'] = $initfreezefunds;
				$fundsfreeze = $modelFundsfreeze -> queryRecordAll( $map1 );
				$vo['fundsfreeze'] = $fundsfreeze;
				$vo['freezefunds'] = $freezefunds;
			}
				
			$data['list']  = $list;
				
			$model_Statistics = D('Biz/Statistics');
			// 获取站点的数量
			$site_num = $model_Statistics -> getSiteNum( $userids );
			$data['site_num'] =  $site_num;
			// 获取优化中关键词总数量
			$purchased_kw_num = $model_Statistics -> getPurchasedKeywordNum( $userids );
			$data['optimize_num'] =  $purchased_kw_num;
			// 获取最新达标关键词数量
			$standard_kw_num = $model_Statistics -> getStandardKeywordNum( $userids );
			$data['standards_num'] =  $standard_kw_num;
			// 获取最新达标关键词消费
			$standardsFee = $model_Statistics -> getTodayFee( $userids );
			$data['standard_fee'] 			= $standardsFee;
				
			// 获取累计消费
			$consumptionfunds = $model_Statistics -> getAllConsumption( $userids );
			$data['total_consumption'] = $consumptionfunds;
				
			// 获取用户的资金池统计信息
			$funds_pool = $model_Statistics -> getFundsPool( $userids, 1 );

			$data['funs_info'] =  $funds_pool;
		}



		/* 	// 获取达标消费
		 $date[] = date('Y-m-d');
		 $standard_fee = $modelStandardfee -> getFeeForAllUser($date);
		 $data['standard_fee'] =  $standard_fee[0]['consumption'];
		 */
		return $data;
	}



	/**
	 * 获取我的关键词列表
	 */
	function getKeywords(  ){
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> queryRecordAll($map, $fields);
	}

	/**
	 * 获取我的关键词列表
	 */
	function getKeywordsForSubUser(  ){
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> queryRecordAll($map, $fields);
	}


	/**
	 * 获取代理商的关键词列表
	 */
	function getKeywordsForAgentUser( $userid ){

		$model_user = D('User/User');
		if( !$userid ){
			$userid =  $this-> getLoginUserId();
		}
		$map_user['pid'] 	= $userid;
		$map_user['status'] 			= 1;
		$users = $model_user -> queryRecordAll( $map_user );

		foreach ($users as $vo_user ){
			$userids[] = $vo_user['id'];
		}
		$userids = array_unique( $userids );
		if( $userids ){
			$map['createuserid'] 	= array( 'IN', $userids );
			$map['status'] 			= 1;

			$list = $this -> queryRecordAll($map);
		}

		return $list;
	}

	/**
	 * 获取我的关键词列表：分页
	 */
	function getListByPage(  ){
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> queryRecordEx($map);
	}

	/**
	 * 获取全部已购买关键词数量
	 *
	 */
	function getAllPurchasedNum( ){
		$map['status'] 			= 1;
		$map['keywordstatus'] 	= array ( array('EQ','优化中'), array('EQ','合作停') ,'OR' );
		return $this -> where( $map ) -> count();
	}

	/**
	 * 获取已购买关键词数量
	 *
	 */
	function getPurchasedKeywordNum(  ){
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		$map['keywordstatus'] 	= array ( array('EQ','优化中'), array('EQ','合作停') ,'OR' );
		return $this -> where( $map ) -> count();
	}

	/**
	 * 获取我的站点列表
	 */
	function getMyKeywordNum(  ){

		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}

	/**
	 * 达标关键词数量
	 */
	function getAllStandardsNum(  ){

		$map['standardstatus'] 	= '已达标';
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}

	/**
	 * 达标关键词数量
	 */
	function getStandardsNum(  ){

		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['standardstatus'] 	= '已达标';
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}


	/**
	 * 达标关键词数量
	 */
	function getSubStandardsNum(  ){

		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['standardstatus'] 	= '已达标';
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}


	/**
	 * 获取代理商达标关键词数量
	 */
	function getAgentStandardsNum( $userid ){

		$model_user = D('User/User');
		if( !$userid ){
			$userid =  $this-> getLoginUserId();
		}
		$map_user['pid'] 	= $userid;
		$map_user['status'] 			= 1;
		$users = $model_user -> queryRecordAll( $map_user );

		foreach ($users as $vo_user ){
			$userids[] = $vo_user['id'];
		}
		$userids = array_unique( $userids );
		if( $userids ){
			$map['createuserid'] 	= array( 'IN', $userids );
			$map['standardstatus'] 	= '已达标';
			$map['status'] 			= 1;
			return $this -> where( $map ) -> count();
		}
	}


	/**
	 * 达标关键词扣费
	 */
	function getAllStandardsFee(  ){

		$map['standardstatus'] 	= '已达标';
		$map['keywordstatus'] 	= '优化中';
		$map['status'] 			= 1;
		return $this -> where( $map ) -> sum('price');;
	}

	/**
	 * 达标关键词扣费
	 */
	function getStandardsFee(  ){
		$modelStandardfee 	= D('Biz/Standardfee') ;
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['standardstatus'] 	= '已达标';
		$map['keywordstatus'] 	= '优化中';
		$map['status'] 			= 1;
		return $this -> where( $map ) -> sum('price');;
	}

	/**
	 * 获取关键词达标率
	 */
	function getComplianceRate(  ){

		// 获取全部优化中的关键词
		$map['keywordstatus'] 	= array( array('EQ','优化中'),array('EQ','合作停'),'OR');
		$map['status'] 			= 1;
		$count1 = $this -> where( $map ) -> count();

		// 获取全部优化中的关键词
		$map2['standardstatus'] 	= '已达标';
		$map2['status'] 			= 1;
		$count2 = $this -> where( $map2 ) -> count();

		return round($count2/$count1,2);
	}

	/**
	 * 获取关键词达标率
	 */
	function getAllConsumptionMonth(  ){

		$model = D('Biz/Standardfee') ;

		$consumption = $model -> getAllConsumptionMonth();

		return round($count2/$count1,2);
	}


	/**
	 * 获取优化关键词数量
	 */
	function getAllOptimizeNum(  ){

		$map['keywordstatus'] 	= '优化中';
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}

	/**
	 * 获取优化关键词数量
	 */
	function getOptimizeNum(  ){

		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['keywordstatus'] 	= '优化中';
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}

	/**
	 * 获取优化关键词数量
	 */
	function getSubOptimizeNum(  ){

		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['keywordstatus'] 	= '优化中';
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}


	/**
	 * 获取代理商优化关键词数量
	 */
	function getAgentOptimizeNum( $userid ){

		$model_user = D('User/User');
		if( !$userid ){
			$userid =  $this-> getLoginUserId();
		}
		$map_user['pid'] 	= $userid;
		$map_user['status'] 			= 1;
		$users = $model_user -> queryRecordAll( $map_user );

		foreach ($users as $vo_user ){
			$userids[] = $vo_user['id'];
		}
		$userids = array_unique( $userids );
		if( $userids ){
			$map['createuserid'] 	= array( 'IN', $userids );
			$map['keywordstatus'] 	= '优化中';
			$map['status'] 			= 1;
			return $this -> where( $map ) -> count();
		}
	}




	/**
	 * 根据站点的ID获取已经购买的关键词
	 */
	function getBySiteid( $siteid ){

		$map['siteid'] = $siteid;
		$map['status'] 	= 1;
		return $this -> queryRecordAll($map);
	}

	/**
	 * 获取整个网站10天的消费明细
	 *
	 * 不包含今天的消耗
	 */
	function getAllConsumerdetails(  ){
		for($i=11;$i>0;$i--){
			$days[]=date('Y-m-d',strtotime("-{$i} days"));
		}
		//获取优化中的关键词，以及合作停的关键词
		// $map['_string'] = "(keywordstatus = '优化中' ) OR (keywordstatus = '合作停' AND cooperationstopdate > $days[0] )";
		$map['_string'] = "(standardstatus = '已达标' ) OR (keywordstatus = '合作停' AND cooperationstopdate > $days[0] )";
		$map['status'] 			= 1;

		$list = $this -> queryRecordAll($map);
		foreach ( $days as $vo ){
			$consumption = 0;
			foreach ( $list as $vo_list ){

				if( $vo_list['keywordstatus'] == '优化中'){
					// 开始优化时间
					// $optimizetime = format_date( $vo_list['optimizetime']);

					// 达标时间
					$standarddate = format_date( $vo_list['standarddate']);

					//如果开始优化时间在当前时间之前，说明当前的时间已经开始进行消费
					if( $standarddate <= $vo ){
						$consumption += $vo_list['price'];
					}
				}else if( $vo_list['keywordstatus'] == '合作停'){
					// 开始优化时间
					// $optimizetime = format_date( $vo_list['optimizetime']);
					// 达标时间
					$standarddate = format_date( $vo_list['standarddate']);
					$cooperationstopdate = format_date( $vo_list['cooperationstopdate']);
					//如果开始优化时间在当前时间之前，说明当前的时间已经开始进行消费
					if( $standarddate <= $vo && $vo < $cooperationstopdate){
						$consumption += $vo_list['price'];
					}
				}
				//unset($list[$key]);
			}

			$rs['day'] = $vo;
			$rs['consumption'] = $consumption;
			$rss[] = $rs;
		}

		return $rss;
	}

	/**
	 * 获取我10天的消费明细
	 *
	 * 不包含今天的消耗
	 */
	function getConsumerdetails(  ){
		for($i=11;$i>0;$i--){
			$days[]=date('Y-m-d',strtotime("-{$i} days"));
		}
		//获取优化中的关键词，以及合作停的关键词
		// $map['_string'] = "(keywordstatus = '优化中' ) OR (keywordstatus = '合作停' AND cooperationstopdate > $days[0] )";
		$map['_string'] = "(standardstatus = '已达标' ) OR (keywordstatus = '合作停' AND cooperationstopdate > $days[0] )";

		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;

		$list = $this -> queryRecordAll($map);
		foreach ( $days as $vo ){
			$consumption = 0;
			foreach ( $list as $vo_list ){

				if( $vo_list['keywordstatus'] == '优化中'){
					// 开始优化时间
					// $optimizetime = format_date( $vo_list['optimizetime']);

					// 达标时间
					$standarddate = format_date( $vo_list['standarddate']);

					//如果开始优化时间在当前时间之前，说明当前的时间已经开始进行消费
					if( $standarddate <= $vo ){
						$consumption += $vo_list['price'];
					}
				}else if( $vo_list['keywordstatus'] == '合作停'){
					// 开始优化时间
					// $optimizetime = format_date( $vo_list['optimizetime']);
					// 达标时间
					$standarddate = format_date( $vo_list['standarddate']);
					$cooperationstopdate = format_date( $vo_list['cooperationstopdate']);
					//如果开始优化时间在当前时间之前，说明当前的时间已经开始进行消费
					if( $standarddate <= $vo && $vo < $cooperationstopdate){
						$consumption += $vo_list['price'];
					}
				}
				//unset($list[$key]);
			}

			$rs['day'] = $vo;
			$rs['consumption'] = $consumption;
			$rss[] = $rs;
		}
		return $rss;
	}


	/**
	 * 发送post请求
	 * @param string $url 请求地址
	 * @param array $post_data post键值对数据
	 * @return string
	 */
	function send_post($url, $post_data) {

		//$postdata = http_build_query($post_data);
		dump($post_data);
		$options = array(
				'http' => array(
						'method' => 'POST',
						'header' => 'Content-Type: application/json; charset=utf-8',
						'content' => $post_data,
				)
		);
		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

		return $result;
	}

	/**
	 * 或的url的host
	 * 2013年4月26日20:33:25
	 * 2013年5月9日20:28:05
	 */
	function yundanran_parse_host($url)
	{
		if(!is_string($url) || $url=='')return "";

		$info=parse_url($url);
		$host=isset($info['host'])?$info['host']:"";
		if($host=="")return "";

		if(preg_match("/^192\.168\.\d{1,3}\.\d{1,3}¦127\.\d{1,3}\.\d{1,3}\.\d{1,3}¦255\.\d{1,3}\.\d{1,3}\.\d{1,3}$/",$host))return "";
		if(!preg_match("/\.[a-z]+$/i",$host) && !preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/",$host))return "";
		return $host;
	}

	/**
	 * 搜索关键词
	 *
	 * 通过第三方接口搜索关键词
	 *
	 * @accesspublic
	 */
	public function search( $keyword_arr ){
		$KeywordLengthPriceIndexOptions 		= C('KeywordLengthPriceIndexOptions');
		
		$searchengine_keys = array_keys($KeywordLengthPriceIndexOptions);

		//组成字符
		$keywords 			= implode(',' , $keyword_arr);


		//
		foreach ( $keyword_arr as $key => $vo ){

			// 去掉关键词前后的空额
			//$vo = strtolower(trim($vo));
			$vo = trim($vo);
			$replace = array(" ","　","\n","\r","\t");
			$vo = str_replace($replace, "", $vo);
			$temp['keyword'] = $vo;
			foreach ( $searchengine_keys as $vo2 ){
				$temp[$vo2] = 0;
			}
			$arr[] = $temp;
		}
		
		$list = $this -> combKeywordSearchResults( $arr );

		return $list;
	}
	
	
	
	

	/**
	 * 搜索关键词:根据用户的关键词搜索推荐的关键词
	 *
	 * 通过第三方接口搜索关键词
	 *
	 * @accesspublic
	 */
	public function searchRecommend( $keyword_arr ){

		//G('begin');



		// 长尾词挖掘配置
		$KeywordDigOptions 				= C('KeywordDigOptions');
		// 关键词长度价格指数代码集
		$KeywordLengthPriceIndexOptions = C('KeywordLengthPriceIndexOptions');
		$searchengine_keys = array_keys($KeywordLengthPriceIndexOptions);

		//组成字符
		$keywords 				= implode(',' , $keyword_arr);
		//关键词搜索
		//$url_search = $KeywordDigOptions['url']. urlencode($keywords);
		$url_search = "http://www.baidu.com/s?wd=". urlencode($keywords);;
		//从http://www.5118.com/seo/words/%E4%BA%92%E8%81%94%E7%BD%91%E4%BF%9D%E9%99%A9
		$html = file_get_contents( $url_search );
		
		
		// ...其他代码段
		//G('end');

		// ...也许这里还有其他代码
		// 进行统计区间
		//echo G('begin','end').'s';
		// 根据特殊的字符进行匹配
		/*
		$pattern_all = '/<span class="hoverToHide"><a.*?>(.+?)<\/a><\/span>/is';
		*/
		$pattern_all = '/<th><a href="(?:.*?)">(.*?)<\/a><\/th>/is';
		preg_match_all($pattern_all, $html, $results);
		
		$keyword_arr1 = $results[1];

		//$keyword_arr2 =  array_slice($keyword_arr1,0,20) ;

		if( count($keyword_arr1) > 0 ){


			// 截取和去重获取10个关键词
			foreach ( $keyword_arr1 as $vo ){
				//dump($vo);
				$keyword_arr3[] = str_replace(array('<em>','</em>'), '',$vo);
				//$keyword_temp  = explode(' ',$vo);

			}


			// 数组去重
			$keyword_arr3 = array_unique( $keyword_arr3 );
			// 在最终的数组去掉关键词
			$keyword_arr3 = array_diff( $keyword_arr3,$keyword_arr );
			// 截取前10个元素
			$keyword_arr3 =  array_slice($keyword_arr3,0,10) ;


			foreach ( $keyword_arr3 as $key => $vo ){
				$temp['keyword'] = $vo;
				foreach ( $searchengine_keys as $vo2 ){
					$temp[$vo2] = 0;
				}
				$temp['isrecommend'] = 1;
				$arr[] = $temp;
			}

			$list = $this -> combKeywordSearchResults( $arr );
		}

		return $list;

	}


	/**
	 * 搜索关键词:根据用户的关键词搜索推荐的关键词
	 *
	 * 通过第三方接口搜索关键词:由于第三方的接口一下只能提交10个关键词，需要将关键词进行等分
	 *
	 * @accesspublic
	 */
	public function combKeywordSearchResults( $list ){
		// 关键词长度价格指数代码集
		$KeywordLengthPriceIndexOptions 			= C('KeywordLengthPriceIndexOptions');
		// 百度指数价格指数代码集
		$BaiduIndexPriceIndexOptions 				= C('BaiduIndexPriceIndexOptions');
		// 关键词长度难度指数代码集
		$KeywordDifficultyIndexOptions 				= C('KeywordDifficultyIndexOptions');
		// 关键词长度优化周期代码集
		$KeywordOptimizationCycleOptions 			= C('KeywordOptimizationCycleOptions');
		// 关键词百度指数难度指数代码集
		$KeywordDifficultyIndex4BaiduIndexOptions 	= C('KeywordDifficultyIndex4BaiduIndexOptions');
		// 关键词百度指数化周期代码集
		$KeywordOptimizationCycle4BaiduIndexOptions = C('KeywordOptimizationCycle4BaiduIndexOptions');

		

		// 将关键词组成一个字符串
		/* foreach ( $list as $vo1){
			$keyword_arr[] = $vo1['keyword'];
			} */

		// 将 关键词进行等分
		$list_new = array_chunk($list,10);

		foreach ($list_new as &$vo_list){
			unset($keyword_arr);
			foreach ($vo_list as $vo_temp ){
				$keyword_arr[] = trim($vo_temp['keyword']);
			}
			//将获取的关键词数组组成字符串
			$keywords= implode(',',$keyword_arr);



			// 百度指数查询
			$url_index = 'http://api.91cha.com/index?key=456a38a7a22f41a0ae3829ec1ccb7fc1&kws='.urlencode($keywords);
			//echo file_get_contents("http://www.91cha.com");
			$data_index = json_decode( file_get_contents($url_index), true);
			//$data_index = json_decode( file_get_contents($url_index));

			//$data_index = file_get_contents($url_index);
			
			
			/* $baiduindex_data =0;
			 $baiduindex = 0;
			 $mobileindex = 0;
			 $so360index = 0;
			 if($data_index['state'] == 1 ){
				$baiduindex_data = $data_index['data'];
				$baiduindex = $data_index['data'][0]['allindex'];
				$mobileindex = $data_index['data'][0]['mobileindex'];
				$so360index = $data_index['data'][0]['so360index'];
				} */

			foreach ( $vo_list as $key => &$vo ){
				$baiduindex = 0;
				$mobileindex = 0;
				$so360index = 0;
				if($data_index['state'] == 1 ){
					foreach ($data_index['data'] as $vo_bi){
						if(  $vo['keyword'] == $vo_bi['keyword']){
							$baiduindex 	= $vo_bi['allindex'];
							$mobileindex 	= $vo_bi['mobileindex'];
							$so360index 	= $vo_bi['so360index'];
						}
					}
				}

				// 判断字符的长度
				$len = floor((strlen( $vo['keyword']) + mb_strlen( $vo['keyword'],'UTF8')) / 2);
				/* $baiduindex 	= $baiduindex_data[$key]['allindex'];

				$mobileindex 	= $baiduindex_data[$key]['mobileindex'];
				$so360index 	= $baiduindex_data[$key]['so360index']; */
					
				foreach ($vo as $key_vo => &$vo_vo ){
					$price = 0;
					$price1 = 0;
					$price2 = 0;
					// 关键词长度指数
					$keywordOption 			= $KeywordLengthPriceIndexOptions[$key_vo];

					if( $keywordOption ){
						foreach ($keywordOption as $vo_ko ){
							if( $vo_ko['vmin'] <= $len && $len <=$vo_ko['vmax'] ){
								$price1 = $vo_ko['quotavalue'];
							}
						}
					}

					// 关键词百度指数
					$BaiduIndexPriceIndexOption = $BaiduIndexPriceIndexOptions[$key_vo];
					if( $BaiduIndexPriceIndexOption ){
						foreach ($BaiduIndexPriceIndexOption as $vo_bo ){
							if( $vo_bo['vmin'] <= $baiduindex && $baiduindex <=$vo_bo['vmax'] ){
								$price2 = $vo_bo['quotavalue'];
							}
						}
					}

					$price = $price1 + $price2;

					if( $price ){
						$vo_vo = round($price*0.95,0);
					}
				}


				// 计算难度指数difficulty_index 和 优化周期 optimization_cycle
				// 如果有百度指数，则只通过百度指数来进行计算
				if( $baiduindex ){
					foreach ($KeywordDifficultyIndex4BaiduIndexOptions as $vo_kd ){
						if( $vo_kd['vmin'] <= $baiduindex && $baiduindex <=$vo_kd['vmax'] ){
							$difficulty_index = $vo_kd['quotavalue'];
						}
					}

					foreach ($KeywordOptimizationCycle4BaiduIndexOptions as $vo_ko ){
						if( $vo_ko['vmin'] <= $baiduindex && $baiduindex <=$vo_ko['vmax'] ){
							$optimization_cycle = $vo_ko['quotavalue'];
						}
					}
				}else{
					foreach ($KeywordDifficultyIndexOptions as $vo_kd ){
						if( $vo_kd['vmin'] <= $len && $len <=$vo_kd['vmax'] ){
							$difficulty_index = $vo_kd['quotavalue'];
						}
					}

					foreach ($KeywordOptimizationCycleOptions as $vo_ko ){
						if( $vo_ko['vmin'] <= $len && $len <=$vo_ko['vmax'] ){
							$optimization_cycle = $vo_ko['quotavalue'];
						}
					}
				}
				$vo['difficulty_index'] 	= $difficulty_index;

				// 计算显示的样式
				if($difficulty_index > 0 ){
					$rate = '<span style="color:red;font-size:20px;">';
					for($i =1 ;$i<=$difficulty_index;$i++){
						$rate .='★';
					}
					$rate .= '</span>';
				}

				$rate_diff = 5 - $difficulty_index;
				if($rate_diff > 0 ){
					$rate .= '<span style="font-size:20px;">';
					for($i=1;$i<= $rate_diff;$i++){
						$rate .= '☆';
					}
					$rate .= '</span>';
				}
				$vo['rate'] 	= $rate;

				$vo['optimization_cycle'] 	= $optimization_cycle;
			}
		}
		
		foreach ($list_new as $vo2 ){
			if( !$return ){
				$return = $vo2;
			}else{
				$return = array_merge ( $return,$vo2);
			}
		}
		return $return;
	}




	/**
	 * 搜索关键词
	 *
	 * 通过第三方接口搜索关键词
	 *
	 * @accesspublic
	 */
	public function search1( $keyword_arr ){
		// 长尾词挖掘配置
		$KeywordDigOptions 	= C('KeywordDigOptions');
		$KeywordLengthPriceIndexOptions 		= C('KeywordLengthPriceIndexOptions');
		$BaiduIndexPriceIndexOptions 		= C('BaiduIndexPriceIndexOptions');
		//组成字符
		$keywords 			= implode(',' , $keyword_arr);
		//关键词搜索
		$url_search = $KeywordDigOptions['url']. urlencode($keywords);
		//从http://www.5118.com/seo/words/%E4%BA%92%E8%81%94%E7%BD%91%E4%BF%9D%E9%99%A9
		$html = file_get_contents( $url_search );

		//$pattern = '/<div class="Fn-ui-list dig-list">(.+?)<div>/is';
		//$pattern = '/<dd class="col3-6 center">(.+?)a>/is';
		//$pattern = '/<dd class="col3-6 word">(.+?)<dd class="col3-4 center">/is';

		//	dump($result_search);exit;
		//	preg_match($pattern, $html, $match);
		//$match_arr =  array_slice($match[0],0,10) ;
		//dump($match);exit;

		// 根据特殊的字符进行匹配
		$pattern_all = '/<span class="hoverToHide"><a.*?>(.+?)<\/a><\/span>/is';

		preg_match_all($pattern_all, $html, $results);
		$keyword_arr1 = $results[1];

		$keyword_arr2 =  array_slice($keyword_arr1,0,20) ;

		// 截取和去重获取10个关键词
		foreach ( $keyword_arr2 as $vo ){
			$keyword_temp  = explode(' ',$vo);
			foreach ($keyword_temp as $vo_temp){
				$keyword_arr3[] = str_replace(array('<em>','</em>'), '',$vo_temp);
			}
		}
		$keyword_arr3 = array_unique( $keyword_arr3 );
		if( $keyword_arr3 ){
			$new_arr = array_merge( $keyword_arr,$keyword_arr3);
		}

		// 数组去重
		$new_arr = array_unique( $new_arr );
		// 截取
		$l = 10 + count($keyword_arr);
		$new_arr =  array_slice($new_arr, 0, $l) ;

		$searchengine_keys = array_keys($KeywordLengthPriceIndexOptions);

		foreach ( $new_arr as $key1 => $vo1 ){
			$temp['keyword'] = $vo1;
			foreach ( $searchengine_keys as $vo2 ){
				$temp[$vo2] = 0;
			}
			if( $key1 >= count($keyword_arr)){
				$temp['isrecommend'] = 1;
			}

			$list[] = $temp;
		}
		unset($vo);
		foreach ( $list as $key => &$vo ){

			// 判断字符的长度
			$len = mb_strlen( $vo['keyword'],'utf8');

			//获取百度指数
			// 百度指数查询
			// 			$url_index = 'http://api.91cha.com/index?key=456a38a7a22f41a0ae3829ec1ccb7fc1&kws='.urlencode($vo['keyword']);
			// 			$data_index = json_decode( file_get_contents($url_index), true);

			// 			if($data_index['state'] == 1 ){
			// 				$baiduindex = $data_index['data'][0]['allindex'];
			// 				$mobileindex = $data_index['data'][0]['mobileindex'];
			// 				$so360index = $data_index['data'][0]['so360index'];
			// 			}

			foreach ($vo as $key_vo => &$vo_vo ){
				//dump($key_vo);
				$keywordOption = $KeywordLengthPriceIndexOptions[$key_vo];
				//dump($keywordOption);
				if( $keywordOption ){
					foreach ($keywordOption as $vo_ko ){
						if( $vo_ko['vmin'] <= $len && $len <=$vo_ko['vmax'] ){
							$price1 = $vo_ko['quotavalue'];
						}
					}

					if ( $key_vo =='baidu'){
						foreach ($BaiduIndexPriceIndexOptions as $vo_bo ){
							if( $vo_bo['vmin'] <= $baiduindex && $baiduindex <=$vo_bo['vmax'] ){
								$price2 = $vo_bo['quotavalue'];
							}
						}
						$price = $price1 + $price2;
					}else{
						$price = $price1;
					}
					$vo_vo = $price;
				}
			}
		}
		return $list;

		exit;

	}

	/**
	 * 获取每日流水记录
	 */
	function getDaily(){

		//获取我的全部关键词，并且状态是优化中’合作停的
		$map['keywordstatus'] = array( array('EQ','优化中'), array('EQ','合作停'), 'OR');
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		$list = $this -> queryRecordAll($map);
		foreach ($list as $vo ){
			$diff = (strtotime(date('Y-m-d')) - strtotime(format_date($vo['createtime'])))/86400;
			$data['begindate'] 	= format_date($vo['createtime']);
			$data['diff'] 		= $diff;
			$data['price'] 		= $vo['price'] ;
			$datas[] = $data;
		}
		dump($datas);
		foreach ($datas as $key => $vo ){
			$day =date('Y-m-d',strtotime("-{$vo['diff']} days"));
			unset($days);
			for($i=$vo['diff'];$i>=0;$i--){
				$arr['date']=date('Y-m-d',strtotime("-{$i} days"));
				$arr['price']= $vo['price'];
				$arrs[$key][] = $arr;
			}
		}
		dump($arrs);

	}


	/**
	 * 关键词审核
	 *
	 * 关键词审核通过后预先冻结该关键词30天的费用
	 *
	 * 刚审核的关键词都先冻结30天的费用，有关键词达标（上百度首页）客户90天后才能解冻撤词。关键词都是先扣除冻结30天的费用，30天费用扣完后，从总体冻结资金扣（一般不会全部都达标的，达标的关键词扣满30天从未达标的冻结资金里扣），都扣完了，从客户可用余额扣。
	 * update By Richer 于2017年8月29日17:10:31 审核的时候需要判断该关键词的站点是否审核通过，如果未审核通过提示错误
	 * @param array $postData
	 */
	function review( $postData ){

		$id 		= $postData['id'];
		$conclusion = $postData['keywordstatus'];
		// 获取关键词的信息
		$keyword 	= $this -> selectOne( array('id' => $id ));

		if( $keyword['keywordstatus'] != '待审核' &&  $keyword['keywordstatus'] != '合作停'){
			$this->error ='你暂时不能操作该关键词！';
			return false;
		}

		// 组合关键词信息
		$data['id'] 			= $id;
		$data['reviewdate'] 	= date('Y-m-d H:i:s');
		$data['reviewopinion'] 	= $postData['reviewopinion'];
		$data['reviewuserid'] 	= $this -> getLoginUserId();
		$data['reviewusername'] = $this -> getloginUserName();
		$data['keywordstatus'] 	= $conclusion;

		// 如果审核的状态是优化中
		if( $conclusion == '优化中'){
				
			// update By Richer 于2017年8月29日17:10:31 审核的时候需要判断该关键词的站点是否审核通过，如果未审核通过提示错误
			$site = D('Biz/Site') -> selectOne(array('id' => $keyword['siteid']));
			if( $site['sitestatus'] != '优化中'){
				$this->error ='该关键词站点未审核！';
				return false;
			}
				
			// 如果老的关键词数据不是合作停，需要冻结相关资金
			if( $keyword['keywordstatus'] != '合作停'){
				// add By Richer 于2017年8月15日20:18:50 对于一些特殊的客户，只需要冻结10天的资金
				// TODO 暂行先写死为代理商用户的id
				$user_info = D('User/User') -> field('pid') -> where( array('id' => $keyword['createuserid'])) -> find();
				if( $user_info['pid'] == 187){
					$days = 10;
				}else{
					$days = 30;
				}
					
				$createuserid 	= $keyword['createuserid'];
				$siteid 		= $keyword['siteid'];
				$price 			= $keyword['price']* $days;
				$data['freezefunds'] = $price;

				//  资金余额是否大于冻结的金额
				$modelFunds 		= D('Biz/Funds');
				//获取我的账户信息
				$funsinfo = $modelFunds -> getFunsinfo( $createuserid ,1 );
				// 可用余额
				$availablefunds = $funsinfo ['availablefunds'];
				/* dump($availablefunds);
				 dump($price);
				 dump($funsinfo);exit; */
				if( $availablefunds < $price ){
					$this -> error ='用户资金余额不足';
					return false;
				}
			}
		}

		switch ($conclusion) {
			case '优化中':

				break;
					
			default:
				;
				break;
		}


		if($data ){
			$result =	$this -> update( $data );
		}

		// 如果操作成功
		if ($result) {
			// 判断当前的状态
			switch ( $conclusion ) {
				case '优化中':
					// 如果审核的状态为优化中，则需要将该关键词通过接口提交的第三方
					// 关键词检测模型
					$model_detect 	= D('Biz/Keyworddetect');
					

				 	$detect["id"] 				= $keyword['id'];;
				    $detect["keywordstatus"] 	= $keyword['keywordstatus'];;
				    $detect["keyword"] 			= $keyword['keyword'];;
				    $detect["searchengine"] 	= $keyword['searchengine'];;
				    $detect["website"] 			= $keyword['website'];;
				    $detect["createuserid"] 	= $keyword['createuserid'];;
				    $detect["is_detect"] 		= $keyword['is_detect'];;
				    $detect["detect_token"] 	= $keyword['detect_token'];;
				    $detects[] = $detect;
					//$result_detect 	= $model_detect -> add_task( $id,$keyword['keyword'],$keyword['website'],$keyword['searchengine'],$keyword['createuserid'],$keyword['detect_token'] );

					$result_detect 	= $model_detect -> detect_all( $detects );
					// 如果提交接口失败
					if( !$result_detect ){
						// 推送失败需要回滚
						$data_rollback['reviewdate'] 		= $keyword['reviewdate'];;
						$data_rollback['reviewopinion'] 	= $keyword['reviewopinion'];
						$data_rollback['reviewuserid'] 		= $keyword['reviewuserid'];
						$data_rollback['reviewusername'] 	= $keyword['reviewusername'];
						$data_rollback['keywordstatus'] 	= $keyword['keywordstatus'];
						$data_rollback['freezefunds'] 		= $keyword['freezefunds'];

						$this -> where( array('id' => $id)) -> save( $data_rollback );
						$this -> error = $model_detect -> getError();
						return false;
					}
						
					if( $keyword['keywordstatus'] != '合作停'){
						$modelFundsfreeze 	= D('Biz/Fundsfreeze');
						//更新资金的金额
						//获取我的账户信息
						if( !$funsinfo ){
							$funsinfo = $modelFunds -> getFunsinfo( $createuserid,1);
						}
						//冻结账户资金
						$modelFunds -> freezeFunds( $funsinfo, $price);
							
						//冻结明细表中增加记录
						$freeze['fundsid'] 		= $funsinfo['id'] ;
						$freeze['siteid'] 		= $siteid ;
						$freeze['keywordid'] 	= $id ;
						$freeze['freezefunds'] 	= $price;

						$modelFundsfreeze -> addRecord( $freeze );
					}
						
					// add by Richer 于2017年5月15日 21:08:10
					// 审核完成后推送接口，获取该关键词的初始排名
					//$keywords[] = $keyword;
					// $this-> detect( $keywords ) ;
					break;
				case '合作停':// 合作停的状态需要解冻剩余的资金
						
						
					break;
				default:
					;
					break;
			}

			// 审核完成后写入操作日志
			$postData['conclusion'] =  $conclusion;
			$model_operation_log = D('Biz/OperationLog');
			$model_operation_log -> addLog( 'keyword',MODULE_NAME,'审核关键词',$postData );
		}

		return $result;
	}


	/**
	 * 关键词审核
	 *
	 * 关键词审核通过后预先冻结该关键词30天的费用
	 *
	 * 刚审核的关键词都先冻结30天的费用，有关键词达标（上百度首页）客户90天后才能解冻撤词。关键词都是先扣除冻结30天的费用，30天费用扣完后，从总体冻结资金扣（一般不会全部都达标的，达标的关键词扣满30天从未达标的冻结资金里扣），都扣完了，从客户可用余额扣。
	 * @param unknown $postData
	 */
	function reviewBatch( $postData ){
		// 资金池模型
		$modelFunds 		= D('Biz/Funds');
		// 资金池冻结模型
		$modelFundsfreeze 	= D('Biz/Fundsfreeze');
		// 用户模型
		$model_user			= D('User/User');
		// 站点模型
		$model_site			= D('Biz/Site');
		// 关键词检测模型
		$model_detect 		= D('Biz/Keyworddetect');


		// 获取选中的ID
		$ids 		= $postData['id'];
		$conclusion = $postData['keywordstatus'];



		foreach ($ids as $vo ){
			$data['id'] 			= $vo;
			$data['reviewdate'] 	= date('Y-m-d H:i:s');
			$data['reviewopinion'] 	= $postData['reviewopinion'];
			$data['reviewuserid'] 	= $this -> getLoginUserId();
			$data['reviewusername'] = $this -> getloginUserName();
			$data['keywordstatus'] 	= $conclusion;

			// 设置参数，判断当前是否可以进行审核，主要是为了判断在审核通过的时候，预付冻结金额不足的情况
			$is_can_review = true;
			$is_review  = false;
				
			// 审核通过之前需要进行资金的冻结
			// 审核通过之前需要进行资金的冻结 update By Richer 于2017年6月18日 14:28:10 对于合作停的也能审核成优化中，但是不需要冻结资金
			if( $conclusion == '优化中'){
				$keyword 		= $this  -> selectOne( array('id' =>  $vo ));
					
				if( $keyword['keywordstatus'] != '合作停'){
						
					// update By Richer 于2017年8月29日17:10:31 审核的时候需要判断该关键词的站点是否审核通过，如果未审核通过提示错误
					$site = $model_site -> selectOne(array('id' => $keyword['siteid']));
					if( $site['sitestatus'] != '优化中'){
						$fail[] = $vo;
						$is_can_review = false;
						$this->error ='该关键词站点未审核！';
					}else{
						// add By Richer 于2017年8月15日20:18:50 对于一些特殊的客户，只需要冻结10天的资金
						// TODO 暂行先写死为代理商用户的id
						$user_info = $model_user -> field('pid') -> where( array('id' => $keyword['createuserid'])) -> find();
						if( $user_info['pid'] == 187){
							$days = 10;
						}else{
							$days = 30;
						}
							
						$createuserid 	= $keyword['createuserid'];
						$siteid 		= $keyword['siteid'];
						$price 			= $keyword['price']* $days;
						$data['freezefunds'] = $price;

						//  资金余额是否大于冻结的金额
						//获取该用户的账户信息
						$funsinfo = $modelFunds -> getFunsinfo( $createuserid ,1);
						$availablefunds = $funsinfo ['availablefunds'];

						// 判断可用余额是否大于冻结金额
						if( $availablefunds < $price ){
							$fail[] = $vo;
							$is_can_review = false;
							$this -> error ='用户资金余额不足';
						}else{
							//$success[] = $vo;

						}
					}
				}else{
					//$success[] = $vo;
						
				}
					
					
			}else{
				// 如果不是审核通过
				$success[] = $vo;
			}


			// 如果可以审核关键词
			if( $is_can_review ){
				// 修改关键词的信息
				$result =	$this -> update( $data );
				// 如果操作成功
				if ($result) {
					// 如果审核状态是优化中
					if( $conclusion == '优化中'){
						//$result_detect 	= $model_detect -> add_task( $vo,$keyword['keyword'],$keyword['website'],$keyword['searchengine'] ,$keyword['createuserid'],$keyword['detect_token']);
						$detect["id"] 				= $keyword['id'];;
					    $detect["keywordstatus"] 	= $keyword['keywordstatus'];;
					    $detect["keyword"] 			= $keyword['keyword'];;
					    $detect["searchengine"] 	= $keyword['searchengine'];;
					    $detect["website"] 			= $keyword['website'];;
					    $detect["createuserid"] 	= $keyword['createuserid'];;
					    $detect["is_detect"] 		= $keyword['is_detect'];;
					    $detect["detect_token"] 	= $keyword['detect_token'];;
					    $detects[0] = $detect;
						$result_detect 	= $model_detect -> detect_all( $detects );

						// 如果提交接口失败
						if( !$result_detect ){
							// 推送失败需要回滚
							$data_rollback['reviewdate'] 		= $keyword['reviewdate'];;
							$data_rollback['reviewopinion'] 	= $keyword['reviewopinion'];
							$data_rollback['reviewuserid'] 		= $keyword['reviewuserid'];
							$data_rollback['reviewusername'] 	= $keyword['reviewusername'];
							$data_rollback['keywordstatus'] 	= $keyword['keywordstatus'];
							$data_rollback['freezefunds'] 		= $keyword['freezefunds'];

							$this -> where( array('id' => $vo)) -> save( $data_rollback );
							$this -> error = $model_detect -> getError();
							$fail[] = $vo;
						}else{
							//更新资金的金额
							if( $keyword['keywordstatus'] != '合作停'){
								//冻结账户资金
								$modelFunds -> freezeFunds( $funsinfo, $price);

								//冻结明细表中增加记录
								$freeze['fundsid'] 		= $funsinfo['id'] ;
								$freeze['siteid'] 		= $siteid ;
								$freeze['keywordid'] 	= $vo ;
								$freeze['freezefunds'] 	= $price;

								$modelFundsfreeze -> addRecord( $freeze );
							}
							$is_review = true;
							$success[] = $vo;
						}

						
					}else{
						$is_review = true;
						$success[] = $vo;
					}


					if( $is_review ){
						// 审核完成后写入操作日志
						$postData['conclusion'] =  $conclusion;
						$model_operation_log = D('Biz/OperationLog');
						$log['id'] 				= $vo;
						$log['conclusion'] 		= $conclusion;
						$log['reviewopinion'] 	= $postData['reviewopinion'];
						$model_operation_log -> addLog( 'keyword',MODULE_NAME,'审核关键词',$log );
					}
					
				}
			}
		}

		$return['fail'] 	= $fail;
		$return['success'] 	= $success;

		return $return;
	}



	/**
	 * 关键词解冻
	 *
	 * 关键词解冻后将剩余冻结的金额进行解冻
	 *
	 * 刚审核的关键词都先冻结30天的费用，有关键词达标（上百度首页）客户90天后才能解冻撤词。关键词都是先扣除冻结30天的费用，30天费用扣完后，从总体冻结资金扣（一般不会全部都达标的，达标的关键词扣满30天从未达标的冻结资金里扣），都扣完了，从客户可用余额扣。
	 * @param unknown $postData
	 */
	function unfreeze( $postData ){

		$id 		= $postData['id'];
		$conclusion = $postData['keywordstatus'];
		$old_data = $this -> selectOne( array('id' => $id ) );
		$createuserid 	= $old_data['createuserid'];
		$siteid 		= $old_data['siteid'];
		$price 			= $old_data['freezefunds_remain'];
		//d

		if( $old_data['keywordstatus'] != '优化中' && $old_data['keywordstatus'] != '被拒绝'){
			$this -> error ='您暂时不能操作该关键词！';
			return false;
		}

		$data['id'] 			= $id;
		
		if( $conclusion == '待审核'){
			$data['latestranking'] 	= 0;
			$data['standardstatus'] = '未达标';
		}
		/* $data['standardstatus'] = '未达标';
		$data['latestranking'] 	= 0; */
		$data['reviewopinion'] 	= $postData['reviewopinion'];
		$data['keywordstatus'] 	= $conclusion;
		$data['unfreezetime'] 	= date('Y-m-d H:i:s');
		$data['freezefunds'] 	= 0;

		$result =	$this -> update( $data );

		if ($result) {
			if( $old_data['keywordstatus'] == '优化中' ){

				// add By Richer 于2017年9月7日18:20:29 有优化中到其他状态需要推送接口，删除该关键词的检测任务
// 				$model_detect = D('Biz/Keyworddetect');
// 				$result_detect = $model_detect -> delete_task( $id );
// 				if( !$result_detect ){
// 					// 推送失败需要回滚
// 					$data_rollback['standardstatus'] 	= $old_data['standardstatus'];
// 					$data_rollback['latestranking'] 	= $old_data['latestranking'];
// 					$data_rollback['reviewopinion'] 	= $old_data['reviewopinion'];
// 					$data_rollback['keywordstatus'] 	= $old_data['keywordstatus'];
// 					$data_rollback['unfreezetime'] 		= null;
// 					$data_rollback['freezefunds'] 		= $old_data['freezefunds'];
// 					$this -> where( array('id' => $id)) -> save( $data_rollback );
// 					$this -> error = $model_detect -> getError();
// 					return false;
// 				}

				$modelFunds 		= D('Biz/Funds');
				$modelFundsfreeze 	= D('Biz/Fundsfreeze');

				//更新资金的金额
				$funsinfo = $modelFunds -> getFunsinfo( $createuserid,1 );
				//解冻账户资金
				$modelFunds -> unfreezeFunds( $funsinfo, $price);

				//冻结明细表中增加记录
				$map_freeze['fundsid'] 		= $funsinfo['id'] ;
				$map_freeze['keywordid'] 	= $old_data['id'] ;
				$data_freeze['status'] 		= 0;
				$modelFundsfreeze -> where( $map_freeze ) -> save( $data_freeze );

			}
			// 审核完成后写入操作日志
			$postData['conclusion'] =  $conclusion;
			$model_operation_log = D('Biz/OperationLog');
			$model_operation_log -> addLog( 'keyword',MODULE_NAME,'解冻关键词',$postData );
		}

		return $result;
	}


	/**
	 * 关键词审核
	 *
	 * 关键词审核通过后预先冻结该关键词30天的费用
	 *
	 * 刚审核的关键词都先冻结30天的费用，有关键词达标（上百度首页）客户90天后才能解冻撤词。关键词都是先扣除冻结30天的费用，30天费用扣完后，从总体冻结资金扣（一般不会全部都达标的，达标的关键词扣满30天从未达标的冻结资金里扣），都扣完了，从客户可用余额扣。
	 * @param unknown $postData
	 */
	function unfreezeBatch( $postData ){
		// 资金模型
		$modelFunds 		= D('Biz/Funds');
		// 资金冻结模型
		$modelFundsfreeze 	= D('Biz/Fundsfreeze');
		// 关键词检测模型
		$model_detect 		= D('Biz/Keyworddetect');

		// 获取选中的ID
		$ids 		= $postData['id'];
		$conclusion = $postData['keywordstatus'];

		// 循环关键词id数组
		foreach ($ids as $vo ){
				
			// 获取历史数据
			$old_data = $this -> selectOne( array('id' => $vo ) );
				
			$createuserid 	= $old_data['createuserid'];
			$siteid 		= $old_data['siteid'];
			$price 			= $old_data['freezefunds_remain'];
			//d
				
			// 判断关键词的原始状态
			if( $old_data['keywordstatus'] != '优化中' && $old_data['keywordstatus'] != '被拒绝'){
				// 如果原始状态不为优化中
				$fail[] = $vo;
			}else{
				// 如果当前的原始数据状态是优化中，需要进行回滚
				if( $old_data['keywordstatus'] == '优化中'){
					// 将全部的数据保存到数组中，为了方便回滚
					$old_datas[] = $old_data;
				}
				// 组合关键词信息
				$data['id'] 			= $vo;
				$data['keywordstatus'] 	= $conclusion;
				$data['unfreezetime'] 	= date('Y-m-d H:i:s');
				$data['freezefunds'] 	= 0;
				if( $conclusion == '待审核'){
					$data['latestranking'] 	= 0;
					$data['standardstatus'] = '未达标';
				}
				// 更新数据
				$result =	$this -> update( $data );
				// 如果操作失败
				if( !$result ){
					$fail[] = $vo;
				}

				// 如果老的数据是优化中，那么解冻的时候涉及到冻结金额，而且需要推送接口删除该关键词的任务
				if( $old_data['keywordstatus'] == '优化中' ){
						
					// add By Richer 于2017年9月7日18:20:29 有优化中到其他状态需要推送接口，删除该关键词的检测任务
// 					$result_detect = $model_detect -> delete_task( $vo );
// 					if( !$result_detect ){
// 						// 推送失败需要回滚
// 						$data_rollback['standardstatus'] 	= $old_data['standardstatus'];
// 						$data_rollback['latestranking'] 	= $old_data['latestranking'];
// 						$data_rollback['reviewopinion'] 	= $old_data['reviewopinion'];
// 						$data_rollback['keywordstatus'] 	= $old_data['keywordstatus'];
// 						$data_rollback['unfreezetime'] 		= null;
// 						$data_rollback['freezefunds'] 		= $old_data['freezefunds'];
// 						$this -> where( array('id' => $vo)) -> save( $data_rollback );
// 						$this -> error = $model_detect -> getError();
// 						$fail[] = $vo;
// 					}else{
						//更新资金的金额
						$funsinfo = $modelFunds -> getFunsinfo( $createuserid,1 );
						// dump($funsinfo);
						//冻结账户资金
						$modelFunds -> unfreezeFunds( $funsinfo, $price);
						//dump( $modelFunds -> _sql());
						// 更新冻结明细表中记录
						$map_freeze['fundsid'] 		= $funsinfo['id'] ;
						$map_freeze['keywordid'] 	= $old_data['id'] ; ;
						$data_freeze['status'] 		= 0;
						$modelFundsfreeze -> where( $map_freeze ) -> save( $data_freeze );
						//dump( $modelFundsfreeze -> _sql());
						$success[] = $vo;
				//	}

				}else{
					$success[] = $vo;
				}
					
				// 审核完成后写入操作日志
				$postData['conclusion'] =  $conclusion;
				$model_operation_log = D('Biz/OperationLog');
				$model_operation_log -> addLog( 'keyword',MODULE_NAME,'解冻关键词',$postData );

			}
				
			//dump($data);
				
			//dump( $this -> _sql());
				
		}
		//dump($fail);dump($success);
		$return['fail'] 	= $fail;
		$return['success'] 	= $success;

		return $return;
	}



	/**
	 * 获取站点的每日记录
	 *
	 * @param int $siteid
	 * @param string $begindate
	 * @param string $enddate
	 * @return unknown
	 */
	function getHistory ( $keywordid, $datestr, $usertype ){

		$model_detect 	= D('Biz/Keyworddetectrecord');

		//获取该关键词的开始购买时间
		$kw = $this -> selectOne( array('id' => $keywordid ));
		$reviewdate = format_date($kw['reviewdate']);
		$createtime = format_date($kw['createtime']);
		
		// 获取检测时间范围
		$detecttime_arr = explode(' ~ ',$datestr);
		// 开始时间
		$begindate  = $detecttime_arr[0] ;
		
		if( !$begindate || $begindate <  $createtime ){
			$begindate = $createtime;
		}
		// 结束时间
		$enddate  	= date("Y-m-d",strtotime("$detecttime_arr[1]   +1   day"));
		if( !$enddate ){
			$enddate = date("Y-m-d",strtotime("+1 day"));
		}
		
		$map['createtime'] 	= array( array ('LT', $enddate ),array ('EGT',$begindate ),'AND');
		$map['keywordid'] 	= $keywordid;
		$map['status'] 		= 1;
		$list = $model_detect -> queryRecordEx( $map,null,'regtime desc');

		//dump($model_detect ->  _sql());
		//dump($list);
		return $list;
		

	}

	/**
	 * 关键词指定排名
	 *
	 * 对于有异议的排名，运维人员可以手动改变排名
	 * 1、如果将排名改为10以后，那么需要将该关键词的达标日（standarddays）减一，同时将资金冻结资金（freezefunds）和资金余额（balancefunds）增加该关键词的单价
	 * 2、将该关键词当天的代表消费记录删除
	 * 3、如果修改的是今天的排名，同时需要将该关键词的达标状态（standardstatus）修改为“未达标”
	 *
	 *
	 * @param int $standardfeeid 关键词达标扣费ID
	 * @param int $rank 关键词设定的排名
	 * @param int $original_rank 原有排名
	 * @param string $date 操作的天数
	 * @return unknown
	 */
	function setRank ( $standardfeeid, $rank, $original_rank,$date ){

		// 关键词达标扣费模型
		$modelStandardfee 			= D('Biz/Standardfee');
		// 资金账户模型
		$modelFunds 				= D('Biz/Funds');
		// 资金账户冻结模型
		$modelFundsfreeze 			= D('Biz/Fundsfreeze');
		// 资金账户冻结模型
		$model_detectrecord 		= D('Biz/Keyworddetectrecord');

		$map_detectrecord['id']	= $standardfeeid;
		$detectrecord = $model_detectrecord -> selectOne($map_detectrecord);

		$keywordid = $detectrecord['keywordid'];

		$map['id']	= $keywordid;
		$data = $this -> selectOne($map);

		// 首次达标时间
		$firststandarddate  = $data['firststandarddate'];
		$date_cur = date('Y-m-d H:i:s');
		// 获取资金账户信息
		$data_funds  	= $modelFunds -> selectOne( array('userid' => $data['createuserid'] ));

		// 判断原有排名是否是已经达标的
		if( $original_rank <= 10 && $original_rank > 0 ){
			// 如果原有排名是否是已经达标的

			// 如果只是修改排名，而且都是达标的状态，那么主需要更新关键的排名即可
			if( $rank <= 10 && $rank > 0 ){
				$keyword['latestranking']	= $rank;
				$this -> where( $map ) -> save( $keyword );
			}else{
				// 如果只是修改排名，而且是将达标的状态修改为未达标，
				// 那么需要更新关键的排名，关键词的达标状态、
				// 如果修改的达标时间是今天
				if( $date == date('Y-m-d')){
					$keyword['latestranking']	= $rank;
					$keyword['standardstatus']	= '未达标';
				}
				// 为了保证数据的准确性，判断达标天数是否有，如果有才进行数据的操作
				if( $data['standarddays'] > 0 ){
					$keyword['standarddays']	= $data['standarddays'] - 1;
					$keyword['totalconsumption']= $data['totalconsumption'] - $data['price'];
                    $keyword['latestconsumption'] = 0 ;
					// 如果值达标了一天，而且将达标改为未达标，那么需要将首次达标日期，
					if( $data['standarddays'] == 1 ){
						$keyword['firststandarddate'] = null ;//$firststandarddate
						$keyword['unfreezedate'] = null ;
						$keyword['latestconsumption'] = 0 ;
					}
				}else{
					$keyword['standarddays']	= 0;
					$keyword['totalconsumption']= 0;
				}


				$this -> where( $map ) -> save( $keyword );
				//dump($this -> _sql());
				// 为了保证数据的准确性，判断达标天数是否有，如果有才进行数据的操作
				if( $data['standarddays'] > 0 ){
					// 如果冻结资金大于 0
					if( $data_funds['freezefunds'] > 0){
						$funds['freezefunds'] 	= $data_funds['freezefunds'] + $data['price'];// 冻结资金
						$funds['balancefunds']	= $data_funds['balancefunds'] + $data['price'];// 资金余额
					}else{
						$funds['balancefunds']	= $data_funds['balancefunds'] + $data['price'];// 资金余额
						$funds['availablefunds']= $funds['balancefunds'];
					}

					$modelFunds -> where( array('id' => $data_funds['id'] )) -> save( $funds );
					Log::write("------------------------------ 更新资金池信息：". $modelFunds -> _sql());
				}
				//dump($modelFunds -> _sql());

				$map_standardfee['keywordid'] 	= $keywordid;
				$map_standardfee['createtime'] 	= array( 'LIKE', $date .'%');
				$standardfee['status'] 			= 0;
				$modelStandardfee -> where( $map_standardfee ) -> save( $standardfee );
				//dump($modelStandardfee -> _sql());
			}
		}else{
			// 如果原有排名未达标
			// 如果只是修改排名，而且都是未达标的状态，那么主需要更新关键的排名即可
			if( $rank > 10 || $rank <= 0 ){
				$keyword['latestranking']	= $rank;
				$this -> where( $map ) -> save( $keyword );
			}else{
				// 如果只是修改排名，而且是将达标的状态修改为达标，
				// 那么需要更新关键的排名，关键词的达标状态、
				// 如果修改的达标时间是今天
				if( $date == date('Y-m-d')){
					$keyword['latestranking']	= $rank;
					$keyword['standardstatus']	= '已达标';
				}
				$keyword['standarddays']		= $data['standarddays'] + 1;
				$keyword['totalconsumption']	= $data['totalconsumption'] + $data['price'];
				$keyword['latestconsumption'] 	= $data['price'] ;
				// 如果未达标，而且将达标改为未达标，那么需要将首次达标日期，
				if( !$data['standarddays']  ){
					$keyword['firststandarddate'] = $date_cur ;//$firststandarddate
					$keyword['unfreezedate'] = date("Y-m-d H:i:s",strtotime("+90 day")); ;
                    $keyword['latestconsumption'] 	= 0;
				}

				$this -> where( $map ) -> save( $keyword );
				//dump($this -> _sql());
					
				// 更新资金账户信息
				$freezefunds = $data_funds['freezefunds'] - $data['price'];// 冻结资金
				$balancefunds= $data_funds['balancefunds'] - $data['price'];// 资金余额
				// 如果冻结资金小于0
				if( $freezefunds < 0 ){
					$freezefunds = 0;
					$funds['availablefunds']	= $balancefunds;
				}
				$funds['freezefunds'] 		= $freezefunds;
				$funds['balancefunds'] 		= $balancefunds;

				$modelFunds -> where( array('id' => $data_funds['id'] )) -> save( $funds );
				Log::write("------------------------------ 更新资金池信息：". $modelFunds -> _sql());
				//dump($modelFunds -> _sql());
					
				// 判断原来是否有消耗
				$map_standardfee['keywordid'] 	= $keywordid;
				$map_standardfee['createtime'] 	= array( 'LIKE', $date .'%');
				$standardfee_old = $modelStandardfee -> selectOne( $map_standardfee );
				// 如果
				if( $standardfee_old ){
					// 如果状态为0 。那么只需要修改状态
					if( $standardfee_old['status'] == 0){
						$standardfee['status'] 			= 1;
						$modelStandardfee -> where( $map_standardfee ) -> save( $standardfee );
					}
				}else{
					$standardfee['siteid'] 			= $data['siteid'];
					$standardfee['keywordid'] 		= $keywordid;
					$standardfee['keyword'] 		= $data['keyword'];
					$standardfee['price'] 			= $data['price'];
					$standardfee['ownuserid'] 		= $data['createuserid'];
					$standardfee['standarddate'] 	= $date;
					$modelStandardfee -> insert( $standardfee );
				}
				//dump($modelStandardfee -> _sql());

			}
		}
		$record['rank'] = $rank;
		// 更新检测记录
		$model_detectrecord -> where($map_detectrecord) -> save( $record );
		//dump($model_detectrecord -> _sql());

		return true;

	}


	/**
	 * 关键词指定排名
	 *
	 * 对于有异议的排名，运维人员可以手动改变排名
	 * 1、如果将排名改为10以后，那么需要将该关键词的达标日（standarddays）减一，同时将资金冻结资金（freezefunds）和资金余额（balancefunds）增加该关键词的单价
	 * 2、将该关键词当天的代表消费记录删除
	 * 3、如果修改的是今天的排名，同时需要将该关键词的达标状态（standardstatus）修改为“未达标”
	 *
	 *
	 * @param int $standardfeeid 关键词达标扣费ID
	 * @param int $rank 关键词设定的排名
	 * @param int $original_rank 原有排名
	 * @param string $date 操作的天数
	 * @return unknown
	 */
	function setInitRank ( $id, $rank ){

		$map['id'] = $id;
		$data['initialranking'] = $rank;

		return $this -> where($map) -> save( $data );

	}




	/**
	 * 检测关键词
	 *
	 * 检测所有正在优化中的关键词：
	 * 1、检测全部正在优化，无论是否达标都需要对该关键词进行检测，只有当前的最新排名在第一页，才会进行达标扣费
	 * 2、如果排名在第一页，修改该关键词的状态为已达标，并且判断是否是第一次达标，如果是第一次达标，就将该关键词进行绑定，并且90天内不能解冻
	 *
	 */
	function detect( $list ){
		header("Content-type: text/html; charset=utf-8");
		// 关键词检测记录
		$modelKeyworddetectrecord 	= D('Biz/Keyworddetectrecord');

		// 关键词查询 具体标准是：1或者参数为空：百度PC;2：百度移动；3：360PC;4:搜狗；5:神马搜索；)
		$url_post 	= 'https://api.zzmofang.com/v1/coop/recieve_words';
		$host 		= $this -> yundanran_parse_host( $url_post );


		// 1.=========================== 从系统中获取全部正在优化还未达标的关键词 ===========================
		if( !$list ){
			// $map['standardstatus'] 	= array('NEQ', '已达标');
			$map['keywordstatus'] 	= '优化中';
			$map['status'] 			= 1;
			//$list = $this -> queryRecordAll( $map,'id,keyword,searchengine,website,createuserid' );
			//dump($list);
			$sql ='SELECT ts_keyword.id,keywordstatus,ts_keyword.keyword,ts_keyword.searchengine,ts_keyword.website,ts_keyword.createuserid,is_detect,detect_token FROM ts_keyword LEFT JOIN ts_keyworddetectrecord ON ts_keyworddetectrecord.keywordid = ts_keyword.id  AND ts_keyword.status=1 AND ts_keyworddetectrecord.status=1 AND ts_keyworddetectrecord.createtime LIKE "'.date('Y-m-d').'%" WHERE ts_keyword.keywordstatus="优化中" AND ts_keyworddetectrecord.keywordid IS NULL';
			$list = M() -> query($sql);
			$show_trans = true;
		}
		//dump($list);
		//dump( M() -> _sql());
		//exit;
		// 循环对关键词进行处理
		foreach ( $list as $vo ){

			// 在检测记录中增加一条检测的记录
			$record = $modelKeyworddetectrecord -> addRecord( $vo['id'], $vo['keyword'] ,$vo['website'] ,$vo['searchengine'], $vo['createuserid'] );
			// 如果新增成功才进行推送消息处理
			if( $record ){

				// 网站地址 去掉www. m.  Wap. 3g.  等前缀
				//$url = str_replace(array('www.','m.','Wap.', '3g.'),'',$vo['website']);

				//$url = str_ireplace(array('www.','Wap.', '3g.'),'',$vo['website']);

				// 新去掉http://
				$url = str_ireplace(array('http://','https://'),'',$vo['website']);

				// 需要替换的前缀
				$prefixs =  array('www.','m.','wap.', '3g.');

				// 判断是否已以下的几个开开头
				foreach ($prefixs as $vo_pf){
					if( stripos($url,$vo_pf) === 0 ){
						$url = substr($url,strlen($vo_pf));

					}
				}

					
				//获取token
				$token = md5($url.$record.'pandarank');
					
				//将token插入都数据库
				$data['token'] = $token;
				$r = $modelKeyworddetectrecord -> where( array('id' => $record)) -> save( $data );
					
				// 				if( !$r ){
				// 					$this -> error ="";
				// 					return false;
				// 				}
					
				//调用关键词接口进行获取数据
					
				// 循环对关键词进行检测
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
					case 'sougou':
						$type = 4;
						break;
					case 'shenma':
						$type = 5;
						break;
					default:
						$type = 1;
						break;
				}
				$postData['task_id'] 	= $record;
				$postData['url'] 		= $url;
				$postData['type'] 		= $type;//1或者参数为空：百度PC;2：百度移动；3：360PC;4:搜狗；5:神马搜索
				$postData['keywords'] 	= $vo['keyword'];
				$postData['token'] 		= $token;

				//exit;
				// TODO ==================>

				$result_post = API_V1Model::httpClientPostData($postData, $host, $url_post);


				$response = json_decode($result_post['response'],true);
					

				// 判断操作结果，如果提交接口失败，那么需要滚回数据
				if( $response['ret'] != 1 ){
					//
					$modelKeyworddetectrecord -> deleteRecord( array('id' => $record) );
						
				}
				if( $show_trans){
					dump( $postData);
					dump($response);
				}

			}
		}

	}

	/**
	 * 关键词快排
	 *
	 * 检测所有正在优化中的关键词：
	 * 1、检测全部正在优化，无论是否达标都需要对该关键词进行检测，只有当前的最新排名在第一页，才会进行达标扣费
	 * 2、如果排名在第一页，修改该关键词的状态为已达标，并且判断是否是第一次达标，如果是第一次达标，就将该关键词进行绑定，并且90天内不能解冻
	 *
	 */
	function quick_sort( $list ){

		header("Content-type: text/html; charset=utf-8");
		// 关键词检测记录
		$modelKeyworddetectrecord 	= D('Biz/Keyworddetectrecord');

		$map['keywordstatus'] 	= '优化中';
		$map['searchengine'] 	= 'baidu';
		$map['status'] 			= 1;
		$list = $this -> queryRecordAll( $map,'id,keyword,searchengine,website' ,'regtime desc', null,5);
		foreach ( $list as $vo ){
				
			$url_get 	= 'http://www.wode101.cn:82/baidupcrank?keyword='.urlencode( $vo['keyword'] ).'&site='. $vo['website']  .'&page=15&id='. $vo['id'];
				
			dump( $url_get );
				
			$result = file_get_contents( $url_get );
			$arra = json_decode( $result, true);
			foreach ( $arra as &$vo ){
				$vo = urldecode($vo);
			}
			dump( $arra );
		}
		exit;
		dump($list);exit;


		$url_get 	= 'http://www.wode101.cn:82/baidupcrank?keyword='.urlencode('关键词排名批量查询').'&site=www.wode101.cn&page=4&id='.urlencode('关键词ID');

		$list = file_get_contents( $url_get );

		$arra = json_decode( $list, true);

		//$arra = my_json_encode( $list);

		foreach ( $arra as &$vo ){
			$vo = urldecode($vo);
		}
		dump($arra);
		/* $host 		= $this -> yundanran_parse_host( $url_get );
		 dump( $host );

		 $result_post = API_V1Model::httpClientGetData( $host, $url_get );
		 	

		 $response = json_decode($result_post['response'],true);
		 dump( $result_post ); */
		exit;
		// 判断操作结果，如果提交接口失败，那么需要滚回数据

		if( $show_trans){
			dump( $postData);
			dump($response);
		}

	}

/**
	 * 检测关键词
	 *
	 * 检测所有正在优化中的关键词：
	 * 1、检测全部正在优化，无论是否达标都需要对该关键词进行检测，只有当前的最新排名在第一页，才会进行达标扣费
	 * 2、如果排名在第一页，修改该关键词的状态为已达标，并且判断是否是第一次达标，如果是第一次达标，就将该关键词进行绑定，并且90天内不能解冻
	 * 正在显示第 0 - 24 行 (共 81 行, 查询花费 0.2178 秒。)
select a.`keywordid`, a.`rank` - b.`rank` as diff,a.`keyword`,a.`rank`, b.`rank` from (select `keywordid`,keyword,`rank` from ts_keyworddetectrecord WHERE `createtime` like '2017-10-18%' and rank > -1 ) a, (select `keywordid`,keyword,`rank` from ts_keyworddetectrecord WHERE `createtime` like '2017-10-19%' and rank > -1 ) b where a.keywordid = b.keywordid and (a.`rank` - b.`rank` > 5 OR a.`rank` - b.`rank` < -5)
	 */
	function different( $list ){
		
		// 关键词检测记录
		$model 	= D('Biz/Keyworddetectrecord');

		//  获取关键词今天的全部检测相效果
		//$map['createtime'] 	= array('LIKE',date('Y-m-d').'%');
		//$map['rank'] 		= array('NEQ',-1);
		//$map['status'] 		= 1;
		//$list = $model -> queryRecordEx($map); 

		//$map['createtime'] 	= array('LIKE',date("Y-m-d",strtotime("-1 day")).'%');



            $sql ="select a.`keywordid`, a.`rank` - b.`rank` as diff,a.`keyword`,a.`rank` as rank_yesterday, b.`rank` as rank_today,a.website,a.searchengine from 
		(select `keywordid`,`rank`,`keyword` ,website ,searchengine from ts_keyworddetectrecord WHERE `createtime` like '".date("Y-m-d",strtotime("-1 day"))."%' and rank > -1 ) a, 
(select `keywordid`,`rank` from ts_keyworddetectrecord WHERE `createtime` like '".date('Y-m-d')."%' and rank > -1 ) b 
where a.keywordid = b.keywordid and (a.`rank` - b.`rank` > 5 OR a.`rank` - b.`rank` < -5) and a.rank > 0 AND a.rank <11";

            $sql1 ="select b.`keywordid`, b.`rank` - a.`rank` as diff,b.`keyword`,a.`rank` as rank_yesterday, b.`rank` as rank_today,b.website,b.searchengine from (select `keywordid`,`rank`,`keyword` ,website ,searchengine from ts_keyworddetectrecord WHERE `createtime` like '".date("Y-m-d",strtotime("-1 day"))."%' and rank > -1 ) a, (select `keywordid`,`rank`,`keyword` ,website ,searchengine from ts_keyworddetectrecord WHERE `createtime` like '".date('Y-m-d')."%' and rank > -1 ) b where a.keywordid = b.keywordid and (b.`rank` - a.`rank` > 4 OR b.`rank` - a.`rank` < -4) and b.rank > 0 AND b.rank <11";


$SearchengineOptions = C('SearchengineOptions');
		// 搜索引擎打开地址
		$SearchengineSiteOptions = C('SearchengineSiteOptions');

		$list1 = M() -> query($sql) ;
		$list2 = M() -> query($sql1) ;
		 $list = array_merge($list1,$list2);
		foreach ($list as $key => &$vo) {
				$vo['searchengine_zh'] = $SearchengineOptions[$vo['searchengine']];

				$searchengine_url = $SearchengineSiteOptions[$vo['searchengine']];
				// 替换关键词
				$vo['searchengine_url'] = str_replace('{keyword}',urlencode($vo['keyword']),$searchengine_url);
				// 昨日排名
				$rank_yesterday = $vo['rank_yesterday'];
				// 今日排名
				$rank_today = $vo['rank_today'];
				if( $rank_today == 0 ){
					$vo['img'] = '__PUBLIC__/img/down.gif';
				}else{
					if ($rank_today  >= $rank_yesterday ) {
						$vo['img'] = '__PUBLIC__/img/down.gif';
					}else{
						$vo['img'] = '__PUBLIC__/img/up.gif';
					}
				}
		}

		return $list ;

	}

	
	/**
	 * 导入关键词
	 *
	 * update By Richer 于2017年9月28日12:09:00 由于关键词无法完全匹配，所以在导入的时候不匹配关键词，值匹配今天报表中的关键词是否已经检测过了
	 *
	 * @accesspublic
	 */
	function importMatch( $postData ){
	
		ini_set('memory_limit',-1);
		// excel 模型类
		$model_excel 		= D('Tool/Excel');
		
		$fileid 	= $postData['fileid'][0];// 导入文件id
		$fileurl 	= $postData['fileurl'][0];// 导入文件路径
		$filepath 	= $postData['filepath'][0];// 导入文件路径
		
		// 读取模板文件
		$datas = $model_excel -> readMode1( 1, 'A' , $filepath , $sheetNum = 0, $strArray,false, 4 );
	
		$values = $datas['value'];
	

		if( $values ){
			
			foreach ($values as $vo_v){
	
				$keyword 		= $vo_v[0];
				$website 		= $vo_v[1];
				// 组合url
				$website = str_ireplace(array('http://','https://'),'',$vo_v[1]);
				// 需要替换的前缀
				$prefixs =  array('www.','m.','wap.', '3g.');
				// 判断是否已以下的几个开开头
				foreach ($prefixs as $vo_pf){
					if( stripos($website,$vo_pf) === 0 ){
						$website = substr($website,strlen($vo_pf));
					}
				}
				
				$website = rtrim($website, '/');
				
				$searchengine_zh = $vo_v[2];
				$rank = $vo_v[3];
				$detectiondate = $vo_v[4];
				
				$map['keyword'] = $keyword;
				$map['website'] = array('LIKE', '%'.$website.'%') ;
				switch ( $searchengine_zh ) {
					case '百度':
						$searchengine = 'baidu';
						break;
					case '百度移动':
						$searchengine = 'baidu_mobile';
						break;
					case '搜狗':
						$searchengine = 'sougou';
						break;
					case '360':
						$searchengine = '360';
						break;
					
					default:
						$searchengine = 'baidu';
						break;
				}
				
				$map['searchengine'] = $searchengine;
				$map['latestranking'] = array('NEQ', $rank);
				$keyword = $this-> selectOne( $map ,'id,website,keyword,latestranking as rank,searchengine,createuserid,createusername');
				if( $keyword ){
					$keyword['real_rank'] = $rank;
					$keywords[] = $keyword;
				}else{
					//dump($this-> _sql());
				}
				//dump($this-> _sql());
				 
					
			}

		}
		return $keywords;
	
	}
	
	
	/**
	 * 获取今日合作停的关键词
	 */
	function get_cooperate_stop_today(){
		$map['keywordstatus'] 	= '合作停';
		$map['unfreezetime'] 		= array('LIKE' ,date('Y-m-d').'%');//array('LIKE' ,'2017-11-01%');  //
		$map['status'] 			= 1;
		$list  = $this -> queryRecordAll($map,'id,sitename,website,keyword,searchengine,price,createuserid,createusername,createtime');
		return $list;
	}
	
	/**
	 * 获取全部合作停的关键词
	 */
	function get_cooperate_stop_all(){
		$map['keywordstatus'] 	= '合作停';
		//$map['unfreezetime'] 		= array('LIKE' ,date('Y-m-d').'%');//array('LIKE' ,'2017-11-01%');  //
		$map['status'] 			= 1;
		$list  = $this -> queryRecordAll($map,'id,sitename,website,keyword,searchengine,price,createuserid,createusername,createtime');
		return $list;
	}
	
	
	/**
	 * 获取今日新增的关键词
	 */
	function get_new_keyword_today(){
		$map['keywordstatus'] 	= '优化中';
		$map['reviewdate'] 	= array('LIKE' ,date('Y-m-d').'%');//array('LIKE' ,'2017-11-01%');  //
		$map['status'] 			= 1;
		$list  = $this -> queryRecordAll($map,'id,sitename,website,keyword,searchengine,price,createuserid,createusername,createtime');
		return $list;
	}
}

?>
