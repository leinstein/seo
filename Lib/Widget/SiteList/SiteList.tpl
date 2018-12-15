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
      function deleteRecord(id) {
          layer_confirm('删除后该站点无法恢复，您确认删除么？',
              function () {

                  window.location.href = "__URL__/deleteRecord/id/" + id;

              });
      }
      function adjustBatch() {

          //获取选中的关键词
          var ids = getChecked( 'layui'  );
          var username = $('#username option:selected').html();
          if ( ids == "" || ids == 0 ) {
              layer_alert('请您选择站点');
              return false;
          }
          layer_confirm('您确定分配选中的站点？', function(){
              var url = "__URL__/getSiteID";
              $.ajax({
                  url : url,
                  type : "POST",
                  dataType: 'json',
                  data : {
                      'ids': ids,
                      'username': username
                  },
                  success : function(res) {
                      if(res.status == 200){
                          layer.msg(res.message, {icon: 1});
                          location.reload();
                      }else{
                          layer_alert(res.message);
                      }
                  }
              });
          });
      }
    </script>
	<form name="form" id="form" method="get" action="__URL__/index" class="layui-form">
        <input type="hidden" name="m" value="{$Think.MODULE_NAME}" />
        <input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
        <input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
        <div class="layui-form-item">
        	<eq name="Think.GROUP_NAME" value="Manage">
        	<div class="layui-inline">
                <div class="layui-input-inline">
                    <!-- <input type="text" class="layui-input" name="createusername" value="{$Think.get.createusername}" placeholder="用户"> -->
                    <html:select options="UserOptions" first="全部用户" name="createuserid"  style="form-control" selected="_GET['createuserid']" lay_search="true"/>
                </div>
            </div>
            </eq>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="sitename" value="{$Think.get.sitename}" placeholder="站点名称">
                </div>
            </div>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input type="text" name="website" class="layui-input" value="{$Think.get.website}" placeholder="站点地址">
                </div>
            </div>
            <div class="layui-inline">
                <div class="layui-input-inline" style="width: 100px;">
                    <html:select options="SiteStatusOptions" first="站点状态" name="sitestatus" style="" selected="_GET['sitestatus']" />
                </div>
            </div>
             <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 160px;">
		        <html:select options="PerPageOptions" first="默认每页显示20条" name="num_per_page"  style="" selected="_GET['num_per_page']" />
		      </div>
		    </div>

            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input type="submit" name="sub" value="查询" class="layui-btn">
                    <button type="reset" name="btn" onclick="location.href='__URL__/{$Think.ACTION_NAME}'" class="layui-btn layui-btn-primary"> 重置</button>
                </div>
            </div>
        </div>

		<table class="layui-table">
			<thead>
				<tr>
					<th width="50px">序号</th>
					<th>站点名称</th>
					<th>站点网址 </th>
					<th>创建用户</th>
					<eq name="Think.GROUP_NAME" value="Manage">
					<th>代理商</th>
					</eq>
					<th width="80">创建时间</th>
					<th width="60">关键词数</th>
					<th width="60">站点状态</th>
					<th width="60">后台状态</th>
					<th width="60">运维人员</th>
					<th width="30">工单</th>
					<!-- <th width="30">日志</th> -->
					<th width="140">操作 </th>
				</tr>
			</thead>
			<tbody>
				<notempty name="list['data']">
					<volist name="list['data']" id="vo">
						<tr>
							<td>
								<input type="checkbox" id="id_{$vo['id']}" name="id[]" value="{$vo['id']}" lay-skin="primary">&nbsp;{$vo['No']}
							</td>
							<td>
								<a href="javascript:;" onclick="open_layer('查看详情','{:U('detail')}/id/{$vo['id']}','50%')" class="btn btn-link add_site_btn"> {$vo['sitename']}</a>
							</td>
							<td>
								{$vo['website']}
							</td>
							<td>
								{$vo['createusername']}
							</td>
							<eq name="Think.GROUP_NAME" value="Manage">
							<td>
								{$vo['agent']['username']}
							</td>
							</eq>
							<td>
								{$vo['createtime']|format_date}
							</td>
							<td>
								<eq name="Think.GROUP_NAME" value="Service">
								<a href="{:U('Keyword/effect')}/website/{$vo['website']|base64_encode}/from/site"> {$vo['keywordnum']|default=0}</a>
								<else/>
								<a href="{:U('Keyword/index')}/website/{$vo['website']|base64_encode}/from/site"> {$vo['keywordnum']|default=0}</a>
								</eq>
							</td>
							<td>
								{$vo['sitestatus']}
							</td>
							<td>
								{$vo['mbgstatus']}
							</td>
							<td>
								{$vo['site_manage']}
							</td>
							<td>
								<eq name="vo.can_add_workorder" value="1">
									<a href="{:U('Workorder/index')}/productid/1/objecttype/site/objectid/{$vo['id']}/touserid/{$vo['createuserid']}/tousername/{$vo['createusername']}?returnUrl={$returnUrl}" class="layui-btn layui-btn-mini">工单<gt name="untreated_workorder_num" value="0"><span class="badge" style="margin-top: -18px;margin-right: -10px;">{$untreated_workorder_num}</span></gt></a>
								<else/>
									<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">工单</button>
								</eq>
							</td>
							
							<td>
								<!-- 可以修改 -->
								<eq name="vo.can_edit" value="1">
									<a href="javascript:;" onclick="open_layer('修改站点信息','{:U('updatePage')}/id/{$vo['id']}?returnUrl={$returnUrl}','50%')" class="layui-btn layui-btn-mini">修改</a>
								<else/>
									 <button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">修改</button>
								</eq>

								<!-- 可以审核 -->
								<eq name="vo.can_review" value="1">
									<a href="javascript:;" onclick="open_layer('站点审核','{:U('reviewPage')}/id/{$vo['id']}?returnUrl={$returnUrl}','50%')" class="layui-btn layui-btn-mini">审核</a>
								<else/>
									<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">审核</button>
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
						 <if condition="($_SESSION['MANAGE_SESSION_LoginUserType'] neq 'operation') AND  ($_SESSION['MANAGE_SESSION_LoginUserType'] neq 'sub')">
							<tr>
								<td colspan=12>
									<div class="layui-inline">
										<div class="layui-input-inline">
											<input id="checkAll" type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" title="全选/反选">
										</div>
									</div>

									<div class="layui-inline">
										<div class="layui-input-inline">
											<html:select options="operation" first="选择运维" value="operation" name="username" id="username"/>
										</div>
									</div>

									<div class="layui-inline">
									  <div class="layui-input-inline">
										<input class="layui-btn" type="button" name="btn4" value="批量分配站点" onclick="adjustBatch()">
									  </div>
									</div>

									<!-- 分页 begin -->
									<div class="layui-box layui-laypage fr">
										{$list['html']}
									</div>
									<!-- 分页 end -->
								</td>
							</tr>
						</if>
					<else/>
					<tr>
						<td colspan="13" align="center" class="layui-table-nodata">暂无相关数据</td>
					</tr>
				</notempty>
			</tbody>
		</table>
	</form>




                    