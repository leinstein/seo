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

class TestAction extends BaseAction{

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
		//继承

	}
	
	function getT(){
		dump(date('Y-m-d H:i:s'));
		dump(time());
	}
	
	function getM(){
		$html = file_get_contents('https://api.weixin.qq.com/cgi-bin/menu/get?access_token=5c8_mw3KRFIEQSrdBTbOambCJsni0eKzgjspO1Zt1jhfOAuQSiQGGzEbrQly6grVBeTT1Faz6-oD47A2Q6S06_JSxCjGR5oEfwcLkbip0NIBOLiAJAFSP');
		dump($html);
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
	
		//初始化日志
		$bizlog = bizlog_model();
		//保存日志
		$bizlog->write("用户打开微信绑定页面", $this->tVar);
	
		//如果已经进入了企业选择界面
		if( $_SESSION['temp_choiceenterprise'] ){
				
			$loginUser = unserialize( $_SESSION['temp_loginuserinfo'] );
			$loginName = $_SESSION['temp_loginname'];
				
			//如果获取到
			if( $loginName && $loginUser ){
				//赋值变量
				$this->assign('temp_loginname', $_SESSION['temp_loginname']);
				$this->assign('temp_loginpass', $_SESSION['temp_loginpass']);
				$this->assign('temp_choiceenterprise', $_SESSION['temp_choiceenterprise']);
				//清除session
				$_SESSION['temp_choiceenterprise'] = null;
			}
	
			$loginUser = unserialize( $_SESSION['temp_loginuserinfo'] );
			$this->assign('loginUserEps', $loginUser['expandinfo']['SipacEnterprises']);
		}
	
		$this->assign("wechatOpenid", $_SESSION["weixin_openid"]);
		$this->display();
	}
	
	/**
	 * 用户绑定微信号操作
	 *
	 * @access public
	 */
	public function doBindWechat() {
		//初始化日志
		$bizlog = bizlog_model();
	
		//移动端
		if( $this->isMobile ){
			//动态设置跳转界面参数
			//TODO 该代码可以基类
			C('TMPL_ACTION_SUCCESS',C('TMPL_ACTION_SUCCESS').'.mobile');
			C('TMPL_ACTION_ERROR',C('TMPL_ACTION_ERROR').'.mobile');
		}
	
		//必填控制
		if( empty($_POST['loginname']) ){
			$this->error("请填写账号名称！" );
		}
		if( empty($_POST['loginpass']) ){
			$this->error("请填写账号密码！" );
		}
		if($_SESSION['verify'] != md5($_POST['verifycode'])) {
			$this->error('验证码错误或者已经过期！');
		}
	
		$loginName = $_POST['loginname'];
		$loginPass = $_POST['loginpass'];
		$openId = $_POST['wechatOpenid'];
	
		//初始化用户模型
		$user_model = get_usermodel( $_POST['loginusertype'] );
	
		//用户验证并绑定微信openid
		$wxinfo['openid'] = $openId;
		if( C('USER_CHECK_MODE') == "REMOTE_CHECK" )
			$loginUser = $user_model -> remoteBindWechat( $wxinfo, $loginName, $loginPass );
			else
				$loginUser = $user_model -> bindWechat( $wxinfo, $loginName, $loginPass );
	
				//验证后处理
				$this->commonAfterLogin(  $loginUser, $loginName, $loginPass, $bizlog);
	
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
		$bizlog = bizlog_model();
	
		# 引入文件
		require_once(VENDOR_PATH . '\wechat\include.php');
	
		# 配置参数
		$config = C('WX_AUTH_CALLBACK_CONFIG_PORTAL');
	
		# 加载对应操作接口
		//$callback = "http://192.168.33.21" . __URL__."/getWechatUserInfo&returnUrl=".urlencode($_GET["returnUrl"]);
		$callback = 'http://'.$_SERVER['SERVER_NAME']. __URL__ ."/getWechatUserInfo&returnUrl=".urlencode($_GET["returnUrl"]);
		$wechat = & \Wechat\Loader::get('Oauth', $config);
		$url = $wechat->getOauthRedirect($callback,'STATE','snsapi_userinfo');
	
		//如果用户已经登录，则直接跳转
		if( $this->myName ){
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
	
	
	
	
	
	
	
	function keyword_case(){

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
	
	
	function getNeedBetween( $kw ){
		$st = stripos($kw,$mark1);
		$ed =stripos($kw,$mark2);
		if(($st==false||$ed==false)||$st>=$ed)
			return 0;
			$kw=substr($kw,($st+1),($ed-$st-1));
			return $kw;
	}
	
	
	/**
	 * 设置合作停的排名
	 */
	function set_coop_stop_rank(){
		// 获取关键词
		$model_keyword = D('Biz/Keyword');
		// 获取关键词
		$model_Keyworddetect = D('Biz/Keyworddetectrecord');
		// 获取最新排名为0的合作停的关键词、
		$map['latestranking'] =  array(array('EQ','0'),array('EXP','IS NULL'),'OR');
		$map['keywordstatus'] =  '合作停';
		$map['status'] =  1;
		$list  = $model_keyword -> queryRecordAll($map,'id,keyword,latestranking' );

		dump($list);
		foreach ( $list as $vo ){
			// 获取最新的检测结果，而且结果不为0的检测排名
			$map_detect['keywordid'] = $vo['id'];
			$map_detect['rank'] =  array(array('NEQ','0'),array('EXP','IS NOT NULL'),'AND');
			$list1  = $model_Keyworddetect -> queryRecordAll($map_detect,null,'regtime desc',null,1 );
			
			if( $list1 ){
				$map_k['id'] = $vo['id'];
				$data['latestranking'] = $list1[0]['rank'];
				$model_keyword -> where ( $map_k ) -> save( $data );
				dump($model_keyword ->  _sql());
			}
			
		}
		
	}
	/**
	 * 检测达标消费是否有重复扣费的情况
	 */
	function check_fee(){
		$modelStandardfee 			= D('Biz/Standardfee');
		
		// 获取全部的日期
		$dates = $modelStandardfee -> field("left(standarddate,10) as date") -> group("left(standarddate,10)") -> select();

		foreach ($dates as $vo ){
			unset($keywordid);
			$map['standarddate'] = array('LIKE' , $vo['date'] .'%');
			$list = $modelStandardfee -> where( $map ) ->field("keywordid,keyword,ownuserid,createusername,standarddate") ->  select();
			//dump( $modelStandardfee -> _sql());
			//dump($list);
			$day['day'] = $vo;
			foreach ($list as $vo_l){
				
				$keywordid[] = $vo_l['keywordid'];
			}
			
			
			$r = $this -> is_repeat( $keywordid );
			$keywordid_new = array_unique($keywordid);
			
			
			if( count( $keywordid ) > count( $keywordid_new ) ){
				dump(count( $keywordid ));
				dump(count( $keywordid_new ));
				dump($r );
				
				dump($vo['date']);
				//dump($keywordid);
			}
			$day['keywordid'] = $keywordid;
			$days[] = $day;
		}
	}
	
	function is_repeat( $array ){
		
		$len = count ( $array );
		for($i = 0; $i < $len; $i ++) {
			for($j = $i + 1; $j < $len; $j ++) {
				if ($array [$i] == $array [$j]) {
					$repeat_arr [] = $array [$i];
					break;
				}
			}
		}
		return $repeat_arr;
	}

	function epdir(){

		header("Content-type: text/html; charset=utf-8");
		load("@.des");
		//dump(time());
		//dump(basic_decrypt('NqsFZD0oSz5Zk8uQknQ8xw=='));
		
		// 初始化用户模型
		$user_model = D ( 'User/User' );
		$model_epdir = M ( 'ts_sys_epdir' , null );
		$list = $user_model -> where( $map ) -> field('id,username,userpass,epname,usergroup,isopen_oem,isopen_subagent,seller_id,operation_id,customer_id,reguser,regtime') -> order('regtime') -> group('epname')-> select();
		foreach ($list as &$vo){
			$ep = $model_epdir  -> where( array('epname' => $vo['epname'])) -> find();
			
			if($vo['epname'] && !$ep){
				$data['epid'] = create_guid();
				$data['epname'] = $vo['epname'];
				$data['epgroup'] = $vo['usergroup'];
				$data['isopen_oem'] = $vo['isopen_oem'];
				$data['isopen_subagent'] = $vo['isopen_subagent'];
				$data['seller'] = $vo['seller_id'];
				$data['customer'] = $vo['operation_id'];
				$data['operationer'] = $vo['customer_id'];
				
				$data['status'] = 1;
				$data['reguser'] = $vo['reguser'];
				$data['regtime'] = $vo['regtime'];
				$datas[] = $data;
			}
		}
		dump($datas);
		M ( 'ts_sys_epdir' , null ) -> addAll( $datas );

	}

	function update_user(){

		header("Content-type: text/html; charset=utf-8");
		load("@.des");

		// 初始化用户模型
		$user_model = D ( 'User/User' );

		$list = 	M ( 'ts_sys_epdir' , null ) -> select( );
		foreach ($list as $vo) {
			$map['epname'] = $vo['epname'];
			$data['epid'] = $vo['id'];
			$user_model -> where( $map ) -> save( $data );
		}
		
	}

	public function funds(){
		
		$model_funds = D ( 'Biz/Funds' );
		// 获取关键词
		$model_keyword = D('Biz/Keyword');
		$map['status'] = 1;
		$map['usertype'] = 'sub';
		$funds = $model_funds -> queryRecordAll( $map );
		foreach ($funds as $vo ){
			$userid = $vo['userid'];
			$map1['createuserid'] = $userid;
			$keywords = $model_keyword -> queryRecordAll( $map1 );
			unset( $ids );
			foreach ($keywords as $vo1 ){
				$ids[] = $vo1['id'];
			}
				
			// 从达标消费中获取全部额
			if( $ids ){
				$map2['keywordid'] = array('IN',$ids);
				$map2['status'] = 1;
				$price = D('Biz/Standardfee') -> where( $map2 ) ->  sum('price');
			}
			$vo['total_consumption'] = $price;
			
			$freezefunds = $vo["initfreezefunds"] - $price;
			
			if($vo['id'] == 5  ){
				dump($price);
				dump($vo);
				dump ( $freezefunds );
			}
			
			if( $freezefunds >=0){
				$data["freezefunds"] 	= $freezefunds;
				$data["balancefunds"] 	= $vo["totalfunds"] - $price;
				$data["availablefunds"] = $vo["totalfunds"] - $vo["initfreezefunds"] ;
			}else{
				$data["freezefunds"] 	= 0;
				$data["balancefunds"] 	= $vo["totalfunds"] - $price - $freezefunds;
				$data["availablefunds"] = $data["balancefunds"];
			}
			
		/* 	$data['id'] = $vo['id'];
			
			dump($data); */
			$model_funds -> where( array('id' => $vo['id'])) -> save($data );
			
			dump($model_funds -> _sql());
			
		}
	}
	
	public function funds2(){
	
		$model_funds = D ( 'Biz/Funds' );
		// 获取关键词
		$model_keyword = D('Biz/Keyword');
		$map['status'] = 1;
		$map['usertype'] = 'sub';
		$funds = $model_funds -> queryRecordAll( $map );
		foreach ($funds as $vo ){
			if( $vo["initfreezefunds"]  > 0 ){ 
				
				
				
				$userid = $vo['userid'];
				$map1['createuserid'] = $userid;
				$keywords = $model_keyword -> queryRecordAll( $map1 );
				unset( $ids );
				foreach ($keywords as $vo1 ){
					$ids[] = $vo1['id'];
				}
		
				// 从达标消费中获取全部额
				if( $ids ){
					$map2['keywordid'] = array('IN',$ids);
					$map2['status'] = 1;
					$price = D('Biz/Standardfee') -> where( $map2 ) ->  sum('price');
				}
				if( $userid == 9){
					dump( $vo["freezefunds"] );
					dump($price);
					dump( D('Biz/Standardfee') -> _sql());
				}
			
				if( $price > 0){
					
					
					if( $vo["freezefunds"] >  0){
						
						
						// $data["freezefunds"] 	= $vo["initfreezefunds"] - $price;;
						// 剩余金额为 总金额-消耗金额-剩余冻结金额
						$data["balancefunds"] 	= $vo["totalfunds"] - $price + $vo["freezefunds"];
						
						$data["availablefunds"] 	= $vo["totalfunds"] -  $vo["initfreezefunds"];
						if( $userid == 9){
							dump(111111);
							dump( $data );
						}
							
						// 剩余可以金额为 总金额减去
						// $data["availablefunds"] = $vo["totalfunds"] - $vo["initfreezefunds"] ;
					}else{
						
						
						
						$data["freezefunds"] 	= 0;
						
						if( $userid == 9){
							dump(222222);
							dump( $vo["freezefunds"] );
							dump( $data );
						}
						
						$data["balancefunds"] 	= $vo["totalfunds"] - $price;
						$data["availablefunds"] = $data["balancefunds"] ;
						
						if( $userid == 9){
							dump( $data["balancefunds"]  );
							dump( $data );
						}
					}
	
					//dump($data);
					$model_funds -> where( array('id' => $vo['id'])) -> save($data );
					
					dump($model_funds -> _sql());
				}
				
			}
			// 获取冻结金额	
		}
	}
	
	public function test(){
		header("Content-type: text/html; charset=utf-8");
		load("@.des");
		//dump(time());
		//dump(basic_decrypt('NqsFZD0oSz5Zk8uQknQ8xw=='));
		
		// 初始化用户模型
		$user_model = D ( 'User/User' );
		$list = $user_model -> queryRecordAll( $map,'id,username,userpass,epname','regtime desc');
		foreach ($list as &$vo){
			$vo['userpass_decrypt'] = basic_decrypt( $vo['userpass']);
		}
		dump($list);
	}
	
	public function test1(){
		
		$model_funds = D('Biz/Funds');
		$model_keyword = D('Biz/Keyword');
		
		$map['standarddate'] = array('LIKE','2017-05-20%');
		$map['status'] = 1;
		// 获取 ownuserid
		
		$list = D('Biz/Standardfee') -> queryRecordAll( $map, 'id,keywordid,keyword,price,ownuserid,standarddate','regtime desc,keywordid');
		foreach ($list as $vo ){
			$ownuserids[] = $vo['ownuserid'];
		}
		$ownuserids = array_unique( $ownuserids );
		/* foreach ($ownuserids as $vo_userid ){
			
			$map['ownuserid'] = $vo_userid;
			D('Biz/Standardfee') -> where( $map) -> g
		}
		
		exit; */
		//dump($list);
		
		//$list = $this -> array_unique_fb( $list );
		//dump($list);
		foreach ($ownuserids as $vo_userid ){
			// 获取该用户的资金信息
			$map_funds['userid'] = $vo_userid;
			$funds = $model_funds -> selectOne( $map_funds );
			unset( $list_new );
			foreach ( $list as $vo1 ){
				if($vo_userid == $vo1['ownuserid'] ){
					$list_new[] = $vo1;
				}
			}
			
			
			
			unset($repeats);
			foreach ($list_new as $key1 => &$vo1){
				foreach ($list_new as $vo2){
					
					if( $vo1['id'] != $vo2['id'] && $vo1['keywordid'] == $vo2['keywordid']){
						$repeats[] = $vo1;
						unset($list_new[$key1]);
					}
				}
			}
			$price = 0;
			foreach ($repeats as $vo_repeats ){
				$price += $vo_repeats['price'];
				$r['status'] = 0;
				D('Biz/Standardfee') -> where(array('id' => $vo_repeats['id'])) -> save( $r );
				
				$keywod = $model_keyword -> selectOne( array('id' => $vo_repeats['keywordid']));
				$kw['standarddays'] 		= $keywod['standarddays'] -1;// 达标天数
				$kw['totalconsumption'] 	= $keywod['totalconsumption'] - $keywod['price']; // 累计消费
				$model_keyword -> where(array('id' => $keywod['id'])) -> save( $kw );
				
			}
			$fund['id'] = $funds['id'];
			$fund['freezefunds'] = $funds['freezefunds'] + $price;
			$fund['balancefunds'] = $funds['balancefunds'] + $price;
			$model_funds -> where( array('id' => $funds['id'])) -> save($fund );
			
			
			
			
			dump($price);
			dump($funds);
			dump($repeats);
			dump('============');
		}
	}
	
	//二维数组去掉重复值
	function array_unique_fb($array2D){
		foreach ($array2D as $v){
			$v=join(',',$v); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
			$temp[]=$v;
		}
		$temp1 =array_unique($temp); //去掉重复的字符串,也就是重复的一维数组
		// 获取重复数据的数组
		$repeat = array_diff_assoc ( $temp, $temp1 );
		//dump($repeat);
		foreach ($repeat as $k => $v){
			$repeat[$k]=explode(',',$v); //再将拆开的数组重新组装
		}
		//dump($repeat);
		return $repeat;
		
	}
	
	
	function FetchRepeatMemberInArray($array) {
		// 获取去掉重复数据的数组
		$unique_arr = array_unique ( $array );
		// 获取重复数据的数组
		$repeat_arr = array_diff_assoc ( $array, $unique_arr );
		return $repeat_arr;
	}
	
	function login(){
		$this -> display();
	}
	
	function adjust_funds(){
		D('Biz/Funds') -> adjust_funds();
	}
	
	
	public function receive_keywords_rank(){
		Log::write("============================== 关键词检测接口调试 ==============================");
		// 关键词模型
		$modelKeyword 				= D('Biz/Keyword');
		// 关键词检测模型
		$modelKeyworddetectrecord 	= D('Biz/Keyworddetectrecord');
		// 关键词达标扣费模型
		$modelStandardfee 			= D('Biz/Standardfee');
		// 资金账户模型
		$modelFunds 				= D('Biz/Funds');
		// 资金账户冻结模型
		$modelFundsfreeze 			= D('Biz/Fundsfreeze');
	
		$map_detect['createtime'] 	= array('LIKE', date('Y-m-d').'%');
		$map_detect['rank'] 		= -1;
		$map_detect['status'] 		= 1;
		$keyword_detect_list = $modelKeyworddetectrecord -> queryRecordAll( $map_detect);
		
		foreach ($keyword_detect_list as $vo ){
		
			$token 				= $vo['token'];
			$data_id			= $vo['keywordid'];
			$keywords			= $vo['keyword'];
			$searchengine		= $vo['searchengine'];
			$rank				= rand(1,100);;
			$url				= $vo['url'];
		
			// 没有任务ID
			if( !$data_id ){
				$return['ret'] 		= -1;
				$return['message'] 	= '任务ID为空';
				dump($return);
				//exit(json_encode( $return ));
			}
		
			// 2.=========================== 根据data_id来获取关键词的详细信息，并进行相关的校验 ===========================
			// 查询搜索任务
			$data_kw = $modelKeyword -> selectOne( array('id' => $data_id ));
		
			//判断$token是否相同
			if( $token != $data_kw['detect_token']){
				$return['ret'] 		= -1;
				$return['message'] 	= 'token校验不正确';
				dump($return);
			//	exit(json_encode( $return ));
			}
			//判断关键词是否相同
			if( $keywords != $data_kw['keyword']){
				$return['ret'] 		= -1;
				$return['message'] 	= '关键词校验不正确';
				dump($return);
				//exit(json_encode( $return ));
			}
		
			//判断url是否相同
			// 		if( $url != $data['website']){
			// 			$return['ret'] 		= -1;
			// 			$return['message'] 	= 'url验证不正确';
			// 			exit(json_encode( $return ));
			// 		}
			// 当前的时间：达标时间
			$date_cur 		= date('Y-m-d H:i:s');
			// 判断最新达标日期是否是今天，如果是今天表示今日已经达标了，不能再重复进行扣费
			if( substr( $data_kw['standarddate'],0,10 ) == substr( $date_cur,0,10 ) ){
				$return['ret'] 		= 1;
				$return['message'] 	= '成功';
				dump($return);
				exit(json_encode( $return ));
			}
			// 3.=========================== 验证通过后，进行数据处理 ===========================
			// 真实排名
			$rank_real	= $rank;
			// 判断是否是首次进行关键词的检测
			if( !$data_kw['detectiondate'] ){
					
				// 如果是首次进行检测，需要更新初始排名,将排加上10
				// update By Richer 于2017年6月9日17:27:46 所有初始排名加10
				// update By Richer 于2017年7月25日10:43:23 所有的初始排名加10到15之间的随机数
				$num = rand(10, 15) ;
				if( $rank > 0 ){
					$rank 	= $rank + $num;//
				}
				// 设置初始排名
				$kw['initialranking'] 	= $rank;// 初始排名
			}
		
			// 4.=========================== 更新检测记录表中的数据  ===========================
			// 更新检测记录表中的数据
			$result = $modelKeyworddetectrecord -> updateRecord( $rank,$rank_real,$data_kw['id'], $data_kw['keyword'], $data_kw['website'], $data_kw['searchengine'], $data_kw['createuserid'] );
			//dump($modelKeyworddetectrecord -> _sql());
			// 5.=========================== 组合关键词公共信息  ===========================
			// 组合关键词公共部分
			$kw['id'] 				= $data_id;
			$kw['detectiondate'] 	= $date_cur;// 检测时间
			$kw['latestranking'] 	= $rank;// 最新排名
			$kw['is_detect'] 		= 1;// 已经通过检测接口进行了检测
		
			// 如果关键词达标
			if( $rank <= 10 && $rank  > 0){
		
				// 6.=========================== 获取资金账户信息  ===========================
				// 获取资金账户信息
				$data_funds  	= $modelFunds -> selectOne( array('userid' => $data_kw['createuserid'] ));
					
				// 7.=========================== 组合关键词其他信息  ===========================
				// 剩余冻结资金
				$freezefunds = $data_funds['freezefunds'];
				$kw['standarddate'] 		= $date_cur;// 达标时间
				$kw['standardstatus'] 		= '已达标';// 达标状态
				$kw['latestconsumption'] 	= $data_kw['price']; // 最新消费
				$kw['standarddays'] 		= $data_kw['standarddays'] + 1;// 达标天数
				$kw['totalconsumption'] 	= $data_kw['totalconsumption'] + $data_kw['price']; // 累计消费
					
				// 判断是否是首次达标
				if ( !$data_kw['firststandarddate'] ){
					// 如果关键词是首次达标，则需要冻结该关键词90天，90天内部能解冻，并且冻结30天的费用
					// 冻结费用
					// $freezefunds = $data_kw['price'] * 30;
					// 90天之后的日期:允许解冻日期
					$unfreezedate = date("Y-m-d H:i:s",strtotime("+90 day"));
		
					//冻结关键词90天 ====================================>
					$kw['firststandarddate'] 	= $date_cur;// 首次达标时间
					//$kw['standarddays'] 		= 1;// 达标天数
					$kw['unfreezedate'] 		= $unfreezedate;// 解冻日期
				}
		
				// 8.=========================== 更新关键词信息  ===========================
				// 更新关键词
				$result = $modelKeyword -> update($kw);
				dump("------------------------------ 更新关键词：". $modelKeyword -> _sql());
				Log::write("------------------------------ 更新关键词：". $modelKeyword -> _sql());
		
					
				// 9.=========================== 更新资金账户信息  ===========================
					
				// 更新资金账户更新消费记录 ================>
		
				// 更新资金账户 ：需要将冻结的资金全部消耗完毕，然后再从余额中进行消耗================>
				// 如果冻结资金已经小于当前的关键词单价，那么关键词的消耗要从资金余额中进行扣除
				// 判断是否还有冻结资金
				if( $freezefunds > 0 ){
					// 如果还有冻结资金，
					// 判断冻结资金是否已经小于关键词的单价
					if( $freezefunds <= $data_kw['price'] ){
		
						// 将冻结资金设置为 0
						$funds['freezefunds'] 			= 0;
						// 资金可用余额 :冻结资金消耗完之后从可用余额中扣除
						$funds['availablefunds'] 		= $data_funds['availablefunds']  - $data_kw['price'] + $freezefunds; //array('exp', "balancefunds - {$data_kw['price']}" );// 充值金额减去消费金额
		
					}else{
						// 冻结资金还未消耗完毕，从冻结资金中扣除，此时资金可用余额不变
						$funds['freezefunds'] 			= $data_funds['freezefunds'] 	- $data_kw['price'];// 关键词达标扣费需要从冻结费用中进行扣除
						$funds['availablefunds'] 		= $data_funds['availablefunds'] ;
						// $funds['balancefunds'] 			= $data_funds['balancefunds']   - $data_kw['price']; //array('exp', "balancefunds - {$data_kw['price']}" );// 充值金额减去消费金额
					}
						
				}else{
					// 资金可用余额 :冻结资金消耗完之后从可用余额中扣除
					$funds['availablefunds'] 		= $data_funds['availablefunds']  - $data_kw['price'] ; //array('exp', "balancefunds - {$data_kw['price']}" );// 充值金额减去消费金额
					$funds['freezefunds'] 			= 0;
						
				}
		
				// 资金余额：等于资金可用余额加上资金冻结金额
				$funds['balancefunds'] 			= $funds['availablefunds']  + $funds['freezefunds'];
		
				// update By Richer 于2017年9月1日16:59:37  解决冻结资金出现负数的问题
				if( $funds['freezefunds'] < 0 ){
					$funds['freezefunds']  = 0;
					$funds['availablefunds'] = $funds['balancefunds'] ;
				}
		
				$modelFunds -> where( array('id' => $data_funds['id'] )) -> save( $funds );
				//	dump($modelFunds -> _sql());
				dump("------------------------------ 更新资金账户：". $modelFunds -> _sql());
				Log::write("------------------------------ 更新资金账户：". $modelFunds -> _sql());
		
		
		
				// 往達標消費記錄中增加一條消費記錄 ================>
				$standardfee['siteid'] 			= $data_kw['siteid'];
				$standardfee['keywordid'] 		= $data['keywordid'];
				$standardfee['keyword'] 		= $keywords;
				$standardfee['price'] 			= $data_kw['price'];
				$standardfee['ownuserid'] 		= $data_kw['createuserid'];
				$standardfee['standarddate'] 	= $date_cur;
				$modelStandardfee -> insert( $standardfee );
				//dump($modelStandardfee -> _sql());
				dump("------------------------------ 达标消费记录中增加信息：". $modelStandardfee -> _sql());
				Log::write("------------------------------ 达标消费记录中增加信息：". $modelStandardfee -> _sql());
		
			}else{
				$kw['standardstatus'] 		= '未达标';// 达标状态
				$result = $modelKeyword -> update($kw);
				Log::write($modelKeyword -> _sql());
			}
		
		
			$return['ret'] 		= 1;
			$return['message'] 	= '成功';
			dump($return);
			//exit(json_encode( $return ));
		}
	}
	
	function update_user_role(){
		dump(time());
		dump(json_decode('{"ret":"-1","msg":"\u8be5\u4efb\u52a1\u5df2\u5b58\u5728\uff01"}'));
		exit;
		// 初始化用户模型
		$user_model = D ( 'User/User' );
		$model_role = M ( 'ts_sys_userroleinfo' , null );
		$model_depart = M ( 'ts_sys_departinfo' , null );
		$map['usergroup'] = array('NEQ','Service');
		$list = $user_model -> queryRecordAll($map,'id,usergroup,usertype,username');
		foreach ($list as $vo ){
			$map1['rolegroup'] 	= $vo['usergroup'];
			$map1['rolecode'] 	= $vo['usertype'];
			
			$role = $model_role -> where( $map1 ) -> field('departid,roleno') -> find();
			
			$data['roleno'] = $role['roleno'];
			$map2['id'] = $role['departid'];
			$depart = $model_depart -> where( $map2 ) -> field('orgid') -> find();
		
			$data['departno'] = $depart['orgid'];
			$user_model -> where( array('id' => $vo['id'])) -> save( $data );
			dump($user_model -> _sql());
		}
		
	}
	
	
	function update_role(){
		$model_role = M ( 'ts_sys_userroleinfo' , null );
		$list = $model_role -> select();
		foreach ($list as $vo ){
			$model_role -> where( array('id' => $vo['id'])) -> save( array('roleno' => create_guid()));
		}
	
	}
	
	function update_epdir(){
		$model 		= M ( 'ts_sys_epdir' , null );
		$model_user = M ( 'ts_sys_user' , null );
		$map['seller|seller_manager'] = array(array('NEQ',''),array('EXP','IS NOT NULL'),array('NEQ',0),'AND');
		//$map['sales_manager'] = array(array('NEQ',''),array('EXP','IS NOT NULL'),array('NEQ',0),'AND');
		$list = $model -> where($map) -> select();
	dump($list);
		foreach ($list as $vo ){
			$map_user['id'] = $vo['seller'];
			$user = $model_user -> where($map_user) -> find();
			dump($user['usertype']);
			if ($user['usertype'] == 'seller'){
				//dump($user);
				//$user_p = $model_user -> where(array('id' =>$user['pid'] )) -> find();
				//dump($user_p);
				if($user['pid']){
					$model -> where(array('id' => $vo['id'])) -> save(array('seller_manager'=> $user['pid']));
				}
			}else if( $user['usertype'] == 'sales_manager'){
				$data['seller_manager'] =  $user['id'];
				$data['seller'] 		=  0;
				$model -> where(array('id' => $vo['id'])) -> save($data);
			}
			
			//$model -> where( array('id' => $vo['id'])) -> save( array('roleno' => create_guid()));
		}
	
	}
	
	
	function t1(){
		$model1 = M ( 'ts_keyword' , null );
		$model2    = M ( 'ts_keyworddetectrecord' , null );
		$map1['keywordstatus'] =  '合作停';
		$list = $model1 -> where($map1) -> select();
		foreach ($list as $vo ){
			$map2['keywordid'] = $vo['id'];
			$map2['status'] 	= 1;
			$data1 = $model2 -> where($map2) -> field('rank') ->  order('regtime desc') -> find();
			
			if( $data1['rank'] != $vo['latestranking']){
				dump($model2 -> _sql());
				dump($data1['rank']);
				//dump($vo);
				
				$data['latestranking'] = $data1['rank'];
				if( $data1['rank'] > 0 && $data1['rank'] <= 10 ){
					$data['standardstatus']  = '已达标';
				}
				$model1 -> where( array('id' => $vo['id'])) -> save($data);
				dump($model1 -> _sql());
				dump('.....');
			}
			
		}
		
	}
	
	function t2(){
		$model1 = M ( 'ts_keyword' , null );
		$model2    = M ( 'ts_standardfee' , null );
		$map1['createuserid'] =  263;
		$map1['keywordstatus'] =  '优化中';
		$map1['standarddate'] =  array('LIKE','2017-09-27%');
		$map1['status'] 	= 1;
		$list1 = $model1 -> where($map1) -> select();
		
		$map2['ownuserid'] =  263;
		$map2['standarddate'] = array('LIKE','2017-09-27%');
		$map2['status'] 	= 1;
		$list2 = $model2 -> where($map2) -> select();
		foreach ($list1 as $vo1){
			$ids[] = $vo1['id'];
		}
		dump(count($list1));
		dump(count($list2));
		foreach ($list2 as $vo2){
			if(!in_array($vo2['keywordid'],$ids)){
				dump($vo2);
				$id1s[] = $vo2['keywordid'];
			}
		}
		
		dump($id1s);
		/* 
		foreach ($list as $vo ){
			
			$data1 = $model2 -> where($map2) -> field('rank') ->  order('regtime desc') -> find();
			if($data1 ){
				
			}
		}
	 */
	}
	
	/**
	 * 关键词检测和关键词表中不一致
	 */
	function t3(){
		$model1 	= M ( 'ts_keyword' , null );
		$model2 	= M ( 'ts_keyworddetectrecord' , null );
		
		$map1['keywordstatus'] 	=  '优化中';
		$map1['status'] 		=  1;
		$list = $model1 -> where($map1) -> select(); 
		
		
		foreach ($list as $vo ){
			$map2['keywordid'] = $vo['id'];
			$map2['status'] 	= 1;
			$data1 = $model2 -> where($map2) -> field('rank') ->  order('regtime desc') -> find();
				
			if( $data1['rank'] != $vo['latestranking']){
				dump($model2 -> _sql());
				dump($data1['rank']);
				//dump($vo);
	
				$data['latestranking'] = $data1['rank'];
				if( $data1['rank'] > 0 && $data1['rank'] <= 10 ){
					$data['standardstatus']  = '已达标';
				}
				$model1 -> where( array('id' => $vo['id'])) -> save($data);
				dump($model1 -> _sql());
				dump('.....');
			}
				
		}
	
	}


	/**
	 * 关键词检测和关键词表中不一致
	 */
	function t4(){
		$model1 	= M ( 'ts_keyword' , null );
		$model2 	= M ( 'ts_standardfee' , null );
	
		$map1['keywordstatus'] 		=  '优化中';
		$map1['standardstatus'] 	=  '已达标';
		$map1['status'] 			=  1;
		$list1 = $model1 -> where($map1) -> field('id') ->  select();
		
		$map2['standarddate'] 		=  array('LIKE', date('Y-m-d') .'%');
		$map2['status'] 			=  1;
		$list2 = $model2 -> where($map2) -> field('keywordid') -> select();
		dump($model2 -> _sql());
		dump(count($list1));
		dump(count($list2));
		foreach ($list1 as $key1 => $vo1 ){
			foreach ($list2 as $key2 => $vo2 ){
				if( $vo1['id'] == $vo2['keywordid']){
					unset($list1[$key1]);
					unset($list2[$key2]);
				}
			}
		}
		dump(count($list1));
		dump($list2);
		
		foreach ($list2 as $vo3){
			$ids[] = $vo3['keywordid'];
		}
		$map['keywordid'] = array('IN',$ids);
		$map['standarddate'] 		=  array('LIKE', date('Y-m-d') .'%');
		$data['status'] = 0;
		$model2 -> where($map ) -> save( $data );
	}
}