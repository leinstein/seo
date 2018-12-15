<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "购买关键词";</php>
<head>
<include file="../Public/header" />

<!--响应式css-->
<link rel="stylesheet" type="text/css" href="../Public/css/responsive.css">

<link rel="stylesheet" href="../Public/css/keyword_add.css">

<!--datepicker插件-->
<link rel="stylesheet" type="text/css" href="../Public/css/bootstrap-daterangepicker/daterangepicker-bs3.css">
<style>
body, #content {
	background-color: #fff;
}

.tuijian .btn {
	margin-bottom: 10px;
	border-radius: 0;
}

.checked {
	position: relative;
	left: 0;
	top: 0;
	border: 1px solid #48b56c !important;
}

.checked:after {
	content: '';
	display: block;
	width: 30px;
	height: 30px;
	background:
		url("http://www.yuntask.com/assets/theme/pc/company/images/rapbox3_pbg.png")
		right bottom no-repeat;
	position: absolute;
	right: 0;
	bottom: 0;
}

table {
	border-collapse: inherit;
}

.panel-heading {
	padding-bottom: 20px;;
}

.hidden1 {
	display: none;
}

#tablelist tr td:nth-of-type(1) label {
	display: inline-block;
	width: 240px !important;
	overflow: hidden;
}
</style>
<!-- FONTS -->
<!--字体-->
</head>
<body>
	<!-- PAGE -->
	<section id="page">
		<div id="main-content">
			<div class="container">
				<div class="row">
					<div id="content" class="col-lg-12" style="min-height: 780px;">
						<!-- PAGE HEADER-->
						<div class="row">
							<div class="col-sm-12">
								<div class="page-header">
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">购买关键词</h3>
									</div>
									<div class="description">mitong search</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<form id="form1" class="form-horizontal" action="">
							<input type="hidden" name="m" value="{$Think.MODULE_NAME}" /> 
							<input type="hidden" name="a" value="search" />
							<input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
							<style>
							    .form-group{
							    	margin-left: 10px !important;
							    	margin-right: 10px;
							    }
    						</style>
							<div class="form-group">
								<!-- <label>关键词</label> -->
								<textarea onpropertychange="MaxMe(this)" oninput="MaxMe(this)" style="overflow:hidden" class="form-control" placeholder="支持多个关键词查询，每个关键词用回车隔开" name="kws">{$kws}</textarea>
							  	<script type="text/javascript">
							    	function MaxMe(o) {
							      		o.style.height = o.scrollTop + o.scrollHeight + "px";
							    	}
							  	</script>
							</div>

							<div class="form-group">
								<input type="submit" value="查询" class="btn btn-danger">
							</div>

							<!-- <div class="form-group">
								<label style="font-weight: normal; color: #f00">注：购买关键词之前请认真阅读
									<a target="_blank" href="/help_article.php?id=44">《网站优化服务协议》</a>
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
							<div class="panel-body" id="tuijian">
								<volist name="list" id="vo1">
									<eq name="vo1.isrecommend" value="1">
									<a href="javascript:;" class="btn btn-default" mark="{$key}">{$vo1['keyword']}</a>&nbsp;
									</eq>
								</volist>
							</div>
						</div>
						<script>
						$(function() {
							
							// 如果關鍵詞，就進行後台ajax搜索
                        	if( "{$keywords}"){
                        		var url = "__URL__/searchRecommend/keywords/{$keywords}";
                        	console.log(url);
                        		$.ajax({url: url,
                                    dataType: 'json',
                                    success: function(data){
                                    	//console.log(data);
                                    	var total = data.length;
                                    	for(i=0;i<total;i++){
                                    		$("#tuijian").append('<a href="javascript:;" class="btn btn-default" mark="1'+i+'">'+data[i]["keyword"]+'</a>&nbsp;');
                                    		var klist = '<tr class="hidden1" id="tr1'+i+'">';
                                    		klist += '<td ><input type="checkbox" name="delid[]" value="'+data[i]['keyword']+'::11000" class="keyword" >'+data[i]["keyword"]+'</td>';
											klist +='<td class="text-center keyword_price price_pc checked">'+data[i]["baidu"]+'元/天</td>';
											klist +='<td class="text-center keyword_price price_yidong checked">'+data[i]["baidu_mobile"]+'元/天</td>';
											klist +='<td class="text-center keyword_price price_360 ">'+data[i]["360"]+'元/天</td>';
											klist +='<td class="text-center keyword_price price_sougou ">'+data[i]["sougou"]+'元/天</td>';
											klist +='<td class="text-center keyword_price price_shenma ">'+data[i]["shenma"]+'元/天</td>';
											// 加上难度指数和优化周期
											klist +='<td class="text-center">'+data[i]["difficulty_index"]+'颗星</td>';
											klist +='<td class="text-center">'+data[i]["optimization_cycle"]+'元/天</td>';
											
											klist +='<td class="text-center"><a href="__URL__/doAdd/keyword/'+data[i]["keyword"]+'/keywords/{$keywords}/type/11000/pricestr/'+data[i]["baidu"] +','+data[i]["baidu_mobile"] +'" class="btn btn-xs btn-danger" type=11000>加入购物车</a><a mark="1'+i+'" onclick="rm(this)" class="btn btn-xs btn-default">移出</a></td>';
											klist +='</tr>';
                                    		$("#tablelist").append(klist);
                                    	}
                                        $("#tuijian").append('<br>');
                                    }
                                   
                                  });  
                        	}
						
						    $('.tuijian .btn').click(checked);
						    // $('.list .keyword_price').click(checked);
						    // $('.list').delegate('.keyword_price', 'click',checked);
						    $('.list').on('click', '.keyword_price', checked1);
						    // $('#tablelist').on('click','.keyword_price',checked);
						    $('.key_pc').click(function() {
						        $('.price_pc').each(checked1);
						    });
						    $('.key_yidong').click(function() {
						        $('.price_yidong').each(checked1);
						    });
						    $('.key_360').click(function() {
						        $('.360').each(checked1);
						    });
						    $('.key_sougou').click(function() {
						        $('.sougou').each(checked1);
						    });
						    $('.key_shenma').click(function() {
						        $('.shenma').each(checked1);
						    });

						    // $('.list').delegate('.')
						    /*$('#tablelist').on('click','.keyword',function () {
															$(this).parents('tr').find('.keyword_price').each(checked);
														});*/

						    $('.list').delegate('.keyword', 'click',
						    function() {
						        $(this).parents('tr').find('.keyword_price').each(checked);
						    });

						    $('#tuijian').on('click', 'a',
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

						/**
						* 点击td事件
						*/
						
						function checked1() {
						    if ($(this).hasClass('checked')) {
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


						<div class="panel  list">
							<div class="panel-heading" style="padding-bottom: 20px;">
							
								<h3 class="panel-title pull-left" style="line-height: 1.5">
									<i class="iconfont">&#xe686;</i>关键词清单</h3>
							</div>
							<form name="form2" id="form2" action="__URL__/doAdd" method="post" class="table-responsive">
								<input type="hidden" name="keywords" value="{$keywords}">
								<table id="tablelist" class="table table-bordered " style="border: 1px solid #dddddd;">
									<tbody>
										<tr style="background-color: #e5e6e7;">
											<td class="text-center ">关键词</td>
											<td class="text-center key_pc">百度PC</td>
											<td class="text-center key_yidong">百度移动</td>
											<td class="text-center key_360">360</td>
											<td class="text-center key_sougou">搜狗</td>
											<td class="text-center key_shenma">神马</td>
											<td class="text-center">难度指数</td>
											<td class="text-center">优化周期</td>
											<td class="text-center ">操作</td>
										</tr>
										<volist name="list" id="vo">
										<tr <eq name="vo['isrecommend']" value="1"> class="hidden1" </eq> id="tr{$key}">
											<td>
												<input type="checkbox" name="check[]" value="{$vo['keyword']}::11000" class="keyword">
												{$vo['keyword']}
											</td>
											<td class="text-center keyword_price price_pc checked">
												{$vo['baidu']}元/天
												<input type="hidden"  value="{$vo['baidu']}">
											</td>
											<td class="text-center keyword_price price_yidong checked">
												{$vo['baidu_mobile']}元/天
												<input type="hidden"  value="{$vo['baidu_mobile']}">
											</td>
											<td class="text-center keyword_price 360 ">
												{$vo['360']}元/天
												<input type="hidden"   value="{$vo['360']}">
											</td>
											<td class="text-center keyword_price sougou ">
												{$vo['sougou']}元/天
												<input type="hidden"  value="{$vo['sougou']}">
											</td>
											<td class="text-center keyword_price shenma ">
												{$vo['shenma']}元/天
												<input type="hidden"  value="{$vo['shenma']}">
											</td>
											<td class="text-center keyword_price shenma ">
												{$vo['difficulty_index']}颗星
											</td>
											<td class="text-center keyword_price shenma ">
												{$vo['optimization_cycle']}
											</td>
											<td class="text-center">
												<a href="__URL__/doAdd/keyword/{$vo['keyword']}/keywords/{$keywords}/type/11000/pricestr/{$vo['baidu']},{$vo['baidu_mobile']}" class="btn btn-xs btn-danger" type="11000">加入购物车</a>
												<a mark="{$key}" onclick="rm(this)" class="btn btn-xs btn-default">移出</a></td>
											</tr>
										</volist>

									</tbody>
								</table>

							</form>
						</div>
						<!-- <p>提示:点击关键词和搜索引擎名称可以批量选择</p>
						<div class="clearfix">
							<a onClick="selectAll()"  class="btn btn-danger pull-left">全选</a>
							<a onClick="addAll()" class="btn btn-danger pull-right">加入购物车</a>
						</div> -->
						<div class="clearfix">
							<!--                    <a onClick="selectAll()"  class="btn btn-danger pull-left">全选</a>-->
							<label for="select_all " class="pull-left" style="line-height: 30px; padding-right: 20px; color: #5e87b1;">
							<input id="select_all" name="select_all" type="checkbox"  onclick="selectAll()">全选
							</label>
							<a onclick="addAll()" class="btn btn-primary pull-left">加入购物车</a>
						</div>
						<p class="tip">提示:点击关键词和搜索引擎名称可以批量选择</p>
						<script>
							function selectAll() {
								$(".list tr").not(".hidden1").find(":checkbox")
										.each(function() {
											$(this).trigger("click");
										});
							}
							function addAll() {
								
								 /* $.each($('input:checked'), function(i, n){
							    	  //console.log($(n).css("display"));
							      	id = $(n).val();
							          if (id  && $(n).css("display") !="none" && id != "on") ids.push(id);
							      });
								 
								 $("input[name='check[]']").each(function(i,e){
									console.log($(this).attr('checked'));
							
								}) */
								var ids = getChecked();
								if(ids == ''){
									alert('请您选择关键词')
									return false;
								}
								
								
								$('#form2').submit();
							}
							function rm(obj) {
								var num = obj.getAttribute('mark');
								$("#tr" + num).remove();

							}
						</script>

					</div>
				</div>

			</div>
		</div>
		</div>
	</section>
	<!--/PAGE -->

</body>
</html>