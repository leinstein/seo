<div class="weui-panel weui-panel_access notify">
  <div class="weui-panel__hd">系统公告</div>
  <div class="weui-panel__bd">
  
  	<notempty name="list">
  		<volist name="list"  id="vo">
  		<a class="weui-cell weui-cell_access" href="{:U('News/detail')}/id/{$vo['id']}">
            <div class="weui-cell__bd">
              <p>{$vo['newstitle']}</p>
            </div>
            <div class="weui-cell__ft">{$vo['pubtime']|format_date}</div>
		</a>
          
	    <!-- <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
	      <div class="weui-media-box__hd">
	        <i class="iconfont f18 c_lightblue pl0 pr5">&#xe6bc;</i>
	      </div>
	      <div class="weui-media-box__bd">
	        <h4 class="weui-media-box__title f14">{$vo['newstitle']}</h4>
	      </div>
	    </a> -->
	    </volist>
    <else/>
		<h5 class="weui-media-box__title">暂无相关数据</h5> 
	</notempty>
  </div>
</div>

