<!--menu 左侧菜单 begin-->
<script type="text/javascript">
$(function() {
  layui.use(['element'], function () {
    var element = layui.element
    
    window.$ = layui.jquery;
    // 监听导航点击
    element.on('nav(menu)', function (elem) {
      var mUrl = elem.attr('dx-menu');
      !_.isEmpty(mUrl) && _route.go(mUrl);
    });
  });
});
</script>
<nav class="ui-menu">
	<ul class="layui-nav layui-nav-tree" lay-filter="menu">

		<!-- 产品概况 begin -->
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Home' && ACTION_NAME eq 'home'">layui-nav-itemed</if>">
			<a href="{:U('Home/home')}"><i class="iconfont">&#xe60a;</i>我的桌面</a>
		</li>
		<!-- 产品概况 end -->

		<!-- 用户管理 begin -->
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'UserManagement'">layui-nav-itemed</if>">
			<a href="javascript:;"><i class="iconfont">&#xe62f;</i>我的用户</a>
			<dl class="layui-nav-child">
			
				<!-- 只有开通了二级代理的权限才能显示子代理的菜单 end -->
				<dd <if condition="MODULE_NAME  eq 'UserManagement' && ACTION_NAME eq 'sub_user_list'">class="layui-this"</if>>
					<a href="{:U('UserManagement/sub_user_list')}">子用户列表</a>
				</dd>
			</dl>
		</li>
		<!-- 用户管理 end -->

		<switch name="LoginUserInfo['usertype']" >
			<case value="sales_manager" break="0"></case><!-- 销售经理 -->
			<case value="customer_manager"><!--客服经理 -->
		 
		 	<!-- 员工管理 begin -->
		    <li class="layui-nav-item <if condition="MODULE_NAME  eq 'SysPermission'">layui-nav-itemed</if>">
		    	<a href="{:U('SysPermission/staff')}">
					<i class="iconfont">&#xe629;</i>员工管理
				</a>
		    </li>
			<!-- 员工管理 end -->
			 
		 	</case>
		 	<case value="seller"> <!-- 销售 -->
		 	</case>
		 	<case value="customer"> <!-- 客服 -->
		 	</case>
		 	<default />

				<!-- 财务管理 begin -->
			 	<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Finance'">layui-nav-itemed</if>">
					<a href="javascript:;"><i class="iconfont">&#xe63d;</i>我的钱包</a>
					<dl class="layui-nav-child">
						<dd <if condition="MODULE_NAME  eq 'Finance' && ACTION_NAME eq 'pool'">class="layui-this"</if>>
							<a href="{:U('Finance/pool')}">资金池管理</a>
						</dd>
						<dd <if condition="MODULE_NAME  eq 'Finance' && ACTION_NAME eq 'details'">class="layui-this"</if>>
							<a href="{:U('Finance/details')}">财务明细</a>
						</dd>
						<!-- 只有开通了二级代理的权限才能显示子代理的菜单 begin -->
						<eq name="LoginUserInfo.isopen_subagent" value="1">
						<dd <if condition="MODULE_NAME  eq 'Finance' && ACTION_NAME eq 'sub_agent_list'">class="layui-this"</if>>
							<a href="{:U('Finance/sub_agent_list')}">子代理充值</a>
						</dd>
						</eq>
						<dd <if condition="MODULE_NAME  eq 'Finance' && ACTION_NAME eq 'sub_user_list'">class="layui-this"</if>>
							<a href="{:U('Finance/sub_user_list')}">子用户充值</a>
						</dd>
					</dl>
				</li>
				<!-- 财务管理 end -->

				<!-- 系统设置 begin -->
				<eq name="LoginUserInfo.isopen_oem" value="1">
		 		<li class="layui-nav-item <if condition=" ( MODULE_NAME  eq 'System') OR ( MODULE_NAME  eq 'News') ">layui-nav-itemed</if>">
					<a href="javascript:;"><i class="iconfont">&#xe7e0;</i>我的设置</a>
					<dl class="layui-nav-child">
						<dd <if condition="MODULE_NAME  eq 'System' && ACTION_NAME eq 'index'">class="layui-this"</if>>
							<a href="{:U('System/index')}">基础设置</a>
						</dd>
						<dd <if condition="MODULE_NAME  eq 'News' && ACTION_NAME eq 'maintainPage' && $_GET['newstype'] eq 'notice'">class="layui-this"</if>>
							<a href="{:U('News/maintainPage')}/newstype/notice">维护公告</a>
						</dd>
						<dd <if condition="MODULE_NAME  eq 'News' && ACTION_NAME eq 'maintainPage' && $_GET['newstype'] eq 'protocol'">class="layui-this"</if>>
							<a href="{:U('News/maintainPage')}/newstype/protocol">维护协议</a>
						</dd>
						<dd <if condition="MODULE_NAME  eq 'News' && ACTION_NAME eq 'insertPage'">class="layui-this"</if>>
							<a href="{:U('News/insertPage')}">添加通知</a>
						</dd>
						<!-- <dd <if condition="MODULE_NAME  eq 'System' && ACTION_NAME eq 'insertNoticePage'">class="layui-this"</if>>
							<a href="{:U('System/insertNoticePage')}">添加公告</a>
						</dd>
						<dd <if condition="MODULE_NAME  eq 'System' && ACTION_NAME eq 'insertProtocolPage'">class="layui-this"</if>>
							<a href="{:U('System/insertProtocolPage')}">添加协议</a>
						</dd> -->
						<dd <if condition="MODULE_NAME  eq 'News' && ACTION_NAME eq 'publist'">class="layui-this"</if>>
							<a href="{:U('News/publist')}">发布列表</a>
						</dd>
					</dl>
				</li>
				</eq>
				<!-- 系统设置 end -->

				<!-- 权限管理 begin -->
				<li class="layui-nav-item <if condition="MODULE_NAME  eq 'SysPermission' ">layui-nav-itemed</if>">
					<a href="javascript:;"><i class="iconfont">&#xe6c2;</i>角色管理</a>
					<dl class="layui-nav-child">
						<dd <if condition="MODULE_NAME  eq 'SysPermission' && ACTION_NAME eq 'department'">class="layui-this"</if>>
							<a href="{:U('SysPermission/department')}">角色管理</a>
						</dd>
						<!-- <dd <if condition="MODULE_NAME  eq 'SysPermission' && ACTION_NAME eq 'role'">class="layui-this"</if>>
							<a href="{:U('SysPermission/role')}">角色管理</a>
						</dd> -->
						<!-- <dd <if condition="MODULE_NAME  eq 'SysPermission' && ACTION_NAME eq 'staff'">class="layui-this"</if>>
							<a href="{:U('SysPermission/staff')}">员工管理</a>
						</dd> -->
					</dl>
				</li>
				<!-- 权限管理 end -->
		</switch>

		<!-- 账号管理 begin -->
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'User'">layui-nav-itemed</if>">
			<a href="javascript:;"><i class="iconfont">&#xe66a;</i>账号管理</a>
			<dl class="layui-nav-child">
				<!-- <dd>
				<a href="{:U('User/index')}">个人中心</a>
				</dd> -->
				<dd <if condition="MODULE_NAME  eq 'User' && ACTION_NAME eq 'updatePage'">class="layui-this"</if>>
					<a href="{:U('User/updatePage')}">基本信息</a>
				</dd>
				<dd <if condition="MODULE_NAME  eq 'User' && ACTION_NAME eq 'updatePasswordPage'">class="layui-this"</if>>
					<a href="{:U('User/updatePasswordPage')}">修改密码</a>
				</dd>
			</dl>
		</li>
		<!-- 账号管理 end -->








	
		
		
		
			
		
		<!-- <li class="layui-nav-item <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'effect'">layui-nav-itemed</if>">
			<a href="{:U('Keyword/effect')}"><i class="iconfont">&#xe699;</i>关键词排名</a>
		</li> -->
		
		
		
		
		
		
		
	</ul>
	
</nav>
<!--menu 左侧菜单 end-->