<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "帐号信息";</php>
<head>
<include file="../Public/header" />

<!-- 引入文章新聞類樣式文件 css-->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/news.css">

</head>
<body class="main-body">

	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner"/>
	<!-- 页面顶部 logo & 菜单 end  -->
	
	<div class="main-wrapper">
		<!-- 页面左侧菜单 begin  -->
		<include file="../Public/left_home"/>
		<!-- 页面左侧菜单 end  -->
		
		<div class="right-wrapper fr">
			<div class="main-content" style="margin-bottom: 20px;">
				<!-- 面包屑导航 begin -->
	        	<div class="nav-mbx">您当前的位置：<a href="{:U('Index/index')}">优站宝</a> &gt; <a href="">文章列表</a></div>
	        	<!-- 面包屑导航 end -->
	        	
	        	<div class="main-table-content">
					{:W('NewsList', array( 'list' => $list ))}		   
				</div>
				
				<!-- <div class="art-list big" style="min-height: 560px; border: none;">
	            	<div class="sprite col-title">文章列表</div>
	            	<ul>
	            		<volist name="Newss['data']" id="vo">
	            		<li><span class="t">{$vo['No']}. <a href="{:U('News/detail')}/id/{$vo['id']}" target="_blank" title="{$vo['newstitle']}">{$vo['newstitle']}</a></span>
	            			 <span class="date">{$vo['pubtime']|format_date}</span>
	            		</li>
	            		</volist>
		            </ul>
		            分页 begin		
					<div class="layui-box layui-laypage fr">
						{$Newss['html']}
					</div>	
					分页 end	
					
	            </div> -->
			</div>
		</div>
	</div>


</body>
</html>