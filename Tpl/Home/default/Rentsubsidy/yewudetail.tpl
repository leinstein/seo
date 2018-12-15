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
				<h2 class="ui-page-title">业务信息 > 详情</h2>	
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
				        <a href="__APP__/Fundinfo/index" class="ui-box-head-more">返回</a>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content pt15">
				        	
				        	<div class="ui-table-container">
							    <table class="ui-table ui-table-inbox">
							        <tbody>
							        	<tr>
							                <td width="18%">房租补贴拨付ID：</td>
							                <td width="81%"></td>
							                <td width="9%">&nbsp;</td>
							            </tr>
							            <tr>
							                <td width="18%">房租补贴拨付明细ID：</td>
							                <td width="81%"></td>
							                <td width="9%">&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>补贴月份：</td>
							                <td></td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>开始日期：</td>
							                <td></td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>结束日期：</td>
							                <td></td>
							                <td>&nbsp;</td>
							            </tr>
							             <tr>
							                <td>补贴面积（㎡）：</td>
							                <td>{$Fundinfo.appropriatebatch}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>补贴单价（元/㎡）：</td>
							                <td></td>
							                <td>&nbsp;</td>
							        </tbody>
							    </table>							    
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