<?php

/**
 * 模型层：关键词检测视图模型类型
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170905
 * @link        http://www.qisobao.com
 */
class KeyworddetectViewModel extends ViewBaseModel{
	
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
	 * 关联表：ts_keyworddetectrecord - 关键词检测表，ts_keyword － 关键词表 
	 */
	public $viewFields = array (
			'ts_keyword' => array(
					'id',  
					'keyword',
					'website',
					'rank', //
					'createtime', //
					'status',
					'_table' 		=> 'ts_keyword',
					'_type' 		=> 'LEFT',
			),
			'ts_keyworddetectrecord' => array (
					'id' => 'id2',
					'initialranking',
					'createtime' 	=> 'createtime2', //
					'status' 		=> 'status2', //
					'regtime' 		=> 'regtime2', //
					'searchengine' 	=> 'searchengine2', //
					'keyword' 		=> 'keyword2', // 
					'website' 		=> 'website2', // 
					'_table' 		=> 'ts_keyworddetectrecord',
					'_on' 			=> 'ts_keyworddetectrecord.keywordid = ts_keyword.id AND ts_keyworddetectrecord.status=1 AND ts_keyworddetectrecord.createtime LIKE "2017-09-06%"',
			),
			
	);
}
	
?>