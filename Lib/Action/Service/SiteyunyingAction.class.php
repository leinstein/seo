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
class SiteyunyingAction extends BaseAction {
	
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
		$this->success ( '努力调试中，再等等哦^^', U ( 'Index/index' ) );
		//echo "努力调试中，再等等哦^^";
	}
	
	
}