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

class SiteAction extends BaseAction {
	
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
		
		$this->modelName = "Biz/Site";
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index(){
		$model = D($this->modelName);
		//$loginUserName = $this->loginUserName;
		//$list  = $model -> getPendingReviewSites( );
		
		$model = D( $this-> modelName );
		
		//引入查询工具类
		import('ORG.Util.QueryTools');
		
		//实例化联合查询工具类
		$querytools = new QueryTools();
			
		// 用户
		if($querytools->paramExist('createusername')){
			//拼接exp条件
			$exp = array('like', '%'.$_GET['createusername'].'%');
			$querytools ->addParam('createusername','createusername',$exp);
		}
		// 用户
		if($querytools->paramExist('createuserid')){
			//拼接exp条件
			$exp = array('EQ', $_GET['createuserid']);
			$querytools ->addParam('createuserid','createuserid',$exp);
		}
		
		
		// 查询站点名称
		if($querytools->paramExist('sitename')){
			//拼接exp条件
			$exp = array('like', '%'. trim($_GET['sitename']).'%');
			$querytools ->addParam('sitename','sitename',$exp);
		}
		
		// 查询站点地址
		if($querytools->paramExist('website')){
			//拼接exp条件
			$exp = array('like', '%'.trim( $_GET['website'] ).'%');
			$querytools ->addParam('website','website',$exp);
		}
		
		// 查询站点状态
		if($querytools->paramExist('sitestatus')){
			//拼接exp条件
			$exp = array('eq', $_GET['sitestatus']);
			$querytools ->addParam('sitestatus','sitestatus',$exp);
		}
		
		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');
		
		//组合查询条件
		$query_params = 'sitename,website,sitestatus,num_per_page';
		$this->assign('query_params', combo_url_param($query_params));
		$page['query_params'] = combo_url_param($query_params);
		//添加默认排序参数-组织机构代码
			$querytools->addDefOrder('sitestatus ="合作停" ||  sitestatus ="被拒绝",sitestatus desc,id desc');
		
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['status'] 		= 1;
        //如果是分运维登录只显示自己
        $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
        $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
        if($usertype == 'operation'){
            $map['site_manage'] = $username;
        }
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] 		= $model->queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page']);
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
		
		$this -> assign($page);
                
        $url = $_SERVER['REQUEST_URI'] . (strpos($_SERVER['REQUEST_URI'], '?') ? '' : '?');
		$url = substr($url,0,strrpos($url,'?')) . '?'; 
		$this->assign('CURRENT_URL_ADD', $url);
		
		$this->display();
	}
	
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function effect1(){
		$model = D($this->modelName);
		//$loginUserName = $this->loginUserName;
		//$list  = $model -> getPendingReviewSites( );
	
		$model = D( $this-> modelName );
	
		//引入查询工具类
		import('ORG.Util.QueryTools');
	
		//实例化联合查询工具类
		$querytools = new QueryTools();
	
		// 查询站点名称
		if($querytools->paramExist('sitename')){
			//拼接exp条件
			$exp = array('like', '%'.$_GET['sitename'].'%');
			$querytools ->addParam('sitename','sitename',$exp);
		}
	
		// 查询站点地址
		if($querytools->paramExist('website')){
			//拼接exp条件
			$exp = array('like', '%'.$_GET['website'].'%');
			$querytools ->addParam('website','website',$exp);
		}
	
		// 查询站点状态
		if($querytools->paramExist('sitestatus')){
			//拼接exp条件
			$exp = array('eq', $_GET['sitestatus']);
			$querytools ->addParam('sitestatus','sitestatus',$exp);
		}
	
		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');
	
		//组合查询条件
		$query_params = 'sitename,website,sitestatus';
		$this->assign('query_params', combo_url_param($query_params));
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('id desc');
	
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['status'] 		= 1;
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] 		= $model->queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam());
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
		$page['site_status_options'] = C('SiteStatusOptions');
	
		$this -> assign($page);
	
		$this->display();
	}
	
	
	/**
	 * 站点检测效果
	 *
	 */
	function effect(){
		$model = D($this->modelName);
		//$loginUserName = $this->loginUserName;
		$me = $this -> loginUserInfo;
		
		//引入查询工具类
		import('ORG.Util.QueryTools');
		
		//实例化联合查询工具类
		$querytools = new QueryTools();
		
		// 查询站点名称
		if($querytools->paramExist('sitename')){
			//拼接exp条件
			$exp = array('like', '%'.trim($_GET['sitename']).'%');
			$querytools ->addParam('sitename','sitename',$exp);
		}
		
		// 查询站点地址
		if($querytools->paramExist('website')){
			//拼接exp条件
			$exp = array('like', '%'.trim($_GET['website']).'%');
			$querytools ->addParam('website','website',$exp);
		}
		
		//组合查询条件
		$query_params = 'sitename,website,num_per_page';
		//添加默认排序参数-按照天时间排序
		$querytools->addDefOrder('id desc,regtime desc');
		
		//将map条件重新赋值
		$map = $querytools->getMap();

        //如果是分运维登录只显示自己
        $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
        $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
        if($usertype == 'operation'){
            $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
            $ids = array_map('current', $ids);
            $ids = implode(',',$ids);
            if($ids != ''){
                $map['id']  = array('in',$ids);
            }else{
                $map['status'] 			= 999;
            }
        }
		$list  = $model -> getEffect( $map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page'] );
		$this -> assign('list', $list);
	
		$this->display();
	
	}
	/**
	 * 站点日报表：历史效果
	 *
	 */
	function history(){
	
		$model 		= D( $this->modelName);
	
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getHistory( $_GET['id'], $_GET['detecttime'],'admin' );
	 
		//传值到模板显示
		$this -> assign($page);
		$this->display();
	
	}
	
	
	function review(){
		$model 		= D( $this->modelName );

		$result = $model -> review( $_POST );
		
		if ($result) {
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '审核成功！',$returnUrl,false,true);
			}else{
				$this->success ( '审核成功！', U ( 'index'),false,true);
			}
		} else {
			$this->error ( '审核失败！' );
		}
	}

	/**
	 * 显示登录页面
	 * @accesspublic
	 */
	public function reviewPage(){
		$model = D($this->modelName);
		
		$map['id'] = $_GET['id'];
		
		$page['data'] = $model -> selectOne( $map );
		$page['SiteStatusOptions']  = C('SiteStatusOptions');
		
		$this -> assign($page );
		
		$this->display();
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
		
		$page['ManageBackgroundStatusOptions']  = C('ManageBackgroundStatusOptions');
		$this -> assign($page );
		
		$this->display();
	}
	
	/**
	 * 修改站点信息
	 * 
	 * @accesspublic
	 */
	public function update(){
		$model = D($this->modelName);
	
		$result = $model -> update_record( $_POST );
	
		if( $result ){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '修改站点成功！',$returnUrl,false,true);
			}else{
				$this->success ( '修改站点成功！', U ( 'index'),false,true);
			}
		}else{
			$this-> error('修改站点失败！');
		}
	}
	
	/**
	 * 显示详情页面
	 * 
	 * @accesspublic
	 */
	public function detail(){
		
		$model = D($this->modelName);
	
		$map['id'] = $_GET['id'];
		
		$data = $model -> selectOne( $map );

		$this -> assign('data', $data );
		
		$this->display();
	}
	
	/**
	 * 删除站点
	 * 
	 * @accesspublic
	 */
	public function deleteRecord(){
	
		$model = D($this->modelName);
	
		$map['id'] = $_GET['id'];
	
		$result = $model -> deleteRecord( $map );
		if( $result ){
			$this-> success('删除站点成功！' , U('index'));
			//header();
		}else{
			$this-> error('删除站点失败！');
		}
	
	}

    /**
     * author L
     */
    public function getSiteID(){
        $username = $_POST['username'];
        $ids = $_POST['ids'];
        $res = D($this->modelName)->distribution($username,$ids);
        if($res){
            echo json_encode(array('message'=>'站点分配成功','status' => 200));
        }else{
            echo json_encode(array('message'=>'站点分配失败','status' => 202));
        }
    }
	
	

	
}