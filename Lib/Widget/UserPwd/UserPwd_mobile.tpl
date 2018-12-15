<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label required">用户名</label>
	</div>
	<div class="weui-cell__bd">
		{$me.username}
	</div>
</div> 

<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label">原始密码</label>
	</div>
	<div class="weui-cell__bd">
		<input type="password" name="password" id="password"  placeholder="请输入您的原始登录密码"  class="weui-input">
	</div>
</div>

<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label required">新登录密码</label>
	</div>
	<div class="weui-cell__bd">
		<input type="password" name="newpassword1" id="newpassword1"  placeholder="请输入您的新登录密码"  class="weui-input">
	</div>
</div>

<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label required">确认新密码</label>
	</div>
	<div class="weui-cell__bd">
		<input type="password" name="newpassword2" id="newpassword2"  placeholder="请再次输入您的新密码"  class="weui-input">
	</div>
</div>

<div class="weui-btn-area">
	<input type="hidden" name="id" value="{$me['id']}">
	<a class="weui-btn weui-btn_primary" href="javascript:;" onclick="doSub()">立即提交</a>
</div>
 <script>
//修改密码
 function doSub() {
 	 $(".weui-cell").css('border','none');;

 	// 原始密码判断
 	var password = $.trim($("#password").val());
 	if (!password) {
 		$.toptip('请输入您的原始密码', 'error');
 		$("#password").focus();
 		$("#password").parent().parent().css('border','1px solid red');;
 		return false;
 	}
 	
 	
 	// 新的登录密码判断
 	var newpassword1 = $.trim($("#newpassword1").val());
 	if (!newpassword1) {
 		$.toptip('请您输入新的登录密码', 'error');
 		$("#newpassword1").focus();
 		$("#newpassword1").parent().parent().css('border','1px solid red');;
 		return false;
 	}
 	if ( !(/(.+){6,}$/.test(newpassword1)) ) {
 		$.toptip('密码不能小于6位', 'error');
 		$("#newpassword1").focus();
 		$("#newpassword1").parent().parent().css('border','1px solid red');;
 		return false;
 	}
 	
 	// 新的登录密码判断
 	var newpassword2 = $.trim($("#newpassword2").val());
 	if (!newpassword2) {
 		$.toptip('请您输入新的登录密码', 'error');
 		$("#newpassword2").focus();
 		$("#newpassword2").parent().parent().css('border','1px solid red');;
 		return false;
 	}
 	
 	if ( !(/(.+){6,}$/.test("newpassword2")) ) {
 		$.toptip('密码不能小于6位', 'error');
 		$("#newpassword2").focus();
 		$("#newpassword2").parent().parent().css('border','1px solid red');;
 		return false;
 	}
 	
 	if(newpassword1 != newpassword2){
 		$.toptip('您两次输入的密码不一致，请重新输入', 'error'); 
 		$("#newpassword2").focus();
 		$("#newpassword2").parent().parent().css('border','1px solid red');
 		return false;
 	}
 	
 	document.form.submit();
 }

 </script>