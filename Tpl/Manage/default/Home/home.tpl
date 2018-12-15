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

<link rel="stylesheet" href="__PUBLIC__/css/index.css">


<script type="text/javascript">
$(function(){ 
	// 隐藏父页面的加载进度层
	$('#loading_iframe', parent.document).hide();
	
	init_chart();
	$(window).resize(function () {          //当浏览器大小变化时
		init_chart();
	});
	
	/* var nowTime ;
    function play(){
    	var time = new Date();
    	nowTime = time.getHours()+"时"+time.getMinutes()+"分"+time.getSeconds()+"秒";
   	 	document.getElementById("time").innerHTML = nowTime;
    }
    play();
    setInterval(play,1000); */
    
	if( "{$show_hint}" == 1 ){
		var src ="{:U('Manage/Home/show_trips')}/userids/" + "{$userids_less}";
		layer_tips_right("温馨提示",src);
	}
    
}) 	

function init_chart(){
	// 基于准备好的dom，初始化echarts实例2017年4月20日 12:37:33 ：实例化账户余额
    var myChart = echarts.init(document.getElementById('account_balance'));
	var consumptions = {$balances};
    // 指定图表的配置项和数据
    var option = {
        title: {
            text: '账户余额（元）',
            subtext: '最近10天账户余额',
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
        xAxis: {
            data:{$days}
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
        
        
        /* title: {
            text: '账户余额（元）',
            subtext: '每日账户余额',
            left: 'center',
            top: 10
        },
        color: ['rgb(25, 183, 207)'],
        grid: {
            left: '3%',
            right: '3%',
            bottom: '3%',
            top: 80,
            containLabel: true
        },
        xAxis: [{
            type: 'value',
            scale: true, //这个一定要设，不然barWidth和bins对应不上
            data:{$days2}
        }],
        yAxis: [{
            type: 'value',
        }],
        series: [{
        	name: '账户余额（元）',
            type: 'bar',
            barWidth: '99.3%',
            label: {
              
            },
            data: consumptions,
        }] */
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);


/*每日消费统计*/
	var myChart2 = echarts.init(document.getElementById('main'));
		var consumptions_last_month = {$consumptions_last_month};
		var consumptions_this_month = {$consumptions_this_month};
        // 指定图表的配置项和数据
        
        
        var option2 = {
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
        myChart2.setOption(option2);
    
}
</script>
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
		{:w('MyNotifyPanel', array('RootUrl'=>$RootUrl ,'skin' => 'manage' ,'users_less' => $users_less))}   	
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
								<!-- <i class="iconfont">&#xe759;</i><i class="iconfont f20">&#xe625;</i> -->
								<span  class="usertype" >{$LoginUserInfo['role_info']['rolename']}</span>
								
							</div>
							<!-- <div>
								    会员ID：{{user.UserId}}
							</div> -->
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
						<!-- <i class="iconfont" style="font-size: 80px;color: #fff">&#xe639;</i> -->
						
					</div>
					<div class="secretary-operate f14">
						<div class="text-center">
							客服在线
							<span class="text-primary">{$LoginUserInfo['customer_name']}</span>
						</div>
						<!-- <div class="text-center mt10">
							<span class="default-transition">
								<a href="tencent://Message/?Menu=YES&amp;Uin=735283159&amp;websiteName=im.qq.com" target="_blank" class="layui-btn layui-btn-primary" style="height: 38px; line-height: 38px;margin-left: 10px;float: left;">
									<i class="iconfont">&#xe608;</i> 735283159
								</a>
							</span>
							
							<span class="default-transition">
								<a href="tel:17717368566"  class="layui-btn layui-btn-warm"   style="height: 38px; line-height: 38px;margin-right:10px;float: right;">
								<i class="iconfont">&#xe6d6;</i> 17717368566
								</a>
							</span>
						</div> -->
						
						<div class="text-center secretary-operate-buttons">
							<a href="tencent://Message/?Menu=YES&amp;Uin=735283159&amp;websiteName=im.qq.com" target="_blank" class="layui-btn layui-btn-success" style="height: 38px; line-height: 38px; width: auto;">
								<i class="iconfont">&#xe608;</i> 735283159
							</a>
							<a href="tel:17717368566"  class="layui-btn layui-btn-warm" style="height: 38px; line-height: 38px;width: auto;"> 
								<i class="iconfont">&#xe6d6;</i> 17717368566
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="tier-1-block">
				<div class="ui-panel home-tier-1">
					
					<div class="home-panel-heading notice-panel-heading clearfix">
						<a class="fr f14 line-height-1"  href="{:U('News/index')}/open_type/blank" target="_blank">更多 &gt;&gt;</a>
						<span class="notice-title text-center fl">
							系统提示
						</span>
						 
					</div>
					<div class="notice-list-panel">
						<ul class="text-link">
							<volist name="news" id="vo">
							<li class="clearfix">
								<div class="notice-content text-overflow" style="margin-right:100px;">
									<span class="list-decoration-point">•</span>
									<a href="{:U('News/detail')}/id/{$vo['id']}/open_type/blank" target="_blank" title="{$vo['newstitle']}">{$vo['newstitle']}</a>
								</div>
								<div class="fr news-time text-muted" style="width: 100px;float:right;">
									{$vo['pubtime']|format_date}
								</div>
							</li>
							</volist>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<!-- 产品详情 begin -->
		<div class="home-tier-2">
			<div class="ui-panel">
				<div class="operate-container clearfix">
					<div class="clearfix operate-container-left">
						<div class="">
							<span class="user-operate-name"><i class="iconfont mr5 f20" style="">&#xe635;</i>今日消费：</span>
							<span class="detail-count-container">
								<notempty name="products">
								<volist name="products" id="vo">
									<span class="user-balance mr10">
										<span style="color:#333;font-size: 16px;">{$vo['product_name']}</span>
										{$vo.today_consumptions|format_money} 
										<span style="font-size: 14px;">元</span>
									</span> 
								</volist>
								<else/>
								<span class="user-balance mr10">
										<span style="color:#333;font-size: 16px;"></span>
										{$vo.today_consumptions|format_money} 
										<span style="font-size: 14px;">元</span>
									</span> 
								</notempty>
								
							</span>
							<!-- <span class="user-operate-name"><i class="iconfont mr5 f20">&#xe615;</i>会员数量：</span>
							<span class="detail-count-container">
								<notempty name="members">
								<volist name="members" id="vo">
									<span class="user-balance mr10">
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
								
							</span> -->

							
							
							
						</div>
						
					</div>

				</div>
			</div>
		</div>
		<!-- 产品详情 end -->
	
		<!-- 账户余额区域 begin -->
		<div class="home-tier-3 " <if condition="$LoginUserInfo['usertype'] !='agent' && $LoginUserInfo['usertype'] !='agent2'"> style="display:none;"</if>>
			<div class="clearfix">
				<div class="home-tier-3">
					<div class="ui-panel">
						
					    <div id="account_balance"  style="width:100%;height:437px;"></div>		   
				    	
					</div>
				</div>
			</div>
		</div>
		<!-- 账户余额区域 end -->

		<!-- 每日消费统计 begin -->
		<div class="home-tier-3 ">
			<div class="clearfix">
				<div class="home-tier-3">
					<div class="ui-panel">
						
					    
					    <div class="echarts" id="main" style="height:400px;"></div>
				    	
					</div>
				</div>
			</div>
		</div>
		<!-- 每日消费统计 end -->
		
	</div>
	
</div>
<!-- 页面底部 begin  -->
<include file="../Public/footer"/>
<!-- 页面底部 end  -->
</body>
</html>