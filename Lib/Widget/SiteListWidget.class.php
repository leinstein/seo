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
class SiteListWidget extends Widget{

	//渲染方法
    public function render($data){
    	// 系统统计模型
    	$model_static = D('Biz/Statistics');
    	
    	$data['SiteStatusOptions']  	= C('SiteStatusOptions');
    	$data['PerPageOptions']  		= C ('PerPageOptions');
    	
    	// 获取系统的全部子用户
    	$UserOptions = $model_static -> getSubUsers();
    	$data['UserOptions']  = $UserOptions;

        //获取全部分运维
        $data['operation'] = D('Biz/Site')->getoperation();
    	

    	$skin = $data['skin'];
    	if( $skin ){
    		$content = $this->renderFile('SiteList_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('SiteList',$data);
    	}
		
        return $content;  
    } 
}
?>