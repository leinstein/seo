<!-- 浮动div开始 -->
<div id="system-support" class="system-support" style="cursor:pointer;display:none;">&nbsp; </div>
<!-- 浮动div结束 -->
<!-- 顶部菜单 begin -->
<div class="ui-top-nav  fn-linear-light shadow">
	<div class="wrapper">
		<php>if($Think.ACTION_NAME  != 'loginInner' && $LoginUserId){</php>
		<a class="nav-right-links system-support" href="javascript:void(0);">问题反馈</a><a class="nav-right-links ml10 system-support" href="javascript:void(0);"><img src="../Public/img/icon-QR.png" border="0"></a><span class="nav-right-links">您好, {$LoginUserName}, 欢迎访问!</span>
		<php>}</php>
	</div>
</div>
<!-- 顶部菜单 end -->
<div class="wrapper">
	<div class="ui-grid-row">
		<div class="ui-grid-25">
			<h1 class="main-logo"></h1>
		</div>
	</div>
	<div class="ui-grid-row">
		<div class="ui-grid-25">
			<!-- 主菜单 begin -->
			<div class="ui-nav shadow <if condition="MODULE_NAME == 'Index'  or MODULE_NAME == 'EpArchive'">ui-nav-nosub</if>">
				<ul class="ui-nav-main">
					<!-- <li class="ui-nav-item <if condition="MODULE_NAME == 'Index'">ui-nav-item-current</if>">
						<a href="{$Think.config.indexUrl}"> 首页</a>
					</li> -->
					<li class="ui-nav-item <if condition="MODULE_NAME == 'EpSpace' or MODULE_NAME == 'LeadingTalentSpace'">ui-nav-item-current</if>">
						<a href="__APP__/EpSpace/index">主体空间</a>
						<ul class="ui-nav-submain">
							<if condition="strstr($LoginUserInfo['funcontrol'],'Epspace')">
								<li class="ui-nav-subitem <if condition="MODULE_NAME == 'EpSpace'">ui-nav-subitem-current</if>"><a href="__APP__/EpSpace/index">企业空间</a></li>
							</if>
							<if condition="strstr($LoginUserInfo[funcontrol],'LeadingTalentSpace')">
								<li class="ui-nav-subitem <if condition="MODULE_NAME == 'LeadingTalentSpace'">ui-nav-subitem-current</if>"><a href="__APP__/LeadingTalentSpace/index">领军空间</a></li>
							</if>
						</ul>
					</li>
					<li class="ui-nav-item <if condition="MODULE_NAME == 'SupProject'||MODULE_NAME == 'Talentinfo'||MODULE_NAME == 'Fundinfo'||MODULE_NAME == 'EpDeclare'||MODULE_NAME == 'ProductDeclare'||MODULE_NAME == 'Patentinfo'||MODULE_NAME == 'LjztInvest'||MODULE_NAME == 'YdjjInvest'||MODULE_NAME == 'Uloancon'||MODULE_NAME == 'SkLoan'">ui-nav-item-current</if>">
						<a href="__APP__/SupProject/index">业务信息</a>
					
						<ul class="ui-nav-submain">
							<if condition="strstr($LoginUserInfo[funcontrol ],'SupProject')">
							<li class="ui-nav-subitem <if condition="MODULE_NAME == 'SupProject'">ui-nav-subitem-current</if>"><a href="__APP__/SupProject/index">科技项目查询</a></li>
							</if>
							<if condition="strstr($LoginUserInfo[funcontrol ],'Talentinfo')">
							<li class="ui-nav-subitem <if condition="MODULE_NAME == 'Talentinfo'">ui-nav-subitem-current</if>"><a href="__APP__/Talentinfo/index">科技人才查询</a></li>
							</if>
							<if condition="strstr($LoginUserInfo[funcontrol ],'Fundinfo')">
							<li class="ui-nav-subitem <if condition="MODULE_NAME == 'Fundinfo'">ui-nav-subitem-current</if>"><a href="__APP__/Fundinfo/index">科技资金查询</a></li>
							</if>
							<if condition="strstr($LoginUserInfo[funcontrol ],'EpDeclare')">
							<php>$a = urlencode('有效');$b = urlencode('待定');</php>
							<li class="ui-nav-subitem <if condition="MODULE_NAME == 'EpDeclare'">ui-nav-subitem-current</if>"><a href="__APP__/EpDeclare/index/epd03/{$a},{$b}">企业资质查询</a></li>
							</if>
							<if condition="strstr($LoginUserInfo[funcontrol ],'ProductDeclare')">
							<li class="ui-nav-subitem <if condition="MODULE_NAME == 'ProductDeclare'">ui-nav-subitem-current</if>"><a href="__APP__/ProductDeclare/index">产品资质查询</a></li>
							</if>
							<if condition="strstr($LoginUserInfo[funcontrol ],'LjztInvest')">
							<li class="ui-nav-subitem <if condition="MODULE_NAME == 'LjztInvest'">ui-nav-subitem-current</if>"><a href="__APP__/LjztInvest/index">领军直投查询</a></li>
							</if>
							<if condition="strstr($LoginUserInfo[funcontrol ],'YdjjInvest')">
							<li class="ui-nav-subitem <if condition="MODULE_NAME == 'YdjjInvest'">ui-nav-subitem-current</if>"><a href="__APP__/YdjjInvest/index">引导基金查询</a></li>
							</if>
							<if condition="strstr($LoginUserInfo[funcontrol ],'Uloancon')">
							<li class="ui-nav-subitem <if condition="MODULE_NAME == 'Uloancon'">ui-nav-subitem-current</if>"><a href="__APP__/Uloancon/index">统贷信息查询</a></li>
							</if>
							<if condition="strstr($LoginUserInfo[funcontrol ],'SKLoan')">
							<li class="ui-nav-subitem <if condition="MODULE_NAME == 'SkLoan'">ui-nav-subitem-current</if>"><a href="__APP__/SkLoan/index">苏科贷</a></li>
							</if>
						</ul>
					</li>
					<li class="ui-nav-item <if condition="MODULE_NAME == 'CountAnalyse'||MODULE_NAME ==  'Rentsubsidy' || MODULE_NAME ==  'Bussiness'|| MODULE_NAME ==  'Company'">ui-nav-item-current</if>">
						<a href="__APP__/CountAnalyse/index">统计分析</a>
						<ul class="ui-nav-submain">
							<li class="ui-nav-subitem <if condition="strpos(ACTION_NAME ,'nanometer') === 0"> ui-nav-subitem-current </if>"><a href="__APP__/CountAnalyse/nanometer">纳米技术应用产业分析</a></li>
							<if condition="strstr($LoginUserInfo[funcontrol ],'TechFundInfo')">
							<li class="ui-nav-subitem <if condition="strpos(ACTION_NAME ,'techfunds') === 0"> ui-nav-subitem-current </if>"><a href="__APP__/CountAnalyse/techfunds">科技资金分析</a></li>
						    </if>
						    <if condition="strstr($LoginUserInfo[funcontrol ],'Rentsubsidy')">
							<li class="ui-nav-subitem <if condition="MODULE_NAME=='Rentsubsidy'|| MODULE_NAME ==  'Bussiness'|| MODULE_NAME ==  'Company'"> ui-nav-subitem-current </if>"><a href="__APP__/Rentsubsidy/index">房租补贴专题分析</a></li>
							</if>
						</ul>
					</li>
					<li class="ui-nav-item <if condition="MODULE_NAME == 'Bizlog' ||MODULE_NAME == 'Datalog'">ui-nav-item-current</if>">
						<a href="__APP__/Bizlog/index">日志查询</a>
						<ul class="ui-nav-submain">
							<if condition="strstr($LoginUserInfo[funcontrol ],'Bizlog')">
							<li class="ui-nav-subitem <if condition="MODULE_NAME == 'Bizlog'">ui-nav-subitem-current</if>"><a href="__APP__/Bizlog/index">系统操作日志查询</a></li>
							</if>
							<if condition="strstr($LoginUserInfo[funcontrol ],'Datalog')">
							<li class="ui-nav-subitem <if condition="MODULE_NAME == 'Datalog'">ui-nav-subitem-current</if>"><a href="__APP__/Datalog/index">数据更新日志查询</a></li>
							</if>
						</ul>
					</li>
				</ul>
				<div class="ui-nav-subcontainer"></div>
			</div>
			<!-- 主菜单 end -->
		</div>
	</div>
</div>
