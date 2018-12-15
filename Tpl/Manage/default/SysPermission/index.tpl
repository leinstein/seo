<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
   <script type="text/javascript">
   $(function() {
	   layui.use(['form'], function(){
		   	var form = layui.form;
		   	//自定义验证规则
			form.verify({
				/* mbstatus: function(value){
		  			if($.trim(value)== ""){
		    			return '请选择管理后台状态';
		  			}
				} */
			});

			form.on('submit(go)', function(data) {
			
			});
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
    <include file="../Public/left_home" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
    
        <!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>系统角色管理</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	 
	            <script type="text/javascript">
					$(function() {
						layui.use(['form'], function(){
						  var form = layui.form;
						  
						  
						});
					});
				</script>
				<form class="layui-form mt10" name="form1" id="form1" method="get" action="__URL__" >
					<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
					<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
					<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
					<div class="layui-form-item">
						<div class="layui-inline">
				
							<div class="layui-input-inline" >
								<input id="username" name="rolename" class="layui-input" value="{$Think.get.rolename}" placeholder="角色名">
							</div>
							<!-- <div class="layui-input-inline">
								<input id="username" name="truename" class="layui-input" value="{$Think.get.truename}" placeholder="用户姓名">
							</div>
							<div class="layui-input-inline">
								<input id="epname" name="epname" class="layui-input" value="{$Think.get.epname}" placeholder="公司名">
							</div>
							
							<div class="layui-input-inline">
								<html:select options="UserStatusOptions" first="用户状态" name="userstatus"  selected="_GET['userstatus']" />
							</div> -->
							
							
							<div class="layui-input-inline">
								<input type="submit" name="sub" value="查询" class="layui-btn"> 
								<input type="button" name="btn" value="重置" onclick="location.href='__URL__/{$Think.ACTION_NAME}'" class="layui-btn layui-btn-primary">
								
							</div>
						</div>
					</div>
					
					
				</form>
						
				<table class="layui-table">
					<thead>
						<tr>
							<th width="40">序号</th>
							<th>角色名</th>
							<th>管理</th>
						</tr>
					</thead>
					<tbody>
						<notempty name="list['data']">
						<volist name="list['data']" id="vo">
						<tr>
							<td>{$vo['No']}</td>
						
							<!-- 用户姓名 -->
							<td>
								{$vo['rolename']}
							</td>
							<!--管理-->
							<td>
								
								<a class="layui-btn layui-btn-mini" href="javascript:;" onclick="open_layer('功能权限','{:U('updatePage')}/id/{$vo['id']}/type/agent','50%')" >功能权限</a>
								<!-- <a class="layui-btn layui-btn-mini" href="javascript:;" onclick="open_layer('修改子用户密码','{:U('updatePasswordPage')}/id/{$vo['id']}/type/agent',600,400)" >密码</a>
								<a class="layui-btn layui-btn-mini" target="_blank" href="__URL__/loginSubuser/userid/{$vo['id']}">登录</a>
								<a href="javascript:;" onclick="open_layer('日志','{:U('updatePasswordPage')}/id/{$vo['id']}/type/agent',500,460)" >日志</a>
								<eq name="vo['isCanEdit']" value="1">
								<a onclick="return confirm(&quot;确定删除吗?&quot;)" class="layui-btn layui-btn-danger layui-btn-mini"  href="__URL__/delete/id/{$vo['id']}">删除</a>
								<else/>
								<button type="button" class="layui-btn layui-btn-danger layui-btn-mini layui-btn-disabled" >删除</button>
								</eq> -->
								
							</td>
				
						</tr>
						</volist>
						<else />
						<tr>
							<td colspan="15" align="center" class="layui-table-nodata">暂无相关数据</td>
						</tr>
						</notempty>
				
					</tbody>
				</table>
				
				<!-- 分页 begin -->		
				<div class="layui-box layui-laypage">
					{$list['html']}
				</div>	
				<!-- 分页 end -->	  
			</div> 
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>
