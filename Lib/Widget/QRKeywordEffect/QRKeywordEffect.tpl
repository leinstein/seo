
	<script type="text/javascript">
		$(function() {
			layui.use(['form'], function(){
				var form = layui.form;
			  
			  
			});
			
			layui.use('laydate', function(){
				  var laydate = layui.laydate;
				  
				  //执行一个laydate实例
				  laydate.render({
				    elem: '#detecttime',//指定元素
				    max : '1',
				    type: 'date',
				    range: '~' ,//或 range: '~' 来自定义分割字符
				    festival: true, //是否显示节日
				  });
			
				});
			
			/* layui.use(['laydate'], function() {
				var laydate = layui.laydate;
				var start = {
					//min : laydate.now(),
					//max : '2099-06-16 23:59:59',
					max : laydate.now(),
					istoday : false,
					festival: true, //是否显示节日
					choose : function(datas) {
						end.min = datas; //开始日选好后，重置结束日的最小日期
						end.start = datas //将结束日的初始值设定为开始日
					}
				};
		
				var end = {
					max : laydate.now(),
					istoday : false,
					festival: true, //是否显示节日
					choose : function(datas) {
						start.max = datas; //结束日选好后，重置开始日的最大日期
					}
				};
		
				document.getElementById('t1').onclick = function() {
					start.elem = this;
					laydate(start);
				}
				document.getElementById('t2').onclick = function() {
					end.elem = this
					laydate(end);
				}
		
			}); */
		});
		

	</script>
	
	<form name="form1" id="form1" method="get" action="__URL__" class="layui-form">
		<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
		<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
		<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
		
		<div class="layui-form-item">
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <input type="text" class="layui-input" name="keyword" value="{$Think.get.keyword}" placeholder="关键词">
		      </div>
		    </div>
		    <!-- <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <input type="text" name="website" class="layui-input" value="{$Think.get.website}" placeholder="网址">
		      </div>
		    </div> -->
		   	<div class="layui-inline">
			   	<!-- <div class="layui-input-inline">
					<input id="t1" name="t1" value="{$Think.get.t1}"  placeholder="开始时间" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-mid">-</div>
				<div class="layui-input-inline">
					<input type="text" id="t2" name="t2" value="{$Think.get.t2}"  placeholder="结束时间" autocomplete="off" class="layui-input">
				</div> -->
				<div class="layui-input-inline">
					<input id="detecttime" name="detecttime" value="{$Think.get.detecttime}"  placeholder="开始时间 到 结束时间" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		        <html:select options="SearchengineOptions" first="搜索引擎" name="searchengine"  style="" selected="_GET['searchengine']" />
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
		        <button type="reset" name="btn" onclick="location.href='__URL__/effect'" class="layui-btn layui-btn-primary">重置</button>
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
		<th>关键词</th>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;搜索引擎</th>
		<th>快照</th>
		<th width="80">排名</th>
		<th>检测时间</th>
		<!-- <th width="90" align="center" style="text-align: center;">添加日期</th> -->
    </tr> 
 	</thead>
	<tbody>
 		<notempty name="list['data']">
		<volist name="list['data']" id="vo">
	    <tr>
	      	<td>{$vo['No']}</td>
			<td>{$vo['keyword']}</td>
			<td><img src="{$vo['searchengine_img']}"></td>
			<td><a href="{$vo['snapshot']}" target="_blank">查看快照</a></td>
			<td>{$vo['rank']}</td>
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
<div class="layui-box layui-laypage">
	{$list['html']}
</div>	
<!-- 分页 end -->	
	