 <?php

/**
 * 前台公共控制层类:用户管理控制类
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Agent
 * @version     20141010
 * @link        http://www.mitong.com
 */
class UserManagementAction extends BaseAction {
	
	/*
	 * 公共函数，不接受权限检查，写法 array('index');
	 */
	public $public_functions = array ();
	
	/**
	 * 初始化函数
	 *
	 * @return void
	 */
	public function _initialize() {
		// 继承
		parent::_initialize ();
		
		$this->modelName = "Biz/UserManagement";
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index() {
		
		// 判断该代理商是否开启了二级代理的功能
		$me = $this -> loginUserInfo;
		if( $me['isopen_subagent'] == 1  ){
			$this -> redirect('sub_agent_list');
		}else{
			$this -> redirect('sub_user_list');
		}
		
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function sub_user_list( ){
		
		$model = D( $this-> modelName );
	
		//引入查询工具类
		import('ORG.Util.QueryTools');
	
		//实例化联合查询工具类
		$querytools = new QueryTools();
	
		
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			if( $_GET['keyword'] ){
				$map['username|epname'] = array('like', '%'.$_GET['keyword'].'%');
			}
				
			//翻页后仍能按照某字段排序
			$querytools ->addParam('order');
			
			//添加默认排序参数-组织机构代码
			$querytools->addDefOrder('id desc');
			//获得查询结果，传值到模板输出查询的结果
			$page['list'] = $model->getSubUserList($map, $fields, $querytools->getOrder(), $querytools->getPageparam());
			
			// 高亮关键词
			foreach ($page['list']['data'] as &$vo ){
				$vo['username'] = str_ireplace($_GET['keyword'],'<span style="color: #c00">'.$_GET['keyword'] .'</span>' , $vo['username']);
				$vo['epname'] = str_ireplace($_GET['keyword'],'<span style="color: #c00">'.$_GET['keyword'] .'</span>' , $vo['epname']);
			}
				
				
			$tpl =  ACTION_NAME . ".mobile";
			
			// 移动端数据渲染模板
			$tpl_data = 'tpl/'. $tpl;
				
			$page['tpl'] = $tpl_data;
			
			// 否则获取当前操作用户的产品列表
			$me = $this-> loginUserInfo;
			// 获取用户的产品
			$page['products'] 		= $me['products'];
			
			//传值到模板显示
			$this -> assign($page);
			//判断是否为第一页,如果不是第一页通过ajax返回数据
			if( $_GET['p'] >= 2 ){
				//exit(json_encode( $data['MyBizProgress']['data'] ));
				//通过fetch的方式进行渲染
				$content = $this->fetch( $tpl_data );
				exit($content);
			}
		}else{
			// 查询用户名
			if($querytools->paramExist('username')){
		
				//拼接exp条件
				$exp = array('like', '%'.$_GET['username'].'%');
				$querytools ->addParam('username','username',$exp);
			}
			
			// 查询用户名
			if($querytools->paramExist('truename')){
			
				//拼接exp条件
				$exp = array('like', '%'.$_GET['truename'].'%');
				$querytools ->addParam('truename','truename',$exp);
			}
			
			// 查询用户名
			if($querytools->paramExist('epname')){
				//拼接exp条件
				$exp = array('like', '%'.$_GET['epname'].'%');
				$querytools ->addParam('epname','epname',$exp);
			}
			
			// 查询用户名
			if($querytools->paramExist('userstatus')){
				//拼接exp条件
				$exp = array('eq', $_GET['userstatus']);
				$querytools ->addParam('userstatus','userstatus',$exp);
			}
			
			
		
			//翻页后仍能按照某字段排序
			$querytools ->addParam('order');
		
			//组合查询条件
			$query_params = 'username,truename,epname,userstatus';
			$this->assign('query_params', combo_url_param($query_params));
			//添加默认排序参数-组织机构代码
			$querytools->addDefOrder('id desc');
		
			//将map条件重新赋值
			$map = $querytools->getMap();
			
			//获得查询结果，传值到模板输出查询的结果
			$page['list'] = $model->getSubUserList($map, $fields, $querytools->getOrder(), $querytools->getPageparam());
	
			//查询的参数字符串
			$page['urlparams'] = $querytools ->getUrlparam();
			
			// 获取总用户数量
			$total_num = $model-> getTotalSubNum();
			$page['total_num'] = $total_num;
			// 获取有效用户数量
			$active_num = $model-> getActiveSubNum();
			$page['active_num'] = $active_num;
			// 获取无线用户数量
			$invalid_num = $model-> getInvalidSubNum();
			$page['invalid_num'] = $invalid_num;
			// 获取资金大于10000的用户数量
			
			
			$page['UserStatusOptions'] = C('UserStatusOptions'); 
			
			//传值到模板显示
			$this -> assign($page);
		}
		
		$this->display ( $tpl );
	}
	
	/**
	 * 子代理商列表
	 * 
	 * @accesspublic
	 */
	public function sub_agent_list( ){
	
		$model = D( $this-> modelName );
	
		//引入查询工具类
		import('ORG.Util.QueryTools');
	
		//实例化联合查询工具类
		$querytools = new QueryTools();
		
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			if( $_GET['keyword'] ){
				$map['username|epname'] = array('like', '%'.$_GET['keyword'].'%');
			}
			$map['status'] = 1;
			
			//翻页后仍能按照某字段排序
			$querytools ->addParam('order');
				
			//添加默认排序参数-组织机构代码
			$querytools->addDefOrder('id desc');
			
			//获得查询结果，传值到模板输出查询的结果
			$page['list'] = $model->getSubAgentUserList($map, $fields, $querytools->getOrder(), $querytools->getPageparam());
				
			// 高亮关键词
			foreach ($page['list']['data'] as &$vo ){
				$vo['username'] = str_ireplace($_GET['keyword'],'<span style="color: #c00">'.$_GET['keyword'] .'</span>' , $vo['username']);
				$vo['epname'] = str_ireplace($_GET['keyword'],'<span style="color: #c00">'.$_GET['keyword'] .'</span>' , $vo['epname']);
			}
		
			// 移动端模板
			$tpl =  ACTION_NAME . ".mobile";
			
			// 移动端数据渲染模板
			$tpl_data = 'tpl/'. $tpl;
			
			$page['tpl'] = $tpl_data;
			
			// 否则获取当前操作用户的产品列表
			$me = $this-> loginUserInfo;
			// 获取用户的产品
			$page['products'] 		= $me['products'];
			
			//传值到模板显示
			$this -> assign($page);
			
			//判断是否为第一页,如果不是第一页通过ajax返回数据
			if( $_GET['p'] >= 2 ){
				//通过fetch的方式进行渲染
				$content = $this->fetch( $tpl_data  );
				exit($content);
			}
		}else{
	
			// 查询用户名
			if($querytools->paramExist('username')){
		
				//拼接exp条件
				$exp = array('like', '%'.$_GET['username'].'%');
				$querytools ->addParam('username','username',$exp);
			}
		
			// 查询用户名
			if($querytools->paramExist('truename')){
		
				//拼接exp条件
				$exp = array('like', '%'.$_GET['truename'].'%');
				$querytools ->addParam('truename','truename',$exp);
			}
		
			// 查询用户名
			if($querytools->paramExist('epname')){
				//拼接exp条件
				$exp = array('like', '%'.$_GET['epname'].'%');
				$querytools ->addParam('epname','epname',$exp);
			}
		
			// 查询用户名
			if($querytools->paramExist('userstatus')){
				//拼接exp条件
				$exp = array('eq', $_GET['userstatus']);
				$querytools ->addParam('userstatus','userstatus',$exp);
			}
	
			//翻页后仍能按照某字段排序
			$querytools ->addParam('order');
		
			//组合查询条件
			$query_params = 'username,truename,epname,userstatus';
			$this->assign('query_params', combo_url_param($query_params));
			//添加默认排序参数-组织机构代码
			$querytools->addDefOrder('id desc');
		
			//将map条件重新赋值
			$map = $querytools->getMap();
			//$map['pid'] = $this -> loginUserId;
			$map['status'] = 1;
			//获得查询结果，传值到模板输出查询的结果
			$page['list'] = $model->getSubAgentUserList( $map, $fields, $querytools->getOrder(), $querytools->getPageparam());
	
			//查询的参数字符串
			$page['urlparams'] = $querytools ->getUrlparam();
		
			// 获取总用户数量
			$total_num = $model-> getTotalSubNum();
			$page['total_num'] = $total_num;
			// 获取有效用户数量
			$active_num = $model-> getActiveSubNum();
			$page['active_num'] = $active_num;
			// 获取无线用户数量
			$invalid_num = $model-> getInvalidSubNum();
			$page['invalid_num'] = $invalid_num;
			// 获取资金大于10000的用户数量
		
		
			$page['UserStatusOptions'] = C('UserStatusOptions');
		
			//传值到模板显示
			$this -> assign($page);
	
		}
			
		$this->display ( $tpl );
	}
	
	/**
	 * 进入新增用户界面
	 * 
	 * 根据不同的用户类型进入不同的新增界面，一级代理商用户、子用户
	 * @accesspublic
	 */
	public function insertPage( ){
		$page['ProductTypeOptions'] = C('ProductTypeOptions');
		
		// 从OE中获取用户的产品配置
		$mode_oem = D('Sys/OEM');
		$me = $this-> loginUserInfo;
		$data_oem = $mode_oem -> selectOne ( array('userid' => $me['id'] ));
		// TODO 暂时不需要自定义产品名称 
		$product_name = $data_oem['product_name'];
		if( !$product_name ){
			foreach ($page['ProductTypeOptions']  as $vo ){
				$product_name .= $vo . ',';
			}
			$product_name = rtrim($product_name, ',');
		}
		$page['data']['product_desc'] = $product_name;
		$page['data']['usertype'] = $_GET['usertype'];
		$this -> assign( $page );
		$this->display ();
	}
	
	/**
	 * 新增用户
	 *
	 * 根据不同的用户类型调用不同的模型增加新的用户
	 * @accesspublic
	 */
	public function insert( ){
		$model = D( $this-> modelName );

		$result = $model -> addUser( $_POST );
		
		if( $result){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '添加用戶成功！',$returnUrl,false,true);
			}else{
				$this->success ( '添加用戶成功！', U ( 'index'),false,true);
			}
		}else{
			$this->error ( '添加用戶失败，原因'. $model -> getError() );
		}
	}
	
	
	/**
	 * 用户详情
	 *
	 * 根据不同的用户类型调用不同的模型用户详情
	 * @accesspublic
	 */
	public function detail( ){
		$model = D( $this-> modelName );
	
// 		switch ( $_GET['type'] ) {
// 			case 'agent':
// 				$data = $model -> getAgentUserDetail( $_GET['id'] );
// 				break;
// 			case 'server':
// 				$data = $model -> getServerUserDetail( $_GET['id'] );
// 			default:
// 				;
// 				break;
// 		}
		$page['data'] = $model -> detail( $_GET['id'] );
		
		
		
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
			// 否则获取当前操作用户的产品列表
			$me = $this-> loginUserInfo;
			// 获取用户的产品
			$poducts_ids = $page['data']['productids'];
			// 获取用户的产品
			$products 		= $me['products'];
			foreach ($products as &$vo) {
				if( in_array($vo['id'], $poducts_ids)){
					$vo['checked'] = 1;
				}
			}
			// 获取用户的产品
			$page['products'] 		= $products;
			
		}
	
		$this -> assign( $page );
		$this -> display( $tpl );
	}
	
	
	/**
	 * 用户详情
	 *
	 * 根据不同的用户类型调用不同的模型用户详情
	 * @accesspublic
	 */
	public function updatePage( ){
		$model = D( $this-> modelName );
	
		$page['data'] = $model -> detail( $_GET['id'] );
		// 获取当前的代理商用户id
		$page['pid'] =  $data['pid'];
		// 开通产品类型
		$page['ProductTypeOptions'] = C('ProductTypeOptions');
		
		$this -> assign( $page );
		$this -> display();
	}
	
	
	/**
	 * 修改用户
	 *
	 * 根据不同的用户类型调用不同的模型增加新的用户
	 * @accesspublic
	 */
	public function update( ){
		$model = D( $this-> modelName );
	
// 		switch ( $_POST['type'] ) {
// 			case 'agent':
// 				$result = $model -> updateAgentUser( $_POST );
// 				break;
// 			case 'server':
// 				$result = $model -> updateServerUser( $_POST );
// 			default:
// 				;
// 				break;
// 		}
		
		$result = $model -> updateUser( $_POST );
		
		if( $result){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '修改用戶成功！',$returnUrl,false,true);
			}else{
				$this->success ( '修改用戶成功！', U ( 'index'),false,true);
			}
		}else{
			$this->error ( '修改用戶失败，原因'. $model -> getError()  );
		}
	}
	
	
	/**
	 * 用户详情
	 *
	 * 根据不同的用户类型调用不同的模型用户详情
	 * @accesspublic
	 */
	public function updatePasswordPage( ){
		$model = D( $this-> modelName );
	
		$data = $model -> detail( $_GET['id'] );
		// 获取当前的代理商用户id
		$this -> assign( 'pid', $data['pid'] );
	
		$this -> assign('data', $data );
		$this -> display();
	}
	
	
	/**
	 * 修改用户
	 *
	 * 根据不同的用户类型调用不同的模型增加新的用户
	 * @accesspublic
	 */
	public function updateSubPassword( ){
		$model = D( $this-> modelName );
	
		// 		switch ( $_POST['type'] ) {
		// 			case 'agent':
		// 				$result = $model -> updateAgentUser( $_POST );
		// 				break;
		// 			case 'server':
		// 				$result = $model -> updateServerUser( $_POST );
		// 			default:
		// 				;
		// 				break;
		// 		}

		$result = $model -> updateSubUserPassword( $_POST );
	
		if( $result){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '修改用戶戶密码成功！',$returnUrl,false,true);
			}else{
				$this->success ( '修改用戶戶密码成功！', U ( 'index'),false,true);
			}
		}else{
			$this->error ( '修改用戶密码失败，原因'. $model -> getError()  );
		}
	}
	
	/**
	 * 登录子用户账户
	 */
	function loginSubuser(){
		$model = D( $this-> modelName );
		
		$userinfo  = $model -> loginSubuser( $_GET['userid'] );
		//dump($userinfo['role_info']['rolegroup']);exit;
		if ($userinfo) {
			$this->success ( '登录成功！', U ( $userinfo['role_info']['rolegroup'] .'/Home/home' ) );
		} else {
			$this->error ( '用户名或者密码不正确！', U ( 'Service/Index/login' ) );
		}
	}
	
	
	/**
	 * 删除站点
	 *
	 * @accesspublic
	 */
	public function deleteRecord(){
	
		$model = D($this->modelName);
		
		$result = $model -> deleteRecord( $_GET['id'] );
		
		if( $result ){
			$returnUrl = $_GET['returnUrl'];
			if( $returnUrl ){
				$this->success ( '删除用户成功！',$returnUrl,false,true);
			}else{
				$this->success ( '删除用户成功！', U ( 'index'),false,true);
			}
		}else{
			$this-> error('删除用户失败！');
		}
	}
	
	
	
}