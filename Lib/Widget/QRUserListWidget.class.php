<?php

/**
 * 挂件：海排用户效果挂件
 * 用法：{:W('ObjList', array('objname'=>'Epidenty'))}
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Widget
 * @version     20170519
 * @link        http://www.qisobao.com
 */
class QRUserListWidget extends Widget{

	//渲染方法
    public function render($data){
    	$data['UserStatusOptions']  	= C('UserStatusOptions');
    	$data['PerPageOptions']  		= C ('PerPageOptions');
    	$skin = $data['skin'];
    	
    	switch ( $skin ) {
    		case 'sub':
    			// 获取所有的代理商
    			$users = D('User/User') -> getAgentUser( );
    			foreach ($users as $vo ){
    				$AgentUserOptions[$vo['id']] = $vo['username'];
    			}
    			$data['AgentUserOptions'] = $AgentUserOptions;
    			
    			$data['userids_less'] = $_SESSION['userids_less'];
    		break;
    		
    		default:
    			;
    		break;
    	}
    	
    	// 当前登录用户的信息
    	$me = $data['me'];
    	switch ( $me['usertype'] ) {
    		case 'customer_manager':// 客服经理
    		case 'customer':// 客服
    			// 客服用户可以登录子用户
    			$data['can_login_subuser'] = 1;
    			break;
    		case 'agent':// 代理商用户
    		case 'agent2':// 代理商用户
    			$data['can_login_subuser'] = 1;
    			$data['can_edit_subuser'] = 1;
    			$data['can_login_subagent'] = 1;
    			break;
    		default:
    			;
    			break;
    	}
    	
    	if( $skin ){
    		$content = $this->renderFile('QRUserList_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('QRUserList',$data);
    	}
		
        return $content;  
    } 
}
?>