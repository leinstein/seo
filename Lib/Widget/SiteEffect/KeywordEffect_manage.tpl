			
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
		<html:select options="SearchengineOptions" first="全部搜索引擎" name="searchengine"  style="form-control" selected="_GET['searchengine']" />				
	</div>
	<div class="form-group">
		<html:select options="keywordstatusOptions" first="所有状态" name="keywordstatus"  style="form-control" selected="_GET['keywordstatus']" />				
	</div>
	<div class="form-group">
		<html:select options="standardstatusOptions" first="达标状态" name="standardstatus"  style="form-control" selected="_GET['standardstatus']" />
	</div>
	<div class="form-group">
		<html:select options="PerPageOptions" first="默认每页显示20条" name="num_per_page"  style="form-control" selected="_GET['num_per_page']" />				
	</div>
	<input type="submit" name="sub" value="查询" class="btn btn-primary "> 
	<input type="button" name="btn" value="重置" onclick="location.href='__URL__/effect'" class="btn btn-default ">
</form>

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
								<th class="center">关键词</th>
								<th class="center">网址</th>
								<th class="center">搜索引擎</th>
								<th class="center">添加日期</th>
								<th class="center">单价</th>
								<!-- <th class="center">购买天数</th>-->
								<!--<th class="center">检测时间<th>-->
								<th class="center">初始排名</th>
								<th class="center" title="数据以最新监测时间为准"> <a href="__URL__/effect/ord/latestranking{$query_params}">最新排名</a>
								</th>
								<th class="center" title="数据以最新监测时间为准">最新消费</th>
								<th class="center">检测时间</th>
								<th><a href="__URL__/effect/ord/standarddays desc{$query_params}">达标天数</a></th>
								<!-- <th class="center">昨日扣费</th> -->
								<th class="center"><a href="__URL__/effect/ord/totalconsumption desc{$query_params}">累计消费</a></th>
								<th class="center">状态</th>
								<th class="center">日报表</th>
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
									<a target="_balnk" href="{$vo['searchengine_url']}">{$vo['keyword']}</a>
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
									{$vo['latestranking']|default='100+'}
									<eq name="vo['initialranking']" value="0">
										<!-- 如果初始排名为0  -->
										<gt name="vo['latestranking']" value="0">
											<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;">
										</gt>
									<else/>
										<!-- 如果初始排名不为0  -->
										<eq name="vo['latestranking']" value="0">
											<img src="__PUBLIC__/img/down.gif" style="vertical-align: middle;">
										<else/>
											<gt name="vo['latestranking']" value="$vo['initialranking']">
												<img src="__PUBLIC__/img/down.gif" style="vertical-align: middle;">
											<else/>
												<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;">
											</gt>
										</eq>
									</eq>
								</td>

								<!-- 最新消费-->
								<td class="center">
								{$vo['latest_consumption']|format_money} 
								</td>

								<!--检测时间-->
								<td class="center">
								{$vo['detectiondate']} 
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
									
									<a href="javascript:void(0);" onclick="open_layer('日报表','{:U('history')}/id/{$vo['id']}&returnUrl={$CURRENT_URL|urlencode}',900,680)">日报表</a>
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
					
					

					<!-- 分页 begin -->		
					<div class="layui-box layui-laypage">
						{$list['html']}
					</div>	
					<!-- 分页 end -->	
				</div>
			</div>
			<!-- /BOX -->
		</div>
	</div>
	<!--/我的站点-->

</div>