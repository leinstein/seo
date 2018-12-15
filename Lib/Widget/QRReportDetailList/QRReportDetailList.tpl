<script>
	$(function() {
		
		layui.use('laydate', function(){
			var laydate = layui.laydate;
			//执行一个laydate实例
			laydate.render({
			    elem: '#reportdate',//指定元素
			    max : '1',
			    type: 'date',
			    range: '~' ,//或 range: '~' 来自定义分割字符
			    festival: true, //是否显示节日
			});
		});
	
	});
	
	/**
	 * 导出报表，导出一天的报表
	 * @accesspublic
	 */
   	function exportReport( reportdate ){

		layer_confirm('导出数据可能会比较缓慢，您确认导出么？',
			function () {

				window.location.href = "__URL__/exportReport/reportdate/" + reportdate;

		});
   	}
	</script>
        	
        	<form name="form mt10" method="get" action="__URL__" class="form-inline layui-form">
				<input type="hidden" name="m" value="{$Think.MODULE_NAME}" />
				<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
				<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
				<input type="hidden" name="id" value="{$Think.get.id}" />
				<input type="hidden" name="planid" value="{$Think.get.planid}" />
				<input type="hidden" name="searchengine" value="{$Think.get.searchengine}" />
				<input type="hidden" name="standard_number" value="{$Think.get.standard_number}" />
				<input type="hidden" name="baidu_number" value="{$Think.get.baidu_number}" />
				<input type="hidden" name="baidumobile_number" value="{$Think.get.baidumobile_number}" />
				<input type="hidden" name="sougou_number" value="{$Think.get.sougou_number}" />
				<input type="hidden" name="reportdate" value="{$Think.get.reportdate}" />
				
				<div class="layui-form-item">
			
					<div class="layui-inline">
			
						<div class="layui-input-inline">
							<input name="keyword" value="{$Think.get.keyword}"  placeholder="关键词" autocomplete="off" class="layui-input">
						</div>
					    <div class="layui-input-inline">
					        <html:select options="PerPageOptions" first="默认每页显示20条" name="num_per_page"  style="" selected="_GET['num_per_page']" />
					    </div>
						<div class="layui-input-inline">
							<input type="submit" name="sub" value="查询" class="layui-btn">
							<button type="reset" name="btn"onclick="location.href='__URL__/{$Think.ACTION_NAME}/id/{$_GET['id']}/planid/{$_GET['planid']}/reportdate/{$_GET['reportdate']}/searchengine/{$_GET['searchengine']}/standard_number/{$_GET['standard_number']}/baidu_number/{$_GET['baidu_number']}/baidumobile_number/{$_GET['baidumobile_number']}/sougou_number/{$_GET['sougou_number']}'" class="layui-btn layui-btn-primary">重置</button>
						</div>
					</div>
				</div>
			</form>

        	<div class="layui-tab layui-tab-brief">
				  <ul class="layui-tab-title">
				  	<li onclick="window.location.href='{:U('detail')}/id/{$_GET['id']}/planid/{$_GET['planid']}/reportdate/{$_GET['reportdate']}/standard_number/{$_GET['standard_number']}/baidu_number/{$_GET['baidu_number']}/baidumobile_number/{$_GET['baidumobile_number']}/sougou_number/{$_GET['sougou_number']}'" <empty name="Think.get.searchengine"> class="layui-this" </empty> >全部({$_GET['standard_number']})</li>
				    <li onclick="window.location.href='{:U('detail')}/id/{$_GET['id']}/planid/{$_GET['planid']}/reportdate/{$_GET['reportdate']}/searchengine/baidu/standard_number/{$_GET['standard_number']}/baidu_number/{$_GET['baidu_number']}/baidumobile_number/{$_GET['baidumobile_number']}/sougou_number/{$_GET['sougou_number']}'" <eq name="Think.get.searchengine" value="baidu"> class="layui-this" </eq> >百度({$_GET['baidu_number']})</li>
				    <li onclick="window.location.href='{:U('detail')}/id/{$_GET['id']}/planid/{$_GET['planid']}/reportdate/{$_GET['reportdate']}/searchengine/baidu_mobile/standard_number/{$_GET['standard_number']}/baidu_number/{$_GET['baidu_number']}/baidumobile_number/{$_GET['baidumobile_number']}/sougou_number/{$_GET['sougou_number']}'"<eq name="Think.get.searchengine" value="baidu_mobile"> class="layui-this" </eq> >百度手机({$_GET['baidumobile_number']})</li>
				    <li onclick="window.location.href='{:U('detail')}/id/{$_GET['id']}/planid/{$_GET['planid']}/reportdate/{$_GET['reportdate']}/searchengine/sougou/standard_number/{$_GET['standard_number']}/baidu_number/{$_GET['baidu_number']}/baidumobile_number/{$_GET['baidumobile_number']}/sougou_number/{$_GET['sougou_number']}'"<eq name="Think.get.searchengine" value="sougou"> class="layui-this" </eq> >搜狗({$_GET['sougou_number']})</li>
				  </ul>
				  <div class="layui-tab-content">					
				    <div class="layui-tab-item layui-show" >
				       	<table class="layui-table">
						  	<thead>
						  					
							    <tr>
							   	 	<th>序号</th>
							   	 	<th>关键词</th>
							      	<th>搜索引擎</th>
									<th>排名</th>
									<th>排名快照</th>
									<th>检测时间</th>
							    </tr> 
						  	</thead>
						 		<tbody>
						  		<notempty name="list['data']">
								<volist name="list['data']" id="vo">
							    <tr>
							    	<td>{$vo['No']}</td>
							    	<td>{$vo['keyword']}</td>
							    	<td><img src="{$vo['searchengine_img']}"></td>
							    	<td>{$vo['rank']}</td>
							    	<td><a href="{$vo['snapshot']}" target="_blank">查看快照</a></td>
									<td>{$vo['detecttime']}</td>
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
						<div class="clear"></div>
						<!-- 分页 end -->		
						
				    </div>
				  </div>
				</div>