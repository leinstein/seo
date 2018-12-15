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
		$me = $this -> loginUserInfo;
		
		$this -> assign( $page );
		
		$this->display();
	}
	
	
	/**
	 * 站点检测效果
	 *
	 */
	function effect(){
	
		$model = D($this->modelName);
	
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			if( $_GET['keyword'] ){
				$map['sitename|website'] = array('like', '%'.$_GET['keyword'].'%');
			}
				
			$page['list']  = $model -> getEffectForAgent( $this -> loginUserId, $map  );
			// 高亮关键词
			foreach ($page['list']['data'] as &$vo ){
				$vo['sitename'] = str_replace($_GET['keyword'],'<span style="color: #c00">'.$_GET['keyword'] .'</span>' , $vo['sitename']);
				$vo['website'] = str_replace($_GET['keyword'],'<span style="color: #c00">'.$_GET['keyword'] .'</span>' , $vo['website']);
			}
				
				
			$tpl =  ACTION_NAME . ".mobile";
			//传值到模板显示
			$this -> assign($page);
			//判断是否为第一页,如果不是第一页通过ajax返回数据
			if( $_GET['p'] >= 2 ){
				//exit(json_encode( $data['MyBizProgress']['data'] ));
				//通过fetch的方式进行渲染
				$content = $this->fetch( 'tpl/'. $tpl  );
				exit($content);
			}
		}else{
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
						
			//组合查询条件
			$query_params = 'sitename,website,num_per_page';
			//添加默认排序参数-按照天时间排序
			$querytools->addDefOrder('id desc,regtime desc');
				
			//将map条件重新赋值
			$map = $querytools->getMap();
				
			//$loginUserName = $this->loginUserName;
			$page['list']  = $model -> getEffect( $map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page']  );
				
		}
	
		//传值到模板显示
		$this -> assign($page);
	
		$this->display ( $tpl );
	
	}
	
	/**
	 * 站点日报表：历史效果
	 *
	 */
	function history(){
	
		$model 		= D( $this->modelName);
	
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getHistory( $_GET['id'], $_GET['detecttime'],'agent' );
	
		//传值到模板显示
		$this -> assign($page);
		$this->display();
	
	}
	
	/**
	 * 显示登录页面
	 * @accesspublic
	 */
	public function insert(){
		$model = D($this->modelName);
		
		//dump($model);exit;
		$result = $model -> insert( $_POST );
		
		if( $result ){
			$this-> success('新增站点成功！' , U('index'));
		}else{
			$this-> error('新增站点失败！');
		}
	}
	
	/**
	 * 显示登录页面
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
	
		$result = $model -> update( $_POST );
	
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
}