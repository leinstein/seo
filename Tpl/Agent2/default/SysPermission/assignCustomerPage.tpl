<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<script type="text/javascript">

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
function choose( ids ) {
	
	// 如果有ids是单个操作，那么需要将所有的checkbox去掉选中，并将当期的checkbox选中
	if( ids ) {
		// 
  	  	//$.each($('tbody .layui-form-checked'), function(i, n){
  	  	//$.each($('input[type="checkbox"]'), function(i, n){
  	  	$.each($('.layui-form-checkbox '), function(i, n){
  	
  	  		
	  	  	var id = $(this).prev().val();
	  	 
	        if (ids == id ) {
	        	$(this).addClass( 'layui-form-checked');
	        	$(this).prev().prop("checked",true); 
	        }else{
	        	$(this).removeClass( 'layui-form-checked');
	        	$(this).prev().prop("checked", false); 
	        }
		  	
      	  
      	  	
        
        }); 
		
	}
	
	//获取选中的关键词
 	ids = getChecked( 'layui' );
	
  	/* if ( ids == "" || ids == 0 ) {
  		layer_confirm('是否删除全部的用？', function(){ 
  		   	 document.form2.submit();
  		});
       	return false;
   	} */
       
   	layer_confirm('您确定选择选中的用户？', function(){ 
	   	 document.form2.submit();
	});
   
}

</script>
</head>
<tagLib name="html" />
<body>
	<div class="layui-tab-content">
		<form name="form" method="get" action="__URL__" class="form-inline layui-form" style="display:none">
			<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
			<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
			<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
			
			<div class="layui-form-item">
			    <div class="layui-inline">
			      <div class="layui-input-inline">
			        <input type="text" class="layui-input" name="username" value="{$Think.get.username}" placeholder="用户名">
			      </div>
			    </div>
			    <div class="layui-inline">
			      <div class="layui-input-inline">
			        <input type="text" class="layui-input" name="epname"  value="{$Think.get.epname}" placeholder="企业名称">
			      </div>
			    </div>
			    <!-- <div class="layui-inline">
			      <div class="layui-input-inline">
			        <html:select options="SearchengineOptions" first="全部搜索引擎" name="searchengine"  style="" selected="_GET['searchengine']" />
			      </div>
			    </div>
			    <div class="layui-inline">
			      <div class="layui-input-inline">
			        <html:select options="keywordstatusOptions" first="所有状态" name="keywordstatus"  style="" selected="_GET['keywordstatus']" />
			      </div>
			    </div> -->
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
		
		
		<form class="layui-form" name="form2" method="post" action="__URL__/assignCustomer" onkeydown="if(event.keyCode==13){return false;}">
			<input type="hidden" name="returnUrl" value="{$Think.get.returnUrl}" />
			<input type="hidden" name="userid" value="{$Think.get.id}" />
			<input type="hidden" name="usertype" value="{$LoginUserInfo['usertype']}" />
			<table class="layui-table">
		 	
			 	<thead>
			    <tr>
			      	<tr>
						<th width="50" align="center">序号</th>
						<th>用户名</th>
						<th>用户类型</th>
						<th>联系电话</th>
						<th>企业名称</th>
						<th>添加日期</th>
						<!-- <th width="140">操作</th> -->
					</tr>
			 	</thead>
				<tbody>
			 		<notempty name="list">
					<volist name="list" id="vo">
				    <tr>
						<td>
							<!-- 如果当前是解冻操作 -->
							<input type="checkbox" id="id_{$vo['epid']}" name="id[]" value="{$vo['epid']}" lay-skin="primary" <eq name="vo.is_checked" value="1"> checked =""</eq>>					
							&nbsp;{$key+1}
						</td>
						<!-- 关键词 -->
						<td>
							<a href="javascript:;" onclick="open_layer('用户详情','{:U('UserManagement/detail')}/id/{$vo['id']}','50%')">{$vo['username']}</a>					
						</td>
						<td>{$vo['usertype_desc']}</td>
						<td>{$vo['mobileno']}</td>
						<td>{$vo['epname']}</td>
						<!-- 添加日期 -->
						<td>{$vo['createtime']}</td>
						<!-- <td>
							<a href="javascript:;" onclick="choose({$vo['epid']})" class="layui-btn layui-btn-mini">选择</a>
						</td> -->
				
					</tr>
				   </volist>
				   <tr>
				   <td colspan="10 align="left" style="text-align: left;padding-left: 22px !important;">
				   		<div class="layui-inline">
					      	<div class="layui-input-inline">
					      		<input id="checkAll" type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" title="全选">
					   		</div>
					    </div>					  	
					    <div class="layui-inline">
					      <div class="layui-input-inline">
					        <input class="layui-btn" type="button"  value="批量选择" onclick="choose()"></div>
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
					<td colspan="15" align="center" align="center" class="layui-table-nodata">暂无相关数据</td>
				</tr>
				</notempty>
			 	</tbody>
			</table>
		</form>
	</div>
</body>
</html>
