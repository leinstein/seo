<?php

/**
 * 前台公共控制层类
 *
 * @category   快排宝-关键词控制类类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Service
 * @version     20170629
 * @link        http://www.mitong.com
 */

class QRKeywordAction extends BaseAction {
	
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
		
		$this->modelName = "QR/QRKeyword";
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
		
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			if( $_GET['keyword'] ){
				$map['keyword'] = array('like', '%'.$_GET['keyword'].'%');
			}
			$map['createuserid'] 	= $this -> loginUserId;
			$map['status'] = 1;
			$page['list']  = $model -> getEffectForAgent($map, $fields, $querytools->getOrder(), $querytools->getPageparam());
				
			// 高亮关键词
			foreach ($page['list']['data'] as &$vo ){
				$vo['keyword'] = str_replace($_GET['keyword'],'<span style="color: #c00">'.$_GET['keyword'] .'</span>' , $vo['keyword']);
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
					
			// 查询关键词状态
			if($querytools->paramExist('keywordstatus')){
				//拼接exp条件
				$exp = array('eq', $_GET['keywordstatus']);
				$querytools ->addParam('keywordstatus','keywordstatus',$exp);
			}
			
			// 查询所属的计划
			if($querytools->paramExist('planid')){
				//拼接exp条件
				$exp = array('eq', $_GET['planid']);
				$querytools ->addParam('planid','planid',$exp);
			}
			
			//翻页后仍能按照某字段排序
			$querytools ->addParam('order');
			
			//组合查询条件
			$query_params = 'keyword,keywordstatus,planid,num_per_page';
			$this->assign('query_params', combo_url_param($query_params));
			//添加默认排序参数-组织机构代码
			$querytools->addDefOrder('id desc');
		
			//将map条件重新赋值
			$map = $querytools->getMap();
			
			// 获取我的全部子用户
			$model_statistics = D('QR/Statistics');
			
			$userids = $model_statistics -> 	getUserids();
			
			if( $userids ){
				$map['createuserid'] 	= array('IN',$userids);
				$map['status'] = 1;
				//获得查询结果，传值到模板输出查询的结果
				$page['list'] = $model->queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam() , $_GET['num_per_page']);
				
				// 高亮关键词
				foreach ($page['list']['data'] as &$vo ){
					$vo['keyword'] = str_replace( trim($_GET['keyword']),'<span style="color: #c00">'.trim($_GET['keyword']) .'</span>' , $vo['keyword']);
				}
				
				//查询的参数字符串
				$page['urlparams'] = $querytools ->getUrlparam();
				
				// 获取我的子用户全部计划
				$plans = D('QR/QRPlan') -> getPlansByUserids( $userids );
				 
				foreach ( $plans as $vo1 ){
					$PlanOptions[$vo1['id']] = $vo1['planname'];
				}
				$data['PlanOptions']  = $PlanOptions;
				$page['data']  		= $data;
			}
			
			
			
			//传值到模板显示
			$this -> assign($page);
		}
	
 
		$this->display ( $tpl );
	}
	
	
	/**
	 * 关键词效果
	 *
	 * @accesspublic
	 */
	public function effect(){
	
		$model 		= D( $this->modelName);
	
		//引入查询工具类
		import('ORG.Util.QueryTools');
	
		//实例化联合查询工具类
		$querytools = new QueryTools();
	
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			if( $_GET['keyword'] ){
				$map['keyword'] = array('like', '%'.$_GET['keyword'].'%');
			}
			$map['createuserid'] 	= $this -> loginUserId;
			$map['status'] = 1;
			$page['list']  = $model -> getEffect($map, $fields, $querytools->getOrder(), $querytools->getPageparam());
	
			// 高亮关键词
			foreach ($page['list']['data'] as &$vo ){
				$vo['keyword'] = str_replace($_GET['keyword'],'<span style="color: #c00">'.$_GET['keyword'] .'</span>' , $vo['keyword']);
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
				$exp = array('like', '%'.trim( $_GET['keyword']).'%');
				$querytools ->addParam('keyword','keyword',$exp);
			}
	
				
			// 查询检测开始时间
			if ( $querytools->paramExist ( 'detecttime' ) ) {
				unset( $exp );
				$detecttime_arr = explode(' ~ ',$_GET['detecttime']);
				// 拼接map条件
				$exp[] = array ('EGT',trim ( $detecttime_arr[0] ) );
				// 拼接map条件
				$lastDate = date("Y-m-d",strtotime("$detecttime_arr[1]   +1   day"));
				$exp[] = array ('LT', $lastDate );
				$querytools->addParam ( 'detecttime', 'detecttime', $exp );
			}
				
			// 查询关键词
			if($querytools->paramExist('searchengine')){
					
				//拼接exp条件
				$exp = array('EQ', trim( $_GET['searchengine']));
				$querytools ->addParam('searchengine','searchengine',$exp);
			}
				
				
			//翻页后仍能按照某字段排序
			$querytools ->addParam('order');
	
			//组合查询条件
			$query_params = 'keyword,detecttime,searchengine,num_per_page';
			$this->assign('query_params', combo_url_param($query_params));
			//添加默认排序参数-组织机构代码
			$querytools->addDefOrder('detecttime desc');
	
			//将map条件重新赋值
			$map = $querytools->getMap();
				
			//获得查询结果，传值到模板输出查询的结果
			$list = $model->getEffect($map, $fields, $querytools->getOrder(), $querytools->getPageparam() , $_GET['num_per_page']);
				
			// 高亮关键词
			foreach ($list['data'] as &$vo ){
				$vo['keyword'] = str_replace( trim($_GET['keyword']),'<span style="color: #c00">'.trim($_GET['keyword']) .'</span>' , $vo['keyword']);
			}
			$page['list'] = $list;
			//查询的参数字符串
			$page['urlparams'] = $querytools ->getUrlparam();
	
	
			//传值到模板显示
			$this -> assign($page);
		}
	
		$this->display ( $tpl );
	}
	
	
	
}