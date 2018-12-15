<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
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
		    url: "{:U('Upload/doUpload1')}" //接口url
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
<taglib name="dupload" />
<!-- 引入上传组件标签库 end -->
<!-- 引入上传组件js和css文件 begin -->
<dupload:script name="dupload"/>
<!-- 引入上传组件js和css文件 end-->

</head>
<body>
    <!-- 页面顶部 logo & 菜单 begin -->
    <include file="../Public/top_banner" />
    <!-- 页面顶部 logo & 菜单 end -->
    <!-- 页面左侧菜单 begin -->
    <include file="../Public/left_home" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
        
		<!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>系统基本配置</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        
        <div class="ui-content" id="ui-content">
            <div class="ui-panel">	            
	           	<form class="layui-form" name="update_form" action="__URL__/update" enctype="multipart/form-data" method="post" onkeydown="if(event.keyCode==13){return false;}">			
					<input type="hidden" name="id" value="{$data['id']}">
					
					<!-- <div class="layui-form-item">
						<label class="layui-form-label">登录地址</label>
						<div class="layui-input-block">
							<input type="text" name="login_page_address"  value="{$data['login_page_address']}" placeholder="请填写用户登录网址"  autocomplete="off" class="layui-input">
						</div>
					</div> -->
					
					<div class="layui-form-item">
						<label class="layui-form-label required">系统名称</label>
						<div class="layui-input-inline" style="width: 50%;margin-left: 10px;">
							<input type="text" name="page_title"  value="{$data['page_title']}" placeholder="请填写系统主页名称"  autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux">该参数显示在浏览器的title中</div>
					</div>
					<!-- <div class="layui-form-item">
						<label class="layui-form-label required">产品名称</label>
						<div class="layui-input-inline" style="width: 50%;margin-left: 10px;">
							<input type="text" name="product_name"  value="{$data['product_name']}"  placeholder="请填写产品名称"  autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux"></div>
					</div> -->
					<div class="layui-form-item">
						<label class="layui-form-label required">登录地址</label>
						<div class="layui-input-inline" style="width: 50%;margin-left: 10px;">
							<input type="text" name="home_page_address"  value="{$data['home_page_address']}"  placeholder="请填写系统主页地址"  autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux"></div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label required">客服名称</label>
						<div class="layui-input-inline" style="width: 50%;margin-left: 10px;">
							<input type="text" name="customer"  value="{$data['customer']}"  placeholder="请填写客服名称"  autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux"></div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label required">客服电话</label>
						<div class="layui-input-inline" style="width: 50%;margin-left: 10px;">
							<input type="text" name="telephone"  value="{$data['telephone']}" placeholder="请填写客服联系电话"  autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux">固定电话格式为：xxxx-xxxxxxxx</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label required">客服QQ</label>
						<div class="layui-input-inline" style="width: 50%;margin-left: 10px;">
							<input type="text" name="QQnumber"  value="{$data['QQnumber']}"  required="" lay-verify="verifyQQ" placeholder="请填写客服QQ号码"  autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux"></div>
					</div>	
					
					
					<div class="layui-form-item">
						<label class="layui-form-label required">登录图片</label>
						<div class="layui-input-inline" style="width: 50%;">
							<dupload:upload 
									cannotedit = "login_page_image_arr['cannotedit']"
									isimage = "login_page_image_arr['isimage']"
									attachmentid = "login_page_image_arr['fileid']"
									maxsize="login_page_image_arr['maxsize']" 
									attachmentname="login_page_image_arr['attachmentname']"
									attachmenttype="login_page_image_arr['attachmenttype']" 
									attachmentdesc="login_page_image_arr['attachmentdesc']" 
									isrequire="login_page_image_arr['isrequire']" 
									skin ="login_page_image_arr['skin']"
									tagname="login_page_image_arr['tagname']">
								</dupload:upload>
						</div>
						<div class="layui-form-mid layui-word-aux">图片大小 1590*660(具体根据显示效果来定)</div>
					</div>	
					
					<div class="layui-form-item">
						<label class="layui-form-label required">登录页logo</label>
						<div class="layui-input-inline" style="width: 50%;">
							<dupload:upload 
									cannotedit = "loginpage_logo_image_arr['cannotedit']"
									isimage = "loginpage_logo_image_arr['isimage']"
									attachmentid = "loginpage_logo_image_arr['fileid']"
									maxsize="loginpage_logo_image_arr['maxsize']" 
									attachmentname="loginpage_logo_image_arr['attachmentname']"
									attachmenttype="loginpage_logo_image_arr['attachmenttype']" 
									isrequire="loginpage_logo_image_arr['isrequire']" 
									skin ="loginpage_logo_image_arr['skin']"
									tagname="loginpage_logo_image_arr['tagname']">
								</dupload:upload>
						</div>
						<div class="layui-form-mid layui-word-aux">图片大小200 * 80 (具体根据显示效果来定)</div>
					</div>
					
					<div class="layui-form-item">
						<label class="layui-form-label required">系统logo</label>
						<div class="layui-input-inline" style="width: 50%;">
							<dupload:upload 
									cannotedit = "logo_image_arr['cannotedit']"
									isimage = "logo_image_arr['isimage']"
									attachmentid = "logo_image_arr['fileid']"
									maxsize="logo_image_arr['maxsize']" 
									attachmentname="logo_image_arr['attachmentname']"
									attachmenttype="logo_image_arr['attachmenttype']" 
									isrequire="logo_image_arr['isrequire']" 
									skin ="logo_image_arr['skin']"
									tagname="logo_image_arr['tagname']">
								</dupload:upload>
						</div>
						<div class="layui-form-mid layui-word-aux">请使用透明背景，白色字体logo，图片大小 180 * 60 (具体根据显示效果来定)</div>
					</div>	
					
					<!-- <div class="layui-form-item">
						<label class="layui-form-label">用户协议</label>
						<div class="layui-input-block">
							<textarea name="agreement" placeholder="请填写用户协议" class="layui-textarea" id="layer_textarea" style="display: none">{$data['agreement']}</textarea>
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
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>
