<?php

/**
 * 后台控制层类 - 图书信息控制类（示例）
 *
 * @copyright   Copyright 2010-2014 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Action
 * @version     20141010
 * @type		project
 * @link        http://www.dejax.cn
 */

class DemoBookAction extends BaseAction {
	
	/**
	 * 初始化函数
	 * 
	 * @access public
	 */
	public function _initialize() {
		//继承
		parent::_initialize();
		//初始化变量
		$this->modelName = "Demo/Book";
	}
	
	/**
	 * 图书信息列表查询功能
	 * 
	 * @access public
	 */
	public function index() {		
		//初始化模型
		$model = D($this->modelName);
		//获得查询结果
		$data =   $model->queryRecordEx($map, $fields, $order = null,  $url_param = '');
		// 输出模板
		$this->assign($model->getModelName() . 's', $data);
		$this->display(); 
	}
	
	/**
	 * 显示图书信息增加界面
	 *
	 * @access public
	 */
	public function insertPage() {
		// 输出模板
		$this->display('insert');
	}
	
	/** 
	 * 保存新的图书信息
	 * 
	 * @access public
	 */
	public function insert() {
		//初始化模型
		$model = D($this->modelName);
		//创建对象
		$result = $model->insert();
		//判断结果
		$this->setResult($result, "index");
	}
	
	/**
	 * 删除图书信息
	 *
	 * @access public
	 */
	public function delete() {
		//初始化模型
		$model = D($this->modelName);
		//删除记录
		$result = $model->deleteRecord($this->getPKMap($model));
		//判断结果
		$this->setResult($result, 'index');
	}
	
	/**
	 * 显示图书信息修改界面
	 *
	 * @access public
	 */
	public function updatePage() {
		//初始化模型
		$model = D($this->modelName);
		//利用主键，查询图书信息
		$data = $model->selectOne($this->getPKMap($model));
		//显示结果
		$this->showResult($data, $model->getModelName(), 'update');
	}
	
	/**
	 * 图书信息修改功能
	 *
	 * @access public
	 */
	public function update() {
		//初始化模型
		$model = D($this->modelName);
		//创建对象
		$result = $model->update();		
		//判断结果
		$this->setResult($result, 'index');
	}
	
}