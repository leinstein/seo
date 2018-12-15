<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang = "zh-CN">
<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title><?php echo (($page_title)?($page_title):"米同智能营销系统管理后台"); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<meta name="description" content="mitong">
<meta name="author" content="mitong">
<!-- <link rel="shortcut icon" href="Upload/favicon.ico" type="image/x-icon" /> -->


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
$('#loading_iframe', parent.document).show();
</script>

    <!-- 自定义正则验证js  -->
    <script src = "__PUBLIC__/js/regular.js"></script>
    <style>

        .sel_btn {
            height: 21px;
            line-height: 21px;
            padding: 0 16px;

            border: 1px #A5A5A5 solid;
            border-radius: 3px;
            color: black;
            display: inline-block;
            text-decoration: none;
            font-size: 14px;
            outline: none;
        }

        .ch_cls {
            background: #e4e4e4;
        }

    </style>

    <script type = "text/javascript">
        layui.use(['layedit'], function () {
            var layedit = layui.layedit;
            layedit.set({
                uploadImage: {
                    url: "<?php echo U('Upload/doUpload1');?>" //接口url
                    , type: '' //默认post
                }
            });
            //注意：layedit.set 一定要放在 build 前面，否则配置全局接口将无效。
            layedit.build('layer_textarea', {

                height: 500
            }); //建立编辑器
        });

    </script>
    <!-- 引入上传组件标签库 begin -->
    
    <!-- 引入上传组件标签库 end -->
    <!-- 引入上传组件js和css文件 begin -->
    <script type="text/javascript" src="__PUBLIC__/js/upload/upload.js"></script><link rel="stylesheet" href="__PUBLIC__/css/upload/upload.css"/>
    <!-- 引入上传组件js和css文件 end-->

</head>
<body>
<!-- 页面顶部 logo & 菜单 begin  -->

	<!-- header -->
	<div class="ui-header">
		<div class="ui-header-logo fl">
			<!--<?php if(($LoginUserInfo['usertype']) == "seller"): ?><a class="logo" href="<?php echo U('Manage/Home/home');?>">
	        <img src="__PUBLIC__/img/logo-white.png">
	      	</a>
	    <?php else: ?>
	    	<a class="logo" href="<?php echo U('Manage/Home/home');?>">
	        <img src="__PUBLIC__/img/logo-white.png">
	      	</a><?php endif; ?>-->

	    <div style="font-size:25px;text-align:center;line-height:63px;font-weight:bold;color:#fff;"><i class="iconfont">&#xe62f;</i> <?php echo ($LoginUserInfo['role_info']['rolename']); ?></div>
		</div>
		<div class="ui-header-main ta_r">
			<!-- <div class="menu-control-outer fl">
				<a href="#a_null" id="menuControl" class="menu-collapse-control" title="折叠菜单">
				</a>
			</div> -->
			<ul class="layui-nav header-link fr">
			  <li class="layui-nav-item">
			    <a href="javascript:;">欢迎您，<?php echo ($LoginUserName); ?></a>
			    <dl class="layui-nav-child">
			      <dd><a href="<?php echo U('User/updatePage');?>">账号信息</a></dd>
			      <dd><a href="<?php echo U('User/updatePasswordPage');?>">密码修改</a></dd>
			      <dd><a href="<?php echo U('Index/logOut');?>">安全退出</a></dd>
			    </dl>
			  </li>
			</ul> 
			
			
			<div class="fl">
				
				<?php  $home_arra = array('Home','User','Finance','System','UserManagement','News','SysPermission'); $os_arra = array('Index','Site','Keyword','Cart','OSReport'); $qr_arra = array('QRIndex','QRKeyword','QRPlan','QREpinfo','QRReport'); ?>
				<?php if(($LoginUserName) != "排名统计"): ?><a href="<?php echo U('Manage/Home/home');?>" class="header-link <?php if(in_array(MODULE_NAME,$home_arra)): ?>actived<?php endif; ?>">
						<i class="iconfont">&#xe671;</i>首页
					</a><?php endif; ?>
				
				<!-- 系统产品 begin -->
				<?php if(is_array($sys_products)): $i = 0; $__LIST__ = $sys_products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['entry_code']);?>" class="header-link <?php if(in_array(MODULE_NAME,$vo['module_name_arra'][GROUP_NAME])): ?>actived<?php endif; ?>">
						<i class="iconfont"><?php echo ($vo['menuicon']); ?></i><?php echo ($vo['product_name']); ?>
					</a><?php endforeach; endif; else: echo "" ;endif; ?>

				<!-- 系统产品 end -->
				
				<?php if(($LoginUserName) != "排名统计"): ?><a href="<?php echo U('Manage/Workorder/index');?>"  class="header-link <?php if(MODULE_NAME == 'Workorder'): ?>actived<?php endif; ?>">
						<i class="iconfont">&#xe6aa;</i>工单<?php if(($untreated_workorder_num) > "0"): ?><span class="badge"><?php echo ($untreated_workorder_num); ?></span><?php endif; ?>
					</a>
					<a href="<?php echo U('Manage/Remark/index');?>"  class="header-link <?php if(MODULE_NAME == 'Remark'): ?>actived<?php endif; ?>">
						<i class="iconfont">&#xe64d;</i>日志
					</a>
					<!-- <a href="<?php echo U('Manage/Question/index');?>"  class="header-link <?php if(MODULE_NAME == 'Question'): ?>actived<?php endif; ?>">
						<i class="iconfont">&#xe64c;</i>常见问题
					</a> --><?php endif; ?>
				
				
			</div>
		</div>
	</div>
	<!-- header end-->
	
	<script>
layui.use(['element'], function(){
  var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
});
</script>
<!-- 页面顶部 logo & 菜单 end  -->

<!-- 页面左侧菜单 begin  -->
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
        <!--    <li class="layui-nav-item <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'bpxdlist'): ?>layui-nav-itemed<?php endif; ?>">
        <a href="<?php echo U('System/bpxdlist');?>"><i class="iconfont">&#xe76a;</i>霸屏下单</a>
        </li> -->

        <li class="layui-nav-item <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'bpxdlist'): ?>layui-nav-itemed<?php endif; ?>">
        <a href="<?php echo U('System/bpxdlist');?>"><i class="iconfont">&#xe76a;</i>站点监控</a>
        </li>
        <li class="layui-nav-item <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'caseShow'): ?>layui-nav-itemed<?php endif; ?>">
        <a href="<?php echo U('System/caseShow');?>"><i class="iconfont">&#xe76a;</i>案例展示</a>
        </li>
        <!--<li class="layui-nav-item <?php if(MODULE_NAME == 'System' && ACTION_NAME == 'bpprice'): ?>layui-nav-itemed<?php endif; ?>">
        <a href="<?php echo U('System/bpprice');?>"><i class="iconfont">&#xe76a;</i>霸屏套餐</a>
        </li>-->

    </ul>

</nav>
<!--menu 左侧菜单 end
<!-- 页面左侧菜单 end  -->

<!--内容区域 begin -->
<div class = "ui-module">

    <div class = "ui-content"
         id = "ui-content">
        <?php
 $b = (strpos(__URL__, "/")); $a = substr(__URL__, $b + 1); $b = (strpos($a, "/")); $model_name = substr($a, 0, $b); ?>
        <div class = "ui-panel">
            <form class = "layui-form"
                  name = "update_form"
                  action = "
                <?php if ($LoginUserInfo['role_info']['id'] == '2') { echo "/Manage/System/bpcheck"; }; ?>"
                  enctype = "multipart/form-data"
                  method = "post">
                <input type = "hidden"
                       name = "id"
                       value = "<?php echo ($data['id']); ?>">
                <div class = "layui-form-item">
                    <label class = "layui-form-label required">网站名称</label>
                    <div class = "layui-input-inline"
                         style = "width: 50%;margin-left: 10px;">

                        <input type = "text"
                               name = "bp_sitename"
                               value = "<?php echo ($data['bp_sitename']); ?>"
                               placeholder = "请填写您的网站名称"
                               autocomplete = "off"
                               class = "layui-input"
                            <?php if ($LoginUserInfo['role_info']['id'] !== '2') { echo 'readonly'; }; ?>>
                    </div>
                </div>
                <div class = "layui-form-item">
                    <label class = "layui-form-label required">网站地址</label>
                    <div class = "layui-input-inline"
                         style = "width: 50%;margin-left: 10px;">

                        <input type = "text"
                               name = "bp_site_url"
                               value = "<?php echo ($data['bp_site_url']); ?>"
                               placeholder = "请填写您的网站网址"
                               autocomplete = "off"
                               class = "layui-input"
                            <?php if ($LoginUserInfo['role_info']['id'] !== '2') { echo 'readonly'; }; ?>>
                    </div>
                </div>

                <div class = "layui-form-item">
                    <label class = "layui-form-label required">联系电话</label>
                    <div class = "layui-input-inline"
                         style = "width: 50%;margin-left: 10px;">
                        <input type = "text"
                               name = "bp_telephone"
                               value = "<?php echo ($data['bp_telephone']); ?>"
                               placeholder = "请填写您的手机号"
                               autocomplete = "off"
                               class = "layui-input"
                            <?php if ($LoginUserInfo['role_info']['id'] !== '2') { echo 'readonly'; }; ?>>
                    </div>
                </div>

                <div class = "layui-form-item">
                    <!-- <label class="layui-form-label required">登录图片</label>-->
                    <label class = "layui-form-label required">营业执照</label>
                    <div class = "layui-input-inline"
                         style = "width: 50%;">
                        <?php $skin =$login_page_image_arr['skin']; $attachmentid =$login_page_image_arr['fileid']; unset($attainfos); unset($attachmentids); if( $attachmentid ){ $attachmentids= explode("," , $attachmentid); if( $attachmentids ){ $map["id"] = array("IN",$attachmentids);$attainfos = D("File/File") -> queryRecordAll($map,null,"odernum");$ordernum_max = $attainfos[count($attainfos)-1]["odernum"] + 1;} }else{ } if( !$attainfos){ $atta["nofile"]="1";$attainfos[0] = $atta;} $attachmentname = $login_page_image_arr['attachmentname']; $isRequire = $login_page_image_arr['isrequire']; load("encode"); $guid = create_guid(); $guid = str_replace("-","",$guid ); $isimage =$login_page_image_arr['isimage']; if(!$suffix_temp){ if( $isimage == 1 ){ $suffix_temp ="png,jpg,gif,jpeg,bmp"; }else{ $suffix_temp ="zip,rar,xls,xlsx,txt,doc,docx,png,jpg,jpeg,pdf,bmp"; } } $suffix = D("File/File") -> combineSuffix($suffix_temp); $maxsize =$login_page_image_arr['maxsize']; if( !$maxsize ){ $maxsize = 30; } $attachmenttype =$login_page_image_arr['attachmenttype']; $cannotedit = $login_page_image_arr['cannotedit']; if( !$appid ){ $appid = "SYS_NAME"; } if( !$groupname ){ $groupname = "Manage"; } $tagname = $login_page_image_arr['tagname']; if( !$tagname ){ $tagname = "System"; } if( $truetablename ){ $truetablenames = explode("," , $truetablename); } if( $primarykey ){ $primarykeys = explode("," , $primarykey); } if( $primarykeyvalue ){ $primarykeyvalues = explode("," , $primarykeyvalues); } ?><div class="ui-uploader-form <?php  echo($style); ?>" style="padding: 2px;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $skin =="simple" ){ ?><ul class="ui-uploader-form-ul ui-attachment-list"><?php foreach( $attainfos as $key_dupload => $vo_dupload ){ $ordernum = $vo_dupload["odernum"]; ?><li class="ui-uploader-form-li <?php if( $isimage == "1"){ ?>isimg<?php } ?>"><?php if( $attachmentname ){ ?><span class="ui-uploader-form-filename"><?php if($key_dupload ==0 ) { echo($attachmentname); if( $isRequire == 1 ) { ?><span class="ui-form-required">*</span><?php } ?>:<?php } ?></span><?php } if( $attachmentname ){ ?><span class="ui-uploader-form-filefield-short"><?php }else{ ?><span class="ui-uploader-form-filefield-long"><?php } if( $vo_dupload["id"] ){ if( $isimage == "1"){ ?><div class="ui-uploader-form-img" style="display:none"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img"><img class="ui-img" src="/Manage/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>"><?php  if( $cannotedit != "1" && $model_name !== "Manage" && $data["bp_check"] !== "1" || $model_name == "Manage" && $LoginUserInfo["role_info"]["id"] == "2" && $data["bp_check"] !== "1") { ?><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Manage/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span><?php } }else{ ?><div class="ui-uploader-form-other" style="display:none"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div  id="child_div_<?php  echo($guid); ?>" ><?php  if( $cannotedit != "1") { ?><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Manage/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  /><?php } ?><a class="ui-uploader-form-a" id="a_<?php  echo($guid); ?>" target="_blank" href="/Manage/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>" ><?php  echo($vo_dupload["originalfilename"]) ?></a><?php } }else{ ?><div id="div_<?php  echo($guid); ?>" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $cannotedit ==1){ ?><span class="nofile">还未上传相关附件</span><input name="uploadField[]" type="file" class="ui-input hide"  id="<?php  echo($guid); ?>"  disabled <?php if( $isRequire == 1 ) { } ?>/><?php }else{ if( $isimage == "1"){ ?><div class="ui-uploader-form-img"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img" style="display: none" ><img class="ui-img" /><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete"></span><?php }else{ ?><div class="ui-uploader-form-other"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div style="display: none" id="child_div_<?php  echo($guid); ?>" ><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button " type="button" value="删除"/><a class="ui-uploader-form-a" target="_blank"></a><?php } } } ?><input type="hidden" name="fileurl[]" id="fileurl_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["fileurl"]) ?>"/><input type="hidden" name="filepath[]" id="filepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["filepath"]) ?>"/><input type="hidden" name="savepath[]" id="savepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["savepath"]) ?>"/><input type="hidden" name="orifilename[]" id="orifilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["originalfilename"]) ?>"/><input type="hidden" name="formatfilename[]" id="formatfilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["formatfilename"]) ?>" /><?php if( $isRequire == 1 ) { ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="必填字段"/><?php }else{ ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" /><?php } ?><input type="hidden" name="filegroupid[]" id="filegroupid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["groupid"]) ?>" /></div><input type="hidden" name="uploadflag[]" id="uploadflag_<?php  echo($guid); ?>" value="0" /><input type="hidden" name="isdeleted[]" id="delflag_<?php  echo($guid); ?>"  value="0"><input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_<?php  echo($guid); ?>" /><input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" ><input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" /><input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" /><input type="hidden" name="guid[]" value="<?php  echo($guid); ?>" /><div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div></span><span style="display: inline-block;inline-block;float: left;width:5%;"><?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" ></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }else{ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" style="visibility: hidden"></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }?></span><script type="text/javascript">$(function($) {bindUploaderNew( "<?php  echo($guid); ?>", "/Manage/Upload/doUpload" ,"/Manage/Upload/downloadFile", "/Manage/Upload/delUploadFile" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>", "<?php echo($skin) ?>" );})</script></li><?php  } ?></ul><?php  }else{ ?><table class="ui-table ui-table-noborder ui-attachment-list" style="padding: 5px;border:none;border-left: none;border-right: none;border-bottom:none"><?php foreach( $attainfos as $key_dupload => $vo_dupload ){ $ordernum = $vo_dupload["odernum"]; ?><tr valign="top"><?php if( $attachmentname ){ ?><td width="30%;" valign="middle" align="left"><?php if($key_dupload ==0 ) { echo($attachmentname); if( $isRequire == 1 ) { ?><span class="ui-form-required">*</span><?php } ?>:<?php } ?></td><?php } ?><td valign="middle" align="left" width="30%;" style="padding:5px 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $vo_dupload["id"] ){ if( $isimage == "1"){ ?><div class="ui-uploader-form-img" style="display:none"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img"><img class="ui-img" src="/Manage/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>"><?php  if( $cannotedit != "1") { ?><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Manage/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span><?php } }else{ ?><div class="ui-uploader-form-other" style="display:none"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div  id="child_div_<?php  echo($guid); ?>" ><?php  if( $cannotedit != "1") { ?><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Manage/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  /><?php } ?><a class="ui-uploader-form-a" id="a_<?php  echo($guid); ?>" target="_blank" href="/Manage/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>" ><?php  echo($vo_dupload["originalfilename"]) ?></a><?php } }else{ ?><div id="div_<?php  echo($guid); ?>" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $cannotedit ==1){ ?><span class="nofile">还未上传相关附件</span><input name="uploadField[]" type="file" class="ui-input hide" id="<?php  echo($guid); ?>" disabled <?php if( $isRequire == 1 ) { } ?>/><?php }else{ if( $isimage == "1"){ ?><div class="ui-uploader-form-img"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img" style="display: none" ><img class="ui-img"><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete"></span><?php }else{ ?><div class="ui-uploader-form-other"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field"  id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div style="display: none" id="child_div_<?php  echo($guid); ?>" ><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button " type="button" value="删除"/><a class="ui-uploader-form-a" target="_blank"></a><?php } } } ?><input type="hidden" name="fileurl[]" id="fileurl_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["fileurl"]) ?>"/><input type="hidden" name="filepath[]" id="filepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["filepath"]) ?>"/><input type="hidden" name="savepath[]" id="savepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["savepath"]) ?>"/><input type="hidden" name="orifilename[]" id="orifilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["originalfilename"]) ?>"/><input type="hidden" name="formatfilename[]" id="formatfilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["formatfilename"]) ?>" /><?php if( $isRequire == 1 ) { ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="必填字段"/><?php }else{ ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" /><?php } ?><input type="hidden" name="filegroupid[]" id="filegroupid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["groupid"]) ?>" /></div><input type="hidden" name="uploadflag[]" id="uploadflag_<?php  echo($guid); ?>" value="0" /><input type="hidden" name="isdeleted[]" id="delflag_<?php  echo($guid); ?>"  value="0"><input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_<?php  echo($guid); ?>" /><input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" ><input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" /><input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" /><input type="hidden" name="guid[]" value="<?php  echo($guid); ?>" /><div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div></div></td><td valign="middle" align="left" width="5%"><?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" ></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }else{ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" style="visibility: hidden"></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }?></td><?php $attachmentdesc = $login_page_image_arr['attachmentdesc']; ?><td valign="middle" align="left" width="30%"><?php if( $attachmentdesc ){ if($key_dupload ==0 ) { echo($attachmentdesc); } }?></td></tr><script type="text/javascript">$(function($) {bindUploaderNew( "<?php  echo($guid); ?>", "/Manage/Upload/doUpload" ,"/Manage/Upload/downloadFile", "/Manage/Upload/delUploadFile" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>" );})</script></div><?php  } ?></table><?php  } ?></div><?php unset($cannotedit); unset($isimage); unset($attachmentid); unset($maxsize); unset($attachmentname); unset($attachmenttype); unset($attachmentdesc); unset($isrequire); unset($skin); unset($tagname); ?>
                    </div>
                    <div class = "layui-form-mid layui-word-aux">请使用5M以内图片上传</div>
                </div>

                <div class = "layui-form-item">
                    <label class = "layui-form-label required">系统logo</label>
                    <div class = "layui-input-inline"
                         style = "width: 50%;">
                        <?php $skin =$loginpage_logo_image_arr['skin']; $attachmentid =$loginpage_logo_image_arr['fileid']; unset($attainfos); unset($attachmentids); if( $attachmentid ){ $attachmentids= explode("," , $attachmentid); if( $attachmentids ){ $map["id"] = array("IN",$attachmentids);$attainfos = D("File/File") -> queryRecordAll($map,null,"odernum");$ordernum_max = $attainfos[count($attainfos)-1]["odernum"] + 1;} }else{ } if( !$attainfos){ $atta["nofile"]="1";$attainfos[0] = $atta;} $attachmentname = $loginpage_logo_image_arr['attachmentname']; $isRequire = $loginpage_logo_image_arr['isrequire']; load("encode"); $guid = create_guid(); $guid = str_replace("-","",$guid ); $isimage =$loginpage_logo_image_arr['isimage']; if(!$suffix_temp){ if( $isimage == 1 ){ $suffix_temp ="png,jpg,gif,jpeg,bmp"; }else{ $suffix_temp ="zip,rar,xls,xlsx,txt,doc,docx,png,jpg,jpeg,pdf,bmp"; } } $suffix = D("File/File") -> combineSuffix($suffix_temp); $maxsize =$loginpage_logo_image_arr['maxsize']; if( !$maxsize ){ $maxsize = 30; } $attachmenttype =$loginpage_logo_image_arr['attachmenttype']; $cannotedit = $loginpage_logo_image_arr['cannotedit']; if( !$appid ){ $appid = "SYS_NAME"; } if( !$groupname ){ $groupname = "Manage"; } $tagname = $loginpage_logo_image_arr['tagname']; if( !$tagname ){ $tagname = "System"; } if( $truetablename ){ $truetablenames = explode("," , $truetablename); } if( $primarykey ){ $primarykeys = explode("," , $primarykey); } if( $primarykeyvalue ){ $primarykeyvalues = explode("," , $primarykeyvalues); } ?><div class="ui-uploader-form <?php  echo($style); ?>" style="padding: 2px;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $skin =="simple" ){ ?><ul class="ui-uploader-form-ul ui-attachment-list"><?php foreach( $attainfos as $key_dupload => $vo_dupload ){ $ordernum = $vo_dupload["odernum"]; ?><li class="ui-uploader-form-li <?php if( $isimage == "1"){ ?>isimg<?php } ?>"><?php if( $attachmentname ){ ?><span class="ui-uploader-form-filename"><?php if($key_dupload ==0 ) { echo($attachmentname); if( $isRequire == 1 ) { ?><span class="ui-form-required">*</span><?php } ?>:<?php } ?></span><?php } if( $attachmentname ){ ?><span class="ui-uploader-form-filefield-short"><?php }else{ ?><span class="ui-uploader-form-filefield-long"><?php } if( $vo_dupload["id"] ){ if( $isimage == "1"){ ?><div class="ui-uploader-form-img" style="display:none"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img"><img class="ui-img" src="/Manage/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>"><?php  if( $cannotedit != "1" && $model_name !== "Manage" && $data["bp_check"] !== "1" || $model_name == "Manage" && $LoginUserInfo["role_info"]["id"] == "2" && $data["bp_check"] !== "1") { ?><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Manage/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span><?php } }else{ ?><div class="ui-uploader-form-other" style="display:none"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div  id="child_div_<?php  echo($guid); ?>" ><?php  if( $cannotedit != "1") { ?><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Manage/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  /><?php } ?><a class="ui-uploader-form-a" id="a_<?php  echo($guid); ?>" target="_blank" href="/Manage/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>" ><?php  echo($vo_dupload["originalfilename"]) ?></a><?php } }else{ ?><div id="div_<?php  echo($guid); ?>" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $cannotedit ==1){ ?><span class="nofile">还未上传相关附件</span><input name="uploadField[]" type="file" class="ui-input hide"  id="<?php  echo($guid); ?>"  disabled <?php if( $isRequire == 1 ) { } ?>/><?php }else{ if( $isimage == "1"){ ?><div class="ui-uploader-form-img"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img" style="display: none" ><img class="ui-img" /><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete"></span><?php }else{ ?><div class="ui-uploader-form-other"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div style="display: none" id="child_div_<?php  echo($guid); ?>" ><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button " type="button" value="删除"/><a class="ui-uploader-form-a" target="_blank"></a><?php } } } ?><input type="hidden" name="fileurl[]" id="fileurl_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["fileurl"]) ?>"/><input type="hidden" name="filepath[]" id="filepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["filepath"]) ?>"/><input type="hidden" name="savepath[]" id="savepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["savepath"]) ?>"/><input type="hidden" name="orifilename[]" id="orifilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["originalfilename"]) ?>"/><input type="hidden" name="formatfilename[]" id="formatfilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["formatfilename"]) ?>" /><?php if( $isRequire == 1 ) { ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="必填字段"/><?php }else{ ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" /><?php } ?><input type="hidden" name="filegroupid[]" id="filegroupid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["groupid"]) ?>" /></div><input type="hidden" name="uploadflag[]" id="uploadflag_<?php  echo($guid); ?>" value="0" /><input type="hidden" name="isdeleted[]" id="delflag_<?php  echo($guid); ?>"  value="0"><input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_<?php  echo($guid); ?>" /><input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" ><input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" /><input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" /><input type="hidden" name="guid[]" value="<?php  echo($guid); ?>" /><div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div></span><span style="display: inline-block;inline-block;float: left;width:5%;"><?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" ></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }else{ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" style="visibility: hidden"></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }?></span><script type="text/javascript">$(function($) {bindUploaderNew( "<?php  echo($guid); ?>", "/Manage/Upload/doUpload" ,"/Manage/Upload/downloadFile", "/Manage/Upload/delUploadFile" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>", "<?php echo($skin) ?>" );})</script></li><?php  } ?></ul><?php  }else{ ?><table class="ui-table ui-table-noborder ui-attachment-list" style="padding: 5px;border:none;border-left: none;border-right: none;border-bottom:none"><?php foreach( $attainfos as $key_dupload => $vo_dupload ){ $ordernum = $vo_dupload["odernum"]; ?><tr valign="top"><?php if( $attachmentname ){ ?><td width="30%;" valign="middle" align="left"><?php if($key_dupload ==0 ) { echo($attachmentname); if( $isRequire == 1 ) { ?><span class="ui-form-required">*</span><?php } ?>:<?php } ?></td><?php } ?><td valign="middle" align="left" width="30%;" style="padding:5px 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $vo_dupload["id"] ){ if( $isimage == "1"){ ?><div class="ui-uploader-form-img" style="display:none"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img"><img class="ui-img" src="/Manage/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>"><?php  if( $cannotedit != "1") { ?><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Manage/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span><?php } }else{ ?><div class="ui-uploader-form-other" style="display:none"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div  id="child_div_<?php  echo($guid); ?>" ><?php  if( $cannotedit != "1") { ?><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Manage/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  /><?php } ?><a class="ui-uploader-form-a" id="a_<?php  echo($guid); ?>" target="_blank" href="/Manage/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>" ><?php  echo($vo_dupload["originalfilename"]) ?></a><?php } }else{ ?><div id="div_<?php  echo($guid); ?>" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $cannotedit ==1){ ?><span class="nofile">还未上传相关附件</span><input name="uploadField[]" type="file" class="ui-input hide" id="<?php  echo($guid); ?>" disabled <?php if( $isRequire == 1 ) { } ?>/><?php }else{ if( $isimage == "1"){ ?><div class="ui-uploader-form-img"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img" style="display: none" ><img class="ui-img"><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete"></span><?php }else{ ?><div class="ui-uploader-form-other"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field"  id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div style="display: none" id="child_div_<?php  echo($guid); ?>" ><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button " type="button" value="删除"/><a class="ui-uploader-form-a" target="_blank"></a><?php } } } ?><input type="hidden" name="fileurl[]" id="fileurl_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["fileurl"]) ?>"/><input type="hidden" name="filepath[]" id="filepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["filepath"]) ?>"/><input type="hidden" name="savepath[]" id="savepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["savepath"]) ?>"/><input type="hidden" name="orifilename[]" id="orifilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["originalfilename"]) ?>"/><input type="hidden" name="formatfilename[]" id="formatfilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["formatfilename"]) ?>" /><?php if( $isRequire == 1 ) { ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="必填字段"/><?php }else{ ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" /><?php } ?><input type="hidden" name="filegroupid[]" id="filegroupid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["groupid"]) ?>" /></div><input type="hidden" name="uploadflag[]" id="uploadflag_<?php  echo($guid); ?>" value="0" /><input type="hidden" name="isdeleted[]" id="delflag_<?php  echo($guid); ?>"  value="0"><input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_<?php  echo($guid); ?>" /><input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" ><input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" /><input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" /><input type="hidden" name="guid[]" value="<?php  echo($guid); ?>" /><div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div></div></td><td valign="middle" align="left" width="5%"><?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" ></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }else{ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" style="visibility: hidden"></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }?></td><td valign="middle" align="left" width="30%"><?php if( $attachmentdesc ){ if($key_dupload ==0 ) { echo($attachmentdesc); } }?></td></tr><script type="text/javascript">$(function($) {bindUploaderNew( "<?php  echo($guid); ?>", "/Manage/Upload/doUpload" ,"/Manage/Upload/downloadFile", "/Manage/Upload/delUploadFile" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>" );})</script></div><?php  } ?></table><?php  } ?></div><?php unset($cannotedit); unset($isimage); unset($attachmentid); unset($maxsize); unset($attachmentname); unset($attachmenttype); unset($isrequire); unset($skin); unset($tagname); ?>
                    </div>
                    <div class = "layui-form-mid layui-word-aux">请使用透明背景，白色字体logo，图片大小 180 * 60 (具体根据显示效果来定)</div>
                </div>
                <?php if ($LoginUserInfo['role_info']['id'] == '2') { ?>
                    <div class = "layui-form-item layui-form-text">
                        <label class = "layui-form-label required">相关附件</label>
                        <div class = "layui-input-inline"
                             style = "width: 50%;">
                            <?php $skin =$logo_image_arr['skin']; $attachmentid =$logo_image_arr['fileid']; unset($attainfos); unset($attachmentids); if( $attachmentid ){ $attachmentids= explode("," , $attachmentid); if( $attachmentids ){ $map["id"] = array("IN",$attachmentids);$attainfos = D("File/File") -> queryRecordAll($map,null,"odernum");$ordernum_max = $attainfos[count($attainfos)-1]["odernum"] + 1;} }else{ } if( !$attainfos){ $atta["nofile"]="1";$attainfos[0] = $atta;} $attachmentname = $logo_image_arr['attachmentname']; $isRequire = $logo_image_arr['isrequire']; load("encode"); $guid = create_guid(); $guid = str_replace("-","",$guid ); if(!$suffix_temp){ if( $isimage == 1 ){ $suffix_temp ="png,jpg,gif,jpeg,bmp"; }else{ $suffix_temp ="zip,rar,xls,xlsx,txt,doc,docx,png,jpg,jpeg,pdf,bmp"; } } $suffix = D("File/File") -> combineSuffix($suffix_temp); $maxsize =$logo_image_arr['maxsize']; if( !$maxsize ){ $maxsize = 30; } $attachmenttype =$logo_image_arr['attachmenttype']; $cannotedit = $logo_image_arr['cannotedit']; if( !$appid ){ $appid = "SYS_NAME"; } if( !$groupname ){ $groupname = "Manage"; } $tagname = $logo_image_arr['tagname']; if( !$tagname ){ $tagname = "System"; } if( $truetablename ){ $truetablenames = explode("," , $truetablename); } if( $primarykey ){ $primarykeys = explode("," , $primarykey); } if( $primarykeyvalue ){ $primarykeyvalues = explode("," , $primarykeyvalues); } ?><div class="ui-uploader-form <?php  echo($style); ?>" style="padding: 2px;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $skin =="simple" ){ ?><ul class="ui-uploader-form-ul ui-attachment-list"><?php foreach( $attainfos as $key_dupload => $vo_dupload ){ $ordernum = $vo_dupload["odernum"]; ?><li class="ui-uploader-form-li <?php if( $isimage == "1"){ ?>isimg<?php } ?>"><?php if( $attachmentname ){ ?><span class="ui-uploader-form-filename"><?php if($key_dupload ==0 ) { echo($attachmentname); if( $isRequire == 1 ) { ?><span class="ui-form-required">*</span><?php } ?>:<?php } ?></span><?php } if( $attachmentname ){ ?><span class="ui-uploader-form-filefield-short"><?php }else{ ?><span class="ui-uploader-form-filefield-long"><?php } if( $vo_dupload["id"] ){ if( $isimage == "1"){ ?><div class="ui-uploader-form-img" style="display:none"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img"><img class="ui-img" src="/Manage/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>"><?php  if( $cannotedit != "1" && $model_name !== "Manage" && $data["bp_check"] !== "1" || $model_name == "Manage" && $LoginUserInfo["role_info"]["id"] == "2" && $data["bp_check"] !== "1") { ?><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Manage/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span><?php } }else{ ?><div class="ui-uploader-form-other" style="display:none"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div  id="child_div_<?php  echo($guid); ?>" ><?php  if( $cannotedit != "1") { ?><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Manage/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  /><?php } ?><a class="ui-uploader-form-a" id="a_<?php  echo($guid); ?>" target="_blank" href="/Manage/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>" ><?php  echo($vo_dupload["originalfilename"]) ?></a><?php } }else{ ?><div id="div_<?php  echo($guid); ?>" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $cannotedit ==1){ ?><span class="nofile">还未上传相关附件</span><input name="uploadField[]" type="file" class="ui-input hide"  id="<?php  echo($guid); ?>"  disabled <?php if( $isRequire == 1 ) { } ?>/><?php }else{ if( $isimage == "1"){ ?><div class="ui-uploader-form-img"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img" style="display: none" ><img class="ui-img" /><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete"></span><?php }else{ ?><div class="ui-uploader-form-other"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div style="display: none" id="child_div_<?php  echo($guid); ?>" ><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button " type="button" value="删除"/><a class="ui-uploader-form-a" target="_blank"></a><?php } } } ?><input type="hidden" name="fileurl[]" id="fileurl_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["fileurl"]) ?>"/><input type="hidden" name="filepath[]" id="filepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["filepath"]) ?>"/><input type="hidden" name="savepath[]" id="savepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["savepath"]) ?>"/><input type="hidden" name="orifilename[]" id="orifilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["originalfilename"]) ?>"/><input type="hidden" name="formatfilename[]" id="formatfilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["formatfilename"]) ?>" /><?php if( $isRequire == 1 ) { ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="必填字段"/><?php }else{ ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" /><?php } ?><input type="hidden" name="filegroupid[]" id="filegroupid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["groupid"]) ?>" /></div><input type="hidden" name="uploadflag[]" id="uploadflag_<?php  echo($guid); ?>" value="0" /><input type="hidden" name="isdeleted[]" id="delflag_<?php  echo($guid); ?>"  value="0"><input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_<?php  echo($guid); ?>" /><input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" ><input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" /><input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" /><input type="hidden" name="guid[]" value="<?php  echo($guid); ?>" /><div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div></span><span style="display: inline-block;inline-block;float: left;width:5%;"><?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" ></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }else{ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" style="visibility: hidden"></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }?></span><script type="text/javascript">$(function($) {bindUploaderNew( "<?php  echo($guid); ?>", "/Manage/Upload/doUpload" ,"/Manage/Upload/downloadFile", "/Manage/Upload/delUploadFile" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>", "<?php echo($skin) ?>" );})</script></li><?php  } ?></ul><?php  }else{ ?><table class="ui-table ui-table-noborder ui-attachment-list" style="padding: 5px;border:none;border-left: none;border-right: none;border-bottom:none"><?php foreach( $attainfos as $key_dupload => $vo_dupload ){ $ordernum = $vo_dupload["odernum"]; ?><tr valign="top"><?php if( $attachmentname ){ ?><td width="30%;" valign="middle" align="left"><?php if($key_dupload ==0 ) { echo($attachmentname); if( $isRequire == 1 ) { ?><span class="ui-form-required">*</span><?php } ?>:<?php } ?></td><?php } ?><td valign="middle" align="left" width="30%;" style="padding:5px 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $vo_dupload["id"] ){ if( $isimage == "1"){ ?><div class="ui-uploader-form-img" style="display:none"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img"><img class="ui-img" src="/Manage/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>"><?php  if( $cannotedit != "1") { ?><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Manage/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span><?php } }else{ ?><div class="ui-uploader-form-other" style="display:none"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div  id="child_div_<?php  echo($guid); ?>" ><?php  if( $cannotedit != "1") { ?><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("<?php  echo($guid); ?>",<?php echo($vo_dupload["id"]) ?>,"/Manage/Upload/delUploadFile","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  /><?php } ?><a class="ui-uploader-form-a" id="a_<?php  echo($guid); ?>" target="_blank" href="/Manage/Upload/downloadFile/id/<?php  echo($vo_dupload["id"]) ?>" ><?php  echo($vo_dupload["originalfilename"]) ?></a><?php } }else{ ?><div id="div_<?php  echo($guid); ?>" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"><?php if( $cannotedit ==1){ ?><span class="nofile">还未上传相关附件</span><input name="uploadField[]" type="file" class="ui-input hide" id="<?php  echo($guid); ?>" disabled <?php if( $isRequire == 1 ) { } ?>/><?php }else{ if( $isimage == "1"){ ?><div class="ui-uploader-form-img"><input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div class="ui-uploader-form-show-img" style="display: none" ><img class="ui-img"><span  id="btn_del_<?php  echo($guid); ?>" class="ui-icon-delete"></span><?php }else{ ?><div class="ui-uploader-form-other"><input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field"  id="<?php  echo($guid); ?>" <?php if( $isRequire == 1 ) { } ?>/></div><div style="display: none" id="child_div_<?php  echo($guid); ?>" ><input  id="btn_del_<?php  echo($guid); ?>" class="ui-uploader-form-button " type="button" value="删除"/><a class="ui-uploader-form-a" target="_blank"></a><?php } } } ?><input type="hidden" name="fileurl[]" id="fileurl_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["fileurl"]) ?>"/><input type="hidden" name="filepath[]" id="filepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["filepath"]) ?>"/><input type="hidden" name="savepath[]" id="savepath_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["savepath"]) ?>"/><input type="hidden" name="orifilename[]" id="orifilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["originalfilename"]) ?>"/><input type="hidden" name="formatfilename[]" id="formatfilename_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["formatfilename"]) ?>" /><?php if( $isRequire == 1 ) { ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="必填字段"/><?php }else{ ?><input type="hidden" name="fileid[]" id="fileid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["id"]) ?>" /><?php } ?><input type="hidden" name="filegroupid[]" id="filegroupid_<?php  echo($guid); ?>" value="<?php echo($vo_dupload["groupid"]) ?>" /></div><input type="hidden" name="uploadflag[]" id="uploadflag_<?php  echo($guid); ?>" value="0" /><input type="hidden" name="isdeleted[]" id="delflag_<?php  echo($guid); ?>"  value="0"><input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_<?php  echo($guid); ?>" /><input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" ><input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" /><input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" /><input type="hidden" name="guid[]" value="<?php  echo($guid); ?>" /><div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div></div></td><td valign="middle" align="left" width="5%"><?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" ></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }else{ ?><div class="ui-uploader-form-add" id="div_add_<?php  echo($guid); ?>" style="visibility: hidden"></div><input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>"><?php }?></td><?php $attachmentdesc = $logo_image_arr['attachmentdesc']; ?><td valign="middle" align="left" width="30%"><?php if( $attachmentdesc ){ if($key_dupload ==0 ) { echo($attachmentdesc); } }?></td></tr><script type="text/javascript">$(function($) {bindUploaderNew( "<?php  echo($guid); ?>", "/Manage/Upload/doUpload" ,"/Manage/Upload/downloadFile", "/Manage/Upload/delUploadFile" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>" );})</script></div><?php  } ?></table><?php  } ?></div><?php unset($cannotedit); unset($attachmentid); unset($maxsize); unset($attachmentname); unset($attachmenttype); unset($attachmentdesc); unset($isrequire); unset($skin); unset($tagname); ?>
                        </div>
                        <div class = "layui-form-mid layui-word-aux">请下载模板文档填写后上传</div>
                    </div>

                    <div class = "layui-form-item">
                        <label class = "layui-form-label "></label>
                        <!--  <div class = "layui-input-inline"
                              style = "width: 50%;">
                            <a class = "sel_btn  ch_cls" href = "/Manage/Upload/downloadFile/id/92"  download="mitong">点击下载模板文档</a>
                        </div>-->
                        <div class = "sel_btn  ch_cls"   id="download" style="width: 150px;cursor: pointer">
                            点击下载模板文档
                        </div>
                        <script>
                            $("#download").click(function(){
                                window.open("http://www.mitong.com/Manage/Upload/downloadFile/id/92");
                            });
                        </script>
                    </div>
                <?php } ?>
                <div class = "layui-form-item">
                    <label class = "layui-form-label required">套餐类型</label>
                    <div class = "layui-input-inline">
                        <select first = "请选择套餐种类"
                                id = "bp_combo_id"
                                name = "bp_combo" disabled="disabled">
                            <option
                                <?php if ($data['bp_combo'] == '1') { echo 'selected'; }; ?> value = "1">季度
                            </option>
                            <option
                                <?php if ($data['bp_combo'] == '2') { echo 'selected'; }; ?> value = "2">半年
                            </option>
                            <option
                                <?php if ($data['bp_combo'] == '3') { echo 'selected'; }; ?> value = "3">一年
                            </option>
                        </select>
                          <div class = "layui-input-inline" style="display: inline">
                                <input type = "text"
                                   name = "bp_price"
                              <?php if($data['bp_price'] == 0): ?>value=""<?php else: ?>value = "<?php echo ($data["bp_price"]); ?>" disabled="disabled"<?php endif; ?>
                                   placeholder = "请填写霸屏价格"
                                   autocomplete = "off"
                                   class = "layui-input">
                        </div>
                    </div>
                </div>




                <?php if ($LoginUserInfo['role_info']['id'] == '2') { ?>
                    <div class = "layui-form-item">
                        <label class = "layui-form-label required">下单审核</label>
                        <div class = "layui-input-inline">
                            <select first = "请审核"
                                    name = "bp_check" <?php if ($data['bp_check'] == '1' || $data['bp_check'] == '2'){ echo 'disabled'; }; ?>>
                                <option
                                    <?php if ($data['bp_check'] == '2') { echo 'selected'; }; ?> value = "2">审核驳回
                                </option>
                                <option
                                    <?php if ($data['bp_check'] == '1') { echo 'selected'; }; ?> value = "1">审核通过
                                </option>
                            </select>
                        </div>
                    </div>
                <?php }; ?>
                <?php if ($LoginUserInfo['role_info']['id'] == '2'){ ?>

                    <?php if ($data['bp_check']=='1'){ ?>
                        <div class = "layui-form-item">
                            <label class = "layui-form-label required">效果监控</label>
                            <div class = "layui-input-inline"
                                 style = "width: 50%;margin-left: 10px;">
                                <input type = "text"
                                       name = "bp_mosite_url"
                                       value = "<?php echo ($data['bp_mosite_url']); ?>"
                                       placeholder = "请填写效果监控网址"
                                       autocomplete = "off"
                                       class = "layui-input"
                            </div>
                        </div>
                    <?php } ;?>

                <div class = "layui-form-item" style="margin-top: 30px">
                    <div class = "layui-input-block">
                        <button class = "layui-btn"
                                lay-submit = ""
                                lay-filter = "go"><?php if ($data['bp_check'] == '1'||$data['bp_check'] == '2') { echo '更新'; }else{ echo '审核'; }; ?>
                        </button>
                        <?php if($data['bp_check'] == '1'): ?><a href="/Manage/System/tuitecheckRecord?id=<?php echo ($data['id']); ?>" style="margin-left: 50px">
                                <div style="" class="layui-btn">退单</div>
                            </a><?php endif; ?>
                    </div>
                </div>
                    <?php }; ?>

            </form>
        </div>
    </div>
    <!-- 页面底部 begin  -->
    <style>
.jqadmin-foot {
    height: 30px;
    padding: 5px 0;
    line-height: 30px;
    text-align: center;
    color: #666;
    font-weight: 300;
    border-left: 1px solid #1AA094;
    border-top: 1px solid #DDD;
    z-index: 998;
}
</style>
<!-- <div class="layui-footer jqadmin-foot" style="left: 200px;">
     <div class="layui-mian">
         <p class="jqadmin-copyright">
             <span class="layui">2017 ©</span> Write by Paco,<a href="http://www.jqcool.net">jQAdmin</a>. 版权所有 <span class="layui">依赖前端框架layui</span>
         </p>
     </div>
 </div> -->
    <!-- 页面底部 end  -->

</body>
</html>