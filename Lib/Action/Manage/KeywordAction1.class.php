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

class KeywordAction extends BaseAction {
	
	/*
	 * 公共函数，不接受权限检查，写法 array('index');
	 */
	public $public_functions = array('detect','detect_all');
	
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
			$exp = array('like', '%'.trim($_GET['keyword']).'%');
			$querytools ->addParam('keyword','keyword',$exp);
		}
		// 查询站点
		if($querytools->paramExist('website')){
			//拼接exp条件
			if( $_GET['from'] == 'site' && !is_url( $_GET['website'] )){
				$_GET['website'] = base64_decode ( $_GET['website']);
			}
			$exp = array('like', '%'.trim($_GET['website']).'%');
			$querytools ->addParam('website','website',$exp);
		}
		
		// 查询搜索引擎
		if($querytools->paramExist('searchengine')){
			//拼接exp条件
			$exp = array('eq', $_GET['searchengine']);
			$querytools ->addParam('searchengine','searchengine',$exp);
		}
		
		//关键词状态
		if($querytools->paramExist('keywordstatus')){
			//拼接exp条件
			$exp = array('eq', $_GET['keywordstatus']);
			$querytools ->addParam('keywordstatus','keywordstatus',$exp);
		}
		
		
		
		//组合查询条件
		$query_params = 'keyword,website,keywordstatus,searchengine,num_per_page';
		$this->assign('query_params', combo_url_param($query_params));
		$page['query_params'] = combo_url_param($query_params);
		
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('keywordstatus ="合作停" ||  keywordstatus ="被拒绝",keywordstatus desc,id desc');
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
		
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page'] );
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
		/* $page['keywordstatusOptions']  = C('KeywordStatusOptions');
		$page['standardstatusOptions']  = C('KeywordStandardStatusOptions'); */
	
		//传值到模板显示
		$this -> assign($page);
	

		
		$this->display();
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
	
			$this->display();
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
	 * 首页
	 * @accesspublic
	 */
	public function effect(){
		
		
		$model 		= D( $this->modelName);
		
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
			if( $_GET['from'] == 'site' && !is_url( $_GET['website'] )){
				$_GET['website'] = base64_decode ( $_GET['website']);
			}
			$exp = array('like', '%'.trim($_GET['website']).'%');
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
		
		//获得查询结果，传值到模板输出查询的结果
		$me = $this -> loginUserInfo;
		switch ( $me['depart_info']['departname'] ) {
				
			case '销售部':
				$model_user = D('User/User');
				
				$userids = $model_user -> getUsersForSale ( ) ;
				
				if( $this -> LoginUserName == '排名统计'){
				
					$userids = 'all';
				}else{
					
					if( $userids ){
						$map['createuserid'] 	= array( 'IN', $userids );
					}
				}
				
				break;
			default:
				$userids = 'all';
				break;
		}
		
	
		$data['record'] = $model->getEffect( $map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page'],$userids );
		
		$data['urlparams'] = $querytools ->getUrlparam();
		$page['data'] = $data;
		
		//传值到模板显示
		$this -> assign($page);	
		
		$this->display();
		
	}
	
	
	/**
	 * 关键词解冻列表
	 * 
	 * @accesspublic
	 */
	public function unfreeze_list(){
	
	
		$model 		= D( $this->modelName);

		//引入查询工具类
		import('ORG.Util.QueryTools');
	
		//实例化联合查询工具类
		$querytools = new QueryTools();
	
		// 关键词
		if($querytools->paramExist('keyword')){
	
			//拼接exp条件
			$exp = array('like', '%'.trim($_GET['keyword']).'%');
			$querytools ->addParam('keyword','keyword',$exp);
		}
		
		// 网站
		if($querytools->paramExist('website')){
			//拼接exp条件
			if( $_GET['from'] == 'site' && !is_url( $_GET['website'] )){
				$_GET['website'] = base64_decode ( $_GET['website']);
			}
			$exp = array('like', '%'.trim($_GET['website']).'%');
			$querytools ->addParam('website','website',$exp);
		}
	
		// 查询搜索引擎
		if($querytools->paramExist('searchengine')){
			//拼接exp条件
			$exp = array('eq', $_GET['searchengine']);
			$querytools ->addParam('searchengine','searchengine',$exp);
		}
	
		// 关键词状态:默认状态为优化中和合作停
		if($querytools->paramExist('keywordstatus')){
			//拼接exp条件
			$exp = array('eq', $_GET['keywordstatus']);
			$querytools ->addParam('keywordstatus','keywordstatus',$exp);
		}else{
			$exp = array( array( 'eq', '优化中'), array( 'eq', '被拒绝' ),'OR');
			$querytools ->addParam('keywordstatus','keywordstatus',$exp);
		}
	
		//组合查询条件
		$query_params = 'keyword,website,keywordstatus,searchengine,num_per_page';
		$this->assign('query_params', combo_url_param($query_params));
		$page['query_params'] = combo_url_param($query_params);
	
		//添加默认排序参数-组织机构代码
		$querytools->addDefOrder('keywordstatus ="被拒绝",keywordstatus desc,id desc');
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
	
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->queryRecordEx($map, $fields, $querytools->getOrder(), $querytools->getPageparam(),$_GET['num_per_page'] );
		//查询的参数字符串
		$page['urlparams'] = $querytools ->getUrlparam();
		/* $page['keywordstatusOptions']  = C('KeywordStatusOptions');
			$page['standardstatusOptions']  = C('KeywordStandardStatusOptions'); */
	
		//传值到模板显示
		$this -> assign($page);
	
	
	
		$this->display();
	}
	
	/**
	 * 进入关键词详情
	 * @accesspublic
	 */
	public function detail(){
		$model = D($this->modelName);
	
		$map['id'] = $_GET['id'];
	
		$page['data'] = $model -> detail( $_GET['id'] );
		$page['keywordstatusOptions']  = C('KeywordStatusOptions');
		
		// 获取站点信息
		$this -> assign($page);
		$this->display();
	}
	
	/**
	 * 删除购物车中的关键词
	 */
	function delete(){
		$model = D( $this->modelName );
		$idstr = $_GET['id'];
		$ids = explode( ',',$idstr );
	
		if( $ids ){
			$map['id'] = array('IN' ,  $ids );
			$data['status'] = 0;
			$result = $model -> where( $map ) -> save( $data );
		}
	
		if ($result) {
	
			$this->success ( '删除成功！', U ( 'index' ) );
		} else {
			$this->error ( '删除失败！' );
		}
	
	}
	
	
	
	/**
	 * 搜索关键词
	 * 
	 * 通过第三方接口搜索关键词
	 * 
	 * @accesspublic
	 */
	public function detect(){
	
		// $model 		= D( $this->modelName);
		
		$model 		= D( 'Biz/Keyworddetect' ); 
		
		$list 		= $model -> detect_all();
		
		//$this -> assign('list',$list);
		
		$this->display();
		
	}


	/**
	 * 搜索关键词
	 * 
	 * 通过第三方接口搜索关键词
	 * 
	 * @accesspublic
	 */
	public function detect_all(){

		//dump(date('Y-m-d H:i:s'));
		//dump(time());

		set_time_limit (0);
	
		$model 			= D( $this->modelName);
		$model_log 		= M('ts_keyworddetectlog',null);

		// 获取接口参数
		// 当前系统运行环境
		$app_environment 			= C('APP_ENVIRONMENT');
		// 获取接口参数
		$keywor_detect_config_arr 	= C('KEYWORD_DETECT_CONFIG');
		// 获取接口参数
		$keywor_detect_config 		= $keywor_detect_config_arr[$app_environment];

		$app_id 					= $keywor_detect_config['APP_ID'];
		$app_key 					= $keywor_detect_config['APP_KEY'];

		// 2.=========================== 获取接口推送地址和主机地址 ===========================
			// 获取接口地址
		$url_post 	= $keywor_detect_config['ADD_TASK_URL'];
			// 获取当前接口的主机地址
		$host 		= $model -> yundanran_parse_host( $url_post );
		
		// 全部优化中中的关键词
		$map['keywordstatus'] 		= '优化中';
		//$map['is_detect'] 		= array(array('EXP', 'IS NULL'),array('EXP', 'IS NULL'),array('EXP', 'IS NULL'),'OR');0;
		//$map['is_detect'] 		= array('NEQ', 1);
		//$map['detectiondate'] 	= array('LT', date('Y-m-d'));
		$map['status'] 				= 1;
		// $list1 = $model -> queryRecordAll( $map );
		// foreach ($list1 as $key1 => $vo1) {
		// 	foreach ($list1 as $key2 => $vo2) {
		// 		if( $key1  != $key2 && $vo1['keyword'] ==  $vo2['keyword'] && $vo1['website'] ==  $vo2['website'] &&  $vo1['searchengine'] ==  $vo2['searchengine']  ){
		// 			dump($vo1['id']);dump($vo2['id']);
		// 			dump('-----');
		// 		}
		// 	}
		// }

		$per_page = 100;
		$p = $_GET['p'];
		if(!$p){
			$p = 1;
		}
		// 全部数据
		$count = $model -> where( $map) -> count();
		$page_count = ceil($count / $per_page);

		$list = $model -> queryRecordEx( $map,'id,keyword,searchengine,website,createuserid,keywordstatus,is_detect',
			'regtime' ,null,
			$per_page);

		foreach ($list['data'] as $vo) {
			// 组合url
			$url = str_ireplace(array('http://','https://'),'',$vo['website']);
			// 需要替换的前缀
			$prefixs =  array('www.','m.','wap.', '3g.');
			// 判断是否已以下的几个开开头
			foreach ($prefixs as $vo_pf){
				if( stripos($url,$vo_pf) === 0 ){
					$url = substr($url,strlen($vo_pf));
				}
			}
				
			// 4.=========================== 对还未生成token的关键词生成token ===========================
			// 对还未生成token的关键词生成token
			if( !$vo['detect_token'] ){

				// 获取token接口Token加密方式 :md5(url参数+data_id+APP_ID)
				$token = md5($url.$vo['id'].$app_id);
					
				//将token插入都数据库
				$keyword['detect_token'] = $token;

				$model -> where( array('id' => $vo['id']) ) -> save( $keyword );
			}

			// 5.=========================== 对还未进行检测的数据进行接口的推送 ===========================
			
				// 生成分类
				switch ($vo['searchengine']) {
					case 'baidu':
						$type = 1;
						break;
					case 'baidu_mobile':
						$type = 2;
						break;
					case '360':
						$type = 3;
						break;
					case '360_mobile':
						$type = 4;
						break;
					case 'sougou':
						$type = 5;
						break;
					case 'sougou_mobile':
						$type = 6;
						break;
					case 'shenma':
						$type = 7;
						break;
					default:
						$type = 1;
						break;
				}

				// 组合最终的推送信息
				$postData['data_id'] 	= $vo['id'];// 数据ID(方便A方接收数据时处理相关逻辑)
				$postData['type'] 		= $type;// 类别(具体标准是：1或者参数为空：百度PC;2：百度移动；3：360PC；4：360移动;5:搜狗PC；6:搜狗移动；7:神马搜索；)
				$postData['url'] 		= $url;// 网站地址
				$postData['keywords'] 	= $vo['keyword'];// 关键词
				$postData['app_id'] 	= $app_id;// APP_ID（接入时由平台分配，请务必妥善保管）
				$postData['app_key'] 	= $app_key;// APP_KEY（接入时由平台分配，请务必妥善保管）
				// 6.=========================== 进行接口推送 ===========================
				// 本地测试环境不进行推送
				// TODO ==================>
				if( $app_environment == 3 || $app_environment == 4  ){
					$result_post = API_V1Model::httpClientPostData($postData, $host, $url_post);
				}
				

				// $riqi = date("Ymd");
			 //    $path = "./data/upload/qrcode/".$riqi;
				// if (!file_exists($path)){
					
				// 	//$res=mkdir($path,0777,true); 
			 //   	}

				//$myfile = fopen($path."/testfile.txt", "w");
				// 如果操作成功
				if( $response['ret'] == 1 ){
					//$txt = '关键词'.$vo['keyword'] .'('. $vo['id'] .')推送任务成功';
					//file_put_contents( $myfile, $txt, FILE_APPEND);

					//fwrite($myfile, $txt);
					//file_put_contents( $myfile, $txt .PHP_EOL, FILE_APPEND);

					$map_log['keywordid'] = $vo['id'];
					if( !$model_log -> where ( $map_log ) -> find()){
						$data['userid'] 		= $vo['createuserid'];
						$data['keywordid'] 		= $vo['id'];
						$data['keyword'] 		= $vo['keyword'];
						$data['website'] 		= $vo['website'];
						$data['searchengine'] 	= $vo['searchengine'];
						$data['createtime'] 	= date('Y-m-d H:i:s');
						$data['createuserid'] 	= $this -> LoginUserId;
						$data['createusername'] = $this -> LoginUserName;
						$result =  $model_log ->add($data);
					}
			}else{
				//$txt = '关键词'.$vo['keyword'] .'('. $vo['id'] .')推送任务失败';
					//file_put_contents( $myfile, $txt, FILE_APPEND);
				//file_put_contents( $myfile, $txt .PHP_EOL, FILE_APPEND);

					//fwrite($myfile, $txt);
			}
			
		}

		echo "总共{$page_count }数据，第{$p}页";
		$p++;

		$url = __URL__ . '/detect_all/p/'.$p;
		if($p <= $page_count){
			header('Location: ' .$url);
		}

			//$p ++;
			//sleep(5);
		//dump($url);
		//$this -> redirect('detect_all',array('p' => $p));

		
		
	}
	
	
	/**
	 * 修改关键词状态
	 * @accesspublic
	 */
	public function unfreezePage(){
		$model = D($this->modelName);
	
		$map['id'] = $_GET['id'];
	
		$page['data'] = $model -> selectOne( $map );
		
		$KeywordStatusOptions = C('KeywordStatusOptions');
		unset($KeywordStatusOptions['优化中']);
		unset($KeywordStatusOptions['被拒绝']);
		
		$page['keywordstatusOptions']  = $KeywordStatusOptions;
		
		$this -> assign($page);
	
		$this->display();
	}
	
	
	/**
	 * 解冻关键词
	 * 
	 * 修改关键词状态：只能讲优化中的关键词改成待审核、合作停
	 * 1、如果是将该关键词状态该为待审核，那么需要将该关键词剩余的冻结资金进行解冻
	 * 
	 */
	function unfreeze(){
		
		
		$model 		= D( $this->modelName);
		 
		$result = $model -> unfreeze( $_POST ); 
		
		if( $result){
			
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '解冻成功！',$returnUrl,false,true);
			}else{
				$this->success ( '解冻成功！', U ( 'index'),false,true);
			}
			
			
		}else{
			$this->error ( '解冻失败！' .$model  -> getError());
		}	
	}
	
	/**
	 * 批量审核关键词
	 *
	 */
	function unfreezeBatch(){
		$model 		= D( $this->modelName);
		$result = $model -> unfreezeBatch( $_POST );
		
		if( $result['success']){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '解冻成功！',$returnUrl,false,true);
			}else{
				$this->success ( '解冻成功！', U ( 'index'),false,true);
			}
		}else{
			$this->error ( '解冻失败' .$model  -> getError());
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
		$page['keywordstatusOptions']  = C('KeywordStatusOptions');
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
			$this->error ( '审核失败，' .$model  -> getError());
		}
	}
	
	
	
	/**
	 * 关键词日报表：历史效果
	 *
	 */
	function history(){
	
		$model 		= D( $this->modelName);
	
		//获得查询结果，传值到模板输出查询的结果
		$page['list'] = $model->getHistory( $_GET['id'], $_GET['t1'], $_GET['t2'],'sub' );
	
		//传值到模板显示
		$this -> assign($page);
		$this->display();
	
	}
	
	/**
	 * 关键词指定排名
	 */
	function setRank(){
		$model 	= D( $this->modelName); 
		$result = $model  -> setRank( $_POST['id'] ,$_POST['rank'], $_POST['original_rank'], $_POST['day']);
		
		if( $result){	
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '指定排名成功！',$returnUrl,false,true,2);
			}else{
				$this->success ( '指定排名成功！', U ( 'effect'),false,true,2);
			}
			
		}else{
			$this->error ( '指定排名失败！' .$model  -> getError());
		}
	}
	
	/**
	 * 进入设置初始排名界面
	 */
	function setInitRankPage(){
		
		// 从关键词检测表中获取该关键词第一次检测的时候的真实排名、
		$model = D('Biz/Keyworddetectrecord');
		$map['keywordid'] 	= $_GET['id'];
		$map['status'] 		= 1;
		$list = $model -> queryRecordAll( $map,null,'regtime',null,1);
		$data = $list[0];
		
		$page['rank_original'] = $data['rank_original'];
		$this -> assign($page);
		$this->display();
		
	}
	/**
	 * 关键词指定排名
	 */
	function setInitRank(){
		$model 	= D( $this->modelName);
		$result = $model  -> setInitRank( $_POST['id'] ,$_POST['initialranking']);
		
	
		if( $result){
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '指定排名成功！',$returnUrl,false,true,2);
			}else{
				$this->success ( '指定排名成功！', U ( 'effect'),false,true,2);
			}
				
		}else{
			$this->error ( '指定排名失败！' .$model  -> getError());
		}
	}
	
	/**
	 * 快排
	 *
	 * @accesspublic
	 */
	public function quick_sort(){
	
		$model 		= D( $this->modelName);
	
		$list = $model -> quick_sort();
	
	
		$this->display();
	
	
	
	}
	
}