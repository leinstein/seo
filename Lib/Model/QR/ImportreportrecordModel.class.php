<?php

/**
 * 模型层：关键词导入原始记录模型
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.QR
 * @version     20170629
 * @link        http://www.qisobao.com
 */
class ImportreportrecordModel extends BaseModel{
	
	
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
		$this -> trueTableName= C('DB_PREFIX') . 'qr_importreportrecord';
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
		
		}
		return $data;
	}
	
	
	
	/**
	 * 增加导入记录
	 * 
	 * 为每次关键词导入增加导入的记录
	 * 1、判断天数差是否大于0，如果大于0说明还有未增加的消费记录
	 * 2、循环天数，增加消费记录
	 * 
	 * @param array $record 关键词信息
	 * @param int $diff 相差的天数
	 * @return boolean|string|unknown
	 */
	function addRecord( $planid, $fileid, $original_data ){
		
		//组合其他相关参数
		$data['planid'] 			= $planid;
		$data['fileid'] 			= $fileid;
		$data['original_data'] 		= my_json_encode( $original_data );
	
		return $this -> insert($data);
	}
	
	
}
	
?>