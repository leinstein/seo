<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "关键词效果";</php>
<head>
<include file="../Public/header" />
<!--响应式css-->
<link rel="stylesheet" type="text/css" href="../Public/css/responsive.css">

<!--datepicker插件-->
<link rel="stylesheet" type="text/css" href="../Public/js/bootstrap-daterangepicker/daterangepicker-bs3.css">
<!-- FONTS -->
<!--字体-->
<script type="text/javascript" src="../Public/js/easydialog/easydialog.min.js"></script>
<link href="../Public/js/easydialog/easydialog.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="../Public/js/My97DatePicker/WdatePicker.js"></script>
<link href="../Public/js/My97DatePicker/skin/WdatePicker.css" rel="stylesheet" type="text/css">
<!-- FONTS -->
<style type="text/css">
.tooltip {
	
}

.tooltip-inner {
	background-color: #fff !important;
	color: #666 !important;
	line-height: 1.5;
	border: 1px solid #aaa;
}
</style>
</head>
<tagLib name="html" />
<body>
	<!-- PAGE -->
	<section id="page">
		<div id="main-content">
			<div class="container">
				<div class="row">
					<div id="content" class="col-lg-12" style="min-height: 780px;">
						<!-- PAGE HEADER-->
						<div class="row">
							<div class="col-sm-12">
								<div class="page-header">
									<div class="clearfix">
										<h3 class="content-title pull-left">关键词效果</h3>
									</div>
									<div class="description">keyword monitor</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<!--我的站点-->
						<div></div>


						<div style="line-height: 60px;" class="gaikuang">
							<style type="text/css">
							.gaikuang {
								
							}
							
							.gaikuang span {
								color: #f00;
								margin-right: 10px;
							}
							</style>

							站点总数: <span>{$site_num}</span> 优化关键词数: <span>{$optimize_num}</span>
							达标词数：<span class="danger">{$standards_num}</span> 达标消费: <span></span>
							累计消费: <span>{$funs_info['total_consumption']|format_money}</span> 预付冻结费用:<span>{$funs_info['freezefunds']|format_money}</span>
							可用余额:<span>{$funs_info['availablefunds']|format_money}</span>
							账户余额: <span>{$funs_info['balancefunds']|format_money}</span>
						</div>


						<div>
							<form name="form1" id="form1" method="get" action="__URL__" class="form-inline" style="margin-bottom: 15px;">
								<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
								<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
								<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
								<div class="form-group">
									<input type="text" class="form-control" name="keyword" value="{$Think.get.keyword}" placeholder="关键词">
								</div>
								<div class="form-group">
									<input type="text" name="website" class="form-control" value="{$Think.get.website}" placeholder="网址">
								</div>
								<div class="form-group">
									<html:select options="keywordstatusOptions" first="所有状态" name="keywordstatus"  style="form-control" selected="_GET['keywordstatus']" />				
								</div>
								<div class="form-group">
									<html:select options="standardstatusOptions" first="达标状态" name="standardstatus"  style="form-control" selected="_GET['standardstatus']" />
								</div>
								<input type="submit" name="sub" value="查询" class="btn btn-primary "> 
								<input type="button" name="btn" value="重置" onclick="location.href='__URL__/index'" class="btn btn-default ">
							</form>
						</div>


						<div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box border purple">
									<div class="box-body">
										<div id="datatable2_wrapper"
											class="dataTables_wrapper form-inline table-responsive"
											role="grid">
											<table cellpadding="0" cellspacing="0" border="0"
												class="datatable table table-striped table-bordered table-hover dataTable">
												<thead>
													<tr>
														<th class="center">序号</th>
														<th class="center">ID</th>
														<th class="center">关键词</th>
														<th class="center">网址</th>
														<th class="center">搜索引擎</th>
														<th class="center">添加日期</th>
														<th class="center">单价</th>
														<!-- <th class="center">购买天数</th>-->
														<!--<th class="center">检测时间<th>-->
														<th class="center">初始排名</th>
														<th class="center" title="数据以最新监测时间为准"> <a href="__URL__/index/ord/latestranking{$query_params}">最新排名</a>
														</th>
														<th class="center" title="数据以最新监测时间为准">最新消费</th>
														<th class="center">检测时间</th>
														<th><a href="__URL__/index/ord/standarddays{$query_params}">达标天数</a></th>
														<!-- <th class="center">昨日扣费</th> -->
														<th class="center"><a href="__URL__/index/ord/totalconsumption{$query_params}">累计消费</a></th>
														<th class="center">状态</th>
														<th class="center">操作</th>
													</tr>
												</thead>
												<tbody>
													<notempty name="list['data']">
													<volist name="list['data']" id="vo">
													<tr class="gradeA odd">
														<td class="center">{$vo['No']}</td>
														<td class="center">{$vo['id']}</td>
														<!-- 关键词 -->
														<td class="center">
															<a target="_BLANK" href="http://www.baidu.com/#ie=UTF-8&amp;wd={$vo['keyword']}">{$vo['keyword']}</a>
														</td>
														<!-- 网址 -->
														<td class="center">{$vo['website']}</td>
														<!-- 搜索引擎 -->
														<td class="center">{$vo['searchengine_ZH']}</td>
														<!-- 添加日期 -->
														<td class="center">{$vo['createtime']}</td>
														<!-- 单价 -->
														<td class="center">{$vo['price']|format_money}{$vo['unit']}/{$vo['unit2']}</td>
														<!-- 购买天数 -->
														<!--<td class="center">30 </td>-->
														<!-- 初始排名 -->
														<td class="center">
															{$vo['initialranking']|default='100+'}
														</td>
														<!--最新排名-->
														<td class="center">
															<gt name="vo['latestranking']" value="0">
															{$vo['latestranking']} 
															<lt name="vo['latestranking']" value = "100"> 
															<img src="../Public/img/up.gif">
															</lt>
															<else/>
															100+
															</gt>
														</td>

														<!-- 最新消费-->
														<td class="center">
														{$vo['latest_consumption']|format_money} 
														</td>

														<!--检测时间-->
														<td class="center">
														
														</td>

														<!-- 达标天数 -->
														<td class="center">
														{$vo['standarddays']} 
														</td>

														<!-- 累计消费 -->
														<td class="center">
														{$vo['total_consumption']|format_money} 
														</td>

														<td class="center">
															{$vo['keywordstatus']}
														</td>

														<td class="center">
															<eq name="vo['isCanEdit']" value="1">
															<a onclick="return confirm(&quot;确定删除吗?&quot;)" class="btn btn-danger btn-xs" href="__URL__/delete/id/{$vo['id']}">删除</a>
															<else/>
															<button type="button" class="btn btn-default btn-xs no-drop" disabled="disabled" style="background-color:#9e9e9e;">删除</button>
															</eq>
				
															<!-- <a class="btn btn-info btn-xs  " href="__URL__/detail/id/{$vo['id']}">查看详情</a> --> 
														</td>

													</tr>
													</volist>
													<else />
													<tr>
														<td class="center" colspan="15">您还未购买任何关键词</td>
													</tr>
													</notempty>

												</tbody>
											</table>

											<div class="row">
												<div class="dataTables_footer clearfix">
													<div class="col-md-12 ">
														<div class="dataTables_paginate paging_bs_full pull-right"
															id="datatable2_paginate">
															<!--分页-->
															{$list['html']}
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /BOX -->
								</div>
							</div>
							<!--/我的站点-->

						</div>
					</div>
				</div>
			</div>
	</section>

	<div>
	</div>

	<!--/PAGE -->





</body>
</html>