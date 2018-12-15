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

<script src="__PUBLIC__/js/regular.js"></script>
<script type="text/javascript">
   $(function() {
	   layui.use(['form'], function() {
		   var form = layui.form;
			//自定义验证规则
			form.verify({
				amount: function(value){
					
			  		if($.trim(value)== ""){
			    		return '请输入金额';
			  		}
			  		
			  		// 金额输入的示是否正确
					//if( !verifyMoney(value)){
					//	return "您输入的金额格式不正确！";
					//}
				}
			});
	
			
			form.on('submit(go)', function(data) {
			});
	   });
	});
</script>
   
   
</head>

<body>
    <div class="layui-tab-content">
      		<form name="form1"  class="layui-form"  action="<?php echo U('recharge');?>" method="post">
			<div class="layui-form-item">
				<label class="layui-form-label">用户名</label>
				<div class="layui-input-block">
					<div class="layui-form-mid"><?php echo ($data['username']); ?></div>
				</div>
			</div>		
			<div class="layui-form-item">
				<label class="layui-form-label">角色</label>
				<div class="layui-input-block">
					<div class="layui-form-mid">一级代理商</div>
				</div>
			</div>	
			
			<div class="layui-form-item">
				<label class="layui-form-label">公司名称</label>
				<div class="layui-input-block">
					<div class="layui-form-mid"><?php echo ($data['epname']); ?></div>
				</div>
			</div>	
			<!-- <div class="layui-form-item">
				<label class="layui-form-label">充值产品</label>
				<div class="layui-input-block">
					<select id="" name="productid" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >选择产品</option><?php  foreach($ProductOptions as $key=>$val) { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } ?></select>
				</div>
			</div>	 -->
		

			<div class="layui-form-item">
				<label class="layui-form-label">充值金额</label>
				<div class="layui-input-block">
					<input type="text" class="layui-input" name="amount" required="" lay-verify="amount"  placeholder="请填写充值金额,写负数为退款" >
				</div>
			</div>
		
			<div class="layui-form-item">
				<div class="layui-input-block">
					<input type="hidden" name="usertype"  value="agent">
					<input type="hidden" name="id"  value="<?php echo ($data['id']); ?>">
					<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">确 定</button>
				</div>
			</div>

		</form>
    </div>
</body>
</html>