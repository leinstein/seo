<?php

/**
 * 模型层：用户信息模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20141010
 * @link        http://www.qisobao.com
 */

class UserModel extends BaseModel{
	
	/**
	 * 用户表名称
	 */
	protected $trueTableName = 'ts_user'; 
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
		
		//按照配置重写设置session变量名
		$this ->login_userid_session 	= C('SESSION_PREFIX') .'LoginUserId';
		$this ->login_username_session 	= C('SESSION_PREFIX') .'LoginUserName';
		
		//不能覆盖用户信息的session，由于当从资金系统跳转到本系统时候，会将资金系统的用户登录信息覆盖，使得资金系统相关权限丢失
		//$this ->login_userinfo_session 	= C('SESSION_PREFIX') .'LoginUserInfo';
		
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
	
	/**
	 * 设置用户会话
	 *
	 * @return array 当前登录的用户信息
	 */
	public function setUserSession( $userid, $username, $userinfo ) {
		$_SESSION[$this->login_userid_session] = $userid;
		//$_SESSION[$this->login_username_session] 	=  $userid ;
		$_SESSION[$this->login_username_session] 	=  $username ;
		$_SESSION[$this->login_userinfo_session] = serialize($userinfo);
		return true;
	}
	
	/**
	 * 验证用户权限
	 *
	 * @return array 当前登录的用户信息
	 */
	public function checkUserRemote( $userid ) {
		
		//设置session
		$userinfo['useid'] = $userid;
		$userinfo['username'] = $userid;
		$userinfo['userlevel'] = 0; //默认用户级别
		$this->setUserSession($userid, $userid, $userinfo);
		
		//检查本地用户权限配置，如果存在本地用户，则取本地用户的配置
		$map['uname'] = $userid;
		$data_user = $this -> selectOne($map);
		if( $data_user ){
			$this->setUserSession($userid, $userid, $data_user);
			return $data_user;
		}else{
			return $userinfo;
		}
		
	}
	
	/**
	 * 本地验证用户权限
	 *
	 * @return array 当前登录的用户信息
	 */
	public function checkUserLocal( $username, $userpass ) {
		
		$map['uname'] = $username;
		$map['passwd'] = $userpass;
		$user_info = $this -> selectOne($map);		
		
		if( $user_info ){
			$this->setUserSession($user_info['id'],$user_info['uname'],$user_info); 
			return $user_info;
		}else 
			return false;
	}
	
}
	
?>