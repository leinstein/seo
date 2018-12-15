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
   	
   	/**
	 * 导出报表，导出当天合作停的关键词
	 * @accesspublic
	 */
   	function exportReport(){

		layer_confirm('导出数据可能会比较缓慢，您确认导出么？',
			function () {

				window.location.href = "__URL__/export_new_keyword_today";

		});
   	}
</script>
</head>
<tagLib name="html" />
<body>
    <!-- 页面顶部 logo & 菜单 begin -->
    <include file="../Public/top_banner" />
    <!-- 页面顶部 logo & 菜单 end -->
    <!-- 页面左侧菜单 begin -->
    <include file="../Public/left_home" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
        
		<!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>今日新增关键词列表</cite></a>
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
						
						<button type="button" class="layui-btn layui-btn" onclick="exportReport()">导出报表</button>
						
						<table class="layui-table">
					 	<thead>
					    <tr>
					      	<th width="30">序号</th>
							<th width="150">关键词</th>
							<th>网址</th>
							<th width="80">搜索引擎</th>
							<th width="100">创建用户</th>
							<th width="120">创建时间</th>
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
								<td>{$vo['website']}</td>
								<td>{$vo['searchengine_zh']}</td>
								<td>{$vo['createusername']}</td>
								<td>{$vo['createtime']}</td>
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



