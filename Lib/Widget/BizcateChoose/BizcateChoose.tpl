<a href="{$urlbefore}/{$queryfield}/%/" class="item-param <if condition="$_GET[$queryfield]==''||$_GET[$queryfield]=='%'">selected</if>">不限</a>
<a href="#" onclick="$('#bizcate-options').fadeToggle(400);" class="item-param <if condition="$_GET[$queryfield] neq $default && $_GET[$queryfield] neq '' && $_GET[$queryfield] neq '%'">selected</if>"">
    <span class="ui-dbutton-self pr5"><if condition="$_GET[$queryfield]==''||$_GET[$queryfield]=='%'">{$default}<else/>{$_GET[$queryfield]}</if></span>
    <i class="ui-dbutton-arrow iconfont" title="下三角形">&#xF03C;</i>
</a>
<span class="c_gray"></span>
<div id="bizcate-options" class="select-bar">
	<div class="select-bar-dialog">
		<div class="btn-close"><a href="javascript:void()" onclick="$('#bizcate-options').hide(400);">X</a></div>
        <!-- 类型筛选条件 begin -->
       	<div class="sections">
       		<volist name="bizcate" id="vo1" key="k1">
       		<div class="section <if condition="$k1 eq count($bizcate)">last</if>">										    
       			<h2 class="caption"><a href="{$urlbefore}/{$queryfield}/{$vo1['nodename']}" class="item-param">{$vo1['nodename']}</a></h2>
       			<ul class="items">
       				<volist name="vo1['_child']" id="vo2">
       				<li class="item"><a href="{$urlbefore}/{$queryfield}/{$vo2['nodename']}" class="item-param">{$vo2['nodename']}</a></li>
       				</volist>
       			</ul>
       			<div class="clear"></div>
       		</div>
       		</volist>									        		
       	</div>
       	<!-- 类型筛选条件 end -->
    </div>
</div>