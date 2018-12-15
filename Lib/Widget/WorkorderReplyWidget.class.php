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
class WorkorderReplyWidget extends Widget{

	//渲染方法
	public function render($data){

		// 实例化统计模型
		$model = D('Biz/Statistics');
		 
		$skin = $data['skin'];
		
		 
		$file['maxsize'] = 10;
		$file['attachmenttype'] = 'workorder_reply_product_' . $_GET['productid'];
		//$file['attachmentname'] = '工单';
		//$file['isrequire'] = 1;// 是否必传
		$file['skin'] = 'simple';
		$file['tagname'] = 'workorder_reply';
		
		$data['upload_file'] = $file;
		// 获取登录用户的产品
		 
		// 获取全部的站点
		 
		if( $skin ){
			$content = $this->renderFile('WorkorderReply_'.$skin,$data);
		}else{
			$content = $this->renderFile('WorkorderReply',$data);
		}

		return $content;
	}
}
?>


