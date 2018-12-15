<!-- 应用图标列表 begin -->
<div class="weui-panel my-business ">
	<div class="weui-grids">
	
		<!-- 产品 begin -->
		<volist name="sys_products" id="vo">
		<a href="{:U($vo['entry_code'])}" class="weui-grid js_grid" style="background: {$vo['miconcolor']}">
			<div class="weui-grid__icon">
				<i class="iconfont">{$vo['menuicon']}</i>
			</div>
			<p class="weui-grid__label">{$vo['product_name']}</p>
		</a>
		</volist>
		<!-- 产品 end -->

		<!-- 用户管理 begin -->
		<eq name="is_show_user" value="1">
		<a href="{:U('UserManagement/index')}" class="weui-grid js_grid" style="background: #ED5434">
			<div class="weui-grid__icon">
				<i class="iconfont">&#xe726;</i>
			</div>
			<p class="weui-grid__label">用户管理</p>
		</a> 
		</eq>
		<!-- 用户管理 end -->
		
		<!-- 财务管理 begin -->
		<eq name="is_show_finance" value="1">
		<a href="{:U('Finance/pool')}" class="weui-grid js_grid" style="background: #1FB6BD">
			<div class="weui-grid__icon">
				<i class="iconfont">&#xe702;</i>
			</div>
			<p class="weui-grid__label">财务管理</p>
		</a> 
		</eq>
		<!-- 财务管理 end -->
		
		
		
		<!-- 用户管理 begin -->
		<!-- <a href="{:U('UserManagement/sub_agent_list')}" class="weui-grid js_grid" style="background: #ED5434">
			<div class="weui-grid__icon">
				<i class="iconfont">&#xe643;</i>
			</div>
			<p class="weui-grid__label">用户管理</p>
		</a>  -->
		<!-- 用户管理 end -->
		
		<!-- 用户管理 begin -->
		<!-- <a href="{:U('UserManagement/sub_agent_list')}" class="weui-grid js_grid" style="background: #475C9F">
			<div class="weui-grid__icon">
				<i class="iconfont">&#xe643;</i>
			</div>
			<p class="weui-grid__label">用户管理</p>
		</a>  -->
		<!-- 用户管理 end -->
		
		<!-- 用户管理 begin -->
		<!-- <a href="{:U('UserManagement/sub_agent_list')}" class="weui-grid js_grid" style="background: #F48221">
			<div class="weui-grid__icon">
				<i class="iconfont">&#xe643;</i>
			</div>
			<p class="weui-grid__label">用户管理</p>
		</a>  -->
		<!-- 用户管理 end -->
		
		<!-- 工单 begin -->
		<a href="{:U('Workorder/index')}" class="weui-grid js_grid" style="background: #4fb3a4">
			<div class="weui-grid__icon">
				<i class="iconfont">&#xe643;</i>
			</div>
			<p class="weui-grid__label">工单</p>
		</a> 
		<!-- 工单 end -->
		
		
		<!-- 常见问题 begin -->
		<a href="{:U('Question/index')}" class="weui-grid js_grid" style="background: #f5b977">
			<div class="weui-grid__icon">
				<i class="iconfont">&#xe6a3;</i>
			</div>
			<p class="weui-grid__label">常见问题</p>
		</a>
		<!-- 常见问题 end -->
		
		<!-- 代理商OE设置 begin -->
		<eq name="me.isopen_oem" value="1">
		<!-- <a href="{:U('System/index')}" class="weui-grid js_grid" style="background: #F48221">
			<div class="weui-grid__icon">
				<i class="iconfont">&#xe7e0;</i>
			</div>
			<p class="weui-grid__label">系统设置</p>
		</a> -->
		</eq>
		<!-- 代理商OE设置 end -->
		
		
		
		<!-- 系统公告 begin -->
		<a href="{:U('News/index')}" class="weui-grid js_grid" style="background: #CD814D">
			<div class="weui-grid__icon">
				<i class="iconfont">&#xe6bc;</i>
			</div>
			<p class="weui-grid__label">系统公告</p>
		</a>
		<!-- 系统公告 end -->
		
		<!-- 消息提醒 begin -->
		<a href="{:U('Notify/index')}" class="weui-grid js_grid" style="background: #B667E6">
			<div class="weui-grid__icon">
				<i class="iconfont">&#xe6ba;</i>
			</div>
			<p class="weui-grid__label">消息提醒</p>
		</a>
		<!-- 消息提醒 end -->
		
		<!-- 账号管理  begin -->
		<a href="{:U('User/updatePage')}" class="weui-grid js_grid" style="background: #475C9F">
			<div class="weui-grid__icon">
				<i class="iconfont">&#xe66a;</i>
			</div>
			<p class="weui-grid__label">账号管理</p>
		</a>
		<!-- 账号管理  end -->
		
	</div>
</div>

<!-- 应用图标列表 end -->