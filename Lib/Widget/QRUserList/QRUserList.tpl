<script type="text/javascript">
	$(function() {
		layui.use(['form'], function(){
			var form = layui.form;
		  
		  
		});
	});
	
	function deleteRecord(id) {
		layer_confirm('删除后该用户无法恢复，您确认删除么？',
		function () {

			window.location.href = "__URL__/deleteRecord/id/" + id +"&returnUrl={$returnUrl|urlencode}";

		});
    }
</script>
<form class="layui-form mt10" name="form1" id="form1" method="get" action="__URL__" >
	<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
	<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
	<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
	<div class="layui-form-item">
		<div class="layui-inline">

			<div class="layui-input-inline" >
				<input id="username" name="username" class="layui-input" value="{$Think.get.username}" placeholder="用户名">
			</div>
			<div class="layui-input-inline">
				<input id="epname" name="epname" class="layui-input" value="{$Think.get.epname}" placeholder="公司名">
			</div>
			
			<div class="layui-input-inline">
				<html:select options="UserStatusOptions" first="用户状态" name="userstatus"  selected="_GET['userstatus']" />
			</div>
			
			
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
			<th>序号</th>
			<th>用户名</th>
			<th>公司名称</th>
			<th>计划数量</th>
			<th>关键词数量</th>
			<th>计费起始日期</th>
			<th>昨日排位消耗</th>
			<th>今日排位消耗</th>
			<th>累计排位消耗</th>
			<th>剩余排位</th>
			<th>总排位</th>
			
			<th>销售经理</th>
			<th>销售员</th>
			<th>状态</th>
			<th>创建时间</th>
			<th>管理</th>
		</tr>
	</thead>
	<tbody>
		<notempty name="list['data']">
		<volist name="list['data']" id="vo">
		<tr>
			<td>{$vo['No']}</td>
			<!-- 一级代理商 -->
			<td>
				<a href="javascript:;" onclick="open_layer('查看子用户','{:U('UserManagement/detail')}/id/{$vo['id']}/usertype/{$vo['usertype']}','50%')" >{$vo['username']}</a>
			</td>
			
			<!--公司名称-->
			<td>{$vo['epname']}</td>
			<td>{$vo['plan_num']|default=0}</td>
			<td>{$vo['keyword_num']|default=0}</td>
			
			<td>{$vo['start_date']}</td>
			
			<td>{$vo['consumption_yesterday']|default=0}</td>
			<td>{$vo['consumption_today']|default=0}</td>
			<td>{$vo['consumption_total']|default=0}</td>
			<td>{$vo['rank_remain']|default=0}</td>
			<td>{$vo['rank_total']|default=0}</td>
			
			<!--销售经理-->
			<td>{$vo['seller_manager']['username']}<notempty name="vo['seller_manager']['truename']">（{$vo['seller_manager']['truename']}）</notempty></td>
			
			<!--销售员-->
			<td>{$vo['seller']['username']}<notempty name="vo['seller']['truename']">（{$vo['seller']['truename']}）</notempty></td>

			<!--产品余额--
			<td>
				{$vo['totalfunds_str']} 
			</td>
			<td>
				{$vo['balancefunds_str']} 
			</td>
			<td>
				{$vo['availablefunds_str']} 
			</td>
			<!--状态-->
			<td>{$vo['userstatus']}</td>
			<!--创建时间-->
			<td>
				{$vo['createtime']|format_date} 
			</td>
		
			
			<!--管理-->
			<td>
				<eq name="operate" value="funds">
					
					<a class="layui-btn layui-btn-danger layui-btn-mini" href="javascript:;" onclick="open_layer('子<eq name="type" value="sub_agent">代理<else/>用户</eq>充值','{:U('rechargePage')}/id/{$vo['id']}/type/{$type}&returnUrl={$returnUrl|urlencode}',500,460)" >充值</a>
				<else/>
				
					<eq name="type" value="sub_agent">
						<eq name="can_login_subagent" value="1">
						<a class="layui-btn layui-btn-mini" target="_blank" href="__URL__/loginSubuser/userid/{$vo['id']}">登录</a>
						</eq>
					<else/>
						<eq name="can_login_subuser" value="1">
						<a class="layui-btn layui-btn-mini" target="_blank" href="__URL__/loginSubuser/userid/{$vo['id']}">登录</a>
						</eq>
					</eq>
					
					<eq name="can_edit_subuser" value="1">
						<a class="layui-btn layui-btn-mini" href="javascript:;" onclick="open_layer('修改子用户','{:U('updatePage')}/id/{$vo['id']}/usertype/{$vo['usertype']}&returnUrl={$returnUrl|urlencode}', '50%')" >修改</a>
						<a class="layui-btn layui-btn-mini" href="javascript:;" onclick="open_layer('修改子用户密码','{:U('updatePasswordPage')}/id/{$vo['id']}/usertype/{$vo['usertype']}/usertype/{$vo['usertype']}&returnUrl={$returnUrl|urlencode}','500',400)" >密码</a>
						<empty name="vo.funds">
							<a href="javascript:;" onclick="deleteRecord({$vo['id']})" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
						</empty>
					</eq>
					
					
					
				</eq>
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