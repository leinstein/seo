<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>{$page_title}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="dejax">
<script>
<!--
  var URL       				= '__URL__';
  var APP       				= '__APP__';
  var GROUP       			= '__GROUP__';
  var ACTION_NAME   = '<php>echo ACTION_NAME;</php>';
  var MODULE_NAME = '<php>echo MODULE_NAME;</php>';
  var PUBLIC      			= '__PUBLIC__';
  var PUBLIC_RES 		= '{$PublicRes}';
  var PUBLIC_JS 			= '{$PublicJs}';
  var APP_PUBLIC    	= '../Public/';
  var ROOT      				= '__ROOT__';
  var ROOT_URL      		= '{$RootUrl}';
  var CURL      				= '{$CURRENT_URL}';
  var PREURL      			= '{$PRE_URL}';
  var MY_ID 					= '{$LoginUserId}';
  var MY_NAME 			= '{$LoginUserName}';
//-->
</script>

<link href="{$PublicRes}/css/aliceui/aliceui-local.css" rel="stylesheet">
<link href="{$PublicRes}/css/icons/iconfont.css" rel="stylesheet">
<link href="{$PublicRes}/css/arale/dialog.css" rel="stylesheet">
<link href="{$PublicRes}/css/reset-alice.css" rel="stylesheet">

<php>if(  APP_ENVIRONMENT == 'local') {</php>
<!-- css调试开发模式 -->
<link href="{$PublicRes}/css/modules/ui-attachment.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-base.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-box.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-data-preview.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-footer.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-form.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-head.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-icon-list.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-icon.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-layout.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-list.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-log.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-logo.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-menu.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-nav.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-page.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-panel.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-section.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-space.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-tabbutton.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-table.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-top-userpanel.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-user-notify.css" rel="stylesheet">
<link href="{$PublicRes}/css/modules/ui-util.css" rel="stylesheet">
<php>}else{</php>
<!-- css生产模式 -->
<link href="{$PublicRes}/css/modules/epitomi-debug.css?t=20160131" rel="stylesheet">
<php>};</php>
<link href="{$PublicRes}/css/modules/ui-widescreen.css" rel="stylesheet">
<link href="{$PublicRes}/css/style.css" rel="stylesheet">
<link href="{$PublicRes}/css/short.css" rel="stylesheet">
<link href="../Public/css/style.css" rel="stylesheet">

<!-- HTML5 and CSS3 for IE6-8 support of HTML5 and CSS3 elements -->
<!--[if lt IE 9]>
<script src="{$PublicJs}/js/html5shiv.js"></script>
<![endif]-->

<!-- 全局js begin -->
<script src="{$PublicJs}/js/jquery/jquery.1.8.1.min.js"></script>
<script src="{$PublicJs}/js/sea-modules/layer/2.2/layer.js"></script>
<script src="{$PublicJs}/js/cookie/jquery.cookie.js"></script>
<script src="{$PublicJs}/js/easydropdown/jquery.easydropdown.min.js"></script>
<link href="{$PublicJs}/js/easydropdown/theme/easydropdown.css" rel="stylesheet">
<script src="{$PublicJs}/js/sea-modules/seajs/seajs/2.2.1/sea.js"></script>
<script src="{$PublicJs}/js/sea-modules/seajs/seajs-style/1.1.0/seajs-style.js"></script>

<!-- 全局参数js begin -->
<script src="{$PublicJs}/js/arguments.js"></script>
<!-- 全局参数js end -->

<!-- 公共js begin -->
<script src="{$PublicJs}/js/common.js"></script>
<!-- 公共js begin -->

<!-- 上传插件js begin-->
<script src="{$PublicJs}/js/upload/jquery.upload.js"></script>
<link rel="stylesheet" type="text/css" href="{$PublicRes}/css/upload/upload.css">
<!-- 上传插件js end-->

<!-- 遮罩层 begin   -->
<script type="text/javascript" src="{$PublicJs}/js/overlay.js"></script>
<!-- 遮罩层 end   -->

<!-- 正则验证js begin -->
<script src="{$PublicJs}/js/regular.js"></script>
<!-- 正则验证js end -->

<script type="text/javascript">

	seajs.config({
		base: '{$PublicJs}/js/sea-modules/',
		alias: {
			  '$': 'jquery/jquery/1.7.2/jquery',
			  'position': 'arale/position/1.0.1/position',
			  'validator': 'arale/validator/0.9.6/validator',
			  'widget': 'arale/widget/1.1.1/widget',
			  'dialog': 'arale/dialog/1.3.1/dialog',
			  'popup': 'arale/popup/1.1.5/popup',
			  'tip': 'arale/tip/1.2.1/tip',
			  'tabs':'arale/switchable/1.0.2/tabs',
			  'select':'arale/select/0.9.8/select',
			  'placeholder':'arale/placeholder/1.1.0/placeholder',
			  'calendar':'arale/calendar/1.0.0/calendar',
			  'autocomplete':'arale/autocomplete/1.3.2/autocomplete'
		}
	});
	
	//全局加载
	$(function(){
		
		//弹出提示，方法：在class中写入pop-tip，表示会弹出，在poptip中写入要提示的内容
		seajs.use(['tip'], function(Tip){
			
			//一般提示，鼠标移动弹出
			var t = new Tip({
			    trigger: '.pop-tip',
			    theme: 'white',
			    effect: 'fade',
			    inViewport: true,
			    arrowPosition: 1
			});
			
			t.before('show', function() {
			    this.set('content', this.activeTrigger.attr("poptip"));
			});
			
			//动态提示，直接弹出
			var dymic_tip = new Tip({
			    trigger: '.pop-tip-impt',
			    effect: 'fade',
			    inViewport: true,
			    arrowPosition: 1
			});
			
			dymic_tip.before('show', function() {
			    this.set('content', this.activeTrigger.attr("poptip"));
			});
			
			if( $(".pop-tip-impt").length >0 )
				dymic_tip.show();
		});
		
	});
</script>
<!-- 全局js end -->