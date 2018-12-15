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
class StaffListWidget extends Widget{

	//渲染方法
    public function render($data){
   
    	// 用户角色管理模型
    	$model_role = D( 'Sys/UserRole' );
    	// 用户部门管理模型
    	$model_depart = D( 'Sys/Departinfo' );
    	// 获取管理端用户的角色
    	// $userrole_options =  D( 'Sys/UserRole' ) ->  getManageRoleCodeset( $_GET['rolecode'] );

        // 
        // 获取用户的角色
        $userrole_options = $model_role ->  getRoleCodeset( $_GET['rolecode'] );
    	// 获取全部的上级用户
    	if( $_GET['rolelevel']  > 1   ){
    		$data['users']=  D( 'Sys/SysPermission' ) ->  getParentUsers( $_GET['rolecode'] );
    	}
    	
    	$data['userrole_options'] 	= $userrole_options;
    	
    	// 获取每个分组的部门
    	$departnoOptions =  $model_depart ->  getDepartCodeset(  );
    	$data['departnoOptions'] 	= $departnoOptions;
    	//if( $_GET['departno']){
    		$rolenoOptions = $model_role ->  getCodeSetByDepart( $_GET['departno'] ); 
    		$data['rolenoOptions'] 	= $rolenoOptions;
    	//}
    	
   		$data['userstatusOptions'] = C('userstatusOptions');
    	
    	$skin = $data['skin'];
    	if( $skin ){
    		$content = $this->renderFile('StaffList_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('StaffList',$data);
    	}
		
        return $content;  
    } 
}
?>