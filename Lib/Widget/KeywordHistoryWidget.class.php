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
class KeywordHistoryWidget extends Widget{

	//渲染方法
    public function render($data){
    
    	$skin = $data['skin'];
    	if( $skin ){
    		$content = $this->renderFile('KeywordHistory_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('KeywordHistory',$data);
    	}
		
        return $content;  
    } 
}
?>