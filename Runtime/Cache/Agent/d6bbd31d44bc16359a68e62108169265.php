<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" xmlns:html="http://www.w3.org/1999/xhtml" xmlns:html="http://www.w3.org/1999/xhtml">
	$(function() {
		layui.use(['form'], function(){
			var form = layui.form;
		  
		  
		});
	});
	
	function deleteRecord(id) {
		layer_confirm('删除后该用户无法恢复，您确认删除么？',
		function () {

			window.location.href = "__URL__/deleteRecord/id/" + id +"&returnUrl=<?php echo ($returnUrl); ?>";

		});
    }
</script>
<form class="layui-form mt10" name="form1" id="form1" method="get" action="__URL__" >
	<input type="hidden" name="m" value="<?php echo (MODULE_NAME); ?>" /> 
	<input type="hidden" name="a" value="<?php echo (ACTION_NAME); ?>" />
	<input type="hidden" name="g" value="<?php echo (GROUP_NAME); ?>" />
	<div class="layui-form-item">
		<div class="layui-inline">

			<div class="layui-input-inline" >
				<input id="username" name="username" class="layui-input" value="<?php echo ($_GET['username']); ?>" placeholder="用户名">
			</div>
			<div class="layui-input-inline">
				<input id="username" name="truename" class="layui-input" value="<?php echo ($_GET['truename']); ?>" placeholder="用户姓名">
			</div>
			<div class="layui-input-inline">
				<input id="epname" name="epname" class="layui-input" value="<?php echo ($_GET['epname']); ?>" placeholder="公司名">
			</div>
			
			<div class="layui-input-inline">
				<select id="" name="userstatus" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >用户状态</option><?php  foreach($UserStatusOptions as $key=>$val) { if(!empty($_GET['userstatus']) && ($_GET['userstatus'] == $key || in_array($key,$_GET['userstatus']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
			</div>
			
			
			<div class="layui-input-inline">
				<input type="submit" name="sub" value="查询" class="layui-btn"> 
				<input type="button" name="btn" value="重置" onclick="location.href='__URL__/<?php echo (ACTION_NAME); ?>'" class="layui-btn layui-btn-primary">
				
			</div>
		</div>
	</div>
	
	
</form>
		
<table class="layui-table">
	<thead>
		<tr>
			<th width="30">序号</th>
			<!-- <th>ID</th> -->
			<th width="50">用户名</th>
			<?php if(($type) != "sub_agent"): ?><th width="50">开通产品</th><?php endif; ?>
			<!-- <th>用户姓名</th> -->
			<th width="50">公司名称</th>
			
			<?php if(($type) == "sub_agent"): ?><th width="50">子用户数</th><?php endif; ?>
			<th width="50">总资金</th>
			<th width="50">资金余额</th>
			<th width="50">可用余额</th>
			<th width="50">销售经理</th>
			<th width="50">销售员</th>
			<th width="50">状态</th>
			<th width="50">创建时间</th>
			<th width="50">管理</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($list['data'])): if(is_array($list['data'])): $i = 0; $__LIST__ = $list['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($vo['No']); ?></td>
			<!-- <td><?php echo ($vo['id']); ?></td> -->
			<!-- 一级代理商 -->
			<td>
				<a href="javascript:;" onclick="open_layer('查看子用户','<?php echo U('UserManagement/detail');?>/id/<?php echo ($vo['id']); ?>/usertype/<?php echo ($vo['usertype']); ?>','50%')" ><?php echo ($vo['username']); ?></a>
			</td>
			
			<!-- 开通产品 -->
			<?php if(($type) != "sub_agent"): ?><td>
				<?php echo ($vo['productnames']); ?>
			</td><?php endif; ?>
			<!-- 用户姓名 -->
			<!-- <td>
				<?php echo ($vo['truename']); ?>
			</td> -->
			
			<!--公司名称-->
			<td><?php echo ($vo['epname']); ?></td>
		
			<?php if(($type) == "sub_agent"): ?><td>
					<!-- <a href="javascript:;" onclick="open_layer('子用户列表','<?php echo U('rechargePage');?>/id/<?php echo ($vo['id']); ?>/type/<?php echo ($type); ?>&returnUrl=<?php echo ($returnUrl); ?>','50%')" ><?php echo (($vo['sub_user_num'])?($vo['sub_user_num']):0); ?></a> -->
					<?php echo (($vo['sub_user_num'])?($vo['sub_user_num']):0); ?>
				</td><?php endif; ?>
			
			<!--产品余额-->
			<td>
				<?php echo (format_money($vo['totalfunds'])); ?> 
			</td>
			<td>
				<?php echo (format_money($vo['balancefunds'])); ?> 
			</td>
			<td>
				<?php echo (format_money($vo['availablefunds'])); ?> 
			</td>
			
			<!--销售经理-->
			<td><?php echo ($vo['epdir']['seller_manager']['username']); if(!empty($vo['epdir']['seller_manager']['truename'])): ?>（<?php echo ($vo['epdir']['seller_manager']['truename']); ?>）<?php endif; ?></td>
			
			<!--销售员-->
			<td><?php echo ($vo['epdir']['seller']['username']); if(!empty($vo['epdir']['seller']['truename'])): ?>（<?php echo ($vo['epdir']['seller']['truename']); ?>）<?php endif; ?></td>

			<!--产品余额--
			<td>
				<?php echo ($vo['totalfunds_str']); ?> 
			</td>
			<td>
				<?php echo ($vo['balancefunds_str']); ?> 
			</td>
			<td>
				<?php echo ($vo['availablefunds_str']); ?> 
			</td>-->
			<!--状态-->
			<td><?php echo ($vo['userstatus']); ?></td>
			<!--创建时间-->
			<td>
				<?php echo (format_date($vo['createtime'])); ?> 
			</td>
		
			
			<!--管理-->
			<td>
				<?php if(($operate) == "funds"): ?><a class="layui-btn layui-btn-danger layui-btn-mini" href="javascript:;" onclick="open_layer('子<?php if(($type) == "sub_agent"): ?>代理<?php else: ?>用户<?php endif; ?>充值','<?php echo U('rechargePage');?>/id/<?php echo ($vo['id']); ?>/type/<?php echo ($type); ?>&returnUrl=<?php echo ($returnUrl); ?>',500,460)" >充值</a>
				<?php else: ?>
				
					<?php if(($type) == "sub_agent"): if(($can_login_subagent) == "1"): ?><a class="layui-btn layui-btn-mini" target="_blank" href="__URL__/loginSubuser/userid/<?php echo ($vo['id']); ?>">登录</a><?php endif; ?>
					<?php else: ?>
						<?php if(($can_login_subuser) == "1"): ?><a class="layui-btn layui-btn-mini" target="_blank" href="__URL__/loginSubuser/userid/<?php echo ($vo['id']); ?>">登录</a><?php endif; endif; ?>
					
					<?php if(($can_edit_subuser) == "1"): ?><a class="layui-btn layui-btn-mini" href="javascript:;" onclick="open_layer('修改子用户','<?php echo U('updatePage');?>/id/<?php echo ($vo['id']); ?>/usertype/<?php echo ($vo['usertype']); ?>?returnUrl=<?php echo ($returnUrl); ?>', '50%')" >修改</a>
						<a class="layui-btn layui-btn-mini" href="javascript:;" onclick="open_layer('修改子用户密码','<?php echo U('updatePasswordPage');?>/id/<?php echo ($vo['id']); ?>/usertype/<?php echo ($vo['usertype']); ?>/usertype/<?php echo ($vo['usertype']); ?>?returnUrl=<?php echo ($returnUrl); ?>','500',400)" >密码</a>
						<?php if(empty($vo["funds"])): ?><a href="javascript:;" onclick="deleteRecord(<?php echo ($vo['id']); ?>)" class="layui-btn layui-btn-danger layui-btn-mini">删除</a><?php endif; endif; endif; ?>
			</td>

		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<?php else: ?>
		<tr>
			<td colspan="15" align="center" class="layui-table-nodata">暂无相关数据</td>
		</tr><?php endif; ?>

	</tbody>
</table>

<!-- 分页 begin -->		
<div class="layui-box layui-laypage">
	<?php echo ($list['html']); ?>
</div>	
<!-- 分页 end -->