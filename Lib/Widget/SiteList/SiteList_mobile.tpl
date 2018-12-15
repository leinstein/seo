<notempty name="list['data']">
	<volist name="list['data']" id="vo">
	<a href="__URL__/detail/id/{$vo['id']}" class="weui-media-box weui-media-box_appmsg">
		<!-- <div class="weui-media-box__hd" >
			<img class="weui-media-box__thumb" src="../Public/img/community/leader-log-index.png" alt="">
		</div> -->
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title">{$vo['sitename']}</h4>
			<p class="weui-media-box__desc mt5">{$vo['website']}</p>
			<p class="weui-media-box__desc mt5">关键词数：{$vo['keywordnum']|default=0}</p>
		</div>
	</a>
	</volist>
	<else/>
	
	</notempty>

	
                    