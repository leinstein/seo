<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "添加站点";</php>
<head>
<include file="../Public/header" />
<!--响应式css-->
<link rel="stylesheet" type="text/css" href="../Public/css/responsive.css">

</head>
<body>
	<div id="main-content">
		<div class="container">
			<div class="row">
				<div id="content" class="col-lg-12">

					<div class="row">
						<div class="col-sm-12">
							<div class="page-header">
								<div class="clearfix">
									<h3 class="content-title pull-left">站点管理 - 新增站点</h3>
								</div>
								<div class="description"></div>
							</div>
						</div>
					</div>

					<section id="page">
						<div id="main-content">
							<div class="container">
								<form name="form1" action="{:U('insert')}" method="post"
									onsubmit="return validate()">
									<input type="hidden" name="action" value="add">
									<div class="form-group">
										<label>站点名称</label> <input type="text" class="form-control" name="sitename" id="wzname" value="" required="">
									</div>
									<div class="form-group">
										<label>网址</label>
										<input type="text" class="form-control" name="website" id="url" value="" required="" placeholder="请按照格式填写，如：www.baidu.com">

									</div>
									<div class="form-group">
										<label>ftp</label>
										<textarea name="ftp" id="ftp" class="form-control" rows="4"  placeholder="请准确FTP信息,以便优化师调整"></textarea>
									</div>
									<div class="form-group">
										<label>管理后台</label>
										<textarea name="managebackground" class="form-control" rows="4"  placeholder="请填写后台管理账号,以便优化师调整"></textarea>
									</div>

									<div class="modal-footer">
										<button type="submit" class=" form-control btn btn-primary">添加站点信息</button>
									</div>

								</form>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
	<!-- PAGE -->


</body>
</html>