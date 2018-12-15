<!DOCTYPE html>
<html lang="zh-CN">
<php>//$page_title = "优站宝首页";</php>
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
       	        text: '每日消费（元）',
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
       	    	data:['上月消费','本月消费'],
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
       	        	name: '上月消费',
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
       	        	name: '本月消费',
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
        
        
        
     	// 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main2'));
        var standard_num_last_month = {$standard_num_last_month};
		var standard_num_this_month = {$standard_num_this_month};
		var option = {
       	    title: {
       	        text: '每日达标任务',
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
       	    	data:['上月达标','本月达标'],
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
       	            type : 'value'
       	        }
       	    ],
       	    series : [
       	        {
       	        	name: '上月达标',
       	            type:'line',
       	         	data: standard_num_last_month ,
       	            //areaStyle: {normal: {color:'#DDA490'}},
     	            symbolSize: 8,//拐点大小
					label: {
						normal: {
							show: true,
							position: 'top'
						}
					},
					itemStyle : {
	                     normal : {
	                         lineStyle:{
	                            width:3,//折线宽度
	                            color:"#DDA490"//折线颜色
	                         }
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
       	        },
       	        {
       	        	name: '本月达标',
       	            type:'line',
       	         	data: standard_num_this_month,
       	           	// areaStyle: {normal: {color:'#B1D7C6'}},
     	            symbolSize: 8,//拐点大小
					label: {
						normal: {
							show: true,
							position: 'top'
						}
					},
					itemStyle : {
	                     normal : {
	                         lineStyle:{
	                            width:3,//折线宽度
	                            color:"#B1D7C6"//折线颜色
	                         }
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
		<div class="mt20">
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-blue" style="background: #7CCD7C">站点总数</div>
                    <div class="value">
                        <a data-parent="true" data-title="站点总数">
                          <h1>{$siteNum|default= 0}</h1>
                     </a>

                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-commred" style="background: #708090" >关键词总数</div>
                    <div class="value">
                        <a data-parent="true" data-title="关键词总数">
                            <h1>{$purchasedKeywordNum|default= 0}</h1>
                   </a>

                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-dark-green" style="background: #4F94CD">最新达标词数</div>
                    <div class="value">
                        <a data-parent="true" data-title="最新达标词数">
                            <h1>{$stankeywordNum|default= 0}</h1>
                      </a>

                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-yellow-green" style="background: #00CED1">最新消费</div>
                    <div class="value">
                        <a  data-parent="true" data-title="最新消费">
                            <h1>{$standardsFee|format_money}</h1>
                      
                      	</a>
                    </div>
                </section>
            </div>
            
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-orange" style="background: #C71585">冻结资金</div>
                    <div class="value">
                        <a data-parent="true" data-title="冻结资金">
                            <h1>{$freezefunds|format_money}</h1>
                      		
                      	</a>
                    </div>
                </section>
            </div>
            
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-yellow" style="background: #CD8C95">本月消费</div>
                    <div class="value">
                        <a data-parent="true" data-title="本月消费">
                            <h1>{$consumption_month|format_money}</h1>
                      	
                      	</a>
                    </div>
                </section>
            </div>
            
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-orange" style="background: #EE7621">累计消费</div>
                    <div class="value">
                        <a data-parent="true" data-title="累计消费">
                            <h1>{$consumptionfunds|format_money}</h1>
                      	
                      	</a>
                    </div>
                </section>
            </div>
            
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-orange">关键词达标率</div>
                    <div class="value">
                        <a data-parent="true" data-title="关键词达标率">
                            <h1>{$compliance_rate|default="0%"}</h1>
                      	
                      	</a>
                    </div>
                </section>
            </div>
		</div>
		<div class="clear"></div>     
		<div class="">
            <section class="panel">
                <div class="panel-heading">每日消费统计</div>
                <div class="panel-body">
                    <div class="echarts" id="main" style="height:400px;"></div>
                </div>
            </section>
        </div>
	
     	<div class="mt10">
             <section class="panel">
                 <div class="panel-heading">每日达标任务</div>
                 <div class="panel-body">
                     <div class="echarts" id="main2" style="height:400px;"></div>
                 </div>
             </section>
     	</div>
     	<!-- <div class="mt10">
             <section class="panel">
                 <div class="panel-heading">每日达标率</div>
                 <div class="panel-body">
                     <div class="echarts" id="main3" style="height:400px;"></div>
                 </div>
             </section>
        </div> -->
	</div>
</div>
<!-- 页面底部 begin  -->
<include file="../Public/footer"/>
<!-- 页面底部 end  -->
</body>
</html>
