<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <include file="../Public/header" />
   
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
	    function adjust( id ) {

			
			layer_confirm('您确定将选中的关键词进行价格调整？', function(){ 
				 var url = "__URL__/adjusPricePage/ids/" + id + "?returnUrl={$CURRENT_URL|urlencode}";
				 open_layer('调整价格',url,500,200)
			});

		}
		function adjustBatch() {

			//获取选中的关键词
			var ids = getChecked( 'layui'  );
			if ( ids == "" || ids == 0 ) {
			    layer_alert('请您选择关键词');
			    return false;
			}
		 
			layer_confirm('您确定将选中的关键词进行价格调整？', function(){ 
				 var url = "__URL__/adjusPricePage/ids/" + ids + "?returnUrl={$CURRENT_URL|urlencode}";
				 open_layer('调整价格',url,500,200)
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
    <include file="../Public/left" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
        <!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>关键词清单</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
            <section>
                <div class="ui-panel">				
                    <form name="form" id="form" method="get" action="__URL__" class="layui-form">
                        <input type="hidden" name="m" value="{$Think.MODULE_NAME}" />
                        <input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
                        <input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
                        <div class="layui-form-item">
                        	<div class="layui-inline">
						      <div class="layui-input-inline">
						        <input type="text" class="layui-input" name="keyword" value="{$Think.get.keyword}" placeholder="关键词">
						      </div>
                            <div class="layui-inline">
                                <div class="layui-input-inline" style="width: 100px;">
                                    <html:select options="SearchengineOptions" first="搜索引擎" name="searchengine"  style="form-control" selected="_GET['searchengine']" />	
                                </div>
                            </div>
                            <div class="layui-inline">
                                <div class="layui-input-inline">
                                    <html:select options="UserOptions" first="全部用户" name="createuserid"  style="form-control" selected="_GET['createuserid']" lay_search="true"/>	
                                </div>
                            </div>
                            <div class="layui-inline">
                                <div class="layui-input-inline" style="width: 160px;">
                                    <html:select options="PerPageOptions" first="默认每页显示20条" name="num_per_page"  style="form-control" selected="_GET['num_per_page']" />
                                </div>
                            </div>
                            
                            <div class="layui-inline">
                                <div class="layui-input-inline">
                                    <input type="submit" name="sub" value="查询" class="layui-btn">
                                    <button type="reset" name="btn" onclick="location.href='__URL__/index'" class="layui-btn layui-btn-primary"> 重置</button>
                                </div>
                            </div>
                        </div>
                    
						<table class="layui-table">
		                    <thead>
		                        <tr>
		                            <th width="50">序号</th>
									<th>关键词</th>
									<th>搜索引擎</th>
									<!--<th>购买天数</th>-->
									<th>添加用户</th>
									<th>添加日期</th>
									<th  width="80">初始单价</th>
									<th  width="80">调整后单价</th>
									<th width="80">操作</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                        <notempty name="list['data']">
		                            <volist name="list['data']" id="vo">
		                                <tr id="dd{$vo['id']}">
											<td>
												<input type="checkbox" id="id_{$vo['id']}" name="id[]" value="{$vo['id']}" lay-skin="primary">&nbsp;{$vo['No']}
											</td>
											<td>{$vo['keyword']}</td>
											<td>{$vo['searchengine_zh']}</td>
											<td>{$vo['createusername']}</td>
											<td>{$vo['createtime']}</td>
											<td>{$vo['initial_price']|format_money}{$vo['unit']}/{$vo['unit2']}</td>
											<td>{$vo['price']|format_money}{$vo['unit']}/{$vo['unit2']}</td>
											<td>
												<a onclick="adjust({$vo['id']})" class="layui-btn layui-btn-danger layui-btn-mini" href="javascript:;">调整价格</a>
												
											</td>
										</tr>
		                            </volist>
		                            <tr>
										<td colspan="8" style="text-align: left;">
											<div class="layui-inline">
										      	<div class="layui-input-inline">
										      		<input id="checkAll" type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" title="全选/反选">
										   		</div>
										    </div>
										    
										    <div class="layui-inline">
										      <div class="layui-input-inline">
										        <input class="layui-btn layui-btn-danger " type="button" name="btn4" value="批量调整价格" onclick="adjustBatch()">		
										      </div>
										    </div>
								
											<!-- 分页 begin -->		
											<div class="layui-box layui-laypage fr">
												{$list['html']}
											</div>	
											<!-- 分页 end -->	
										</td>
										
									</tr>
		                            <else/>
		                            <tr>
		                                <td colspan="8" align="center" align="center" class="layui-table-nodata">暂无相关数据</td>
		                            </tr>
		                        </notempty>
		                    </tbody>
		                </table>
	                </form>
                </div>
            </section>
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
