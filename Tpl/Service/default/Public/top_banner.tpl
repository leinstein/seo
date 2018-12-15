
<!-- header -->
<div class="ui-header">
	<php>
    load("@.file");
    $logo_path = get_download_url($LoginUserInfo['oem_config']['logo_image_arr']['fileid']);
    </php>
	<div class="ui-header-logo fl">
    	<!--<a class="logo" href="{:U('Service/Home/home')}">
        <img src="{$logo_path|default='__PUBLIC__/img/logo-white.png'}" alt="">
      	</a>-->
	<div style="font-size:25px;text-align:center;line-height:63px;font-weight:bold;color:#fff;"><i class="iconfont">&#xe62f;</i> {$LoginUserInfo['role_info']['rolename']}</div>
	</div>
	<div class="ui-header-main ta_r">
		<!-- <div class="menu-control-outer fl">
			<a href="#a_null" id="menuControl" class="menu-collapse-control" title="折叠菜单">
			</a>
		</div> -->
		<ul class="layui-nav header-link fr">
		  <li class="layui-nav-item">
		    <a href="javascript:;" title="{$LoginUserName}">欢迎您，{$LoginUserName|title_show}</a>
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
				$home_arra = array('Home','User');
			</php>
			<a href="{:U('Service/Home/home')}" class="header-link <if condition="in_array(MODULE_NAME,$home_arra)">actived</if>">
				<i class="iconfont">&#xe671;</i>首页
			</a>
			
			<!-- 系统产品 begin -->
			<volist name="sys_products" id="vo">
				<a href="{:U($vo['entry_code'])}" class="header-link <if condition="in_array(MODULE_NAME,$vo['module_name_arra'][GROUP_NAME])">actived</if>">
					<i class="iconfont">{$vo['menuicon']}</i>{$vo['product_name']}
				</a>
			</volist>
			<!-- 系统产品 end -->

			<a href="{:U('Service/Workorder/index')}"  class="header-link <if condition="MODULE_NAME == 'Workorder'">actived</if>">
				<i class="iconfont">&#xe6aa;</i>工单<gt name="untreated_workorder_num" value="0"><span class="badge">{$untreated_workorder_num}</span></gt>
			</a>
			<a href="{:U('Service/Question/index')}"  class="header-link <if condition="MODULE_NAME == 'Question'">actived</if>">
				<i class="iconfont">&#xe64c;</i>常见问题
			</a>
			
		</div>
		
	</div>
</div>
<!-- header end-->
	

<script>
layui.use(['element'], function(){
  var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
});
</script>