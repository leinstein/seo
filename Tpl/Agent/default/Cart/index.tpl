<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "璐墿杞�";</php>
<head>
<include file="../Public/header" />

<!--鍝嶅簲寮廲ss-->
<link rel="stylesheet" type="text/css" href="../Public/css/responsive.css">
<!--datepicker鎻掍欢-->
<link rel="stylesheet" type="text/css" href="../Public/css/bootstrap-daterangepicker/daterangepicker-bs3.css">
</head>
<tagLib name="html" />
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
									<div class="clearfix">
										<h3 class="content-title pull-left">璐墿杞�</h3>
									</div>
									<div class="description">shoping cart</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<!--璐墿杞�-->

						<div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box border purple">
									<div class="box-body">
										<div id="datatable2_wrapper"
											class="dataTables_wrapper form-inline" role="grid">
											<form name="form2" id="form2" action="{:U('buy')}" method="post" class="table-responsive">
												<table cellpadding="0" cellspacing="0" border="0"
													class="datatable table table-striped table-bordered table-hover dataTable">
													<thead>
														<tr role="row">
															<th class="center">ID</th>
															<th class="center">鍏抽敭璇�</th>
															<th class="center">閫夋嫨缃戝潃</th>
															<th class="center">鎼滅储寮曟搸</th>
															<!--<th class="center">璐拱澶╂暟</th>-->
															<th class="center">鏃ユ湡</th>
															<th class="center">鍗曚环</th>
															<th class="center">鎿嶄綔</th>
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
																<html:select options="sitesOptions" first="璇烽�夋嫨" name="url" id="url{$vo['id']}" style="form-control input-sm" />
															</td>
															<td class="center">{$vo['searchengine_ZH']}</td>
															<td class="center">{$vo['createtime']}</td>
															<td class="center">{$vo['price']|format_money}{$vo['unit']}/{$vo['unit2']}</td>
															<td class="center">
																<input type="button" class="btn btn-danger btn-xs" onclick="buy({$vo['id']});" value="璐拱">
																<a onclick="return confirm('鍏抽敭璇嶅垹闄ゅ悗涓嶅彲鎭㈠锛屾偍纭畾鍒犻櫎锛�')" class="btn btn-danger btn-xs" href="{:u('delete')}/id/{$vo['id']}">鍒犻櫎</a>
															</td>
														</tr>

														</volist>
														<tr>

															<td class="center">
																<input type="checkbox"  onclick="checkAll(this,3)">鍏ㄩ儴/鍙嶉��
																<!-- <input class="btn btn-danger btn-sm" type="button" name="selectButton" value="鍏ㄩ儴/鍙嶉��" onclick="checkAll(this,3)"style="cursor: hand;"> -->
															</td>
															<td class="center" colspan="7">
															
																<html:select options="sitesOptions" first="鎵归噺璐拱璇烽�夋嫨缃戝潃" name="url" id="url" style="form-control input-sm pull-left" />
																	
															
																<div class="btn-group pull-left">
																	<input class="btn btn-danger  input-sm " type="button" name="btn4" value="鎵归噺璐拱" onclick="buyBatch()">

																	<input class="btn btn-default  input-sm " type="button" name="btn4" value="鎵归噺鍒犻櫎" onclick="deleteBatch()">
																</div></td>
														</tr>

														<else />
														<tr>
															<td class="center" colspan="7">鎮ㄨ繕鏈坊鍔犱换浣曞叧閿瘝</td>
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

											<!-- <div class="buy_tip">
												<span style="line-height: 30px">璐拱椤荤煡:<br>1.涓轰簡纭繚鍏抽敭璇嶆晥鏋�,绯荤粺灏嗘寜鐓х珯鐐逛笅鎵�璐拱鍏抽敭璇�30澶╃殑杈炬爣璐圭敤浣滀负棰勪粯娆捐繘琛屽喕缁�,鍐荤粨璧勯噾渚濈劧鍦ㄦ偍鐨勮处鎴蜂腑,浣嗘棤娉曞啀娆¤喘涔板叾浠栧叧閿瘝銆�<br>
													2.鍏抽敭璇嶈揪鏍囧悗鎸夊ぉ璁¤垂,璐圭敤浠庨浠樻涓繘琛屾墸闄�,棰勪粯娆炬秷鑰楀畬姣�,鍏抽敭璇嶈揪鏍囪垂鐢ㄥ皢浠庤处鍙蜂綑棰濅腑鎵ｉ櫎銆�<br>
													3.鍏抽敭璇嶈揪鏍囧悗90澶╁唴涓嶅緱鍋滄浼樺寲銆�<br> 鏇村鏈嶅姟鏉℃,璇烽槄璇�<a
													href="/help_article.php?id=44">銆婁紭绔欏疂鏈嶅姟鍗忚銆�</a></span>
											</div> -->

										</div>
									</div>
								</div>
								<!-- /BOX -->
							</div>
						</div>
						<!--/璐墿杞�-->
						<!--/鎴戠殑绔欑偣-->
						<!-- <div class="row">
							<div class="dataTables_footer clearfix">
								<div class="col-md-12 ">
									<div class="dataTables_paginate paging_bs_full pull-right"
										id="datatable2_paginate">
										<ul class="pagination">
											鎬昏褰曟暟:
											<span style="color: red">70</span>涓� 鎬婚〉鏁�:
											<span style="color: red">4</span> 涓婁竴椤�
											<span class="redfontB">1</span> |
											<a href="list.php?page=2">2</a> |
											<a href="list.php?page=3">3</a> |
											<a href="list.php?page=4">4</a> |
											<a href="list.php?page=2">涓嬩竴椤�</a> 璺宠浆鍒�
											<input type="text"
												style="width: 20px; border: 1px solid #ccc;" value="1"
												onchange="location.href=&quot;list.php?page=&quot;+this.value+&quot;&quot;">
											椤�
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

	<script>
    
	 function buy(id) {
		 
	        var siteid = $("#url" + id ).val(); 
	        
	        if (siteid == "") {
	            alert("璇峰厛閫夋嫨涓�涓綉鍧�锛屽湪杩涜璐拱");
				return false;
	        }
	        
	        if( confirm('鎮ㄧ‘瀹氳喘涔拌鍏抽敭璇嶏紵')){
	        	
		        var url = "__URL__/buy/id/" + id + "/siteid/" + siteid;
		      	// window.location.href= url;return false;
	        	$.ajax({
	                type: "get",
	                url: url,
	                dataType: "json",
	                success: function ( result ) {
	                	
	                	if( result.status == 1 ){
	                		 alert("璐拱鎴愬姛");
		                       $("#dd" + id).remove();
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
            alert("鍏宠仈缃戝潃涓嶈兘涓虹┖");
            return false;
        }
        
      //鑾峰彇閫変腑鐨勫叧閿瘝
      var ids = getChecked();
       if ( ids == "" || ids == 0 ) {
            alert("璇锋偍閫変腑鍏抽敭璇�");
            return false;
        }
        
       
       if( confirm('鎮ㄧ‘瀹氳喘涔伴�変腑鐨勫叧閿瘝锛�')){
      	
        var url = "__URL__/buy/id/" + ids + "/siteid/" + siteid;
	      	//window.location.href= url;return false;
      	$.ajax({
              type: "get",
              url: url,
              dataType: "json",
              success: function ( result ) {
              	
              	if( result.status == 1 ){
              		 alert("璐拱鎴愬姛");
	                // var id_arr=ids.split(","); //瀛楃鍒嗗壊 
                      for (i=0;i<ids.length ;i++ ) { 
                      	 $("#dd" + ids[i]).remove();
                      } 
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
    	//鑾峰彇閫変腑鐨勫叧閿瘝
        var ids = getChecked();
         if ( ids == "" || ids == 0 ) {
              alert("璇锋偍涓叧閿瘝");
              return false;
          }
         if( confirm('鎮ㄧ‘瀹氳喘涔拌鍏抽敭璇嶏紵')){
        	 window.location.href="__URL__/delete/id/"+ ids;
         }
   
    }


    
</script>
</body>
</html>