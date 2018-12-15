<!DOCTYPE HTML>
<html>
<head>
<include file="../Public/html/header" />
<!-- 自定义样式 -->
<link href='../Public/css/style.css' rel='stylesheet'>
<style type="text/css">

</style>
</head>
<body>
	<div class="tips tips-large tips-success">
		<span class="x-icon x-icon-success"><i class="icon icon-ok icon-white"></i></span>
		<div class="tips-content">
			<h2>图书管理</h2>
		</div>
	</div>
	<div style="height: 10px;"></div>
	<form method="post" id="S_Form" name="S_Form" action="/Admin/WebArticles/articles_list">
		<div class="tips tips-large tips-warning">
			<div class="tips-content">
				栏目：<select name="widgetArticleCate" id="widgetArticleCate" style="width: 200px"><option SELECTED value="0">全部分类</option>
					<option value="10">&nbsp;&nbsp;通知公告</option>
					<option value="1010">&nbsp;&nbsp;&nbsp;&nbsp;本站通知</option>
					<option value="20">&nbsp;&nbsp;新闻资讯</option>
					<option value="2010">&nbsp;&nbsp;&nbsp;&nbsp;行业新闻</option>
					<option value="2020">&nbsp;&nbsp;&nbsp;&nbsp;本站新闻</option>
					<option value="30">&nbsp;&nbsp;其它新闻</option></select> 添加时间： <input type="text" name="start_time" id="start_time" value="" class="input-small calendar" style="width: 80px;" />
				- <input type="text" name="end_time" id="end_time" value="" class="input-small calendar" style="width: 80px;" /> <select name="widgetArticleType"
					id="widgetArticleType" style="width: 100px"><option value="" SELECTED>全部</option>
					<option value="1">头条</option>
					<option value="2">幻灯</option>
					<option value="3">推荐</option></select> 标题： <input type="text" class="input" id="keywords" name="keywords" style="width: 100px;" value="" placeholder="请输入关键字...">
				<button type="submit" name="submit" value="search" class="button button-small button-success">搜索</button>
			</div>
		</div>
		<div style="height: 10px;"></div>
	</form>
	<form method="post" id="J_Form" name="J_Form" action="/Admin/WebArticles/articles_list_submit" onsubmit="return confirmSubmit();">
		<ul class="toolbar">
			<li>
				<a href="__URL__/insertPage" class="button button-primary"> 增加 </a>
				<button type="submit" name="submit" value="delete" class="button button-danger">删除</button>
			</li>
		</ul>
		<table class="table table-bordered">
			<thead>
				<tr>
					<td style="width: 40px; text-align: center;"><input type="checkbox" id="selAll" onclick="SelectAll();" /></td>
					<td style="width: 100px; text-align: left;">图书编号</td>
					<td>图书名称</td>
					<td style="width: 80px; text-align: center;">定价</td>
					<td style="width: 80px; text-align: center;">实际售价</td>
					<td style="width: 50px; text-align: center;">点击次数</td>
					<td style="width: 120px; text-align: left;">添加时间</td>
					<td style="width: 80px; text-align: center;">添加用户</td>
					<td style="width: 60px; text-align: center;">管理操作</td>
				</tr>
			</thead>
			<tbody>
				<empty name="Books['data']">
				<tr>
					<td style="text-align: center;" colspan="99">暂无数据</td>
				</tr>
				<else/>
				<volist name="Books['data']" id="vo">
				<tr>
					<td style="text-align: center;"><input name="chk[]" type="checkbox" value="{$vo['id']}" /></td>
					<td>{$vo['bookno']}</td>
					<td>{$vo['bookname']}</td>
					<td style="text-align: right;">{$vo['bookprice']}</td>
					<td style="text-align: right;">{$vo['sellprice']}</td>
					<td style="text-align: center;">{$vo['viewcount']}</td>
					<td style="text-align: center;">{$vo['regtime']}</td>
					<td style="text-align: center;">{$vo['reguser']}</td>
					<td><a href="/Admin/WebArticles/articles_edit/id/213">[编辑]</a></td>
				</tr>
				</volist>
				</empty>
			</tbody>
		</table>
		<div class="pageAdmin" style="float: right; vertical-align: middle;">
			{$Books['html']}
		</div>
		<div class="clear"></div>
	</form>
	<!-- 全选 -->
	<script>
	var selAll = document.getElementById("selAll");
	function SelectAll(){
		var obj = document.getElementsByName("chk[]");
		if(document.getElementById("selAll").checked == false){
			for(var i=0; i<obj.length; i++){
			obj[i].checked=false;
			}
		}else {
			for(var i=0; i<obj.length; i++){
			obj[i].checked=true;
			}
		}
	}
	</script>
	<!-- 是否提交表单 -->
	<script>
	function confirmSubmit(){
		if (confirm("您确认本操作吗？")) {
			return true;
		} else {
			return false;
		}
	};
	</script>
	<script type="text/javascript">
	BUI.use('bui/form',function(Form){
	
		new Form.Form({
			srcNode : '#J_Form'
		}).render();
		
		new Form.Form({
			srcNode : '#S_Form'
		}).render();
	
	});

	</script>

	<include file="../Public/html/footer" />
</body>
</html>