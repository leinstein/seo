<script type="text/javascript">
	$(function() {
		layui.use(['form'], function(){
			var form = layui.form;
		  
		  
		});
	});
	
	function deleteRecord(id) {
        layer_confirm('删除后该用户后无法恢复，您确认删除么？',
            function () {

                window.location.href = "__URL__/deleteRecord/id/" + id;

            });
    }
	
	function openOEM( userid ) {
        layer_confirm('您确定为该代理商开启OEM功能么？',
            function () {

                window.location.href = "__URL__/openOEM/userid/" + userid;

            });
    }
	
	function closeOEM( userid ) {
        layer_confirm('您确定关闭该代理商OEM功能么？',
            function () {

                window.location.href = "__URL__/closeOEM/userid/" + userid;

            });
    }
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
			<!-- <th>用户姓名</th> -->
			<th>公司名称</th>
			<th>一级代理商</th>
			<th>站点</th>
			<th>总资金</th>
			<th>资金余额</th>
			<th>可用余额</th>
			<th>销售经理</th>
			<th>销售员</th>
			<th>状态</th>
			<th>创建时间</th>
			<th width="30">日志</th>
			<th>管理</th>
		</tr>
	</thead>
	<tbody>
		<notempty name="list['data']">
		<volist name="list['data']" id="vo">
		<tr <if condition="in_array( $vo['id'],$userids_less)">style="background: red;color:#fff"</if>>
			<td rowspan="{$vo['site']|count}">{$vo['No']}</td>
			
			<!-- 一级代理商 -->
			<td rowspan="{$vo['site']|count}">
				<a href="javascript:;" onclick="open_layer('查看子用户','{:U('detail')}/id/{$vo['id']}/usertype/sub','50%')" >{$vo['username']}</a>
			</td>
			<!-- 用户姓名 -->
			<!-- <td rowspan="{$vo['site']|count}">
				{$vo['truename']}
			</td> -->
			
			<!-- 开通产品 -->
			<td rowspan="{$vo['site']|count}">
				{$vo['productnames']}
			</td>
			
			<!--公司名称-->
			<td rowspan="{$vo['site']|count}">
				{$vo['epname']} 
			</td>
			
			<!-- 一级代理商 -->
			<td rowspan="{$vo['site']|count}">
				{$vo['agent']['username']}
			</td>
			
			<td >
				{$vo['site'][0]['website']} 
			</td>
			
			<!--产品余额-->
			<td rowspan="{$vo['site']|count}">
				{$vo['totalfunds']|format_money} 
			</td>
			<td rowspan="{$vo['site']|count}">
				{$vo['balancefunds']|format_money} 
			</td>
			<td rowspan="{$vo['site']|count}">
				{$vo['availablefunds']|format_money} 
			</td>

			<!--销售经理-->
			<td rowspan="{$vo['site']|count}">{$vo['epdir']['seller_manager']['username']}<notempty name="vo['epdir']['seller_manager']['truename']">（{$vo['epdir']['seller_manager']['truename']}）</notempty></td>
			
			<!--销售员-->
			<td rowspan="{$vo['site']|count}">{$vo['epdir']['seller']['username']}<notempty name="vo['epdir']['seller']['truename']">（{$vo['epdir']['seller']['truename']}）</notempty></td>
			<!--产品余额--
			<td rowspan="{$vo['site']|count}">
				{$vo['totalfunds_str']} 
			</td>
			<td rowspan="{$vo['site']|count}">
				{$vo['balancefunds_str']} 
			</td>
			<td rowspan="{$vo['site']|count}">
				{$vo['availablefunds_str']} 
			</td>
			
			<!--状态-->
			<td rowspan="{$vo['site']|count}">
				{$vo['userstatus']} 
			</td>
			<!--创建时间-->
			<td rowspan="{$vo['site']|count}">
				{$vo['createtime']|format_date} 
			</td>
		
			<td rowspan="{$vo['site']|count}">
			 	<a href="{:U('Remark/index')}/productid/1/objecttype/user/objectid/{$vo['id']}/touserid/{$vo['id']}/tousername/{$vo['username']|urlencode}&returnUrl={$returnUrl|urlencode}" class="layui-btn layui-btn-mini">查看日志</a>               	
            </td>
            
			<!--管理-->
			<td rowspan="{$vo['site']|count}">
			<eq name="vo.can_edit" value="1">
				<a class="layui-btn layui-btn-mini"  href="javascript:;" onclick="open_layer('修改子用户','{:U('updatePage')}/id/{$vo['id']}/usertype/sub&returnUrl={$returnUrl|urlencode}','50%')" >修改</a>
				<a class="layui-btn layui-btn-mini"  href="javascript:;" onclick="open_layer('修改子用户密码','{:U('updatePasswordPage')}/id/{$vo['id']}/usertype/sub&returnUrl={$returnUrl|urlencode}','50%')" >密码</a>
				
				<a class="layui-btn layui-btn-mini" target="_blank" href="__URL__/loginSubuser/userid/{$vo['id']}">登录</a>
				
				
				<eq name="vo.is_can_delete" value="1">
					<a href="javascript:;" onclick="deleteRecord({$vo['id']})" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
				<else/>
	            	<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">删除</button>
				</eq>
				</eq> 
			</td> 

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