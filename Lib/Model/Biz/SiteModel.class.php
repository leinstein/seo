<?php

/**
 * 模型层：站点模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170419
 * @link        http://www.qisobao.com
 */
class SiteModel extends BaseModel{
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		$this -> trueTableName= C('DB_PREFIX') . 'site';
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
	function selectOne( $map ){
	
		//调用父类方法获取数据
		$data = parent:: selectOne( $map );
	
		//将数据的中的大字段格式转化成php数组
		if( $data ){
		
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
	
		foreach( $list as &$vo ){
				
	
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
		
		foreach( $list['data'] as $key => &$vo ){
	
			//计算序号
			
	
	
	
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
	
		$list = parent:: queryRecordEx($map, $fields, $order,  $url_param, $num_per_page);
		
		$me = $this -> getloginUserInfo();
		
		$modelKeyword = D( 'Biz/Keyword' );
		
		$model_workorder = D( 'Biz/Workorder' );
		foreach( $list['data'] as  $key => &$vo ){
			//获取关键词的数量
            $m['siteid'] = $vo['id'];
            $m['keywordstatus'] = '优化中';

            $keywords = $modelKeyword ->where($m)->select();
			//$keywords = $modelKeyword -> getBySiteid( $vo['id'] );
			//计算冻结费用
			$freezefunds = 0;
			foreach( $keywords as  $vo_kw ){
				$freezefunds += $vo_kw['freezefunds'];
			}
			$vo['freezefunds']= $freezefunds ;
			$vo['keywords'] = $keywords;
			$vo['keywordnum'] = count( $vo['keywords'] );

			//$vo['isCanEdit'] = 1;
			$standardNum = 0;
			$optimizationNum  = 0;
			// 达标消费
			$standard_con =  0;
			// 累计消费		
			$total_consumption = 0;
			//是否有已经优化的关键词
			foreach ($keywords as $vo_kw ){
				//if( $vo_kw['keywordstatus']=='优化中' || $vo_kw['keywordstatus'] == '合作停'){
				if( $vo_kw['keywordstatus']=='优化中'){
					$vo['isCanEdit'] = 0;
					//$vo['sitestatus'] = '优化中';
					$optimizationNum ++;
					//达标关键词
					if( $vo_kw['standardstatus']=='已达标'){
						$standardNum ++;
						$standard_con += $vo_kw ['price'] ;
					}
				}
				// 累计消费
				$total_consumption  +=  $vo_kw ['price']* $vo_kw['standarddays'] ;
			}
			$vo['optimizationNum'] = $optimizationNum;
			//达标关键词
			$vo['standardNum'] = $standardNum;
			
			//计算达标总消费
			if( $vo['standardstatus'] == '已达标' ){
				$vo['total_consumption']  = $vo['standarddays'] * $vo['price'] ;
			}

			// 达标消费
			$vo['standard_con'] = $standard_con ;

			// 累计消费
			$vo['total_consumption'] = $total_consumption  ;
				
			switch ($me['usertype']) {
				case 'sub':
					if( $vo['sitestatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_delete'] = 1;
					}
				break;
				case 'operation_manager':
				case 'operation':
					//$vo['can_edit'] = 1;
					if( $vo['sitestatus'] == '待审核' || $vo['sitestatus'] == '优化中'){
						$vo['can_review'] = 1;
					}
					if( $vo['sitestatus'] == '待审核'){
						$vo['can_delete'] = 1;
					}
					if( $vo['sitestatus'] == '优化中' || $vo['sitestatus'] == '合作停'){
						$vo['can_edit'] = 1;
					}
					break;
				
				default:
					;
				break;
			}
			
			// 是否可以添加工单
			if( $vo['sitestatus'] == '优化中'){
				$vo['can_add_workorder'] = 1;
			}
			// 查询是否有工单，还未结束的工单
		//	$workorder  = $model_workorder -> getActived( $vo['id']);
		
			// 查询用户的代理用户
			$userids[] = $vo['createuserid'];
		}
		
		if( GROUP_NAME == 'Manage' ){
			// 获取用户的代理商
			$userids = array_unique( $userids );
			
			$users = D('User/User') -> getAgentUserForSub( $userids );
			foreach( $list['data'] as  &$vo_list ){
				$user = list_search($users, array('id' =>$vo_list['createuserid'] ));
				$vo_list['agent'] = $user[0]['agent'];
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
		//rtrim($str, ",");
		
		//组合其他相关参数
		$data = $postData;
		$data['createtime'] 	= date('Y-m-d H:i:s');
		$data['createuserid'] 	= $this -> getLoginUserId();
		$data['createusername'] = $this -> getloginUserName();
		$data['sitestatus'] 	= '待审核';
		// 去掉结尾的/
		$data['website'] 		= rtrim($postData['website'], "/") ; 
		return parent::insert($data);
	}
	
	/**
	 * 获取我的站点列表
	 */
	function getMySites( $username ){
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> queryRecordEx($map, $fields,'regtime desc');
	}
	
	
	
	/**
	 * 获取全部的站点数数量
	 */
	function getSitesNum(  ){
	
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}
	
	/**
	 * 获取我的站点列表
	 */
	function getMySitesNum(  ){
		
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}
	
	
	/**
	 * 获取我的站点列表
	 * 获取子用户站点
	 * 
	 */
	function getSubSitesNum(  ){
	
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}
	
	/**
	 * 获取代理商的网站点数量
	 * 
	 * @param unknown $userid
	 */
	function getAgentSitesNum( $userid ){

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
			return $this -> where( $map ) -> count();
		}
	}
	
	
	/**
	 * 获取我的站点列表
	 */
	function getMySitesAll(  ){
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> queryRecordAll($map, $fields);
	}
	
	/**
	 *
	 * @param array $map
	 * @param array $fields
	 * @param string $order
	 * @param string $pageparam
	 * @param int $num_per_page
	 * @param bool $is_mobile
	 * @return mixed
	 */
	function getEffect( $map, $fields,$order ='regtime desc' ,$pageparam, $num_per_page, $is_mobile ){
		// 资金冻结模型
		$modelFundsfreeze 	= D('Biz/Fundsfreeze');
		// 资金模型
		$model_funds 		= D('Biz/Funds');
		// 达标消费模型
		$modelStandardfee 	= D('Biz/Standardfee');
		
		// 实例化统计模型
		$model = D('Biz/Statistics');
		// 获取该用户下面的全部客户信息
		$users =  $model -> getUsers( );
		$userids = $users['userids'];

		if( $userids ){
			if( $userids != 'all'){
				$map['createuserid'] 	= array( 'IN', $userids );
			}
			$map['sitestatus'] 		= array( array('EQ','优化中'),array('EQ','合作停'),'OR');
			$map['status'] 			= 1;
			$list = $this -> queryRecordEx($map, $fields,$order, $pageparam, $num_per_page);
		}

		
	
		/* //获取该站点的冻结jin'e
		foreach ($list['data'] as $vo_t ){
			$userids[] = $vo_t['createuserid'];
		}
		$userids = array_unique( $userids ); */
		//获取该站点的冻结jin'e
		foreach ($list['data'] as &$vo ){
			/* unset( $funds );
				$initfreezefunds 	= 0;
				$total_consumption 	= 0;
				foreach ( $userids as $vo_uid ){
				if( $vo['createuserid'] == $vo_uid ){
				$funds[] = $model_funds -> selectOne( array('userid' => $vo_uid) );
				}
	
				}
					
				foreach ($funds as $vo_funds ){
				$initfreezefunds += $vo_funds['initfreezefunds'];
				$total_consumption += $vo_funds['total_consumption'];
				}
				// 初始冻结金额
				$vo['initfreezefunds'] = $initfreezefunds;
				// 剩余冻结金额
				$vo['remainfreezefunds'] = ($initfreezefunds - $total_consumption) > 0 ? $initfreezefunds - $total_consumption : 0;
				// 消耗冻结金额
				$vo['consfreezefunds'] = $vo['initfreezefunds'] - $vo['remainfreezefunds'];
				// 累计消耗金额
				$vo['consumption'] = $total_consumption; */
				
			unset($map);
			$map['siteid'] 			=  $vo['id'];
			$map['status'] 			=  1;
			/* //$map['unfreezedate'] 	= '';
				$map['siteid'] 			=  $vo['id'];
				$map['status'] 			=  1;
				// 初始冻结金额
				$initfreezefunds = $modelFundsfreeze -> where( $map ) -> sum( 'freezefunds' );
				if ( $vo['id'] == 49 ){
				dump($modelFundsfreeze -> _sql());
				dump( $vo );
				} */
			$initfreezefunds = $vo['freezefunds'];
			$vo['initfreezefunds'] = $initfreezefunds;
			// $fundsfreeze = $modelFundsfreeze -> queryRecordAll( $map1 );
			// 获取该站点的消费金额
			$consumption = $modelStandardfee -> where( $map ) -> sum( 'price');
			$vo['consumption'] = $consumption;
			$consfreezefunds = $consumption;
			if( $consfreezefunds > $initfreezefunds){
				$consfreezefunds = $initfreezefunds;
			}
			$vo['consfreezefunds'] = $consfreezefunds;
			// 剩余冻结金额
			$vo['remainfreezefunds'] = $initfreezefunds - $consfreezefunds ;
	
			// 获取今日达标消费
			$map['standarddate'] 			=  array('LIKE',date('Y-m-d') .'%');
			$standardfee = $modelStandardfee -> where( $map ) -> sum( 'price' );
			$vo['standardfee'] = $standardfee;
		}
		return $list;
	}
	
	/**
	 * 
	 * @param array $map
	 * @param array $fields
	 * @param string $order
	 * @param string $pageparam
	 * @param int $num_per_page
	 * @param bool $is_mobile
	 * @return mixed
	 */
	function getEffect1( $map, $fields,$order ='regtime desc' ,$pageparam, $num_per_page, $is_mobile ){
		// 资金冻结模型
		$modelFundsfreeze 	= D('Biz/Fundsfreeze');
		// 资金模型
		$model_funds 	= D('Biz/Funds');
		// 达标消费模型
		$modelStandardfee 	= D('Biz/Standardfee');
		$list = $this -> queryRecordEx($map, $fields,$order, $pageparam, $num_per_page);
		
		//获取该站点的冻结jin'e
		foreach ($list['data'] as $vo_t ){
			$userids[] = $vo_t['createuserid'];
		}
		$userids = array_unique( $userids );
		//获取该站点的冻结jin'e
		foreach ($list['data'] as &$vo ){
			/* unset( $funds );
			$initfreezefunds 	= 0;
			$total_consumption 	= 0;
			foreach ( $userids as $vo_uid ){
				if( $vo['createuserid'] == $vo_uid ){
					$funds[] = $model_funds -> selectOne( array('userid' => $vo_uid) );
				}
				
			}
			
			foreach ($funds as $vo_funds ){
				$initfreezefunds += $vo_funds['initfreezefunds'];
				$total_consumption += $vo_funds['total_consumption'];
			}
			// 初始冻结金额
			$vo['initfreezefunds'] = $initfreezefunds;
			// 剩余冻结金额
			$vo['remainfreezefunds'] = ($initfreezefunds - $total_consumption) > 0 ? $initfreezefunds - $total_consumption : 0;
			// 消耗冻结金额
			$vo['consfreezefunds'] = $vo['initfreezefunds'] - $vo['remainfreezefunds'];
			// 累计消耗金额
			$vo['consumption'] = $total_consumption; */
			
			 unset($map);
			 $map['siteid'] 			=  $vo['id'];
			 $map['status'] 			=  1;
			/* //$map['unfreezedate'] 	= '';
			$map['siteid'] 			=  $vo['id'];
			$map['status'] 			=  1;
			// 初始冻结金额
			$initfreezefunds = $modelFundsfreeze -> where( $map ) -> sum( 'freezefunds' );
			if ( $vo['id'] == 49 ){
				dump($modelFundsfreeze -> _sql());
				dump( $vo );
			} */
			 $initfreezefunds = $vo['freezefunds'];
			$vo['initfreezefunds'] = $initfreezefunds;
			// $fundsfreeze = $modelFundsfreeze -> queryRecordAll( $map1 );
			// 获取该站点的消费金额
			$consumption = $modelStandardfee -> where( $map ) -> sum( 'price'); 
			$vo['consumption'] = $consumption;
			$consfreezefunds = $consumption;
			if( $consfreezefunds > $initfreezefunds){
				$consfreezefunds = $initfreezefunds;
			}
			$vo['consfreezefunds'] = $consfreezefunds;
			// 剩余冻结金额
			$vo['remainfreezefunds'] = $initfreezefunds - $consfreezefunds ;
		
			// 获取今日达标消费
			$map['standarddate'] 			=  array('LIKE',date('Y-m-d') .'%');
			$standardfee = $modelStandardfee -> where( $map ) -> sum( 'price' );
			$vo['standardfee'] = $standardfee;
		}
		return $list;
	}
	
	/**
	 * 获取站点的每日记录
	 * 
	 * @param int $siteid
	 * @param string $begindate
	 * @param string $enddate
	 * @return unknown
	 */
	function getHistory ( $siteid,$datestr, $usertype ){
		

		$modelStandardfee 	= D('Biz/Standardfee');
		// 获取当前站点的添加时间
		$data = $this -> selectOne( array('id' => $siteid ));

		$createtime = format_date($data['createtime']);
		
		
		// 获取检测时间范围
		$detecttime_arr = explode(' ~ ',$datestr);
		// 开始时间
		$begindate  = $detecttime_arr[0] ;
		
		if( !$begindate || $begindate <  $createtime ){
			$begindate = $createtime;
		}
		// 结束时间
		$enddate  	= $detecttime_arr[1];
		if( !$enddate ){
			$enddate = date("Y-m-d");
		}
		

		// 如果
		if( strtotime($begindate) < strtotime($createtime) ){
		
			$begindate = $createtime;
		}
		
		if( strtotime($enddate) < strtotime($begindate) ){
			$enddate = $begindate;
		}
	
		$days = combo_query_date($begindate,$enddate);
		$days = array_reverse( $days );
	
		
		$map['siteid'] 			= $siteid;
		$map['status'] 			= 1;
		
		$p 				= !empty( $_GET['p'] ) ?  $_GET['p']  : 1;
		$page_number 	= !empty( $_GET['page_number'] ) ?  $_GET['page_number']  : $this -> pageNum;
		$start 			= ($p -1) * $page_number;
		$days_alice = array_slice( $days,$start,$page_number);
		foreach ( $days_alice as $key => $vo ){
			$map['standarddate'] = array( 'LIKE', $vo .'%');
			$count 			= $modelStandardfee -> where( $map ) -> count( );
			$consumption 	= $modelStandardfee -> where( $map ) -> sum( 'price' );
			//计算序号
			$No = ($key + 1) + ($p -1) * $page_number;
			$rs['No'] 			= $No;
			$rs['day'] 			= $vo;
			$rs['count'] 		= $count;
			$rs['consumption'] 	= $consumption;
			$rss[] = $rs;
		}
		$count = count( $days );
		//引用分页库
		import("ORG.Util.Page");
		// 实例化分页类传入总记录数和每页显示的记录数
		$Page = new Page ( $count, $page_number );
		//在翻页时需要加入查询条件，此操作只需要进行一次，如果没有构造条件，则构造，使用qb标志来保存状态
		if ( $_GET["qb"] != 1 ){
			//开始构造查询条件
			$Page->parameter = "&qb=1&" . $queryOptions['PageParameters'];
		}
		// 分页显示输出
		$show = $Page->show ();
		//拼接输出
		$result ['data'] 		= $rss;
		$result ['html'] 		= $show;
		$result ['count'] 		= $count;
		$result ['pageCount'] = ceil( $count / $page_number);     //总页数 intval($Page->totalPages);
		
		return $result;
		
	}

		
	
	/**
	 * 获取子用户当前站点的历史统计情况
	 * 主要是统计历史达标关键词数量
	 */
	function getHistoryForSub( $siteid, $begindate, $enddate ){
		
		
		
		if( $begindate ){
			$diff_begin = (strtotime(date('Y-m-d')) - strtotime($begindate))/86400;
		}else{
			$diff_begin = 5;
		}
		
		if( $enddate ){
			$diff_end = (strtotime($enddate) - strtotime(date('Y-m-d')))/86400;
		}else{
			$diff_end = 0;
		}
		
		$diff = $diff_begin - $diff_end;

		for($i = $diff;$i>=0;$i--){
			$days[]=date('Y-m-d',strtotime("-{$i} days"));
		}
		$days = array_reverse( $days );
		$modelStandardfee 	= D('Biz/Standardfee');
		
		$map['siteid'] 			= $siteid;
		$map['status'] 			= 1;
		foreach ( $days as $vo ){
			$map['standarddate'] = array( 'LIKE', $vo .'%');
			$count 			= $modelStandardfee -> where( $map ) -> count( );
			$consumption 	= $modelStandardfee -> where( $map ) -> sum( 'price' );
			$rs['day'] = $vo;
			$rs['count'] = $count;
			$rs['consumption'] = $consumption;
			$rss[] = $rs;
		}

		return $rss;
		
	}
	
	
	/**
	 * 获取待审核站点
	 * 
	 * @return mixed
	 */
	function getPendingReviewSites(){
		$map['sitestatus'] 		= '待审核';
		$map['status'] 			= 1;
		return $this -> queryRecordEx($map, $fields);

	}
	
	
	/**
	 * 进行站点的审批功能
	 * 
	 * @param unknown $postData
	 * @return unknown
	 */
	function review( $postData ){
		//d
		$id 			= $postData['id'];
		//$conclusion 	= $postData['conclusion'];
		$data['id'] 			= $id;
		$data['reviewdate'] 	= date('Y-m-d H:i:s');
		$data['sitestatus'] 	= $postData['sitestatus'];
		$data['reviewopinion'] 	= $postData['reviewopinion'];
		$data['reviewuserid'] 	= $this -> getLoginUserId();
		$data['reviewusername'] = $this -> getloginUserName();
		$result =	$this -> update($data);
	
		if( $result ){
			// 审核完成后写入操作日志
			$postData['conclusion'] 	= $postData['sitestatus'];
			$model_operation_log = D('Biz/OperationLog');
			$model_operation_log -> addLog( 'site',MODULE_NAME,'审核站点',$postData );
		}
		
		return $result;
	}

	/**
	 * 更新站点信息
	 * 
	 * @param unknown $postData
	 * @return unknown
	 */
	function update_record( $postData ){
		
		$result =	$this -> update( $postData);
	
		if( $result ){
			// 更新成功后，需要同步更新关键词对应的网站
			$map['siteid'] = $postData['id'];
			$keyword['website'] = $postData['website']; 
			D("Biz/Keyword") -> where ( $map ) -> save( $keyword );
		}
		
		return $result;
	}

    /**
     * author l
     * 获取分运维
     */
    function getoperation(){
        $user = M('sys_user');
        $data = $user
            ->field('username')
            ->where(array('usertype'=>'operation','userstatus'=>'正常'))
            ->select();
        foreach ($data as $v){
            $result[] = $v['username'];
        }
        return $result;
    }

    /**
     *给运维分配站点
     */
    function distribution($username,$ids){
        $user = M('sys_user');
        $site = M('Site');
        $userid = $user->field('id,manage_site')->where(array('username'=>$username))->find();
        if($username == '选择运维') $username = '';
        $i = 0;
        foreach ($ids as $k=>$v){
            $siteres =  $site ->where(array('id'=>$v))->save(array('site_manage'=>$username));
            if($siteres) $i++;
        }
        if($i){
            return true;
        }else{
            return false;
        }
    }
	
}
	
?>