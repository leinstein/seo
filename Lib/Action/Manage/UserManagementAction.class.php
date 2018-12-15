<?php

/**
 * 前台公共控制层类:用户管理控制类
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Manage
 * @version     20141010
 * @link        http://www.mitong.com
 */
class UserManagementAction extends BaseAction {
	
	/*
	 * 公共函数，不接受权限检查，写法 array('index');
	 */
	public $public_functions = array ();
	
	/**
	 * 初始化函数
	 *
	 * @return void
	 */
	public function _initialize() {
		// 继承
		parent::_initialize ();
		
		$this->modelName = "Biz/UserManagement";
	}
	
	/**
	 * 首页
	 * 代理商用户列表
	 * @accesspublic
	 */
	public function index() {
		
		$model = D( $this-> modelName );
		
		//引入查询工具类
		import('ORG.Util.QueryTools');
		
		//实例化联合查询工具类
		$querytools = new QueryTools();
		
		// 查询用户名
		if($querytools->paramExist('username')){
		
			//拼接exp条件
			$exp = array('like', '%'.$_GET['username'].'%');
			$querytools ->addParam('username','username',$exp);
		}
		
		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');
		
		//组合查询条件
		$query_params = 'username';
		$this->assign('query_params', combo_url_param($query_params));
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('id desc');
		
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['status'] = 1;
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getAgentUserList($map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page'] );
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
		
		// 获取总代理商用户数量
		$total_num = $model-> getTotalAgentNum();
		$page['total_num'] = $total_num;
		
		// 获取有效用户数量
		$active_num = $model-> getActiveAgentNum();
		$page['active_num'] = $active_num;
		
		// 获取无线用户数量
		$invalid_num = $model-> getInvalidAgentNum();
		$page['invalid_num'] = $invalid_num;
		
		// 获取资金池低于10000 的用户
		//$pool_less10000 	= $model-> getPoolLess10000();
		//$page['pool_less10000'] = $pool_less10000;
		
		// 获取资金池大于于10000 的用户
		$pool_gt10000 	= $model-> getPoolGT10000();
		$page['pool_gt10000'] = $pool_gt10000;
		$page['pool_less10000'] = $active_num - $pool_gt10000;
		//传值到模板显示
		$this -> assign($page);
		$this->display (  );
		
	}
	
	/**
	 * 首页
	 * 代理商用户列表
	 * @accesspublic
	 */
	public function agent_list() {
	
		$model = D( $this-> modelName );
	
		//引入查询工具类
		import('ORG.Util.QueryTools');
	
		//实例化联合查询工具类
		$querytools = new QueryTools();
	
		// 查询用户名
		if($querytools->paramExist('username')){
	
			//拼接exp条件
			$exp = array('like', '%'.$_GET['username'].'%');
			$querytools ->addParam('username','username',$exp);
		}
	
		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');
	
		//组合查询条件
		$query_params = 'username';
		$this->assign('query_params', combo_url_param($query_params));
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('id desc');
	
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['status'] = 1;
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getAgentUserList($map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page'] );
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
	
		// 获取总代理商用户数量
		$total_num = $model-> getTotalAgentNum();
		$page['total_num'] = $total_num;
	
		// 获取有效用户数量
		$active_num = $model-> getActiveAgentNum();
		$page['active_num'] = $active_num;
	
		// 获取无线用户数量
		$invalid_num = $model-> getInvalidAgentNum();
		$page['invalid_num'] = $invalid_num;
	
		// 获取资金池低于10000 的用户
		//$pool_less10000 	= $model-> getPoolLess10000();
		//$page['pool_less10000'] = $pool_less10000;
	
		// 获取资金池大于于10000 的用户
		$pool_gt10000 	= $model-> getPoolGT10000();
		$page['pool_gt10000'] = $pool_gt10000;
		$page['pool_less10000'] = $active_num - $pool_gt10000;
		
		//传值到模板显示
		$this -> assign($page);
		$this->display (  );
	
	}
	
	/**
	 * 查看子用户列表界面
	 * 
	 * @accesspublic
	 */
	public function sub_user_list( ){
	
		$model = D( $this-> modelName );
	
		//引入查询工具类
		import('ORG.Util.QueryTools');
	
		//实例化联合查询工具类
		$querytools = new QueryTools();
	
		// 查询用户名
		if($querytools->paramExist('username')){
	
			//拼接exp条件
			$exp = array('like', '%'.$_GET['username'].'%');
			$querytools ->addParam('username','username',$exp);
		}
	
		// 查询用户名
		if($querytools->paramExist('pid')){
		
			//拼接exp条件
			$exp = array('EQ', $_GET['pid']);
			$querytools ->addParam('pid','pid',$exp);
		}
		
		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');
	
		//组合查询条件
		$query_params = 'username,pid';
		$this->assign('query_params', combo_url_param($query_params));
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('regtime desc,pid desc');
	
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['status'] = 1;
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getSubUserList($map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page'] ,'operation' );
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
		
		$users_less = $_SESSION['users_less'] ;
		//dump( $_SESSION['users_less'] );exit;
		
		$page['users_less'] = $users_less;
	
		//传值到模板显示
		$this -> assign($page);
	
		$this->display (  );
	}
	
	/**
	 * 查看子用户列表界面
	 *
	 * @accesspublic
	 */
	public function sub_agent_list( ){
	
		$model = D( $this-> modelName );
	
		//引入查询工具类
		import('ORG.Util.QueryTools');
	
		//实例化联合查询工具类
		$querytools = new QueryTools();
	
		// 查询用户名
		if($querytools->paramExist('username')){
	
			//拼接exp条件
			$exp = array('like', '%'.$_GET['username'].'%');
			$querytools ->addParam('username','username',$exp);
		}
	
		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');
	
		//组合查询条件
		$query_params = 'username';
		$this->assign('query_params', combo_url_param($query_params));
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('id desc');
	
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['pid'] = $_GET['id'];
		$map['status'] = 1;
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getSubAgentUserList($map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page']  );
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
	
		//传值到模板显示
		$this -> assign($page);
	
		$this->display (  );
	}
	
	
	/**
	 * 进入新增用户界面
	 * 
	 * 根据不同的用户类型进入不同的新增界面，一级代理商用户、子用户
	 * @accesspublic
	 */
	public function insertPage( ){
	
		$page['ProductTypeOptions'] = C('ProductTypeOptions');
		foreach ($page['ProductTypeOptions']  as $vo ){
			$product_strs .= $vo . ',';
		}

		$page['data']['product_desc'] = rtrim($product_strs, ','); ;

		$this -> assign( $page );
		$this->display ();
	}
	
	/**
	 * 新增用户
	 *
	 * 根据不同的用户类型调用不同的模型增加新的用户
	 * @accesspublic
	 */
	public function insert( ){
		$model = D( $this-> modelName );
		
// 		switch ( $_POST['type'] ) {
// 			case 'agent':
// 				$result = $model -> addAgentUser( $_POST );
// 			break;
// 			case 'server':
// 				$result = $model -> addServerUser( $_POST );
// 			default:
// 				;
// 			break;
// 		}


		$result = $model -> addUser( $_POST );
		
		if( $result){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '添加用戶成功！',$returnUrl,false,true);
			}else{
				$this->success ( '添加用戶成功！', U ( 'sub_user_list'), false, true);
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
	public function detail( ){
		$model = D( $this-> modelName );

		$page['data'] = $model -> detail( $_GET['id'] );

		// 开通产品类型
		$page['ProductTypeOptions'] = C('ProductTypeOptions');
		
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
	
		$data = $model -> detail( $_GET['id'] );
		// 获取当前的代理商用户id
		$pid  =  $data['pid'];
		
		// 获取上级用户的信息
		if( $pid ){
			
			$data_parent = $model -> detail( $pid );
			if( !$data['seller_id'] ){
				$data['seller_id'] = $data_parent['seller_id'];
			}
			if( !$data['operation_id'] ){
				$data['operation_id'] = $data_parent['operation_id'];
			}
			if( !$data['customer_id'] ){
				$data['customer_id'] = $data_parent['customer_id'];
			}
		}
		$page['data'] 			= $data;
		$page['pid'] = $pid;
		$page['data_parent'] 	= $data_parent;
		
		
		// 开通产品类型
		$page['ProductTypeOptions'] = C('ProductTypeOptions');
		
		
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
	
		$result = $model -> updateUser( $_REQUEST );
		
		if( $result){
			$returnUrl = $_REQUEST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '修改用戶成功！',$returnUrl,false,true);
			}else{
				$this->success ( '修改用戶成功！', U ( 'sub_user_list'), false, true);
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
	public function updatePasswordPage( ){
		$model = D( $this-> modelName );
	
		$data = $model -> detail( $_GET['id'] );
		// 获取当前的代理商用户id
		$this -> assign( 'pid', $data['pid'] );
	
		$this -> assign('data', $data );
		$this -> display();
	}
	
	
	/**
	 * 修改用户
	 *
	 * 根据不同的用户类型调用不同的模型增加新的用户
	 * @accesspublic
	 */
	public function updateUserPassword( ){
		$model = D( $this-> modelName );
	
		$result = $model -> updateAgentUserPassword( $_POST );
	
		if( $result){
			if( $_POST['type'] == 'sub' ){
				$level = 2;
			}
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '修改用戶密码成功！',$returnUrl,false,true,$level);
			}else{
				$this->success ( '修改用戶密码成功！', U ( 'sub_user_list'), false, true,$level);
			}
			
		}else{
			$this->error ( '修改用戶密码失败，原因'. $model -> getError()  );
		}
	}
	
	
	/**
	 * 删除代理商用户信息
	 */
	function deleteRecord(  ){
		$model = D( $this-> modelName );
		$result = $model -> deleteRecord($_GET['id'] );
		
		if( $result){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '删除用戶成功！',$returnUrl,false,true);
			}else{
				$this->success ( '删除用戶成功！', U ( 'subuser_list'), false, true);
			}
			
		}else{
			$this->error ( '删除用戶失败！' );
		}
	}
	
	/**
	 * 登录子用户账户，或者子代理账户
	 */
	function loginSubuser(){
		$model = D( $this-> modelName );
	
		$userinfo  = $model -> loginSubuser( $_GET['userid'] );
		//dump($userinfo['role_info']['rolegroup']);exit;
		if ($userinfo) {
			$this->success ( '登录成功！', U ( $userinfo['role_info']['rolegroup'] .'/Home/home' ) );
		} else {
			$this->error ( '用户名或者密码不正确！', U ( 'Service/Index/login' ) );
		}
	}
	
	
	/**
	 * 为代理商用户开启OEM功能
	 */
	function openOEM(){
		
		$model = D( $this-> modelName );
	
		$result = $model -> openOEM( $_GET['epid'] );
	
		if ($result) {
			$this->success ( 'OEM开启成功', U ( 'agent_list' ) );
		} else {
			$this->error ( 'OEM开启失败' );
		}
	}
	
	/**
	 * 为代理商用户关闭OEM功能
	 */
	function closeOEM(){
	
		$model = D( $this-> modelName );
	
		$result = $model -> closeOEM( $_GET['epid'] );
	
		if ($result) {
			$this->success ( 'OEM关闭成功', U ( 'agent_list' ) );
		} else {
			$this->error ( 'OEM关闭失败' );
		}
	}
	
	/**
	 * 为代理商用户开启二级代理功能
	 */
	function openSubAgent(){
	
		$model = D( $this-> modelName );
	
		$result = $model -> openSubAgent( $_GET['epid'] );
	
		if ($result) {
			$this->success ( '二级代理功能开启成功', U ( 'agent_list' ) );
		} else {
			$this->error ( '二级代理功能开启失败' );
		}
	}
	
	/**
	 * 为代理商用户关闭二级代理功能
	 */
	function closeSubAgent(){
	
		$model = D( $this-> modelName );
	
		$result = $model -> closeSubAgent( $_GET['epid'] );
	
		if ($result) {
			$this->success ( '二级代理功能关闭成功', U ( 'agent_list' ) );
		} else {
			$this->error ( '二级代理功能关闭失败' );
		}
	}
	
	/**
	 * 为代理商用户开启充值额度限制功能
	 */
	function openRechargeLimit(){
	
		$model = D( $this-> modelName );
	
		$result = $model -> openRechargeLimit( $_GET['epid'] );
	
		if ($result) {
			$this->success ( '操作成功', U ( 'agent_list' ) );
		} else {
			$this->error ( '操作失败' );
		}
	}
	
	/**
	 * 为代理商用户关闭充值额度限制功能
	 */
	function closeRechargeLimit(){
	
		$model = D( $this-> modelName );
	
		$result = $model -> closeRechargeLimit( $_GET['epid'] );
	
		if ($result) {
			$this->success ( '操作成功', U ( 'agent_list' ) );
		} else {
			$this->error ( '操作失败' );
		}
	}
	
	
}