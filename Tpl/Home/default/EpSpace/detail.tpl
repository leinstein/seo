<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<!-- 专用风格 -->
<link href="../Public/css/special/epspace.css" rel="stylesheet">
<style>

/*自定义风格*/
.quota-high{ background:url('../Public/img/epspace/icon-high.png') no-repeat 0 12px; }
.quota-low{ background:url('../Public/img/epspace/icon-low.png') no-repeat  0 12px;  }

/*目录风格*/
.dir-content{ margin:0 0 0 100px; }
.dir-content:after{  clear: both; content: " "; display: block; font-size: 0; height: 0; visibility: hidden; }
.ui-list-dir{ width:150px; float:left; margin-top:5px;}
.ui-list-dir .title-level1{ list-style:none; font-size:15px;color:#08C;}
.ui-list-dir .title-level2{ padding-left:12px; line-height:16px; }
.ui-list-dir .title-level2 a{ color:#888;}
.ui-list-dir .title-level2 a:hover{ color:#08C;}
/*空间页边距*/
.ui-box-cotent-padding { padding: 0px 0px 0px 0px !important;}
/*查看档案信息和企业报送信息链接按钮格式*/
.ui-button-sblue {  margin: 0px 5px; border: 0px; background: #156fcd;  border-radius:4px;}
.button-link-a { width: 90px; hight: 15px; margin: 0px 5px; border: 0px; color: #fff; background: #156fcc; border-radius:4px;}
</style>
<script>

function iFrameHeight() {
        var ifm= document.getElementById("archivesdata");
        var subWeb = document.frames ? document.frames["archivesdata"].document :ifm.contentDocument;
            if(ifm != null && subWeb != null) {
            ifm.height = subWeb.body.scrollHeight;
            }
    }


//加载
$(function(){
	var dialogwidth = '950px';
	var dialogheight = '520px';
	
	//自定义脚本
	seajs.use(['arale/dialog/1.3.1/dialog'], function(Dialog) {
	    new Dialog({
			trigger: '#gsFinance',
			width: dialogwidth,
			height: dialogheight,
			 effect: 'fade',
			content: '__APP__/EpSpace/gsFinanceDetail/epid/{$epid}'
	    });
	});
	seajs.use(['arale/dialog/1.3.1/dialog'], function(Dialog) {
	    new Dialog({
			trigger: '#reportFinance',
			width: dialogwidth,
			height: dialogheight,
			 effect: 'fade',
			content: '__APP__/EpSpace/reportFinanceDetail/epid/{$epid}'
	    });
	});
	seajs.use(['arale/dialog/1.3.1/dialog'], function(Dialog) {
	    new Dialog({
			trigger: '#bzjStaff',
			width: dialogwidth,
			height: dialogheight,
			 effect: 'fade',
			content: '__APP__/EpSpace/bzjStaffDetail/epid/{$epid}'
	    });
	});
	seajs.use(['arale/dialog/1.3.1/dialog'], function(Dialog) {
	    new Dialog({
			trigger: '#gjjStaff',
			width: dialogwidth,
			height: dialogheight,
			 effect: 'fade',
			content: '__APP__/EpSpace/gjjStaffDetail/epid/{$epid}'
	    });
	});
	
	seajs.use(['arale/dialog/1.3.1/dialog'], function(Dialog) {
		$('.techpro').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/techproDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		$('.techtalent').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/techtalentDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		$('.epdeclare').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/epdeclareDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		$('.prodeclare').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/prodeclareDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		$('.patent').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/patentinfoDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		$('.follow').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/followDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		$('.direct').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/directDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		$('.loan').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/loanDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		//苏科贷详情
		$('.suLoan').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/suLoanDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		//银行贷款余额
		$('.daikuan').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/yinhangdaikuanDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		$('.policy').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/policyDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});

		$('.address').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/addressDetail/id/{$id}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		$('.Owingtax').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/OwingTaxDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		$('.OwingHousingfund').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/OwingHousingfundDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});

		$('.ICpunishment').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/ICpunishmentDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		$('.Illegaltax').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/illegalTaxDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		//统贷违约详情
		$('.Uloandefault').bind('click',function(){    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/EpSpace/illegalLoanDetail/epid/{$epid}/id/'+$(this).attr('data')
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
	});
	
	$('#repdatabtn').click(function(){
		$('#reportdetail').show()
		$('#repdata').show();
		$('#epspacebtn').show();
		$('#spacedetail').hide()
		$('#repdatabtn').hide();
		$('#epdata').hide();
	});
	
	$('#epspacebtn').click(function(){
		$('#reportdetail').hide()
		$('#repdata').hide();
		$('#epspacebtn').hide();
		$('#spacedetail').show()
		$('#repdatabtn').show();
		$('#epdata').show();
	});
	
	$('#eparchivesbtn').click(function(){
		$('#archivesdetail').show()
		$('#archivesdata').show();
		$('#epspacebtn').show();
		$('#spacedetail').hide()
		$('#eparchivesbtn').hide();
		$('#epdata').hide();
	});
	
	$('#epspacebtn').click(function(){
		$('#archivesdetail').hide()
		$('#archivesdata').hide();
		$('#epspacebtn').hide();
		$('#spacedetail').show()
		$('#eparchivesbtn').show();
		$('#epdata').show();
	});
	
});
</script>
</head>
<body>
	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner" />
	<!-- 页面顶部 logo & 菜单 end  -->
		
	<div class="wrapper">
		<!-- 顶部栏目导航 begin -->
		<div  class="ui-grid-row">
			<div class="ui-grid-25">
				<!--<a class="fr ui-button ui-button-sblue" href="javascript:void(0)" id="repdatabtn"><span class="title-text">企业报送信息查询</span></a>-->
				<if condition="$epreport"> 
					<input class="fr ui-button ui-button-sblue" href="javascript:void(0)" id="repdatabtn" type="button" value="查看企业报送信息">
				</if>
				<!--<a class="fr ui-button ui-button-sblue" href="javascript:void(0)" id="epspacebtn" style="display:none"><span class="title-text">返回企业空间详情</span></a>-->
				<input class="fr ui-button ui-button-sblue" href="javascript:void(0)" id="epspacebtn" style="display:none" type="button" value="返回企业空间详情">
				<!--<a class="fr" href="__APP__/EpArchive/detail/epid/{$_GET['epid']}"><span class="title-text">查看档案信息</span></a>-->
				<if condition="$eparchive">
				<input class="fr ui-button ui-button-sblue" type="button" value="查看企业档案信息" onclick="location.href='__APP__/EpArchive/detail/epid/{$_GET['epid']}'"></if>
				<h2 class="ui-page-title">企业空间 > <span id="spacedetail">详情</span><span id="reportdetail" style="display:none">企业报送信息</span></h2>
			</div>
		</div>
		<!-- 顶部栏目导航 end -->
		<!-- 全宽布局 begin -->
		<div class="ui-grid-row">
			<div class="ui-grid-25">
			
				<!-- 企业空间详情 begin -->
				<div class="ui-box shadow">
				    <div class="ui-box-container">
						<div class="ui-box-content">
						
							<!-- 企业报送数据 begin -->
							<iframe id="repdata" style="display:none" src="http://localhost/dcv2/index.php?s=/Report/reporteddata/epid/{$_GET['epid']}" height="500" width="950" scrolling="auto" frameborder=0></iframe>
				        	<!-- 企业报送数据 end -->
				        	
				        	<!-- 档案信息 begin -->
							<!--<iframe id="archivesdata" style="display:none" src="http://localhost/dcv2/index.php?s=/EpArchives/index/epid/{$_GET['epid']}" height="500" width="950" scrolling="auto" frameborder=0></iframe>-->
				        	<!-- 档案信息 end -->
				        	
				        	<div id="epdata">
				        	<!-- 空间头 - 企业名称，logo等 begin -->
				        	<div class="ui-space-header">				        	
				        		<div class="ui-space-header-logo">
				        			<img class="eplogo"  src="../Public/img/epspace/Logo/{$EpSpaces['paragraphs']['briefing']['data']['logo']|default='default-logo.png'}" onerror="javascript:this.src='../Public/img/epspace/Logo/default-logo.png'" />
				        		</div>
				        		<div class="ui-space-header-epkey">
			        				<h2>
				        				{$EpSpaces['summary']['data']['epname']} 
				        				<volist name="EpSpaces['summary']['data']['industrytype']" id="vo">
				        				<span class="f12 c_gray pl10">{$vo}&nbsp;</span>
				        				</volist>
				        			</h2>
				        			<ul class="ui-space-epapts">
				        				<if condition="$EpSpaces['summary']['data']['talent']">
				        				<volist name="EpSpaces['summary']['data']['talent']" id="vo">
				        				<if condition="$vo"><li class="ui-item-epapt">{$vo}</li></if>
				        				</volist>
				        				</if>
				        				<if condition="$EpSpaces['summary']['data']['epdeclare']">
				        				<volist name="EpSpaces['summary']['data']['epdeclare']" id="vo">
				        				<if condition="$vo"><li class="ui-item-epapt">{$vo}</li></if>
				        				</volist>
				        				</if>
				        			</ul>
				        		</div>
				        		<div class="ui-space-header-flag">
				        		</div>			        		
				        	</div>
				        	<!-- 空间头 - 企业名称，logo等 end -->
				        	
				        	<!-- 空间主体 begin -->
				        	<div class="ui-space-body">
				        		<!-- 企业简介 begin -->
				        		<div class="ui-space-body-paragraph paragraph-epsummary">
				        				<div class="paragraph-head">
									        <h3 class="paragraph-head-title">企业简介</h3>
									    </div>
									    <div class="paragraph-container">
									        <div class="paragraph-content">
												<p><if condition="$EpSpaces['paragraphs']['briefing']['data']['briefing']">{$EpSpaces['paragraphs']['briefing']['data']['briefing']}<else />暂无简介</if></p>   
											</div>
									    </div>
				        		</div>
				        		<!-- 企业简介 end -->
				        		
				        		<!-- 数据提示 begin -->
				        		<div class="ui-space-body-paragraph">
				        			<div class="paragraph-hint">
				        				<div class="ui-tipbox ui-tipbox-message">
										    <div class="ui-tipbox-icon">
										        <i class="iconfont" title="提示">&#xF046;</i>    
										    </div>
										    <div class="ui-tipbox-content-simple">
										        <h3 class="ui-tipbox-title">数据更新的时间在{$now_date}，数据统计的范围来自于数据中心企业库中的 {$ep_amount}家企业。</h3>
										    </div>
										</div>
				        			</div>
				        		</div>
				        		<!-- 数据提示 end -->
				        		
				        		<!-- 信息摘要和地图 begin -->
				        		<div class="ui-space-row">
			        				<!-- 信息摘要 begin -->
			        				<div class="ui-space-25">
						        		<div class="ui-space-body-paragraph paragraph-keyinfo">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title">信息摘要</h3>
										        <span class="paragraph-head-text"></span>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        	<table class="ui-table ui-table-noborder ui-table-dashline">
													    <tbody>
													    	<!-- <volist name="EpSpaces['paragraphs']['mainquota']['data']" id="vo">
													    	<if condition="$vo['value']">
													        <tr>
													            <td style="width:20%;">
													            	<if condition="$vo['value']['quotaname']=='创业创新启动资金'">其中，<elseif condition="$vo['value']['quotaname']=='房租补贴'||$vo['value']['quotaname']=='上级项目配套'"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</if>
													            	{$vo['value']['quotaname']}：
													            </td>
													            <td style="width:18%;">
													            	<if condition="$vo['value']['quotaindex']=='Q01'">
													            	{$vo['value']['quotavalue']}年
													            	<elseif condition="$vo['value']['quotaindex']=='Q02'" />
													            	{$vo['value']['quotavalue']}
													            	<elseif condition="$vo['value']['quotaindex']=='Q06'" />
													            	{$vo['value']['quotavalue']}人
													            	<elseif condition="$vo['value']['quotaindex']=='Q10'||$vo['value']['quotaindex']=='Q11'" />
													            	{$vo['value']['quotavalue']}个
													            	<else />
													            	{$vo['value']['quotavalue']|format_money='4'}万元人民币
													            	</if>
													            </td>
													            <td style="width:62%;" <if condition="$vo['compare']=='high'">class="quota-high"<elseif condition="$vo['compare']=='low'"/>class="quota-low"</if>>
													            	<if condition="$vo['value']['quotaindex']=='Q02'&&empty($vo['value']['quotavalue'])">
													            	<p>&nbsp;</p><else/>
													            	<p>{$vo['comment']}&nbsp;</p></if>
													            </td>
													        </tr>
													        </if>
													        </volist> -->
													        <tr>
													            <td style="width:20%;">成立年限：</td>
													            <td style="width:18%;"><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q01']['value']['quotavalue'] && $EpSpaces['paragraphs']['mainquota']['data']['Q01']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q01']['value']['quotavalue']}年<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q01']['value']['quotavalue']=='0'"/>一年以内<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q01']['compare']=='high' && $EpSpaces['paragraphs']['mainquota']['data']['Q01']['comment'] && $EpSpaces['paragraphs']['mainquota']['data']['Q01']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q01']['value']['quotavalue']!='-1'">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q01']['compare']=='low' && $EpSpaces['paragraphs']['mainquota']['data']['Q01']['comment'] && $EpSpaces['paragraphs']['mainquota']['data']['Q01']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q01']['value']['quotavalue']!='-1'"/>class="quota-low"</if>>
													            	<p><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q01']['comment'] && $EpSpaces['paragraphs']['mainquota']['data']['Q01']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q01']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q01']['comment']}<else/>&nbsp;</if></p>
													            </td>
													        </tr>
													        <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q02']['comment']">
													        <tr>
													            <td style="width:20%;">所属载体：</td>
													            <td style="width:18%;"><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q02']['value']['quotavalue']">{$EpSpaces['paragraphs']['mainquota']['data']['Q02']['value']['quotavalue']}<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q02']['compare']=='high' && $EpSpaces['paragraphs']['mainquota']['data']['Q02']['comment']">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q02']['compare']=='low' && $EpSpaces['paragraphs']['mainquota']['data']['Q02']['comment']"/>class="quota-low"</if>>
													            	<p>{$EpSpaces['paragraphs']['mainquota']['data']['Q02']['comment']}&nbsp;</p>
													            </td>
													        </tr>
													    	</if>
													        <tr>
													            <td style="width:20%;">注册资本：</td>
													            <td style="width:18%;">
													            	<if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q04']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q04']['value']['quotavalue']!='-1' && $EpSpaces['paragraphs']['mainquota']['data']['Q04']['value']['quotavalue']!='0'">{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['regcapital']|format_money=6}<if condition="$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['currency']=='美元'"><php>echo str_replace('元','',$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['unit']);</php><else/>{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['unit']}</if>{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['currency']} &nbsp;
													            	<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q04']['compare']=='high' && $EpSpaces['paragraphs']['mainquota']['data']['Q04']['comment']">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q04']['compare']=='low' && $EpSpaces['paragraphs']['mainquota']['data']['Q04']['comment']"/>class="quota-low"</if>>
													            	<p><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q04']['comment'] && $EpSpaces['paragraphs']['mainquota']['data']['Q04']['value']['quotavalue']!='0'">{$EpSpaces['paragraphs']['mainquota']['data']['Q04']['comment']}</if>&nbsp;</p>
													            </td>
													        </tr>
													        <tr>
													            <td style="width:20%;">主营业务收入：</td>
													            <td style="width:18%;">
													            	<if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q05']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q05']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q05']['value']['quotavalue']|format_money='4'}万元人民币<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q05']['compare']=='high' && $EpSpaces['paragraphs']['mainquota']['data']['Q05']['comment']">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q05']['compare']=='low' && $EpSpaces['paragraphs']['mainquota']['data']['Q05']['comment']"/>class="quota-low"</if>>
													            	<p>{$EpSpaces['paragraphs']['mainquota']['data']['Q05']['comment']}&nbsp;</p>
													            </td>
													        </tr>
													        <tr>
													            <td style="width:20%;">参保人数：</td>
													            <td style="width:18%;"><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q06']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q06']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q06']['value']['quotavalue']}人<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q06']['compare']=='high'">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q06']['compare']=='low'"/>class="quota-low"</if>>
													            	<p>{$EpSpaces['paragraphs']['mainquota']['data']['Q06']['comment']}&nbsp;</p>
													            </td>
													        </tr>
													        <tr>
													            <td style="width:20%;">上缴税费总额：</td>
													            <td style="width:18%;"><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q07']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q07']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q07']['value']['quotavalue']|format_money='4'}万元人民币<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q07']['compare']=='high' && $EpSpaces['paragraphs']['mainquota']['data']['Q07']['comment']">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q07']['compare']=='low' && $EpSpaces['paragraphs']['mainquota']['data']['Q07']['comment']"/>class="quota-low"</if>>
													            	<p>{$EpSpaces['paragraphs']['mainquota']['data']['Q07']['comment']}&nbsp;</p>
													            </td>
													        </tr>
													        <tr>
													            <td style="width:20%;">拥有的高新技术产品数量：</td>
													            <td style="width:18%;"><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q10']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q10']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q10']['value']['quotavalue']}个<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q10']['compare']=='high'">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q10']['compare']=='low'"/>class="quota-low"</if>>
													            	<p>{$EpSpaces['paragraphs']['mainquota']['data']['Q10']['comment']}&nbsp;</p>
													            </td>
													        </tr>
													        <tr>
													            <td style="width:20%;">承担的上级科技项目总数：</td>
													            <td style="width:18%;"><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q11']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q11']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q11']['value']['quotavalue']}个<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q11']['compare']=='high'">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q11']['compare']=='low'"/>class="quota-low"</if>>
													            	<p>{$EpSpaces['paragraphs']['mainquota']['data']['Q11']['comment']}&nbsp;</p>
													            </td>
													        </tr>
													        <tr>
													            <td style="width:20%;">获得园区科技发展资金总额：</td>
													            <td style="width:18%;"><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q12']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q12']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q12']['value']['quotavalue']|format_money4}万元人民币<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q12']['compare']=='high'">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q12']['compare']=='low'"/>class="quota-low"</if>>
													            	<p>{$EpSpaces['paragraphs']['mainquota']['data']['Q12']['comment']}&nbsp;</p>
													            </td>
													        </tr>
													        <tr>
													            <td style="width:20%;">其中，	创业创新启动资金：</td>
													            <td style="width:18%;"><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q13']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q13']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q13']['value']['quotavalue']|format_money4}万元人民币<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q13']['compare']=='high'">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q13']['compare']=='low'"/>class="quota-low"</if>>
													            	<p>{$EpSpaces['paragraphs']['mainquota']['data']['Q13']['comment']}&nbsp;</p>
													            </td>
													        </tr>
													        <tr>
													            <td style="width:20%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;房租补贴：</td>
													            <td style="width:18%;"><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q14']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q14']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q14']['value']['quotavalue']|format_money4}万元人民币<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q14']['compare']=='high'">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q14']['compare']=='low'"/>class="quota-low"</if>>
													            	<p>{$EpSpaces['paragraphs']['mainquota']['data']['Q14']['comment']}&nbsp;</p>
													            </td>
													        </tr>
													        <tr>
													            <td style="width:20%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;上级项目配套：</td>
													            <td style="width:18%;"><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q15']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q15']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q15']['value']['quotavalue']|format_money4}万元人民币<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q15']['compare']=='high'">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q15']['compare']=='low'"/>class="quota-low"</if>>
													            	<p>{$EpSpaces['paragraphs']['mainquota']['data']['Q15']['comment']}&nbsp;</p>
													            </td>
													        </tr>
													        <tr>
													            <td style="width:20%;">园区政策性贷款总额：</td>
													            <td style="width:18%;"><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q16']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q16']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q16']['value']['quotavalue']|format_money4}万元人民币<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q16']['compare']=='high'">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q16']['compare']=='low'"/>class="quota-low"</if>>
													            	<p>{$EpSpaces['paragraphs']['mainquota']['data']['Q16']['comment']}&nbsp;</p>
													            </td>
													        </tr>
													        <tr>
													            <td style="width:20%;">园区政策性直接投资总额：</td>
													            <td style="width:18%;"><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q17']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q17']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q17']['value']['quotavalue']|format_money4}万元人民币<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q17']['compare']=='high'">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q17']['compare']=='low'"/>class="quota-low"</if>>
													            	<p>{$EpSpaces['paragraphs']['mainquota']['data']['Q17']['comment']}&nbsp;</p>
													            </td>
													        </tr>
													        <tr>
													            <td style="width:20%;">园区政策性跟进投资总额：</td>
													            <td style="width:18%;"><if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q18']['value']['quotavalue']!=null && $EpSpaces['paragraphs']['mainquota']['data']['Q18']['value']['quotavalue']!='-1'">{$EpSpaces['paragraphs']['mainquota']['data']['Q18']['value']['quotavalue']|format_money4}万元人民币<else/>暂未取得</if></td>
													            <td style="width:62%;" <if condition="$EpSpaces['paragraphs']['mainquota']['data']['Q18']['compare']=='high'">class="quota-high"<elseif condition="$EpSpaces['paragraphs']['mainquota']['data']['Q18']['compare']=='low'"/>class="quota-low"</if>>
													            	<p>{$EpSpaces['paragraphs']['mainquota']['data']['Q18']['comment']}&nbsp;</p>
													            </td>
													        </tr>
													    </tbody>
													</table>
												</div>
										    </div>
						        		</div>
					        		</div>
					        		<!-- 信息摘要 end -->
					        		<!-- 企业地图 begin -->
					        		<div class="ui-space-7">
					        			<div class="epmap">
					        			
					        			</div>
					        		</div>
					        		<!-- 企业地图 end -->
				        		</div>
				        		<!-- 信息摘要和地图 end -->
				        		
				        		<!-- 信息目录 begin -->
				        		<div class="ui-space-body-paragraph paragraph-dir">
								    <div class="paragraph-container">
								        <div class="paragraph-content dir-content">
								        
								        	<ul class="ui-list ui-list-dir" style="padding-top:0px;">									        		
								        		<li class="ui-list-item title-level1"><a href="#baseinfo">1&nbsp;企业基本信息</a></li>
								        		<li class="ui-list-item title-level2"><a style="line-height:16px;" href="#reg">注册信息</a></li>
								        		<li class="ui-list-item title-level2"><a style="line-height:16px;" href="#ext">扩展信息</a></li>
												<li class="ui-list-item title-level2"><a style="line-height:16px;" href="#industryInfo">产业信息</a></li>
								        		<li class="ui-list-item title-level2"><a style="line-height:16px;" href="#contact">联系信息</a></li>
								        		<li class="ui-list-item title-level2"><a style="line-height:16px;" href="#account">账户信息</a></li>
								        		<li class="ui-list-item title-level2"><a style="line-height:16px;" href="#account">经营场所</a></li>
								        		<li class="ui-list-item title-level1"><a style="line-height:16px;" href="#finance">2&nbsp;企业财务信息</a></li>
								        	</ul>
								        	
								        	<ul class="ui-list ui-list-dir" style="padding-top:0px;">
								        		<li class="ui-list-item title-level1"><a href="#staff">3&nbsp;企业人员信息</a></li>
								        		<li class="ui-list-item title-level1"><a href="#tech">4&nbsp;科技信息</a></li>
								        		<li class="ui-list-item title-level2"><a href="#techpro">科技项目</a></li>
								        		<li class="ui-list-item title-level2"><a href="#talent">科技人才</a></li>
								        		<li class="ui-list-item title-level2"><a href="#epdeclare">企业资质</a></li>
								        		<li class="ui-list-item title-level2"><a href="#prodeclare">产品资质</a></li>
								        		<li class="ui-list-item title-level2"><a href="#patent">专利信息</a></li>
								        	</ul>
								        	
								        	<ul class="ui-list ui-list-dir" style="width:200px;padding-top:0px;">
								        		<notempty name="EpSpaces['paragraphs']['equityinfo']">
								        		
								        		<li class="ui-list-item title-level1"><a href="#equity">5&nbsp;企业融资信息</a></li>
								        		<li class="ui-list-item title-level2"><a href="#follow">园区创业投资引导基金跟进投资</a></li>
								        		<li class="ui-list-item title-level2"><a href="#direct">园区领军创业投资基金直接投资</a></li>
								        		<li class="ui-list-item title-level2"><a href="#loan">园区统贷平台委托贷款</a></li>
								        		<li class="ui-list-item title-level2"><a href="#suLoan">苏科贷</a></li>
								        		<li class="ui-list-item title-level2"><a href="#daikuan">贷款余额</a></li>
								        		</notempty>
								        		<li class="ui-list-item title-level1"><a href="#policy">{$EpSpaces['paragraphs']['calalogue']['order']['policy']}&nbsp;园区科技发展资金</a></li>									        		
								        	</ul>
								        	
								        	<ul class="ui-list ui-list-dir" style="padding-top:0px;">
								        		<notempty name="EpSpaces['paragraphs']['negative']">
								        		<li class="ui-list-item title-level1"><a href="#Negative">7&nbsp;负面记录</a></li>
								        		<li class="ui-list-item title-level2"><a href="#Owingtax">税务欠税记录（地税）</a></li>
								        		<li class="ui-list-item title-level2"><a href="#OwingHousingfund">公积金欠费记录</a></li>
								        		<li class="ui-list-item title-level2"><a href="#OwingRent">房租欠费记录</a></li>
								        		<li class="ui-list-item title-level2"><a href="#ICpunishment">工商行政处罚</a></li>
								        		<li class="ui-list-item title-level2"><a href="#Illegaltax">税务违法（地税）</a></li>
								        		<li class="ui-list-item title-level2"><a href="#Uloandefault">统贷违约</a></li>
								        		</notempty>
								        	</ul> 
								        	<div class="clear"></div>
										</div>
								    </div>
				        		</div>
				        		<!-- 信息目录 end -->
				        		
				        		<!-- 信息正文 begin  -->
				        		<div class="ui-space-row">
				        			<!-- 左侧正文内容 begin -->
				        			<div class="ui-space-22">	
				        				<notempty name="EpSpaces['paragraphs']['baseinfo']">     			
						        		<!-- 企业基本信息 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level1">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="baseinfo"></a><span class="title-no">{$EpSpaces['paragraphs']['calalogue']['order']['baseinfo']}</span><span class="title-text">企业基本信息</span> </h3>
										    </div>
										    <div class="paragraph-container" style="display:none;">
										        <div class="paragraph-content">
												</div>
										    </div>
						        		</div>
						        		
						        		<!-- 注册信息 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="reg"></a>注册信息 </h3>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        	<!-- 两栏列表文字 begin -->
										        	<dl class="ui-dlist ui-dlist-col1">
										        		<dt class="ui-dlist-tit">企业名称：</dt>
													    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['entername']} &nbsp;</dd>
													    <dt class="ui-dlist-tit">组织机构代码：</dt>
													    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['organcode']} &nbsp;</dd>
										        		<dt class="ui-dlist-tit">法定代表人：</dt>
													    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['corporate']} &nbsp;</dd>
													    <dt class="ui-dlist-tit">法人库状态：</dt>
													    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['epstatus']}&nbsp;</dd> 
										        	</dl>
										        	<dl class="ui-dlist ui-dlist-col2">
													    <dt class="ui-dlist-tit">工商执照注册号：</dt>
													    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['corpregnumber']} &nbsp;</dd>
													    <dt class="ui-dlist-tit">注册时间：</dt>
													    <dd class="ui-dlist-det"><if condition="$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['regdate']=='0000-00-00'||$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['regdate']=='1900-01-01'">&nbsp;<else/>{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['regdate']} &nbsp;</if></dd>
										        		<dt class="ui-dlist-tit">注册资本：</dt>
													    <dd class="ui-dlist-det"><if condition="$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['regcapital']">{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['regcapital']|format_money=6}<if condition="$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['currency']=='美元'"><php>echo str_replace('元','',$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['unit']);</php><else/>{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['unit']}</if>{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['currency']}&nbsp; <else/>&nbsp;</if></dd>
										        		<dt class="ui-dlist-tit">注册类型：</dt>
													    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['regtype']}&nbsp;</dd>
										        		
										        	</dl>
										        	<div class="clear"></div>
										        	<dl class="ui-dlist ui-dlist-col1" style="width:100%;">
										        		<dt class="ui-dlist-tit" style="width: 14%;">注册地址：</dt>
													    <dd class="ui-dlist-det" style="width: 82%;">{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['regaddress']}&nbsp;</dd>
													    <dt class="ui-dlist-tit" style="width: 14%;">经营范围：</dt>
													    <dd class="ui-dlist-det" style="width: 82%;">{$EpSpaces['paragraphs']['baseinfo']['child'][0]['data']['businessscope']}&nbsp;</dd>    
										        	</dl>
									        		<!-- 两栏列表文字 end -->
												</div>
										    </div>
						        		</div>
						        		<!-- 注册信息 end -->
						        		
						        		<!-- 扩展信息 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="ext"></a>扩展信息 </h3>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        	<!-- 两栏列表文字 begin -->
										        	<dl class="ui-dlist ui-dlist-col1">
										        		<dt class="ui-dlist-tit">所属载体：</dt>
													    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][1]['data']['carrier']} &nbsp;</dd>
													    <dt class="ui-dlist-tit">所属产业：</dt>
													    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][1]['data']['industrytype']} &nbsp;</dd>	    
										        	</dl>
										        	<dl class="ui-dlist ui-dlist-col2">
										        		<dt class="ui-dlist-tit">招商部门：</dt>
													    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][1]['data']['partment']}&nbsp; </dd>
													    <dt class="ui-dlist-tit">曾用名：</dt>
													    <dd class="ui-dlist-det">{$EpSpaces['summary']['data']['bfname']}&nbsp; </dd>
										        	</dl>
										        	<div class="clear"></div>
									        		<!-- 两栏列表文字 end -->
												</div>
										    </div>
						        		</div>
						        		<!-- 扩展信息 end -->
						        		
						        		<!-- 产业信息 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
						        			<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="industryInfo"></a>产业信息 </h3>
										    </div>
						        			<div class="paragraph-container">
										        <div class="paragraph-content">
										        	<!-- 官方标记内容 begin -->
										        	<div class="ui-space-body-paragraph paragraph-level2" style="padding:0px 0px;">
											        	<div class="paragraph-head">
											        		<h3 class="paragraph-head-title">官方标记 </h3>
											    		</div>
											    		<div class="paragraph-container">
										        			<div class="paragraph-content">
																<!-- 产业特征 begin -->
																<table class="ui-table ui-table-data mt10">
																	<thead>
																		<tr>
																			<th width="60%">产业特征</th>
																			<th width="40%">标记部门</th>
																		</tr>
																	</thead>
																	<if condition = "$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['indusfeature'] || $EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['deptname_gov']">
																		<tbody>
																			<tr>
																				<td>{$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['indusfeature']}</td>
																				<td>{$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['deptname_gov']}</td>
																			</tr>
																		</tbody>
																	<else />
																		<tfoot>
																			<tr>
																				<td colspan="2" style="text-align:center;">暂无数据</td>
																			</tr>
																		</tfoot>
																	</if>
																</table>
																<!-- 产业特征 end -->
																<!-- 产业分类 begin -->
																<table class="ui-table ui-table-data mt10">
																	
																	<thead>
																		<tr>
																			<th width="60%">产业分类</th>
																			<th width="40%">标记部门</th>
																		</tr>
																	</thead>
																	
																	<if condition="$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['industypeinfo']">
																		<tbody>
																			<volist name="EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['industypeinfo']" id="vo">
																				<tr>
																					<td>{$vo['industype']|str_replace=",","<br/>",###}</td>
																					<td>{$vo['deptname_gov']}</td>
																				</tr>
																			</volist>
																		</tbody>
																	<else />
																		<tfoot>
																			<tr>
																				<td colspan="2" style="text-align:center;">暂无数据</td>
																			</tr>
																		</tfoot>
																	</if>
																</table>
																<!-- 产业分类 end -->
													    		<!--<dl class="ui-dlist ui-dlist-col1">
													        		<dt class="ui-dlist-tit">产业特征：</dt>
																    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['indusfeature']}&nbsp;</dd>
																    <dt class="ui-dlist-tit">产业分类：</dt>
																    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['indussort']} &nbsp;</dd>
													        	</dl>
													        	<dl class="ui-dlist ui-dlist-col2">
													        		<dt class="ui-dlist-tit">标记部门：</dt>
																    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['carrier']} &nbsp;</dd>
																    <dt class="ui-dlist-tit">标记部门：</dt>
																    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['ofdeptname']} &nbsp;</dd>
													        	</dl>-->
													        </div>
													    </div>
										        	</div>
										        	<!-- 官方标记内容 end -->
										        	
										        	<!-- 招商载体标记内容 begin -->
										        	<div class="ui-space-body-paragraph paragraph-level2" style="padding:0px 0px;">
											        	<div class="paragraph-head">
											        		<h3 class="paragraph-head-title">招商载体标记 </h3>
											    		</div>
											    		<div class="paragraph-container">
										        			<div class="paragraph-content">
																<!-- 产业特征 begin -->
																<table class="ui-table ui-table-data mt10">
																	<thead>
																		<tr>
																			<th width="60%">产业特征</th>
																			<th width="40%">标记部门</th>
																		</tr>
																	</thead>
																	<if condition = "$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['indusfeature_org'] || $EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['deptname_org']">
																		<tbody>
																			<tr>
																				<td>{$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['indusfeature_org']}</td>
																				<td>{$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['deptname_org']}</td>
																			</tr>
																		</tbody>
																	<else />
																		<tfoot>
																			<tr>
																				<td colspan="2" style="text-align:center;">暂无数据</td>
																			</tr>
																		</tfoot>
																	</if>
																</table>
																<!-- 产业特征 end -->
																<table class="ui-table ui-table-data mt10">
																	<thead>
																		<tr>
																			<th width="60%">产业分类</th>
																			<th width="40%">标记部门</th>
																		</tr>
																	</thead>
																	<if condition="$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['industypeinfo_org']">
																		<tbody>
																			<volist name="EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['industypeinfo_org']" id="vol">
																				<tr>
																					<td>{$vol['industype_org']|str_replace=",","<br/>",###}</td>
																					<td>{$vol['deptname_org']}</td>
																				</tr>
																			</volist>
																		<tbody>
																	<else />
																		<tfoot>
																			<tr>
																				<td colspan="2" style="text-align:center;">暂无数据</td>
																			</tr>
																		</tfoot>
																	</if>
																</table>
													        	<!--<dl class="ui-dlist ui-dlist-col1">
													        		<dt class="ui-dlist-tit">产业分类：</dt>
																    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['carriertag']} &nbsp;</dd>
													        	</dl>
													        	<dl class="ui-dlist ui-dlist-col2">
													        		<dt class="ui-dlist-tit">标记部门：</dt>
																    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][5]['data']['deptname']} &nbsp;</dd>
													        	</dl>-->
													        </div>
													    </div>
										        	</div>
										        	<!-- 招商载体标记内容 end -->
										        </div>
										    </div>
						        		</div>
						        		<!-- 产业信息 end -->
						        		
						        		<!-- 联系信息 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="contact"></a>联系信息 </h3>
										        <!-- <span class="paragraph-head-text">其他文字</span> -->
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        	<!-- 两栏列表文字 begin -->
										        	<dl class="ui-dlist ui-dlist-col1">
										        		<dt class="ui-dlist-tit">总经理：</dt>
													    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][2]['data']['manage']['manager']}&nbsp;</dd>
													    <dt class="ui-dlist-tit"> 总经理电话：</dt>
													    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][2]['data']['manage']['managermobile']} &nbsp;</dd>
										        	</dl>
										        	<dl class="ui-dlist ui-dlist-col2">
										        		<dt class="ui-dlist-tit">总经理邮箱：</dt>
													    <dd class="ui-dlist-det">{$EpSpaces['paragraphs']['baseinfo']['child'][2]['data']['manage']['manageremail']}&nbsp;</dd>
										        	</dl>
										        	<div class="clear"></div>
									        		<!-- 两栏列表文字 end -->
									        		<div class="clear"></div>
									        		<!-- 联系人表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="25%">联系人</th>
													            <th width="25%">移动电话</th>
													            <th width="25%">固定电话</th>
													            <th width="25%">电子邮箱</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['baseinfo']['child'][2]['data']['normal']">
													    	<volist name="EpSpaces['paragraphs']['baseinfo']['child'][2]['data']['normal']" id="vo">
													        <tr>
													            <td>{$vo['contacts']}&nbsp;</td>
													            <td>{$vo['mobilephone']}&nbsp;</td>
													            <td>{$vo['telephone']}&nbsp;</td>
													            <td>{$vo['email']}&nbsp;</td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=100 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 联系人表格 end -->
												</div>
										    </div>
						        		</div>
						        		<!-- 联系信息 end -->
						        		
						        		<!-- 账户信息 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="account"></a>账户信息 </h3>
										        <!-- <span class="paragraph-head-text">其他文字</span> -->
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
									        		<!-- 账户表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="10%">账户类型</th>
													            <th width="30%">开户行</th>
													            <th width="30%">开户名</th>
													            <th width="30%">银行账号</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['baseinfo']['child'][3]['data']">
													    	<volist name="EpSpaces['paragraphs']['baseinfo']['child'][3]['data']" id="vo">
													        <tr>
													            <td>{$vo['type']}&nbsp;</td>
													            <td>{$vo['bankname']}&nbsp;</td>
													            <td>{$vo['accountapplyer']}&nbsp;</td>
													            <td>{$vo['account']}&nbsp;</td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=100 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 账户表格 end -->
												</div>
										    </div>
						        		</div>
						        		<!-- 账户信息 end -->
						        		<!-- 经营场所 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="account"></a>经营场所 </h3>
										        <!-- <span class="paragraph-head-text">其他文字</span> -->
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
									        		<!-- 账户表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="50%">经营场所</th>
													            <th width="44%">面积（㎡）</th>
													            <th width="6%">操作</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['baseinfo']['child'][4]['data']">
													    	<volist name="EpSpaces['paragraphs']['baseinfo']['child'][4]['data']" id="vo">
													        <tr>
													            <td>{$vo['businessaddress']}&nbsp;</td>
													            <td>{$vo['area']}&nbsp;</td>
													            <td style="text-align:right"><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more address">详情</a></td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=100 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 账户表格 end -->
												</div>
										    </div>
						        		</div>
						        		<!-- 经营场所 end -->
						        		<!-- 企业基本信息  end -->	
						        		</notempty>
						        		
						        		<notempty name="EpSpaces['paragraphs']['financeinfo']">
						        		<!-- 企业财务信息 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level1">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="finance"></a><span class="title-no">{$EpSpaces['paragraphs']['calalogue']['order']['financeinfo']}</span><span class="title-text">企业财务信息</span></h3>
										    </div>
										    <div class="paragraph-container" style="display:none;">
										        <div class="paragraph-content">
												</div>
										    </div>
						        		</div>
						        		
						        		<!-- 来源于国税的财务信息 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title">财务信息，数据来源：官方渠道  </h3>
										        <span class="paragraph-head-text">单位：万元人民币</span>
										        <notempty name="EpSpaces['paragraphs']['financeinfo']['child'][0]['data']">
										        	<a href="javascript:void(0)" id="gsFinance" class="paragraph-head-more">详情</a>
										        </notempty>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="10%">年度</th>
													            <!-- <th>净入库税金</th> -->
													            <!-- <th>减免税金</th> -->
													            <th width="20%" style="text-align:right">资产总额</th>
													            <th width="25%" style="text-align:right">实收资本</th>
													            <th width="25%" style="text-align:right">主营业务收入</th>
													            <th width="20%" style="text-align:right">净利润</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['financeinfo']['child'][0]['data']">
													    	<volist name="EpSpaces['paragraphs']['financeinfo']['child'][0]['data']" id="vo">
													        <tr>
													            <td>{$vo['year']}</td>
													            <!-- <td>{$vo['storagetaxes']}</td> -->
													            <!-- <td>{$vo['reductiontaxes']}</td> -->
													            <td style="text-align:right">{$vo['assets']/10000|format_money1=2}</td>
													            <td style="text-align:right">{$vo['realitycapital']/10000|format_money1=2}</td>
													            <td style="text-align:right"><neq name="vo['mainoperreceipt']" value="">{$vo['mainoperreceipt']/10000|format_money1=2}<else />暂无信息</neq></td>
													            <td style="text-align:right"><neq name="vo['netmargin']" value="">{$vo['netmargin']/10000|format_money1=2}<else />暂无信息</neq></td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=5 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 来源于国税的财务信息 end -->
						        		
						        		<!-- 来源于国税的财务信息 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title">财务信息，数据来源：企业自报  </h3>
										        <span class="paragraph-head-text">单位：万元人民币</span>
										        <notempty name="EpSpaces['paragraphs']['financeinfo']['child'][1]['data']">
										        	<a href="javascript:void(0)" id="reportFinance" class="paragraph-head-more">详情</a>
										        </notempty>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="15%">报表时点</th>
													            <th width="25%">报表类型</th>
													            <th width="15%" style="text-align:right">资产总额</th>
													            <th width="15%" style="text-align:right">实收资本</th>
													            <th width="15%" style="text-align:right">主营业务收入</th>
													            <th width="15%" style="text-align:right">净利润</th>
													            <!-- <th>是否审计</th> -->
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['financeinfo']['child'][1]['data']">
													    	<volist name="EpSpaces['paragraphs']['financeinfo']['child'][1]['data']" id="vo">
													        <tr>
													            <td>{$vo['reporttime']}</td>
													            <td>{$vo['reporttype']}</td>
													            <td style="text-align:right">{$vo['assets']|format_money1=2}</td>
													            <td style="text-align:right">{$vo['realitycapital']|format_money1=2}</td>
													            <td style="text-align:right"><neq name="vo['mainoperreceipt']" value="">{$vo['mainoperreceipt']|format_money1=2}<else />暂无信息</neq></td>
													            <td style="text-align:right"><neq name="vo['netmargin']" value="">{$vo['netmargin']|format_money1=2}<else />暂无信息</neq></td>
													            <!-- <td>{$vo['auditsign']}</td> -->
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=6 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 来源于国税的财务信息 end -->

						        		<!-- 来源于国税的纳税信息 begin -->
						        		<!-- <notempty name="EpSpaces['paragraphs']['financeinfo']['child'][3]">
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title">纳税信息，数据来源：官方渠道   </h3>
										        <span class="paragraph-head-text">单位：万元人民币</span> -->
										     <!--   <a href="javascript:void(0)" id="reportFinance" class="paragraph-head-more">详情</a>-->
										   <!--  </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content"> -->
										        
									        		<!-- 数据表格 begin -->
									        		<!-- <table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="25%">纳税年度</th>
													            <th width="30%">上缴税费总额  </th>
													            <th width="30%" >营业税</th>
													            <th width="15%" >企业所得税</th> -->
													            <!-- <th>是否审计</th> -->
													        <!-- </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['financeinfo']['child'][3]['data']">
													    	<volist name="EpSpaces['paragraphs']['financeinfo']['child'][3]['data']" id="vo">
													        <tr>
													            <td>{$vo['year']}</td>
													            <td>{$vo['storagetaxes']/10000|format_money1=2}</td>
													            <td >{$vo['businesstax']/10000|format_money1=2}</td>
													            <td >{$vo['eptincometax']/10000|format_money1=2}</td> -->
													            <!-- <td>{$vo['auditsign']}</td> -->
													       <!--  </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=4 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table> -->
									        		<!-- 数据表格 end -->
									        		
												<!-- </div>
										    </div>
						        		</div>
						        		</notempty> -->
						        		<!-- 来源于国税的纳税信息 end -->


						        		<!--税收优惠begin-->
						        		<notempty name="EpSpaces['paragraphs']['financeinfo']['child'][2]">
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title">税收优惠信息，数据来源：官方渠道  </h3>
										        <span class="paragraph-head-text">单位：万元人民币</span><span class="paragraph-head-more">优惠金额总计：{$EpSpaces['paragraphs']['financeinfo']['child'][2]['sum']|format_money1}</span>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="10%">年度</th>
													            <th width="30%">所得税主管部门</th>
													            <th width="15%">税种</th>
													            <th width="30%">税收优惠类型</th>
													            <th width="15%">税收优惠金额</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['financeinfo']['child'][2]['data']">
													    	<volist name="EpSpaces['paragraphs']['financeinfo']['child'][2]['data']" id="vo">
													        <tr>
													            <td>{$vo['year']}</td>
													            <td>{$vo['taxheadunit']}</td>
													            <td>{$vo['taxtype']}</td>
													            <td>{$vo['taxincenttype']}</td>
													            <td>{$vo['taxincentamount']|format_money1=2}</td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=5 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		</notempty>
						        		<!--税收优惠end-->
						        		<!-- 企业财务信息  end -->	
						        		</notempty>
						        		
						        		<notempty name="EpSpaces['paragraphs']['staffinfo']">
						        		<!-- 人员信息 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level1">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="staff"></a><span class="title-no">{$EpSpaces['paragraphs']['calalogue']['order']['staffinfo']}</span><span class="title-text">人员信息</span> </h3>
										    </div>
										    <div class="paragraph-container" style="display:none;">
										        <div class="paragraph-content">
												</div>
										    </div>
						        		</div>
						        		
						        		<!-- 来源苏州工业园区劳动和社会保障局信息 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title">数据来源：苏州工业园区劳动和社会保障局  </h3>
										        <notempty name="EpSpaces['paragraphs']['staffinfo']['child'][0]['data']">
										        	<a href="javascript:void(0)" id="bzjStaff" class="paragraph-head-more">更多</a>
										        </notempty>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th>截止时点</th>
													            <th>劳动合同备案人数</th>
													            <th>全日制合同人数</th>
													            <th>本科学历人数</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['staffinfo']['child'][0]['data']">
													    	<volist name="EpSpaces['paragraphs']['staffinfo']['child'][0]['data']" id="vo" offset="0" length="3">
													        <tr>
													            <td>{$vo['ddate']}</td>
													            <td>{$vo['labcontractnum']}</td>
													            <td>{$vo['fullcontractnum']}</td>
													            <td>{$vo['undergradnum']}</td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=4 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 来源苏州工业园区劳动和社会保障局信息 end -->
						        		
						        		<!-- 来源苏州工业园区公积金管理中心 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title">数据来源：苏州工业园区公积金管理中心   </h3>
										        <notempty name="EpSpaces['paragraphs']['staffinfo']['child'][1]['data']">
										        	<a href="javascript:void(0)" id="gjjStaff" class="paragraph-head-more">更多</a>
										        </notempty>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th>人员统计时点</th>
													            <th>企业参保人数</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['staffinfo']['child'][1]['data']">
													    	<volist name="EpSpaces['paragraphs']['staffinfo']['child'][1]['data']" id="vo" offset="0" length="3">
													        <tr>
													            <td>{$vo['ddate']}</td>
													            <td>{$vo['accnum']}</td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=2 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 来源苏州工业园区公积金管理中心 end -->
						        		<!-- 人员信息  end -->
						        		</notempty>
						        		
						        		<notempty name="EpSpaces['paragraphs']['techinfo']">
						        		<!-- 科技信息 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level1">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="tech"></a><span class="title-no">{$EpSpaces['paragraphs']['calalogue']['order']['techinfo']}</span><span class="title-text">科技信息</span> </h3>
										    </div>
										    <div class="paragraph-container" style="display:none;">
										        <div class="paragraph-content">
												</div>
										    </div>
						        		</div>
						        		
						        		<!-- 科技项目 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="techpro"></a>科技项目  </h3>
										    	<!-- <span class="paragraph-head-text">单位：万元人民币</span> -->
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="10%">立项年度</th>
													            <th width="20%">发文项目名称</th>
													            <th width="20%">项目类型</th>
													            <th width="30%">项目子类</th>
													            <th width="14%">项目状态</th>
													            <th width="6%">操作</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['techinfo']['child'][0]['data']">
													    	<volist name="EpSpaces['paragraphs']['techinfo']['child'][0]['data']" id="vo">
													        <tr>
													            <td>{$vo['year']}</td>
													            <td>{$vo['projectname']}</td>
													            <td>{$vo['projecttype']}</td>
													            <td>{$vo['subclass']}</td>
													            <td>{$vo['pjstatus']}</td>
													            <td><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more techpro">详情</a></td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=6 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 科技项目 end -->
						        		
						        		<!-- 科技人才 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="talent"></a>科技人才  </h3>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="15%">人才姓名</th>
													            <th width="25%">人才类型</th>
													            <th width="34%">人才子类</th>
													            <th width="10%">认定年度</th>
													            <!-- <th width="20%">项目名称</th> -->
													            <th width="10%">状态</th>
													            <th width="6%">操作</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['techinfo']['child'][1]['data']">
													    	<volist name="EpSpaces['paragraphs']['techinfo']['child'][1]['data']" id="vo">
													        <tr>
													            <td>{$vo['talentname']}</td>
													            <td>{$vo['projecttype']}</td>
													            <td>{$vo['projectclass']}</td>
													            <td>{$vo['year']}</td>
													            <!-- <td>{$vo['projectname']}</td> -->
													            <td>{$vo['pjstatus']}</td>
													            <td><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more techtalent">详情</a></td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=6 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 科技人才 end -->
						        		
						        		<!-- 企业资质 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="epdeclare"></a>企业资质  </h3>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="29%">资质类型</th>
													            <th width="15%">首次认定年度</th>
													            <th width="25%">证书编号</th>
													            <th width="15%">发证时间</th>
													            <th width="10%">状态</th>
													            <th width="6%">操作</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['techinfo']['child'][2]['data']">
													    	<volist name="EpSpaces['paragraphs']['techinfo']['child'][2]['data']" id="vo">
													        <tr>
													            <td>{$vo['aptype']}</td>
													            <td>{$vo['certyear']}</td>
													            <td>{$vo['certno']}</td>
													            <td>{$vo['certdate']}</td>
													            <td>{$vo['aptstatus']}</td>
													            <td><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more epdeclare">详情</a></td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=6 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 企业资质 end -->
						        		
						        		<!-- 产品资质 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="prodeclare"></a>产品资质</h3>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="47%">产品资质</th>
													            <th width="47%">产品数量</th>
													            <th width="6%">操作</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['techinfo']['child'][3]['data']">
													    	<volist name="EpSpaces['paragraphs']['techinfo']['child'][3]['data']" id="vo">
													        <tr>
													            <td>{$vo['aptype']}</td>
													            <td>{$vo['num']}</td>
													            <td><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more prodeclare">清单</a></td>
													        </tr>
													        </volist>
														        <else/>
														        <tr><td colspan=3 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 产品资质 end -->
						        		<!-- 专利信息 begin-->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="patent"></a>专利信息</h3><span class="paragraph-head-text">（目前仅包含法律状态有效的发明专利）</span>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="47%">专利类型</th>
													            <th width="47%">有效专利数量</th>
													            <th width="6%">操作</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['techinfo']['child'][4]['data']">
													    	<volist name="EpSpaces['paragraphs']['techinfo']['child'][4]['data']" id="vo">
													        <tr>
													            <td>{$vo['patenttype']}</td>
													            <td>{$vo['num']}</td>
													            <td><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more patent">清单</a></td>
													        </tr>
													        </volist>
														        <else/>
														        <tr><td colspan=3 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 专利信息 end-->
						        		<!-- 科技信息  end -->
						        		</notempty>
						        		
						        		<notempty name="EpSpaces['paragraphs']['equityinfo']">
						        		<!-- 企业融资信息 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level1">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="equity"></a><span class="title-no">{$EpSpaces['paragraphs']['calalogue']['order']['equityinfo']}</span><span class="title-text"></span>企业融资信息 </h3>
										    </div>
										    <div class="paragraph-container" style="display:none;">
										        <div class="paragraph-content">
												</div>
										    </div>
						        		</div>
						        		
						        		<!-- 园区创业投资引导基金跟进投资 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
						        				<div class="paragraph-head">
											        <h3 class="paragraph-head-title"><a name="follow"></a>园区创业投资引导基金跟进投资 </h3>
											   		<span class="paragraph-head-text">单位：万元人民币</span>
											    </div>
											    <div class="paragraph-container">
											        <div class="paragraph-content">
											        
										        		<!-- 数据表格 begin -->
										        		<table class="ui-table ui-table-data mt10">
														    <thead>
														        <tr>
														            <th width="10%">投资年度</th>
														            <th style="text-align:right" width="10%">跟投总额</th>
														            <!-- <th width="7%">单位</th>
														            <th width="7%">币种</th> -->
														            <th width="16%" style="text-align:right">已出资额</th>
														            <th width="32%">主投资方</th>
														            <th width="16%" style="text-align:right">投后估值</th>
														            <th width="10%">状态</th>
														            <th width="6%">操作</th>
														        </tr>
														    </thead>
														    <tbody>
														    	<if condition="$EpSpaces['paragraphs']['equityinfo']['child'][0]['data']">
														    	<volist name="EpSpaces['paragraphs']['equityinfo']['child'][0]['data']" id="vo">
														        <tr>
														            <td>{$vo['investyear']}</td>
														            <td style="text-align:right">{$vo['investsum']|format_money1=2}</td>
														            <!-- <td>{$vo['unit']}</td>
														            <td>{$vo['currency']}</td> -->
														            <td style="text-align:right">{$vo['actfundsum']|format_money1=2 }</td>
														            <td>{$vo['maorgname']}</td>
														            <td style="text-align:right">{$vo['afterinvestval']|format_money1=2 }</td>
														            <td>{$vo['pjstatus']}</td>
														            <td><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more follow">详情</a></td>
														        </tr>
														        </volist>
														        <else/>
														        <tr><td colspan=7 style="text-align:center">暂无数据</td></tr></if>
														    </tbody>
														</table>
										        		<!-- 数据表格 end -->
										        		
													</div>
											    </div>
						        		</div>
						        		<!-- 园区创业投资引导基金跟进投资 end -->
						        		
						        		<!-- 园区领军创业投资基金直接投资 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
						        				<div class="paragraph-head">
											        <h3 class="paragraph-head-title"><a name="direct"></a>园区领军创业投资基金直接投资  </h3>
											        <span class="paragraph-head-text">单位：万元人民币</span>
											        <!-- <a href="javascript:void(0)" id="data" class="paragraph-head-more">详情</a> -->
											    </div>
											    <div class="paragraph-container">
											        <div class="paragraph-content">
											        
										        		<!-- 数据表格 begin -->
										        		<table class="ui-table ui-table-data mt10">
														    <thead>
														        <tr>
														            <th width="10%">投资年度</th>
														            <th width="18%" style="text-align:right">投资总额</th>
														            <!-- <th>单位</th>
														            <th>币种</th> -->
														            <th width="18%" style="text-align:right">已出资额</th>
														            <th width="18%" style="text-align:right">投后估值</th>
														            <th width="18%" style="text-align:right">状态</th>
														            <th width="18%" style="text-align:right">操作</th>
														        </tr>
														    </thead>
														    <tbody>
														    	<if condition="$EpSpaces['paragraphs']['equityinfo']['child'][1]['data']">
														    	<volist name="EpSpaces['paragraphs']['equityinfo']['child'][1]['data']" id="vo">
														        <tr>
														            <td>{$vo['investyear']}</td>
														            <td style="text-align:right">{$vo['investsum']|format_money1=2 }</td>
														            <!-- <td>{$vo['unit']}</td>
														            <td>{$vo['currency']}</td> -->
														            <td style="text-align:right">{$vo['actfundsum']|format_money1=2 }</td>
														            <td style="text-align:right">{$vo['afterinvestval']|format_money1=2 }</td>
														            <td style="text-align:right">{$vo['pjstatus']}</td>
														            <td style="text-align:right"><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more direct">详情</a></td>
														        </tr>
														        </volist>
														        <else/>
														        <tr><td colspan=6 style="text-align:center">暂无数据</td></tr></if>
														    </tbody>
														</table>
										        		<!-- 数据表格 end -->
										        		
													</div>
											    </div>
						        		</div>
						        		<!-- 园区领军创业投资基金直接投资 end -->
						        		
						        		<!-- 园区统贷平台委托贷款 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
						        				<div class="paragraph-head">
											        <h3 class="paragraph-head-title"><a name="loan"></a>园区统贷平台委托贷款  </h3>
													<span class="paragraph-head-text">单位：万元人民币</span><span class="paragraph-head-more">放款金额总计：{$EpSpaces['paragraphs']['equityinfo']['child'][2]['sum1']|format_money1}&nbsp &nbsp 贷款余额总计：{$EpSpaces['paragraphs']['equityinfo']['child'][2]['sum2']|format_money1}</span>
											    </div>
											    <div class="paragraph-container">
											        <div class="paragraph-content">
											        
										        		<!-- 数据表格 begin -->
										        		<table class="ui-table ui-table-data mt10">
														    <thead>
														        <tr>
														            <th width="10%">放款序号</th>
														            <th width="14%">放款日期</th>
														            <th width="25%" style="text-align:right">放款金额</th>
														            <th width="25%" style="text-align:right">贷款余额</th>
														            <th width="15%" style="text-align:right">状态</th>
														            <th width="11%" style="text-align:right">操作</th>
														        </tr>
														    </thead>
														    <tbody>
														    	<if condition="$EpSpaces['paragraphs']['equityinfo']['child'][2]['data']">
														    	<volist name="EpSpaces['paragraphs']['equityinfo']['child'][2]['data']" id="vo">
														        <tr>
														            <td>{$vo['loanno']}</td>
														            <td>{$vo['loandate']}</td>
														            <td style="text-align:right">{$vo['loanamount']|format_money1=2}</td>
														            <td style="text-align:right">{$vo['loanover']|format_money1=2}</td>
														            <td style="text-align:right">{$vo['loanstatus']}</td>
														            <td style="text-align:right"><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more loan">详情</a></td>
														        </tr>
														        </volist>
														        <else/>
														        <tr><td colspan=6 style="text-align:center">暂无数据</td></tr></if>
														    </tbody>
														</table>
										        		<!-- 数据表格 end -->
										        		
													</div>
											    </div>
						        		</div>
						        		<!-- 园区统贷平台委托贷款 end -->
						        		
						        		<!-- 苏科贷 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
						        				<div class="paragraph-head">
											        <h3 class="paragraph-head-title"><a name="suLoan"></a>苏科贷  </h3>
													<span class="paragraph-head-text">单位：万元人民币</span><span class="paragraph-head-more">贷款金额总计：{$EpSpaces['paragraphs']['equityinfo']['child'][3]['sum']|format_money1}</span>
											    </div>
											    <div class="paragraph-container">
											        <div class="paragraph-content">
											        
										        		<!-- 数据表格 begin -->
										        		<table class="ui-table ui-table-data mt10">
														    <thead>
														        <tr>
														            <th width="14%">贷款年度</th>
														            <th width="15%">申报日期</th>
														            <th width="40%">贷款银行</th>
														            <th  width="20%" style="text-align:right">贷款金额</th>
														            <th width="11%" style="text-align:right">操作</th>
														        </tr>
														    </thead>
														    <tbody>
														    	<if condition="$EpSpaces['paragraphs']['equityinfo']['child'][3]['data']">
														    	<volist name="EpSpaces['paragraphs']['equityinfo']['child'][3]['data']" id="vo">
														    	
														        <tr>
														            <td>{$vo['year']}</td>
														            <td>{$vo['applydate']}</td>
														            <td>{$vo['recombank']}</td>
														            <td style="text-align:right">{$vo['actloanlimit']|format_money1}</td>
														            <td style="text-align:right"><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more suLoan">详情</a></td>
														        </tr>
														        </volist>
														        <else/>
														        <tr><td colspan=5 style="text-align:center">暂无数据</td></tr></if>
														    </tbody>
														</table>
										        		<!-- 数据表格 end -->
										        		
													</div>
											    </div>
						        		</div>
						        		<!-- 苏科贷 end -->

						        		<!-- 银行贷款余额 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
						        				<div class="paragraph-head">
											        <h3 class="paragraph-head-title"><a name="daikuan"></a>银行贷款余额，数据来源：官方渠道</h3>
													<span class="paragraph-head-text">单位：万元人民币</span>
													<notempty name="EpSpaces['paragraphs']['equityinfo']['child'][4]['data']">
														<a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more daikuan">更多</a>
													</notempty>
											    </div>
											    <div class="paragraph-container">
											        <div class="paragraph-content">
											        
										        		<!-- 数据表格 begin -->
										        		<table class="ui-table ui-table-data mt10">
														    <thead>
														        <tr>
														            <th width="50%" style="text-align:left;">截止日期</th>
														            <th width="50%" style="text-align:left">贷款余额</th>
														        </tr>
														    </thead>
														    <tbody>
														    	<if condition="$EpSpaces['paragraphs']['equityinfo']['child'][4]['data']">
														    	<volist name="EpSpaces['paragraphs']['equityinfo']['child'][4]['data']" id="vo" offset="0" length="3">
														    	
														        <tr>
														            <td style="text-align:left;">{$vo['dataendtime']}</td>
														            <td style="text-align:left;">{$vo['uloanbalance']|format_money1}</td>
														        </tr>
														        </volist>
														        <else/>
														        <tr><td colspan=5 style="text-align:center">暂无数据</td></tr></if>
														    </tbody>
														</table>
										        		<!-- 数据表格 end -->
										        		
													</div>
											    </div>
						        		</div>
						        		<!-- 银行贷款余额end -->
						        		
						        		<!-- 企业融资信息  end -->

						        		</notempty>
						        		
						        		<notempty name="EpSpaces['paragraphs']['policy']">
						        		<!-- 园区科技发展资金 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level1">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="policy"></a><span class="title-no">{$EpSpaces['paragraphs']['calalogue']['order']['policy']}</span><span class="title-text">园区科技发展资金</span> </h3>
										    </div>
										    <div class="paragraph-container" style="display:none;">
										        <div class="paragraph-content">
												</div>
										    </div>
						        		</div>
						        		
						        		<!-- 园区资金拨付记录 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head" style="">
										        <!-- <h3 class="paragraph-head-title">园区资金拨付<a name="policy"></a>  </h3> -->
										    	<span class="paragraph-head-text">单位：万元人民币</span><span class="paragraph-head-more">兑现金额总计：{$EpSpaces['paragraphs']['policy']['child'][0]['allSum']|format_money1}</span>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="40%">兑现类型</th>
													            <th width="20%" style="text-align:right">兑现金额</th>
													            <th width="40%" style="text-align:right">操作</th>
													        </tr>
													    </thead>
													    <tbody>
													    	<if condition="$EpSpaces['paragraphs']['policy']['child'][0]['allData']">
													    	<volist name="EpSpaces['paragraphs']['policy']['child'][0]['allData']" id="vo">
													        <tr>
													            <td>{$vo['fundtype']}</td>
													            <td style="text-align:right">{$vo['sum']|format_money1=2}</td>
													            <td style="text-align:right"><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more policy">详情</a></td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=3 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 园区资金拨付记录 end -->
						        		<!-- 园区科技发展资金  end -->
						        		</notempty>
						        		
						        		<notempty name="EpSpaces['paragraphs']['negative']">
						        		<!-- 负面记录 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level1">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="Negative"></a><span class="title-no">{$EpSpaces['paragraphs']['calalogue']['order']['negative']}</span><span class="title-text">负面记录</span> </h3>
										    </div>
										    <div class="paragraph-container" style="display:none;">
										        <div class="paragraph-content">
												</div>
										    </div>
						        		</div>
						        		
						        		<!-- 欠税记录（地税） begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="Owingtax"></a>税务欠税记录（地税）  </h3>
										    	<span class="paragraph-head-text">单位：元人民币</span>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="10%">年度</th>
													            <th width="10%">批次</th>
													            <th width="15%">统计截止日期</th>
													            <th width="20%">欠税税种</th>
													            <th width="15%" style="text-align:right">欠税余额</th>
													            <th width="24%" style="text-align:right">当期新发生的欠税金额</th>
													            <th width="6%">操作</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['negative']['child'][0]['data']">
													    	<volist name="EpSpaces['paragraphs']['negative']['child'][0]['data']" id="vo">
													        <tr>
													            <td>{$vo['year']}</td>
													            <td>{$vo['batch']}</td>
													            <td>{$vo['totalenddate']}</td>
													            <td>{$vo['taxestype']}</td>
													            <td style="text-align:right">{$vo['owetax']|format_money1=2}</td>
													            <td style="text-align:right">{$vo['currenttaxes']|format_money1=2}</td>
													            <td><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more Owingtax">详情</a></td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=7 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 欠税记录（地税） end -->
						        		
						        		<!-- 公积金欠费记录 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="OwingHousingfund"></a>公积金欠费记录</h3>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="25%">欠费人数</th>
													            <th width="25%">数据统计截止日期</th>
													            <th width="22%">年度</th>
													            <th width="22%">批次</th>
													            <th width="6%">操作</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['negative']['child'][1]['data']">
													    	<volist name="EpSpaces['paragraphs']['negative']['child'][1]['data']" id="vo">
													        <tr>
													            <td>{$vo['arrearsnum']}</td>
													            <td>{$vo['tdate']}</td>
													            <td>{$vo['year']}</td>
													            <td>{$vo['batch']}</td>
													            <td><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more OwingHousingfund">详情</a></td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=5 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 公积金欠费记录 end -->
						        		
						        		<!-- 房租欠费记录 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="OwingRent"></a>房租欠费记录</h3>
										        <span class="paragraph-head-text">单位：元人民币</span>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="50%">欠费时段</th>
													            <th width="50%">欠费金额</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['negative']['child'][5]['data']">
													    	<volist name="EpSpaces['paragraphs']['negative']['child'][5]['data']" id="vo">
													        <tr>
													        <td>{$vo['arreartime']}</td> 
													            <td>{$vo['arrearamount']|format_money1=2}</td> 
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=2 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 房租欠费记录 end -->

						        		<!-- 工商行政处罚 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="ICpunishment"></a>工商行政处罚  </h3>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="40%">处罚类型</th>
													            <th width="39%">处罚原因</th>
													            <th width="15%">公示时间</th>
													            <th width="6%">操作</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['negative']['child'][2]['data']">
													    	<volist name="EpSpaces['paragraphs']['negative']['child'][2]['data']" id="vo">
													        <tr>
													            <td>{$vo['type']}</td>
													            <td>{$vo['reason']}</td>
													            <td>{$vo['pubdate']}</td>
													            <td><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more ICpunishment">详情</a></td>
													        </tr>
													        </volist>
													        <else/>
													        <tr><td colspan=4 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 工商行政处罚 end -->
						        		
						        		<!-- 税务违法（地税） begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="Illegaltax"></a>税务违法（地税）  </h3>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													    <thead>
													        <tr>
													            <th width="15%">公告日期</th>
													            <th width="19%">违法行为</th>
													            <th width="20%">违法事实</th>
													            <th width="20%">处罚决定</th>
													            <th width="20%">执行情况</th>
													            <th width="6%">操作</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['negative']['child'][3]['data']">
													    	<volist name="EpSpaces['paragraphs']['negative']['child'][3]['data']" id="vo">
													        <tr>
													            <td>{$vo['noticedate']}</td>
													            <td>{$vo['violation']}</td>
													            <td>{$vo['facts']}</td>
													            <td>{$vo['decision']}</td>
													            <td>{$vo['lmplementation']}</td>
													            <td><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more Illegaltax">详情</a></td>
													        </tr>
													        </volist>
														        <else/>
														        <tr><td colspan=6 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 税务违法（地税） end -->
						        		
						        		<!-- 统贷违约记录 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level2">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><a name="Uloandefault"></a>统贷违约  </h3>
										    	<span class="paragraph-head-text">单位：万元人民币</span>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        
									        		<!-- 数据表格 begin -->
									        		<table class="ui-table ui-table-data mt10">
													     <thead>
													        <tr>
													            <th width="9%">贷款违约次数</th>
													            <th width="13%" style="text-align:right">贷款当前逾期本金</th>
													            <th width="18%" style="text-align:right">贷款逾期31-60天未归还本金</th>
													            <th width="18%" style="text-align:right">贷款逾期61-90天未归还本金</th>
													            <th width="18%" style="text-align:right">贷款逾期91-180天未归还本金</th>
													            <th width="18%" style="text-align:right">贷款逾期180天以上未归还本金</th>
													            <th width="6%">操作</th>
													        </tr>
													    </thead>
													    <tbody>
														    <if condition="$EpSpaces['paragraphs']['negative']['child'][4]['data']">
													    	<volist name="EpSpaces['paragraphs']['negative']['child'][4]['data']" id="vo">
													        <tr>
													            <td>{$vo['defaultnum']}</td>
													            <td style="text-align:right">{$vo['loan']|format_money1}</td>
													            <td style="text-align:right">{$vo['overduenotrepay1']|format_money1}</td>
													            <td style="text-align:right">{$vo['overduenotrepay2']|format_money1}</td>
													            <td style="text-align:right">{$vo['overduenotrepay3']|format_money1}</td>
													            <td style="text-align:right">{$vo['overduenotrepay4']|format_money1}</td>
													            <td><a href="javascript:void(0);" data="{$vo['id']}" class="paragraph-head-more Uloandefault">详情</a></td>
													        </tr>
													        </volist>
														        <else/>
														        <tr><td colspan=7 style="text-align:center">暂无数据</td></tr></if>
													    </tbody>
													</table>
									        		<!-- 数据表格 end -->
									        		
												</div>
										    </div>
						        		</div>
						        		<!-- 统贷违约记录 end -->
						        		
						        		
						        		<!-- 负面记录 end -->
						        		</notempty>	
						        			        		
					        		</div>
					        		<!-- 左侧正文内容  end -->
					        		
					        		<!-- 右侧动态目录 begin -->					        		
					        		<div class="ui-space-3">
					        		</div>
					        		<!-- 右侧动态目录 end -->
					        		
				        		</div>	
				        		<!-- 信息正文 end  -->
				        						        		
				        	 </div>
				        	<!-- 空间主体 end -->
				        	</div>
				        	
				        </div>
				    </div>				    
				</div>
				<!--  企业空间详情 end-->
				
			</div>
		</div>
		<!-- 全宽布局 end -->
	</div>
</body>
</html>