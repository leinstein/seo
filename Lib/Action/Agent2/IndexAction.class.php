<?php

/**
 * 前台公共控制层类
 *
 * @category   业务控制类
 * @copyright   Copyright 2016-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Home
 * @version     20170410
 * @link        http://www.mitong.com
 */
class IndexAction extends BaseAction {
	
	/*
	 * 公共函数，不接受权限检查，写法 array('index');
	 */
	public $public_functions = array ( 'logOut'  );
	
	/**
	 * 初始化函数
	 *
	 * @return void
	 */
	public function _initialize() {
		
		// 将当前的路径存入session
		$_SESSION['GROUP_NAME'] = GROUP_NAME;
		$_SESSION['GROUP'] = __GROUP__;
		
		// 继承
		parent::_initialize ();
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index() {
		// 实例化统计模型
		$model = D('Biz/Statistics');
		
		// 获取该用户下面的全部客户信息
		$users =  $model -> getUsers( );
				
		// 获取用户id
		$userids 	= $users['userids'];
		// 获取用户所在企业id
		$epids 		= $users['epids'];
		
		// 获取首页的统计
		$page = $model -> getOptimize( $userids );
			
		$this -> assign( $page );
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );	
	}

	/**
	 * 登出系统
	 *
	 * @access public
	 */
	public function logOut() {
		// 初始化用户模型
		$user_model = D ( 'User/ServerUser' );
		//保存日志
		//清理用户session
		$user_model -> setUserSession( );
		//返回
		if( $_GET['returnUrl'] ){
			header("location:".$_GET['returnUrl'] );
		}else{
			//跳转到登录界面
			$this->redirect(  C("LOGIN_URL") . '?t='.time() );
		}
	}

}