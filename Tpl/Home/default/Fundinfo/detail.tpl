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
				<h2 class="ui-page-title">所有科技资金信息 > 科技资金详情</h2>	
			</div>
		</div>
		<!-- 顶部栏目导航 end -->
		
		<!-- 全宽布局 begin -->
		<div class="ui-grid-row">		
			<!-- 全宽布局 begin -->
			<div class="ui-grid-25">
				
				<div class="ui-box">
				    <div class="ui-box-head">
				        <h3 class="ui-box-head-title">{$Fundinfo.fundtype}详情</h3>
				        <span class="ui-box-head-text"></span>
				        <a href="javascript:window.history.go(-1)" class="ui-box-head-more">返回</a>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content pt15">
				        	
				        	<div class="ui-table-container">
							   <!--  <table class="ui-table ui-table-inbox">可以在class中加入ui-table-inbox或ui-table-noborder分别适应不同的情况
							        <tbody>
							        	<tr>
							                <td width="18%">企业名称：</td>
							                <td width="81%">{$Fundinfo.epname}</td>
							                <td width="9%">&nbsp;</td>
							            </tr>
							            <tr>
							                <td width="18%">申请人名称：</td>
							                <td width="81%">{$Fundinfo.entername}</td>
							                <td width="9%">&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>申请资金类型：</td>
							                <td>{$Fundinfo.fundtype}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>拨付金额（万元）：</td>
							                <td>{$Fundinfo.appropriateamount|format_money1}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>拨付年度：</td>
							                <td>{$Fundinfo.appropriateyear}</td>
							                <td>&nbsp;</td>
							            </tr>
							             <tr>
							                <td>拨付批次：</td>
							                <td>{$Fundinfo.appropriatebatch}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>拨款依据：</td>
							                <td>{$Fundinfo.appropriateaccord}</td>
							                <td>&nbsp;</td>
							        </tbody>
							    </table> -->
							    {:W('BusinessDetail',array('tplname'=>'Fundinfo', 'data'=>$Fundinfo))}
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