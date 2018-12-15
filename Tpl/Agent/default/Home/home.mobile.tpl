<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />

<!-- 引入 echarts begin -->
<script type="text/javascript" src="__PUBLIC__/js/echarts/echarts.js"></script>  
<!-- 引入 echarts end -->

<script type="text/javascript">
	$(function() {
		
		//init_chart();
		
	});
	
	$(window).resize(function () {          //当浏览器大小变化时
		//init_chart();
	});
	
	function init_chart(){
		// 基于准备好的dom，初始化echarts实例2017年4月20日 12:37:33 ：实例化账户余额
	    var myChart = echarts.init(document.getElementById('account_balance'));
		var consumptions = {$balances};
	    // 指定图表的配置项和数据
	    var option = {
	        title: {
	            text: '账户余额（元）',
	            subtext: '最近7天账户余额',
	            left: 'center',
	            top: 10
	        },
	        //color: ['rgb(25, 183, 207)'],
	        grid: {
	            left: '1%',
	            right: '1%',
	            bottom: '5%',
	            top: 80,
	            containLabel: true
	        },
	        tooltip: {
	        	
	        },
	        color: ['#66d6ff'],
	       
	        /* toolbox: {
	 	        show : true,
	 	        feature : {
	 	            mark : {show: true},
	 	            dataView : {show: true, readOnly: false},
	 	            magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
	 	            restore : {show: true},
	 	            saveAsImage : {show: true}
	 	        }
	 	    }, */
	    	calculable : true,
	   	    grid: {
	   	    	 left: '1%',
	             right: '3%',
	             bottom: '5%',
	             top: 80,
	             containLabel: true
	   	    },
	        xAxis: {
	            data:{$date}
	        },
	        yAxis: {
	        	 type: 'value'
	        },
	        series: [{
	            name: '账户余额（元）',
	            type: 'bar',
	           	barWidth: '90%',
	            data: consumptions,
	            itemStyle : { 
	            	normal: {
	        			label : {show: true}
	                },
	                
	            },
	        }]
	        
	    };

	    // 使用刚指定的配置项和数据显示图表。
	    myChart.setOption(option);

	    
	}
	
</script>
<style>

	/* user */


</style>

<link rel="stylesheet" href="__PUBLIC__/css/mobile/index.css">
</head>
<body>

	<div class="header">
		<a class="header-arrow__left" href="{:U('Agent/Home/home')}"><i class="iconfont">&#xe671;</i></a>
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
							<span class="user-account-usertype">{$LoginUserInfo['usertype_desc']|default="代理商"}</span>
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
			<div class="weui-panel weui-panel_access notify">
			  	<div class="weui-panel__hd">专属客服</div>
			  	<div class="weui-panel__bd">
				    <a href="mqqwpa://im/chat?chat_type=wpa&uin=735283159&version=1&src_type=web&web_src=oicqzone.com" class="weui-media-box weui-media-box_appmsg">
				      <div class="weui-media-box__hd">
				        <i class="iconfont f18  c_lightblue pl0 pr5">&#xe608;</i>
				      </div>
				      <div class="weui-media-box__bd">
				        <h4 class="weui-media-box__title f14">
				        	735283159
				        </h4>
				      </div>
				    </a>
				    
				    <a href="tel:17717368566" class="weui-media-box weui-media-box_appmsg">
				      <div class="weui-media-box__hd">
				        <i class="iconfont f18 c_lightblue pl0 pr5">&#xe6d6;</i>
				      </div>
				      <div class="weui-media-box__bd">
				        <h4 class="weui-media-box__title f14">
				        	17717368566
				        </h4>
				      </div>
				    </a>
			  </div>
			</div>
			<!-- 客服信息  end -->
	   	
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

