<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "一级代理商用户列表";</php>
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
										<h3 class="content-title pull-left">代理商用户</h3>
									</div>
									<div class="description">agent user</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- 添加用户  begin -->
						<div class="row" style="margin-bottom: 15px">
							<div class="col-md-12">
								<a href="javascript:;" onclick="open_layer('添加一级代理商用户','{:U('insertPage')}',500,760)" class="btn btn-warning2 add_site_btn">添加一级代理商用户</a>
	
								<!-- <a href="{:U('insertPage')}" class="btn btn-warning2 add_site_btn">添加用户</a> -->
							</div>
						</div>
						<!-- 添加用户  end -->
						
						<div class="divide-10"></div>

						<!-- 一级代理用户列表  begin -->
						<div style="line-height: 60px;" class="gaikuang">
							<style type="text/css">
							.gaikuang {
								
							}
							.gaikuang span {
								color: #f00;
								margin-right: 10px;
							}
							</style>

							总用户： <span>{$total_num|default=0}</span>
							有效用户：<span class="danger">{$active_num|default=0}</span>
							无效用户：<span>{$invalid_num|default=0}</span>
							资金池低于10000 的用户：<span>{$pool_less10000|default=0}</span>
						</div>


						<div>
							<form name="form1" id="form1" method="get" action="__URL__" class="form-inline" style="margin-bottom: 15px;">
								<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
								<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
								<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
								<div class="form-group">
									<input type="text" class="form-control" name="username" value="{$Think.get.username}" placeholder="用户名">
								</div>
								<!-- <div class="form-group">
									<input type="text" name="website" class="form-control" value="{$Think.get.website}" placeholder="网址">
								</div>
								<div class="form-group">
									<html:select options="keywordstatusOptions" first="所有状态" name="keywordstatus"  style="form-control" selected="_GET['keywordstatus']" />				
								</div>
								<div class="form-group">
									<html:select options="standardstatusOptions" first="达标状态" name="standardstatus"  style="form-control" selected="_GET['standardstatus']" />
								</div> -->
								<input type="submit" name="sub" value="查询" class="btn btn-primary "> 
								<input type="button" name="btn" value="重置" onclick="location.href='__URL__/agentUserList'" class="btn btn-default ">
							</form>
						</div>


						<div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box border">
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
														<th class="center">一级代理商</th>
														<th class="center">子用户数</th>
														<th class="center">创建时间</th>
														<th class="center">产品余额</th>
														<th class="center">状态</th>
														<th class="center">管理</th>
													</tr>
												</thead>
												<tbody>
													<notempty name="list['data']">
													<volist name="list['data']" id="vo">
													<tr class="gradeA odd">
														<td class="center">{$vo['No']}</td>
														<td class="center">{$vo['id']}</td>
														<!-- 一级代理商 -->
														<td class="center">
															<a href="javascript:;" onclick="open_layer('查看一级代理商用户','{:U('detail')}/id/{$vo['id']}/type/agent',500,700)" >{$vo['username']}</a>
														</td>
														<!-- 子用户数 -->
														<td class="center">
															{$vo['serveruser_num']}
														</td>
														
														<!--创建时间-->
														<td class="center">
															{$vo['createtime']} 
														</td>
														
														<!--产品余额-->
														<td class="center">
															{$vo['funds']['availablefunds']|format_money} 
														</td>
														
														<!--状态-->
														<td class="center">
															{$vo['userstatus']} 
														</td>
														
														<!--管理-->
														<td class="center">
															<a href="javascript:;" onclick="open_layer('修改一级代理商用户','{:U('updatePage')}/id/{$vo['id']}/type/agent',500,760)" >修改</a>
															<a href="javascript:;" onclick="open_layer('修改一级代理商用户密码','{:U('updatePasswordPage')}/id/{$vo['id']}/type/agent',500,460)" >密码</a>
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
														<td class="center" colspan="15">暂无相关数据</td>
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
							<!-- 一级代理用户列表  end -->

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