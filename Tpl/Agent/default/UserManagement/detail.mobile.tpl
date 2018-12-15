<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />

<!-- 自定义正则验证js  -->
<script src="__PUBLIC__/js/regular.js"></script>

<!-- 自定义正则验证js  -->
<script src="__PUBLIC__/js/user.mobile.js"></script>

<script type="text/javascript">
	$(function() {
		
		
		
	});
</script>
<style>

</style>

</head>
<body ontouchstart>
	<div class="header">
  		<a class="header-arrow__left" href="{:U('Agent/Home/home')}"><i class="iconfont">&#xe671;</i></a>
  		<span class="header__center">用户管理</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>
	<div class="page">
	 	<div class="page__bd">
	 	
	 		<div class="weui-panel weui-panel_access question">
	 			
			  <div class="weui-panel__bd">
		            <div class="modal-content">
						<div class="weui-cells__title">用户信息</div>
						<div class="weui-cells weui-cells_form">
							<form name="form" action="{:U('update')}" method="post">
								<input type="hidden" name="id" value="{$data['id']}">
								
								<!-- 用户详情 挂件 begin -->
								{:W('UserDetail', array( 'data'=>$data,'operate' => 'update','skin' => 'mobile','me' => $LoginUserInfo , 'returnUrl' => $CURRENT_URL ))}
								<!-- 用户详情 挂件 end -->
								
							</form>
						</div>

					</div>
           		</div>
			</div>
	 	</div>
	</div>
		 
    