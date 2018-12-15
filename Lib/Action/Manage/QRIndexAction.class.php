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
class QRIndexAction extends BaseAction {
	
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
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index() {
		
		
		$model = D('QR/Statistics');
		
		// 获取首页的统计
		$page = $model -> getIndexStatistics();
		// 获取系统的新闻通知
		$me = $this -> loginUserInfo;
		// 如果该子用户的代理商已经开通了OEM权限

		$this -> assign($page);
		$this->display ();
	}
	
	
}