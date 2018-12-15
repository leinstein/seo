<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
   <script type="text/javascript">
   $(function() {
	layui.use(['form'], function(){
	  var form = layui.form;
	});
});
   </script>
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
		  <a><cite>关键词检测排名差异</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        
        <div class="ui-content" id="ui-content">
            <section>
	            <div class="ui-panel">	            
		           	<!-- <form name="form1" id="form1" method="get" action="__URL__" class="layui-form">
							<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
							<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
							<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
							
							<div class="layui-form-item">
							    <div class="layui-inline">
							      <div class="layui-input-inline" style="width: 100px;">
							        <input type="text" class="layui-input" name="keyword" value="{$Think.get.keyword}" placeholder="关键词">
							      </div>
							    </div>
							    <div class="layui-inline">
							      <div class="layui-input-inline" style="width: 100px;">
							        <input type="text" name="website" class="layui-input" value="{$Think.get.website}" placeholder="网址">
							      </div>
							    </div>
							    <div class="layui-inline">
							      <div class="layui-input-inline" style="width: 100px;">
							        <html:select options="SearchengineOptions" first="搜索引擎" name="searchengine"  style="" selected="_GET['searchengine']" />
							      </div>
							    </div>
							    
							   
							    <div class="layui-inline">
							      <div class="layui-input-inline">
							        <input type="submit" name="sub" value="查询" class="layui-btn">
							        <button type="reset" name="btn" onclick="location.href='__URL__/effect'" class="layui-btn layui-btn-primary">重置</button>
							      </div>
							    </div>
							  </div>
						</form> -->
						
						<button type="button" class="layui-btn layui-btn" onclick="open_layer('导入报表','{:U('importMatchPage')}/id/{$vo['id']}/planname/{$vo['planname']|urlencode}&returnUrl={$returnUrl|urlencode}',600,450)">导入后台报表</button>
						
						<table class="layui-table">
					 	<thead>
					    <tr>
					      	<th width="30">序号</th>
							<th width="150">关键词</th>
							<th>网址</th>
							<th width="80">搜索引擎</th>
							<th width="60">今日排名</th>
							<th width="60">真实排名</th>
					    </tr> 
					 	</thead>
						<tbody>
					 		<notempty name="list">
							<volist name="list" id="vo">
						    <tr>
						      	<td>{$key+1}</td>
								<!-- 关键词 -->
								<td>
									<a target="_balnk" href="{$vo['searchengine_url']}">{$vo['keyword']}</a>
								</td>
								<!-- 网址 -->
								<td>{$vo['website']}</td>
								<!-- 搜索引擎 -->
								<td>{$vo['searchengine_zh']}</td>
								
								<td>
									{$vo['rank']}
									<img src="{$vo.img}" style="vertical-align: middle;float: right;">
								</td>
								<td>{$vo['real_rank']}</td>
						    </tr>
						   </volist>
						<else/>
						<tr>
							<td colspan="15" align="center" class="layui-table-nodata">暂无相关数据</td>
						</tr>
						</notempty>
					 	</tbody>
					</table>
				</div>
            </section>
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>



