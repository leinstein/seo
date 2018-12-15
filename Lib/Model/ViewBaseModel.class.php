<?php
/**
 * 模型层：视图类业务模型的基类，只提供查询操作
 * 
 * 新增模型层自我取值的功能，表现为 getMe, getAll函数，类似于AR模式
 *
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model
 * @version     20141010
 * @link        http://www.qisobao.com
 */
import("@.Org.Util.ModelTools");
abstract class ViewBaseModel extends ViewModel {
	/**
	 * 用户处理类名称
	 */
	const USER_MODEL_NAME		= '';
	
	/**
	 * 对象数据
	 */
	public $objdata			= null;
		
	/**
	 * 翻页记录数配置
	 */
	public $pageNum 			= 20;
	
	/**
	 * 业务操作步骤
	 */
	protected $bizSteps = array();
	
	/**
	 * 基类构造函数，完成对类实例的初始化
	 *
	 * @return void
	 */
	public function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		//设置默认值
		if( C('NUM_PER_PAGE') )
			$this -> pageNum = C('NUM_PER_PAGE');
	}
	
	/**
	 * 外部接口：获得当前登录的用户名称
	 *
	 * @return string 当前登录的用户名称
	 */
	public function getloginUserName() {
		//返回当前用户名
		return ModelTools :: getloginUserName(self::USER_MODEL_NAME);
	}
		
	/**
	 * 外部接口：获得当前登录的用户编号
	 *
	 * @return string 当前登录的用户编号
	 */
	public function getLoginUserId() {
		//返回当前用户名
		return ModelTools :: getLoginUserId(self::USER_MODEL_NAME);
	}
	
	/**
	 * 外部接口：获得当前登录的用户信息
	 *
	 * @return 当前登录的用户信息
	 */
	public function getloginUserInfo() {
		//返回当前用户信息
		return ModelTools :: getloginUserInfo(self::USER_MODEL_NAME);
	}
	
	/**
	 * 根据查询条件查询符合条件的所有记录集合
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志以及最大记录数这几个条件对记录集进行过滤筛选并返回结果。
	 *
	 * @param array $map 查询条件
	 * @param string $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param boolean $Relation 表示是否采用关系模型来查询，可选值为:true,false，默认false。当采用关系模型时，会查询和当前模型有关系的数据，并放入到返回结果。
	 * @param int $maxCount 表示全部查询时取的最大记录数，一般情况为避免系统消耗太多性能，默认为10000，注意导出数据时修改此参数；
	 * @return mixed 查询结果
	 */
	public function queryRecordAll($map, $field = null, $order = null, $relation = false, $maxCount = 10000) {
		return ModelTools :: queryRecordAll( $this, $map, $field, $order, $relation, $maxCount );
	}

	/**
	 * 查询单个对象信息
	 *
	 * 根据查询条件查询数据库中的单条记录，并返回结果。
	 *
	 * @param array $map 查询条件，如果是整型值，则直接作为主键值进行查询
	 * @param boolean $relation 是否采用关系模型，当采用关系模型时，会查询和当前模型有关系的数据，并放入到返回结果中。
	 * @return mixed 如果查询成功则返回对象信息，如果失败则返回false
	 */
	public function selectOne($map, $relation = false) {
		return ModelTools :: selectOne($this, $map, $relation);
	}
	
	/**
	 * 查询单个对象信息用于详细信息页面
	 *
	 * 调用selectOne方法根据查询条件查询数据库中的单条记录，并返回结果。此处单独声明一个函数是便于子类进行重写。
	 *
	 * @param var $map 查询条件，如果是整型值，则直接作为主键值进行查询
	 * @param boolean $relation 是否采用关系模型，当采用关系模型时，会查询和当前模型有关系的数据，并放入到返回结果中。
	 * @return mixed 如果查询成功则返回对象信息，如果失败则返回false
	 */
	public function selectOneDetail($map, $relation = false) {
		return ModelTools :: selectOne($this, $map, $relation = false );
	}
	
	/**
	 * 根据查询条件查询符合条件的所有记录集合，以翻页模式返回数据
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志，每页记录数，翻页参数这几个条件对记录集进行过滤筛选并返回结果。
	 *
	 * @param array $map 查询条件； 
	 * @param string $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param array $queryOpts 查询参数配置，目前包括：'Relation', 'NumberPerPage', 'PageParameters'等等；
	 *  											Relation　表示是否采用关系模型来查询，可选值为:true,false，默认false; 
	 *  											NumberPerPage  表示每页记录数，值为整数，默认读取配置文件中的NUM_PER_PAGE; 
	 *  											PageParameters  表示翻页后的参数，字符串类型默认为空; 特别的：如果输入数值，那么直接表示每页个数；如果是真假值，那么表示关系；如果输入文本，那么表示PageParameters；
	 *  
	 * @return mixed 查询结果
	 */
	public function queryRecord($map, $fields, $order = null, $queryOpts) {
		return ModelTools :: queryRecord($this, $map, $fields, $order, $queryOpts);
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
	public function queryRecordEx($map, $fields, $order = null,  $url_param ='', $num_per_page = 10) {
		$queryOpts = array();
		$queryOpts['Relation'] = false;
		$queryOpts['NumberPerPage'] = $num_per_page;
		$queryOpts['PageParameters'] = $url_param;
		return ModelTools :: queryRecord($this, $map, $fields, $order, $queryOpts);
	}
	
	/**
	 * 自定义查询记录集，用于复杂的查询需求
	 *
	 * 根据自定义查询语句来查询数据库记录集。
	 * 调用例子：　$model -> queryRecordBySql ("SELECT * FROM __TABLE__", "SELECT count(id) AS count FROM __TABLE__", $queryOpts);
	 * 
	 * @param string $rsSql 查询SQL语句
	 * @param string $countSql 统计SQL语句
	 * @param $queryOpts 查询参数配置，目前包括：'Relation', 'NumberPerPage', 'PageParameters'等等，说明见方法queryRecord。
	 * @return mixed 如果成功，则返回查询结果
	 */
	public function queryRecordBySql($rsSql, $countSql, $queryOpts) {
		//查询结果
		return ModelTools :: queryRecordBySql($this, $rsSql, $countSql, $queryOpts);
	}
	
	/**
	 * 根据页面查询域配置查询符合条件的所有记录集合，以翻页模式返回数据
	 *
	 * 根据页面查询域配置，排序设置，关系模型标志，每页记录数，翻页参数这几个条件对记录集进行过滤筛选并返回结果。
	 *
	 * @param array $query_fields 查询域数组（什么是查询域数组，请参见 BaseAction:: getQueryFields 注释） 
	 * @param string $order 排序参数
	 * @param array $queryOpts 查询参数配置，目前包括：'Relation', 'NumberPerPage', 'PageParameters'等等，说明见方法queryRecord。
	 * @param array $condition 附加查询条件
	 * @return mixed 如果成功，则返回查询结果 
	 */
	public function queryRecordByPage($query_fields, $order = null, $queryOpts, $condition = null) {
		//查询结果
		return ModelTools :: queryRecordByPage($this, $query_fields, $order = null, $queryOpts,$condition);
	}
	
	
	/**
	 * 模型层外部通用接口之一
	 *
	 * 输入数据集，进行翻译，并返回翻译后的数据集
	 *
	 * @param array $recordSet 翻译目标记录集；
	 * @param string $dictName 字典1名称，取语言包里面的数组变量
	 * @param array $otherDict 字典2，是一个数组，可以与字典1的数据合并
	 * @return mixed 转换后的而结果
	 */
	protected function translateObjects($recordSet, $dictName, $otherDict = null) {
		//返回结果	
		return ModelTools:: translateObjects($recordSet, $dictName, $otherDict);
	}
	
	/**
	 * 返回代码集类型的数据
	 *
	 * 根据查询条件，选取字段配置，排序设置这几个条件对记录集进行过滤筛选并返回代码集形式的结果。
	 *
	 * @param array $map 获取条件
	 * @param string $field 代码集字段，如需要取orgid, orgname, 则可以写成'orgid, orgname', 或者array('orgid','orgname');
	 * @param string $order 排序规则
	 * @param string $first 前置代码，作用是定制
	 * @return mixed 代码集形式的数据
	 */
	public function getCodeSet( $map = null, $field, $order = null, $first = null) {
		//返回结果	
		return ModelTools::getCodeSet( $this, $map, $field, $order, $first);
	}
	
	/**
	 * 保存对数据库的操作
	 *
	 * @param string $ssql
	 * @param string $note
	 */
	protected function saveStep($note, $ssql){
		$step_log['time'] = $this->getCurrentTime();
		$step_log['note'] = $note;
		$step_log['SQL'] = $ssql;
		$this->bizSteps[] = $step_log;
	}
	
	/**
	 * 获取所有对数据库的操作
	 */
	public function getBizSteps(){
		return $this->bizSteps;
	}
	
	/**
	 * 获得当前时间，带微秒的
	 */
	private function getCurrentTime(){
		$mtime1 = explode(" ", microtime());
		$mtime2 = explode(".", $mtime1[0]);
		return date("YmdHis") . "." . $mtime2[1];
	}
	
}
?>