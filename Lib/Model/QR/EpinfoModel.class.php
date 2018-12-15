<?php

/**
 * 模型层：快排宝-企业基本资料模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.QR
 * @version     20170629
 * @link        http://www.qisobao.com
 */
class EpinfoModel extends BaseModel{
	
	
	/**
	 * 自动处理数据
	 */
	protected $__auto 		= array (
			array ('createuserid', 'getLoginUserId',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createusername', 'getloginUserName',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createtime','date',1,'function',array('Y-m-d H:i:s')), // 对createtime字
			array ('epstatus','待审核'), // 新增的时候把userstatus字段设置为正常
	);
	
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		$this -> trueTableName= C('DB_PREFIX') . 'qr_epinfo';
		//合并自动完成
		$this->setProperty("_auto", array_merge($this->_auto, $this->__auto));
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
			$me = $this -> getloginUserInfo();
			// 根据用户的角色判断该用户对该计划的权限
			switch ( $me['role_info']['rolecode']) {
				case 'sub':// 子用户
					if( $data['epstatus'] == '待审核'){
						$data['can_edit'] = 1;
						$data['can_delete'] = 1;
					}
					break;
				case 'agent':// 代理商用户
					if( $data['epstatus'] == '待审核'){
						$data['can_edit'] = 1;
						$data['can_delete'] = 1;
					}
					break;
				case 'operation':// 运维
					if( $data['epstatus'] == '待审核'){
						$data['can_edit'] = 1;
						$data['can_review'] = 1;
						$data['can_delete'] = 1;
					}
			
					if( $data['epstatus'] == '合作停'){
						$data['can_review'] = 1;
					}
					break;
				default:
					;
					break;
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
		$me = $this -> getloginUserInfo();
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
		if( !$numberPerPage ) {
			$numberPerPage = $this -> pageNum;;
		}
		$me = $this -> getloginUserInfo();
		foreach( $list['data'] as $key => &$vo ){
	
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $numberPerPage;
			$vo['No'] = $No;	
	
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
		foreach( $list['data'] as  $key => &$vo ){
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $num_per_page;
			$vo['No'] = $No;
			
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
	function addRecord( $postData ){
		//rtrim($str, ",");
		// 判断该计划的任务是否已经添加
		$postData['planname'] = trim( $postData['planname'] );
		if( $this -> selectOne( array('planname' => $postData['planname'] ))){
			$this -> error ="该计划已经存在";
			return false;
		}
		// 去掉结尾的/
		return $this -> insert($postData);
	}
	
	/**
	 * 获取我的企业基本信息
	 */
	function getMyEpinfo( ){
	
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> selectOne($map);
	}
	
	/**
	 * 维护企业基本信息
	 * 
	 * 分页获取我的计划
	 */
	function maintain( $postData){
		$id = $postData['id'];
		if( $id ){
			$result = $this-> update($postData );
		}else{
			$result =$this-> insert($postData );
		}
		return $result;
	}
	
	/**
	 * 获取我的计划
	 * 
	 * 获取我的全部计划
	 */
	function getMyPlansAll(){
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> queryRecordAll($map, $fields,'regtime desc');
	}
	
	
	
	/**
	 * 获取全部的计划数量
	 */
	function getAllPlansNum(  ){
	
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
	 * 获取优化中或者合作停的站点
	 */
	function getEffectForSub(  ){
		// 资金冻结模型
		$modelFundsfreeze 	= D('Biz/Fundsfreeze');
		// 达标消费模型
		$modelStandardfee 	= D('Biz/Standardfee');
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['sitestatus'] 		= array( array('EQ','优化中'),array('EQ','合作停'),'OR');
		$map['status'] 			= 1;
		$list = $this -> getEffect( $map, $fields );
		return $list;
	}
	
	/**
	 * 获取代理商站点效果
	 */
	function getEffectForSale( ){
		$model_user = D('User/User');
		
		
		$userids = $model_user -> getUsersForSale ( ) ;
	
		if( $userids ){
			$map['createuserid'] 	= array( 'IN', $userids );
			$map['sitestatus'] 		= array( array('EQ','优化中'),array('EQ','合作停'),'OR');
			$map['status'] 			= 1;
				
			$list = $this -> getEffect( $map, $fields );
				
		}
	
	
		return $list;
	}
	
	/**
	 * 获取代理商站点效果
	 */
	function getEffectForAgent( $userid ){
		$model_user = D('User/User');
		// 资金冻结模型
		$modelFundsfreeze 	= D('Biz/Fundsfreeze');
		// 达标消费模型
		$modelStandardfee 	= D('Biz/Standardfee');
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
			$map['sitestatus'] 		= array( array('EQ','优化中'),array('EQ','合作停'),'OR');
			$map['status'] 			= 1;
			
			$list = $this -> getEffect( $map, $fields );
			
		}
		
		return $list;
	}
	
	/**
	 * 获取全部站点的效果
	 */
	function getEffectForAdmin( $userid ){
		// 资金冻结模型
		$modelFundsfreeze 	= D('Biz/Fundsfreeze');
		// 达标消费模型
		$modelStandardfee 	= D('Biz/Standardfee');
		
		//引入查询工具类
		import('ORG.Util.QueryTools');
		
		//实例化联合查询工具类
		$querytools = new QueryTools();
		
		// 查询站点名称
		if($querytools->paramExist('sitename')){
			//拼接exp条件
			$exp = array('like', '%'.$_GET['sitename'].'%');
			$querytools ->addParam('sitename','sitename',$exp);
		}
		
		// 查询站点地址
		if($querytools->paramExist('website')){
			//拼接exp条件
			$exp = array('like', '%'.$_GET['website'].'%');
			$querytools ->addParam('website','website',$exp);
		}
		
		// 查询站点状态
		if($querytools->paramExist('sitestatus')){
			//拼接exp条件
			$exp = array('eq', $_GET['sitestatus']);
			$querytools ->addParam('sitestatus','sitestatus',$exp);
		}
		
		//组合查询条件
		$query_params = 'sitename,website,sitestatus,num_per_page';
		//添加默认排序参数-按照天时间排序
		$querytools->addDefOrder('id desc,regtime desc');
		
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['sitestatus'] 		= array( array('EQ','优化中'),array('EQ','合作停'),'OR');
		$map['status'] 			= 1;
		
		$list = $this -> getEffect( $map, $fields, $querytools->getOrder(), $querytools->getPageparam() ,$_GET['num_per_page']);
				
		return $list;
	}
	
	
	/*
	 * 获取站点效果公共方法
	 */
	function getEffect( $map, $fields,$order ='regtime desc' ,$pageparam,$num_per_page ){
		// 资金冻结模型
		$modelFundsfreeze 	= D('Biz/Fundsfreeze');
		// 资金模型
		$model_funds 	= D('Biz/Funds');
		// 达标消费模型
		$modelStandardfee 	= D('Biz/Standardfee');
		$list = $this -> queryRecordEx($map, $fields,$order, $pageparam,$num_per_page);
		
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
	function getHistory ( $siteid,$begindate, $enddate, $usertype ){
		
		// 获取当前站点的添加时间
		$data = $this -> selectOne( array('id' => $siteid ));

		$createtime = format_date($data['createtime']);

		// 如果
		if( strtotime($begindate) < strtotime($createtime) ){
		
			$begindate = $createtime;
		}
	
		$days = combo_query_date($begindate,$enddate);
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
		
		$data = $postData;
		//d
		$id 			= $postData['id'];
		
		//判断当前是否可以删除
		$oldData = $this -> selectOne( array('id' => $id ));
		if( $oldData['can_review'] != 1 ){
			$this -> error =  '审核失败，您暂时不能审核该关键词！';
			return false;
		}
		
		$data['reviewdate'] 	= date('Y-m-d H:i:s');
		$data['reviewuserid'] 	= $this -> getLoginUserId();
		$data['reviewusername'] = $this -> getloginUserName();
		
		$result =	$this -> update($data);
	
		if( $result ){
			// 审核完成后写入操作日志
			$postData['conclusion'] 	= $postData['epstatus'];
			$model_operation_log = D('Biz/OperationLog');
			
			$model_operation_log -> addLog( $this -> getModelName() ,MODULE_NAME,'审核企业基本资料',$postData );
		}
		
		return $result;
	}
	
	
}
	
?>