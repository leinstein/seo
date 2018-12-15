<script>
$(function() {
	layui.use(['laydate'], function() {
		var laydate = layui.laydate;
		var start = {
			//min : laydate.now(),
			//max : '2099-06-16 23:59:59',
			max : laydate.now(),
			istoday : false,
			festival: true, //是否显示节日
			choose : function(datas) {
				end.min = datas; //开始日选好后，重置结束日的最小日期
				end.start = datas //将结束日的初始值设定为开始日
			}
		};

		var end = {
			max : laydate.now(),
			istoday : false,
			festival: true, //是否显示节日
			choose : function(datas) {
				start.max = datas; //结束日选好后，重置开始日的最大日期
			}
		};

		document.getElementById('t1').onclick = function() {
			start.elem = this;
			laydate(start);
		}
		document.getElementById('t2').onclick = function() {
			end.elem = this
			laydate(end);
		}

	});
});
</script>
<form class="layui-form layui-form-pane1" name="form1" id="form1" method="get" action="__URL__" class="form-inline" style="margin-bottom: 15px;">
	<input type="hidden" name="m" value="{$Think.MODULE_NAME}" />
	<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
	<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
	<input type="hidden" name="id" value="{$Think.get.id}" />
	<div class="layui-form-item">

		<div class="layui-inline">

			<div class="layui-input-inline" style="width: 150px;">
				<input id="t1" name="t1" value="{$Think.get.t1}"  placeholder="购买开始时间" autocomplete="off" class="layui-input">
			</div>
			<div class="layui-form-mid">-</div>
			<div class="layui-input-inline" style="width: 150px;">
				<input type="text" id="t2" name="t2" value="{$Think.get.t2}"  placeholder="购买结束时间" autocomplete="off" class="layui-input">
			</div>
			<div class="layui-input-inline">
				<input type="submit" name="sub" value="查询" class="layui-btn">
				<button type="reset" name="btn"onclick="location.href='__URL__/history/id/{$Think.get.id}'" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
	</div>
</form>

<table class="layui-table">
  	<thead>
	    <tr>
	    	<th>序号</th>
	      	<th>日期</th>
			<th>关键词</th>
			<th>渠道</th>
			<th>排名</th>
	    </tr> 
  	</thead>
 		<tbody>
  		<notempty name="list['data']">
		<volist name="list['data']" id="vo">
	    <tr>
	      	<!-- 日期 -->
			<td>{$vo['No']}</td>
	      	<!-- 日期 -->
			<td>{$vo['createtime']|format_date}</td>
			<!--关键词-->
			<td>
				{$vo['keyword']}
			</td>
			
			<!--渠道-->
			<td>
				{$vo['searchengine_zh']}
			</td>
			
			<!-- 排名 -->
			<td>
				<if condition="$vo['rank'] GT 0 AND $vo['rank'] ELT 10">
				<span style="color: red">{$vo['rank']}</span>
				<else/>
				{$vo['rank']|default='100+'}
				</if>
			</td>
	    </tr>
    </volist>
	<else/>
	<tr>
		<td colspan="4">
			暂无相关数据
		</td>
	</tr>
	</notempty>
  	</tbody>
</table>
<!-- 分页 begin -->
<div class="layui-box layui-laypage">
	{$list['html']}
</div>
<!-- 分页 end -->		