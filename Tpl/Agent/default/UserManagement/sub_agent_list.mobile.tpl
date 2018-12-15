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
	$(document).on("click", ".open-popup", function() {
      
		// 将全部的文本域清空
		document.form.reset()
      	
  	}).on("close", ".weui-popup-modal", function() {
  		
	});
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
		<span class="header__center">用户管理</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>

	<div class="page" >
		<div class="page__bd">
			<div class="weui-tab">
				<div class="weui-tab__bd">
					<div class="weui-tab">
						<div class="weui-navbar">
							<a class="weui-navbar__item  weui-bar__item--on" href="{:U('UserManagement/sub_agent_list')}">子代理管理</a>
							<a class="weui-navbar__item" href="{:U('UserManagement/sub_user_list')}">子用户管理</a>
						</div>
						<div class="weui-tab__bd">
							
							<div class="weui-search-bar" id="searchBar">
						      <form class="weui-search-bar__form" action="__URL__" >
						      	<input type="hidden" name="m" value="{$Think.MODULE_NAME}" />
								<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
								<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
						        <div class="weui-search-bar__box">
						          <i class="weui-icon-search"></i>
						          <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="请输入用户名称/企业名称" name="keyword" value="{$Think.get.keyword}">
						          <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
						        </div>
						        
						      </form>
						      <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
						    </div>
						    
						    <div class="weui-panel weui-panel_access">
								<div class="weui-panel__hd">用户列表
									<span class="ml10">
										<gt name="list['count']" value="0">共<span><b class="ml5 mr5">{$list['count']}</b></span>个结果</gt>
										<a href="javascript:;" class="weui-btn weui-btn_primary weui-btn_mini fr open-popup" data-target="#full" style="margin-top: -5px;">添加子代理</a>
									</span>
									
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
					        		
					        		<!-- 添加用户弹窗 begin -->
				        		 	<div id="full" class='weui-popup__container'>
							      		<div class="weui-popup__overlay"></div>
							      		<div class="weui-popup__modal">
							        		<div class="toolbar">
						          				<div class="toolbar-inner">
								            		<a href="javascript:;" class="picker-button close-popup">关闭</a>
								            		<h1 class="title">新增子代理商</h1>
								          		</div>
								        	</div>
								        	
								        	<div class="modal-content">
												<div class="weui-cells__title">新增子代理商</div>
												<div class="weui-cells weui-cells_form">
													<form name="form" action="{:U('insert')}" method="post">
														<!-- 用户详情 挂件 begin -->
														{:W('UserDetail', array( 'data'=>$data,'operate' => 'insert','skin' => 'mobile','usertype' => 'agent2', 'me' => $LoginUserInfo , 'returnUrl' => $CURRENT_URL  ))}
														<!-- 用户详情 挂件 end -->
														
													</form>
												</div>

											</div>
								      	</div>
							    	</div>
					        		<!-- 添加用户弹窗 end -->
					        		
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

