<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
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

<?php if(($list["can_add_agent"]) == "1"): ?><h3 class="rwgl mb20">
 	<a href="javascript:;" onclick="open_layer('添加代理商用户','<?php echo U('insertPage');?>/usertype/agent/usergroup/Agent/&returnUrl=<?php echo ($returnUrl); ?>','50%')" class="layui-btn"><i class="iconfont icon-jia"></i> 添加代理商</a>
 </h3><?php endif; ?>
<form class="form-inline mt10 mb10 layui-form" name="form1" id="form1" method="get" action="__URL__" >
	<!-- <input type="hidden" name="m" value="<?php echo (MODULE_NAME); ?>" /> 
	<input type="hidden" name="a" value="<?php echo (ACTION_NAME); ?>" />
	<input type="hidden" name="g" value="<?php echo (GROUP_NAME); ?>" /> -->
	<div class="layui-form-item">
		<div class="layui-inline">

			<div class="layui-input-inline" >
				<input id="username" name="username" class="layui-input" value="<?php echo ($_GET['username']); ?>" placeholder="用户名">
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
		<?php if(!empty($list['data'])): if(is_array($list['data'])): $i = 0; $__LIST__ = $list['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($vo['No']); ?></td>
			
			<!-- 一级代理商 -->
			<td>
				<a href="javascript:;" onclick="open_layer('查看代理商用户','<?php echo U('detail');?>/id/<?php echo ($vo['id']); ?>','50%')" ><?php echo ($vo['username']); ?></a>
			</td>
			
			<!-- 子代理数 -->
			<td>
				<?php if(($vo["isopen_subagent"]) == "1"): if(($vo['sub_agent_num']) > "0"): ?><a href="javascript:;" onclick="open_layer('查看子代理','<?php echo U('sub_agent_list');?>/id/<?php echo ($vo['id']); ?>','100%')" ><?php echo ($vo['sub_agent_num']); ?></a>
					<?php else: ?>
						0<?php endif; ?>
				<?php else: ?>
					-<?php endif; ?>
			</td>
			
			
			<!-- 子用户数 -->
			<td>
				<?php if(($vo['sub_user_num']) > "0"): ?><!-- <a href="javascript:;" onclick="open_layer('查看子用户','<?php echo U('sub_user_list');?>/id/<?php echo ($vo['id']); ?>','50%')" ><?php echo ($vo['sub_user_num']); ?></a> -->
					
					<a href="<?php echo U('sub_user_list');?>/pid/<?php echo ($vo['id']); ?>" ><?php echo ($vo['sub_user_num']); ?></a>
				<?php else: ?>
					0<?php endif; ?>
			</td>
			
			<!-- 开通产品 -->
			<td>
				<?php echo ($vo['productnames']); ?>
			</td>
			
			
			<!--创建时间-->
			<td>
				<?php echo ($vo['createtime']); ?> 
			</td>
			
			<!--产品余额-->
			<!--产品余额<?php echo (count($vo['site'])); ?>-->
			<td rowspan="">
				<?php echo (format_money($vo['funds']['totalfunds'])); ?> 
			</td>
		<!--	<td rowspan="">
				<?php echo (format_money($vo['funds']['balancefunds'])); ?> 
			</td>-->
			<td rowspan="">
				<?php echo (format_money($vo['funds']['availablefunds'])); ?> 
			</td>
			
			<!--销售经理-->
			<td><?php echo ($vo['epdir']['seller_manager']['username']); if(!empty($vo['epdir']['seller_manager']['truename'])): ?>（<?php echo ($vo['epdir']['seller_manager']['truename']); ?>）<?php endif; ?></td>
			
			<!--销售员-->
			<td><?php echo ($vo['epdir']['seller']['username']); if(!empty($vo['epdir']['seller']['truename'])): ?>（<?php echo ($vo['epdir']['seller']['truename']); ?>）<?php endif; ?></td>
			
			<!--OEM功能-->
			<td>
				<?php if(($vo["isopen_oem"]) == "1"): ?>已开启
				<?php else: ?>
				未开启<?php endif; ?>
			</td>
			
			<!--状态-->
			<td>
				<?php echo ($vo['userstatus']); ?> 
			</td>
			
			<!--管理-->
			<td>

				<?php if(($vo["can_edit"]) == "1"): ?><!-- 充值金额限制 begin -->
				<?php if(($vo["is_recharge_limit"]) == "1"): ?><a class="layui-btn layui-btn-danger layui-btn-mini"  href="javascript:;" onclick="closeRechargeLimit( <?php echo ($vo['epid']); ?> )" >关闭充值额度限制</a>
				<?php else: ?>
				<a class="layui-btn layui layui-btn-mini"  href="javascript:;" onclick="openRechargeLimit( <?php echo ($vo['epid']); ?> )" >开启充值额度限制</a><?php endif; ?>
				<!-- 充值金额限制 end -->
				
				<!-- OEM功能设置 begin -->
				<?php if(($vo["isopen_oem"]) == "1"): ?><a class="layui-btn layui-btn-danger layui-btn-mini"  href="javascript:;" onclick="closeOEM( <?php echo ($vo['epid']); ?> )" >关闭OEM</a>
				<?php else: ?>
				<a class="layui-btn layui layui-btn-mini"  href="javascript:;" onclick="openOEM( <?php echo ($vo['epid']); ?> )" >开启OEM</a><?php endif; ?>
				<!-- OEM功能设置 end -->
				
				<!-- 二级代理功能设置 begin -->
				<?php if(($vo["isopen_subagent"]) == "1"): ?><a class="layui-btn layui-btn-danger layui-btn-mini"  href="javascript:;" onclick="closeSubAgent( <?php echo ($vo['epid']); ?> )" >关闭二级代理</a>
				<?php else: ?>
				<a class="layui-btn layui layui-btn-mini"  href="javascript:;" onclick="openSubAgent( <?php echo ($vo['epid']); ?> )" >开启二级代理</a><?php endif; ?>
				<!-- 二级代理功能设置 end -->
				<a class="layui-btn layui-btn-mini" target="_blank" href="<?php echo U('UserManagement/loginSubuser');?>/userid/<?php echo ($vo['id']); ?>">登录</a>

				<a class="layui-btn layui-btn-mini"  href="javascript:;" onclick="open_layer('修改代理商用户','<?php echo U('updatePage');?>/id/<?php echo ($vo['id']); ?>/usertype/agent?returnUrl=<?php echo ($returnUrl); ?>','50%')" >修改</a>
				<a class="layui-btn layui-btn-mini"  href="javascript:;" onclick="open_layer('修改代理商用户密码','<?php echo U('updatePasswordPage');?>/id/<?php echo ($vo['id']); ?>/usertype/agent?returnUrl=<?php echo ($returnUrl); ?>','50%')" >密码</a>
				<?php if(($vo['isCanEdit']) == "1"): ?><a class="layui-btn layui-btn-danger layui-btn-mini" href="javascript:;"  onclick="deleteRecord(<?php echo ($vo['id']); ?>)" >删除</a>
				<?php else: ?>
				<button type="button" class="layui-btn layui-btn-danger layui-btn-mini layui-btn-disabled" >删除</button><?php endif; endif; ?>
	
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