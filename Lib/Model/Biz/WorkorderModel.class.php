<?php

/**
 * 模型层：工单管理模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170707
 * @link        http://www.qisobao.com
 */
class WorkorderModel extends BaseModel{
	
	
	/**
	 * 自动处理数据
	 */
	protected $__auto 		= array (
			array ('createuserid', 'getLoginUserId',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createusername', 'getloginUserName',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createtime','date',1,'function',array('Y-m-d H:i:s')), // 对createtime字
			array ('bizstatus','未处理'), // 新增的时候把业务状态字段设置为正常
	);
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		// 真实表名称
		$this -> trueTableName= C('DB_PREFIX') . 'biz_workorder';
		
		//合并自动验证
		$this->setProperty("_validate", array_merge($this->_validate, $this->__validate));
		//合并自动完成
		$this->setProperty("_auto", array_merge($this->_auto, $this->__auto));
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
		if( $data ){
			$list[] = $data;
			
			// 对数据进行转换
			$this -> myTransData( $list, 'detail');
			
			$data = $list[0] ;
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
		
		// 对数据进行转换
		$this -> myTransData( $list );
		
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
		
		// 对数据进行转换
		$this -> myTransData( $list['data'] );
		
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
		
		// 对数据进行转换
		$this -> myTransData( $list['data'] );
		
		// 根据不同的工单对象来组合不同的对象id
		$me = $this -> getloginUserInfo();
		switch ( $me['usertype'] ) {
			case 'operation_manager':
			case 'operation': // 销售账号可以新增工单
				$list['can_add']  = 1;
				break;
			case 'sub':// 客户可以新增工单
				$list['can_add']  = 1;
				break;
			default:
				;
				break;
		}
	
		return $list;
	}
	
	/**
	 * 转换数据
	 */
	function myTransData( &$list , $type ){
		
		// 附件模型
		// $model_file = D('File/File');
		// 回复模型
		$model = D('Biz/WorkorderReply') ;
		
		$userid = $this -> getLoginUserId();
		$me = $this -> getloginUserInfo();
		foreach( $list as $key => &$vo ){
			
			// 获取附件
			$file_arra = json_decode( $vo['file'], true );
			$file_arra['maxsize'] = 10;
			// $file_arra['isrequire'] = 1;// 是否必传
			$file_arra['skin'] = 'simple';
			$file_arra['cannotedit'] = 1; // 不能编辑
			$vo['file_arra'] = $file_arra;
			
			// 获取全部的回复
			$reply_list = $model -> queryRecordAll( array('workorderid' => $vo['id']) , 'id,content,createuserid,createusername,createtime,file,touserid,tousername,isread','regtime');
			$vo['reply_list'] = $reply_list;
			$vo['reply_num'] = count( $reply_list );
			// 计算有多少个回复还未读
			$not_read_reply_num = 0;
			foreach ($reply_list as $vo_reply ){
				if( $vo_reply['touserid'] == $this-> getLoginUserId() && $vo_reply['isread'] == 0 ){
					$not_read_reply_num ++;
					$vo_reply['not_read_reply'] = 1;
					$replyids[] = $vo_reply['id'];
				}
			}
			$vo['not_read_reply_num'] =  $not_read_reply_num ;
			switch ( $vo['bizstatus'] ) {
				case '未处理':
					// 根据不同的工单对象来组合不同的对象id
					switch ( $me['usertype'] ) {
						case 'operation_manager':
						case 'operation': // 销售账号可以删除和关闭该工单
							$vo['can_close']  	= 1;
							$vo['can_delete']  	= 1;
							$vo['can_edit']  	= 1;
							$vo['can_reply']  = 1;
							break;
						case 'sub':// 客户可以回复该工单
							$vo['can_reply']  = 1;
							// $vo['can_show_badge'] = 1;// 显示提示数字
							break;
						default:
							;
							break;
					}
					
					// 是否显示提醒
					if( $vo['touserid'] == $me['id']){
						$vo['can_show_badge'] = 1;// 显示提示数字
					}
					
					
				break;
				case '操作中':
					// 是否能回复
// 					if( $reply_list ){
// 						if( $reply_list[$vo['reply_num']-1]['createuserid'] != $userid ){
// 							$vo['can_reply'] = 1;
// 						}
// 					}else{
// 						if( $me['usertype'] == 'sub' ){
// 							$vo['can_reply'] = 1;
// 						}
// 					}
					
					$vo['can_reply'] = 1; 
					
					// 运维账号可以关闭工单
					// 根据不同的工单对象来组合不同的对象id
					switch ( $me['usertype'] ) {
						case 'operation_manager':
						case 'operation':
							$vo['can_close']  = 1;
							break;
								
						default:
							;
							break;
					}
					
					break;
				
				default:
					;
				break;
			}
				
			// 产品id
			if( $vo['productid'] ){
				$productids[] = $vo['productid'];
			}
		
			// 根据不同的工单对象来组合不同的对象id
			switch ( $vo['objecttype'] ) {
				case 'site':
					if( $vo['objectid'] ){
						$siteids[] = $vo['objectid'];
					}
					break;
						
				default:
					;
					break;
			}
			
			// add by Richer 于2017年8月23日10:13:14 工单即使结束了也能回复
			$vo['can_reply']  = 1;
		}
		
		unset( $vo );
		
		// 去重
		$productids = array_unique( $productids );
		if( $productids ){
			// 系统产品模型
			$model_product = D('Sys/Product');
			$map['id'] = array('IN', $productids );
			$products = $model_product -> queryRecordAll( $map,'id,product_name');
		}
		
		// 去重
		$siteids = array_unique( $siteids );
		if( $siteids ){
			// 站点模型
			$model_site = D('Biz/Site');
			$map['id'] = array('IN', $siteids );
			$sites = $model_site -> queryRecordAll( $map,'id,sitename,website' );
		}
		
		foreach( $list  as &$vo ){
			$product = list_search($products, array('id' => $vo['productid']));
			$vo['productname'] = $product[0]['product_name'];
		
			// 根据不同的工单对象来组合不同的对象id
			switch ( $vo['objecttype'] ) {
				case 'site':
					$site = list_search($sites, array('id' => $vo['objectid']));
					$vo['sitename'] = '【'.$site[0]['sitename'] ."】". $site[0]['website'];
					break;
		
				default:
					;
					break;
			}
		
		}
		
		if ( $type == 'detail'){
			// 将未读的回复全部设置为已读
			// 去重
			$replyids = array_unique( $replyids ); 
			if( $replyids ){
				unset($reply);
				unset( $map );
				$reply['isread'] = 1;
				$map['id'] = array('IN',$replyids);
				$model -> where($map) -> save( $reply );
			}
			
			
		}
		
	}
	
	
	/**
	 * 新增记录
	 * 
	 * @param array $postData
	 * @return boolean|mixed
	 */
	function addRecord( $postData ){
		
		//rtrim($str, ",");
		$model_file = D('File/File');
		
		$files = $model_file -> combineFiles( $postData );
		//组合其他相关参数
		$data['file'] 		= my_json_encode($files[0]);
		$data["productid"] 	= $postData["productid"];
		$data["objectid"] 	= $postData["objectid"];
		$data["title"] 		= $postData["title"];
		$data['content'] = htmlspecialchars( $postData['content'] );
		$data["objecttype"] = $postData["objecttype"];
		$data["touserid"] 	= $postData["touserid"];
		$data["tousername"] = $postData["tousername"];
		
		// 新增之前判断该对象的工单是否存在或者还未关闭
		
		$map['objectid'] 	= $data['objectid'];
		$map['objecttype'] 	= $data['objecttype'];
		$map['bizstatus'] 		= array( array('EQ','未处理'),array('EQ','操作中'),'OR');
		$map['status'] 		= 1;
		if( $this -> selectOne($map)){
			$this-> error = '该站点工单还未操作完成，请勿重复添加';
			return  false;
		}
		
		
		if( !$data['touserid'] ){
			// 获取用的信息
			$me =$this -> getloginUserInfo();
			switch ( $data['objecttype'] ) {
				case 'site':
					// 如果当前用户是子用户
					if ( $me['usertype'] == 'sub'){
						
						$touserid = 5;
						$tousername = '运维总账号';
					}
					
					switch ( $me['usertype'] ) {
						case 'sub':// 如果当前用户是子用户
							// TODO 暂时写死
							$touserid = 5;
							$tousername = '运维总账号';
						break;
						case 'operation_manager':// 如果当前用户是运维经理
						case 'operation':// 如果当前用户是运维账号
							$model_site = D( 'Biz/Site' );
							$site_info 	= $model_site -> selectOne( array('id' => $data['objectid']));
							$touserid 	= $site_info['createuserid'];
							$tousername = $site_info['createusername'];
						break;
						default:
							break;
					}
					
					$data['touserid'] 	= $touserid;
					$data['tousername'] = $tousername;
					
				break;
				// TODO 其他产品补充
				default:
					;
				break;
			}
		}
		
		// 新增工单
		$result =  $this -> insert($data);
		
		if( $result ){
			// 添加成功后添加通知
			
			//消息通知模型对象
			$model_notify 		= D( "Notify/Notify" );
			// 接收用户id
			$receiveid 			= $data['touserid'] ;
			// 发生用户信息
			$from['userid'] 	= $this -> getLoginUserId();
			$from['username'] 	= $this -> getLoginUserName();
			
			// 获取产品名称
			$product = D('Sys/Product') -> selectOne(array('id' =>  $data['productid']), 'product_name');

			// 推送正文
			$content 			= array('{productname}'=> $product['product_name'],'{title}'=> $data['title']);
			// 设置推送消息附属于哪个对象对应的数据库表
			//$target['type'] 		= 'site.report';
			// 设置数据的主键
			$target['id'] 		= $result;
			// 设置当前通知模板
			$tpl 				= 'workorder_new';
			// 设置当前跳转路径
			$gourl 				= __APP__ .'/{group}/Workorder/index/productid/'.$data['productid'].'/objecttype/'.$data['objecttype'].'/objectid/'.$data['objectid'];
			// 发送消息
			$model_notify -> send( $receiveid, $content, $target,$gourl, $tpl, $from );
		}
		
		return $result;
	}
	
	/**
	 * 修改记录
	 *
	 * @param array $postData
	 * @return boolean|mixed
	 */
	function updateRecord( $postData ){
	
		$model_file = D('File/File');
	
		$files = $model_file -> combineFiles( $postData );
		
		$data["id"] 		= $postData["id"];
		//组合其他相关参数
		$data['file'] 		= my_json_encode($files[0]);
		$data["productid"] 	= $postData["productid"];
		$data["objectid"] 	= $postData["objectid"];
		$data["title"] 		= $postData["title"];
		$data['content'] = htmlspecialchars( $postData['content'] );
		$data["objecttype"] = $postData["objecttype"];
		$data["touserid"] 	= $postData["touserid"];
		$data["tousername"] = $postData["tousername"];
		// 新增之前判断该对象的工单是否存在或者还未关闭
		$map['id'] 			=  array( 'NEQ',$data['id']);
		$map['objectid'] 	= $data['objectid'];
		$map['objecttype'] 	= $data['objecttype'];
		$map['bizstatus'] 	= array( array('EQ','未处理'),array('EQ','操作中'),'OR');
		$map['status'] 		= 1;
		$this -> selectOne($map);
		if( $this -> selectOne($map)){
			$this-> error = '该站点工单还未操作完成，请勿重复添加';
			return  false;
		}
	
	
		if( !$data['touserid'] ){
	
			switch ( $data['objecttype'] ) {
				case 'site':
					$model_site = D( 'Biz/Site' );
					$site_info 	= $model_site -> selectOne( array('id' => $data['objectid']));
					$data['touserid'] = $site_info['createuserid'];
					$data['tousername'] = $site_info['createusername'];
					break;
					// TODO 其他产品补充
				default:
					;
					break;
			}
		}
		return $this -> update($data);
	}
	
	/**
	 * 回复工单
	 */
	function reply( $postData ){
		// 回复模型
		$model = D('Biz/WorkorderReply') ;
		
		// 获取工单信息
		$workorder = $this -> selectOne( array('id' => $postData['workorderid']));
		// 获取创建用户的分组
		$user = D('User/User') -> field('id,username,usergroup') -> where( array('id' => $workorder['createuserid'])) -> find();
		$me = $this-> getloginUserInfo();
		// 如果当前回复人和信息的创建者是在一个分组，那么说明发送对象为原始的对象
		if( $user['usergroup'] == $me['usergroup']){
			$touserid 	= $workorder['touserid'];
			$tousername = $workorder['tousername'];
		}else{
			$touserid 	= $workorder['createuserid'];
			$tousername = $workorder['createusername'];
		}
		$postData['touserid'] 	= $touserid;
		$postData['tousername'] = $tousername;
		$postData["productid"] 	= $workorder["productid"];
		$postData["objectid"] 	= $workorder["objectid"];
		$postData["objecttype"] = $workorder["objecttype"];
		
		
		$reply = $postData;
		
		$result = $model -> addRecord( $reply );
		if( $result ){
			$data['id'] 		= $postData['workorderid'];
			$data['bizstatus'] 	= '操作中';
			$this -> update( $data );
			
			
			// 添加成功后添加通知
			//消息通知模型对象
			$model_notify 		= D( "Notify/Notify" );
			// 接收用户id

			$receiveid 			= $touserid ;
			// 发生用户信息
			$from['userid'] 	= $me['id'];
			$from['username'] 	= $me['username'];
			
			// 写入消息通知
			$content 			= array('{workordername}'=> $workorder['title']);
			// 设置推送消息附属于哪个对象对应的数据库表
			//$target['type'] 		= 'site.report';
			// 设置数据的主键
			$target['id'] 		= $workorder['id'];
			// 设置当前通知模板
			$tpl 				= 'workorder_reply_new';
			// 设置当前跳转路径
			$gourl 				= __APP__ .'/{group}/Workorder/index/productid/'.$workorder['productid'].'/objecttype/'.$workorder['objecttype'].'/objectid/'.$workorder['objectid'];
			// 发送消息
			$model_notify -> send( $receiveid, $content, $target,$gourl, $tpl, $from );
		}
		return $result;
	}
	
	/**
	 * 组合消息推送
	 */
	function compose_notify_content(){
		
	}
	
	/**
	 * 关闭工单
	 */
	function closeRecord( $id ){
	
		$data['id'] 		=  $id;
		$data['bizstatus'] 	= '已完成';
		$result = $this -> update( $data );
		
		return $result;
	}
	
	/**
	 * 获取用户未处理的工单数量：未处理的工单，或者有回复未读取的工单
	 */
	function getUntreatedNum( $userid ){
		
		// 回复模型
		$model = D('Biz/WorkorderReply') ;
		
		if( !$userid ){
			$userid = $this -> getLoginUserId();
		}
		$map['touserid'] 		=  $userid;
		$map['bizstatus'] 		=  '未处理';
		$map['status'] 			=  1;
		// 获取未处理的数量
		$count = $this -> where( $map ) -> count();
		unset($map['touserid']);
		// 获取操作中的数量
		$map['touserid|createuserid'] 		=  $userid;
		$map['bizstatus'] 		= '操作中';
		//$map['bizstatus'] 		=  array(array('EQ' ,'未处理'), array('EQ' ,'未处理'),'OR');
		$list = $this -> queryRecordAll( $map ,'id');
		foreach ( $list as $vo ){
			$map_reply['workorderid'] 	= $vo['id'];
			$map_reply['isread'] 		= 0;
			$map_reply['touserid'] 		= $userid ;
			// 获取全部的回复
			$count_reply = $model ->  where( $map_reply ) -> count();
			if( $count_reply > 0 ){
				$count ++;
			}
		}
		return $count;
	}
	
	/**
	 * 获取用户未处理的工单
	 */
	function getUntreatedList( $userid ){
		if( !$userid ){
			$userid = $this -> getLoginUserId();
		}
		$map['touserid'] 		=  $userid;
		$map['bizstatus'] 		=  '未处理';
		$map['status'] 			=  1;
		$result = $this -> deleteRecord( $map );
	
		return $result;
	}
	
	
}
	
?>