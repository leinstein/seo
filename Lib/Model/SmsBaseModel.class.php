<?php
/**
 * 模型层：短消息模型的基类
 * 
 * @copyright   Copyright 2010-2012 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Know.Model
 * @version     201200822
 * @link        http://www.qisobao.com 
 */
 
abstract class SmsBaseModel extends Model {
	
	/**
	 * 短信接口配置
	 */
	public $config = array();

	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		
		$currentClassName=get_called_class();//获取子类的名称
		
		$this-> config = C($currentClassName::configName);//读取子类常量“configName”，调用短信配置
	}
	
}

?>