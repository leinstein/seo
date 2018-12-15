<!DOCTYPE html>
<html lang="en">
<php>$page_title = "操作失败";</php>
<head>
<include file="../Public/header.mobile" />
<title><?php echo "提示";?></title>
<style type="text/css">
</style>
<?php $waitSecond = $waitSecond ? $waitSecond : 3 ; ?>
<body>
<div class="weui-toptips weui-toptips_warn js_tooltips">错误提示</div>
<div class = "container" id="container">
<div class="page msg_warn js_show">
    <div class="weui-msg">
        <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
        <div class="weui-msg__text-area">
            <h2 class="weui-msg__title">操作失败</h2>
            <p class="weui-msg__desc">&nbsp;</p>
            <p class="weui-msg__desc"><present name="message">{$message}<else/>{$error}</present></p>
            <p class="weui-msg__desc">&nbsp;</p>
		    <p class="weui-msg__desc">等待时间： <b id="wait">{$waitSecond}</b></p>
			<span style="display:none;"><span id="wait"><?php echo($waitSecond); ?></span> {$Think.lang.waiting_for}</span>
        </div>
        <div class="weui-msg__opr-area">
            <p class="weui-btn-area">
                <a  id="href"  href="{$jumpUrl}" class="weui-btn weui-btn_warn">返回上一页</a>
            </p>
        </div>
        
    </div>
</div>
</div>


</body>
<script type="text/javascript">
(function(){
	var wait = document.getElementById('wait'),href = document.getElementById('href').href;
	var interval = setInterval(function(){
		var time = --wait.innerHTML;
		if(time == 0) {
			location.href = href;
			clearInterval(interval);
		};
	}, 1000);
	})();
</script>
</html>
