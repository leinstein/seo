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

        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
		var consumptions_last_month = {$consumptions_last_month};
		var consumptions_this_month = {$consumptions_this_month};
        // 指定图表的配置项和数据
        
        
        var option = {
       	    title: {
       	        text: '每日消耗（元）',
       	        left: 'center',
       	     	top: 50
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
	    	calculable : true,
       	    grid: {
       	    	 left: '1%',
                 right: '3%',
                 bottom: '5%',
                 top: 100,
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
       	        },
       	        {
       	        	name: '本月消耗',
       	        	type:'line',
       	            //areaStyle: {normal: {}},
       	            data: consumptions_this_month,
       	            symbolSize: 8,//拐点大小
             
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
       	    	top: 50
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
 	    	calculable : true,
       	    grid: {
       	    	 left: '1%',
                 right: '3%',
                 bottom: '5%',
                 top: 100,
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
					itemStyle : {
	                     normal : {
	                         lineStyle:{
	                            width:3,//折线宽度
	                            color:"#DDA490"//折线颜色
	                         }
	                     }
	                }
       	        },
       	        {
       	        	name: '本月达标',
       	            type:'line',
       	         	data: standard_num_this_month,
       	           	// areaStyle: {normal: {color:'#B1D7C6'}},
     	            symbolSize: 8,//拐点大小
					
					itemStyle : {
	                     normal : {
	                         lineStyle:{
	                            width:3,//折线宽度
	                            color:"#B1D7C6"//折线颜色
	                         }
	                     }
	                },
	                
       	        }
       	    ]
       	};

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
   
        
	}
</script>
<style>

</style>

<link rel="stylesheet" href="__PUBLIC__/css/mobile/demos.css">
</head>
<body ontouchstart>
	<div class="header">
  		<a class="header-arrow__left" href="{:U('Agent/Home/home')}"><i class="iconfont">&#xe671;</i></a>
  		<span class="header__center">产品概况</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>
		
  	<div class="page">
  		<div class="page__bd">
			<div class="weui-tab">
				<div class="weui-tab__bd">
					<div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
						
						<div class="weui-grids">
							<a href="#" class="weui-grid js_grid">
								<section class="panel">
									<div class="weui-grid__icon" style="background: #ff9900">
							          <i class="iconfont">&#xe633;</i>
							        </div>
							        <div class="weui-grid__label">
							        	<div>{$siteNum|default= 0}</div>
							          	<div>站点总数</div>
							        </div>
							        <div class="clear"></div>
						        </section>
							</a>
							<a href="#" class="weui-grid js_grid">
							<section class="panel">
								<div class="weui-grid__icon" style="background: #a6325a">
						          <i class="iconfont">&#xe631;</i>
						        </div>
						        <div class="weui-grid__label">
						        	<div>{$purchasedKeywordNum|default= 0}</div>
						          	<div>在线任务</div>
						        </div>
						        <div class="clear"></div>
						        </section>
							</a>
							
							<a href="#" class="weui-grid js_grid">
							<section class="panel">
								<div class="weui-grid__icon" style="background: #48a7c2">
						          <i class="iconfont">&#xe6b8;</i>
						        </div>
						        <div class="weui-grid__label">
						        	<div>{$stankeywordNum|default= 0}</div>
						          	<div>达标任务</div>
						        </div>
						        <div class="clear"></div>
						        </section>
							</a>
							
							<a href="#" class="weui-grid js_grid">
							<section class="panel">
								<div class="weui-grid__icon" style="background: #4fb3a4">
						          <i class="iconfont">&#xe66e;</i>
						        </div>
						        <div class="weui-grid__label">
						        	<div>{$standardsFee|format_money}</div>
						          	<div>今日消费</div>
						        </div>
						        <div class="clear"></div>
						        </section>
							</a>
							
							
							<a href="#" class="weui-grid js_grid">
								<section class="panel">
								<div class="weui-grid__icon" style="background: #f5b977">
						          <i class="iconfont">&#xe62e;</i>
						        </div>
						        <div class="weui-grid__label">
						        	<div>{$funds_pool['freezefunds']|format_money}</div>
						          	<div>冻结资金</div>
						        </div>
						        <div class="clear"></div>
						        </section>
							</a>
							
							
							<a href="#" class="weui-grid js_grid">
								<section class="panel">
									<div class="weui-grid__icon" style="background: #6F5499">
							          <i class="iconfont">&#xe617;</i>
							        </div>
							        <div class="weui-grid__label">
							        	<div>{$consumption_month|format_money}</div>
							          	<div>本月消费</div>
							        </div>
							        <div class="clear"></div>
						        </section>
							</a>
										
							<a href="#" class="weui-grid js_grid">
							<section class="panel">
								<div class="weui-grid__icon" style="background: #b1c914">
						          <i class="iconfont">&#xe635;</i>
						        </div>
						        <div class="weui-grid__label">
						        	<div>{$consumptionfunds|format_money}</div>
						          	<div>累计消费</div>
						        </div>
						        <div class="clear"></div>
						        </section>
							</a>
							
							<a href="#" class="weui-grid js_grid">
								<section class="panel">
									<div class="weui-grid__icon" style="background: #FF5722">
							          <i class="iconfont">&#xe60e;</i>
							        </div>
							        <div class="weui-grid__label">
							        	<div>{$compliance_rate}</div>
							          	<div>关键词达标率</div>
							        </div>
							        <div class="clear"></div>
							    </section>
		
							</a>
				    	</div>
				    	<div class="clear"></div>
				    	 
				    	 <div class="weui-panel weui-panel_access notify">
					  		<div class="weui-panel__hd">每日消耗统计</div>
				  			<div class="weui-panel__bd">
						    	<div class="echarts" id="main" style="height:300px;"></div>
					  		</div>
						</div>
						
						<div class="weui-panel weui-panel_access notify">
					  		<div class="weui-panel__hd">每日达标任务</div>
				  			<div class="weui-panel__bd">
						    	<div class="echarts" id="main2" style="height:300px;"></div>
					  		</div>
						</div>
					
					</div>
					
				</div>
				<div class="weui-tabbar">
					<a href="{:U('Index/index')}" class="weui-tabbar__item weui-bar__item--on">
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe60a;</i>
						</div>
						<p class="weui-tabbar__label">产品概况</p>
					</a>
					<a href="{:U('Site/effect')}" class="weui-tabbar__item">
						
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe633;</i>
						</div>
						<p class="weui-tabbar__label">站点监控</p>
						
					</a>
					<a href="{:U('Keyword/search')}" class="weui-tabbar__item">
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe612;</i>
						</div>
						<p class="weui-tabbar__label">关键词管理</p>
					</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

