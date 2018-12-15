<html lang="en"><head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>添加站点</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<!--系统css-->
	<link rel="stylesheet" type="text/css" href="../Public/css/cloud-admin.css">
	<!--主题css-->
	<link rel="stylesheet" type="text/css" href="../Public/css/themes/default.css" id="skin-switcher">
	<!--响应式css-->
	<link rel="stylesheet" type="text/css" href="../Public/css/responsive.css">
	<!--图标字体-->
	<link href="../Public/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- DATE RANGE PICKER -->
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
									<h3 class="content-title pull-left">站点管理</h3>
								</div>
								<div class="description">qisobao search system</div>
							</div>
						</div>
					</div>




					<section id="page">
	<div id="main-content">
		<div class="container">
			<form name="form1" action="{:U('insert')}" method="post" onsubmit="return validate()">
				<input type="hidden" name="action" value="add">
				<div class="form-group">
					<label>站点名称</label>
					<input type="text" class="form-control" name="sitename" id="wzname" value="" required="">
				</div>
				<div class="form-group">
					<label>网址</label>
					<input type="text" class="form-control" name="website" id="url" value="" required="" placeholder="请按照格式填写，如：www.baidu.com">
					
				</div>
				<div class="form-group">
					<label>ftp</label>
					<textarea name="ftp" id="ftp" class="form-control" placeholder="请准确FTP信息,以便优化师调整"></textarea>
				</div>
				<div class="form-group">
					<label>管理后台</label>
					<textarea name="glht" class="form-control" placeholder="请填写后台管理账号,以便优化师调整"></textarea>
				</div>

				<div class="modal-footer"  style="border: none">
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

<!--/PAGE -->
<script src="../Public/js/jquery/jquery-2.0.3.min.js"></script>

</body></html>