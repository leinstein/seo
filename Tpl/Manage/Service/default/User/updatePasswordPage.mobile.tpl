<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />

<!-- 自定义正则验证js  -->
<script src="__PUBLIC__/js/regular.js"></script>


<!-- 专用js begin -->
<script src="__PUBLIC__/js/loadmore-mobile.js"></script>
<!-- 专用js begin -->

<script type="text/javascript">

</script>
<style>
</style>

</head>
<body ontouchstart>

	<div class="header">
		<a class="header-arrow__left" href="{:U('Service/Home/home')}"><i class="iconfont">&#xe671;</i></a>
		<span class="header__center">用户管理</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>

	<div class="page" >
		<div class="page__bd">
			<div class="weui-tab">
				<div class="weui-tab__bd">
					<div class="weui-tab">
						<div class="weui-navbar">
							<a class="weui-navbar__item " href="{:U('User/updatePage')}">基本信息</a>
							<a class="weui-navbar__item weui-bar__item--on" href="{:U('User/updatePasswordPage')}">修改密码</a>
						</div>
						<div class="weui-tab__bd">						    
						    <div class="weui-panel weui-panel_access">
								
								<div class="weui-panel__bd">
									<div class="weui-cells__title">修改密码</div>
									<div class="weui-cells weui-cells_form">
										<form name="form" action="{:U('updatePassword')}" method="post">
											
											<!-- 用户密码修改 挂件 begin -->
											{:W('UserPwd', array( 'data'=>$data,'skin' => 'mobile','me' => $LoginUserInfo , 'returnUrl' => $CURRENT_URL  ))}
											<!-- 用户密码修改 挂件 end -->
														
										</form>
									</div>
	
								</div>
					      	</div>
				    	</div>
		        		<!-- 添加用户弹窗 end -->
		        		
		        		
					</div>
				</div>
			</div>
		</div>
</div>
	
</body>
</html>

