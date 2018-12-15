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
				
				remarkmode: function(value){
					
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
		<html:select options="products" first="请选择" name="productid" lay_verify="required" selected="data['productid']"/>
	</div>
</div>
<!-- <div class="layui-form-item">
	<label class="layui-form-label required">站点</label>
	<div class="layui-input-block">
		<html:select options="sites" first="请选择" name="objectid" lay_verify="required" selected="data['objectid']" readonly="readonly" lay_search="true"/>
	</div>
</div> -->
<div class="layui-form-item">
	<label class="layui-form-label required">用户</label>
	<div class="layui-input-block">
		<html:select options="users" first="请选择" name="objectid" lay_verify="required" selected="data['objectid']" lay_search="true"/>
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label required">业务类型</label>
	<div class="layui-input-block">
		<html:select options="RemarkTypeOptions" first="请选择" name="remarktype" lay_verify="required" selected="data['remarktype']"/>
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label required">沟通方式</label>
	<div class="layui-input-block">
		<!-- <html:select options="RemarkModeOptions" first="请选择" name="remarkmode" lay_verify="required" selected="data['remarkmode']"/>
		<html:radio radios="RemarkModeOptions" first="请选择" name="remarkmode" lay_verify="required" checked="data['remarkmode']" separator="&nbsp;&nbsp;&nbsp;&nbsp;"/>  -->
		<volist name="RemarkModeOptions" id="vo">
			<input type="radio" name="remarkmode" value="{$key}" title="{$vo}" lay-verify="remarkmode" <if condition="$key EQ 'QQ' OR $data['remarkmode'] EQ $key">checked=""</if>>
		</volist>
	</div>
</div>
<div class="layui-form-item layui-form-text">
	<label class="layui-form-label required">内容</label>
	<div class="layui-input-block">
		<textarea name="content" placeholder="请输入内容" class="layui-textarea" lay-verify="required">{$data['content']}</textarea>
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

<eq name="Think.ACTION_NAME" value="detail">
<div class="layui-form-item layui-form-text">
	<label class="layui-form-label">创建用户</label>
	<div class="layui-input-block">
		<input type="text" value="{$data['createusername']}" class="layui-input" readonly="readonly">
		<!-- <div class="layui-form-mid">{$data['createusername']}</div> -->
	</div>
</div>
<div class="layui-form-item layui-form-text">
	<label class="layui-form-label">创建时间</label>
	<div class="layui-input-block">
		<input type="text" value="{$data['createtime']|format_date}" class="layui-input" readonly="readonly">
		<!-- <div class="layui-form-mid">{$data['createtime']}</div> -->
	</div>
</div>
</eq>

<input type="hidden" name="returnUrl" value="{$returnUrl}">


