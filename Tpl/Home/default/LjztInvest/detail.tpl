<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<style>
</style>
</head>
<body>
	
	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner" />
	<!-- 页面顶部 logo & 菜单 end  -->
	
	<div class="wrapper">	
		<!-- 顶部栏目导航 begin -->
		<div  class="ui-grid-row">
			<div class="ui-grid-25">
				<h2 class="ui-page-title">所有领军直投信息 > 领军直投详情</h2>	
			</div>
		</div>
		<!-- 顶部栏目导航 end -->
		
		<!-- 全宽布局 begin -->
		<div class="ui-grid-row">		
			<!-- 全宽布局 begin -->
			<div class="ui-grid-25">
				
				<div class="ui-box">
				    <div class="ui-box-head">
				        <h3 class="ui-box-head-title">领军直投详情</h3>
				        <span class="ui-box-head-text"></span>
				        <a href="javascript:history.go(-1)" class="ui-box-head-more">返回</a>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content pt15">
				        	
				        	<div class="ui-table-container">
							    <!-- <table class="ui-table ui-table-inbox">可以在class中加入ui-table-inbox或ui-table-noborder分别适应不同的情况
							        <tbody>
							            <tr>
							                <td width="18%">企业名称：</td>
							                <td width="81%">{$Ljztinvest.epinfo.epname}</td>
							                <td width="9%">&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							            <tr>
							                <td>投资年度：</td>
							                <td>{$Ljztinvest.investyear}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>投资总额（万元）：</td>
							                <td>{$Ljztinvest.investsum|format_money1}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>投资股权份额（%）：</td>
							                <td>{$Ljztinvest.stake}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>已出金额（万元）：</td>
							                <td>{$Ljztinvest.actfundsum|format_money1}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>投后估值（万元）：</td>
							                <td>{$Ljztinvest.afterinvestval|format_money1}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>最近一次融资估值（万元）：</td>
							                <td>{$Ljztinvest.recentfinancing|format_money1}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>退出年度：</td>
							                <td>{$Ljztinvest.quityear}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>退出回收金额（万元）：</td>
							                <td>{$Ljztinvest.outsum|format_money1}</td>
							                <td>&nbsp;</td>
							            </tr>
							             <tr>
							                <td>状态：</td>
							                <td>{$Ljztinvest.pjstatus}</td>
							                <td>&nbsp;</td>
							            </tr>
							        </tbody>
							    </table> -->
							    {:W('BusinessDetail',array('tplname'=>'Ljztinvest', 'data'=>$Ljztinvest))}
							</div>
				        
				        </div>
				    </div>
				</div>
				
			</div>			
		</div>
		<!-- 全宽布局 end -->
	</div>
</body>
</html>