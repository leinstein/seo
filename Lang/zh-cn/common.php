<?php
//语言文件包
return array(
	//login
	'username'				=> '用户名',
	'password'				=> '密码',
	'validate_code'			=> '验证码',
	'user_must_login'		=> '请先登录，正在为您跳转...',
	'access_deny'			=> '对不起，您没有访问此页面的权限！',
	'login_success'			=> '登录成功',
	'logout_success'		=> '退出成功，正在跳转至登录页面...',
		
	'save_success' 	=> "保存成功！",
	/*未登录时提示*/
	'must_login' 	=> "对不起，访问此页面需要登录，系统正在为您跳转，请稍候...",
	/*没有功能使用权限的提示*/
	'access_deny' 	=> "对不起，您不具备此页面功能的访问权限.",
     
	/*资金预算信息*/
	'FundsBudgetOptions' => array(
			
			'2011' => array(
					array('nodelink' => '','nodename'=>'总计','budget' => ''),
					array('nodelink'=>'10','nodename'=>'科技项目启动经费','budget' => '','map'=>array(array('LIKE','10%'),array('NOTLIKE','101101%'),'AND')),
					array('nodelink'=>'101101','nodename'=>'重大招商项目启动经费','budget' => ''),
					array('nodelink'=>'1115','nodename'=>'房租补贴','budget' => ''),
					array('nodelink'=>'1120','nodename'=>'上级项目配套','budget' => ''),
					array('nodelink'=>'11','nodename'=>'科技政策兑现','budget' => '','map'=>array(array('LIKE','11%'),array('NOTLIKE','1115%'),array('NOTLIKE','1120%'),'AND'),),
					array('nodelink'=>'12','nodename'=>'知识产权奖励','budget' => ''),
					array('nodelink'=>'13','nodename'=>'公共平台建设及运转补贴','budget' => ''),
					array('nodelink'=>'-1','nodename'=>'其它','budget' => ''), 
			),
			'2012' => array(
					array('nodelink' => '','nodename'=>'总计','budget' => ''),
					array('nodelink'=>'10','nodename'=>'科技项目启动经费','budget' => '','map'=>array(array('LIKE','10%'),array('NOTLIKE','101101%'),'AND')),
					array('nodelink'=>'101101','nodename'=>'重大招商项目启动经费','budget' => ''),
					array('nodelink'=>'1115','nodename'=>'房租补贴','budget' => ''),
					array('nodelink'=>'1120','nodename'=>'上级项目配套','budget' => ''),
					array('nodelink'=>'11','nodename'=>'科技政策兑现','budget' => '','map'=>array(array('LIKE','11%'),array('NOTLIKE','1115%'),array('NOTLIKE','1120%'),'AND'),),
					array('nodelink'=>'12','nodename'=>'知识产权奖励','budget' => ''),
					array('nodelink'=>'13','nodename'=>'公共平台建设及运转补贴','budget' => ''),
					array('nodelink'=>'-1','nodename'=>'其它','budget' => ''), 
			),
			'2013' => array(
					array('nodelink' => '','nodename'=>'总计','budget' => ''),
					array('nodelink'=>'10','nodename'=>'科技项目启动经费','budget' => '','map'=>array(array('LIKE','10%'),array('NOTLIKE','101101%'),'AND')),
					array('nodelink'=>'101101','nodename'=>'重大招商项目启动经费','budget' => ''),
					array('nodelink'=>'1115','nodename'=>'房租补贴','budget' => ''),
					array('nodelink'=>'1120','nodename'=>'上级项目配套','budget' => ''),
					array('nodelink'=>'11','nodename'=>'科技政策兑现','budget' => '','map'=>array(array('LIKE','11%'),array('NOTLIKE','1115%'),array('NOTLIKE','1120%'),'AND'),),
					array('nodelink'=>'12','nodename'=>'知识产权奖励','budget' => ''),
					array('nodelink'=>'13','nodename'=>'公共平台建设及运转补贴','budget' => ''),
					array('nodelink'=>'-1','nodename'=>'其它','budget' => ''), 
				),	
			'2014' => array(
					
					array('nodelink' => '','nodename'=>'总计','budget' => '56000'),
					array('nodelink'=>'10','nodename'=>'科技项目启动经费','budget' => '8000','map'=>array(array('LIKE','10%'),array('NOTLIKE','101101%'),'AND')),
					array('nodelink'=>'101101','nodename'=>'重大招商项目启动经费','budget' => '4000'),
					array('nodelink'=>'1115','nodename'=>'房租补贴','budget' => '11500'),
					array('nodelink'=>'1120','nodename'=>'上级项目配套','budget' => '13000'),
					array('nodelink'=>'11','nodename'=>'科技政策兑现','budget' => '11232','map'=>array(array('LIKE','11%'),array('NOTLIKE','1115%'),array('NOTLIKE','1120%'),'AND'),),
					array('nodelink'=>'12','nodename'=>'知识产权奖励','budget' => '3000'),
					array('nodelink'=>'13','nodename'=>'公共平台建设及运转补贴','budget' => '3800'),
					array('nodelink'=>'-1','nodename'=>'其它','budget' => '1468'), 
					/* array('nodelink' => '','nodename'=>'总计','budget' => '128200'),
					array('nodelink'=>'1010','nodename'=>'领军人才启动经费','budget' => '7100'),
					array('nodelink'=>'1011','nodename'=>'招商启动经费','budget' => '8000'),
					array('nodelink'=>'1115','nodename'=>'房租补贴','budget' => '11500'),
					array('nodelink'=>'1120','nodename'=>'上级项目配套','budget' => '13000'),
					array('nodelink'=>'12','nodename'=>'知识产权奖励','budget' => '3000'),
					array('nodelink'=>'-1','nodename'=>'其它','budget' => '85600'), */
			),
			
			'2015' => array(
						
					array('nodename'=>'总计','budget' => '6' ,'fact' => '6.3795'),
					array('nodename'=>'创新创业专项','budget' => '2.07','fact' => '2.9074'),
					array('nodename'=>'新兴产业专项','budget' => '0.4','fact' => '0.4076'),
					array('nodename'=>'科技金融专项','budget' => '0.8','fact' => '0.5254'),
					array('nodename'=>'创新政策专项','budget' => '1.25','fact' => '1.3731'),
					array('nodename'=>'知识产权专项','budget' => '0.25','fact' => '0.2124'),
					array('nodename'=>'公共平台专项','budget' => '0.68','fact' => '0.4205'),
					array('nodename'=>'MOCVD补贴','budget' => '0.4','fact' => '0.3572'),
					array('nodename'=>'其他专项','budget' => '0.15','fact' => '0.1759'),
					
					//array('nodename'=>'众创政策兑现','budget' => '0.68','fact' => '4076'),
					
					
					
					
					
					//array('nodename'=>'公共平台专项','budget' => '315','fact' => '277'),
					//array('nodename'=>'MOCVD补贴','budget' => '200','fact' => '61'),
					//array('nodename'=>'企业服务专项','budget' => '200','fact' => '185'),
					//array('nodename'=>'项目管理专项','budget' => '785','fact' => '1236'),
					//array('nodename'=>'科协科普专项','budget' => '4000','fact' => '3572'),
					
					
			),

		),
		//提交资金申请信息接口调试状态用户名、密码
		'FUND_INTERFACE_DEBUG'			=> array(
				'status' 			=> 'debug',
				'userid' 			=> 'test',
				'userpass' 			=> 'test',
		),
		
)
?>