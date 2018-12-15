
<script type="text/javascript">
	$(function() {
		layui.use(['form'], function(){
			var form = layui.form;
		  	form.on('select', function(data){
			 // console.log(data['elem']);
			  
			  /* console.log($(data.elem).attr('name')); //得到select原始DOM对象
			  console.log(data.value); //得到被选中的值
			  console.log(data.othis); //得到美化后的DOM对象 */
			  
			 var dom_name = $(data.elem).attr('name');
		  	// 如果选择了部门需要通过ajax来获取全部的角色
		  	if( dom_name == 'departno'){
		  		var url = "__URL__/getRoleCodeset/departno/"+data.value+"/request_type/ajax";
		  		console.log(url)
				$.ajax({url: url,
					dataType: 'json',
	    			success: function(data){
	    				console.log( data)
	    				// 如果返回的结果又值
	    				if( data ){
	    					$("#roleno option").remove();
	    					$("#roleno").append("<option value=''>工作职位</option>");
	    					for(var i in data){
	    						$("#roleno").append("<option value='"+i+"'>"+data[i]+"</option>");
	    					}
	    					
		    			//	$("#roleno")
	    					form.render('select', 'departno'); //更新 lay-filter="test2" 所在容器内的全部 select 状态
						}  else{
						}
	    			}
				});  
			  }
			 // alert()
			});
		  
		});
	});
	
	 function cancelRecord(id) {
		 layer_confirm('您确认注销该用户么？',
             function () {

                 window.location.href = "__URL__/cancelRecord/id/" + id + "&returnUrl={$returnUrl}";

		});
     }
	 
</script>


<h3 class="rwgl mb20">
	<eq name="list['can_add_staff']" value="1">
		<a href="javascript:;" onclick="open_layer('添加员工','{:U('insertStaffPage')}?returnUrl={$returnUrl}','50%')" class="layui-btn"><i class="iconfont icon-jia"></i> 添加员工</a>
	</eq>
</h3>
<form class="layui-form mt10" name="form1" id="form1" method="get" action="__URL__" >
	<!-- <input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
	<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
	<input type="hidden" name="g" value="{$Think.GROUP_NAME}" /> -->
	<div class="layui-form-item">
		<div class="layui-inline">

			<div class="layui-input-inline">
				<input name="username" class="layui-input" value="{$Think.get.username}" placeholder="用户名">
			</div>
			
			<eq name="me.usertype" value="agent">
			<div class="layui-input-inline">
				<html:select options="departnoOptions" first="所属部门" name="departno"  selected="_GET['departno']" lay_filter="departno"/>
			</div>
			
			<div class="layui-input-inline">
				<html:select options="rolenoOptions" first="工作职位" name="roleno"  id="roleno" selected="_GET['roleno']" />
			</div>
			
			</eq>
			<div class="layui-input-inline">
				<html:select options="userstatusOptions" first="用户状态" name="userstatus"  selected="_GET['userstatus']" />
			</div>
			
			
			<div class="layui-input-inline">
				<input type="submit" name="sub" value="查询" class="layui-btn"> 
				<input type="button" name="btn" value="重置" onclick="location.href='__URL__/{$Think.ACTION_NAME}'" class="layui-btn layui-btn-primary">
				
			</div>
		</div>
	</div>
</form>
		
<table class="layui-table">
	<thead>
		<tr>
		<th>序号</th>
		<th>用户名</th>
		<th>用户姓名</th>
		<th>分管经理</th>
		<th>用户类型</th>
		<th>用户状态</th>
		<th>创建时间</th>
		<th>管理</th>
	</tr>
</thead>
<tbody>
	<notempty name="list['data']">
	<volist name="list['data']" id="vo">
	<tr >
	<php>$rowspan = count( $vo['child']);</php>
		<td rowspan="{$rowspan}" <eq name="vo.userstatus" value="注销">style="background: #ccc"</eq>>{$vo['No']}</td>
		<!-- <td>{$vo['id']}</td> -->
		<!-- 一级代理商 -->
		<td rowspan="{$rowspan}" <eq name="vo.userstatus" value="注销">style="background: #ccc"</eq>>
			<a href="javascript:;" onclick="open_layer('查看用户','{:U('staff_detail')}/id/{$vo['id']}','50%')" >{$vo['username']}</a>
		</td>
		
		<!-- <td>
			<a href="javascript:;" onclick="open_layer('查看子用户','{:U('staff_detail')}/id/{$vo['child'][0]['id']}',550 ,450)" >{$vo['child'][0]['username']}</a> 
		</td> -->
		
		<!-- 用户姓名 -->
		<td <eq name="vo.userstatus" value="注销">style="background: #ccc"</eq>>
			{$vo['truename']}
		</td>
	
		<td <eq name="vo.userstatus" value="注销">style="background: #ccc"</eq>>
			<notempty name="vo.parent">
			{$vo['parent']['username']}
			<else/>
			-
			</notempty>
		</td>
	
		<!--用户类型-->
		<td <eq name="vo.userstatus" value="注销">style="background: #ccc"</eq>>
			{$vo['usertype']|get_codeset= ###,$userrole_options}
		</td>
		
		<!--状态-->
		<td <eq name="vo.userstatus" value="注销">style="background: #ccc"</eq>>{$vo['userstatus']}</td>
		<!--创建时间-->
		<td <eq name="vo.userstatus" value="注销">style="background: #ccc"</eq>>
			{$vo['createtime']|format_date} 
		</td>
	
		
		<!--管理-->
		<td rowspan="{$rowspan}" <eq name="vo.userstatus" value="注销">style="background: #ccc;"</eq>>
		
			<!-- 修改员工信息 begin -->
			<eq name="vo.can_edit" value="1">
			<a class="layui-btn layui-btn-mini" href="javascript:;" onclick="open_layer('修改员工信息','{:U('updateStaffPage')}/id/{$vo['id']}&returnUrl={$returnUrl}','50%')" >修改</a>
			<else/>
			<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">修改</button>
	   		</eq>
	   		<!-- 修改员工信息 end -->
	   		
	   		<!-- 注销员工 begin -->
			<eq name="vo.can_cancel" value="1">
			<a href="javascript:;" onclick="cancelRecord({$vo['id']})" class="layui-btn layui-btn-danger layui-btn-mini">注销</a>
			<else/>
			<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">注销</button>
			</eq>
			
			<!-- 注销员工 end -->
			
			<!-- 分配客户 begin -->
			<eq name="vo.can_assign" value="1">
			<a class="layui-btn layui-btn-mini" href="javascript:;" onclick="open_layer('分配客户','{:U('assignCustomerPage')}/id/{$vo['id']}/usertype/{$vo['usertype']}?returnUrl={$returnUrl}','100%')" >分配客户</a>
			<else/>
			<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">分配客户</button>
			</eq>
			<!-- 分配客户 end -->
			
			<!-- 修改员工密码 begin -->
			<eq name="vo.can_update_pwd" value="1">
			<a class="layui-btn layui-btn-mini" href="javascript:;" onclick="open_layer('修改员工密码','{:U('UserManagement/updatePasswordPage')}/id/{$vo['id']}&returnUrl={$returnUrl}',550,400)" >密码</a>
			<else/>
			<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">密码</button>
			</eq>
			<!-- 修改员工密码 end -->
			
			<!-- 登录 begin -->
			<!-- <eq name="vo.can_login" value="1">
			<a class="layui-btn layui-btn-mini" target="_blank" href="__URL__/loginSubuser/userid/{$vo['id']}">登录</a>
			<else/>
			<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">登录</button>
			</eq> -->
			<!-- 登录 end -->
			<!-- <a class="layui-btn layui-btn-danger layui-btn-mini" href="javascript:;" onclick="deleteRecord({$vo['id']})">删除</a> -->
		
		
		</td>

	</tr>
	<php>unset($vo['child'][0]);</php>
	<volist name="vo['child']" id="vo2" >
	<tr>
	
		<td>
			<a href="javascript:;" onclick="open_layer('查看子用户','{:U('staff_detail')}/id/{$vo2['id']}','50%')" >{$vo2['username']}</a> 
			</td>
			
		</tr>
		</volist>	
		
		</volist>
		<else />
		<tr>
			<td colspan="15" align="center" class="layui-table-nodata">暂无相关数据</td>
		</tr>
		</notempty>

	</tbody>
</table>

<!-- 分页 begin -->		
<div class="layui-box layui-laypage">
	{$list['html']}
</div>	
<!-- 分页 end -->	  


