<?php

/**
 * 附件上传操作控制层基类类
 *
 * @copyright   Copyright 2010-2011 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action
 * @version     20150618
 * @type		project
 * @link        http://www.mitong.com
 */
class UploadAction extends BaseUploadAction {
	
	
	// 公共函数，不接受权限检查
	public $public_functions = array ('*');
	/**
	 * 初始化函数
	 *
	 * @access public
	 */
	public function _initialize() {
		
		// 继承
		parent::_initialize ();
		
	}
	
}