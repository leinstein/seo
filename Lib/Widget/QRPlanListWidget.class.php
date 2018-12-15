<?php

/**
 * 挂件：快排宝计划挂件
 * 用法：{:W('ObjList', array('objname'=>'Epidenty'))}
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Widget
 * @version     20170519
 * @link        http://www.qisobao.com
 */
class QRPlanListWidget extends Widget{

	//渲染方法
    public function render($data){
    	

    	$data['PlanStatusOptions']  	= C('PlanStatusOptions');
    	$data['PerPageOptions']  		= C ( 'PerPageOptions');
    	
    	$skin = $data['skin'];
    	if( $skin ){
    		$content = $this->renderFile('QRPlanList_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('QRPlanList',$data);
    	}
		
        return $content;  
    } 
}
?>