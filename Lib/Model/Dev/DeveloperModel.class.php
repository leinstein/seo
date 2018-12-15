<?php

/**
 * 模型层：用户信息模型类
 * 
 * @copyright   Copyright 2010-2014 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Model.Dev
 * @version     20141010
 * @link        http://www.dejax.cn
 */

class DeveloperModel extends BaseModel{

	/**
	 * 用户表名称
	 */
	protected $trueTableName = 'sys_user';
	/**
	 * 用户id的session名称
	 */
	protected $login_userid_session 		= 'LoginUserId';
	/**
	 * 用户名的session名称
	 */
	protected $login_username_session 	= 'LoginUserName';
	/**
	 * 用户信息的session名称
	 */
	protected $login_userinfo_session 	= 'LoginUserInfo';
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
	}
	
	
	/**
	 * 外部接口：获得当前登录的用户编号
	 *
	 * @return string 当前登录的用户编号
	 */
	public function getLoginUserId( ) {
		return $_SESSION[$this->login_userid_session];
	}
	
	/**
	 * 外部接口：获得当前登录的用户名
	 *
	 * @return string 当前登录的用户名
	 */
	public function getLoginUserName( ) {
		return $_SESSION[$this->login_username_session] ;
	}
	
	/**
	 * 外部接口：获得当前登录的用户信息
	 *
	 * @return array 当前登录的用户信息
	 */
	public function getLoginUserInfo( ) {
		$userInfo = unserialize($_SESSION[$this->login_userinfo_session]);
		return $userInfo;
	}
}
	
?>