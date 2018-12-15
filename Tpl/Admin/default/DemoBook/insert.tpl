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
	<form method='post' id="J_Form" name="J_Form" action="__URL__/insert">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th colspan="2">新增图书信息 <span class="hint">(带星号的是必填项)</span></th>
				</tr>
			</thead>
			<tbody>
			    <tr>
					<td>图书编号：<span class="c_red">*</span></td>
					<td><input type="text" style="width: 470px;" name="bookno" id="bookno" value="" class="input" data-rules="{required:true,maxlength:32}" /> </td>
				</tr>
				<tr>
					<td>图书名称：<span class="c_red">*</span></td>
					<td><input type="text" style="width: 470px;" name="bookname" id="bookname" value="" class="input" data-rules="{required:true,maxlength:64}" /></td>
				</tr>
				<tr>
					<td>图书分类：<span class="c_red">*</span></td>
					<td>
							<select name="bookcate" id="bookcate" style="width: 250px" data-rules="{required:true}">
								<option value="10">通知公告</option>
								<option value="1010">&nbsp;&nbsp;本站通知</option>
								<option value="20">新闻资讯</option>
								<option value="2010">&nbsp;&nbsp;行业新闻</option>
								<option value="2020">&nbsp;&nbsp;本站新闻</option>
								<option value="30">其它新闻</option>
							</select>
					</td>
				</tr>
				<tr>
					<td>图书作者：</td>
					<td><input type="text" class="input" id="bookauthor" name="bookauthor" value="" style="width: 470px;" data-rules="{maxlength:128}" /></td>
				</tr>
				<tr>
					<td>图书标签：</td>
					<td><input type="text" class="input" id="booktags" name="booktags" value="" style="width: 470px;" data-rules="{maxlength:256}" /></td>
				</tr>
				<tr>
					<td>上传图片：</td>
					<td>
							<input type="text" class="input" id="imgInput" name="picurl" value="" readonly="readonly" style="width: 718px;" /> 
							<input type="button" id="uploadPic" value="上传图片" />
					</td>
				</tr>
				<tr>
					<td></td>
					<td><img id="imgview" src="../Public/img/no.jpg" style="border: 1px #999999 solid; height: 160px;" /></td>
				</tr>
				<tr>
					<td>图书简介：</td>
					<td><textarea id="booksummary" name="booksummary" style="width: 470px; height: 60px;" data-rules="{maxlength:256}"></textarea></td>
				</tr>
				<tr>
					<td>图书详细介绍：</td>
					<td><textarea id="KindEditor" name="bookintro" style="width: 800px; height: 400px; visibility: hidden;"></textarea></td>
				</tr>
				<tr>
					<td>定价：<span class="c_red">*</span></td>
					<td><input type="text" class="input" id="bookprice" name="bookprice" value="" style="width: 470px;" data-rules="{required:true,number:true}" /></td>
				</tr>
				<tr>
					<td>实际售价：<span class="c_red">*</span></td>
					<td><input type="text" class="input" id="sellprice" name="sellprice" value="" style="width: 470px;" data-rules="{required:true,number:true}" /></td>
				</tr>
				<tr>
					<td>出版日期：</td>
					<td><input type="text" name="pubdate" id="pubdate" value="2014-06-26" class="input-small calendar" style="width: 90px;" /></td>
				</tr>
				<tr>
					<td>出版社：</td>
					<td><input type="text" class="input" id="bookconcern" name="bookconcern" value="" style="width: 470px;" data-rules="{maxlength:64}" /></td>
				</tr>
				<tr>
					<td>印刷日期：</td>
					<td><input type="text" name="printtime" id="printtime" value="2014-06-26" class="input-small calendar" style="width: 90px;" /></td>
				</tr>
				<tr>
					<td>字数：</td>
					<td><input type="text" class="input" id="wordcount" name="wordcount" value="" style="width: 470px;" data-rules="{number:true}" /></td>
				</tr>
				<tr>
					<td>页数：</td>
					<td><input type="text" class="input" id="pagecount" name="pagecount" value="" style="width: 470px;" data-rules="{number:true}" /></td>
				</tr>
				<tr>
					<td>ISBN：</td>
					<td><input type="text" class="input" id="isbn" name="isbn" value="" style="width: 470px;" data-rules="{maxlength:32}" /></td>
				</tr>
				<tr>
					<td>点击次数：</td>
					<td><input type="text" class="input" id="viewcount" name="viewcount" value="" style="width: 470px;" data-rules="{number:true}" /></td>
				</tr>
			</tbody>
		</table>
		<ul class="toolbar">
			<li>
				<button type="submit" name="submit" value="save" class="button button-primary">
					<i class="icon-upload icon-white"></i> 提交保存
				</button>
			</li>
			<li><a href="__URL__" class="button"> 返回上页 </a></li>
		</ul>
	</form>
	<script>
		var editor;
		KindEditor.ready(function(K) {
			editor = K.create('textarea[id="KindEditor"]', {
				allowFileManager : true
			});
		});
	</script>
	<script>
		var hostname = '';
		//加上域名
		hostname = window.location.hostname;
		hostname = 'http://' + hostname;

		//上传图片
		KindEditor.ready(function(K) {
			var uploadPic = K.uploadbutton({
				button : K('#uploadPic')[0],
				fieldName : 'imgFile',

				url : '../Public/js/editor/php/upload_json.php?dir=image',
				afterUpload : function(data) {
					if (data.error === 0) {
						var url = K.formatUrl(data.url, 'absolute');
						//赋值给控件
						K('#imgInput').val(hostname + url);
						K("#imgview").attr("src", url);

					} else {
						alert(data.message);
					}
				},
				afterError : function(str) {
					alert('错误信息: ' + str);
				}
			});
			uploadPic.fileBox.change(function(e) {
				uploadPic.submit();
			});
		});
	</script>
	<script type="text/javascript">
		BUI.use('bui/form', function(Form) {

			new Form.Form({
				srcNode : '#J_Form'
			}).render();

		});
	</script>
	
	<include file="../Public/html/footer" />

</body>
</html>