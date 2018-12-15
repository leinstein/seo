<?php
return array(
	// 定义权限检查方式 LOGIN - 所有功能都必须要登录才能使用，PUBLIC - 所有功能都无须登录就可以使用, CHECK - 所有功能必须进行权限检查
	'PERMISSISON_MODE'			=> 'LOGIN',
	'LOGIN_URL'					=> 'Service/Index/login',
	'INDEX_URL'					=> 'Index/index',
	
	//'TMPL_ACTION_SUCCESS'		=> 'Public:success',
	//'TMPL_ACTION_ERROR'			=> 'Public:error',
		
	'SESSION_PREFIX'	 		=> 'AGENT2_SESSION_',
		 
	// 当前分组对应的用户模型
	'USER_MODEL'           		=> 'User/AgentUser',
	
);
?>