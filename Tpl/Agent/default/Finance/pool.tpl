<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<!-- 引入 echarts begin -->
<script type="text/javascript" src="__PUBLIC__/js/echarts/echarts.js"></script>  
<!-- 引入 echarts end -->
<script type="text/javascript">
   $(function() {
	   layui.use(['form'], function(){
			var form = layui.form;
		   	//自定义验证规则
			form.verify({
				/* mbstatus: function(value){
		  			if($.trim(value)== ""){
		    			return '请选择管理后台状态';
		  			}
				} */
			});

			form.on('submit(go)', function(data) {
			
			});
	   	});
	   
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
	        data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
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
<tagLib name="html" />
<body>
    <!-- 页面顶部 logo & 菜单 begin -->
    <include file="../Public/top_banner" />
    <!-- 页面顶部 logo & 菜单 end -->
    <!-- 页面左侧菜单 begin -->
    <include file="../Public/left_home" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
       
        <!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>资金池管理</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        
        
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	 
        	
	        	<blockquote class="layui-elem-quote">
                    资金池可用余额: <span>{$data['balancefunds']|format_money}元</span>
                    资金池消费金额: <span>{$data['consumptionfunds']|format_money}元</span>
				</blockquote>
	            <!-- 账户余额区域 begin -->
				    <div id="account"  style="height:510px;padding: 10px;"></div>		   
			    	<!-- 账户余额区域 end -->
			</div> 
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>
