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

<link rel="stylesheet" href="../Public/css/keyword_add.css">

<!-- jquery.flexText begin -->
<script type="text/javascript" src="__PUBLIC__/js/jquery.flexText/jquery.flexText.min.js"></script>
<!-- jquery.flexText end -->
<link rel="stylesheet" href="__PUBLIC__/js/jquery.flexText/jquery.flexText.style.css">
   
    <script>
	$(function() {
		
		$('textarea').flexText();
		
		// 如果關鍵詞，就進行後台ajax搜索
        if( "<?php echo ($keywords); ?>"){
			var url = "__URL__/searchRecommend/keywords/<?php echo ($keywords); ?>/request_type/ajax";
			$.ajax({url: url,
				dataType: 'json',
    			success: function(data){
    				// 隐藏加载狂
					$('.progress').hide();
    				// 如果返回的结果又值
    				if( data ){
	    				
						var total = data.length;
						var html ="";
						for(i=0;i<total;i++){
							 html += '<a href="javascript:;" class="btn btn-default" mark="1'+i+'">'+data[i]["keyword"]+'</a>&nbsp;';
								var klist = '<tr class="hidden1" id="tr1'+i+'">';
								klist += '<td >'+data[i]["keyword"]+'</td>';
								klist +='<td class="text-center keyword_price price_pc">'+data[i]["baidu"]+'元/天</td>';
								klist +='<td class="text-center keyword_price price_yidong">'+data[i]["baidu_mobile"]+'元/天</td>';
								klist +='<td class="text-center keyword_price price_360 ">'+data[i]["360"]+'元/天</td>';
								klist +='<td class="text-center keyword_price price_sougou ">'+data[i]["sougou"]+'元/天</td>';
								klist +='<td class="text-center keyword_price price_shenma ">'+data[i]["shenma"]+'元/天</td>';
								/* klist +='<td class="text-center"><a href="__URL__/doAdd/keyword/'+data[i]["keyword"]+'/keywords/{$keywords}/type/11000/pricestr/'+data[i]["baidu"] +','+data[i]["baidu_mobile"] +'" class="layui-btn layui-btn-mini" type=11000>加入清单</a><a mark="1'+i+'" onclick="rm(this)" class="layui-btn layui-btn-danger layui-btn-mini">移出</a></td>'; */
								
								// 加上难度指数和优化周期
								klist +='<td class="text-center">'+data[i]["rate"]+'</td>';
								klist +='<td class="text-center">'+data[i]["optimization_cycle"]+'</td>';
	
								klist +='</tr>';
	                       		$("#tablelist").append(klist);
	                     }
						
						$("#show_recommend").html(html);
					}  else{
						$("#show_recommend").html('<div class="alert alert-warning" role="alert">未能获取到相关推荐关键词！</div>');
					}
    			}
			});  
		}
	
	    $('.recommend .btn').click(checked);
	    
	 
	    $('#recommend').on('click', 'a',
		    function() {
		        if (this.className.indexOf('checked') > 0) {
		            $(this).removeClass('checked');
		            var k = $(this).attr("mark");
		            $("#tr" + k).addClass("hidden1");
		            $("#tr" + k).find("input:checkbox").prop("checked", false);
	
		        } else {
		            $(this).addClass('checked');
		            var k = $(this).attr("mark");
		            $("#tr" + k).removeClass("hidden1");
		            $("#tr" + k).find("input:checkbox").prop("checked", true);
		        }
		    });
	
	});
	
	//
	function checked() {
	    var keyword_checked = $(this).parents('tr').find('.keyword').get(0).checked;
	    if (!keyword_checked) {
	        $(this).removeClass('checked');
	    } else {
	        $(this).addClass('checked');
	    }
	
	    $('.list tbody tr').each(function() {
	        var kstr = "";
	        var pricestr="";
	        var kw = $(this).find('input:checkbox').val();
	        $(this).find('td').each(function(i,e) {
	        	var price ="";
	        	if($(e).hasClass('keyword_price')){
	        		price = $(e).find(':hidden').val()
	        	}
	 
	            if ($(this).hasClass('checked')) {
	                kstr += '1';
	                if($(e).hasClass('keyword_price')){
		                if(pricestr){
		                	pricestr +=  "," + price;
		                }else{
		                	pricestr +=   price;
		                }
	                }
	                
	            } else {
	                kstr += '0';
	                if($(e).hasClass('keyword_price')){
		                if(pricestr){
		                	pricestr +=  ",0";
		                }else{
		                	pricestr +=   "0";
		                }
	                }
	            }
	        });
	        kstr = kstr.substr(1, 5);
	        if (kw != undefined) {
	            $(this).find('a:eq(0)').attr('href', '__URL__/doAdd/keyword/' + kw.substr(0, kw.indexOf('::')) + '/keywords/<?php echo ($keywords); ?>/type/' + kstr + '/pricestr/' + pricestr);
	            $(this).find(':checkbox').val(kw.substr(0, kw.indexOf('::')) + '::' + kstr + '::' + pricestr);
	        }
	
	    });
	}
	
	
</script>
<style type="text/css">
.list td, .list th {
    /* padding: 5px; */
    vertical-align: middle;
    text-align: center;
}
.list th, .list td {
    border: 1px solid #eee;
}
.list td, .list {
    font-size: 13px;
}
.list td, .list th {
    padding: 9px 15px;
    min-height: 20px;
    line-height: 20px;
    border: 1px solid #e2e2e2;
    font-size: 14px;
}
</style>
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
  		<?php if(($LoginUserName) != "排名统计"): ?><!-- 产品首页 begin -->
	 	<li class="layui-nav-item <?php if(MODULE_NAME == 'Index' && ACTION_NAME == 'index'): ?>layui-nav-itemed<?php endif; ?>">
	      <a href="<?php echo U('Index/index');?>">
	        <i class="iconfont f18">&#xe60a;</i><span class="menu-title">产品首页</span>
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
		        <dd <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'effect'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo U('Keyword/effect');?>">关键词效果监测</a></dd>
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
	  <?php if(($LoginUserInfo["usertype"]) != "operation"): ?><li class="operation layui-nav-item <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'different'): ?>layui-nav-itemed<?php endif; ?>">
          <a href="<?php echo U('Keyword/different');?>">
            <i class="iconfont f18">&#xe62c;</i><span class="menu-title">排名差异</span>
          </a>
		  </li>

        <!-- 排名差异 <?php echo $LoginUserInfo['usertype']; ?> end -->

        <li class="operation layui-nav-item <?php if(MODULE_NAME == 'OSReport'): endif; ?>">
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
		  <a><cite>关键词查询</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	 
		        	<!-- <div class="ddtishi">
	                    <h5>添加任务必读</h5>
	                    <p>推送者快排服务的前提是：<strong>你提供的关键词对应网址的排名已经在百度前十页</strong>，非前十页我们暂时无法优化；排名任务一般7~20天见效，<strong>不到首页不收取任务报价费用</strong>。但是由于部分网站可能由于自身服务器站内内容频繁更改等原因造成排名失败，而且每个任务都需要人力资源去维护，因此，<strong>20天内还未进入首页的关键词任务我们将自动关闭，并扣除20推币作为基础优化费用</strong>。<br> 推送者快速排名可以促进排名提升，时间越久排名越靠前，如到首页一段时间后停止使用，排名很有可能下降，再次恢复难度较大，请及时关注关键词是否需续费。<br> 提交任务相关详细技巧请查看《<strong><a href="/training">快排培训</a></strong>》栏目。</p>
	                </div>
					 -->
					<form id="form1" class="form-horizontal" action="" class="layui-form layui-form-pane">
						<input type="hidden" name="m" value="<?php echo (MODULE_NAME); ?>" /> 
						<input type="hidden" name="a" value="search" />
						<input type="hidden" name="g" value="<?php echo (GROUP_NAME); ?>" />
						<style>
						    .form-group{
						    	margin-left: 10px !important;
						    	margin-right: 10px;
						    }
   						</style>
   						
   						
   						
   						<div class="layui-form-item layui-form-text">
							<div class="layui-input-block" style="margin-left: 0px">
								<textarea class="layui-textarea" style="overflow:hidden; " placeholder="支持多个关键词查询，每个关键词用回车隔开" name="kws"><?php echo ($kws); ?></textarea>
							</div>
						</div>
						
						<div class="layui-form-item" style="margin-top: 70px;">
							<div class="layui-input-block" style="margin-left: 0">
								<input type="submit" value="查询关键词" class="layui-btn">
							</div>
						</div>


						<!-- <div class="form-group">
							<label style="font-weight: normal; color: #f00">注：购买关键词之前请认真阅读
								<a target="_blank" href="/help_article.php?id=44">《<?php echo (($LoginUserInfo['oem_config']['product_name'])?($LoginUserInfo['oem_config']['product_name']):'优站宝'); ?>服务协议》</a>
							</label>
						</div> -->
					</form>
					
					<!-- 查询结果 begin -->
					<div id="search" <?php if(empty($list)): ?>style="display: none;"<?php endif; ?>>

					<div class="panel tuijian_box" style="background-color: #f2f2f2; margin-bottom: 0;">
						<div class="panel-heading">
							<h3 class="panel-title pull-left" style="line-height: 1.5">
							<i class="iconfont">&#xe634;</i>
								系统为您推荐的词
							</h3>
						</div>
						<div class="panel-body" id="recommend">
							
							<!-- 加载进度 begin -->
							<!-- <div class="progress">
						      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only">45% Complete</span></div>
						    </div> -->
						    <div class="progress" style="margin: 0 auto;text-align: center;padding: 0 20px 20px 20px;">
						    	<img class="progress-img" alt="" src="__PUBLIC__/img/laoding.gif">
						    	<div class="progress-text mt10">系统正在为你查询相关推荐的关键词</div>
						  	  	
						    </div>
							<!-- 加载进度 end -->

							<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; if(($vo1["isrecommend"]) == "1"): ?><a href="javascript:;" class="btn btn-default" mark="<?php echo ($key); ?>"><?php echo ($vo1['keyword']); ?></a>&nbsp;<?php endif; endforeach; endif; else: echo "" ;endif; ?>
							<div id="show_recommend">
								<!--<div class="alert alert-success" role="alert">...</div>
								<div class="alert alert-info" role="alert">...</div> 
								<div class="alert alert-warning" role="alert">未能获取到相关推荐关键词！</div>
								<div class="alert alert-danger" role="alert">...</div> -->
							</div>
						</div>
					</div>
								
					<div class="panel-heading" style="padding-bottom: 20px;padding-top: 20px;">
					
						<h3 class="panel-title pull-left" style="line-height: 1.5">
							<i class="iconfont">&#xe686;</i>关键词清单</h3>
					</div>
					<form name="form2" id="form2" action="__URL__/doAdd" method="post" class="table-responsive" >
						<input type="hidden" name="keywords" value="<?php echo ($keywords); ?>">
						<table id="tablelist" class="list" style="width: 100%;">
							<tbody>
								<tr style="background-color: #e5e6e7;font-weight: bold;">
									<td>关键词</td>
									<td class="text-center key_pc"><img alt="" src="__PUBLIC__/img/baidu.png" style="width: 100px;"></td>
									<td class="text-center key_yidong"><img alt="" src="__PUBLIC__/img/baidu_mobile.png" style="width: 100px;"></td>
									<td class="text-center key_360"><img alt="" src="__PUBLIC__/img/360.png" style="width: 100px;"></td>
									<td class="text-center key_sougou"><img alt="" src="__PUBLIC__/img/sougou.png" style="width: 100px;"></td>
									<td class="text-center key_shenma"><img alt="" src="__PUBLIC__/img/shenma.png" style="width: 100px;"></td>
									<td class="text-center" width="100px">难度指数</td>
									<td class="text-center" width="60px">优化周期</td>
									
								</tr>
								<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr <?php if(($vo['isrecommend']) == "1"): ?>class="hidden1"<?php endif; ?> id="tr<?php echo ($key); ?>">
									<td>
										<?php echo ($vo['keyword']); ?>
									</td>
									<td class="text-center keyword_price price_pc ">
										<?php echo ($vo['baidu']); ?>元/天
										<input type="hidden"  value="<?php echo ($vo['baidu']); ?>">
									</td>
									<td class="text-center keyword_price price_yidong ">
										<?php echo ($vo['baidu_mobile']); ?>元/天
										<input type="hidden"  value="<?php echo ($vo['baidu_mobile']); ?>">
									</td>
									<td class="text-center keyword_price price_360 ">
										<?php echo ($vo['360']); ?>元/天
										<input type="hidden"   value="<?php echo ($vo['360']); ?>">
									</td>
									<td class="text-center keyword_price price_sougou ">
										<?php echo ($vo['sougou']); ?>元/天
										<input type="hidden"  value="<?php echo ($vo['sougou']); ?>">
									</td>
									<td class="text-center keyword_price price_shenma ">
										<?php echo ($vo['shenma']); ?>元/天
										<input type="hidden"  value="<?php echo ($vo['shenma']); ?>">
									</td>
									<td class="text-center">
										<?php echo ($vo['rate']); ?>
									</td>
									<td class="text-center">
										<?php echo ($vo['optimization_cycle']); ?>
									</td>
									
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>

							</tbody>
						</table>
						
						

					</form>
					
					
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
</html>