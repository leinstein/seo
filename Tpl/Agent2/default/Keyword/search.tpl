<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<link rel="stylesheet" href="../Public/css/keyword_add.css">

<!-- jquery.flexText begin -->
<script type="text/javascript" src="__PUBLIC__/js/jquery.flexText/jquery.flexText.min.js"></script>
<!-- jquery.flexText end -->
<link rel="stylesheet" href="__PUBLIC__/js/jquery.flexText/jquery.flexText.style.css">
   
    <script>
	$(function() {
		
		$('textarea').flexText();
		
		// 如果關鍵詞，就進行後台ajax搜索
        if( "{$keywords}"){
			var url = "__URL__/searchRecommend/keywords/{$keywords}/request_type/ajax";
			$.ajax({url: url,
				dataType: 'json',
    			success: function(data){
    				// 隐藏加载狂
					$('.progress').hide();
    				// 如果返回的结果又值
    				if( data ){
	    				
						var total = data.length;
						var html ="";
						for(i=0;i<total;i++){
							 html += '<a href="javascript:;" class="btn btn-default" mark="1'+i+'">'+data[i]["keyword"]+'</a>&nbsp;';
								var klist = '<tr class="hidden1" id="tr1'+i+'">';
								klist += '<td >'+data[i]["keyword"]+'</td>';
								klist +='<td class="text-center keyword_price price_pc">'+data[i]["baidu"]+'元/天</td>';
								klist +='<td class="text-center keyword_price price_yidong">'+data[i]["baidu_mobile"]+'元/天</td>';
								klist +='<td class="text-center keyword_price price_360 ">'+data[i]["360"]+'元/天</td>';
								klist +='<td class="text-center keyword_price price_sougou ">'+data[i]["sougou"]+'元/天</td>';
								klist +='<td class="text-center keyword_price price_shenma ">'+data[i]["shenma"]+'元/天</td>';
								/* klist +='<td class="text-center"><a href="__URL__/doAdd/keyword/'+data[i]["keyword"]+'/keywords/{$keywords}/type/11000/pricestr/'+data[i]["baidu"] +','+data[i]["baidu_mobile"] +'" class="layui-btn layui-btn-mini" type=11000>加入清单</a><a mark="1'+i+'" onclick="rm(this)" class="layui-btn layui-btn-danger layui-btn-mini">移出</a></td>'; */
								
								// 加上难度指数和优化周期
								klist +='<td class="text-center">'+data[i]["rate"]+'</td>';
								klist +='<td class="text-center">'+data[i]["optimization_cycle"]+'</td>';
	
								klist +='</tr>';
	                       		$("#tablelist").append(klist);
	                     }
						
						$("#show_recommend").html(html);
					}  else{
						$("#show_recommend").html('<div class="alert alert-warning" role="alert">未能获取到相关推荐关键词！</div>');
					}
    			}
			});  
		}
	
	    $('.recommend .btn').click(checked);
	    
	 
	    $('#recommend').on('click', 'a',
		    function() {
		        if (this.className.indexOf('checked') > 0) {
		            $(this).removeClass('checked');
		            var k = $(this).attr("mark");
		            $("#tr" + k).addClass("hidden1");
		            $("#tr" + k).find("input:checkbox").prop("checked", false);
	
		        } else {
		            $(this).addClass('checked');
		            var k = $(this).attr("mark");
		            $("#tr" + k).removeClass("hidden1");
		            $("#tr" + k).find("input:checkbox").prop("checked", true);
		        }
		    });
	
	});
	
	//
	function checked() {
	    var keyword_checked = $(this).parents('tr').find('.keyword').get(0).checked;
	    if (!keyword_checked) {
	        $(this).removeClass('checked');
	    } else {
	        $(this).addClass('checked');
	    }
	
	    $('.list tbody tr').each(function() {
	        var kstr = "";
	        var pricestr="";
	        var kw = $(this).find('input:checkbox').val();
	        $(this).find('td').each(function(i,e) {
	        	var price ="";
	        	if($(e).hasClass('keyword_price')){
	        		price = $(e).find(':hidden').val()
	        	}
	 
	            if ($(this).hasClass('checked')) {
	                kstr += '1';
	                if($(e).hasClass('keyword_price')){
		                if(pricestr){
		                	pricestr +=  "," + price;
		                }else{
		                	pricestr +=   price;
		                }
	                }
	                
	            } else {
	                kstr += '0';
	                if($(e).hasClass('keyword_price')){
		                if(pricestr){
		                	pricestr +=  ",0";
		                }else{
		                	pricestr +=   "0";
		                }
	                }
	            }
	        });
	        kstr = kstr.substr(1, 5);
	        if (kw != undefined) {
	            $(this).find('a:eq(0)').attr('href', '__URL__/doAdd/keyword/' + kw.substr(0, kw.indexOf('::')) + '/keywords/{$keywords}/type/' + kstr + '/pricestr/' + pricestr);
	            $(this).find(':checkbox').val(kw.substr(0, kw.indexOf('::')) + '::' + kstr + '::' + pricestr);
	        }
	
	    });
	}
	
	
</script>
<style type="text/css">
.list td, .list th {
    /* padding: 5px; */
    vertical-align: middle;
    text-align: center;
}
.list th, .list td {
    border: 1px solid #eee;
}
.list td, .list {
    font-size: 13px;
}
.list td, .list th {
    padding: 9px 15px;
    min-height: 20px;
    line-height: 20px;
    border: 1px solid #e2e2e2;
    font-size: 14px;
}
</style>
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
		  <a><cite>我的站点</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	 
		        	<!-- <div class="ddtishi">
	                    <h5>添加任务必读</h5>
	                    <p>推送者快排服务的前提是：<strong>你提供的关键词对应网址的排名已经在百度前十页</strong>，非前十页我们暂时无法优化；排名任务一般7~20天见效，<strong>不到首页不收取任务报价费用</strong>。但是由于部分网站可能由于自身服务器站内内容频繁更改等原因造成排名失败，而且每个任务都需要人力资源去维护，因此，<strong>20天内还未进入首页的关键词任务我们将自动关闭，并扣除20推币作为基础优化费用</strong>。<br> 推送者快速排名可以促进排名提升，时间越久排名越靠前，如到首页一段时间后停止使用，排名很有可能下降，再次恢复难度较大，请及时关注关键词是否需续费。<br> 提交任务相关详细技巧请查看《<strong><a href="/training">快排培训</a></strong>》栏目。</p>
	                </div>
					 -->
					<form id="form1" class="form-horizontal" action="" class="layui-form layui-form-pane">
						<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
						<input type="hidden" name="a" value="search" />
						<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
						<style>
						    .form-group{
						    	margin-left: 10px !important;
						    	margin-right: 10px;
						    }
   						</style>
   						
   						
   						
   						<div class="layui-form-item layui-form-text">
							<div class="layui-input-block" style="margin-left: 0px">
								<textarea class="layui-textarea" style="overflow:hidden; " placeholder="支持多个关键词查询，每个关键词用回车隔开" name="kws">{$kws}</textarea>
							</div>
						</div>
						
						<div class="layui-form-item" style="margin-top: 70px;">
							<div class="layui-input-block" style="margin-left: 0">
								<input type="submit" value="查询关键词" class="layui-btn">
							</div>
						</div>


						<!-- <div class="form-group">
							<label style="font-weight: normal; color: #f00">注：购买关键词之前请认真阅读
								<a target="_blank" href="/help_article.php?id=44">《{$LoginUserInfo['oem_config']['product_name']|default='优站宝'}服务协议》</a>
							</label>
						</div> -->
					</form>
					
					<!-- 查询结果 begin -->
					<div id="search" <empty name="list">style="display: none;"</empty>>

					<div class="panel tuijian_box" style="background-color: #f2f2f2; margin-bottom: 0;">
						<div class="panel-heading">
							<h3 class="panel-title pull-left" style="line-height: 1.5">
							<i class="iconfont">&#xe634;</i>
								系统为您推荐的词
							</h3>
						</div>
						<div class="panel-body" id="recommend">
							
							<!-- 加载进度 begin -->
							<!-- <div class="progress">
						      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only">45% Complete</span></div>
						    </div> -->
						    <div class="progress" style="margin: 0 auto;text-align: center;padding: 0 20px 20px 20px;">
						    	<img class="progress-img" alt="" src="__PUBLIC__/img/laoding.gif">
						    	<div class="progress-text mt10">系统正在为你查询相关推荐的关键词</div>
						  	  	
						    </div>
							<!-- 加载进度 end -->

							<volist name="list" id="vo1">
								<eq name="vo1.isrecommend" value="1">
								<a href="javascript:;" class="btn btn-default" mark="{$key}">{$vo1['keyword']}</a>&nbsp;
								</eq>
							</volist>
							<div id="show_recommend">
								<!--<div class="alert alert-success" role="alert">...</div>
								<div class="alert alert-info" role="alert">...</div> 
								<div class="alert alert-warning" role="alert">未能获取到相关推荐关键词！</div>
								<div class="alert alert-danger" role="alert">...</div> -->
							</div>
						</div>
					</div>
								
					<div class="panel-heading" style="padding-bottom: 20px;padding-top: 20px;">
					
						<h3 class="panel-title pull-left" style="line-height: 1.5">
							<i class="iconfont">&#xe686;</i>关键词清单</h3>
					</div>
					<form name="form2" id="form2" action="__URL__/doAdd" method="post" class="table-responsive" >
						<input type="hidden" name="keywords" value="{$keywords}">
						<table id="tablelist" class="list" style="width: 100%;">
							<tbody>
								<tr style="background-color: #e5e6e7;font-weight: bold;">
									<td>关键词</td>
									<td class="text-center key_pc"><img alt="" src="__PUBLIC__/img/baidu.png" style="width: 100px;"></td>
									<td class="text-center key_yidong"><img alt="" src="__PUBLIC__/img/baidu_mobile.png" style="width: 100px;"></td>
									<td class="text-center key_360"><img alt="" src="__PUBLIC__/img/360.png" style="width: 100px;"></td>
									<td class="text-center key_sougou"><img alt="" src="__PUBLIC__/img/sougou.png" style="width: 100px;"></td>
									<td class="text-center key_shenma"><img alt="" src="__PUBLIC__/img/shenma.png" style="width: 100px;"></td>
									<td class="text-center" width="100px">难度指数</td>
									<td class="text-center" width="60px">优化周期</td>
									
								</tr>
								<volist name="list" id="vo">
								<tr <eq name="vo['isrecommend']" value="1"> class="hidden1" </eq> id="tr{$key}">
									<td>
										{$vo['keyword']}
									</td>
									<td class="text-center keyword_price price_pc ">
										{$vo['baidu']}元/天
										<input type="hidden"  value="{$vo['baidu']}">
									</td>
									<td class="text-center keyword_price price_yidong ">
										{$vo['baidu_mobile']}元/天
										<input type="hidden"  value="{$vo['baidu_mobile']}">
									</td>
									<td class="text-center keyword_price price_360 ">
										{$vo['360']}元/天
										<input type="hidden"   value="{$vo['360']}">
									</td>
									<td class="text-center keyword_price price_sougou ">
										{$vo['sougou']}元/天
										<input type="hidden"  value="{$vo['sougou']}">
									</td>
									<td class="text-center keyword_price price_shenma ">
										{$vo['shenma']}元/天
										<input type="hidden"  value="{$vo['shenma']}">
									</td>
									<td class="text-center">
										{$vo['rate']}
									</td>
									<td class="text-center">
										{$vo['optimization_cycle']}
									</td>
									
									</tr>
								</volist>

							</tbody>
						</table>
						
						

					</form>
					
					
				</div>  
				
				 
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>
