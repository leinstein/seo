<?php

/**
 * 模型层：统计分析模型
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20141021
 * @link        http://www.qisobao.com
 */
class StatisticsModel extends BaseModel{
	
	/**
	 * 不检查数据库
	 */
	protected $autoCheckFields = false;
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
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
		
		}
		return $data;
	}
	
	
	
	/**
	 * 获取用户id和用户对应的企业id
	 *
	 * 获取用户id和用户对应的企业id:获取已经开通了海排产品的全部用户
	 * 根据当前登录用户的用户类型和对应的分组来查询该用户下面的全部子代理、子用户的信息
	 *
	 * @param number $mode 方式默认为1.不查询
	 * @return 当前登录的用户信息
	 */
	function getUsers( $mode = 1 ){
	
		$me = $this -> getloginUserInfo();
		$role_info 		= $me['role_info'];
		$depart_info 	= $me['depart_info'];
	
		switch (  $me ['usertype']  ) {
			case 'admin': // 管理员
			case 'operation_manager':// 运维
			case 'operation':// 运维
				$userids 	= 'all';
				$epids 		= 'all';
				if( $mode == 2 ){
					$model_user = D('User/User');
					// 获取全部的用户
					$list = $model_user -> getSUbUsersByManage();
					foreach ($list as $vo ){
						/* $userids[] 	= $vo['id'];
							$epids[] 	= $vo['epid']; */
						if( $vo['id'] && $vo['username']){
							$users[$vo['id']] 	= $vo['username'];
						}
	
					}
				}
				break;
			case 'sub':// 子用户
				$userids[] 	= $me['id'];
				$epids[] 	= $me['epid'];
				$users[$me['id']] 	= $me['username'];
				//
				break;
			case 'agent':// 一级代理
				unset($userids);
				unset( $epids );
				$model_user = D('User/User');
				// 获取全部子用户
				$sub_suers = $model_user -> getSubUserForAgent();
	
				foreach ($sub_suers as $vo_u1) {
					$userids[] 	= $vo_u1['id'];
					$epids[] 	= $vo_u1['epid'];
				}
				if( $me['isopen_subagent'] == 1 ){
					//
					$sub_suerss = $model_user -> getSubSubUserForAgent();
						
					foreach ($sub_suerss as $vo_u2) {
						$userids[] 	= $vo_u2['id'];
						$epids[] 	= $vo_u2['epid'];
						$users[$vo_u2['id']] 	= $vo_u2['username'];
					}
				}
	
				break;
			case 'agent2':// 二级代理：获取全部的子用户
				$model_user = D('User/User');
				$sub_suerss = $model_user -> getSubUserForAgent2();
	
				foreach ($sub_suerss as $vo_u2) {
					$userids[] 	= $vo_u2['id'];
					$epids[] 	= $vo_u2['epid'];
					$users[$vo_u2['id']] 	= $vo_u2['username'];
				}
	
	
				//dump($sub_suerss);exit;
				break;
			case 'sales_manager':// 销售经理：获取自己的客户或者员工的客户
				$model_user = D('User/User');
				$sellerids[] 	= $me['id'];
	
				// 获取我的全部员工
				$children = $model_user -> getChildrenUsers();
				foreach ($children as $vo ){
					$sellerids[] = $vo['id'];
				}
				$list = $model_user -> getUsersBySeller( $sellerids );
				foreach ($list as $vo ){
					$userids[] 	= $vo['id'];
					$epids[] 	= $vo['epid'];
					$users[$vo['id']] 	= $vo['username'];
				}
				break;
			case 'customer_manager':// 客服经理：获取自己的客户或者员工的客户
				$model_user = D('User/User');
				$sellerids[] 	= $me['id'];
	
				// 获取我的全部员工
				$children = $model_user -> getChildrenUsers();
				foreach ($children as $vo ){
					$sellerids[] = $vo['id'];
				}
				$list = $model_user -> getUsersByCustomer( $sellerids );
				foreach ($list as $vo ){
					$userids[] 	= $vo['id'];
					$epids[] 	= $vo['epid'];
					$users[$vo['id']] 	= $vo['username'];
				}
				break;
			case 'seller':// 销售经理：获取自己的客户
				$model_user = D('User/User');
				$list = $model_user -> getUsersBySeller( $me['id'] );
				foreach ($list as $vo ){
					$userids[] 	= $vo['id'];
					$epids[] 	= $vo['epid'];
					$users[$vo['id']] 	= $vo['username'];
				}
				break;
			case 'customer':// 客服：获取自己的客户
				$model_user = D('User/User');
				$list = $model_user -> getUsersByCustomer( $me['id'] );
				foreach ($list as $vo ){
					$userids[] 	= $vo['id'];
					$epids[] 	= $vo['epid'];
					$users[$vo['id']] 	= $vo['username'];
				}
				break;
					
			default:
				$model_user = D('User/User');
	
				$staffids[] =  $me['id'];
				// 如果是一级角色，获取该用户的全部子用户
				if(  $role_info ['rolelevel']  = 1 ){
					// 获取全部的子用户
					$map_staff['pid'] 	= $me['id'];
					$map_staff['status'] = 1;
	
					$staffs = $model_user -> queryRecordAll( $map_staff );
	
					foreach ($staffs as $vo_staff){
						$staffids[]= $vo_staff['id'];
					}
				}
	
				switch ( $depart_info['departname']) {
					case '销售部':// 销售
						$map_user['seller_id'] 	= array('IN' , $staffids);
						$map_user['status'] 	= 1;
						$users = $model_user -> queryRecordAll( $map_user );
						foreach ($users as $vo ){
							if( $vo['usertype'] == 'agent'){
								$map_user1['pid'] 	=  $vo['id'];
								$map_user1['status'] = 1;
								$users1 = $model_user -> queryRecordAll( $map_user1 );
								foreach ($users1 as $vo_user1 ){
									$userids[] = $vo_user1['id'];
								}
							}else {
								$userids[] = $vo['id'];
							}
						}
						$userids = array_unique( $userids );
						if( $userids ){
							$map['createuserid'] 	= array( 'IN', $userids );
							$map['status'] 			= 1;
						}
						break;
	
					default:
						;
						break;
				}
					
				break;
		}
		if(is_array( $userids )){
			$userids 	= array_unique( $userids );
		}
		if(is_array( $epids )){
			$epids 	= array_unique( $epids );
		}
	
		$return['userids'] 	= $userids;
		$return['epids'] 	= $epids;
		$return['users'] 	= $users;
		//dump($data);
		return $return;
	}
	
	/**
	 * 根据条件获取已经开通海排宝产品的企业
	 */
	function getEpdirs(){
		$map['product'] = array('LIKE','%"id":"2"%');
		$map['status'] 	= 1;
		$model = D('Sys/Epdir');
		$list = $model -> queryRecordAll($map);
	}
	
	function getIndexStatistics(){
		$me = $this -> getloginUserInfo();
	
		$role_info 		= $me['role_info'];
		$depart_info 	= $me['depart_info'];
		
		switch (  $role_info ['rolecode']  ) {
			case 'admin':
			case 'operation_manager':
			case 'operation':
				$userids = 'all';
				break;
			case 'sub':// 子用户
				$userids[] = $me['id'];
			case 'agent':// 一级代理
				
				break;
			case 'agent2':// 二级代理
			
				break;
			default:
				$model_user = D('User/User');
				
				$staffids[] =  $me['id'];
				// 如果是一级角色，获取该用户的全部子用户
				if(  $role_info ['rolelevel']  = 1 ){
					// 获取全部的子用户
					$map_staff['pid'] 	= $me['id'];
					$map_staff['status'] = 1;
					
					$staffs = $model_user -> queryRecordAll( $map_staff );
					
					foreach ($staffs as $vo_staff){
						$staffids[]= $vo_staff['id'];
					}
				}
				
				switch ( $depart_info['departname']) {
					case '销售部':// 销售
						$map_user['seller_id'] 	= array('IN' , $staffids);
						$map_user['status'] 	= 1;
						$users = $model_user -> queryRecordAll( $map_user );
						foreach ($users as $vo ){
							if( $vo['usertype'] == 'agent'){
								$map_user1['pid'] 	=  $vo['id'];
								$map_user1['status'] = 1;
								$users1 = $model_user -> queryRecordAll( $map_user1 );
								foreach ($users1 as $vo_user1 ){
									$userids[] = $vo_user1['id'];
								}
							}else {
								$userids[] = $vo['id'];
							}
						}
						$userids = array_unique( $userids );
						if( $userids ){
							$map['createuserid'] 	= array( 'IN', $userids );
							$map['status'] 			= 1;
						}
						break;
	
					default:
						;
						break;
				}
			
				break;
		}
		// 获取站点的数量
		$plan_num = $this -> getMyPlansNum( $userids );
		$data['plan_num'] 				= $plan_num;
		// 获取优化中关键词总数量
		$keyword_num = $this -> getKeywordNum( $userids );
		$data['keyword_num']	= $keyword_num;
		// 获取最新达标关键词数量
		$standard_keyword_num = $this -> getStandardKeywordNum( $userids );
		$data['standard_keyword_num'] 		= $standard_keyword_num;
		
		// 获取最新首页排位
		$home_page_rank_num = $this -> getHomepageRank( $userids ); 
		$data['home_page_rank_num'] 			= $home_page_rank_num;
		
		/* // 获取用户的资金池统计信息
		$funds_pool = $this -> getFundsPool( $userids ); 
		
		
		// 资金总额
		$data['totalfunds'] = $funds_pool['totalfunds'];
		
		// 资金余额
		$data['balancefunds'] = $funds_pool['balancefunds'];
		
		// 资金可用余额
		$data['availablefunds'] = $funds_pool['availablefunds'];
		
		// 资金总额
		$data['totalfunds'] = $funds_pool['totalfunds'];
		// 冻结资金
		$data['freezefunds'] = $funds_pool['freezefunds'];
		// 初始冻结资金
		$data['initfreezefunds'] = $funds_pool['initfreezefunds'];
	
		// 获取本月消费
		$consumption_month = $this -> getAllConsumptionMonth( $userids );
		$data['consumption_month'] = $consumption_month;
		
		// 获取累计消费
		$consumptionfunds = $this -> getAllConsumption( $userids );
		$data['consumptionfunds'] = $consumptionfunds;
		
		
		// 获取关键词达标率
		$data['compliance_rate'] = round( $standard_kw_num / $keyword_num ,2) * 100 .'%';
		
		// 获取上个月的消费记录
		$consumerdetails_last = $this -> getConsdetailsForLastMonth( $userids );
		foreach ($consumerdetails_last as $vo){
			$days[]	 				= $vo['day'];
			$cons_last_month[] 		= $vo['consumption'];
		}
		$data['days'] = json_encode($days) ;
		$data['consumptions_last_month'] = json_encode($cons_last_month) ;
		
		// 获取本月的消费统计
		$consumerdetails_this = $this -> getConsdetailsForThisMonth( $userids );
		foreach ($consumerdetails_this as $vo){
			$cons_this_month[] =$vo['consumption'];
		}
		$data['consumptions_this_month'] = json_encode($cons_this_month) ;
		
		// 获取上个月的消费记录
		$standardNumsLast = $this -> getStandardNumForLastMonth( $userids );
		foreach ($standardNumsLast as $vo){
			$standard_num_last_month[] 	= $vo['num'];
			$standard_rate_last_month[] = $vo['rate'];
		}
		$data['standard_num_last_month'] = json_encode($standard_num_last_month) ;
		$data['standard_rate_last_month'] = json_encode($standard_rate_last_month) ;
		
		// 获取上个月的消费记录
		$standardNumsThis = $this -> getStandardNumForThisMonth( $userids );
		foreach ($standardNumsThis as $vo){
			$standard_num_this_month[] 	= $vo['num'];
			$standard_rate_this_month[] = $vo['rate'];
		}
		$data['standard_num_this_month'] = json_encode($standard_num_this_month) ;
		$data['standard_rate_this_month'] = json_encode($standard_rate_this_month) ;
		
		// 如果是子用户需要统计最近10天的消费记录
		if( $role_info ['rolecode']  == 'sub'){
			
			$consumerdetails_10days = $this -> getConsdetailsForLast10Days( $userids );
			
			foreach ($consumerdetails_10days as $vo){
				$consumerdetails[] 	= $vo['consumption'];
				$date[] = substr($vo['date'],5); 
			}
			$data['consumptions_ten_days'] = json_encode($consumerdetails) ; 
			$data['date'] = json_encode($date) ;
		} */
		//dump($data);
		

		for ($i=1 ; $i <= 31;$i++){
			$days[] = $i;
			$cons_last_month[] = 0;
			$cons_this_month[] = 0;
		}
		$data['days'] = json_encode($days) ;
		$data['consumptions_last_month'] = json_encode($cons_last_month) ;
		$data['consumptions_this_month'] = json_encode($cons_this_month) ;
		
		
		return $data;
	}
	
	/**
	 * 根据用户角色获取该角色可见的数据
	 */
	function getMyPlansNum( $userids ){
		//站点模型
		$model = D('QR/Plan');
		if( $userids ){
			if( $userids != 'all'){
				$map['createuserid'] 	= array( 'IN', $userids );
			}
			$map['status'] 			= 1;
			return $num = $model -> where( $map ) -> count();;
		}
	}
	
	
	/**
	 * 获取已购买关键词数量
	 */
	function getKeywordNum( $userids ){
		//站点模型
		$model = D('QR/QRKeyword');
		if( $userids ){
			if( $userids != 'all'){
				$map['createuserid'] 	= array( 'IN', $userids );
			}
			// $map['keywordstatus'] 	= array ( array('EQ','优化中'), array('EQ','合作停') ,'OR' );
			//$map['keywordstatus'] 	=  '优化中';
			$map['status'] 			= 1;
			$num = $model -> where( $map ) -> count();;
			//dump($model -> _sql());
			return $num; 
		}
	}
	
	
	/**
	 * 达标关键词数量
	 */
	function getStandardKeywordNum( $userids ){
		// 关键词模型
		/* $model = D('Biz/Keyword');
		if( $userids ){
			if( $userids != 'all'){
				$map['createuserid'] 	= array( 'IN', $userids );
			}
			$map['standarddate'] 	= array('LIKE',date('Y-m-d') .'%');
			$map['standardstatus'] 	= '已达标';
			$map['status'] 			= 1;
			$num = $model -> where( $map ) -> count();;
			//dump($model -> _sql());
			return $num; 
		}
		 */
		
		// 达标消费模型
		$model = D('Biz/Standardfee');
		
		if( $userids ){
			if( $userids != 'all'){
				$map['ownuserid'] 	= array( 'IN', $userids );
			}
			$map['createtime'] = array('LIKE',date('Y-m-d') .'%');
			$map['status'] 			= 1;
			$num = $model -> where( $map ) -> count();;
			//dump($model -> _sql());
			return $num;
		}
	}
	
	/**
	 * 获取今日的消费总额
	 */
	function getHomepageRank( $userids ){
	
		//站点模型
		$model = D('Biz/Standardfee');
		if( $userids ){
			if( $userids != 'all'){
				$map['ownuserid'] 	= array( 'IN', $userids );
			}
			$map['createtime'] 	= array('LIKE',date('Y-m-d') .'%');
			$map['status'] 			= 1;
			$price = $model -> where($map) -> sum( 'price ');
			//dump($model -> _sql());
			return $price;
		}
		
		return $price;
	}
	
	
	/**
	 * 资金池管理
	 *
	 * 获取当前资金池的总金额，已经消费金额 资金池金额充值总金额、消费金额、剩余金额
	 */
	function getFundsPool( $userids ){
		
		// 资金账户模型
		$model_funds = D('Biz/Funds');
		$model_standardfee 	= D('Biz/Standardfee');
		
		if( $userids ){
			if( $userids != 'all'){
				$map['userid'] 	= array( 'IN', $userids );
			}
			$map['usertype'] = 'sub';
			//$map['createtime'] 	= array('LIKE',date('Y-m-d') .'%');
			$map['status'] 			= 1;
			$list = $model_funds -> queryRecordAll($map);
			
			foreach ( $list as $vo ){
				// 总金额
				$data['totalfunds'] 	+= $vo['totalfunds'];
				// 资金余额
				$data['balancefunds'] 	+=  $vo['balancefunds'];
				// 可用余额
				$data['availablefunds'] +=   $vo['availablefunds'];
				// 冻结金额
				$data['freezefunds'] 	+=   $vo['freezefunds'];
				// 冻结初始金额
				$data['initfreezefunds'] 	+=   $vo['initfreezefunds'];
			}
			/* // 总金额
			$data['totalfunds'] 	= $model_funds -> where($map) -> sum( 'totalfunds' );
			// 资金余额
			$data['balancefunds'] 	= $model_funds -> where($map) -> sum( 'balancefunds' );
			// 可用余额
			$data['availablefunds'] = $model_funds -> where($map) -> sum( 'availablefunds' );
			// 冻结金额
			$data['freezefunds'] 	= $model_funds -> where($map) -> sum( 'freezefunds' );
			// 冻结初始金额
			$data['initfreezefunds'] 	= $model_funds -> where($map) -> sum( 'initfreezefunds' ); */
			
			// 消费余额
			//$data['consumptionfunds'] = $data['totalfunds'] - $data['availablefunds'];
		//	$data['consumptionfunds'] = $model_standardfee  -> sum('price');
		}
		
		
	
		return $data;
	}
	
	/**
	 * 获取所有关键词的本月消费
	 */
	function getAllConsumptionMonth ( $userids ){
		$model_standardfee 	= D('Biz/Standardfee');
		if( $userids ){
			if( $userids != 'all'){
				$map['ownuserid'] 	= array( 'IN', $userids );
			}
			$begin_date=date('Y-m-01', strtotime(date("Y-m-d")));
			$end_date =  date('Y-m-d', strtotime("$begin_date +1 month"));
			
			$map['createtime'] = array( array('GT',$begin_date),array('LT',$end_date),'AND');
			$map['status'] 			= 1;
			$price = $model_standardfee -> where($map) -> sum( 'price ');
		
		}
		
		return $price;
	}
	
	/**
	 * 获取所总消费 
	 */
	function getAllConsumption( $userids ){
		
		$model_standardfee 	= D('Biz/Standardfee');
		if( $userids ){
			if( $userids != 'all'){
				$map['ownuserid'] 	= array( 'IN', $userids );
			}
			$map['status'] 			= 1;
			$price = $model_standardfee -> where($map) -> sum( 'price ');
		}
		
	
		return $price;
	}
	
	
	
	/**
	 * 获取所有关键词的上月消费
	 */
	function getStandardNumForLastMonth( $userids ){
		$model_standardfee 	= D('Biz/Standardfee');
		$model_detect = D('Biz/Keyworddetectrecord');;
		
		$begin_date = date('Y-m-01', strtotime('-1 month'));
		$end_date 	=  date('Y-m-t', strtotime('-1 month'));
	
		for($i = 0 ;$i<= 30;$i++){
			$days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
		}
	
		// 如果userids存在
		if( $userids ){
			$map['status'] 			= 1;
		
			foreach ( $days as $vo ){
				$standard_num = 0;
				$map['createtime'] = array( 'LIKE', $vo .'%');
			
				if( $userids != 'all'){
					$map['ownuserid'] 	= array( 'IN', $userids );
				}
			
				$standard_num = $model_standardfee -> where( $map ) -> count();
			
				// 获取今天的检测关键词数量
				$detect_num = $model_detect -> where( $map ) -> count();
		
				if( !$standard_num ){
					$standard_num = 0;
				}
				
				if( !$detect_num ){
					$detect_num = 0;
				}
				
				$rs['date'] = $vo;
				$rs['day'] = intval( substr($vo,8) );
				$rs['num'] = intval( $standard_num );
				$rs['rate'] = round( $standard_num / $detect_num ,2) * 100;
				$rss[] = $rs;
			}
		}
		
		return $rss;
	}
	
	
	
	/**
	 * 获取本月的达标任务数量统计
	 */
	function getStandardNumForThisMonth( $userids ){
		
		$model_standardfee 	= D('Biz/Standardfee');
		$model_detect = D('Biz/Keyworddetectrecord');
		
		$begin_date = date('Y-m-01');
		$end_date 	= date('Y-m-d');
	
		$diff = (strtotime( $end_date ) - strtotime( $begin_date ) )/86400;
	
	
	
		for($i = 0 ;$i<= $diff;$i++){
			$days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
		}
		
		// 如果userids存在
		if( $userids ){
			$map['status'] 			= 1;
			foreach ( $days as $vo ){
				$standard_num = 0;
				$map['createtime'] = array( 'LIKE', $vo .'%');
				
				if( $userids != 'all'){
					$map['ownuserid'] 	= array( 'IN', $userids );
				}
				
				$standard_num = $model_standardfee -> where( $map ) -> count();
				
				// 获取今天的检测关键词数量
				$detect_num = $model_detect -> where( $map ) -> count();
				
				
				if( !$standard_num ){
					$standard_num = 0;
				}
				
				if( !$detect_num ){
					$detect_num = 0;
				}
				
				$rs['date'] = $vo;
				$rs['day'] = intval( substr($vo,8) );
				$rs['num'] = intval( $standard_num );
				$rs['rate'] = round( $standard_num / $detect_num ,2) * 100;
				$rss[] = $rs;
			}
		}
	
		return $rss;
	}
	
	
	/**
	 * 获取子用户最近10天的消费记录
	 *
	 * 不包含今天的消耗
	 */
	function getConsdetailsForLast10Days( $userids ){
	
		$model_standardfee 	= D('Biz/Standardfee');
		// 如果当前的时间是下午
		//设置【日期/时间】 默认时区
		date_default_timezone_set('Asia/Shanghai');
	
		//获取当前小时
		/* $hour=date("G");
	
		if( $hour > 12 ){
		for($i=10;$i>=0;$i--){
		$days[]=date('Y-m-d',strtotime("-{$i} days"));
		}
		}else{
		for($i=11;$i>0;$i--){
		$days[]=date('Y-m-d',strtotime("-{$i} days"));
		}
		} */
		for($i=10;$i>=0;$i--){
			$days[]=date('Y-m-d',strtotime("-{$i} days"));
		}
	
	
		//获取优化中的关键词，以及合作停的关键词
		// $map['_string'] = "(keywordstatus = '优化中' ) OR (keywordstatus = '合作停' AND cooperationstopdate > $days[0] )";
		
		// 如果userids存在
		if( $userids ){
				
			$map['status'] 			= 1;
			
			if( $userids != 'all'){
				$map['ownuserid'] 	= array( 'IN', $userids );
			}
			
			foreach ( $days as $vo ){
				$consumption = 0;
				$map['createtime'] = array( 'LIKE', $vo .'%');
			
				$consumption = $model_standardfee -> where( $map ) -> sum( 'price' );
				if( !$consumption ){
					$consumption = 0;
				}
				
				$rs['date'] = $vo;
				$rs['day'] =  intval( substr($vo,8));
				$rs['consumption'] = intval( $consumption );
				$rss[] = $rs;
			}
		}
			
		return $rss;
	}
	
	/**
	 * 获取所有关键词的上月消费
	 */
	function getConsdetailsForLastMonth( $userids ){
	
		$model_standardfee 	= D('Biz/Standardfee');
		
		$begin_date = date('Y-m-01', strtotime('-1 month'));
		$end_date 	=  date('Y-m-t', strtotime('-1 month'));
	
		for($i = 0 ;$i<= 30;$i++){
			$days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
		}
		
		// 如果userids存在
		if( $userids ){
			
			$map['status'] 			= 1;
			
			foreach ( $days as $vo ){
				$consumption = 0;
				$map['createtime'] = array( 'LIKE', $vo .'%');
			
				if( $userids != 'all'){
					$map['ownuserid'] 	= array( 'IN', $userids );
				}
				$consumption = $model_standardfee -> where( $map ) -> sum( 'price' );
				
				
				if( !$consumption ){
					$consumption = 0;
				}
				$rs['date'] = $vo;
				$rs['day'] =  intval( substr($vo,8));
				$rs['consumption'] = intval( $consumption );
				$rss[] = $rs;
			}
		}
		return $rss;
	}
	
	
	/**
	 * 获取所有关键词的本月消费
	 */
	function getConsdetailsForThisMonth( $userids ){
		
		$model_standardfee 	= D('Biz/Standardfee');
		
	
		$begin_date = date('Y-m-01');
		$end_date 	= date('Y-m-d');
		
		$diff = (strtotime( $end_date ) - strtotime( $begin_date ) )/86400;
		
		
	
		for($i = 0 ;$i<= $diff;$i++){
			$days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
		}
		
		// 如果userids存在
		if( $userids ){
				
			$map['status'] 			= 1;
		
			foreach ( $days as $vo ){
				$consumption = 0;
				
				$map['createtime'] = array( 'LIKE', $vo .'%');
				if( $userids != 'all'){
					$map['ownuserid'] 	= array( 'IN', $userids );
				}
				$consumption = $model_standardfee -> where( $map ) -> sum( 'price' );
				
				if( !$consumption ){
					$consumption = 0;
				}
				$rs['date'] = $vo;
				$rs['day'] = intval( substr($vo,8) );
				$rs['consumption'] = intval( $consumption );
				$rss[] = $rs;
			}
		}
	
		return $rss;
	}
	
	
	
}
	
?>