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
        		
				<!-- <form class="layui-form mt10" name="form1" id="form1" method="get" action="__URL__" >
					<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
					<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
					<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
					<div class="layui-form-item">
						<div class="layui-inline">
				
							<div class="layui-input-inline" >
								<input id="username" name="rolename" class="layui-input" value="{$Think.get.rolename}" placeholder="角色名">
							</div>
							<div class="layui-input-inline">
								<input id="username" name="truename" class="layui-input" value="{$Think.get.truename}" placeholder="用户姓名">
							</div>
							<div class="layui-input-inline">
								<input id="epname" name="epname" class="layui-input" value="{$Think.get.epname}" placeholder="公司名">
							</div>
							
							<div class="layui-input-inline">
								<html:select options="UserStatusOptions" first="用户状态" name="userstatus"  selected="_GET['userstatus']" />
							</div>
							
							
							<div class="layui-input-inline">
								<input type="submit" name="sub" value="查询" class="layui-btn"> 
								<input type="button" name="btn" value="重置" onclick="location.href='__URL__/{$Think.ACTION_NAME}'" class="layui-btn layui-btn-primary">
								
							</div>
						</div>
					</div>
					
					
				</form> -->
						
				<table class="layui-table">
					<thead>
						<tr>
							<th width="40">序号</th>
							<th>部门</th>
							<th>角色</th>
							<th>员工</th>
							<th>管理</th>
						</tr>
					</thead>
					<tbody>
						<notempty name="list">
						<volist name="list" id="vo">
						<tr>
							<td rowspan="{$vo['roles']|count}">{$key+1}</td>
						
							<!-- 用户姓名 -->
							<td rowspan="{$vo['roles']|count}">
								{$vo['departname']}
							</td>
							<!--管理-->
							
							<!-- 用户姓名 -->
							<td>
								{$vo['roles'][0]['rolename']} 
							</td>
							<!--管理-->
							
							<td>
								<volist name="vo['roles'][0]['user_info']" id="vo_user" >
									<a class="m10" href="javascript:;" onclick="open_layer('修改用户信息','{:U('updateStaffPage')}/id/{$vo_user['id']}/rolecode/{$vo['roles'][0]['rolecode']}/rolelevel/{$vo['roles'][0]['rolelevel']}&returnUrl={$CURRENT_URL}',600 ,500)" >{$vo_user['username']}</a>
									<a class="layui-btn layui-btn-mini fr" style="margin-right:20px;" href="javascript:;" onclick="open_layer('分配客户','{:U('assignCustomerPage')}/id/{$vo_user['id']}&returnUrl={$CURRENT_URL}','100%')" >分配客户</a>
								</volist>
							</td>
							
							<td>
								<!-- <a href="{:U('insertStaffPage')}/rolecode/{$vo['roles'][0]['rolecode']}" >添加员工</a> -->
								<a class="layui-btn layui-btn-mini" href="javascript:;" onclick="open_layer('添加员工','{:U('insertStaffPage')}/rolecode/{$vo['roles'][0]['rolecode']}/rolelevel/{$vo['roles'][0]['rolelevel']}&returnUrl={$CURRENT_URL}',600 ,550)" >添加员工</a>
								
							</td>
				
						</tr>
						<php>unset($vo['roles'][0]);</php>
						<volist name="vo['roles']" id="vo2" >
						<tr>
						
							<td >
								{$vo2['rolename']} 
							</td>
							<td>
								<volist name="vo2['user_info']" id="vo_user2" >
									<a class="m10" style="" href="javascript:;" onclick="open_layer('修改用户信息','{:U('updateStaffPage')}/id/{$vo_user2['id']}/rolecode/{$vo2['rolecode']}/rolelevel/{$vo2['rolelevel']}&returnUrl={$CURRENT_URL}',600 ,500)" >{$vo_user2['username']} </a>
									<a class="layui-btn layui-btn-mini fr" style="margin-right:20px;" href="javascript:;" onclick="open_layer('分配客户','{:U('assignCustomerPage')}/id/{$vo_user2['id']}&returnUrl={$CURRENT_URL}','100%')" >分配客户</a>
								</volist>
							</td>
							<td>
								<!-- <a href="{:U('insertStaffPage')}/rolecode/{$vo2['rolecode']}" >添加员工</a> -->
								<a class="layui-btn layui-btn-mini" href="javascript:;" onclick="open_layer('添加员工','{:U('insertStaffPage')}/rolecode/{$vo2['rolecode']}/rolelevel/{$vo2['rolelevel']}&returnUrl={$CURRENT_URL}',600 ,550)" >添加员工</a>
								
							</td>
						</tr>
						</volist>	
						
						</volist>
						<else />
						<tr>
							<td colspan="15" align="center" class="layui-table-nodata">暂无相关数据</td>
						</tr>
						</notempty>
				
					</tbody>
				</table>
				
			
			</div> 
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>
