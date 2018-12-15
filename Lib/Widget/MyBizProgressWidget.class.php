<?php

/**
 * 挂件：我收到的消息提醒
 * 参数：暂无
 * 调用：{:w('MyNotifyPanel')}
 * 
 * @copyright		Copyright 2010-2015 上海启搜网络科技有限公司(www.qisobao.com)
 * @package		Widget
 * @version			20150719
 * @link				http://www.qisobao.com
 */
class MyBizProgressWidget extends Widget{

	//渲染方法
    public function render($data){
    	
    	//调用模型
    	$model_bizprogress = kernel_model( "Biz/BizProgress" );
    	$loginUserInfo = $model_bizprogress->getLoginUserInfo();
		
    	//查询结果
		if( $loginUserInfo["usertype"] == "ep" ){
			$data['MyBizProgress'] = $model_bizprogress -> getMy();
			
			//获取项目的名称并且进行字符串截取
			foreach($data['MyBizProgress']['data'] as &$vo){
				$vo['projname'] = $vo['projectname'];
			}
    	}else{
    		
	    	$data['MyBizProgress'] = $model_bizprogress -> getMy();
	    		
	    	//获取项目的名称并且进行字符串截取
	    	foreach($data['MyBizProgress']['data'] as &$vo){
	    		$vo['projname'] = $vo['projectname'];
	    	}
    	}
		
        return $this->renderFile('MyBizProgress',  $data);
    }
}
?>