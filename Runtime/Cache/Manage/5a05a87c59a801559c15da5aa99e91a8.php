<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<?php $page_title = "关键词审核"; ?>
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


<script>
	$(function() {
		layui.use(['form'], function() {
			var form = layui.form;
			//自定义验证规则
			form.verify({
				
		        rank: function(value){
					
			  		if( $.trim(value)== ""){
			    		return '请输入指定排名';
			  		}
			  		if( isNaN(value) ){
			  			return '请输入正确指定排名';
			        }
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
	<form name="form" action="<?php echo U('setRank');?>" method="post" class="layui-form">
		<input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>">
		<input type="hidden" name="original_rank" value="<?php echo ($_GET['rank']); ?>">
		<input type="hidden" name="day" value="<?php echo ($_GET['day']); ?>">
		<input type="hidden" name="returnUrl" value="<?php echo ($_GET['returnUrl']); ?>"> 
		
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">达标日期</label>
			<div class="layui-input-block">
				<input type="text" value="<?php echo ($_GET['day']); ?>" readonly="readonly" class="layui-input">
			</div>
		</div>

		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">原排名</label>
			<div class="layui-input-block">
				<input type="text" value="<?php echo ($_GET['rank']); ?>" readonly="readonly" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">真实排名</label>
			<div class="layui-input-block">
				<input type="text" value="<?php echo ($_GET['original']); ?>" readonly="readonly" class="layui-input">
			</div>
		</div>
											
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">指定排名</label>
			<div class="layui-input-block">
				<input type="text" name="rank" id="rank" required="" lay-verify="rank" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item layui-form-text">
			<div class="layui-input-block">
				<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">确定</button>
			</div>
		</div>						
	
	</form>
</div>	
</body>
</html>