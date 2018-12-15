<?php

/**
 * 前台公共控制层类
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.qisobao.cn)
 * @package     Action.Home
 * @version     20141010
 * @link        http://www.qisobao.cn
 */

class FinanceAction extends BaseAction {
	
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
		
		$this->modelName = "Biz/Finance";
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index(){
		
		
		$modelKeyword 		= D( 'Biz/Keyword' );
		$modelStandardfeel = D('Biz/Standardfee');
		
		//获取日报表
		$dailys= $modelStandardfeel -> getDaily();
		$this->assign( 'dailys', $dailys );
		
	
		$this -> display();
	
	}
	
	/**
	 * 删除购物车中的关键词
	 */
	function keywordList(){
	
		
		$list = $model -> getListByPage();
		$this -> assign('list', $list);
		$this->display();
	
	}
	
	/**
	 * 资金池管理
	 * 
	 * 获取当前资金池的总金额，已经消费金额 资金池金额充值总金额、消费金额、剩余金额
	 */
	function pool(){
		
		$model = D( $this->modelName );
		
		$data = $model -> getFundsPoolAgent();
		$page['data'] 	= $data;
		$pie['name'] 	= '资金池余额';
		$pie['value'] 	= $data['balancefunds'];
		$pies[] = $pie;
		
		$pie['name'] 	= '资金池可用余额'	;
		$pie['value']	= $data['availablefunds'];
		$pies[] = $pie;
		$pie['name'] 	= '资金池初始冻结金额';
		$pie['value']	= $data['initfreezefunds'];
		$pies[] = $pie;
		$pie['name']	= '资金池剩余冻结金额';
		$pie['value']	= $data['freezefunds'];
		$pies[] = $pie;
		$page['pies'] 	= $pies;
		
		$page['days'] = json_encode($days) ;
		$page['pools'] = json_encode($pies) ; ;
		// 获取用户的分布情况
		//dump($page);
		
		//传值到模板显示
		$this -> assign($page);

		$this->display();
	
	}
	
	/**
	 * 财务明细
	 *
	 * 获取一级代理商的充值记录
	 */
	function details(){
	
		$model = D( $this->modelName );
		// 获取代理商为子用户充值记录
		$page['list_sub'] = $model -> getExpendRecords();
		
		//获取管理账户为代理商充值记录
		$page['list_agent'] = $model -> getEntryRecords( $this-> loginUserId );
		
		//传值到模板显示
		$this -> assign($page);
		$this->display();
	}
	
	/**
	 * 日子用户列表
	 */
	function sub_user_list(){
	
		$model = D( 'Biz/UserManagement' );
	
		//引入查询工具类
		import('ORG.Util.QueryTools');
	
		//实例化联合查询工具类
		$querytools = new QueryTools();
	
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
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('id desc');
	
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['status'] = 1;
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getSubUserList($map, $fields, $querytools->getOrder(), $querytools->getPageparam());
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
	
		//传值到模板显示
		$this -> assign($page);
		$this->display( );
	}
	
	
	/**
	 * 子代理商列表
	 *
	 * @accesspublic
	 */
	public function sub_agent_list( ){
	
		$model = D( 'Biz/UserManagement' );
	
		//引入查询工具类
		import('ORG.Util.QueryTools');
	
		//实例化联合查询工具类
		$querytools = new QueryTools();
	
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
		$map['pid'] = $this -> loginUserId;
		$map['status'] = 1;
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getSubAgentUserList($map, $fields, $querytools->getOrder(), $querytools->getPageparam());
	
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
	
	
	
		$this->display ( );
	}
	
	/**
	 * 一级代理充值界面
	 */
	function rechargePage(){
	
		$model = D( 'Biz/UserManagement' );
	
		$data 	= $model -> detail( $_GET['id']);
		// 获取该用户开通的产品
		$product_arr = $data['product_arr'];
		foreach ($product_arr as $key => $vo) {
			$ProductOptions[$vo['id']] = $vo['product_name'];
		}
		$page['ProductOptions'] = $ProductOptions;
		
		// 获取代理商的资金池
		$funds = D( 'Biz/Funds' ) -> queryRecordAll(  array('userid' => $this-> loginUserId ),'id,productid,totalfunds,balancefunds,availablefunds');
		
		$page['funds_str'] = json_encode($funds);
		//$funs_pool= D( $this->modelName ) -> getFundsPoolAgent();
	
		//$data['balancefunds'] = $funds['balancefunds'];
		$page['data'] = $data;
		$page['default_productid']= 1;
		foreach ($funds as $vo ){
			if($vo['productid'] == $page['default_productid']){
				$default_product = $vo;
			}
		}
		$page['default_product'] = $default_product;
		$this -> assign($page);
		$this->display(  );
	}
	
	/**
	 * 为子用户代理充值
	 */
	function recharge(){
		$model = D( $this->modelName );
	
		$result = $model -> recharge($_POST);
		if( $result){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '充值成功！',$returnUrl,false,true);
			}else{
				$this->success ( '充值成功！', U ( 'sub_user_list'),false,true);
			}
		}else{
			$this->error ( '充值失败，原因'. $model -> getError() );
		}
	}
	
	
	
	
}