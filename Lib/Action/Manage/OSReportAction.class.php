<?php

/**
 * 优站宝报表管理公共控制层类
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Manage
 * @version     20171102
 * @link        http://www.mitong.com
 */

class OSReportAction extends BaseAction {
	
	/*
	 * 公共函数，不接受权限检查，写法 array('index');
	 */
	public $public_functions = array('');
	
	/**
	 * 初始化函数
	 * 
	 * @return void
	 */
	public function _initialize() {
		//继承
		parent::_initialize();
		
		$this->modelName = "OS/OSReport";
	}
	
	/**
	 * 关键词排名匹配：和昨天相比差异
	 *
	 * @accesspublic
	 */
	public function matchPage(){
		
		// 从关键词表获取全部未达标的关键词
	
		$model 		= D( $this->modelName);
		
		$map_kw['status'] 			= 1;
		$map_kw['keywordstatus'] 	= '优化中';
		$map_kw['standardstatus'] 	= '未达标';
		$map_kw['latestranking'] 	= array( array('EQ',0),array('GT',10),array('EXP','IS NULL'),array('EQ',''),'OR');
		//$page['list'] = $model -> queryRecordAll( $map_kw,'id,website,keyword,latestranking as rank,searchengine,createuserid,createusername' );
	
		$this -> assign($page);
	
		$this->display();
	
	}
	
	
	/**
	 * 关键词排名匹配：和昨天相比差异
	 *
	 * @accesspublic
	 */
	public function importMatchPage(){
	
		// 从关键词表获取全部未达标的关键词
	
		$model 		= D( $this->modelName);
	
		$map_kw['status'] 			= 1;
		$map_kw['keywordstatus'] 	= '优化中';
		$map_kw['standardstatus'] 	= '未达标';
		$map_kw['latestranking'] 	= array( array('EQ',0),array('GT',10),array('EXP','IS NULL'),array('EQ',''),'OR');
		$page['list'] = $model -> queryRecordAll( $map_kw,'id,website,keyword,latestranking as rank,searchengine,createuserid,createusername' );
	
		$this -> assign($page);
	
		$this->display();
	
	}
	
	function importMatch(){
		$model 		= D( $this->modelName);
		$page['list'] =  $model -> importMatch( $_REQUEST);
		
		$this -> assign($page);
		//dump($page['list'] );exit;
		$this->display( 'matchPage' );
		//$this->success ( '审核成功！', U ( 'index'),false,true);
	}
	
	
	/**
	 * 获取今天的合作停的关键词
	 */
	function cooperate_stop_today(){
		// 关键词模型
		$model 		= D( $this->modelName);
		
		$list = $model -> get_cooperate_stop_today();
		
		$page['list'] = $list;
		$this -> assign($page);
		$this -> display();
		
	}
	
	/**
	 * 导出今日合作停的关键词
	 */
	function export_cooperate_stop_today(){
		
		$model 	= D( $this->modelName);
		
		$model -> export_cooperate_stop_today ( );
	}
	
	
	/**
	 * 获取全部的合作停的关键词
	 */
	function cooperate_stop_all(){
		// 关键词模型
		$model 		= D( $this->modelName);
	
		$list = $model -> get_cooperate_stop_all();
	
		$page['list'] = $list;
		$this -> assign($page);
		$this -> display();
	}
	
	/**
	 * 导出全部合作停的关键词
	 */
	function export_cooperate_stop_all(){
	
		$model 	= D( $this->modelName);
	
		$model -> export_cooperate_stop_all ( );
	}
	
	
	/**
	 * 获取今日新增的关键词关键词
	 */
	function new_keyword_today(){
	
		$model 	= D( $this->modelName);
	
		$list =$model -> get_new_keyword_today ( );
		
		$page['list'] = $list;
		$this -> assign($page);
		$this -> display();
	}
	
	/**
	 * 导出全部合作停的关键词
	 */
	function export_new_keyword_today(){
	
		$model 	= D( $this->modelName);
	
		$model -> export_new_keyword_today ( );
	}
	
	
	/**
	 * 获取全部的合作停的关键词
	 */
	function new_keyword_all(){
		// 关键词模型
		$model 		= D( $this->modelName);
	
		$list = $model -> get_cooperate_stop_all();
	
		$page['list'] = $list;
		$this -> assign($page);
		$this -> display();
	
	}
	
	
}