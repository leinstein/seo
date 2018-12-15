<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />

<script type="text/javascript">
	$(function() {
		
		
		
	});
	
</script>
<style>

	/* user */


</style>

<link rel="stylesheet" href="__PUBLIC__/css/mobile/index.css">
</head>
<body>
<div class="header">
		<a class="header-arrow__left" href="{:U('Service/Home/home')}"><i class="iconfont">&#xe671;</i></a>
		<span class="header__center">用户中心</span>
		<a class="header-arrow__right" href="{:U('Index/logOut')}"><i class="iconfont">&#xe611;</i></a>
	</div>
	<div class="page" style="padding-bottom:10px;">

		 <div class="page__bd">
		 
			<!-- 用户中心 begin -->
			<div class="user-wrapper">
				<div class="user-account clearfix">
					<div class="user-avatar fl text-center">
						<img src="__PUBLIC__/img/avatar_user.png" alt="">
					</div>
					<div class="fl user-account-detail">
						<div class="user-detail-greetings mb20">
							<span class="user-account-username" title="{$LoginUserName}">你好，{$LoginUserName}</span>
							<span class="user-account-usertype">普通用户</span>
						</div>
						<div>会员ID：{$LoginUserId}</div>
					</div>
				</div>
				<div>
					<div class="user-connect clearfix">
						<span class="connect-icon ">手机号码</span>
						<a class="fr" href="javascript:;">{$LoginUserInfo['mobileno']}</a>
					</div>
					<div class="clearfix user-connect">
						<span class="text-muted connect-icon ">公司名称</span>
						<a class="fr" href="javascript:;">{$LoginUserInfo['epname']}</a>
					</div>
				</div>
			</div>
			<!-- 用户中心 end -->
			
			<!-- 客服信息  begin -->
			<div class="secretary-wrapper hide">
				<div class="personal-detail secretary-detail">
					<img src="__PUBLIC__/img/avatar_secretary.png" alt="">
				</div>
				
				<div>
					<div class="user-connect clearfix">
						<span class="connect-icon ">客服QQ</span>
						<a class="fr" href="javascript:;"><i class="iconfont">&#xe608;</i> {$LoginUserInfo['oem_config']['QQnumber']|default='3125704179'}</a>
					</div>
					<div class="user-connect clearfix">
						<span class="connect-icon ">客服电话</span>
						<a class="fr" href="tel:{$LoginUserInfo['oem_config']['telephone']|default='021-31009706'}"><i class="iconfont">&#xe6d6;</i> {$LoginUserInfo['oem_config']['telephone']|default='021-31009706'}</a>
					</div>
				</div>
				
				<!-- <div class="secretary-operate f14">
					<div class="text-center">
						专属客服
						<span class="text-primary">{$LoginUserInfo['oem_config']['customer']}</span>
					</div>
					
					<div class="secretary-operate-buttons">
						<a href="mqqwpa://im/chat?chat_type=wpa&uin={$LoginUserInfo['oem_config']['QQnumber']|default='3125704179'}&version=1&src_type=web&web_src=oicqzone.com" target="_blank" class="weui-btn weui-btn_primary"  style="background: #1E9FFF;">
							<i class="iconfont">&#xe608;</i> {$LoginUserInfo['oem_config']['QQnumber']|default='3125704179'}
						</a>
						<a href="tel:{$LoginUserInfo['oem_config']['telephone']|default='021-31009706'}"  class="weui-btn weui-btn_primary"    style="background: #F7B824;">
							<i class="iconfont">&#xe6d6;</i> {$LoginUserInfo['oem_config']['telephone']|default='021-31009706'}
						</a>
					</div>
				</div> -->
			</div>
			<!-- 客服信息  end -->
			
			<div class="weui-panel weui-panel_access notify">
			  	<div class="weui-panel__hd">专属客服&nbsp;&nbsp;&nbsp;&nbsp;{$LoginUserInfo['oem_config']['customer']}</div>
			  	<div class="weui-panel__bd">
				    <a href="mqqwpa://im/chat?chat_type=wpa&uin={$LoginUserInfo['oem_config']['QQnumber']|default='3125704179'}&version=1&src_type=web&web_src=oicqzone.com" class="weui-media-box weui-media-box_appmsg">
				      <div class="weui-media-box__hd">
				        <i class="iconfont f18  c_lightblue pl0 pr5" style="padding-left: 30px;">&#xe608;</i>
				      </div>
				      <div class="weui-media-box__bd">
				        <h4 class="weui-media-box__title f14">
				        	{$LoginUserInfo['oem_config']['QQnumber']|default='3125704179'}
				        </h4>
				      </div>
				    </a>
				    
				    <a href="tel:{$LoginUserInfo['oem_config']['telephone']|default='021-31009706'}" class="weui-media-box weui-media-box_appmsg">
				      <div class="weui-media-box__hd">
				        <i class="iconfont f18 c_lightblue pl0 pr5" style="padding-left: 30px;">&#xe6d6;</i>
				      </div>
				      <div class="weui-media-box__bd">
				        <h4 class="weui-media-box__title f14">
				        	{$LoginUserInfo['oem_config']['telephone']|default='021-31009706'}
				        </h4>
				      </div>
				    </a>
				    
			  </div>
			</div>
			
	
	    	<!-- 我的业务九宫格 begin -->
	    	{:w('MyBizPanel', array( 'skin' => 'mobile','sys_products' => $sys_products, 'me' => $LoginUserInfo ))}   
			<!-- 我的业务九宫格 end -->
			
	    </div>
	    <!-- 页面底部 begin  -->
		<include file="Public/tpl/footer_mobile.tpl" />
		<!-- 页面底部 end  -->
	</div>
</body>
</html>

