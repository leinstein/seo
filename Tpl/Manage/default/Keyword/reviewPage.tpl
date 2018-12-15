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
			    		return '请选择审核结论';
			  		}
			  		ks = $.trim(value);
				},
				reviewopinion: function(value){
					if( ks == '被拒绝'){
			        	
						if( $.trim(value)== ""){
				    		return '请填写审核意见';
				  		}
			        }
				} 
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
	<form name="form" action="{:U('review')}" method="post" class="layui-form">
		<input type="hidden" name="id" value="{$data['id']}">
		<input type="hidden" name="returnUrl" value="{$Think.get.returnUrl}">
		
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">关键词</label>
			<div class="layui-input-block">
				<input type="text" value="{$data['keyword']}" readonly="readonly" class="layui-input">
			</div>
		</div>

		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">网址</label>
			<div class="layui-input-block">
				<input type="text" value="{$data['website']}" readonly="readonly" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">搜索引擎</label>
			<div class="layui-input-block">
				<input type="text" value="{$data['searchengine_zh']}" readonly="readonly" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">添加日期</label>
			<div class="layui-input-block">
				<input type="text" value="{$data['createtime']}" readonly="readonly" class="layui-input">
			</div>
		</div>
		
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">单价</label>
			<div class="layui-input-block">
				<input type="text" value="{$data['price']|format_money}{$data['unit']}/{$data['unit2']}" readonly="readonly" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label required">审核结论</label>
			<div class="layui-input-block">
				<html:select options="keywordstatusOptions" first="请选择" name="keywordstatus" id="keywordstatus" lay_verify="keywordstatus"/>
			</div>
		</div>
		
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">审核意见</label>
			<div class="layui-input-block">
				<textarea name="reviewopinion" placeholder="请填写审核意见" class="layui-textarea" lay-verify="reviewopinion" >{$data['reviewopinion']}</textarea>
			</div>
		</div>
		
		
		<div class="layui-form-item layui-form-text">
			<div class="layui-input-block">
				<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">审核</button>
			</div>
		</div>						
	
	</form>
</div>	
</body>
</html>