<?php
/**
 * 模型层：短信提醒模型类 
 *
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Notify
 * @version     20170718
 * @link        http://www.qisobao.com
*/
 
class SMSNoticeModel extends BaseModel {
	
	protected $tableName = 'sms_notice_record'; 
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
	 * 发送短信通知
	 * @param string $mobileNo  手机号码（多个手机号用半角逗号隔开）
	 * @param string $msgcontent 通知内容
	 * @param array $data 通知日志记录相关信息
	 * @return mixed
	 */
	function sendSMSNotice($mobileNo,$msgcontent,$data){
		$sms_model=D('kernel://Biz/SMS');
		$result=$sms_model->send($mobileNo,$msgcontent,"POST");
		if($result>=0){
			$result=$this->insert($data);
		}
		return $result;
	}
	
	
}

?>