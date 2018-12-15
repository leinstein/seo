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
				<h2 class="ui-page-title">日志查询  > 数据更新日志查询  > <span id="spacedetail">详情</span></h2>
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
						
				        	<div id="epdata">
				        	
				        	<!-- 空间主体 begin -->
				        	<div class="ui-space-body">
				        		
				        		<!-- 信息摘要和地图 begin -->
				        		<div class="ui-space-row">
			        				<!-- 信息摘要 begin -->
			        				<div class="ui-space-25">
						        		<div class="ui-space-body-paragraph paragraph-keyinfo">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title">日志详情</h3>
										        <span class="paragraph-head-text"></span>
										    </div>
										    <div class="paragraph-container">
										        <div class="paragraph-content">
										        	<table class="ui-table ui-table-noborder ui-table-dashline" style="word-break:break-all">
													    <tbody>
													        <tr>
													            <td style="width:10%;">更新数据类型：</td>
													            <td style="width:30%;"><if condition="$Datalogs['updatecontent']">{$Datalogs['updatecontent']}<else/>暂未取得</if></td>
													        </tr>
													        <tr>
													            <td style="width:10%;">更新时间：</td>
													            <td style="width:30%;"><if condition="$Datalogs['updatetime']">{$Datalogs['updatetime']|strtotime|date='Y-m-d',###}<else/>暂未取得</if></td>
													        </tr>
													        <tr>
													            <td style="width:10%;">更新说明：</td>
													            <td style="width:30%;"><if condition="$Datalogs['updatedesc']">{$Datalogs['updatedesc']}<else/>暂未取得</if></td>
													        </tr>
													        <tr>
													            <td style="width:10%;">更新脚本：</td>
													            <td style="width:30%;"><if condition="$Datalogs['updatejs']">{$Datalogs['updatejs']}<else/>暂未取得</if></td>
													        </tr>
													        <tr>
													            <td style="width:10%;">备注：</td>
													            <td style="width:30%;"><if condition="$Datalogs['memo']">{$Datalogs['memo']}<else/>暂未取得</if></td>
													        </tr>
													    </tbody>
													</table>
												</div>
										    </div>
						        		</div>
					        		</div>
					        		<!-- 信息摘要 end -->
					        		
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