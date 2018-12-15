<?php

/**
 * 前台公共控制层类
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Manage
 * @version     20141010
 * @link        http://www.mitong.com
 */

class StaffAction extends BaseAction {
	
	/*
	 * 公共函数，不接受权限检查，写法 array('index');
	 */
	public $public_functions = array();
	
	/**
	 * 初始化函数
	 * 
	 * @return void
	 */
	public function _initialize() {
		//继承
		parent::_initialize();
		// 初始化用户模型
		$this -> modelName = 'User/Staff';
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index(){
		
		$model 		= D( $this->modelName);
		
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
		
		// 用户类型
		if($querytools->paramExist('usertype')){
			//拼接exp条件
			$exp = array('eq', $_GET['usertype']);
			$querytools ->addParam('usertype','usertype',$exp);
		}
	
		//组合查询条件
		$query_params = 'username,truename,usertype,num_per_page';
		$this->assign('query_params', combo_url_param($query_params));
		$page['query_params'] = combo_url_param($query_params);
		
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('id desc');
		
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['status'] = 1;
		
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getStaffList( $map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page'] );
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
		
		// 获取管理端用户的角色
		$page['userrole_options'] =  D( 'User/UserRole' ) ->  getManageRoleCodeset();
		
		$this -> assign( $page );
		
		$this->display();
	}
	
	
	/**
	 * 进入新增用户界面
	 *
	 * 根据不同的用户类型进入不同的新增界面，一级代理商用户、子用户
	 * @accesspublic
	 */
	public function insertPage( ){
	
		
		// 获取管理端用户的角色
		$page['userrole_options'] =  D( 'User/UserRole' ) ->  getManageRoleCodeset();
		
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
	
		$result = $model -> insert( $_POST );
	
		if( $result){
			$this->success ( '添加用戶成功！', U ( 'index'), false, true);
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
	 * 删除用户信息
	 */
	function deleteRecord( $id ){
		$model = D( $this-> modelName );
		$result = $model -> delete( $id );
		if( $result){
			$this->success ( '删除用戶成功', U ( 'index'));
		}else{
			$this->error ( '删除用戶失败'. $model -> getError()  );
		}
	}
	
	
	
}