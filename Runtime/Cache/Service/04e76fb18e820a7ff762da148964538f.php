<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title><?php echo (($page_title)?($page_title):"搜索营销管理后台"); ?></title>
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

<!-- 引入 echarts begin -->
<script type="text/javascript" src="__PUBLIC__/js/echarts/echarts.js"></script>  
<!-- 引入 echarts end -->
<script type="text/javascript">
   $(function() {
	   layui.use(['form'], function(){
			var form = layui.form;
		   	//自定义验证规则
			form.verify({
				/* mbstatus: function(value){
		  			if($.trim(value)== ""){
		    			return '请选择管理后台状态';
		  			}
				} */
			});

			form.on('submit(go)', function(data) {
			
			});
	   	});
	   
		// 初始化echarts
		init_chart();
		$(window).resize(function () {          //当浏览器大小变化时
			init_chart();
		});
		
		
	});
	
   function init_chart(){
		// 
		var myChart = echarts.init(document.getElementById('account'));
		var pools = <?php echo ($pools); ?>;
		
	    // 指定图表的配置项和数据
	    var option = {
	    title : {
	        text: '资金池统计',
	        subtext: '资金池统计',
	        x:'center'
	    },
	    tooltip : {
	        trigger: 'item',
	        formatter: "{a} <br/>{b} : {c} ({d}%)"
	    },
	    legend: {
	        orient: 'vertical',
	        left: 'left',
	        data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
	    },
	    series : [
	        {
	            name: '访问来源',
	            type: 'pie',
	            radius : '75%',
	            center: ['50%', '60%'],
	            data:pools,
	            itemStyle: {
	                emphasis: {
	                    shadowBlur: 10,
	                    shadowOffsetX: 0,
	                    shadowColor: 'rgba(0, 0, 0, 0.5)'
	                }
	            }
	        }
	    	]
		};
	
	    
	    option = {
    	    backgroundColor: '#48a7c2',

    	    title: {
    	        text: '资金池统计',
    	        left: 'center',
    	        top: 20,
    	        textStyle: {
    	            color: '#fff'
    	        }
    	    },

    	    tooltip : {
    	        trigger: 'item',
    	        formatter: "{a} <br/>{b} : {c} ({d}%)"
    	    },

    	    visualMap: {
    	        show: false,
    	        min: 1000,
    	        max: 200000,
    	        inRange: {
    	            colorLightness: [0, 1]
    	        }
    	    },
    	    series : [
    	        {
    	            name:'资金池统计',
    	            type:'pie',
    	            radius : '65%',
    	            center: ['50%', '50%'],
    	            data:pools.sort(function (a, b) { return a.value - b.value; }),
    	            roseType: 'radius',
    	            label: {
    	                normal: {
    	                    textStyle: {
    	                        color: '#ffffff'
    	                    }
    	                }
    	            },
    	            labelLine: {
    	                normal: {
    	                    lineStyle: {
    	                        color: 'rgba(255, 255, 255, 1)'
    	                    },
    	                    smooth: 0.2,
    	                    length: 10,
    	                    length2: 20
    	                }
    	            },
    	            itemStyle: {
    	                normal: {
    	                    color: '#ff9900',
    	                    shadowBlur: 200,
    	                    shadowColor: 'rgba(0, 0, 0, 0.5)'
    	                }
    	            },

    	            animationType: 'scale',
    	            animationEasing: 'elasticOut',
    	            animationDelay: function (idx) {
    	                return Math.random() * 200;
    	            }
    	        }
    	    ]
    	};

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
}	
</script>
   
   
</head>

<body>
    <!-- 页面顶部 logo & 菜单 begin -->
    
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
    <!-- 页面顶部 logo & 菜单 end -->
    <!-- 页面左侧菜单 begin -->
    <!--menu 左侧菜单 begin-->
<nav class="ui-menu">
	<ul class="layui-nav layui-nav-tree" lay-filter="menu">
		
		<li class="layui-nav-item <?php if(MODULE_NAME == 'Home' && ACTION_NAME == 'home'): ?>layui-nav-itemed<?php endif; ?>">
			<a href="<?php echo U('Service/Home/home');?>"><i class="iconfont">&#xe60a;</i>我的桌面</a>
		</li>
		
		

		<li class="layui-nav-item <?php if(MODULE_NAME == 'Index' && ACTION_NAME == 'index'): ?>layui-nav-itemed<?php endif; ?>">
			<a href="<?php echo U('Index/index');?>"><i class="iconfont">&#xe60a;</i>效果监控</a>
		</li>
		
		
		

		<li class="layui-nav-item <?php if(( MODULE_NAME == 'Keyword' && (ACTION_NAME == 'search' || ACTION_NAME == 'effect' ) ) OR ( MODULE_NAME == 'Cart' && ACTION_NAME == 'index') || (MODULE_NAME == 'Site' && ACTION_NAME == 'effect' ) || (MODULE_NAME == 'Site' && ACTION_NAME == 'index' )): ?>layui-nav-itemed<?php endif; ?>">
			<a href="javascript:;"><i class="iconfont">&#xe612;</i>优化中心</a>
			<dl class="layui-nav-child">
				<dd <?php if(MODULE_NAME == 'Site' && ACTION_NAME == 'index'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('Site/index');?>">我的站点<?php if(($untreated_workorder_num) > "0"): ?><span class="badge"><?php echo ($untreated_workorder_num); ?></span><?php endif; ?></a>
				</dd>
				<dd <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'search'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('Keyword/search');?>">关键词查询</a>
				</dd>
				<dd <?php if(MODULE_NAME == 'Cart' && ACTION_NAME == 'index'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('Cart/index');?>">关键词清单</a>
				</dd>
				<dd <?php if(MODULE_NAME == 'Site' && ACTION_NAME == 'effect'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('Site/effect');?>">站点监控</a>
				</dd>
				<dd <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'effect'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('Keyword/effect');?>">关键词排名</a>
				</dd>
			</dl>
		</li>
		
		<li class="layui-nav-item <?php if(MODULE_NAME == 'Finance'): ?>layui-nav-itemed<?php endif; ?>">
			<a href="javascript:;"><i class="iconfont">&#xe63d;</i>我的钱包</a>
			<dl class="layui-nav-child">
				<dd <?php if(MODULE_NAME == 'Finance' && ACTION_NAME == 'pool'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('Finance/pool');?>">资金池管理</a>
				</dd>
				<dd <?php if(MODULE_NAME == 'Finance' && ACTION_NAME == 'details'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('Finance/details');?>">财务明细</a>
				</dd>
			</dl>
				</li>
	
		<li class="layui-nav-item <?php if(MODULE_NAME == 'User'): ?>layui-nav-itemed<?php endif; ?>">
			<a href="javascript:;"><i class="iconfont">&#xe66a;</i>安全中心</a>
			<dl class="layui-nav-child">
				
				<dd <?php if(MODULE_NAME == 'User' && ACTION_NAME == 'updatePage'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('User/updatePage');?>">基本信息</a>
				</dd>
				<dd <?php if(MODULE_NAME == 'User' && ACTION_NAME == 'updatePasswordPage'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('User/updatePasswordPage');?>">修改密码</a>
				</dd>
			</dl>
		</li>

	</ul>
	
</nav>
<!--menu 左侧菜单 end-->
<script type="text/javascript">
  layui.use(['element'], function () {
    var element = layui.element
    
    window.$ = layui.jquery;
    // 监听导航点击
    element.on('nav(menu)', function (elem) {
      var mUrl = elem.attr('dx-menu');
      !_.isEmpty(mUrl) && _route.go(mUrl);
    });
  });
</script>






    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
       
        <!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="<?php echo U('Index/index');?>"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>资金池管理</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        
        
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	 
        	
	        	<blockquote class="layui-elem-quote">
                    资金池总额: <span><?php echo (format_money($data['totalfunds'])); ?>元</span>
                    资金池余额: <span><?php echo (format_money($data['balancefunds'])); ?>元</span>
                    资金池可用余额: <span><?php echo (format_money($data['availablefunds'])); ?>元</span>
                    资金池消费金额: <span><?php echo (format_money($data['consumptionfunds'])); ?>元</span>
                    资金池剩余冻结金额: <span><?php echo (format_money($data['freezefunds'])); ?>元</span>
                </blockquote>
	            <!-- 账户余额区域 begin -->
				    <div id="account"  style="height:510px;padding: 10px;"></div>		   
			    	<!-- 账户余额区域 end -->
			</div> 
        </div>
    </div>
    <!-- 页面底部 begin -->
    <div class="clear"> </div>

<div class="footer mt20" style="display: none;">
	<!-- <div class="ftleft">
		<p class="fl">
			<a href="/faq">常见问题</a> | <a href="/about">关于我们</a> | <a
				href="/contacts">联系我们</a> | <a href="/cooperation">商务合作</a>| <a
				href="#">网站地图</a> | <a href="/privacy">隐私申明</a> <br>
			400客服电话：400-902-8550 地址：上海市闵行区陈行公路2388号浦江科技广场5号楼5楼<br>
			推送者关键词快速排名系统-上海优槃网络科技有限公司旗下网站 <a href="http://www.miitbeian.gov.cn"
				target="_blank">沪ICP备16031230号-2</a>
		</p>
		<a href="/"><img src="/front/images/logo_white.png" alt=""
			class="fr"></a>
	</div> -->
</div>

    <!-- 页面底部 end -->
</body>
</html>