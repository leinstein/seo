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
class KeywordListWidget extends Widget{

	//渲染方法
    public function render($data){
    	
    	$KeywordStatusOptions =  C('KeywordStatusOptions');
    	if( $data['operate'] == 'unfreeze'){
    		unset($KeywordStatusOptions['待审核']);
    		unset($KeywordStatusOptions['合作停']);
    		$KeywordStatusOptions1 =  C('KeywordStatusOptions');
    		unset($KeywordStatusOptions1['优化中']);
    		unset($KeywordStatusOptions1['被拒绝']);
    		//unset($KeywordStatusOptions1['合作停']);
    		$data['keywordstatusOptions1']  	= $KeywordStatusOptions1;
    	}else{
    		$data['keywordstatusOptions1']  	= $KeywordStatusOptions;
    	}
    	$data['keywordstatusOptions']  	= $KeywordStatusOptions;
    	$data['standardstatusOptions']  = C('KeywordStandardStatusOptions');
    	$data['SearchengineOptions']  	= C('SearchengineOptions');
    	$data['PerPageOptions']  		= C ( 'PerPageOptions');

 	
    	
    	$skin = $data['skin'];
    	if( $skin ){
    		$content = $this->renderFile('KeywordList_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('KeywordList',$data);
    	}
		
        return $content;  
    } 
}
?>