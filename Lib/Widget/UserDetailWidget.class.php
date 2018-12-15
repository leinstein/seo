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
class UserDetailWidget extends Widget{

	//渲染方法
    public function render($data){

        // 系统角色模型
        $model_role = D( 'User/User' );

        // 系统产品模型
        $model_product = D( 'Sys/Product' ); 

        $skin = $data['skin'];
          // 用户信息
        $user_info = $data['data'];


    	$data['UserStatusOptions']  	= C('UserStatusOptions');
    	
    	// 获取管理端用户的角色
    	$staff_options =  $model_role ->  getStaffCodeSet();
    	
    	$data['operation_codeSet'] 	= $staff_options['operation_codeSet'];
    	$data['sale_codeSet'] 		= $staff_options['sale_codeSet'];
    	$data['customer_codeSet'] 	= $staff_options['customer_codeSet'];
    	
    	$usergroup = !empty($_GET['usergroup']) ? $_GET['usergroup'] : $data['data']['usergroup'] ;
        // 如果是管理端新增，那么显示全部的产品
        if( GROUP_NAME =='Manage'){
            $products =  $model_product  -> getProducts() ;
            if( ACTION_NAME !='insertPage' ) {
            	// 获取用户的产品
            	$poducts_ids = $user_info['productids'];
            	foreach ($products as &$vo) {
            		if( in_array($vo['id'], $poducts_ids)){
            			$vo['checked'] = 1;
            		}
            	}
            }
        }else{
        	
        	// 否则获取当前操作用户的产品列表
        	$me = $data['me'];
        	 
        	// 获取用户的产品
        	$poducts_ids = $user_info['productids'];
        	// 获取用户的产品
        	$products 		= $me['products'];
        	foreach ($products as &$vo) {
        		if( in_array($vo['id'], $poducts_ids)){
        			$vo['checked'] = 1;
        		}
        			 
            }
            
        }
        $data['usergroup']      = $usergroup;
        $data['products']      = $products;
    	
    	if( $skin ){
    		$content = $this->renderFile('UserDetail_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('UserDetail',$data);
    	}
		
        return $content;  
    } 
}
?>


