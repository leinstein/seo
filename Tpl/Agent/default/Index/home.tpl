<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "系统主页";</php>
<head>
<include file="../Public/header" />

<!--响应式css-->
<link rel="stylesheet" type="text/css" href="../Public/css/responsive.css">
<!--datepicker插件-->
<link rel="stylesheet" type="text/css" href="../Public/css/bootstrap-daterangepicker/daterangepicker-bs3.css">

<script src="../Public/js/bootstrap/bootstrap.min.js"></script>

<script type="text/javascript">
$(function(){ 
	
	
	var nowTime ;
    function play(){
    	var time = new Date();
    	nowTime = time.getHours()+"时"+time.getMinutes()+"分"+time.getSeconds()+"秒";
   	 	document.getElementById("time").innerHTML = nowTime;
    }
    play();
    setInterval(play,1000);
    

    // 基于准备好的dom，初始化echarts实例2017年4月20日 12:37:33 ：实例化账户余额
    var myChart = echarts.init(document.getElementById('account_balance'));
	var consumptions = {$balances};
    // 指定图表的配置项和数据
    var option = {
        title: {
           // text: 'ECharts 入门示例'
        },
        tooltip: {
        	
        },
        legend: {
            data:['账户余额（元）']
        },
        toolbox: {
            show: true,
            feature: {
                magicType: {show: true, type: ['stack', 'tiled']},
                saveAsImage: {show: true}
            }
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
           // smooth: true,
            data: consumptions,
            itemStyle : { normal: {label : {show: true}}},
        }]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);


	 // 基于准备好的dom，初始化echarts实例2017年4月20日 12:37:33 ：实例化用户化分布
    /*var myChart = echarts.init(document.getElementById('user_distribution'));
	var consumptions = {$consumptions};
    // 指定图表的配置项和数据
    var option = {
        title: {
           // text: 'ECharts 入门示例'
        },
        tooltip: {
        	
        },
        legend: {
            data:['用户分布']
        },
        toolbox: {
            show: true,
            feature: {
                magicType: {show: true, type: ['stack', 'tiled']},
                saveAsImage: {show: true}
            }
        },
        xAxis: {
            data:{$days}
        },
        yAxis: {
        	 type: 'value'
        },
        series: [{
            name: '用户分布',
            type: 'pie',
           // smooth: true,
            data: consumptions
        }]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
*/
    
}) 	
</script>

</head>

<body>
	<div class="container">
	<style>
		body {
			padding: 15px;;
		}
		
		.welcome {
			overflow: hidden;
		}
		
		.welcome .bordered {
			border: 1px solid #dddddd;
		}
		
		.welcome .item1 {
			/*max-width:1082px;*/
			padding: 25px 15px;
			background-color: #fff;
			float: left;
		}
		
		.welcome .item1 .left {
			
		}
		
		.welcome .item1 .left img {
			
		}
		
		.welcome .item1 .right {
			/*background-color: #f00;*/
			padding-left: 130px;
		}
		
		.welcome .item1  .user_info {
			float: left;
			height: 40px;
			line-height: 40px;
		}
		
		.welcome .item1  .other_info {
			float: right;
			height: 40px;
			line-height: 40px;
		}
		
		
		.blue {
			color: #1d8bd8;
		}
		
		.welcome .item1  .user_info .username {
			font-size: 24px;
		}
		
		
		.welcome .item2{

			padding: 5x; 
		
		}
		
		.welcome .item2  .bordered-sub {
			padding: 5x; 
		}
		
		.welcome .item2  .bordered-sub .user-icon {
			width: 60px;
			padding: 0;
			margin: 0;
			float: left;
			padding: 10px 0;
			
		}
		.welcome .item2  .bordered-sub .user-icon .iconfont {
			font-size: 50px;
		}
		
		.welcome .item2  .bordered-sub .user-info {
			padding: 0;
			margin: 0;
			float: left;
			padding: 10px 0;
		}
		
		.welcome .item2  .bordered-sub .other-info {
			padding: 0;
			margin: 0;
			padding: 20px 0;
			text-align: center;
			margin: 0 auot;
		}
		.welcome .item2  .bordered-sub .customer-info {
			padding: 0;
			margin: 0;
			padding: 10px 0;
		}
		
		.welcome .item3{
	        /*margin-left:20px;*/
	        padding-top:15px;
	        background-color: #fff;
	        width:100%;
	        /*margin-left:20px;*/
	        /*margin-bottom:10px;*/
	        height:100%;
	        padding-bottom:10px;;
	        margin-bottom:0;
	    }
	
	    .welcome .item3 dt{
	        color: #0d4fa1;
	        font-size:14px;
	        line-height:30px;
	        position: relative;
	        left:0;
	        top:0;
	        margin-bottom:10px;
	        padding-left:20px;;
	    }
	    .welcome .item3 dt:after,
	    .welcome .item3 dt:before{
	        content: '';
	        display: block;
	        height:1px;
	        position: absolute;
	        left:0;
	        bottom:0;
	    }
	    .welcome .item3 dt:after{
	        width:100%;
	        left:20px;
	        background-color: #e5e5e5;
	    }
	    .welcome .item3 dt:before{
	        z-index:9999;
	        width:80px;
	        left:20px;
	        background-color: #477ceb;
	    }
	    .welcome .item3 dd{
	        line-height:2.2;
	
	    }
	
	    .welcome .item3 dd a.title{
	        font-size:14px;
	        color: #666666;
	        padding-left:20px;
	 
	        position: relative;
	        left:0;
	        top:0;
	    }
	    .welcome .item3 a.title::before{
	        content: '';
	        width:3px;
	        height:3px;
	        border-radius: 100%;
	        display: block;
	        position: absolute;
	        left:10px;
	        top:50%;
	        background-color: #999999;
	    }
	    .welcome .item3 dd span.date{
	        color: #999999;
	        margin-right:20px;;
	    }
	    
		.list_lh{
	        overflow:hidden;
	        height: 300px;
	        padding-right: 0;
	        margin-right: 0;
    	}
    	
    	.list_lh .news_center{
    		padding: 10px;
    	}
    	
    	.pro_list {
	
		}
		
		.pro_list ul {
			overflow: hidden;
			background-color: #fff;
			padding-left: 0;
			margin-bottom: 0;
		}
		
		.pro_list li {
			float: left;
			list-style: none;
			border-right: 1px solid #e6e6e6;
			padding: 10px 40px;
			background-color: #fff;
		}
		
		.pro_list li:last-of-type {
			border-right: none;
		}

		.user-icon {
			width: 60px;
			padding: 0;
			margin: 0;
			float: left;
			padding: 10px 0;
			
		}
		.user-icon .iconfont {
			font-size: 40px;
		}
		
		.user-info {
			padding: 0;
			margin: 0;
			float: left;
			padding: 10px 0;
		}
		
		.other-info {
			padding: 0;
			margin: 0;
			padding: 20px 0;
			text-align: center;
			margin: 0 auot;
		}
		.customer-info {
			padding: 0;
			margin: 0;
			padding: 10px 0;
		}
		</style>

		
		<div class="row welcome">
		
			<div class="col-xs-12  bordered item1">
				<div class="left pull-left">
					<div class="user_info">
						<i class="iconfont" style="font-size: 30px;">&#xe65c;</i>
						欢迎 <span class="username blue">{$LoginUserName}</span>，登录米同营销代理后台。
					</div>

				</div>
				<div class="right">
					<div class="other_info">
						<span class="mr10">{$date}</span>
						<span class="mr10">{$week}</span>
						<span class="mr10" id="time"></span>
					</div>
				</div>
			</div>
			
			<div class="clear"></div>
			
			<div class="col-xs-12  bordered item2 mt20">
			
				<div class="col-xs-5 bordered-sub" style="border-right: 1px dashed #ccc;">
					<div class="user-icon">
						<i class="iconfont">&#xe75a;</i>
					</div>
					<div class="user-info">
						<div class="mt5">用户名：<span class="username blue">{$LoginUserName}</span></div>
						<div class="mt5">公司名：{$LoginUserInfo['epname']}</div>
						<div class="mt5">登录时间：{$LoginUserInfo['logintime']}</div>
					</div>
				</div>
				
				<div class="col-xs-3 bordered-sub" style="border-right: 1px dashed #ccc;">
					<div class="other-info">
						<div class="mt5"><i class="iconfont mr5">&#xe635;</i> 今日消耗：{$today_consumption|format_money}</div>
						<div class="mt5"><i class="iconfont mr5">&#xe615;</i> 会员数量：{$members_number|default=0}</div>
					</div>
				</div>
				
				<div class="col-xs-4 bordered-sub">
					<div class="customer-info">
						<div class="mt5">专属客服：<a></a></div>
						<div class="mt5">QQ： 735283159  电话：17701876236</div>
						<div class="mt5">服务时间：周一到周五 9:00 - 18:00</div>
					</div>
				</div>
			</div>
			
			<div class="clear"></div>
			
			<!-- <div class="row pro_list mt20">
			   <div class="col-md-12" style="padding-left:0;">
			       <ul class="table-bordered">
                      <li>
                     
					<div class="user-icon">
						<i class="iconfont">&#xe75a;</i>
					</div>
					<div class="user-info">
						<div>用户名：{$LoginUserName}</div>
						<div>公司名：{$LoginUserInfo['epname']}</div>
						<div>登录时间：{$LoginUserInfo['logintime']}</div>
					</div>
				</li>
                      <li><a href="/admin/menumb.php?type=b" target="menu"><img src="/admin/admin/img/icon201.png"></a></li>
                      <li><a href="/admin/menumb.php?type=g" target="menu"><img src="/admin/admin/img/icon202.png"></a></li>
                      <li><a href="/admin/menumb.php?type=j" target="menu"><img src="/admin/admin/img/icon203.png"></a></li>
	                   
			       </ul>
			   </div>
			</div> -->
			
			
			<!-- 账户余额区域 begin -->
			<div class="col-md-9 bordered item1 mt20" style="height:400px;">
		      <div id="account_balance"  style="width:100%;height:400px;"></div>
		    </div>
		    <!-- 账户余额区域 end -->
		    
		    <!-- 系统消息区域 begin -->
		    <div class="col-md-3  list_lh mt20" style="height:400px;">
		    	<div class="news_center bordered item3" style="height:400px;">
			    	<ul id="myTab" class="nav nav-tabs">
						<li class="active">
							<a href="#home" data-toggle="tab">系统公告</a>
						</li>
						<li><a href="#ios" data-toggle="tab">新手指南</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade in active" id="home">
							<dl class="" style="border: 1px solid #dddddd;border-top: none;padding-top: 10px;padding-bottom: 10px;">
		                        <dd class="clearfix">
					                <a target="_blank" href="/admin/notice_detail.php?id=7" class="title pull-left">米同营销 网站优化V1...</a>
					                <span class="date pull-right">2016-06-15</span>
					            </dd> 
					            <dd class="clearfix">
					                <a target="_blank" href="/admin/notice_detail.php?id=7" class="title pull-left">米同营销 网站优化V1...</a>
					                <span class="date pull-right">2016-06-15</span>
					            </dd> 
					            <dd class="clearfix">
					                <a target="_blank" href="/admin/notice_detail.php?id=7" class="title pull-left">米同营销 网站优化V1...</a>
					                <span class="date pull-right">2016-06-15</span>
					            </dd>     
					        
				        	</dl>
						</div>
						<div class="tab-pane fade" id="ios" style="border: 1px solid #dddddd;border-top: none;padding: 10px;">
							<p style="text-indent: 2em;line-height: 30px;font-size: 16px;">米同营销平台拥有数十名资深优化师，采用正规手法优化，快速提升网站排名，无风险排名持久有效。可推广所有搜索引擎，一帐户通用，方便快捷。平台根据关键词冷热度、竞争度定价，系统自动记录每个关键词每天排名位置，关键词排名按天按效果付费，不在首页不计费。关键词随意添加，无需专人打理，系统根据搜索引擎相关数据自动计算！</p>
						</div>
					</div>
		        </div>
		    </div>
    		<!-- 系统消息区域 end -->
			
		</div>
	
</div>


</body>
</html>