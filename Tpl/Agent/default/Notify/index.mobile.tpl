<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />

<!-- 自定义正则验证js  -->
<script src="__PUBLIC__/js/regular.js"></script>

<!-- 专用js begin -->
<script src="__PUBLIC__/js/loadmore-mobile.js"></script>
<!-- 专用js begin -->

<script type="text/javascript">
	$(function() {
		
		
	});
	
	//总的页码
	var pageCount = "{$list['pageCount']}";
	//加载更多资源地址
	var url = "__URL__/{$Think.ACTION_NAME}/type/ajax/qb/1";
	
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
</style>

</head>
<body ontouchstart>

	<div class="header">
		<a class="header-arrow__left" href="{:U('Agent/Home/home')}"><i class="iconfont">&#xe671;</i></a>
		<span class="header__center">消息提醒</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>

	<div class="page" >
		<div class="page__bd">
			<div class="weui-tab">
				<div class="weui-tab__bd">
					<div class="weui-tab">
						
						<div class="weui-tab__bd">
							
							<!-- <div class="weui-search-bar" id="searchBar">
						      <form class="weui-search-bar__form" action="__URL__" >
						      	<input type="hidden" name="m" value="{$Think.MODULE_NAME}" />
								<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
								<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
						        <div class="weui-search-bar__box">
						          <i class="weui-icon-search"></i>
						          <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="请输入公告标题/公告内容" name="keyword" value="{$Think.get.keyword}">
						          <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
						        </div>
						        
						      </form>
						      <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
						    </div> -->
						    
						    <div class="weui-panel weui-panel_access">
								<div class="weui-panel__hd">
									消息提醒<gt name="list['count']" value="0">
									<span class="ml10">共<span><b class="ml5 mr5">{$list['count']}</b></span>个结果</span></gt>
								</div>
								<div class="weui-panel__bd">
								
									<div id="content_div">
							 			<!-- 嵌套数据模版 begin -->
							            <include file="$tpl"/>
							            <!-- 嵌套数据模版 end -->
									</div>
								
									<!-- 加载更多 begin -->
						            <div class="weui-panel__ft" id="loadmore_div">
					            		<div class="weui-loadmore" onclick ="load_more()">
						            		<a href="javascript:;" class="weui-btn weui-btn_default weui-btn_loading">
				            					<i class="weui-loading" style="display: none;"></i>
				            					<span class="weui-loadmore__tips">查看更多</span>
				            				</a>
					       				</div>
					       			</div>
					        		<!-- 加载更多 end -->
	       		
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

