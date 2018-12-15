<!DOCTYPE html>
<html lang="zh-CN">
<php>//$page_title = "站点历史数据";</php>
<head>
<include file="../Public/header" />
</head>
<body>
	<!-- PAGE -->
	<div class="layui-tab-content">
	
		<!-- 站点效果挂件 begin -->
      	{:W('SiteHistory', array( 'list' => $list ))}	
		<!-- 站点效果挂件 end -->	 
		
	</div>
</body>
</html>