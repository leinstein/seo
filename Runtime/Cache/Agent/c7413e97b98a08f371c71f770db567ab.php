<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<?php $page_title = "财务管理 - 子用户充值"; ?>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title><?php echo (($page_title)?($page_title):"米同营销搜索营销管理后台"); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<meta name="description" content="mitong">
<meta name="author" content="mitong">


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
// $('#loading_iframe', parent.document).show();
</script>

<!-- 自定义正则验证js  -->
<script src="__PUBLIC__/js/regular.js"></script>

<script>
		$(function() {
			layui.use(['form'], function(){
				var form = layui.form;
	 			var availablefunds = "<?php echo ($funds['availablefunds']); ?>";
				//自定义验证规则
				form.verify({
					amount: function(value){
				  	
						// 是否输入了金额
						// 金额输入的示是否正确
						if( !$.trim( value) ){
							return "请输入金额！";
						}
						
						// 金额输入的示是否正确
						if( !verifyMoney(value)){
							return "您输入的金额格式不正确！";
						}

						// 金额是否大于可用余额
						if( accSub(value , 5000 ) < 0 && "<?php echo ($data['usertype']); ?>" == 'sub' && "<?php echo ($is_recharge_limit); ?>" == 1 ){
							return "充值金额最少为5000元";
						}

						// 金额是否大于可用余额
						if( accSub(value , availablefunds ) > 0 ){
							return "您输入的金额不能大于资金池余额！";
						}
						
					}
				});
	
				form.on('submit(go)', function(data) {
				});

				/*form.on('select', function(data){
					  //console.log(data.elem); //得到select原始DOM对象
					 var select_value = data.value; //得到被选中的值
					 //得到json数据中的值
					 var funds_str = <?php echo ($funds_str); ?>;
					 var funds_info = null;	
					// console.log(funds_str);
					 for (var i = 0; i < funds_str.length; i++) {
					 	// console.log(funds_str[i]);
					 	 if( select_value == funds_str[i]['productid']){
					 	 	funds_info = funds_str[i];
					 	 	break;
					 	 }
					 }

					 if( funds_info ){
					 	availablefunds = funds_info['availablefunds'];
					 	
					 }else{
					 	availablefunds = 0;
					 }
					 $("#product_funds").show();
					 $("#availablefunds").text( availablefunds );
				  //console.log(data.othis); //得到美化后的DOM对象
				});*/
	
	
				/* //事件监听
				form.on('select', function(data){
				  console.log(data);
				});
	
				form.on('select(aihao)', function(data){
				  console.log(data);
				});
				
				form.on('checkbox', function(data){
				  console.log(data.elem.checked);
				});
				
				form.on('switch', function(data){
				  console.log(data);
				});
				
				form.on('radio', function(data){
				  console.log(data);
				});
				
				//监听提交
				form.on('submit(*)', function(data){
				  console.log(data)
				  return false;
				}); */
	
			});
		});
	</script>
	
</head>

<body>
	<div class="layui-tab-content">
		<form name="form1" action="<?php echo U('recharge');?>" method="post" class="layui-form">
		
			<div class="layui-form-item">
				<label class="layui-form-label">用户名</label>
				<div class="layui-input-block">
					<div class="layui-form-mid"><?php echo ($data['username']); ?> </div>
				</div>
			</div>
		
			<div class="layui-form-item">
				<label class="layui-form-label">角色类型</label>
				<div class="layui-input-block">
				
				<?php if(($_GET['type']) == "sub_agent"): ?><div class="layui-form-mid">子代理</div>
					<input type="hidden" name="usertype" value="agent2">
				<?php else: ?>
					<div class="layui-form-mid">子用户</div>
					<input type="hidden" name="usertype" value="sub"><?php endif; ?> 
				
					
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">公司名称</label>
				<div class="layui-input-block">
					<div class="layui-form-mid"><?php echo ($data['epname']); ?></div>
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">资金余额</label>
				<div class="layui-input-block">
					<div class="layui-form-mid"><span id="availablefunds"><?php echo (format_money($funds['availablefunds'])); ?></span> 元</div>
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label required">充值产品</label>
				<div class="layui-input-block">
					<select id="" name="productid" onchange="" ondblclick="" class="" lay-verify="required" lay-filter="required" readonly="" ><option value="" >选择产品</option><?php  foreach($ProductOptions as $key=>$val) { if(!empty($default_productid) && ($default_productid == $key || in_array($key,$default_productid))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
				</div>
			</div>
			
			<!-- <div class="layui-form-item" id="product_funds">
				<label class="layui-form-label">产品余额</label>
				<div class="layui-input-block">
					<div class="layui-form-mid"><span id="availablefunds"><?php echo (format_money($default_product['balancefunds'])); ?></span> 元</div>
				</div>
			</div>	 -->
		
			
			<div class="layui-form-item">
				<label class="layui-form-label required">充值金额</label>
				<div class="layui-input-block">
					<input type="text" name="amount" required="" lay-verify="amount" placeholder="请填写充值金额" autocomplete="off" class="layui-input">
				</div>
			</div>	
			
			<input type="hidden" name="id"  value="<?php echo ($data['id']); ?>">
			
			
			<div class="layui-form-item">
				<div class="layui-input-block">
					<input type="hidden" name="returnUrl" value="<?php echo ($_GET['returnUrl']); ?>"> 
					<button class="layui-btn" lay-submit="" lay-filter="go">立即提交</button>
				</div>
			</div>

		</form>
	</div>
</body>
</html>