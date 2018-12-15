<include file="../Public/header" />
<title><?php echo L('message_tips');?></title>
<style type="text/css">
</style>
<?php $waitSecond = 1; ?>
<body>
<div class="wrapper">
	<div class="ui-grid-row" style="margin-top:200px;">
		<div class="ui-grid-5"></div>
		<div class="ui-grid-15">
			<div class="ui-tipbox ui-tipbox-success">
			    <div class="ui-tipbox-icon">
			        <i class="iconfont" title="成功">&#xF049;</i>
			    </div>
			    <div class="ui-tipbox-content">
			        <h3 class="ui-tipbox-title"><h3 class="ui-tipbox-title"><present name="message">{$message}<else/>{$error}</present></h3></h3>
			        <p class="ui-tipbox-explain">&nbsp;</p>
			        <p class="ui-tipbox-explain"><a id="href" href="{$jumpUrl}">返回上一页</a> | 等待时间： <b id="wait">{$waitSecond}</b></p>
					<span style="display:none;"><span id="wait"><?php echo($waitSecond); ?></span> {$Think.lang.waiting_for}</span>
			    </div>
			</div>
		</div>
		<div class="ui-grid-5"></div>
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
