<script type="text/javascript">
	$(function() {
		layui.use(['form'], function(){
			var form = layui.form;
		  
		  
		});
	});
	/**
	 * 删除代理商
	 */
	function deleteRecord(id) {
        layer_confirm('删除该代理商无法恢复，您确认删除么？',
            function () {

                window.location.href = "__URL__/deleteRecord/id/" + id;

            });
    }
	/**
	 * 开启OEM功能
	 */
	function openOEM( epid ) {
        layer_confirm('您确定为该代理商开启OEM功能么？',
            function () {

                window.location.href = "__URL__/openOEM/epid/" + epid;

            });
    }
	/**
	 * 关闭OEM功能
	 */
	function closeOEM( epid ) {
        layer_confirm('您确定关闭该代理商OEM功能么？',
            function () {

                window.location.href = "__URL__/closeOEM/epid/" + epid;

            });
    }
	
	/**
	 * 开启二级代理功能
	 */
	function openSubAgent( epid ) {
        layer_confirm('您确定为该代理商开启二级代理功能么？',
            function () {

                window.location.href = "__URL__/openSubAgent/epid/" + epid;

            });
    }
	/**
	 * 关闭二级代理功能
	 */
	function closeSubAgent( epid ) {
        layer_confirm('您确定关闭该代理商二级代理功能么？',
            function () {

                window.location.href = "__URL__/closeSubAgent/epid/" + epid;

            });
    }
	/**
	 * 开启二级代理功能
	 */
	function openRechargeLimit( epid ) {
        layer_confirm('您确定为该代理商开启充值额度限制么？',
            function () {

                window.location.href = "__URL__/openRechargeLimit/epid/" + epid;

            });
    }
	/**
	 * 关闭二级代理功能
	 */
	function closeRechargeLimit( epid ) {
        layer_confirm('您确定关闭该代理商充值额度限制么？',
            function () {

                window.location.href = "__URL__/closeRechargeLimit/epid/" + epid;

            });
    }
	
	
</script>

<eq name="list.can_add_agent" value="1">
<h3 class="rwgl mb20">
 	<a href="javascript:;" onclick="open_layer('添加代理商用户','{:U('insertPage')}/usertype/agent/usergroup/Agent/&returnUrl={$returnUrl}','50%')" class="layui-btn"><i class="iconfont icon-jia"></i> 添加代理商</a>
 </h3>	
 </eq>
<form class="form-inline mt10 mb10 layui-form" name="form1" id="form1" method="get" action="__URL__" >
	<!-- <input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
	<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
	<input type="hidden" name="g" value="{$Think.GROUP_NAME}" /> -->
	<div class="layui-form-item">
		<div class="layui-inline">

			<div class="layui-input-inline" >
				<input id="username" name="username" class="layui-input" value="{$Think.get.username}" placeholder="用户名">
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
			<th>代理商</th>
			<th>子代理数</th>
			<th>子用户数</th>
			<th>开通产品</th>
			<th>创建时间</th>
			<th>总资金</th>
			<!--<th>资金余额</th>-->
			<th>可用余额</th>
			<th>销售经理</th>
			<th>销售员</th>
			<th>OEM功能</th>
			<th>状态</th>
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
				<a href="javascript:;" onclick="open_layer('查看代理商用户','{:U('detail')}/id/{$vo['id']}','50%')" >{$vo['username']}</a>
			</td>
			
			<!-- 子代理数 -->
			<td>
				<eq name="vo.isopen_subagent" value="1">
					<gt name="vo['sub_agent_num']" value="0">
						<a href="javascript:;" onclick="open_layer('查看子代理','{:U('sub_agent_list')}/id/{$vo['id']}','100%')" >{$vo['sub_agent_num']}</a>
					<else/>
						0
					</gt>
				<else/>
					-
				</eq>
			</td>
			
			
			<!-- 子用户数 -->
			<td>
				<gt name="vo['sub_user_num']" value="0">
					<!-- <a href="javascript:;" onclick="open_layer('查看子用户','{:U('sub_user_list')}/id/{$vo['id']}','50%')" >{$vo['sub_user_num']}</a> -->
					
					<a href="{:U('sub_user_list')}/pid/{$vo['id']}" >{$vo['sub_user_num']}</a>
				<else/>
					0
				</gt>
			</td>
			
			<!-- 开通产品 -->
			<td>
				{$vo['productnames']}
			</td>
			
			
			<!--创建时间-->
			<td>
				{$vo['createtime']} 
			</td>
			
			<!--产品余额-->
			<!--产品余额{$vo['site']|count}-->
			<td rowspan="">
				{$vo['funds']['totalfunds']|format_money} 
			</td>
		<!--	<td rowspan="">
				{$vo['funds']['balancefunds']|format_money} 
			</td>-->
			<td rowspan="">
				{$vo['funds']['availablefunds']|format_money} 
			</td>
			
			<!--销售经理-->
			<td>{$vo['epdir']['seller_manager']['username']}<notempty name="vo['epdir']['seller_manager']['truename']">（{$vo['epdir']['seller_manager']['truename']}）</notempty></td>
			
			<!--销售员-->
			<td>{$vo['epdir']['seller']['username']}<notempty name="vo['epdir']['seller']['truename']">（{$vo['epdir']['seller']['truename']}）</notempty></td>
			
			<!--OEM功能-->
			<td>
				<eq name="vo.isopen_oem" value="1">
				已开启
				<else/>
				未开启
				</eq>
			</td>
			
			<!--状态-->
			<td>
				{$vo['userstatus']} 
			</td>
			
			<!--管理-->
			<td>

				<eq name="vo.can_edit" value="1">
				
				<!-- 充值金额限制 begin -->
				<eq name="vo.is_recharge_limit" value="1">
				<a class="layui-btn layui-btn-danger layui-btn-mini"  href="javascript:;" onclick="closeRechargeLimit( {$vo['epid']} )" >关闭充值额度限制</a>
				<else/>
				<a class="layui-btn layui layui-btn-mini"  href="javascript:;" onclick="openRechargeLimit( {$vo['epid']} )" >开启充值额度限制</a>
				</eq>
				<!-- 充值金额限制 end -->
				
				<!-- OEM功能设置 begin -->
				<eq name="vo.isopen_oem" value="1">
				<a class="layui-btn layui-btn-danger layui-btn-mini"  href="javascript:;" onclick="closeOEM( {$vo['epid']} )" >关闭OEM</a>
				<else/>
				<a class="layui-btn layui layui-btn-mini"  href="javascript:;" onclick="openOEM( {$vo['epid']} )" >开启OEM</a>
				</eq>
				<!-- OEM功能设置 end -->
				
				<!-- 二级代理功能设置 begin -->
				<eq name="vo.isopen_subagent" value="1">
				<a class="layui-btn layui-btn-danger layui-btn-mini"  href="javascript:;" onclick="closeSubAgent( {$vo['epid']} )" >关闭二级代理</a>
				<else/>
				<a class="layui-btn layui layui-btn-mini"  href="javascript:;" onclick="openSubAgent( {$vo['epid']} )" >开启二级代理</a>
				</eq>
				<!-- 二级代理功能设置 end -->
				<a class="layui-btn layui-btn-mini" target="_blank" href="{:U('UserManagement/loginSubuser')}/userid/{$vo['id']}">登录</a>

				<a class="layui-btn layui-btn-mini"  href="javascript:;" onclick="open_layer('修改代理商用户','{:U('updatePage')}/id/{$vo['id']}/usertype/agent?returnUrl={$returnUrl}','50%')" >修改</a>
				<a class="layui-btn layui-btn-mini"  href="javascript:;" onclick="open_layer('修改代理商用户密码','{:U('updatePasswordPage')}/id/{$vo['id']}/usertype/agent?returnUrl={$returnUrl}','50%')" >密码</a>
				<eq name="vo['isCanEdit']" value="1">
				<a class="layui-btn layui-btn-danger layui-btn-mini" href="javascript:;"  onclick="deleteRecord({$vo['id']})" >删除</a>
				<else/>
				<button type="button" class="layui-btn layui-btn-danger layui-btn-mini layui-btn-disabled" >删除</button>
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