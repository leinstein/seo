<notempty name="list['data']">
	<volist name="list['data']" id="vo">
	<a href="__URL__/detail/id/{$vo['id']}" class="weui-media-box weui-media-box_appmsg">
		<div class="weui-media-box__hd" >
			<!-- <span>{$vo['latestranking_show']|default='100+'}
				<eq name="vo['initialranking']" value="0">
					如果初始排名为0 
					<gt name="vo['latestranking']" value="0">
						<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;">
					</gt>
				<else/>
					如果初始排名不为0 
					<gt name="vo['latestranking']" value="$vo['initialranking']">
						<img src="__PUBLIC__/img/down.gif" style="vertical-align: middle;">
					<else/>
						<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;">
					</gt>
				</eq></span> -->
				<span style="display: block;">
					{$vo['detectiondate']|format_date= ###,m_d}
				</span>
				
		</div>
		<div class="weui-media-box__bd">
			<h4 class="weui-media-box__title">{$vo['keyword']} 
				<span class="fr"><!-- <span>{$vo['initialranking']|default='100+'}</span> -->
				<span>{$vo['latestranking_show']|default='100+'}
				<eq name="vo['initialranking']" value="0">
					<!-- 如果初始排名为0  -->
					<gt name="vo['latestranking']" value="0">
						<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;">
					</gt>
				<else/>
					<!-- 如果初始排名不为0  -->
					<gt name="vo['latestranking']" value="$vo['initialranking']">
						<img src="__PUBLIC__/img/down.gif" style="vertical-align: middle;">
					<else/>
						<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;">
					</gt>
				</eq></span>
				</span>
			</h4>
			<p class="weui-media-box__desc mt5"><span>{$vo['website']}</span><span class="ml10">搜索引擎：{$vo['searchengine_zh']}</span></p>
			<p class="weui-media-box__desc mt5">
				<span>单价：{$vo['price']|format_money}{$vo['unit']}/{$vo['unit2']}</span>
				<span class="ml10">最新消费：{$vo['latest_consumption']|format_money}</span>
				<span class="ml10">累计消费：{$vo['total_consumption']|format_money} </span> 
			</p>
			<p class="weui-media-box__desc mt5">
				
				<span>检测时间：{$vo['detectiondate']|format_date} </span>
				<span class="ml10">达标天数：{$vo['standarddays']} </span>
				<!-- <span class="ml10">累计消费：{$vo['consumption']|format_money}</span> -->
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