<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<!-- 专用风格 -->
<link href="../Public/css/special/epspace.css" rel="stylesheet">
<script src="../Public/js/jquery-2.1.1.js"></script>
<script type="text/javascript">
/*展开收起动画*/
	
/*全部展开按钮控制函数*/
	$(function(){
		$("#allextend").click(function(){
			//$(this).html($(".extendlist").is(":hidden") ? document.write("<span class="title-text allextend-padding">收起全部文件</span>") : document.write("<span class="title-text allextend-padding">展开全部文件</span>"));
			$(".extend_btn").click().$(".extendlist").slideToggle("fast");
		});
	});

/*查看关闭文件按钮控制函数*/
	$(function(){
		$(".extendlist").hide();
		$(".extend_btn").click(function() {
			id = $(this).attr("data");
        	$(this).html($("#extendlist_"+id).is(":hidden") ? "<img src='../Public/img/bullet_arrow_up.png' />"+"&nbsp;收起文件清单" : "<img src='../Public/img/bullet_arrow_down.png' />"+"&nbsp;查看文件清单");
        	$("#extendlist_"+id).slideToggle("fast");
    	});
	});
	
	/*$(function(){
		$("#test3").hide();
		$("#extend3").click(function() {
        	$(this).html($("#test3").is(":hidden") ? "<img src='../Public/img/bullet_arrow_up.png' />"+"&nbsp;收起文件清单" : "<img src='../Public/img/bullet_arrow_down.png' />"+"&nbsp;查看文件清单");
        	$("#test3").slideToggle();
    	});
	});
	
	$(function(){
		$("#test2").hide();
		$("#extend2").click(function() {
        	$(this).html($("#test").is(":hidden") ? "<img src='../Public/img/022605.jpg' />"+"&nbsp;收起" : "<img src='../Public/img/022604.jpg' />"+"&nbsp;展开");
        	$("#test2").slideToggle(function(){
  				$(this).next("#test2").animate({ height: 'toggle', opacity: 'toggle'}, "slow");
  			});
    	});
	});*/
</script>
<style>
/*企业档案中企业名称样式设计*/
.ui-archives-header { margin-right: -10px; zoom: 1;}
.ui-archives-header-title { float:left; display:inline; width: 840px; padding-left: 8px;}
.ui-archives-header-title h2 { font-family: 微软雅黑; font-size: 24px; line-height: 22px; padding: 8px 2px 20px;}

/*企业档案空间布局*/
.ui-archives-row { margin-right: -10px; zoom: 1; }

/*企业档案一级标题样式设计*/
.paragraph-head { position: relative; padding: 10px 10px 2px 10px; height: 16px; line-height: 16px; zoom: 1;}
.paragraph-head .paragraph-head-title{ color: #656565; font-size: 15px; font-weight: 700; float: left; display: inline; margin: 0; padding: 0px 0px 10px 0px;}
.tishi-padding { padding: 8px 2px 8px 2px;}
/*表格块样式设计*/
.ui-block-container { background: #FCFCFC;}
.ui-block-container .ui-table-content { padding: 10px;}
.ui-table-backcolor { background: #FCFCFC;}

/*表格文本内容不加粗*/

.ui-table-th-weight { font-weight: normal !important;width:100px;}

/*表格两行单元格内容之间的间距样式*/
.ui-table-padding-fir { padding: 10px 9px 3px 9px !important;}
.ui-table-padding-sec { padding: 3px 9px 10px 9px !important;}

/*展开样式*/
.ui-text-right { text-align: right !important;}

/*全部展开pading样式*/
.allextend-padding { padding: 0px 20px 0px 0px !important;}

/*两个table之间的间距*/
.ui-table-padding-bottom { padding: 10px 9px 5px 9px !important;}
.ui-table-padding-top { padding: 5px 9px 10px 9px !important;}

/*表格边框线*/
.table-a { border: 1px solid #CCCCCC}
.no-border-top { border-top: none !important; }
/*跳转链接按钮格式*/
.ui-button-sblue {  margin: 0px 5px; border: 0px; background: #156fcd;  border-radius:4px;}
.button-like1 { width: 90px; hight: 15px; margin: 0px 5px; border: 0px; color: #fff; background: #156fcd; border-radius:4px;}
</style>
</head>
<body>
	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner" />
	<!-- 页面顶部 logo & 菜单 end  -->
	
	<div class="wrapper">
		<div class="ui-grid-row">
			<div class="ui-grid-25">
				<!--<a class="fr" href="__APP__/EpSpace/index/"><span class="title-text">返回企业空间</span></a>-->
				<input class="fr ui-button ui-button-sblue" type="button" value="返回企业查询页面" onclick="location.href='__APP__/EpSpace/index/'">
				<!--<a class="fr" href="__APP__/EpSpace/detail/epid/{$_GET['epid']}"><span class="title-text">返回企业空间详情&nbsp;&nbsp;</span></a>-->
				<input class="fr ui-button ui-button-sblue" type="button" value="返回企业空间详情" onclick="location.href='__APP__/EpSpace/detail/epid/{$_GET['epid']}'">
				<h2 class="ui-page-title">企业空间 > <span>企业档案信息</span></h2>
			</div>
		</div>
		<!-- 全宽布局 begin -->
		<div class="ui-grid-row">
			<div class="ui-grid-25">
			
			
				<!-- 企业档案详情 begin -->
				<div class="ui-box shadow">
				    <div class="ui-box-container">
						<div class="ui-box-content">
				        	<!-- 企业名称-->
				        	<div class="ui-space-header">				        	
				        		<div class="ui-space-header-epkey">
			        				<h2>
			        					{$data}
				        			</h2>
				        			<!--<span class="ui-table-th-weight tishi-padding">-->
				        			<p class="ui-tiptext ui-tiptext-message">
				        				<i class="ui-tiptext-icon iconfont" title="提示">&#xF046;</i>
				        				提示：下载mht格式的文件请使用IE浏览器打开
				        			</p>
				        			
				        			<!--</span>-->
				        		</div>
				        	</div>
				        	    <!-- 企业档案主体 begin -->
				        		<div class="ui-space-body">
				        			<div class="ui-archives-row">
						        		<!-- 科技项目档案 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level1">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><span class="title-no">{$arcdata['data']['calalogue']['order']['archtydata']}</span><span class="title-text">科技项目档案(含人才档案)</span></h3>
										    </div>
										    <a class="fr" href="javascript:void(0)" id="allextend"><span class="title-text allextend-padding">展开/收起全部文件</span></a>
						        		</div>
						        		
						        		<div class="ui-table-container">
						        			<div class="ui-table-content ui-table-padding-bottom">
						        				<if condition="$arcdata['data']['archtydata']['arch01']">
						        				<volist name="arcdata['data']['archtydata']['arch01']" id="vo">
						        					<table class="ui-table ui-table-data ui-table-backcolor table-a" style="margin-top:10px">
						        						<tr>
						        							<th colspan="2" class="ui-table-padding-fir">档案名称：<span class="ui-table-th-weight">{$vo['archivename']}</span></th>
						        							<th rowspan='2' class="ui-text-right ui-table-th-weight"><a href="javascript:void(0)" class="extend_btn" data="{$vo['archivesid']}"><img src='../Public/img/bullet_arrow_down.png' />&nbsp;查看文件清单</a></th>
						        						</tr>
						        						<tr>
						        							<th class="ui-table-padding-sec" style="width: 539px !important;">档案类型：<span class="ui-table-th-weight">{$vo['archiveidtype']}</span></th>
						        							<!--<if  condition="status">-->
						        							<th class="ui-table-padding-sec">文件数量：<span class="ui-table-th-weight">{$vo['bizwritinfo']['count']}</span></th>
						        						</tr>
						        					</table>
						        				
						        					<div id="extendlist_{$vo['archivesid']}" class="extendlist">
						        						<table class="ui-table ui-table-data no-border-top table-a" style="margin-bottom:10px">
						        						<thead>
						        							<tr>
						        								<th width="15%">类型</th>
						        								<th width="15%">名称</th>
						        								<th width="20%">内容</th>
						        								<th width="40%">电子文件名称</th>
						        								<th width="10%">操作</th>
						        							</tr>
						        						</thead>
						        						<tbody>
						        							<if condition="$vo['bizwritinfo']['content']">
						        								<volist name="vo['bizwritinfo']['content']" id="sub">
						        									<tr>
						        										<td>{$sub['wtype']}</td>
						        										<td>{$sub['writname']}</td>
						        										<td>{$sub['writdes']}</td>
						        										<volist name="sub['fileinfo']" id="file">
						        											<td>{$file['orifilename']}</td>
						        											<php>
						        											$filepath = str_replace('#','%23',$file['filepath']);
						        											$formatfilename = str_replace('#','%23',$file['formatfilename']);
						        											</php>
																			<td><a target="_blank" href="{$file_path}{$file['subfoldid']}{$filepath}/{$formatfilename}">下载文件</a></td>
													
						        										</volist>
						        									</tr>
						        								</volist>
						        							<else/>
						        							<tr><td colspan=5 style="text-align:center">暂无档案文件数据</td></tr></if>
						        						</tbody>
						        						</table>
						        					</div>
						        				</volist>
						        				<else/>
						        				<table class="ui-table">
						        					<tr><td colspan=5 style="text-align:center">暂无科技项目档案（含人才档案）数据</td></tr>
						        				</table>
						        				</if>
						        			</div>
						        		</div>
						        		
						        		
						        		<!-- 资质档案 begin -->
						        		<div class="ui-space-body-paragraph paragraph-level1">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><span class="title-no">{$arcdata['data']['calalogue']['order']['archdecdata']}</span><span class="title-text">资质档案</span></h3>
										    </div>
						        		</div>
						        		
										   <div class="ui-table-container">
						        			<div class="ui-table-content ui-table-padding-bottom">
						        				<if condition="$arcdata['data']['archdecdata']['arch02']">
						        				<volist name="arcdata['data']['archdecdata']['arch02']" id="vo">
						        					<table class="ui-table ui-table-data ui-table-backcolor table-a" style="margin-top:10px">
						        						<tr>
						        							<th colspan="2" class="ui-table-padding-fir">档案名称：<span class="ui-table-th-weight">{$vo['archivename']}</span></th>
						        							<th rowspan='2' class="ui-text-right ui-table-th-weight"><a href="javascript:void(0)" class="extend_btn" data="{$vo['archivesid']}"><img src='../Public/img/bullet_arrow_down.png' />&nbsp;查看文件清单</a></th>
						        						</tr>
						        						<tr>
						        							<th class="ui-table-padding-sec" style="width: 539px !important;">档案类型：<span class="ui-table-th-weight">{$vo['archiveidtype']}</span></th>
						        							<th class="ui-table-padding-sec">文件数量：<span class="ui-table-th-weight">{$vo['bizwritinfo']['count']}</span></th>
						        						</tr>
						        					
						        					</table>
						        				
						        					<div id="extendlist_{$vo['archivesid']}" class="extendlist">
						        						<table class="ui-table ui-table-data no-border-top table-a" style="margin-bottom:10px">
						        						<thead>
						        							<tr>
						        								<th width="15%">类型</th>
						        								<th width="15%">名称</th>
						        								<th width="20%">内容</th>
						        								<th width="40%">电子文件名称</th>
						        								<th width="10%">操作</th>
						        							</tr>
						        						</thead>
						        						<tbody>
						        							<if condition="$vo['bizwritinfo']['content']">
						        								<volist name="vo['bizwritinfo']['content']" id="sub">
						        								<tr>
						        									<td>{$sub['wtype']}</td>
						        									<td>{$sub['writname']}</td>
						        									<td>{$sub['writdes']}</td>
						        									<volist name="sub['fileinfo']" id="file">
						        										<td>{$file['orifilename']}</td>
						        										<php>
						        											$filepath = str_replace('#','%23',$file['filepath']);
						        											$formatfilename = str_replace('#','%23',$file['formatfilename']);
						        										</php>
																		<td><a target="_blank" href="{$file_path}{$file['subfoldid']}{$filepath}/{$formatfilename}">下载文件</a></td>
						        									</volist>
						        								</tr>
						        								</volist>
						        							<else/>	
						        							<tr><td colspan=5 style="text-align:center">暂无档案文件数据</td></tr></if>
						        						</tbody>
						        						</table>
						        					</div>
						        				</volist>
						        				<else/>
						        				<table class="ui-table">
						        				<tr><td style="text-align:center !important;">暂无资质档案数据</td></tr>
						        				</table>
						        				</if>
						        				
										    </div>
						        		<!-- 资质档案 end -->
						        		
						        		<!-- <!-- 科技金融 begin -->
						        	<!--<notempty name="arcdata['data']['archtejrdata']">
						        		<div class="ui-space-body-paragraph paragraph-level1">
					        				<div class="paragraph-head">
										        <h3 class="paragraph-head-title"><span class="title-no">{$arcdata['data']['calalogue']['order']['archtejrdata']}</span><span class="title-text">科技金融</span></h3>
										    </div>
						        		</div>
						        		
										<div class="ui-table-container">
						        			<div class="ui-table-content ui-table-padding-bottom">
						        				<if condition="$arcdata['data']['archtejrdata']['arch03']">
						        				<volist name="arcdata['data']['archtejrdata']['arch03']" id="vo">
						        					<table class="ui-table ui-table-data ui-table-backcolor table-a" style="margin-top:10px">
						        						<tr>
						        							<th colspan="2" class="ui-table-padding-fir">档案名称：<span class="ui-table-th-weight">{$vo['archivename']}</span></th>
						        							<th rowspan='2' class="ui-text-right ui-table-th-weight"><a href="javascript:void(0)" class="extend_btn" data="{$vo['archivesid']}"><img src='../Public/img/bullet_arrow_down.png' />&nbsp;查看文件清单</a></th>
						        						</tr>
						        						<tr>
						        							<th class="ui-table-padding-sec" style="width: 539px !important;">档案类型：<span class="ui-table-th-weight">{$vo['archiveidtype']}</span></th>
						        							<th class="ui-table-padding-sec">文件数量：<span class="ui-table-th-weight">{$vo['bizwritinfo']['count']}</span></th>
						        						</tr>
						        					
						        					</table>
						        				
						        					<div id="extendlist_{$vo['archivesid']}" class="extendlist">
						        						<table class="ui-table ui-table-data no-border-top table-a" style="margin-bottom:10px">
						        						<thead>
						        							<tr>
						        								<th width="15%">类型</th>
						        								<th width="15%">名称</th>
						        								<th width="20%">内容</th>
						        								<th width="40%">电子文件名称</th>
						        								<th width="10%">操作</th>
						        							</tr>
						        						</thead>
						        						<tbody>
						        							<if condition="$vo['bizwritinfo']['content']">
						        								<volist name="vo['bizwritinfo']['content']" id="sub">
						        								<tr>
						        									<td>{$sub['wtype']}</td>
						        									<td>{$sub['writname']}</td>
						        									<td>{$sub['writdes']}</td>
						        									<volist name="sub['fileinfo']" id="file">
						        										<td>{$file['orifilename']}</td>
						        										<php>
						        											$filepath = str_replace('#','%23',$file['filepath']);
						        											$formatfilename = str_replace('#','%23',$file['formatfilename']);
																			dump($file['formatfilename']);
																			$a = strstr($file['formatfilename'],'%');
																			dump($a);
						        										</php>
																		<if condition="strstr($file['formatfilename'],'%')">
						        										<td><a target="_blank" href="__URL__/downFile/id/{$file['fileno']}">下载文件</a></td>
																		<else/>
																		<td><a target="_blank" href="{$file_path}{$file['subfoldid']}{$filepath}/{$formatfilename}">下载文件</a></td>
																		</if>
						        									</volist>
						        								</tr>
						        								</volist>
						        							<else/>
						        							<tr><td colspan=5 style="text-align:center">暂无档案文件数据</td></tr></if>
						        						</tbody>
						        						</table>
						        					</div>
						        				</volist>
						        				<else/>
						        				<table class="ui-table">
						        					<tr><td colspan=5 style="text-align:center">暂无科技金融档案数据</td></tr>
						        				</table>
						        				</if>
											</div>
										 </div>-->
						        	
						        		<!-- 科技金融 end --> 
						        	</div>
								</notempty>