<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
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

    
    <script type="text/javascript">

        function deleteRecord(id) {
            layer_confirm('删除后该站点无法恢复，您确认删除么？',
                function () {

                    window.location.href = "__URL__/deleteRecord/id/" + id;

                });
        }
    </script>
</head>

<body>
    <!-- 页面顶部 logo & 菜单 begin -->
    
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
    <!-- 页面顶部 logo & 菜单 end -->
    <!-- 页面左侧菜单 begin -->
    <!--menu 左侧菜单 begin-->

<nav class="ui-menu">

  <ul class="layui-nav layui-nav-tree" lay-filter="menu">
  
  		<!-- 产品首页 begin -->
	 	<li class="layui-nav-item <?php if(MODULE_NAME == 'Home' && ACTION_NAME == 'home'): ?>layui-nav-itemed<?php endif; ?>">
	      <a href="<?php echo U('Home/home');?>">
	        <i class="iconfont f18">&#xe60a;</i><span class="menu-title">系统概况</span>
	      </a>
	    </li>
	    <!-- 产品首页  end -->
	    <?php if(($LoginUserName) != "排名统计"): switch($LoginUserInfo['usertype']): case "sales_manager": ?><!-- 销售经理 -->

	        <li class="layui-nav-item <?php if(MODULE_NAME == 'UserManagement'): ?>layui-nav-itemed<?php endif; ?>">
	            <a href="javascript:;"><i class="iconfont">&#xe62f;</i>用户管理</a>
	            <dl class="layui-nav-child">
	            
	                <dd <?php if(MODULE_NAME == 'UserManagement' && ACTION_NAME == 'agent_list'): ?>class="layui-this"<?php endif; ?>>
	                    <a href="<?php echo U('UserManagement/agent_list');?>">代理商管理</a>
	                </dd>
	                
	                <dd <?php if(MODULE_NAME == 'UserManagement' && ACTION_NAME == 'sub_user_list'): ?>class="layui-this"<?php endif; ?>>
	                    <a href="<?php echo U('UserManagement/sub_user_list');?>">子用户管理</a>
	                </dd>
	            </dl>
	        </li>
		  
		    
			<!-- 员工管理 begin -->
		    <li class="layui-nav-item <?php if(MODULE_NAME == 'SysPermission'): ?>layui-nav-itemed<?php endif; ?>">
		    	<a href="<?php echo U('SysPermission/staff');?>">
					<i class="iconfont">&#xe629;</i>员工管理
				</a>
		    </li>
			<!-- 员工管理 end --><?php break;?>
		 <?php case "seller": ?><!-- 销售 -->
	
	      <li class="layui-nav-item <?php if(MODULE_NAME == 'UserManagement'): ?>layui-nav-itemed<?php endif; ?>">
	            <a href="javascript:;"><i class="iconfont">&#xe62f;</i>用户管理</a>
	            <dl class="layui-nav-child">
	            
	                <dd <?php if(MODULE_NAME == 'UserManagement' && ACTION_NAME == 'agent_list'): ?>class="layui-this"<?php endif; ?>>
	                    <a href="<?php echo U('UserManagement/agent_list');?>">代理商管理</a>
	                </dd>
	                
	                <dd <?php if(MODULE_NAME == 'UserManagement' && ACTION_NAME == 'sub_user_list'): ?>class="layui-this"<?php endif; ?>>
	                    <a href="<?php echo U('UserManagement/sub_user_list');?>">子用户管理</a>
	                </dd>
	            </dl>
	        </li><?php break;?>
		 <?php default: ?>
		 	<?php if(($LoginUserInfo['usertype']) != "operation"): ?><li class="layui-nav-item <?php if(MODULE_NAME == 'UserManagement'): ?>layui-nav-itemed<?php endif; ?>">
				<a href="javascript:;"><i class="iconfont">&#xe62f;</i>用户管理</a>
				<dl class="layui-nav-child">
				
					<dd <?php if(MODULE_NAME == 'UserManagement' && ACTION_NAME == 'agent_list'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('UserManagement/agent_list');?>">代理商管理</a>
					</dd>
					
					<dd <?php if(MODULE_NAME == 'UserManagement' && ACTION_NAME == 'sub_user_list'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('UserManagement/sub_user_list');?>">子用户管理</a>
					</dd>
				</dl>
			</li><?php endif; ?>
	    	
	    
		    
	    
	    	<?php if(($LoginUserInfo['usertype']) == "admin"): ?><li class="layui-nav-item <?php if((MODULE_NAME) == "Finance"): ?>layui-nav-itemed<?php endif; ?>">
		      <a href="javascript:;">
		        <i class="iconfont f18">&#xe623;</i><span class="menu-title">财务管理</span>
		      <span class="layui-nav-more"></span></a>
		      <dl class="layui-nav-child">
		        <dd <?php if(MODULE_NAME == 'Finance' && ACTION_NAME == 'pool'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Finance/pool');?>">资金池管理</a></dd>
		        <dd <?php if(MODULE_NAME == 'Finance' && ACTION_NAME == 'details'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Finance/details');?>">财务明细</a></dd>
		        <dd <?php if(MODULE_NAME == 'Finance' && ACTION_NAME == 'agent_user_list'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Finance/agent_user_list');?>">代理充值</a></dd>
		        <dd <?php if(MODULE_NAME == 'Finance' && ACTION_NAME == 'sub_user_list'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Finance/sub_user_list');?>">用户退款</a></dd>
		      </dl>
		    </li>
		    
		    <!-- <li class="layui-nav-item <?php if(MODULE_NAME == 'UserRole'): ?>layui-nav-itemed<?php endif; ?>">
		      <a href="<?php echo U('UserRole/index');?>">
		        <i class="iconfont f18">&#xe614;</i><span class="menu-title">角色管理</span>
		      </a>
		    </li>
		    
		    <li class="layui-nav-item <?php if(MODULE_NAME == 'Staff'): ?>layui-nav-itemed<?php endif; ?>">
		      <a href="<?php echo U('Staff/index');?>">
		        <i class="iconfont f18">&#xe61b;</i><span class="menu-title">员工管理</span>
		      </a>
		    </li>
		     -->
		    
		    <li class="layui-nav-item <?php if(MODULE_NAME == 'SysPermission' ): ?>layui-nav-itemed<?php endif; ?>">
				<a href="javascript:;"><i class="iconfont">&#xe7e0;</i>权限管理</a>
				<dl class="layui-nav-child">
					<dd <?php if(MODULE_NAME == 'SysPermission' && ACTION_NAME == 'department'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('SysPermission/department');?>">角色管理</a>
					</dd>
					<!-- <dd <?php if(MODULE_NAME == 'SysPermission' && ACTION_NAME == 'role'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('SysPermission/role');?>">角色管理</a>
					</dd> -->
					<!-- <dd <?php if(MODULE_NAME == 'SysPermission' && ACTION_NAME == 'staff'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('SysPermission/staff');?>">员工管理</a>
					</dd> -->
				</dl>
			</li><?php endif; ?>

			<?php if($LoginUserInfo['usertype'] == 'operation_manager'): ?><li class="layui-nav-item <?php if( ( MODULE_NAME == 'System') OR ( MODULE_NAME == 'News') ): ?>layui-nav-itemed<?php endif; ?>">
				<a href="javascript:;"><i class="iconfont">&#xe7e0;</i>系统设置</a>
				<dl class="layui-nav-child">
					<dd <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'updateNewsPage' && $_GET['newstype'] == 'notice'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('System/updateNewsPage');?>/newstype/notice">维护公告</a>
					</dd>
					<dd <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'updateNewsPage' && $_GET['newstype'] == 'protocol'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('System/updateNewsPage');?>/newstype/protocol">维护协议</a>
					</dd>

					<dd <?php if(MODULE_NAME == 'News' && ACTION_NAME == 'insertPage'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('News/insertPage');?>">添加通知</a>
					</dd>
					<dd <?php if(MODULE_NAME == 'News' && ACTION_NAME == 'index'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('News/index');?>">发布列表</a>
					</dd>

				</dl>
			</li><?php endif; endswitch; endif; ?>


		<?php if(($LoginUserName) != "排名统计"): ?><!-- 产品首页 begin -->
	 	<li class="layui-nav-item <?php if(MODULE_NAME == 'Index' && ACTION_NAME == 'index'): ?>layui-nav-itemed<?php endif; ?>">
	      <a href="<?php echo U('Index/index');?>">
	        <i class="iconfont f18">&#xe60a;</i><span class="menu-title">产品统计</span>
	      </a>
	    </li>
	    <!-- 产品首页  end -->
	    
		<?php switch($LoginUserInfo['usertype']): case "sales_manager": ?><!-- 销售经理 -->
		 
		  
	       <!-- 关键词查询 begin -->
	        <li class="layui-nav-item <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'search'): ?>layui-nav-itemed<?php endif; ?>">
	          <a href="<?php echo U('Keyword/search');?>">
	            <i class="iconfont f18">&#xe699;</i><span class="menu-title">关键词查询</span>
	          </a>
	        </li>
	        <!-- 关键词查询 end -->
	
	
		    <!-- 效果监控 begin -->
		 	<li class="layui-nav-item <?php if(ACTION_NAME == 'effect'): ?>layui-nav-itemed<?php endif; ?>">
		      <a href="javascript:;">
		        <i class="iconfont f18">&#xe7b2;</i><span class="menu-title">效果监控</span>
		      <span class="layui-nav-more"></span></a>
		      <dl class="layui-nav-child">
		        <dd <?php if(MODULE_NAME == 'Site' && ACTION_NAME == 'effect'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Site/effect');?>">站点效果监测</a></dd>
		        <dd <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'effect'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Keyword/effect');?>">关键词效果监测</a></dd>
				  <!--{*<dd <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'effect'): ?>class="layui-this"<?php endif; ?>><a href="/Manage/Keyword/effect/ord/latestranking/keyword//website//keywordstatus/%E4%BC%98%E5%8C%96%E4%B8%AD/standardstatus//searchengine//num_per_page/">关键词效果监测</a></dd>*}-->
		      </dl>
		    </li>
		    <!-- 效果监控 end --><?php break;?>
		 <?php case "seller": ?><!-- 销售 -->
	
	      <!-- 关键词查询 begin -->
	        <li class="layui-nav-item <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'search'): ?>layui-nav-itemed<?php endif; ?>">
	          <a href="<?php echo U('Keyword/search');?>">
	            <i class="iconfont f18">&#xe699;</i><span class="menu-title">关键词查询</span>
	          </a>
	        </li>
	        <!-- 关键词查询 end -->
	
			<li class="layui-nav-item <?php if(ACTION_NAME == 'effect'): ?>layui-nav-itemed<?php endif; ?>">
		      <a href="javascript:;">
		        <i class="iconfont f18">&#xe7b2;</i><span class="menu-title">效果监控</span>
		      <span class="layui-nav-more"></span></a>
		      <dl class="layui-nav-child">
		        <dd <?php if(MODULE_NAME == 'Site' && ACTION_NAME == 'effect'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Site/effect');?>">站点效果监测</a></dd>
		        <dd <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'effect'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Keyword/effect');?>">关键词效果监测</a></dd>
				  <!--{*<dd <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'effect'): ?>class="layui-this"<?php endif; ?>><a href="/Manage/Keyword/effect/ord/latestranking/keyword//website//keywordstatus/%E4%BC%98%E5%8C%96%E4%B8%AD/standardstatus//searchengine//num_per_page/">关键词效果监测</a></dd>*}-->
		      </dl>
		    </li><?php break;?>
		 <?php default: ?>
		    
	    	<?php if($LoginUserInfo['usertype'] == 'operation_manager' OR $LoginUserInfo['usertype'] == 'operation'): ?><li class="layui-nav-item <?php if(MODULE_NAME == 'Site' && ACTION_NAME == 'index'): ?>layui-nav-itemed<?php endif; ?>">
		      <a href="<?php echo U('Site/index');?>">
		        <i class="iconfont f18">&#xe633;</i><span class="menu-title">站点管理</span>
		      </a>
		    </li>
		    <li class="layui-nav-item <?php if((MODULE_NAME == 'Keyword' && (ACTION_NAME == 'index' OR ACTION_NAME == 'unfreeze_list' OR ACTION_NAME=='search' )) OR (MODULE_NAME == 'Cart' && ACTION_NAME == 'index')): ?>layui-nav-itemed<?php endif; ?>">
		      <a href="javascript:;">
		        <i class="iconfont f18">&#xe631;</i><span class="menu-title">关键词管理</span>
		      <span class="layui-nav-more"></span></a>
		      <dl class="layui-nav-child">
		      	<dd <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'search'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Keyword/search');?>">关键词查询</a></dd>
		        <dd <?php if(MODULE_NAME == 'Cart' && ACTION_NAME == 'index'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Cart/index');?>">关键词清单</a></dd>
		        <dd <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'index'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Keyword/index');?>">关键词审核</a></dd>
		        <dd <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'unfreeze_list'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Keyword/unfreeze_list');?>">关键词解冻</a></dd>
		      </dl>
		    </li><?php endif; ?>
	    
		    <li class="layui-nav-item <?php if(ACTION_NAME == 'effect'): ?>layui-nav-itemed<?php endif; ?>">
		      <a href="javascript:;">
		        <i class="iconfont f18">&#xe7b2;</i><span class="menu-title">效果监控</span>
		      <span class="layui-nav-more"></span></a>
		      <dl class="layui-nav-child">
		        <dd <?php if(MODULE_NAME == 'Site' && ACTION_NAME == 'effect'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Site/effect');?>">站点效果监测</a></dd>
		        <dd <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'effect'): ?>class="layui-this"<?php endif; ?>><a href="/Manage/Keyword/effect/ord/latestranking/keyword//website//keywordstatus/%E4%BC%98%E5%8C%96%E4%B8%AD/standardstatus//searchengine//num_per_page/">关键词效果监测</a></dd>
		      </dl>
		    </li><?php endswitch;?>
  		<?php else: ?>
	  		<!-- 产品首页 begin -->
		 	<li class="layui-nav-item layui-nav-itemed">
		      <a href="<?php echo U('Keyword/effect');?>">
		        <i class="iconfont f18">&#xe60a;</i><span class="menu-title">关键词效果监测</span>
		      </a>
		    </li>
		    <!-- 产品首页  end --><?php endif; ?>

        <!-- 排名差异 begin -->
		<?php if($LoginUserInfo['usertype'] != 'operation'): ?><li class="layui-nav-item <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'different'): ?>layui-nav-itemed<?php endif; ?>">
				<a href="<?php echo U('Keyword/different');?>">
					<i class="iconfont f18">&#xe62c;</i><span class="menu-title">排名差异</span>
				</a>
			</li><?php endif; ?>
        <!-- 排名差异  end -->
        <?php if($LoginUserInfo['usertype'] != 'operation'): ?><li class="layui-nav-item <?php if(MODULE_NAME == 'OSReport'): ?>layui-nav-itemed<?php endif; ?>">
				<a href="javascript:;"><i class="iconfont">&#xe6b2;</i>报表管理</a>
				<dl class="layui-nav-child">
					<!-- <dd <?php if(MODULE_NAME == 'OSReport' && ACTION_NAME == 'matchPage'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('OSReport/matchPage');?>">关键词核对报表</a>
					</dd> -->
					<dd <?php if(MODULE_NAME == 'OSReport' && ACTION_NAME == 'cooperate_stop_today'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('OSReport/cooperate_stop_today');?>">今日合作停关键词</a>
					</dd>
					<dd <?php if(MODULE_NAME == 'OSReport' && ACTION_NAME == 'cooperate_stop_all'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('OSReport/cooperate_stop_all');?>">全部合作停关键词</a>
					</dd>
					<dd <?php if(MODULE_NAME == 'OSReport' && ACTION_NAME == 'new_keyword_today'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('OSReport/new_keyword_today');?>">今日新增关键词</a>
					</dd>
					<!-- <dd <?php if(MODULE_NAME == 'OSReport' && ACTION_NAME == 'keyword_compare'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('OSReport/keyword_compare');?>">刷词后台比较</a>
					</dd> -->

					<!-- <dd <?php if(MODULE_NAME == 'QRReport'): ?>class="layui-this"<?php endif; ?>>
						<a href="<?php echo U('QRReport/index');?>">效果报表</a>
					</dd> -->
				</dl>
			</li><?php endif; ?>
        <!-- 排名匹配 begin -->
       <!--  <li class="layui-nav-item <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'matchPage'): ?>layui-nav-itemed<?php endif; ?>">
          <a href="<?php echo U('Keyword/matchPage');?>">
            <i class="iconfont f18">&#xe62c;</i><span class="menu-title">排名匹配</span>
          </a>
        </li> -->
        <!-- 排名匹配  end -->

 	</ul>
</nav>
<!--menu 左侧菜单 end-->

<script>
layui.use(['element'], function(){
  
  
});
</script>
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
        <!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="<?php echo U('Index/index');?>"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>站点管理</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
               <div class="ui-panel">
	                <!-- 站点列表挂件 begin -->
					<?php echo W('SiteList', array( 'list' => $list,'query_params'=>$query_params, 'returnUrl' => $CURRENT_URL_ADD));?>
					<!-- 站点列表挂件 end -->	
			</div>
        </div>
    </div>
    <!-- 页面底部 begin -->
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
    <!-- 页面底部 end -->
</body>