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
		
		$('.layim-chat-main').scrollTop( $('.layim-chat-main')[0].scrollHeight );
	});
</script>

		
		<!-- <div class="layim-chat-box">
			<div class="layim-chat layim-chat-friend layui-show">
				<div class="layui-unselect layim-chat-title">
					<div class="layim-chat-other">
						<img class="layim-friend1008612"
							src="//tva3.sinaimg.cn/crop.0.0.180.180.180/7f5f6861jw1e8qgp5bmzyj2050050aa8.jpg"><span
							class="layim-chat-username" layim-event="">小闲 </span>
						<p class="layim-chat-status"></p>
					</div>
				</div>
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
				<div class="layim-chat-footer">
					<div class="layui-unselect layim-chat-tool">
						<span
							class="layui-icon layim-tool-image" title="上傳文件件"
							layim-event="image" data-type="file"><input type="file"
							name="file"></span>
					</div>
					<div class="layim-chat-textarea">
						<textarea></textarea>
					</div>
					<div class="layim-chat-bottom">
						<div class="layim-chat-send">
							
							<span class="layim-send-btn" layim-event="send">发送</span>
							
						</div>
					</div>
				</div>
			</div>
		</div> -->
	
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
	
	<div id="dom_reply_area" style="position: absolute; bottom: 0;width: 99%;margin-left:-5px;margin-right:-10px;margin-top:10px;-moz-box-shadow:-1px -3px 12px #333333; -webkit-box-shadow:-1px -3px 12px #333333; box-shadow:-1px -3px 12px #333333;">
		<fieldset class="layui-elem-field layui-field-title" >
	  		<legend>回复</legend>
		</fieldset>
	
		
		
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label required">回复内容</label>
			<div class="layui-input-block">
				<textarea name="content" placeholder="请填写回复内容" class="layui-textarea" lay-verify="required" ></textarea>
			</div>
		</div>
		
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">相关附件</label>
			<div class="layui-input-block">
				<dupload:upload 
					cannotedit = "upload_file['cannotedit']"
					isimage = "upload_file['isimage']"
					attachmentid = "upload_file['fileid']"
					maxsize="upload_file['maxsize']" 
					attachmentname="upload_file['attachmentname']"
					attachmenttype="upload_file['attachmenttype']" 
					attachmentdesc="upload_file['attachmentdesc']" 
					isrequire="upload_file['isrequire']" 
					skin ="upload_file['skin']"
					tagname="upload_file['tagname']">
				</dupload:upload>
			</div>
		</div>	
	
		<div class="layui-form-item">
			<div class="layui-input-block">
				<input type="hidden" name="returnUrl" value="{$CURRENT_URL}">
				<button class="layui-btn" lay-submit="" lay-filter="go">立即提交</button>
				<!-- <button type="reset" class="layui-btn layui-btn-primary">重置</button> -->
			</div>
		</div>
	</div>

