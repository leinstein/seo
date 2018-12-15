
<!-- 正则验证 begin -->
<script type="text/javascript" src="__PUBLIC__/js/regular.js"></script>
<!-- 正则验证 end -->
<script>
	$(function() {
		layui.use(['form'], function(){
			var form = layui.form;

			//自定义验证规则
			form.verify({
				email: function(value){
					if( $.trim(value) && !verifyEmail($.trim(value) )){
			    		return '请输入正确的邮箱';
			  		}
				},
				QQnumber: function(value){
					if( $.trim(value) && !verifyQQ($.trim(value) )){
			    		return '请输入正确的QQ';
			  		}
				},
				mobileno: function(value){
					if( $.trim(value) && !verifyMobile($.trim(value) )){
			    		return '请输入正确的手机号';
			  		}
				},
				required_pid : function(value){
					// 只有选择的用户类型是 二级用户才进行判断
					if( $("#usertype_id").val() == 'seller' || $("#usertype_id").val() == 'customer' ){
						
						if( !$.trim(value) ){
				    		return '请选择分管经理';
				  		}
			  		}
				}
				
			});

			form.on('select', function(data){
				var dom_name = $(data.elem).attr('name');
				//console.log(dom_name)
				// 如果是用户类型选择了
				if( dom_name =='usertype' ){
					var value = data.value;
					/* console.log(value);
					console.log($(data.elem).find("option:selected").text());  */
					$("#usertype_desc").val( $(data.elem).find("option:selected").text() );
					switch( value ){
						case "seller":
						case "customer":
							var url = "__URL__/get_"+value+"_managers/request_type/ajax";
							/* console.log(url); */
							$.ajax({url: url,
								dataType: 'json',
				    			success: function(data){
				    				//console.log( data)
				    				// 如果返回的结果又值
				    				if( data ){
				    					$("#pid_div").show()
				    					$("#pid_select option").remove();
				    					$("#pid_select").append("<option value=''>请选择</option>");
				    					for(var i in data){
				    						$("#pid_select").append("<option value='"+i+"'>"+data[i]+"</option>");
				    					}
				    					
					    			//	$("#roleno")
				    				//	form.render('select', 'pid_select'); //更新 lay-filter="test2" 所在容器内的全部 select 状态
				    					form.render('select'); //更新 lay-filter="test2" 所在容器内的全部 select 状态
									}  else{
										//$("#pid_div").hide();
									}
				    			}
							});  
					  	break;
					default:
						$("#pid_div").hide();
					}
					
				}
				  /* console.log(data);
				  console.log(data.elem); //得到select原始DOM对象
				  console.log(data.value); //得到被选中的值
				  console.log(data.othis); //得到美化后的DOM对象
				  console.log( ); */
			});
			
			form.on('submit(go)', function(data) {
				
			});


		});
	});
</script>


<div class="layui-form-item">
	<label class="layui-form-label required">用户名</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" name="username" required="" lay-verify="required"  placeholder="请输入登录用户名" value="{$data['username']}" <neq name="Think.ACTION_NAME" value="insertStaffPage">readonly="readonly" </neq>>
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label">邮箱地址</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" name="email" lay-verify="email" placeholder="请输入常用邮箱" value="{$data['email']}" <eq name="Think.ACTION_NAME" value="staff_detail">readonly="readonly" </eq>>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">公司名称</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" name="epname" value="{$data.epname|default='上海米同网络科技有限公司'}" readonly="readonly">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">真实姓名</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" name="truename" required="" lay-verify="required" placeholder="员工的真实姓名" value="{$data['truename']}" <eq name="Think.ACTION_NAME" value="staff_detail">readonly="readonly" </eq>>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">QQ号码</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" name="QQnumber" lay-verify="QQnumber" placeholder="QQ号码" value="{$data['QQnumber']}" <eq name="Think.ACTION_NAME" value="staff_detail">readonly="readonly" </eq>>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">手机号码</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" name="mobileno" placeholder="手机号码" lay-verify="required|mobileno" value="{$data['mobileno']}" <eq name="Think.ACTION_NAME" value="staff_detail">readonly="readonly" </eq>>
	</div>
</div>
<eq name="Think.ACTION_NAME" value="insertStaffPage">

<!-- 所在部门 begin -->
<!-- <div class="layui-form-item">
	<label class="layui-form-label required">部门</label>
	<div class="layui-input-block">
		<html:select options="data.departnoOptions"  first="请选择" name="departno" lay_verify="required" selected="data['departno']" readonly="readonly"/>
		
		<input type="hidden" name="usertype" value="{$data['usertype']}">
	</div>
</div> -->
<!-- 所在部门 end -->
<notempty name="data['usertype']">
<div class="layui-form-item">
	<label class="layui-form-label required">用户类型</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" value="{$data['usertype_desc']}"readonly="readonly">
		<input type="hidden" name="usertype" value="{$data['usertype']}">
		<input type="hidden" name="usertype_desc" value="{$data['usertype_desc']}">
	</div>
</div>

<div class="layui-form-item" id="pid_div">
	<label class="layui-form-label required">分管经理</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" value="{$data['pusername']}" readonly="readonly">
		<input type="hidden" name="pid" value="{$data['pid']}">
	</div>
</div>
<else/>

<div class="layui-form-item">
	<label class="layui-form-label required">用户类型</label>
	<div class="layui-input-block">
		<html:select options="data['usertypeOptions']"  first="请选择" id="usertype_id" name="usertype" lay_verify="required" selected="data['usertype']" lay_filter="usertype" readonly="readonly"/>
		
		<input type="hidden" name="usertype_desc" id="usertype_desc" value="{$data['usertype_desc']}">
	</div>
</div>

<div class="layui-form-item" id="pid_div" style="display: none;">
	<label class="layui-form-label required">分管经理</label>
	<div class="layui-input-block">
		<html:select first="请选择" name="pid" id="pid_select" lay_verify="required_pid" selected="data['pid']"/>
	</div>
</div>
</notempty>

</eq>
<input type="hidden" name="id" value="{$data['id']}">
<input type="hidden" name="returnUrl" value="{$Think.get.returnUrl}">

<neq name="Think.ACTION_NAME" value="staff_detail">
<div class="layui-form-item">
	<div class="layui-input-block">
		<input type="hidden" name="id" value="{$data['id']}">
		<input type="hidden" name="returnUrl" value="{$Think.get.returnUrl}">
		<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">确定</button>
	</div>
</div>
</neq>




