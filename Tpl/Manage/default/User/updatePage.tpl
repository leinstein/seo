<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
   <script type="text/javascript">
   $(function() {
	   var form = layui.form;
		//自定义验证规则
		form.verify({
			mbstatus: function(value){
				
		  		if($.trim(value)== ""){
		    		return '请选择管理后台状态';
		  		}
			}
		});

		form.on('submit(go)', function(data) {
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
    <include file="../Public/left" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
    
        <!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>账号信息</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        
        <div class="ui-content" id="ui-content">
        	<div class="ui-panel">	 
	        	<form class="layui-form" name="update_form" method="post" action="__URL__/update" onkeydown="if(event.keyCode==13){return false;}">
					<div class="layui-form-item">
						<label class="layui-form-label">登陆账号</label>
						<div class="layui-input-block">
							<div class="layui-form-mid">{$LoginUserName}</div>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">邮箱地址</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" name="email" placeholder="请输入常用邮箱,用于平台通知、密码找回" value="{$LoginUserInfo['email']}" >
						</div>
					</div>
					
					<div class="layui-form-item">
						<label class="layui-form-label">公司名称</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" name="epname" placeholder="公司名称,请填写营业执照公司全称" value="{$LoginUserInfo['epname']}" >
						</div>
					</div>
					
					<div class="layui-form-item">
						<label class="layui-form-label">联系人</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" name="contact" placeholder="您的真实姓名" value="{$LoginUserInfo['contact']}" >
						</div>
					</div>
				
					<div class="layui-form-item">
						<label class="layui-form-label">联系QQ</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" name="QQnumber" placeholder="方便在线沟通" value="{$LoginUserInfo['QQnumber']}" >
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">固定电话</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" name="telephone" placeholder="便于沟通" value="{$LoginUserInfo['telephone']}" >
						</div>
					</div>
	
					<div class="layui-form-item">
						<label class="layui-form-label">手机号码</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" name="mobileno" placeholder="便于沟通" value="{$LoginUserInfo['mobileno']}" >
						</div>
					</div>
					
					<div class="layui-form-item">
						<div class="layui-input-block">
							<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">修改账户资料</button>
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
