<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>用户登录</title>
<link rel="stylesheet" href="../Public/css/common.css"> <meta http-equiv="X-UA-Compatible" content="IE=Edge">
<script src="../Public/js/jquery/jquery-1.7.2.min.js" type="text/javascript"></script>
 <!--图标字体-->
     <link href="__PUBLIC__/css/iconfont/iconfont.css" rel="stylesheet">
<style>
#loginform table td{ vertical-align:top; height:46px;}
#loginform table td.label{ padding-top:4px;}
.text{ padding:4px; }
.f14{ font-size:14px;}
a.submit_a {
	width: 100px;
	height: 25px;
	margin: 10px 0px;
	background: #156fcc;
	border: 0px;
	border-radius: 3px;
	line-height: 25px;
	font-size: 14px;
	color: #fff;
	display: block;
	padding: 2px;
	text-align: center;
}
.header {
        background-color: #fff;
        border-bottom: 1px solid #dddcdc;
        height: 110px;
        position: relative;
        left: 0;
        top: 0;
    }

    .header img {
        /*padding-top: 40px;*/
    }

    .header p {
        padding-top: 40px;
        color: #333333;
    }

    .header a {
        color: #333333;
        display: inline-block;
        padding: 0 10px;;
    }
    .content {
	    min-width: 324px;
	    height: 516.5px;
	    background-position: center;
	    background-size: cover;
	    background-repeat: no-repeat;
	    padding-top: 50px;
	    padding-bottom:20px;
	    position: relative;
	    background-image: url('../Public/img/login_bg.png');
	}

    .content .pic {
        margin-top: 86px;
    }

    .content h4 {
    }

    .content .login_box {
        margin-top: 70px;
        border: 1px solid #e5e5e5;
        padding-left: 40px;
        padding-right: 40px;
    }

    .content h4 {
        line-height: 1;
        padding: 26px 0 30px 0;
        font-size: 20px;
    }

    .content form {
    }

    .content .form-group {
        position: relative;
        left: 0;
        top: 0;
        color: #cbcbcb;
        margin-bottom: 20px;
    }

    .content .iconfont {
        position: absolute;
        left: 10px;
        top: 8px;
        color: #cbcbcb;
        font-size: 20px;
    }

    .content .username,
    .content .password {
        text-indent: 46px;
        width: 280px;
        height: 40px;
        border: 1px solid #e5e5e5;
    }

    .content input[type=button] {
        border: none;
        color: #fff;
        background-color: #0285d5;
        font-size: 14px;
        width: 280px;
        height: 40px;
        margin-bottom: 36px;
        cursor: pointer;
    }

    .content .change {
        color: #0285d5;
        font-size: 12px;
    }

    .content .verify {
        border: 1px solid #e5e5e5;
        height: 31px;
        text-indent: 15px;
        width: 100px;
    }

    .content .verify_img {
        padding: 0 10px;
    }
    
     .foot {
        text-align: center;
        border-top: 1px solid #dddcdc;
        padding-top: 25px;
        padding-bottom: 40px;
       
    }

    .foot .flink {
        padding-bottom: 18px;
        color: #666666;
    }

    .foot .flink a {
        color: #666666;
        font-size: 16px;
    }

    .foot .copyright {
        color: #999999;
        font-size: 18px;
    } 
</style>


<style type="text/css">

</style>
</head>
<body>

<div class="header">
    <div class="wrapper clearfix">
        <img src="__PUBLIC__/img/logo.png" alt="" class="fl">
        <p class="fr">
            <!-- <a href="/">蜂鸟首页</a>|
            <a href="/help.php">帮助中心</a> -->
        </p>
    </div>
</div>

<!-- <div class="content  clearfix" style="position: relative;"> -->
<div  class="content">
	
    <div class="fr login_box" style="position: absolute;top:33.5px ;right:10%;background: #fff;display: ;">
        <h4>用户登录</h4>
        
        <form action="__URL__/doLogin" id="loginform" method="post">
            <div class="form-group">
                <i class="iconfont icon-yonghuming"></i>
                <input type="text" name="username" class="dianji username" id="username"  placeholder="用户名" onKeyDown="return SubmitKeyClick(this,event)"/>
            </div>
            <div>
                <em id="username_error" style=" font-size: 14px; padding-bottom: 5px;display: block;  color: #f00;font-style: normal;margin-top: -15px;">&nbsp;</em>
            </div>
            <div class="form-group">
                <i class="iconfont icon-iconfontlock"></i>
                <input type="password"  name="userpass" id="userpass" class="dianji password" placeholder="请输入密码" onKeyDown="return SubmitKeyClick(this,event)">
            </div>
            <div>
                <em id="userpass_error" style=" font-size: 14px; padding-bottom: 5px;display: block;  color: #f00;font-style: normal;margin-top: -15px;">&nbsp;</em>
            </div>
            <div class="form-group">
                <input name="verifycode" id="verifycode" type="text" class="verify" placeholder="验证码">
                <img id="verify_code" src="__URL__/verify" id="smsyzmpic" class="smsyzmpic verify_img" style="vertical-align:middle;">
                <a class="change" href="javascript:void(0);" onclick="$('#verify_code').attr('src','__URL__/verify/t/'+Math.random());" class="ml5">看不清换一张</a>
            </div>
            <div>
                <em id="verifycode_error" style=" font-size: 14px; padding-bottom: 5px;display: block;  color: #f00;font-style: normal;margin-top: -15px;">&nbsp;</em>
            </div>
            <input type="button" value="登陆" onclick="doLogin();">
        </form>
    </div>
</div>

<div class="foot wrapper">
    <p class="flink">
        <a href="#">关于我们</a> | <a href="#">加盟合作</a> | <a href="#">加入我们</a> | <a href="#">联系我们</a>
    </p>
    <p class="copyright">
        ©上海企搜网络科技有限公司
    </p>
</div> 



<script>

    function doLogin() {
    	
        if ($("#username").val() == "") {
           	// alert("用户名不能为空");
            $("#username_error").html( "用户名不能为空" );
            //$("#username").focus();
            $("#username_error").show();
           // return false;
        }else{
        	$("#username_error").html( "&nbsp;" );
        }
        
		if($("#userpass").val() == "") {
			$("#userpass_error").html( "密码不能为空" );
			//$("#userpass").focus();
        }else{
        	$("#userpass_error").html( "&nbsp;" );
        }

		//获取验证码
        var verifycode = $("#verifycode").val();
        if( verifycode  == "") {
			$("#verifycode_error").html( "验证码不能为空" );
			//$("#verifycode").focus();
            return false;
        }else{
        	$("#verifycode_error").html( "&nbsp;" );
        }
		
        $.ajax({
	        type: "get",
	        url: "__URL__/checkVerifyCode/verifycode/" + verifycode,
	        dataType:"json",  
	        success: function (result) {
	        	var status = result.status;
	        	if( status != 1 ){
	        		$("#verifycode").focus();
	                //alert("验证码不匹配，请重新输入");
	        		$("#verifycode_error").html( result.info);
	        		return false;
	        	}else {
	        		$("#verifycode_error").html( "&nbsp;" );
	                $("#loginform").submit();
	            }
	
	        }
	    })
    }

    
</script>
</body>
</html>