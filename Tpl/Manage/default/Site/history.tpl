<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "站点历史数据";</php>
<head>
<include file="../Public/header" />
</head>
<body>
	<div class="layui-tab-content">
	<!-- 关键词历史挂件 begin -->
   	{:W('SiteHistory', array( 'list' => $list ))}	
	<!-- 关键词历史挂件 end -->	 
</div>
</body>
</html>