<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />
<link rel="stylesheet" href="__PUBLIC__/css/mobile/list.css">
<!-- 专用js begin -->
<script src="__PUBLIC__/js/loadmore-mobile.js"></script>
<!-- 专用js begin -->
<!-- <script type="text/javascript" src="__PUBLIC__/js/jquery-weui/lib/fastclick.js"></script>
<script type="text/javascript">
	$(function() {
		 FastClick.attach(document.body);
	      
	    
	});
	
</script>

 <script>
      var loading = false;
      $(document.body).infinite().on("infinite", function() {
    	  alert()
        if(loading) return;
        loading = true;
        setTimeout(function() {
          $("#list").append("<p>《世界著名计算机教材精选·人工智能:一种现代的方法(第3版)》英文版有1100多页，教学内容非常丰富，不但涵盖了人工智能基础、问题求解、知识推理与规划等经典内容，而且还包括不确定知识与推理、机器学习、通讯感知与行动等专门知识的介绍。目前我们为本科生开设的学科基础必修课“人工智能导论”主要介绍其中的经典内容，而研究生必修的核心课程“人工智能原理”主要关注其中的专门知识。其实《世界著名计算机教材精选·人工智能:一种现代的方法(第3版)》也适合希望提高自身计算系统设计水平的广大应用计算技术的社会公众，对参加信息学奥林匹克竞赛和ACM程序设计竞赛的选手及其教练员也有一定的参考作用。</p>");
          loading = false;
        }, 2000);
      });
    </script> -->
<style>

</style>


<script type="text/javascript">

//总的页码
var pageCount = "{$list['pageCount']}";
//加载更多资源地址
var url = "__URL__/baike/type/ajax/qb/1";
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
		<a class="header-arrow__left" href="{:U('Home/Index/index')}"><i class="iconfont">&#xe671;</i></a>
		<span class="header__center">SEO百科</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>
	<div class="page">
		 <div class="page__bd">
		 
		 	<section class="banner">
				<img src="__PUBLIC__/img/mobile/seoBanner.jpg">
			</section>
		 	
		 	<section class="main width" >
		 		<div id="content_div">
		 			<!-- 嵌套数据模版 begin -->
		            <include file="tpl/baike.mobile"/>
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
        		
			</section>
			
	    </div>
	    <!-- 页面底部 begin  -->
		<include file="Public/tpl/footer_mobile.tpl" />
		<!-- 页面底部 end  -->
	</div>
</body>
</html>

