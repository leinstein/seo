<?php

/**
 * 挂件：我收到的消息提醒
 * 参数： 
 * 	RootUrl  根路径； 
 * ShowType 显示方式，默认为unread 有多少未读消息就显示多少，并且点击就关闭，也可以设置为 showall 即显示所有消息，但是未读消息会有粗体标示；
 * 调用：{:w('MyNotifyPanel')}
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Widget
 * @version     20170519
 * @link        http://www.qisobao.com
 */
class MyNotifyPanelWidget extends Widget{

	//渲染方法
    public function render($data){
    	
    	$skin = $data['skin'];
    	if( $skin == 'manage'){
    		// 如果是管理端的消息提醒
   
    		
    	}else{
    		//调用模型
    		$model_notify = D( "Notify/Notify" );
    		if( empty( $data['ShowType'] ) || $data['ShowType'] == "unread" ){
    			$map['isread'] = 0;
    		}
    		//$data['MyNotify'] = $model_notify -> get($map, D( "User/User") ->getLoginUserId(), 5);
    		 
    		// 显示底部通知
    		if( $data['is_show_layer_tips_right'] == 1 ){
    			// 获取未处理的工单
    		}
    		$data['MyNotify'] = $model_notify -> get($map, D( "User/User") ->getLoginUserId(), 4);
    	}
    	
    	
    	
    	if( $skin ){
    		$content = $this->renderFile('MyNotifyPanel_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('MyNotifyPanel',$data);
    	}
        return $content;
    }
}
?>