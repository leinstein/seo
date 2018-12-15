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