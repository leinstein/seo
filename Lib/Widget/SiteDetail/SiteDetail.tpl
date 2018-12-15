
<script>
	$(function() {
		layui.use(['form'], function(){
			var form = layui.form;
			var ks ="";
			//自定义验证规则
			form.verify({
				mbstatus: function(value){
					
			  		if($.trim(value)== ""){
			    		return '请选择管理后台状态';
			  		}
				},
				sitestatus: function(value){
					
			  		if($.trim(value)== ""){
			    		return '请选择管理审核意见';
			  		}
			  		ks = $.trim(value);
				},
				reviewopinion: function(value){
					if( ks == '被拒绝'){
			        	
						if( $.trim(value)== ""){
				    		return '请填写审核意见';
				  		}
			        }
				} 
			});

			form.on('submit(go)', function(data) {
			});
		});
	});
</script>

<input type="hidden" name="id" value="{$data['id']}">
<input type="hidden" name="returnUrl" value="{$Think.get.returnUrl}">

<div class="layui-form-item">
	<label class="layui-form-label required">站点名称</label>
	<div class="layui-input-block">
		<input type="text" name="sitename" value="{$data['sitename']}" required="" lay-verify="required" placeholder="请输入站点名称" autocomplete="off" class="layui-input" <if condition="$can_update NEQ 1 && $can_insert NEQ 1">readonly="readonly"</if>>
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label required">站点地址</label>
	<div class="layui-input-block">
		<input type="text" name="website" value="{$data['website']}" required="" lay-verify="required" placeholder="请按照格式填写，如：www.baidu.com" autocomplete="off" class="layui-input" <if condition="$can_update NEQ 1 && $can_insert NEQ 1">readonly="readonly"</if>>
	</div>
</div>
<div class="layui-form-item layui-form-text">
	<label class="layui-form-label">ftp</label>
	<div class="layui-input-block">
		<textarea name="ftp" placeholder="请准确FTP信息,以便优化师调整" class="layui-textarea" <if condition="$can_update NEQ 1 && $can_insert NEQ 1">readonly="readonly"</if>>{$data['ftp']}</textarea>
	</div>
</div>

<div class="layui-form-item layui-form-text">
	<label class="layui-form-label">管理后台</label>
	<div class="layui-input-block">
		<textarea name="managebackground" placeholder="请填写后台管理账号,以便优化师调整" class="layui-textarea" <if condition="$can_update NEQ 1 && $can_insert NEQ 1">readonly="readonly"</if>>{$data['managebackground']}</textarea>
	</div>
</div>

<!-- 运维端  在站点合作停的时候可以修改为待审核和优化中 begin -->
<if condition="$can_edit_reviewstatus EQ 1 OR $can_review EQ 1">
<div class="layui-form-item">
	<label class="layui-form-label required"><eq name="can_edit_reviewstatus" value="1">站点状态<else/>审核结论</eq></label>
	<div class="layui-input-block">
		<html:select options="SiteStatusOptions" first="请选择" name="sitestatus" id="sitestatus" lay_verify="sitestatus"/>
	</div>
</div>
</if>

<if condition="$can_edit_reviewopinion EQ 1 OR $can_review EQ 1">
<div class="layui-form-item layui-form-text">
	<label class="layui-form-label">审核意见</label>
	<div class="layui-input-block">
		<textarea name="reviewopinion" placeholder="请填写审核意见" class="layui-textarea" lay-verify="reviewopinion">{$data['reviewopinion']}</textarea>
	</div>
</div>
</if>
<!-- 运维端  在站点合作停的时候可以修改为待审核和优化中 end -->

<!--  审核按钮 begin -->
<eq name="can_edit_mbstatus" value="1">
<div class="layui-form-item">
	<label class="layui-form-label required">后台状态</label>
	<div class="layui-input-block">
		<html:select options="ManageBackgroundStatusOptions" first="请选择" name="mbgstatus" lay_verify="mbstatus"  selected="data['mbgstatus']" />
	</div>
</div>
</eq>

<!--  审核按钮 begin -->
<eq name="can_review" value="1">
<div class="layui-form-item layui-form-text">
	<div class="layui-input-block">
		<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">审核</button>
	</div>
</div>
</eq>
<!-- 审核按钮  end -->

<!-- 修改按钮  begin -->
<eq name="can_update" value="1">
<div class="layui-input-block"> 
	<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">立即提交</button>
</div>
</eq>
<!-- 修改按钮 end  -->

