<?php if (!defined('THINK_PATH')) exit();?>	<style type="text/css">
	
		.layui-elem-quote span {
			color: #f00;
			margin-right: 10px;
		}
		</style>
		<script type="text/javascript">
		$(function() {
			layui.use(['form'], function(){
				var form = layui.form;
			  
			  
			});
		});
		</script>
	<blockquote class="layui-elem-quote">
		站点总数：<span><?php echo (($data['record']['site_num'])?($data['record']['site_num']):0); ?></span> 
		优化关键词数：<span><?php echo (($data['record']['optimize_num'])?($data['record']['optimize_num']):0); ?></span>
		达标词数：<span><?php echo (($data['record']['standards_num'])?($data['record']['standards_num']):0); ?></span> 
		达标消费：<span><?php echo (format_money($data['record']['standard_fee'])); ?></span>
		累计消费：<span><?php echo (format_money($data['record']['funs_info']['total_consumption'])); ?></span>
		预付冻结费用：<span><?php echo (format_money($data['record']['funs_info']['freezefunds'])); ?></span>
		可用余额：<span><?php echo (format_money($data['record']['funs_info']['availablefunds'])); ?></span>
		账户余额：<span><?php echo (format_money($data['record']['funs_info']['balancefunds'])); ?></span>
	</blockquote>
		
	<form name="form1" id="form1" method="get" action="__URL__" class="layui-form">
		<input type="hidden" name="m" value="<?php echo (MODULE_NAME); ?>" /> 
		<input type="hidden" name="a" value="<?php echo (ACTION_NAME); ?>" />
		<input type="hidden" name="g" value="<?php echo (GROUP_NAME); ?>" />
		
		<div class="layui-form-item">
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <input type="text" class="layui-input" name="keyword" value="<?php echo ($_GET['keyword']); ?>" placeholder="关键词">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <input type="text" name="website" class="layui-input" value="<?php echo ($_GET['website']); ?>" placeholder="网址">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <select id="" name="searchengine" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >搜索引擎</option><?php  foreach($SearchengineOptions as $key=>$val) { if(!empty($_GET['searchengine']) && ($_GET['searchengine'] == $key || in_array($key,$_GET['searchengine']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <select id="" name="keywordstatus" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >所有状态</option><?php  foreach($keywordstatusOptions as $key=>$val) { if(!empty($_GET['keywordstatus']) && ($_GET['keywordstatus'] == $key || in_array($key,$_GET['keywordstatus']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <select id="" name="standardstatus" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >达标状态</option><?php  foreach($standardstatusOptions as $key=>$val) { if(!empty($_GET['standardstatus']) && ($_GET['standardstatus'] == $key || in_array($key,$_GET['standardstatus']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 160px;">
		        <select id="" name="num_per_page" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >默认每页显示20条</option><?php  foreach($PerPageOptions as $key=>$val) { if(!empty($_GET['num_per_page']) && ($_GET['num_per_page'] == $key || in_array($key,$_GET['num_per_page']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <input type="submit" name="sub" value="查询" class="layui-btn">
		        <button type="reset" name="btn" onclick="location.href='__URL__/effect'" class="layui-btn layui-btn-primary">重置</button>
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
		<!-- <th>ID</th> -->
		<th width="150">关键词</th>
		<th>网址</th>
		<th width="80">搜索引擎</th>
		<th width="90" align="center" style="text-align: center;">添加日期</th>
		<th width="60" align="center" style="text-align: center;">单价</th>
		<!-- <th>购买天数</th>-->
		<!--<th>检测时间<th>-->
		<th width="60" align="center" style="text-align: center;">初始排名</th>
		<th width="60" align="center" style="text-align: center;" title="数据以最新监测时间为准"><a href="__URL__/effect?ord=latestranking&<?php echo ($data['query_params']); ?>">最新排名</a></th>
		<th width="60" align="center" style="text-align: center;" title="数据以最新监测时间为准">最新消费</th>
		<th width="90" align="center" style="text-align: center;">检测时间</th>
		<th width="60" align="center" style="text-align: center;"><a href="__URL__/effect?ord=standarddays desc&<?php echo ($data['query_params']); ?>">达标天数</a></th>
		<!-- <th>昨日扣费</th> -->
		<th width="60" align="center" style="text-align: center;"><a href="__URL__/effect?ord=totalconsumption desc&<?php echo ($data['query_params']); ?>">累计消费</a></th>
		<th width="50" align="center" style="text-align: center;">状态</th>
		<th width="70">历史数据</th>
    </tr> 
 	</thead>
	<tbody>
 		<?php if(!empty($list['data'])): if(is_array($list['data'])): $i = 0; $__LIST__ = $list['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
	      	<td><?php echo ($vo['No']); ?></td>
			<!-- <td><?php echo ($vo['id']); ?></td> -->
			<!-- 关键词 -->
			<td>
				<a target="_balnk" href="<?php echo ($vo['searchengine_url']); ?>"><?php echo ($vo['keyword']); ?></a>
			</td>
			<!-- 网址 -->
			<td><?php echo ($vo['website']); ?></td>
			<!-- 搜索引擎 -->
			<td><?php echo ($vo['searchengine_ZH']); ?></td>
			<!-- 添加日期 -->
			<td align="center" style="text-align: center;"><?php echo (format_date($vo['createtime'])); ?></td>
			<!-- 单价 -->
			<td align="center" style="text-align: center;"><?php echo (format_money($vo['price'])); echo ($vo['unit']); ?>/<?php echo ($vo['unit2']); ?></td>
			<!-- 购买天数 -->
			<!--<td>30 </td>-->
			<!-- 初始排名 -->
			<td align="center" style="text-align: center;">
				<?php echo (($vo['initialranking'])?($vo['initialranking']):'100+'); ?>
			</td>
			<!--最新排名-->
			<td align="center" style="text-align: center;">
				<span><?php echo (($vo['latestranking_show'])?($vo['latestranking_show']):'100+'); ?></span>
				<?php if(($vo['initialranking']) == "0"): ?><!-- 如果初始排名为0  -->
					<?php if(($vo['latestranking']) > "0"): ?><img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;float: right;"><?php endif; ?>
				<?php else: ?>
					<?php if(($vo['latestranking']) == "0"): ?><img src="__PUBLIC__/img/down.gif" style="vertical-align: middle;;float: right;">
					<?php else: ?>
						<!-- 如果初始排名不为0  -->
						<?php if(($vo['latestranking']) > $vo['initialranking']): ?><img src="__PUBLIC__/img/down.gif" style="vertical-align: middle;;float: right;">
						<?php else: ?>
							<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;;float: right;"><?php endif; endif; endif; ?>
			</td>

			<!-- 最新消费-->
			<td align="center" style="text-align: center;">
			<?php echo (format_money($vo['latestconsumption'])); ?> 
			</td>

			<!--检测时间-->
			<td align="center" style="text-align: center;">
			<?php echo (format_date($vo['detectiondate'])); ?> 
			</td>

			<!-- 达标天数 -->
			<td align="center" style="text-align: center;">
			<?php echo ($vo['standarddays']); ?> 
			</td>

			<!-- 累计消费 -->
			<td align="center" style="text-align: center;">
			<?php echo (format_money($vo['total_consumption'])); ?> 
			</td>

			<td align="center" style="text-align: center;">
				<?php echo ($vo['keywordstatus']); ?>
			</td>
			
			<td>
				<a href="javascript:void(0);" onclick="open_layer('查看详情','<?php echo U('history');?>/id/<?php echo ($vo['id']); ?>?returnUrl=<?php echo (urlencode($returnUrl)); ?>','50%')" class="layui-btn layui-btn-mini">查看详情</a></td>
		

			<!-- <td>
				<?php if(($vo['isCanEdit']) == "1"): ?><a onclick="return confirm(&quot;确定删除吗?&quot;)" class="btn btn-danger btn-xs" href="__URL__/delete/id/<?php echo ($vo['id']); ?>">删除</a>
				<?php else: ?>
				<button type="button" class="btn btn-default btn-xs no-drop" disabled="disabled" style="background-color:#9e9e9e;">删除</button><?php endif; ?>

			</td> -->
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