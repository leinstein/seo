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
			var mess 		= "<?php echo($message); ?>";
			var jumpurl 	= "<?php echo($jumpUrl); ?>";
			var waitSecond 	= "<?php echo($waitSecond); ?>";
			var parent_page = "<?php echo($parent); ?>"; 
			var parent_level = "<?php echo($parent_level); ?>"; 
			
			var suc = '<span style="color: #00ba9b">' + mess + '<br>等待时间: <b id="show">' + waitSecond + '</b> 秒</span>';
			layer.msg(suc, {
		        icon: 1,
		        title: [
		        	mess,
		            //自定义标题风格，如果不需要，直接title: '标题' 即可
		            'border:none; background: #00ba9b; color:#fff;' 
		          ],
		       
		        success: function(layer) {
		            var wait = document.getElementById('wait'),
		                href = document.getElementById('href').href;
		            var interval = setInterval(function() {
		                time = --wait.innerHTML;
		                document.getElementById('show').innerHTML = time;
		                if (time <= 0) {
		                	if( parent_page == 1 ){
		                		if( parent_level == 1 ){
		                			parent.location.href = href;
		                		}else if( parent_level == 2 ){
		                			parent.parent.location.href = href;
		                		}else if( parent_level == 3 ){
		                			parent.parent.parent.location.href = href;
		                		}
		                		/* switch(parent_level){
		                			case 1:
		                				parent.location.href = href;
		                		  		break;
		                			case 2:
		                				parent.parent.location.href = href;
		                		  		break;
		                			default:
		                				alert(parent_level);
		                				parent.location.href = href;
		                		} */
		                		
		                	
		                		
		                	}else{
		                		location.href = href;
		                	}
		                  	
		                    clearInterval(interval);
		                };
		            }, 1000);
		        }
			});
        })
        
        
     
  
        </script>
    </body>
    </html>