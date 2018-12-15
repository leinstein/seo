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
	  	layer_alert("请您选中关键词");
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
   
   layer_confirm('您确定审核选中的关键词？', function(){ 
	   	document.form2.action="{:U('Keyword/reviewBatch')}";
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
		      	<tr>
					<th width="50" align="center">序号</th>
					<th>计划名称</th>
					<th>关键词总量</th>
					<th>排位数</th>
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
						<a href="javascript:;" onclick="open_layer('查看详情','{:U('detail')}/id/{$vo['id']}','50%')" class="btn btn-link add_site_btn">{$vo['planname']}</a>
					</td>
					<td style="vertical-align: middle;">{$vo['keywordnumber']}</td>
					<td style="vertical-align: middle;">{$vo['']}</td>
					<td style="vertical-align: middle;">{$vo['createtime']}</td>
					<td class="center">{$vo['planstatus']}</td>
					<td style="vertical-align: middle;"> 
						<!-- 可以审核 -->
						<eq name="vo.can_review" value="1">
							<a href="javascript:;" onclick="open_layer('审核','{:U('updatePage')}/id/{$vo['id']}','50%')" class="layui-btn layui-btn-mini">审核</a>
						<else/>
							<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">审核</button>
						</eq>
						
						<!-- 可以编辑 -->
						<eq name="vo.can_edit" value="1">
							<a href="javascript:;" onclick="open_layer('修改计划','{:U('updatePage')}/id/{$vo['id']}','50%')" class="layui-btn layui-btn-mini">修改</a>
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
					
					
					
					<td>
						<!-- 如果当前是解冻操作 -->
						<eq name="operate" value="unfreeze">
							<a href="javascript:;" onclick="open_layer('关键词解冻','{:U('unfreezePage')}/id/{$vo['id']}&returnUrl={$returnUrl|urlencode}','50%')" class="layui-btn layui-btn-danger layui-btn-mini">解冻</a>
						<else/>
							<eq name="vo['keywordstatus']" value="待审核">
								<a href="javascript:;" onclick="open_layer('关键词审核','{:U('reviewPage')}/id/{$vo['id']}&returnUrl={$returnUrl|urlencode}','50%')" class="layui-btn layui-btn-mini">审核</a>
								<a href="javascript:;" onclick="del({$vo['id']})" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
								
							<else/>
								<eq name="vo['keywordstatus']" value="合作停">
								<a href="javascript:;" onclick="open_layer('关键词审核','{:U('reviewPage')}/id/{$vo['id']}&returnUrl={$returnUrl|urlencode}','50%')" class="layui-btn layui-btn-mini">审核</a>
								<else/>
								<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">审核</button>
								</eq>
								<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">删除</button>
								
							</eq>
							<if condition="$vo['keywordstatus']=='优化中' || $vo['keywordstatus']=='被拒绝'">
								<a href="javascript:;" onclick="open_layer('关键词解冻','{:U('unfreezePage')}/id/{$vo['id']}&returnUrl={$returnUrl|urlencode}','50%')" class="layui-btn layui-btn-danger layui-btn-mini">解冻</a>
							<else/>
							<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">解冻</button>
							</if>
							
						</eq>
					</td>
					
					
					
								
					
					<!-- 关键词 -->
					<td>
						<a href="javascript:;" onclick="open_layer('关键词详情','{:U('detail')}/id/{$vo['id']}&returnUrl={$returnUrl|urlencode}','50%',700)">{$vo['keyword']}</a>
						<!-- <a target="_BLANK" href="{$vo['searchengine_url']}">{$vo['keyword']}</a> -->
					</td>
					<!-- 网址 -->
					<td>{$vo['website']}</td>
					<!-- 搜索引擎 -->
					<td>{$vo['searchengine_ZH']}</td>
					<!-- 添加日期 -->
					<td>{$vo['createtime']}</td>
					<!-- 单价 -->
					<td>{$vo['price']|format_money}{$vo['unit']}/{$vo['unit2']}</td>
					<td>{$vo['keywordstatus']}</td>
			
					<td>
						<!-- 如果当前是解冻操作 -->
						<eq name="operate" value="unfreeze">
							<a href="javascript:;" onclick="open_layer('关键词解冻','{:U('unfreezePage')}/id/{$vo['id']}&returnUrl={$returnUrl|urlencode}','50%')" class="layui-btn layui-btn-danger layui-btn-mini">解冻</a>
						<else/>
							<eq name="vo['keywordstatus']" value="待审核">
								<a href="javascript:;" onclick="open_layer('关键词审核','{:U('reviewPage')}/id/{$vo['id']}&returnUrl={$returnUrl|urlencode}','50%')" class="layui-btn layui-btn-mini">审核</a>
								<a href="javascript:;" onclick="del({$vo['id']})" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
								
							<else/>
								<eq name="vo['keywordstatus']" value="合作停">
								<a href="javascript:;" onclick="open_layer('关键词审核','{:U('reviewPage')}/id/{$vo['id']}&returnUrl={$returnUrl|urlencode}','50%')" class="layui-btn layui-btn-mini">审核</a>
								<else/>
								<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">审核</button>
								</eq>
								<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">删除</button>
								
							</eq>
							<if condition="$vo['keywordstatus']=='优化中' || $vo['keywordstatus']=='被拒绝'">
								<a href="javascript:;" onclick="open_layer('关键词解冻','{:U('unfreezePage')}/id/{$vo['id']}&returnUrl={$returnUrl|urlencode}','50%')" class="layui-btn layui-btn-danger layui-btn-mini">解冻</a>
							<else/>
							<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">解冻</button>
							</if>
							
						</eq>
					</td>
			
				</tr>
			   </volist>
			   <tr>
			   <td colspan="10 align="left" style="text-align: left;padding-left: 22px !important;">
			   		<div class="layui-inline">
				      	<div class="layui-input-inline">
				      		<input id="checkAll" type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" title="全选/反选">
				   		</div>
				    </div>
				    <div class="layui-inline">
				      <div class="layui-input-inline">
				        <html:select options="keywordstatusOptions1" first="请选择审核结论" name="keywordstatus" id="keywordstatus"/>
				      </div>
				    </div>
				    <!-- 如果当前是解冻操作 -->
					<eq name="operate" value="unfreeze">
					<div class="layui-inline">
				      <div class="layui-input-inline">
				        <input class="layui-btn layui-btn-danger" type="button"  value="批量解冻" onclick="unfreezeBatch()">
				      </div>
				    </div>
					<else/>
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
				<td colspan="15" align="center" class="layui-table-nodata">暂无相关数据</td>
			</tr>
			</notempty>
		 	</tbody>
		</table>
			
	</form>