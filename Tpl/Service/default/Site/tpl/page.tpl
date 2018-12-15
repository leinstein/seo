
<script>
	$(function() {
		layui.use(['form'], function() {
			var form = layui.form;

			//自定义验证规则
			form.verify({
			/* sitename: function(value){
			  if(value.length < 5){
			    return '标题也太短了吧';
			  }
			}
			,pass: [/(.+){6,12}$/, '密码必须6到12位'] */
			});

			form.on('submit(*)', function(data) {
				console.log(data)
				return false;
			});

			/* //事件监听
			form.on('select', function(data){
			  console.log(data);
			});

			form.on('select(aihao)', function(data){
			  console.log(data);
			});
			
			form.on('checkbox', function(data){
			  console.log(data.elem.checked);
			});
			
			form.on('switch', function(data){
			  console.log(data);
			});
			
			form.on('radio', function(data){
			  console.log(data);
			});
			
			//监听提交
			form.on('submit(*)', function(data){
			  console.log(data)
			  return false;
			}); */

		});
	});
</script>


<div class="layui-form-item">
	<label class="layui-form-label">站点名称</label>
	<div class="layui-input-block">
		<input type="text" name="sitename" value="{$data['sitename']}" required="" lay-verify="required" placeholder="请输入站点名称" autocomplete="off" class="layui-input">
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label">站点地址</label>
	<div class="layui-input-block">
		<input type="text" name="website" value="{$data['website']}" required="" lay-verify="required" placeholder="请按照格式填写，如：www.baidu.com" autocomplete="off" class="layui-input">
	</div>
</div>
<div class="layui-form-item layui-form-text">
	<label class="layui-form-label">ftp</label>
	<div class="layui-input-block">
		<textarea name="ftp" placeholder="请准确FTP信息,以便优化师调整" class="layui-textarea">{$data['ftp']}</textarea>
	</div>
</div>

<div class="layui-form-item layui-form-text">
	<label class="layui-form-label">管理后台</label>
	<div class="layui-input-block">
		<textarea name="managebackground" placeholder="请填写后台管理账号,以便优化师调整" class="layui-textarea">{$data['managebackground']}</textarea>
	</div>
</div>




