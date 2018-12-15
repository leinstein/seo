<?php

/**
 * 前台公共控制层类
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Manage
 * @version     20141010
 * @link        http://www.mitong.com
 */
class IndexAction extends BaseAction {
	
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
		$_SESSION['GROUP'] = __GROUP__;
		// 继承
		parent::_initialize ();
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index() {
		
		if( $this -> LoginUserName == '排名统计'){
			$this-> redirect('Keyword/effect');
		}
		
		// 实例化统计模型
		$model = D('Biz/Statistics');
		
		// 获取该用户下面的全部客户信息
		$users =  $model -> getUsers( );
				
		// 获取用户id
		$userids 	= $users['userids'];
		// 获取用户所在企业id
		$epids 		= $users['epids'];
		
		// 获取首页的统计
		$page = $model -> getOptimize( $userids );
		
		$this -> assign( $page );

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
		$this->display ();
	}
	
	/**
	 * 登录，包括验证
	 * @accesspublic
	 */
	public function doLogin($rpcmode = false) {
		
		
		// 初始化用户模型
		$user_model = D ( 'User/ManageUser' );
		
		
		if ($_GET ['luname']) {
			$username = $_GET ['luname'];
			$userid = $_GET ['luid'];
		} else {
			$username = $_POST ['username'];
			$userid = $_POST ['userpass'];
		}
		
		$result ['userinfo'] = $user_model->checkUserLocal ( $username, $userid );
		
		if ($result ['userinfo']) {
			
			// 保存交易中的步骤
			// $bizlog->saveStep("用户{$username}登录成功！");
			
			$this->success ( '登录成功！', U ( 'Index/index' ) );
		} else {
			$this->error ( '用户名或者密码不正确！', U ( 'Index/login' ) );
		}
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function home() {
		
		$modelFunds = D('Biz/Funds');
		$modelKeyword = D('Biz/Keyword');
		$modelFinance = D('Biz/Finance');
		$modelStandardfee = D('Biz/Standardfee') ;
		
		// 获取全部的站点数量
		$siteNum = D('Biz/Site') -> getSitesNum();
		$page['siteNum'] = $siteNum;
	
		// 获取已购买关键词数量
		$purchasedKeywordNum = $modelKeyword -> getAllPurchasedNum();
		$page['purchasedKeywordNum'] = $purchasedKeywordNum;
		
		// 获取达标关键词数数量
		$stankeywordNum = $modelKeyword -> getAllStandardsNum();
		$page['stankeywordNum'] = $stankeywordNum;
	
		// 获取达标扣费
		$standardsFee = $modelStandardfee -> getTodayFee();
		$page['standardsFee'] = $standardsFee;
	
		// 获取资金池统计值
		$funds_pool = $modelFinance -> getFundsPool();
		// 冻结资金
		$page['freezefunds'] = $funds_pool['freezefunds'];
		// 初始冻结资金
		$page['initfreezefunds'] = $funds_pool['initfreezefunds'];
		// 累计消费
		// $page['consumptionfunds'] = $funds_pool['consumptionfunds'];
		
		// 获取达标率
		$compliance_rate = $modelKeyword -> getComplianceRate();
		$page['compliance_rate'] = $compliance_rate;
		// 获取本月消费
		$consumption_month = $modelStandardfee -> getAllConsumptionMonth();
		$page['consumption_month'] = $consumption_month;
		
		// 获取累计消费
		$consumptionfunds = $modelStandardfee -> getAllConsumption();
		$page['consumptionfunds'] = $consumptionfunds;
		
		
		//获取消费明细
		// $consumerdetails = $modelKeyword -> getConsumerdetails();
		
		$consumerdetails = $modelStandardfee -> getConsdetailsForAll(); 
		foreach ($consumerdetails as $vo){
			$days[] =$vo['day'];
			$consumptions[] =$vo['consumption'];
		}
		$page['days'] = json_encode($days) ;
		$page['consumptions'] = json_encode($consumptions) ;

		$this -> assign( $page );
		
		$this->display ();
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
		//保存日志
		//清理用户session
		$user_model -> setUserSession( );
		//返回
		if( $_GET['returnUrl'] ){
			header("location:".$_GET['returnUrl'] );
		}else{
			//跳转到登录界面
			$this->redirect(  C("LOGIN_URL") . '?t='.time() );
			
			
		}
	}
}