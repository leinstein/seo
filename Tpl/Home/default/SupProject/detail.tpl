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
				<h2 class="ui-page-title">所有科技项目 > 科技项目详情</h2>	
			</div>
		</div>
		<!-- 顶部栏目导航 end -->
		
		<!-- 全宽布局 begin -->
		<div class="ui-grid-row">		
			<!-- 全宽布局 begin -->
			<div class="ui-grid-25">
				
				<div class="ui-box">
				    <div class="ui-box-head">
				        <h3 class="ui-box-head-title">{$SupProject.projectname}详情</h3>
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
							                <td width="81%">{$SupProject.epname}</td>
							                <td width="9%">&nbsp;</td>
							            </tr>
							            <tr >
							                <td>立项文号：</td>
							                <td>{$SupProject.projectdocid}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>申报年度：</td>
							                <td>{$SupProject.applyyear}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr >
							                <td>立项年度：</td>
							                <td>{$SupProject.year}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>项目级别：</td>
							                <td>{$SupProject.projectlevel}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr >
							                <td>项目名称：</td>
							                <td>{$SupProject.projectname}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr >
							                <td>项目类型：</td>
							                <td>{$SupProject.projecttype}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr >
							                <td>项目子类：</td>
							                <td>{$SupProject.subclass}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr >
							                <td>上级资金拨款总额（万元）：</td>
							                <td>{$SupProject.highfunding|format_money1}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr >
							                <td>园区已配套（万元）：</td>
							                <td>{$SupProject.parkhavematchtotal|format_money1}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr >
							                <td>项目执行期（起始时间）：</td>
							                <td>{$SupProject.projectstarttime}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr >
							                <td>项目执行期（截止时间）：</td>
							                <td>{$SupProject.projectendtime}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr >
							                <td>项目状态：</td>
							                <td>{$SupProject.pjstatus}</td>
							                <td>&nbsp;</td>
							            </tr>
							        </tbody>
							    </table> -->
							    {:W('BusinessDetail',array('tplname'=>'SupProject', 'data'=>$SupProject))}
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