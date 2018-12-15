<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />
<!-- 引入 echarts begin -->
<!-- 引入 echarts end -->
<script type="text/javascript">
	$(function() {
		 $(document).on("open", ".weui-popup-modal", function() {
		      console.log("open popup");
		    }).on("close", ".weui-popup-modal", function() {
		      console.log("close popup");
		    });
		 
		 
		 layui.use(['form'], function() {
				var form = layui.form;

				//自定义验证规则
				form.verify({
				});

				form.on('submit(*)', function(data) {
					console.log(data)
					return false;
				});


			});
		
	});
	

	function submit(){
		 $.toptip('操作失败', 'error');
	}
</script>
<style>

</style>

<link rel="stylesheet" href="__PUBLIC__/css/mobile/demos.css">
</head>
<body ontouchstart>

  	<div class="header">
  		<a class="header-arrow__left" href="{:U('Service/Home/home')}"><i class="iconfont">&#xe671;</i></a>
  		<span class="header__center">我的站点</span>
		<a class="header-arrow__right open-popup" href="javascript:;" data-target="#full"><i class="iconfont">&#xe651;</i></a>
	</div>
	
	
	<div id="full" class='weui-popup__container' style="z-index: 188888">
      <div class="weui-popup__modal">
       
        <div class="weui-cells__title">新增站点</div>
        	<form class="layui-form" action="{:U('insert')}" method="post">
				<div class="weui-cells weui-cells_form">
			      <div class="weui-cell">
			        <div class="weui-cell__hd"><label class="weui-label">站点名称</label></div>
			        <div class="weui-cell__bd">
			          <!-- <input class="weui-input" type="text" pattern="[0-9]*" placeholder="请输入qq号"> -->
			          <input type="text" name="sitename" class="weui-input layui-input"  required="" lay-verify="required" placeholder="请输入站点名称">
			      	</div>
			      </div>
			      <div class="weui-cell weui-cell_vcode">
			        <div class="weui-cell__hd">
			          <label class="weui-label">站点地址</label>
			        </div>
			        <div class="weui-cell__bd">
			          <input type="text" name="website" class="weui-input layui-input"  required="" lay-verify="required" placeholder="请按照格式填写，如：www.baidu.com">
			        </div>
			      </div>
			      <div class="weui-cell">
			        <div class="weui-cell__hd"><label for="" class="weui-label">ftp</label></div>
			        <div class="weui-cell__bd">
			           <textarea class="weui-textarea layui-textarea" name="ftp" placeholder="请准确FTP信息,以便优化师调整"  rows="3"></textarea>
			        </div>
			      </div>
			      <div class="weui-cell">
			        <div class="weui-cell__hd"><label for="" class="weui-label">管理后台</label></div>
			        <div class="weui-cell__bd">
			           <textarea class="weui-textarea layui-textarea" name="managebackground" placeholder="请填写后台管理账号,以便优化师调整"  rows="3"></textarea>
			        </div>
			      </div>
			      
			    </div>
	    		<button class="layui-btn weui-btn weui-btn_primary " lay-submit="" lay-filter="formDemo">立即提交</button>
				<a href="javascript:;" class="weui-btn weui-btn_default close-popup">关闭</a>
			</form>
		</div>
    </div>
		
  	<div class="page">
  		<div class="page__bd">
			<div class="weui-tab">
				<div class="weui-tab__bd">
					<div class="weui-panel weui-panel_access">
						<div class="weui-panel__hd">站点列表</div>
						<div class="weui-panel__bd">
							<!-- 站点列表挂件 begin -->
							{:W('SiteList', array( 'list' => $list,'skin'=>'mobile', 'untreated_workorder_num' => $untreated_workorder_num, 'me' => $LoginUserInfo, 'returnUrl' => $CURRENT_URL))}
							<!-- 站点列表挂件 end -->	
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
					<a href="{:U('Site/index')}" class="weui-tabbar__item weui-bar__item--on">
						
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe633;</i>
						</div>
						<p class="weui-tabbar__label">我的站点</p>
						
					</a>
					<a href="{:U('Keyword/search')}" class="weui-tabbar__item">
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

