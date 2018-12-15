<?php

/**
 * 模型层：关键词搜索记录表
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20141021
 * @link        http://www.qisobao.com
 */
class KeywordqueryrecordModel extends BaseModel{
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		$this -> trueTableName= C('DB_PREFIX') . 'keywordqueryrecord';
	}
	
	
	/**
	 * 重写父类方法：获取单个申请单信息
	 *
	 * 根据查询条件查询数据库中的单条记录，并返回结果。
	 * 获取一个资金申请单的基本信息：
	 *   1、不包含明细信息；
	 *   2、将大字段进行转换。
	 *
	 * @param array $map 查询条件
	 * @return var 如果查询成功则返回对象信息，如果失败则返回false
	 */
	function selectOne( $map ){
	
		//调用父类方法获取数据
		$data = parent:: selectOne( $map );
	
		//将数据的中的大字段格式转化成php数组
		if( $data ){
			//判断时候能删除
			if( $data['keywordstatus'] == '待审核'){
				$data['isCanEdit'] = 1;
			}
		}
		return $data;
	}
	
	
	/**
	 * 重写父类方法：根据查询条件查询符合条件的所有记录集合
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志以及最大记录数这几个条件对记录集进行过滤筛选并返回结果。
	 *   1、调用父类方法获取查询结果
	 *   2、将数据中的json格式大字段转换成php数据
	 *   3、其他数据的转换
	 *
	 * @param array $map 查询条件
	 * @param $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param boolean $Relation 表示是否采用关系模型来查询，可选值为:true,false，默认false。当采用关系模型时，会查询和当前模型有关系的数据，并放入到返回结果。
	 * @param int $maxCount 表示全部查询时取的最大记录数，一般情况为避免系统消耗太多性能，默认为10000，注意导出数据时修改此参数；
	 * @return var 查询结果
	 */
	public function queryRecordAll($map, $field = null, $order = null, $relation = false, $maxCount = 10000) {
	
		$list = parent:: queryRecordAll($map, $field, $order, $relation, $maxCount );
	
		foreach( $list as &$vo ){
			
				
		}
		//返回记录集
		return $list;
	}
	
	/**
	 * 重写父类方法：根据查询条件查询符合条件的所有记录集合，以翻页模式返回数据
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志，每页记录数，翻页参数这几个条件对记录集进行过滤筛选并返回结果。
	 *   1、调用父类方法获取查询结果
	 *   2、将数据中的json格式大字段转换成php数据
	 *   3、其他数据的转换
	 *
	 * @param array $map 查询条件；
	 * @param string $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param array $queryOpts 查询参数配置，目前包括：'Relation', 'NumberPerPage', 'PageParameters'等等；
	 *  Relation　表示是否采用关系模型来查询，可选值为:true,false，默认false;
	 *  NumberPerPage  表示每页记录数，值为整数，默认读取配置文件中的NUM_PER_PAGE;
	 *  PageParameters  表示翻页后的参数，字符串类型默认为空;
	 * 　特别的：如果输入数值，那么直接表示每页个数；如果是真假值，那么表示关系；如果输入文本，那么表示PageParameters；
	 * @return var 查询结果
	 */
	public function queryRecord($map, $fields, $order = null, $queryOpts) {
	
		$list = parent:: queryRecord($map, $fields, $order, $queryOpts);
		//获取每页显示条数
		$numberPerPage = $queryOpts;//$queryOpts['NumberPerPage'];
		if( !$numberPerPage ) {
			$numberPerPage = $this -> pageNum;;
		}
		foreach( $list['data'] as $key => &$vo ){
				
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $numberPerPage;
			$vo['No'] = $No;
				
	
				
		}
		return $list;
	}
	
	
	/**
	 * 根据查询条件查询符合条件的所有记录集合，以翻页模式返回数据
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志，每页记录数，翻页参数这几个条件对记录集进行过滤筛选并返回结果。
	 *
	 * @param array $map 查询条件；
	 * @param string $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param int $num_per_page  表示每页记录数，值为整数，默认读取配置文件中的NUM_PER_PAGE;
	 * @param string $url_param  表示翻页后的参数，字符串类型默认为空; 特别的：如果输入数值，那么直接表示每页个数；如果是真假值，那么表示关系；如果输入文本，那么表示PageParameters；
	 *
	 * @return mixed 查询结果
	 */
	public function queryRecordEx($map, $fields, $order = null,  $url_param = '', $num_per_page = 20) {
	
		$list = parent:: queryRecordEx($map, $fields, $order,  $url_param, $num_per_page);
	
		foreach( $list['data'] as  $key => &$vo ){
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $num_per_page;
			$vo['No'] = $No;
			
			//计算达标总消费
			if( $vo['standardstatus'] == '已达标' ){
				$vo['total_consumption']  = $vo['standarddays'] * $vo['price'] ;
			}
			
			//查询网站信息
			//if( )
			
			//判断时候能删除
			if( $vo['keywordstatus'] == '待审核'){
				$vo['isCanEdit'] = 1;
			}
				
		}
	
		return $list;
	}
	
	/**
	 * 
	 * 新增
	 * {@inheritDoc}
	 * @see BaseModel::insert()
	 */
	function addRecord( $keywords ){
		
		//组合其他相关参数
		$data['keywords'] = $keywords;
		$data['createtime'] = date('Y-m-d H:i:s');
		$data['createuserid'] = $this -> getLoginUserId();
		$data['createusername'] = $this -> getloginUserName();
		
		return $this -> insert($data);
	}
	
	/**
	 * 获取我的关键词列表
	 */
	function getKeywords(  ){
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> queryRecordAll($map, $fields);
	}
	
	/**
	 * 获取我的关键词列表：分页
	 */
	function getListByPage(  ){
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> queryRecordEx($map);
	}
	
	/**
	 * 获取已购买关键词数量
	 * 
	 */
	function getPurchasedKeywordNum(  ){
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		$map['keywordstatus'] 	= array ( array('EQ','优化中'), array('EQ','合作停') ,'OR' ); 
		return $this -> where( $map ) -> count();
	}
	
	/**
	 * 获取我的站点列表
	 */
	function getMyKeywordNum(  ){
		
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}
	
	/**
	 * 达标关键词数量
	 */
	function getStandardsNum(  ){
	
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['standardstatus'] 	= '已达标';
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}
	
	/**
	 * 达标关键词扣费
	 */
	function getStandardsFee(  ){
	
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['standardstatus'] 	= '已达标';
		$map['keywordstatus'] 	= '优化中';
		$map['status'] 			= 1;
		return $this -> where( $map ) -> sum('price');;
	}
	
	
	/**
	 * 获取优化关键词数量
	 */
	function getOptimizeNum(  ){
	
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['keywordstatus'] 	= '优化中';
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}
	
	
	
	/**
	 * 根据站点的ID获取已经购买的关键词
	 */
	function getBySiteid( $siteid ){
		
		$map['siteid'] = $siteid;
		$map['status'] 	= 1;
		return $this -> queryRecordAll($map);
	}
	
	/**
	 * 获取我进10天的消费明细
	 */
	function getConsumerdetails(  ){
		for($i=10;$i>=0;$i--){
			$days[]=date('Y-m-d',strtotime("-{$i} days"));
		}
		//获取优化中的关键词，以及合作停的关键词
		$map['_string'] = "(keywordstatus = '优化中') OR (keywordstatus = '合作停' AND cooperationstopdate > $days[0] )";
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		
		$list = $this -> queryRecordAll($map);
		foreach ( $days as $vo ){
			$consumption = 0;
			foreach ( $list as $vo_list ){
				
				if( $vo_list['keywordstatus'] == '优化中'){
					// 开始优化时间
					$optimizetime = format_date( $vo_list['optimizetime']);
					//如果开始优化时间在当前时间之前，说明当前的时间已经开始进行消费
					if( $optimizetime <= $vo ){
						$consumption += $vo_list['price'];
					}
				}else if( $vo_list['keywordstatus'] == '合作停'){
					// 开始优化时间
					$optimizetime = format_date( $vo_list['optimizetime']);
					$cooperationstopdate = format_date( $vo_list['cooperationstopdate']);
					//如果开始优化时间在当前时间之前，说明当前的时间已经开始进行消费
					if( $optimizetime <= $vo && $vo < $cooperationstopdate){
						$consumption += $vo_list['price'];
					}
				}
				//unset($list[$key]);
			}
			
			$rs['day'] = $vo;
			$rs['consumption'] = $consumption;
			$rss[] = $rs;
		}
		
		return $rss;
	}
	
	
	/**
	 * 发送post请求
	 * @param string $url 请求地址
	 * @param array $post_data post键值对数据
	 * @return string
	 */
	function send_post($url, $post_data) {
	
		//$postdata = http_build_query($post_data);
		dump($post_data);
		$options = array(
				'http' => array(
						'method' => 'POST',
						'header' => 'Content-Type: application/json; charset=utf-8',
						'content' => $post_data,
				)
		);
		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
	
		return $result;
	}
	
	/**
	 * 或的url的host
	 * 2013年4月26日20:33:25
	 * 2013年5月9日20:28:05
	 */
	function yundanran_parse_host($url)
	{
		if(!is_string($url) || $url=='')return "";
	
		$info=parse_url($url);
		$host=isset($info['host'])?$info['host']:"";
		if($host=="")return "";
	
		if(preg_match("/^192\.168\.\d{1,3}\.\d{1,3}¦127\.\d{1,3}\.\d{1,3}\.\d{1,3}¦255\.\d{1,3}\.\d{1,3}\.\d{1,3}$/",$host))return "";
		if(!preg_match("/\.[a-z]+$/i",$host) && !preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/",$host))return "";
		return $host;
	}
	
	/**
	 * 搜索关键词
	 *
	 * 通过第三方接口搜索关键词
	 *
	 * @accesspublic
	 */
	public function search( $keywords ){

		// 关键词查询
		// $url = 'http://api.91cha.com/bdsort?key=f15e8385d23d42ed984960b2f003122b&kws='.$keywords;
		
		// 关键词查询
		$url = 'https://api.zzmofang.com/v1/coop/recieve_words';
		$host = $this -> yundanran_parse_host( $url );
		$postData['task_id'] 	= 1;
		$postData['url'] 		= 'www.qisobao.com';
		$postData['type'] 		= 1;
		$postData['keywords'] 	= $keywords;
		$postData['token'] 		= md5('www.qisobao.com1pandarank') ;
		//$result = $this -> send_post( $url, $post_data );
		dump($postData);
		$result = API_V1Model::httpClientPostData($postData, $host, 'https://api.zzmofang.com/v1/coop/recieve_words');
		dump($result);
		dump(json_decode($result['response'],true));
		// 百度指数查询
		$url_index = 'http://api.91cha.com/index?key=456a38a7a22f41a0ae3829ec1ccb7fc1&kws='.urlencode($keywords);
		$data_index = json_decode( file_get_contents($url_index), true);
		$keywordOptions 	= C('KeywordOptions');
		$BaiduIndexPriceIndexOptions 	= C('BaiduIndexPriceIndexOptions');
		dump($keywordOptions);
		dump($BaiduIndexPriceIndexOptions);
		/**
		 * [0] => array(4) {
    ["keyword"] => string(6) "减肥"
    ["allindex"] => int(19532)
    ["mobileindex"] => int(11596)
    ["so360index"] => int(3222)
  }
  [1] => array(4) {
    ["keyword"] => string(6) "养生"
    ["allindex"] => int(2750)
    ["mobileindex"] => int(1727)
    ["so360index"] => int(1486)
  }
}
		 */
		exit;
		// 查询成功
		if( $data_index['state'] == 1){
			$list = $data_index['data'];
			dump($data);
			// 将两个数数组进行合并
			
			$keywordOptions 	= C('KeywordOptions');
			$BaiduIndexPriceIndexOptions 	= C('$BaiduIndexPriceIndexOptions');
			dump($keywordOptions);
			dump($BaiduIndexPriceIndexOptions);
			foreach ( $list as $vo ){
				$keyword = $vo['keyword'];
				// 判断字符的长度
				$len = mb_strlen($keyword,'utf8');
				$keywordOption = $keywordOptions[$vo['searchengine']];
			}
			
		}
		//dump($url);exit;
			$list = M('ts_keywordlist',null ) -> select();
			$keywordOptions 	= C('KeywordOptions');
			$BaiduIndexPriceIndexOptions 	= C('$BaiduIndexPriceIndexOptions');
			
			/* foreach ($list as $vo1 ){
				foreach ($list as $vo2 ){
					if( $vo1['keyword'] == $vo2['keyword']){
						
						$temp['keyword'] = $vo1['keyword'];
						$temp[$vo1['searchengine']] = 
					}
				
				}
				
			} 
			
			dump($list);*/
			
			foreach ( $list as &$vo ){
				$keyword = $vo['keyword'];
				// 判断字符的长度
				$len = mb_strlen($keyword,'utf8');
				$keywordOption = $keywordOptions[$vo['searchengine']];
				// 计算指数
				$baiduindex = $vo['baiduindex'];
				foreach ($keywordOption as $vo_ko ){
					if( $vo_ko['vmin'] <= $len && $len <=$vo_ko['vmax'] ){
						$price1 = $vo_ko['quotavalue'];
					}
				}
				
				foreach ($BaiduIndexPriceIndexOptions as $vo_bo ){
					if( $vo_bo['vmin'] <= $baiduindex && $baiduindex <=$vo_bo['vmax'] ){
						$price2 = $vo_bo['quotavalue'];
					}
				}
				$price = $price1 + $price2;
				$vo['price'] = $price;
			}
			
			
			
			$list1 = $list;
			foreach ($list as $key1 =>  &$vo1 ){
				foreach ($list1 as $key2 =>  &$vo2 ){
					if( $vo1['keyword'] == $vo2['keyword']){
						$temp['keyword'] = $vo1['keyword'];
						$temp[$vo1['searchengine']] =$vo1['price'];
						$temp[$vo2['searchengine']] =$vo2['price'];
						$temp['isrecommend'] = $vo1['isrecommend'];
						unset($list[$key1]);
						unset($list1[$key2]);
					}
				}
				$temps[] = $temp;
			}
			
		
			return $list;	
	}
	
	/**
	 * 获取每日流水记录
	 */
	function getDaily(){
		
		//获取我的全部关键词，并且状态是优化中’合作停的
		$map['keywordstatus'] = array( array('EQ','优化中'), array('EQ','合作停'), 'OR');
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		$list = $this -> queryRecordAll($map);
		foreach ($list as $vo ){
			$diff = (strtotime(date('Y-m-d')) - strtotime(format_date($vo['createtime'])))/86400;
			$data['begindate'] 	= format_date($vo['createtime']);
			$data['diff'] 		= $diff;
			$data['price'] 		= $vo['price'] ;
			$datas[] = $data;
		}
		dump($datas);
		foreach ($datas as $key => $vo ){
			$day =date('Y-m-d',strtotime("-{$vo['diff']} days"));
			unset($days);
			for($i=$vo['diff'];$i>=0;$i--){
				$arr['date']=date('Y-m-d',strtotime("-{$i} days"));
				$arr['price']= $vo['price'];
				$arrs[$key][] = $arr;
			}
		}
		dump($arrs);
		
	}
	
	
	/**
	 * 关键词审核
	 * @param unknown $postData
	 */
	function review( $postData ){
		//d
		$id 		= $postData['id'];
		$conclusion = $postData['conclusion'];
		$data['id'] 			= $id;
		$data['reviewdate'] 	= date('Y-m-d H:i:s');
		$data['reviewopinion'] 	= $postData['reviewopinion'];
		$data['reviewuserid'] 	= $this -> getLoginUserId();
		$data['reviewusername'] = $this -> getloginUserName();
		
		if( $conclusion == 'pass'){
			$keyword 		= $this  -> selectOne( array('id' =>  $id ));
			$createuserid 	= $keyword['createuserid'];
			$siteid 		= $keyword['siteid'];
			$price 			= $keyword['price']* 30;
			$data['keywordstatus'] = '优化中';
			$data['freezefunds'] = $price;
				
		}else if( $conclusion == 'notpass'){
	
			$data['keywordstatus'] = '被拒绝';
	
		}
	
		if($data ){
			$result =	$this -> update( $data );
		}
	
		if ($result) {
			if( $conclusion == 'pass'){
	
				$modelFunds 		= D('Biz/Funds');
				$modelFundsfreeze 	= D('Biz/Fundsfreeze');
	
				//更新资金的金额
				//冻结账户资金
				$modelFunds -> freezeFunds( $price, $createuserid);
					
				//冻结明细表中增加记录
				$freeze['siteid'] 	= $siteid ;
				$freeze['keywordid'] 	= $id ;
				$freeze['freezefunds'] 	= $price;
	
				$modelFundsfreeze -> addRecord( $freeze );
			}
		}
		
		return $result;
	}
	
	/**
	 * 检测关键词
	 * 
	 * 检测所有正在优化中的关键词：
	 * 1、检测全部正在优化，并且还未达标的关键词
	 * 2、如果排名在第一页，修改该关键词的状态为已达标，并且自
	 * 
	 */
	function detect(){
		
		// 从系统中获取全部正在优化还未达标的关键词
		$map['standardstatus'] 	= array('NEQ', '已达标');
		$map['keywordstatus'] 	= '优化中';
		$map['status'] 			= 1;
		$list = $this -> queryRecordAll( $map );

		// 通过接口查询排名，如果关键词到到达第一页，就开始计费，并设置关键词状态为达标状态
		foreach ( $list as $vo ){
			//TODO 查询接口
			//$rs_detect =
			$data['id'] 			= $vo['id'];
			// 检测时间
			$data['detectiondate'] 	= date('Y-m-d H:i:s');
			// 最新排名
			$data['latestranking'] 	= $rs_detect['latestranking']; 
			
			if($rs_detect['page'] == 1 ){
				// 如果在第一页。则表示该关键词已经达标
				$data['standardstatus'] 	= '已达标';
				$data['standarddate'] 		= date('Y-m-d H:i:s');
				$data['latestconsumption'] 	= $vo['price']; 
				$data['standarddays'] 		= 1; 
				$this -> update( $data );
			}else{
				$data['standardstatus'] = '未达标';
			}
		}
		
		unset($data);
		
		// 从系统中获取全部达标的关键词
		$map2['standardstatus'] 	= array('EQ', '已达标');
		$map2['keywordstatus'] 		= '优化中';
		$map2['status'] 			= 1;
		$list2 = $this -> queryRecordAll( $map2 );
	
		$modelStandardfeel = D('Biz/Standardfee');
		foreach ($list2 as $vo2 ){
			
			//查询该关键词的达标扣费的最新事件记录
			unset( $map );
			$map['keywordid'] 	= $vo2['id'];
			$map['status'] 		= 1;
			$oldFeel = $modelStandardfeel -> where( $map ) -> order('createtime desc') -> find();
			$diff = ( strtotime(date('Y-m-d')) - strtotime(format_date($oldFeel['createtime'])))/ 86400 ; 
			
			// 如果时间差大于0，则进行添加的操作
			if( $diff > 0){
				$data['id'] = $vo2['id'];
				// 达标天数加一
				$data['standarddays'] 		= $vo2['standarddays'] + $diff;
				// 达标天数加一
				$data['totalconsumption'] 	= $vo2['standarddays'] * ($vo2['standarddays'] + $diff);
					
				$r1 = $this -> update( $data );
				if( $r1 ){
					$modelStandardfeel -> addRecord( $vo2 , $diff);
				}
			}
			
		}
		
	}
	
	
	
	
}
	
?>