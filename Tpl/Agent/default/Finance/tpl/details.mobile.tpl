<notempty name="list['data']">
	<volist name="list['data']" id="vo">
	<eq name="Think.get.operate" value="recharge">
	<div class="weui-media-box weui-media-box_appmsg">
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title">{$vo['amount']|format_money}</h4>
			<p class="weui-media-box__desc mt5">
				<span>操作用户：{$vo['reguser']}</span>
				<span class="ml10">操作时间：{$vo['createtime']|format_date}</span>
			</p>
		</div>
	</div>
	<else/>
	<div class="weui-media-box weui-media-box_appmsg">
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title">{$vo['amount']|format_money}</h4>
			<p class="weui-media-box__desc mt5">
				<span>用户名：{$vo['username']}</span>
				<span class="ml10">用户类型：{$vo['usertype_desc']}</span>
				<span class="ml10">充值产品：{$vo['product']['product_name']}</span>
			</p>
			
			<p class="weui-media-box__desc mt5">
				<span>操作用户：{$vo['reguser']}</span>
				<span class="ml10">操作时间：{$vo['createtime']|format_date}</span>
			</p>
		</div>
	</div>
	</eq>
	</volist>
	<else/>
		<div class="weui-media-box weui-media-box_appmsg">
	
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title pl10 pt10 pb 10">暂无相关数据</h4>
			
		</div>
	</div>
	</notempty>