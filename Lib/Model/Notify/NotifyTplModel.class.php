<?php
/**
 * 模型层：网页消息提醒模型类 
 *
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Notify
 * @version     20170718
 * @link        http://www.qisobao.com
*/
 
class NotifyTplModel extends BaseModel {
	
	/**
	 * 数据表名称
	 */
	protected $tableName = 'sys_notify_tpl';
	
	/*自动处理数据*/
	protected $__auto 		= array (
// 			array ('userstatus', '1',    Model::MODEL_INSERT),
	);
	
	/*
	 * 自动验证设置
	*/
	protected $__validate	 =	 array(
// 			array('username','/[^\s].*/','请输入用户名！',0,Model::MODEL_BOTH),
// 			array('username','','用户名已经存在！',0,'unique',Model::MODEL_INSERT),
// 			array('password','/[^\s].*/','请输入密码！',0,Model::MODEL_BOTH),
// 			array('repassword','/[^\s].*/','请输入确认密码！',0,Model::MODEL_BOTH),
// 			array('repassword','password','密码和确认密码不一致！',0,'confirm'),
// 			array('truename','/[^\s].*/','请输入真实姓名！',0,Model::MODEL_BOTH),
	);
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
	
// 		//初始化变量
// 		$this->__auto[0][0] 	= $this->field_userstatus;
// 		$this->__validate[0][0]	= $this->field_username;
// 		$this->__validate[1][0]	= $this->field_username;
// 		$this->__validate[2][0]	= $this->field_userpass;
// 		$this->__validate[3][0]	= $this->field_repass;
// 		// 		$this->__validate[4][0]	= $this->field_repass;
// 		// 		$this->__validate[4][1]	= $this->field_userpass;
		// 		合并自动验证
		$this->setProperty("_validate", array_merge($this->_validate, $this->__validate));
		//合并自动完成
		$this->setProperty("_auto", array_merge($this->_auto, $this->__auto));
	}
	
	/**
	 * 新增模板
	 * @param array $data
	 * @return mixed
	 */
	function insert($data){
		return $this->insert($data);
	}
	
	/**
	 * 查询模板
	 * @return mixed
	 */
	function queryTemplate(){
		$map['status']=1;
		return $this->queryRecordAll($map);
	}
	
	
}

?>