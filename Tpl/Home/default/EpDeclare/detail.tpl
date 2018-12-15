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
				<h2 class="ui-page-title">所有企业资质 > 企业资质详情</h2>	
			</div>
		</div>
		<!-- 顶部栏目导航 end -->
		
		<!-- 全宽布局 begin -->
		<div class="ui-grid-row">		
			<!-- 全宽布局 begin -->
			<div class="ui-grid-25">
				
				<div class="ui-box  shadow">
				    <div class="ui-box-head">
				        <h3 class="ui-box-head-title">{$EpDeclare.certentername}企业资质详情</h3>
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
							                <td width="81%">{$EpDeclare.epinfo.epname}</td>
							                <td width="9%">&nbsp;</td>
							            </tr>
							            <tr>
							                <td width="18%">证书企业名称：</td>
							                <td width="81%">{$EpDeclare.certentername|default='未获得数据'}</td>
							                <td width="9%">&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>资质类型：</td>
							                <td>{$EpDeclare.aptype}</td>
							                <td>&nbsp;</td>
							            </tr>
							             <tr class="ui-table-split">
							                <td>首次认定年度：</td>
							                <td>{$EpDeclare.certyear}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>证书编号：</td>
							                <td>{$EpDeclare.certno}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>发证时间：</td>
							                <td>{$EpDeclare.certdate}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>有效期：</td>
							                <td>{$EpDeclare.valid}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>发证机构：</td>
							                <td>{$EpDeclare.certorg}</td>
							                <td>&nbsp;</td>
							            </tr>
							             <tr>
							                <td>状态：</td>
							                <td>{$EpDeclare.aptstatus}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td>说明：</td>
							                <td>{$EpDeclare.desc}</td>
							                <td>&nbsp;</td>
							            </tr>
							        </tbody>
							    </table> -->
							    {:W('BusinessDetail',array('tplname'=>'EpDeclare', 'data'=>$EpDeclare))}
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