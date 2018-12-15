<!--menu 左侧菜单 begin-->
<nav class="ui-menu">
	<ul class="layui-nav layui-nav-tree" lay-filter="menu">
		
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Index' && ACTION_NAME eq 'index'">layui-nav-itemed</if>">
			<a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品概况</a>
		</li>
		
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Site' && ACTION_NAME eq 'index'">layui-nav-itemed</if>">
			<a href="{:U('Site/index')}"><i class="iconfont">&#xe633;</i>我的站点<gt name="untreated_workorder_num" value="0"><span class="badge">{$untreated_workorder_num}</span></gt></a>
		</li>
		

		<li class="layui-nav-item <if condition="( MODULE_NAME  eq 'Keyword' && (ACTION_NAME eq 'search' || ACTION_NAME eq 'effect' ) ) OR ( MODULE_NAME  eq 'Cart' && ACTION_NAME eq 'index') || (MODULE_NAME  eq 'Site' && ACTION_NAME eq 'effect'  )">layui-nav-itemed</if>">
			<a href="javascript:;"><i class="iconfont">&#xe612;</i>优化中心</a>
			<dl class="layui-nav-child">
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





