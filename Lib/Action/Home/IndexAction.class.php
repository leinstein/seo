<?php

/**
 * 前台公共控制层类
*
* @category   业务控制类
* @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
* @package     Action.Home
* @version     20141010
* @link        http://www.mitong.com
*/

class IndexAction extends BaseAction{

	/*
	 * 公共函数，不接受权限检查，写法 array('index');
	 */
	public $public_functions = array('*');

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
	 * 公众端首页
	 *
	 * {@inheritDoc}
	 * @see BaseAction::index()
	 */
	function index(){
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );
	}
	/**
	 * 产品服务
	 */
	function product(){
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );
	}
	/**
	 * SEO百科服务
	 */
	function baike(){

		$page_number = !empty( $_GET['page_number'] ) ?  $_GET['page_number']  : 10;
		$model_article = M('qisobao.archives','dede_');
		$p = !empty( $_GET['p'] ) ?  $_GET['p']  : 1;
		$start 	= ($p -1) * $page_number;
		$end 	= $page_number;
		$map['typeid'] = 2;
		$list 	= $model_article -> where($map) -> order('pubdate desc') -> limit( $start, $end) -> select();
		$count 	= $model_article -> where($map) -> count();
		foreach ($list as &$vo){
			$pubdate = date('Y-m-d',$vo['pubdate']);
			$vo['pubdate_pre'] = substr($pubdate,2,5);
			$vo['pubdate_suf'] = substr($pubdate,8,2);
		}


		//拼接输出
		$result ['data'] = $list;
		$result ['count'] = $count;
		$result ['pageCount'] = ceil($count/$page_number);     //总页数 intval($Page->totalPages);
		$page['list'] = $result;

		$this -> assign( $page );
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
				
			//判断是否为第一页,如果不是第一页通过ajax返回数据
			if( $_GET['p'] >= 2 ){
				//exit(json_encode( $data['MyBizProgress']['data'] ));
				//通过fetch的方式进行渲染
				$content = $this->fetch( 'tpl/'. $tpl  );
				exit($content);
			}
				
		}
		$this->display ( $tpl );
	}

	/**
	 * SEO百科服务
	 */
	function baike_detail(){
		$model_archives = M('qisobao.archives','dede_');
		$model_article = M('qisobao.addonarticle','dede_');
		$data = $model_archives -> where( array('id' => $_GET['id'])) -> find();
		$title = $data['title'];
		$map['aid'] = $_GET['id'];
		$data = $model_article -> where($map) -> find();
		$data['title'] = $title;
		$page['data'] = $data;
		$this -> assign( $page );

		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );
	}

	/**
	 * 新闻咨询
	 */
	function news(){

		$page_number = !empty( $_GET['page_number'] ) ?  $_GET['page_number']  : 10;
		$model_article = M('qisobao.archives','dede_');
		$p = !empty( $_GET['p'] ) ?  $_GET['p']  : 1;
		$start 	= ($p -1) * $page_number;
		$end 	= $page_number;
		$map['typeid'] = 14;
		$list 	= $model_article -> where($map) -> order('pubdate desc') -> limit( $start, $end) -> select();
		$count 	= $model_article -> where($map) -> count();
		foreach ($list as &$vo){
			$pubdate = date('Y-m-d',$vo['pubdate']);
			$vo['pubdate_pre'] = substr($pubdate,2,5);
			$vo['pubdate_suf'] = substr($pubdate,8,2);
		}


		//拼接输出
		$result ['data'] = $list;
		$result ['count'] = $count;
		$result ['pageCount'] = ceil($count/$page_number);     //总页数 intval($Page->totalPages);
		$page['list'] = $result;

		$this -> assign( $page );
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";

			//判断是否为第一页,如果不是第一页通过ajax返回数据
			if( $_GET['p'] >= 2 ){
				//exit(json_encode( $data['MyBizProgress']['data'] ));
				//通过fetch的方式进行渲染
				$content = $this->fetch( 'tpl/'. $tpl  );
				exit($content);
			}

		}

		$this->display ( $tpl );
	}

	/**
	 * 关于我们
	 */
	function aboutus(){
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );
	}

	/**
	 * 加盟合作们
	 */
	function joinus(){
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );
	}

	/**
	 * 成功案例
	 */
	function keyword_case(){


		$model = D('Biz/Keyworddetectrecord');
		$model_keyword = D('Biz/Keyword');

		$SearchengineOptions  	= C('SearchengineOptions');
		$page['PerPageOptions']  = C( 'PerPageOptions');
		foreach ( $SearchengineOptions as $key => $vo ){
			$option['title'] = $vo;
			$option['value'] = $key;
			$options[] = $option;
				
			// 将渠道进行解析
			$searchengine = $_GET['searchengine'];
			if( $searchengine == $vo ){
				$searchengine_val = $key;
			}
		}
		$page['options'] = json_encode($options);
		$page['SearchengineOptions'] = $SearchengineOptions;

		//引入查询工具类
		import('ORG.Util.QueryTools');

		//实例化联合查询工具类
		$querytools = new QueryTools();

		//查询项目进度
		if($querytools->paramExist('keyword')){
			$exp = array('like', '%'.$_GET['keyword'].'%');
			$querytools ->addParam('keyword','keyword',$exp);
		}
		//查询异常状态
		if($querytools->paramExist('website')){
			$exp = array('like', '%'.$_GET['website'].'%');
			$querytools ->addParam('website','website',$exp);
		}

		// 查询搜索引擎
		if($querytools->paramExist('searchengine')){
				
			//拼接exp条件
			$exp = array('eq', $_GET['searchengine']);
			$querytools ->addParam('searchengine','searchengine',$exp);
		}

		//组合查询条件
		$query_params = 'keyword,website,searchengine';
		$this->assign('query_params', combo_url_param($query_params));
		$page['query_params'] = combo_url_param($query_params);

		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('regtime desc,rank');

		//翻页后仍能按照某字段排序
		$querytools ->addParam('ord');

		//将map条件重新赋值
		$map = $querytools->getMap();


		$map = array_filter($map) ;
		if( $_GET['test']){
			if( count($map )){

			}
		}

		//$map['rank'] = array('GT',0);
		if( $map['keyword']  ||  $map['website']){
			$map['rank'] = array(array('GT',0),array('ELT',10),'AND');
		}else{
			$map['rank'] = 1;
			$map['createtime'] = array('like',date('Y-m-d').'%');
		}

		if( !$map['keyword']){
			$map['createtime'] = array('like',date('Y-m-d').'%');
		}
		$map['status'] = 1;

		//$map['initialranking'] = array(array('GT',10),array('EQ',0),'OR');
		$map['latestranking'] = array(array('GT',0),array('ELT',10),'AND');
		if( $_GET['test']){
			if( count($map )){

			}

			dump($map);
		}
		//获得查询结果，传值到模板输出查询的结果
		$list['data'] = $model->queryRecordAll( $map, $fields,'keywordid desc,regtime desc', null, 50 );
		//获得查询结果，传值到模板输出查询的结果
		//$list = $model->queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page'] );
		//查询的参数字符串
		//$page['urlparams'] = $querytools ->getUrlparam();

		foreach ( $list['data'] as $key => &$vo){
			switch ( $vo['searchengine']){
				case 'baidu':
					$img ='__PUBLIC__/img/baidu.png';
					$search_url="https://www.baidu.com/s?ie=UTF-8&wd=".$vo['keyword'];
					break;
				case 'baidu_mobile':
					$img ='__PUBLIC__/img/baidu_mobile.png';
					$search_url="https://m.baidu.com/s?ie=UTF-8&wd=".$vo['keyword'];
					break;
				case '360':
					$img ='__PUBLIC__/img/360.png';
					$search_url="https://www.so.com/s?ie=utf-8&q=".$vo['keyword'];
					break;
				case 'sougou':
					$img ='__PUBLIC__/img/sougou.png';
					$search_url="https://www.sogou.com/web?query=".$vo['keyword'];
					break;
				case 'shenma':
					$img ='__PUBLIC__/img/shenma.png';
					$search_url="http://soma.sma.so/?q=".$vo['keyword'];
					break;
				default:
					$img ='__PUBLIC__/img/baidu.png';
					$search_url="https://www.baidu.com/s?ie=UTF-8&wd=".$vo['keyword'];
					break;
			}
				
			$vo['img'] = $img;
			$vo['search_url'] = $search_url;
			// http://www. http:// www. wap. .com .net .la .cn .com.cn .sh.cn
			$website = $vo['website'];

			// 需要替换的前缀
			$suffixs =  array('http://','https://','www.','wap.', '3g.','.com','.net','.la','.cn','.sh');
			$website_new = str_ireplace( $suffixs ,'',$website);
			$str = substr($website_new,0,2) .'***';
			$website = str_ireplace( $website_new ,$str,$website);
			$vo['website'] = $website;
			/* dump( $website_new);
			 dump( $str);
			 dump($website); */

			$keyword_info = $model_keyword -> selectOne( array('id' => $vo['keywordid']));
			if( $keyword_info['initialranking'] > 0 AND $keyword_info['initialranking'] <= 10 ){
				unset( $list['data'][$key]);
			}
			$vo['initialranking'] = $keyword_info['initialranking'];
			if( $vo['initialranking'] <= 0 ){
				$diff = 99;
			}else{
				$diff = abs( $vo['initialranking'] - $vo['rank']);
			}
			$vo['diff'] = $diff;
		}

		$list['data'] = array_slice( $list['data'],0,20);
		$page['list'] = $list;
		//	dump($list);exit;
		$this -> assign( $page );

		$tpl = 'case';
		if( $this -> isMobile ){
			$tpl =  "case.mobile";
		}
		$this->display ( $tpl );
	}


	/**
	 * 手機端登錄
	 */
	function doLoginMobile(){

		dump($_POST);

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

		//动态设置跳转界面参数
		//TODO 该代码可以基类
		C('TMPL_ACTION_SUCCESS',C('TMPL_ACTION_SUCCESS').'.mobile');
		C('TMPL_ACTION_ERROR',C('TMPL_ACTION_ERROR').'.mobile');


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
		import( KERNEL_NAME . "/". get_usermodel_space() . "/User");
		$loginUser = UserModel::getUserinfoByWx($wxOpenid);

		//查询到了直接设置登录状态
		if( $loginUser ){
			$this->commonAfterLogin( $loginUser, $loginUser['email'], $loginUser['password'], $bizlog );
		}else{
			//没有查询到则打开绑定页面开始绑定流程
			$this->assign("wechatOpenid", $_SESSION["weixin_openid"]);
			$this->display("bindWechat");
		}
	}

	/**
	 * 获取微信用户的openid和AccessToken
	 */
	public function getWechatUserInfo(){

		# 引入文件
		require_once(VENDOR_PATH . '\wechat\include.php');

		# 配置参数
		$config = C('WX_AUTH_CALLBACK_CONFIG_PORTAL');

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
		//	require_once(VENDOR_PATH . '\wechat\include.php');

		# 配置参数
		//	$config = C('WX_AUTH_CALLBACK_CONFIG_PORTAL');

		# 加载对应操作接口
		//$callback = "http://192.168.33.21" . __URL__."/getWechatUserInfo&returnUrl=".urlencode($_GET["returnUrl"]);
		$callback = 'http://'.$_SERVER['SERVER_NAME']. __URL__ ."/getWechatUserInfo&returnUrl=".urlencode($_GET["returnUrl"]);
		$wechat = & \Wechat\Loader::get('Oauth', $config);
		$url = $wechat->getOauthRedirect($callback,'STATE','snsapi_userinfo');
		if( $_GET["returnUrl"] ){
			$returnUrl =  'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_GET["returnUrl"] ;
		}

		//如果用户已经登录，则直接跳转
		if( $this-> loginUserId ){
			$back_url = $returnUrl ? $returnUrl : 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"] . U(C("INDEX_URL"));
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







	function keyword_case1(){

		$model = D('Biz/KeywordCaseView');

		//$model = D('Biz/Keyworddetectrecord');
		//$model_keyword = D('Biz/Keyword');

		$page['SearchengineOptions']  	= C('SearchengineOptions');
		$page['PerPageOptions']  		= C( 'PerPageOptions');


		//引入查询工具类
		import('ORG.Util.QueryTools');

		//实例化联合查询工具类
		$querytools = new QueryTools();

		//查询项目进度
		if($querytools->paramExist('keyword')){
			$exp = array('like', '%'.$_GET['keyword'].'%');
			$querytools ->addParam('keyword','keyword1',$exp);
		}
		//查询异常状态
		if($querytools->paramExist('website')){
			$exp = array('like', '%'.$_GET['website'].'%');
			$querytools ->addParam('website','website1',$exp);
		}

		// 查询搜索引擎
		if($querytools->paramExist('searchengine')){
			//拼接exp条件
			$exp = array('eq', $_GET['searchengine']);
			$querytools ->addParam('searchengine','searchengine1',$exp);
		}

		//组合查询条件
		$query_params = 'keyword,website,searchengine';
		$this->assign('query_params', combo_url_param($query_params));
		$page['query_params'] = combo_url_param($query_params);

		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('regtime1 desc,rank');

		//翻页后仍能按照某字段排序
		$querytools ->addParam('ord');

		//将map条件重新赋值
		$map = $querytools->getMap();
		$map = array_filter($map) ;
		$map['status1'] = 1;
		$map['rank'] = array('GT',0);
		$map['initialranking'] = array(array('GT',10),array('EQ',0),'OR');

		//获得查询结果，传值到模板输出查询的结果
		$list = $model->queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page'] );
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();

		foreach ( $list['data'] as &$vo){
			switch ( $vo['searchengine1']){
				case 'baidu':
					$img ='__PUBLIC__/img/baidu.png';
					$search_url="https://www.baidu.com/s?ie=UTF-8&wd=".$vo['keyword'];
					break;
				case 'baidu_mobile':
					$img ='__PUBLIC__/img/baidu_mobile.png';
					$search_url="https://m.baidu.com/s?ie=UTF-8&wd=".$vo['keyword'];
					break;
				case '360':
					$img ='__PUBLIC__/img/360.png';
					$search_url="https://www.so.com/s?ie=utf-8&q=".$vo['keyword'];
					break;
				case 'sougou':
					$img ='__PUBLIC__/img/sougou.png';
					$search_url="https://www.sogou.com/web?query=".$vo['keyword'];
					break;
				case 'shenma':
					$img ='__PUBLIC__/img/shenma.png';
					$search_url="http://soma.sma.so/?q=".$vo['keyword'];
					break;
				default:
					$img ='__PUBLIC__/img/baidu.png';
					$search_url="https://www.baidu.com/s?ie=UTF-8&wd=".$vo['keyword'];
					break;
			}
			$vo['img'] = $img;
			$vo['search_url'] = $search_url;
			// http://www. http:// www. wap. .com .net .la .cn .com.cn .sh.cn
			$website = $vo['website'];
				
			// 需要替换的前缀
			$suffixs =  array('http://','https://','www.','wap.', '3g.','.com','.net','.la','.cn','.sh');
			$website_new = str_ireplace( $suffixs ,'',$website);
			$str = substr($website_new,0,2) .'***';
			$website = str_ireplace( $website_new ,$str,$website);
			$vo['website'] = $website;
			/* dump( $website_new);
			 dump( $str);
			 dump($website); */
				
			//$keyword_info = $model_keyword -> selectOne( array('id' => $vo['keywordid']));
			//$vo['initialranking'] = $keyword_info['initialranking'];
			if( $vo['initialranking'] <= 0 ){
				$diff = 99;
			}else{
				$diff = abs( $vo['initialranking'] - $vo['rank']);
			}
			$vo['diff'] = $diff;
		}
		$page['list'] = $list;

		//	dump($list);exit;
		$this -> assign( $page );
		$this -> display('case');
	}

	function login(){
		$this -> display();
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
			}
			$back_url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"] . U( $jump_url );
				
			//判断是否是Ajax方式提交
			if( $this->isAjax() ){
				$returndata['info']   =   $loginUser;
				$returndata['status'] =   1;
				$returndata['url']    =   $back_url;
				$this->ajaxReturn($returndata);
			}else{
				header("location:".$back_url);
			}
			exit;

		}else{
			//清除session
			$_SESSION['temp_choiceenterprise'] = null;
			//保存日志
			$bizlog->write("用户[".$loginName."]登录系统失败，原因是用户名或密码错误！", $this->tVar);
			//错误
			$this->error( "用户名或密码错误！" );
		}
	}

}