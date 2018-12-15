<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<?php $page_title = "关键词审核"; ?>
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


<script>
	$(function() {
		layui.use(['form'], function() {
			var form = layui.form;
			var ks = "";
			//自定义验证规则
			form.verify({
				
				keywordstatus: function(value){
					
			  		if( $.trim(value)== ""){
			    		return '请选择关键词状态';
			  		}
			  		ks = $.trim(value);
				},
				
			});

			form.on('submit(go)', function(data) {
			});
		});
	});
</script>
</head>

<body>
<div class="layui-tab-content">
	<form name="form" action="<?php echo U('unfreeze');?>" method="post" class="layui-form">
		<input type="hidden" name="id" value="<?php echo ($data['id']); ?>">
		<input type="hidden" name="returnUrl" value="<?php echo ($_GET['returnUrl']); ?>">
		
		<div class="layui-form-item">
			<label class="layui-form-label">关键词</label>
			<div class="layui-input-block">
				<input type="text" value="<?php echo ($data['keyword']); ?>" readonly="readonly" class="layui-input">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">网址</label>
			<div class="layui-input-block">
				<input type="text" value="<?php echo ($data['website']); ?>" readonly="readonly" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">搜索引擎</label>
			<div class="layui-input-block">
				<input type="text" value="<?php echo ($data['searchengine_zh']); ?>" readonly="readonly" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">添加日期</label>
			<div class="layui-input-block">
				<input type="text" value="<?php echo ($data['createtime']); ?>" readonly="readonly" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">单价</label>
			<div class="layui-input-block">
				<input type="text" value="<?php echo (format_money($data['price'])); echo ($data['unit']); ?>/<?php echo ($data['unit2']); ?>" readonly="readonly" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">初始冻结金额</label>
			<div class="layui-input-block">
				<input type="text" value="<?php echo (format_money($data['freezefunds'])); ?>" readonly="readonly" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">消耗冻结金额</label>
			<div class="layui-input-block">
				<input type="text" value="<?php echo (format_money($data['consumption'])); ?>" readonly="readonly" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">剩余冻结金额</label>
			<div class="layui-input-block">
				<input type="text" value="<?php echo (format_money($data['freezefunds_remain'])); ?>" readonly="readonly" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label required">关键词状态</label>
			<div class="layui-input-block">
				<select id="keywordstatus" name="keywordstatus" onchange="" ondblclick="" class="" lay-verify="keywordstatus" lay-filter="keywordstatus" readonly="" ><option value="" >请选择</option><?php  foreach($keywordstatusOptions as $key=>$val) { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } ?></select>
			</div>
		</div>
		
		
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">解 冻</button>
			</div>
		</div>						
	
	</form>
</div>	
</body>
</html>