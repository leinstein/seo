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
	$(function() {
	
	});
</script>
<style>
</style>

</head>
<!-- 引入上传组件标签库 begin -->
<taglib name="dupload" />
<!-- 引入上传组件标签库 end -->
<!-- 引入上传组件js和css文件 begin -->
<dupload:script name="dupload"/>
<!-- 引入上传组件js和css文件 end-->
<body ontouchstart>

	<div class="header">
		<a class="header-arrow__left" href="{:U('Agent/Home/home')}"><i class="iconfont">&#xe671;</i></a>
		<span class="header__center">系统设置</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>

	<div class="page" >
		<div class="page__bd">
			<div class="weui-tab">
				<div class="weui-tab__bd">
					<div class="weui-tab">
						<div class="weui-navbar">
							<a class="weui-navbar__item weui-bar__item--on" href="{:U('System/index')}">基础设置</a>
							<a class="weui-navbar__item " href="{:U('News/maintainPage')}/newstype/notice">维护公告</a>
							<a class="weui-navbar__item " href="{:U('News/maintainPage')}/newstype/protocol">维护协议</a>
							<a class="weui-navbar__item " href="{:U('News/insertPage')}">添加通知</a>
							<a class="weui-navbar__item " href="{:U('News/publist')}">文章列表</a>
						</div>
						<div class="weui-tab__bd">						    
						    <div class="weui-panel weui-panel_access">
								
								<div class="weui-panel__bd">
									<div class="weui-cells__title">基础设置</div>
									<div class="weui-cells weui-cells_form">
										<form name="form" action="{:U('update')}" method="post">
											<div class="weui-cell">
												<div class="weui-cell__hd">
													<label class="weui-label required">系统名称</label>
												</div>
												<div class="weui-cell__bd">
													<input type="text" id="page_title" name="page_title"  value="{$data['page_title']}" placeholder="请填写系统主页名称"  class="weui-input">										
												</div>
											</div>
											<div class="weui-cells__tips">该参数显示在浏览器的title中</div>
											
											<div class="weui-cell">
												<div class="weui-cell__hd">
													<label class="weui-label required">登录地址</label>
												</div>
												<div class="weui-cell__bd">
													<input type="text" id="home_page_address" name="home_page_address" value="{$data['home_page_address']}"  placeholder="请填写系统主页地址"  class="weui-input">
												</div>
											</div>
											
											<div class="weui-cell">
												<div class="weui-cell__hd">
													<label class="weui-label required">客服名称</label>
												</div>
												<div class="weui-cell__bd">
													<input type="text" id="customer" name="customer" value="{$data['customer']}" placeholder="请填写客服名称"  class="weui-input">
												</div>
											</div>
											
											<div class="weui-cell">
												<div class="weui-cell__hd">
													<label class="weui-label required">客服电话</label>
												</div>
												<div class="weui-cell__bd">
													<input type="text" id="telephone" name="telephone" value="{$data['telephone']}"  placeholder="请填写客服联系电话"  class="weui-input">
												</div>
											</div>
											
											<div class="weui-cell">
												<div class="weui-cell__hd">
													<label class="weui-label required">客服QQ</label>
												</div>
												<div class="weui-cell__bd">
													<input type="text" id="QQnumber" name="QQnumber" value="{$data['QQnumber']}"  placeholder="请填写客服QQ号码"  class="weui-input">
												</div>
											</div>
											
											
											<div class="weui-cell">
												<div class="weui-cell__hd">
													<label class="weui-label required">固定电话</label>
												</div>
												<div class="weui-cell__bd">
													<input type="text" name="telephone" id="telephone"  placeholder="请填写固定电话"  class="weui-input" value="{$data['telephone']}">
												</div>
											</div>
											
											<div class="weui-cell">
												<div class="weui-cell__hd">
													<label class="weui-label required">登录图片</label>
												</div>
												<div class="weui-cell__bd">
													<dupload:upload 
														cannotedit = "login_page_image_arr['cannotedit']"
														isimage = "login_page_image_arr['isimage']"
														attachmentid = "login_page_image_arr['fileid']"
														maxsize="login_page_image_arr['maxsize']" 
														attachmentname="login_page_image_arr['attachmentname']"
														attachmenttype="login_page_image_arr['attachmenttype']" 
														attachmentdesc="login_page_image_arr['attachmentdesc']" 
														isrequire="login_page_image_arr['isrequire']" 
														skin ="login_page_image_arr['skin']"
														tagname="login_page_image_arr['tagname']">
													</dupload:upload>
												</div>
											</div>
											<div class="weui-cells__tips">图片大小 1590*660(具体根据显示效果来定)</div>
											
											<div class="weui-cell">
												<div class="weui-cell__hd">
													<label class="weui-label required">登录页logo</label>
												</div>
												<div class="weui-cell__bd">
													<dupload:upload 
														cannotedit = "loginpage_logo_image_arr['cannotedit']"
														isimage = "loginpage_logo_image_arr['isimage']"
														attachmentid = "loginpage_logo_image_arr['fileid']"
														maxsize="loginpage_logo_image_arr['maxsize']" 
														attachmentname="loginpage_logo_image_arr['attachmentname']"
														attachmenttype="loginpage_logo_image_arr['attachmenttype']" 
														isrequire="loginpage_logo_image_arr['isrequire']" 
														skin ="loginpage_logo_image_arr['skin']"
														tagname="loginpage_logo_image_arr['tagname']">
													</dupload:upload>
												</div>
											</div>
											<div class="weui-cells__tips">图片大小200 * 80 (具体根据显示效果来定)</div>
											
											<div class="weui-cell">
												<div class="weui-cell__hd">
													<label class="weui-label required">系统logo</label>
												</div>
												<div class="weui-cell__bd">
													<dupload:upload 
														cannotedit = "logo_image_arr['cannotedit']"
														isimage = "logo_image_arr['isimage']"
														attachmentid = "logo_image_arr['fileid']"
														maxsize="logo_image_arr['maxsize']" 
														attachmentname="logo_image_arr['attachmentname']"
														attachmenttype="logo_image_arr['attachmenttype']" 
														isrequire="logo_image_arr['isrequire']" 
														skin ="logo_image_arr['skin']"
														tagname="logo_image_arr['tagname']">
													</dupload:upload>
												</div>
											</div>
											<div class="weui-cells__tips">请使用透明背景，白色字体logo，图片大小 180 * 60 (具体根据显示效果来定)</div>
											
											
											<!-- <div class="weui-btn-area">
												<input type="hidden" name="returnUrl" value="{$returnUrl}"> 
												<a class="weui-btn weui-btn_primary" href="javascript:;" onclick="doSub()">立即提交</a>
											</div> -->
								
											
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

