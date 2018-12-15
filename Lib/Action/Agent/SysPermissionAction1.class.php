<?php

/**
 * 前台公共控制层类
 *
 * @category   业务控制类：系统权限配置管理控制类
 * @copyright   Copyright 2016-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Agent
 * @version     20170410
 * @link        http://www.mitong.com
 */
class SysPermissionAction extends BaseAction {
	
	/*
	 * 公共函数，不接受权限检查，写法 array('index');
	 */
	public $public_functions = array (  );
	
	/**
	 * 初始化函数
	 *
	 * @return void
	 */
	public function _initialize() {
		// 继承
		parent::_initialize ();
		
		$this->modelName = "Sys/SysPermission";
	}
	
	
	
	/**
	 *	获取部门
	 */
	public function department() {
		// 初始化用户模型
		$model = D ($this->modelName);
	
		// 获取当前代理商的系统配置
		$page['list'] = $model -> getDepartment();
		
		$this -> assign($page);
		$this->display ();
	}
	/**
	 *	获取全部角色
	 */
	public function role() {
		// 初始化用户模型
		$model = D ($this->modelName);
	
		// 获取当前代理商的系统配置
		$page['list'] = $model -> getRole();
	
		$this -> assign($page);
		$this->display ();
	}
	
	
	function staff(){
		// 初始化用户模型
		$model = D ($this->modelName);
		//引入查询工具类
		import('ORG.Util.QueryTools');
		
		//实例化联合查询工具类
		$querytools = new QueryTools();
		
		// 用户登录名
		if($querytools->paramExist('username')){
		
			//拼接exp条件
			$exp = array('like', '%'.$_GET['username'].'%');
			$querytools ->addParam('username','username',$exp);
		}
		
		// 用户姓名
		if($querytools->paramExist('truename')){
			//拼接exp条件
			$exp = array('like', '%'.$_GET['truename'].'%');
			$querytools ->addParam('truename','truename',$exp);
		}
		
		// 部门
		if($querytools->paramExist('departno')){
			//拼接exp条件
			$exp = array('eq', $_GET['departno']);
			$querytools ->addParam('departno','departno',$exp);
		}
		
		// 角色
		if($querytools->paramExist('roleno')){
			//拼接exp条件
			$exp = array('eq', $_GET['roleno']);
			$querytools ->addParam('roleno','roleno',$exp);
		}
		
		// 用户状态
		if($querytools->paramExist('userstatus')){
			//拼接exp条件
			$exp = array('eq', $_GET['userstatus']);
			$querytools ->addParam('userstatus','userstatus',$exp);
		}
		 
		//组合查询条件
		$query_params = 'username,departno,roleno,userstatus,num_per_page';
		$this->assign('query_params', combo_url_param($query_params));
		$page['query_params'] = combo_url_param($query_params);
		
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('pid,regtime desc');
		
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['usergroup'] 		= GROUP_NAME;
		$map['epid'] 			=  $this->loginEpid;
		$map['usertype'] 		=  array('NEQ','agent');
		
		$map['status'] = 1;
		
		// 判断当前登录用户的类型
		switch ($this -> loginUserType) {
			case 'customer_manager':
			case 'personnel_manager':
			case 'operation_manager':
			case 'develop_manager':
			case 'sales_manager':
				$map['pid'] 			=  $this-> loginUserId;
			break;
			
			default:
				;
			break;
		}
		
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getStaffs( $map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page'] );
		
		//dump($model-> _sql());exit;
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
		
// 		// 获取管理端用户的角色
// 		$model_role = D( 'Sys/UserRole' );
// 		$page['userrole_options'] =  $model_role ->  getManageRoleCodeset( );
 		
// 		// 获取当前用户的下级角色
// 		$me = $this-> loginUserInfo;
// 		$page['userrole'] =  $model_role -> selectOne( array('pid' => $me['role_info']['id']));
	
		$this -> assign( $page );
		$this -> display();
	}
	
	/**
	 * 根据部门的编号来获取部门的全部角色
	 */
	function getRoleCodeset(){
		$model = D('Sys/UserRole');
		$codeset = $model -> getCodeSetByDepart( $_GET['departno'] );
		exit(json_encode($codeset));
	}
	
	/**
	 * 首页
	 * @accesspublic
	 * 新增OEM配置：
	 * 	客户登录界面背景logo,
	 * 	后台logo修改，
	 * 	客服联系方式，
	 * 	用户协议（添加后设置代理端可自助修改）
	 */
	public function index() {
		// 初始化用户模型
		
		$this->display ();
	}
	
	
	
	
	/**
	 * 进入新增用户界面
	 *
	 * 根据不同的用户类型进入不同的新增界面，一级代理商用户、子用户
	 * @accesspublic
	 */
	public function insertStaffPage( ){
		$model = D( $this-> modelName );
		
		

		// 根据用户的类型来进行不同的操作
		switch ($this -> loginUserType) {
			case 'agent':
				
				// 获取全部的用户类型
				$usertypeOptions = $model ->  getCodeSetByGroup();
				$data['usertypeOptions'] = $usertypeOptions;
				
				// 获取全部的上级用户
				if( $_GET['rolelevel']  > 1   ){
				//	$data['users']= $model ->  getParentUsers( $_GET['rolecode'] );
				}
				break;
			case 'customer_manager':
				break;
			case 'personnel_manager':
				break;
			case 'operation_manager':
				break;
			case 'develop_manager':
				break;
			case 'sales_manager':
				$data['usertype'] = 'seller';
				$data['usertype_desc'] = '销售员';
				break;
			default:
				$data['usertype'] = $_GET['rolecode'];
				$data['pid'] =  $this -> loginUserId;
				
				// 获取全部的上级用户
				if( $_GET['rolelevel']  > 1   ){
					$data['users']= $model ->  getParentUsers( $_GET['rolecode'] );
				}
				break;
		}
		
		$data['pid'] =  $this -> loginUserId;
		$data['pusername'] =  $this -> loginUserName;

		// 获取当我登录的用户的企业名称
		$me = $this -> loginUserInfo;
		$data['me_type'] = $me['usertype'];
		$data['epname'] = $me['epname'];
		$page['data'] =  $data;
		$this -> assign( $page );
		$this->display ();
	}
	
	/**
	 * 新增用户
	 *
	 * 根据不同的用户类型调用不同的模型增加新的用户
	 * @accesspublic
	 */
	public function insertStaff( ){
		
		$model = D( $this-> modelName );
	
		$result = $model -> insertStaff( $_POST );
	
		if( $result){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '添加用戶成功！',$returnUrl,false,true);
			}else{
				$this->success ( '添加用戶成功！', U ( 'staff'),false,true);
			}
		}else{
			$this->error ( '添加用戶失败，原因'. $model -> getError() );
		}
	}
	
	/**
	 * 用户详情
	 *
	 * 根据不同的用户类型调用不同的模型用户详情
	 * @accesspublic
	 */
	public function updateStaffPage( ){
		
		$model = D( $this-> modelName );
		$page['data'] = $model -> getStaffDetail( $_GET['id'] );
		
		$this -> assign( $page );
		$this -> display();
	}
	
	/**
	 * 修改用户
	 *
	 * 根据不同的用户类型调用不同的模型增加新的用户
	 * @accesspublic
	 */
	public function updateStaff( ){
		
		$model = D( $this-> modelName );
	
		$result = $model -> updateStaff( $_POST );
	
		if( $result){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '修改用戶成功',$returnUrl,false,true);
			}else{
				$this->success ( '修改用戶成功', U ( 'staff'),false,true);
			}
		}else{
			$this->error ( '修改用戶失败，原因'. $model -> getError()  );
		}
	}
	
	/**
	 * 用户详情
	 *
	 * 根据不同的用户类型调用不同的模型用户详情
	 * @accesspublic
	 */
	public function staff_detail( ){
		
		$model = D( $this-> modelName );
	
		$page['data'] = $model -> getStaffDetail( $_GET['id'] );
	
		$this -> assign( $page );
	
		$this -> display();
	}
	

	
	/**
	 * 为员工分配客户界面
	 *
	 * 根据不同的角色为员工分配客户
	 * 1、当前的员工是2级角色，比如是销售，或者客服之类的，那么需要要获取该销售
	 * @accesspublic
	 */
	public function assignCustomerPage( ){
		
		$model = D( $this-> modelName );
		$list = $model -> getCustomers( $_GET['id'],$_GET['usertype']);
		
	//	dump($list);exit;
		$page['list'] = $list;
		$page['nodes'] = json_encode($list);
		$this -> assign( $page );
		$this -> display();
	}

	/**
	 * 为销售用户分配客户
	 *
	 * 根据不同的用户类型调用不同的模型增加新的用户
	 * @accesspublic
	 */
	public function assignCustomer( ){
	
		$model = D( $this-> modelName );
		$result = $model -> assignCustomer( $_POST );
	
		if( $result){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '分配客户成功',$returnUrl,false,true);
			}else{
				$this->success ( '分配客户成功', U ( 'staff'),false,true);
			}
		}else{
			$this->error ( '分配客户失败，原因'. $model -> getError()  );
		}
	}
	
	
	/**
	 * 用户详情
	 *
	 * 根据不同的用户类型调用不同的模型用户详情
	 * @accesspublic
	 */
	public function detail( ){
		$model = D( $this-> modelName );
	
		$page['data'] = $model -> detail( $_GET['id'] );
	
		$this -> assign( $page );
	
		$this -> display();
	}
	
	
	/**
	 * 用户详情
	 *
	 * 根据不同的用户类型调用不同的模型用户详情
	 * @accesspublic
	 */
	public function updatePage( ){
		$model = D( $this-> modelName );
	
		$page['data'] = $model -> detail( $_GET['id'] );
		// 获取管理端用户的角色
		$page['userrole_options'] =  D( 'User/UserRole' ) ->  getManageRoleCodeset();
	
		$this -> assign( $page );
		$this -> display();
	}
	
	/**
	 * 修改用户
	 *
	 * 根据不同的用户类型调用不同的模型增加新的用户
	 * @accesspublic
	 */
	public function update( ){
		$model = D( $this-> modelName );

		$result = $model -> update( $_POST );
	
		if( $result){
			$this->success ( '修改用戶成功', U ( 'index'), false, true);
		}else{
			$this->error ( '修改用戶失败，原因'. $model -> getError()  );
		}
	}
	
	/**
	 * 注销用户
	 */
	function cancelRecord(){
		
		$model = D( $this-> modelName );
		$result = $model -> cancelRecord( $_GET['id'] );
		
		if( $result){
			$returnUrl = $_GET['returnUrl'];
			if( $returnUrl ){
				$this->success ( '修改成功',$returnUrl,false,true);
			}else{
				$this->success ( '修改成功', U ( 'staff'),false,true);
			}
		}else{
			$this->error ( '修改失败，原因'. $model -> getError()  );
		}
	}
	
	/**
	 * 获取当前企业的全部销售经理
	 */
	function get_seller_managers(){
		$model = D( $this-> modelName );
		$codeset = $model -> get_sales_managers();
		exit(json_encode($codeset));
	}
	
	/**
	 * 获取当前企业的全部销售经理
	 */
	function get_customer_managers(){
		$model = D( $this-> modelName );
		$codeset = $model -> get_customer_managers();
		exit(json_encode($codeset));
	}
	
}