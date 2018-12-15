<?php
return array(
	// 定义权限检查方式 LOGIN - 所有功能都必须要登录才能使用，PUBLIC - 所有功能都无须登录就可以使用, CHECK - 所有功能必须进行权限检查
	'PERMISSISON_MODE'			=> 'LOGIN',
	'LOGIN_URL'					=> 'Service/Index/login',
	'INDEX_URL'					=> 'Index/index',
	
	//'TMPL_ACTION_SUCCESS'	=> 'Public:success',
	//'TMPL_ACTION_ERROR'		=> 'Public:error',
	// update by Richer 于2017年8月24日11:50:38 将成功和失败的模板指定为公共目录
	//'TMPL_ACTION_SUCCESS'		=> APP_PATH.'Public/success.tpl',
	//'TMPL_ACTION_ERROR'			=> APP_PATH.'Public/error.tpl',
		
	'SESSION_PREFIX'	 	=> 'SERVICE_SESSION_',

);
?>