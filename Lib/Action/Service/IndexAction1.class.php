<?php
/**
 * 前台公共控制层类：系统首页
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Service
 * @version     20140420
 * @link        http://www.mitong.com
 */
class IndexAction extends BaseAction {

	/*
	 * 公共函数，不接受权限检查，写法 array('index');
	 */
	public $public_functions = array ( 'login', 'doLogin','verify','checkVerifyCode','logOut','wechatEntry','loginByWechat','commonAfterLogin','bindWechat','doBindWechat' ,'getWechatUserInfo' );

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

		// 系统统计模型
		$model = D('Biz/Statistics');

		// 获取用户id
		// 获取该用户下面的全部客户信息
		$users =  $model -> getUsers( );

		// 获取用户id
		$userids 	= $users['userids'];
		// 获取用户所在企业id
		$epids 		= $users['epids'];
		
		
		// 获取首页的统计
		$page = $model -> getOptimize( $userids );
		
		$page['consumption'] = $model -> getConsumption( $userids , 1);

	/* 	// 获取站点的数量
		$page['siteNum']  = $model -> getSiteNum( $userids , 1);

		// 获取优化中关键词总数量 - 在线任务
		$page['purchasedKeywordNum'] = $model -> getPurchasedKeywordNum( $userids, 1 );

		// 获取最新达标关键词数量 - 达标任务
		$page['stankeywordNum'] = $model -> getStandardKeywordNum( $userids, 1);

		// 获取最新达标关键词消费 - 今日消费
		$page['standardsFee'] = $model -> getTodayFee( $userids , 1);

		// 获取最新达标关键词消费 - 累计消费
		$page['consumption'] = $model -> getConsumption( $userids , 1);

		// 获取资金统计情况
		$page['funds_pool'] = $model -> getFundsPool( $userids, 1 );

		// 每日统计
		// 上个月消费统计情况
		$cons_lastmonth = $model -> getConsdetailsForLastMonth( $userids , 1 );
		foreach ($cons_lastmonth as $vo){
			$days[] =$vo['day'];
			$consumptions_last_month[] = $vo['consumption'];
		}
		$page['days'] = json_encode($days) ;
		$page['consumptions_last_month'] = json_encode( $consumptions_last_month );
		// b本月月消费统计情况
		$cons_thismonth = $model -> getConsdetailsForThisMonth( $userids , 1 );
		foreach ($cons_thismonth as $vo){
			$consumptions_this_month[] = $vo['consumption'];
		}
		$page['consumptions_this_month'] = json_encode( $consumptions_this_month ); */


		$this -> assign($page);
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );
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
			//$data_file2 = $mode_file -> selectOne( array('id' => $data_oem['logo_image_arr']['fileid']) );
			$data_file2 = $mode_file -> selectOne( array('id' => $data_oem['loginpage_logo_image_arr']['fileid']) );
				
			$this -> assign('login_page_image_url', $data_file1['file_server_path'] );
			$this -> assign('logo_image_url', $data_file2['file_server_path'] );;
		}

		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );
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
$result ['userinfo'] = $user_model-> checkUserLocalSub(1);
		//$result ['userinfo'] = $user_model->checkUserLocal ( $username, $userid );


		/* dump($result ['userinfo'] );exit;

		dump($userinfo['role_info']['rolegroup']);; */
		if ($result ['userinfo']) {
			
			if( $result ['userinfo']['userstatus'] == '注销'){
				$this->error ( '该用户已经注销，无法登陆系统！', U ( 'Index/login' ) );
			}
			
				
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
					$jump_url = $result ['userinfo']['role_info']['rolegroup'] . '/Home/home';
					break;
				default:
					// $jump_url = U ( 'Index/index' );

						
					$jump_url = $result ['userinfo']['role_info']['rolegroup'] . '/Home/home';
						
					break;
			}
			// dump( $jump_url );exit;
				

			// 保存交易中的步骤
				
			// 保存交易中的步骤
			// $bizlog->saveStep("用户{$username}登录成功！");
				
			$this->redirect( $jump_url ,array('tag' => 1));
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

	/**
	 * 用户绑定微信号页面
	 *
	 * @access public
	 */
	public function bindWechat() {

		$this->assign("wechatOpenid", $_SESSION["weixin_openid"]);
		$this->display();
	}

	/**
	 * 用户绑定微信号操作
	 *
	 * @access public
	 */
	public function doBindWechat() {




		//必填控制
		if( empty($_POST['loginname']) ){
			$this->error("请填写账号名称！" );
		}

		if( empty($_POST['loginpass']) ){
			$this->error("请填写账号密码！" );
		}


		$loginName 	= $_POST['loginname'];
		$loginPass 	= $_POST['loginpass'];
		$openId 	= $_POST['wechatOpenid'];

		//初始化用户模型
		$user_model = D('User/User');

		//用户验证并绑定微信openid
		$wxinfo['openid'] = $openId;

		$loginUser = $user_model -> bindWechat( $wxinfo, $loginName, $loginPass );

		//验证后处理
		$this->commonAfterLogin(  $loginUser, $loginName, $loginPass );

	}

	/**
	 * 使用微信号来登录系统
	 *
	 * @access private
	 */
	private function loginByWechat($wxOpenid){

		//首先，通过openid查询用户信息是否存在
		import( "User/User");
		$loginUser = UserModel::getUserinfoByWx($wxOpenid);

		//查询到了直接设置登录状态
		if( $loginUser ){
			$this->commonAfterLogin( $loginUser, $loginUser['username'], $loginUser['password'], $bizlog );
		}else{
			//没有查询到则打开绑定页面开始绑定流程
			$this->assign("wechatOpenid", $_SESSION["weixin_openid"]);
			//$this->display("bindWechat");
			$this->display("login.mobile");
		}
	}

	/**
	 * 获取微信用户的openid和AccessToken
	 */
	public function getWechatUserInfo(){

		# 引入文件
		//require_once(VENDOR_PATH . '\wechat\include.php');
		require_once './Core/Extend/Vendor/wechat/include.php';

		# 配置参数
		$config = C('WX_AUTH_CALLBACK_CONFIG');

		# 加载对应操作接口
		$wechat = & \Wechat\Loader::get('Oauth', $config);
		$result = $wechat->getOauthAccessToken();

		//保存Openid
		if( $result ){
			$_SESSION["weixin_openid"] = $result['openid'];
			$_SESSION["user_access_token"] = $result['access_token'];

			//加载完用户信息之后，进行用户信息加载
			$this->loginByWechat($_SESSION["weixin_openid"]);
		}
	}

	/**
	 * 微信入口
	 * https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxb85dcea23a174abd&redirect_uri=http%3A%2F%2F192.168.33.21%2Fts%2Fportal%2Findex.php%3Fs%3D%2FService%2FIndex%2FgetUserinfo&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect
	 */
	public function wechatEntry(){

		# 引入文件
		//require_once(VENDOR_PATH . '\wechat\include.php');
		require_once './Core/Extend/Vendor/wechat/include.php';

		# 配置参数
		$config = C('WX_AUTH_CALLBACK_CONFIG');
		
		# 加载对应操作接口
		$callback 	= 'http://'.$_SERVER['SERVER_NAME']. __URL__ ."/getWechatUserInfo&returnUrl=".urlencode($_GET["returnUrl"]);
		$wechat 	= & \Wechat\Loader::get('Oauth', $config);
		$url 		= $wechat->getOauthRedirect($callback,'STATE','snsapi_userinfo');
		
		//如果用户已经登录，则直接跳转
		if( $this-> LoginuserName ){
			$back_url = $_GET["returnUrl"]? $_GET["returnUrl"] : 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"] . U(C("INDEX_URL"));
			header("location:".$back_url);
			exit;
		}else{
			//如果用户没有登录，并且会话中有openid，则直接通过openid进行获取
			if( $_SESSION["weixin_openid"] &&  $_SESSION["user_access_token"] ){
				//通过openid查询用户信息是否存在
				$this->loginByWechat( $_SESSION["weixin_openid"]);
			}else{
				//如果openid为空，则跳转到授权页面回调页面，获取openid并且加载用户信息
				header("location:".$url);
			}
		}
	}

	/**
	 * 验证用户之后的公共业务逻辑
	 *
	 * @access private
	 */
	private function commonAfterLogin( $loginUser, $loginName, $loginPass ){


		//登录判断
		if( $loginUser ){

			//初始化用户模型
			$user_model = D('User/User');

			//如果是企业用户，且有多个所属企业，则需要进行选择
			if( $loginUser['usertype'] == 'ep' &&  $loginUser['epcount']>1  ){
				//临时存储用户信息
				$_SESSION['temp_loginname'] = $loginName;
				$_SESSION['temp_loginpass'] = $loginPass;
				$_SESSION['temp_loginuserinfo'] = serialize($loginUser);
				$_SESSION['temp_choiceenterprise'] = 1;
				if( $_REQUEST['returnUrl'] )
					$returnUrl = '&='.time().'&returnUrl='.urlencode($_REQUEST['returnUrl']);
					else
						$returnUrl = '&='.time();
						//需要判断该企业的epid是否为空

						$loginUrl = $_REQUEST["loginUrl"]?$_REQUEST["loginUrl"]:C("LOGIN_URL");

						//判断是否是Ajax方式提交
						if( $this->isAjax() ){
							$returndata['info']   =   $loginUser;
							$returndata['status'] =   1;
							$returndata['url']    =   $loginUrl;
							$this->ajaxReturn($returndata);
						}else{
							$this->redirect($loginUrl.$returnUrl);
						}
						exit;
			}else{
				//清除一些选择企业的session
				$_SESSION['temp_choiceenterprise'] = null;
				$_SESSION['temp_choiceno'] = null;
				$_SESSION['temp_loginname'] = null;
				$_SESSION['temp_loginpass'] = null;
				$_SESSION['temp_loginuserinfo'] = null;
			}

			//设置用户会话
			$user_model->setUserSession($loginUser['id'], $loginName, $loginUser);

			//正常跳转
			$returnUrl = htmlspecialchars_decode($_REQUEST['returnUrl']);
				
			if( $returnUrl  ){
				$back_url =  $returnUrl;
			}else{

				$back_url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"] . U(C("INDEX_URL"));
					
				// 判断当前用户的类型，根据不同的类型跳转到不同的分组
				switch ( $loginUser['usertype']) {

					case 'sub':
					case 'server':
						$jump_url = $loginUser['role_info']['rolegroup'] . '/Home/home';
						break;
					default:
						$jump_url = $loginUser['role_info']['rolegroup'] . '/Home/home';
							
						break;
				}

				$back_url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"] . U( $jump_url );
			}
				
				
			//	dump($back_url);
			//exit;
			//判断是否是Ajax方式提交
			if( $this->isAjax() ){
				$returndata['info']   =   $loginUser;
				$returndata['status'] =   1;
				$returndata['url']    =   $back_url;
				$this->ajaxReturn($returndata);
			}else{
					
				header("location:".$back_url);
				//$this-> redirect($jump_url);
			}
			exit;

		}else{
			//清除session
			$_SESSION['temp_choiceenterprise'] = null;

			//错误
			$this->error( "用户名或密码错误！" );
		}
	}
}