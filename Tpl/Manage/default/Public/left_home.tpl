<!--menu 左侧菜单 begin-->

<nav class="ui-menu">

  <ul class="layui-nav layui-nav-tree" lay-filter="menu">

  		<!-- 产品首页 begin -->
	 	<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Home' && ACTION_NAME eq 'home'">layui-nav-itemed</if>">
	      <a href="{:U('Home/home')}">
	        <i class="iconfont f18">&#xe60a;</i><span class="menu-title">系统概况</span>
	      </a>
	  </li>
		<!-- 产品首页  end -->
	    <neq name="LoginUserName" value="排名统计">
		<switch name="LoginUserInfo['usertype']" >
		 <case value="sales_manager"><!-- 销售经理 -->

	        <li class="layui-nav-item <if condition="MODULE_NAME  eq 'UserManagement'">layui-nav-itemed</if>">
	            <a href="javascript:;"><i class="iconfont">&#xe62f;</i>用户管理</a>
	            <dl class="layui-nav-child">

	                <dd <if condition="MODULE_NAME  eq 'UserManagement' && ACTION_NAME eq 'agent_list'">class="layui-this"</if>>
	                    <a href="{:U('UserManagement/agent_list')}">代理商管理</a>
					</dd>

					<dd <if condition="MODULE_NAME  eq 'UserManagement' && ACTION_NAME eq 'sub_user_list'">class="layui-this"</if>>
	                    <a href="{:U('UserManagement/sub_user_list')}">子用户管理</a>
					</dd>
	            </dl>
			 </li>


									 <!-- 员工管理 begin -->
		    <li class="layui-nav-item <if condition="MODULE_NAME  eq 'SysPermission'">layui-nav-itemed</if>">
		    	<a href="{:U('SysPermission/staff')}">
					<i class="iconfont">&#xe629;</i>员工管理
				</a>
			 </li>
									 <!-- 员工管理 end -->

		 </case>
		 <case value="seller"> <!-- 销售 -->

	      <li class="layui-nav-item <if condition="MODULE_NAME  eq 'UserManagement'">layui-nav-itemed</if>">
	            <a href="javascript:;"><i class="iconfont">&#xe62f;</i>用户管理</a>
	            <dl class="layui-nav-child">

	                <dd <if condition="MODULE_NAME  eq 'UserManagement' && ACTION_NAME eq 'agent_list'">class="layui-this"</if>>
	                    <a href="{:U('UserManagement/agent_list')}">代理商管理</a>
					</dd>

					<dd <if condition="MODULE_NAME  eq 'UserManagement' && ACTION_NAME eq 'sub_user_list'">class="layui-this"</if>>
	                    <a href="{:U('UserManagement/sub_user_list')}">子用户管理</a>
					</dd>
	            </dl>
			 </li>


		 </case>
		 <default />
		 	<neq name="LoginUserInfo['usertype']" value="operation">
		    <li class="layui-nav-item <if condition="MODULE_NAME  eq 'UserManagement'">layui-nav-itemed</if>">
				<a href="javascript:;"><i class="iconfont">&#xe62f;</i>用户管理</a>
				<dl class="layui-nav-child">

					<dd <if condition="MODULE_NAME  eq 'UserManagement' && ACTION_NAME eq 'agent_list'">class="layui-this"</if>>
						<a href="{:U('UserManagement/agent_list')}">代理商管理</a>
					</dd>

					<dd <if condition="MODULE_NAME  eq 'UserManagement' && ACTION_NAME eq 'sub_user_list'">class="layui-this"</if>>
						<a href="{:U('UserManagement/sub_user_list')}">子用户管理</a>
					</dd>
				</dl>
				</li>
		   	</neq>




	    	<eq name="LoginUserInfo['usertype']" value="admin">
		    <li class="layui-nav-item <eq name="Think.MODULE_NAME" value="Finance">layui-nav-itemed</eq>">
		      <a href="javascript:;">
		        <i class="iconfont f18">&#xe623;</i><span class="menu-title">财务管理</span>
		      <span class="layui-nav-more"></span></a>
		      <dl class="layui-nav-child">
		        <dd <if condition="MODULE_NAME  eq 'Finance' && ACTION_NAME eq 'pool'">class="layui-this"</if>><a href="{:U('Finance/pool')}">资金池管理</a></dd>
				  <dd <if condition="MODULE_NAME  eq 'Finance' && ACTION_NAME eq 'details'">class="layui-this"</if>><a href="{:U('Finance/details')}">财务明细</a></dd>
				  <dd <if condition="MODULE_NAME  eq 'Finance' && ACTION_NAME eq 'agent_user_list'">class="layui-this"</if>><a href="{:U('Finance/agent_user_list')}">代理充值</a></dd>
				  <dd <if condition="MODULE_NAME  eq 'Finance' && ACTION_NAME eq 'sub_user_list'">class="layui-this"</if>><a href="{:U('Finance/sub_user_list')}">用户退款</a></dd>
		      </dl>
			</li>

																										<!-- <li class="layui-nav-item <if condition="MODULE_NAME  eq 'UserRole'">layui-nav-itemed</if>">
		      <a href="{:U('UserRole/index')}">
		        <i class="iconfont f18">&#xe614;</i><span class="menu-title">角色管理</span>
		      </a>
		    </li>

		    <li class="layui-nav-item <if condition="MODULE_NAME  eq 'Staff'">layui-nav-itemed</if>">
		      <a href="{:U('Staff/index')}">
		        <i class="iconfont f18">&#xe61b;</i><span class="menu-title">员工管理</span>
		      </a>
		    </li>
		     -->

		    <li class="layui-nav-item <if condition="MODULE_NAME  eq 'SysPermission' ">layui-nav-itemed</if>">
				<a href="javascript:;"><i class="iconfont">&#xe7e0;</i>权限管理</a>
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

			</eq>

			<if condition="$LoginUserInfo['usertype'] == 'operation_manager'">
	    	<li class="layui-nav-item <if condition=" ( MODULE_NAME  eq 'System') OR ( MODULE_NAME  eq 'News') ">layui-nav-itemed</if>">
				<a href="javascript:;"><i class="iconfont">&#xe7e0;</i>系统设置</a>
				<dl class="layui-nav-child">
					<dd <if condition="MODULE_NAME  eq 'System' && ACTION_NAME eq 'updateNewsPage' && $_GET['newstype'] eq 'notice'">class="layui-this"</if>>
						<a href="{:U('System/updateNewsPage')}/newstype/notice">维护公告</a>
					</dd>
					<dd <if condition="MODULE_NAME  eq 'System' && ACTION_NAME eq 'updateNewsPage' && $_GET['newstype'] eq 'protocol'">class="layui-this"</if>>
						<a href="{:U('System/updateNewsPage')}/newstype/protocol">维护协议</a>
					</dd>

					<dd <if condition="MODULE_NAME  eq 'News' && ACTION_NAME eq 'insertPage'">class="layui-this"</if>>
						<a href="{:U('News/insertPage')}">添加通知</a>
					</dd>
					<dd <if condition="MODULE_NAME  eq 'News' && ACTION_NAME eq 'index'">class="layui-this"</if>>
						<a href="{:U('News/index')}">发布列表</a>
					</dd>

				</dl>
			</li>
			</if>

		 </switch>
  		</neq>


		<neq name="LoginUserName" value="排名统计">
  		<!-- 产品首页 begin -->
	 	<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Index' && ACTION_NAME eq 'index'">layui-nav-itemed</if>">
	      <a href="{:U('Index/index')}">
	        <i class="iconfont f18">&#xe60a;</i><span class="menu-title">产品统计</span>
	      </a>
			</li>
		<!-- 产品首页  end -->

		<switch name="LoginUserInfo['usertype']" >
		 <case value="sales_manager"><!-- 销售经理 -->


									 <!-- 关键词查询 begin -->
	        <li class="layui-nav-item <if condition="MODULE_NAME eq 'Keyword' && ACTION_NAME eq 'search'">layui-nav-itemed</if>">
	          <a href="{:U('Keyword/search')}">
	            <i class="iconfont f18">&#xe699;</i><span class="menu-title">关键词查询</span>
	          </a>
			 </li>
									 <!-- 关键词查询 end -->


									 <!-- 效果监控 begin -->
		 	<li class="layui-nav-item <if condition="ACTION_NAME eq 'effect'">layui-nav-itemed</if>">
		      <a href="javascript:;">
		        <i class="iconfont f18">&#xe7b2;</i><span class="menu-title">效果监控</span>
		      <span class="layui-nav-more"></span></a>
		      <dl class="layui-nav-child">
		        <dd <if condition="MODULE_NAME  eq 'Site' && ACTION_NAME eq 'effect'">class="layui-this"</if>><a href="{:U('Site/effect')}">站点效果监测</a></dd>
				  <dd <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'effect'">class="layui-this"</if>><a href="{:U('Keyword/effect')}">关键词效果监测</a></dd>
																											 <!--{*<dd <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'effect'">class="layui-this"</if>><a href="/Manage/Keyword/effect/ord/latestranking/keyword//website//keywordstatus/%E4%BC%98%E5%8C%96%E4%B8%AD/standardstatus//searchengine//num_per_page/">关键词效果监测</a></dd>*}-->
		      </dl>
			 </li>
									 <!-- 效果监控 end -->

		 </case>
		 <case value="seller"> <!-- 销售 -->

							   <!-- 关键词查询 begin -->
	        <li class="layui-nav-item <if condition="MODULE_NAME eq 'Keyword' && ACTION_NAME eq 'search'">layui-nav-itemed</if>">
	          <a href="{:U('Keyword/search')}">
	            <i class="iconfont f18">&#xe699;</i><span class="menu-title">关键词查询</span>
	          </a>
			 </li>
							   <!-- 关键词查询 end -->

			<li class="layui-nav-item <if condition="ACTION_NAME eq 'effect'">layui-nav-itemed</if>">
		      <a href="javascript:;">
		        <i class="iconfont f18">&#xe7b2;</i><span class="menu-title">效果监控</span>
		      <span class="layui-nav-more"></span></a>
		      <dl class="layui-nav-child">
		        <dd <if condition="MODULE_NAME  eq 'Site' && ACTION_NAME eq 'effect'">class="layui-this"</if>><a href="{:U('Site/effect')}">站点效果监测</a></dd>
				  <dd <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'effect'">class="layui-this"</if>><a href="{:U('Keyword/effect')}">关键词效果监测</a></dd>
																											 <!--{*<dd <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'effect'">class="layui-this"</if>><a href="/Manage/Keyword/effect/ord/latestranking/keyword//website//keywordstatus/%E4%BC%98%E5%8C%96%E4%B8%AD/standardstatus//searchengine//num_per_page/">关键词效果监测</a></dd>*}-->
		      </dl>
			 </li>
		 </case>
		 <default />

	    	<if condition="$LoginUserInfo['usertype'] == 'operation_manager' OR $LoginUserInfo['usertype'] == 'operation'">

		    <li class="layui-nav-item <if condition="MODULE_NAME  eq 'Site' && ACTION_NAME eq 'index'">layui-nav-itemed</if>">
		      <a href="{:U('Site/index')}">
		        <i class="iconfont f18">&#xe633;</i><span class="menu-title">站点管理</span>
		      </a>
			</li>
			<li class="layui-nav-item <if condition="(MODULE_NAME  eq 'Keyword' && (ACTION_NAME eq 'index' OR ACTION_NAME eq 'unfreeze_list' OR ACTION_NAME=='search' )) OR (MODULE_NAME  eq 'Cart' && ACTION_NAME eq 'index')">layui-nav-itemed</if>">
		      <a href="javascript:;">
		        <i class="iconfont f18">&#xe631;</i><span class="menu-title">关键词管理</span>
		      <span class="layui-nav-more"></span></a>
		      <dl class="layui-nav-child">
		      	<dd <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'search'">class="layui-this"</if>><a href="{:U('Keyword/search')}">关键词查询</a></dd>
				  <dd <if condition="MODULE_NAME  eq 'Cart' && ACTION_NAME eq 'index'">class="layui-this"</if>><a href="{:U('Cart/index')}">关键词清单</a></dd>
				  <dd <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'index'">class="layui-this"</if>><a href="{:U('Keyword/index')}">关键词审核</a></dd>
				  <dd <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'unfreeze_list'">class="layui-this"</if>><a href="{:U('Keyword/unfreeze_list')}">关键词解冻</a></dd>
		      </dl>
			</li>
			</if>

			<li class="layui-nav-item <if condition="ACTION_NAME eq 'effect'">layui-nav-itemed</if>">
		      <a href="javascript:;">
		        <i class="iconfont f18">&#xe7b2;</i><span class="menu-title">效果监控</span>
		      <span class="layui-nav-more"></span></a>
		      <dl class="layui-nav-child">
		        <dd <if condition="MODULE_NAME  eq 'Site' && ACTION_NAME eq 'effect'">class="layui-this"</if>><a href="{:U('Site/effect')}">站点效果监测</a></dd>
				  <dd <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'effect'">class="layui-this"</if>><a href="/Manage/Keyword/effect/ord/latestranking/keyword//website//keywordstatus/%E4%BC%98%E5%8C%96%E4%B8%AD/standardstatus//searchengine//num_per_page/">关键词效果监测</a></dd>
		      </dl>
			</li>

		 </switch>
  		<else/>
		<!-- 产品首页 begin -->
		 	<li class="layui-nav-item layui-nav-itemed">
		      <a href="{:U('Keyword/effect')}">
		        <i class="iconfont f18">&#xe60a;</i><span class="menu-title">关键词效果监测</span>
		      </a>
		    </li>
		<!-- 产品首页  end -->
  		</neq>

		<!-- 排名差异 begin -->
		<if condition="$LoginUserInfo['usertype'] != 'operation'">
			<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'different'">layui-nav-itemed</if>">
				<a href="{:U('Keyword/different')}">
					<i class="iconfont f18">&#xe62c;</i><span class="menu-title">排名差异</span>
				</a>
	  </li>
	 
			<!-- 排名差异  end -->
			<li class="layui-nav-item <if condition="MODULE_NAME  eq 'OSReport'">layui-nav-itemed</if>">
				<a href="javascript:;"><i class="iconfont">&#xe6b2;</i>报表管理</a>
				<dl class="layui-nav-child">
					<!-- <dd <if condition="MODULE_NAME  eq 'OSReport' && ACTION_NAME eq 'matchPage'">class="layui-this"</if>>
						<a href="{:U('OSReport/matchPage')}">关键词核对报表</a>
					</dd> -->
					<dd <if condition="MODULE_NAME  eq 'OSReport' && ACTION_NAME eq 'cooperate_stop_today'">class="layui-this"</if>>
						<a href="{:U('OSReport/cooperate_stop_today')}">今日合作停关键词</a>
					</dd>
					<dd <if condition="MODULE_NAME  eq 'OSReport' && ACTION_NAME eq 'cooperate_stop_all'">class="layui-this"</if>>
						<a href="{:U('OSReport/cooperate_stop_all')}">全部合作停关键词</a>
					</dd>
					<dd <if condition="MODULE_NAME  eq 'OSReport' && ACTION_NAME eq 'new_keyword_today'">class="layui-this"</if>>
						<a href="{:U('OSReport/new_keyword_today')}">今日新增关键词</a>
					</dd>
					<!-- <dd <if condition="MODULE_NAME  eq 'OSReport' && ACTION_NAME eq 'keyword_compare'">class="layui-this"</if>>
						<a href="{:U('OSReport/keyword_compare')}">刷词后台比较</a>
					</dd> -->

					<!-- <dd <if condition="MODULE_NAME  eq 'QRReport'">class="layui-this"</if>>
						<a href="{:U('QRReport/index')}">效果报表</a>
					</dd> -->
				</dl>
	  </li>
	  </if>
		<!-- 排名匹配 begin -->
		<!--  <li class="layui-nav-item <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'matchPage'">layui-nav-itemed</if>">
          <a href="{:U('Keyword/matchPage')}">
            <i class="iconfont f18">&#xe62c;</i><span class="menu-title">排名匹配</span>
          </a>
        </li> -->
		<!-- 排名匹配  end -->

 	</ul>
</nav>
<!--menu 左侧菜单 end-->

<script>
layui.use(['element'], function(){


});
</script>