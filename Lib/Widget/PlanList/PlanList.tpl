	
	<form name="form" method="get" action="__URL__" class="form-inline layui-form">
		<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
		<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
		<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
		
		<div class="layui-form-item">
			<div class="layui-inline">
		    	<div class="layui-input-inline" >
					<input name="planname" class="layui-input" value="{$Think.get.planname}" placeholder="计划名称">
				</div>
			</div>
			<div class="layui-inline">
		      	<div class="layui-input-inline">
		      		<html:select options="PlanStatusOptions" first="计划状态" name="planstatus" selected="_GET['planstatus']" />
	      		</div>
		    </div>		      
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <html:select options="PerPageOptions" first="默认每页显示20条" name="num_per_page"  style="" selected="_GET['num_per_page']" />
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <input type="submit" name="sub" value="查询" class="layui-btn">
		        <button type="reset" name="btn" onclick="location.href='__URL__/{$Think.ACTION_NAME}'" class="layui-btn layui-btn-primary">重置</button>
		      </div>
		    </div>
		  </div>
	</form>
	
	
	<form name="form2" action="{:U('QRPlane/reviewBatch')}" method="post" class="layui-form">
		<input type="hidden" name="returnUrl" value="{$returnUrl}" />
		<table class="layui-table">
		 	<thead>
			    <tr>
					<th width="50" align="center">序号</th>
					<th>计划名称</th>
					<th>关键词总量</th>
					<th>排位数</th>
					<th>提交用户</th>
					<th>提交时间</th>
					<th>计划状态</th>
					<th>操作</th>
				</tr>
		 	</thead>
			<tbody>
		 		<notempty name="list['data']">
				<volist name="list['data']" id="vo">
			    <tr>			    
			    	<td>
			    		<eq name="vo.can_review" value="1">
							<input type="checkbox" id="id_{$vo['id']}" name="id[]" value="{$vo['id']}" lay-skin="primary">
						</eq>
						&nbsp;{$vo['No']}
					</td>
				    <td style="vertical-align: middle;">
						<a href="{:U('QRKeyword/index')}/planid/{$vo['id']}" class="btn btn-link add_site_btn">{$vo['planname']}</a>
					</td>
					<td style="vertical-align: middle;">{$vo['keywordnumber']}</td>
					<td style="vertical-align: middle;">{$vo['']}</td>
					<td style="vertical-align: middle;">{$vo['createusername']}</td>
					<td style="vertical-align: middle;">{$vo['createtime']}</td>
					<td class="center">{$vo['planstatus']}</td>
					<td style="vertical-align: middle;"> 
						<!-- 可以审核 -->
						<eq name="vo.can_review" value="1">
							<a href="javascript:;" onclick="open_layer('审核','{:U('reviewPage')}/id/{$vo['id']}&returnUrl={$returnUrl|urlencode}','50%')" class="layui-btn layui-btn-mini">审核</a>
						<else/>
							<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">审核</button>
						</eq>
						
						<!-- 可以编辑 -->
						<eq name="vo.can_edit" value="1">
							<a href="javascript:;" onclick="open_layer('修改计划','{:U('updatePage')}/id/{$vo['id']}&returnUrl={$returnUrl|urlencode}','50%')" class="layui-btn layui-btn-mini">修改</a>
						<else/>
							<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">修改</button>
						</eq>
						
						<!-- 可以删除 -->
						<eq name="vo.can_delete" value="1">
							<a href="javascript:;" onclick="deleteRecord({$vo['id']})" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
						<else/>
							<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">删除</button>
						</eq>
						
					</td>
				</tr>
			   	</volist>
			   	<tr>
		   			<td colspan="10 align="left" style="text-align: left;padding-left: 22px !important;">
				    	<eq name="list.can_review" value="1">
				   		<div class="layui-inline">
					      	<div class="layui-input-inline">
					      		<input id="checkAll" type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" title="全选">
					      		<!-- <label style="float: right;padding-right: 15px;line-height: 18px;background: 0 0;color: #666;padding: 0 10px;height: 100%;font-size: 14px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">/反选</label> -->
					   		</div>
					    </div>
					    <div class="layui-inline">
					      <div class="layui-input-inline">
					        <html:select options="PlanStatusOptions" first="请选择审核结论" name="keywordstatus" id="keywordstatus"/>
					      </div>
					    </div>
						
					    <div class="layui-inline">
					      <div class="layui-input-inline">
					        <input type="text" class="layui-input" name="reviewopinion" id="reviewopinion"  placeholder="请填写审核意见"/>		
					      </div>
					    </div>
					    <div class="layui-inline">
					      <div class="layui-input-inline">
					        <input class="layui-btn" type="button"  value="批量审核" onclick="reviewBatch()">
					        <input class="layui-btn layui-btn-danger" type="button"  value="批量删除" onclick="deleteBatch()">
					      </div>
					    </div>
						</eq>
					<!-- 分页 begin -->		
					<div class="layui-box layui-laypage fr">
						{$list['html']}
					</div>
					<!-- 分页 end -->	
				</td>
			</tr>
			<else/>
			<tr>
				<td colspan="15"  align="center" class="layui-table-nodata">暂无相关数据</td>
			</tr>
			</notempty>
		 	</tbody>
		</table>	
	</form>
	<script type="text/javascript">
	$(function() {
		layui.use('form', function(){
		  var $ = layui.jquery, form = layui.form();
		  //全选
		  form.on('checkbox(allChoose)', function(data){
		    var child = $(data.elem).parents('table').find('input[name="id[]"]');
		    child.each(function(index, item){
		      item.checked = data.elem.checked;
		    });
		    form.render('checkbox');
		  });
		  
		  form.on('checkbox', function(data){
			 // console.log(data.elem.checked);
			});
		  
		});
	});
	
	/**
	 * 批量审核
	 * @accesspublic
	 */
	function reviewBatch() {
		
		//获取选中的关键词
	 	var ids = getChecked( 'layui' );
	  	if ( ids == "" || ids == 0 ) {
		  	layer_alert("请您选中计划");
	       	return false;
	   }
	       
	      
			var keywordstatus = $("#keywordstatus").val();
	        
	   if ( keywordstatus == "") {
		   layer_alert("请您选择审核结论");
	       return false;
	   }
	   
	   // 
	   if( keywordstatus == '被拒绝'){
	   	
	       	if( $("#reviewopinion" ).val() == ''){
	       		layer.msg('请填写审核意见！'); 
	       		return false;
	       	}
	   }
	   
	   layer_confirm('您确定审核选中的计划？', function(){ 
		   	document.form2.action="{:U('QRPlan/reviewBatch')}";
		   	 	document.form2.submit();
		});
	   
	}
	
	
	/**
	* 刪除關鍵詞
	*/
	function del( id ){
	
	layer_confirm('关键词删除后不可恢复，您确定删除？', function(){ 
		   var url = "__URL__/delete/type/ajax/id/"+ id;
	   	window.location.href= url;return false;
	  	$.ajax({
	          type: "get",
	          url: url,
	          dataType: "json",
	          success: function ( result ) {
	          	
	          	if( result.status == 1 ){
	          		layer_msg('刪除成功');
	                $("#dd" + id).remove();
	          	}else{
	          		layer_alert(result.info);
	          	}	              
	          }
	      }) 
	});
	
	}
	
	function deleteBatch() {
	//获取选中的关键词
	//获取选中的关键词
	var ids = getChecked( 'layui' );
	 if ( ids == "" || ids == 0 ) {
	      layer_alert("请您选择关键词");
	      return false;
	  }
	 layer_confirm('关键词删除后不可恢复，您确定删除？', function(){ 
	
		var url = "__URL__/delete/type/ajax/id/"+ ids;
	   	window.location.href= url;return false;
	  	$.ajax({
	          type: "get",
	          url: url,
	          dataType: "json",
	          success: function ( result ) {
	          	
	          	if( result.status == 1 ){
	          		layer_msg('刪除成功');
		                // var id_arr=ids.split(","); //字符分割 
	                  for (i=0;i<ids.length ;i++ ) { 
	                  	 $("#dd" + ids[i]).remove();
	                  } 
	          	}else{
	          		layer_alert(result.info);
	          	}
	       
	             
	          }
	      }) 
	      
	
	 });
	
	}
	/**
	 * 批量解冻关键词
	 * @accesspublic
	 */
	function unfreezeBatch() {
		
		//获取选中的关键词
	 	var ids = getChecked( 'layui' );
		if ( ids == "" || ids == 0 ) {
		  	layer_alert("请您选中关键词");
	       	return false;
	   	}
	       
	      
		var keywordstatus = $("#keywordstatus").val();
	        
	   	if ( keywordstatus == "") {
		   layer_alert("请您选择审核结论");
	       return false;
	   	}
	   
	
	   	layer_confirm('您确定解冻选中的关键词？', function(){ 
	   		
	   		document.form2.action="{:U('Keyword/unfreezeBatch')}";
			document.form2.submit();
		});
	}
	
</script>