<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
		$(function() {
			layui.use(['form'], function(){
				var form = layui.form;
			  
			  
			});
		});
		</script>
	<form name="form" id="form" method="get" action="__URL__" class="layui-form">
		<input type="hidden" name="m" value="<?php echo (MODULE_NAME); ?>" />
		<input type="hidden" name="a" value="<?php echo (ACTION_NAME); ?>" />
		<input type="hidden" name="g" value="<?php echo (GROUP_NAME); ?>" />
		<div class="layui-form-item">
			<div class="layui-inline">
				<div class="layui-input-inline">
					<input type="text" class="layui-input" name="sitename" value="<?php echo ($_GET['sitename']); ?>" placeholder="站点名称">
				</div>
			</div>
			<div class="layui-inline">
				<div class="layui-input-inline">
                      <input type="text" name="website" class="layui-input" value="<?php echo ($_GET['website']); ?>" placeholder="站点地址">
                </div>
			</div>
			<!-- <div class="layui-inline">
				<div class="layui-input-inline">
					<select id="" name="sitestatus" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >站点状态</option><?php  foreach($SiteStatusOptions as $key=>$val) { if(!empty($_GET['sitestatus']) && ($_GET['sitestatus'] == $key || in_array($key,$_GET['sitestatus']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
				</div>
			</div> -->
			<div class="layui-inline">
				<div class="layui-input-inline" style="width: 160px;">
          			<select id="" name="num_per_page" onchange="" ondblclick="" class="form-control" lay-verify="" lay-filter="" readonly="" ><option value="" >默认每页显示20条</option><?php  foreach($PerPageOptions as $key=>$val) { if(!empty($_GET['num_per_page']) && ($_GET['num_per_page'] == $key || in_array($key,$_GET['num_per_page']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
      			</div>
  			</div>
                
			<div class="layui-inline">
            	<div class="layui-input-inline">
                	<input type="submit" name="sub" value="查询" class="layui-btn">
                	<button type="reset" name="btn" onclick="location.href='__URL__/<?php echo (ACTION_NAME); ?>'" class="layui-btn layui-btn-primary"> 重置</button>
            	</div>
        	</div>
    	</div>
	</form>
	<table class="layui-table">
	  	<!-- <colgroup>
	    	<col width="150">
	    	<col width="200">
	    	<col>
	  	</colgroup> -->
	  	<thead>
		    <tr>
		    	<th width="30">序号</th>
		      	<th>站点名称</th>
				<th>网址</th>
				<th>优化关键词数</th>
				<th>达标词数</th>
				<th>达标消费</th>
				<th>预付冻结金额</th>
				<!-- <th >累计上首页数量</th> -->
				<th>累计消费</th>
				<th>添加时间</th>
				<th>历史数据</th>
		    </tr> 
	  	</thead>
	 		<tbody>
	  		<?php if(!empty($list['data'])): if(is_array($list['data'])): $i = 0; $__LIST__ = $list['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
		    	<td><?php echo ($vo['No']); ?></td>
		      	<!-- 站点名称 -->
				<td><a href="javascript:void(0);" onclick="open_layer('站点信息','<?php echo U('detail');?>/id/<?php echo ($vo['id']); ?>','50%')"><?php echo ($vo['sitename']); ?></a></td>
				<!-- 网址 -->
				<td><?php echo ($vo['website']); ?></td>
				<!-- 优化关键词数 -->
				<td><a href="<?php echo U('Keyword/effect');?>/website/<?php echo (base64_encode($vo['website'])); ?>/from/site/keywordstatus/优化中"><?php echo (($vo['optimizationNum'])?($vo['optimizationNum']):0); ?></a></td>
				<!--达标词数-->
				<td class="center hidden-xs "><a href="<?php echo U('Keyword/effect');?>/website/<?php echo (base64_encode($vo['website'])); ?>/from/site/standardstatus/已达标"><?php echo (($vo['standardNum'])?($vo['standardNum']):0); ?></a></td>
				<!--达标消费-->
				<td class="center hidden-xs "><?php echo (format_money($vo['standardfee'])); ?></td>
				<!--累计上首页-->
				<!--  <td class="center hidden-xs "></td> -->
				<!--预付冻结金额-->
				<td><span class="tip tipso_style" data-tipso="初始冻结金额：<?php echo (format_money($vo['initfreezefunds'])); ?>；<br>消耗冻结金额：<?php echo (format_money($vo['consfreezefunds'])); ?>；<br>剩余冻结金额：<?php echo (format_money($vo['remainfreezefunds'])); ?>。"><?php echo (format_money($vo['freezefunds'])); ?></span>								</td>
				<!--累计消费-->
				<td class="center hidden-xs "><?php echo (format_money($vo['consumption'])); ?></td>
				<!--添加时间-->
				<td class="center hidden-xs "><?php echo (format_date($vo['createtime'])); ?></td>
				<!---->
				<td><a href="javascript:void(0);" onclick="open_layer('查看详情','<?php echo U('history');?>/id/<?php echo ($vo['id']); ?>','50%')" class="layui-btn layui-btn-mini">查看详情</a></td>
		    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<?php else: ?>
		<tr>
			<td colspan="10" align="center" class="layui-table-nodata">
				暂无相关数据
			</td>
		</tr><?php endif; ?>
	  	</tbody>
	</table>
	
	<!-- 分页 begin -->		
	<div class="layui-box layui-laypage">
		<?php echo ($list['html']); ?>
	</div>	
	<!-- 分页 end -->	

                    <!-- <table cellpadding="0" cellspacing="0" border="0">
						<thead>
							<tr role="row">
								<th class="center">站点名称</th>
								<th class="center">网址</th>
								<th class="center">优化关键词数</th>
								<th class="center">达标词数</th>
								<th class="center">达标消费</th>
								<th class="center">预付冻结金额</th>
								<th class="center" >累计上首页数量</th>
								<th class="center">累计消费</th>
								<th class="center">添加时间</th>
								<th class="center">历史数据</th>
							</tr>
						</thead>
						<tbody role="alert" aria-live="polite" aria-relevant="all">
						
						<?php if(!empty($list['data'])): if(is_array($list['data'])): $i = 0; $__LIST__ = $list['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="gradeA odd">
								站点名称
								<td class="center hidden-xs">
									<a href="javascript:void(0);" onclick="open_layer('站点信息','<?php echo U('detail');?>/id/<?php echo ($vo['id']); ?>','50%')"><?php echo ($vo['sitename']); ?></a>
								</td>

								网址
								<td class="center hidden-xs">
								<?php echo ($vo['website']); ?>
								</td>
								优化关键词数
								<td class="center hidden-xs">
									<a href="<?php echo U('Keyword/effect');?>/website/<?php echo (urlencode($vo['website'])); ?>/keywordstatus/优化中"><?php echo (($vo['optimizationNum'])?($vo['optimizationNum']):0); ?></a>
								</td>

								达标词数
								<td class="center hidden-xs ">
									<a href="<?php echo U('Keyword/effect');?>/website/<?php echo (urlencode($vo['website'])); ?>/standardstatus/已达标"><?php echo (($vo['standardNum'])?($vo['standardNum']):0); ?></a>
								</td>

								达标消费
								<td class="center hidden-xs "><?php echo (format_money($vo['standardfee'])); ?></td>

								累计上首页
								  <td class="center hidden-xs ">
                                          		</td>
								预付冻结金额
								<td class="center hidden-xs">
									<span class="tip tipso_style" data-tipso="初始冻结金额：<?php echo (format_money($vo['initfreezefunds'])); ?>；<br>消耗冻结金额：<?php echo (format_money($vo['consfreezefunds'])); ?>；<br>剩余冻结金额：<?php echo (format_money($vo['remainfreezefunds'])); ?>。"><?php echo (format_money($vo['freezefunds'])); ?></span>
								</td>

								累计消费
								<td class="center hidden-xs "><?php echo (format_money($vo['consumption'])); ?></td>


								添加时间
								<td class="center hidden-xs "><?php echo (format_date($vo['createtime'])); ?></td>

								
								<td class="center hidden-xs">
									<a href="javascript:void(0);" onclick="open_layer('查看详情','<?php echo U('history');?>/id/<?php echo ($vo['id']); ?>','50%')" class="layui-btn layui-btn-mini">查看详情</a>					
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						<?php else: ?>
						<tr>
							<td class="center" colspan="9">
								暂无相关数据
							</td>
						</tr><?php endif; ?>
						</tbody>
					</table> -->