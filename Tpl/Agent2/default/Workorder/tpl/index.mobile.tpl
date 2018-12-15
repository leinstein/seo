<notempty name="list['data']">
	<volist name="list['data']" id="vo">
	<a href="__URL__/detail/id/{$vo['id']}" class="weui-media-box weui-media-box_appmsg">
		
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title">{$vo['title']}  {$vo['reply_num']} </h4>
			<p class="weui-media-box__desc mt5">
				<span style="">产品：</span><span>{$vo['productname']}</span>
			</p>
			<p class="weui-media-box__desc mt5">
				<span style="">站点：</span><span>{$vo['sitename']}</span>
			</p>
			<p class="weui-media-box__desc mt5">
				<span style="">内容：</span><span>{$vo['content']}</span>
			</p>
		</div>
	</a>
	</volist>
	<else/>
		<div class="weui-media-box weui-media-box_appmsg">
			<div class="weui-media-box__bd">
				<h4 class="weui-media-box__title pt10 pl10 pb10">暂无相关数据</h4>
			</div>
		</div>
	</notempty>