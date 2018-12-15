
	<!-- header -->
	<div class="ui-header">
		<div class="ui-header-logo fl">
			<eq name="LoginUserInfo['usertype']" value="seller">
	      	<a class="logo" href="{:U('Manage/Home/home')}">
	        <img src="__PUBLIC__/img/logo-white.png">
	      	</a>
	    <else/>
	    	<a class="logo" href="{:U('Manage/Home/home')}">
	        <img src="__PUBLIC__/img/logo-white.png">
	      	</a>
	    </eq>

	    <div style="font-size:15px;text-align:center;line-height:63px;font-weight:bold;color:#fff;"><i class="iconfont">&#xe62f;</i> {$LoginUserInfo['role_info']['rolename']}</div>
		</div>
		<div class="ui-header-main ta_r">
			<!-- <div class="menu-control-outer fl">
				<a href="#a_null" id="menuControl" class="menu-collapse-control" title="折叠菜单">
				</a>
			</div> -->
			<ul class="layui-nav header-link fr">
			  <li class="layui-nav-item">
			    <a href="javascript:;">欢迎您，{$LoginUserName}</a>
			    <dl class="layui-nav-child">
			      <dd><a href="{:U('User/updatePage')}">账号信息</a></dd>
			      <dd><a href="{:U('User/updatePasswordPage')}">密码修改</a></dd>
			      <dd><a href="{:U('Index/logOut')}">安全退出</a></dd>
			    </dl>
			  </li>
			</ul> 
			
			
			<div class="fl">
				
				<php>
					// 定义首页MODULE_NAME集合
					$home_arra = array('Home','User','Finance','System','UserManagement','News','SysPermission');
					// 定义优站宝MODULE_NAME集合
					$os_arra = array('Index','Site','Keyword','Cart','OSReport');
					// 定义快排宝MODULE_NAME集合
					$qr_arra = array('QRIndex','QRKeyword','QRPlan','QREpinfo','QRReport');
				</php>
				<neq name="LoginUserName" value="排名统计">
					<a href="{:U('Manage/Home/home')}" class="header-link <if condition="in_array(MODULE_NAME,$home_arra)">actived</if>">
						<i class="iconfont">&#xe671;</i>首页
					</a>
				</neq>
				
				<!-- 系统产品 begin -->
				<volist name="sys_products" id="vo">
					<a href="{:U($vo['entry_code'])}" class="header-link <if condition="in_array(MODULE_NAME,$vo['module_name_arra'][GROUP_NAME])">actived</if>">
						<i class="iconfont">{$vo['menuicon']}</i>{$vo['product_name']}
					</a>
				</volist>
				<!-- 系统产品 end -->
				
				<neq name="LoginUserName" value="排名统计">
					<a href="{:U('Manage/Workorder/index')}"  class="header-link <if condition="MODULE_NAME == 'Workorder'">actived</if>">
						<i class="iconfont">&#xe6aa;</i>工单<gt name="untreated_workorder_num" value="0"><span class="badge">{$untreated_workorder_num}</span></gt>
					</a>
					<a href="{:U('Manage/Remark/index')}"  class="header-link <if condition="MODULE_NAME == 'Remark'">actived</if>">
						<i class="iconfont">&#xe64d;</i>日志
					</a>
					<!-- <a href="{:U('Manage/Question/index')}"  class="header-link <if condition="MODULE_NAME == 'Question'">actived</if>">
						<i class="iconfont">&#xe64c;</i>常见问题
					</a> -->
					
				</neq>
				<b style="color:#F7B824;margin-left:10px;"> 米同营销，让营销更专业</b>
				
			</div>
		</div>
	</div>
	<!-- header end-->
	
	<script>
layui.use(['element'], function(){
  var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
});
</script>