<?php

/**
 * 模型层：快排宝-报表统计模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.QR
 * @version     20170629
 * @link        http://www.qisobao.com
 */
class QRReportModel extends BaseModel{
	
	
	/**
	 * 自动处理数据
	 */
	protected $__auto 		= array (
			array ('createuserid', 'getLoginUserId',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createusername', 'getloginUserName',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createtime','date',1,'function',array('Y-m-d H:i:s')), // 对createtime字
	);
	
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		$this -> trueTableName= C('DB_PREFIX') . 'qr_report';
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
			$me = $this -> getloginUserInfo();
			// 根据用户的角色判断该用户对该计划的权限
			switch ( $me['role_info']['rolecode']) {
				case 'sub':// 子用户
					if( $data['planstatus'] == '待审核'){
						$data['can_edit'] = 1;
						$data['can_delete'] = 1;
					}
					break;
				case 'agent':// 代理商用户
					if( $data['planstatus'] == '待审核'){
						$data['can_edit'] = 1;
						$data['can_delete'] = 1;
					}
					break;
				case 'operation':// 运维
					if( $data['planstatus'] == '待审核'){
						$data['can_edit'] = 1;
						$data['can_review'] = 1;
						$data['can_delete'] = 1;
					}
						
					if( $data['planstatus'] == '合作停'){
						$data['can_review'] = 1;
					}
					break;
				default:
					;
					break;
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
		$me = $this -> getloginUserInfo();
		foreach( $list as &$vo ){
			// 根据用户的角色判断该用户对该计划的权限
			switch ( $me['role_info']['rolecode']) {
				case 'sub':// 子用户
					if( $vo['planstatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_delete'] = 1;
					}
					break;
				case 'agent':// 代理商用户
					if( $vo['planstatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_delete'] = 1;
					}
					break;
				case 'operation':// 运维
					if( $vo['planstatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_review'] = 1;
						$vo['can_delete'] = 1;
					}
						
					if( $vo['planstatus'] == '合作停'){
						$vo['can_review'] = 1;
					}
					$list['can_review'] = 1;
					break;
				default:
					;
					break;
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
		$me = $this -> getloginUserInfo();
		foreach( $list['data'] as $key => &$vo ){
	
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $numberPerPage;
			$vo['No'] = $No;
			// 根据用户的角色判断该用户对该计划的权限
			switch ( $me['role_info']['rolecode']) {
				case 'sub':// 子用户
					if( $vo['planstatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_delete'] = 1;
					}
					break;
				case 'agent':// 代理商用户
					if( $vo['planstatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_delete'] = 1;
					}
					break;
				case 'operation':// 运维
					if( $vo['planstatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_review'] = 1;
						$vo['can_delete'] = 1;
					}
						
					if( $vo['planstatus'] == '合作停'){
						$vo['can_review'] = 1;
					}
					$list['can_review'] = 1;
					break;
				default:
					;
					break;
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
		// 获取我的全部计划
		$model = D('QR/QRPlan');
		foreach( $list['data'] as  $key => &$vo ){
			$plan = $model -> where( array('id' => $vo['planid']) ) -> find();
			$vo['planname'] = $plan['planname'];
			
		}
	
		return $list;
	}
	
	
	/**
	 * 增加导入记录
	 *
	 * 为每次关键词导入增加导入的记录
	 * 1、判断天数差是否大于0，如果大于0说明还有未增加的消费记录
	 * 2、循环天数，增加消费记录
	 * 
	 * @param unknown $userid 
	 * @param unknown $planid
	 * @param unknown $keyword_num
	 * @param unknown $standard_num
	 */
	function addRecord( $userid, $planid, $keyword_num, $records  ){
	
		// 关键词检测模型
		$model = D('QR/Keyworddetectrecord');
		
		// 循环导入原始数据，获取检测数据的日期
		foreach ($records as $vo ){
			$detecttimes[] = substr( $vo['detecttime'],0,10 ) ; 
		}
		
		// 时间去除
		$detecttimes = array_unique( $detecttimes );
		
		// 循环导入的原始检测的日期，
		foreach ($detecttimes as $vo_t){
			unset( $map);
			$standard_num = 0;// 达标关键词
			$standard_baidu_num = 0;// 百度达标关键词
			$standard_baidumobile_num = 0;// 百度手机达标关键词
			$standard_sougou_num = 0;// 搜狗达标关键词
			$homerank_num = 0;// 排位数
			$homerank_baidu_num = 0;// 百度排位数
			$homerank_baidumobile_num = 0;// 百度手机排位数
			$homerank_sougou_num = 0;// 搜狗排位数 
			$consumption = 0; // 排位消耗：只计算百度和百度手机的排位
			
			// 获取当天的全部关键词
			$map['planid'] 		= $planid;
			$map['detecttime'] 	= array('LIKE', $vo_t .'%');
			$map['status'] 		= 1;
			$list = $model -> field('rank,searchengine,keyword,detecttime') -> where( $map ) -> select();
			
			// 达标关键词
			$standard_num = count( $list );
			
			foreach ($list as $vo_record ){
				
				$ranks = explode('、',$vo_record['rank']);
				foreach ( $ranks as $vo_rank){
					if($vo_rank > 0 AND $vo_rank <= 10 ){
						// 排位数加一
						$homerank_num ++;
					}
				}
				
				switch ($vo_record['searchengine']) {
					case 'baidu':// 百度达标关键词
							
						$standard_baidu_num ++;
						
						foreach ( $ranks as $vo_rank){
							if($vo_rank > 0 AND $vo_rank <= 10 ){
								// 排位数加一
								$homerank_baidu_num ++;
								// 消耗加一
								$consumption++;
							}
						}
							
						break;
						
					case 'baidu_mobile':// 百度手机达标关键词
							
						$standard_baidumobile_num ++;
						foreach ( $ranks as $vo_rank){
							if($vo_rank > 0 AND $vo_rank <= 10 ){
								// 排位数加一
								$homerank_baidumobile_num ++;
								// 消耗加一
								$consumption++;
							}
						}
							
						break;
						
					case 'sougou':// 搜狗达标关键词
							
						$standard_sougou_num ++;
						foreach ( $ranks as $vo_rank){
							if($vo_rank > 0 AND $vo_rank <= 10 ){
								// 排位数加一
								$homerank_sougou_num ++;
							}
						}
							
						break;
							
					default:
						;
						break;
				}
				
			}
			/* dump($list);
			dump($standard_num );
			dump($standard_baidu_num );
			dump($standard_baidumobile_num );
			dump($standard_sougou_num );
			dump($homerank_num );
			dump($homerank_baidu_num );
			dump($homerank_baidumobile_num );
			dump($homerank_sougou_num );
			exit; */
			
		
			// 更新报表记录
			unset( $map );
			$map['planid'] 			= $planid;
			$map['reportdate'] 		= $vo_t;
			$map['status'] 			= 1;
			$data_old = $this -> selectOne($map);
			
			$data['planid'] 				= $planid;
			$data['userid'] 				= $userid;
			$data['consumption'] 			= $consumption;
			$data['keyword_number'] 		= $keyword_num;
			$data['standard_number'] 		= $standard_num;
			$data['baidu_number'] 			= $standard_baidu_num;
			$data['baidumobile_number'] 	= $standard_baidumobile_num;
			$data['sougou_number'] 			= $standard_sougou_num;
			$data['homerank_number'] 		= $homerank_num;
			$data['homerank_baidu_number'] 	= $homerank_baidu_num;
			$data['homerank_baidumobile_number'] 	= $homerank_baidumobile_num;
			$data['homerank_sougou_number'] = $homerank_sougou_num;
			
			if( $data_old ){
				$data['id'] = $data_old['id'];
				$result = $this -> update( $data );
			}else{
				//组合其他相关参数
				$data['reportdate'] 		=  $vo_t;
				$result = $this -> insert($data);
			}
			//dump( $this -> _sql());
		}
		
		
		return $result;
	}
	
	/**
	 * 获取一个计划的全部统计值情况
	 * $standard_num = 0;// 达标关键词
			$standard_baidu_num = 0;// 百度达标关键词
			$standard_baidumobile_num = 0;// 百度手机达标关键词
			$standard_sougou_num = 0;// 搜狗达标关键词
			$homerank_num = 0;// 排位数
			$homerank_baidu_num = 0;// 百度排位数
			$homerank_baidumobile_num = 0;// 百度手机排位数
			$homerank_sougou_num = 0;// 搜狗排位数 
	 * @param unknown $planid
	 */
	function getStatistics( $planid ){
		$map['planid'] = $planid; 
		$map['status'] = 1;
		
		// 百度达标关键词
		/* $baidu_number = $this -> where( $map ) -> sum( 'baidu_number' );
		// 百度手机达标关键词
		$baidumobile_number = $this -> where( $map ) -> sum( 'baidumobile_number' );
		// 搜狗达标关键词
		$sougou_number = $this -> where( $map ) -> sum( 'sougou_number' );
		// 达标关键词 */
		/* $sql = 'SELECT sum(`standard_number`) as standard_number,sum(`baidu_number`) as baidu_number,sum(`baidumobile_number`) as baidumobile_number ,sum(`sougou_number`) as sougou_number,sum(`homerank_number`) as homerank_number,sum(`homerank_baidu_number`) as homerank_baidu_number ,sum(`homerank_baidumobile_number`) as homerank_baidumobile_number,sum(`homerank_sougou_number`) as homerank_sougou_number FROM `ts_qr_report` WHERE  status = 1 AND planid = '.$planid;

		$data = $this -> query($sql); */
		
		return $this -> field( 'sum(`standard_number`) as standard_number,sum(`baidu_number`) as baidu_number,sum(`baidumobile_number`) as baidumobile_number ,sum(`sougou_number`) as sougou_number,sum(`homerank_number`) as homerank_number,sum(`homerank_baidu_number`) as homerank_baidu_number ,sum(`homerank_baidumobile_number`) as homerank_baidumobile_number,sum(`homerank_sougou_number`) as homerank_sougou_numbe') ->  where( $map ) -> find(  );;
	
	}
	
	/**
	 * 获取报表列表
	 */
	function getReports( $map, $fields, $order, $url_param, $num_per_page ){
		
		// 统计模型
		$model_statistics = D('QR/Statistics');
		
		// 获取满足条件的全部用户id
		$userids = $model_statistics -> getUserids();
		
		if( $userids ){
			
			//引用分页库
			import("ORG.Util.Page");
			
			$count 	= $this -> where($map) -> count();
			
			$num_per_page = !empty( $num_per_page ) ?  $num_per_page  : $this ->pageNum;
			
			// 实例化分页类传入总记录数和每页显示的记录数
			$Page = new Page ( $count, $num_per_page );
			
			/* //在翻页时需要加入查询条件，此操作只需要进行一次，如果没有构造条件，则构造，使用qb标志来保存状态
			if ( $_GET["qb"] != 1 ){
				//开始构造查询条件
				$Page->parameter = "&qb=1&" . $queryOptions['PageParameters'];
			} */
			
			// 分页显示输出
			$show = $Page->show ();
			
			$map['userid'] = array('IN', $userids);
			$map['status'] = 1;
			
			$p = !empty( $_GET['p'] ) ?  $_GET['p']  : 1;
			
			$start 	= ($p -1) * $num_per_page;
			$end 	= $num_per_page;
			
			// 批量统计查询
			$rss = $this -> where( $map ) -> field('left(reportdate,10) as reportdate,sum( `keyword_number` ) as keyword_number,sum( `consumption` ) as consumption,sum(`standard_number`) as standard_number,sum(`baidu_number`) as baidu_number,sum(`baidumobile_number`) as baidumobile_number ,sum(`sougou_number`) as sougou_number,sum(`homerank_number`) as homerank_number,sum(`homerank_baidu_number`) as homerank_baidu_number ,sum(`homerank_baidumobile_number`) as homerank_baidumobile_number,sum(`homerank_sougou_number`) as homerank_sougou_number ') ->  group( 'left(reportdate,10)' ) -> order('reportdate desc') -> limit( $start, $end) -> select() ;
			
			foreach ($rss as $key => &$vo){
				$No = ($key + 1) + ($p -1) * $num_per_page;
				$vo['No'] = $No;
			}
			//$list = $this -> queryRecordEx( $map, $fields, $order,  $url_param,$num_per_page );
			
			//拼接输出
			$list ['data'] 		= $rss;
			$list ['count'] 	= $count;
			$list ['html'] = $show;
			$list ['pageCount'] = ceil($count/$num_per_page);     //总页数 intval($Page->totalPages);
		}
		return $list;
	}
	
	
	/**
	 * 获取报表详情
	 * 
	 */
	function getReportDetails( $map, $fields, $order, $url_param, $num_per_page ){
		// 统计模型
		$model_statistics = D('QR/Statistics');
		
		// 获取满足条件的全部用户id
		$userids = $model_statistics -> getUserids();
		
		if( $userids ){
			// 统计模型
			$model 		= D( 'QR/Keyworddetectrecord');
			$map['userid'] = array('IN', $userids);
			$list = $model -> queryRecordEx( $map, $fields, $order, $url_param, $num_per_page );
		}
				
	
		
				
		return $list;
	}
	
	
	/**
	 * 导出报表
	 *
	 * 从计划中导出关键词到excel中
	 *
	 * @param int $id
	 */
	function exportReport( $reportdate ){
	
		// excel 模型类
		$model_excel 	= D('Tool/Excel');
		
		// 关键词检测模型
		$model_detect 	= D('QR/Keyworddetectrecord');
		
		// 统计模型
		$model_statistics = D('QR/Statistics');
		
		// 获取满足条件的全部用户id
		$userids = $model_statistics -> getUserids();
		
		if( $userids ){
			// 从关键词检测表中获取选择日期的检测
			$map['detecttime'] 	=  array('LIKE', $reportdate .'%');
			$map['userid'] 		= array('IN', $userids);
			$map['status'] 		= 1;
			$list = $model_detect -> queryRecordAll( $map);
			
			$filename 	='关键词报表_' .$reportdate;
			$sheetTitle ='关键词报表（'.$reportdate.'）';
			
			$model_excel -> writeMode1( $beginRow = 2, $beginColumn ='A' , $filePath , $sheetNum = 0, $list, C('QR_REPORT_EXPORT_CONFIG'),  $filename, $sheetTitle  );
			
		}
		
	
	}
}
	
?>