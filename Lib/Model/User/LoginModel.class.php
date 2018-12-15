<?php

/**
 * 模型层：用户信息模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20141010
 * @link        http://www.qisobao.com
 */

class LoginModel extends BaseModel{
	
	/**
	 * 用户表名称
	 */
	protected $trueTableName = 'ts_sys_login'; 
	
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		
		//执行父类构造函数
		parent::_initialize();
	
		
	}
	
	
	
	/**
	 * 本地验证用户权限
	 *
	 * @return array 当前登录的用户信息
	 */
	public function addRecord( $user_info ) {
		$data['userid'] 		= $user_info['id'];
		$data['username'] 		= $user_info['username'];
		$data['usertype']  		= $user_info['usertype'];
		$data['loginstatus'] 	= '已登录';
		$data['loginuserid'] 	= $user_info['id'];
		$data['usergroup'] 		= GROUP_NAME; 
		// 获取IP地址
		$IPaddress 				= getIP();
		$data['IPaddress'] 		= $IPaddress;
		// 获取城市地址
		$city 					= getCity($IPaddress);
		$province 				= $city['province'];
		if( $city['province'] == '北京' || $city['province'] == '上海' || $city['province'] == '天津' || $city['province'] == '重庆'){
			$province = '';
		}
		$data['city'] 			= $province.$city['city'] ;
		$data['logintime'] 		= date('Y-m-d H:i:s');

		$result = $this -> insert($data);
		if( $result ) {
			return $data;
		}else{
			return false;
		}	
	}
	
	/**
	 * 注销后将用户的登录信息进行修改
	 */
	function doAfterlogOut( $userid ){
		$map['userid'] = $userid;
		$map['status'] = 1;
		$map['loginstatus'] = '已登录';
		$data = $this -> where( $map ) -> field('id') ->  order('regtime desc') -> find( $data );
		$data['loginstatus'] 		= '已注销';
		$data['logouttime'] 		= date('Y-m-d H:i:s'); 
		return $this -> update( $data );
	}
	
	/**
	 * 
	 */
	function isLoggedin( $userid ){
		$map['userid'] = $userid;
		$map['status'] = 1;
		$map['loginstatus'] = '已登录';
		return $this -> selectOne( $map );
	}
	
}
	
?>