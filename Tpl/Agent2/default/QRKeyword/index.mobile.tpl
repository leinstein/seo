<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />

<!-- 专用js begin -->
<script src="__PUBLIC__/js/loadmore-mobile.js"></script>
<!-- 专用js begin -->

<script type="text/javascript">
	$(function() {

	});
	
	//总的页码
	var pageCount = "{$list['pageCount']}";
	//加载更多资源地址
	var url = "__URL__/effect/type/ajax/qb/1";
	
	//定义加载更多对象
	var loadmoreObj = loadmore( url, pageCount );

	//加载
	$(function(){
		//初始化加载更多模块
		loadmoreObj.init();
	});

	//加载更多
	function load_more(){
		loadmoreObj.load();
		
	}
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
		<span class="header__center">关键词管理</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>

	<div class="page" >
		<div class="page__bd">
			<div class="weui-tab">
				<div class="weui-tab__bd">
					<div class="weui-tab">
						<div class="weui-navbar">
							<a class="weui-navbar__item" href="{:U('QRPlan/index')}">计划管理</a>
							<a class="weui-navbar__item weui-bar__item--on" href="{:U('QRKeyword/index')}">关键词管理</a>
							<a class="weui-navbar__item" href="{:U('QRReport/index')}">效果报表</a>
						</div>
						<div class="weui-tab__bd">
							<div class="weui-search-bar" id="searchBar">
						      <form class="weui-search-bar__form" action="__URL__" >
						      	<input type="hidden" name="m" value="{$Think.MODULE_NAME}" />
								<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
								<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
						        <div class="weui-search-bar__box">
						          <i class="weui-icon-search"></i>
						          <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="请输入计划名称" name="keyword" value="{$Think.get.keyword}">
						          <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
						        </div>
						        
						      </form>
						      <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
						    </div>
						    
						    <div class="weui-panel weui-panel_access">
								<div class="weui-panel__hd">关键词列表<gt name="list['count']" value ="0"><span class="ml10">共<span>{$list['count']}</span>个结果</span></gt></div>
								<div class="weui-panel__bd">
								
									<div id="content_div">
							 			<!-- 嵌套数据模版 begin -->
							            <include file="tpl/index.mobile"/>
							            <!-- 嵌套数据模版 end -->
									</div>
								
									<!-- 加载更多 begin -->
						            <div class="weui-panel__ft" id="loadmore_div">
					            		<div class="weui-loadmore" onclick ="load_more()">
						            		<i class="weui-loading" style="display: none;"></i>
						            		<span class="weui-loadmore__tips">查看更多</span>
					       				</div>
					       			</div>
					        		<!-- 加载更多 end -->
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="weui-tabbar">
			<a href="{:U('QRIndex/index')}" class="weui-tabbar__item">
				<div class="weui-tabbar__icon">
					<i class="iconfont">&#xe60a;</i>
				</div>
				<p class="weui-tabbar__label">产品概况</p>
			</a>
			<a href="{:U('QREpinfo/index')}" class="weui-tabbar__item">
				
				<div class="weui-tabbar__icon">
					<i class="iconfont">&#xe6c5;</i>
				</div>
				<p class="weui-tabbar__label">企业资料</p>
				
			</a>
			<a href="{:U('QRPlan/index')}" class="weui-tabbar__item weui-bar__item--on">
				<div class="weui-tabbar__icon">
					<i class="iconfont">&#xe631;</i>
				</div>
				<p class="weui-tabbar__label">关键词管理</p>
			</a>
			
			<!-- <a href="{:U('Keyword/search')}" class="weui-tabbar__item">
				<div class="weui-tabbar__icon">
					<i class="iconfont">&#xe612;</i>
				</div>
				<p class="weui-tabbar__label">财务管理</p>
			</a> -->
		</div>
			</div>
		</div>
	</div>
</body>
</html>

