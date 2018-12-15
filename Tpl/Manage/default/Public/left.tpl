<!--menu 左侧菜单 begin-->
<nav class="ui-menu">
  <ul class="layui-nav layui-nav-tree" lay-filter="menu">
  		<neq name="LoginUserName" value="排名统计">
  		<!-- 产品首页 begin -->
	 	<li class="layui-nav-item <if condition="MODULE_NAME  eq 'Index' && ACTION_NAME eq 'index'">layui-nav-itemed</if>">
	      <a href="{:U('Index/index')}">
	        <i class="iconfont f18">&#xe60a;</i><span class="menu-title">产品首页</span>
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
		        <dd <if condition="MODULE_NAME  eq 'Keyword' && ACTION_NAME eq 'effect'">class="layui-this"</if>><a href="{:U('Keyword/effect')}">关键词效果监测</a></dd>
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
	  <neq name="LoginUserInfo.usertype" value="operation">
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
	  </neq>
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