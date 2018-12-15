<?php

/**
 * 挂件：日志列表效果挂件
 * 用法：{:W('ObjList', array('objname'=>'Epidenty'))}
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Widget
 * @version     20170519
 * @link        http://www.qisobao.com
 */
class RemarkListWidget extends Widget{

	//渲染方法
    public function render($data){
   	
    	// 实例化统计模型
    	$model = D('Biz/Statistics');
    	
    	// 登录用户信息
    	$me 		= $data['me'];
    	
    	// 获取该用户下面的全部客户信息
    	$user_stat =  $model -> getUsers( 2 );
    	
    	$users = $user_stat['users'];
    	$data['users'] = $users;
    	if( !$product_arr){
    		
    		$product_arr = $model -> getProducts( $user_stat['userids'] );
    	}
    	foreach ($product_arr as $vo_p ){
    		$products[$vo_p['id']] = $vo_p['product_name'];
    	}
    	$data['products'] = $products;
    	
    	$data['RemarkTypeOptions']  	= C('RemarkTypeOptions');
    	$data['PerPageOptions']  		= C ('PerPageOptions');
    	
    	// 模板皮肤
    	$skin 		= $data['skin'];
    	 
    	if( $skin ){
    		$content = $this->renderFile('RemarkList_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('RemarkList',$data);
    	}
		
        return $content;  
    } 
}
?>