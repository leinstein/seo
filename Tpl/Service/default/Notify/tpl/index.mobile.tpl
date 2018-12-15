
	<notempty name="list['data']">
	<volist name="list['data']" id="vo">
	<a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
	      <div class="weui-media-box__hd">
	        <i class="iconfont f18 c_lightblue pl0 pr5">&#xe6bc;</i>
	      </div>
	      <div class="weui-media-box__bd">
	        <h4 class="weui-media-box__title f14">{$vo['body']}</h4>
	        <!-- <p class="weui-media-box__desc">{$vo['body']}</p> -->
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