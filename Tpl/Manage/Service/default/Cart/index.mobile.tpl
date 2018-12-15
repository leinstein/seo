<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />


<script type="text/javascript">
	$(function() {

	});
	
</script>
<style>
.weui-grid {
  padding: 5px 
}
.weui-grid__icon {
    width: 100px;
    height: 50px;
    margin: 0 auto;
}
.weui-grid__icon img {
    display: block;
    width: 100%;
}
.weui-grid__label{
	font-size: 1.3em;
	font-weight: bold;
	color: #999;
}
</style>

</head>
<body ontouchstart>

	<div class="header">
		<a class="header-arrow__left" href="{:U('Service/Home/home')}"><i class="iconfont">&#xe671;</i></a>
		<span class="header__center">关键词清单</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>

	<div class="page" >
		<div class="page__bd">
			<div class="weui-tab">
				<div class="weui-tab__bd">
					<div class="weui-tab">
						<div class="weui-navbar">
							<a class="weui-navbar__item" href="{:U('Keyword/search')}">关键词查询</a>
							<a class="weui-navbar__item weui-bar__item--on" href="{:U('Cart/index')}">关键词清单</a>
							<a class="weui-navbar__item" href="{:U('Site/effect')}">站点监控</a>
							<a class="weui-navbar__item" href="{:U('Keyword/effect')}">关键词排名</a>
						</div>
						<div class="weui-tab__bd">
							
						    <div class="weui-panel weui-panel_access">
								<div class="weui-panel__hd">关键词清单</div>
								<div class="weui-panel__bd">
								
								<!-- <div class="weui-cells weui-cells_checkbox">
							        <label class="weui-cell weui-check__label" for="s11">
							          <div class="weui-cell__hd">
							            <input type="checkbox" class="weui-check" name="checkbox1" id="s11" checked="checked">
							            <i class="weui-icon-checked"></i>
							          </div>
							          <div class="weui-cell__bd">
							            <p>standard is dealt for u.</p>
							          </div>
							        </label>
							      </div> -->
								
									<notempty name="list">
										<volist name="list" id="vo">
										<a href="__URL__/detail/id/{$vo['id']}" class="weui-media-box weui-media-box_appmsg">
											<!-- <div class="weui-media-box__hd" >
												<img class="weui-media-box__thumb" src="../Public/img/community/leader-log-index.png" alt="">
											</div> -->
											<div class="weui-media-box__bd">
												<h4 class="weui-media-box__title">{$vo['keyword']}</h4>
												<p class="weui-media-box__desc mt5"><span>渠道：{$vo['searchengine_ZH']}</span></p>
												<p class="weui-media-box__desc mt5">
													<span>单价：{$vo['price']|default=format_money} {$vo['unit']}/{$vo['unit2']}</span>
												</p>
												
											</div>
										</a>
										</volist>
										<else/>
											<h4 class="weui-media-box__title pt10 pl10 pb10">暂无相关数据</h4>
										</notempty>
								
						           
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="weui-tabbar">
					<a href="{:U('Index/index')}" class="weui-tabbar__item">
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe60a;</i>
						</div>
						<p class="weui-tabbar__label">产品概况</p>
					</a> <a href="{:U('Site/index')}"
						class="weui-tabbar__item">

						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe633;</i>
						</div>
						<p class="weui-tabbar__label">我的站点</p>

					</a> <a href="{:U('Keyword/search')}" class="weui-tabbar__item weui-bar__item--on">
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe612;</i>
						</div>
						<p class="weui-tabbar__label">优化中心</p>
					</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

