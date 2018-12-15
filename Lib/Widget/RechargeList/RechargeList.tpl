<script type="text/javascript">
	$(function() {
		/* layui.use(['form'], function(){
			var form = layui.form;
		  
		  
		}); */
	});
</script>

		
<table class="layui-table">
	<thead>
		<tr >
			<th width="30">序号</th>
	   		<th>代理商用户</th>
	   		<th>姓名</th>
	   		<th>充值产品</th>
	        <th>金额</th>
	        <th>操作说明</th>
	        <th>操作人员</th>
	        <th>时间</th>
	    </tr>
	</thead>
	<tbody>
		<notempty name="list['data']">
		<volist name="list['data']" id="vo">
		<tr>
			<td>{$vo['No']}</td>
	  		<td>{$vo['username']}</td>
	  		<td>{$vo['truename']}</td>
	  		<td>{$vo['product']['product_name']}</td>
	  		<td>{$vo['amount']}</td>
	  		<td>{$vo['remarks']}</td>
	  		<td>{$vo['createusername']}</td>
	  		<td>{$vo['createtime']}</td>
		</tr>
		</volist>
		<else />
		<tr>
			<td colspan="6" align="center" class="layui-table-nodata">暂无相关数据</td>
		</tr>
		</notempty>
	</tbody>
</table>

<!-- 分页 begin -->		
<div class="layui-box layui-laypage">
	{$list['html']}
</div>	
<!-- 分页 end -->	  
