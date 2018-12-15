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
class QRReportListWidget extends Widget{

	//渲染方法
    public function render($data){
    	
    	
    	$data['PerPageOptions']  		= C ( 'PerPageOptions');
    	
    	$data['keywordstatusOptions']  = C('KeywordStatusOptions');
    	$data['PerPageOptions']  		= C('PerPageOptions');
    		
    		
    	// 获取我的全部计划
    	$plans = D('QR/QRPlan') -> getAllPlans();
    	foreach ( $plans as $vo ){
    		$PlanOptions[$vo['id']] = $vo['planname'];
    	}
    		
    	$data['PlanOptions']  = $PlanOptions;

 	
    	
    	$skin = $data['skin'];
    	if( $skin ){
    		$content = $this->renderFile('QRReportList_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('QRReportList',$data);
    	}
		
        return $content;  
    } 
}
?>