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
class WorkorderDetailWidget extends Widget{

	//渲染方法
    public function render($data){

    	// 实例化统计模型
    	$model = D('Biz/Statistics');
    	
    	$skin = $data['skin'];
    	
    	// 获取该用户下面的全部客户信息
    	$users =  $model -> getUsers( );
    	// 获取用户id
    	$userids 	= $users['userids'];
    	// 获取站点
    	$sites = $model -> getSites( $userids );
        //如果是分运维登录只显示自己
        $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
        $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
        if($usertype == 'operation'){
            $sites = M('Site')->field('id,website,sitename')->where(array('site_manage'=>$username))->select();
        }
        $sites = array_sort($sites,'id','desc');
    	foreach ($sites as $vo_site ){
    		$site_options[$vo_site['id']] = '【' .$vo_site['sitename'] ."】". $vo_site['website'];
    	}
    	$data['sites'] = $site_options;
    	

    	// 登录用户信息
    	$me 		= $data['me'];
    	// 获取产品
    	$product_arr 	= $me['product_arr'];
    	if( !$product_arr){
    		$product_arr = $model -> getProducts( $userids );
    	}
    	foreach ($product_arr as $vo_p ){
    		$products[$vo_p['id']] = $vo_p['product_name'];
    	}
    	$data['products'] = $products;
    	 
    	$data['WorkorderStatusOptions']  	= C('WorkorderStatusOptions');
    		
   
    	// 组合上传附件的信息
    	$file = $data['data']['file_arra'];
    	if( !$file ){
    		$file['maxsize'] = 10;
    		$file['attachmenttype'] = 'workorder_product_' . $_GET['productid'];
    		//$file['attachmentname'] = '工单';
    		//$file['isrequire'] = 1;// 是否必传
    		$file['skin'] = 'simple';
    		$file['tagname'] = 'workorder';
    	}
    	
    	$data['file_arra'] = $file;
    	// 获取登录用户的产品
    	
    	// 获取全部的站点
    	
    	if( $skin ){
    		$content = $this->renderFile('WorkorderDetail_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('WorkorderDetail',$data);
    	}
		
        return $content;  
    } 
}
?>


