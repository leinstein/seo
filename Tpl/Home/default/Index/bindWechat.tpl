<!DOCTYPE html>
<html lang="en">
<php>$page_title = "绑定用户账号";</php>
<head>
<include file="$header_mobile"/>
<script>
$(function(){

	//隐藏选择框
	function hideActionSheet(weuiActionsheet, mask) {
        weuiActionsheet.removeClass('weui-actionsheet_toggle');
        mask.removeClass('actionsheet__mask_show');
        weuiActionsheet.on('transitionend', function () {
            mask.css('display', 'none');
        }).on('webkitTransitionEnd', function () {
            mask.css('display', 'none');
        })
    }

    //显示选择框
    function showActionSheet() {
        var mask = $('#mask');
        var weuiActionsheet = $('#weui-actionsheet');
        weuiActionsheet.addClass('weui-actionsheet_toggle');
        mask.show().focus().addClass('actionsheet__mask_show').one('click', function () {
            hideActionSheet(weuiActionsheet, mask);
        });
        $('#actionsheet_cancel').one('click', function () {
            hideActionSheet(weuiActionsheet, mask);
        });
        weuiActionsheet.unbind('transitionend').unbind('webkitTransitionEnd');
    }

    <eq name="temp_choiceenterprise" value="1">
    showActionSheet();
   	</eq>
});
</script>
</head>
<body ontouchstart>
	<div class="page actionsheet js_show">
		<div class="page__hd" style="background:#0070C0;">
			<h1 class="page__title" style="color:#fff;">登录科创业务云</h1>
			<p class="page__desc" style="color:#fff;">您需要首先绑定您的科技枢纽系统账号</p>
		</div>
		<div class="page__bd">
			<form action="__URL__/doBindWechat" id="loginform" method="post">	
			<div class="weui-panel weui-panel_access">
				<div class="weui-cells__title">选择用户类型</div>
				<div class="weui-cells weui-cells_radio">
					<input type="hidden" name="returnUrl" value="{$returnUrl}">	
					<input type="hidden" name="loginUrl" value="Index/bindWechat">	
					<input type="hidden" name="wechatOpenid" value="{$wechatOpenid}">	
		            <label class="weui-cell weui-check__label" for="epuser">
		                <div class="weui-cell__bd">
		                    <p>企业用户</p>
		                </div>
		                <div class="weui-cell__ft">
		                    <input type="radio" class="weui-check" name="loginusertype" id="epuser" value="ep" <neq name="Think.get.logintype" value="peruserinfo">checked</neq> checked="checked">
		                    <span class="weui-icon-checked"></span>
		                </div>
		            </label>
		            <label class="weui-cell weui-check__label" for="peruser">
		                <div class="weui-cell__bd">
		                    <p>个人用户</p>
		                </div>
		                <div class="weui-cell__ft">
		                    <input type="radio" class="weui-check" name="loginusertype" id="peruser" value="per" <eq name="Think.get.logintype" value="peruserinfo">checked</eq>>
		                    <span class="weui-icon-checked"></span>
		                </div>
		            </label>
		        </div>
		    </div>
		    <div class="weui-panel weui-panel_access">
				<div class="weui-cells__title">请填写账号和密码</div>
				<div class="weui-cells weui-cells_form">
		            <div class="weui-cell">
		                <div class="weui-cell__hd"><label class="weui-label">账号</label></div>
		                <div class="weui-cell__bd">
		                    <input class="weui-input" type="text" name="loginname" value="<notempty name='temp_loginname'>{$temp_loginname}<else/>{$Think.get.last_username}</notempty>" placeholder="用户名/手机号/邮箱" >
		                </div>
		            </div>
		            <div class="weui-cell">
		                <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
		                <div class="weui-cell__bd">
		                    <input class="weui-input" type="password" name="loginpass"  value="{$temp_loginpass}" placeholder="账号密码">
		                </div>
		            </div>
		            <div class="weui-cell weui-cell_vcode">
		                <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
		                <div class="weui-cell__bd">
		                    <input class="weui-input" type="number" name="verifycode"  value="{$temp_verifycode}" placeholder="请输入验证码">
		                </div>
		                <div class="weui-cell__ft">
		                    <img id="verify_code" class="weui-vcode-img" src="__URL__/verify" onclick="$('#verify_code').attr('src','__URL__/verify/t/'+Math.random());">
		                </div>
		            </div>
		        </div>
		    </div>
		    <div class="page__bd_spacing" style="margin-top:15px;">
				<input type="submit" class="weui-btn weui-btn_primary" value="绑定"/>
			</div>	
			</form>	
		</div>
		<div class="page__ft">			
			<a href="javascript:void()"><img src="../Public/img/home/icon_footer_link.png" /></a>
		</div>

		<!--BEGIN actionSheet-->
	    <div id="actionSheet_wrap">
	        <div class="weui-mask_transparent actionsheet__mask" id="mask"></div>
	        <div class="weui-actionsheet" id="weui-actionsheet">
	            <div class="weui-actionsheet__menu">
	                <div class="weui-actionsheet__cell">您属于多个企业，请选择</div>
	                <volist name="loginUserEps" id="vo">  
        			<div class="weui-actionsheet__cell" onclick="self.location='__URL__/afterChoiceEp/orgcode/{$vo['CompanyOrgCode']}/epname/{$vo['CompanyName']|urlencode}/t/<php>echo time();</php>}&returnUrl={$Think.get.returnUrl|urlencode}&i={$i}';">{$vo['CompanyName']}</div>
        			</volist>
	            </div>
	            <div class="weui-actionsheet__action">
	                <div class="weui-actionsheet__cell" id="actionsheet_cancel">取消</div>
	            </div>
	        </div>
	    </div>
	    <!--END actionSheet-->

	</div>

	
</body>
</html>