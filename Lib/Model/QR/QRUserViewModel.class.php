<?php

/**
 * 模型层：海排用户管理视图模型类 
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.QR
 * @version     20171012
 * @link        http://www.qisobao.com
 */

class QRUserViewModel extends ViewBaseModel{

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
	 * 实际查询的数据表
	 * 
	 * 关联表：ts_keyworddetectrecord - 关键词检测表，ts_keyword － 关键词表 
	 */
	public $viewFields = array (
			
		
			'user' => array(
					'id',  
					'pid',
					'epid',
					'epname',
					'usergroup', //
					'username', //
					'truename', //
					'email', //
					'mobileno', //
					'telephone', //
					'QQnumber', //
					'contact', //
					'usertype', //
					'usertype_desc', //
					'_table' 		=> 'ts_sys_user',
					'_type' 		=> 'LEFT',
					
			),
			'epdir' => array (
					//'id',
					/*'epname',*/
					'epgroup', 
					'seller_manager',
					'seller',
					'customer_manager',
					'customer',
					'operationer_manager',
					'operationer',
					'product',	
					//'status' 		=> 'status2', //
					'_table' 		=> 'ts_sys_epdir',
					'_on' 			=> 'epdir.id = user.epid AND epdir.status=1 AND user.status=1 AND user.usertype = "sub"',
					//'_on' 			=> 'ts_sys_epdir.id = ts_sys_user.epid AND ts_sys_epdir.status=1 AND ts_sys_epdir.product LIKE \'%"id":"2"%\' AND ts_sys_user.status=1',
			), 
			
	);
	
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
			
			// 从扩展信息中获取
			$data['expand_arr'] = json_decode($data['expand_info'], true );
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
			// 从扩展信息中获取
			if( $vo['expand_arr'] ){
				$vo['expand_arr'] = json_decode($vo['expand_info'], true );
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


		foreach( $list['data'] as $key => &$vo ){
	
			
			// 从扩展信息中获取
			if( $vo['expand_arr'] ){
				$vo['expand_arr'] = json_decode($vo['expand_info'], true );
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
		
		//获取每页显示条数
		$numberPerPage = $queryOpts;//$queryOpts['NumberPerPage'];
		if( !$numberPerPage ) {
			$numberPerPage = $this -> pageNum;;
		}
		
		foreach( $list['data'] as  $key => &$vo ){
		
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
	public function getUserList( $map, $fields, $order = null,  $url_param = '', $num_per_page = 20) {
	
		$map['epdir.product '] = array('LIKE','%"id":"2"%');
		
		$list = $this -> queryRecordEx($map, $fields, $order,  $url_param, $num_per_page);
		
		// 计划模型
		$model_plan 	= D('QR/QRPlan');
		// 报表模型
		$model_report 	= D('QR/QRReport');
		// 用户模型
		$model_user 	= D('User/User');
	
		foreach( $list['data'] as  $key => &$vo ){
			unset($map_plan);
			// 获取计划数量
			$map_plan['createuserid'] = $vo['id'];
			$map_plan['status'] = 1;
			$plan_num = $model_plan -> where( $map_plan ) -> count();
			$vo['plan_num'] =  $plan_num;
			// 获取关键词数量
			$keyword_num = $model_plan -> where( $map_plan ) -> sum( 'keywordnumber' );
			$vo['keyword_num'] =  $keyword_num;
			
			if( $plan_num ){
				unset($map_report);
				// 获取全部的消耗
				$map_report['userid'] 		= $vo['id'];
				$map_report['status'] 		= 1;
					
				// 获取计费始日
				$report =   $model_report -> field( 'reportdate') ->  where( $map_report ) -> order( 'reportdate') ->  find();
				$vo['start_date'] = $report['reportdate'];
				// 获取总的排位消耗
				$consumption1 =   $model_report -> field( 'sum(`consumption`) as consumption') ->  where( $map_report ) -> find( );
				$vo['consumption_total'] = $consumption1['consumption'];
				// 获取昨日排位消耗
				$map_report['reportdate'] 	= date("Y-m-d",strtotime("-1 day"));
				$consumption2 =   $model_report  ->  field('consumption') ->  where( $map_report ) -> find( );
				$vo['consumption_yesterday'] = $consumption2['consumption'];
				// 获取今日排位消耗
				$map_report['reportdate'] 	= date('Y-m-d');
				$consumption3 =   $model_report  ->  field('consumption') ->  where( $map_report ) -> find( );
				$vo['consumption_today'] = $consumption3['consumption'];
				
				// 总的排位。目前默认是100000个
				$vo['rank_total'] = 100000;
				// 剩余的排位
				$vo['rank_remain'] = $vo['rank_total'] - $vo['consumption_total'];
			}else{
				$vo['start_date'] = '-';
				$vo['consumption_total'] = '-';
				$vo['consumption_yesterday'] = '-';
				$vo['consumption_today'] = '-';
				$vo['rank_total'] = '-';
				$vo['rank_remain'] = '-';
			}
			
			
			// 获取销售经理和销售员
			if( $vo['seller_manager']){
				$vo['seller_manager'] = $model_user -> selectOne ( array('id' => $vo['seller_manager'] ));
			}
			if( $vo['seller']){
				$vo['seller'] = $model_user -> selectOne ( array('id' => $vo['seller'] ));
			}
			
		}
		return $list;
	}
	
}
	
?>