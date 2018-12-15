<notempty name="list['data']">
	<volist name="list['data']" id="vo">
	<a href="__URL__/detail/id/{$vo['id']}" class="weui-media-box weui-media-box_appmsg">
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title">{$vo['keyword']}</h4>
			<p class="weui-media-box__desc mt5">
				<span>所属计划：{$vo['plan']['planname']}</span>
			</p>
		</div>
	</a>
	</volist>
	<else/>
		<div class="weui-media-box weui-media-box_appmsg">
	
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title">暂无相关数据</h4>
			
		</div>
	</div>
	</notempty>