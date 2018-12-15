	<style type="text/css">
	
		.layui-elem-quote span {
			color: #f00;
			margin-right: 10px;
		}
		</style>
		<script type="text/javascript">
		$(function() {
			layui.use(['form'], function(){
				var form = layui.form;
			  
			  
			});
		});
		</script>
	<blockquote class="layui-elem-quote">
		站点总数：<span>{$data['record']['site_num']|default=0}</span> 
		优化关键词数：<span>{$data['record']['optimize_num']|default=0}</span>
		达标词数：<span>{$data['record']['standards_num']|default=0}</span> 
		达标消费：<span>{$data['record']['standard_fee']|format_money}</span>
		累计消费：<span>{$data['record']['funs_info']['total_consumption']|format_money}</span>
		预付冻结费用：<span>{$data['record']['funs_info']['freezefunds']|format_money}</span>
		可用余额：<span>{$data['record']['funs_info']['availablefunds']|format_money}</span>
		账户余额：<span>{$data['record']['funs_info']['balancefunds']|format_money}</span>
	</blockquote>
		
	<form name="form1" id="form1" method="get" action="__URL__" class="layui-form">
		<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
		<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
		<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
		
		<div class="layui-form-item">
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <input type="text" class="layui-input" name="keyword" value="{$Think.get.keyword}" placeholder="关键词">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <input type="text" name="website" class="layui-input" value="{$Think.get.website}" placeholder="网址">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <html:select options="SearchengineOptions" first="搜索引擎" name="searchengine"  style="" selected="_GET['searchengine']" />
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <html:select options="keywordstatusOptions" first="所有状态" name="keywordstatus"  style="" selected="_GET['keywordstatus']" />
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <html:select options="standardstatusOptions" first="达标状态" name="standardstatus"  style="" selected="_GET['standardstatus']" />
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 160px;">
		        <html:select options="PerPageOptions" first="默认每页显示20条" name="num_per_page"  style="" selected="_GET['num_per_page']" />
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <input type="submit" name="sub" value="查询" class="layui-btn">
		        <button type="reset" name="btn" onclick="location.href='__URL__/effect'" class="layui-btn layui-btn-primary">重置</button>
		      </div>
		    </div>
		  </div>
	</form>
	
	<table class="layui-table">
 	<!-- <colgroup>
	   	<col width="150">
	   	<col width="200">
	   	<col>
 	</colgroup> -->
 	<thead>
    <tr>
      	<th width="30">序号</th>
		<!-- <th>ID</th> -->
		<th width="150">关键词</th>
		<th>网址</th>
		<th width="80">搜索引擎</th>
		<th width="90" align="center" style="text-align: center;">添加日期</th>
		<th width="60" align="center" style="text-align: center;">单价</th>
		<!-- <th>购买天数</th>-->
		<!--<th>检测时间<th>-->
		<th width="60" align="center" style="text-align: center;">初始排名</th>
		<th width="60" align="center" style="text-align: center;" title="数据以最新监测时间为准"><a href="__URL__/effect?ord=latestranking&{$data['query_params']}">最新排名</a></th>
		<th width="60" align="center" style="text-align: center;" title="数据以最新监测时间为准">最新消费</th>
		<th width="90" align="center" style="text-align: center;">检测时间</th>
		<th width="60" align="center" style="text-align: center;"><a href="__URL__/effect?ord=standarddays desc&{$data['query_params']}">达标天数</a></th>
		<!-- <th>昨日扣费</th> -->
		<th width="60" align="center" style="text-align: center;"><a href="__URL__/effect?ord=totalconsumption desc&{$data['query_params']}">累计消费</a></th>
		<th width="50" align="center" style="text-align: center;">状态</th>
		<th width="70">历史数据</th>
    </tr> 
 	</thead>
	<tbody>
 		<notempty name="list['data']">
		<volist name="list['data']" id="vo">
	    <tr>
	      	<td>{$vo['No']}</td>
			<!-- <td>{$vo['id']}</td> -->
			<!-- 关键词 -->
			<td>
				<a target="_balnk" href="{$vo['searchengine_url']}">{$vo['keyword']}</a>
			</td>
			<!-- 网址 -->
			<td>{$vo['website']}</td>
			<!-- 搜索引擎 -->
			<td>{$vo['searchengine_ZH']}</td>
			<!-- 添加日期 -->
			<td align="center" style="text-align: center;">{$vo['createtime']|format_date}</td>
			<!-- 单价 -->
			<td align="center" style="text-align: center;">{$vo['price']|format_money}{$vo['unit']}/{$vo['unit2']}</td>
			<!-- 购买天数 -->
			<!--<td>30 </td>-->
			<!-- 初始排名 -->
			<td align="center" style="text-align: center;">
				{$vo['initialranking']|default='100+'}
			</td>
			<!--最新排名-->
			<td align="center" style="text-align: center;">
				<span>{$vo['latestranking_show']|default='100+'}</span>
				<eq name="vo['initialranking']" value="0">
					<!-- 如果初始排名为0  -->
					<gt name="vo['latestranking']" value="0">
						<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;float: right;">
					</gt>
				<else/>
					<eq name="vo['latestranking']" value="0">
						<img src="__PUBLIC__/img/down.gif" style="vertical-align: middle;;float: right;">
					<else/>
						<!-- 如果初始排名不为0  -->
						<gt name="vo['latestranking']" value="$vo['initialranking']">
							<img src="__PUBLIC__/img/down.gif" style="vertical-align: middle;;float: right;">
						<else/>
							<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;;float: right;">
						</gt>
					</eq>
				</eq>
			</td>

			<!-- 最新消费-->
			<td align="center" style="text-align: center;">
			{$vo['latestconsumption']|format_money} 
			</td>

			<!--检测时间-->
			<td align="center" style="text-align: center;">
			{$vo['detectiondate']|format_date} 
			</td>

			<!-- 达标天数 -->
			<td align="center" style="text-align: center;">
			{$vo['standarddays']} 
			</td>

			<!-- 累计消费 -->
			<td align="center" style="text-align: center;">
			{$vo['total_consumption']|format_money} 
			</td>

			<td align="center" style="text-align: center;">
				{$vo['keywordstatus']}
			</td>
			
			<td>
				<a href="javascript:void(0);" onclick="open_layer('查看详情','{:U('history')}/id/{$vo['id']}?returnUrl={$returnUrl|urlencode}','50%')" class="layui-btn layui-btn-mini">查看详情</a></td>
		

			<!-- <td>
				<eq name="vo['isCanEdit']" value="1">
				<a onclick="return confirm(&quot;确定删除吗?&quot;)" class="btn btn-danger btn-xs" href="__URL__/delete/id/{$vo['id']}">删除</a>
				<else/>
				<button type="button" class="btn btn-default btn-xs no-drop" disabled="disabled" style="background-color:#9e9e9e;">删除</button>
				</eq>

			</td> -->
	    </tr>
	   </volist>
	<else/>
	<tr>
		<td colspan="15" align="center" class="layui-table-nodata">暂无相关数据</td>
	</tr>
	</notempty>
 	</tbody>
</table>

<!-- 分页 begin -->		
<div class="layui-box layui-laypage">
	{$list['html']}
</div>	
<!-- 分页 end -->	
	