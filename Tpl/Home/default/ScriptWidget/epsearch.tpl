<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>科技信息枢纽  |  企业数据中心</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="dejax">
<link href="{$Think.const.DCGOV_HOST}../Public/css/aliceui/aliceui-local.css" rel="stylesheet">
<link href="{$Think.const.DCGOV_HOST}../Public/css/01-reset-alice.css" rel="stylesheet">
<link href="{$Think.const.DCGOV_HOST}../Public/css/02-short.css" rel="stylesheet">
<link href="{$Think.const.DCGOV_HOST}../Public/css/03-style.css" rel="stylesheet">
<style>
form{
	margin:0;
	padding:0;
	display:block;
}
.search-box{
	width:595px;
	height:120px;
	border:0;
	zoom:1;
	font-size:12px;
	color:#595959;
	margin:0;
	padding:0;
	padding-top:1px;
}
.search{	
	height:30px;
	margin-top:15px;
	margin-bottom:10px;
	padding-left:20px;
}
.searchtext{
	font-size:13px;
	font-weight:bold;
	height:27px;
	line-height:27px;
}
.inputbar{
	width:350px;
	height:22px;
	border:1px solid #c1c1c1;
	font-size:12px;
	color:gray;
	padding:2px 3px;
	background:url({$Think.const.DCGOV_HOST}../Public/img/epspace/inputbox1.png) no-repeat -1px -1px ;
}
.inputimg{
	width:30px;
	height:27px;
	background:url({$Think.const.DCGOV_HOST}../Public/img/epspace/search.png) no-repeat center center rgb(51,102,255);
	cursor:pointer;
}
.comment{
	width:550px;
	height:30px;
	font-size:13px;
	color:gray;
	margin-left:20px;
	text-align:left;
}
.fl{
	float: left;
}
</style>
<script>
function inputbar_click(){
	document.getElementById("inputbar").style.backgroundImage="url({$Think.const.DCGOV_HOST}../Public/img/epspace/inputbox2.png)";
}
function inputbar_change(){
	var val = document.getElementById("inputbar").value;
	if( val == "" )
		document.getElementById("inputbar").style.backgroundImage="url({$Think.const.DCGOV_HOST}../Public/img/epspace/inputbox1.png)";
}
function form_submit(){
	document.getElementById("epsearch").submit();
}
</script>
</head>
<body>
<div class="search-box">
	<div class="search">
		<form class="myform" name="epsearch" id="epsearch" method="get" action="{$Think.const.DCGOV_HOST}__URL__" target="_blank">
			<input type="hidden" name="m" value="EpSpace"/>
			<input type="hidden" name="a" value="index"/>
			<label class="searchtext fl">企业搜索：</label>
			<input type="text" class="inputbar fl" id="inputbar" name="t1" value="" onchange="inputbar_change()" onclick="inputbar_click()"/>
			<div class="inputimg fl" onclick="form_submit()">&nbsp;</div>
		</form>
	</div> 
	<div class="comment">
		<span>{$Think.config.epsearchComment}</span>
	</div>
</div>
</body>
</html>