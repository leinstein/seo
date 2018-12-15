<html>
<head>
<meta charset="utf-8">
<title>meTools</title>
<meta name="viewport"
	content="width=device-width,initial-scale=1,maximum-scale=1">
<link rel="icon" type="image/x-icon" href="./static/favicon .ico">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/layui-master/src/css/layui.css" >

</head>
<body>
	<div id="app" class="layui-layout layui-layout-admin">
		<div class="layui-header">
			
		</div>
		<div id="leftMenu" class="layui-side layui-bg-black">
			<div class="layui-side-scroll">
				<ul class="layui-nav ymheader layui-nav-tree" allopen="true">
					<li class="layui-nav-item layui-current layui-nav-itemed"><a
						href="#/home" class="router-link-active">
						<i style="display: none;"></i> 快速导航 <span class="layui-nav-more"
							style="display: none;"></span></a>
						<dl class="layui-nav-child layui-anim layui-anim-upbit"
							style="display: none;"></dl></li>
					<li class="layui-nav-item"><a href="#/fanyi" class=""><i
							style="display: none;"></i> 在线翻译 <span class="layui-nav-more"
							style="display: none;"></span></a>
						<dl class="layui-nav-child layui-anim layui-anim-upbit"
							style="display: none;"></dl></li>
					<li class="layui-nav-item"><a href="#/qrcode" class=""><i
							style="display: none;"></i> 二维码生成 <span class="layui-nav-more"
							style="display: none;"></span></a>
						<dl class="layui-nav-child layui-anim layui-anim-upbit"
							style="display: none;"></dl></li>
					<li class="layui-nav-item"><a href="#/encrypt" class=""><i
							style="display: none;"></i> 加密/解密 <span class="layui-nav-more"
							style="display: none;"></span></a>
						<dl class="layui-nav-child layui-anim layui-anim-upbit"
							style="display: none;"></dl></li>
					<li class="layui-nav-item"><a href="#/encode" class=""><i
							style="display: none;"></i> 编码/解码 <span class="layui-nav-more"
							style="display: none;"></span></a>
						<dl class="layui-nav-child layui-anim layui-anim-upbit"
							style="display: none;"></dl></li>
					<li class="layui-nav-item"><a href="#/tobase64" class=""><i
							style="display: none;"></i> 图片转base64 <span
							class="layui-nav-more" style="display: none;"></span></a>
						<dl class="layui-nav-child layui-anim layui-anim-upbit"
							style="display: none;"></dl></li>
					<li class="layui-nav-item"><a href="#/strsplit" class=""><i
							style="display: none;"></i> 字符串替换 <span class="layui-nav-more"
							style="display: none;"></span></a>
						<dl class="layui-nav-child layui-anim layui-anim-upbit"
							style="display: none;"></dl></li>
					<li class="layui-nav-item"><a href="#/rmbconvert" class=""><i
							style="display: none;"></i> 人民币转换 <span class="layui-nav-more"
							style="display: none;"></span></a>
						<dl class="layui-nav-child layui-anim layui-anim-upbit"
							style="display: none;"></dl></li>
					<li class="layui-nav-item"><a href="#/mdconvert" class=""><i
							style="display: none;"></i> Markdown转换 <span
							class="layui-nav-more" style="display: none;"></span></a>
						<dl class="layui-nav-child layui-anim layui-anim-upbit"
							style="display: none;"></dl></li>
					<li class="layui-nav-item"><a href="javascript:void(0);"
						target="_blank"><i style="display: none;"></i> 友情链接 <span
							class="layui-nav-more"></span></a>
						<dl class="layui-nav-child layui-anim layui-anim-upbit"
							style="display: none;">
							<dd class="level2-menu">
								<a href="http://www.yimo.link" target="_blank">易墨‘s_Blog</a>
							</dd>
							<dd class="level2-menu">
								<a href="http://tool.oschina.net/" target="_blank">都没有？那就戳这里</a>
							</dd>
						</dl></li>
				</ul>
			</div>
		</div>
		<div id="rightContent" class="layui-body layui-tab-content">
			<div class="layui-tab-brief" style="width: 100%; height: 100%;">
				<ul class="layui-tab-title site-demo-title"
					style="margin-bottom: 10px;">
					<li class="">欢迎页</li>
					<li class="">颜色随机</li>
					<li tabcode="code" class="layui-this">查看代码</li>
				</ul>
				<div style="width: 100%; height: 100%;">
					<div class="welcome layui-circle"
						style="background-color: rgba(81, 39, 58, 0.8);">
						<a href="#/home" class="router-link-active">快速导航</a>
					</div>
					<div class="welcome layui-circle"
						style="background-color: rgba(221, 161, 226, 0.8);">
						<a href="#/fanyi" class="">在线翻译</a>
					</div>
					<div class="welcome layui-circle"
						style="background-color: rgba(29, 192, 245, 0.8);">
						<a href="#/qrcode" class="">二维码生成</a>
					</div>
					<div class="welcome layui-circle"
						style="background-color: rgba(180, 203, 153, 0.8);">
						<a href="#/encrypt" class="">加密/解密</a>
					</div>
					<div class="welcome layui-circle"
						style="background-color: rgba(103, 76, 196, 0.8);">
						<a href="#/encode" class="">编码/解码</a>
					</div>
					<div class="welcome layui-circle"
						style="background-color: rgba(78, 100, 50, 0.8);">
						<a href="#/tobase64" class="">图片转base64</a>
					</div>
					<div class="welcome layui-circle"
						style="background-color: rgba(6, 201, 162, 0.8);">
						<a href="#/strsplit" class="">字符串替换</a>
					</div>
					<div class="welcome layui-circle"
						style="background-color: rgba(158, 98, 38, 0.8);">
						<a href="#/rmbconvert" class="">人民币转换</a>
					</div>
					<div class="welcome layui-circle"
						style="background-color: rgba(80, 17, 142, 0.8);">
						<a href="#/mdconvert" class="">Markdown转换</a>
					</div>
					<div class="welcome layui-circle"
						style="background-color: rgba(33, 186, 60, 0.8);">
						<a href="http://www.yimo.link" target="_blank">易墨‘s_Blog</a>
					</div>
					<div class="welcome layui-circle"
						style="background-color: rgba(145, 99, 17, 0.8);">
						<a href="http://tool.oschina.net/" target="_blank">都没有？那就戳这里</a>
					</div>
				</div>
			</div>
		</div>
		<div id="contentFooter" class="layui-footer footer footer-doc">
			<p>
				<a href="http://www.yimo.link" target="_blank">易墨‘s_Blog</a><a
					href="https://coding.net/u/yimocoding/p/metools/git/blob/master/不花一分钱就能拥有自己的工具站点.MD"
					target="_blank">分分钟拥有自己的站点吧</a> <a>少年需要留个言么？</a>
			</p>
		</div>
	</div>
	
</body>
</html>