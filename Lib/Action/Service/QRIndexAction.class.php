<?php

/**
 * 前台公共控制层类
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Service
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

		
		$this -> assign($page);
		
		// 获取系统的新闻通知
	
		
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );
	}
	
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index2() {
	
	
		//进入的时候需要对数据进行更新
		$modelFunds = D('Biz/Funds');
		$modelKeyword = D('Biz/Keyword');
	
		// 获取全部的站点数量
		$siteNum = D('Biz/Site') -> getMySitesNum();
		$page['siteNum'] = $siteNum;
	
		// 获取已购买关键词数量
		$purchasedKeywordNum = $modelKeyword -> getPurchasedKeywordNum();
		$page['purchasedKeywordNum'] = $purchasedKeywordNum;
	
		// 获取达标关键词数数量
		$stankeywordNum = $modelKeyword -> getStandardsNum();
		$page['stankeywordNum'] = $stankeywordNum;
	
		// 获取达标扣费
		$standardsFee = $modelKeyword -> getStandardsFee();
		$page['standardsFee'] = $standardsFee;
	
		// 获取累计消费
		$totalAmount = D('Biz/Site') -> getMySitesNum();
		$page['totalAmount'] = $totalAmount;
	
		//账号余额
		$funs_info = $modelFunds -> getFunsinfo();
		$page['funs_info'] = $funs_info;
		// 获取系统的新闻通知
		$me = $this -> loginUserInfo;
		// 如果该子用户的代理商已经开通了OEM权限
		if( $me['oem_config']['id'] ){
			$page['news'] = D('Biz/News') -> getListByAgentuser( $me['pid'], 10);
		}else{
			$page['news'] = D('Biz/News') -> getListByOperationuser( 10);
		}
	
	
		$this -> assign($page);
		$this->display ();
	}
	
	
}