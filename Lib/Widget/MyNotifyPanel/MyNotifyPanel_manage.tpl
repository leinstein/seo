<!-- 通知列表 begin -->


<!-- 只显示未读消息模式 -->
<notempty name="users_less">
<script>
//加载
$(function(){
	$("#top-usercenter-notify").slideDown("slow");
});

/**
 * 清除单条通知
 * panel_ele_id 通知面板的id， 
 * notify_id 通知的编号
 */
var clearNotify = function(panel_ele_id, notify_id){
	
	//清理某一个通知
	$.getJSON("__GROUP__/Notify/readOne/id/" + notify_id, function(data){
		
		//完成处理
		if( data.status == 1 ){
			
			//只处理在某个div里面的
			$("#"+panel_ele_id + " .notify_"+notify_id).slideUp("fast", function(){
				
				//隐藏后删除
				$(this).remove();
				
				//将没有显示出来的消息显示出来
				$("#" +panel_ele_id + " li.hide:first").show();
				
				//如果都删除了，则去掉提示
				if( $("#" +panel_ele_id + " li.ui-notify-item").length <= 0 ){
					$(".login-name").removeClass("top-hint");
					$("#" + panel_ele_id ).slideUp("slow");
				}
				
			});
			
		}
	});
}
</script>
<div class="ui-panel ui-notice-panel hide mb20" id="top-usercenter-notify">
    <div class="ui-panel-container">
        <div class="ui-panel-content">
        	<ul class="ui-user-notify">
				<volist name="users_less" id="vo">
				<li class="ui-notify-item not-read notify_{$vo['id']}">
					<i class="iconfont f18 c_lightblue pl0 pr5">&#xe6bc;</i><span>用户<b class="ml10 mr10">{$vo['username']}</b>资金池余额小于一周的消耗，请提醒续费！</span>
					
				</li>
				</volist>
			</ul>
        </div>
    </div>
</div>
</notempty>
<!-- 通知列表 end -->