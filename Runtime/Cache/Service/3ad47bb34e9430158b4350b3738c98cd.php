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
          // if ( username == "选择运维") {
          //     layer_alert('请您选择运维人员');
          //     return false;
          // }
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
                          quxiao();
                      }else{
                          layer_alert(res.message);
                      }
                  }
			  });
          });
      }
    </script>
	<form name="form" id="form" method="get" action="__URL__/index" class="layui-form">
        <input type="hidden" name="m" value="<?php echo (MODULE_NAME); ?>" />
        <input type="hidden" name="a" value="<?php echo (ACTION_NAME); ?>" />
        <input type="hidden" name="g" value="<?php echo (GROUP_NAME); ?>" />
        <div class="layui-form-item">
        	<?php if((GROUP_NAME) == "Manage"): ?><div class="layui-inline">
                <div class="layui-input-inline">
                    <!-- <input type="text" class="layui-input" name="createusername" value="<?php echo ($_GET['createusername']); ?>" placeholder="用户"> -->
                    <select id="" name="createuserid" onchange="" ondblclick="" class="form-control" lay-verify="" lay-filter="" readonly="" lay-search><option value="" >全部用户</option><?php  foreach($UserOptions as $key=>$val) { if(!empty($_GET['createuserid']) && ($_GET['createuserid'] == $key || in_array($key,$_GET['createuserid']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
                </div>
            </div><?php endif; ?>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="sitename" value="<?php echo ($_GET['sitename']); ?>" placeholder="站点名称">
                </div>
            </div>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input type="text" name="website" class="layui-input" value="<?php echo ($_GET['website']); ?>" placeholder="站点地址">
                </div>
            </div>
            <div class="layui-inline">
                <div class="layui-input-inline" style="width: 100px;">
                    <select id="" name="sitestatus" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >站点状态</option><?php  foreach($SiteStatusOptions as $key=>$val) { if(!empty($_GET['sitestatus']) && ($_GET['sitestatus'] == $key || in_array($key,$_GET['sitestatus']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
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
                    <button type="reset" name="btn" onclick="location.href='__URL__/<?php echo (ACTION_NAME); ?>'" class="layui-btn layui-btn-primary"> 重置</button>
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
					<?php if((GROUP_NAME) == "Manage"): ?><th>代理商</th><?php endif; ?>
					<th width="80">创建时间</th>
					<th width="60">关键词数</th>
					<th width="60">站点状态</th>
					<th width="60">后台状态</th>
					<th width="60">运维人员</th>
					<th width="30">工单</th>
					<!-- <th width="30">日志</th> -->
					<th width="140px">操作 </th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($list['data'])): if(is_array($list['data'])): $i = 0; $__LIST__ = $list['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
							<td>
								<input type="checkbox" id="id_<?php echo ($vo['id']); ?>" name="id[]" value="<?php echo ($vo['id']); ?>" lay-skin="primary">&nbsp;<?php echo ($vo['No']); ?>
							</td>
							<td>
								<a href="javascript:;" onclick="open_layer('查看详情','<?php echo U('detail');?>/id/<?php echo ($vo['id']); ?>','50%')" class="btn btn-link add_site_btn"> <?php echo ($vo['sitename']); ?></a>
							</td>
							<td>
								<?php echo ($vo['website']); ?>
							</td>
							<td>
								<?php echo ($vo['createusername']); ?>
							</td>
							<?php if((GROUP_NAME) == "Manage"): ?><td>
								<?php echo ($vo['agent']['username']); ?>
							</td><?php endif; ?>
							<td>
								<?php echo (format_date($vo['createtime'])); ?>
							</td>
							<td>
								<?php if((GROUP_NAME) == "Service"): ?><a href="<?php echo U('Keyword/effect');?>/website/<?php echo (base64_encode($vo['website'])); ?>/from/site"> <?php echo (($vo['keywordnum'])?($vo['keywordnum']):0); ?></a>
								<?php else: ?>
								<a href="<?php echo U('Keyword/index');?>/website/<?php echo (base64_encode($vo['website'])); ?>/from/site"> <?php echo (($vo['keywordnum'])?($vo['keywordnum']):0); ?></a><?php endif; ?>
							</td>
							<td>
								<?php echo ($vo['sitestatus']); ?>
							</td>
							<td>
								<?php echo ($vo['mbgstatus']); ?>
							</td>
							<td>
								<?php echo ($vo['site_manage']); ?>
							</td>
							<td>
								<?php if(($vo["can_add_workorder"]) == "1"): ?><a href="<?php echo U('Workorder/index');?>/productid/1/objecttype/site/objectid/<?php echo ($vo['id']); ?>/touserid/<?php echo ($vo['createuserid']); ?>/tousername/<?php echo ($vo['createusername']); ?>?returnUrl=<?php echo ($returnUrl); ?>" class="layui-btn layui-btn-mini">工单<?php if(($untreated_workorder_num) > "0"): ?><span class="badge" style="margin-top: -18px;margin-right: -10px;"><?php echo ($untreated_workorder_num); ?></span><?php endif; ?></a>
								<?php else: ?>
									<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">工单</button><?php endif; ?>
							</td>
						   <!--  <td>
								<a href="<?php echo U('Remark/index');?>/productid/1/objecttype/site/objectid/<?php echo ($vo['id']); ?>/touserid/<?php echo ($vo['createuserid']); ?>/tousername/<?php echo ($vo['createusername']); ?>?returnUrl=<?php echo ($returnUrl); ?>" class="layui-btn layui-btn-mini">查看日志</a>

							</td> -->
							<td>
								<!-- 可以修改 -->
								<?php if(($vo["can_edit"]) == "1"): ?><a href="javascript:;" onclick="open_layer('修改站点信息','<?php echo U('updatePage');?>/id/<?php echo ($vo['id']); ?>?returnUrl=<?php echo ($returnUrl); ?>','50%')" class="layui-btn layui-btn-mini">修改</a>
								<?php else: ?>
									 <button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">修改</button><?php endif; ?>

								<!-- 可以审核 -->
								<?php if(($vo["can_review"]) == "1"): ?><a href="javascript:;" onclick="open_layer('站点审核','<?php echo U('reviewPage');?>/id/<?php echo ($vo['id']); ?>?returnUrl=<?php echo ($returnUrl); ?>','50%')" class="layui-btn layui-btn-mini">审核</a>
								<?php else: ?>
									<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">审核</button><?php endif; ?>

								<!-- 可以删除 -->
								<?php if(($vo["can_delete"]) == "1"): ?><a href="javascript:;" onclick="deleteRecord(<?php echo ($vo['id']); ?>)" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
								<?php else: ?>
									<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">删除</button><?php endif; ?>

							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					<!--<?php if($_SESSION['MANAGE_SESSION_LoginUserType'] != 'operation'): ?>-->
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
											<select id="username" name="username" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >选择运维</option><?php  foreach($operation as $key=>$val) { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } ?></select>
										</div>
									</div>

									<div class="layui-inline">
									  <div class="layui-input-inline">
										<input class="layui-btn" type="button" name="btn4" value="批量分配站点" onclick="adjustBatch()">
									  </div>
									</div>

									<!-- 分页 begin -->
									<div class="layui-box layui-laypage fr">
										<?php echo ($list['html']); ?>
									</div>
									<!-- 分页 end -->
								</td>
							</tr><?php endif; ?>
					<?php else: ?>
					<tr>
						<td colspan="13" align="center" class="layui-table-nodata">暂无相关数据</td>
					</tr><?php endif; ?>

			</tbody>
		</table>
	</form>
<!--
	<div class="layui-inline">
		<div class="layui-input-inline">
			<input id="checkAll" type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" title="全选/反选">
		</div>
	</div>

	<div class="layui-inline">
	  <div class="layui-input-inline">
		<select id="keywordstatus" name="keywordstatus" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >运维</option><?php  foreach($keywordstatusOptions1 as $key=>$val) { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } ?></select>
	  </div>
	</div>

	<!-- 如果当前是解冻操作
	<eq name="operate" value="unfreeze">
	<div class="layui-inline">
	  <div class="layui-input-inline">
		<input class="layui-btn layui-btn-danger" type="button"  value="批量划站" onclick="unfreezeBatch()">
	  </div>
	</div>