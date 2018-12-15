<?php if (!defined('THINK_PATH')) exit();?><html lang = "en">
<head>
    <meta http-equiv = "content-type"
          content = "text/html; charset=UTF-8">
    <meta charset = "utf-8">
    <title>米同智能营销系统管理后台</title>
    <meta name = "viewport"
          content = "width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <!--系统css-->
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Public/css/cloud-admin.css">
    <!--主题css-->
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Public/css/default.css"
          id = "skin-switcher">
    <!--图标字体-->
    <link href = "../Public/css/font-awesome.min.css"
          rel = "stylesheet">
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title><?php echo (($page_title)?($page_title):"米同搜索营销管理后台"); ?></title>
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

    <!-- 自定义正则验证js  -->
    <script src = "__PUBLIC__/js/regular.js"></script>
    <!-- FONTS -->
    <!--字体-->
</head>
<body>
<!-- 页面顶部 logo & 菜单 begin  -->

<!-- header -->
<div class="ui-header">
	<?php load("@.file"); $logo_path = get_download_url($LoginUserInfo['oem_config']['logo_image_arr']['fileid']); ?>
	<div class="ui-header-logo fl">
    	<!--<a class="logo" href="<?php echo U('Service/Home/home');?>">
        <img src="<?php echo (($logo_path)?($logo_path):'__PUBLIC__/img/logo-white.png'); ?>" alt="">
      	</a>-->
	<div style="font-size:25px;text-align:center;line-height:63px;font-weight:bold;color:#fff;"><i class="iconfont">&#xe62f;</i> <?php echo ($LoginUserInfo['role_info']['rolename']); ?></div>
	</div>
	<div class="ui-header-main ta_r">
		<!-- <div class="menu-control-outer fl">
			<a href="#a_null" id="menuControl" class="menu-collapse-control" title="折叠菜单">
			</a>
		</div> -->
		<ul class="layui-nav header-link fr">
		  <li class="layui-nav-item">
		    <a href="javascript:;" title="<?php echo ($LoginUserName); ?>">欢迎您，<?php echo (title_show($LoginUserName)); ?></a>
		    <dl class="layui-nav-child">
		      <dd><a href="<?php echo U('User/updatePage');?>">账号信息</a></dd>
		      <dd><a href="<?php echo U('User/updatePasswordPage');?>">密码修改</a></dd>
		      <dd><a href="<?php echo U('Index/logOut');?>">安全退出</a></dd>
		    </dl>
		  </li>
		</ul> 
		
		<div class="fl">
			<?php  $home_arra = array('Home','User'); ?>
			<a href="<?php echo U('Service/Home/home');?>" class="header-link <?php if(in_array(MODULE_NAME,$home_arra)): ?>actived<?php endif; ?>">
				<i class="iconfont">&#xe671;</i>首页
			</a>
			
			<!-- 系统产品 begin -->
			<?php if(is_array($sys_products)): $i = 0; $__LIST__ = $sys_products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['entry_code']);?>" class="header-link <?php if(in_array(MODULE_NAME,$vo['module_name_arra'][GROUP_NAME])): ?>actived<?php endif; ?>">
					<i class="iconfont"><?php echo ($vo['menuicon']); ?></i><?php echo ($vo['product_name']); ?>
				</a><?php endforeach; endif; else: echo "" ;endif; ?>
			<!-- 系统产品 end -->

			<a href="<?php echo U('Service/Workorder/index');?>"  class="header-link <?php if(MODULE_NAME == 'Workorder'): ?>actived<?php endif; ?>">
				<i class="iconfont">&#xe6aa;</i>工单<?php if(($untreated_workorder_num) > "0"): ?><span class="badge"><?php echo ($untreated_workorder_num); ?></span><?php endif; ?>
			</a>
			<a href="<?php echo U('Service/Question/index');?>"  class="header-link <?php if(MODULE_NAME == 'Question'): ?>actived<?php endif; ?>">
				<i class="iconfont">&#xe64c;</i>常见问题
			</a>
			
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
        <li class="layui-nav-item <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'bpxdindex'): ?>layui-nav-itemed<?php endif; ?>">
        <a href="<?php echo U('System/bpxdindex');?>"><i class="iconfont">&#xe76a;</i>霸屏下单</a>
        </li>

        <li class="layui-nav-item <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'bpxdlist'): ?>layui-nav-itemed<?php endif; ?>">
        <a href="<?php echo U('System/bpxdlist');?>"><i class="iconfont">&#xe76a;</i>站点监控</a>
        </li>
        <li class="layui-nav-item <?php if(MODULE_NAME == 'MiriadeKeyword' && ACTION_NAME == 'caseShow'): ?>layui-nav-itemed<?php endif; ?>">
        <a href="<?php echo U('System/caseShow');?>"><i class="iconfont">&#xe76a;</i>案例展示</a>
        </li>

    </ul>

</nav>
<!--menu 左侧菜单 end
<!-- 页面左侧菜单 end  -->
<div class = "ui-module">
    <div class = "ui-content"
         id = "ui-content">
        <div class = "ui-panel">

            <table cellpadding = "0"
                   cellspacing = "0"
                   border = "0"
                   class = "datatable table table-striped table-bordered table-hover dataTable">
                <thead>
                <tr>
                    <th class = "center">序号</th>
                    <th class = "center">网站名称</th>
                    <th class = "center">网站地址</th>
                    <th class = "center">套餐类型</th>
                    <th class = "center">审批状态</th>
                    <th class = "center">下单账户</th>
                    <th class = "center">联系方式</th>
                    <th class = "center">更新时间</th>
                    <th class = "center">效果监控入口</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
                        <td class = "center">
                            <?php echo ($key+1); ?>
                        </td>
                        <td class = "center">
                            <?php echo ($vo['bp_sitename']); ?>
                        </td>
                        <td class = "center">
                            <a href = " <?php echo U('System/bpxdindex', array('id' => $vo['id']));?>"><?php echo ($vo['bp_site_url']); ?></a>
                        </td>
                        <?php $vo['bp_combo'] == '1' ? $combo = $vo["bp_price"].'/季度' : ($vo['bp_combo'] == '2' ? $combo = $vo["bp_price"].'/半年' : $combo = $vo["bp_price"].'/年'); ?>
                        <td class = "center"><?php echo ($combo); ?></td>
                        <?php $vo['bp_check'] == '1' ? $check = '审核通过' : ($vo['bp_check'] == '2' ? $check = '审核驳回' : $check = '待审核'); ?>
                        <td class = "center"><?php echo ($check); ?></td>
                        <td class = "center"><?php echo ($vo['bp_username']); ?></td>

                        <td class = "center"><?php echo ($vo['bp_telephone']); ?></td>

                        <td class = "center"><?php echo ($vo['bp_updatetime']); ?></td>
                        <td class = "center">

                            <a href = "http://<?php echo ($vo['bp_mosite_url']); ?> " target="_blank"><?php if($vo['bp_mosite_url']){?>点击进入<?php }else{ } ?></a><?php if($vo['bp_mosite_url']){?>>><?php }else{ } ?>


                        </td>

                    </tr><?php endforeach; endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!--/PAGE -->
<!-- JAVASCRIPTS -->
<!-- JQUERY -->
<script src = "../Public/js/jquery/jquery-2.0.3.min.js"></script>
<!-- /JAVASCRIPTS -->

</body>
</html>