<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />

<!-- 引入 echarts begin -->
<script type="text/javascript" src="__PUBLIC__/js/echarts/echarts.js"></script>  
<!-- 引入 echarts end -->

<script type="text/javascript">
	$(function() {
		
		init_chart();
		
	});
	
	$(window).resize(function () {          //当浏览器大小变化时
		init_chart();
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

	<div class="page" style="padding-bottom:10px;margin: 0">

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
	   
	    	<!-- 消息提醒 begin-->
			{:w('MyNotifyPanel', array( 'skin' => 'mobile' ))}   
	    	<!-- 消息提醒 end-->
	    	
	    	<!-- 系统公告 begin-->
			{:w('MyNewsPanel', array( 'skin' => 'mobile' ))}   
	    	<!-- 系统公告 end-->
	    	
	    	<!-- 会员信息 begin-->
			<div class="weui-panel weui-panel_access notify">
			  	<div class="weui-panel__hd">会员信息</div>
			  	<div class="weui-panel__bd">
				    <div class="m10 p10">
						<span class="user-operate-name"><!-- <i class="iconfont mr5 f20">&#xe615;</i> -->会员数量</span>
						<span class="detail-count-container">
							<notempty name="members">
							<volist name="members" id="vo">
								<span class="user-balance mr10 ml10">
									<span style="color:#333;font-size: 16px;">{$vo['usertype_desc']}</span>
									<a href="{:U('Home/member')}/usertype/{$vo['usertype']}">{$vo.num|default=0}</a>
									<span style="font-size: 14px;">个</span>
								</span> 
							</volist>
							<else/>
							<span class="user-balance mr10">
									<span style="color:#333;font-size: 16px;"></span>
									0
									<span style="font-size: 14px;">个</span>
								</span> 
							</notempty>
							
						</span>
					</div>   
			  </div>
			</div>
	    	<!-- 会员信息 end-->
	    	
	    	<!-- 客服信息  begin -->
			<div class="weui-panel weui-panel_access notify">
			  	<div class="weui-panel__hd">账户余额</div>
			  	<div class="weui-panel__bd">
				    <div id="account_balance"  style="width:100%;height:300px;"></div>		   
			  </div>
			</div>
			<!-- 客服信息  end -->
	    	
	    	<!-- 我的业务九宫格 begin -->
	    	{:w('MyBizPanel', array( 'skin' => 'mobile','sys_products' => $sys_products, 'me' => $LoginUserInfo ))}   
			<!-- 我的业务九宫格 end -->
			
	        <!-- 我的业务 begin-->
	       <!--  <div class="weui-panel business">
	            <div class="weui-panel__hd">我的业务<span class="f12 c_gray ml10">点击图标，扫码办理业务</span></div>
			    <div class="weui-grids">
			       
			    </div>
			</div> -->
	        <!--我的业务 end-->
	        
	        <!-- 产品&服务 begin--
	        <div class="weui-panel weui-panel_access">
	            <div class="weui-panel__hd">产品&服务</div>
	            <div class="weui-panel__bd">
	                <a id="notify" <notempty name="notify">href="__GROUP__/Message/myNotify"<else/>  onclick="shake(this)" </notempty> class="weui-media-box weui-media-box_appmsg">
	                    <div class="weui-media-box__hd">
	                        <img class="weui-media-box__thumb" src="data:image/png;base64,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" alt="">
	                        <div class="weui-media-box__hd__title">消息提醒</div>
	                    </div>
	                    <div class="weui-media-box__bd">
	                        <notempty name="notify">
	               				<script>
	                        		//去掉隐藏伪类的样式
	                               	$("#notify .weui-media-box__bd").removeClass("hideafter") ;
	                            </script>
	                            <h4 class="weui-media-box__title">{$notify['body']}</h4>
	                        <else/>
            					<script>
	                          		//增加隐藏伪类的样式
	                            	$("#notify .weui-media-box__bd").addClass("hideafter");  
	                            </script>
                                <h5 class="weui-media-box__title">您暂时还没有消息提醒</h5> 
	                        </notempty>
	                        
	                    </div>
	                </a>
	            </div>
	        </div>
	    	<!-- 产品&服务 end-->
	        
	        <!-- <div class="shortcut-navs">
				<ul class="shortcut-nav">
					<li><a class="link link1" href="#">待付款</a></li>
					<li><a class="link link2" href="#">待收货</a></li>
					<li><a class="link link3" href="#">全部订单</a></li>
					<li><a class="link link5" href="#">我的资产</a></li>
				</ul>
				<ul class="shortcut-nav">
					<li><a class="link link6" href="#">帐户中心</a></li>
					<li><a class="link link7" href="#">客户服务</a></li>
					<li><a class="link link8" href="#">我的预约</a></li>
					<li></li>
				</ul>
			</div> -->

	    </div>
	    <!-- 页面底部 begin  -->
		<include file="Public/tpl/footer_mobile.tpl" />
		<!-- 页面底部 end  -->
	</div>
</body>
</html>

