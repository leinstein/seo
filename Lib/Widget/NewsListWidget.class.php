<?php

/**
 * 挂件：文章列表效果挂件
 * 用法：{:W('ObjList', array('objname'=>'Epidenty'))}
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Widget
 * @version     20170519
 * @link        http://www.qisobao.com
 */
class NewsListWidget extends Widget{

	//渲染方法
    public function render($data){
    	$skin = $data['skin'];
    	if( $skin ){
    		$content = $this->renderFile('NewsList_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('NewsList',$data);
    	}
		
        return $content;  
    } 
}
?>