<?php

/**
 * 模型层：系统管理模型
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170518
 * @link        http://www.qisobao.com
 */

class DepartinfoModel extends BaseModel{
	
	/**
	 * 用户表名称
	 */
	protected $trueTableName = 'ts_sys_departinfo';
	
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		
		//执行父类构造函数
		parent::_initialize();
		
	}
	
	/**
	 * 根据当前的分组获取全部的部门
	 */
	function getDepartCodeset( $orggroup ){
		if( !$orggroup ){
			$orggroup = GROUP_NAME;
		}
		$map['orggroup'] 	= $orggroup;
		$map['status'] 		= 1;
		$list = $this -> queryRecordAll($map,'id,orgid,departname');
		foreach ($list as $vo ){
			$codeset[$vo['orgid']] = $vo['departname'];
		}
		return $codeset;
	}
}
	
?>