<?php
// 主配置文件
return array(
		//数据库配置
		'DB_TYPE'					=>	'mysql',			//数据库类型
		'DB_HOST'					=>	'localhost',	    //服务器地址
		'DB_NAME'					=>	'seo_mitong',	//数据库名
		'DB_USER'					=>	'root',				//用户名
		'DB_PWD'					=>	'root',			//密码
		'DB_PREFIX'					=>	'ts_',				//数据库表前缀
		'DB_CHARSET'				=>	'utf8',				//数据库编码

		'LOG_RECORD' 				=> true, // 开启日志记录
		'LOG_LEVEL'					=>'EMERG,ALERT,CRIT,ERR,WARN', // 只记录EMERG ALERT CRIT ERR 错误

		//缓存校验配置
		'DATA_CACHE_CHECK'      	=> true,

		//核心配置
		'SHOW_ERROR_MSG' 			=> true,
		'URL_MODEL'					=> 2 ,
		
		//主题配置
		'DEFAULT_THEME'				=> 'default',
		'TMPL_TEMPLATE_SUFFIX' 		=> '.tpl',

		//分组配置
		'APP_GROUP_LIST'			=>'Service,Manage,Home,Agent,Agent2',
		'DEFAULT_GROUP'				=>'Service',

		//多语言配置
		'LANG_SWITCH_ON' 			=> true,   //开启语言包
		'LANG_AUTO_DETECT'			=> false,  //是否自动检测语言

		//加载扩展配置文件
		'LOAD_EXT_CONFIG'           => array('expand'),

		// 定义权限检查方式 LOGIN - 所有功能都必须要登录才能使用
		'LOGIN_URL'					=> '/Index/login',

		//'TMPL_ACTION_SUCCESS'	=> 'Public:success',
		//'TMPL_ACTION_ERROR'		=> 'Public:error',
		// update by Richer 于2017年8月24日11:50:38 将成功和失败的模板指定为公共目录
		'TMPL_ACTION_SUCCESS'		=> APP_PATH.'Public/success.tpl',
		'TMPL_ACTION_ERROR'			=> APP_PATH.'Public/error.tpl',
		
		// 增加过滤器
		//'VAR_FILTERS'=>'trim',// 去除前后空格
        'SHOW_RUN_TIME'    => true, // 运行时间显示
        'SHOW_ADV_TIME'    => true, // 显示详细的运行时间
        'SHOW_DB_TIMES'    => true, // 显示数据库查询和写入次数

        //'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息
//        'TRACE_PAGE_TABS'=>array('base'=>'基本','file'=>'文件','think'=>'流程','error'=>'错误','sql'=>'SQL','debug'=>'调试','user'=>'用户')
        //'PAGE_TRACE_SAVE'=>true,
        //'PAGE_TRACE_SAVE'=>array('base','file','sql','error'=>'错误','sql'=>'SQL'),


);
?>