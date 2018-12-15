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

   
<script type="text/javascript">
$(function() {
	layui.use(['form'], function(){
	  var $ = layui.jquery, form = layui.form;
	  //全选
	  form.on('checkbox(allChoose)', function(data){
	    var child = $(data.elem).parents('table').find('input[type="checkbox"]');
	    child.each(function(index, item){
	      item.checked = data.elem.checked;
	    });
	    form.render('checkbox');
	  });
	  
	  form.on('checkbox', function(data){
		 // console.log(data.elem.checked);
		});
	  
	});
});

function buy(id) {
	 
    var siteid = $("#url" + id ).val(); 
    
    if (siteid == "") {
    
    	layer_alert('请先选择一个网址，再进行购买');
		return false;
    }
    
    layer_confirm('您确定购买该关键词？',function(){ 
    	var url = "__URL__/buy/type/ajax/id/" + id + "/siteid/" + siteid + "/request_type/ajax";
      	// window.location.href= url;return false;
    	$.ajax({
            type: "get",
            url: url,
            dataType: "json",
            success: function ( result ) {
            	if( result.status == 1 ){
            		
                    $("#dd" + id).remove();
            	}else{
            		layer_alert(result.info );
            	}   
            }
        }) 
    })
 
}

function buyBatch() {


 var siteid = $("#url").val();
    
	if ( siteid == "") {
	    layer_alert('关联网址不能为空');
	    return false;
	}
	
	//获取选中的关键词
	var ids = getChecked( 'layui' );
	if ( ids == "" || ids == 0 ) {
	    layer_alert('请您选择关键词');
	    return false;
	}
	
	layer_confirm('您确定购买选中的关键词？', function(){ 
	   var url = "__URL__/buy/type/ajax/id/" + ids + "/siteid/" + siteid + "/request_type/ajax"
	  	//window.location.href= url;return false;
	 	$.ajax({
	         type: "get",
	         url: url,
	         dataType: "json",
	         success: function ( result ) {
	         	
	         	if( result.status == 1 ){
	         		layer_msg('购买成功');
	                // var id_arr=ids.split(","); //字符分割 
	                var success 	= result.success;
	        		var fail 		= result.fail;
	        		var fail_ids 	= result.fail_ids; 
	        		if( fail > 0 ){
	        			layer_msg("购买成功，有" + fail +"个关键词已经购买过"); 
	        		}else{
	        			layer_msg("购买成功！"); 
	        		}
	        		
	        		var new_ids =  _.difference(ids, fail_ids);
	        		
	                for (i=0;i<new_ids.length ;i++ ) { 
	                	$("#dd" + new_ids[i]).remove();
	                } 
	         	}else{
	         		layer_alert(result.info);
	         	}
	      
	         }
	     }) 
	});

}
/**
* 刪除關鍵詞
*/
function del( id ){

layer_confirm('关键词删除后不可恢复，您确定删除？', function(){ 
	   var url = "__URL__/delete/type/ajax/id/"+ id + "/request_type/ajax";
   	//window.location.href= url;return false;
  	$.ajax({
          type: "get",
          url: url,
          dataType: "json",
          success: function ( result ) {
          	
          	if( result.status == 1 ){
          		layer_msg('刪除成功');
                $("#dd" + id).remove();
          	}else{
          		layer_alert(result.info);
          	}	              
          }
      }) 
});

}

function deleteBatch() {
//获取选中的关键词
var ids = getChecked( 'layui' );
 if ( ids == "" || ids == 0 ) {
      layer_alert("请您选择关键词");
      return false;
  }
 layer_confirm('关键词删除后不可恢复，您确定删除？', function(){ 

	var url = "__URL__/delete/type/ajax/id/"+ ids + "/request_type/ajax";
   	//window.location.href= url;return false;
  	$.ajax({
          type: "get",
          url: url,
          dataType: "json",
          success: function ( result ) {
          	
          	if( result.status == 1 ){
          		layer_msg('刪除成功');
	                // var id_arr=ids.split(","); //字符分割 
                  for (i=0;i<ids.length ;i++ ) { 
                  	 $("#dd" + ids[i]).remove();
                  } 
          	}else{
          		layer_alert(result.info);
          	}
       
             
          }
      }) 
      

 });

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
		  <a href="<?php echo U('Index/index');?>"><i class="iconfont">&#xe60a;</i><?php echo (($LoginUserInfo['oem_config']['product_name'])?($LoginUserInfo['oem_config']['product_name']):'网站优化'); ?><span class="layui-box">&gt;</span></a>
		  <a><cite>关键词清单</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	 
				<form name="form2" id="form2" action="<?php echo U('buy');?>" method="post" class="layui-form">		
					<table class="layui-table">
					  	<thead>
						    <tr>
						    	<th width="50"><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
						      	<th width="100">ID</th>
								<th>关键词</th>
								<th>选择网址</th>
								<th>搜索引擎</th>
								<!--<th>购买天数</th>-->
								<th>日期</th>
								<th>单价</th>
								<th width="100">操作</th>
						    </tr> 
					  	</thead>
				  		<tbody>
					  		<?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="dd<?php echo ($vo['id']); ?>">
								<td>
									<input type="checkbox" id="id_<?php echo ($vo['id']); ?>" name="id[]" value="<?php echo ($vo['id']); ?>" lay-skin="primary" style="vertical-align: text-bottom;margin-top: 2px;">
								</td>
								<td><?php echo ($vo['id']); ?></td>
								<td><?php echo ($vo['keyword']); ?></td>
								<td>
									<select id="url<?php echo ($vo['id']); ?>" name="url" onchange="" ondblclick="" class="form-control input-sm" lay-verify="" lay-filter="" readonly="" ><option value="" >请选择</option><?php  foreach($sitesOptions as $key=>$val) { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } ?></select>
								</td>
								<td><?php echo ($vo['searchengine_ZH']); ?></td>
								<td><?php echo ($vo['createtime']); ?></td>
								<td><?php echo (format_money($vo['price'])); echo ($vo['unit']); ?>/<?php echo ($vo['unit2']); ?></td>
								<td>
									<input type="button" class="layui-btn layui-btn-mini" onclick="buy(<?php echo ($vo['id']); ?>);" value="购买">
									<input type="button" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del(<?php echo ($vo['id']); ?>);" value="删除">
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							
	
							<?php else: ?>
							<tr>
								<td colspan="7">暂无相关数据</td>
							</tr><?php endif; ?>
					  	</tbody>
					  	<tfoot>
					  		<tr>
								<td colspan="2" align="left" style="text-align: left;padding-left: 22px !important;">
									<input id="checkAll" type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" title="全选/反选">
								</td>
								<td colspan="3" align="left" style="padding: 5px;">
									<select id="url" name="url" onchange="" ondblclick="" class="input-sm" lay-verify="" lay-filter="" readonly="" ><option value="" >批量购买请选择网址</option><?php  foreach($sitesOptions as $key=>$val) { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } ?></select>
								</td>
								<td colspan="3" align="left" style="padding: 5px;">
									<input class="layui-btn" type="button" name="btn4" value="批量购买" onclick="buyBatch()">
									<input class="layui-btn layui-btn-danger" type="button" name="btn4" value="批量删除" onclick="deleteBatch()">
									
								</td>
							</tr>
						</tfoot>
					</table>
				
				</form>
					
				<blockquote class="layui-elem-quote mt20">
					<p class="b">购买须知：</p>
					<p>1. 为了确保关键词效果，系统将按照站点下所购买关键词30天的达标费用作为预付款进行冻结，冻结资金依然在您的账户中，但无法再次购买其他关键词；</p>
					<p>2. 关键词达标后按天计费，费用从预付款中进行扣除，预付款消耗完毕，关键词达标费用将从账号余额中扣除；</p>
					<p>3. 关键词达标后90天内不得停止优化。</p>
					<p>更多服务条款，请阅读
					<?php if(!empty($news)): ?><a href="<?php echo U('News/detail');?>/id/<?php echo ($news['id']); ?>/open_type/blank" target="_blank">《<?php echo ($news['newstitle']); ?>》</a>
					<?php else: ?>
						<a href="<?php echo U('News/detail');?>/id/2/open_type/blank" target="_blank">《网站优化服务条款》</a><?php endif; ?>
					</p>
				</blockquote>
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