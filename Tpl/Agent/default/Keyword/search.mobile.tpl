<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />
<!-- 引入 echarts begin -->
<!-- 引入 echarts end -->
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
		<a class="header-arrow__left" href="{:U('Agent/Home/home')}"><i class="iconfont">&#xe671;</i></a>
		<span class="header__center">关键词查询</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>

	<div class="page" >
		<div class="page__bd">
			<div class="weui-tab">
				<div class="weui-tab__bd">
					<div class="weui-tab">
						<div class="weui-navbar">
							<a class="weui-navbar__item weui-bar__item--on" href="{:U('Keyword/search')}">关键词查询</a>
							<a class="weui-navbar__item" href="{:U('Keyword/effect')}">关键词排名</a>
						</div>
						<div class="weui-tab__bd">
							<div class="weui-cells weui-cells_form" style="margin-top: 0">
								<form id="form1" class="form-horizontal" action="" class="layui-form layui-form-pane">
								<div class="weui-cell">
									<div class="weui-cell__bd">
										
										<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
										<input type="hidden" name="a" value="search" />
										<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
										<textarea class="weui-textarea" placeholder="支持多个关键词查询，每个关键词用回车隔开" rows="3" name="kws">{$kws}</textarea>
										<!-- <div class="weui-textarea-counter"><span>0</span>/200</div> -->
										
									</div>
								</div>
								<div class="weui-cell">
									<div class="weui-cell__bd">
										<input type="submit" class="weui-btn weui-btn_primary" value="查询关键词" >
									</div>
								</div>
								</form>
							</div>
							
							<div class="weui-panel weui-panel_access">
								<div class="weui-panel__hd">关键词清单</div>
								<div class="weui-panel__bd">
									<volist name="list" id="vo">
									<div class="weui-media-box weui-media-box_appmsg">
										
										<div class="weui-media-box__bd">
											<h4 class="weui-media-box__title">{$vo['keyword']}</h4>
											<p class="weui-media-box__desc mt5">{$vo['rate']} <span class="ml10">{$vo['optimization_cycle']}</span></p>
									
										
											<div class="weui-grids mt5">
										      <div class="weui-grid js_grid">
										        <div class="weui-grid__icon">
										          <img alt="" src="__PUBLIC__/img/baidu.png">
										        </div>
										        <p class="weui-grid__label">
										          {$vo['baidu']} 元/天
										        </p>
										      </div>
										      <div class="weui-grid js_grid">
										        <div class="weui-grid__icon">
										          <img alt="" src="__PUBLIC__/img/baidu_mobile.png">
										        </div>
										        <p class="weui-grid__label">
										           {$vo['baidu_mobile']} 元/天
										        </p>
										      </div>
										      <div class="weui-grid js_grid">
										        <div class="weui-grid__icon">
										          <img alt="" src="__PUBLIC__/img/360.png">
										        </div>
										        <p class="weui-grid__label">
										          {$vo['360']} 元/天
										        </p>
										      </div>
										      <div class="weui-grid js_grid">
										        <div class="weui-grid__icon">
										          <img alt="" src="__PUBLIC__/img/sougou.png">
										        </div>
										        <p class="weui-grid__label">
										           {$vo['sougou']} 元/天
										        </p>
										      </div>
										      <div class="weui-grid js_grid">
										        <div class="weui-grid__icon">
										          <img alt="" src="__PUBLIC__/img/shenma.png">
										        </div>
										        <p class="weui-grid__label">
										          {$vo['shenma']} 元/天
										        </p>
										      </div>
										    </div>
										</div>
									</div>
									</volist>
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
					</a>
					<a href="{:U('Site/effect')}" class="weui-tabbar__item">
						
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe633;</i>
						</div>
						<p class="weui-tabbar__label">站点监控</p>
						
					</a>
					<a href="{:U('Keyword/search')}" class="weui-tabbar__item weui-bar__item--on">
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe612;</i>
						</div>
						<p class="weui-tabbar__label">关键词管理</p>
					</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

