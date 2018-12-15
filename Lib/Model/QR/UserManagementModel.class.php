<?php

/**
 * 模型层：用户管理模型类 
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20141010
 * @link        http://www.qisobao.com
 */

class UserManagementModel extends BaseModel{

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
			
			// 从扩展信息中获取
			$data['expand_arr'] = json_decode($data['expand_info'], true );
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
			// 从扩展信息中获取
			if( $vo['expand_arr'] ){
				$vo['expand_arr'] = json_decode($vo['expand_info'], true );
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

		foreach( $list['data'] as $key => &$vo ){
	
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $numberPerPage;
			$vo['No'] = $No;
			
			// 从扩展信息中获取
			if( $vo['expand_arr'] ){
				$vo['expand_arr'] = json_decode($vo['expand_info'], true );
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
	
		$list = parent:: queryRecordEx($map, $fields, $order,  $url_param, $num_per_page);
		
		foreach( $list['data'] as  $key => &$vo ){
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $num_per_page;
			$vo['No'] = $No;
			
			// 从扩展信息中获取
			if( $vo['expand_arr'] ){
				$vo['expand_arr'] = json_decode($vo['expand_info'], true );
			}
		}
	
		return $list;
	}
	
	
	
	/**
	 * 获取总用户数量
	 */
	function getTotalNum( ){
		// 
		$model 	= D('User/AgentUser');
	
		return $model -> count( );
	}
	

	/**
	 * 获取代理商总用户数量
	 */
	function getTotalAgentNum( ){
		//
		$model 	= D('User/User');
		$map['usertype'] = 'agent';
	
		return $model -> where($map) -> count( );
	}
	
	/**
	 * 获取代理商下面的全部子用户数量
	 */
	function getTotalSubNum( $userid ){
		//
		$model 	= D('User/User');
		if( !$userid ){
			$userid = $this -> getLoginUserId();
		}
		$map['pid'] 		= $userid;
		$map['usertype'] 	= 'sub';
		return $model -> where($map) -> count( );
	}
	
	
	/**
	 * 获取有效用户数量
	 */
	function getActiveNum( ){
		//
		$model 	= D('User/AgentUser');
		$map['userstatus'] = '正常';
	
		return $model -> where( $map ) -> count( );
	}
	
	/**
	 * 获取有效代理商总用户数量
	 */
	function getActiveAgentNum( ){
		//
		$model 	= D('User/User');
		$map['usertype'] = 'agent';
		$map['userstatus'] = '正常';
	
		return $model -> where($map) -> count( );
	}
	
	/**
	 * 获取代理商下面的全部有效子用户数量
	 */
	function getActiveSubNum( $userid ){
		//
		$model 	= D('User/User');
		if( !$userid ){
			$userid = $this -> getLoginUserId();
		}
		$map['pid'] 		= $userid;
		$map['usertype'] 	= 'sub';
		$map['userstatus'] 	= '正常';
		return $model -> where($map) -> count( );
	}
	
	/**
	 * 获取无效总用户数量
	 */
	function getInvalidNum( ){
		//
		$model 	= D('User/AgentUser');
		$map['userstatus'] = array('NEQ','正常');
		return $model -> where( $map ) -> count( );
	}
	
	/**
	 * 获取无效代理商总用户数量
	 */
	function getInvalidAgentNum( ){
		//
		$model 	= D('User/User');
		$map['usertype'] = 'agent';
		$map['userstatus'] = array('NEQ','正常');
	
		return $model -> where($map) -> count( );
	}
	
	
	/**
	 * 获取资金池低于10000 的用户
	 */
	function getPoolLess10000( ){
		$model = D('Biz/Funds');
		$map['usertype'] = 'agent';
		$map['userstatus'] 	= '正常';
		$map['balancefunds'] = array('LT',10000);
		$model -> where($map) -> count();
		return $model -> where($map) -> count();
	}
	/**
	 * 获取资金池大于10000 的用户
	 */
	function getPoolGT10000( ){
		$model = D('Biz/Funds');
		$map['usertype'] = 'agent';
		$map['userstatus'] 	= '正常';
		$map['balancefunds'] = array('EGT',10000);
		$model -> where($map) -> count();
		return $model -> where($map) -> count();
	}
	
	
	
	
	/**
	 * 获取代理商下面的全部无效子用户数量
	 */
	function getInvalidSubNum( $userid ){
		//
		$model 	= D('User/User');
		if( !$userid ){
			$userid = $this -> getLoginUserId();
		}
		$map['pid'] 		= $userid;
		$map['usertype'] 	= 'sub';
		$map['userstatus'] = array('NEQ','正常');
		return $model -> where($map) -> count( );
	}
	
	
	/**
	 * 增加用户信息
	 */
	function addUser( $postData ){
		$model 	= D('User/User');
		$postData['username'] = trim( $postData['username'] );
		$data 	= $postData;
		if( !$postData['pid'] ){
			$data['pid'] 	= $this -> getLoginUserId();
		}

		// 判断当前的用户明师傅已经存在
		$map['username'] = $postData['username'];
		if( $model -> selectOne( $map )){
			$this -> error = '该用户名已经存在，请重新创建！';
			return false;
		}
	
		// 组合开通产品信息 
		$product 	= implode($postData['product'],',');
		$data['product'] 		= $product;
		// 组合扩展信息
		$expand['customer'] 	= $postData['customer_id'];
		$expand['seller'] 		= $postData['seller_id'];
		$expand['operationer'] 	= $postData['operationer_id'];
		$data['expand_info'] 	= urldecode(json_encodeEOL(urlencodeAry($expand)));
	
		$result = $model -> insert( $data );
		return $result;
	}
	
	/**
	 * 修改用户信息
	 */
	function updateUser( $postData ){
	
		$model 	= D('User/User');
		$data 	= $postData;
		//if( !$postData['pid'] ){
			//$data['pid'] 	= $this -> getLoginUserId();
		//}
		// 判断当前的用户明师傅已经存在
		$map['username'] = $postData['username'];
		$map['id'] = array('NEQ',$postData['id']);
		if( $model -> selectOne( $map )){
			$this -> error = '该用户名已经存在，请重新修改！';
			return false;
		}
	
		// 组合扩展信息
		$expand['customer'] 	= $postData['customer_id'];
		$expand['seller'] 		= $postData['seller_id'];
		$expand['operationer'] 	= $postData['operationer_id'];
		$data['expand_info'] 	= urldecode(json_encodeEOL(urlencodeAry($expand)));
		// $result = $model -> update( $data );
		unset($data['id']);
		$data['moduser'] = $this -> getloginUserName();
		$data['modtime'] = time();
		$result = $model -> where( array('id' => $postData['id']) ) -> save( $data );
		return $result;
	}
	
	/**
	 * 修改子用户密码
	 */
	function updateSubUserPassword( $postData ){
	
		$model 	= D('User/User');
		
		$result = $model -> updateSubUserPassword( $postData );
		if( !$result ){
			$this -> error = $model -> getError();
		}
		
		return $result;
	}
	
	
	/**
	 * 修改子用户密码
	 */
	function updateAgentUserPassword( $postData ){
	
		$model 	= D('User/User');
	
		$result = $model -> updateAgentUserPassword( $postData );
		if( !$result ){
			$this -> error = $model -> getError();
		}
	
		return $result;
	}
	
	
	
	/**
	 * 增加代理商用户信息
	 */
	function addAgentUser( $postData ){
		$model 	= D('User/AgentUser');
		$data 	= $postData;
		
		// 判断当前的用户明师傅已经存在
		$map['username'] = $postData['username'];
		if( $model -> selectOne( $map )){
			$this -> error = '该用户名已经存在，请重新创建！';
			return false;
		}
		
		// 组合扩展信息
		$expand['customer'] 	= $postData['customer'];
		$expand['seller'] 		= $postData['seller'];
		$expand['operationer'] 	= $postData['operationer'];
		$data['expand_info'] 	= urldecode(json_encodeEOL(urlencodeAry($expand)));
		
		$result = $model -> insert( $data );
		return $result;
	}
	
	/**
	 * 增加代理商用户信息
	 */
	function updateAgentUser( $postData ){

		$model 	= D('User/AgentUser');
		$data 	= $postData;
		// 判断当前的用户明师傅已经存在
		$map['username'] = $postData['username'];
		$map['id'] = array('NEQ',$postData['id']);
		if( $model -> selectOne( $map )){
			$this -> error = '该用户名已经存在，请重新修改！';
			return false;
		}

		// 组合扩展信息
		$expand['customer'] 	= $postData['customer'];
		$expand['seller'] 		= $postData['seller'];
		$expand['operationer'] 	= $postData['operationer'];
		$data['expand_info'] 	= urldecode(json_encodeEOL(urlencodeAry($expand)));
		
		// $result = $model -> update( $data );
		unset($data['id']);
		$data['moduser'] = $this -> getloginUserName();
		$data['modtime'] = time();
		$result = $model -> where( array('id' => $postData['id']) ) -> save( $data );
		return $result;
	}
	
	
	/**
	 * 删除代理商用户信息
	 */
	function delAgentUser( $id ){
		$model 	= D('User/AgentUser');
		$data 	= $postData;
		$result = $model -> deleteRecord( array('id' => $id ) );
		return $result;
	}
	
	/**
	 * 删除用户信息
	 */
	function deleteRecord( $id ){
		$model 	= D('User/User');
		$result = $model -> deleteRecord( array('id' => $id ) );
		return $result;
	}
	
	
	
	
	/**
	 * 获取代理商用户信息列表
	 */
	function detail( $id ){
	
		// 实例化代理商用户模型
		$model_user 	= D('User/User');
	
		// 获取一级代理商用户
		$data 	= $model_user -> selectOne( array('id' => $id ));
		
	
		return $data;
	}
	
	/**
	 * 代理用户登录自代理用户
	 */
	function loginSubuser( $id ){
	
		// 实例化代理商用户模型
		$model_user 	= D('User/User');
		
		return $model_user->checkUserLocalSub ( $id );
	

	}
	
	
	/**
	 * 获取代理商用户信息列表
	 */
// 	function getAgentUserDetail( $id ){
	
// 		// 实例化代理商用户模型
// 		$model_user 	= D('User/User');
		
// 		// 获取一级代理商用户
// 		$data 	= $model_user -> selectOne( array('id' => $id ));
	
// 		return $data;
// 	}
	
	/**
	 * 获取代理商用户信息列表
	 */
	function getAgentUserList( $map, $fields, $order, $pageparam ){

		// 实例化代理商用户模型
		// $model_user 	= D('User/AgentUser');
		$model_user 		= D('User/User');
		$model_funds 		= D("Biz/Funds");
		$map['usertype'] 	= 'agent';

		// 获取当前用户的用户类型
		$me = $this -> getloginUserInfo();
		$usertype = $me['usertype'];
		switch ($usertype) {
			case 'sales_manager':// 销售经理
				// 获取销售经理下面的全部销售
				$userids[] = $me['id'];
				$childs = $model_user -> getChildrenUsers( $me['id'] );
				foreach ($childs as  $vo) {
					$userids[] = $vo['id'];
				}
				if( $userids ){
					$map['seller_id'] = array('IN', $userids );
				}
				break;
			case 'seller':// 销售
				// 获取销售经理下面的全部销售
				$map['seller_id'] = $me['id'];
				break;
			
			default:
				# code...
				break;
		}
		//$map['pid'] 		= $this -> getLoginUserId();
		// 获取一级代理商用户
		$list 	= $model_user -> queryRecordEx( $map, $fields, $order, $pageparam , $num_per_page);
		// 获取子用户信息
		foreach ( $list['data'] as &$vo){
			//$vo['serveruser_num'] = $model_user -> getMembersNum( $vo['id'] ) ;
			$vo['sub_user_num'] = $model_user -> getSubUserNum( $vo['id'] ) ;
			$vo['sub_agent_num'] = $model_user -> getSubAgentNum( $vo['id'] ) ;
			
			
			// 获取每个子用户的资金账户信息
			$vo['funds'] 		= $model_funds -> getFunsinfo( $vo['id'] ) ;
		}
		
		// dump($list);exit;
		return $list;
	}
	
	/**
	 * 获取子用户商用户信息列表
	 */
	function getSubUserList( $map, $fields, $order, $pageparam , $num_per_page, $usertype ){
	
		// 实例化代理商用户模型
		$model_user 	= D('User/User');
		// 资金账户模型
		$model_funds = D('Biz/Funds');
		// 站点模型
		$model_site = D('Biz/Site');
		
		$map['usertype'] 	= 'sub';
		
		if( !$map['pid'] && $usertype != 'operation'){
			$map['pid'] 		= $this -> getLoginUserId();
		}

		// 获取当前用户的用户类型
		$me = $this -> getloginUserInfo();
		$usertype = $me['usertype'];
		switch ($usertype) {
			case 'sales_manager':// 销售经理
				// 获取销售经理下面的全部销售
				$userids[] = $me['id'];
				$childs = $model_user -> getChildrenUsers( $me['id'] );
				foreach ($childs as  $vo) {
					$userids[] = $vo['id'];
				}
				if( $userids ){
					$map['seller_id'] = array('IN', $userids );
				}
				break;
			case 'seller':// 销售
				// 获取销售经理下面的全部销售
				$map['seller_id'] = $me['id'];
				break;
			
			default:
				# code...
				break;
		}
		
		// 获取一级代理商用户
		$list 	= $model_user -> queryRecordEx( $map, $fields, $order, $pageparam, $num_per_page );
		
		// 获取子用户的全部上级代理商
		foreach ($list['data'] as $vo){
			$pids[] = $vo['pid'];
		}
		$pids = array_unique( $pids );
		if( $pids ){
			$map_agent['id'] 	= array('IN', $pids );
			$agents = $model_user -> queryRecordAll( $map_agent );
		}
		
		foreach ($list['data'] as &$vo1){
			$agent			= list_search($agents, array('id' => $vo1['pid']));
			$vo1['agent'] =$agent[0];

			// 获取当前子用户的资金情况
			$funds = $model_funds -> getFunsinfo( $vo1['id']);
			$vo1['funds'] = $funds;
			
			// 获取该用户的全部站点信息
			if( $usertype == 'operation' || $usertype == 'admin'){
				$map_site['createuserid'] = $vo1['id'];
				$map_site['status'] = 1;
				$vo1['site'] = $model_site -> queryRecordAll( $map_site );
			
				// 判断当前用户是否能删除，判断资金池是否为空，并且没有站点
				if( count( $vo1['site'] ) == 0 ){
					// 获取该子用户是否有资金池记录
					if( !$funds ){
						$vo1['is_can_delete'] = 1;
					}
				}
			}
		}
		
		return $list;
	}
	
	/**
	 * 获取子代理户商用户信息列表
	 */
	function getSubAgentUserList( $map, $fields, $order, $pageparam , $num_per_page, $usertype ){
	
		// 实例化代理商用户模型
		$model_user 	= D('User/User');
		// 资金账户模型
		$model_funds = D('Biz/Funds');
		// 站点模型
		$model_site = D('Biz/Site');
	
		$map['usertype'] 	= 'agent2';
	
		if( !$map['pid'] && $usertype != 'operation'){
			$map['pid'] 		= $this -> getLoginUserId();
		}
	
		// 获取一级代理商用户
		$list 	= $model_user -> queryRecordEx( $map, $fields, $order, $pageparam, $num_per_page );
	
		// 获取子用户的全部上级代理商
		foreach ($list['data'] as $vo){
			$pids[] = $vo['pid'];
		}
		$pids = array_unique( $pids );
		if( $pids ){
			$map_agent['id'] 	= array('IN', $pids );
			$agents = $model_user -> queryRecordAll( $map_agent );
		}
	
		foreach ($list['data'] as &$vo1){
			$agent			= list_search($agents, array('id' => $vo1['pid']));
			$vo1['agent'] =$agent[0];
			// 获取当前子用户的资金情况
			$funds = $model_funds -> getFunsinfo( $vo1['id']);
			$vo1['funds'] = $funds;
				
			// 获取该用户的全部站点信息
			if( $usertype == 'operation' || $usertype == 'admin'){
				$map_site['createuserid'] = $vo1['id'];
				$map_site['status'] = 1;
				$vo1['site'] = $model_site -> queryRecordAll( $map_site );
					
				// 判断当前用户是否能删除，判断资金池是否为空，并且没有站点
				if( count( $vo1['site'] ) == 0 ){
					// 获取该子用户是否有资金池记录
					if( !$funds ){
						$vo1['is_can_delete'] = 1;
					}
				}
			}
		}
		return $list;
	}
	
	/**
	 * 为代理商用户开启OEM功能
	 */
	function openOEM( $userid ){
	
		$model 	= D('User/User');

		$data['id'] 		= $userid;
		$data['isopen_oem'] = 1;
		$result = $model -> update( $data );
		return $result;
	}
	
	/**
	 * 为代理商用户关闭OEM功能
	 */
	function closeOEM( $userid ){
	
		$model 	= D('User/User');
	
		$data['id'] 		= $userid;
		$data['isopen_oem'] = 0;
		$result = $model -> update( $data );
		return $result;
	}
	
	/**
	 * 为代理商用户开启二级代理功能
	 */
	function openSubAgent( $userid ){
	
		$model 	= D('User/User');
	
		$data['id'] 		= $userid;
		$data['isopen_subagent'] = 1;
		$result = $model -> update( $data );
		return $result;
	}
	
	/**
	 * 为代理商用户关闭二级代理功能
	 */
	function closeSubAgent( $userid ){
	
		$model 	= D('User/User');
	
		$data['id'] 		= $userid;
		$data['isopen_subagent'] = 0;
		$result = $model -> update( $data );
		return $result;
	}
	
// 	/**
// 	 * 增加服务商商用户信息
// 	 */
// 	function addServerUser( $postData ){
// 		$model 	= D('User/ServerUser');
// 		$data 	= $postData;
// 		$result = $model -> insert( $data );
// 		return $result;
// 	}
	
// 	/**
// 	 * 删除代理商用户信息
// 	 */
// 	function delServerUser( $id ){
// 		$model 	= D('User/ServerUser');
// 		$data 	= $postData;
// 		$result = $model -> deleteRecord( array('id' => $id ) );
// 		return $result;
// 	}
// 	/**
// 	 * 获取服务商用户信息列表
// 	 */
// 	function getServerUserList(){
	
// 		return $list;
// 	}
	
// 	/**
// 	 * 获取代理商用户信息列表
// 	 */
// 	function getServerUserDetail( $id ){
	
// 		// 实例化服务用户模型
// 		$modelServerUser 	= D('User/ServerUser');
// 		// 获取一级代理商用户
// 		$data 	= $modelServerUser -> selectOne( array('id' => $id ));
	
// 		return $data;
// 	}
	
	
	
	
}
	
?>