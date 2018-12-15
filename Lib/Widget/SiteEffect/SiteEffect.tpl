<script type="text/javascript">
		$(function() {
			layui.use(['form'], function(){
				var form = layui.form;
			  
			  
			});
		});
		</script>
	<form name="form" id="form" method="get" action="__URL__" class="layui-form">
		<input type="hidden" name="m" value="{$Think.MODULE_NAME}" />
		<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
		<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
		<div class="layui-form-item">
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
			<!-- <div class="layui-inline">
				<div class="layui-input-inline">
					<html:select options="SiteStatusOptions" first="站点状态" name="sitestatus" style="" selected="_GET['sitestatus']" />
				</div>
			</div> -->
			<div class="layui-inline">
				<div class="layui-input-inline" style="width: 160px;">
          			<html:select options="PerPageOptions" first="默认每页显示20条" name="num_per_page"  style="form-control" selected="_GET['num_per_page']" />
      			</div>
  			</div>
                
			<div class="layui-inline">
            	<div class="layui-input-inline">
                	<input type="submit" name="sub" value="查询" class="layui-btn">
                	<button type="reset" name="btn" onclick="location.href='__URL__/{$Think.ACTION_NAME}'" class="layui-btn layui-btn-primary"> 重置</button>
            	</div>
        	</div>
    	</div>
	</form>
	<table class="layui-table">
	  	<!-- <colgroup>
	    	<col width="150">
	    	<col width="200">
	    	<col>
	  	</colgroup> -->
	  	<thead>
		    <tr>
		    	<th width="30">序号</th>
		      	<th>站点名称</th>
				<th>网址</th>
				<th>优化关键词数</th>
				<th>达标词数</th>
				<th>达标消费</th>
				<th>预付冻结金额</th>
				<!-- <th >累计上首页数量</th> -->
				<th>累计消费</th>
				<th>添加时间</th>
				<th>历史数据</th>
		    </tr> 
	  	</thead>
	 		<tbody>
	  		<notempty name="list['data']">
			<volist name="list['data']" id="vo">
		    <tr>
		    	<td>{$vo['No']}</td>
		      	<!-- 站点名称 -->
				<td><a href="javascript:void(0);" onclick="open_layer('站点信息','{:U('detail')}/id/{$vo['id']}','50%')">{$vo['sitename']}</a></td>
				<!-- 网址 -->
				<td>{$vo['website']}</td>
				<!-- 优化关键词数 -->
				<td><a href="{:U('Keyword/effect')}/website/{$vo['website']|base64_encode}/from/site/keywordstatus/优化中">{$vo['optimizationNum']|default=0}</a></td>
				<!--达标词数-->
				<td class="center hidden-xs "><a href="{:U('Keyword/effect')}/website/{$vo['website']|base64_encode}/from/site/standardstatus/已达标">{$vo['standardNum']|default=0}</a></td>
				<!--达标消费-->
				<td class="center hidden-xs ">{$vo['standardfee']|format_money}</td>
				<!--累计上首页-->
				<!--  <td class="center hidden-xs "></td> -->
				<!--预付冻结金额-->
				<td><span class="tip tipso_style" data-tipso="初始冻结金额：{$vo['initfreezefunds']|format_money}；<br>消耗冻结金额：{$vo['consfreezefunds']|format_money}；<br>剩余冻结金额：{$vo['remainfreezefunds']|format_money}。">{$vo['freezefunds']|format_money}</span>								</td>
				<!--累计消费-->
				<td class="center hidden-xs ">{$vo['consumption']|format_money}</td>
				<!--添加时间-->
				<td class="center hidden-xs ">{$vo['createtime']|format_date}</td>
				<!---->
				<td><a href="javascript:void(0);" onclick="open_layer('查看详情','{:U('history')}/id/{$vo['id']}','50%')" class="layui-btn layui-btn-mini">查看详情</a></td>
		    </tr>
	    </volist>
		<else/>
		<tr>
			<td colspan="10" align="center" class="layui-table-nodata">
				暂无相关数据
			</td>
		</tr>
		</notempty>
	  	</tbody>
	</table>
	
	<!-- 分页 begin -->		
	<div class="layui-box layui-laypage">
		{$list['html']}
	</div>	
	<!-- 分页 end -->	

                    <!-- <table cellpadding="0" cellspacing="0" border="0">
						<thead>
							<tr role="row">
								<th class="center">站点名称</th>
								<th class="center">网址</th>
								<th class="center">优化关键词数</th>
								<th class="center">达标词数</th>
								<th class="center">达标消费</th>
								<th class="center">预付冻结金额</th>
								<th class="center" >累计上首页数量</th>
								<th class="center">累计消费</th>
								<th class="center">添加时间</th>
								<th class="center">历史数据</th>
							</tr>
						</thead>
						<tbody role="alert" aria-live="polite" aria-relevant="all">
						
						<notempty name="list['data']">
						<volist name="list['data']" id="vo">
						<tr class="gradeA odd">
								站点名称
								<td class="center hidden-xs">
									<a href="javascript:void(0);" onclick="open_layer('站点信息','{:U('detail')}/id/{$vo['id']}','50%')">{$vo['sitename']}</a>
								</td>

								网址
								<td class="center hidden-xs">
								{$vo['website']}
								</td>
								优化关键词数
								<td class="center hidden-xs">
									<a href="{:U('Keyword/effect')}/website/{$vo['website']|urlencode}/keywordstatus/优化中">{$vo['optimizationNum']|default=0}</a>
								</td>

								达标词数
								<td class="center hidden-xs ">
									<a href="{:U('Keyword/effect')}/website/{$vo['website']|urlencode}/standardstatus/已达标">{$vo['standardNum']|default=0}</a>
								</td>

								达标消费
								<td class="center hidden-xs ">{$vo['standardfee']|format_money}</td>

								累计上首页
								  <td class="center hidden-xs ">
                                          		</td>
								预付冻结金额
								<td class="center hidden-xs">
									<span class="tip tipso_style" data-tipso="初始冻结金额：{$vo['initfreezefunds']|format_money}；<br>消耗冻结金额：{$vo['consfreezefunds']|format_money}；<br>剩余冻结金额：{$vo['remainfreezefunds']|format_money}。">{$vo['freezefunds']|format_money}</span>
								</td>

								累计消费
								<td class="center hidden-xs ">{$vo['consumption']|format_money}</td>


								添加时间
								<td class="center hidden-xs ">{$vo['createtime']|format_date}</td>

								
								<td class="center hidden-xs">
									<a href="javascript:void(0);" onclick="open_layer('查看详情','{:U('history')}/id/{$vo['id']}','50%')" class="layui-btn layui-btn-mini">查看详情</a>					
								</td>
							</tr>
						
						</volist>
						<else/>
						<tr>
							<td class="center" colspan="9">
								暂无相关数据
							</td>
						</tr>
						</notempty>
						</tbody>
					</table> -->
					
					
