<script type="text/javascript">
$(function() {
	var  layedit = "";
	var  layedit_index = "";
	layui.use(['form'], function(){
		var form = layui.form;
	  
	  //自定义验证规则
	  form.verify({
		  /* my_mobile: function(value){
	      	if( $.trim( value ) && !verifyMobile( value ) ){
	        	return '手机号格式不正确';
	      	}
	      },*/
	      textarea: function(value){
	    	  if( !layedit.getText(layedit_index) ){
	    		  return '请您填写文章1正文';
	    	  }
		     
		  }
	  });

	
	  //监听提交
	  form.on('submit(go)', function(data){
	  });
	  
	});
	
	layui.use(['layedit'], function(){
	  layedit = layui.layedit;
	  
	  //构建一个默认的编辑器
	  //var index = layedit.build('layer_textarea');
	  //var index = layedit.build('layer_textarea', {
		   // tool: ['strong','italic','underline','del', '|', 'left', 'center', 'right', '|','face', 'link', 'unlink']
		//});
	  
	  	layedit.set({
		  uploadImage: {
		    url: "{:U('Upload/doUpload1')}" //接口url
		    ,type: '' //默认post
		  }
		});
		//注意：layedit.set 一定要放在 build 前面，否则配置全局接口将无效。
		layedit_index = layedit.build('layer_textarea',{
			height:500
		}); //建立编辑器
	 
	});
}); 

	
</script>
		
<div class="layui-form-item">
	<label class="layui-form-label required">标题</label>
	<div class="layui-input-block">
		<input type="text" name="newstitle"  value="{$data['newstitle']}" required="" lay-verify="required" placeholder="请填写标题"  autocomplete="off" class="layui-input">
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label required">正文</label>
	<div class="layui-input-block">
		<textarea name="newscontent" placeholder="请填写正文" class="layui-textarea" id="layer_textarea" lay-verify="textarea" style="display: ">{$data['newscontent']}</textarea>
	</div>
</div>

<div class="layui-form-item">
	<div class="layui-input-block">
		<button class="layui-btn" lay-submit="" lay-filter="go">提 交</button>
	</div>
</div>
<input type="hidden" name="id"  value="{$data['id']}">
