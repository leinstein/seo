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
class MyNewsPanelWidget extends Widget{

	//渲染方法
    public function render($data){
    	
    	// 如果该子用户的代理商已经开通了OEM权限
    	$me = $data['me'];
    	if( $me['oem_config']['id']){
    		$data['list'] = D('Biz/News') -> getListByAgentuser( $me['pid'], 10);
    	}else{
    		$data['list'] = D('Biz/News') -> getListByOperationuser( 10);
    	}
    	
    	$skin = $data['skin'];
    	if( $skin ){
    		$content = $this->renderFile('MyNewsPanel_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('MyNewsPanel',$data);
    	}
        return $content;
    }
}
?>