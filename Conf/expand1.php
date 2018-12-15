<?php
// 扩展配置文件
return array(
	//配置项 'key' => 'value'
	
		//环境 0:dev开发环境 1:innertest内部测试环境 2:pubtest外部测试环境 3:show演示版本 4:pub生产环境
		'APP_ENVIRONMENT' => 0,
		
		//环境名称
		'ENV_NAME' => array(
				"开发版",
				"内部测试版",
				"外部测试版",
				"演示版本",
				"正式版",
		),
		'ENV_ID' => array(
				"dev",
				"innertest",
				"beta",
				"show",
				"pub",
		),
		
		// 关键词检测接口接口参数配置
		'KEYWORD_DETECT_CONFIG' => array(
				array(
						'ADD_TASK_URL'  	=> 'https://api.zzmofang.com/v1/coop/add_rank_task',
						'DELETE_TASK_URL1' 	=> 'https://api.zzmofang.com/v1/coop/delete_tasks ',
						'DELETE_TASK_URL2'  => 'https://api.zzmofang.com/v1/coop/delete_task_by_id',
						'APP_ID'       		=> '10000001', //测试APP_ID:10000001,
						'APP_KEY'      		=> 'dd4b21e9ef71e1291183a46b913ae6f2',//测试APP_KEY:dd4b21e9ef71e1291183a46b913ae6f2
				),
				array(
						'ADD_TASK_URL'  	=> 'https://api.zzmofang.com/v1/coop/add_rank_task',
						'DELETE_TASK_URL1' 	=> 'https://api.zzmofang.com/v1/coop/delete_tasks ',
						'DELETE_TASK_URL2'  => 'https://api.zzmofang.com/v1/coop/delete_task_by_id',
						'APP_ID'       		=> '10000001', //测试APP_ID:10000001,
						'APP_KEY'      		=> 'dd4b21e9ef71e1291183a46b913ae6f2',//测试APP_KEY:dd4b21e9ef71e1291183a46b913ae6f2
				),
				array(
						'ADD_TASK_URL'  	=> 'https://api.zzmofang.com/v1/coop/add_rank_task',
						'DELETE_TASK_URL1' 	=> 'https://api.zzmofang.com/v1/coop/delete_tasks ',
						'DELETE_TASK_URL2'  => 'https://api.zzmofang.com/v1/coop/delete_task_by_id',
						'APP_ID'       		=> '10000001', //测试APP_ID:10000001,
						'APP_KEY'      		=> 'dd4b21e9ef71e1291183a46b913ae6f2',//测试APP_KEY:dd4b21e9ef71e1291183a46b913ae6f2
				),
				array(
						'ADD_TASK_URL'  	=> 'https://api.zzmofang.com/v1/coop/add_rank_task',
						'DELETE_TASK_URL1' 	=> 'https://api.zzmofang.com/v1/coop/delete_tasks ',
						'DELETE_TASK_URL2'  => 'https://api.zzmofang.com/v1/coop/delete_task_by_id',
						'APP_ID'       		=> '10000001', //测试APP_ID:10000001,
						'APP_KEY'      		=> 'dd4b21e9ef71e1291183a46b913ae6f2',//测试APP_KEY:dd4b21e9ef71e1291183a46b913ae6f2
				),
				
				array(
						'ADD_TASK_URL'  	=> 'https://api.zzmofang.com/v1/coop/add_rank_task',
						'DELETE_TASK_URL1' 	=> 'https://api.zzmofang.com/v1/coop/delete_tasks ',
						'DELETE_TASK_URL2'  => 'https://api.zzmofang.com/v1/coop/delete_task_by_id',
						'APP_ID'       		=> '11880585', //测试APP_ID:10000001,
						'APP_KEY'      		=> '5c8ad0e1457995aef9add9698e8a09e0',//测试APP_KEY:dd4b21e9ef71e1291183a46b913ae6f2
				),
		),
	
		//host配置
		'HostOptions' 	=> array(
				'member.qisobao.com',
				'member.qisobao.com:8888',
		),
		
		//SESSION过期相关参数设置
		'SESSION_Options' 	=> array(
			'expired_para'	=> 'last_access',//上次访问系统标识
			'expired_time'	=> '1800',//过期时间5分钟
				
		),
		
		//微信授权回调接口参数配置
		'WX_AUTH_CALLBACK_CONFIG' => array(
				'token'          => 'Richer',
				'appid'          => 'wx28bd180a7708b16c',//appid在部署到生产环境的时候，需要修改
				'appsecret'      => '9bc4ce7029df468de88a6b30b7eb4827',//appid对应的appsecret
				//'template_id'	=> 'ccc8U_emnaRIL4ZruSeWBWWdNOoGe20qNtUcmOB-uz4';
				'encodingaeskey' => '',
		),
		
		// 关键词检测接口接口参数配置
// 		'KEYWORD_DETECT_CONFIG' => array(
// 				'ADD_TASK_URL'  	=> 'https://api.zzmofang.com/v1/coop/add_rank_task',
// 				'DELETE_TASK_URL1' 	=> 'https://api.zzmofang.com/v1/coop/delete_tasks ',
// 				'DELETE_TASK_URL2'  => 'https://api.zzmofang.com/v1/coop/delete_task_by_id',
// 				'APP_ID'       		=> '11880585', //测试APP_ID:10000001,
// 				'APP_KEY'      		=> '5c8ad0e1457995aef9add9698e8a09e0',//测试APP_KEY:dd4b21e9ef71e1291183a46b913ae6f2
				
// 		),
		
		// 系统产品类型
		'ProductTypeOptions' => array(
				'OptimizeWebsite' 		=> '优站宝',
		),
		// 用户类型
		'UserTypeOptions' 	=> array(
				'sub' 		=> '子用户',
				'server' 	=> '服务端用户',
				'agent' 	=> '代理商用户',
				'admin' 	=> '管理端用户',
				'operation' => '运维用户',
				'sale'		=> '销售用户',
		),
		
		// 用户类型
		'UserStatusOptions' => array(
				'正常' 		=> '正常',
				'注销' 		=> '注销',
		),
		
		// 站点状态代码集 网站状态：待审核、优化中、合作停
		'SiteStatusOptions' => array(
				'待审核' 		=> '待审核',
				'优化中' 		=> '优化中',
				'合作停' 		=> '合作停',
				'被拒绝' 		=> '被拒绝',
		),
		
		// 站点状态代码集 网站状态：待审核、优化中、合作停
		'SiteStatusOptions' => array(
				'待审核' 		=> '待审核',
				'优化中' 		=> '优化中',
				'合作停' 		=> '合作停',
				'被拒绝' 		=> '被拒绝',
		),
		
		// 计划状态代码集 网站状态：待审核、优化中、合作停、被拒绝
		'PlanStatusOptions' => array(
				'待审核' 		=> '待审核',
				'优化中' 		=> '优化中',
				'合作停' 		=> '合作停',
				'被拒绝' 		=> '被拒绝',
		),
		
		// 关键词状态代码集 关键词状态：待审核‘优化中‘合作停、被拒绝’’’
		'KeywordStatusOptions' => array(
				'待审核' 		=> '待审核',
				'优化中' 		=> '优化中',
				'合作停' 		=> '合作停',
				'被拒绝' 		=> '被拒绝',
		),
		
		// 关键词达标状态代码集 关键词状态：已达标、未达标’
		'KeywordStandardStatusOptions' => array(
				'已达标' => '已达标',
				'未达标' => '未达标',
		),
		
		
		// 关键词长度价格指数代码集
		'KeywordLengthPriceIndexOptions' => array(
					
				'baidu' => array(
						array('vmin'=>1,'vmax'=> 4,'quotavalue' => 20),
						array('vmin'=>5 ,'vmax'=> 5,'quotavalue' => 19),
						array('vmin'=>6 ,'vmax'=> 6,'quotavalue' => 18),
						array('vmin'=>7 ,'vmax'=> 7,'quotavalue' => 16),
						array('vmin'=>8 ,'vmax'=> 8,'quotavalue' => 16),
						array('vmin'=>9 ,'vmax'=> 9,'quotavalue' => 15),
						array('vmin'=>10,'vmax'=> 10,'quotavalue' => 15),
						array('vmin'=>11,'vmax'=> 11,'quotavalue' => 12),
						array('vmin'=>12,'vmax'=> 12,'quotavalue' => 12),
						array('vmin'=>13,'vmax'=> 13,'quotavalue' => 10),
						array('vmin'=>14,'vmax'=> 14,'quotavalue' => 10),
						array('vmin'=>15,'vmax'=> 15,'quotavalue' => 9),
						array('vmin'=>16,'vmax'=> 16,'quotavalue' => 9),
						array('vmin'=>17,'vmax'=> 999999999,'quotavalue' => 8),
				),
					
				'baidu_mobile' => array(
						array('vmin'=>1,'vmax'=> 4,'quotavalue' => 25),
						array('vmin'=>5 ,'vmax'=> 5,'quotavalue' => 23),
						array('vmin'=>6 ,'vmax'=> 6,'quotavalue' => 22),
						array('vmin'=>7 ,'vmax'=> 7,'quotavalue' => 20),
						array('vmin'=>8 ,'vmax'=> 8,'quotavalue' => 20),
						array('vmin'=>9 ,'vmax'=> 9,'quotavalue' => 18),
						array('vmin'=>10,'vmax'=> 10,'quotavalue' => 18),
						array('vmin'=>11,'vmax'=> 11,'quotavalue' => 15),
						array('vmin'=>12,'vmax'=> 12,'quotavalue' => 15),
						array('vmin'=>13,'vmax'=> 13,'quotavalue' => 12),
						array('vmin'=>14,'vmax'=> 14,'quotavalue' => 12),
						array('vmin'=>15,'vmax'=> 15,'quotavalue' => 10),
						array('vmin'=>16,'vmax'=> 16,'quotavalue' => 10),
						array('vmin'=>17,'vmax'=> 999999999,'quotavalue' => 9),
				),
				'sougou' => array(
						array('vmin'=>1,'vmax'=> 4,'quotavalue' => 8),
						array('vmin'=>5 ,'vmax'=> 5,'quotavalue' => 7),
						array('vmin'=>6 ,'vmax'=> 6,'quotavalue' => 7),
						array('vmin'=>7 ,'vmax'=> 7,'quotavalue' => 6),
						array('vmin'=>8 ,'vmax'=> 8,'quotavalue' => 6),
						array('vmin'=>9 ,'vmax'=> 9,'quotavalue' => 5),
						array('vmin'=>10,'vmax'=> 10,'quotavalue' => 5),
						array('vmin'=>11,'vmax'=> 11,'quotavalue' => 4),
						array('vmin'=>12,'vmax'=> 12,'quotavalue' => 4),
						array('vmin'=>13,'vmax'=> 13,'quotavalue' => 3),
						array('vmin'=>14,'vmax'=> 14,'quotavalue' => 3),
						array('vmin'=>15,'vmax'=> 15,'quotavalue' => 2),
						array('vmin'=>16,'vmax'=> 16,'quotavalue' => 2),
						array('vmin'=>17,'vmax'=> 999999999,'quotavalue' => 2),
				),
		
				'360' => array(
						array('vmin'=>1 ,'vmax'=> 4,'quotavalue' => 9),
						array('vmin'=>5 ,'vmax'=> 5,'quotavalue' => 8),
						array('vmin'=>6 ,'vmax'=> 6,'quotavalue' => 8),
						array('vmin'=>7 ,'vmax'=> 7,'quotavalue' => 7),
						array('vmin'=>8 ,'vmax'=> 8,'quotavalue' => 7),
						array('vmin'=>9 ,'vmax'=> 9,'quotavalue' => 6),
						array('vmin'=>10,'vmax'=> 10,'quotavalue' => 6),
						array('vmin'=>11,'vmax'=> 11,'quotavalue' => 5),
						array('vmin'=>12,'vmax'=> 12,'quotavalue' => 5),
						array('vmin'=>13,'vmax'=> 13,'quotavalue' => 4),
						array('vmin'=>14,'vmax'=> 14,'quotavalue' => 4),
						array('vmin'=>15,'vmax'=> 15,'quotavalue' => 3),
						array('vmin'=>16,'vmax'=> 16,'quotavalue' => 3),
						array('vmin'=>17,'vmax'=> 999999999,'quotavalue' => 3),
				),
				'shenma' => array(
						array('vmin'=>1 ,'vmax'=> 4,'quotavalue' => 6),
						array('vmin'=>5 ,'vmax'=> 5,'quotavalue' => 6),
						array('vmin'=>6 ,'vmax'=> 6,'quotavalue' => 6),
						array('vmin'=>7 ,'vmax'=> 7,'quotavalue' => 5),
						array('vmin'=>8 ,'vmax'=> 8,'quotavalue' => 5),
						array('vmin'=>9 ,'vmax'=> 9,'quotavalue' => 4),
						array('vmin'=>10,'vmax'=> 10,'quotavalue' => 4),
						array('vmin'=>11,'vmax'=> 11,'quotavalue' => 3),
						array('vmin'=>12,'vmax'=> 12,'quotavalue' => 3),
						array('vmin'=>13,'vmax'=> 13,'quotavalue' => 2),
						array('vmin'=>14,'vmax'=> 14,'quotavalue' => 2),
						array('vmin'=>15,'vmax'=> 15,'quotavalue' => 2),
						array('vmin'=>16,'vmax'=> 16,'quotavalue' => 2),
						array('vmin'=>17,'vmax'=> 999999999,'quotavalue' => 2),
				),
		),
		
		// 百度指数价格指数代码集
		'BaiduIndexPriceIndexOptions'=>array(
				'baidu' => array(
						array('quotavalue'=>5,'vmin'=>1,'vmax'=>100,'choose'=>0),
						array('quotavalue'=>8,'vmin'=>101,'vmax'=>500,'choose'=>0),
						array('quotavalue'=>12,'vmin'=>501,'vmax'=>1000,'choose'=>0),
						array('quotavalue'=>15,'vmin'=>1001,'vmax'=> 1500,'choose'=>0),
						array('quotavalue'=>18,'vmin'=>1501,'vmax'=> 999999999,'choose'=>0),
				),
					
				'baidu_mobile' => array(
						array('quotavalue'=>5,'vmin'=>1,'vmax'=>100,'choose'=>0),
						array('quotavalue'=>8,'vmin'=>101,'vmax'=>500,'choose'=>0),
						array('quotavalue'=>12,'vmin'=>501,'vmax'=>1000,'choose'=>0),
						array('quotavalue'=>15,'vmin'=>1001,'vmax'=> 1500,'choose'=>0),
						array('quotavalue'=>18,'vmin'=>1501,'vmax'=> 999999999,'choose'=>0),
				),
				'sougou' => array(
						array('quotavalue'=>2,'vmin'=>1,'vmax'=>100,'choose'=>0),
						array('quotavalue'=>3,'vmin'=>101,'vmax'=>500,'choose'=>0),
						array('quotavalue'=>4,'vmin'=>501,'vmax'=>1000,'choose'=>0),
						array('quotavalue'=>5,'vmin'=>1001,'vmax'=> 1500,'choose'=>0),
						array('quotavalue'=>6,'vmin'=>1501,'vmax'=> 999999999,'choose'=>0),
				),
				
				'360' => array(
						array('quotavalue'=>2,'vmin'=>1,'vmax'=>100,'choose'=>0),
						array('quotavalue'=>3,'vmin'=>101,'vmax'=>500,'choose'=>0),
						array('quotavalue'=>4,'vmin'=>501,'vmax'=>1000,'choose'=>0),
						array('quotavalue'=>5,'vmin'=>1001,'vmax'=> 1500,'choose'=>0),
						array('quotavalue'=>6,'vmin'=>1501,'vmax'=> 999999999,'choose'=>0),
				),
				'shenma' => array(
						array('quotavalue'=>2,'vmin'=>1,'vmax'=>100,'choose'=>0),
						array('quotavalue'=>2,'vmin'=>101,'vmax'=>500,'choose'=>0),
						array('quotavalue'=>3,'vmin'=>501,'vmax'=>1000,'choose'=>0),
						array('quotavalue'=>4,'vmin'=>1001,'vmax'=> 1500,'choose'=>0),
						array('quotavalue'=>5,'vmin'=>1501,'vmax'=> 999999999,'choose'=>0),
				),
				
				
		),
		
		// 关键词长度难度指数代码集
		'KeywordDifficultyIndexOptions' => array(
				array('quotavalue'=>5,'vmin'=>1,'vmax'=>4,'choose'=>0),
				array('quotavalue'=>4,'vmin'=>5,'vmax'=>8,'choose'=>0),
				array('quotavalue'=>3,'vmin'=>9,'vmax'=>13,'choose'=>0),
				array('quotavalue'=>2,'vmin'=>14,'vmax'=> 999999999,'choose'=>0),
		),
		
		// 关键词长度优化周期代码集
		'KeywordOptimizationCycleOptions' => array(
				array('quotavalue'=>'3-6/月','vmin'=>1,'vmax'=>4,'choose'=>0),
				array('quotavalue'=>'2-5/月','vmin'=>5,'vmax'=>8,'choose'=>0),
				array('quotavalue'=>'7-90/天','vmin'=>9,'vmax'=>13,'choose'=>0),
				array('quotavalue'=>'3-60/天','vmin'=>14,'vmax'=> 999999999,'choose'=>0),
		),
		
		
		// 关键词百度指数难度指数代码集
		'KeywordDifficultyIndex4BaiduIndexOptions'=>array(
				array('quotavalue'=>4,'vmin'=>1,'vmax'=>499,'choose'=>0),
				array('quotavalue'=>5,'vmin'=>500,'vmax'=> 999999999,'choose'=>0),
		),
		// 关键词百度指数化周期代码集
		'KeywordOptimizationCycle4BaiduIndexOptions'=>array(
				array('quotavalue'=>'2-5/月','vmin'=>1,'vmax'=>499,'choose'=>0),
				array('quotavalue'=>'3-6/月','vmin'=>500,'vmax'=> 999999999,'choose'=>0),
		),
		
		
		// 长尾词挖掘代码集
		'KeywordDigOptions' => array(
				'url' => 'http://www.5118.com/seo/words/',
		
		),
		
		// 关键词排名解耦
		'KeywordRankOptions' => array(
				'url' => 'https://api.zzmofang.com/v1/coop/recieve_words',
				
		),

		'SearchengineOptions' 	=> array(
				'baidu' 		=> '百度pc',
				'baidu_mobile' 	=> '百度手机',
				'sougou' 		=> '搜狗',
				'360' 			=> '360',
				'shenma' 		=> '神马',
		),
		/**
		 * 搜索引擎地址
		 */
		'SearchengineSiteOptions' 	=> array(
				'baidu' 		=> 'http://www.baidu.com/#ie=UTF-8&amp;wd={keyword}',
				'baidu_mobile' 	=> 'https://m.baidu.com/ssid=fd5379616e677a696c676c8223/from=1012971h/s?&ie=utf-8&word={keyword}',
				'sougou' 		=> 'https://www.sogou.com/web?ie=utf8&query={keyword}',
				'360' 			=> 'https://www.so.com/s?ie=utf-8&q={keyword}',
				'shenma' 		=> 'http://www.baidu.com/#ie=UTF-8&amp;wd={keyword}',// 暂时用百度的
		),
		
		// 客户站点管理后台状态
		'ManageBackgroundStatusOptions' => array(
				'有效' => '有效',
				'无效' => '无效',
		),
	
		// 每页显示条数
		'PerPageOptions' => array(
				/* '20' => '20', */
				'50' => '每页显示50条',
				'100' => '每页显示100条',
				'200' => '每页显示200条',
				'500' => '每页显示500条',
				'1000' => '每页显示1000条',
		),
		
		// 运行模式
		'RUN_MODE' => 1, // 本地测试环境
		
		// 工单状态：未处理、操作中、已完成’
		'WorkorderStatusOptions' => array(
				'未处理' 		=> '未处理',
				'操作中' 		=> '操作中',
				'已完成' 		=> '已完成',
		),
		
		// 日志类型：
		'RemarkTypeOptions' => array(
				'FTP沟通' 		=> 'FTP沟通',
				'续费沟通' 		=> '续费沟通',
				'关键词解冻' 		=> '关键词解冻',
				'换词沟通' 		=> '换词沟通',
				'加词沟通' 		=> '加词沟通',
				'日常维护' 		=> '日常维护',
				'退款沟通' 		=> '退款沟通',
				'建站宝推荐' 		=> '建站宝推荐',
				'开户通知' 		=> '开户通知',
				'工单跟进' 		=> '工单跟进',
				'关键词排名不准' 	=> '关键词排名不准',
		),
		
		// 沟通方式：QQ、电话、邮箱’
		'RemarkModeOptions' => array(
				'QQ' 		=> 'QQ',
				'电话' 		=> '电话',
				'邮箱' 		=> '邮箱',
		),
		
		// 用户状态：正常'注销’
		'userstatusOptions' => array(
				'正常' 		=> '正常',
				'注销' 		=> '注销',
		),
		
		
);
?>