<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title><?php echo (($page_title)?($page_title):"米同营销搜索营销管理后台"); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<meta name="description" content="mitong">
<meta name="author" content="mitong">


<script type="text/javascript">
<!--
	var ROOT      		= '__ROOT__';
  	var URL       		= '__URL__';
  	var APP       		= '__APP__';
  	var GROUP 			= '__GROUP__';
  	var ACTION_NAME   	= '<?php echo ACTION_NAME; ?>';
  	var MODULE_NAME   	= '<?php echo MODULE_NAME; ?>';
  	var PUBLIC      	= '__PUBLIC__';
  	var APP_PUBLIC    	= '../Public/';
  	var CURL      		= '<?php echo ($CURRENT_URL); ?>';
  	var PREURL      	= '<?php echo ($PRE_URL); ?>';
  
//-->
</script>

<!-- HTML5 for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="__PUBLIC__/js/html5shiv.js"></script>
<![endif]-->

<!-- ================================= load js begin =================================> -->
<!-- 引入jQuery -->
<script type="text/javascript" src="__PUBLIC__/js/jquery/jquery.1.10.2.min.js"></script>
<!-- 引入 layer 框架  -->
<script type="text/javascript" src="__PUBLIC__/js/layui/layui.js"></script>
<!-- underscore工具库   -->
<script type="text/javascript" src="__PUBLIC__/js/underscore/underscore-min.js"></script>
<!-- 系统公共js  -->
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>


<!-- ================================= load css begin =================================> -->
<!-- 引入bootstrap css -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css?v=v3.3.7">
<!-- 引入 layui css -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/layui/css/layui.css?v=1.0.9">
<!-- 引入系统  css -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/demo3.css" type="text/css">
<!-- 引入图标字体  css -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/iconfont/iconfont.css?v=1.0.0" media="all">
<!-- 引入通用样式 css-->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/common.css">
<!-- 引入通用缩写样式 css-->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/short.css">
<!-- 引入重写样式 -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/reset.css" >
<!-- 引入重写样式 -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/reset-layui.css" >
<script type="text/javascript">
//隐藏父页面的加载进度层
// $('#loading_iframe', parent.document).show();
</script>

<!-- 自定义正则验证js  -->
<script src="__PUBLIC__/js/regular.js"></script>

<script type="text/javascript">
$(function() {
	layui.use(['form'], function(){
	  var form = layui.form;
	  
	  //自定义验证规则
	  form.verify({
		 /*  my_mobile: function(value){
	      	if( $.trim( value ) && !verifyMobile( value ) ){
	        	return '手机号格式不正确';
	      	}
	      }, */
	      my_phone: function(value){
		      if( $.trim( value ) && !verifyTel( value ) && !verifyMobile( value ) ){
		        return '客服电话格式不正确';
		     }
		  },
		  verifyQQ: function(value){
		      if( $.trim( value ) && !verifyQQ( value ) ){
			        return '客服QQ格式不正确';
			     }
			  },
	  });

	
	  //监听提交
	  form.on('submit(go)', function(data){
	    
	  });
	  
	}); 
}); 

layui.use(['layedit'], function(){
	  var layedit = layui.layedit;
	  
	  //构建一个默认的编辑器
	  //var index = layedit.build('layer_textarea');
	  //var index = layedit.build('layer_textarea', {
		   // tool: ['strong','italic','underline','del', '|', 'left', 'center', 'right', '|','face', 'link', 'unlink']
		//});
	  
	  layedit.set({
		  uploadImage: {
		    url: "<?php echo U('Upload/doUpload1');?>" //接口url
		    ,type: '' //默认post
		  }
		});
		//注意：layedit.set 一定要放在 build 前面，否则配置全局接口将无效。
		layedit.build('layer_textarea',{
			
			height:500
		}); //建立编辑器
	  //编辑器外部操作
	 /*  var active = {
	    content: function(){
	      alert(layedit.getContent(index)); //获取编辑器内容
	    }
	    ,text: function(){
	      alert(layedit.getText(index)); //获取编辑器纯文本内容
	    }
	    ,selection: function(){
	      alert(layedit.getSelection(index));
	    }
	  };
	  
	  $('.site-demo-layedit').on('click', function(){
	    var type = $(this).data('type');
	    active[type] ? active[type].call(this) : '';
	  });
	   */
	});
	
</script>
<!-- 引入上传组件标签库 begin -->

<!-- 引入上传组件标签库 end -->
<!-- 引入上传组件js和css文件 begin -->
<script type="text/javascript" src="__PUBLIC__/js/upload/upload.js"></script><link rel="stylesheet" href="__PUBLIC__/css/upload/upload.css"/>
<!-- 引入上传组件js和css文件 end-->

</head>
<body>
    <!-- 页面顶部 logo & 菜单 begin -->
    
<!-- header -->
<div class="ui-header">
	<?php load("@.file"); $logo_path = get_download_url($LoginUserInfo['oem_config']['logo_image_arr']['fileid']); ?>
	<div class="ui-header-logo fl">
    	<!-- <a class="logo" href="<?php echo U('Agent/Home/home');?>">
        <img src="<?php echo (($logo_path)?($logo_path):'__PUBLIC__/img/logo-white.png'); ?>" alt="">
      	</a> -->
	<div style="font-size:25px;text-align:center;line-height:63px;font-weight:bold;color:#fff;"><i class="iconfont">&#xe62f;</i>		<?php if($LoginUserName == '上海潮牛'): ?>潮牛网络
			<?php else: ?>
            <?php echo (title_show($LoginUserName)); endif; ?></div>
	</div>
	<div class="ui-header-main ta_r">
		<!-- <div class="menu-control-outer fl">
			<a href="#a_null" id="menuControl" class="menu-collapse-control" title="折叠菜单">
			</a>
		</div> -->
		<ul class="layui-nav header-link fr">
		  <li class="layui-nav-item">
		    <a href="javascript:;" title="<?php echo ($LoginUserName); ?>">欢迎您，<?php echo (title_show($LoginUserName)); ?></a>
		    <dl class="layui-nav-child">
		      <dd><a href="<?php echo U('User/updatePage');?>">账号信息</a></dd>
		      <dd><a href="<?php echo U('User/updatePasswordPage');?>">密码修改</a></dd>
		      <dd><a href="<?php echo U('Index/logOut');?>">安全退出</a></dd>
		    </dl>
		  </li>
		</ul>


		<div class="fl">
			<?php  $home_arra = array('Home','User','UserManagement','Finance','SysPermission'); ?>

			<a href="<?php echo U('Agent/Home/home');?>" class="header-link <?php if(in_array(MODULE_NAME,$home_arra)): ?>actived<?php endif; ?>">
				<i class="iconfont">&#xe671;</i>首页
			</a>

			<!-- 系统产品 begin -->
			<?php if(is_array($sys_products)): $i = 0; $__LIST__ = $sys_products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['entry_code']);?>" class="header-link <?php if(in_array(MODULE_NAME,$vo['module_name_arra'][GROUP_NAME])): ?>actived<?php endif; ?>">
					<i class="iconfont"><?php echo ($vo['menuicon']); ?></i><?php echo ($vo['product_name']); ?>
				</a><?php endforeach; endif; else: echo "" ;endif; ?>


			<!-- 系统产品 end -->

			<a href="<?php echo U('Agent/Workorder/index');?>"  class="header-link <?php if(MODULE_NAME == 'Workorder'): ?>actived<?php endif; ?>">
				<i class="iconfont">&#xe6aa;</i>工单<?php if(($untreated_workorder_num) > "0"): ?><span class="badge"><?php echo ($untreated_workorder_num); ?></span><?php endif; ?>
			</a>
			<a href="<?php echo U('Agent/Question/index');?>"  class="header-link <?php if(MODULE_NAME == 'Question'): ?>actived<?php endif; ?>">
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
    <!-- 页面顶部 logo & 菜单 end -->
    <!-- 页面左侧菜单 begin -->
    <!--menu 左侧菜单 begin-->
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

		<!-- 产品概况 begin -->
		<li class="layui-nav-item <?php if(MODULE_NAME == 'Home' && ACTION_NAME == 'home'): ?>layui-nav-itemed<?php endif; ?>">
			<a href="<?php echo U('Home/home');?>"><i class="iconfont">&#xe60a;</i>我的桌面</a>
		</li>
		<!-- 产品概况 end -->

		<!-- 用户管理 begin -->
		<li class="layui-nav-item <?php if(MODULE_NAME == 'UserManagement'): ?>layui-nav-itemed<?php endif; ?>">
			<a href="javascript:;"><i class="iconfont">&#xe62f;</i>我的用户</a>
			<dl class="layui-nav-child">
			
				<!-- 只有开通了二级代理的权限才能显示子代理的菜单 begin -->
				<?php if(($LoginUserInfo["isopen_subagent"]) == "1"): ?><dd <?php if(MODULE_NAME == 'UserManagement' && ACTION_NAME == 'sub_agent_list'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('UserManagement/sub_agent_list');?>">子代理列表</a>
				</dd><?php endif; ?>
				<!-- 只有开通了二级代理的权限才能显示子代理的菜单 end -->
				<dd <?php if(MODULE_NAME == 'UserManagement' && ACTION_NAME == 'sub_user_list'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('UserManagement/sub_user_list');?>">子用户列表</a>
				</dd>
			</dl>
		</li>
		<!-- 用户管理 end -->

		<?php switch($LoginUserInfo['usertype']): case "sales_manager": ?><!-- 销售经理 -->
			<?php case "customer_manager": ?><!--客服经理 -->
		 
		 	<!-- 员工管理 begin -->
		    <li class="layui-nav-item <?php if(MODULE_NAME == 'SysPermission'): ?>layui-nav-itemed<?php endif; ?>">
		    	<a href="<?php echo U('SysPermission/staff');?>">
					<i class="iconfont">&#xe629;</i>员工管理
				</a>
		    </li>
			<!-- 员工管理 end --><?php break;?>
		 	<?php case "seller": ?><!-- 销售 --><?php break;?>
		 	<?php case "customer": ?><!-- 客服 --><?php break;?>
		 	<?php default: ?>

				<!-- 财务管理 begin -->
			 	<li class="layui-nav-item <?php if(MODULE_NAME == 'Finance'): ?>layui-nav-itemed<?php endif; ?>">
					<a href="javascript:;"><i class="iconfont">&#xe63d;</i>我的钱包</a>
					<dl class="layui-nav-child">
						<dd <?php if(MODULE_NAME == 'Finance' && ACTION_NAME == 'pool'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('Finance/pool');?>">资金池管理</a>
						</dd>
						<dd <?php if(MODULE_NAME == 'Finance' && ACTION_NAME == 'details'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('Finance/details');?>">财务明细</a>
						</dd>
						<!-- 只有开通了二级代理的权限才能显示子代理的菜单 begin -->
						<?php if(($LoginUserInfo["isopen_subagent"]) == "1"): ?><dd <?php if(MODULE_NAME == 'Finance' && ACTION_NAME == 'sub_agent_list'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('Finance/sub_agent_list');?>">子代理充值</a>
						</dd><?php endif; ?>
						<dd <?php if(MODULE_NAME == 'Finance' && ACTION_NAME == 'sub_user_list'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('Finance/sub_user_list');?>">子用户充值</a>
						</dd>
					</dl>
				</li>
				<!-- 财务管理 end -->

				<!-- 系统设置 begin -->
				<?php if(($LoginUserInfo["isopen_oem"]) == "1"): ?><li class="layui-nav-item <?php if( ( MODULE_NAME == 'System') OR ( MODULE_NAME == 'News') ): ?>layui-nav-itemed<?php endif; ?>">
					<a href="javascript:;"><i class="iconfont">&#xe7e0;</i>系统设置</a>
					<dl class="layui-nav-child">
						<dd <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'index'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('System/index');?>">基础设置</a>
						</dd>
						<dd <?php if(MODULE_NAME == 'News' && ACTION_NAME == 'maintainPage' && $_GET['newstype'] == 'notice'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('News/maintainPage');?>/newstype/notice">维护公告</a>
						</dd>
						<dd <?php if(MODULE_NAME == 'News' && ACTION_NAME == 'maintainPage' && $_GET['newstype'] == 'protocol'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('News/maintainPage');?>/newstype/protocol">维护协议</a>
						</dd>
						<dd <?php if(MODULE_NAME == 'News' && ACTION_NAME == 'insertPage'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('News/insertPage');?>">添加通知</a>
						</dd>
						<!-- <dd <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'insertNoticePage'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('System/insertNoticePage');?>">添加公告</a>
						</dd>
						<dd <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'insertProtocolPage'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('System/insertProtocolPage');?>">添加协议</a>
						</dd> -->
						<dd <?php if(MODULE_NAME == 'News' && ACTION_NAME == 'publist'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('News/publist');?>">发布列表</a>
						</dd>
					</dl>
				</li><?php endif; ?>
				<!-- 系统设置 end -->

				<!-- 权限管理 begin -->
				<li class="layui-nav-item <?php if(MODULE_NAME == 'SysPermission' ): ?>layui-nav-itemed<?php endif; ?>">
					<a href="javascript:;"><i class="iconfont">&#xe6c2;</i>角色管理</a>
					<dl class="layui-nav-child">
						<!-- <dd <?php if(MODULE_NAME == 'SysPermission' && ACTION_NAME == 'department'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('SysPermission/department');?>">角色管理</a>
						</dd> -->
						
						<dd <?php if(MODULE_NAME == 'SysPermission' && ACTION_NAME == 'staff'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('SysPermission/staff');?>">员工管理</a>
						</dd>
						<!-- <dd <?php if(MODULE_NAME == 'SysPermission' && ACTION_NAME == 'role'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('SysPermission/role');?>">角色管理</a>
						</dd> -->
						<!-- <dd <?php if(MODULE_NAME == 'SysPermission' && ACTION_NAME == 'staff'): ?>class="layui-this"<?php endif; ?>>
							<a href="<?php echo U('SysPermission/staff');?>">员工管理</a>
						</dd> -->
					</dl>
				</li>
				<!-- 权限管理 end --><?php endswitch;?>

		<!-- 账号管理 begin -->
		<li class="layui-nav-item <?php if(MODULE_NAME == 'User'): ?>layui-nav-itemed<?php endif; ?>">
			<a href="javascript:;"><i class="iconfont">&#xe66a;</i>安全中心</a>
			<dl class="layui-nav-child">
				<!-- <dd>
				<a href="<?php echo U('User/index');?>">个人中心</a>
				</dd> -->
				<dd <?php if(MODULE_NAME == 'User' && ACTION_NAME == 'updatePage'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('User/updatePage');?>">基本信息</a>
				</dd>
				<dd <?php if(MODULE_NAME == 'User' && ACTION_NAME == 'updatePasswordPage'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('User/updatePasswordPage');?>">修改密码</a>
				</dd>
			</dl>
		</li>
		<!-- 账号管理 end -->








	
		
		
		
			
		
		<!-- <li class="layui-nav-item <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'effect'): ?>layui-nav-itemed<?php endif; ?>">
			<a href="<?php echo U('Keyword/effect');?>"><i class="iconfont">&#xe699;</i>关键词排名</a>
		</li> -->
		
		
		
		
		
		
		
	</ul>
	
</nav>
<!--menu 左侧菜单 end -->
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
        
		<!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="<?php echo U('Index/index');?>"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>系统基本配置</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        
        <div class="ui-content" id="ui-content">
            <div class="ui-panel">	            
	           	<form class="layui-form" name="update_form" action="__URL__/update" enctype="multipart/form-data" method="post" onkeydown="if(event.keyCode==13){return false;}">			
					<input type="hidden" name="id" value="<?php echo ($data['id']); ?>">
					
					<!-- <div class="layui-form-item">
						<label class="layui-form-label">登录地址</label>
						<div class="layui-input-block">
							<input type="text" name="login_page_address"  value="<?php echo ($data['login_page_address']); ?>" placeholder="请填写用户登录网址"  autocomplete="off" class="layui-input">
						</div>
					</div> -->
					
					<div class="layui-form-item">
						<label class="layui-form-label required">系统名称</label>
						<div class="layui-input-inline" style="width: 50%;margin-left: 10px;">
							<input type="text" name="page_title"  value="<?php echo ($data['page_title']); ?>" placeholder="请填写系统主页名称"  autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux">该参数显示在浏览器的title中</div>
					</div>
					<!-- <div class="layui-form-item">
						<label class="layui-form-label required">产品名称</label>
						<div class="layui-input-inline" style="width: 50%;margin-left: 10px;">
							<input type="text" name="product_name"  value="<?php echo ($data['product_name']); ?>"  placeholder="请填写产品名称"  autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux"></div>
					</div> -->
					<div class="layui-form-item">
						<label class="layui-form-label required">登录地址</label>
						<div class="layui-input-inline" style="width: 50%;margin-left: 10px;">
							<input type="text" name="home_page_address"  value="<?php echo ($data['home_page_address']); ?>"  placeholder="请填写系统主页地址"  autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux"></div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label required">客服名称</label>
						<div class="layui-input-inline" style="width: 50%;margin-left: 10px;">
							<input type="text" name="customer"  value="<?php echo ($data['customer']); ?>"  placeholder="请填写客服名称"  autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux"></div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label required">客服电话</label>
						<div class="layui-input-inline" style="width: 50%;margin-left: 10px;">
							<input type="text" name="telephone"  value="<?php echo ($data['telephone']); ?>" placeholder="请填写客服联系电话"  autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux">固定电话格式为：xxxx-xxxxxxxx</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label required">客服QQ</label>
						<div class="layui-input-inline" style="width: 50%;margin-left: 10px;">
							<input type="text" name="QQnumber"  value="<?php echo ($data['QQnumber']); ?>"  required="" lay-verify="verifyQQ" placeholder="请填写客服QQ号码"  autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux"></div>
					</div>	
					
					
					<div class="layui-form-item">
						<label class="layui-form-label required">登录图片</label>
						<div class="layui-input-inline" style="width: 50%;">
							<?php $skin =$login_page_image_arr['skin']; $attachmentid =$login_page_image_arr['fileid']; unset($attainfos); unset($attachmentids); if( $attachmentid ){ $attachmentids= explode("," , $attachmentid); if( $attachmentids ){ $map["id"] = array("IN",$attachmentids);$attainfos = D("File/File") -> queryRecordAll($map,null,"odernum");$ordernum_max = $attainfos[count($attainfos)-1]["odernum"] + 1;} }else{ } if( !$attainfos){ $atta["nofile"]="1";$attainfos[0] = $atta;} $attachmentname = $login_page_image_arr['attachmentname']; $isRequire = $login_page_image_arr['isrequire']; load("encode"); $guid = create_guid(); $guid = str_replace("-","",$guid ); $isimage =$login_page_image_arr['isimage']; if(!$suffix_temp){ if( $isimage == 1 ){ $suffix_temp ="png,jpg,gif,jpeg,bmp"; }else{ $suffix_temp ="zip,rar,xls,xlsx,txt,doc,docx,png,jpg,jpeg,pdf,bmp"; } } $suffix = D("File/File") -> combineSuffix($suffix_temp); $maxsize =$login_page_image_arr['maxsize']; if( !$maxsize ){ $maxsize = 30; } $attachmenttype =$login_page_image_arr['attachmenttype']; $cannotedit = $login_page_image_arr['cannotedit']; if( !$appid ){ $appid = "SYS_NAME"; } if( !$groupname ){ $groupname = "Agent"; } $tagname = $login_page_image_arr['tagname']; if( !$tagname ){ $tagname = "System"; } if( $truetablename ){ $truetablenames = explode("," , $truetablename); } if( $primarykey ){ $primarykeys = explode("," , $primarykey); } if( $primarykeyvalue ){ $primarykeyvalues = explode("," , $primarykeyvalues); } ?><div class="ui-uploader-form <?php  echo($style); ?>" style="padding: 2px;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $skin =="simple" ){ ?><ul class="ui-uploader-form-ul ui-attachment-list"><?php foreach( $attainfos as $key_dupload => $vo_dupload ){ $ordernum = $vo_dupload["odernum"]; ?><li class="ui-uploader-form-li <?php if( $isimage == "1"){ ?>isimg<?php } ?>"><?php if( $attachmentname ){ ?><span class="ui-uploader-form-filename"><?php if($key_dupload ==0 ) { echo($attachmentname); if( $isRequire == 1 ) { ?><span class="ui-form-required">*</span><?php } ?>:<?php } ?></span><?php } if( $attachmentname ){ ?><span class="ui-uploader-form-filefield-short"><?php }else{ ?><span class="ui-uploader-form-filefield-long"><?php } if( $vo_dupload["id"] ){ if( $isimage == "1"){ ?><div class="ui-uploader-form-img" style="display:none"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img"><img class="ui-img" src="/Agent/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>"><?php  if( $cannotedit != "1" && $model_name !== "Manage" && $data["bp_check"] !== "1" || $model_name == "Manage" && $LoginUserInfo["role_info"]["id"] == "2" && $data["bp_check"] !== "1") { ?><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Agent/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span><?php } }else{ ?><div class="ui-uploader-form-other" style="display:none"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div  id="child_div_<?php  echo($guid); ?>" ><?php  if( $cannotedit != "1") { ?><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Agent/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  /><?php } ?><a class="ui-uploader-form-a" id="a_<?php  echo($guid); ?>" target="_blank" href="/Agent/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>" ><?php  echo($vo_dupload["originalfilename"]) ?></a><?php } }else{ ?><div id="div_<?php  echo($guid); ?>" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $cannotedit ==1){ ?><span class="nofile">还未上传相关附件</span><input name="uploadField[]" type="file" class="ui-input hide"  id="<?php  echo($guid); ?>"  disabled <?php if( $isRequire == 1 ) { } ?>/><?php }else{ if( $isimage == "1"){ ?><div class="ui-uploader-form-img"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img" style="display: none" ><img class="ui-img" /><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete"></span><?php }else{ ?><div class="ui-uploader-form-other"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div style="display: none" id="child_div_<?php  echo($guid); ?>" ><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button " type="button" value="删除"/><a class="ui-uploader-form-a" target="_blank"></a><?php } } } ?><input type="hidden" name="fileurl[]" id="fileurl_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["fileurl"]) ?>"/><input type="hidden" name="filepath[]" id="filepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["filepath"]) ?>"/><input type="hidden" name="savepath[]" id="savepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["savepath"]) ?>"/><input type="hidden" name="orifilename[]" id="orifilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["originalfilename"]) ?>"/><input type="hidden" name="formatfilename[]" id="formatfilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["formatfilename"]) ?>" /><?php if( $isRequire == 1 ) { ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="必填字段"/><?php }else{ ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" /><?php } ?><input type="hidden" name="filegroupid[]" id="filegroupid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["groupid"]) ?>" /></div><input type="hidden" name="uploadflag[]" id="uploadflag_<?php  echo($guid); ?>" value="0" /><input type="hidden" name="isdeleted[]" id="delflag_<?php  echo($guid); ?>"  value="0"><input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_<?php  echo($guid); ?>" /><input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" ><input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" /><input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" /><input type="hidden" name="guid[]" value="<?php  echo($guid); ?>" /><div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div></span><span style="display: inline-block;inline-block;float: left;width:5%;"><?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" ></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }else{ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" style="visibility: hidden"></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }?></span><script type="text/javascript">$(function($) {bindUploaderNew( "<?php  echo($guid); ?>", "/Agent/Upload/doUpload" ,"/Agent/Upload/downloadFile", "/Agent/Upload/delUploadFile" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>", "<?php echo($skin) ?>" );})</script></li><?php  } ?></ul><?php  }else{ ?><table class="ui-table ui-table-noborder ui-attachment-list" style="padding: 5px;border:none;border-left: none;border-right: none;border-bottom:none"><?php foreach( $attainfos as $key_dupload => $vo_dupload ){ $ordernum = $vo_dupload["odernum"]; ?><tr valign="top"><?php if( $attachmentname ){ ?><td width="30%;" valign="middle" align="left"><?php if($key_dupload ==0 ) { echo($attachmentname); if( $isRequire == 1 ) { ?><span class="ui-form-required">*</span><?php } ?>:<?php } ?></td><?php } ?><td valign="middle" align="left" width="30%;" style="padding:5px 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $vo_dupload["id"] ){ if( $isimage == "1"){ ?><div class="ui-uploader-form-img" style="display:none"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img"><img class="ui-img" src="/Agent/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>"><?php  if( $cannotedit != "1") { ?><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Agent/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span><?php } }else{ ?><div class="ui-uploader-form-other" style="display:none"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div  id="child_div_<?php  echo($guid); ?>" ><?php  if( $cannotedit != "1") { ?><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Agent/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  /><?php } ?><a class="ui-uploader-form-a" id="a_<?php  echo($guid); ?>" target="_blank" href="/Agent/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>" ><?php  echo($vo_dupload["originalfilename"]) ?></a><?php } }else{ ?><div id="div_<?php  echo($guid); ?>" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $cannotedit ==1){ ?><span class="nofile">还未上传相关附件</span><input name="uploadField[]" type="file" class="ui-input hide" id="<?php  echo($guid); ?>" disabled <?php if( $isRequire == 1 ) { } ?>/><?php }else{ if( $isimage == "1"){ ?><div class="ui-uploader-form-img"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img" style="display: none" ><img class="ui-img"><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete"></span><?php }else{ ?><div class="ui-uploader-form-other"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field"  id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div style="display: none" id="child_div_<?php  echo($guid); ?>" ><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button " type="button" value="删除"/><a class="ui-uploader-form-a" target="_blank"></a><?php } } } ?><input type="hidden" name="fileurl[]" id="fileurl_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["fileurl"]) ?>"/><input type="hidden" name="filepath[]" id="filepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["filepath"]) ?>"/><input type="hidden" name="savepath[]" id="savepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["savepath"]) ?>"/><input type="hidden" name="orifilename[]" id="orifilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["originalfilename"]) ?>"/><input type="hidden" name="formatfilename[]" id="formatfilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["formatfilename"]) ?>" /><?php if( $isRequire == 1 ) { ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="必填字段"/><?php }else{ ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" /><?php } ?><input type="hidden" name="filegroupid[]" id="filegroupid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["groupid"]) ?>" /></div><input type="hidden" name="uploadflag[]" id="uploadflag_<?php  echo($guid); ?>" value="0" /><input type="hidden" name="isdeleted[]" id="delflag_<?php  echo($guid); ?>"  value="0"><input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_<?php  echo($guid); ?>" /><input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" ><input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" /><input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" /><input type="hidden" name="guid[]" value="<?php  echo($guid); ?>" /><div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div></div></td><td valign="middle" align="left" width="5%"><?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" ></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }else{ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" style="visibility: hidden"></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }?></td><?php $attachmentdesc = $login_page_image_arr['attachmentdesc']; ?><td valign="middle" align="left" width="30%"><?php if( $attachmentdesc ){ if($key_dupload ==0 ) { echo($attachmentdesc); } }?></td></tr><script type="text/javascript">$(function($) {bindUploaderNew( "<?php  echo($guid); ?>", "/Agent/Upload/doUpload" ,"/Agent/Upload/downloadFile", "/Agent/Upload/delUploadFile" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>" );})</script></div><?php  } ?></table><?php  } ?></div><?php unset($cannotedit); unset($isimage); unset($attachmentid); unset($maxsize); unset($attachmentname); unset($attachmenttype); unset($attachmentdesc); unset($isrequire); unset($skin); unset($tagname); ?>
						</div>
						<div class="layui-form-mid layui-word-aux">图片大小 1590*660(具体根据显示效果来定)</div>
					</div>	
					
					<div class="layui-form-item">
						<label class="layui-form-label required">登录页logo</label>
						<div class="layui-input-inline" style="width: 50%;">
							<?php $skin =$loginpage_logo_image_arr['skin']; $attachmentid =$loginpage_logo_image_arr['fileid']; unset($attainfos); unset($attachmentids); if( $attachmentid ){ $attachmentids= explode("," , $attachmentid); if( $attachmentids ){ $map["id"] = array("IN",$attachmentids);$attainfos = D("File/File") -> queryRecordAll($map,null,"odernum");$ordernum_max = $attainfos[count($attainfos)-1]["odernum"] + 1;} }else{ } if( !$attainfos){ $atta["nofile"]="1";$attainfos[0] = $atta;} $attachmentname = $loginpage_logo_image_arr['attachmentname']; $isRequire = $loginpage_logo_image_arr['isrequire']; load("encode"); $guid = create_guid(); $guid = str_replace("-","",$guid ); $isimage =$loginpage_logo_image_arr['isimage']; if(!$suffix_temp){ if( $isimage == 1 ){ $suffix_temp ="png,jpg,gif,jpeg,bmp"; }else{ $suffix_temp ="zip,rar,xls,xlsx,txt,doc,docx,png,jpg,jpeg,pdf,bmp"; } } $suffix = D("File/File") -> combineSuffix($suffix_temp); $maxsize =$loginpage_logo_image_arr['maxsize']; if( !$maxsize ){ $maxsize = 30; } $attachmenttype =$loginpage_logo_image_arr['attachmenttype']; $cannotedit = $loginpage_logo_image_arr['cannotedit']; if( !$appid ){ $appid = "SYS_NAME"; } if( !$groupname ){ $groupname = "Agent"; } $tagname = $loginpage_logo_image_arr['tagname']; if( !$tagname ){ $tagname = "System"; } if( $truetablename ){ $truetablenames = explode("," , $truetablename); } if( $primarykey ){ $primarykeys = explode("," , $primarykey); } if( $primarykeyvalue ){ $primarykeyvalues = explode("," , $primarykeyvalues); } ?><div class="ui-uploader-form <?php  echo($style); ?>" style="padding: 2px;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $skin =="simple" ){ ?><ul class="ui-uploader-form-ul ui-attachment-list"><?php foreach( $attainfos as $key_dupload => $vo_dupload ){ $ordernum = $vo_dupload["odernum"]; ?><li class="ui-uploader-form-li <?php if( $isimage == "1"){ ?>isimg<?php } ?>"><?php if( $attachmentname ){ ?><span class="ui-uploader-form-filename"><?php if($key_dupload ==0 ) { echo($attachmentname); if( $isRequire == 1 ) { ?><span class="ui-form-required">*</span><?php } ?>:<?php } ?></span><?php } if( $attachmentname ){ ?><span class="ui-uploader-form-filefield-short"><?php }else{ ?><span class="ui-uploader-form-filefield-long"><?php } if( $vo_dupload["id"] ){ if( $isimage == "1"){ ?><div class="ui-uploader-form-img" style="display:none"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img"><img class="ui-img" src="/Agent/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>"><?php  if( $cannotedit != "1" && $model_name !== "Manage" && $data["bp_check"] !== "1" || $model_name == "Manage" && $LoginUserInfo["role_info"]["id"] == "2" && $data["bp_check"] !== "1") { ?><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Agent/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span><?php } }else{ ?><div class="ui-uploader-form-other" style="display:none"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div  id="child_div_<?php  echo($guid); ?>" ><?php  if( $cannotedit != "1") { ?><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Agent/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  /><?php } ?><a class="ui-uploader-form-a" id="a_<?php  echo($guid); ?>" target="_blank" href="/Agent/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>" ><?php  echo($vo_dupload["originalfilename"]) ?></a><?php } }else{ ?><div id="div_<?php  echo($guid); ?>" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $cannotedit ==1){ ?><span class="nofile">还未上传相关附件</span><input name="uploadField[]" type="file" class="ui-input hide"  id="<?php  echo($guid); ?>"  disabled <?php if( $isRequire == 1 ) { } ?>/><?php }else{ if( $isimage == "1"){ ?><div class="ui-uploader-form-img"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img" style="display: none" ><img class="ui-img" /><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete"></span><?php }else{ ?><div class="ui-uploader-form-other"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div style="display: none" id="child_div_<?php  echo($guid); ?>" ><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button " type="button" value="删除"/><a class="ui-uploader-form-a" target="_blank"></a><?php } } } ?><input type="hidden" name="fileurl[]" id="fileurl_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["fileurl"]) ?>"/><input type="hidden" name="filepath[]" id="filepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["filepath"]) ?>"/><input type="hidden" name="savepath[]" id="savepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["savepath"]) ?>"/><input type="hidden" name="orifilename[]" id="orifilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["originalfilename"]) ?>"/><input type="hidden" name="formatfilename[]" id="formatfilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["formatfilename"]) ?>" /><?php if( $isRequire == 1 ) { ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="必填字段"/><?php }else{ ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" /><?php } ?><input type="hidden" name="filegroupid[]" id="filegroupid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["groupid"]) ?>" /></div><input type="hidden" name="uploadflag[]" id="uploadflag_<?php  echo($guid); ?>" value="0" /><input type="hidden" name="isdeleted[]" id="delflag_<?php  echo($guid); ?>"  value="0"><input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_<?php  echo($guid); ?>" /><input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" ><input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" /><input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" /><input type="hidden" name="guid[]" value="<?php  echo($guid); ?>" /><div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div></span><span style="display: inline-block;inline-block;float: left;width:5%;"><?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" ></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }else{ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" style="visibility: hidden"></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }?></span><script type="text/javascript">$(function($) {bindUploaderNew( "<?php  echo($guid); ?>", "/Agent/Upload/doUpload" ,"/Agent/Upload/downloadFile", "/Agent/Upload/delUploadFile" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>", "<?php echo($skin) ?>" );})</script></li><?php  } ?></ul><?php  }else{ ?><table class="ui-table ui-table-noborder ui-attachment-list" style="padding: 5px;border:none;border-left: none;border-right: none;border-bottom:none"><?php foreach( $attainfos as $key_dupload => $vo_dupload ){ $ordernum = $vo_dupload["odernum"]; ?><tr valign="top"><?php if( $attachmentname ){ ?><td width="30%;" valign="middle" align="left"><?php if($key_dupload ==0 ) { echo($attachmentname); if( $isRequire == 1 ) { ?><span class="ui-form-required">*</span><?php } ?>:<?php } ?></td><?php } ?><td valign="middle" align="left" width="30%;" style="padding:5px 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $vo_dupload["id"] ){ if( $isimage == "1"){ ?><div class="ui-uploader-form-img" style="display:none"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img"><img class="ui-img" src="/Agent/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>"><?php  if( $cannotedit != "1") { ?><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Agent/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span><?php } }else{ ?><div class="ui-uploader-form-other" style="display:none"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div  id="child_div_<?php  echo($guid); ?>" ><?php  if( $cannotedit != "1") { ?><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Agent/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  /><?php } ?><a class="ui-uploader-form-a" id="a_<?php  echo($guid); ?>" target="_blank" href="/Agent/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>" ><?php  echo($vo_dupload["originalfilename"]) ?></a><?php } }else{ ?><div id="div_<?php  echo($guid); ?>" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $cannotedit ==1){ ?><span class="nofile">还未上传相关附件</span><input name="uploadField[]" type="file" class="ui-input hide" id="<?php  echo($guid); ?>" disabled <?php if( $isRequire == 1 ) { } ?>/><?php }else{ if( $isimage == "1"){ ?><div class="ui-uploader-form-img"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img" style="display: none" ><img class="ui-img"><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete"></span><?php }else{ ?><div class="ui-uploader-form-other"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field"  id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div style="display: none" id="child_div_<?php  echo($guid); ?>" ><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button " type="button" value="删除"/><a class="ui-uploader-form-a" target="_blank"></a><?php } } } ?><input type="hidden" name="fileurl[]" id="fileurl_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["fileurl"]) ?>"/><input type="hidden" name="filepath[]" id="filepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["filepath"]) ?>"/><input type="hidden" name="savepath[]" id="savepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["savepath"]) ?>"/><input type="hidden" name="orifilename[]" id="orifilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["originalfilename"]) ?>"/><input type="hidden" name="formatfilename[]" id="formatfilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["formatfilename"]) ?>" /><?php if( $isRequire == 1 ) { ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="必填字段"/><?php }else{ ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" /><?php } ?><input type="hidden" name="filegroupid[]" id="filegroupid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["groupid"]) ?>" /></div><input type="hidden" name="uploadflag[]" id="uploadflag_<?php  echo($guid); ?>" value="0" /><input type="hidden" name="isdeleted[]" id="delflag_<?php  echo($guid); ?>"  value="0"><input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_<?php  echo($guid); ?>" /><input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" ><input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" /><input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" /><input type="hidden" name="guid[]" value="<?php  echo($guid); ?>" /><div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div></div></td><td valign="middle" align="left" width="5%"><?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" ></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }else{ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" style="visibility: hidden"></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }?></td><td valign="middle" align="left" width="30%"><?php if( $attachmentdesc ){ if($key_dupload ==0 ) { echo($attachmentdesc); } }?></td></tr><script type="text/javascript">$(function($) {bindUploaderNew( "<?php  echo($guid); ?>", "/Agent/Upload/doUpload" ,"/Agent/Upload/downloadFile", "/Agent/Upload/delUploadFile" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>" );})</script></div><?php  } ?></table><?php  } ?></div><?php unset($cannotedit); unset($isimage); unset($attachmentid); unset($maxsize); unset($attachmentname); unset($attachmenttype); unset($isrequire); unset($skin); unset($tagname); ?>
						</div>
						<div class="layui-form-mid layui-word-aux">图片大小200 * 80 (具体根据显示效果来定)</div>
					</div>
					
					<div class="layui-form-item">
						<label class="layui-form-label required">系统logo</label>
						<div class="layui-input-inline" style="width: 50%;">
							<?php $skin =$logo_image_arr['skin']; $attachmentid =$logo_image_arr['fileid']; unset($attainfos); unset($attachmentids); if( $attachmentid ){ $attachmentids= explode("," , $attachmentid); if( $attachmentids ){ $map["id"] = array("IN",$attachmentids);$attainfos = D("File/File") -> queryRecordAll($map,null,"odernum");$ordernum_max = $attainfos[count($attainfos)-1]["odernum"] + 1;} }else{ } if( !$attainfos){ $atta["nofile"]="1";$attainfos[0] = $atta;} $attachmentname = $logo_image_arr['attachmentname']; $isRequire = $logo_image_arr['isrequire']; load("encode"); $guid = create_guid(); $guid = str_replace("-","",$guid ); $isimage =$logo_image_arr['isimage']; if(!$suffix_temp){ if( $isimage == 1 ){ $suffix_temp ="png,jpg,gif,jpeg,bmp"; }else{ $suffix_temp ="zip,rar,xls,xlsx,txt,doc,docx,png,jpg,jpeg,pdf,bmp"; } } $suffix = D("File/File") -> combineSuffix($suffix_temp); $maxsize =$logo_image_arr['maxsize']; if( !$maxsize ){ $maxsize = 30; } $attachmenttype =$logo_image_arr['attachmenttype']; $cannotedit = $logo_image_arr['cannotedit']; if( !$appid ){ $appid = "SYS_NAME"; } if( !$groupname ){ $groupname = "Agent"; } $tagname = $logo_image_arr['tagname']; if( !$tagname ){ $tagname = "System"; } if( $truetablename ){ $truetablenames = explode("," , $truetablename); } if( $primarykey ){ $primarykeys = explode("," , $primarykey); } if( $primarykeyvalue ){ $primarykeyvalues = explode("," , $primarykeyvalues); } ?><div class="ui-uploader-form <?php  echo($style); ?>" style="padding: 2px;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $skin =="simple" ){ ?><ul class="ui-uploader-form-ul ui-attachment-list"><?php foreach( $attainfos as $key_dupload => $vo_dupload ){ $ordernum = $vo_dupload["odernum"]; ?><li class="ui-uploader-form-li <?php if( $isimage == "1"){ ?>isimg<?php } ?>"><?php if( $attachmentname ){ ?><span class="ui-uploader-form-filename"><?php if($key_dupload ==0 ) { echo($attachmentname); if( $isRequire == 1 ) { ?><span class="ui-form-required">*</span><?php } ?>:<?php } ?></span><?php } if( $attachmentname ){ ?><span class="ui-uploader-form-filefield-short"><?php }else{ ?><span class="ui-uploader-form-filefield-long"><?php } if( $vo_dupload["id"] ){ if( $isimage == "1"){ ?><div class="ui-uploader-form-img" style="display:none"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img"><img class="ui-img" src="/Agent/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>"><?php  if( $cannotedit != "1" && $model_name !== "Manage" && $data["bp_check"] !== "1" || $model_name == "Manage" && $LoginUserInfo["role_info"]["id"] == "2" && $data["bp_check"] !== "1") { ?><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Agent/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span><?php } }else{ ?><div class="ui-uploader-form-other" style="display:none"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div  id="child_div_<?php  echo($guid); ?>" ><?php  if( $cannotedit != "1") { ?><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Agent/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  /><?php } ?><a class="ui-uploader-form-a" id="a_<?php  echo($guid); ?>" target="_blank" href="/Agent/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>" ><?php  echo($vo_dupload["originalfilename"]) ?></a><?php } }else{ ?><div id="div_<?php  echo($guid); ?>" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $cannotedit ==1){ ?><span class="nofile">还未上传相关附件</span><input name="uploadField[]" type="file" class="ui-input hide"  id="<?php  echo($guid); ?>"  disabled <?php if( $isRequire == 1 ) { } ?>/><?php }else{ if( $isimage == "1"){ ?><div class="ui-uploader-form-img"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img" style="display: none" ><img class="ui-img" /><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete"></span><?php }else{ ?><div class="ui-uploader-form-other"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div style="display: none" id="child_div_<?php  echo($guid); ?>" ><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button " type="button" value="删除"/><a class="ui-uploader-form-a" target="_blank"></a><?php } } } ?><input type="hidden" name="fileurl[]" id="fileurl_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["fileurl"]) ?>"/><input type="hidden" name="filepath[]" id="filepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["filepath"]) ?>"/><input type="hidden" name="savepath[]" id="savepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["savepath"]) ?>"/><input type="hidden" name="orifilename[]" id="orifilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["originalfilename"]) ?>"/><input type="hidden" name="formatfilename[]" id="formatfilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["formatfilename"]) ?>" /><?php if( $isRequire == 1 ) { ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="必填字段"/><?php }else{ ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" /><?php } ?><input type="hidden" name="filegroupid[]" id="filegroupid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["groupid"]) ?>" /></div><input type="hidden" name="uploadflag[]" id="uploadflag_<?php  echo($guid); ?>" value="0" /><input type="hidden" name="isdeleted[]" id="delflag_<?php  echo($guid); ?>"  value="0"><input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_<?php  echo($guid); ?>" /><input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" ><input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" /><input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" /><input type="hidden" name="guid[]" value="<?php  echo($guid); ?>" /><div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div></span><span style="display: inline-block;inline-block;float: left;width:5%;"><?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" ></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }else{ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" style="visibility: hidden"></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }?></span><script type="text/javascript">$(function($) {bindUploaderNew( "<?php  echo($guid); ?>", "/Agent/Upload/doUpload" ,"/Agent/Upload/downloadFile", "/Agent/Upload/delUploadFile" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>", "<?php echo($skin) ?>" );})</script></li><?php  } ?></ul><?php  }else{ ?><table class="ui-table ui-table-noborder ui-attachment-list" style="padding: 5px;border:none;border-left: none;border-right: none;border-bottom:none"><?php foreach( $attainfos as $key_dupload => $vo_dupload ){ $ordernum = $vo_dupload["odernum"]; ?><tr valign="top"><?php if( $attachmentname ){ ?><td width="30%;" valign="middle" align="left"><?php if($key_dupload ==0 ) { echo($attachmentname); if( $isRequire == 1 ) { ?><span class="ui-form-required">*</span><?php } ?>:<?php } ?></td><?php } ?><td valign="middle" align="left" width="30%;" style="padding:5px 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $vo_dupload["id"] ){ if( $isimage == "1"){ ?><div class="ui-uploader-form-img" style="display:none"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img"><img class="ui-img" src="/Agent/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>"><?php  if( $cannotedit != "1") { ?><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Agent/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span><?php } }else{ ?><div class="ui-uploader-form-other" style="display:none"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div  id="child_div_<?php  echo($guid); ?>" ><?php  if( $cannotedit != "1") { ?><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Agent/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  /><?php } ?><a class="ui-uploader-form-a" id="a_<?php  echo($guid); ?>" target="_blank" href="/Agent/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>" ><?php  echo($vo_dupload["originalfilename"]) ?></a><?php } }else{ ?><div id="div_<?php  echo($guid); ?>" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $cannotedit ==1){ ?><span class="nofile">还未上传相关附件</span><input name="uploadField[]" type="file" class="ui-input hide" id="<?php  echo($guid); ?>" disabled <?php if( $isRequire == 1 ) { } ?>/><?php }else{ if( $isimage == "1"){ ?><div class="ui-uploader-form-img"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img" style="display: none" ><img class="ui-img"><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete"></span><?php }else{ ?><div class="ui-uploader-form-other"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field"  id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div style="display: none" id="child_div_<?php  echo($guid); ?>" ><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button " type="button" value="删除"/><a class="ui-uploader-form-a" target="_blank"></a><?php } } } ?><input type="hidden" name="fileurl[]" id="fileurl_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["fileurl"]) ?>"/><input type="hidden" name="filepath[]" id="filepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["filepath"]) ?>"/><input type="hidden" name="savepath[]" id="savepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["savepath"]) ?>"/><input type="hidden" name="orifilename[]" id="orifilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["originalfilename"]) ?>"/><input type="hidden" name="formatfilename[]" id="formatfilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["formatfilename"]) ?>" /><?php if( $isRequire == 1 ) { ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="必填字段"/><?php }else{ ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" /><?php } ?><input type="hidden" name="filegroupid[]" id="filegroupid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["groupid"]) ?>" /></div><input type="hidden" name="uploadflag[]" id="uploadflag_<?php  echo($guid); ?>" value="0" /><input type="hidden" name="isdeleted[]" id="delflag_<?php  echo($guid); ?>"  value="0"><input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_<?php  echo($guid); ?>" /><input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" ><input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" /><input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" /><input type="hidden" name="guid[]" value="<?php  echo($guid); ?>" /><div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div></div></td><td valign="middle" align="left" width="5%"><?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" ></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }else{ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" style="visibility: hidden"></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }?></td><td valign="middle" align="left" width="30%"><?php if( $attachmentdesc ){ if($key_dupload ==0 ) { echo($attachmentdesc); } }?></td></tr><script type="text/javascript">$(function($) {bindUploaderNew( "<?php  echo($guid); ?>", "/Agent/Upload/doUpload" ,"/Agent/Upload/downloadFile", "/Agent/Upload/delUploadFile" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>" );})</script></div><?php  } ?></table><?php  } ?></div><?php unset($cannotedit); unset($isimage); unset($attachmentid); unset($maxsize); unset($attachmentname); unset($attachmenttype); unset($isrequire); unset($skin); unset($tagname); ?>
						</div>
						<div class="layui-form-mid layui-word-aux">请使用透明背景，白色字体logo，图片大小 180 * 60 (具体根据显示效果来定)</div>
					</div>	
					
					<!-- <div class="layui-form-item">
						<label class="layui-form-label">用户协议</label>
						<div class="layui-input-block">
							<textarea name="agreement" placeholder="请填写用户协议" class="layui-textarea" id="layer_textarea" style="display: none"><?php echo ($data['agreement']); ?></textarea>
						</div>
					</div>	 -->
					
					<div class="layui-form-item">
						<div class="layui-input-block">
							<button class="layui-btn" lay-submit="" lay-filter="go">修改系统配置</button>
						</div>
					</div>
				</form>
			</div>
        </div>
    </div>
    <!-- 页面底部 begin -->
    <div class="clear"> </div>

<div class="footer mt20" style="display: none;">
	<!-- <div class="ftleft">
		<p class="fl">
			<a href="/faq">常见问题</a> | <a href="/about">关于我们</a> | <a
				href="/contacts">联系我们</a> | <a href="/cooperation">商务合作</a>| <a
				href="#">网站地图</a> | <a href="/privacy">隐私申明</a> <br>
			400客服电话：400-902-8550 地址：上海市闵行区陈行公路2388号浦江科技广场5号楼5楼<br>
			推送者关键词快速排名系统-上海优槃网络科技有限公司旗下网站 <a href="http://www.miitbeian.gov.cn"
				target="_blank">沪ICP备16031230号-2</a>
		</p>
		<a href="/"><img src="/front/images/logo_white.png" alt=""
			class="fr"></a>
	</div> -->
</div>

    <!-- 页面底部 end -->
</body>
</html>