<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
</head>
<tagLib name="html" />
<body>
    <!-- 页面顶部 logo & 菜单 begin -->
    <include file="../Public/top_banner" />
    <!-- 页面顶部 logo & 菜单 end -->
    <!-- 页面左侧菜单 begin -->
    <include file="../Public/left" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
        <!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>关键词审核</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
            <section>
                <div class="ui-panel">	
                	<!-- 關鍵詞列表 挂件 begin -->
					{:W('KeywordList', array( 'data'=>$data , 'list' => $list,'skin' => 'manage', 'operate'=> 'review','returnUrl' => $CURRENT_URL ))}
					<!-- 關鍵詞列表 挂件 end -->
				</div>
			</section>
		</div>
                    
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>