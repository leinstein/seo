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

class KeywordAction extends BaseAction {
	
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
		
		$this->modelName = "Biz/Keyword";
	}

	/**
	 * 搜索关键词
	 *
	 * 通过第三方接口搜索关键词
	 *
	 * @accesspublic
	 */
	public function search(){
	
		$model 		= D( $this->modelName);
	
		$kws 		= $_GET['kws'];
	
		$keywords 	= $_GET['keywords'];
		if( $kws ){
			// 将回车换行替换成逗号
			$keywords = str_replace(array("\r\n", "\r", "\n"), ",", $kws);
	
		}else  if( $keywords ){
			//将回车换行替换成都好
			$kws = str_replace(",","\r\n", $keywords);
			$kws = str_replace(",","\r", $keywords);
			$kws = str_replace(",","\n", $keywords);
		}
	
		$keyword_arr = explode(',' , $keywords );
		// 去重空值
		$keyword_arr = array_filter( $keyword_arr );
		// 去重操作
		$keyword_arr = array_values(array_unique( $keyword_arr ));

		$this -> assign('kws',$kws);
		$this -> assign('keywords',$keywords);

		// 如果关键词存在才进行查询
		if( $keywords ){
			$list = $model -> search( $keyword_arr );
		}

		$this -> assign('list',$list);

		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );
	}
	
	/**
	 * 搜索推荐关键词:
	 *
	 * 通过第三方接口搜索关键词
	 *
	 * @accesspublic
	 */
	public function searchRecommend(){
	
		$model 		= D( $this->modelName);
	
		$keywords 		= $_GET['keywords'];
	
	
		$keyword_arr = explode(',' , $keywords );
		// 去重空值
		$keyword_arr = array_filter( $keyword_arr );
		// 去重操作
		$keyword_arr = array_values(array_unique( $keyword_arr ));
	
	
		$list = $model -> searchRecommend( $keyword_arr );
	
		exit(json_encode($list));
	}
	
	
	/**
	 * 站点检测效果
	 *
	 */
	function effect(){
		$model = D($this->modelName);
		
		//引入查询工具类
		import('ORG.Util.QueryTools');
		
		//实例化联合查询工具类
		$querytools = new QueryTools();
		
		// 手机端查询
		if( $this -> isMobile ){
				
			//添加默认排序参数-按照天时间排序
			$querytools->addDefOrder('id desc');
			//添加排序参数
			if( $_GET['ord'] == 'latestranking'){
				$querytools->addOrder('latestranking','latestranking!=0 desc,latestranking,id desc');
			}else{
				$querytools->addOrder($_GET['ord'],$_GET['ord'].',id desc');
			}
			//翻页后仍能按照某字段排序
			$querytools ->addParam('ord');
				
			$map['createuserid'] 	= $this -> loginUserId;
			$map['status'] = 1;
		
				
			if( $_GET['keyword'] ){
				$map['keyword|website'] = array('like', '%'.$_GET['keyword'].'%');
			}
		
			$page = $model -> getEffectForAgent( $map ,$fields, $querytools->getOrder());
				
			// 高亮关键词
			foreach ($page['list']['data'] as &$vo ){
				$vo['keyword'] = str_replace($_GET['keyword'],'<span style="color: #c00">'.$_GET['keyword'] .'</span>' , $vo['keyword']);
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
		
			// 查询关键词
			if($querytools->paramExist('keyword')){
			
				//拼接exp条件
				$exp = array('like', '%'.$_GET['keyword'].'%');
				$querytools ->addParam('keyword','keyword',$exp);
			}
			
			// 查询网站
			if($querytools->paramExist('website')){
				//拼接exp条件
				if( $_GET['from'] == 'site' && !is_url( $_GET['website'] ) ){
					$_GET['website'] = base64_decode ( $_GET['website']);
				}
				$exp = array('like', '%'.$_GET['website'].'%');
				$querytools ->addParam('website','website',$exp);
			}
			
			// 查询关键词状态
			if($querytools->paramExist('keywordstatus')){
				//拼接exp条件
				$exp = array('eq', $_GET['keywordstatus']);
				$querytools ->addParam('keywordstatus','keywordstatus',$exp);
			}
			
			// 查询关键词达标状态
			if($querytools->paramExist('standardstatus')){
				//拼接exp条件
				$exp = array('eq', $_GET['standardstatus']);
				$querytools ->addParam('standardstatus','standardstatus',$exp);
			}
			
			// 查询搜索引擎
			if($querytools->paramExist('searchengine')){
				//拼接exp条件
				$exp = array('eq', $_GET['searchengine']);
				$querytools ->addParam('searchengine','searchengine',$exp);
			}
			
			//组合查询条件
			$query_params = 'keyword,website,keywordstatus,standardstatus,searchengine,num_per_page';
			$this->assign('query_params', combo_url_param($query_params));
			$data['query_params'] = combo_url_param($query_params);
			
			//添加默认排序参数-按照天时间排序
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
			
			$me = $this -> loginUserInfo;
			switch (  $me ['usertype']  ) {
					
				case 'agent':// 一级代理
		
					$data['record']  = $model -> getEffectForAgent( $map, $fields, $querytools->getOrder(), $querytools->getPageparam() ,$_GET['num_per_page'] );
		
					break;
                case 'agent2':// 一级代理

                    $data['record']  = $model -> getEffectForAgent( $map, $fields, $querytools->getOrder(), $querytools->getPageparam() ,$_GET['num_per_page'] );

                    break;
						
				case 'sales_manager':// 销售经理：获取自己的客户或者员工的客户
		
					$data['record']  = $model -> getEffectForSaleManager( $map, $fields, $querytools->getOrder(), $querytools->getPageparam() ,$_GET['num_per_page'] );
		
					break;
				case 'seller':// 销售：获取自己的客户
		
					$data['record']  = $model -> getEffectForSeller( $map, $fields, $querytools->getOrder(), $querytools->getPageparam() ,$_GET['num_per_page'] );
		
					break;
				case 'customer_manager':// 客服经理：获取自己的客户或者员工的客户
		
					$data['record']  = $model -> getEffectForCustomerManager( $map, $fields, $querytools->getOrder(), $querytools->getPageparam() ,$_GET['num_per_page'] );
		
					break;
				case 'customer':// 客服：获取自己的客户
		
					$data['record']  = $model -> getEffectForCustomer( $map, $fields, $querytools->getOrder(), $querytools->getPageparam() ,$_GET['num_per_page'] );
		
					break;
						
				default:
		
					break;
			}
		
			$data['urlparams'] = $querytools ->getUrlparam();
			$page['data'] = $data;
			
			//传值到模板显示
			$this -> assign($page);
		}
	
		$this->display( $tpl );
	
	}
	
	/**
	 * 关键词效果监测
	 * 
	 * @accesspublic
	 */
	public function effect1(){
	
	
		$model 		= D( $this->modelName);
		
		//引入查询工具类
		import('ORG.Util.QueryTools');
	
		//实例化联合查询工具类
		$querytools = new QueryTools();
	
		// 查询关键词
		if($querytools->paramExist('keyword')){
		
			//拼接exp条件
			$exp = array('like', '%'.$_GET['keyword'].'%');
			$querytools ->addParam('keyword','keyword',$exp);
		}
		
		// 查询网站
		if($querytools->paramExist('website')){
			//拼接exp条件
			if( $_GET['from'] == 'site' && !is_url( $_GET['website'] ) ){
				$_GET['website'] = base64_decode ( $_GET['website']);
			}
			$exp = array('like', '%'.$_GET['website'].'%');
			$querytools ->addParam('website','website',$exp);
		}
		
		// 查询关键词状态
		if($querytools->paramExist('keywordstatus')){
			//拼接exp条件
			$exp = array('eq', $_GET['keywordstatus']);
			$querytools ->addParam('keywordstatus','keywordstatus',$exp);
		}
		
		// 查询关键词达标状态
		if($querytools->paramExist('standardstatus')){
			//拼接exp条件
			$exp = array('eq', $_GET['standardstatus']);
			$querytools ->addParam('standardstatus','standardstatus',$exp);
		}
		
		// 查询搜索引擎
		if($querytools->paramExist('searchengine')){
			//拼接exp条件
			$exp = array('eq', $_GET['searchengine']);
			$querytools ->addParam('searchengine','searchengine',$exp);
		}
	
		//组合查询条件
		$query_params = 'keyword,website,keywordstatus,standardstatus,searchengine,num_per_page';
		$this->assign('query_params', combo_url_param($query_params));
		$data['query_params'] = combo_url_param($query_params);
	
		//添加默认排序参数-按照天时间排序
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
		$map['createuserid'] 	= $this -> loginUserId;
		$map['status'] = 1;
	
		//获得查询结果，传值到模板输出查询的结果
		$data['record'] = $model->getEffectForAgent($map, $fields, $querytools->getOrder(), $querytools->getPageparam() ,$_GET['num_per_page']);
		//查询的参数字符串
		//$page['urlparams'] = $querytools ->getUrlparam();
		$data['urlparams'] = $querytools ->getUrlparam();
		$page['data'] = $data;
	
		//传值到模板显示
		$this -> assign($page);
	
		$this->display();
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
	 * 关键词日报表：历史效果
	 *
	 */
	function history(){
	
		$model 		= D( $this->modelName);
	
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getHistory( $_GET['id'], $_GET['detecttime'] );
	
		//传值到模板显示
		$this -> assign($page);
		$this->display();
	
	}
	
}