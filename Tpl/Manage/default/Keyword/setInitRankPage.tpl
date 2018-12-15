<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "关键词审核";</php>
<head>
<include file="../Public/header" />

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
	<form name="form" action="{:U('setInitRank')}" method="post" class="layui-form">
		<input type="hidden" name="id" value="{$Think.get.id}">
		<input type="hidden" name="original_rank" value="{$Think.get.rank}">
		<input type="hidden" name="returnUrl" value="{$Think.get.returnUrl}"> 
		
		

		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">原排名</label>
			<div class="layui-input-block">
				<input type="text" value="{$Think.get.rank}" readonly="readonly" class="layui-input">
			</div>
		</div>
				
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">真实排名</label>
			<div class="layui-input-block">
				<input type="text" value="{$rank_original}" readonly="readonly" class="layui-input">
			</div>
		</div>
				
											
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">指定排名</label>
			<div class="layui-input-block">
				<input type="text" name="initialranking" id="initialranking" required="" lay-verify="rank" class="layui-input">
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