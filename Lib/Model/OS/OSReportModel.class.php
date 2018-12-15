<?php

/**
 * 模型层：优站宝-报表统计模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.OS
 * @version     20171102
 * @link        http://www.qisobao.com
 */
class OSReportModel extends BaseModel{
	
	
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
	 * 获取今日合作停的关键词
	 */
	function get_cooperate_stop_today(){
		
		// 关键词模型
		$model_keyword 	= D('Biz/Keyword'); 
		$list  = $model_keyword -> get_cooperate_stop_today();
		return $list;
	}
	
	/**
	 * 导出报表
	 *
	 * 从计划中导出关键词到excel中
	 *
	 * @param int $id
	 */
	function export_cooperate_stop_today( $reportdate ){
	
		// excel 模型类
		$model_excel 	= D('Tool/Excel');
		
		// 关键词模型
		$model_keyword 	= D('Biz/Keyword');
		
		
		// 获取满足条件的全部用户id
		$list = $this -> get_cooperate_stop_today();
		
		$filename 	='合作停关键词报表_' .date('Y-m-d');
		$sheetTitle ='合作停关键词报表（' .date('Y-m-d') .'）';
			
		$model_excel -> writeMode1( $beginRow = 2, $beginColumn ='A' , $filePath , $sheetNum = 0, $list, C('OS_KEYWORD_REPORT_EXPORT_CONFIG'),  $filename, $sheetTitle  );
	}
	
	/**
	 * 获取今日合作停的关键词
	 */
	function get_cooperate_stop_all(){
	
		// 关键词模型
		$model_keyword 	= D('Biz/Keyword');
		$list  = $model_keyword -> get_cooperate_stop_all();
		
		return $list;
	}
	
	/**
	 * 导出报表
	 *
	 * 从计划中导出关键词到excel中
	 *
	 * @param int $id
	 */
	function export_cooperate_stop_all( $reportdate ){
	
		// excel 模型类
		$model_excel 	= D('Tool/Excel');
	
		// 关键词模型
		$model_keyword 	= D('Biz/Keyword');
	
	
		// 获取满足条件的全部用户id
		$list = $this -> get_cooperate_stop_all();
	
		$filename 	='全部合作停关键词报表_' .date('Y-m-d');
		$sheetTitle ='全部合作停关键词报表';
			
		$model_excel -> writeMode1( $beginRow = 2, $beginColumn ='A' , $filePath , $sheetNum = 0, $list, C('OS_KEYWORD_REPORT_EXPORT_CONFIG'),  $filename, $sheetTitle  );
	}
	
	/**
	 * 获取今日合作停的关键词
	 */
	function get_new_keyword_today(){
	
		// 关键词模型
		$model_keyword 	= D('Biz/Keyword');
		$list  = $model_keyword -> get_new_keyword_today();
		return $list;
	}
	
	/**
	 * 导出报表
	 *
	 * 从计划中导出关键词到excel中
	 *
	 * @param int $id
	 */
	function export_new_keyword_today(  ){
	
		// excel 模型类
		$model_excel 	= D('Tool/Excel');
	
		// 关键词模型
		$model_keyword 	= D('Biz/Keyword');
	
	
		// 获取满足条件的全部用户id
		$list = $this -> get_new_keyword_today();
	
		$filename 	='新增关键词报表_' .date('Y-m-d');
		$sheetTitle ='新增关键词报表（' .date('Y-m-d') .'）';
			
		$model_excel -> writeMode1( $beginRow = 2, $beginColumn ='A' , $filePath , $sheetNum = 0, $list, C('OS_KEYWORD_REPORT_EXPORT_CONFIG'),  $filename, $sheetTitle  );
	}
	
	
}
	
?>