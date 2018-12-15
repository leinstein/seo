<?php

/**
 * 前台公共控制层类：关键词清单（购物车）前台控制类
 *
 * @category   业务控制类
 * @copyright   Copyright 20170-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Manage
 * @version     20170519
 * @link        http://www.mitong.com
 */

class CartAction extends BaseAction {
	
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
		
		$this->modelName = "Biz/Cart";
	}
	
	
	
	
	/**
	 * 显示页面
	 * @accesspublic
	 */
	public function index(){
		
		$model = D( $this->modelName );
		
		// 系统统计模型
		$model_static = D('Biz/Statistics');
		
		//引入查询工具类
		import('ORG.Util.QueryTools');
		
		//实例化联合查询工具类
		$querytools = new QueryTools();
		
		// 查询关键词
		if($querytools->paramExist('keyword')){
		
			//拼接exp条件
			$exp = array('like', '%'.trim($_GET['keyword']).'%');
			$querytools ->addParam('keyword','keyword',$exp);
		}
		
		// 查询网站
		if($querytools->paramExist('website')){
			//拼接exp条件
			$exp = array('like', '%'.trim($_GET['website']).'%');
			$querytools ->addParam('website','website',$exp);
		}
		
		// 查询关键词状态
		if($querytools->paramExist('createuserid')){
			//拼接exp条件
			$exp = array('eq', $_GET['createuserid']);
			$querytools ->addParam('createuserid','createuserid',$exp);
		}
		
		
		// 查询搜索引擎
		if($querytools->paramExist('searchengine')){
			//拼接exp条件
			$exp = array('eq', $_GET['searchengine']);
			$querytools ->addParam('searchengine','searchengine',$exp);
		}
		
		
		//组合查询条件
		$query_params = 'keyword,createuserid,searchengine';
		$this->assign('query_params', combo_url_param($query_params));
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('id desc');
		//添加排序参数
		if( $_GET['ord'] == 'latestranking'){
			$querytools->addOrder('latestranking','latestranking!=0 desc,latestranking,id desc');
		}else{
			$querytools->addOrder($_GET['ord'],$_GET['ord'].',id desc');
		}
		//翻页后仍能按照某字段排序
		$querytools ->addParam('ord');
		
		//将map条件重新赋值
		$map = $querytools->getMap();
		
		$map['status'] = 1;
		$map['cartstatus'] = '待购买';
        //如果是分运维登录只显示自己
        $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
        $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
        if($usertype == 'operation'){
            $createusername = M('Site')->field('createusername')->where(array('site_manage'=>$username))->select();
            $createusername = array_map('current', $createusername);
            $createusername = implode(',',$createusername);
            if($createusername != ''){
                $map['createusername']  = array('in',$createusername);
            }else{
                $map['status'] 			= 999;
            }
        }
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model-> queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam(), $_GET['num_per_page'] );
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
		
		// 搜索引擎
		$page['SearchengineOptions']  = C('SearchengineOptions');
		
		// 获取系统的全部子用户
		$UserOptions = $model_static -> getSubUsers();
		$page['UserOptions']  = $UserOptions;
		$page['PerPageOptions']  = C ( 'PerPageOptions');
		
		//传值到模板显示
		$this -> assign($page);
		$this->display();
		
	}
	
	/**
	 * 调整价格
	 * 
	 * @accesspublic
	 */
	public function adjustPrice(){
	
		$model = D( $this->modelName );
	
		$result = $model -> adjustPrice( $_POST );
		if( $result){
				
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '调整价格成功！',$returnUrl, false,true);
			}else{
				$this->success ( '调整价格成功！', U ( 'index'),false,true);
			}
				
				
		}else{
			$this->error ( '调整价格失败！' .$model  -> getError());
		}
	}
	

	
}