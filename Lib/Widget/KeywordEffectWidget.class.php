<?php

/**
 * 挂件：关键词效果挂件
 * 用法：{:W('ObjList', array('objname'=>'Epidenty'))}
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Widget
 * @version     20170519
 * @link        http://www.qisobao.com
 */
class KeywordEffectWidget extends Widget{

	//渲染方法
    public function render($data){
    	
    	$data['keywordstatusOptions']  	= C('KeywordStatusOptions');
    	$data['standardstatusOptions']  = C('KeywordStandardStatusOptions');
    	$data['SearchengineOptions']  	= C('SearchengineOptions');
    	$data['PerPageOptions']  		= C ( 'PerPageOptions');
    	
    	// 默认查询优化中的关键词
		 if( !$_GET['keywordstatus']){
		 	$_GET['keywordstatus']  = '优化中';
		 }
    	$skin = $data['skin'];
    	if( $skin ){
    		$content = $this->renderFile('KeywordEffect_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('KeywordEffect',$data);
    	}
		
        return $content;  
    } 
}
?>