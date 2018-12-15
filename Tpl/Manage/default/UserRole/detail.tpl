<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>帐号信息</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<!--系统css-->
<link rel="stylesheet" type="text/css" href="../Public/css/cloud-admin.css">
<!--主题css-->
<link rel="stylesheet" type="text/css" href="../Public/css/themes/default.css" id="skin-switcher">
<!--响应式css-->
<link rel="stylesheet" type="text/css" href="../Public/css/responsive.css">
<!--图标字体-->

<!-- FONTS -->
<!--字体-->
</head>
<body>

	<!-- PAGE -->
	<section id="page">
		<div id="main-content">
			<div class="container">
				<div class="row">
					<div id="content" class="col-lg-12">
						<!-- PAGE HEADER-->
						<div class="row">
							<div class="col-sm-12">
								<div class="page-header">
									<div class="clearfix">
										<h3 class="content-title pull-left">帐号管理</h3>
									</div>
									<div class="description">show user info</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<div class="row">
							<div class="col-sm-12">
											
									<div class="form-group">
										<label>登陆账号</label>
										<span>{$LoginUserName}</span>
									</div>
									<div class="form-group">
										<label>邮箱地址</label>
										<span>{$LoginUserInfo['email']}</span>
									</div>
									<div class="form-group">
										<label>公司名称</label>
										<span>{$LoginUserInfo['epname']}</span>
									</div>
									<div class="form-group">
										<label>联系人</label>
										<span>{$LoginUserInfo['contact']}</span>
									</div>
									<div class="form-group">
										<label>联系QQ</label>
										<span>{$LoginUserInfo['QQnumber']}</span>
									</div>

									<div class="form-group">
										<label>固定电话</label>
										<span>{$LoginUserInfo['telephone']}</span>
									</div>

									<div class="form-group">
										<label>手机号码</label>
										<span>{$LoginUserInfo['mobileno']}</span>
									</div>
									<button type="submit" class="btn btn-primary mt20 mb20">修改账户资料</button>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<!-- JQUERY -->
	<script src="../Public/js/jquery/jquery-2.0.3.min.js"></script>


</body>
</html>