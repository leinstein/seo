	<script type="text/javascript">
	    $(function() {
			layui.use(['form'], function(){
			  var form = layui.form;
			});
		});
	    
	    /**
		 * 删除计划
		 * @accesspublic
		 */
       	function deleteRecord(id) {
           layer_confirm('删除后该计划无法恢复，您确认删除么？',
               function () {
                   window.location.href = "__URL__/deleteRecord/id/" + id;
               });
       	}
       	/**
		 * 导出关键词
		 * @accesspublic
		 */
       	function exportKeywords( id ){

            layer_confirm('导出数据可能会比较缓慢，您确认导出么？',
                function () {

                    window.location.href = "__URL__/exportKeywords/id/" + id;

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
					<th width="50" align="center">序号</th>
					<th>计划名称</th>
					<th>关键词总量</th>
					<th>总达标词数</th>
					<th>总排位数</th>
					<!-- <th>最新达标词数</th>
					<th>最新排位数</th> -->
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
					<td style="vertical-align: middle;">{$vo['statistics']['standard_number']|default=0}</td>
					<td style="vertical-align: middle;">{$vo['statistics']['homerank_number']|default=0}</td>
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
						
						<!-- 导出关键词 begin -->
						<eq name="list.can_export" value="1">
						<eq name="vo.can_export" value="1">
							<a href="javascript:;" onclick="exportKeywords({$vo['id']})" class="layui-btn layui-btn-mini">导出关键词</a>
						<else/>
							<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">导出关键词</button>
						</eq>
						<!-- 导出关键词 end -->
						</eq>
						<!-- 导入结果 begin -->
						<eq name="list.can_import" value="1">
						<eq name="vo.can_import" value="1">
							<a href="javascript:;" onclick="open_layer('导入报表','{:U('importReportPage')}/id/{$vo['id']}/planname/{$vo['planname']|urlencode}&returnUrl={$returnUrl|urlencode}',600,450)" class="layui-btn layui-btn-mini">导入报表</a>
						<else/>
							<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">导入报表</button>
						</eq>
						</eq>
						<!-- 导入结果 end  -->
						
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
	