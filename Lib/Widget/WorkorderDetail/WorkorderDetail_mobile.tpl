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
	});
</script>


<div class="weui-form-preview">

	<div class="weui-form-preview__hd">
		<div class="weui-form-preview__item">
          	<label class="weui-form-preview__label">标题</label>
          	<em class="weui-form-preview__value">{$data['title']}</em>
       	</div>
	</div>
		
	<div class="weui-form-preview__bd">
		<div class="weui-form-preview__item">
          	<label class="weui-form-preview__label">产品</label>
          	<em class="weui-form-preview__value">{$data['productid']|get_codeset= ###,$products}</em>
       	</div>

		<div class="weui-form-preview__item">
	          	<label class="weui-form-preview__label">站点</label>
	          	<span class="weui-form-preview__value">{$data['objectid']|get_codeset= ###,$sites}</span>
       	</div>
	
		<div class="weui-form-preview__item">
          	<label class="weui-form-preview__label">内容</label>
          	<span class="weui-form-preview__value">{$data['content']}</span>
       	</div>
	
		<div class="weui-form-preview__item">
          	<label class="weui-form-preview__label">相关附件</label>
          	<span class="weui-form-preview__value">
	          	<dupload:upload 
					cannotedit = "file_arra['cannotedit']"
					isimage = "file_arra['isimage']"
					attachmentid = "file_arra['fileid']"
					maxsize="file_arra['maxsize']" 
					attachmentname="file_arra['attachmentname']"
					attachmenttype="file_arra['attachmenttype']" 
					attachmentdesc="file_arra['attachmentdesc']" 
					isrequire="file_arra['isrequire']" 
					skin ="file_arra['skin']"
					tagname="file_arra['tagname']">
				</dupload:upload>
			</span>
       	</div>
	
		<div class="weui-form-preview__item">
          	<label class="weui-form-preview__label">工单状态</label>
          	<em class="weui-form-preview__value">{$data['bizstatus']|get_codeset= ###,$WorkorderStatusOptions}</em>
       	</div>
	
	</div>
   </div>
	
