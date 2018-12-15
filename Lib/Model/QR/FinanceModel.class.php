<?php

/**
 * 模型层：财务管理模型层
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170419
 * @link        http://www.qisobao.com
 */
class FinanceModel extends BaseModel{
	
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
		if( !$numberPerPage ) {
			$numberPerPage = $this -> pageNum;;
		}
	
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
	 * 代理商用户充值
	 * 
	 * 代理商用户进行充值
	 * 
	 * @param float $amount
	 */
	function recharge( $postData ){
		// 充值记录模型
		$model_recharge = D('Biz/FundsRechargeRecord');
		// 资金账户模型
		$model_funds = D('Biz/Funds');
		
		switch ( $_POST['usertype'] ) {
			case 'agent':
				$result_funds = $model_funds -> rechargeForAgentUser( $_POST['id'], $_POST['usertype'], $_POST['amount']);
			break;
			case 'sub':
				$result_funds = $model_funds -> rechargeForSubUser( $_POST['id'], $_POST['usertype'], $_POST['amount']);
				break;
			case 'agent2':
				$result_funds = $model_funds -> rechargeForSubAgent( $_POST['id'], $_POST['usertype'], $_POST['amount']);
				break;
			default:
				;
			break;
		}

		
		if( $result_funds){
			$model_recharge -> addRecord( $_POST['id'], $_POST['usertype'], $_POST['amount'] );
		}else {
			$this -> error = $model_funds -> getError();
		}
		
		
		return $result_funds;
		
	}
	
	
	/**
	 * 获取代理商用户充值记录
	 *
	 * 获取代理商用户充值记录
	 *
	 * @param int $id
	 */
	function getEntryRecords( $userId ){
		// 充值记录模型
		$model_recharge = D('Biz/FundsRechargeRecord');
		return $model_recharge -> getEntryRecords( $userId  );
	}
	
	/**
	 * 获取该代理商用户给子用户和子代理充值记录充值记录
	 *
	 * 获取该代理商用户给子用户充值记录充值记录
	 *
	 * @param int $id
	 */
	function getExpendRecords( ){
		// 充值记录模型
		$model_recharge = D('Biz/FundsRechargeRecord');
		return $model_recharge -> getExpendRecords();
	}
	
	
	/**
	 * 服务商用户充值
	 *
	 * 服务商用户进行充值
	 *
	 * @param float $amount
	 */
	function serverRecharge( $amount ){
	
	}
	
	/**
	 * 资金池管理
	 *
	 * 获取当前资金池的总金额，已经消费金额 资金池金额充值总金额、消费金额、剩余金额
	 */
	function getFundsPool(){
		// 资金账户模型
		$model_funds = D('Biz/Funds');
		$model_standardfee 	= D('Biz/Standardfee');
		$map['usertype'] = 'sub';
		// 总金额
		$data['totalfunds'] 	= $model_funds -> where($map) -> sum( 'totalfunds' );
		// 资金余额
		$data['balancefunds'] 	= $model_funds -> where($map) -> sum( 'balancefunds' );
		// 可用余额
		$data['availablefunds'] = $model_funds -> where($map) -> sum( 'availablefunds' );
		// 冻结金额
		$data['freezefunds'] 	= $model_funds -> where($map) -> sum( 'freezefunds' );
		// 冻结初始金额
		$data['initfreezefunds'] 	= $model_funds -> where($map) -> sum( 'initfreezefunds' );
		
		// 消费余额
		//$data['consumptionfunds'] = $data['totalfunds'] - $data['availablefunds'];
		$data['consumptionfunds'] = $model_standardfee  -> sum('price');

		return $data;
	}
	
	/**
	 * 资金池管理
	 *
	 * 获取当前代理上的资金池的总金额，已经消费金额 资金池金额充值总金额、消费金额、剩余金额
	 */
	function getFundsPoolAgent( $userid ){
		$model_user  = D('User/User') ;
		if( !$userid ){
			$userid = $this -> getLoginUserId();
		}
		// 资金账户模型
		$model_funds = D('Biz/Funds');
		$model_standardfee 	= D('Biz/Standardfee');
		$map['userid'] = $userid;
		$map['status'] = 1;
		$data = $model_funds -> selectOne( $map );
		// 获取该代理用户下面的全部子用户，
		$users = $model_user-> getSubUserForAgent ($userid);
		
		// 如果该代理商开通了二级代理的功能，需要获取全部二级代理的资金池
		$me =$this -> getloginUserInfo();
		if( $me['isopen_subagent']){
			
			// 获取全部的二级代理
			$users_agent2 = $model_user -> getSubAgent ($userid);
			
			foreach ($users_agent2 as $vo ){
				$map_agent2['userid'] 		= $vo['id'];
				$map_agent2['usertype'] 	= 'agent2';
				$map_agent2['status'] 		= 1;
				//$pools[] = $this -> getFundsPoolAgent2( $vo['id'] );
				$agent2_userids[] = $vo['id'];;
			}
			if( $agent2_userids ){
				
				$map_agent2['userid'] 		= array('IN', $agent2_userids);
				$map_agent2['status'] 		= 1;
				$totalfunds_sub = $model_funds -> where( $map_agent2 ) -> sum( 'totalfunds'  );
				
				$map_agent2_user['pid'] 		= array('IN', $agent2_userids);
				$map_agent2_user['status'] 	= 1;
				$agent2_users = $model_user -> queryRecordAll( $map_agent2_user );
				foreach ($agent2_users as $vo_a2user){
					$userids[] = $vo_a2user['id'];
				}
					
			}
				
				
			/* 	
				$map_agent2_sub['createuserid'] = array('IN', $agent2_userids);
				$map_agent2_sub['status'] 		= 1;
				
				// 可用余额
				$availablefunds 	= $model_funds -> where($map_agent2_sub) -> sum( 'availablefunds' );
				// 冻结金额
				$freezefunds 		= $model_funds -> where($map_agent2_sub) -> sum( 'freezefunds' );
				// 冻结初始金额
				$initfreezefunds 	= $model_funds -> where($map_agent2_sub) -> sum( 'initfreezefunds' );
				
				// 消费总额
				$data['consumptionfunds'] = $model_standardfee  -> where( $map_standardfee ) ->  sum('price'); */
			
			/* foreach ($users_agent2 as $vo ){
				$pools[] = $this -> getFundsPoolAgent2( $vo['id'] );
			}
			dump($pools);
			foreach ($pools as $vo_pool ){
				$totalfunds_sub += $vo['totalfunds'];
			} */
			/* // TODO
			$users_agent2 = $model_user -> getSubUserForAgent2 ($userid);
			
			$map_['usertype'] 		= 'agent2';
			$map['createuserid'] 	= $userid;
			$map['status'] 			= 1;
			$data = $model_funds -> selectOne( $map );
			
			foreach($users_agent2  as $vo_user_agent2 ){
			
				$userids[] = $vo_user_agent2['id'];
			}
			
			// 获取该
			
			dump($users_agent2); */
		}
		
		
		// 获取用户的id
		foreach($users  as $vo_user ){
			
			$userids[] = $vo_user['id'];
		}
		$userids = array_unique($userids);
		if( $userids ){
			unset( $map);
			$map['userid'] 		= array('IN',$userids);
			$map['usertype'] 	= 'sub';
			$map['status'] 		= 1;
			// 为子用户充值总金额
			$totalfunds_sub 			= $model_funds -> where($map) -> sum( 'totalfunds' );
			
			// 可用余额
			$availablefunds 			= $model_funds -> where($map) -> sum( 'availablefunds' );
			// 冻结金额
			$freezefunds 				= $model_funds -> where($map) -> sum( 'freezefunds' );
			// 冻结初始金额
			$initfreezefunds 			= $model_funds -> where($map) -> sum( 'initfreezefunds' );
			
			// 资金余额
			$data['balancefunds'] 		= $data['totalfunds'] - $totalfunds_sub;
			// 可用余额
			$data['availablefunds'] 	= $availablefunds;
			// 冻结金额
			$data['freezefunds'] 		= $freezefunds;
			// 冻结初始金额
			$data['initfreezefunds'] 	= $initfreezefunds;
			
			// 从达标扣费中获取总共消耗
			$map_standardfee['ownuserid'] = array('IN',$userids); 
			$data['consumptionfunds'] = $model_standardfee  -> where( $map_standardfee ) ->  sum('price');
		}
		return $data;
	}
	
	/**
	 * 资金池管理：获取代理商下面一个全部子代理的资金池统计
	 *
	 * 获取当前代理上的资金池的总金额，已经消费金额 资金池金额充值总金额、消费金额、剩余金额
	 */
	function getFundsPoolAgent2( $userid ){
		
		$model_user  = D('User/User') ;
		if( !$userid ){
			$userid = $this -> getLoginUserId();
		}
		// 资金账户模型
		$model_funds = D('Biz/Funds');
		$model_standardfee 	= D('Biz/Standardfee');
		
		$map['userid'] = $userid;
		$map['status'] = 1;
		$data = $model_funds -> selectOne( $map );
		// 获取该代理用户下面的全部子用户，
		$users = $model_user-> getSubUserForAgent ($userid);
	
		// 获取用户的id
		foreach($users  as $vo_user ){
				
			$userids[] = $vo_user['id'];
		}
		$userids = array_unique($userids);
		if( $userids ){
			unset( $map);
			$map['userid'] 		= array('IN',$userids);
			$map['usertype'] 	= 'sub';
			$map['status'] 		= 1;
			// 为子用户充值总金额
			$totalfunds_sub 		= $model_funds -> where($map) -> sum( 'totalfunds' );
			// 资金余额
			$data['balancefunds'] 	= $data['totalfunds'] - $totalfunds_sub;
			// 可用余额
			$data['availablefunds'] = $model_funds -> where($map) -> sum( 'availablefunds' );
			// 冻结金额
			$data['freezefunds'] 	= $model_funds -> where($map) -> sum( 'freezefunds' );
			// 冻结初始金额
			$data['initfreezefunds'] 	= $model_funds -> where($map) -> sum( 'initfreezefunds' );
				
			// 从达标扣费中获取总共消耗
			$map_standardfee['ownuserid'] = array('IN',$userids);
			$data['consumptionfunds'] = $model_standardfee  -> where( $map_standardfee ) ->  sum('price');
		}
		
		return $data;
	}
	

}
	
?>