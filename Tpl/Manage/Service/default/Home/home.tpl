<!DOCTYPE html>
<html lang="zh-CN">
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
	
	var hints = {$hints};
	var hint_str ="";
	for (hint in hints){
		hint_str += hints[hint]  +'<br>';
	    
	}
	if( "{$show_hint}" == 1 ){
		var src ="{:U('Service/Home/show_trips')}/hint_str/" + encodeURIComponent( hint_str );
		layer_tips_right("温馨提示",src);
	}
	// 判断是否有新的消息
	//var untreated_workorder_num = "{$untreated_workorder_num}";
	//if( untreated_workorder_num > 0  && "{$Think.get.tag}" == 1){
	///	var src ="{:U('Service/Home/show_trips')}";
		//window.location.href= src;
	//	layer_tips_right("温馨提示",src);
	//}
	
	</script>
	<style>
	
	
	</style>
</head>
<body>

<!-- 页面顶部 logo & 菜单 begin  -->
<include file="../Public/top_banner"/>
<!-- 页面顶部 logo & 菜单 end  -->

<!-- 页面左侧菜单 begin  -->
<include file="../Public/left_home"/>
<!-- 页面左侧菜单 end  -->

<!--内容区域 begin -->
<div class="ui-module">

  	<div class="ui-content" id="ui-content" style="background: #ebf1f3">
  
	  	<!-- 顶部通知提醒区域 begin -->
		{:w('MyNotifyPanel', array('RootUrl'=>$RootUrl , 'is_show_layer_tips_right' => 1 ))}   	
		<!-- 顶部通知提醒区域 end -->
	
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
							<div>
								    会员ID：{$LoginUserId}
							</div>
						</div>
					</div>
					<div>
					
						<div class="clearfix user-connect">
							<span class="text-muted connect-icon ">手机号码</span>
							<a class="fr" href="javascript:;">{$LoginUserInfo['mobileno']}</a>
						</div>
						<div class="clearfix user-connect">
							<span class="text-muted connect-icon ">公司名称</span>
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
								<a href="tencent://Message/?Menu=YES&amp;Uin={$LoginUserInfo['oem_config']['QQnumber']|default='735283159'}&amp;websiteName=im.qq.com" target="_blank" class="layui-btn layui-btn-normal" style="height: 38px; line-height: 38px;margin-left: 0;margin-right: 10px;">
									<i class="iconfont">&#xe608;</i> {$LoginUserInfo['oem_config']['QQnumber']|default='735283159'}
								</a>
							</span>
							
							<span class="default-transition">
								<a href="tel:{$LoginUserInfo['oem_config']['telephone']|default='17717368566'}"  class="layui-btn layui-btn-warm"    style="height: 38px; line-height: 38px;margin-left: 0;margin-right: 10px;">
									<i class="iconfont">&#xe6d6;</i> {$LoginUserInfo['oem_config']['telephone']|default='17717368566'}
								</a>
								<a href="tel:{$LoginUserInfo['oem_config']['telephone']|default='17717368566'}"   class="sq-btn btn-primary btn-reverse secretary-feedback">
									<i class="iconfont">&#xe6d6;</i> {$LoginUserInfo['oem_config']['telephone']|default='17717368566'}
								</a>
							</span>
						</div> -->
						
						<div class="text-center secretary-operate-buttons">
							<a href="tencent://Message/?Menu=YES&amp;Uin={$LoginUserInfo['oem_config']['QQnumber']|default='735283159'}&amp;websiteName=im.qq.com" target="_blank" class="layui-btn layui-btn-normal" style="height: 38px; line-height: 38px;width: auto;">
								<i class="iconfont">&#xe608;</i> {$LoginUserInfo['oem_config']['QQnumber']|default='735283159'}
							</a>
							<a href="tel:{$LoginUserInfo['oem_config']['telephone']|default='17717368566'}"  class="layui-btn layui-btn-warm"    style="height: 38px; line-height: 38px;width: auto;">
								<i class="iconfont">&#xe6d6;</i> {$LoginUserInfo['oem_config']['telephone']|default='17717368566'}
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
							<switch name="vo.newstype">
							    <case value="notice"><php>$pre = '【公告】';</php></case>
							    <case value="protocol"><php>$pre = '【协议】';</php></case>
							    <default /><php>$pre = '';</php>
						 	</switch>
							<li class="clearfix">
								<span class="notice-content text-overflow">
									<span class="list-decoration-point">•</span>
									<a href="{:U('News/detail')}/id/{$vo['id']}/open_type/blank" target="_blank" title="{$vo['newstitle']}">{$pre}{$vo['newstitle']}</a>
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
		
		
		<!-- 产品与服务 begin -->
		<div class="home-tier-3">
			<div class="clearfix">
				<div class="home-tier-3">
					<div class="ui-panel">
						<div class="home-panel-heading">产品与服务</div>
						<div class="clearfix products-detail-panel clearfix">
							<ul class="user-wo-lists text-link">
								<li class="clearfix">
									<span class="fl user-detail-item b" style="width: 10%;">
										产品
									</span>
									<span class="fl b">
											产品概况
									</span>
								</li>
								<volist name="products" id="vo1">
								<li>
									<div class="clearfix">
										<span class="fl user-detail-item " style="width: 10%">
											{$vo1['product_name']}
										</span>
										<span class="fl">
											<switch name="vo1.id">
											    <case value="1"><!-- 优站宝产品 -->
											    	站点数：{$vo1.siteNum|default= 0}、
											    </case>
											    <case value="2"><!-- 快排宝产品 -->
											    	计划数：{$vo1.plnaNum|default= 0}、
											    </case>									   
											    <default />
											 </switch>
											关键词数：{$vo1.purchasedKeywordNum|default= 0}、
											最新达标数：{$vo1.stankeywordNum|default= 0}、
											最新达标消费：{$vo1.standardsFee|format_money} 元、
											累计消费：{$vo1.consumption|format_money} 元、
											可用余额：{$vo1['funds_pool']['availablefunds']|format_money} 元、
											产品余额：{$vo1['funds_pool']['balancefunds']|format_money} 元
										</span>
									</div>
								</li>
								</volist>
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

