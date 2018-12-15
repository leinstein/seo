<?php

/**
 * 前台公共控制层类：用户管理
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Service
 * @version     20170423
 * @link        http://www.mitong.com
 */
class UserAction extends BaseAction {
	
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
		$this -> modelName = 'User/ServerUser';
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index(){
		
		//进入的时候需要对数据进行更新
		$modelFunds = D('Biz/Funds');
		$modelKeyword = D('Biz/Keyword');
		
		// 获取全部的站点数量
		$siteNum = D('Biz/Site') -> getMySitesNum();
		$this -> assign('siteNum' , $siteNum);
		
		// 获取已购买关键词数量
		$purchasedKeywordNum = $modelKeyword -> getPurchasedKeywordNum();
		$this -> assign('purchasedKeywordNum' , $purchasedKeywordNum);
		
		// 获取达标关键词数数量
		$stankeywordNum = $modelKeyword -> getStandardsNum();
		$this -> assign('stankeywordNum' , $stankeywordNum);
		
		// 获取达标扣费
		$standardsFee = $modelKeyword -> getStandardsFee();
		$this -> assign('standardsFee' , $standardsFee);
		
		// 获取累计消费
		$totalAmount = D('Biz/Site') -> getMySitesNum();
		$this -> assign('totalAmount' , $totalAmount);
		
		//账号余额
		$funs_info = $modelFunds -> getFunsinfo();
		$this -> assign('funs_info' , $funs_info );
		
		
		$this->display();
	}
	
	/**
	 * 显示登录页面
	 * @accesspublic
	 */
	public function login(){
		$this->display();
	}
	
	/**
	 * 显示修改用户页面
	 * @accesspublic
	 */
	public function updatePage(){
		// 初始化用户模型
		$model = D ( $this -> modelName );
		
		$data = $model -> selectOne( array('id' => $this-> loginUserId) );
		$page['data'] = $data;
		$this -> assign($page);
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );
	}
	
	/**
	 * 修改用户
	 * @accesspublic
	 */
	public function update(){
		// 初始化用户模型
		$model = D ( $this -> modelName );
	
		$result = $model -> updateUserinfo( $_POST );
	
		if ( $result ) {
			$this->success ( '用户信息修改成功！', U ( 'updatePage' ) );
		} else {
			$this->error ( '用户信息修改失败！'.$model -> getError()  );
		}
	}
	
	/**
	 * 显示修改用户密码页面
	 * @accesspublic
	 */
	public function updatePasswordPage(){
	
		$me = $this-> loginUserInfo;
		$this -> assign('userpass_old', $me['userpass']);
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );
	}
	
	/**
	 * 修改用户密码
	 * @accesspublic
	 */
	public function updatePassword(){
		// 初始化用户模型
		$model = D ( $this -> modelName );
	
		$result = $model -> updatePassword( $_POST );
	
		if ( $result ) {
			$this->success ( '用户密码修改成功！', U ( 'updatePage' ) ,false, true);
		} else {
			$this->error ( '用户密码修改失败！'.$model -> getError() );
		}
	} 

	
}