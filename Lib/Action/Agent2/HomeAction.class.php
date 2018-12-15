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
class HomeAction extends BaseAction {
	
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
		$_SESSION['GROUP'] 		= __GROUP__;
		
		// 继承
		parent::_initialize ();
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function home() {
		
		
		// 实例化统计模型
		$model = D('Biz/Statistics');

		
		$modelFunds = D('Biz/Funds') ;
		
		// 获取该用户下面的全部客户信息
		$users =  $model -> getUsers( );
		
		// 获取用户id
		$userids 	= $users['userids'];
		// 获取用户所在企业id
		$epids 		= $users['epids'];

		// 获取系统产品
		$products = $model -> getProducts( $epids );
		
		foreach ($products as $key => &$value) {

			// 获取进入的达标消费，包含全的产品消耗
			$today_consumption = $model -> getConsumptionToday( $userids, $value['id']);
			
			$value['today_consumptions'] = $today_consumption ;
		}
		
		$page['products'] 	= $products;
		
		// 获取会员数量
		$members 	= $model  -> getMembers( $userids );
		
		$page['members'] 	= $members;
		
		$funds_balance = $modelFunds -> getAgentFundsBalance();
		if( $this -> isMobile ){
			$funds_balance = array_slice( $funds_balance, 3 );
		}
		foreach ($funds_balance as $vo){
			$days[] 	= $vo['day'];
			$date[] 	= substr($vo['day'],5);
			$balances[] = $vo['balance'];
		}
		$page['days'] = json_encode($days) ;
		$page['date'] = json_encode($date) ;
		$page['balances'] = json_encode($balances) ;
		
		// 获取系统的新闻通知
		$me = $this -> loginUserInfo;
		// 如果该子用户的代理商已经开通了OEM权限
		
		if( $me['oem_config']['id']){
			$page['news'] = D('Biz/News') -> getListByAgentuser( $me['pid'], 10);
		}else{
			$page['news'] = D('Biz/News') -> getListByOperationuser( 10);
		}
		
		$this -> assign($page);
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		
		$this->display ( $tpl );
	}
	
	/**
	 * 跳转到会员界面
	 */
	function member(){
		switch ( $_GET['usertype'] ) {
			case 'sub':
				$this-> redirect('UserManagement/sub_user_list');
			break;
			case 'agent2':
				$this-> redirect('UserManagement/sub_agent_list');
				break;
			
			default:
				;
			break;
		}
	}
	
}