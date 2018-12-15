<notempty name="list['data']">
	<volist name="list['data']" id="vo">
	<a href="__URL__/detail/id/{$vo['id']}" class="weui-media-box weui-media-box_appmsg">
		<!-- <div class="weui-media-box__hd" >
			<img class="weui-media-box__thumb" src="../Public/img/community/leader-log-index.png" alt="">
		</div> -->
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title">{$vo['sitename']}</h4>
			<p class="weui-media-box__desc mt5">{$vo['website']}</p>
			<p class="weui-media-box__desc mt5">
				<span>关键词数：{$vo['keywordnum']|default=0}</span>
				<span class="ml10">达标词数：{$vo['standardNum']|default=0}</span>
			</p>
			<p class="weui-media-box__desc mt5">
				
				<span>达标消费：{$vo['standardfee']|format_money}</span>
				<span class="ml10">预付冻结资金：{$vo['freezefunds']|format_money}</span>
				<span class="ml10">累计消费：{$vo['consumption']|format_money}</span>
			</p>
		</div>
	</a>
	</volist>
	<else/>
	
	</notempty>