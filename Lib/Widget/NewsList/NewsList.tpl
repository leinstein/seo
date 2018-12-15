		
	<script type="text/javascript">
		$(function() {
			/* layui.use(['form'], function(){
				var form = layui.form;
			  
			  
			}); */
		});
		
		/**
		* 刪除文章
		*/
		function del( id ){
		
			layer_confirm('文章删除后不可恢复，您确定删除？', function(){ 
				var url  = "{:U('News/delete')}/type/ajax/id/"+ id;
	
			  	$.ajax({
	          		type: "get",
		          	url: url,
		          	dataType: "json",
		          	success: function ( result ) {
		          		if( result.status == 1 ){
		          			layer_msg('刪除成功');
			                $("#tr_" + id).remove();
			          	}else{
			          		layer_alert(result.info);
			          	}	              
		          	}
	      		}) 
			});
		
		}
	</script>
	
		
	<!-- <form name="form1" id="form1" method="get" action="__URL__" class="form-inline layui-form" style="margin-bottom: 15px;">
		<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
		<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
		<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
		
		<div class="layui-form-item">
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <input type="text" class="layui-input" name="keyword" value="{$Think.get.newstitle}" placeholder="关键词">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <input type="text" name="website" class="layui-input" value="{$Think.get.website}" placeholder="网址">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <html:select options="SearchengineOptions" first="全部搜索引擎" name="searchengine"  style="" selected="_GET['searchengine']" />
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <html:select options="keywordstatusOptions" first="所有状态" name="keywordstatus"  style="" selected="_GET['keywordstatus']" />
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <html:select options="standardstatusOptions" first="达标状态" name="standardstatus"  style="" selected="_GET['standardstatus']" />
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
		        <button type="reset" name="btn"onclick="location.href='__URL__/effect'" class="layui-btn layui-btn-primary">重置</button>
		      </div>
		    </div>
		  </div>
	</form>
	 -->
	<table class="layui-table">
 	<!-- <colgroup>
	   	<col width="150">
	   	<col width="200">
	   	<col>
 	</colgroup> -->
 	<thead>
    <tr>
      	<th width="50">序号</th>
		<th>文章标题</th>
		<th>发布人</th>
		<th>发布时间</th>
		<th>操作</th>
    </tr> 
 	</thead>
	<tbody>
 		<notempty name="list['data']">
		<volist name="list['data']" id="vo">
	    <tr id="tr_{$vo['id']}">
	      	<td>{$vo['No']}</td>
			<td>
				<switch name="vo.newstype">
				    <case value="notice"><php>$pre = '【公告】';</php></case>
				    <case value="protocol"><php>$pre = '【协议】';</php></case>
				    <default /><php>$pre = '';</php>
			 	</switch>
				<a target="_balnk" href="{:U('News/detail')}/id/{$vo['id']}">{$pre}{$vo['newstitle']}</a>
			</td>
			<td>{$vo['pubuser']}</td>
			<td>{$vo['pubtime']|format_date}</td>
			<td>
				<!-- <a href="javascript:void(0);" onclick="open_layer('查看详情','{:U('detail')}/id/{$vo['id']}',600,680)" class="layui-btn layui-btn-mini">查看详情</a> -->
				<eq name="vo['is_can_edit']" value="1">
					<a href="javascript:void(0);" onclick="open_layer('编辑','{:U('News/updatePage')}/id/{$vo['id']}','100%')" class="layui-btn layui-btn-mini">编辑</a>
					<a href="javascript:void(0);" onclick="del({$vo['id']});" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
				<else/>
					<a href="javascript:void(0);"  class="layui-btn layui-btn-disabled layui-btn-mini">编辑</a>
					<a href="javascript:void(0);"  class="layui-btn layui-btn-disabled layui-btn-mini">删除</a>
				</eq>
			</td>
	    </tr>
	   </volist>
	<else/>
	<tr>
		<td colspan="15" align="center" class="layui-table-nodata">暂无相关数据</td>
	</tr>
	</notempty>
 	</tbody>
</table>

<!-- 分页 begin -->		
<div class="layui-box layui-laypage fr">
	{$list['html']}
</div>	
<!-- 分页 end -->	
	