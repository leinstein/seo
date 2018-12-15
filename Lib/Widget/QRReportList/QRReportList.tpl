<script>
	$(function() {
		
		layui.use('laydate', function(){
			var laydate = layui.laydate;
			//执行一个laydate实例
			laydate.render({
			    elem: '#reportdate',//指定元素
			    max : '1',
			    type: 'date',
			    range: '~' ,//或 range: '~' 来自定义分割字符
			    festival: true, //是否显示节日
			});
		});
	
	});
	
	/**
	 * 导出报表，导出一天的报表
	 * @accesspublic
	 */
   	function exportReport( reportdate ){

		layer_confirm('导出数据可能会比较缓慢，您确认导出么？',
			function () {

				window.location.href = "__URL__/exportReport/reportdate/" + reportdate;

		});
   	}
	</script>
<form name="form mt10" method="get" action="__URL__" class="form-inline layui-form">
	<input type="hidden" name="m" value="{$Think.MODULE_NAME}" />
	<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
	<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
	<input type="hidden" name="id" value="{$Think.get.id}" />
	<div class="layui-form-item">

		<div class="layui-inline">

			<div class="layui-input-inline">
				<input id="reportdate" name="reportdate" value="{$Think.get.reportdate}"  placeholder="开始时间 到 结束时间" autocomplete="off" class="layui-input">
			</div>
			<!-- <div class="layui-form-mid">-</div>
			<div class="layui-input-inline" style="width: 150px;">
				<input type="text" id="t2" name="t2" value="{$Think.get.t2}"  placeholder="结束时间" autocomplete="off" class="layui-input">
			</div> -->
			<div class="layui-input-inline">
				<input type="submit" name="sub" value="查询" class="layui-btn">
				<button type="reset" name="btn"onclick="location.href='__URL__/{$Think.ACTION_NAME}'" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
	</div>
</form>

<table class="layui-table">
  	<thead>
	    <tr>
	      	<th width="30">序号</th>
	   	 	<!-- <th>计划</th> -->
	      	<th>日期</th>
			<th>总关键词数</th>
			<th>总达标词数</th>
			<th>总排位数</th>
			<th>百度排位数</th>
			<th>百度手机排位数</th>
			<th>搜狗排位数（不计入消耗）</th>
			<th>消耗排位</th>
			<th>操作</th>
	    </tr> 
  	</thead>
 		<tbody>
  		<notempty name="list['data']">
		<volist name="list['data']" id="vo">
	    <tr>
	    	<td>{$vo['No']}</td>
					    	
	    	<!-- <td>{$vo['planname']}</td> -->
	      	<!-- 日期 -->
			<td>{$vo['reportdate']|format_date}</td>
			
			<!-- 关键词数 -->
			<td>{$vo['keyword_number']|default='0'}</td>
			
			<!-- 总达标词数 -->
			<td>{$vo['standard_number']|default='0'}</td>
			
			<!-- 排位数 -->
			<td>{$vo['homerank_number']|default='0'}</td>
			
			<!-- 百度排位数 -->
			<td>{$vo['homerank_baidu_number']|default='0'}</td>
			
			<!-- 百度手机排位数 -->
			<td>{$vo['homerank_baidumobile_number']|default='0'}</td>
			
			<!-- 搜狗排位数 -->
			<td>{$vo['homerank_sougou_number']|default='0'}</td>
			
			<!-- 消费 -->
			<td>{$vo['consumption']|default='0'}</td>
			
			<!-- 排名 -->
			<td>
			
				<a href="{:U('detail')}/id/{$vo['id']}/planid/{$vo['planid']}/reportdate/{$vo['reportdate']}/standard_number/{$vo['standard_number']}/baidu_number/{$vo['baidu_number']}/baidumobile_number/{$vo['baidumobile_number']}/sougou_number/{$vo['sougou_number']}" class="layui-btn layui-btn-mini">详情</a>
				<a href="javascript:;" onclick="exportReport('{$vo['reportdate']}')" class="layui-btn layui-btn-mini">导出报表</a>
				<!-- <a href="javascript:;" onclick="open_layer('详情','{:U('keyword_list')}/id/{$vo['id']}/query_type/standard','100%',500)" class="layui-btn layui-btn-mini">覆盖</a>
				<a target="_blank" href="{:U('export')}/id/{$vo['id']}/query_type/standard" onclick="show_trip()" class="layui-btn layui-btn-mini">导出覆盖</a> -->
				
			</td>
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
<div class="layui-box layui-laypage fr">
	{$list['html']}
</div>
<div class="clear"></div>
<!-- 分页 end -->		

<script>
/**
 * 导出报表
 */
function export_report( id ){
	
}
</script>