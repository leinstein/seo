menu 左侧菜单 begin-->
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
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Index' && ACTION_NAME eq 'index'">layui-nav-itemed</if>">
			<a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品概况</a>
		</li>
		
		<switch name="LoginUserInfo['usertype']" >
			<case value="customer_manager" break="0"></case><!-- 客服经理 -->
			<case value="customer"><!-- 客服 -->
				<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Site' && ACTION_NAME eq 'index'">layui-nav-itemed</if>">
			      <a href="{:U('Site/index')}">
			        <i class="iconfont f18">&#xe633;</i><span class="menu-title">站点管理</span>
			      </a>
			    </li>
				
			</case>
		 	<default />
		 	</switch>
			
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Site' && ACTION_NAME eq 'effect'">layui-nav-itemed</if>">
			<a href="{:U('Site/effect')}"><i class="iconfont">&#xe76a;</i>站点监控</a>
		</li>

		<!-- 关键词管理 begin -->
		<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Keyword'">layui-nav-itemed</if>">
			<a href="javascript:;"><i class="iconfont">&#xe699;</i>关键词管理</a>

			<dl class="layui-nav-child">
				<dd <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'search'">class="layui-this"</if>>
					<a href="{:U('Keyword/search')}">关键词查询</a>
				</dd>
				<dd <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'effect'">class="layui-this"</if>>
					<a href="{:U('Keyword/effect')}">关键词排名</a>
				</dd>
				
			</dl>
		</li>
		<!-- 关键词管理 end -->
	</ul>
	
</nav>
<!--menu 左侧菜单 end