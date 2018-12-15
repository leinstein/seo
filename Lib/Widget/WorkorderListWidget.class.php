<?php

/**
 * 挂件：工单列表效果挂件
 * 用法：{:W('ObjList', array('objname'=>'Epidenty'))}
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Widget
 * @version     20170519
 * @link        http://www.qisobao.com
 */
class WorkorderListWidget extends Widget{

	//渲染方法
    public function render($data){
   	
    	// 实例化统计模型
    	$model = D('Biz/Statistics');
    	// 获取该用户下面的全部客户信息
    	$users =  $model -> getUsers( );
    	// 获取用户id
    	$userids 	= $users['userids'];
    	// 获取站点
    	$sites = $model -> getSites( $userids );
    	foreach ($sites as $vo_site ){
    		$site_options[$vo_site['id']] = $vo_site['website'];
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
    	$data['PerPageOptions']  			= C ('PerPageOptions');
    	
    	// 模板皮肤
    	$skin 		= $data['skin'];
    	 
    	if( $skin ){
    		$content = $this->renderFile('WorkorderList_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('WorkorderList',$data);
    	}
		
        return $content;  
    } 
}
?>