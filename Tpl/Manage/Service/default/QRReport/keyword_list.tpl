<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <include file="../Public/header" />
   
    <script>
	$(function() {
		layui.use(['laydate'], function() {
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
	
		});
	});
	</script>
</head>
<tagLib name="html" />
<body>
    <div class="layui-tab-content">
         
	           
				<form class="layui-form " name="form1" id="form1" method="get" action="__URL__" class="form-inline" style="margin-bottom: 15px;">
					<input type="hidden" name="m" value="{$Think.MODULE_NAME}" />
					<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
					<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
					<input type="hidden" name="id" value="{$Think.get.id}" />
					<input type="hidden" name="query_type" value="{$Think.get.query_type}" />
					<div class="layui-form-item">
				
						<div class="layui-inline">
							<div class="layui-input-inline mt10" >
								<input name="keyword" class="layui-input" value="{$Think.get.keyword}" placeholder="关键词">
							</div>
							<div class="layui-input-inline mt10" >
								<input name="website" class="layui-input" value="{$Think.get.website}" placeholder="网址">
							</div>
							<div class="layui-input-inline mt10">
								<input id="t1" name="t1" value="{$Think.get.t1}"  placeholder="开始时间" autocomplete="off" class="layui-input">
							</div>
							<div class="layui-form-mid mt10">-</div>
							<div class="layui-input-inline mt10">
								<input type="text" id="t2" name="t2" value="{$Think.get.t2}"  placeholder="结束时间" autocomplete="off" class="layui-input">
							</div>
							<neq name ="Think.get.query_type" value="standard">
							<div class="layui-input-inline mt10">
								<input  type="number" name="rank1" value="{$Think.get.rank1}"  placeholder="开始排名" autocomplete="off" class="layui-input" min="1">
							</div>
							<div class="layui-form-mid mt10">-</div>
							<div class="layui-input-inline mt10">
								<input  type="number" name="rank2" value="{$Think.get.rank2}"  placeholder="结束排名" autocomplete="off" class="layui-input" min="1">
							</div>
							</neq>
							<div class="layui-input-inline">
								<html:select options="SearchengineOptions" first="渠道" name="searchengine"  style="" selected="_GET['searchengine']" />
				      		</div>
				      		 <div class="layui-input-inline">
						        <html:select options="PerPageOptions" first="默认每页显示20条" name="num_per_page"  style="" selected="_GET['num_per_page']" />
						      </div>
							<div class="layui-input-inline mt10">
								<input type="submit" name="sub" value="查询" class="layui-btn">
								<button type="reset" name="btn"onclick="location.href='__URL__/{$Think.ACTION_NAME}/id/{$Think.get.id}/query_type/{$Think.get.query_type}'" class="layui-btn layui-btn-primary">重置</button>
							</div>
						</div>
					</div>
				</form>
				
				<table class="layui-table">
				  	<thead>
					    <tr>
					      	<th>序号</th>
							<th>关键词</th>
							<th>网址</th>
							<th>排名</th>
							<th>渠道</th>
							<th>添加时间</th>
					    </tr> 
				  	</thead>
				 		<tbody>
				  		<notempty name="list['data']">
						<volist name="list['data']" id="vo">
					    <tr>
					    	<!-- 序号 -->
							<td>{$vo['No']}</td>
							
							<!-- 关键词 -->
							<td><a target="_balnk" href="{$vo['searchengine_url']}">{$vo['keyword']}</a></td>
							
							<!-- 网址 -->
							<td>
								<a href = "{$vo['website']}" target="_blank">{$vo['website']}</a>
							</td>
							
							<!-- 排名 -->
							<td>{$vo['rank']}</td>
							
							<!-- 渠道 -->
							<td>{$vo['searchengine_zh']}</td>
							
					      	<!-- 日期 -->
							<td>{$vo['createtime']|format_date}</td>
					    </tr>
				    </volist>
					<else/>
					<tr>
						<td colspan="6" align="center" class="layui-table-nodata">
							暂无相关数据
						</td>
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
</body>


