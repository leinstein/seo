<script type="text/javascript">
	$(function() {
		layui.use(['form'], function(){
			var form = layui.form;
		  
		  
		});
	});
</script>

<form class="layui-form" name="form1" id="form1" method="get" action="__URL__" >
	<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
	<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
	<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
	<div class="layui-form-item">
		<div class="layui-inline">
			<div class="layui-input-inline"  style="width: 100px;">
				<input id="username" name="username" class="layui-input" value="{$Think.get.username}" placeholder="用户名">
			</div>
			<!-- <div class="layui-input-inline">
				<input id="username" name="truename" class="layui-input" value="{$Think.get.truename}" placeholder="用户姓名">
			</div>
			<div class="layui-input-inline">
				<input id="epname" name="epname" class="layui-input" value="{$Think.get.epname}" placeholder="公司名">
			</div>
			
			<div class="layui-input-inline">
				<html:select options="UserStatusOptions" first="用户状态" name="userstatus"  selected="_GET['userstatus']" />
			</div> -->
			
			
			<div class="layui-input-inline">
				<input type="submit" name="sub" value="查询" class="layui-btn"> 
				<input type="button" name="btn" value="重置" onclick="location.href='__URL__/{$Think.ACTION_NAME}'" class="layui-btn layui-btn-primary">
				
			</div>
		</div>
	</div>
	
	
</form>
<table class="layui-table">
	<thead>
		<tr>
			<th width="30">序号</th>
			<th>ID</th>
			<th>代理商</th>
			<th>子用户数</th>
			<!-- <th>开通产品</th> -->
			<th>创建时间</th>
			<th>资金池余额</th>
			<!-- <th>产品余额</th> -->
			<th>状态</th>
			<th>管理</th>
		</tr>
	</thead>
	<tbody>
	
		<notempty name="list['data']">
		<volist name="list['data']" id="vo">
		
		<tr>
			<td>{$vo['No']}</td>
			<td>{$vo['id']}</td>
			<!-- 一级代理商 -->
			<td>
				<a href="javascript:;" onclick="open_layer('查看代理商用户','{:U('UserManagement/detail')}/id/{$vo['id']}/type/agent','50%')" >{$vo['username']}</a>
			</td>
			<!-- 子用户数 -->
			<td>
				<gt name="vo['sub_user_num']" value="0">
					<a href="javascript:;" onclick="open_layer('查看子用户','{:U('sub_user_list')}/pid/{$vo['id']}','100%')" >{$vo['sub_user_num']}</a>
					
				<else/>
					0
				</gt>
			</td>
			
			<!-- 开通产品 -->
			<!-- <td>
				{$vo['productnames']}
			</td> -->
			
			<!--创建时间-->
			<td>
				{$vo['createtime']} 
			</td>
			<!--产品余额-->
			<td>
				{$vo['funds']['availablefunds']|format_money} 
			</td>
			
			<!--产品余额-->
			<!-- <td>
				{$vo['availablefunds_str']} 
			</td>
			 -->
			<!--状态-->
			<td>
				{$vo['userstatus']} 
			</td>
			
			<!--管理-->
			<td>
				<a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-mini" onclick="open_layer('一级代理商充值','{:U('rechargePage')}/id/{$vo['id']}&returnUrl={$returnUrl|urlencode}',500,460)" >充值</a>				
			</td>

		</tr>
		</volist>
		<else />
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