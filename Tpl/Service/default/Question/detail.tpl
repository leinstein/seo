<!DOCTYPE html>
<html lang="zh-CN">
<php>//$page_title = "帐号信息";</php>
<head>
<include file="../Public/header" />

<!-- 引入文章新聞類樣式文件 css-->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/news.css">

</head>
<body class="main-body">

	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner"/>
	<!-- 页面顶部 logo & 菜单 end  -->
	
	<div class="main-wrapper">
		<div id="main-content" style="margin-bottom: 20px;">
			<div class="art">
				<h1 class="art-title">{$News['newstitle']}</h1>
				<div class="art-meta">
					<div class="bshare-custom icon-medium">
						发布时间：{$News['pubtime']}&nbsp;&nbsp;阅读次数：{$News['viewcount']}次
					</div>
			    </div>

				<div class="art-content">
				    <div id="ZoomContent">
				    	{$News['newscontent']}
				    	<!-- <p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">本服务条款是启搜宝搜索营销平台(www.qisobao.com以下称为“本网站”的经营者上海启搜网络科技有限公司(以下简称为“启搜”)，与用户(下称为“您”)，共同缔结的对双方具有约束力的有效契约。</span></p>
						<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">启搜向用户提供本网站上所展示的产品与服务(下称“启搜宝”“本服务”)，并将不断更新服务内容，最新的启搜宝以本网站上的相关产品及服务介绍的页面展示以及向用户实际提供的为准。</span></p>
						<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">第一条：总则</strong></span></p>
						<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">您确认：您在使用本服务之前，已经充分阅读、理解并接受本服务条款的全部内容(特别是以加粗及/或下划线标注的内容)，一旦您选择“同意”并完成产品操作或使用本服务，即表示您同意遵循本服务条款之所有约定。</span></p>
						<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">您同意：启搜有权随时对本服务条款及相应的服务规则内容进行单方面的变更，并有权以消息推送、网页公告等方式予以公布，而无需另行单独通知您;若您在本服务条款内容公告变更后继续使用本服务的，表示您已充分阅读、理解并接受修改后的协议内容，也将遵循修改后的条款内容使用本服务;若您不同意修改后的服务条款，您应立即停止使用本服务。</span></p>
						<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">第二条：账户</strong></span></p>
						<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">注册</strong></span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">您确认，在您完成开通启搜宝(优站宝)账号并使用本无服务时，您已经阅读并接受了本服务条款</span></p>
						<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">账户安全</strong></span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">您须自行负责对您的启搜宝账户和密码保密，且须对您在该登录名和密码下发生的所有活动(包括但不限于信息披露、发布信息、网上点击同意或提交各类规则协议、网上续签协议或购买服务等)承担责任。</span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">第三条：您的权利与业务</strong></span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">您必须保证网站服务器和域名的正常使用以及网站内容的合法性和真实性;如因此引起纠纷，启搜不承担任何法律责任。</span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">合同签订后三天内提供网站的FTP、网站后台管理等网站权限并授权启搜对您网站进行必要的修改。若您未提供或未及时提供、或提供的网站后台权限授权不够等因素而导致优化师无法登陆客户的优化网站进行技术处理，进而影响关键词排名进度或无法达到合同约定的优化排名效果，为此启搜不承担任何责任。</span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">在网站优化期间，您需要自行重新设计或更改网站代码，必须征得启搜同意，未经启搜允许，合同期内您不得擅自修改网站的信息与内容(更新产品信息除外)，因您擅自修改而造成网站排名下降您需自行承担责任。</span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">您网站所产生的第三方费用由您承担，包括但不限于网站建设费、网站空间使用费、域名费等，您须及时支付给第三方。如因您未及时支付第三方费用造成网站无法正常访问，导致您网站排名下降的，启搜不承担任何责任。</span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">若您的关键词预存款账户余额不足1000元时，启搜及时通知您续费，您应于收到续费通知三个工作日内续费，如账户余额为零时，启搜可立刻终止对您的服务，协议自行终止。</span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">第四条：启搜的权利与义务</strong></span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">启搜有义务提供专人与用户联络</span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">启搜对用户提供的网站源码和FTP信息有保密的义务;否则用户可追究相关的法律责任</span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">启搜按用户购买的关键词进行网站优化并有权对网站代码以及标题、关键词和描述进行必要的修改</span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">在优化期间，如未征得用户同意，启搜不得擅自改变网站外观</span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">第五条：服务使用规则</strong></span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">关于关键词价格</strong></span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">为了更精准的核算关键词价格，启搜宝综合了关键词指数、搜索结果数、关键词前5页独立优化站数、字符长度、地域等多种因素，由于各种因素的不确定性，关键词价格有一定范围的波动，属正常现象，最终关键词价格以系统实时查询价格为准。</span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">关于优站宝计费方式</strong></span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">优站宝计费是按天按效果计费，关键词排名做到首页后计费，不到首页不计费。启搜宝每天自动检测排名，按照实时查询到的排名进行计费。</span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">关于关键词预付款与扣费</strong></span></p>
				    	<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">为了确保关键词有足够的资金消耗从而保障关键词排名的持久性，您购买关键词时，系统会核算该站点所购买关键词30天的达标费用并按照站点将此费用作为预付款进行冻结，冻结资金依然在账户中但用户不能再利用此费用购买其他词，关键词达标之后费用会从冻结资金中进行扣除，冻结资金消耗完毕之后达标费用从账户余额中进行扣除。</span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">关于关键词停止优化规则</strong></span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">约定期限内(一般为3个月)未达标，可以申请停止优化，并释放此关键词预付的冻结费用(实际释放的金额以剩余冻结资金为准，若预付款冻结资金不足则无法释放，剩余预付款冻结资金由达标关键词继续消耗)。</span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">达标关键词合作时间(合作时间以达标起始时间为准)不得低于90天，90天内停止合作需按照90天时间进行扣除剩余天数费用。</span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">关于优站宝退款</strong></span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">到达优化约定见效的时间(一般为3个月)，所有关键词仍未见效(预付款消耗为0)，用户可以申请退款，退款申请周期为一个月。</span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">针对关键词有消耗但未消耗完的情况，合同期限内剩余金额不予退款，可以购买新词或者用于达标关键词的消耗。</span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">关于赔付</strong></span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">由于用户原因(包括但不限于网站无法正常访问、未经启搜同意用户私自改动网站等情况)导致关键词排名下降，用户需对受影响的达标关键词按照90天达标费用的剩余部分进行赔付。如关键词价格10元/天，已达标扣费60天，赔付金额=(90-60)天*10元/天，即300元。</span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">第六条：违约与责任</strong></span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">启搜责任</strong></span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">若由于启搜原因，导致服务无法完成的，用户有权要求启搜退款。不承担任何责任。若由于雇主原因致使服务商产生损失的，网站有权动用雇主托管的赏金对服务商进行赔付。</span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">用户责任</strong></span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">若由于用户原因，导致排名下降，启搜有权动用用户账号预充值进行赔付。</span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体">用户单方面违约导致合作停止，用户账户余额不予退款。</span></p>
				   		<p style="text-align: left;text-indent: 2em"><span style="font-size: 16px;font-family: 宋体"><strong style="color: #666">第七条：本规则自发布之日起实行。</strong></span></p> -->
				   	
				    </div>
				</div>
			</div>
		</div>
	</div>


</body>
</html>