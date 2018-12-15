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
                    /* label: {
                      normal: {
                        show: true,
                        position: 'top'
                      }
                    }    */ 
              },
                {
                  name: '本月消耗',
                  type:'line',
                    //areaStyle: {normal: {}},
                    data: consumptions_this_month,
                    symbolSize: 8,//拐点大小
                    /* label: {
                    	normal: {
                      	show: true,
                      	position: 'top'
                    	}
                  	} */
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
  		<a class="header-arrow__left" href="{:U('Service/Home/home')}"><i class="iconfont">&#xe671;</i></a>
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
							          <i class="iconfont">&#xe696;</i>
							        </div>
							        <div class="weui-grid__label">
							        	<div>{$plan_num|default= 0}</div>
							          	<div>推广计划数</div>
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
						        	<div>{$keyword_num|default= 0}</div>
						          	<div>关键词总数</div>
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
						        	<div>{$standard_keyword_num|default= 0}</div>
						          	<div>最新达标词数</div>
						        </div>
						        <div class="clear"></div>
						        </section>
							</a>
							
							<a href="#" class="weui-grid js_grid">
							<section class="panel">
								<div class="weui-grid__icon" style="background: #4fb3a4">
						          <i class="iconfont">&#xe711;</i>
						        </div>
						        <div class="weui-grid__label">
						        	<div>{$standardsFee|format_money}</div>
						          	<div>最新首页排位</div>
						        </div>
						        <div class="clear"></div>
						        </section>
							</a>
							
				    	</div>
				    	 <div class="clear"></div>
				    	 
				    	 <div class="weui-panel weui-panel_access notify">
					  		<div class="weui-panel__hd">每日消耗统计</div>
				  			<div class="weui-panel__bd">
						    	<div class="echarts" id="main" style="height:400px;">
						  		</div>
					  		</div>
						</div>
					
					</div>
				</div>
				<div class="weui-tabbar">
					<a href="{:U('QRIndex/index')}" class="weui-tabbar__item weui-bar__item--on">
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe60a;</i>
						</div>
						<p class="weui-tabbar__label">产品概况</p>
					</a>
					<a href="{:U('QREpinfo/index')}" class="weui-tabbar__item">
						
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe6c5;</i>
						</div>
						<p class="weui-tabbar__label">企业资料</p>
						
					</a>
					<a href="{:U('QRPlan/index')}" class="weui-tabbar__item">
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe631;</i>
						</div>
						<p class="weui-tabbar__label">关键词管理</p>
					</a>
					
					<!-- <a href="{:U('Keyword/search')}" class="weui-tabbar__item">
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe612;</i>
						</div>
						<p class="weui-tabbar__label">财务管理</p>
					</a> -->
				</div>
			</div>
		</div>
	</div>
</body>
</html>

