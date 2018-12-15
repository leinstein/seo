<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "关键词审核";</php>
<head>
<include file="../Public/header" />

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
<tagLib name="html" />
<body>
<div class="layui-tab-content">
	<form name="form" action="{:U('unfreeze')}" method="post" class="layui-form">
		<input type="hidden" name="id" value="{$data['id']}">
		<input type="hidden" name="returnUrl" value="{$Think.get.returnUrl}">
		
		<div class="layui-form-item">
			<label class="layui-form-label">关键词</label>
			<div class="layui-input-block">
				<input type="text" value="{$data['keyword']}" readonly="readonly" class="layui-input">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">网址</label>
			<div class="layui-input-block">
				<input type="text" value="{$data['website']}" readonly="readonly" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">搜索引擎</label>
			<div class="layui-input-block">
				<input type="text" value="{$data['searchengine_zh']}" readonly="readonly" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">添加日期</label>
			<div class="layui-input-block">
				<input type="text" value="{$data['createtime']}" readonly="readonly" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">单价</label>
			<div class="layui-input-block">
				<input type="text" value="{$data['price']|format_money}{$data['unit']}/{$data['unit2']}" readonly="readonly" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">初始冻结金额</label>
			<div class="layui-input-block">
				<input type="text" value="{$data['freezefunds']|format_money}" readonly="readonly" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">消耗冻结金额</label>
			<div class="layui-input-block">
				<input type="text" value="{$data['consumption']|format_money}" readonly="readonly" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">剩余冻结金额</label>
			<div class="layui-input-block">
				<input type="text" value="{$data['freezefunds_remain']|format_money}" readonly="readonly" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label required">关键词状态</label>
			<div class="layui-input-block">
				<html:select options="keywordstatusOptions" first="请选择" name="keywordstatus" id="keywordstatus" lay_verify="keywordstatus"/>
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