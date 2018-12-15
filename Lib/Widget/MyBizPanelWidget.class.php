<?php

/**
 * 挂件：我的业务挂件
 * 参数：Mode - 显示模式，分为bigicon -大图标模式； listdetail - 详细信息模式
 *            RootUrl - 根目录
 * 调用：{:w('MyBizPanel', array('RootUrl'=>'../', 'Mode'=>'bigicon'))}
 * 
 * @copyright		Copyright 2010-2015 上海启搜网络科技有限公司(www.qisobao.com)
 * @package		Widget
 * @version			20150719
 * @link				http://www.qisobao.com
 */
class MyBizPanelWidget extends Widget{

	//渲染方法
    public function render($data){
    	
    	$skin = $data['skin'];
    	$me = $data['me'];
    	switch ( $me['usergroup'] ) {
    		case 'Manage':
    			$data['is_show_user'] = 1;
    			$data['is_show_finance'] = 1;
    		case 'Agent':
    			//$data['is_show_system'] = 1;
            $data['is_show_user'] = 1;
                $data['is_show_finance'] = 1;
    			break;
    		
    		default:
    			;
    		break;
    	}
    	
    	
    	if( $skin ){
    		$content = $this->renderFile('MyBizPanel_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('MyBizPanel',$data);
    	}
    	return $content;
    }
}
?>