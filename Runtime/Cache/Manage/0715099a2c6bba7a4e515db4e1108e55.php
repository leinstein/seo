<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
    <html>
    <head>
        <title> 页面跳转 等待时间： <?php echo($waitSecond); ?> </title>
        <script src="__PUBLIC__/js/jquery/jquery.1.10.2.min.js"></script>
        <script src="__PUBLIC__/js/layer/layer.js"></script>
    </head>
    <body>
        <b id="wait" style='display:none'><?php echo($waitSecond); ?></b>
        <a id="href" href="<?php echo($jumpUrl); ?>" style='display:none'>跳转</a>
        <script type="text/javascript">
        $(function() { 
			var error 		= "<?php echo($error); ?>";
			var jumpurl 	= "<?php echo($jumpUrl); ?>";
			var waitSecond 	= "<?php echo($waitSecond); ?>";
			var suc = '<span style="color: #eb6b5e">' + error + '<br>等待时间: <b id="show">' + waitSecond + '</b> 秒</span>';
			layer.msg(suc, {
		        icon: 2,
		        title: [
		        	error,
		            //自定义标题风格，如果不需要，直接title: '标题' 即可
		            'border:none; background: #eb6b5e; color:#fff;' 
		          ],
		       
		        success: function(layer) {
		            var wait = document.getElementById('wait'),
		                href = document.getElementById('href').href;
		            var interval = setInterval(function() {
		                time = --wait.innerHTML;
		                document.getElementById('show').innerHTML = time;
		                if (time <= 1) {
		                  	location.href = href;
		                    clearInterval(interval);
		                };
		            }, 1000);
		        }
			});
        })
        </script>
    </body>
    </html>