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
class QRKeywordEffectWidget extends Widget{

	//渲染方法
    public function render($data){
    	
    	$data['keywordstatusOptions']  	= C('KeywordStatusOptions');
    	$data['standardstatusOptions']  = C('KeywordStandardStatusOptions');
    	$data['SearchengineOptions']  	= C('SearchengineOptions');
    	$data['PerPageOptions']  		= C('PerPageOptions');
    	
  
    	$skin = $data['skin'];
    	if( $skin ){
    		$content = $this->renderFile('QRKeywordEffect_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('QRKeywordEffect',$data);
    	}
		
        return $content;  
    } 
}
?>