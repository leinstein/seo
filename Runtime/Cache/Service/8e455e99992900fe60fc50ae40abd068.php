<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>智能营销系统</title>
    <!-- Bootstrap -->
    <link href="__PUBLIC__/static/login/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="__PUBLIC__/static/login/style/mit.css">
	<script type="text/javascript" src="__PUBLIC__/js/layui/layui.js"></script>
	
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



    <script type="text/javascript" src="__PUBLIC__/static/login/dist/js/jquery.min.js"></script>
    <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
  
    <script type="text/javascript" src="__PUBLIC__/static/js/xadmin.js"></script>
	
</head>

<body>
    <div class="container-fluid">
        <div class="login">
            <?php if($logo_image_url): ?><div class="m-logo"><img src="<?php echo ($logo_image_url); ?>" alt=""></div>
                <?php else: ?>
                <div class="m-logo"><img src="__PUBLIC__/static/login/images/m_logo.png" alt=""></div><?php endif; ?>


            <div class="m_form">
                <form class="layui-form" id="loginform">
                    <div class="form-group ipt username">
                        <em class="u-icon"><img src="__PUBLIC__/static/login/images/um-icon.png" alt=""></em>
                        <input type="text" class="u-input" placeholder="请输入登录名" lay-verify="required" name="username" >
                    </div>
                    <div class="split"></div>
                    <div class="form-group ipt password">
                        <em class="p-icon"><img src="__PUBLIC__/static/login/images/pw-icon.png" alt=""></em>
                        <input type="password" class="p-input" placeholder="请输入登录密码" lay-verify="required" name="userpass">
                    </div>
                    <div class="form-group yzm">
                        <input type="text" class="yzm-input" name="verifycode" lay-verify="required" id="verifycode">
                        <div class="yzm-img">
                            <img src="__URL__/verify/request_type/ajax" alt="" id="verify_code">
                            <span><a class="change" href="javascript:void(0);" onclick="$('#verify_code').attr('src','__URL__/verify/request_type/ajax/t/'+Math.random());" class="ml5">看不清换一张</a></span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-default submit" onclick="doLogin()">确定</button>
                </form>
            </div>
        </div>
    </div>
    <!-- jQuery  -->

	
	<script>
       function doLogin(){
		
			var verifycode = $("#verifycode").val();
			if(verifycode==""){return false;}
			$.ajax({
					type: "get",
					url: "__URL__/checkVerifyCode/verifycode/" + verifycode + "/request_type/ajax",
					dataType:"json",  
					success: function (result) {
						var status = result.status;
						if(status != 1 ){
							$("#verifycode").focus();
							layer.msg(result.info,{icon:2});
							return false;
						}else{
						$.ajax({
							url:'__URL__/doLogin',
							type:"POST",
							dataType:"json", 
							data:$("#loginform").serialize(),
							success:function(data){
								if(data.status!=1){
									layer.msg(data.info,{icon:2});
										return false;
								}else{
									layer.msg(data.info,{icon:1});
									location.href = "/"+data.url;
								}
							},
						});
					}
					
					}
				});
		
		}
    </script>
    <?php if($logo_image_url): ?><script>
            $("body").css("background-image","url('<?php echo ($login_page_image_url); ?>' )");
        </script>
        <?php else: endif; ?>


</body>

</html>