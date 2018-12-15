<!DOCTYPE HTML>
<html>
<head>
<include file="../Public/html/header" />
</head>
<style type="text/css">
body {
	padding: 10px 20px 20px 10px;
	background-color: #f7f7f7;
	overflow: visible;
	font-family: Verdana, Geneva, sans-serif
}

#main {
	position: relative;
	padding-right: 300px;
	overflow: hidden; +
	display: inline-block;
}

.mainLeft {
	width: 100%;
	float: left;
}

.mainRight {
	width: 300px;
	float: left;
	margin-right: -300px;
}
</style>
<body>
	<div id="main">

		<!-- 左侧开始 -->
		<div class="mainLeft">
			<div style="margin-right: 10px;">
				<!-- 欢迎信息 -->
				<div class="tips tips-large tips-success" style="margin-bottom: 10px;">
					<span class="x-icon x-icon-success"><i class="icon icon-ok icon-white"></i></span>
					<div class="tips-content">
						<h2>欢迎您: 系统管理员</h2>
						<h2>用户名: admin</h2>
						<p class="auxiliary-text">欢迎您进入本系统! 祝您使用愉快!</p>
					</div>
				</div>

				<!-- 最新通知 -->
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>最新通知
								<div class="pull-right">
									<a href="javascript:" id="nocate_" onclick="showPageNoticeUrl('notice','更多通知');" class="button button-small button-info"><i class="icon-th-list icon-white"></i>
										更多...</a>
								</div>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><i class="icon-bullhorn"></i> <a href="javascript:" onclick="showNotice(85,'23423');"> 23423 </a> <br /> <i class=""></i> 发布时间: 2014-05-15 16:31:24 <br /></td>
						</tr>
						<tr>
							<td><i class="icon-bullhorn"></i> <a href="javascript:" onclick="showNotice(84,'asdfasdf');"> asdfasdf </a> <br /> <i class=""></i> 发布时间: 2014-05-15
								16:30:28 <br /></td>
						</tr>
						<tr>
							<td><i class="icon-bullhorn"></i> <a href="javascript:" onclick="showNotice(83,'asdf');"> asdf </a> <br /> <i class=""></i> 发布时间: 2014-05-15 16:29:08 <br /></td>
						</tr>
						<tr>
							<td><i class="icon-bullhorn"></i> <a href="javascript:" onclick="showNotice(82,'本系统试运行');"> 本系统试运行 </a> <br /> <i class=""></i> 发布时间: 2014-04-29 19:05:19 <br /></td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
		
		<!-- 右侧开始 -->
		<div class="mainRight">

			<!-- 帮助文档 -->
			<table class="table table-bordered" style="margin-right: 10px;">
				<thead>
					<tr>
						<th colspan="2">帮助文档
							<div class="pull-right">
								<a href="javascript:" id="nocate_" onclick="showPageHelpUrl('help','帮助文档');" class="button button-small button-info"><i class="icon-th-list icon-white"></i>
									更多...</a>
							</div>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><i class="icon-exclamation-sign"></i> [ <a href="javascript:" id="nocate_90" onclick="showPageHelpCate(10,'后台使用帮助');">后台使用帮助</a> ] <a href="javascript:"
							id="no_90" onclick="showWinHelp(90,'这里是使用帮助');">这里是使用帮助 </a></td>
					</tr>
					<tr>
						<td><i class="icon-exclamation-sign"></i> [ <a href="javascript:" id="nocate_91" onclick="showPageHelpCate(20,'前台使用帮助');">前台使用帮助</a> ] <a href="javascript:"
							id="no_91" onclick="showWinHelp(91,'12');">12 </a></td>
				</tbody>
			</table>

			<!-- 版本信息 -->
			<table class="table table-bordered">
				<thead>
					<tr>
						<th colspan="2">关于本软件</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="width: 100px;">软件名称：</td>
						<td>管理中心</td>
					</tr>
					<tr>
						<td>版本号：</td>
						<td>1.0</td>
					</tr>
				</tbody>
			</table>

			<!-- 客服信息 -->
			<table class="table table-bordered">
				<thead>
					<tr>
						<th colspan="2">客服信息</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="width: 60px;">客服QQ：</td>
						<td><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=9411526&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:9411526:51" /></a></td>
					</tr>
					<tr>
						<td>支持电话：</td>
						<td>400-1234-123</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- 右侧结束 -->
		
	</div>
	
	<script type="text/javascript">
		//弹窗--弹出通知
		function showNotice(id, dialogTitle) {
			var Overlay = BUI.Overlay;
			var thisDialog = new Overlay.Dialog({
				title : "通知:" + dialogTitle,
				width : 600,
				height : 500,
				mask : true,
				loader : {
					url : '/Admin/Notices/notice_show/id/' + id
				},
				buttons : [ {
					text : '关闭',
					elCls : 'button button-primary',
					handler : function() {
						this.close();
					}
				} ]

			});

			thisDialog.show();

		}

		//查看帮助内容
		function showPageHelpCate(thisId, thisTitle) {
			if (top.topManager) {
				top.topManager.openPage({
					id : thisId,
					href : '/Admin/Help/help_cates_list/id/' + thisId,
					title : thisTitle

				});
			}
		}
		
		function showWinHelp(thisId, thisTitle) {
			if (top.topManager) {
				top.topManager.openPage({
					id : thisId,
					href : '/Admin/Help/help_show/id/' + thisId,
					title : thisTitle

				});
			}
		}
		
		function showPageHelpUrl(thisId, thisTitle) {
			if (top.topManager) {
				top.topManager.openPage({
					id : thisId,
					href : '/Admin/Help/help_list',
					title : thisTitle

				});
			}
		}
		
		function showPageNoticeUrl(thisId, thisTitle) {
			if (top.topManager) {
				top.topManager.openPage({
					id : thisId,
					href : '/Admin/Notices/notices_list',
					title : thisTitle

				});
			}
		}
	</script>

	<include file="../Public/html/footer" />
	
</body>
</html>