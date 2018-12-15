<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "修改一级代理商用户";</php>
<head>
<include file="../Public/header" />
<script type="text/javascript">
$(function() {
	   
	   layui.use(['form'], function() {		
		   var form = layui.form;
		   var val = "";
			//自定义验证规则
			form.verify({
				password: function(value){
			  		if($.trim(value)== ""){
			    		return '请您输入原始登录密码';
			  		}
				},
				newpassword1: function(value){
			  		if( $.trim(value)== ""){
			    		return '请您输入新密码';
			  		}
			  		if(!(/(.+){6,}$/.test($.trim(value)))){
					      return '密码不能小于6位';
				    }
			 		
			  		val = $.trim(value);
				},
				newpassword2: function(value){
			  		if($.trim(value)== ""){
			    		return '请您再次输入新密码';
			  		}
			  		
			  		if(!(/(.+){6,}$/.test($.trim(value)))){
					      return '密码不能小于6位';
				    }
			  		
			  		if( $.trim(value) != val ){
			  			return "您两次输入的密码不一致，请重新输入！";
			  		}
			  		
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
		<form name="form" action="{:U('updateUserPassword')}" method="post" class="layui-form">
			
			<div class="layui-form-item">
				<label class="layui-form-label">用户名称</label>
				<div class="layui-input-block">
					<div class="layui-form-mid">{$data['username']}</div>
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">角色类型</label>
				<div class="layui-input-block">
			
					<div class="layui-form-mid">
						<eq name="_GET['type']" value="sub">
						代理用户
						<else/>
						子用户
						</eq>
					</div>
				</div>
			</div>
			
			<!-- <div class="layui-form-item">
				<label class="layui-form-label">原密码</label>
				<div class="layui-input-block">
						<input type="password" name="userpass_old" required="" lay-verify="password"  placeholder="请输入用户原始密码" autocomplete="off" class="layui-input">
				</div>
			</div>
			 -->
			<div class="layui-form-item">
				<label class="layui-form-label">新密码</label>
				<div class="layui-input-block">
						<input type="password" name="userpass_new1" required="" lay-verify="newpassword1" placeholder="请输入用户新密码" autocomplete="off" class="layui-input">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">确认新密码</label>
				<div class="layui-input-block">
						<input type="password" name="userpass_new2" required="" lay-verify="newpassword2" placeholder="请再次输入新密码" autocomplete="off" class="layui-input">
				</div>
			</div>
			
			
			<input type="hidden" name="id" value="{$data['id']}">
			<input type="hidden" name="type" value="{$Think.get.type}">
			
			<div class="layui-form-item layui-form-text">
				<div class="layui-input-block">
					<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">确认修改</button>
				</div>
			</div>

		</form>
	</div>
</body>
</html>

