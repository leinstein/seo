<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "关键词日报表";</php>
<head>
<include file="../Public/header" />
</head>
<body>
<div class="layui-tab-content">
	<!-- 关键词历史挂件 begin -->
   	{:W('KeywordHistory', array( 'list' => $list ,'skin'  => 'manage' , 'returnUrl' => $_GET['returnUrl']))}	
	<!-- 关键词历史挂件 end -->	 
</div>
	
</body>
</html>