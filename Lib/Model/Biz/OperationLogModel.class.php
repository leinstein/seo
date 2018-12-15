<?php

/**
 * 模型层：业务操作日志模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170419
 * @link        http://www.qisobao.com
 */
class OperationLogModel extends BaseModel{
	
	/**
	 * 自动处理数据
	 */
	protected $__auto 		= array (
			array ('operation_user_id', 'getLoginUserId',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('operation_user_name', 'getloginUserName',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('operation_time','date',1,'function',array('Y-m-d H:i:s')), // 对createtime字
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
		$this -> trueTableName= C('DB_PREFIX') . 'operation_log';
		//合并自动验证
		$this->setProperty("_validate", array_merge($this->_validate, $this->__validate));
		//合并自动完成
		$this->setProperty("_auto", array_merge($this->_auto, $this->__auto));
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
	 * 进行站点的审批功能
	 *
	 * @param unknown $postData
	 * @return unknown
	 */
	function addLog( $type,$model,$operate,$postData ){
		
		//d
		$log['object_id'] 			= $postData['id'];
		$log['object_model'] 		= $model; 
		$log['object_type'] 		= $type;
		$log['operation_name'] 		= $operate;
		$log['operation_result'] 	= $postData['conclusion'];
		$log['operation_opinion'] 	= $postData['reviewopinion'];
		$log['operation_data'] 		= urldecode(json_encodeEOL(urlencodeAry( $postData ))); 
		$result =	$this -> insert($log);
	
		return $result;
	}
	
}
	
?>