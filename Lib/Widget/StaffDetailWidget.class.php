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
class StaffDetailWidget extends Widget{

	//渲染方法
    public function render($data){
   
    	// 获取管理端用户的角色
    	// $userrole_options =  D( 'Sys/UserRole' ) ->  getManageRoleCodeset( $_GET['rolecode'] );

        // 
        // 获取用户的角色
        $userrole_options =  D( 'Sys/UserRole' ) ->  getRoleCodeset( $_GET['rolecode'] );
    	// 获取全部的上级用户
    	if( $_GET['rolelevel']  > 1   ){
    		$data['users']=  D( 'Sys/SysPermission' ) ->  getParentUsers( $_GET['rolecode'] );
    	}
    	
    	$data['userrole_options'] 	= $userrole_options;
    	
   
    	$skin = $data['skin'];
    	if( $skin ){
    		$content = $this->renderFile('StaffDetail_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('StaffDetail',$data);
    	}
		
        return $content;  
    } 
}
?>