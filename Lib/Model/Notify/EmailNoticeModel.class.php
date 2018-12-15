<?php
/**
 * 模型层：邮件提醒模型类 
 *
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Notify
 * @version     20170718
 * @link        http://www.qisobao.com
*/
 
class EmailNoticeModel extends BaseModel {
	
	protected $tableName = 'email_notice_record'; 
	
	/*自动处理数据*/
	protected $__auto 		= array (
			// 			array ('userstatus', '1',    Model::MODEL_INSERT),
	);
	
	/*
	 * 自动验证设置
	*/
	protected $__validate	 =	 array(
			// 			array('username','/[^\s].*/','请输入用户名！',0,Model::MODEL_BOTH),
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
		//合并自动验证
		$this->setProperty("_validate", array_merge($this->_validate, $this->__validate));
		//合并自动完成
		$this->setProperty("_auto", array_merge($this->_auto, $this->__auto));
	}
	
	
	/**
	 * 发送邮件通知
	 * @param string $email 邮箱地址
	 * @param string $title 邮件标题
	 * @param string $template  模板
	 * @param array $templatedata 解析模板的数据
	 * @param array $data 通知日志记录信息
	 * @return mixed
	 */
	function sendEmailNotice($email,$title,$template,$templatedata,$data){
		$sms_model=D('kernel://Biz/Email');
		$ContentAnalysis_action=A('kernel://ContentAnalysis');
		$content=$ContentAnalysis_action->getContent($template,$templatedata);
		$result=$sms_model->sendMail($email,$title,$content);
		if($result){
			$result=$this->insert($data);
		}
		return $result;
	}
}

?>