<?php

/**
 * 模型层：纳米企业群视图类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20141021
 * @link        http://www.qisobao.com
 */
class FundsfreezeModel extends BaseModel{
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		$this -> trueTableName= C('DB_PREFIX') . 'fundsfreeze';
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
	 * 获取我的站点列表
	 */
	function addRecord( $data ){
	
		$data['createtime'] 	= date('Y-m-d H:i:s');
		$data['createuserid'] 	= $this -> getLoginUserId();
		$data['createusername'] = $this -> getloginUserName();
		
		 
		return $this -> insert($data);
	}
	
}
	
?>