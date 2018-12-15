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

class UserRoleAction extends BaseAction {
	
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
		// 初始化用户模型
		$this -> modelName = 'User/UserRole';
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
		
		//查询项目进度
		if($querytools->paramExist('rolename')){
		
			//拼接exp条件
			$exp = array('like', '%'.$_GET['rolename'].'%');
			$querytools ->addParam('rolename','rolename',$exp);
		}
		
		//组合查询条件
		$query_params = 'rolename,num_per_page';
		$this->assign('query_params', combo_url_param($query_params));
		$page['query_params'] = combo_url_param($query_params);
		
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('id');
		
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['status'] = 1;
		
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->queryRecordEx( $map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page'] );
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
		
		$this -> assign( $page );
		
		$this->display();
	}
	
	
	
}