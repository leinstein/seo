<!--menu 左侧菜单 begin-->
<nav class="ui-menu">
	<ul class="layui-nav layui-nav-tree" lay-filter="menu">
		
		<li class="layui-nav-item <if condition="(MODULE_NAME  eq 'Workorder' && ACTION_NAME eq 'index') OR (MODULE_NAME  eq 'Remark' && ACTION_NAME eq 'index')">layui-nav-itemed</if>">
			<a href="{:U('index')}"><i class="iconfont">&#xe60a;</i>首页</a>
		</li>
		
		<!-- <li class="layui-nav-item <if condition="MODULE_NAME  eq 'QREpinfo' && ACTION_NAME eq 'index'">layui-nav-itemed</if>">
			<a href="{:U('QREpinfo/index')}"><i class="iconfont">&#xe6c5;</i>企业资料</a>
		</li>
		

		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'QRKeyword' || MODULE_NAME  eq 'QRPlan' || MODULE_NAME  eq 'QRReport'">layui-nav-itemed</if>">
			<a href="javascript:;"><i class="iconfont">&#xe631;</i>关键词管理</a>
			<dl class="layui-nav-child">
				<dd <if condition="MODULE_NAME  eq 'QRPlan' && ACTION_NAME eq 'index'">class="layui-this"</if>>
					<a href="{:U('QRPlan/index')}">计划管理</a>
				</dd>
				<dd <if condition="MODULE_NAME  eq 'QRKeyword' && ACTION_NAME eq 'index'">class="layui-this"</if>>
					<a href="{:U('QRKeyword/index')}">关键词管理</a>
				</dd>
				<dd <if condition="MODULE_NAME  eq 'QRReport' && ACTION_NAME eq 'index'">class="layui-this"</if>>
					<a href="{:U('QRReport/index')}">效果报表</a>
				</dd>
			</dl>
		</li>
	
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'DRFinance' && ACTION_NAME eq 'index'">layui-nav-itemed</if>">
			<a href="{:U('DRFinance/index')}"><i class="iconfont">&#xe623;</i>财务管理</a>
		</li>
	 -->
	</ul>
	
</nav>
<!--menu 左侧菜单 end-->
<script type="text/javascript">
 /*  layui.use(['element'], function () {
    var element = layui.element
    
    window.$ = layui.jquery;
    // 监听导航点击
    element.on('nav(menu)', function (elem) {
      var mUrl = elem.attr('dx-menu');
      !_.isEmpty(mUrl) && _route.go(mUrl);
    });
  }); */
</script>





