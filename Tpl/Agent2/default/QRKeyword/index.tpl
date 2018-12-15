<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <include file="../Public/header" />
   
    <script type="text/javascript">
	    $(function() {
			layui.use(['form'], function(){
			  var form = layui.form;
			  
			  
			});
		});
       	function deleteRecord(id) {
           layer_confirm('删除后该计划无法恢复，您确认删除么？',
               function () {

                   window.location.href = "__URL__/deleteRecord/id/" + id;

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
    <include file="../Public/left_qr" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
        <!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="{:U('QRIndex/index')}"><i class="iconfont">&#xe60a;</i> 首页<span class="layui-box">&gt;</span></a>
		  <a><cite>计划列表</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	 
        		<div class="layui-input-inline mb10">
					<a class="layui-btn" href="javascript:;" onclick="open_layer('导入关键词','{:U('importPage')}','50%')"><i class="iconfont">&#xe6c0;</i> 导入关键词</a>
				</div>
				
        		<form name="form mt10" method="get" action="__URL__" class="form-inline layui-form">
					<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
					<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
					<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
					
					<div class="layui-form-item">
						<div class="layui-inline">
					    	<div class="layui-input-inline" >
								<input name="keyword" class="layui-input" value="{$Think.get.keyword}" placeholder="关键词">
							</div>
						</div>
						<div class="layui-inline">
					      	<div class="layui-input-inline">
					      		<html:select options="keywordstatusOptions" first="关键词状态" name="keywordstatus" selected="_GET['keywordstatus']" />
				      		</div>
					    </div>	
					    <div class="layui-inline">
					      	<div class="layui-input-inline">
					      		<html:select options="PlanOptions" first="计划" name="planid" selected="_GET['planid']" />
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
								<th>关键词</th>
								<th>所属计划</th>
								<th>状态</th>
								<th>添加时间</th>
							</tr>
					 	</thead>
						<tbody>
					 		<notempty name="list['data']">
							<volist name="list['data']" id="vo">
						    <tr>			    
						    	<td>{$vo['No']}</td>
							    <td style="vertical-align: middle;">{$vo['keyword']}</td>
								<td style="vertical-align: middle;">{$vo['plan']['planname']}</td>
								<td class="center">{$vo['keywordstatus']}</td>
								<td style="vertical-align: middle;">{$vo['createtime']}</td>
								
								
							</tr>
						   	</volist>
						   	
						<else/>
						<tr>
							<td colspan="15" align="center" align="center" class="layui-table-nodata">暂无相关数据</td>
						</tr>
						</notempty>
					 	</tbody>
					</table>	
					<!-- 分页 begin -->		
					<div class="layui-box layui-laypage fr">
						{$list['html']}
					</div>
					<div class="clear"></div>
					<!-- 分页 end -->	
				</form>
        
			</div> 
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>


