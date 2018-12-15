<!--menu 左侧菜单 begin-->
<nav class="ui-menu">
	<ul class="layui-nav layui-nav-tree" lay-filter="menu">
		
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Home' && ACTION_NAME eq 'home'">layui-nav-itemed</if>">
			<a href="{:U('Service/Home/home')}"><i class="iconfont">&#xe60a;</i>我的桌面</a>
		</li>
		
		

		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Index' && ACTION_NAME eq 'index'">layui-nav-itemed</if>">
			<a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>效果监控</a>
		</li>
		
		
		

		<li class="layui-nav-item <if condition="( MODULE_NAME  eq 'Keyword' && (ACTION_NAME eq 'search' || ACTION_NAME eq 'effect' ) ) OR ( MODULE_NAME  eq 'Cart' && ACTION_NAME eq 'index') || (MODULE_NAME  eq 'Site' && ACTION_NAME eq 'effect'  ) || (MODULE_NAME  eq 'Site' && ACTION_NAME eq 'index'  )">layui-nav-itemed</if>">
			<a href="javascript:;"><i class="iconfont">&#xe612;</i>优化中心</a>
			<dl class="layui-nav-child">
				<dd <if condition="MODULE_NAME  eq 'Site' && ACTION_NAME eq 'index'">class="layui-this"</if>>
					<a href="{:U('Site/index')}">我的站点<gt name="untreated_workorder_num" value="0"><span class="badge">{$untreated_workorder_num}</span></gt></a>
				</dd>
				<dd <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'search'">class="layui-this"</if>>
					<a href="{:U('Keyword/search')}">关键词查询</a>
				</dd>
				<dd <if condition="MODULE_NAME  eq 'Cart' && ACTION_NAME eq 'index'">class="layui-this"</if>>
					<a href="{:U('Cart/index')}">关键词清单</a>
				</dd>
				<dd <if condition="MODULE_NAME  eq 'Site' && ACTION_NAME eq 'effect'">class="layui-this"</if>>
					<a href="{:U('Site/effect')}">站点监控</a>
				</dd>
				<dd <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'effect'">class="layui-this"</if>>
					<a href="{:U('Keyword/effect')}">关键词排名</a>
				</dd>
			</dl>
		</li>
		
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Finance'">layui-nav-itemed</if>">
			<a href="javascript:;"><i class="iconfont">&#xe63d;</i>我的钱包</a>
			<dl class="layui-nav-child">
				<dd <if condition="MODULE_NAME  eq 'Finance' && ACTION_NAME eq 'pool'">class="layui-this"</if>>
					<a href="{:U('Finance/pool')}">资金池管理</a>
				</dd>
				<dd <if condition="MODULE_NAME  eq 'Finance' && ACTION_NAME eq 'details'">class="layui-this"</if>>
					<a href="{:U('Finance/details')}">财务明细</a>
				</dd>
			</dl>
				</li>
	
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'User'">layui-nav-itemed</if>">
			<a href="javascript:;"><i class="iconfont">&#xe66a;</i>安全中心</a>
			<dl class="layui-nav-child">
				
				<dd <if condition="MODULE_NAME  eq 'User' && ACTION_NAME eq 'updatePage'">class="layui-this"</if>>
					<a href="{:U('User/updatePage')}">基本信息</a>
				</dd>
				<dd <if condition="MODULE_NAME  eq 'User' && ACTION_NAME eq 'updatePasswordPage'">class="layui-this"</if>>
					<a href="{:U('User/updatePasswordPage')}">修改密码</a>
				</dd>
			</dl>
		</li>

	</ul>
	
</nav>
<!--menu 左侧菜单 end-->
<script type="text/javascript">
  layui.use(['element'], function () {
    var element = layui.element
    
    window.$ = layui.jquery;
    // 监听导航点击
    element.on('nav(menu)', function (elem) {
      var mUrl = elem.attr('dx-menu');
      !_.isEmpty(mUrl) && _route.go(mUrl);
    });
  });
</script>





