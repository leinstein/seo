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
	var url = "__URL__/{$Think.ACTION_NAME}/type/ajax/qb/1/operate/{$Think.get.operate}";
	
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
							<a class="weui-navbar__item weui-bar__item--on" href="{:U('Finance/details')}/operate/recharge">财务明细</a>
							<eq name="LoginUserInfo['isopen_subagent']" value="1">
							<a class="weui-navbar__item" href="{:U('Finance/sub_agent_list')}">子代理充值</a>
							</eq>
							<a class="weui-navbar__item" href="{:U('Finance/sub_user_list')}">子用户充值</a>
						</div>
						<div class="weui-tab__bd">
							
						    <div class="weui-panel weui-panel_access" >
								<div class="weui-panel__bd">
									<div class="weui-navbar">
										<a class="weui-navbar__item <eq name="Think.get.operate" value="recharge">weui-bar__item--on</eq>" href="{:U('Finance/details')}/operate/recharge">入账记录<i class="iconfont ml5" style="font-size: 20px;">&#xe66f;</i></a>
										<a class="weui-navbar__item <eq name="Think.get.operate" value="expend">weui-bar__item--on</eq>" href="{:U('Finance/details')}/operate/expend">支出记录<i class="iconfont ml5" style="font-size: 20px;">&#xe670;</i></a>
								
									</div>
								
									<div class="weui-panel weui-panel_access"  style="margin-top: 56px;">
										<div class="weui-panel__hd">
											<eq name="Think.get.operate" value="recharge">
											入账记录
											<else/>
											支出记录
											</eq>
											<gt name="list['count']" value="0"><span class="ml10">共<span><b class="ml5 mr5">{$list['count']}</b></span>个结果</span></gt>
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
		</div>
	</div>
</body>
</html>

