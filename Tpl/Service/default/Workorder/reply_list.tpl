<!DOCTYPE html>
<html lang="zh-CN">
<php>//$page_title = "修改站点";</php>
<head>
<include file="../Public/header" />
<!-- 引入layim css begin -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/layim.css">
<!-- 引入 layim css end -->

</head>
<body>


	<div class="layui-tab-content">
		<form class="layui-form" name="form1" action="{:U('reply')}" method="post">

			<input type="hidden" name="workorderid" value="{$data['id']}">
			
			
			<!-- 工单回复列表挂件 begin -->
			{:W('WorkorderReply', array( 'data' => $data,  'skin' => 'list','returnUrl' => $returnUrl , 'me' => $LoginUserInfo))}
			<!-- 工单回复列表挂件 end -->	
			
			

			<!-- 工单详情 挂件 begin -->



			<!-- 回复列表 begin -->
			

			<!-- <blockquote class="layui-elem-quote"
				style="font-weight: bold; font-size: 15px; margin: 10px;">
				<div>标题：{$data['title']}</div>
				<div>内容：{$data['content']}</div>
			</blockquote>

			<volist name="data['reply_list']" id="vo">
			<div class="layui-field-box"
				style="font-weight: 100; font-size: 15px; margin: 10px; padding: 20px; display: table">
				<div style="display: table-cell; font-weight: bold;">{$vo['createusername']}：</div>
				<div style="display: table-cell">{$vo['content']}</div>
			</div>
			</volist> -->


			<!-- 工单详情 挂件 end -->
			

		</form>
	</div>


</body>
</html>