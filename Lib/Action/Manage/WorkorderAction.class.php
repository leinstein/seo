<?php

/**
 * 前台公共控制层类：工单管理控制类
 *
 * @category    业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Manage
 * @version     20170707
 * @link        http://www.mitong.com
 */
class WorkorderAction extends BaseAction {
	
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
		
		$this->modelName = "Biz/Workorder";
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index() {

		$model = D($this->modelName);
		
		
		//引入查询工具类
		import('ORG.Util.QueryTools');
		
		// 实例化联合查询工具类
		$querytools = new QueryTools();
		
		// 查询产品
		if($querytools->paramExist('productid')){
		
			//拼接exp条件
			$exp = array('EQ', $_GET['productid'] );
			$querytools ->addParam('productid','productid',$exp);
		}
			
		// 查询对象
		if($querytools->paramExist('objecttype')){
			//拼接exp条件
			$exp = array('EQ', $_GET['objecttype'] );
			$querytools ->addParam('objecttype','objecttype',$exp);
		}
		
		// 查询对象id
		if($querytools->paramExist('objectid')){
			//拼接exp条件
			$exp = array('EQ', $_GET['objectid'] );
			$querytools ->addParam('objectid','objectid',$exp);
		}
		
		// 查询标题
		if($querytools->paramExist('title')){
			//拼接exp条件
			$exp = array('like', '%'.$_GET['title'].'%');
			$querytools ->addParam('title','title',$exp);
		}
		
		// 查询业务状态
		if($querytools->paramExist('bizstatus')){
			//拼接exp条件
			$exp = array('eq', $_GET['bizstatus']);
			$querytools ->addParam('bizstatus','bizstatus',$exp);
		}
		
		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');
		
		//组合查询条件
		$query_params = 'productid,objecttype,objectid,title,bizstatus,num_per_page';
		$this->assign('query_params', combo_url_param($query_params));
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('regtime asc');
		
		//将map条件重新赋值
		$map = $querytools->getMap();
		// 根据用户类型来判断查询的权限
		$me = $this -> loginUserInfo;
		switch ( $me['usertype'] ) {
			case 'operation_manager':
			case 'operation':
			break;
			case 'seller':// 销售员：只能查看自己的工单
				$map['createuserid'] = $this -> loginUserId;
				break;
			case 'sales_manager':// 销售经理：可以查看自己和属下的工单
				$userids[] = $this -> loginUserId;
				$child = D('User/User') -> getChildrenUsers( $this -> loginUserId );
				foreach ($child as $vo){
					$userids[]  = $vo['id'];
				}
				if( $userids ){
					$map['createuserid'] = array('IN', $userids);
				}
				
				break;
			
			default:
				;
			break;
		}
		
		$map['status'] = 1;
        //如果是分运维登录只显示自己
        $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
        $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
        if($usertype == 'operation'){
            $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
            $ids = array_map('current', $ids);
            $ids = implode(',',$ids);
            if($ids != ''){
                $map['objectid']  = array('in',$ids);
            }else{
                $map['status'] 			= 999;
            }
        }
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->queryRecordEx($map, $fields, 'regtime desc', $querytools->getPageparam(), $_GET['num_per_page']);
		
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
		
		// 判断是否能新增
		/* foreach ($page['list']['data'] as $vo ){
			if($vo['bizstatus'] !="已完成"){
				$can_not_add = 1;
				break;
			}
		}
		//$page['can_not_add'] = $can_not_add; */
		//传值到模板显示
		$this -> assign($page);
	
		$this->display ();
	}
	
	
	/**
	 * 工单列表
	 * 
	 * @accesspublic
	 */
	public function list_page() {
	
		$model = D($this->modelName);
		
		
		//引入查询工具类
		import('ORG.Util.QueryTools');
		
		// 实例化联合查询工具类
		$querytools = new QueryTools();
		
		// 查询产品
		if($querytools->paramExist('productid')){
		
			//拼接exp条件
			$exp = array('EQ', $_GET['productid'] );
			$querytools ->addParam('productid','productid',$exp);
		}
		
		
		// 查询对象
		if($querytools->paramExist('objecttype')){
			//拼接exp条件
			$exp = array('EQ', $_GET['objecttype'] );
			$querytools ->addParam('objecttype','objecttype',$exp);
		}
		
		// 查询对象id
		if($querytools->paramExist('objectid')){
			//拼接exp条件
			$exp = array('EQ', $_GET['objectid'] );
			$querytools ->addParam('objectid','objectid',$exp);
		}
		
		// 查询标题
		if($querytools->paramExist('title')){
			//拼接exp条件
			$exp = array('like', '%'.$_GET['title'].'%');
			$querytools ->addParam('title','title',$exp);
		}
		
		// 查询业务状态
		if($querytools->paramExist('bizstatus')){
			//拼接exp条件
			$exp = array('eq', $_GET['bizstatus']);
			$querytools ->addParam('bizstatus','bizstatus',$exp);
		}
		
		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');
		
		//组合查询条件
		$query_params = 'productid,siteid,title,bizstatus,num_per_page';
		$this->assign('query_params', combo_url_param($query_params));
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('regtime desc');
	
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['status'] = 1;
		
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam(), $_GET['num_per_page']);
		
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
		
		// 判断是否能新增
		foreach ($page['list']['data'] as $vo ){
			if($vo['bizstatus'] !="已完成"){
				$can_not_add = 1;
				break;
			}
		}
		//$page['can_not_add'] = $can_not_add;
		//传值到模板显示
		$this -> assign($page);
		
		
		
	
		$this->display ();
	}
	
	/**
	 * 修改界面
	 *
	 * @accesspublic
	 */
	public function insertPage(){
		$data['productid'] = $_GET['productid'];
	
		$data['objectid'] = $_GET['objectid'];
		
		$data['objecttype'] = $_GET['objecttype'];
		
		$data['returnUrl'] = $_GET['returnUrl'];
		
		// 根据不同的工单对象来组合不同的对象id
		switch ( $data['objecttype'] ) {
			case 'site':
				
				break;
		
			default:
				;
				break;
		}
	
		$this -> assign('data', $data );
	
		$this->display();
	}
	
	
	
	/**
	 * 显示登录页面
	 * @accesspublic
	 */
	public function insert(){
		$model = D($this->modelName);
		$result = $model -> addRecord( $_POST );
	
		if( $result ){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '保存成功！',$returnUrl,false,true);
			}else{
				$this->success ( '保存成功！', U ( 'index'),false,true);
			}
			
		}else{
			$this-> error('保存失败，'. $model -> getError());
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
	
		$page['data'] = $model -> selectOne( $map );
		
		$page['data']['file_arra']["cannotedit"] = 0 ;
		$this -> assign( $page );
	
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
		$result = $model -> updateRecord( $_POST );
	
		if( $result ){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '保存成功！',$returnUrl,false,true);
			}else{
				$this->success ( '保存成功！', U ( 'index'),false,true);
			}
				
		}else{
			$this-> error('保存失败，'. $model -> getError());
		}
	}
	
	/**
	 * 显示登录页面
	 * @accesspublic
	 */
	public function detail(){
	
		$model = D($this->modelName);
	
		$map['id'] = $_GET['id'];
	
		$page['data'] = $model -> selectOne( $map );
		
		$this -> assign( $page );
	
		$this->display();
	}
	
	/**
	 * 显示回复详情
	 *
	 * @accesspublic
	 */
	public function reply_list(){
	
		$model = D($this->modelName);
	
		$map['id'] = $_GET['id'];
	
		$page['data'] = $model -> selectOne( $map );
	
		$page['returnUrl'] = $_GET['returnUrl'];
	
		$this -> assign( $page );
	
		$this->display();
	}
	
	/**
	 * 显示回复页面
	 *
	 * @accesspublic
	 */
	public function replyPage(){
	
		$model = D($this->modelName);
	
		$map['id'] = $_GET['id'];
	
		$page['data'] = $model -> selectOne( $map );
	
		$page['returnUrl'] = $_GET['returnUrl'];
	
		$this -> assign( $page );
	
		$this->display();
	}
	
	
	/**
	 * 回复
	 *
	 * @accesspublic
	 */
	public function reply(){
		$model = D($this->modelName);
	
		$result = $model -> reply( $_POST );
	
		if( $result ){
			$returnUrl = $_POST['returnUrl'];
			
			if( $returnUrl ){
				$this->success ( '保存成功！',$returnUrl);
			}else{
				$this->success ( '保存成功！', U ( 'replyPage',array('id' => $_POST['workorderid']) ));
			}

		}else{
			$this-> error('保存失败！');
		}
	}
	
	
	
	
	/**
	 * 关闭工单
	 * 
	 * @accesspublic
	 */
	public function closeRecord(){
	
		$model = D($this->modelName);
	
		$result = $model -> closeRecord( $_GET['id'] );
		if( $result ){
			$this-> success('操作成功！' , U('index'));
			//header();
		}else{
			$this-> error('操作失败！');
		}
	
	}
	
	
	/**
	 *  删除记录
	 * @accesspublic
	 */
	public function deleteRecord(){
	
		$model = D($this->modelName);
	
		$map['id'] = $_GET['id'];
	
		$result = $model -> deleteRecord( $map );
		if( $result ){
			$this-> success('操作成功！' , U('index'));
			//header();
		}else{
			$this-> error('操作失败！');
		}
	
	}
	
	
	
	
}