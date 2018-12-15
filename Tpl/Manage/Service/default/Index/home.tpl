<!DOCTYPE html>
<html lang="zh-CN">
<php>//$page_title = "米同营销首页";</php>
<head>
<include file="../Public/header" />
<!-- tips插件 begin -->
<link rel="stylesheet" href="../Public/css/tipso.min.css">
<script type="text/javascript" src="../Public/js/tipso.min.js"></script>
<!-- tips插件 end -->

<!-- 引入 echarts begin -->
<script type="text/javascript" src="__PUBLIC__/js/echarts/echarts.js"></script>  
<!-- 引入 echarts end -->

<link rel="stylesheet" href="__PUBLIC__/css/index.css">

<script type="text/javascript">
	$(function() {
		
		// 隐藏父页面的加载进度层
		$('#loading_iframe', parent.document).hide();
		
		// 初始化echarts
		init_chart();
		$(window).resize(function () {          //当浏览器大小变化时
			init_chart();
		});
		
        // 提示弹出初始化
		$('.tip').tipso({

			position : 'top',
			useTitle: false

		});
	});
	
	function init_chart(){
        
	}
	</script>
</head>
<body>

<!-- 页面顶部 logo & 菜单 begin  -->
<include file="../Public/top_banner"/>
<!-- 页面顶部 logo & 菜单 end  -->

<!-- 页面左侧菜单 begin  -->
<include file="../Public/left"/>
<!-- 页面左侧菜单 end  -->

<!--内容区域 begin -->
<div class="ui-module">

<!-- 面包屑导航 begin -->
	<!-- <div class="ui-breadcrumb">
	  <span class="layui-breadcrumb" style="visibility: visible;">
	  <a href="javascript:void(0);">后台用户管理<span class="layui-box">&gt;</span></a><a href="javascript:void(0);"><cite>后台用户</cite></a></span>
	</div> -->
  	<!-- 面包屑导航 end -->
  	<div class="ui-content" id="ui-content" style="background: #ebf1f3">
		<div class="home-tier-1">
			<div class="tier-1-block">
				<div class="ui-panel home-tier-1 user-general">
					<div class="personal-detail user-detail-container clearfix">
						<div class="user-avatar fl text-center">
							<img src="__PUBLIC__/img/avatar_user.png" alt="">
						</div>
						<div class="fl user-detail">
							<div class="user-detail-greetings mb20">
								<span class="username-outer text-overflow" title="{$LoginUserName}">你好，{$LoginUserName}</span>
								<span class="usertype" >普通用户</span>
							</div>
							<!-- <div>
								    会员ID：{{user.UserId}}
							</div> -->
						</div>
					</div>
					<div>
					
						<div class="clearfix user-connect">
							<span class="text-muted connect-icon connect-icon-mobile">手机号码</span>
							<a class="fr" href="javascript:;">{$LoginUserInfo['mobileno']}</a>
						</div>
						<div class="clearfix user-connect">
							<span class="text-muted connect-icon connect-icon-email">公司名称</span>
							<a class="fr" href="javascript:;">{$LoginUserInfo['epname']}</a>
						</div>
					</div>
				</div>
			</div>
			<div class="tier-1-block">
				<div class="ui-panel home-tier-1 secretary-panel">
					<div class="personal-detail secretary-detail">
						<img src="__PUBLIC__/img/avatar_secretary.png" alt="">
					</div>
					<div class="secretary-operate f14">
						<div class="text-center">
							专属客服
							<span class="text-primary">{$LoginUserInfo['oem_config']['customer']}</span>
						</div>
						<!-- <div class="text-center mt10">
							<span class="default-transition">
								<a href="tencent://Message/?Menu=YES&amp;Uin={$LoginUserInfo['oem_config']['QQnumber']|default='3125704179'}&amp;websiteName=im.qq.com" target="_blank" class="layui-btn layui-btn-normal" style="height: 38px; line-height: 38px;margin-left: 0;margin-right: 10px;">
									<i class="iconfont">&#xe608;</i> {$LoginUserInfo['oem_config']['QQnumber']|default='3125704179'}
								</a>
							</span>
							
							<span class="default-transition">
								<a href="tel:{$LoginUserInfo['oem_config']['telephone']|default='021-31009706'}"  class="layui-btn layui-btn-warm"    style="height: 38px; line-height: 38px;margin-left: 0;margin-right: 10px;">
									<i class="iconfont">&#xe6d6;</i> {$LoginUserInfo['oem_config']['telephone']|default='021-31009706'}
								</a>
								<a href="tel:{$LoginUserInfo['oem_config']['telephone']|default='021-31009706'}"   class="sq-btn btn-primary btn-reverse secretary-feedback">
									<i class="iconfont">&#xe6d6;</i> {$LoginUserInfo['oem_config']['telephone']|default='021-31009706'}
								</a>
							</span>
						</div> -->
						
						<div class="text-center secretary-operate-buttons">
							<a href="tencent://Message/?Menu=YES&amp;Uin={$LoginUserInfo['oem_config']['QQnumber']|default='3125704179'}&amp;websiteName=im.qq.com" target="_blank" class="layui-btn layui-btn-normal" style="height: 38px; line-height: 38px;width: auto;">
								<i class="iconfont">&#xe608;</i> {$LoginUserInfo['oem_config']['QQnumber']|default='3125704179'}
							</a>
							<a href="tel:{$LoginUserInfo['oem_config']['telephone']|default='021-31009706'}"  class="layui-btn layui-btn-warm"    style="height: 38px; line-height: 38px;width: auto;">
								<i class="iconfont">&#xe6d6;</i> {$LoginUserInfo['oem_config']['telephone']|default='021-31009706'}
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="tier-1-block">
				<div class="ui-panel home-tier-1">
					
					<div class="home-panel-heading notice-panel-heading clearfix">
						<a class="fr f14 line-height-1"  href="{:U('News/index')}" target="_blank">更多 &gt;&gt;</a>
						<span class="notice-title text-center fl">
							系统公告
						</span>
						 
					</div>
					<div class="notice-list-panel">
						<ul class="text-link">
							<volist name="news" id="vo">
							<li class="clearfix">
								<span class="notice-content text-overflow">
									<span class="list-decoration-point">•</span>
									<a href="{:U('News/detail')}/id/{$vo['id']}/open_type/blank" target="_blank" title="{$vo['newstitle']}">{$vo['newstitle']}</a>
								</span>
								<span class="fr news-time text-muted">
									{$vo['pubtime']|format_date}
								</span>
							</li>
							</volist>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<!-- 产品详情 begin -->
		<div class="home-tier-2">
			<div class="ui-panel">
				<div class="operate-container clearfix">
					<div class="clearfix operate-container-left">
						<div class="fl operate-links">
							<span class="user-operate-name"><!-- {$LoginUserInfo['oem_config']['product_name']|default='米同营销'} -->产品余额：</span>
							<span class="detail-count-container">
								<span class="user-balance">{$balancefunds|format_money}</span> 元
							</span>
							<span class="user-operate-name">冻结金额：</span>
							<span class="detail-count-container">
								<span class="user-balance">{$freezefunds|format_money}</span> 元
							</span>
							<span class="user-operate-name">可用金额：</span>
							<span class="detail-count-container">
								<span class="user-balance">{$availablefunds|format_money}</span> 元
							</span>
							<!-- <span class="user-operate-buttons">
								<a href="{{common.domain.uc}}/finance/recharge.aspx" class="sq-btn btn-strong user-recharge">立即充值</a>
							</span> -->
						</div>
						
						<div class="fl operate-links">
							<span class="user-operate-name">在线任务：</span>
							<span class="detail-count-container">
								<span class="user-balance"><a href="{:U('Keyword/effect')}">{$purchasedKeywordNum}</a></span> 个
							</span>
							<span class="user-operate-name">达标任务：</span>
							<span class="detail-count-container">
								<span class="user-balance"><a href="{:U('Keyword/effect')}/standardstatus/已达标">{$stankeywordNum}</a></span> 个
							</span>
							
							<!-- <span class="user-operate-buttons">
								<a class="layui-btn" href="javascript:;" onclick="open_layer('添加站点','{:U('Site/insertPage')}','50%')"><i class="layui-icon">&#xe608;</i> 添加站点</a>
								 <p style="color: red">友情提示：为了确保您的关键词优化效果，添加站点同时请填写网站ftp和网站后台地址以及账号密码，以便于优化师操作。</p>
							</span> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 产品详情 end -->
		
		<!-- 产品与服务 begin -->
		<div class="home-tier-3">
			<div class="clearfix">
				<div class="home-tier-3">
					<div class="ui-panel">
						<div class="home-panel-heading">产品与服务</div>
						<div class="clearfix products-detail-panel clearfix">
							<ul class="user-wo-lists text-link">
								<li class="clearfix">
									<span class="fl user-detail-item user-not-payed b" style="width: 10%;">
										产品
									</span>
									<span class="fl b">
											产品概况
									</span>
								</li>
								<li>
									<div class="clearfix">
										<span class="fl user-detail-item user-not-payed" style="width: 10%">
											{$LoginUserInfo['oem_config']['product_name']|default='米同营销'}
										</span>
										<span class="fl">
											站点数：{$siteNum|default= 0}、
											关键词数：{$purchasedKeywordNum|default= 0}、
											最新达标数：{$stankeywordNum|default= 0}、
											最新达标消费：{$standardsFee|format_money}、
											累计消费：{$consumptionfunds|format_money}、
											可用余额：{$availablefunds|format_money}、
											产品余额：{$balancefunds|format_money}
										</span>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 产品与服务 end -->
	</div>
</div>
<!-- 页面底部 begin  -->
<include file="../Public/footer"/>
<!-- 页面底部 end  -->
</body>
</html>

