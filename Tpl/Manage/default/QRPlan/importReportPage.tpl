<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<script>
$(function() {
	layui.use(['form'], function() {
		var form = layui.form;
		var ks ="";
		//自定义验证规则
		form.verify({

		});

		form.on('submit(go)', function(data) {
		});
	});
	
	
});

</script>


<!-- 引入上传组件标签库 begin -->
<taglib name="html,dupload" />
<!-- 引入上传组件标签库 end -->
<!-- 引入上传组件js和css文件 begin -->
<dupload:script name="dupload"/>
<!-- 引入上传组件js和css文件 end-->
</head>
<body>	
	<div class="layui-tab-content">
		<form class="layui-form"  name="form1" action="{:U('importReport')}" method="post" >
		
			<blockquote class="layui-elem-quote">
					<p class="b">导入须知：</p>
					<p>1. 为了确保关键词效果，系统将按照站点下所购买关键词30天的达标费用作为预付款进行冻结，冻结资金依然在您的账户中，但无法再次购买其他关键词；</p>
					<p>2. 关键词达标后按天计费，费用从预付款中进行扣除，预付款消耗完毕，关键词达标费用将从账号余额中扣除；</p>
					<!-- <p>请您点击<a href="{:U('initTpl')}" target="_blank" style="font-size: 14;font-weight: bold;color: red"> 此处 </a>下载模板，并按照要求填写完整后上传。 -->
					</p>
				</blockquote>
				
			<div class="layui-form-item">
				<label class="layui-form-label">计划名称</label>
				<div class="layui-input-block">
					<input class="layui-input" value="{$Think.get.planname}" value="{$_GET['planname']}" readonly="readonly">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label required">报表文件</label>
				<div class="layui-input-block">
					<dupload:upload 
							suffix = "file_arra['suffix']"
							attachmentname="file_arra['attachmentname']"
							attachmenttype="file_arra['attachmenttype']" 
							attachmentdesc="file_arra['attachmentdesc']" 
							isrequire="file_arra['isrequire']" 
							tagname="file_arra['tagname']">
						</dupload:upload>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-input-block">
					<input type="hidden" name="planid" value="{$Think.get.id}">
					<button class="layui-btn" lay-submit="" lay-filter="go">立即提交</button>
				</div>
			</div>
		</form>
	</div>


</body>
</html>