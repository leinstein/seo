<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "添加用户";</php>
<head>
<include file="../Public/header" />
<!--响应式css-->
<link rel="stylesheet" type="text/css" href="../Public/css/responsive.css">
<tagLib name="html" />
</head>
<body>
	<div id="main-content">
		<div class="container">
			<div class="row">
				<div id="content" class="col-lg-12">

					<!-- <div class="row">
						<div class="col-sm-12">
							<div class="page-header">
								<div class="clearfix">
									<h3 class="content-title pull-left">用户管理 - 新增子用户</h3>
								</div>
								<div class="description"></div>
							</div>
						</div>
					</div> -->

					<section id="page" class="pt10">
						<div id="main-content">
							<div class="container">
								<form name="form1" action="{:U('insert')}" method="post" onsubmit="return validate()">
				
									<include file="tpl/sub_user"/>
									
									<div class="modal-footer">
										<button type="submit" class=" form-control btn btn-primary">添加用户信息</button>
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