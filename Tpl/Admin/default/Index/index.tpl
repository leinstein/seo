<!DOCTYPE HTML>
<html>
<head>
<title>管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="">
<meta name="author" content="dejax">
<script type="text/javascript">
<!--
  var URL       = '__URL__';
  var APP       = '__APP__';
  var ACTION_NAME   = '<php>echo ACTION_NAME;</php>';
  var MODULE_NAME   = '<php>echo MODULE_NAME;</php>';
  var PUBLIC      = '__PUBLIC__';
  var APP_PUBLIC    = '../Public/';
  var ROOT      = '__ROOT__';
  var CURL      = '{$CURRENT_URL}';
  var PREURL      = '{$PRE_URL}';
//-->
</script>
<link href="../Public/skin/bui/css/dpl-min.css" rel="stylesheet" type="text/css" />
<link href="../Public/skin/bui/css/bui-min.css" rel="stylesheet" type="text/css" />
<link href="../Public/skin/bui/css/main-min.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="header">

		<div class="dl-title">
			<a href="__APP__/Admin" title="后台" target="_self"> <img src="../Public/img/logo.png" /></a>
		</div>

		<div class="dl-log">
			<a class="dl-log-quit"> 欢迎您：<i class="icon-user icon-white"></i>
				<span class="dl-log-user">系统管理员 [admin]</span>
			</a> 
			<span class="dl-log-user">|</span> <a href="/Admin/Login/out" title="退出系统" class="dl-log-quit"> 退出系统 </a>
			<span class="dl-log-user">|</span> <a href="javascript:" id="btnUpdatePassword" class="dl-log-quit" title="修改密码"> 修改密码 </a> 
			<span class="dl-log-user">|</span> <a href="javascript:" id="btnAbout" class="dl-log-quit" 	title="关于本软件"> 关于本软件 </a> 
			<span class="dl-log-user">|</span> <a href="javascript:" id="btnHelp" class="dl-log-quit" title="帮助文档"> 帮助文档 </a>
			<span class="dl-log-user">|</span> <a href="/index.php/Web/Index/index" class="dl-log-quit" target="_blank"> 网站首页 </a>
		</div>
	</div>
	<div class="content">
		<div class="dl-main-nav">
			<ul id="J_Nav" class="nav-list ks-clear">
				<li class="nav-item dl-selected"><div class="nav-item-inner nav-home">快捷菜单</div></li>
				<li class="nav-item"><div class="nav-item-inner nav-order">应用示例</div></li>
				<li class="nav-item"><div class="nav-item-inner nav-inventory">系统管理</div></li>
			</ul>
		</div>
		<ul id="J_NavContent" class="dl-tab-conten">

		</ul>
	</div>
	<script type="text/javascript" src="__PUBLIC__/js/jquery/jquery.1.8.1.min"></script>
	<script type="text/javascript" src="../Public/js/bui/bui-min.js"></script>
	<script type="text/javascript" src="../Public/js/bui/config.js"></script>

	<script>
    BUI.use('common/main',function(){
      var config = [{
          id:'fast', 
          homePage : 'home',
          menu:[{
              text:'常用功能',
              items:[
                {id:'home',text:'首页',href:'__APP__/Admin/Index/home',closeable : false},
                {id:'main-menu',text:'如何开始',href:'main/menu.html'}
              ]
            }]
          },{
            id:'sample',
            menu:[{
                text:'对象维护功能',
                items:[
                  {id:'sobjpage1',text:'图书管理',href:'__APP__/Admin/DemoBook/index'}
                ]
              },{
                text:'设置功能',
                items:[
                  {id:'ssetpage',text:'设置界面',href:'__APP__/Admin/DemoCommon/config'}
                ]
              }]
          },{
            id:'common',
            menu:[{
                text:'机构用户管理',
                items:[
                  {id:'user',text:'用户管理',href:'search/code.html'},
                  {id:'org',text:'机构管理',href:'search/example.html'}
                ]
              },{
                  text : '日志查询',
                  items : [
                    {id : 'bizlog',text : '业务日志查询',href : 'search/tab.html'}
                  ]
              },{
                  text : '系统管理',
                  items : [
					{id : 'category',text : '类别管理',href : 'search/tab.html'},
					{id : 'attach',text : '附件管理',href : 'search/tab.html'},       
                    {id : 'bizcode',text : '业务代码管理',href : 'search/tab.html'},
                    {id : 'config',text : '参数设置',href : 'search/tab.html'}
                  ]
              }]
          }];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>
</body>
</html>

