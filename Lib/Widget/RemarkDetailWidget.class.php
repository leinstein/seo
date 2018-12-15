<?php

/**
 * 挂件：工单详情效果挂件
 * 用法：{:W('ObjList', array('objname'=>'Epidenty'))}
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Widget
 * @version     20170519
 * @link        http://www.qisobao.com
 */
class RemarkDetailWidget extends Widget{

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
    	$data['RemarkModeOptions']  	= C('RemarkModeOptions');
    		
   
    	// 组合上传附件的信息
    	$file = $data['data']['file_arra'];
    	if( !$file ){
    		$file['maxsize'] = 10;
    		$file['attachmenttype'] = 'remark_product_' . $_GET['productid'];
    		$file['skin'] = 'simple';
    		$file['tagname'] = 'remark';
    	}
    	
    	$data['file_arra'] = $file;
    	// 获取登录用户的产品
    	
    	// 获取全部的站点
    	
    	if( $skin ){
    		$content = $this->renderFile('RemarkDetail_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('RemarkDetail',$data);
    	}
		
        return $content;  
    } 
}
?>


