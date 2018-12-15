<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<script src="__PUBLIC__/js/regular.js"></script>
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
<tagLib name="html" />
<body>
    <!-- 页面顶部 logo & 菜单 begin -->
    <include file="../Public/top_banner" />
    <!-- 页面顶部 logo & 菜单 end -->
    <!-- 页面左侧菜单 begin -->
    <include file="../Public/left_home" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
        <!-- 面包屑导航 begin -->
        <!-- <div class="ui-breadcrumb">
            <span class="layui-breadcrumb" style="visibility: visible;">
            <a href="javascript:void(0);">后台用户管理<span class="layui-box">&gt;</span></a><a href="javascript:void(0);"><cite>后台用户</cite></a></span>
            </div> -->
        <!-- 面包屑导航 end -->
        
        
        <div class="ui-content" id="ui-content">
        	<div class="ui-content-box">
        		<form class="layui-form" name="update_form" method="post" action="__URL__/updatePassword" onkeydown="if(event.keyCode==13){return false;}">
					<div class="layui-form-item">
						<label class="layui-form-label">登陆账号</label>
						<div class="layui-input-block">
							<div class="layui-form-mid">{$LoginUserName}</div>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">原密码</label>
						<div class="layui-input-block">
							<input type="password" class="layui-input" name="password" placeholder="请输入您的原始登录密码" lay-verify="password" >
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">新密码</label>
						<div class="layui-input-block">
							<input type="password" class="layui-input" name="newpassword1" placeholder="不修改请留空,新密码至少需六位字符长度" lay-verify="newpassword1" >
						</div>
					</div>
					
					<div class="layui-form-item">
						<label class="layui-form-label">确认新密码</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" name="newpassword2" placeholder="请再次输入您的新密码" lay-verify="newpassword2" >
						</div>
					</div>
					
					<div class="layui-form-item">
						<div class="layui-input-block">
							<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">确 定</button>
						</div>
					</div>
				</form>
			</div>
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>