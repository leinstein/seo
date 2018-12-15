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
	
	function show_trip(){
		layui.use(['layer'], function(){
			  
			//多窗口模式，层叠置顶
			layer.open({
				  type: 1
				  ,title: false //不显示标题栏
				  ,closeBtn: false
				  ,area: '300px;'
				  ,shade: [0.4,'#000']//0.1透明度的白色背景
				  ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
				  ,resize: false
				  ,moveType: 1 //拖拽模式，0或者1
				  ,content: '<div style="padding: 50px; line-height: 22px;; color: #333; font-weight: 300;text-align:center;"><img src="__PUBLIC__/img/loading.gif" /><div>正在导出数据，请稍候...</div></div>'
				  ,time: 4000
				});
		 
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
	           
				<form name="form mt10" method="get" action="__URL__" class="form-inline layui-form">
					<input type="hidden" name="m" value="{$Think.MODULE_NAME}" />
					<input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
					<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
					<input type="hidden" name="id" value="{$Think.get.id}" />
					<div class="layui-form-item">
				
						<div class="layui-inline">
				
							<div class="layui-input-inline" style="width: 150px;">
								<input id="t1" name="t1" value="{$Think.get.t1}"  placeholder="开始时间" autocomplete="off" class="layui-input">
							</div>
							<div class="layui-form-mid">-</div>
							<div class="layui-input-inline" style="width: 150px;">
								<input type="text" id="t2" name="t2" value="{$Think.get.t2}"  placeholder="结束时间" autocomplete="off" class="layui-input">
							</div>
							<div class="layui-input-inline">
								<input type="submit" name="sub" value="查询" class="layui-btn">
								<button type="reset" name="btn"onclick="location.href='__URL__/{$Think.ACTION_NAME}'" class="layui-btn layui-btn-primary">重置</button>
							</div>
						</div>
					</div>
				</form>
				
				<table class="layui-table">
				  	<thead>
					    <tr>
					      	<th>日期</th>
							<th>关键词数</th>
							<th>排位数</th>
							<th>消费</th>
							<th>操作</th>
					    </tr> 
				  	</thead>
				 		<tbody>
				  		<notempty name="list['data']">
						<volist name="list['data']" id="vo">
					    <tr>
					      	<!-- 日期 -->
							<td>{$vo['createtime']|format_date}</td>
							
							<!-- 关键词数 -->
							<td>			
								<a href="javascript:;" onclick="open_layer('详情','{:U('keyword_list')}/id/{$vo['id']}','100%')">{$vo['keyword_number']|default='0'}</a>
							</td>
							
							<!-- 排位数 -->
							<td>
								<a href="javascript:;" onclick="open_layer('详情','{:U('keyword_list')}/id/{$vo['id']}/query_type/standard','100%',500)">{$vo['qualifying_number']|default='0'}</a>
							</td>
							
							<!-- 消费 -->
							<td>{$vo['consumption']|format_money}</td>
							
							<!-- 排名 -->
							<td>
							
								<a href="javascript:;" onclick="open_layer('详情','{:U('keyword_list')}/id/{$vo['id']}','100%',500)" class="layui-btn layui-btn-mini">详情</a>
								<a target="_blank" href="{:U('export')}/id/{$vo['id']}" onclick="show_trip()" class="layui-btn layui-btn-mini">导出详情</a>
								<a href="javascript:;" onclick="open_layer('详情','{:U('keyword_list')}/id/{$vo['id']}/query_type/standard','100%',500)" class="layui-btn layui-btn-mini">覆盖</a>
								<a target="_blank" href="{:U('export')}/id/{$vo['id']}/query_type/standard" onclick="show_trip()" class="layui-btn layui-btn-mini">导出覆盖</a>
								
							</td>
					    </tr>
				    </volist>
					<else/>
					<tr>
						<td colspan="5" >
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
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>


