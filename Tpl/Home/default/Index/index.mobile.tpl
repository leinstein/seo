<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />

<link rel="stylesheet" href="__PUBLIC__/css/mobile/index.css">
<script type="text/javascript" src="__PUBLIC__/js/jquery-weui/js/swiper.js" charset='utf-8'></script>
<script type="text/javascript">
	$(function() {
		
	      $(".swiper-container").swiper({
	        loop: true,
	        autoplay: 3000
	      });
	    
	});
	
</script>
<style>

</style>

</head>

<body>
	<div class="page" style="margin-top: 0">
		 <div class="page__bd">
		 	<!-- Slider main container begin -->
			<div class="swiper-container" data-space-between='10' data-pagination='.swiper-pagination' data-autoplay="1000">
			  <div class="swiper-wrapper">
			    <div class="swiper-slide"><img src="http://www.qisobao.com/banner/images/banner.png" alt="" width="100%"></div>
			    <div class="swiper-slide"><img src="http://www.qisobao.com/banner/images/banner02.jpg" alt="" width="100%"></div>
			    <div class="swiper-slide"><img src="http://www.qisobao.com/banner/images/banner03.jpg" alt="" width="100%"></div>
			    <!-- <div class="swiper-slide"><img src="http://www.qisobao.com/banner/images/banner04.jpg" alt="" width="100%"></div> -->
			  </div>
			</div>
			<!-- Slider main container end -->
			
	    	<!-- 我的业务九宫格 begin -->
	    	<div class="weui-panel my-business ">
		    	<div class="weui-grids">
				  <!-- <a href="__ROOT__/Tpl/Home/default/Index/product.html" class="weui-grid js_grid" style="background: #ff9900"> -->
				  <a href="{:U('Index/product')}" class="weui-grid js_grid" style="background: #ff9900">
				  
				    <div class="weui-grid__icon">
				      <i class="iconfont">&#xe688;</i>
				    </div>
				    <p class="weui-grid__label">产品服务</p>
				  </a>
				  <!-- <a href="{:U('News/index')}" class="weui-grid js_grid" style="background: #a6325a">
				    <div class="weui-grid__icon">
				      <i class="iconfont">&#xe6bc;</i>
				    </div>
				    <p class="weui-grid__label">通知公告</p>
				  </a>
				  <a href="{:U('Question/index')}" class="weui-grid js_grid" style="background: #48a7c2">
				    <div class="weui-grid__icon">
				      <i class="iconfont">&#xe637;</i>
				    </div>
				    <p class="weui-grid__label">常见问题</p>
				  </a> -->
				  <!-- <a href="" class="weui-grid js_grid" style="background: #48a7c2">
				    <div class="weui-grid__icon">
				      <i class="iconfont">&#xe62d;</i>
				    </div>
				    <p class="weui-grid__label">服务</p>
				  </a> -->
				  <a href="{:U('Index/keyword_case')}" class="weui-grid js_grid" style="background: #a6325a">
				    <div class="weui-grid__icon">
				      <i class="iconfont">&#xe62c;</i>
				    </div>
				    <p class="weui-grid__label">成功案例</p>
				  </a>
				  <a href="{:U('Index/joinus')}" class="weui-grid js_grid" style="background: #48a7c2">
				    <div class="weui-grid__icon">
				      <i class="iconfont">&#xe62a;</i>
				    </div>
				    <p class="weui-grid__label">加盟合作</p>
				  </a>
				  <a href="{:U('Index/news')}" class="weui-grid js_grid" style="background: #4fb3a4">
				    <div class="weui-grid__icon">
				      <i class="iconfont">&#xe649;</i>
				    </div>
				    <p class="weui-grid__label">新闻资讯</p>
				  </a>
				  <a href="{:U('Index/baike')}" class="weui-grid js_grid" style="background: #f5b977">
				    <div class="weui-grid__icon">
				      <i class="iconfont">&#xe646;</i>
				    </div>
				    <p class="weui-grid__label">SEO百科</p>
				  </a>
				  <a href="{:U('Index/aboutus')}" class="weui-grid js_grid" style="background: #ff7073">
				    <div class="weui-grid__icon">
				      <i class="iconfont">&#xe62a;</i>
				    </div>
				    <p class="weui-grid__label">关于我们</p>
				  </a>
				</div>
			</div>
			<!-- 我的业务九宫格 end -->
			
	        <!-- 我的业务 begin-->
	       <!--  <div class="weui-panel business">
	            <div class="weui-panel__hd">我的业务<span class="f12 c_gray ml10">点击图标，扫码办理业务</span></div>
			    <div class="weui-grids">
			       
			    </div>
			</div> -->
	        <!--我的业务 end-->
	        
	        <!-- 产品&服务 begin--
	        <div class="weui-panel weui-panel_access">
	            <div class="weui-panel__hd">产品&服务</div>
	            <div class="weui-panel__bd">
	                <a id="notify" <notempty name="notify">href="__GROUP__/Message/myNotify"<else/>  onclick="shake(this)" </notempty> class="weui-media-box weui-media-box_appmsg">
	                    <div class="weui-media-box__hd">
	                        <img class="weui-media-box__thumb" src="data:image/png;base64,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" alt="">
	                        <div class="weui-media-box__hd__title">消息提醒</div>
	                    </div>
	                    <div class="weui-media-box__bd">
	                        <notempty name="notify">
	               				<script>
	                        		//去掉隐藏伪类的样式
	                               	$("#notify .weui-media-box__bd").removeClass("hideafter") ;
	                            </script>
	                            <h4 class="weui-media-box__title">{$notify['body']}</h4>
	                        <else/>
            					<script>
	                          		//增加隐藏伪类的样式
	                            	$("#notify .weui-media-box__bd").addClass("hideafter");  
	                            </script>
                                <h5 class="weui-media-box__title">您暂时还没有消息提醒</h5> 
	                        </notempty>
	                        
	                    </div>
	                </a>
	            </div>
	        </div>
	    	<!-- 产品&服务 end-->
	        
	        <!-- <div class="shortcut-navs">
				<ul class="shortcut-nav">
					<li><a class="link link1" href="#">待付款</a></li>
					<li><a class="link link2" href="#">待收货</a></li>
					<li><a class="link link3" href="#">全部订单</a></li>
					<li><a class="link link5" href="#">我的资产</a></li>
				</ul>
				<ul class="shortcut-nav">
					<li><a class="link link6" href="#">帐户中心</a></li>
					<li><a class="link link7" href="#">客户服务</a></li>
					<li><a class="link link8" href="#">我的预约</a></li>
					<li></li>
				</ul>
			</div> -->

	    </div>
	    <!-- 页面底部 begin  -->
		<include file="Public/tpl/footer_mobile.tpl" />
		<!-- 页面底部 end  -->
	</div>
</body>
</html>

