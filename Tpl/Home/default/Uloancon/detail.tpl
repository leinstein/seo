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
				<h2 class="ui-page-title">所有统贷信息 > 统贷信息详情</h2>	
			</div>
		</div>
		<!-- 顶部栏目导航 end -->
		
		<!-- 全宽布局 begin -->
		<div class="ui-grid-row">		
			<!-- 全宽布局 begin -->
			<div class="ui-grid-25">
				
				<div class="ui-box">
				    <div class="ui-box-head">
				        <h3 class="ui-box-head-title">统贷信息详情</h3>
				        <span class="ui-box-head-text"></span>
				        <a href="javascript:window.history.go(-1)" class="ui-box-head-more">返回</a>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content pt15">
				        	
				        	<div class="ui-table-container">
							    <!-- <table class="ui-table ui-table-inbox">可以在class中加入ui-table-inbox或ui-table-noborder分别适应不同的情况
							        <tbody>
							            <tr>
							                <td width="18%">企业名称：</td>
							                <td width="81%">{$Uloancon.epinfo.epname}</td>
							                <td width="9%">&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>签约企业名称：</td>
							                <td>{$Uloancon.signentername}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>放款年度：</td>
							                <td>{$Uloancon.loanyear}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>放款金额（万元）：</td>
							                <td>{$Uloancon.loanamount|format_money1}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>已还本金（万元）：</td>
							                <td>{$Uloancon.haverepay|format_money1}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>贷款余额（万元）：</td>
							                <td>{$Uloancon.loanover|format_money1}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>贷款期限（月）：</td>
							                <td>{$Uloancon.timelimit}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>到期日期：</td>
							                <td>{$Uloancon.expdate}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							            <tr class="ui-table-split">
							                <td>贷款银行：</td>
							                <td>{$Uloancon.loanbank}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>贷款利率（%）：</td>
							                <td>{$Uloancon.arp}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>还款方式：</td>
							                <td>{$Uloancon.repaystyle}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>状态：</td>
							                <td>{$Uloancon.loanstatus}</td>
							                <td>&nbsp;</td>
							            </tr>
							        </tbody>
							    </table> -->
							    {:W('BusinessDetail',array('tplname'=>'Uloancon', 'data'=>$Uloancon))}
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