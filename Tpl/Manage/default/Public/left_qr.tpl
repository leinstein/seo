<!--menu 左侧菜单 begin-->
<nav class="ui-menu">
	<ul class="layui-nav layui-nav-tree" lay-filter="menu">
		
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'QRIndex'">layui-nav-itemed</if>">
			<a href="{:U('QRIndex/index')}"><i class="iconfont">&#xe60a;</i>产品首页</a>
		</li>
		
		<!-- <li class="layui-nav-item <if condition="MODULE_NAME  eq 'QRIndex' && ACTION_NAME eq 'epinfo'">layui-nav-itemed</if>">
			<a href="{:U('QRIndex/epinfo')}"><i class="iconfont">&#xe633;</i>企业资料</a>
		</li> -->
		
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'QRPlan'">layui-nav-itemed</if>">
			<a href="{:U('QRPlan/index')}"><i class="iconfont">&#xe696;</i>计划管理</a>
		</li>

		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'QRKeyword'">layui-nav-itemed</if>">
			<a href="javascript:;"><i class="iconfont">&#xe631;</i>关键词管理</a>
			<dl class="layui-nav-child">
				<dd <if condition="MODULE_NAME  eq 'QRKeyword' && ACTION_NAME eq 'index'">class="layui-this"</if>>
					<a href="{:U('QRKeyword/index')}">关键词清单</a>
				</dd>
				<dd <if condition="MODULE_NAME  eq 'QRKeyword' && ACTION_NAME eq 'effect'">class="layui-this"</if>>
					<a href="{:U('QRKeyword/effect')}">关键词效果</a>
				</dd>
				<!-- <dd <if condition="MODULE_NAME  eq 'QRReport'">class="layui-this"</if>>
					<a href="{:U('QRReport/index')}">效果报表</a>
				</dd> -->
			</dl>
		</li>
		
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'QRReport'">layui-nav-itemed</if>">
			<a href="{:U('QRReport/index')}"><i class="iconfont">&#xe7b2;</i>报表管理</a>
		</li>
		
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'QRUser'">layui-nav-itemed</if>">
			<a href="{:U('QRUser/index')}"><i class="iconfont">&#xe62f;</i>用户管理</a>
		</li>
	
		<!-- <li class="layui-nav-item <if condition="MODULE_NAME  eq 'QRFinance'">layui-nav-itemed</if>">
			<a href="{:U('QRFinance/index')}"><i class="iconfont">&#xe623;</i>财务管理</a>
		</li> -->
	
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





