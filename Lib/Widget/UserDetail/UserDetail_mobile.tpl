<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label required">用户名</label>
	</div>
	<div class="weui-cell__bd">
		<eq name="operate" value="insert">
		<input type="text" name="username" id="username"  placeholder="请填写用户登录名"  class="weui-input">
		<else/>
		{$data['username']}
		</eq>
	</div>
</div>
<neq name="operate" value="update_me">
<div class="weui-cell">
	<div class="weui-cell__hd">
		<label for="" class="weui-label">角色类型</label>
	</div>
	<div class="weui-cell__bd">
		<eq name="operate" value="insert">
			<input type="hidden" name="usertype" value="{$usertype}">
			<switch name="usertype" >
			<case value="sub">
				<span id="usertype">子用户</span>
				<input type="hidden" name="usergroup" value="Service">
			</case>
			<case value="agent">
				<span id="usertype">代理商</span>
				<input type="hidden" name="usergroup" value="Agent">
			</case>
			<case value="agent2">
				<span id="usertype">子代理商</span>
				<input type="hidden" name="usergroup" value="Agent2">
			</case>
			<default />
				<span id="usertype">子用户</span>
				<input type="hidden" name="usergroup" value="Service">
			</switch>
		<else/>
			<span id="usertype">{$data['usertype_desc']}</span>
		</eq>
		
	</div>
</div>
</neq>
<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label">真实姓名</label>
	</div>
	<div class="weui-cell__bd">
		<input type="text" name="truename" id="truename"  placeholder="请填写用户真实姓名"  class="weui-input" value="{$data['truename']}">
	</div>
</div>

<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label required">公司名称</label>
	</div>
	<div class="weui-cell__bd">
		<input type="text" name="epname" id="epname"  placeholder="请填写公司名称"  class="weui-input" value="{$data['epname']}">
	</div>
</div>

<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label required">联系人</label>
	</div>
	<div class="weui-cell__bd">
		<input type="text" name="contact" id="contact"  placeholder="请填写联系人"  class="weui-input" value="{$data['contact']}">
	</div>
</div>

<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label">邮箱地址</label>
	</div>
	<div class="weui-cell__bd">
		<input type="text" name="email" id="email"  placeholder="请输入常用邮箱,用于平台通知、密码找回"  class="weui-input" value="{$data['email']}">
	</div>
</div>


<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label">固定电话</label>
	</div>
	<div class="weui-cell__bd">
		<input type="text" name="telephone" id="telephone"  placeholder="请填写固定电话"  class="weui-input" value="{$data['telephone']}">
	</div>
</div>

<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label required">移动电话</label>
	</div>
	<div class="weui-cell__bd">
		<input type="text" name="mobileno" id="mobileno"  placeholder="请填写联系电话"  class="weui-input" value="{$data['mobileno']}">
	</div>
</div>

<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label required">QQ号码</label>
	</div>
	<div class="weui-cell__bd">
		<input type="text" name="QQnumber" id="QQnumber"  placeholder="请填写QQ号码"  class="weui-input" value="{$data['QQnumber']}">
	</div>
</div>

<neq name="operate" value="update_me">
<div class="weui-cells weui-cells_checkbox">
   <div class="weui-cells__title weui-label required" style="color: #333;font-size: 16px;">开通产品</div>
 	 <volist name="products" id="vo">
	   	 <eq name="vo['id']" value="1"> 
	   	 <!-- 优站宝产品 begin -->
	   	 <div class="weui-cell weui-check__label">
			<div class="weui-cell__hd" >
				<input type="checkbox" class="weui-check" name="product[]" value="{$vo['id']}" checked="checked">
				<i class="weui-icon-checked"></i>
			</div>
			<div class="weui-cell__bd">
	          	<p>{$vo['product_name']}</p>
			</div>
		</div>
		<!-- 优站宝产品 end -->
		<else/>
		<!-- 其他产品 begin -->
		<label class="weui-cell weui-check__label" for="s{$vo['id']}">
			<div class="weui-cell__hd" >
				<input type="checkbox" class="weui-check" name="product[]" value="{$vo['id']}" id="s{$vo['id']}" <eq name="vo['checked']" value="1">checked="checked"</eq>>
				<i class="weui-icon-checked"></i>
			</div>
			<div class="weui-cell__bd">
				<p>{$vo['product_name']}</p>
	        </div>
		</label>
		<!-- 其他产品 end -->
		</eq>
	</volist>
</div>
</neq>
<div class="weui-btn-area">
	<input type="hidden" name="returnUrl" value="{$returnUrl}"> 
	<a class="weui-btn weui-btn_primary" href="javascript:;" onclick="doSub()">立即提交</a>
</div>
 <script>
	//提交添加用户
 function doSub() {
	 $(".weui-cell").css('border','none');;
 	// 用户名判断
 	if( verify_element_exists("username")){
 		var username = $.trim($("#username").val());
 		if (!username) {
 			$.toptip('请输入用户名', 'error');
 			$("#username").focus();
 			$("#username").parent().parent().css('border','1px solid red');;
 			return false;
 		}
 	}
 	

 	// 公司名判断
 	var epname = $.trim($("#epname").val());
 	if (!epname) {
 		$.toptip('请输入公司名', 'error');
 		$("#epname").focus();
 		$("#epname").parent().parent().css('border','1px solid red');;
 		return false;
 	}
 	
 	
 	// 联系人判断
 	var contact = $.trim($("#contact").val());
 	if (!contact) {
 		$.toptip('请输入联系人', 'error');
 		$("#contact").focus();
 		$("#contact").parent().parent().css('border','1px solid red');;
 		return false;
 	}
 	
 	// 邮箱判断
 	var email = $.trim($("#email").val());
 	if ( email ) {
 		if (!verifyEmail(email)) {
 	 		$.toptip('邮箱格式不正确', 'error');
 	 		$("#email").focus();
 	 		$("#email").parent().parent().css('border','1px solid red');;
 	 		return false;
 	 	}
 	}
 	
 	// 联系电话判断
 	var telephone = $.trim($("#telephone").val());
 	if ( telephone ) {
 		if (!verifyTel(telephone)) {
 	 		$.toptip('固定格式不正确', 'error');
 	 		$("#telephone").focus();
 	 		$("#telephone").parent().parent().css('border','1px solid red');;
 	 		return false;
 	 	}
 	}

 	// 联系电话判断
 	var mobileno = $.trim($("#mobileno").val());
 	if (!mobileno) {
 		$.toptip('请输入手机号码', 'error');
 		$("#mobileno").focus();
 		$("#mobileno").parent().parent().css('border','1px solid red');;
 		return false;
 	}
 	if (!verifyMobile(mobileno)) {
 		$.toptip('手机号码格式不正确', 'error');
 		$("#mobileno").focus();
 		$("#mobileno").parent().parent().css('border','1px solid red');;
 		return false;
 	}
 	
 	// QQ号码判断
 	var QQnumber = $.trim($("#QQnumber").val());
 	if (QQnumber) {
 		if (!verifyQQ(QQnumber)) {
 			$.toptip('QQ号码格式不正确', 'error');
 			$("#QQnumber").focus();
 			$("#QQnumber").parent().parent().css('border','1px solid red');;
 			return false;
 		}
 	}
 	
 	document.form.submit();
 }
 
 </script>