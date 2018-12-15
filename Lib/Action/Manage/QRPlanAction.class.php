<?php

/**
 *  快排宝-计划控制类
 *
 * @category    快排宝-计划控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Service
 * @version     20170629
 * @link        http://www.mitong.com
 */

class QRPlanAction extends BaseAction {
	
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
		
		$this->modelName = "QR/QRPlan";
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index(){
		
		
		$model 		= D( $this->modelName);
	

		//引入查询工具类
		import('ORG.Util.QueryTools');
		
		//实例化联合查询工具类
		$querytools = new QueryTools();
		
		// 查询计划名称
		if($querytools->paramExist('planname')){
		
			//拼接exp条件
			$exp = array('like', '%'.$_GET['planname'].'%');
			$querytools ->addParam('planname','planname',$exp);
		}
		
		// 查询计划状态
		if($querytools->paramExist('planstatus')){
			//拼接exp条件
			$exp = array('eq', $_GET['planstatus']);
			$querytools ->addParam('planstatus','planstatus',$exp);
		}
		
		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');
		
		//组合查询条件
		$query_params = 'planname,planstatus,num_per_page';
		$this->assign('query_params', combo_url_param($query_params));
		
		//添加默认排序参数-时间倒序
		$querytools->addDefOrder('regtime desc');
		
		//将map条件重新赋值
		$map = $querytools->getMap();
		
		$map['status'] = 1;
		
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam());
		
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
	//	$page['PlanStatusOptions']  = C('PlanStatusOptions');
		
		//传值到模板显示
		$this -> assign($page);

		$this->display();
	}
	
	
	/**
	 * 新增计划
	 */
	function insert(){
		
		$model = D( $this->modelName );
	
		$result = $model -> addRecord( $_POST );
	
		if( $result){
				
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '添加成功！',$returnUrl,false,true);
			}else{
				$this->success ( '添加成功！', U ( 'index'),false,true);
			}
				
				
		}else{
			$this->error ( '添加失败！' .$model  -> getError());
		}
	}
	
	
	/**
	 * 修改界面
	 *
	 * @accesspublic
	 */
	public function updatePage(){
		$model = D($this->modelName);
	
		$map['id'] = $_GET['id'];
	
		$data = $model -> selectOne( $map );
	
		$this -> assign('data', $data );
	
		$this->display();
	}
	
	/**
	 * 修改
	 *
	 * @accesspublic
	 */
	public function update(){
		$model = D($this->modelName);
	
		//dump($model);exit;
		$result = $model -> update( $_POST );
	
		if( $result ){
			
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '修改成功！',$returnUrl,false,true);
			}else{
				$this->success ( '修改成功！', U ( 'index'),false,true);
			}
			
		}else{
			$this-> error('修改失败！');
		}
	}
	
	/**
	 * 删除购物车中的关键词
	 */
	function deleteRecord(){
		$model = D( $this->modelName );
		
		
		//判断当前是否可以删除
		$oldData = $model -> selectOne( array('id' => $_GET['id'] ));
		
		if( $oldData['can_delete'] != 1 ){
			$this->error ( '删除失败，您暂时不能删除该关键词！', U ( 'index' ) );
		}
		
		$data['id'] 	= $_GET['id'];
		$data['status'] = 0;
		$result = $model -> update( $data ); 
		
		if ($result) {
			$this->success ( '删除成功！', U ( 'index' ) );
		} else {
			$this->error ( '删除失败！' );
		}
	
	}
	
	/**
	 * 进入关键词审核界面
	 * @accesspublic
	 */
	public function reviewPage(){
		
		$model = D($this->modelName);
	
		$map['id'] = $_GET['id'];
	
		$page['data'] = $model -> selectOne( $map );
		$page['PlanStatusOptions']  = C('PlanStatusOptions');
		$this -> assign($page);
	
		$this->display();
	}
	
	
	/**
	 * 审核关键词
	 */
	function review(){
	
	
		$model 		= D( $this->modelName);
	
		$result = $model -> review( $_POST );
	
		if( $result){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '审核成功！',$returnUrl,false,true);
			}else{
				$this->success ( '审核成功！', U ( 'index'),false,true);
			}
		}else{
			$this->error ( '审核失败！' .$model  -> getError());
		}
	}
	
	/**
	 * 批量审核关键词
	 * 
	 */
	function reviewBatch(){
		$model 		= D( $this->modelName);
		
		$result = $model -> reviewBatch( $_POST );
		if( $result['success']){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '审核成功！',$returnUrl,false,true);
			}else{
				$this->success ( '审核成功！', U ( 'index'),false,true);
			}
		}else{
			$this->error ( '审核失败，账户余额不足！' .$model  -> getError());
		}
	}
	
	/**
	 * 导出关键词到excel
	 */
	function exportKeywords(){
		
		$model 		= D( $this->modelName);
		
		$model -> exportKeywords( $_GET['id'] );
	}
	
	/**
	 * 进入导入报表界面
	 */
	function importReportPage(){
		
		// 获取计划名称
		$this -> display();
	}
	
	function importReport(){
		$model 		= D( $this->modelName);
		$result =  $model -> importReport( $_REQUEST);
		if( $result){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '导入成功！',$returnUrl,false,true);
			}else{
				$this->success ( '导入成功！', U ( 'index'),false,true);
			}
		}else{
			$this->error ( '导入失败！' .$model  -> getError());
		}
	}
	
}