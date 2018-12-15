<include file="../Public/html/header" />
<title><?php echo L('message_tips');?></title>
<style type="text/css">
<!--
.showMsg a:link,a:visited{text-decoration:none;color:#030;}
.showMsg a:hover,a:active{color:#ff6600;text-decoration: underline}
.showMsg{ border: 1px solid #A9D1A7; zoom:1; width:450px; height:172px;position:absolute;top:46%;left:50%;margin:-87px 0 0 -225px}
.showMsg h5{background-image: url(../Public/img/showmsg/msg.png);background-repeat: no-repeat; color:#fff; padding-left:35px; height:26px; line-height:26px;*line-height:28px; overflow:hidden; font-size:14px; text-align:left}
.showMsg .content{ padding:46px 12px 10px 45px; font-size:15px; height:64px; text-align:left}
.showMsg .bottom{ background:#F0F0F0; margin: 0 1px 1px 1px;line-height:26px; *line-height:30px; height:26px; text-align:center}
.showMsg .ok,.showMsg .guery{background: url(../Public/img/showmsg/msg_bg.png) no-repeat 0px -560px;}
.showMsg .guery{background-position: left -460px;}
-->
</style>
<php>$waitSecond = 1;</php>
<body style="background-color:#fefefe;">
<div class="showMsg" style="text-align:center">
  <h5>提示</h5>
  <div class="content guery" style="display:inline-block;display:-moz-inline-stack;zoom:1;*display:inline;max-width:330px">
	<present name="message">
		<?php echo($message); ?>
	<else/>
		<?php echo($error); ?>
	</present>
  </div>
  <div class="bottom">
    <a id="href" href="<?php echo($jumpUrl); ?>">返回上一页&nbsp;&nbsp;等待时间： <b id="wait"><?php echo($waitSecond); ?></b></a>
	<span style="display:none;"><span id="wait"><?php echo($waitSecond); ?></span> {$Think.lang.waiting_for}</span>
  </div>
</div>
</div>
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

</body>
</html>
