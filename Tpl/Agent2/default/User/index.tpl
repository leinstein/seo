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

.welcome .item1 .right .user_info {
	border-bottom: 1px dashed #dddddd;
	padding-bottom: 10px;
}

.welcome .item1 .right .blue {
	color: #1d8bd8;
}

.welcome .item1 .right .user_info .username {
	font-size: 24px;
}

.welcome .item1 .right .kefu_info {
	line-height: 3;
}

.welcome .item1 .right .login_info {
	line-height: 2;
	color: #cbcbcb;
}

.welcome .item1 .right .yue_info {
	
}

.welcome .item1 .right .yue_info .yue_btn {
	background-color: #efefef;
	border: 1px solid #dedede;
	color: #9c9c9c;
	padding: 9px;
	display: inline-block;
	margin-bottom: 10px;
	margin-top: 15px;
}

.welcome .item1 .right .yue_info p {
	margin-bottom: 0;
}

.welcome .item1 .right .yue_info p span.num {
	color: #ff7e00;
	font-size: 25px;
	margin-right: 30px;
}

.welcome .item2 {
	/*margin-left:20px;*/
	padding-top: 15px;
	background-color: #fff;
	width: 100%;
	/*margin-left:20px;*/
	/*margin-bottom:10px;*/
	height: 100%;
	padding-bottom: 10px;;
	margin-bottom: 0;
}

.welcome .item2 dt {
	color: #0d4fa1;
	font-size: 14px;
	line-height: 30px;
	position: relative;
	left: 0;
	top: 0;
	margin-bottom: 10px;
	padding-left: 20px;;
}

.welcome .item2 dt:after, .welcome .item2 dt:before {
	content: '';
	display: block;
	height: 1px;
	position: absolute;
	left: 0;
	bottom: 0;
}

.welcome .item2 dt:after {
	width: 100%;
	left: 20px;
	background-color: #e5e5e5;
}

.welcome .item2 dt:before {
	z-index: 9999;
	width: 80px;
	left: 20px;
	background-color: #477ceb;
}

.welcome .item2 dd {
	line-height: 2.2;
}

.welcome .item2 dd a.title {
	font-size: 12px;
	color: #666666;
	padding-left: 20px;
	position: relative;
	left: 0;
	top: 0;
}

.welcome .item2 a.title::before {
	content: '';
	width: 3px;
	height: 3px;
	border-radius: 100%;
	display: block;
	position: absolute;
	left: 10px;
	top: 50%;
	background-color: #999999;
}

.welcome .item2 dd span.date {
	color: #999999;
	margin-right: 20px;;
}

.list_lh {
	overflow: hidden;
	height: 263px;
}
</style>
		<div class="row welcome">
			<div class="col-md-12 bordered item1">
				<div class="left pull-left">
					<img src="../Public/img/img200.png" alt="">
				</div>
				<div class="right">
					<div class="user_info">
						<span class="username blue">{$LoginUserName}，欢迎您！</span>
						 <span>您的账户类型:<span class="blue">{$LoginUserInfo['usertype']}</span></span>
						<!-- <span> 您的账户ID是:<span class="blue">492</span> -->
						</span>
					</div>
					<div class="kefu_info">
						您的专属客服： QQ：3125704179
						<!-- 电话：13524024355 -->
					</div>
					<div class="login_info">
						最近登录：{$LoginUserInfo['logintime']}
						IP:{$LoginUserInfo['IPaddress']}
						{$LoginUserInfo['city']}</div>
					<div class="yue_info">
						<span class="yue_btn">可用余额：</span>
						<p>
							优站宝：<span class="num">￥{$funs_info['availablefunds']|format_money}</span> 
							<!-- 搜索通：<span class="num">￥-8.5</span>
							问答通：<span class="num">￥0</span> 新闻通：<span class="num">￥9790</span> -->

						</p>
					</div>
				</div>
			</div>
			<!-- <div class="col-md-3 list_lh">
				<dl class="news_center bordered item2">
					<dt>
						<a href="http://www.fengniaosearch.com/notice.php" target="_blank">系统公告</a>
					</dt>
					<dd class="clearfix" style="">
						href="/help_article.php?id=35"
						<a class="title pull-left">关于优站宝关键词价格...</a> <span
							class="date pull-right">2016-11-17</span>
					</dd>
					<dd class="clearfix" style="">
						href="/help_article.php?id=34"
						<a class="title pull-left">启搜宝系统-优站宝系统...</a> <span
							class="date pull-right">2016-11-01</span>
					</dd>
					<dd class="clearfix" style="">
						href="/help_article.php?id=33"
						<a class="title pull-left">启搜宝系统-搜索通系统...</a> <span
							class="date pull-right">2016-10-20</span>
					</dd>
					<dd class="clearfix" style="">
						href="/help_article.php?id=32"
						<a class="title pull-left">启搜宝系统-新闻通V1...</a> <span
							class="date pull-right">2015-07-15</span>
					</dd>
					<dd class="clearfix" style="">
						href="/help_article.php?id=13"
						<a class="title pull-left">启搜宝系统 问答通V1...</a> <span
							class="date pull-right">2016-06-27</span>
					</dd>
					<dd class="clearfix" style="">
						href="/help_article.php?id=8"
						<a class="title pull-left">启搜宝系统 搜索通V1...</a> <span
							class="date pull-right">2016-06-15</span>
					</dd>
					<dd class="clearfix" style="">
						href="/help_article.php?id=7"
						<a class="title pull-left">启搜宝系统 优站宝V1...</a> <span
							class="date pull-right">2016-06-15</span>
					</dd>
					<dd class="clearfix" style="">
						href="/help_article.php?id=88"
						<a class="title pull-left">关于优站宝预付款相关...</a> <span
							class="date pull-right">2017-01-11</span>
					</dd>
					<dd class="clearfix" style="">
						href="/help_article.php?id=65"
						<a class="title pull-left">公告：产品与文档帮助...</a> <span
							class="date pull-right">2016-11-25</span>
					</dd>
				</dl>
			</div> -->
		</div>
		<style>
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
	width: 16.66%;
}

.pro_list li:last-of-type {
	border-right: none;
}
</style>

		<!-- <div class="divide-20"></div>
		<div class="row pro_list">
			<div class="col-md-12" style="padding-left: 0;">
				<ul class="table-bordered">
					<li><a href="/admin/menumb.php?type=a" target="menu"><img
							src="../Public/img/icon200.png"></a></li>
					<li><a href="/admin/menumb.php?type=b" target="menu"><img
							src="../Public/img/icon201.png"></a></li>
					<li><a href="/admin/menumb.php?type=g" target="menu"><img
							src="../Public/img/icon202.png"></a></li>
					<li><a href="/admin/menumb.php?type=j" target="menu"><img
							src="../Public/img/icon203.png"></a></li>
					<li><a href=""><img src="../Public/img/icon204.png" alt=""></a></li>
					<li><a href=""><img src="../Public/img/icon205.png" alt=""></a></li>
				</ul>
			</div>
		</div>
-->
		<div class="divide-20"></div> 
		<style>
.fuwu {
	
}

.fuwu .box {
	background-color: #fff;
	margin-bottom: 0 !important;
}

.fuwu .box .title {
	padding-left: 20px;;
	color: #1d8bd8;
	font-size: 16px;
	padding: 20px;
}

.fuwu table {
	border-left: none;
	border-right: none;
	margin-bottom: 0;
}

.fuwu tr {
	
}

.fuwu tr:nth-of-type(1) {
	background-color: #eaf6ff;
	border-left: none;
	font-size: 16px !important;
}

.fuwu td {
	height: 50px;
	line-height: 50px !important;
	font-size: 14px !important;
}

.fuwu td:nth-of-type(1) {
	border-left: none;
}
</style>
		<div class="row fuwu ">
			<div class="col-md-12" style="padding-left: 0;">
				<div class="box table-bordered">
					<div class="header">
						<h3 class="title">产品与服务</h3>
					</div>
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td style="border-bottom: 1px solid #1d8bd8;">产品</td>
								<td>产品概况</td>
							</tr>
							<tr>
								<td>优站宝</td>
								<td style="text-align: left !important;">
								站点数：{$siteNum|default= 0}、
								关键词数：{$purchasedKeywordNum|default= 0}、
								最新达标数：{$stankeywordNum|default= 0}、
								最新达标消费：{$standardsFee|format_money}、
								累计消费：{$funs_info['total_consumption']|format_money}、
								可用余额：{$funs_info['availablefunds']|format_money}、
								产品余额：{$funs_info['balancefunds']|format_money}
								</td>
							</tr>
							<!-- <tr>
								<td>搜索通</td>
								<td style="text-align: left !important;">计划数：1、关键词数:6407、最新首页排位数:0</td>
							</tr>
							<tr>
								<td>新闻通</td>
								<td style="text-align: left !important;">今日发布：0、发布总数:4、累计计费210、产品余额:9790</td>
							</tr> -->
							<!--                  <tr>
                    <td>问答通</td>
                    <td style="text-align: left!important;">今日发布：发布总数、累计计费、产品余额</td>
                </tr>
             -->
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<style>
.tuijian {
	background-color: #fff;
}

.tuijian {
	padding: 20px;;
}

.tuijian dt {
	display: inline-block;
	color: #ff7e00;
}

.tuijian dd {
	display: inline-block;
	padding-right: 30px;
}

.tuijian dd a {
	color: #777777;
	line-height: 17px;
	padding-left: 5px;
	font-size: 14px !important;
}
</style>
		<!-- <div class="divide-20"></div>
		<div class="row ">
			<div class="col-md-12" style="padding-left: 0;">
				<dl class="tuijian table-bordered">
					<dt>推荐产品：</dt>
				</dl>
			</div>
		</div>
		<script type="text/javascript">
			setInterval(function() {
				$('.list_lh dd:last').css({
					'height' : '0px',
					'opacity' : '0'
				}).insertBefore('.list_lh dd:first').animate({
					'height' : '35px',
					'opacity' : '1'
				}, 'slow', function() {
					$(this).removeAttr('style');
				});
			}, 1000);
		</script> -->
	</div>


</body>
</html>