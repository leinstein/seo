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

<!-- tips插件 begin -->
<link rel="stylesheet" href="../Public/css/tipso.min.css">
<script type="text/javascript" src="../Public/js/tipso.min.js"></script>
<!-- tips插件 end -->

<!-- 引入 echarts begin -->
<script type="text/javascript" src="__PUBLIC__/js/echarts/echarts.js"></script>  
<!-- 引入 echarts end -->

<link rel="stylesheet" href="__PUBLIC__/css/index.css">

<script type="text/javascript">
	$(function() {
		
		// 隐藏父页面的加载进度层
		$('#loading_iframe', parent.document).hide();
		
		// 初始化echarts
		init_chart();
		$(window).resize(function () {          //当浏览器大小变化时
			init_chart();
		});
		
        // 提示弹出初始化
		$('.tip').tipso({

			position : 'top',
			useTitle: false

		});
	});
	
	function init_chart(){
        
	}
	
	var hints = <?php echo ($hints); ?>;
	var hint_str ="";
	for (hint in hints){
		hint_str += hints[hint]  +'<br>';
	    
	}
	if( "<?php echo ($show_hint); ?>" == 1 ){
		var src ="<?php echo U('Service/Home/show_trips');?>/hint_str/" + encodeURIComponent( hint_str );
		layer_tips_right("温馨提示",src);
	}
	// 判断是否有新的消息
	//var untreated_workorder_num = "<?php echo ($untreated_workorder_num); ?>";
	//if( untreated_workorder_num > 0  && "<?php echo ($_GET['tag']); ?>" == 1){
	///	var src ="<?php echo U('Service/Home/show_trips');?>";
		//window.location.href= src;
	//	layer_tips_right("温馨提示",src);
	//}
	
	</script>
	<style>
	
	
	</style>
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






<!-- 页面左侧菜单 end  -->

<!--内容区域 begin -->
<div class="ui-module">

  	<div class="ui-content" id="ui-content" style="background: #ebf1f3">
  
	  	<!-- 顶部通知提醒区域 begin -->
		<?php echo w('MyNotifyPanel', array('RootUrl'=>$RootUrl , 'is_show_layer_tips_right' => 1 ));?>   	
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
								<span class="usertype" >普通用户</span>
							</div>
							<div>
								    会员ID：<?php echo ($LoginUserId); ?>
							</div>
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
					</div>
					<div class="secretary-operate f14">
						<div class="text-center">
							专属客服
							<span class="text-primary"><?php echo ($LoginUserInfo['oem_config']['customer']); ?></span>
						</div>
						<!-- <div class="text-center mt10">
							<span class="default-transition">
								<a href="tencent://Message/?Menu=YES&amp;Uin=<?php echo (($LoginUserInfo['oem_config']['QQnumber'])?($LoginUserInfo['oem_config']['QQnumber']):'735283159'); ?>&amp;websiteName=im.qq.com" target="_blank" class="layui-btn layui-btn-normal" style="height: 38px; line-height: 38px;margin-left: 0;margin-right: 10px;">
									<i class="iconfont">&#xe608;</i> <?php echo (($LoginUserInfo['oem_config']['QQnumber'])?($LoginUserInfo['oem_config']['QQnumber']):'735283159'); ?>
								</a>
							</span>
							
							<span class="default-transition">
								<a href="tel:<?php echo (($LoginUserInfo['oem_config']['telephone'])?($LoginUserInfo['oem_config']['telephone']):'17717368566'); ?>"  class="layui-btn layui-btn-warm"    style="height: 38px; line-height: 38px;margin-left: 0;margin-right: 10px;">
									<i class="iconfont">&#xe6d6;</i> <?php echo (($LoginUserInfo['oem_config']['telephone'])?($LoginUserInfo['oem_config']['telephone']):'17717368566'); ?>
								</a>
								<a href="tel:<?php echo (($LoginUserInfo['oem_config']['telephone'])?($LoginUserInfo['oem_config']['telephone']):'17717368566'); ?>"   class="sq-btn btn-primary btn-reverse secretary-feedback">
									<i class="iconfont">&#xe6d6;</i> <?php echo (($LoginUserInfo['oem_config']['telephone'])?($LoginUserInfo['oem_config']['telephone']):'17717368566'); ?>
								</a>
							</span>
						</div> -->
						
						<div class="text-center secretary-operate-buttons">
							<a href="tencent://Message/?Menu=YES&amp;Uin=<?php echo (($LoginUserInfo['oem_config']['QQnumber'])?($LoginUserInfo['oem_config']['QQnumber']):'735283159'); ?>&amp;websiteName=im.qq.com" target="_blank" class="layui-btn layui-btn-normal" style="height: 38px; line-height: 38px;width: auto;">
								<i class="iconfont">&#xe608;</i> <?php echo (($LoginUserInfo['oem_config']['QQnumber'])?($LoginUserInfo['oem_config']['QQnumber']):'735283159'); ?>
							</a>
							<a href="tel:<?php echo (($LoginUserInfo['oem_config']['telephone'])?($LoginUserInfo['oem_config']['telephone']):'17717368566'); ?>"  class="layui-btn layui-btn-warm"    style="height: 38px; line-height: 38px;width: auto;">
								<i class="iconfont">&#xe6d6;</i> <?php echo (($LoginUserInfo['oem_config']['telephone'])?($LoginUserInfo['oem_config']['telephone']):'17717368566'); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="tier-1-block">
				<div class="ui-panel home-tier-1">
					
					<div class="home-panel-heading notice-panel-heading clearfix">
						<a class="fr f14 line-height-1"  href="<?php echo U('News/index');?>" target="_blank">更多 &gt;&gt;</a>
						<span class="notice-title text-center fl">
							系统公告
						</span>
						 
					</div>
					<div class="notice-list-panel">
						<ul class="text-link">
							<?php if(is_array($news)): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; switch($vo["newstype"]): case "notice": $pre = '【公告】'; break;?>
							    <?php case "protocol": $pre = '【协议】'; break;?>
							    <?php default: $pre = ''; endswitch;?>
							<li class="clearfix">
								<span class="notice-content text-overflow">
									<span class="list-decoration-point">•</span>
									<a href="<?php echo U('News/detail');?>/id/<?php echo ($vo['id']); ?>/open_type/blank" target="_blank" title="<?php echo ($vo['newstitle']); ?>"><?php echo ($pre); echo ($vo['newstitle']); ?></a>
								</span>
								<span class="fr news-time text-muted">
									<?php echo (format_date($vo['pubtime'])); ?>
								</span>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		
		<!-- 产品与服务 begin -->
		<div class="home-tier-3">
			<div class="clearfix">
				<div class="home-tier-3">
					<div class="ui-panel">
						<div class="home-panel-heading">产品与服务</div>
						<div class="clearfix products-detail-panel clearfix">
							<ul class="user-wo-lists text-link">
								<li class="clearfix">
									<span class="fl user-detail-item b" style="width: 10%;">
										产品
									</span>
									<span class="fl b">
											产品概况
									</span>
								</li>
								<?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><li>
									<div class="clearfix">
										<span class="fl user-detail-item " style="width: 10%">
											<?php echo ($vo1['product_name']); ?>
										</span>
										<span class="fl">
											<?php switch($vo1["id"]): case "1": ?><!-- 优站宝产品 -->
											    	站点数：<?php echo (($vo1["siteNum"])?($vo1["siteNum"]): 0); ?>、<?php break;?>
											    <?php case "2": ?><!-- 快排宝产品 -->
											    	计划数：<?php echo (($vo1["plnaNum"])?($vo1["plnaNum"]): 0); ?>、<?php break;?>									   
											    <?php default: endswitch;?>
											关键词数：<?php echo (($vo1["purchasedKeywordNum"])?($vo1["purchasedKeywordNum"]): 0); ?>、
											最新达标数：<?php echo (($vo1["stankeywordNum"])?($vo1["stankeywordNum"]): 0); ?>、
											最新达标消费：<?php echo (format_money($vo1["standardsFee"])); ?> 元、
											累计消费：<?php echo (format_money($vo1["consumption"])); ?> 元、
											可用余额：<?php echo (format_money($vo1['funds_pool']['availablefunds'])); ?> 元、
											产品余额：<?php echo (format_money($vo1['funds_pool']['balancefunds'])); ?> 元
										</span>
									</div>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 产品与服务 end -->
	</div>
</div>
<!-- 页面底部 begin  -->
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

<!-- 页面底部 end  -->
</body>
</html>