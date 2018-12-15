<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<style>
.ui-table .no-border-btm{border-bottom:none;}
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
				<h2 class="ui-page-title">按业务查询 > 详情</h2>	
			</div>
		</div>
		<!-- 顶部栏目导航 end -->
		
		<!-- 全宽布局 begin -->
		<div class="ui-grid-row">		
			<!-- 全宽布局 begin -->
			<div class="ui-grid-25">
				<div class="ui-box">
					<div class="ui-box-head">
				        <h3 class="ui-box-head-title">{$_GET['entername']}{$_GET['batchyear']}年度>拨付详情</h3>
				        <span class="ui-box-head-text"></span>
				        <a href="javascript:history.go(-1)" class="ui-box-head-more">返回</a>
				        <a class="ui-box-head-more" href="__APP__/Company/companyDetail/epid/{$data[0]["epid"]}">点击查看该企业完整房租补贴情况&nbsp;&nbsp;</a>
				    </div>
				</div>
				
				    <div class="ui-box-container" >
				        <div class="ui-table-container shadow">
				    		<table class="ui-table ui-table-follow">
							        	<thead>
								            <tr>
								            	<th width="12%">拨付批次</th>
								                <th width="12%">补贴开始日期</th>
								                <th width="12%">补贴结束日期</th>
								                <th width="12%">补贴面积（㎡）</th>
								                <th width="17%">补贴单价（元/㎡）</th>
								                <!-- <th width="16%">申请补贴金额（万元）</th> -->
								                <th width="20%">实际兑现金额（万元）</th>
								               
								            </tr>
								        </thead><!-- 表头可选 -->
								        <tbody>
								        	<volist name="data" id="data" >
									        	<tr class="ui-table-split">
									        		<td>第{$data.batchno}批</td>
									                <td>{$data.starttime|format_date='Y-m-d'}</td>
									                <td>{$data.endtime|format_date='Y-m-d'}</td>
									                <td>{$data['allowancearea']|format_money1}</td>
									                <td>{$data['allowancemoney']|format_money1} </td>
									                <!-- <td align="right" style="padding-right:28px;">{$data['money0']/10000|format_money4}</td> -->
									                <td align="right" style="padding-right:110px;">{$data['money5']/10000|format_money4}</td>
									                
									            </tr>
								            </volist>
								        </tbody>
							</table>
						</div>
					</div>							            
				</div>
	
		</div>
	</div>
</body>
</html>