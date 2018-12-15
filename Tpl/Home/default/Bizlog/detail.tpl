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
<script type="text/javascript" src="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip={$Bizlogs['clientaddr']}"></script>
<script>

//加载
$(function(){
	var dialogwidth = '950px';
	var dialogheight = '520px';
	
	//自定义脚本
	seajs.use(['arale/dialog/1.3.1/dialog'], function(Dialog) {
		$('#pageinput').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/Bizlog/showData/logid/{$Bizlogs["id"]}/type/pageinput'
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		$('#actionsteps').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/Bizlog/showData/logid/{$Bizlogs["id"]}/type/actionsteps'
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
		
		$('#pageoutput').bind('click',function(){		    
			var d = new Dialog({
				width: dialogwidth,
				height: dialogheight,
				effect: 'fade',
				content : '__APP__/Bizlog/showData/logid/{$Bizlogs["id"]}/type/pageoutput'
		    });
		    d.activeTrigger = $(this);
		    d.show();
		});
	});
	
	if(remote_ip_info["country"]&&remote_ip_info["province"]&&remote_ip_info["city"]){
		$("#ipaddr").html(remote_ip_info["country"]+','+remote_ip_info["province"]+"省"+','+remote_ip_info["city"]+"市");
	}else{
		$("#ipaddr").html("暂未取得");
	}
	
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
				<h2 class="ui-page-title">日志查询  > 系统操作日志查询  ><span id="spacedetail">详情</span></h2>
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
													            <td style="width:15%;">操作人员用户名：</td>
													            <td style="width:30%;"><if condition="$Bizlogs['username']">{$Bizlogs['username']}<else/>暂未取得</if></td>
													            <td style="width:15%;">操作人员姓名：</td>
													            <td style="width:20%;"><if condition="$Bizlogs['truename']">{$Bizlogs['truename']}<else/>暂未取得</if></td>
													        </tr>
													        <tr>
													            <td style="width:15%;">操作时间：</td>
													            <td style="width:30%;"><if condition="$Bizlogs['actbegintime']">{$Bizlogs['actbegintime']|substr=0,14|strtotime|date='Y-m-d H:i:s',###}<else/>暂未取得</if></td>
													            <td style="width:15%;">操作交易代码：</td>
													            <td style="width:20%;"><if condition="$Bizlogs['actioncode']">{$Bizlogs['actioncode']}<else/>暂未取得</if></td>
													        </tr>
													        <tr>
													            <td style="width:15%;">操作描述：</td>
													            <td style="width:30%;" colspan="3"><if condition="$Bizlogs['actiondesc']">{$Bizlogs['actiondesc']}<else/>暂未取得</if></td>
													        </tr>
													        <tr>
													            <td style="width:15%;">客户端类型：</td>
													            <td style="width:30%;"><if condition="$Bizlogs['clienttype']">{$Bizlogs['clienttype']}<else/>暂未取得</if></td>
													            <td style="width:15%;">客户端操作系统信息：</td>
													            <td style="width:20%;"><if condition="$Bizlogs['clientsys']">{$Bizlogs['clientsys']}<else/>暂未取得</if></td>
													        </tr>
													        <tr>
													            <td style="width:15%;">浏览器版本：</td>
													            <td style="width:30%;"><if condition="$Bizlogs['browserinfo']">{$Bizlogs['browserinfo']}<else/>暂未取得</if></td>
													            <td style="width:15%;">客户端IP地址：</td>
													            <td style="width:20%;"><if condition="$Bizlogs['clientaddr']">{$Bizlogs['clientaddr']}<else/>暂未取得</if></td>
													        </tr>
													        <tr>
													            <td style="width:15%;">客户端IP地址归属地：</td>
													            <td style="width:30%;"colspan="3" id="ipaddr"></td>
													        </tr>
													        <tr>
													            <td style="width:15%;">访问页面地址：</td>
													            <td style="width:30%;"colspan="3"><if condition="$Bizlogs['currenturl']">{$Bizlogs['currenturl']}<else/>暂未取得</if></td>
													        </tr>
													        <tr>
													            <td colspan="4">程序输入输出及执行步骤：</td>
													        </tr>
													        <tr>
													       		<td colspan="4" align="center">	
														            <input type="button" class="ui-button ui-button-sblue" style="width:25%;" id="pageinput" value="查看页面输入数据">
														            <input type="button" class="ui-button ui-button-sblue" style="width:25%;" id="actionsteps" value="查看数据库执行过程">
														            <input type="button" class="ui-button ui-button-sblue" style="width:25%;" id="pageoutput" value="查看页面输出数据">
													            </td>
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