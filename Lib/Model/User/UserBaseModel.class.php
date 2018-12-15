<?php

/**
 * 模型层：用户组模型类 
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20141010
 * @link        http://www.qisobao.com
 */

class UserBaseModel extends BaseModel{
	
	/**
	 * 用户id的session名称
	 */
	protected $login_userid_session 	= 'LoginUserId';
	/**
	 * 用户名的session名称
	 */
	protected $login_username_session 	= 'LoginUserName';
	/**
	 * 用户信息的session名称
	 */
	protected $login_userinfo_session 	= 'LoginUserInfo';
	
	/**
	 * 自动处理数据
	 */
	protected $__auto 		= array (
		array ('userno','create_guid',1,'function') , // 对userno字段在新增的时候调用create_guid
		array ('userpass','md5',1,'function',array('seo188')) , // 对userpass字段在新增的时候使md5函数处理
		array ('createuserid', 'getLoginUserId',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
		array ('createusername', 'getloginUserName',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
		array ('createtime','date',1,'function',array('Y-m-d H:i:s')), // 对createtime字
		array ('userstatus','正常'), // 新增的时候把userstatus字段设置为正常
	);

	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		
		//合并自动验证
		$this->setProperty("_validate", array_merge($this->_validate, $this->__validate));
		//合并自动完成
		$this->setProperty("_auto", array_merge($this->_auto, $this->__auto));
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
	
		$map['username'] 	= $username;
		$map['passwd'] 		= md5($userpass);
		$user_info = $this -> selectOne($map);
	
		//$user_info['usertype']  = 'server';
		if( $user_info ){
			//登录成功后写入登录日志
			$model = D('User/Login');
			//登录成功后判断当前用户是否已经登录
			$isLoggedin  = $model -> isLoggedin( $user_info['id'] );
			$user_info['isLoggedin'] = $isLoggedin;
			$log = $model -> addRecord( $user_info );
			$user_info["IPaddress"] = $log["IPaddress"];
			$user_info["city"] 		= $log["city"];
			$user_info["logintime"] = $log["logintime"];
				
			$this->setUserSession($user_info['id'],$user_info['username'],$user_info);
				
			return $user_info;
		}else
			return false;
	}
	/**
	 * 本地验证用户权限
	 *
	 * @return array 当前登录的用户信息
	 */
	public function update( $postData ) {
	
		$data = $postData;
		$me = $this->getLoginUserInfo();
		$map['id'] 	= $me['id'];
		$userpass = $postData['password'] ;
		//比较密码是否正确
		if( $userpass ){
				
			$userpass_old = $me['userpass'];
			if( md5($userpass) != $userpass_old){
				$this -> error ="您输入的原始密码不正确！";
				return false;
			}
				
			$data['userpass'] = md5( $postData['newpassword1'] );
		}
		$data['id'] = $me['id'];
		$result 	= parent:: update( $data );
	
		//重新获取用户信息
		$user_info = $this -> selectOne( array('id' => $me['id'] ));
	
		$this->setUserSession($user_info['id'],$user_info['username'],$user_info);
	
		return $result;
	}
	
	
	
}
	
?>