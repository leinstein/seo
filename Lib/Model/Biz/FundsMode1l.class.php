<?php

/**
 * 模型层：资金池管理模型类型
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170419
 * @link        http://www.qisobao.com
 */
class FundsModel extends BaseModel{
	
	
	/**
	 * 自动处理数据
	 */
	protected $__auto 		= array (
		array ('createuserid', 'getLoginUserId',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
		array ('createusername', 'getloginUserName',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
		//array ('createtime','date',1,'function',array('Y-m-d H:i:s')), // 对createtime字
	);
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		$this -> trueTableName= C('DB_PREFIX') . 'funds';
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
		
		
		//将数据的中的大字段格式转化成php数组
		if( $data ){

			//TODO 暂时先写死为优站宝
			if( $data['productid'] == 1 ){

			
				switch ( $data['usertype'] ){
					case "sub":
						//计算累计消费
						$map_fee['ownuserid'] = $data['userid'];
						$map_fee['status'] = 1;
						$price = D('Biz/Standardfee') -> where( $map_fee ) ->  sum('price');
						$data['total_consumption'] 		= $price ;
						
						/* if(  $data["initfreezefunds"]  > 0){
								
							// 获取关键词
							$model_keyword = D('Biz/Keyword');
							$keywords = $model_keyword -> queryRecordAll( array('createuserid' => $data['userid'] ));
							unset( $ids );
							foreach ($keywords as $vo1 ){
								$ids[] = $vo1['id'];
							}
								
							// 从达标消费中获取全部额
							if( $ids ){
								$map2['keywordid'] = array('IN',$ids);
								$map2['status'] = 1;
								$price = D('Biz/Standardfee') -> where( $map2 ) ->  sum('price');
							}
								
							$data['total_consumption'] = $price ;
								
							if( $price > 0){
				
								if( $data["freezefunds"] >  0){
									// $data["freezefunds"] 	= $vo["initfreezefunds"] - $price;;
									
									// 剩余可以金额为 总金额减去
									$data["balancefunds"] 	= $data["totalfunds"] -  $price;
									//dump($price);
									//dump($price);
									// 剩余可以金额为 总金额减去
									$data["availablefunds"] 	= $data["totalfunds"] - $data["initfreezefunds"];
									
									
									if( $data['userid'] == 23 ){
										//dump($data);exit;
									}
									// $data["availablefunds"] 	= $data["totalfunds"] -  $data["initfreezefunds"];
								}else{
				
									$data["balancefunds"] 	= $data["totalfunds"] - $price;
									$data["availablefunds"] = $data["balancefunds"] ;
										
								}
							}
						} */
						break;
					case "agent":
						// 获取关键词
						$model_user = D('User/User');
						$users = $model_user -> queryRecordAll( array('pid' => $data['userid']));
						foreach ($users as $vo_user ){
							$userids[] = $vo_user['id'];
						}
						
						if( $userids ){
							
							foreach ( $userids as $vo_id ){
								$funds[] = $this -> selectOne( array('userid' => $vo_id ));
							}
							
							foreach ( $funds as $vo_funds ){
								$totalfunds += $vo_funds['totalfunds'];
							}
							
							$data["balancefunds"] 	= $data["totalfunds"] - $totalfunds;
								
						}
				
						break;
				}
			
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
	
		// 获取关键词
		$model_keyword = D('Biz/Keyword');
		
		$model_Standardfee =  D('Biz/Standardfee');
		
		$list = parent:: queryRecordAll($map, $field, $order, $relation, $maxCount );

		foreach( $list as &$vo ){
			//TODO 暂时先写死为优站宝
			if( $vo['productid'] == 1 ){
				switch ( $vo['usertype'] ){
	// 				case "sub":
	// 					//计算累计消费
	// 					if(  $vo["initfreezefunds"]  > 0){
								
	// 						// 获取关键词
	// 						$model_keyword = D('Biz/Keyword');
	// 						$keywords = $model_keyword -> queryRecordAll( array('createuserid' => $vo['userid'] ));
	// 						unset( $ids );
	// 						foreach ($keywords as $vo1 ){
	// 							$ids[] = $vo1['id'];
	// 						}
								
	// 						// 从达标消费中获取全部额
	// 						if( $ids ){
	// 							$map2['keywordid'] = array('IN',$ids);
	// 							$map2['status'] = 1;
	// 							$price = D('Biz/Standardfee') -> where( $map2 ) ->  sum('price');
	// 						}
								
	// 						$vo['total_consumption'] = $price ;
								
	// 						if( $price > 0){
									
	// 							if( $vo["freezefunds"] >  0){
	// 								// $data["freezefunds"] 	= $vo["initfreezefunds"] - $price;;
	// 							/* 	// 剩余金额为 总金额-消耗金额-剩余冻结金额
	// 								$vo["balancefunds"] 	= $vo["totalfunds"] - $price + $vo["freezefunds"];
	// 								// 剩余可以金额为 总金额减去
	// 								$vo["availablefunds"] 	= $vo["totalfunds"] -  $vo["initfreezefunds"]; */
									
	// 								// 剩余可以金额为 总金额减去
	// 								$vo["balancefunds"] 	= $vo["totalfunds"] -  $price;
									
	// 								// 剩余可以金额为 总金额减去
	// 								$vo["availablefunds"] 	= $vo["totalfunds"]  - $vo["freezefunds"];
									
	// 							}else{
										
	// 								$vo["balancefunds"] 	= $vo["totalfunds"] - $price;
	// 								$vo["availablefunds"] = $vo["balancefunds"] ;
										
	// 							}
	// 						}
	// 					}
	// 					break;
					case "agent":
						// 获取关键词
						$model_user = D('User/User');
						$users = $model_user -> queryRecordAll( array('pid' => $data['userid']));
						foreach ($users as $vo_user ){
							$userids[] = $vo_user['id'];
						}
							
						if( $userids ){
				
							foreach ( $userids as $vo_id ){
								$funds[] = $this -> selectOne( array('userid' => $vo_id ));
							}
				
							foreach ( $funds as $vo_funds ){
								$totalfunds += $vo_funds['totalfunds'];
							}
				
							$data["balancefunds"] 	= $data["totalfunds"] - $totalfunds;
								
						}
							
						break;
				}
			}
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
			
			//计算累计消费
			if( $vo['usertype'] != 'agent' ){
				$vo['total_consumption'] = $vo['totalfunds'] - $vo['balancefunds'] ;
			}
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
			
			//计算累计消费
			if( $vo['usertype'] != 'agent' ){
				$vo['total_consumption'] = $vo['totalfunds'] - $vo['balancefunds'] ;
			}
				
		}
	
		return $list;
	}
	
	
	
	/**
	 * 获取可用余额
	 */
	function getAvailablefunds(  ){
		$map['userid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		$data = $this -> selectOne($map);
		return $data['availablefunds'];
	}
	
	
	/**
	 * 获取我的资金池信息
	 * 
	 * 获取代理商的资金池信息，无产品信息
	 */
	function getFunsinfoForAgent(  $userid ){
		if( !$userid ){
			$userid = $this-> getLoginUserId();
		}
	
		$map['userid'] 	= $userid;
		$map['status'] 	= 1;
	
		$funds = $this -> selectOne($map);
		
		return $funds;
		
	}
	
	/**
	 * 获取我的资金池信息
	 */
	function getFunsinfo(  $userid, $productid ){
		if( !$userid ){
			$userid = $this-> getLoginUserId();
			$userinfo = $this -> getloginUserInfo();
		}else{
			$userinfo = D('User/User') -> selectOne( array('id' => $userid));
		}

		$map['userid'] 	= $userid;
		$map['status'] 	= 1;

		if ( $productid  ){
			$map['productid'] 	= $productid;
			$funds = $this -> selectOne($map);
			return $funds;
		}else{
			$product_arr = $userinfo['product_arr'];

			foreach ($product_arr as $key => $vo) {
				$map['productid'] 	= $vo['id'];
				$data[] = $this -> selectOne($map);

			}

			unset($vo);


			foreach ($data as &$vo) {
				foreach ($product_arr as $vo_prod) {
				
					if($vo['productid'] == $vo_prod['id']){
						$vo['product_name'] = $vo_prod['product_name'];

					}
				}
			}

			return $data;		
		}
	}

	/**
	 * 获取代理商的资金池信息
	 */
	function getFunsinfoAgent(  $userid ){
		if( !$userid ){
			$userid = $this-> getLoginUserId();
			$userinfo = $this -> getloginUserInfo();
		}else{
			$userinfo = D('User/User') -> selectOne( array('id' => $userid));
		}

		$map['userid'] 	= $userid;
		$map['status'] 	= 1;

		$funds = $this -> selectOne($map);
		return $funds;
	}
	
	/**
	 * 获取我的站点列表
	 */
	function getConsumerdetails(  ){
		
		for($i=10;$i>=0;$i--){
			$last_start=date('Y-m-d',strtotime("-{$i} days"));  //上周开始日期
			dump($last_start);
		}
	
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> selectOne($map);
	}
	
	/**
	 * 获取我的站点列表
	 */
	function freezeFunds( $funsinfo, $prices ){
	
	
		 // 资金余额
		 //$balancefunds 		= $funsinfo['balancefunds'] - $prices;
		 // 可用资金
		 $availablefunds 	= $funsinfo['availablefunds'] - $prices;
		 // 冻结资金
		 $freezefunds 		= $funsinfo['freezefunds'] +  $prices;
		 // 初始资金
		 $initfreezefunds 	= $funsinfo['initfreezefunds'] +  $prices;;
		 
		 $data['id'] 				= $funsinfo['id'];
		// $data['balancefunds'] 		= $balancefunds;
		 $data['availablefunds'] 	= $availablefunds;
		 $data['freezefunds'] 		= $freezefunds;
		 $data['initfreezefunds'] 		= $initfreezefunds;
		return $this -> update($data);
	}
	
	

	/**
	 * 解冻资金账户
	 */
	function unfreezeFunds( $funsinfo, $prices ){

		// 可用资金
		$availablefunds 	= $funsinfo['availablefunds'] + $prices;
		// 冻结资金
		$freezefunds 		= $funsinfo['freezefunds'] -  $prices;
		// 初始资金
		$initfreezefunds 	= $funsinfo['initfreezefunds'] -  $prices;;
			
		$data['id'] 				= $funsinfo['id'];
		// $data['balancefunds'] 		= $balancefunds;
		$data['availablefunds'] 	= $availablefunds;
		$data['freezefunds'] 		= $freezefunds;
		$data['initfreezefunds'] 	= $initfreezefunds;
		$result = $this -> update($data);
		Log::write("------------------------------ 解冻资金账户-更新资金池信息：". $this -> _sql());
		return $result;
	}
	/**
	 * 为代理商用户充值
	 *
	 * 为代理商用户充值
	 * update  By Richer 于2017年7月28日 17:34:29 代理商只需要资金池，不需要产品
	 *
	 * @param string $userid
	 * @param string $usertype
	 * @param float $amount
	 * @return boolean|mixed|unknown|number
	 */
	function rechargeForAgentUser( $userid, $usertype, $amount ,$productid ){
		
		/* // add By Richer 于2017年7月26日20:30:22 代理商充值一次最少充值5000
		if( $userid != 2 && $amount < 5000 ){
			$this -> error = '充值金额最少为5000';
			return false;
		} */

		// 获取该用户的资金信息
		$map['userid'] 		= $userid;
		//$map['productid'] 	= $productid;
		$data = $this -> selectOne( $map );
		
		if( $data ){
			$funds['id'] = $data['id'];
			$funds['totalfunds'] 		= $data['totalfunds'] + $amount;
			$funds['balancefunds'] 		= $data['balancefunds'] + $amount;
			$funds['availablefunds'] 	= $data['availablefunds'] + $amount;
			$result =$this -> update( $funds );
		}else{
			$funds['userid'] 			= $userid;
			//$funds['productid'] 		= $productid;
			
			$funds['usertype'] 			= $usertype; 
			$funds['totalfunds'] 		= $amount;
			$funds['balancefunds'] 		= $amount;
			$funds['availablefunds'] 	= $amount;
			$funds['createtime'] 	= date('Y-m-d H:i:s'); 
			$result = $this -> insert( $funds );
		}
		
		return $result;
	
	}
	
	/**
	 * 为子用户充值
	 *
	 * 进行充值
	 *
	 * @param string $userid
	 * @param string $usertype
	 * @param float $amount
	 * @return boolean|mixed|unknown|number
	 */
	function rechargeForSubUser( $userid, $usertype, $amount, $productid  ){
		
		$me = $this -> getloginUserInfo();
	
		// add By Richer 于2017年7月26日20:30:22 子用户充值一次最少充值5000
		if( $me['is_recharge_limit'] == 1 && $this -> getLoginUserId() != 2 && $amount < 5000 ){
			$this -> error = '充值金额最少为5000！';
			return false;
		}
		
		// 如果是代理给子用户充钱，需要判断余额是否足够
		$funds_info = $this -> getFunsinfoForAgent(); 
		if( $funds_info['availablefunds'] <  $amount ){
			$this -> error = "您输入的金额不能大于资金池余额！";
			return  false;
		}
		
		// 获取该用户的资金信息
		$map['userid'] = $userid;
		$map['productid'] 	= $productid;
		$data = $this -> selectOne( $map );

		if( $data ){
			$funds['id'] = $data['id'];
			$funds['totalfunds'] 		= $data['totalfunds'] + $amount;
			$funds['balancefunds'] 		= $data['balancefunds'] + $amount;
			$funds['availablefunds'] 	= $data['availablefunds'] + $amount;
			$result = $this -> update( $funds );
		}else{
			$funds['userid'] 			= $userid;
			$funds['productid'] 		= $productid;
			$funds['usertype'] 			= $usertype;
			$funds['totalfunds'] 		= $amount;
			$funds['balancefunds'] 		= $amount;
			$funds['availablefunds'] 	= $amount;
			$funds['createtime'] 	= date('Y-m-d H:i:s');
			$result = $this -> insert( $funds );
		}
	
		// 如果操作成功
		if( $result ){
			// 如果是代理给子用户充钱，需要将代理商的余额进行扣减
			$funds_agent['id'] 				= $funds_info['id'];
			$funds_agent['availablefunds']  = $funds_info['availablefunds'] - $amount;
			$funds_agent['balancefunds'] 	= $funds_info['balancefunds'] 	- $amount;
			$this -> update( $funds_agent );
			
		}
	
	
		return $result;
	
	}
	
	
	/**
	 * 为子代理充值
	 *
	 * 进行充值
	 *
	 * @param string $userid
	 * @param string $usertype
	 * @param float $amount
	 * @return boolean|mixed|unknown|number
	 */
	function rechargeForSubAgent( $userid, $usertype, $amount, $productid  ){
	
		// 如果是代理给子用户充钱，需要判断余额是否足够
		$funds_info = $this -> getFunsinfoForAgent();
		if( $funds_info['availablefunds'] <  $amount ){
			$this -> error = "您输入的金额不能大于资金池余额！";
			return  false;
		}
		
		// 获取该用户的资金信息
		$map['userid'] = $userid;
		//$map['productid'] 	= $productid;
		$data = $this -> selectOne( $map );
		if( $data ){
			$funds['id'] = $data['id'];
			$funds['totalfunds'] 		= $data['totalfunds'] + $amount;
			$funds['balancefunds'] 		= $data['balancefunds'] + $amount;
			$funds['availablefunds'] 	= $data['availablefunds'] + $amount;
			$result = $this -> update( $funds );
		}else{
			$funds['userid'] 			= $userid;
			$funds['productid'] 		= $productid;
			$funds['usertype'] 			= $usertype;
			$funds['totalfunds'] 		= $amount;
			$funds['balancefunds'] 		= $amount;
			$funds['availablefunds'] 	= $amount;
			$funds['createtime'] 	= date('Y-m-d H:i:s');
			$result = $this -> insert( $funds );
		}
		// 如果操作成功
		if( $result ){
			// 如果是代理给子用户充钱，需要将代理商的余额进行扣减
			$funds_agent['id'] 				= $funds_info['id'];
			$funds_agent['availablefunds']  = $funds_info['availablefunds'] - $amount;
			$funds_agent['balancefunds'] 	= $funds_info['balancefunds'] 	- $amount;
		
			$this -> update( $funds_agent );
			
				
		}
	
	
		return $result;
	
	}
	
	
	/**
	 * 获取子用户的资金统计信息
	 *
	 * 为代理商用户充值
	 *
	 * @param string $userid
	 * @return boolean|mixed|unknown|number
	 */
	function getFundsinfoForSubUser( $userid ){
		$model_user = D('User/User');
		if( !$userid ){
			$userid =  $this-> getLoginUserId();
		}
		$map['userid'] 	= $userid;
		$map['status'] 			= 1;
		
		$data = $this -> selectOne($map);
	
		return $data;
	
	}
	
	/**
	 * 获取代理商的资金统计信息
	 *
	 * 为代理商用户充值
	 *
	 * @param string $userid
	 * @param string $usertype
	 * @param float $amount
	 * @return boolean|mixed|unknown|number
	 */
	function getFundsinfoForAgentUser( $userid ){
		$model_user = D('User/User');
		if( !$userid ){
			$userid =  $this-> getLoginUserId();
		}
		$map_user['pid'] 	= $userid;
		$map_user['status'] 			= 1;
		$users = $model_user -> queryRecordAll( $map_user );
		
		foreach ($users as $vo_user ){
			$userids[] = $vo_user['id'];
		}
		$userids = array_unique( $userids );

		if( $userids ){
			$map['userid'] 	= array( 'IN', $userids );
			$map['status'] 			= 1;
			$list = $this -> queryRecordAll($map, $fields);
		}
		
		foreach ($list as $vo ){
			$totalfunds 		+=$vo['totalfunds'];
			$balancefunds 		+=$vo['balancefunds'];
			$availablefunds 	+=$vo['availablefunds'];
			$freezefunds 		+=$vo['freezefunds'];
			$total_consumption 	+=$vo['total_consumption'];
		}
		$data['totalfunds'] 		= $totalfunds;
		$data['balancefunds'] 		= $balancefunds;
		$data['availablefunds'] 	= $availablefunds;
		$data['freezefunds'] 		= $freezefunds;
		$data['total_consumption'] 	= $total_consumption;
		return $data;
	
	}
	
	/**
	 * 获取全部用户的资金统计信息
	 *
	 * 为代理商用户充值
	 *
	 * @param string $userid
	 * @return boolean|mixed|unknown|number
	 */
	function getFundsinfoForAllUser( $userid ){

		$map['usertype'] 	= 'sub';
		$map['status'] 			= 1;
		$list = $this -> queryRecordAll($map, $fields);
		
		
		foreach ($list as $vo ){
			$totalfunds 		+=$vo['totalfunds'];
			$balancefunds 		+=$vo['balancefunds'];
			$availablefunds 	+=$vo['availablefunds'];
			$freezefunds 		+=$vo['freezefunds'];
			$total_consumption 	+=$vo['total_consumption'];
			$initfreezefunds 	+=$vo['initfreezefunds']; 
		}
		$data['totalfunds'] 		= $totalfunds;
		$data['balancefunds'] 		= $balancefunds;
		$data['availablefunds'] 	= $availablefunds;
		$data['freezefunds'] 		= $freezefunds;
		$data['total_consumption'] 	= $total_consumption;
		$data['initfreezefunds'] 	= $initfreezefunds;
		return $data;
	
	}
	
	/**
	 * 获取代理商的账户余额
	 *
	 * 获取最近5日的账户余额统计：代理商账户余额是指代理商充值资金减去代理商账户充值到子用户的资金，
	 * 1、获取账户金额,并比价创建的日期是否 5天以内
	 * 2、
	 *
	 * @param string $userid
	 * @return boolean|mixed|unknown|number
	 */
	function getAgentFundsBalance( $userid ){
		// 用户模型
		$model_user = D('User/User');
		// 最近账户充值记录模型
		$modelFundsRechargeRecord = D('Biz/FundsRechargeRecord'); 
		
		$me =$this -> getloginUserInfo();
		if( !$userid ){
			$userid = $this -> getLoginUserId();
		}
		
		// 获取资金
		$funds_info = $this -> getFunsinfo( $userid );
		
		// 获取账户的创建时间
		$funds_createtime = $funds_info['createtime'];

		// 计算与今天的时间差
		$diff = (strtotime(date('Y-m-d')) - strtotime(format_date($funds_createtime,'Y-m-d')))/86400;
		if( $diff > 9 ){
			$diff = 9;
		}
		//$diff = 5;
		// 获取该代理商下面的全部子用户
		$users = $model_user ->  getSubUserForAgent( $userid );
		foreach ($users as $vo_user){
			$userids[] = $vo_user['id'];
		}
		
		if( $me['isopen_subagent'] == 1 ){
			$users_subgent = $model_user ->  getSubAgent( $userid );
			foreach ($users_subgent as $vo_agentuser){
				$userids[] = $vo_agentuser['id'];
			} 
		}
		$userids = array_unique( $userids );
		
		// 比较用户资金的创建时间是否在5天以内
		for($i= $diff ;$i>=0;$i--){
			$dates[]=date('Y-m-d',strtotime("-{$i} days"));
		}
		foreach ( $dates as &$vo_date ){
			// 获取代理商用户的全部充值金额
			$map['createtime'] 	= array('LT',date('Y-m-d',strtotime($vo_date.'+1 day')));
			$map['userid'] 		= $userid;
			$map['status'] 		= 1;
			$amount = $modelFundsRechargeRecord -> where($map) -> sum('amount');
			// 获取代理商用户为子用户的全部充值金额
			if( $userids ){
				$map['userid'] 	= array('IN',$userids);
				$amount_sub = $modelFundsRechargeRecord -> where($map) -> sum('amount');
			}
			$balance = $amount - $amount_sub;
			$arra['day'] = $vo_date;
			$arra['balance'] = $balance;
			$list[] = $arra;
		}
		
		return $list;
	
	}
	/**
	 * 校准资金池
	 * 
	 * 校准子用户的资金池
	 */
	function adjust_funds(){
		$model_standardfee 	= D('Biz/Standardfee');
		// 获取全部的子用户的资金池，根据产品来
		$products = D('Sys/Product') -> getProducts();
		//TODO 暂时先获取优站宝的
		foreach ($products as $vo_p ){
			$map['productid'] 	= $vo_p['id'];
			$map['status'] 		= 1;
			$map['usertype'] 	= 'sub'; 
			$funds_list = $this -> queryRecordAll( $map );
			//dump($funds_list);
			foreach ($funds_list as $vo ){
				// 获取当前资金池用户的全部消耗
				
				if( $vo['freezefunds'] <= 0 ){
					// 从达标扣费中获取总共消耗
					$map_standardfee['ownuserid'] = $vo['userid'];
					$map_standardfee['status'] 	= 1;
					// 获取总的消费
					$consumptionfunds = $model_standardfee  -> where( $map_standardfee ) ->  sum('price');
					// 计算资金余额
					$balancefunds = $vo['totalfunds']  - $consumptionfunds;
					$funds['balancefunds'] = $balancefunds;
					$funds['availablefunds'] = $balancefunds;
					$funds['freezefunds'] 	= 0;
					$this -> where( array('id' => $vo['id'])) -> save( $funds );
				dump($this -> _sql());
				}
				//dump($balancefunds);
			//	dump($vo['balancefunds'] );
		
			}
			
		}
	}
	
}
	
?>