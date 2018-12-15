<?php

/**
 *  快排宝-报表统计控制类
*
* @category    快排宝-计划控制类
* @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
* @package     Action.Agent
* @version     20170629
* @link        http://www.mitong.com
*/

class QRReportAction extends BaseAction {

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

		$this->modelName = "QR/QRReport";
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

		//dump($_GET);exit;

		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			if( $_GET['keyword'] ){
				$map['keyword'] = array('like', '%'.$_GET['keyword'].'%');
			}
			$map['userid'] 	= $this -> loginUserId;
			$map['status'] = 1;
			$page['list']  = $model -> queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam());

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
				$map['userid'] 	= array('IN',$userids);
			
				$map['status'] = 1;
					
				//获得查询结果，传值到模板输出查询的结果
				$page['list'] = $model->queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam() , $_GET['num_per_page']);
					
				//查询的参数字符串
				$page['urlparams'] = $querytools ->getUrlparam();
			}
				
			
				
			//传值到模板显示
			$this -> assign($page);
		}

		$this->display ( $tpl );
	}


	/**
	 * 关键词列表
	 *
	 * 查询一个报表下面的全部关键词的列表
	 *
	 * @accesspublic
	 */
	public function detail(){

		$model 		= D( 'QR/Keyworddetectrecord');

		//引入查询工具类
		import('ORG.Util.QueryTools');

		//实例化联合查询工具类
		$querytools = new QueryTools();

		//dump($_GET);exit;

		// 查询关键词
		if($querytools->paramExist('keyword')){

			//拼接exp条件
			$exp = array('like', '%'.$_GET['keyword'].'%');
			$querytools ->addParam('keyword','keyword',$exp);
		}

		// 查询网址
		if($querytools->paramExist('website')){

			//拼接exp条件
			$exp = array('like', '%'.$_GET['website'].'%');
			$querytools ->addParam('website','website',$exp);
		}


		// 查询检测开始时间
		if ( $querytools->paramExist ( 't1' ) && $querytools->paramExist ( 't2' )) {

			// 拼接map条件
			$exp[] = array ('EGT',trim ( $_GET ['t1'] ) );
			// 拼接map条件
			$t2 = trim ( $_GET ['t2'] ) ;
			$lastDate = date("Y-m-d",strtotime("$t2   +1   day"));
			$exp[] = array ('LT', $lastDate );
			$querytools->addParam ( '', 'createtime', $exp );

		}else if( $querytools->paramExist ( 't1' ) ){
			// 拼接map条件
			$exp = array ('EGT',trim ( $_GET ['t1'] ) );
			$querytools->addParam ( 't1', 'createtime', $exp );
		}else if( $querytools->paramExist ( 't2' ) ){
			// 拼接map条件
			$t2 = trim ( $_GET ['t2'] ) ;
			$lastDate = date("Y-m-d",strtotime("$t2   +1   day"));
			$exp = array ('LT', $lastDate );
			$querytools->addParam ( 't2', 'createtime', $exp );
		}

		// 查询排名
		if($querytools->paramExist('rank1')){
			//拼接exp条件
			$exp = array('EGT', $_GET['rank1']);
			$querytools ->addParam('rank1','rank',$exp);
		}

		// 查询排名
		if($querytools->paramExist('rank2')){
			//拼接exp条件
			$exp = array('ELT', $_GET['rank2']);
			$querytools ->addParam('rank2','rank',$exp);
		}

		// 查询渠道
		if($querytools->paramExist('searchengine')){
			//拼接exp条件
			$exp = array('EQ', $_GET['searchengine']);
			$querytools ->addParam('searchengine','searchengine',$exp);
		}



		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');

		//组合查询条件
		$query_params = 'keyword,website,t1,t2,rank1,rank2,searchengine,num_per_page';
		$this->assign('query_params', combo_url_param($query_params));
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('id desc');

		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['planid'] 	= $_GET['planid'];
		$map['detecttime'] 	=  array('LIKE', $_GET['reportdate'] .'%');
		$map['status'] = 1;

		// 查询覆盖
		if( $_GET['query_type'] == 'standard' ){
			//拼接exp条件
			$map['rank'] = array( array('GT',0), array('ELT',10),'AND' );
		}

		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam() , $_GET['num_per_page']);

		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();

		$page['PerPageOptions']  		= C ( 'PerPageOptions');


		$data = D( $this->modelName) -> selectOne( array('id' => $_GET['id']));
		$page['report'] = $data;
		//传值到模板显示
		$this -> assign($page);

		$this->display();
	}

	/**
	 * 关键词列表
	 *
	 * 查询一个报表下面的全部关键词的列表
	 *
	 * @accesspublic
	 */
	public function keyword_list(){

		$model 		= D( 'QR/Keyworddetectrecord');

		//引入查询工具类
		import('ORG.Util.QueryTools');

		//实例化联合查询工具类
		$querytools = new QueryTools();

		//dump($_GET);exit;

		// 查询关键词
		if($querytools->paramExist('keyword')){

			//拼接exp条件
			$exp = array('like', '%'.$_GET['keyword'].'%');
			$querytools ->addParam('keyword','keyword',$exp);
		}

		// 查询网址
		if($querytools->paramExist('website')){

			//拼接exp条件
			$exp = array('like', '%'.$_GET['website'].'%');
			$querytools ->addParam('website','website',$exp);
		}


		// 查询检测开始时间
		if ( $querytools->paramExist ( 't1' ) && $querytools->paramExist ( 't2' )) {
				
			// 拼接map条件
			$exp[] = array ('EGT',trim ( $_GET ['t1'] ) );
			// 拼接map条件
			$t2 = trim ( $_GET ['t2'] ) ;
			$lastDate = date("Y-m-d",strtotime("$t2   +1   day"));
			$exp[] = array ('LT', $lastDate );
			$querytools->addParam ( '', 'createtime', $exp );
				
		}else if( $querytools->paramExist ( 't1' ) ){
			// 拼接map条件
			$exp = array ('EGT',trim ( $_GET ['t1'] ) );
			$querytools->addParam ( 't1', 'createtime', $exp );
		}else if( $querytools->paramExist ( 't2' ) ){
			// 拼接map条件
			$t2 = trim ( $_GET ['t2'] ) ;
			$lastDate = date("Y-m-d",strtotime("$t2   +1   day"));
			$exp = array ('LT', $lastDate );
			$querytools->addParam ( 't2', 'createtime', $exp );
		}

		// 查询排名
		if($querytools->paramExist('rank1')){
			//拼接exp条件
			$exp = array('EGT', $_GET['rank1']);
			$querytools ->addParam('rank1','rank',$exp);
		}

		// 查询排名
		if($querytools->paramExist('rank2')){
			//拼接exp条件
			$exp = array('ELT', $_GET['rank2']);
			$querytools ->addParam('rank2','rank',$exp);
		}

		// 查询渠道
		if($querytools->paramExist('searchengine')){
			//拼接exp条件
			$exp = array('EQ', $_GET['searchengine']);
			$querytools ->addParam('searchengine','searchengine',$exp);
		}



		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');

		//组合查询条件
		$query_params = 'keyword,website,t1,t2,rank1,rank2,searchengine,num_per_page';
		$this->assign('query_params', combo_url_param($query_params));
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('id desc');

		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['planid'] 	= $_GET['id'];
		$map['status'] = 1;

		// 查询覆盖
		if( $_GET['query_type'] == 'standard' ){
			//拼接exp条件
			$map['rank'] = array( array('GT',0), array('ELT',10),'AND' );
		}


		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam() , $_GET['num_per_page']);

		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();

		$data['SearchengineOptions']  	= C('SearchengineOptions');
		$data['PerPageOptions']  		= C ( 'PerPageOptions');


		// 获取我的全部计划
		$plans = D('QR/QRPlan') -> getMyPlansAll();
		foreach ( $plans as $vo ){
			$PlanOptions[$vo['id']] = $vo['planname'];
		}

		$page['PlanOptions']  = $PlanOptions;

		//传值到模板显示
		$this -> assign($page);

		$this->display();
	}

	/**
	 * 将数据导出成excel
	 */
	function exportReport(){
		$model 	= D( $this->modelName);
		$model -> exportReport ( $_GET['reportdate'] );
	}
	

}