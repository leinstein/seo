<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
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
	<!-- <input type="hidden" name="m" value="<?php echo (MODULE_NAME); ?>" /> 
	<input type="hidden" name="a" value="<?php echo (ACTION_NAME); ?>" />
	<input type="hidden" name="g" value="<?php echo (GROUP_NAME); ?>" /> -->
	<div class="layui-form-item">
		<div class="layui-inline">
	      <div class="layui-input-inline" style="width: 100px;">
		        <input id="username" name="username" class="layui-input" value="<?php echo ($_GET['username']); ?>" placeholder="用户名">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <select id="" name="pid" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >代理商</option><?php  foreach($AgentUserOptions as $key=>$val) { if(!empty($_GET['pid']) && ($_GET['pid'] == $key || in_array($key,$_GET['pid']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 160px;">
		        <select id="" name="num_per_page" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >默认每页显示20条</option><?php  foreach($PerPageOptions as $key=>$val) { if(!empty($_GET['num_per_page']) && ($_GET['num_per_page'] == $key || in_array($key,$_GET['num_per_page']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		      	<input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>" />
		        <input type="submit" name="sub" value="查询" class="layui-btn">
		        <button type="reset" name="btn" onclick="location.href='__URL__/<?php echo (ACTION_NAME); ?>/id/<?php echo ($_GET['id']); ?>'" class="layui-btn layui-btn-primary">重置</button>
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
		<?php if(!empty($list['data'])): if(is_array($list['data'])): $i = 0; $__LIST__ = $list['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr <?php if(in_array( $vo['id'],$userids_less)): ?>style="background: red;color:#fff"<?php endif; ?>>
	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>"><?php echo ($vo['No']); ?></td>
	<?php else: ?>
		<td rowspan="1"><?php echo ($vo['No']); ?></td><?php endif; ?>

	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>">
		<a href="javascript:;" onclick="open_layer('查看子用户','<?php echo U('UserManagement/detail');?>/id/<?php echo ($vo['id']); ?>/usertype/sub','50%')" ><?php echo ($vo['username']); ?></a>
	</td>
	<?php else: ?>
		<td rowspan="1">
		<a href="javascript:;" onclick="open_layer('查看子用户','<?php echo U('UserManagement/detail');?>/id/<?php echo ($vo['id']); ?>/usertype/sub','50%')" ><?php echo ($vo['username']); ?></a>
	</td><?php endif; ?>
																									  <!-- 一级代理商 -->

																									  <!-- 用户姓名 -->
																									  <!-- <td rowspan="<?php echo (count($vo['site'])); ?>">
		<?php echo ($vo['truename']); ?>
	</td> -->

																									  <!-- 开通产品 -->
	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>">
		<?php echo ($vo['productnames']); ?>
	</td>
	<?php else: ?>
		<td rowspan="1">
		<?php echo ($vo['productnames']); ?>
	</td><?php endif; ?>


																									  <!--公司名称-->
	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>">
		<?php echo ($vo['epname']); ?>
	</td>
	<?php else: ?>
		<td rowspan="1">
		<?php echo ($vo['epname']); ?>
	</td><?php endif; ?>


																									  <!-- 一级代理商 -->

	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>">
		<?php echo ($vo['agent']['username']); ?>
	</td>

		<?php else: ?>
	<td rowspan="1">
		<?php echo ($vo['agent']['username']); ?>
	</td><?php endif; ?>


	<td >
		<?php echo ($vo['site'][0]['website']); ?>
	</td>

																									  <!--产品余额-->
	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>">
		<?php echo (format_money($vo['totalfunds'])); ?>
	</td>

		<?php else: ?>
	<td rowspan="1">
		<?php echo (format_money($vo['totalfunds'])); ?>
	</td><?php endif; ?>

	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>">
		<?php echo (format_money($vo['balancefunds'])); ?>
	</td>
		</td>

		<?php else: ?>
				<td rowspan="1">
					<?php echo (format_money($vo['balancefunds'])); ?>
				</td><?php endif; ?>

	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>">
		<?php echo (format_money($vo['availablefunds'])); ?>
	</td>
		</td>
		</td>
		<?php else: ?>
				<td rowspan="1">
					<?php echo (format_money($vo['availablefunds'])); ?>
				</td><?php endif; ?>



																									  <!--销售经理-->
	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>"><?php echo ($vo['epdir']['seller_manager']['username']); if(!empty($vo['epdir']['seller_manager']['truename'])): ?>（<?php echo ($vo['epdir']['seller_manager']['truename']); ?>）<?php endif; ?></td>
		<?php else: ?>
				<td rowspan="1"><?php echo ($vo['epdir']['seller_manager']['username']); if(!empty($vo['epdir']['seller_manager']['truename'])): ?>（<?php echo ($vo['epdir']['seller_manager']['truename']); ?>）<?php endif; ?></td><?php endif; ?>


																									  <!--销售员-->

	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>">
			<?php echo ($vo['epdir']['seller']['username']); ?>
			<?php if(!empty($vo['epdir']['seller']['truename'])): ?>（<?php echo ($vo['epdir']['seller']['truename']); ?>）<?php endif; ?>
		</td>
		<?php else: ?>
		<td rowspan="1">
			<?php echo ($vo['epdir']['seller']['username']); ?>
			<?php if(!empty($vo['epdir']['seller']['truename'])): ?>（<?php echo ($vo['epdir']['seller']['truename']); ?>）<?php endif; ?>
		</td><?php endif; ?>



																									  <!--状态-->
	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>">
			<?php echo ($vo['userstatus']); ?>
		</td>
		<?php else: ?>
		<td rowspan="1">
			<?php echo ($vo['userstatus']); ?>
		</td><?php endif; ?>

																									  <!--创建时间-->
	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>">
			<?php echo (format_date($vo['createtime'])); ?>
		</td>
		<?php else: ?>
		<td rowspan="1">
			<?php echo (format_date($vo['createtime'])); ?>
		</td><?php endif; ?>

	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>">
			<a href="<?php echo U('Remark/index');?>/productid/1/objecttype/user/objectid/<?php echo ($vo['id']); ?>/touserid/<?php echo ($vo['id']); ?>/tousername/<?php echo ($vo['username']); ?>&returnUrl=<?php echo ($returnUrl); ?>" class="layui-btn layui-btn-mini">查看日志</a>
		</td>
	<?php else: ?>
		<td rowspan="1">
			<a href="<?php echo U('Remark/index');?>/productid/1/objecttype/user/objectid/<?php echo ($vo['id']); ?>/touserid/<?php echo ($vo['id']); ?>/tousername/<?php echo ($vo['username']); ?>&returnUrl=<?php echo ($returnUrl); ?>" class="layui-btn layui-btn-mini">查看日志</a>
		</td><?php endif; ?>

	<?php if($vo['site']|count > 0): ?><td rowspan="<?php echo (count($vo['site'])); ?>">
			<?php if(($vo["can_edit"]) == "1"): ?><a class="layui-btn layui-btn-mini"  href="javascript:;" onclick="open_layer('修改子用户','<?php echo U('UserManagement/updatePage');?>/id/<?php echo ($vo['id']); ?>/usertype/sub?returnUrl=<?php echo ($returnUrl); ?>','50%')" >修改</a>
				<a class="layui-btn layui-btn-mini"  href="javascript:;" onclick="open_layer('修改子用户密码','<?php echo U('UserManagement/updatePasswordPage');?>/id/<?php echo ($vo['id']); ?>/usertype/sub?returnUrl=<?php echo ($returnUrl); ?>','50%')" >密码</a>
				<a class="layui-btn layui-btn-mini" target="_blank" href="<?php echo U('UserManagement/loginSubuser');?>/userid/<?php echo ($vo['id']); ?>">登录</a>
			<?php if(($vo["is_can_delete"]) == "1"): ?><a href="javascript:;" onclick="deleteRecord(<?php echo ($vo['id']); ?>)" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
		<?php else: ?>
			<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">删除</button><?php endif; endif; ?>
	</td>

	<?php else: ?>
		<td rowspan="1">
			<?php if(($vo["can_edit"]) == "1"): ?><a class="layui-btn layui-btn-mini"  href="javascript:;" onclick="open_layer('修改子用户','<?php echo U('UserManagement/updatePage');?>/id/<?php echo ($vo['id']); ?>/usertype/sub?returnUrl=<?php echo ($returnUrl); ?>','50%')" >修改</a>
				<a class="layui-btn layui-btn-mini"  href="javascript:;" onclick="open_layer('修改子用户密码','<?php echo U('UserManagement/updatePasswordPage');?>/id/<?php echo ($vo['id']); ?>/usertype/sub?returnUrl=<?php echo ($returnUrl); ?>','50%')" >密码</a>
				<a class="layui-btn layui-btn-mini" target="_blank" href="<?php echo U('UserManagement/loginSubuser');?>/userid/<?php echo ($vo['id']); ?>">登录</a>
			<?php if(($vo["is_can_delete"]) == "1"): ?><a href="javascript:;" onclick="deleteRecord(<?php echo ($vo['id']); ?>)" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
		<?php else: ?>
			<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">删除</button><?php endif; endif; ?>
		</td><?php endif; ?>
																									
		</tr>
		
		<?php unset($vo['site'][0]); ?>
			<?php if(is_array($vo['site'])): $i = 0; $__LIST__ = $vo['site'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><tr <?php if(in_array( $vo['id'],$userids_less)): ?>style="background: red;color:#fff"<?php endif; ?>>
			
			<td >
				<?php echo ($vo2['website']); ?> 
			</td>
			
			</tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
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