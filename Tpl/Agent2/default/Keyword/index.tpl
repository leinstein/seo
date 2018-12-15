<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "�ؼ���Ч��";</php>
<head>
<include file="../Public/header" />
<!--��Ӧʽcss-->
<link rel="stylesheet" type="text/css" href="../Public/css/responsive.css">

<!--datepicker���-->
<link rel="stylesheet" type="text/css" href="../Public/js/bootstrap-daterangepicker/daterangepicker-bs3.css">
<!-- FONTS -->
<!--����-->
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
										<h3 class="content-title pull-left">�ؼ���Ч��</h3>
									</div>
									<div class="description">keyword monitor</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<!--�ҵ�վ��-->
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

							վ������: <span>{$site_num}</span> �Ż��ؼ�����: <span>{$optimize_num}</span>
							��������<span class="danger">{$standards_num}</span> �������: <span></span>
							�ۼ�����: <span>{$funs_info['total_consumption']|format_money}</span> Ԥ���������:<span>{$funs_info['freezefunds']|format_money}</span>
							�������:<span>{$funs_info['availablefunds']|format_money}</span>
							�˻����: <span>{$funs_info['balancefunds']|format_money}</span>
						</div>


						<div>
							<form name="form1" id="form1" method="get" action="__URL__" class="form-inline" style="margin-bottom: 15px;">
								<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
								<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
								<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
								<div class="form-group">
									<input type="text" class="form-control" name="keyword" value="{$Think.get.keyword}" placeholder="�ؼ���">
								</div>
								<div class="form-group">
									<input type="text" name="website" class="form-control" value="{$Think.get.website}" placeholder="��ַ">
								</div>
								<div class="form-group">
									<html:select options="keywordstatusOptions" first="����״̬" name="keywordstatus"  style="form-control" selected="_GET['keywordstatus']" />				
								</div>
								<div class="form-group">
									<html:select options="standardstatusOptions" first="���״̬" name="standardstatus"  style="form-control" selected="_GET['standardstatus']" />
								</div>
								<input type="submit" name="sub" value="��ѯ" class="btn btn-primary "> 
								<input type="button" name="btn" value="����" onclick="location.href='__URL__/index'" class="btn btn-default ">
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
														<th class="center">���</th>
														<th class="center">ID</th>
														<th class="center">�ؼ���</th>
														<th class="center">��ַ</th>
														<th class="center">��������</th>
														<th class="center">��������</th>
														<th class="center">����</th>
														<!-- <th class="center">��������</th>-->
														<!--<th class="center">���ʱ��<th>-->
														<th class="center">��ʼ����</th>
														<th class="center" title="���������¼��ʱ��Ϊ׼"> <a href="__URL__/index/ord/latestranking{$query_params}">��������</a>
														</th>
														<th class="center" title="���������¼��ʱ��Ϊ׼">��������</th>
														<th class="center">���ʱ��</th>
														<th><a href="__URL__/index/ord/standarddays{$query_params}">�������</a></th>
														<!-- <th class="center">���տ۷�</th> -->
														<th class="center"><a href="__URL__/index/ord/totalconsumption{$query_params}">�ۼ�����</a></th>
														<th class="center">״̬</th>
														<th class="center">����</th>
													</tr>
												</thead>
												<tbody>
													<notempty name="list['data']">
													<volist name="list['data']" id="vo">
													<tr class="gradeA odd">
														<td class="center">{$vo['No']}</td>
														<td class="center">{$vo['id']}</td>
														<!-- �ؼ��� -->
														<td class="center">
															<a target="_BLANK" href="http://www.baidu.com/#ie=UTF-8&amp;wd={$vo['keyword']}">{$vo['keyword']}</a>
														</td>
														<!-- ��ַ -->
														<td class="center">{$vo['website']}</td>
														<!-- �������� -->
														<td class="center">{$vo['searchengine_ZH']}</td>
														<!-- �������� -->
														<td class="center">{$vo['createtime']}</td>
														<!-- ���� -->
														<td class="center">{$vo['price']|format_money}{$vo['unit']}/{$vo['unit2']}</td>
														<!-- �������� -->
														<!--<td class="center">30 </td>-->
														<!-- ��ʼ���� -->
														<td class="center">
															{$vo['initialranking']|default='100+'}
														</td>
														<!--��������-->
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

														<!-- ��������-->
														<td class="center">
														{$vo['latest_consumption']|format_money} 
														</td>

														<!--���ʱ��-->
														<td class="center">
														
														</td>

														<!-- ������� -->
														<td class="center">
														{$vo['standarddays']} 
														</td>

														<!-- �ۼ����� -->
														<td class="center">
														{$vo['total_consumption']|format_money} 
														</td>

														<td class="center">
															{$vo['keywordstatus']}
														</td>

														<td class="center">
															<eq name="vo['isCanEdit']" value="1">
															<a onclick="return confirm(&quot;ȷ��ɾ����?&quot;)" class="btn btn-danger btn-xs" href="__URL__/delete/id/{$vo['id']}">ɾ��</a>
															<else/>
															<button type="button" class="btn btn-default btn-xs no-drop" disabled="disabled" style="background-color:#9e9e9e;">ɾ��</button>
															</eq>
				
															<!-- <a class="btn btn-info btn-xs  " href="__URL__/detail/id/{$vo['id']}">�鿴����</a> --> 
														</td>

													</tr>
													</volist>
													<else />
													<tr>
														<td class="center" colspan="15">����δ�����κιؼ���</td>
													</tr>
													</notempty>

												</tbody>
											</table>

											<div class="row">
												<div class="dataTables_footer clearfix">
													<div class="col-md-12 ">
														<div class="dataTables_paginate paging_bs_full pull-right"
															id="datatable2_paginate">
															<!--��ҳ-->
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
							<!--/�ҵ�վ��-->

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