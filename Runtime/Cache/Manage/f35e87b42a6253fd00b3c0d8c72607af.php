<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<?php ?>
<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title><?php echo (($page_title)?($page_title):"米同智能营销系统管理后台"); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<meta name="description" content="mitong">
<meta name="author" content="mitong">
<!-- <link rel="shortcut icon" href="Upload/favicon.ico" type="image/x-icon" /> -->


<script type="text/javascript">
<!--
	var ROOT      		= '__ROOT__';
  	var URL       		= '__URL__';
  	var APP       		= '__APP__';
  	var GROUP 			= '__GROUP__';
  	var ACTION_NAME   	= '<?php echo ACTION_NAME; ?>';
  	var MODULE_NAME   	= '<?php echo MODULE_NAME; ?>';
  	var PUBLIC      	= '__PUBLIC__';
  	var APP_PUBLIC    	= '../Public/';
  	var CURL      		= '<?php echo ($CURRENT_URL); ?>';
  	var PREURL      	= '<?php echo ($PRE_URL); ?>';
  
//-->
</script>

<!-- HTML5 for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="__PUBLIC__/js/html5shiv.js"></script>
<![endif]-->

<!-- ================================= load js begin =================================> -->
<!-- 引入jQuery -->
<script type="text/javascript" src="__PUBLIC__/js/jquery/jquery.1.10.2.min.js"></script>
<!-- 引入 layer 框架  -->
<script type="text/javascript" src="__PUBLIC__/js/layui/layui.js"></script>
<!-- underscore工具库   -->
<script type="text/javascript" src="__PUBLIC__/js/underscore/underscore-min.js"></script>
<!-- 系统公共js  -->
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>


<!-- ================================= load css begin =================================> -->
<!-- 引入bootstrap css -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css?v=v3.3.7">
<!-- 引入 layui css -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/layui/css/layui.css?v=1.0.9">
<!-- 引入系统  css -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/demo3.css" type="text/css">
<!-- 引入图标字体  css -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/iconfont/iconfont.css?v=1.0.0" media="all">
<!-- 引入通用样式 css-->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/common.css">
<!-- 引入通用缩写样式 css-->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/short.css">
<!-- 引入重写样式 -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/reset.css" >
<!-- 引入重写样式 -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/reset-layui.css" >
<script type="text/javascript">
//隐藏父页面的加载进度层
$('#loading_iframe', parent.document).show();
</script>

    <!-- tips插件 begin -->
    <link rel="stylesheet" href="../Public/css/tipso.min.css">
    <script type="text/javascript" src="../Public/js/tipso.min.js"></script>
    <!-- tips插件 end -->

    <!-- 引入 echarts begin -->
    <script type="text/javascript" src="__PUBLIC__/js/echarts/echarts.js"></script>
    <!-- 引入 echarts end -->

    <link rel="stylesheet" href="../Public/css/index.css">
    <link rel="stylesheet" href="__PUBLIC__/static/login/style/mit.css">
</head>
<body>

<!-- 页面顶部 logo & 菜单 begin  -->

	<!-- header -->
	<div class="ui-header">
		<div class="ui-header-logo fl">
			<!--<?php if(($LoginUserInfo['usertype']) == "seller"): ?><a class="logo" href="<?php echo U('Manage/Home/home');?>">
	        <img src="__PUBLIC__/img/logo-white.png">
	      	</a>
	    <?php else: ?>
	    	<a class="logo" href="<?php echo U('Manage/Home/home');?>">
	        <img src="__PUBLIC__/img/logo-white.png">
	      	</a><?php endif; ?>-->

	    <div style="font-size:25px;text-align:center;line-height:63px;font-weight:bold;color:#fff;"><i class="iconfont">&#xe62f;</i> <?php echo ($LoginUserInfo['role_info']['rolename']); ?></div>
		</div>
		<div class="ui-header-main ta_r">
			<!-- <div class="menu-control-outer fl">
				<a href="#a_null" id="menuControl" class="menu-collapse-control" title="折叠菜单">
				</a>
			</div> -->
			<ul class="layui-nav header-link fr">
			  <li class="layui-nav-item">
			    <a href="javascript:;">欢迎您，<?php echo ($LoginUserName); ?></a>
			    <dl class="layui-nav-child">
			      <dd><a href="<?php echo U('User/updatePage');?>">账号信息</a></dd>
			      <dd><a href="<?php echo U('User/updatePasswordPage');?>">密码修改</a></dd>
			      <dd><a href="<?php echo U('Index/logOut');?>">安全退出</a></dd>
			    </dl>
			  </li>
			</ul> 
			
			
			<div class="fl">
				
				<?php  $home_arra = array('Home','User','Finance','System','UserManagement','News','SysPermission'); $os_arra = array('Index','Site','Keyword','Cart','OSReport'); $qr_arra = array('QRIndex','QRKeyword','QRPlan','QREpinfo','QRReport'); ?>
				<?php if(($LoginUserName) != "排名统计"): ?><a href="<?php echo U('Manage/Home/home');?>" class="header-link <?php if(in_array(MODULE_NAME,$home_arra)): ?>actived<?php endif; ?>">
						<i class="iconfont">&#xe671;</i>首页
					</a><?php endif; ?>
				
				<!-- 系统产品 begin -->
				<?php if(is_array($sys_products)): $i = 0; $__LIST__ = $sys_products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['entry_code']);?>" class="header-link <?php if(in_array(MODULE_NAME,$vo['module_name_arra'][GROUP_NAME])): ?>actived<?php endif; ?>">
						<i class="iconfont"><?php echo ($vo['menuicon']); ?></i><?php echo ($vo['product_name']); ?>
					</a><?php endforeach; endif; else: echo "" ;endif; ?>

				<!-- 系统产品 end -->
				
				<?php if(($LoginUserName) != "排名统计"): ?><a href="<?php echo U('Manage/Workorder/index');?>"  class="header-link <?php if(MODULE_NAME == 'Workorder'): ?>actived<?php endif; ?>">
						<i class="iconfont">&#xe6aa;</i>工单<?php if(($untreated_workorder_num) > "0"): ?><span class="badge"><?php echo ($untreated_workorder_num); ?></span><?php endif; ?>
					</a>
					<a href="<?php echo U('Manage/Remark/index');?>"  class="header-link <?php if(MODULE_NAME == 'Remark'): ?>actived<?php endif; ?>">
						<i class="iconfont">&#xe64d;</i>日志
					</a>
					<!-- <a href="<?php echo U('Manage/Question/index');?>"  class="header-link <?php if(MODULE_NAME == 'Question'): ?>actived<?php endif; ?>">
						<i class="iconfont">&#xe64c;</i>常见问题
					</a> --><?php endif; ?>
				
				
			</div>
		</div>
	</div>
	<!-- header end-->
	
	<script>
layui.use(['element'], function(){
  var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
});
</script>
<!-- 页面顶部 logo & 菜单 end  -->

<!-- 页面左侧菜单 begin  -->
menu 左侧菜单 begin-->
<script type="text/javascript">
    $(function() {
        layui.use(['element'], function () {
            var element = layui.element

            window.$ = layui.jquery;
            // 监听导航点击
            element.on('nav(menu)', function (elem) {
                var mUrl = elem.attr('dx-menu');
                !_.isEmpty(mUrl) && _route.go(mUrl);
            });
        });
    });
</script>
<nav class="ui-menu">
    <ul class="layui-nav layui-nav-tree" lay-filter="menu">
        <!--    <li class="layui-nav-item <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'bpxdlist'): ?>layui-nav-itemed<?php endif; ?>">
        <a href="<?php echo U('System/bpxdlist');?>"><i class="iconfont">&#xe76a;</i>霸屏下单</a>
        </li> -->

        <li class="layui-nav-item <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'bpxdlist'): ?>layui-nav-itemed<?php endif; ?>">
        <a href="<?php echo U('System/bpxdlist');?>"><i class="iconfont">&#xe76a;</i>站点监控</a>
        </li>
        <li class="layui-nav-item <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'caseShow'): ?>layui-nav-itemed<?php endif; ?>">
        <a href="<?php echo U('System/caseShow');?>"><i class="iconfont">&#xe76a;</i>案例展示</a>
        </li>
        <!--<li class="layui-nav-item <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'bpprice'): ?>layui-nav-itemed<?php endif; ?>">
        <a href="<?php echo U('System/bpprice');?>"><i class="iconfont">&#xe76a;</i>霸屏套餐</a>
        </li>-->

    </ul>

</nav>
<!--menu 左侧菜单 end
<!-- 页面左侧菜单 end  -->

<!--内容区域 begin -->
<div class="ui-module">

    <!-- 面包屑导航 begin -->
    <!-- <div class="ui-breadcrumb">
      <span class="layui-breadcrumb" style="visibility: visible;">
      <a href="javascript:void(0);">后台用户管理<span class="layui-box">&gt;</span></a><a href="javascript:void(0);"><cite>后台用户</cite></a></span>
    </div> -->
    <!-- 面包屑导航 end -->
    <div>
        <img width="99%" src="__PUBLIC__/static/login/images/bp1.jpg">
    </div>
<!-- 页面底部 begin  -->
<style>
.jqadmin-foot {
    height: 30px;
    padding: 5px 0;
    line-height: 30px;
    text-align: center;
    color: #666;
    font-weight: 300;
    border-left: 1px solid #1AA094;
    border-top: 1px solid #DDD;
    z-index: 998;
}
</style>
<!-- <div class="layui-footer jqadmin-foot" style="left: 200px;">
     <div class="layui-mian">
         <p class="jqadmin-copyright">
             <span class="layui">2017 ©</span> Write by Paco,<a href="http://www.jqcool.net">jQAdmin</a>. 版权所有 <span class="layui">依赖前端框架layui</span>
         </p>
     </div>
 </div> -->
<!-- 页面底部 end  -->
</body>
</html>