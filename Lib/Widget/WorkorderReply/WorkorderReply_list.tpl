<!-- 引入上传组件标签库 begin -->
<taglib name="html,dupload" />
<!-- 引入上传组件标签库 end -->
<!-- 引入上传组件js和css文件 begin -->
<dupload:script name="dupload"/>
<!-- 引入上传组件js和css文件 end-->
<script>
	$(function() {
		layui.use(['form'], function(){
			var form = layui.form;
			var ks ="";
			//自定义验证规则
			form.verify({
				
				bizstatus: function(value){
					
			  		if($.trim(value)== ""){
			    		return '请选择管理审核意见';
			  		}
			  		ks = $.trim(value);
				}
			});

			form.on('submit(go)', function(data) {
			});
		});
		
		// 初始化界面的高度
		//var 
		//浏览器当前窗口可视区域高度
		var window_height = $(document).height(); 
		
		// 获取回复框的高度
		var dom_height = $("#dom_reply_area").height( );
		$(".layim-chat-main").height(window_height - dom_height - 50);
	});
</script>

		
		
	<div class="layim-chat-main">
		<ul>
			<volist name="data['reply_list']" id="vo">
		  	<li class="{$vo.class_name}">
			  	<div class="layim-chat-user">
			  		<img src="__PUBLIC__/img/{$vo.icon}">
			  		<cite><i>{$vo['createtime']}</i>{$vo['createusername']}</cite>
			  	</div>
			  	<div class="layim-chat-text">
			  		{$vo['content']}
			  		<notempty name="vo['file_info']['id']">
			  		<div style="color: blue">
				  		相关附件：
				  		<php>load("@.file");</php>
				  		<a href="{$vo['file_info']['id']|get_download_url}" style="color: blue">{$vo['file_info']['originalfilename']}</a>
			  		</div>
			  		</notempty>
			  	</div>
		  	</li>
		  	</volist>
		</ul>
	</div>
	
	

