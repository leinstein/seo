<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>购物车</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<!--系统css-->
<link rel="stylesheet" type="text/css" href="../Public/css/cloud-admin.css">
<!--主题css-->
<link rel="stylesheet" type="text/css" href="../Public/css/default.css" id="skin-switcher">
<!--响应式css-->
<link rel="stylesheet" type="text/css" href="../Public/css/responsive.css">
<!--图标字体-->
<link href="../Public/css/font-awesome.min.css" rel="stylesheet">
<!-- DATE RANGE PICKER -->
<!--datepicker插件-->
<link rel="stylesheet" type="text/css" href="../Public/css/bootstrap-daterangepicker/daterangepicker-bs3.css">
<!-- FONTS -->
<!--字体-->

<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>

</head>
<tagLib name="html" />
<body>
	<!-- PAGE -->
	<section id="page">
		<div id="main-content">
			<div class="container">
				<div class="row">
					<div id="content" class="col-lg-12">
						<!-- PAGE HEADER-->
						<div class="row">
							<div class="col-sm-12">
								<div class="page-header">
									<div class="clearfix">
										<h3 class="content-title pull-left">购物车</h3>
									</div>
									<div class="description">shoping cart</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<!--购物车-->

						<div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box border">
									<div class="box-body">
										<div id="datatable2_wrapper"
											class="dataTables_wrapper form-inline" role="grid">
											<form name="form2" id="form2" action="{:U('buy')}" method="post" class="table-responsive">
												<table cellpadding="0" cellspacing="0" border="0"
													class="datatable table table-striped table-bordered table-hover dataTable">
													<thead>
														<tr role="row">
															<th class="center">ID</th>
															<th class="center">关键词</th>
															<th class="center">选择网址</th>
															<th class="center">搜索引擎</th>
															<!--<th class="center">购买天数</th>-->
															<th class="center">日期</th>
															<th class="center">单价</th>
															<th class="center">操作</th>
														</tr>
													</thead>
													<tbody>
														<notempty name="list">
														<volist name="list" id="vo">
														<tr id="dd{$vo['id']}">
															<td class="center">
																<input type="checkbox" id="id_{$vo['id']}" name="id[]" value="{$vo['id']}">
																{$vo['id']}
															</td>
															<td class="center">{$vo['keyword']}</td>
															<td class="center">
																<html:select options="sitesOptions" first="请选择" name="url" id="url{$vo['id']}" style="form-control input-sm" />
															</td>
															<td class="center">{$vo['searchengine']}</td>
															<td class="center">{$vo['createtime']}</td>
															<td class="center">{$vo['price']|format_money}{$vo['unit']}/{$vo['unit2']}</td>
															<td class="center">
																<input type="button" class="btn btn-danger btn-xs" onclick="buy({$vo['id']});" value="购买">
																<a onclick="return confirm('关键词删除后不可恢复，您确定删除？';)" class="btn btn-danger btn-xs" href="{:u('delete')}/id/{$vo['id']}">删除</a>
															</td>
														</tr>

														</volist>
														<tr>

															<td class="center">
																<input type="checkbox"  onclick="checkAll(this,3)">全部/反选
																<!-- <input class="btn btn-danger btn-sm" type="button" name="selectButton" value="全部/反选" onclick="checkAll(this,3)"style="cursor: hand;"> -->
															</td>
															<td class="center" colspan="7">
															
																<html:select options="sitesOptions" first="批量购买请选择网址" name="url" id="url" style="form-control input-sm pull-left" />
																	
															
																<div class="btn-group pull-left">
																	<input class="btn btn-danger  input-sm " type="button" name="btn4" value="批量购买" onclick="buyBatch()">

																	<input class="btn btn-default  input-sm " type="button" name="btn4" value="批量删除" onclick="deleteBatch()">
																</div></td>
														</tr>

														<else />
														<tr>
															<td class="center" colspan="7">暂无相关数据</td>
														</tr>
														</notempty>



													</tbody>
												</table>
											</form>

											<style type="text/css">
											.buy_tip {
												background-color: rgb(255, 253, 231);
												border-left: 5px solid rgb(255, 186, 50);
												padding: 5px 20px;
											}
											
											.buy_tip span {
												
											}
											</style>

											<div class="buy_tip">
												<span style="line-height: 30px">购买须知:<br>1.为了确保关键词效果,系统将按照站点下所购买关键词30天的达标费用作为预付款进行冻结,冻结资金依然在您的账户中,但无法再次购买其他关键词。<br>
													2.关键词达标后按天计费,费用从预付款中进行扣除,预付款消耗完毕,关键词达标费用将从账号余额中扣除。<br>
													3.关键词达标后90天内不得停止优化。<br> 更多服务条款,请阅读<a
													href="/help_article.php?id=44">《官网通服务协议》</a></span>
											</div>

										</div>
									</div>
								</div>
								<!-- /BOX -->
							</div>
						</div>
						<!--/购物车-->
						<!--/我的站点-->
						<!-- <div class="row">
							<div class="dataTables_footer clearfix">
								<div class="col-md-12 ">
									<div class="dataTables_paginate paging_bs_full pull-right"
										id="datatable2_paginate">
										<ul class="pagination">
											总记录数:
											<span style="color: red">70</span>个 总页数:
											<span style="color: red">4</span> 上一页
											<span class="redfontB">1</span> |
											<a href="list.php?page=2">2</a> |
											<a href="list.php?page=3">3</a> |
											<a href="list.php?page=4">4</a> |
											<a href="list.php?page=2">下一页</a> 跳转到
											<input type="text"
												style="width: 20px; border: 1px solid #ccc;" value="1"
												onchange="location.href=&quot;list.php?page=&quot;+this.value+&quot;&quot;">
											页
										</ul>
									</div>
								</div>
							</div>
						</div> -->

					</div>
				</div>
			</div>
		</div>
	</section>


	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- JQUERY -->
	<script src="../Public/js/jquery/jquery-2.0.3.min.js"></script>
	<!-- JQUERY UI-->




	<script>
    
	 function buy(id) {
		 
		 

	        var siteid = $("#url" + id ).val(); 
	        
	        if (siteid == "") {
	            alert("请先选择一个网址，在进行购买");
				return false;
	        }
	        
	        if( confirm('您确定购买该关键词？')){
	        	 $("#id_" + id ).attr("checked","checked"); 
	        	 var data ={
	        		"id":id,
	        		"siteid":siteid
	        			 
	        	 };
		        var url = "__URL__/buy/id/" + id + "/siteid/" + siteid;
		      //	window.location.href= url;return false;
	        	$.ajax({
	                type: "get",
	                url: url,
	                data: data,
	                dataType: "json",
	                success: function ( result ) {
	                	
	                	if( result.status == 1 ){
	                		 alert("购买成功");
		                        $("#" + dd).hide();
	                	}else{
	                		 alert(result.info );
	                	}   
	                }
	            }) 
	        }
	 
	    }

    function buyBatch() {
    	 var siteid = $("#url").val();
	        
        if ( siteid == "") {
            alert("关联网址不能为空");
            return false;
        }
        
      //获取选中的关键词
      var ids = getChecked();
       if ( ids == "" || ids == 0 ) {
            alert("请您选中关键词");
            return false;
        }
        
       
       if( confirm('关键词删除后不可恢复，您确定删除？')){
      	
	        var url = "__URL__/buy/id/" + ids + "/siteid/" + siteid;
	      	//window.location.href= url;return false;
      	$.ajax({
              type: "get",
              url: url,
              dataType: "json",
              success: function ( result ) {
              	
              	if( result.status == 1 ){
              		 alert("购买成功");
	                        $("#" + dd).hide();
              	}else{
              		 alert(result.info );
              	}
           
                 
              }
          }) 
      }
       

        //  document.form2.action = "__URL__/buy";
        //  document.form2.submit();
    }
    
    function deleteBatch() {
    	//获取选中的关键词
        var ids = getChecked();
         if ( ids == "" || ids == 0 ) {
              alert("请您中关键词");
              return false;
          }
         if( confirm('您确定购买该关键词？')){
        	 window.location.href="__URL__/delete/id/"+ ids;
         }
   
    }


    
</script>
</body>
</html>