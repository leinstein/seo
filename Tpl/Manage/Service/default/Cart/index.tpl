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
	    var child = $(data.elem).parents('table').find('input[type="checkbox"]');
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

function buy(id) {
	 
    var siteid = $("#url" + id ).val(); 
    
    if (siteid == "") {
    
    	layer_alert('请先选择一个网址，再进行购买');
		return false;
    }
    
    layer_confirm('您确定购买该关键词？',function(){ 
    	var url = "__URL__/buy/type/ajax/id/" + id + "/siteid/" + siteid + "/request_type/ajax";
      	// window.location.href= url;return false;
    	$.ajax({
            type: "get",
            url: url,
            dataType: "json",
            success: function ( result ) {
            	if( result.status == 1 ){
            		
                    $("#dd" + id).remove();
            	}else{
            		layer_alert(result.info );
            	}   
            }
        }) 
    })
 
}

function buyBatch() {


 var siteid = $("#url").val();
    
	if ( siteid == "") {
	    layer_alert('关联网址不能为空');
	    return false;
	}
	
	//获取选中的关键词
	var ids = getChecked( 'layui' );
	if ( ids == "" || ids == 0 ) {
	    layer_alert('请您选择关键词');
	    return false;
	}
	
	layer_confirm('您确定购买选中的关键词？', function(){ 
	   var url = "__URL__/buy/type/ajax/id/" + ids + "/siteid/" + siteid + "/request_type/ajax"
	  	//window.location.href= url;return false;
	 	$.ajax({
	         type: "get",
	         url: url,
	         dataType: "json",
	         success: function ( result ) {
	         	
	         	if( result.status == 1 ){
	         		layer_msg('购买成功');
	                // var id_arr=ids.split(","); //字符分割 
	                var success 	= result.success;
	        		var fail 		= result.fail;
	        		var fail_ids 	= result.fail_ids; 
	        		if( fail > 0 ){
	        			layer_msg("购买成功，有" + fail +"个关键词已经购买过"); 
	        		}else{
	        			layer_msg("购买成功！"); 
	        		}
	        		
	        		var new_ids =  _.difference(ids, fail_ids);
	        		
	                for (i=0;i<new_ids.length ;i++ ) { 
	                	$("#dd" + new_ids[i]).remove();
	                } 
	         	}else{
	         		layer_alert(result.info);
	         	}
	      
	         }
	     }) 
	});

}
/**
* 刪除關鍵詞
*/
function del( id ){

layer_confirm('关键词删除后不可恢复，您确定删除？', function(){ 
	   var url = "__URL__/delete/type/ajax/id/"+ id + "/request_type/ajax";
   	//window.location.href= url;return false;
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
var ids = getChecked( 'layui' );
 if ( ids == "" || ids == 0 ) {
      layer_alert("请您选择关键词");
      return false;
  }
 layer_confirm('关键词删除后不可恢复，您确定删除？', function(){ 

	var url = "__URL__/delete/type/ajax/id/"+ ids + "/request_type/ajax";
   	//window.location.href= url;return false;
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
</script>
</head>
<tagLib name="html" />
<body>
    <!-- 页面顶部 logo & 菜单 begin -->
    <include file="../Public/top_banner" />
    <!-- 页面顶部 logo & 菜单 end -->
    <!-- 页面左侧菜单 begin -->
    <include file="../Public/left_home" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
        <!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>{$LoginUserInfo['oem_config']['product_name']|default='网站优化'}<span class="layui-box">&gt;</span></a>
		  <a><cite>关键词清单</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	 
				<form name="form2" id="form2" action="{:U('buy')}" method="post" class="layui-form">		
					<table class="layui-table">
					  	<thead>
						    <tr>
						    	<th width="50"><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
						      	<th width="100">ID</th>
								<th>关键词</th>
								<th>选择网址</th>
								<th>搜索引擎</th>
								<!--<th>购买天数</th>-->
								<th>日期</th>
								<th>单价</th>
								<th width="100">操作</th>
						    </tr> 
					  	</thead>
				  		<tbody>
					  		<notempty name="list">
							<volist name="list" id="vo">
							<tr id="dd{$vo['id']}">
								<td>
									<input type="checkbox" id="id_{$vo['id']}" name="id[]" value="{$vo['id']}" lay-skin="primary" style="vertical-align: text-bottom;margin-top: 2px;">
								</td>
								<td>{$vo['id']}</td>
								<td>{$vo['keyword']}</td>
								<td>
									<html:select options="sitesOptions" first="请选择" name="url" id="url{$vo['id']}" style="form-control input-sm" />
								</td>
								<td>{$vo['searchengine_ZH']}</td>
								<td>{$vo['createtime']}</td>
								<td>{$vo['price']|format_money}{$vo['unit']}/{$vo['unit2']}</td>
								<td>
									<input type="button" class="layui-btn layui-btn-mini" onclick="buy({$vo['id']});" value="购买">
									<input type="button" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del({$vo['id']});" value="删除">
								</td>
							</tr>
							</volist>
							
	
							<else />
							<tr>
								<td colspan="7">暂无相关数据</td>
							</tr>
							</notempty>
					  	</tbody>
					  	<tfoot>
					  		<tr>
								<td colspan="2" align="left" style="text-align: left;padding-left: 22px !important;">
									<input id="checkAll" type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" title="全选/反选">
								</td>
								<td colspan="3" align="left" style="padding: 5px;">
									<html:select options="sitesOptions" first="批量购买请选择网址" name="url" id="url" style="input-sm" />
								</td>
								<td colspan="3" align="left" style="padding: 5px;">
									<input class="layui-btn" type="button" name="btn4" value="批量购买" onclick="buyBatch()">
									<input class="layui-btn layui-btn-danger" type="button" name="btn4" value="批量删除" onclick="deleteBatch()">
									
								</td>
							</tr>
						</tfoot>
					</table>
				
				</form>
					
				<blockquote class="layui-elem-quote mt20">
					<p class="b">购买须知：</p>
					<p>1. 为了确保关键词效果，系统将按照站点下所购买关键词30天的达标费用作为预付款进行冻结，冻结资金依然在您的账户中，但无法再次购买其他关键词；</p>
					<p>2. 关键词达标后按天计费，费用从预付款中进行扣除，预付款消耗完毕，关键词达标费用将从账号余额中扣除；</p>
					<p>3. 关键词达标后90天内不得停止优化。</p>
					<p>更多服务条款，请阅读
					<notempty name="news">
						<a href="{:U('News/detail')}/id/{$news['id']}/open_type/blank" target="_blank">《{$news['newstitle']}》</a>
					<else/>
						<a href="{:U('News/detail')}/id/2/open_type/blank" target="_blank">《网站优化服务条款》</a>
					</notempty>
					</p>
				</blockquote>
			</div> 
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
