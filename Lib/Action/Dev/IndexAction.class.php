<?php

/**
 * 前台公共控制层类
 *
 * @copyright   Copyright 2010-2014 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Action.Dev
 * @version     20141010
 * @type		project
 * @link        http://www.dejax.cn
 */

class IndexAction extends BaseAction {
	
	//公共函数，不接受权限检查，写法 array('index');
	public $public_functions = array();
	
	/**
	 * 初始化函数
	 * @access public
	 */
	public function _initialize() {
		//继承
		parent::_initialize();
		
	}
}