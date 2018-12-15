<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<?php ?>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title><?php echo (($page_title)?($page_title):"智能营销系统管理后台"); ?></title>
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

<link rel="stylesheet" href="__PUBLIC__/css/index.css">


<script type="text/javascript">
$(function(){ 
	// 隐藏父页面的加载进度层
	$('#loading_iframe', parent.document).hide();
	
	init_chart();
	$(window).resize(function () {          //当浏览器大小变化时
		init_chart();
	});
	
	/* var nowTime ;
    function play(){
    	var time = new Date();
    	nowTime = time.getHours()+"时"+time.getMinutes()+"分"+time.getSeconds()+"秒";
   	 	document.getElementById("time").innerHTML = nowTime;
    }
    play();
    setInterval(play,1000); */
    
	if( "<?php echo ($show_hint); ?>" == 1 ){
		var src ="<?php echo U('Manage/Home/show_trips');?>/userids/" + "<?php echo ($userids_less); ?>";
		layer_tips_right("温馨提示",src);
	}
    
}) 	

function init_chart(){
	// 基于准备好的dom，初始化echarts实例2017年4月20日 12:37:33 ：实例化账户余额
    var myChart = echarts.init(document.getElementById('account_balance'));
	var consumptions = <?php echo ($balances); ?>;
    // 指定图表的配置项和数据
    var option = {
        title: {
            text: '账户余额（元）',
            subtext: '最近10天账户余额',
            left: 'center',
            top: 10
        },
        //color: ['rgb(25, 183, 207)'],
        grid: {
            left: '1%',
            right: '1%',
            bottom: '5%',
            top: 80,
            containLabel: true
        },
        tooltip: {
        	
        },
        color: ['#66d6ff'],
       
        toolbox: {
 	        show : true,
 	        feature : {
 	            mark : {show: true},
 	            dataView : {show: true, readOnly: false},
 	            magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
 	            restore : {show: true},
 	            saveAsImage : {show: true}
 	        }
 	    },
    	calculable : true,
   	    grid: {
   	    	 left: '1%',
             right: '3%',
             bottom: '5%',
             top: 80,
             containLabel: true
   	    },
        xAxis: {
            data:<?php echo ($days); ?>
        },
        yAxis: {
        	 type: 'value'
        },
        series: [{
            name: '账户余额（元）',
            type: 'bar',
           	barWidth: '90%',
            data: consumptions,
            itemStyle : { 
            	normal: {
        			label : {show: true}
                },
                
            },
        }]
        
        
        /* title: {
            text: '账户余额（元）',
            subtext: '每日账户余额',
            left: 'center',
            top: 10
        },
        color: ['rgb(25, 183, 207)'],
        grid: {
            left: '3%',
            right: '3%',
            bottom: '3%',
            top: 80,
            containLabel: true
        },
        xAxis: [{
            type: 'value',
            scale: true, //这个一定要设，不然barWidth和bins对应不上
            data:<?php echo ($days2); ?>
        }],
        yAxis: [{
            type: 'value',
        }],
        series: [{
        	name: '账户余额（元）',
            type: 'bar',
            barWidth: '99.3%',
            label: {
              
            },
            data: consumptions,
        }] */
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);


/*每日消费统计*/
	var myChart2 = echarts.init(document.getElementById('main'));
		var consumptions_last_month = <?php echo ($consumptions_last_month); ?>;
		var consumptions_this_month = <?php echo ($consumptions_this_month); ?>;
        // 指定图表的配置项和数据
        
        
        var option2 = {
       	    title: {
       	        text: '每日消费（元）',
       	        left: 'center',
                   top: 10
       	    },
       	    tooltip : {
       	        trigger: 'axis',
       	        /* axisPointer: {
       	            type: 'cross',
       	            label: {
       	                backgroundColor: '#6a7985'
       	            }
       	        } */
       	    },
       	    legend: {
       	    	data:['上月消费','本月消费'],
                left: 'left',
       	    },
       	 	toolbox: {
	 	        show : true,
	 	        feature : {
	 	            mark : {show: true},
	 	            dataView : {show: true, readOnly: false},
	 	            magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
	 	            restore : {show: true},
	 	            saveAsImage : {show: true}
	 	        }
	 	    },
	    	calculable : true,
       	    grid: {
       	    	 left: '1%',
                 right: '3%',
                 bottom: '5%',
                 top: 80,
                 containLabel: true
       	    },
       	    xAxis : [
       	        {
   	            type : 'category',
   	            // boundaryGap : false,
   	            data:<?php echo ($days); ?>,
   	            axisLabel: {
                       interval:0,//横轴信息全部显示
                     //  rotate: 60,//60度角倾斜显示
                      
                   }
       	        }
       	        
                  
       	    ],
       	    yAxis : [
       	        {
       	        	type : 'value',
	       	        axisLabel: {
	                    formatter: '{value}元'
	                }
       	        }
       	    ],
       	    series : [
       	        {
       	        	name: '上月消费',
       	            type:'line',
       	            //areaStyle: {normal: {}},
       	            data: consumptions_last_month,
       	            symbolSize: 8,//拐点大小
                    label: {
						normal: {
							show: true,
							position: 'top'
						}
					},
					
				 /* 	markPoint : {
				 		data: [
		                    {type: 'max', name: '最大值'},
		                    {type: 'min', name: '最小值'}
		                ]
		            },  */
		            markLine : {
		                data : [
		                    {type : 'average', name : '平均值'}
		                ]
		            }
			            
       	        },
       	        {
       	        	name: '本月消费',
       	        	type:'line',
       	            //areaStyle: {normal: {}},
       	            data: consumptions_this_month,
       	            symbolSize: 8,//拐点大小
                    label: {
						normal: {
							show: true,
							position: 'top'
						}
					},
					/* markPoint : {
				 		data: [
		                    {type: 'max', name: '最大值'},
		                    {type: 'min', name: '最小值'}
		                ]
		            },  */
					markLine : {
		                data : [
		                    {type : 'average', name : '平均值'}
		                ]
		            }
       	        }
       	    ]
       	};

        // 使用刚指定的配置项和数据显示图表。
        myChart2.setOption(option2);
    
}
</script>
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
	  </li>
	 
			<!-- 排名差异  end -->
			<li class="layui-nav-item <?php if(MODULE_NAME == 'OSReport'): ?>layui-nav-itemed<?php endif; ?>">
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
<!-- 页面左侧菜单 end  -->

<!--内容区域 begin -->
<div class="ui-module">

  	<div class="ui-content" id="ui-content" style="background: #ebf1f3">
  	
  		<!-- 顶部通知提醒区域 begin -->
		<?php echo w('MyNotifyPanel', array('RootUrl'=>$RootUrl ,'skin' => 'manage' ,'users_less' => $users_less));?>   	
		<!-- 顶部通知提醒区域 end -->
  	
		<div class="home-tier-1">
			<div class="tier-1-block">
				<div class="ui-panel home-tier-1 user-general">
					<div class="personal-detail user-detail-container clearfix">
						<div class="user-avatar fl text-center">
							<img src="__PUBLIC__/img/avatar_user.png" alt="">
						</div>
						<div class="fl user-detail">
							<div class="user-detail-greetings mb20">
								<span class="username-outer text-overflow" title="<?php echo ($LoginUserName); ?>">你好，<?php echo ($LoginUserName); ?></span>
								<!-- <i class="iconfont">&#xe759;</i><i class="iconfont f20">&#xe625;</i> -->
								<span  class="usertype" ><?php echo ($LoginUserInfo['role_info']['rolename']); ?></span>
								
							</div>
							<!-- <div>
								    会员ID：{{user.UserId}}
							</div> -->
						</div>
					</div>
					<div>
					
						<div class="clearfix user-connect">
							<span class="text-muted connect-icon ">手机号码</span>
							<a class="fr" href="javascript:;"><?php echo ($LoginUserInfo['mobileno']); ?></a>
						</div>
						<div class="clearfix user-connect">
							<span class="text-muted connect-icon ">公司名称</span>
							<a class="fr" href="javascript:;"><?php echo ($LoginUserInfo['epname']); ?></a>
						</div>
					</div>
				</div>
			</div>
			<div class="tier-1-block">
				<div class="ui-panel home-tier-1 secretary-panel">
					<div class="personal-detail secretary-detail">
						<img src="__PUBLIC__/img/avatar_secretary.png" alt="">
						<!-- <i class="iconfont" style="font-size: 80px;color: #fff">&#xe639;</i> -->
						
					</div>
					<div class="secretary-operate f14">
						<div class="text-center">
							客服在线
							<span class="text-primary"><?php echo ($LoginUserInfo['customer_name']); ?></span>
						</div>
						<!-- <div class="text-center mt10">
							<span class="default-transition">
								<a href="tencent://Message/?Menu=YES&amp;Uin=735283159&amp;websiteName=im.qq.com" target="_blank" class="layui-btn layui-btn-primary" style="height: 38px; line-height: 38px;margin-left: 10px;float: left;">
									<i class="iconfont">&#xe608;</i> 735283159
								</a>
							</span>
							
							<span class="default-transition">
								<a href="tel:17717368566"  class="layui-btn layui-btn-warm"   style="height: 38px; line-height: 38px;margin-right:10px;float: right;">
								<i class="iconfont">&#xe6d6;</i> 17717368566
								</a>
							</span>
						</div> -->
						
						<div class="text-center secretary-operate-buttons">
							<a href="tencent://Message/?Menu=YES&amp;Uin=735283159&amp;websiteName=im.qq.com" target="_blank" class="layui-btn layui-btn-success" style="height: 38px; line-height: 38px; width: auto;">
								<i class="iconfont">&#xe608;</i> 735283159
							</a>
							<a href="tel:17717368566"  class="layui-btn layui-btn-warm" style="height: 38px; line-height: 38px;width: auto;"> 
								<i class="iconfont">&#xe6d6;</i> 17717368566
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="tier-1-block">
				<div class="ui-panel home-tier-1">
					
					<div class="home-panel-heading notice-panel-heading clearfix">
						<a class="fr f14 line-height-1"  href="<?php echo U('News/index');?>/open_type/blank" target="_blank">更多 &gt;&gt;</a>
						<span class="notice-title text-center fl">
							系统提示
						</span>
						 
					</div>
					<div class="notice-list-panel">
						<ul class="text-link">
							<?php if(is_array($news)): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="clearfix">
								<div class="notice-content text-overflow" style="margin-right:100px;">
									<span class="list-decoration-point">•</span>
									<a href="<?php echo U('News/detail');?>/id/<?php echo ($vo['id']); ?>/open_type/blank" target="_blank" title="<?php echo ($vo['newstitle']); ?>"><?php echo ($vo['newstitle']); ?></a>
								</div>
								<div class="fr news-time text-muted" style="width: 100px;float:right;">
									<?php echo (format_date($vo['pubtime'])); ?>
								</div>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<!-- 产品详情 begin -->
		<div class="home-tier-2">
			<div class="ui-panel">
				<div class="operate-container clearfix">
					<div class="clearfix operate-container-left">
						<div class="">
							<span class="user-operate-name"><i class="iconfont mr5 f20" style="">&#xe635;</i>今日消费：</span>
							<span class="detail-count-container">
								<?php if(!empty($products)): if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="user-balance mr10">
										<span style="color:#333;font-size: 16px;"><?php echo ($vo['product_name']); ?></span>
										<?php echo (format_money($vo["today_consumptions"])); ?> 
										<span style="font-size: 14px;">元</span>
									</span><?php endforeach; endif; else: echo "" ;endif; ?>
								<?php else: ?>
								<span class="user-balance mr10">
										<span style="color:#333;font-size: 16px;"></span>
										<?php echo (format_money($vo["today_consumptions"])); ?> 
										<span style="font-size: 14px;">元</span>
									</span><?php endif; ?>
								
							</span>
							<!-- <span class="user-operate-name"><i class="iconfont mr5 f20">&#xe615;</i>会员数量：</span>
							<span class="detail-count-container">
								<?php if(!empty($members)): if(is_array($members)): $i = 0; $__LIST__ = $members;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="user-balance mr10">
										<span style="color:#333;font-size: 16px;"><?php echo ($vo['usertype_desc']); ?></span>
										<a href="<?php echo U('Home/member');?>/usertype/<?php echo ($vo['usertype']); ?>"><?php echo (($vo["num"])?($vo["num"]):0); ?></a>
										<span style="font-size: 14px;">个</span>
									</span><?php endforeach; endif; else: echo "" ;endif; ?>
								<?php else: ?>
								<span class="user-balance mr10">
										<span style="color:#333;font-size: 16px;"></span>
										0
										<span style="font-size: 14px;">个</span>
									</span><?php endif; ?>
								
							</span> -->

							
							
							
						</div>
						
					</div>

				</div>
			</div>
		</div>
		<!-- 产品详情 end -->
	
		<!-- 账户余额区域 begin -->
		<div class="home-tier-3 " <?php if($LoginUserInfo['usertype'] !='agent' && $LoginUserInfo['usertype'] !='agent2'): ?>style="display:none;"<?php endif; ?>>
			<div class="clearfix">
				<div class="home-tier-3">
					<div class="ui-panel">
						
					    <div id="account_balance"  style="width:100%;height:437px;"></div>		   
				    	
					</div>
				</div>
			</div>
		</div>
		<!-- 账户余额区域 end -->

		<!-- 每日消费统计 begin -->
		<div class="home-tier-3 ">
			<div class="clearfix">
				<div class="home-tier-3">
					<div class="ui-panel">
						
					    
					    <div class="echarts" id="main" style="height:400px;"></div>
				    	
					</div>
				</div>
			</div>
		</div>
		<!-- 每日消费统计 end -->
		
	</div>
	
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