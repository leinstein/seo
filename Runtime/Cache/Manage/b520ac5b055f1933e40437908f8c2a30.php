<?php if (!defined('THINK_PATH')) exit();?>	<script type="text/javascript">
	$(function() {
		layui.use(['form'], function(){
		  var $ = layui.jquery, form = layui.form;
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
	   	document.form2.action="<?php echo U('Keyword/reviewBatch');?>";
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
   		
   		document.form2.action="<?php echo U('Keyword/unfreezeBatch');?>";
		document.form2.submit();
	});
}

</script>
	<form name="form" method="get" action="__URL__" class="form-inline layui-form">
		<input type="hidden" name="m" value="<?php echo (MODULE_NAME); ?>" /> 
		<input type="hidden" name="a" value="<?php echo (ACTION_NAME); ?>" />
		<input type="hidden" name="g" value="<?php echo (GROUP_NAME); ?>" />
		
		<div class="layui-form-item">
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <input type="text" class="layui-input" name="keyword" value="<?php echo ($_GET['keyword']); ?>" placeholder="关键词">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <input type="text" name="website" class="layui-input" value="<?php echo ($_GET['website']); ?>" placeholder="网址">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <select id="" name="searchengine" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >搜索引擎</option><?php  foreach($SearchengineOptions as $key=>$val) { if(!empty($_GET['searchengine']) && ($_GET['searchengine'] == $key || in_array($key,$_GET['searchengine']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <select id="" name="keywordstatus" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >所有状态</option><?php  foreach($keywordstatusOptions as $key=>$val) { if(!empty($_GET['keywordstatus']) && ($_GET['keywordstatus'] == $key || in_array($key,$_GET['keywordstatus']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 160px;">
		        <select id="" name="num_per_page" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >默认每页显示20条</option><?php  foreach($PerPageOptions as $key=>$val) { if(!empty($_GET['num_per_page']) && ($_GET['num_per_page'] == $key || in_array($key,$_GET['num_per_page']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <input type="submit" name="sub" value="查询" class="layui-btn">
		        <button type="reset" name="btn" onclick="location.href='__URL__/<?php echo (ACTION_NAME); ?>'" class="layui-btn layui-btn-primary">重置</button>
		      </div>
		    </div>
		  </div>
	</form>
	
	
	<form name="form2" action="<?php echo U('Keyword/reviewBatch');?>" method="post" class="layui-form">
		<input type="hidden" name="returnUrl" value="<?php echo ($returnUrl); ?>" />
		<table class="layui-table">
	 	
		 	<thead>
		    <tr>
		      	<tr>
					<th width="50" align="center"  >序号</th>
					<th>ID</th>
					<th>关键词</th>
					<th>网址</th>
					<th>搜索引擎</th>
					<th>添加日期</th>
					<th>单价</th>
					<th>状态</th>
					<th width="140">操作</th>
				</tr>
		 	</thead>
			<tbody>
		 		<?php if(!empty($list['data'])): if(is_array($list['data'])): $i = 0; $__LIST__ = $list['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td>
						<!-- 如果当前是解冻操作
						<?php if(($operate) == "unfreeze"): ?><input type="checkbox" id="id_<?php echo ($vo['id']); ?>" name="id[]" value="<?php echo ($vo['id']); ?>" lay-skin="primary">
						<?php else: ?>
							<?php if($vo['keywordstatus'] == '待审核' OR $vo['keywordstatus'] == '合作停'): ?><input type="checkbox" id="id_<?php echo ($vo['id']); ?>" name="id[]" value="<?php echo ($vo['id']); ?>" lay-skin="primary">
							<?php else: ?>
							 <input type="checkbox" id="id_<?php echo ($vo['id']); ?>" lay-skin="primary" disabled="">
							&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; endif; ?>
						-->
						<input type="checkbox" id="id_<?php echo ($vo['id']); ?>" name="id[]" value="<?php echo ($vo['id']); ?>" lay-skin="primary">
						&nbsp;<?php echo ($vo['No']); ?>
					</td>
					<td><?php echo ($vo['id']); ?></td>
					<!-- 关键词 -->
					<td>
						<a href="javascript:;" onclick="open_layer('关键词详情','<?php echo U('detail');?>/id/<?php echo ($vo['id']); ?>?returnUrl=<?php echo (urlencode($returnUrl)); ?>','50%')"><?php echo ($vo['keyword']); ?></a>
						<!-- <a target="_BLANK" href="<?php echo ($vo['searchengine_url']); ?>"><?php echo ($vo['keyword']); ?></a> -->
					</td>
					<!-- 网址 -->
					<td><?php echo ($vo['website']); ?></td>
					<!-- 搜索引擎 -->
					<td><?php echo ($vo['searchengine_ZH']); ?></td>
					<!-- 添加日期 -->
					<td><?php echo ($vo['createtime']); ?></td>
					<!-- 单价 -->
					<td><?php echo (format_money($vo['price'])); echo ($vo['unit']); ?>/<?php echo ($vo['unit2']); ?></td>
					<td><?php echo ($vo['keywordstatus']); ?></td>
			
					<td>
						<!-- 如果当前是解冻操作 -->
						<?php if(($operate) == "unfreeze"): ?><a href="javascript:;" onclick="open_layer('关键词解冻','<?php echo U('unfreezePage');?>/id/<?php echo ($vo['id']); ?>?returnUrl=<?php echo (urlencode($returnUrl)); ?>','50%')" class="layui-btn layui-btn-danger layui-btn-mini">解冻</a>
						<?php else: ?>
							<?php if(($vo['keywordstatus']) == "待审核"): ?><a href="javascript:;" onclick="open_layer('关键词审核','<?php echo U('reviewPage');?>/id/<?php echo ($vo['id']); ?>?returnUrl=<?php echo (urlencode($returnUrl)); ?>','50%')" class="layui-btn layui-btn-mini">审核</a>
								<a href="javascript:;" onclick="del(<?php echo ($vo['id']); ?>)" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
								
							<?php else: ?>
								<?php if(($vo['keywordstatus']) == "合作停"): ?><a href="javascript:;" onclick="open_layer('关键词审核','<?php echo U('reviewPage');?>/id/<?php echo ($vo['id']); ?>?returnUrl=<?php echo (urlencode($returnUrl)); ?>','50%')" class="layui-btn layui-btn-mini">审核</a>
								<?php else: ?>
								<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">审核</button><?php endif; ?>
								<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">删除</button><?php endif; ?>
							<?php if($vo['keywordstatus']=='优化中' || $vo['keywordstatus']=='被拒绝'): ?><a href="javascript:;" onclick="open_layer('关键词解冻','<?php echo U('unfreezePage');?>/id/<?php echo ($vo['id']); ?>?returnUrl=<?php echo (urlencode($returnUrl)); ?>','50%')" class="layui-btn layui-btn-danger layui-btn-mini">解冻</a>
							<?php else: ?>
							<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">解冻</button><?php endif; endif; ?>
					</td>
			
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			   <tr>
			   <td colspan="10 align="left" style="text-align: left;padding-left: 22px !important;">
			   		<div class="layui-inline">
				      	<div class="layui-input-inline">
				      		<input id="checkAll" type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" title="全选/反选">
				   		</div>
				    </div>
				    <div class="layui-inline">
				      <div class="layui-input-inline">
				        <select id="keywordstatus" name="keywordstatus" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >请选择审核结论</option><?php  foreach($keywordstatusOptions1 as $key=>$val) { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } ?></select>
				      </div>
				    </div>
				    <!-- 如果当前是解冻操作 -->
					<?php if(($operate) == "unfreeze"): ?><div class="layui-inline">
				      <div class="layui-input-inline">
				        <input class="layui-btn layui-btn-danger" type="button"  value="批量解冻" onclick="unfreezeBatch()">
				      </div>
				    </div>
					<?php else: ?>
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
				    </div><?php endif; ?>
					<!-- 分页 begin -->		
					<div class="layui-box layui-laypage fr">
						<?php echo ($list['html']); ?>
					</div>	
					<!-- 分页 end -->	
				</td>
			</tr>
			<?php else: ?>
			<tr>
				<td colspan="15" align="center" class="layui-table-nodata">暂无相关数据</td>
			</tr><?php endif; ?>
		 	</tbody>
		</table>
			
	</form>