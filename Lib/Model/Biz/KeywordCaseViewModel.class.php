<?php

/**
 * 模型层：关键词案例石头模型类型
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170419
 * @link        http://www.qisobao.com
 */
class KeywordCaseViewModel extends ViewBaseModel{
	
	/**
	 * 不检查数据库
	 */
	protected $autoCheckFields = false;

	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
	}
	
	/**
	 * 实际查询的数据表
	 * 
	 * 关联表：ts_declare_report - 申报单表，ts_declare_rdprojconfirm － 申报单详细表 
	 */
	public $viewFields = array (
			'ts_keyworddetectrecord' => array(
					'id',  
					'keyword',
					'website',
					'rank', //项目预计总经费
					'createtime', //本年度预算经费
					'status' => 'status1', //本年度预算经费
					'regtime' => 'regtime1', //本年度预算经费
					'searchengine' => 'searchengine1', //本年度预算经费
					'keyword' => 'keyword1', //本年度预算经费
					'website' => 'website1', //本年度预算经费
					
					'_table' => 'ts_keyworddetectrecord',
					'_type' => 'LEFT',
			),
			'ts_keyword' => array (
					'id',
					'initialranking',
					'_table' => 'ts_keyword',
					'_on' => 'ts_keyworddetectrecord.keywordid = ts_keyword.id',
			),
			
	);
}
	
?>