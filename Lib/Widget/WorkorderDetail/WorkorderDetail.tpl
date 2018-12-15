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

<div class="layui-form-item">
	<label class="layui-form-label required">产品</label>
	<div class="layui-input-block">
		<eq name="Think.ACTION_NAME" value="detail" >
			<div class="layui-form-mid" style="white-space:normal; word-break:break-all;">{$data['productid']|get_codeset= ###,$products}</div>
		<else/>
			<html:select options="products" first="请选择" name="productid" lay_verify="required" selected="data['productid']" readonly="readonly"/>
		</eq>
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label required">站点</label>
	<div class="layui-input-block">
		<eq name="Think.ACTION_NAME" value="detail" >
			<div class="layui-form-mid" style="white-space:normal; word-break:break-all;">{$data['objectid']|get_codeset= ###,$sites}</div>
		<else/>
			<html:select options="sites" first="请选择" name="objectid" lay_verify="required" selected="data['objectid']" readonly="readonly" lay_search="true"/>
		</eq>
		
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label required">标题</label>
	<div class="layui-input-block">
		<eq name="Think.ACTION_NAME" value="detail" >
			<div class="layui-form-mid" style="white-space:normal; word-break:break-all;">{$data['title']}</div>
		<else/>
			<input type="text" name="title" value="{$data['title']}" required="" lay-verify="required" placeholder="请输入工单标题" autocomplete="off" class="layui-input">
		</eq>
	</div>
</div>
<div class="layui-form-item layui-form-text">
	<label class="layui-form-label required">内容</label>
	<div class="layui-input-block">
		<eq name="Think.ACTION_NAME" value="detail" >
			<div class="layui-form-mid" style="white-space:normal; word-break:break-all;">{$data['content']}</div>
		<else/>
			<textarea name="content" placeholder="请输入内容" required="" lay-verify="required"  class="layui-textarea">{$data['content']}</textarea>
		</eq>
	</div>
</div>

<div class="layui-form-item layui-form-text">
	<label class="layui-form-label">相关附件</label>
	<div class="layui-input-block">
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
	</div>
</div>	

<eq name="Think.ACTION_NAME" value="detail" >
<div class="layui-form-item">
	<label class="layui-form-label required">工单状态</label>
	<div class="layui-input-block">
		<eq name="Think.ACTION_NAME" value="detail" >
			<div class="layui-form-mid" style="white-space:normal; word-break:break-all;">{$data['bizstatus']|get_codeset= ###,$WorkorderStatusOptions}</div>
		<else/>
			<html:select options="WorkorderStatusOptions" first="请选择" name="bizstatus" id="bizstatus" lay_verify="bizstatus" selected="data['bizstatus']"/>
		</eq>
	</div>
</div>
</eq>

<input type="hidden" name="returnUrl" value="{$returnUrl}">
<input type="hidden" name="objecttype" value="site">


