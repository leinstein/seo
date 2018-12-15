<notempty name="list['data']">
	<volist name="list['data']" id="vo">
	<a href="__URL__/detail/id/{$vo['id']}" class="weui-media-box weui-media-box_appmsg">
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title">{$vo['username']}</h4>
			<p class="weui-media-box__desc mt5"><span>{$vo['epname']}</span></p>
			<p class="weui-media-box__desc mt5">
				<span>开通产品：{$vo['productnames']}</span>
			</p>
			<p class="weui-media-box__desc mt5">
				<span>总资金：{$vo['totalfunds']|format_money}</span>
				<span class="ml10">资金余额：{$vo['balancefunds']|format_money}</span>
				<span class="ml10">可用余额：{$vo['availablefunds']|format_money}</span>
			</p>
		</div>
	</a>
	</volist>
	<else/>
		<div class="weui-media-box weui-media-box_appmsg">
	
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title pl10 pt10 pb 10">暂无相关数据</h4>
			
		</div>
	</div>
	</notempty>