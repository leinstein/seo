<?php

/**
 * 模型层：关键词达标扣费情况图类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170419
 * @link        http://www.qisobao.com
 */
class StandardfeeModel extends BaseModel{
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		$this -> trueTableName= C('DB_PREFIX') . 'standardfee';
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
	 * 重写父类方法
	 * 
	 * 新增
	 * {@inheritDoc}
	 * @see BaseModel::insert()
	 */
	function insert( $postData ){
		
		//组合其他相关参数
		$data = $postData;
		$data['createtime'] 	= date('Y-m-d H:i:s');
		$data['createuserid'] 	= $this -> getLoginUserId();
		$data['createusername'] = $this -> getloginUserName();
		
		return parent::insert($data);
	}
	
	
	/**
	 * 增加消费记录
	 * 
	 * 为关键词增加达标消费
	 * 1、判断天数差是否大于0，如果大于0说明还有未增加的消费记录
	 * 2、循环天数，增加消费记录
	 * 
	 * @param array $record 关键词信息
	 * @param int $diff 相差的天数
	 * @return boolean|string|unknown
	 */
	function addRecord( $record, $diff ){
		dump($diff);
		if( $diff >0){
			$keywordid = $record['id'];
			// 判断当天是否已经有了记录，如果有了记录就不在增加
			//$map['keywordid'] 	= $keywordid;
			//$map['status'] 		= 1;
			//$map['createtime'] 	= array('LIKE' ,date('Y-m-d').'%');
			
			//$oldData = $this -> selectOne( $map );
			
			//if( $oldData ){
					
			//	return  false;
			//}
			
			for ( $i = $diff; $i>= 0 ;$i-- ){
			
				$data['keywordid'] 	= $keywordid;
				$data['siteid'] 	= $record['siteid'];
				$data['keyword'] 	= $record['keyword'];
				$data['price'] 		= $record['price'];
				$data['ownuserid'] 	= $record['createuserid'];
				$data['createtime'] = date("Y-m-d H:i:s",strtotime("-{$i} day"));
				$data['createuserid'] 	= $this -> getLoginUserId();
				$data['createusername'] = $this -> getloginUserName();
				$datas[] = $data;
			}
			if($datas ){
				return $this -> addAll($datas);
			}
		}	
	}
	
	/**
	 * 获取每日统计
	 */
	function getDaily(){
		
		//每页显示条数
		$pageNum = $_GET['pageNum'] ? $_GET['pageNum'] : $this-> pageNum;
		
		//引用分页库
		import("ORG.Util.Page");
		
		//计算该用户第一个关键词达标的日期
		$map['ownuserid'] 	= $this -> getLoginUserId();
		$map['status'] 	= 1;
		$data  = $this-> where( $map ) -> field('createtime') -> order('createtime asc') ->  find();

		//计算时间差
		$count  = ( strtotime( date('Y-m-d')) - strtotime( format_date($data['createtime'])) )/ 86400;
		
		// 实例化分页类传入总记录数和每页显示的记录数
		$Page = new Page ( $count, $pageNum);
	
		//在翻页时需要加入查询条件，此操作只需要进行一次，如果没有构造条件，则构造，使用qb标志来保存状态
		if ( $_GET["qb"] != 1 ){
			//开始构造查询条件
			$Page->parameter = "&qb=1&" . $queryOptions['PageParameters'];
		}
	
		// 分页显示输出
		$show = $Page->show ();
		
		// 查询的日期间隔
		$diff = $pageNum - 1;
	
		//计算时间
		$p = intval($_GET['p']) ? intval($_GET['p']) :"1";
		// 查询1的时间
		if( $p== 1){
			$diff_time1 = $diff * ( $p -1 ) -1;
		}else{
			$diff_time1 = $diff * ( $p -1 ) ;
		}
		$time1 = date("Y-m-d",strtotime("-{$diff_time1} day"));
		
		// 查询2的时间
		if( $p== 1){
			$diff_time2 = $diff * $p ;
		}else{
			$diff_time2 = $diff * $p + 1 ;
		}
		$time2 = date("Y-m-d",strtotime("-{$diff_time2} day"));

		$map['createtime'] = array( array('GT',$time2), array('LT',$time1),'AND' );
		$map['ownuserid'] 	= $this -> getLoginUserId();
		$map['status'] 	= 1;
		$list  = $this-> where( $map ) -> order('createtime desc') ->   select();

		// 将相同日期的数组合并
		$res = array(); 
		foreach ($list as $k => $vo) {
			$res[format_date($vo['createtime'])][] = $vo;
		}
		
		foreach ($res as $key_res => $vo_re ){
			$daily = array(); 
			$daily['day'] = $key_res;
			foreach ($vo_re as $vo_res){
				$daily['price'] += $vo_res['price'];
				$daily['keyword_num'] ++;
			}
			$dailys[] = $daily;
		}
		
		
		//拼接输出
		$result ['data'] = $dailys;
		$result ['html'] = $show;
		$result ['count'] = $count;
		$result ['pageCount'] = ceil($count/$pageNum);     //总页数 intval($Page->totalPages);

		return $result;
		
	}
	
	/**
	 * 根据用户的ID获取公司全部的消费统计
	 * 
	 * @param unknown $userid
	 */
	function getTotalfeel( $userid ){
		
	}
	
	/**
	 * 获取今日的消费总额
	 */
	function getTodayFeeForSubuser( $userid ){
		
		
		if( !$userid ){
			$userid =  $this-> getLoginUserId();
		}
		$map['ownuserid'] 	= $userid;
		$map['createtime'] 	= array('LIKE',date('Y-m-d') .'%');
		$map['status'] 			= 1;
		$price = $this -> where($map) -> sum( 'price ');
		return $price;
	}
	/**
	 * 获取今日的消费总额
	 */
	function getTodayFeeForAgentuser( $userid ){
	
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
			$map['ownuserid'] 	= array( 'IN', $userids );
			$map['createtime'] 	= array('LIKE',date('Y-m-d') .'%');
			$map['status'] 			= 1;
			$price = $this -> where($map) -> sum( 'price ');
		}
		
		return $price;
	}
	
	
	
	/**
	 * 获取今日的达标关键词数量
	 */
	function getTodayNum( $map ){
		$map['createtime'] = array('LIKE',date('Y-m-d') .'%');
		$map['status'] 			= 1;
		$num = $this -> where($map) -> count( );
		return $num;
	}
	
	/**
	 * 获取今日的消费总额
	 */
	function getTodayFee( $map ){
		$map['createtime'] = array('LIKE',date('Y-m-d') .'%');
		$map['status'] 			= 1;
		$price = $this -> where($map) -> sum( 'price ');
		return $price;
	}
	
	/**
	 * 获取所总消费
	 */
	function getAllConsumption(){
		$map['status'] 			= 1;
		$price = $this -> where($map) -> sum( 'price ');
	
		return $price;
	}
	
	/**
	 * 获取所有关键词的本月消费
	 */
	function getAllConsumptionMonth(){
		
		$begin_date=date('Y-m-01', strtotime(date("Y-m-d")));
		
		$end_date =  date('Y-m-d', strtotime("$begin_date +1 month"));
		
		$map['createtime'] = array( array('GT',$begin_date),array('LT',$end_date),'AND');
		$map['status'] 			= 1;
		$price = $this -> where($map) -> sum( 'price ');

		return $price;
	}
	
	
	/**
	 * 获取所有关键词的上月消费
	 */
	function getStandardNumForLastMonth(){
	
		$model_detect = D('Biz/Keyworddetectrecord');
		
		$begin_date = date('Y-m-01', strtotime('-1 month'));
		$end_date 	=  date('Y-m-t', strtotime('-1 month'));
	
		for($i = 0 ;$i<= 30;$i++){
			$days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
		}
	
		$map['status'] 			= 1;
	
		foreach ( $days as $vo ){
			$standard_num = 0;
			$map['createtime'] = array( 'LIKE', $vo .'%');
	
			$standard_num = $this -> where( $map ) -> count();
			if( !$standard_num ){
				$standard_num = 0;
			}
			
			// 获取今天的检测关键词数量
			$detect_num = $model_detect -> where( $map ) -> count();
			
			$rs['date'] = $vo;
			$rs['day'] = intval( substr($vo,8) );
			$rs['num'] = intval( $standard_num );
			$rs['rate'] = round( $standard_num / $detect_num ,2) * 100;
			$rss[] = $rs;
		}
	
		return $rss;
	}
	
	
	
	/**
	 * 获取本月的达标任务数量统计
	 */
	function getStandardNumForThisMonth(){
		
		$model_detect = D('Biz/Keyworddetectrecord');
		$begin_date = date('Y-m-01');
		$end_date 	= date('Y-m-d');
	
		$diff = (strtotime( $end_date ) - strtotime( $begin_date ) )/86400;
	
	
	
		for($i = 0 ;$i<= $diff;$i++){
			$days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
		}
	
		$map['status'] 			= 1;
		foreach ( $days as $vo ){
			$standard_num = 0;
			$map['createtime'] = array( 'LIKE', $vo .'%');
	
			$standard_num = $this -> where( $map ) -> count();
			if( !$standard_num ){
				$standard_num = 0;
			}
			// 获取今天的检测关键词数量
			$detect_num = $model_detect -> where( $map ) -> count();
			$rs['date'] = $vo;
			$rs['day'] = intval( substr($vo,8) );
			$rs['num'] = intval( $standard_num );
			$rs['rate'] = round( $standard_num / $detect_num ,2) * 100;
			$rss[] = $rs;
		}
	
		return $rss;
	}
	
	/**
	 * 获取所有关键词的上月消费
	 */
	function getConsdetailsForLastMonth(){
	
		$begin_date = date('Y-m-01', strtotime('-1 month'));
		$end_date 	=  date('Y-m-t', strtotime('-1 month'));
	
		for($i = 0 ;$i<= 30;$i++){
			$days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
		}
		
		
		
		$map['status'] 			= 1;
		
		foreach ( $days as $vo ){
			$consumption = 0;
			$map['createtime'] = array( 'LIKE', $vo .'%');
		
			$consumption = $this -> where( $map ) -> sum( 'price' );
			if( !$consumption ){
				$consumption = 0;
			}
			$rs['date'] = $vo;
			$rs['day'] =  intval( substr($vo,8));
			$rs['consumption'] = intval( $consumption );
			$rss[] = $rs;
		}
		
		return $rss;
	}
	
	
	/**
	 * 获取所有关键词的本月消费
	 */
	function getConsdetailsForThisMonth(){
	
		$begin_date = date('Y-m-01');
		$end_date 	= date('Y-m-d');
		
		$diff = (strtotime( $end_date ) - strtotime( $begin_date ) )/86400;
		
		
	
		for($i = 0 ;$i<= $diff;$i++){
			$days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
		}
	
		$map['status'] 			= 1;
	
		foreach ( $days as $vo ){
			$consumption = 0;
			$map['createtime'] = array( 'LIKE', $vo .'%');
	
			$consumption = $this -> where( $map ) -> sum( 'price' );
			if( !$consumption ){
				$consumption = 0;
			}
			$rs['date'] = $vo;
			$rs['day'] = intval( substr($vo,8) );
			$rs['consumption'] = intval( $consumption );
			$rss[] = $rs;
		}
	
		return $rss;
	}
	
	
	
	/**
	 * 获取最近10天的消费记录
	 * 
	 * 不包含今天的消耗
	 */
	function getAllConsumerdetails(){
		
		for($i=11;$i>0;$i--){
			$days[]=date('Y-m-d',strtotime("-{$i} days"));
		}
		//获取优化中的关键词，以及合作停的关键词
		// $map['_string'] = "(keywordstatus = '优化中' ) OR (keywordstatus = '合作停' AND cooperationstopdate > $days[0] )";
		$map['status'] 			= 1;
		
		foreach ( $days as $vo ){
			$consumption = 0;
			$map['createtime'] = array( 'LIKE', $vo .'%');
			
			$consumption = $this -> where( $map ) -> sum( 'price' );
			if( !$consumption )
			{
				$consumption = 0;
			}
			$rs['day'] = $vo;
			$rs['consumption'] = $consumption;
			$rss[] = $rs;
		}

		return $rss;
		
	}
	
	/**
	 * 获取最近10天的消费记录
	 * 
	 * 不包含今天的消耗
	 */
	function getMyConsumerdetails(){

		for($i=11;$i>0;$i--){
			$days[]=date('Y-m-d',strtotime("-{$i} days"));
		}
		//获取优化中的关键词，以及合作停的关键词
		// $map['_string'] = "(keywordstatus = '优化中' ) OR (keywordstatus = '合作停' AND cooperationstopdate > $days[0] )";
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		
		foreach ( $days as $vo ){
			$consumption = 0;
			$map['createtime'] = array( 'LIKE', $vo .'%');
				
			$consumption = $this -> where( $map ) -> sum( 'price' );
		
			$rs['day'] = $vo;
			$rs['consumption'] = $consumption;
			$rss[] = $rs;
		}
	}
	
	/**
	 * 获取子用户最近10天的消费记录
	 *
	 * 不包含今天的消耗
	 */
	function getConsdetailsForSub(){
	
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
		$map['ownuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
	
		foreach ( $days as $vo ){
			$consumption = 0;
			$map['createtime'] = array( 'LIKE', $vo .'%');
	
			$consumption = $this -> where( $map ) -> sum( 'price' );
			if( !$consumption ){
				$consumption = 0;
			}
			$rs['day'] = $vo;
			$rs['consumption'] = $consumption;
			$rss[] = $rs;
		}
		
		return $rss;
	}
	
	/**
	 * 获取所有用的用户最近10天的消费记录
	 *
	 * 不包含今天的消耗
	 */
	function getConsdetailsForAll(){
	
		// 如果当前的时间是下午
		//设置【日期/时间】 默认时区
		date_default_timezone_set('Asia/Shanghai');
	
		//获取当前小时
		$hour=date("G");
	
		/* if( $hour > 12 ){
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
		//$map['ownuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
	
		foreach ( $days as $vo ){
			$consumption = 0;
			$map['createtime'] = array( 'LIKE', $vo .'%');
	
			$consumption = $this -> where( $map ) -> sum( 'price' );
			if( !$consumption ){
				$consumption = 0;
			}
			$rs['day'] = $vo;
			$rs['consumption'] = $consumption;
			$rss[] = $rs;
		}
	
		return $rss;
	}
	/**
	 * 获取所有用的用户最近10天的达标任务
	 */
	function getStandardForAll(){
	
		// 如果当前的时间是下午
		//设置【日期/时间】 默认时区
		date_default_timezone_set('Asia/Shanghai');
	
		//获取当前小时
		$hour=date("G");
	
		/* if( $hour > 12 ){
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
		//$map['ownuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
	
		foreach ( $days as $vo ){
			$num = 0;
			$map['createtime'] = array( 'LIKE', $vo .'%');
	
			$num = $this -> where( $map ) -> count();
			if( !$num ){
				$num = 0;
			}
			$rs['day'] = $vo;
			$rs['num'] = $num;
			$rss[] = $rs;
		}
	
		return $rss;
	}
	
	
	/**
	 * 获取代理商所有的关键词达标扣费统计
	 *
	 * 获取代理商所有的关键词达标扣费统计
	 */
	function getFeeForSubUser( $userid, $dates ){
		
		$keywords = D('Biz/Keyword') -> getKeywordsForSubUser( $userid );
		foreach ($keywords as $vo_kw ){
			$keywordids[] = $vo_kw['id'];
		}
		
		$keywordids = array_unique( $keywordids );
		
		
		if( $keywordids ){
			unset( $map );
			$map['keywordid'] 	= array( 'IN', $keywordids );
			$map['status'] 		= 1;
			
			if( $dates ){
				foreach ( $dates as $vo ){
					$consumption = 0;
					$map['standarddate'] = array( 'LIKE', $vo .'%');
					$consumption = $this -> where( $map ) -> sum( 'price' );
						
					$rs['day'] = $vo;
					$rs['consumption'] = $consumption;
					$data[] = $rs;
				}
			}else{
				$data = $this -> where($map) -> sum('price');
			}
		}
		return $data;
	}
	
	/**
	 * 获取代理商所有的关键词达标扣费统计
	 *
	 * 获取代理商所有的关键词达标扣费统计
	 */
	function getFeeForAgentUser( $userid, $dates ){
	
		$keywords = D('Biz/Keyword') -> getKeywordsForAgentUser( $userid );
		foreach ($keywords as $vo_kw ){
			$keywordids[] = $vo_kw['id'];
		}
	
		$keywordids = array_unique( $keywordids );
	
	
		if( $keywordids ){
			unset( $map );
			$map['keywordid'] 	= array( 'IN', $keywordids );
			$map['status'] 		= 1;
				
			if( $dates ){
				foreach ( $dates as $vo ){
					$consumption = 0;
					$map['standarddate'] = array( 'LIKE', $vo .'%');
					$consumption = $this -> where( $map ) -> sum( 'price' );
	
					$rs['day'] = $vo;
					$rs['consumption'] = $consumption;
					$data[] = $rs;
				}
			}else{
				$data = $this -> where($map) -> sum('price');
			}
		}
		return $data;
	}
	
	
	/**
	 * 获取代理商所有的关键词达标扣费统计
	 *
	 * 获取代理商所有的关键词达标扣费统计
	 */
	function getFeeForAllUser( $dates ){
		$map['status'] 			= 1;
		if( $dates ){
			foreach ( $dates as $vo ){
				$consumption = 0;
				$map['standarddate'] = array( 'LIKE', $vo .'%');
				$consumption = $this -> where( $map ) -> sum( 'price' );

				$rs['day'] = $vo;
				$rs['consumption'] = $consumption;
				$data[] = $rs;
			}
		}else{
			$data = $this -> where($map) -> sum('price');
		}
		
		return $data;
	}
	
}
	
?>