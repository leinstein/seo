<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<php>$page_title = "启搜宝搜索营销管理后台";</php>
<include file="../Public/header.mobile" />
<style>
body, .frosted-glass::before {
	background: url(../Public/img/body_bg_xin.jpg) no-repeat;
	background-position: left top;
	background-size: 100% 100%;
	margin: 0px;
	padding: 0px;
	background-attachment: fixed;
}

.glass {
	width: 100%;
	height: 100%;
	background: inherit;
	/*position: relative;*/
}

.glass::before {
	content: '';
	position: fixed;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	-webkit-filter: blur(5px);
	-moz-filter: blur(5px);
	-ms-filter: blur(5px);
	-o-filter: blur(5px);
	filter: blur(5px);
	filter: progid:DXImageTransform.Microsoft.Blur(PixelRadius=4, MakeShadow=false);
}

/**
 * 设置背景图全屏覆盖及固定
 * 设置内部元素偏移
 */
body {
	/*此处背景图自行替换*/
	box-sizing: border-box;
	margin: 0;
	padding-top: calc(50vh - 6em);
	font: 150%/1.6 Baskerville, Palatino, serif;
}

/**
 * 整体居中功能；
 * 背景透明虚化
 * 溢出隐藏
 * 边缘圆角化
 * 文字增加淡阴影
 */
.login-content {
	/*position: relative;*/
	margin: 0 auto;
	padding: 1em;
	max-width: 20em;
	overflow: hidden;
}

/*使用滤镜模糊边缘*/
.login-page::before {
	content: '';
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	margin: -30px;
	z-index: -1;
	-webkit-filter: blur(20px);
	filter: blur(20px);
}

.weui-input {
	border-radius: 5px !important;
	padding: 5px 0;
}
</style>
<script>
	$(function() {
		layui.use(['form'], function() {
			var form = layui.form;
			//自定义验证规则
			form.verify({
				username: function(value){
			  		if($.trim(value)== ""){
			    		return '请输入登录用戶名';
			  		}
				},
				userpwd: function(value){
			  		if($.trim(value)== ""){
			    		return '请输入登录密码';
			  		}
				}
			});

			form.on('submit(login)', function(data) {
			});
		});
	});
</script>
</head>
<body>
	<div class="glass">
	
		<div style="margin: 0 auto; text-align: center; margin-top: -80px; padding-bottom: 10px;">
			<img alt="" src="../Public/img/logo.png" style="width: 100px;">
		</div>
		<div class="page__bd login-content" style="border: none; position: static;">
			<form class="layui-form" action="__URL__/doBindWechat" method="post" style="background: none">
				<input type="hidden" name="returnUrl" value="{$returnUrl}">	
				<input type="hidden" name="loginUrl" value="Index/bindWechat">	
				<input type="hidden" name="wechatOpenid" value="{$wechatOpenid}">	
				<div class="weui-cells"
					style="border-radius: 5px !important; margin-top: 30px">
	
					<div class="weui-cell">
						<div class="weui-cell__bd">
							<input class="weui-input" type="text" name="loginname" placeholder="请输入登录名" required="" lay-verify="username">
						</div>
					</div>
				</div>
	
				<div class="weui-cells"
					style="border-radius: 5px !important; margin-top: 30px;">
					<div class="weui-cell">
						<div class="weui-cell__bd">
							<input class="weui-input" type="password" name="loginpass"  placeholder="请输入登录密码" required="" lay-verify="userpwd">
						</div>
					</div>
				</div>
	
				<div class="weui-cells layui-input-block" style="background: none; position: static; border-radius: 5px !important; margin-top: 30px;margin-left:0 ">
					<button class="weui-btn weui-btn_primary" href="javascript:" class="layui-btn" lay-submit="" lay-filter="login">确定</button>
				</div>
				
	
	
				<!-- <div class="weui-btn-area">
	            <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">确定</a>
	        </div> -->
	    	</form>
		</div>
		
		<div class="weui-footer mt20">
        	<p class="weui-footer__links">
          		<!-- <a href="javascript:void(0);" class="weui-footer__link">底部链接</a> -->
        	</p>
        	<p class="weui-footer__text">Copyright © 2008-2017 qisobao</p>
      	</div>
		
	</div>
</body>
</html>