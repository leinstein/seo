<div class="weui-panel weui-panel_access notify">
  <div class="weui-panel__hd">消息提醒 </div>
  <div class="weui-panel__bd">
  	<notempty name="MyNotify['data']">
  		<volist name="MyNotify['data']"  id="vo">
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
		<h5 class="weui-media-box__title">您暂时还没有消息提醒</h5> 
	</notempty>
  </div>
  <!-- <div class="weui-panel__ft">
    <a href="javascript:void(0);" class="weui-cell weui-cell_access weui-cell_link">
      <div class="weui-cell__bd">查看更多</div>
      <span class="weui-cell__ft"></span>
    </a>    
  </div> -->
</div>

<div class="weui-panel weui-panel_access notify hide">
     <div class="weui-panel__hd">消息提醒</div>
     <div class="weui-panel__bd">
         <div class="weui-cells">
			<notempty name="MyNotify['data']">
				<volist name="MyNotify['data']"  id="vo">
				<a class="weui-cell weui-cell_access" href="javascript:;">
					<div class="weui-cell__hd"><i class="iconfont f18 c_lightblue pl0 pr5">&#xe6bc;</i><!-- <img src="data:image/png;base64,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" alt="" style="width:20px;margin-right:5px;display:block"> --></div>
					<div class="weui-cell__bd">
						<p>{$vo['body']}</p>
					</div>
					<div class="weui-cell__ft"></div>
				</a>
				</volist>
			<else/>
				<h5 class="weui-media-box__title">您暂时还没有消息提醒</h5> 
			</notempty>
		</div>
	</div>
</div>

<div class="weui-panel weui-panel_access notify hide">
	<div class="weui-cells__title">消息提醒</div>
	<div class="weui-cells">
		<notempty name="MyNotify['data']">
			<volist name="MyNotify['data']"  id="vo">
			<a class="weui-cell weui-cell_access" href="javascript:;">
				<div class="weui-cell__hd"><i class="iconfont f18 c_lightblue pl0 pr5">&#xe6bc;</i><!-- <img src="data:image/png;base64,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" alt="" style="width:20px;margin-right:5px;display:block"> --></div>
				<div class="weui-cell__bd">
					<p>{$vo['body']}</p>
				</div>
				<div class="weui-cell__ft"></div>
			</a>
			</volist>
		<else/>
			<h5 class="weui-media-box__title">您暂时还没有消息提醒</h5> 
		</notempty>
   </div>
</div>
<div class="weui-panel weui-panel_access notify hide">
    <div class="weui-panel__hd">消息提醒</div>
    <div class="weui-panel__bd">
            <!-- <div class="weui-media-box__hd">
                <img class="weui-media-box__thumb" src="data:image/png;base64,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" alt="">
                <div class="weui-media-box__hd__title">消息提醒</div>
            </div> -->
            <div class="weui-media-box__bd">
                <notempty name="MyNotify">
       				<script>
                		//去掉隐藏伪类的样式
                       	$("#notify .weui-media-box__bd").removeClass("hideafter") ;
                    </script>
                    <div class="weui-cells">
                    <volist name="MyNotify" id="vo">
                    <a class="weui-cell weui-cell_access" href="javascript:;">
			            <div class="weui-cell__hd"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAuCAMAAABgZ9sFAAAAVFBMVEXx8fHMzMzr6+vn5+fv7+/t7e3d3d2+vr7W1tbHx8eysrKdnZ3p6enk5OTR0dG7u7u3t7ejo6PY2Njh4eHf39/T09PExMSvr6+goKCqqqqnp6e4uLgcLY/OAAAAnklEQVRIx+3RSRLDIAxE0QYhAbGZPNu5/z0zrXHiqiz5W72FqhqtVuuXAl3iOV7iPV/iSsAqZa9BS7YOmMXnNNX4TWGxRMn3R6SxRNgy0bzXOW8EBO8SAClsPdB3psqlvG+Lw7ONXg/pTld52BjgSSkA3PV2OOemjIDcZQWgVvONw60q7sIpR38EnHPSMDQ4MjDjLPozhAkGrVbr/z0ANjAF4AcbXmYAAAAASUVORK5CYII=" alt="" style="width:20px;margin-right:5px;display:block"></div>
			            <div class="weui-cell__bd">
			              <p>cell standard</p>
			            </div>
			            <div class="weui-cell__ft">说明文字</div>
			          </a>
                    </volist>
                    </div>
                <else/>
   					<script>
                  		//增加隐藏伪类的样式
                    	$("#notify .weui-media-box__bd").addClass("hideafter");  
                    </script>
                       <h5 class="weui-media-box__title">您暂时还没有消息提醒</h5> 
                </notempty>
                
            </div>
    </div>
</div>