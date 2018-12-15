<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />

<!-- 引入 echarts begin -->
<script type="text/javascript" src="__PUBLIC__/js/echarts/echarts.js"></script>  
<!-- 引入 echarts end -->

<script type="text/javascript">
	$(function() {
		// 初始化echarts
		init_chart();
		$(window).resize(function () {          //当浏览器大小变化时
			init_chart();
		});
	});
	
	function init_chart(){
		// 
		var myChart = echarts.init(document.getElementById('account'));
		var pools = {$pools};
		
	    // 指定图表的配置项和数据
	    var option = {
	    title : {
	        text: '资金池统计',
	        subtext: '资金池统计',
	        x:'center'
	    },
	    tooltip : {
	        trigger: 'item',
	        formatter: "{a} <br/>{b} : {c} ({d}%)"
	    },
	    legend: {
	        orient: 'vertical',
	        left: 'left',
	    },
	    series : [
	        {
	            name: '访问来源',
	            type: 'pie',
	            radius : '75%',
	            center: ['50%', '60%'],
	            data:pools,
	            itemStyle: {
	                emphasis: {
	                    shadowBlur: 10,
	                    shadowOffsetX: 0,
	                    shadowColor: 'rgba(0, 0, 0, 0.5)'
	                }
	            }
	        }
	    	]
		};
	
	    
	    option = {
    	    backgroundColor: '#48a7c2',

    	    title: {
    	        text: '资金池统计',
    	        left: 'center',
    	        top: 20,
    	        textStyle: {
    	            color: '#fff'
    	        }
    	    },

    	    tooltip : {
    	        trigger: 'item',
    	        formatter: "{a} <br/>{b} : {c} ({d}%)"
    	    },

    	    visualMap: {
    	        show: false,
    	        min: 1000,
    	        max: 200000,
    	        inRange: {
    	            colorLightness: [0, 1]
    	        }
    	    },
    	    series : [
    	        {
    	            name:'资金池统计',
    	            type:'pie',
    	            radius : '65%',
    	            center: ['50%', '50%'],
    	            data:pools.sort(function (a, b) { return a.value - b.value; }),
    	            roseType: 'radius',
    	            label: {
    	                normal: {
    	                    textStyle: {
    	                        color: '#ffffff'
    	                    }
    	                }
    	            },
    	            labelLine: {
    	                normal: {
    	                    lineStyle: {
    	                        color: 'rgba(255, 255, 255, 1)'
    	                    },
    	                    smooth: 0.2,
    	                    length: 10,
    	                    length2: 20
    	                }
    	            },
    	            itemStyle: {
    	                normal: {
    	                    color: '#ff9900',
    	                    shadowBlur: 200,
    	                    shadowColor: 'rgba(0, 0, 0, 0.5)'
    	                }
    	            },

    	            animationType: 'scale',
    	            animationEasing: 'elasticOut',
    	            animationDelay: function (idx) {
    	                return Math.random() * 200;
    	            }
    	        }
    	    ]
    	};

    	// 使用刚指定的配置项和数据显示图表。
    	myChart.setOption(option);
	}	
</script>
</head>
<body ontouchstart>

	<div class="header">
		<a class="header-arrow__left" href="{:U('Agent/Home/home')}"><i class="iconfont">&#xe671;</i></a>
		<span class="header__center">财务管理</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>

	<div class="page" >
		<div class="page__bd">
			<div class="weui-tab">
				<div class="weui-tab__bd">
					<div class="weui-tab">
						<div class="weui-navbar">
							<a class="weui-navbar__item  weui-bar__item--on" href="{:U('Finance/pool')}">资金池管理</a>
							<a class="weui-navbar__item" href="{:U('Finance/details')}/operate/recharge">财务明细</a>
							<eq name="LoginUserInfo['isopen_subagent']" value="1">
							<a class="weui-navbar__item" href="{:U('Finance/sub_agent_list')}">子代理充值</a>
							</eq>
							<a class="weui-navbar__item" href="{:U('Finance/sub_user_list')}">子用户充值</a>
						</div>
						<div class="weui-tab__bd">
							
						    <div class="weui-panel weui-panel_access">
								
								<div class="weui-panel__bd">
								
									<blockquote class="layui-elem-quote" style="padding: 10px;">
							        	资金池可用余额: <span>{$data['totalfunds']|format_money}元</span><br>
<!--							        	资金池消费金额: <span>{$data['consumptionfunds']|format_money}元</span><br>-->
							        	资金池冻结金额: <span>{$data['freezefunds']|format_money}元</span>    
									</blockquote>           
						            <!-- 账户余额区域 begin -->
								    <div id="account"  style="height:510px;padding: 10px;"></div>		   
							    	<!-- 账户余额区域 end -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

