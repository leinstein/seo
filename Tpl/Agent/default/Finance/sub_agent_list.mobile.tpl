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
	      	// 获取当前选择的用户的id
	      	var userid = $(this).attr( "data-id" ) ;
	      	$("#userid").val( userid );
	      	var username = $(this).attr( "data-username" ) ;
	      	$("#username").text( username );
	      	var epname = $(this).attr( "data-epname" ) ;
	      	$("#epname").text( epname );
	      	var product =  $(this).attr( "data-product" ) ; 
	      	var product_arr = product.split(";");
	      	var product_ids = product_arr[0];
	      	var productid_arra = product_ids.split(",");
	      	var product_names = product_arr[1];
	      	var productname_arra = product_names.split(",");
	      	$("#product option").remove();
	      	
	      	for(var i=0;i<productid_arra.length;i++){
	      		$("#product").append("<option value='"+productid_arra[i]+"'>"+productname_arra[i]+"</option>");
	      	}
	      	
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
	// 提交
	function doSub(){
		
		//自定义验证规则
		// 是否选择了产品
		if( !$("#product").val() ){
			$.toptip('请选择产品', 'error');
			return false;
		}
		var amount = $.trim( $("#amount_recharge").val() );
		
		var is_recharge_limit 	= "{$is_recharge_limit}";
		var availablefunds 		= "{$funds['availablefunds']}";
		// 是否输入了金额
		if( !amount ){
			$.toptip('请输入金额', 'error');
			return false;
		}
		
		// 金额输入的示是否正确
		if( !verifyMoney(amount)){
			$.toptip('您输入的金额格式不正确', 'error');
			return false;
		}
		
		// 金额是否大于可用余额
		if( is_recharge_limit == 1 && accSub(amount , 5000 ) < 0 ){
			$.toptip('充值金额最少为5000元', 'error');
			return false;
		}

		// 金额是否大于可用余额
		if( accSub(amount , availablefunds ) > 0 ){
			$.toptip('充值金额不能大于资金池余额', 'error');
			return false;
		}
		document.form.submit();
	}
</script>
<style>
</style>

</head>
<body ontouchstart>

	<div class="header">
		<a class="header-arrow__left" href="{:U('Agent/Home/home')}"><i class="iconfont">&#xe671;</i></a>
		<span class="header__center">财务管理</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>

	<div class="page" >
		<div class="page__bd">
			<div class="weui-tab">
				<div class="weui-tab__bd">
					<div class="weui-tab">
						<div class="weui-navbar">
							<a class="weui-navbar__item" href="{:U('Finance/pool')}">资金池管理</a>
							<a class="weui-navbar__item" href="{:U('Finance/details')}/operate/recharge">财务明细</a>
							<eq name="LoginUserInfo['isopen_subagent']" value="1">
							<a class="weui-navbar__item weui-bar__item--on" href="{:U('Finance/sub_agent_list')}">子代理充值</a>
							</eq>
							<a class="weui-navbar__item" href="{:U('Finance/sub_user_list')}">子用户充值</a>
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
								<div class="weui-panel__hd">用户列表<gt name="list['count']" value="0"><span class="ml10">共<span><b class="ml5 mr5">{$list['count']}</b></span>个结果</span></gt></div>
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
					        		
					        		<!-- 充值弹窗 begin -->
				        		 	<div id="full" class='weui-popup__container'>
							      		<div class="weui-popup__overlay"></div>
							      		<div class="weui-popup__modal">
							        		<div class="toolbar">
						          				<div class="toolbar-inner">
								            		<a href="javascript:;" class="picker-button close-popup">关闭</a>
								            		<h1 class="title">子代理商充值</h1>
								          		</div>
								        	</div>
								        	
								        	<div class="modal-content">
												<div class="weui-cells__title">子代理商充值</div>
												<div class="weui-cells weui-cells_form">
													<form name="form" action="{:U('recharge')}" method="post" class="layui-form">
														<input type="hidden" name="id" id="userid">
														<input type="hidden" name="usertype" value="agent2">
														
														<div class="weui-cell">
															<div class="weui-cell__hd">
																<label class="weui-label">用户名</label>
															</div>
															<div class="weui-cell__bd">
																<span id="username"></span>
															</div>
														</div>
														<div class="weui-cell">
															<div class="weui-cell__hd">
																<label for="" class="weui-label">角色类型</label>
															</div>
															<div class="weui-cell__bd">
																<span id="usertype">子代理商</span>
															</div>
														</div>
														<div class="weui-cell">
															<div class="weui-cell__hd">
																<label for="" class="weui-label">公司名称</label>
															</div>
															<div class="weui-cell__bd">
																<span id="epname"></span>
															</div>
														</div>
														<div class="weui-cell">
															<div class="weui-cell__hd">
																<label for="" class="weui-label">资金余额</label>
															</div>
															<div class="weui-cell__bd">
																<span id="amount">{$funds['availablefunds']|format_money}</span>元
															</div>
														</div>
	
														<div class="weui-cell">
															<div class="weui-cell__hd">
																<label for="" class="weui-label">充值产品</label>
															</div>
															<div class="weui-cell__bd">
																<select class="weui-select" id="product" name="productid"></select>
															</div>
														</div>
														
														<div class="weui-cell">
															<div class="weui-cell__hd">
																<label for="" class="weui-label">充值金额</label>
															</div>
															<div class="weui-cell__bd">
																<input type="text" id="amount_recharge" name="amount"  placeholder="请填写充值金额"  class="weui-input">
															</div>
														</div>
														
														<div class="weui-btn-area">
													      <a class="weui-btn weui-btn_primary" href="javascript:;" onclick="doSub()">立即提交</a>
													    </div>
													</form>
												</div>

											</div>
								      	</div>
							    	</div>
					        		<!-- 充值弹窗 end -->
					        		
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

