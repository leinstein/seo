<!DOCTYPE html>
<html lang="zh-CN">
<php>//$page_title = "站点详情";</php>
<head>
<include file="../Public/header" />
<!-- <script type="text/javascript">
$(function () {
	$('textarea').flexText();
});
</script> -->
</head>
<body style="height: auto;">
	<div class="layui-tab-content">
		<form class="layui-form" >
			<include file="tpl/page"/>
		
			<div class="layui-form-item layui-form-text">
				<label class="layui-form-label">站点状态</label>
				<div class="layui-input-block">
					<input type="text" name="website" value="{$data['sitestatus']}" required="" lay-verify="required" placeholder="请按照格式填写，如：www.baidu.com" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label class="layui-form-label">审核意见</label>
				<div class="layui-input-block">
					<textarea name="ftp" placeholder="请准确FTP信息,以便优化师调整" class="layui-textarea">{$data['reviewopinion']}</textarea>
				</div>
			</div>
		</form>
	</div>

</body>
</html>