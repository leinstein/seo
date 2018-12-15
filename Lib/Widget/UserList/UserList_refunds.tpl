<script type="text/javascript">
	$(function() {
		layui.use(['form'], function(){
			var form = layui.form;
		});
	});
</script>  	
<form class="form-inline mt10 mb10 layui-form" name="form1" id="form1" method="get" action="__URL__" >
	<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
	<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
	<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
	<div class="layui-form-item">
		<div class="layui-inline">
	      <div class="layui-input-inline" style="width: 100px;">
		        <input id="username" name="username" class="layui-input" value="{$Think.get.username}" placeholder="用户名">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <html:select options="AgentUserOptions" first="代理商" name="pid"  style="" selected="_GET['pid']" />
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 160px;">
		        <html:select options="PerPageOptions" first="默认每页显示20条" name="num_per_page"  style="" selected="_GET['num_per_page']" />
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		      	<input type="hidden" name="id" value="{$Think.get.id}" />
		        <input type="submit" name="sub" value="查询" class="layui-btn">
		        <button type="reset" name="btn" onclick="location.href='__URL__/{$Think.ACTION_NAME}/id/{$Think.get.id}'" class="layui-btn layui-btn-primary">重置</button>
		      </div>
		    </div>
		    
	</div>
</form>


<table class="layui-table">
	<thead>
		<tr>
			<th width="20">序号</th>
			<th>用户名</th>
			<th>开通产品</th>
			<th>公司名称</th>
			<th>一级代理商</th>
			<th>站点</th>
			<th>总资金</th>
		<!--	<th>资金余额</th>-->
			<th>可用余额</th>
			<th>销售经理</th>
			<th>销售员</th>
			<th>状态</th>
			<th>创建时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<notempty name="list['data']">
		<volist name="list['data']" id="vo">
		<tr <if condition="in_array( $vo['id'],$userids_less)">style="background: red;color:#fff"</if>>
			<if condition="$vo['site']|count gt 0">
				<td rowspan="{$vo['site']|count}">
					{$vo['No']}
				</td>
			<else />
				<td rowspan="1">
					{$vo['No']}
				</td>
			</if>



																									  <!-- 一级代理商 -->
			<if condition="$vo['site']|count gt 0">
				<td rowspan="{$vo['site']|count}">
					<a href="javascript:;" onclick="open_layer('查看子用户','{:U('UserManagement/detail')}/id/{$vo['id']}/usertype/sub','50%')" >{$vo['username']}</a>
				</td>
			<else />
				<td rowspan="1">
					<a href="javascript:;" onclick="open_layer('查看子用户','{:U('UserManagement/detail')}/id/{$vo['id']}/usertype/sub','50%')" >{$vo['username']}</a>
				</td>
			</if>
																									  <!-- 开通产品 -->
			<if condition="$vo['site']|count gt 0">
				<td rowspan="{$vo['site']|count}">
					{$vo['productnames']}
				</td>
			<else />
				<td rowspan="1">
					{$vo['productnames']}
				</td>
			</if>
																									  <!--公司名称-->
			<if condition="$vo['site']|count gt 0">
				<td rowspan="{$vo['site']|count}">
					{$vo['epname']}
				</td>
			<else />
				<td rowspan="1">
					{$vo['epname']}
				</td>
			</if>
																									  <!-- 一级代理商 -->
			<if condition="$vo['site']|count gt 0">
				<td rowspan="{$vo['site']|count}">
					{$vo['agent']['username']}
				</td>
			<else />
				<td rowspan="1">
					{$vo['agent']['username']}
				</td>
			</if>

			<td >
				{$vo['site'][0]['website']}
			</td>

																									  <!--产品余额-->
			<if condition="$vo['site']|count gt 0">
				<td rowspan="{$vo['site']|count}">
					{$vo['totalfunds']|format_money}
				</td>
			<else />
				<td rowspan="1">
					{$vo['totalfunds']|format_money}
				</td>
			</if>

			<if condition="$vo['site']|count gt 0">
				<td rowspan="{$vo['site']|count}">
					{$vo['availablefunds']|format_money}
				</td>
			<else />
				<td rowspan="1">
					{$vo['availablefunds']|format_money}
				</td>
			</if>

																									  <!--销售经理-->
			<if condition="$vo['site']|count gt 0">
				<td rowspan="{$vo['site']|count}">
					{$vo['epdir']['seller_manager']['username']}<notempty name="vo['epdir']['seller_manager']['truename']">（{$vo['epdir']['seller_manager']['truename']}）</notempty>
				</td>
			<else />
				<td rowspan="1">
					{$vo['epdir']['seller_manager']['username']}<notempty name="vo['epdir']['seller_manager']['truename']">（{$vo['epdir']['seller_manager']['truename']}）</notempty>
				</td>
			</if>

																									  <!--销售员-->
			<if condition="$vo['site']|count gt 0">
				<td rowspan="{$vo['site']|count}">
					{$vo['epdir']['seller']['username']}<notempty name="vo['epdir']['seller']['truename']">（{$vo['epdir']['seller']['truename']}）</notempty>
				</td>
			<else />
				<td rowspan="1">
					{$vo['epdir']['seller']['username']}<notempty name="vo['epdir']['seller']['truename']">（{$vo['epdir']['seller']['truename']}）</notempty>
				</td>
			</if>


																									  <!--状态-->
			<if condition="$vo['site']|count gt 0">
				<td rowspan="{$vo['site']|count}">
					{$vo['userstatus']}
				</td>
			<else />
				<td rowspan="1">
					{$vo['userstatus']}
				</td>
			</if>

																									  <!--创建时间-->
			<if condition="$vo['site']|count gt 0">
				<td rowspan="{$vo['site']|count}">
					{$vo['createtime']|format_date}
				</td>
			<else />
				<td rowspan="1">
					{$vo['createtime']|format_date}
				</td>
			</if>

																									  <!--管理-->
			<if condition="$vo['site']|count gt 0">
				<td rowspan="{$vo['site']|count}">
					<a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-mini" onclick="open_layer('用户退款','{:U('Finance/refundsPage')}/id/{$vo['id']}&returnUrl={$returnUrl}',600,550)" >退款</a>
				</td>
			<else />
				<td rowspan="1">
					<a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-mini" onclick="open_layer('用户退款','{:U('Finance/refundsPage')}/id/{$vo['id']}&returnUrl={$returnUrl}',600,550)" >退款</a>
				</td>
			</if>

		</tr>
		
		<php>unset($vo['site'][0]);</php>
			<volist name="vo['site']" id="vo2" >
			<tr <if condition="in_array( $vo['id'],$userids_less)">style="background: red;color:#fff"</if>>
			
			<td >
				{$vo2['website']} 
			</td>
			
			</tr>
		</volist>	
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