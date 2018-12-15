<?php
/**
 * 前台公共控制层类：关键词管理
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Service
 * @version     20170420
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
	 * 首页
	 * @accesspublic
	 */
	public function index(){
		
		
		$model 		= D( $this->modelName);
		$modelSite 	= D('Biz/Site');
		$modelFunds = D('Biz/Funds');
		
		
		//站点总数
		$site_num = $modelSite -> getMySitesNum();
		$this -> assign('site_num' , $site_num );
		
		//优化关键词数量
		$optimize_num = $model -> getOptimizeNum();
		$this -> assign('optimize_num' , $optimize_num );
		
		//达标关键词数量
		$standards_num = $model -> getStandardsNum();
		$this -> assign('standards_num' , $standards_num );
		
		//达标消费
		
		//累计消费
		
		//预付冻结费用
		
		//可用余额
		
		//账号余额
		$funs_info = $modelFunds -> getFunsinfo();
		$this -> assign('funs_info' , $funs_info );
		
		
		
		//引入查询工具类
		import('ORG.Util.QueryTools');
	
		//实例化联合查询工具类
		$querytools = new QueryTools();
		
		//查询项目进度
		if($querytools->paramExist('keyword')){
		
			//拼接exp条件
			$exp = array('like', '%'.$_GET['keyword'].'%');
			$querytools ->addParam('keyword','keyword',$exp);
		}
		
		
		//查询异常状态
		if($querytools->paramExist('website')){
			//拼接exp条件
			if( $_GET['from'] == 'site' && !is_url( $_GET['website'] )){
				$_GET['website'] = base64_decode ( $_GET['website']);
			}
			$exp = array('like', '%'.$_GET['website'].'%');
			$querytools ->addParam('website','website',$exp);
		}
		
		//查询企业申报年度
		if($querytools->paramExist('keywordstatus')){
			//拼接exp条件
			$exp = array('eq', $_GET['keywordstatus']);
			$querytools ->addParam('keywordstatus','keywordstatus',$exp);
		}
		
		//查询企业申报年度
		if($querytools->paramExist('standardstatus')){
			//拼接exp条件
			$exp = array('eq', $_GET['standardstatus']);
			$querytools ->addParam('standardstatus','standardstatus',$exp);
		}
		
		//翻页后仍能按照某字段排序
		$querytools ->addParam('order');
		
		//组合查询条件
		$query_params = 'keyword,website,keywordstatus,standardstatus,num_per_page';
		$this->assign('query_params', combo_url_param($query_params));
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('id desc');
	
		
		//将map条件重新赋值
		$map = $querytools->getMap();
		$map['createuserid'] 	= $this -> loginUserId;
		$map['status'] = 1;
		
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam());

		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
	
		$page['keywordstatusOptions']  = C('KeywordStatusOptions');
		$page['standardstatusOptions']  = C('KeywordStandardStatusOptions');
		
		//传值到模板显示
		$this -> assign($page);
	
 
		$this->display();
	}
	
	
	/**
	 * 关键词日报表：历史效果
	 *
	 */
	function history(){
	
		$model 		= D( $this->modelName);
	
		//获得查询结果，传值到模板输出查询的结果
		$page['list']= $model->getHistory( $_GET['id'], $_GET['detecttime'] );

		//传值到模板显示
		$this -> assign($page);
		$this->display();
	
	}
	
	
	/**
	 * 关键词效果监测
	 *
	 * @accesspublic
	 */
	public function effect(){
	
	
		$model 		= D( $this->modelName);
	
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
				
			$page = $model -> getEffectForSub( $map ,$fields, $querytools->getOrder());
			
			// 高亮关键词
			foreach ($page['list']['data'] as &$vo ){
				$vo['keyword'] = str_ireplace($_GET['keyword'],'<span style="color: #c00">'.$_GET['keyword'] .'</span>' , $vo['keyword']);
				$vo['website'] = str_ireplace($_GET['keyword'],'<span style="color: #c00">'.$_GET['keyword'] .'</span>' , $vo['website']);
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
			$this->display( $tpl );
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
				if( $_GET['from'] == 'site' && !is_url( $_GET['website'] )){
					$_GET['website'] = base64_decode ( $_GET['website']);
				}
				$exp = array('like', '%'.$_GET['website'].'%');
				$querytools ->addParam('website','website',$exp);
			}
			
			// 默认查询优化中的关键词
			if( !$_GET['keywordstatus']){
				$_GET['keywordstatus']  = '优化中';
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
			
			// 查询关键词达标状态
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
			$data['record'] = $model->getEffectForSub($map, $fields, $querytools->getOrder(), $querytools->getPageparam() ,$_GET['num_per_page']);
			$data['urlparams'] = $querytools ->getUrlparam();
			$page['data'] = $data;
			
			//传值到模板显示
			$this -> assign($page);
			$this->display();
		}
	
		
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
			// 解析成数组，并将每个元素的前后空格去掉
			$keyword_arr = trim_array( explode(',' , $keywords ));
			
			
			foreach ($keyword_arr as $vo ){
				//$vo = preg_replace('/^( |\s)*|( |\s)*$/', '', $vo);
				
			}
			
		}else  if( $keywords ){
			//将回车换行替换成都好
			$kws = str_replace(",","\r\n", $keywords);
			$kws = str_replace(",","\r", $keywords);
			$kws = str_replace(",","\n", $keywords);
			
		}
		// 解析成数组，并将每个元素的前后空格去掉
		$keyword_arr = trim_array( explode(',' , $keywords ));
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
	
	
	function doAdd(){
		
		//d
	
		$check = $_POST['check'];
		// 批量提交
		if( $check ){
			// 搜索的关键词
			$keywords 	= $_POST['keywords'];
			foreach ($check as $vo) {
				$arr = explode('::',$vo);
				$keyword 	= $arr[0];
				//选中的浏览器
				$type 		= $arr[1];
				//价格
				$pricestr = $arr[2];
				$prices_arr = explode(',' , $pricestr );
					
				//判断type字符串每个字符
				$substr1 = substr( $type, 0, 1 );
				$substr2 = substr( $type, 1, 1 );
				$substr3 = substr( $type, 2, 1 );
				$substr4 = substr( $type, 3, 1 );
				$substr5 = substr( $type, 4, 1 );
				$substr6 = substr( $type, 5, 1 );
					
				$data['keyword'] = $keyword;
				$data['unit'] = '元';
				$data['unit2'] = '天';
				$data['createuserid'] = $this -> loginUserId;
				$data['createusername'] = $this -> loginUserName;
				$data['cartstatus'] = '待购买';
				$data['createtime'] = date('Y-m-d H:i:s');
				$data['status'] = 1;
				$data['regtime'] = time();
				$data['reguser'] = $this -> loginUserName;
				// 百度PC
				if( $substr1 == 1 ){
					$data['searchengine'] = 'baidu';
					$data['price'] = $prices_arr[0];
					$data['initial_price'] = $prices_arr[0];
					$datas[] = $data;
				}
				// 手机百度
				if( $substr2 == 1 ){
					$data['searchengine'] = 'baidu_mobile';
					$data['price'] = $prices_arr[1];
					$data['initial_price'] = $prices_arr[1];
					$datas[] = $data;
				}
					
				// 360
				if( $substr3 == 1 ){
					$data['searchengine'] = '360';
					$data['price'] = $prices_arr[2];
					$data['initial_price'] = $prices_arr[2];
					$datas[] = $data;
				}
					
				// 搜狗
				if( $substr4 == 1 ){
						
					$data['searchengine'] = 'sougou';
					$data['price'] = $prices_arr[3];
					$data['initial_price'] = $prices_arr[3];
					$datas[] = $data;
				}
					
				// 神马
				if( $substr5 == 1 ){
					$data['searchengine'] = 'shenma';
					$data['price'] = $prices_arr[4];
					$data['initial_price'] = $prices_arr[4];
					$datas[] = $data;
						
				}
			}
			
		}else{
			//单个添加
			//当前选择的关键词
			$keyword 	= $_GET['keyword'];
			//选中的浏览器
			$type 		= $_GET['type'];
			// 搜索的关键词
			$keywords 	= $_GET['keywords'];
			//价格
			$pricestr = $_GET['pricestr'];
			
			$prices_arr = explode(',' , $pricestr );
			
			//判断type字符串每个字符
			$substr1 = substr( $type, 0, 1 );
			$substr2 = substr( $type, 1, 1 );
			$substr3 = substr( $type, 2, 1 );
			$substr4 = substr( $type, 3, 1 );
			$substr5 = substr( $type, 4, 1 );
			$substr6 = substr( $type, 5, 1 );
			
			$data['keyword'] = $keyword;
			$data['unit'] = '元';
			$data['unit2'] = '天';
			$data['createuserid'] = $this -> loginUserId;
			$data['createusername'] = $this -> loginUserName;
			$data['cartstatus'] = '待购买'; 
			$data['createtime'] = date('Y-m-d H:i:s');
			$data['status'] = 1; 
			$data['regtime'] = time();
			$data['reguser'] = $this -> loginUserName;
			
		
			// 百度PC
			if( $substr1 == 1 ){
				$data['searchengine'] = 'baidu';
				$data['price'] = $prices_arr[0];
				$data['initial_price'] = $prices_arr[0];
				$datas[] = $data;
			}
			// 手机百度
			if( $substr2 == 1 ){
				$data['searchengine'] = 'baidu_mobile';
				$data['price'] = $prices_arr[1];
				$data['initial_price'] = $prices_arr[1];
				$datas[] = $data;
			}
			
			// 360
			if( $substr3 == 1 ){
				$data['searchengine'] = '360';
				$data['price'] = $prices_arr[2];
				$data['initial_price'] = $prices_arr[2];
				$datas[] = $data;
			}
			
			// 搜狗
			if( $substr4 == 1 ){
			
				$data['searchengine'] = 'sougou';
				$data['price'] = $prices_arr[3];
				$data['initial_price'] = $prices_arr[3];
				$datas[] = $data;
			}
			
			// 神马
			if( $substr5 == 1 ){
				$data['searchengine'] = 'shenma';
				$data['price'] = $prices_arr[4];
				$data['initial_price'] = $prices_arr[4];
				$datas[] = $data;
			
			}
		}
		
		$model = D('Biz/Cart');
		
		$result =	$model -> addAll($datas);
		

		if ($result) {
			//$this->success ( '添加成功！', U ( 'search' ,array('keywords' => $keywords) ));
			$this->success ( '添加成功！');
		} else {
			$this->error ( '添加失败！' );
		}
		
		
	}
	
	/**
	 * 显示登录页面
	 * @accesspublic
	 */
	public function cart(){
		
		$model = D('Biz/Cart');
		
		$modelSite = D('Biz/Site');
	
		$list = $model -> getKeywords();
		$this -> assign('list', $list);
		
		//获取我的全部的站点
		$sites  = $modelSite -> getMySitesAll( );

		foreach ($sites as $vo ){
			$sitesOptions[$vo['id']] = $vo['website'];
		}
		$this -> assign('sitesOptions', $sitesOptions);
		$this->display();
	}

	
	/**
	 * 购买关键词
	 */
	function buy(){
		$model = D( $this->modelName );
	//dump();exit;
		$result = $model -> buy($_REQUEST);
	
		if( $result ){
			$return['status'] = 1;
		}else{
			$return['status'] = 0;
			$return['info'] = $model  -> getError();
		}
		
		exit(json_encode($return));
	}
	
	/**
	 * 删除购物车中的关键词
	 */
	function delete(){
		$model = D( $this->modelName );
		
		
		//判断当前是否可以删除
		$oldData = $model -> selectOne( array('id' => $_GET['id'] ));
		if( $oldData['isCanEdit'] != 1 ){
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
	 * 删除购物车中的关键词
	 */
	function keywordList(){
	
		
		$list = $model -> getListByPage();
		$this -> assign('list', $list);
		$this->display();
	
	}
	
}