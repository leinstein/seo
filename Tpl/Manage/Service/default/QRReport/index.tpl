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
	           
				<!-- 计划列表 挂件 begin -->
				{:W('QRReportList', array( 'data'=>$data , 'list' => $list,'returnUrl' => $CURRENT_URL ))}
				<!-- 计划列表 挂件 end -->
			</div>	
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>


