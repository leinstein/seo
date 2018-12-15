<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<!-- 专用风格 -->
<link href="../Public/css/special/epspace.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/jsoneditor/jsoneditor.css"/>  
<script src="__PUBLIC__/js/jsoneditor/jquery.min.js"></script>  
<script src="__PUBLIC__/js/jsoneditor/jquery.jsoneditor.js"></script>  
<style>
/*自定义风格*/
.ui-box-dialog{
	border:none;
}
.ui-box-dialog .ui-box-container{
	border-bottom:none;
}
</style>
</head>
<script type="text/javascript">
function initPage(){
	  $("textarea").each(function(){
		  $(this).attr("disabled","disabled");
	  });
	  $("button").remove();
}
</script>
<body onload="initPage();">
	
	<div class="wrapper">
		
		<!-- 全宽布局 begin -->
		<div class="ui-grid-row">
			<!-- 全宽布局 begin -->
			<div class="ui-grid-24">
				
				<div class="ui-box ui-box-dialog">
				    <div class="ui-box-head">
				        <h3 class="ui-box-head-title">{$title}</h3>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        <div id="editor" class="json-editor"></div>  
						<pre id="json"></pre>  
				        </div>
				    </div>
				</div>
				
			</div>
			<!-- 全宽布局 end -->
		</div>
		<!-- 全宽布局 end -->
	</div>
</body>
</html>
<script>  
      var myjson = {$data};
	  var opt = { change: function() { $('#json').html(JSON.stringify(json)); } };
	  opt.propertyElement = "<textarea>"; 
	  opt.valueElement = "<textarea>"; 
	  $('#editor').jsonEditor(myjson, opt);
</script> 