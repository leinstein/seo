<!DOCTYPE html>
<html lang="zh-CN">
<php>//$page_title = "网站优化首页";</php>
<head>
<include file="../Public/header" />
<!-- tips插件 begin -->
<link rel="stylesheet" href="../Public/css/tipso.min.css">
<script type="text/javascript" src="../Public/js/tipso.min.js"></script>
<!-- tips插件 end -->

<!-- 引入 echarts begin -->
<script type="text/javascript" src="__PUBLIC__/js/echarts/echarts.js"></script>  
<!-- 引入 echarts end -->

<link rel="stylesheet" href="../Public/css/home.css">

<script type="text/javascript">
	$(function() {
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

        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
		var consumptions_ten_days = {$consumptions_ten_days};
        // 指定图表的配置项和数据
        var option = {
       		title: {
                   text: '每日消耗（元）',
                   subtext: '每日消耗金额',
                   left: 'center',
                   top: 10
               },
            /* tooltip: {
            	
            },
            legend: {
                data:['每日消耗（元）']
            },
            toolbox: {
                show: true,
                feature: {
                    magicType: {show: true, type: ['stack', 'tiled']},
                    saveAsImage: {show: true}
                }
            }, */
            grid: {
                left: '1%',
                right: '1%',
                bottom: '5%',
                top: 80,
                containLabel: true
            },
            xAxis: {
            	 //boundaryGap : false,
                data:{$date},
                axisLabel: {
                    interval:0,//横轴信息全部显示
                  //  rotate: 60,//60度角倾斜显示
                   
                }
            },
            yAxis: {
            	 type: 'value'
            },
            series: [{
            	
            	name: '每日消耗（元）',
                type:'line',
                stack: '总量',
                label: {
                    normal: {
                        show: true,
                        position: 'top'
                    }
                },
                //areaStyle: {normal: {}},
                data: consumptions_ten_days,
      
           	
           	/* name: '每日消耗（元）',
               type: 'line',
              // symbol:'pin',//拐点样式
              symbolSize: 8,//拐点大小
               smooth: true,
               itemStyle : {
                   normal : {
                       lineStyle:{
                           width:3,//折线宽度
                          // color:"#a6325a"//折线颜色
                       }
                   }
               },
               data: consumptions_ten_days, */
               
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
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
  	
  	
		<div class="mt15">
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-blue" style="background: #ff9900"><i class="iconfont">&#xe633;</i></div>
                    <div class="value">
                        <a href="{:U('Site/index')}" data-parent="true" data-title="站点总数">
                          <h1>{$siteNum|default= 0}</h1>
                      <span>站点总数</span></a>

                    </div>
                </section>
            </div>
            
    
                                      
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-commred" style="background: #a6325a" ><i class="iconfont">&#xe631;</i></div>
                    <div class="value">
                        <a data-parent="true" data-title="在线任务">
                            <h1>{$purchasedKeywordNum|default= 0}</h1>
                      <span>在线任务</span></a>

                    </div>
                </section>
            </div>
            
            
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-dark-green" style="background: #48a7c2"><i class="iconfont">&#xe6b8;</i></div>
                    <div class="value">
                        <a data-parent="true" data-title="达标任务">
                            <h1>{$stankeywordNum|default= 0}</h1>
                      <span>达标任务<span class="tip tipso_style" data-tipso="以最新检测时间为准">㊟</span></span></a>

                    </div>
                </section>
            </div>
               
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-yellow-green" style="background: #4fb3a4"><i class="iconfont">&#xe66e;</i></div>
                    <div class="value">
                        <a  data-parent="true" data-title="今日消费">
                            <h1>{$standardsFee|format_money}</h1>
                      	<span>今日消费<span class="tip tipso_style" data-tipso="数据每天后台检测好排名再做统计">㊟</span></span></a>
                    </div>
                </section>
            </div>       
  	
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-orange" style="background: #f5b977"><i class="iconfont">&#xe62e;</i></div>
                    <div class="value">
                        <a data-parent="true" data-title="冻结资金">
                            <h1>{$freezefunds|format_money}</h1>
                      		<span>冻结资金</span>
                      	</a>
                    </div>
                </section>
            </div>
            
            
            
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-orange" style="background: #4fb3a4"><i class="iconfont">&#xe635;</i></div>
                    <div class="value">
                        <a data-parent="true" data-title="累计消费">
                            <h1>{$consumptionfunds|format_money}</h1>
                      	<span>累计消费</span>
                      	</a>
                    </div>
                </section>
            </div>
            
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-orange" style="background: #b1c914"><i class="iconfont">&#xe60e;</i></div>
                    <div class="value">
                        <a data-parent="true" data-title="可用金额">
                            <h1>{$availablefunds|format_money}</h1>
                      	<span>可用金额</span>
                      	</a>
                    </div>
                </section>
            </div>
            
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-orange"><i class="iconfont">&#xe61e;</i></div>
                    <div class="value">
                        <a data-parent="true" data-title="账户余额">
                            <h1>{$balancefunds|format_money}</h1>
                      	<span>账户余额</span>
                      	</a>
                    </div>
                </section>
            </div>
		</div>
		<div class="clear"></div>     
		<div class="mt10">
            <section class="panel">
                <div class="panel-heading">每日消耗统计</div>
                <div class="panel-body">
                    <div class="echarts" id="main" style="height:400px;"></div>
                </div>
            </section>
        </div>
	</div>
</div>
<!-- 页面底部 begin  -->
<include file="../Public/footer"/>
<!-- 页面底部 end  -->
</body>
</html>
