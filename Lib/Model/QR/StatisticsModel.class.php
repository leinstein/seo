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
	// 定义当前登录用户的信息
	protected $me = null;
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		$this -> me = $this -> getloginUserInfo();
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
	 *  判断当前的用户是否已经开通了海排产品
	 */
	function is_has_opened(){
	
		$me 		= $this -> me;
		$productids = $me['productids'];
		if( in_array(2,$productids)){
			$_SESSION['has_open_qr'] = 1;
			return true;
		}else{
			$_SESSION['has_open_qr'] = 0;
		}
	
		return false;
	
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
		
		// 
		$model_user = D('User/User');
		$me = $this -> getloginUserInfo();
		$role_info 		= $me['role_info'];
		$depart_info 	= $me['depart_info'];
	
		switch (  $me ['usertype']  ) {
			case 'admin': // 管理员
			case 'operation_manager':// 运维
			case 'operation':// 运维
				
				// 获取全部的开通海排产品的企业
				$epids = $this -> getEpids();
				if( $epids ){
					$map['epid'] 		= array( 'IN', $epids );
					$map['usertype'] 	= array( 'EQ', 'sub' );
					$map['status'] 		= 1;
					$users = $model_user -> queryRecordAll( $map,'id,username');
					
				}
				
				break;
			case 'sub':// 子用户
				$users[] 	= $me;
				//
				break;
			case 'agent':// 一级代理
			case 'agent2':// 二级代理：获取全部的子用户
				// 获取全部的开通海排产品的企业
				$epids = $this -> getEpids();
				if( $epids ){
					$map['epid'] 		= array( 'IN', $epids );
					$map['usertype'] 	= array( 'EQ', 'sub' );
					$map['pid'] 		= $me['id'];
					$map['status'] 		= 1;
					$users = $model_user -> queryRecordAll( $map,'id,username');
				}
				break;
			case 'sales_manager':// 销售经理：获取自己的客户或者员工的客户
			case 'customer_manager':// 客服经理：获取自己的客户或者员工的客户
			case 'seller':// 销售经理：获取自己的客户
			case 'customer':// 客服：获取自己的客户
				// 获取全部的开通海排产品的企业
				$epids = $this -> getEpids();
				if( $epids ){
					$map['epid'] 		= array( 'IN', $epids );
					$map['usertype'] 	= array( 'EQ', 'sub' );
					$map['status'] 		= 1;
					$users = $model_user -> queryRecordAll( $map,'id,username');
				}
				break;
					
			default:
				
				break;
		}
		//dump($data);
		return $users;
	}
	
	function getUserids(){
		$users = $this -> getUsers();
		foreach ($users as $vo ){
			if( $vo['id'] ){
				$userids[] = $vo['id'];
			}
		}
		
		return $userids;
	}
	
	/**
	 * 根据条件获取已经开通海排宝产品的企业
	 */
	function getEpids(){
		$epdirs = $this-> getEpdirs();
		foreach ($epdirs as $vo ){
			$epids[] = $vo['id'];
		}
		return $epids;
	}
	
	/**
	 * 根据条件获取已经开通海排宝产品的企业
	 */
	function getEpdirs(){
		// 企业名录模型
		$model = D('Sys/Epdir');
		
		$map['product'] = array('LIKE','%"id":"2"%');
		$map['epgroup'] = 'Service';
		$map['status'] 	= 1;
		
		$me = $this -> getloginUserInfo();
		switch (  $me ['usertype']  ) {
			case 'admin': // 管理员
			case 'operation_manager':// 运维
			case 'operation':// 运维
		
				break;
			case 'sub':// 子用户
			
				break;
			case 'agent':// 一级代理
			case 'agent2':// 二级代理：获取全部的子用户
			
				break;
			case 'sales_manager':// 销售经理：获取自己的客户或者员工的客户
				$map['seller_manager'] = $me['id'];
				break;
			case 'customer_manager':// 客服经理：获取自己的客户或者员工的客户
				$map['customer_manager'] = $me['id'];
				break;
			case 'seller':// 销售经理：获取自己的客户
				$map['seller'] = $me['id'];
				break;
			case 'customer':// 客服：获取自己的客户
				$map['customer'] = $me['id'];
				break;
					
			default:
		
				break;
		}
		$list = $model -> queryRecordAll($map);
		return $list;
	}
	
	/**
	 * 获取首页统计
	 * 
	 * @return unknown
	 */
	function getIndexStatistics(){
		
	
		// 获取当前用户所能看见的全部用户id
		$userids = $this -> getUserids();
		
		
		// 获取昨日达标次数和排位数量
		$statics = $this -> getReports( $userids );
		$data = $statics;
		
		$plans = $this -> getPlans( $userids );
		
		// 获取计划的数量
		$plan_num = count( $plans );
		$data['plan_num'] 	= $plan_num;
		
		foreach ($plans as $vo ){
			$keyword_num += $vo['keywordnumber'];
		}
		$data['keyword_num'] = $keyword_num;
	
		$this_month_consumption = $this -> get_this_month_consumption( $userids );
		foreach ($this_month_consumption as $vo){
			$days[]	 				= $vo['day'];
			$cons_this_month[] 		= $vo['consumption'];
		}
		
		$data['days'] = json_encode($days) ;
		$data['consumptions_this_month'] = json_encode($cons_this_month) ;
		$data['days'] = json_encode($days) ;
		return $data;
	}
	
	
	/**
	 * 根据用户角色获取该角色可见的数据
	 */
	function getPlans( $userids ){
		//站点模型
		$model = D('QR/QRPlan');
		if( $userids ){
			$map['createuserid'] 	= array( 'IN', $userids );
				
			$map['status'] 			= 1;
			return $model -> where( $map ) -> select(  );;
		}
	}
	
	function getReports( $userids ){
		// 报表模型
		$model 		= D('QR/QRReport');
		if( $userids ){
			//$sql = 'SELECT sum(`standard_number`) as standard_number,sum(`baidu_number`) as baidu_number,sum(`baidumobile_number`) as baidumobile_number ,sum(`sougou_number`) as sougou_number,sum(`homerank_number`) as homerank_number,sum(`homerank_baidu_number`) as homerank_baidu_number ,sum(`homerank_baidumobile_number`) as homerank_baidumobile_number,sum(`homerank_sougou_number`) as homerank_sougou_number FROM `ts_qr_report` WHERE  status = 1 AND userid in = '.$planid;
			$map['userid'] 	= array( 'IN', $userids );
			
			$map['status'] 			= 1;
			// 总的达标和排位
			$data =   $model -> field( 'sum(`standard_number`) as standard_number,sum(`baidu_number`) as baidu_number,sum(`baidumobile_number`) as baidumobile_number ,sum(`sougou_number`) as sougou_number,sum(`homerank_number`) as homerank_number,sum(`homerank_baidu_number`) as homerank_baidu_number ,sum(`homerank_baidumobile_number`) as homerank_baidumobile_number,sum(`homerank_sougou_number`) as homerank_sougou_numbe') ->  where( $map ) -> find(  );;
			
			// 昨日达标和排位
			$map['reportdate'] 			= date("Y-m-d",strtotime("-1 day")); 
			$data1 =   $model -> field( 'sum(`standard_number`) as standard_number,sum(`baidu_number`) as baidu_number,sum(`baidumobile_number`) as baidumobile_number ,sum(`sougou_number`) as sougou_number,sum(`homerank_number`) as homerank_number,sum(`homerank_baidu_number`) as homerank_baidu_number ,sum(`homerank_baidumobile_number`) as homerank_baidumobile_number,sum(`homerank_sougou_number`) as homerank_sougou_numbe') ->  where( $map ) -> find(  );;
			$data['standard_number_yesterday'] = $data1['standard_number'];
			$data['homerank_number_yesterday'] = $data1['homerank_number'];
			// 进入达标和排位
			$map['reportdate'] 			= date('Y-m-d');
			$data2 =   $model -> field( 'sum(`standard_number`) as standard_number,sum(`baidu_number`) as baidu_number,sum(`baidumobile_number`) as baidumobile_number ,sum(`sougou_number`) as sougou_number,sum(`homerank_number`) as homerank_number,sum(`homerank_baidu_number`) as homerank_baidu_number ,sum(`homerank_baidumobile_number`) as homerank_baidumobile_number,sum(`homerank_sougou_number`) as homerank_sougou_numbe') ->  where( $map ) -> find(  );;
			$data['standard_number_today'] = $data2['standard_number'];
			$data['homerank_number_today'] = $data2['homerank_number'];
		}
		
		return $data;
	}
	
	/**
	 * 根据用户角色获取该角色可见的数据
	 */
	function getPlanNum( $userids ){
		//站点模型
		$model = D('QR/QRPlan');
		if( $userids ){
			$map['createuserid'] 	= array( 'IN', $userids );
			
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
			$map['createuserid'] 	= array( 'IN', $userids );
			
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
		// 报表模型模型
		$model = D('QR/QRReport');
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
	
	/**
	 * 获取本月的每日消耗
	 * 
	 * @param unknown $userids
	 */
	function get_this_month_consumption( $userids ){

		$model = D('QR/QRReport');
		$begin_date = date('Y-m-01');
		$end_date 	= date('Y-m-d');
		
		$diff = (strtotime( $end_date ) - strtotime( $begin_date ) )/86400;
		
		
		
		for($i = 0 ;$i<= $diff;$i++){
			$days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
		}
		
		// 查询用户
		if( $userids ){
			$map['userid'] 	= array( 'IN', $userids );
			$map['status'] 			= 1;
			// 查询时间范围
			$map['reportdate'] = array ( array ('EGT',$begin_date ), array ('LT',date("Y-m-d",strtotime("$end_date   +1   day")) ),'AND');
			$rss = $model -> where( $map ) ->  field( 'reportdate as date,reportdate as day, homerank_number as consumption' ) -> order('reportdate') -> select() ;
		}
		
		return $rss;
	}
	
}
	
?>