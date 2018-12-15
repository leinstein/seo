<notempty name="list['data']">
	<volist name="list['data']" id="vo">
	<a href="#" class="weui-media-box weui-media-box_appmsg">
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title">{$vo['keyword']} 
				
			</h4>
			<p class="weui-media-box__desc mt5"><span>网址：{$vo['website']}</span></p>
			<p class="weui-media-box__desc mt5"><span>渠道：{$vo['searchengine_zh']}</span></p>
			<p class="weui-media-box__desc mt5"><span>初始排名：{$vo['initialranking']}</span></p>
			<p class="weui-media-box__desc mt5"><span>最新排名：{$vo['rank']|default='100+'}
				<eq name="vo['initialranking']" value="0">
					<!-- 如果初始排名为0  -->
					<gt name="vo['rank']" value="0">
						<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;">
					</gt>
				<else/>
					<!-- 如果初始排名不为0  -->
					<gt name="vo['rank']" value="$vo['initialranking']">
						<img src="__PUBLIC__/img/down.gif" style="vertical-align: middle;">
					<else/>
						<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;">
					</gt>
				</eq></span></p>
			<p class="weui-media-box__desc mt5"><span>检测日期：{$vo['createtime']|format_date= ###,m_d}</span></p>
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