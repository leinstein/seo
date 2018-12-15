<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
   <script type="text/javascript">
   $(function() {
	   /* layui.use(['element'], function(){
		   var $ = layui.jquery
		   ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
		   
		 }); */
	});
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
		  <a><cite>财务明细</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	 
        
						
				<div class="layui-tab layui-tab-brief">
				  <ul class="layui-tab-title">
				    <li class="layui-this">充值记录<i class="iconfont ml5" style="font-size: 20px;">&#xe66f;</i></li>
				 <!--    <li>支出记录<i class="iconfont ml5" style="font-size: 20px;">&#xe670;</i></li> -->
				  </ul>
				  <div class="layui-tab-content">
				    <div class="layui-tab-item layui-show">
				       	<table class="layui-table">
							<thead>
								<tr>
									<th>序号</th>
									<th>用户名</th>
									<th>用户类型</th>
									<!-- <th>真实姓名</th>
									<th>公司名称</th> -->
									<th>充值产品</th>
									<th>充值金额</th>
									<th>操作人员</th>
									<th>操作时间</th>
								</tr>
							</thead>
							<tbody>
								<notempty name="list['data']"> <volist
									name="list['data']" id="vo">
								<tr>
									<td>{$vo['No']}</td>
									<td>{$vo['username']}</td>
									<td>{$vo['usertype_desc']}</td>
									<!-- <td>{$vo['truename']}</td>
									<td>{$vo['epname']}</td> -->
									<td>{$vo['product']['product_name']}</td>
									<td>{$vo['amount']|format_money}</td>
									<td>{$vo['createusername']}</td>
									<td>{$vo['createtime']}</td>
								</tr>
								</volist> <else />
								<tr>
									<td colspan="7">暂无充值记录</td>
								</tr>
								</notempty>
							</tbody>
						</table>
						<!-- 分页 begin -->		
						<div class="layui-box layui-laypage fr">
							{$list['html']}
						</div>	
						<!-- 分页 end -->	  
				    </div>
				    
				    
				  </div>
				</div>
     
	           
			</div> 
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>


