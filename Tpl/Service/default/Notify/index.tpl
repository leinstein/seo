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
            	<fieldset class="layui-elem-field layui-field-title sprite col-title">
				  <legend>系统公告</legend>
				</fieldset>
 
            	<ul class="list-group">
	           		<volist name="Newss['data']" id="vo">
	           		<li class="list-group-item">
	           			<span class="t">{$vo['No']}. 
	           				<a href="{:U('News/detail')}/id/{$vo['id']}/open_type/blank" target="_blank" title="{$vo['newstitle']}">{$vo['newstitle']}</a>
	           			</span>
	           			<span class="date">{$vo['pubtime']|format_date}</span>
	           		</li>
	           		</volist>
	            </ul>
				<div class="pagebar">
					{$list['html']}
				</div>
			</div>
		</div>
	</div>
</body>
</html>