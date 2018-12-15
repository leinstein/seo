<?php

/**
 * 前台公共控制层类：系统首页
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Service
 * @version     20170702
 * @link        http://www.mitong.com
 */
class HomeAction extends BaseAction {
	
	/*
	 * 公共函数，不接受权限检查，写法 array('index');
	 */
	public $public_functions = array ( );
	
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
	public function home() {
		
		
		// 系统统计模型
		$model = D('Biz/Statistics');
		
		// 获取系统的新闻通知
		$me = $this -> loginUserInfo;

		// 获取该用户下面的全部客户信息
		$users =  $model -> getUsers( );
		
		// 获取用户id
		$userids 	= $users['userids'];
		// 获取用户所在企业id
		$epids 		= $users['epids'];
		// 获取系统产品
		$products = $model -> getProducts($epids);

		foreach ($products as $key => &$vo) {
			// 获取资金统计情况
			$vo['funds_pool'] = $model -> getFundsPool( $userids, $vo['id'] );

			
			// 获取优化中关键词总数量
			$vo['purchasedKeywordNum'] = $model -> getPurchasedKeywordNum( $userids, $vo['id'] );
			// 获取最新达标关键词数量
			$vo['stankeywordNum'] = $model -> getStandardKeywordNum( $userids, $vo['id'] );

			switch ($vo['id'] ) {
				case 1: // 优站宝产品
					// 获取站点的数量
					$vo['siteNum']  = $model -> getSiteNum( $userids , $vo['id']);
					
					break;

				case 2: // 快排宝
					$vo['planNum']  = $model -> getPlanNum( $userids , $vo['id']);
					break;
				
				default:
					# code...
					break;
			}
			
			// 获取最新达标关键词消费
			$vo['standardsFee'] = $model -> getTodayFee( $userids , $vo['id']); 

			// 获取最新达标关键词消费
			$vo['consumption'] = $model -> getConsumption( $userids , $vo['id']); 
			
			// 获取进入的达标消费，包含全的产品消耗
			$today_consumption = $model -> getConsumptionToday( $userids, $vo['id']);
			$vo['today_consumptions'] = $today_consumption ;
			
			// 关键词达标率
			$vo['rate']  = round(  $vo['stankeywordNum']  / $vo['purchasedKeywordNum'] ,2) * 100 ;
			
			// 登录成功后，如果是子用户需要获取用的剩余金额是否足够：剩余金额要大于7天的达标消费
			if( $me['usertype']  == 'sub'){
				$today_consumptions = $vo['today_consumptions'];
				$balancefunds 		= $vo['funds_pool']['balancefunds'];
				
				if( $balancefunds < 7 * $today_consumptions  ){
					$vo['hint'] =  '【'.$vo['product_name'].'】资金余额不足，请您及时续费';
					$hints[] = $vo['hint'];
					$page['show_hint'] = 1;
				}
				
			}
		}
		$page['products'] = $products;
		$page['hints'] = json_encode( $hints );
		
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
	
	function show_trips(){
		$this->display ();
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index() {

		/* $modelFunds 		= D('Biz/Funds');
		 $modelKeyword 		= D('Biz/Keyword');
		 $modelStandardfee 	= D('Biz/Standardfee') ;
		
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
		 $standardsFee = $modelStandardfee -> getTodayFeeForSubuser();
		 $this -> assign('standardsFee' , $standardsFee);
		
		
		 //账号余额
		 $funs_info = $modelFunds -> getFunsinfo();
		 $this -> assign('funs_info' , $funs_info );
		
		 //获取消费明细
		 // $consumerdetails = $modelKeyword -> getConsumerdetails();
		 //$consumerdetails = $modelStandardfee -> getAllConsumerdetails();
		
		 $consumerdetails = $modelStandardfee -> getConsdetailsForSub();
		
		
		 foreach ($consumerdetails as $vo){
		 $days[] = substr($vo['day'],5);
		
		 $consumptions[] =$vo['consumption'];
		 }
		
		 $this -> assign('days' , json_encode($days) );
		 $this -> assign('consumptions', json_encode($consumptions) );
		 */
		
		$model = D('Biz/Statistics');
		
		// 获取首页的统计
		$page = $model -> getIndexStatistics();
		
		$this -> assign( $page );
	
		$this->display ();
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
	
	/**
	 * 显示验证码
	 */
	Public function verify(){
		import('ORG.Util.Image');
		Image::buildImageVerify();
	}
	
	/**
	 * 显示验证码
	 */
	Public function checkVerifyCode(){
		if($_SESSION['verify'] != md5($_GET['verifycode'])) {
			$return['status'] = 0 ;
			$return['info'] = '验证码错误或者已经过期！';
		}else{
			$return['status'] = 1 ;
		}
		exit(json_encode($return));
	}
	
	
	
	/**
	 * 显示登录页面
	 * @accesspublic
	 */
	public function login() {
		
		// 获取当前的完整登录路径
		//获取域名或主机地址
		/* echo $_SERVER['HTTP_HOST']."<br>"; #localhost
		//获取网页地址
		echo $_SERVER['PHP_SELF']."<br>"; #/blog/testurl.php
		//获取网址参数
		echo $_SERVER["QUERY_STRING"]."<br>"; #id=5
		//获取用户代理
		echo $_SERVER['HTTP_REFERER']."<br>";
		//获取完整的url
		echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."<br>";
		echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']."<br>";
		#http://localhost/blog/testurl.php?id=5
		//包含端口号的完整url
		echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]."<br>";
		#http://localhost:80/blog/testurl.php?id=5
		//只取路径
		$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]."<br>";
		echo dirname($url); */
		#http://localhost/blog
		$url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		
		// 获取域名或主机地址
		$host = $_SERVER['HTTP_HOST'];
		
		// 如果是在我们的域名中进行登录，则不需要查询OEM
		if(  !in_array($host,C('HostOptions')) ){
			// 从OEM中获取有当前主机的配置
			$mode_oem = D('Sys/OEM');
			$map['home_page_address'] = array('LIKE','%'.$host.'%');
			$map['status'] 				= 1;
			$data_oem = $mode_oem -> selectOne ( $map );
			// 		load("@.file");
			// 		$file_path = get_download_url( $data_oem['login_page_image_arr']['fileid'] );
			$mode_file = D("File/File");
			$data_file1 = $mode_file -> selectOne( array('id' => $data_oem['login_page_image_arr']['fileid']) );
			$data_file2 = $mode_file -> selectOne( array('id' => $data_oem['logo_image_arr']['fileid']) );
			$this -> assign('login_page_image_url', $data_file1['file_server_path'] );
			$this -> assign('logo_image_url', $data_file2['file_server_path'] );;
		}
		
		
		$this->display ();
	}
	
	/**
	 * 登录，包括验证
	 * @accesspublic
	 */
	public function doLogin($rpcmode = false) {
		

		// 初始化用户模型
		$user_model = D ( 'User/User' );
		
		if ($_GET ['luname']) {
			$username = $_GET ['luname'];
			$userid = $_GET ['luid'];
		} else {
			$username = $_POST ['username'];
			$userid = $_POST ['userpass'];
		}
		
		$result ['userinfo'] = $user_model->checkUserLocal ( $username, $userid );
		
		
		/* dump($result ['userinfo'] );exit;
		
		dump($userinfo['role_info']['rolegroup']);; */
		if ($result ['userinfo']) {
			
			// 判断当前用户的类型，根据不同的类型跳转到不同的分组
				
			
			switch ( $result ['userinfo']['usertype']) {
				/* case 'agent':
					// $jump_url = U ( 'Agent/Index/index' );
					
					$jump_url = 'Agent/Index/index';
					break;
				case 'sub':
				case 'server':
					// $jump_url = U ( 'Service/Index/index' );
					$jump_url ='Service/Index/index';
					break;
				case 'admin':
				case 'operation':
				case 'sales_manager':
					$jump_url ='Manage/Index/index';
					break; */
				/* case 'seller':
					
					// $jump_url = U ( 'Manage/Index/index' );
					$jump_url ='Manage/Keyword/effect';
					break; */
					case 'sub':
					case 'server':
					$jump_url = $result ['userinfo']['role_info']['rolegroup'] . '/Index/home';
					break;
				default:
					// $jump_url = U ( 'Index/index' );
						
					
						$jump_url = $result ['userinfo']['role_info']['rolegroup'] . '/Index/index';
					
				break;
			}
			// dump( $jump_url );exit;
			
				
			// 保存交易中的步骤
			
			// 保存交易中的步骤
			// $bizlog->saveStep("用户{$username}登录成功！");
			
			$this->redirect( $jump_url );
		} else {
			$this->error ( '用户名或者密码不正确！', U ( 'Index/login' ) );
		}
	}
	
	
	// 手机端修改密码
	public function changePass($rpcmode = false) {
		$user_model = D ( 'Biz/User' );
		$oldPass = $_GET ['oldPass'];
		$newPass = $_GET ['newPass'];
		$userid = $_GET ['userid'];
		$id = $_GET ['id'];
		$map ['uname'] = $userid;
		$map ['passwd'] = $oldPass;
		$result = $user_model->selectOne ( $map );
		if ($result) {
			$data ['id'] = $id;
			$data ['passwd'] = $newPass;
			$result2 = $user_model->update ( $data );
			if ($result2) {
				API_Mobile_V1Action::makeRPCResult ( "", 0, '密码修改成功' );
			} else {
				API_Mobile_V1Action::makeRPCResult ( "", 2, '密码修改失败' );
			}
		} else {
			API_Mobile_V1Action::makeRPCResult ( "", 1, '原密码不正确' );
		}
	}
	public function getPhone($rpcmode = false) {
		$user_model = D ( 'Biz/User' );
		if ($_GET ['userid']) {
			$result ['userinfo'] = $user_model->checkUserRemote ( $_GET ['userid'] );
			$result ['time'] = 2;
			if ($result) {
				if ($rpcmode) {
					$return ["errorcode"] = 0;
					$return ["errormsg"] = "";
					$return ["resulttype"] = 0;
					$return ["resultdata"] = $result;
					API_Mobile_V1Action::makeRPCResult ( $result, 0, '' );
				}
			}
		}
	}
	
	/*
	 * if($funclist){
	 * $funclist_array = explode(',',$funclist);
	 * $_SESSION['funclist_array'] = $funclist_array;
	 * $businesslist_array = explode(',',$businesslist);
	 * $_SESSION['businesslist_array'] = $businesslist_array;
	 *
	 * $this -> success('登录成功！', U('EpSpace/index'));
	 * }else
	 * $this -> error('你没有相关权限！' , U( 'Index/login'));
	 * }
	 * }
	 *
	 *
	 *
	 * /**
	 * 意见反馈
	 *
	 * @return void
	 */
	public function supportTips() {
		$this->display ( 'tpl/supportTips' );
	}
	
	/**
	 * 登出系统
	 *
	 * @access public
	 */
	public function logOut() {
		// 初始化用户模型
		$user_model = D ( 'User/ServerUser' );
		//登录成功后写入登录日志
		$modelLogin = D('User/Login');
		//保存日志
		$userid = $this ->loginUserId;
		//清理用户session
		$user_model -> setUserSession(  );
		
		$modelLogin -> doAfterlogOut( $userid );
		//返回
		if( $_GET['returnUrl'] ){
			header("location:".$_GET['returnUrl'] );
		}else{
			//跳转到登录界面
			$this->redirect(  C("LOGIN_URL") . '&t='.time() );
		}
	}
}