<!DOCTYPE html>
<html lang="zh-CN">
<php>//$page_title = "帐号信息";</php>
<head>
<include file="../Public/header" />

<!-- 引入文章新聞類樣式文件 css-->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/news.css">

</head>
<body style="background: #ebf1f3 !important;padding-top:60px;">

	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner"/>
	<!-- 页面顶部 logo & 菜单 end  -->
	
 	<div class="ui-content" id="ui-content" >	 
		<div class="ui-panel">	
			<div class="art-list big">
            	<!-- <div class="sprite col-title">常见问题</div> -->
            	<fieldset class="layui-elem-field layui-field-title sprite col-title">
				  <legend>常见问题</legend>
				</fieldset>
 
            	<volist name="list" id="vo">
            	<blockquote class="layui-elem-quote" style="font-weight: bold;font-size: 15px;margin: 10px;">
            		Q：{$vo['questtitle']}
            	</blockquote>
            	
            	<div class="layui-field-box" style="font-weight: 100;font-size: 15px;margin: 10px;padding: 20px;display:table">
				   <div style="display:table-cell;width: 10px;font-weight: bold;">A：</div>
				   <div style="display:table-cell">{$vo['questcontent']}</div>
			  	</div>
			  	</volist>
				
            </div>
		</div>
	</div>

</body>
</html>