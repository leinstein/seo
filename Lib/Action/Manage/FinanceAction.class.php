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
	 * 资金池管理
	 * 
	 * 获取当前资金池的总金额，已经消费金额 资金池金额充值总金额、消费金额、剩余金额
	 */
	function pool(){
		
		$model = D( $this->modelName );
		
		$data = $model -> getFundsPool();
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
		$page['pools'] = json_encode($pies) ;
		$page['data'] = $data;
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
		$page['list'] = $model -> getEntryRecords();
		//传值到模板显示
		$this -> assign($page);
		$this->display();
	}
	
	/**
	 * 一级代理充值界面
	 */
	function agent_user_list(){
		
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
		
		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');
		
		//组合查询条件
		$query_params = 'username';
		$this->assign('query_params', combo_url_param($query_params));
		$page['query_params'] = combo_url_param($query_params);
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('id desc');
		
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['status'] = 1;
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getAgentUserList($map, $fields, $querytools->getOrder(), $querytools->getPageparam());
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
		
		
	
		//传值到模板显示
		$this -> assign($page);
		$this->display();
	}
	
	/**
	 * 查看子用户列表界面
	 * 
	 * 
	 * @accesspublic
	 */
	public function sub_user_list( ){
	
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
		if($querytools->paramExist('pid')){
		
			//拼接exp条件
			$exp = array('EQ', $_GET['pid']);
			$querytools ->addParam('pid','pid',$exp);
		}
		
		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');
	
		//组合查询条件
		$query_params = 'username,pid';
		$this->assign('query_params', combo_url_param($query_params));
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('pid desc');
	
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['status'] = 1;
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getSubUserList($map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page'] ,'operation' );
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
	
		//传值到模板显示
		$this -> assign($page);
	
		$this->display (  );
	}

	/**
	 * 一级代理充值界面
	 */
	function rechargePage(){
	
		$model = D( 'Biz/UserManagement' );
	
		$data = $model -> detail( $_GET['id']);
		$page['data'] = $data;

		// 获取该用户开通的产品
		$product_arr = $data['product_arr'];
		foreach ($product_arr as $key => $vo) {
			$ProductOptions[$vo['id']] = $vo['product_name'];
		}
		$page['ProductOptions'] = $ProductOptions;
		
		$this -> assign($page);
		$this->display(  );
	}
	
	/**
	 * 一级代理充值界面
	 */
	function recharge(){
		$model = D( $this->modelName );
		
		$result = $model -> recharge($_POST);

		if( $result){
			$returnUrl = $_REQUEST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '充值成功！',$returnUrl,false,true);
			}else{
				$this->success ( '充值成功！', U ( 'agent_user_list'), false, true);
			}
		}else{
			$this->error ( '充值款失败，原因'. $model -> getError()  );
		}
	}
	
	
	/**
	 * 子用户退款界面
	 * 
	 */
	function refundsPage(){
		$model = D( 'Biz/UserManagement' );
		// 获取该用户的信息
		$data = $model -> detail( $_GET['id']);
		// 渲染到界面
		$page['data'] = $data;
	
		// 获取该用户开通的产品
		$product_arr = $data['product_arr'];
		foreach ($product_arr as $key => $vo) {
			$ProductOptions[$vo['id']] = $vo['product_name'];
		}
		$page['ProductOptions'] = $ProductOptions;
		
		// 获取用户的产品资金池
		$funds_list = $model -> getFundsSub( $data['id']);
		if( $funds_list ){
			$page['has_funds'] = 1;
			$page['funds_str'] = json_encode( $funds_list );
		}else{
			foreach ($ProductOptions as $key => $vo ){
				$funds['userid'] 	= $data['id'];
				$funds['productid'] = $key;
				$funds['totalfunds'] = 0;
				$funds['balancefunds'] = 0;
				$funds['availablefunds'] = 0;
				$funds_list[] = $funds;
			}
		}
		$page['funds_str'] = json_encode( $funds_list );
		
		$this -> assign($page);
		
		$this->display(  );
	}
	
	/**
	 * 一级代理充值界面
	 */
	function refunds(){
		$model = D( $this->modelName );
		$result = $model -> refunds($_POST);
	
		if( $result){
			$returnUrl = $_REQUEST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '退款成功！',$returnUrl,false,true);
			}else{
				$this->success ( '退款成功！', U ( 'sub_user_list'), false, true);
			}
		}else{
			$this->error ( '退款失败，原因'. $model -> getError()  );
		}
	}
	
	
}