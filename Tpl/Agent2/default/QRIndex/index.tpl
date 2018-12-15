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

        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
		var consumptions_last_month = {$consumptions_last_month};
		var consumptions_this_month = {$consumptions_this_month};
        // 指定图表的配置项和数据
        
        
        var option = {
       	    title: {
       	        text: '每日消耗（元）',
       	        left: 'center',
                   top: 10
       	    },
       	    tooltip : {
       	        trigger: 'axis',
       	        /* axisPointer: {
       	            type: 'cross',
       	            label: {
       	                backgroundColor: '#6a7985'
       	            }
       	        } */
       	    },
       	    legend: {
       	    	data:['上月消耗','本月消耗'],
                left: 'left',
       	    },
       	 	toolbox: {
	 	        show : true,
	 	        feature : {
	 	            mark : {show: true},
	 	            dataView : {show: true, readOnly: false},
	 	            magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
	 	            restore : {show: true},
	 	            saveAsImage : {show: true}
	 	        }
	 	    },
	    	calculable : true,
       	    grid: {
       	    	 left: '1%',
                 right: '3%',
                 bottom: '5%',
                 top: 80,
                 containLabel: true
       	    },
       	    xAxis : [
       	        {
   	            type : 'category',
   	            // boundaryGap : false,
   	            data:{$days},
   	            axisLabel: {
                       interval:0,//横轴信息全部显示
                     //  rotate: 60,//60度角倾斜显示
                      
                   }
       	        }
       	        
                  
       	    ],
       	    yAxis : [
       	        {
       	        	type : 'value',
	       	        axisLabel: {
	                    formatter: '{value}元'
	                }
       	        }
       	    ],
       	    series : [
       	        {
       	        	name: '上月消耗',
       	            type:'line',
       	            //areaStyle: {normal: {}},
       	            data: consumptions_last_month,
       	            symbolSize: 8,//拐点大小
                    label: {
						normal: {
							show: true,
							position: 'top'
						}
					},
					
				 /* 	markPoint : {
				 		data: [
		                    {type: 'max', name: '最大值'},
		                    {type: 'min', name: '最小值'}
		                ]
		            },  */
		            markLine : {
		                data : [
		                    {type : 'average', name : '平均值'}
		                ]
		            }
			            
       	        },
       	        {
       	        	name: '本月消耗',
       	        	type:'line',
       	            //areaStyle: {normal: {}},
       	            data: consumptions_this_month,
       	            symbolSize: 8,//拐点大小
                    label: {
						normal: {
							show: true,
							position: 'top'
						}
					},
					/* markPoint : {
				 		data: [
		                    {type: 'max', name: '最大值'},
		                    {type: 'min', name: '最小值'}
		                ]
		            },  */
					markLine : {
		                data : [
		                    {type : 'average', name : '平均值'}
		                ]
		            }
       	        }
       	    ]
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
<include file="../Public/left_qr"/>
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
		<div class="mt20">
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-blue" style="background: #ff9900"><i class="iconfont">&#xe696;</i></div>
                    <div class="value">
                        <a data-parent="true" data-title="推广计划数">
                          <h1>{$plan_num|default= 0}</h1>
                      <span>推广计划数</span></a>

                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-commred" style="background: #a6325a" ><i class="iconfont">&#xe631;</i></div>
                    <div class="value">
                        <a data-parent="true" data-title="关键词总数">
                            <h1>{$keyword_num|default= 0}</h1>
                      <span>关键词总数</span></a>

                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-dark-green" style="background: #48a7c2"><i class="iconfont">&#xe6b8;</i></div>
                    <div class="value">
                        <a data-parent="true" data-title="最新达标词数">
                            <h1>{$standard_keyword_num|default= 0}</h1>
                      <span>最新达标词数<span class="tip tipso_style" data-tipso="以最新检测时间为准">㊟</span></span></a>

                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-yellow-green" style="background: #4fb3a4"><i class="iconfont">&#xe711;</i></div>
                    <div class="value">
                        <a  data-parent="true" data-title="最新首页排位">
                            <h1>{$standardsFee|format_money}</h1>
                      	<span>最新首页排位<span class="tip tipso_style" data-tipso="以最新检测时间为准">㊟</span></span>
                      	</a>
                    </div>
                </section>
            </div>
            
           
		<div class="clear"></div>     
		<div class="">
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
