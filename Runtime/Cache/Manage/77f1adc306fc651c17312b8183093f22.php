<?php if (!defined('THINK_PATH')) exit();?><script>
$(function() {
	
	layui.use('laydate', function(){
		var laydate = layui.laydate;
		  
		//执行一个laydate实例
		laydate.render({
			elem: '#detecttime',//指定元素
		    max : '1',
		    type: 'date',
		    range: '~' ,//或 range: '~' 来自定义分割字符
		    festival: true, //是否显示节日
		});
	});
	
	/* layui.use(['laydate'], function() {
		var laydate = layui.laydate;
		var start = {
			//min : laydate.now(),
			//max : '2099-06-16 23:59:59',
			max : laydate.now(),
			istoday : false,
			festival: true, //是否显示节日
			choose : function(datas) {
				end.min = datas; //开始日选好后，重置结束日的最小日期
				end.start = datas //将结束日的初始值设定为开始日
			}
		};

		var end = {
			max : laydate.now(),
			istoday : false,
			festival: true, //是否显示节日
			choose : function(datas) {
				start.max = datas; //结束日选好后，重置开始日的最大日期
			}
		};

		document.getElementById('t1').onclick = function() {
			start.elem = this;
			laydate(start);
		}
		document.getElementById('t2').onclick = function() {
			end.elem = this
			laydate(end);
		}

	}); */
});
</script>
<form class="layui-form layui-form-pane1" name="form1" id="form1" method="get" action="__URL__" class="form-inline" style="margin-bottom: 15px;">
	<input type="hidden" name="m" value="<?php echo (MODULE_NAME); ?>" />
	<input type="hidden" name="a" value="<?php echo (ACTION_NAME); ?>" />
	<input type="hidden" name="g" value="<?php echo (GROUP_NAME); ?>" />
	<input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>" />
	<div class="layui-form-item">

		<div class="layui-inline">

			<!-- <div class="layui-input-inline" style="width: 150px;">
				<input id="t1" name="t1" value="<?php echo ($_GET['t1']); ?>"  placeholder="购买开始时间" autocomplete="off" class="layui-input">
			</div>
			<div class="layui-form-mid">-</div>
			<div class="layui-input-inline" style="width: 150px;">
				<input type="text" id="t2" name="t2" value="<?php echo ($_GET['t2']); ?>"  placeholder="购买结束时间" autocomplete="off" class="layui-input">
			</div> -->
			<div class="layui-input-inline">
				<input id="detecttime" name="detecttime" value="<?php echo ($_GET['detecttime']); ?>"  placeholder="开始时间 到 结束时间" autocomplete="off" class="layui-input">
			</div>
			<div class="layui-input-inline">
				<input type="submit" name="sub" value="查询" class="layui-btn">
				<button type="reset" name="btn"onclick="location.href='__URL__/history/id/<?php echo ($_GET['id']); ?>'" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
	</div>
</form>

<table class="layui-table">
  	<thead>
	    <tr>
	   	 	<th>序号</th>
	      	<th>日期</th>
			<th>关键词</th>
			<th>渠道</th>
			<th>排名</th>
			<th>操作</th>
	    </tr> 
  	</thead>
 		<tbody>
  		<?php if(!empty($list['data'])): if(is_array($list['data'])): $i = 0; $__LIST__ = $list['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
	    	<!-- 日期 -->
			<td><?php echo ($vo['No']); ?></td>
	      	<!-- 日期 -->
			<td><?php echo (format_date($vo['createtime'])); ?></td>
			
			<!--关键词-->
			<td><?php echo ($vo['keyword']); ?></td>
			
			<!--渠道-->
			<td><?php echo ($vo['searchengine_zh']); ?></td>
			
			<!-- 排名 -->
			<td><?php if($vo['rank'] > 0 AND $vo['rank'] <= 10): ?><span style="color: red"><?php echo ($vo['rank']); ?></span>
				<?php else: ?>
				<?php echo (($vo['rank'])?($vo['rank']):'100+'); endif; ?></td>
			<td>
				<a href="javascript:void(0);" onclick="open_layer('指定排名','<?php echo U('setRankPage');?>/id/<?php echo ($vo['id']); ?>/rank/<?php echo ($vo['rank']); ?>/original/<?php echo ($vo['rank_original']); ?>/day/<?php echo (format_date($vo['createtime'])); ?>?returnUrl=<?php echo (urlencode($returnUrl)); ?>',500,350)" class="layui-btn layui-btn-mini">指定排名</a>
			</td>
											
	    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	<?php else: ?>
	<tr>
		<td colspan="4">
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