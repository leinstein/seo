<!-- <form class="layui-form layui-form-pane1" name="form1" id="form1" method="get" action="__URL__" class="form-inline" style="margin-bottom: 15px;">
	<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
	<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
	<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
	<div class="layui-form-item">
    <div class="layui-inline">
      <div class="layui-input-inline" style="width: 100px;">
        <input type="text" name="price_min" placeholder="￥" autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid">-</div>
      <div class="layui-input-inline" style="width: 100px;">
        <input type="text" name="price_max" placeholder="￥" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-inline">
      <label class="layui-form-label">行内表单</label>
      <div class="layui-input-block">
      <html:select options="SearchengineOptions" first="全部搜索引擎" name="searchengine"  style="layui-input layui-unselect" selected="_GET['searchengine']" />	
      </div>
      <div class="layui-input-block">
        <select name="quiz">
          <option value="">请选择问题</option>
          <option value="你工作的第一个城市">你工作的第一个城市</option>
          <option value="你的工号" disabled="">你的工号</option>
          <option value="你最喜欢的老师">你最喜欢的老师</option>
        </select><div class="layui-unselect layui-form-select">
        <div class="layui-select-title">
        <input type="text" placeholder="请选择问题" value="" readonly="" class="layui-input layui-unselect">
        
        <i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="你工作的第一个城市" class="">你工作的第一个城市</dd><dd lay-value="你的工号" class="layui-disabled">你的工号</dd><dd lay-value="你最喜欢的老师" class="">你最喜欢的老师</dd></dl></div>
      </div>
    </div>
    <div class="layui-inline">
      <div class="layui-input-block">
        <select name="quiz">
          <option value="">请选择问题</option>
          <optgroup label="城市记忆">
            <option value="你工作的第一个城市">你工作的第一个城市</option>
          </optgroup>
          <optgroup label="学生时代">
            <option value="你的工号" disabled="">你的工号</option>
            <option value="你最喜欢的老师">你最喜欢的老师</option>
          </optgroup>
        </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="请选择问题" value="" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit layui-select-group"><dt>城市记忆</dt><dd lay-value="你工作的第一个城市" class="">你工作的第一个城市</dd><dt>学生时代</dt><dd lay-value="你的工号" class=" layui-disabled">你的工号</dd><dd lay-value="你最喜欢的老师" class="">你最喜欢的老师</dd></dl></div>
      </div>
    </div>
  </div>
	
	<div class="layui-form-item">
		<div class="layui-inline">
			<div class="layui-input-inline">
				<input type="text" class="layui-input" name="keyword" value="{$Think.get.keyword}" placeholder="关键词" autocomplete="off" >
			</div>
			<div class="layui-input-inline">
				<input type="text" class="layui-input" name="website" value="{$Think.get.website}" placeholder="网址" autocomplete="off" >
			</div>
			<div class="layui-input-inline">
				<html:select options="SearchengineOptions" first="全部搜索引擎" name="searchengine"  style="layui-input layui-unselect" selected="_GET['searchengine']" />	
			</div>
			<div class="layui-input-inline">
				<html:select options="keywordstatusOptions" first="所有状态" name="keywordstatus"  style="layui-input layui-unselect" selected="_GET['keywordstatus']" />	
			</div>
			<div class="layui-input-inline">
				<html:select options="standardstatusOptions" first="达标状态" name="standardstatus"  style="layui-input layui-unselect" selected="_GET['standardstatus']" />	
			</div>
			<div class="layui-input-inline">
				<html:select options="PerPageOptions" first="默认每页显示20条" name="num_per_page"  style="layui-input layui-unselect" selected="_GET['num_per_page']" />	
			</div>
			<div class="layui-input-inline">
				<input type="submit" name="sub" value="查询" class="layui-btn">
				<button type="reset" name="btn"onclick="location.href='__URL__/history/id/{$Think.get.id}'" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
	</div>
	
</form> -->


				
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
		
		<input type="submit" name="sub" value="查询" class="layui-btn">
		<button type="reset" name="btn"onclick="location.href='__URL__/effect'" class="layui-btn layui-btn-primary">重置</button>
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
		<th>关键词</th>
		<th>网址</th>
		<th width="80">搜索引擎</th>
		<th width="90">添加日期</th>
		<th width="60">单价</th>
		<!-- <th>购买天数</th>-->
		<!--<th>检测时间<th>-->
		<th width="50">初始排名</th>
		<th width="50" title="数据以最新监测时间为准"><a href="__URL__/effect/?ord=latestranking&{$data['query_params']}">最新排名</a></th>
		<th width="50" title="数据以最新监测时间为准">最新消费</th>
		<th clath="90">检测时间</th>
		<th width="50"><a href="__URL__/effect/?ord=standarddays desc&{$query_params}">达标天数</a></th>
		<!-- <th>昨日扣费</th> -->
		<th width="50"><a href="__URL__/effect/?ord=totalconsumption desc&{$query_params}">累计消费</a></th>
		<th width="50">状态</th>
		<th width="70">历史数据</th>
    </tr> 
 	</thead>
	<tbody>
 		<notempty name="list['data']">
		<volist name="list['data']" id="vo">
	    <tr>
	      	<td class="center">{$vo['No']}</td>
			<!-- <td class="center">{$vo['id']}</td> -->
			<!-- 关键词 -->
			<td class="center">
				<a target="_balnk" href="{$vo['searchengine_url']}">{$vo['keyword']}</a>
			</td>
			<!-- 网址 -->
			<td class="center">{$vo['website']}</td>
			<!-- 搜索引擎 -->
			<td class="center">{$vo['searchengine_ZH']}</td>
			<!-- 添加日期 -->
			<td class="center">{$vo['createtime']|format_date}</td>
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
					<gt name="vo['latestranking']" value="$vo['initialranking']">
						<img src="__PUBLIC__/img/down.gif" style="vertical-align: middle;">
					<else/>
						<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;">
					</gt>
				</eq>
			</td>

			<!-- 最新消费-->
			<td class="center">
			{$vo['latestconsumption']|format_money} 
			</td>

			<!--检测时间-->
			<td class="center">
			{$vo['detectiondate']|format_date} 
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
			
			<td><a href="javascript:void(0);" onclick="open_layer('查看详情','{:U('history')}/id/{$vo['id']}?returnUrl={$returnUrl|urlencode}','50%')" class="layui-btn layui-btn-mini">查看详情</a></td>
		

			<!-- <td class="center">
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
		<td class="center" colspan="15">您还未购买任何关键词</td>
	</tr>
	</notempty>
 	</tbody>
</table>
					
               
<div class="row">
	<div class="dataTables_footer clearfix">
		<div class="col-md-12 ">
			<div class="dataTables_paginate paging_bs_full pull-right">
				{$list['html']}
			</div>
		</div>
	</div>
</div>