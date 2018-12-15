<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	$(function() {
		layui.use(['form'], function(){
			var form = layui.form;
		  
		  
		});
	});
</script>

<form class="layui-form" name="form1" id="form1" method="get" action="__URL__" >
	<input type="hidden" name="m" value="<?php echo (MODULE_NAME); ?>" /> 
	<input type="hidden" name="a" value="<?php echo (ACTION_NAME); ?>" />
	<input type="hidden" name="g" value="<?php echo (GROUP_NAME); ?>" />
	<div class="layui-form-item">
		<div class="layui-inline">
			<div class="layui-input-inline"  style="width: 100px;">
				<input id="username" name="username" class="layui-input" value="<?php echo ($_GET['username']); ?>" placeholder="用户名">
			</div>
			<!-- <div class="layui-input-inline">
				<input id="username" name="truename" class="layui-input" value="<?php echo ($_GET['truename']); ?>" placeholder="用户姓名">
			</div>
			<div class="layui-input-inline">
				<input id="epname" name="epname" class="layui-input" value="<?php echo ($_GET['epname']); ?>" placeholder="公司名">
			</div>
			
			<div class="layui-input-inline">
				<select id="" name="userstatus" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >用户状态</option><?php  foreach($UserStatusOptions as $key=>$val) { if(!empty($_GET['userstatus']) && ($_GET['userstatus'] == $key || in_array($key,$_GET['userstatus']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
			</div> -->
			
			
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
			<th>ID</th>
			<th>代理商</th>
			<th>子代理数</th>
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
	
		<?php if(!empty($list['data'])): if(is_array($list['data'])): $i = 0; $__LIST__ = $list['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($vo['No']); ?></td>
			<td><?php echo ($vo['id']); ?></td>
			<!-- 一级代理商 -->
			<td>
				<a href="javascript:;" onclick="open_layer('查看代理商用户','<?php echo U('UserManagement/detail');?>/id/<?php echo ($vo['id']); ?>/type/agent','50%')" ><?php echo ($vo['username']); ?></a>
			</td>
                        <!-- 子代理数 -->
			<td>
				<?php if(($vo["isopen_subagent"]) == "1"): if(($vo['sub_agent_num']) > "0"): ?><a href="javascript:;" onclick="open_layer('查看子代理','<?php echo U('/Manage/UserManagement/sub_agent_list');?>/id/<?php echo ($vo['id']); ?>','100%')" ><?php echo ($vo['sub_agent_num']); ?></a>
					<?php else: ?>
						0<?php endif; ?>
				<?php else: ?>
					-<?php endif; ?>
			</td>
			<!-- 子用户数 -->
			<td>
				<?php if(($vo['sub_user_num']) > "0"): ?><!-- <a href="javascript:;" onclick="open_layer('查看子用户','<?php echo U('sub_user_list');?>/pid/<?php echo ($vo['id']); ?>','100%')" ><?php echo ($vo['sub_user_num']); ?></a>-->
					<a href="<?php echo U('sub_user_list');?>/pid/<?php echo ($vo['id']); ?>" ><?php echo ($vo['sub_user_num']); ?></a>
					
				<?php else: ?>
					0<?php endif; ?>
			</td>
			
			<!-- 开通产品 -->
			<!-- <td>
				<?php echo ($vo['productnames']); ?>
			</td> -->
			
			<!--创建时间-->
			<td>
				<?php echo ($vo['createtime']); ?> 
			</td>
			<!--产品余额-->
			<td>
				<?php echo (format_money($vo['funds']['availablefunds'])); ?> 
			</td>
			
			<!--产品余额-->
			<!-- <td>
				<?php echo ($vo['availablefunds_str']); ?> 
			</td>
			 -->
			<!--状态-->
			<td>
				<?php echo ($vo['userstatus']); ?> 
			</td>
			
			<!--管理-->
			<td>
				<a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-mini" onclick="open_layer('一级代理商充值','<?php echo U('rechargePage');?>/id/<?php echo ($vo['id']); ?>&returnUrl=<?php echo ($returnUrl); ?>',500,460)" >充值或退款</a>		
				
							
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