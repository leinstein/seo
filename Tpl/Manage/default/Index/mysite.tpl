<html lang="en"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>站点管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <!--系统css-->
    <link rel="stylesheet" type="text/css" href="../Public/css/cloud-admin.css">
    <!--主题css-->
    <link rel="stylesheet" type="text/css" href="../Public/css/default.css" id="skin-switcher">
    <!--图标字体-->
    <link href="../Public/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="../Public/js/easydialog/easydialog.min.js"></script><link href="../Public/css/easydialog/easydialog.css" rel="stylesheet" type="text/css"><script>
function dopen(title,src,height){
if(height==undefined){ height=500;}
easyDialog.open({
  container : {
    header : title,
    content : '<iframe src="'+src+'" width="100%" height='+height+'px  frameborder="no" scrolling="no"></iframe>'
  },
  overlay : false
});
}
</script>    <!-- FONTS -->
    <!--字体-->
</head>
<body>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div id="content" class="col-lg-12">
              
             <div class="row">
                 <div class="col-sm-12">
                     <div class="page-header">
                         <div class="clearfix">
                             <h3 class="content-title pull-left">站点管理</h3>
                         </div>
                         <div class="description">qisobao search system</div>
                     </div>
                 </div>
             </div>

            
              

                <!--我的站点-->
                <div class="row" style="margin-bottom: 15px">
                    <div class="col-md-12">
    <a href="javascript:;" onclick="dopen('添加站点','addztd.php',480)" class="btn btn-default add_site_btn">添加站点</a>
                        
                    
                        
                        
                        
                    </div>

                </div>
                                <div class="divide-10"></div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- BOX -->
                        <div class="box border purple">
                            <div class="box-body">
                                <div id="datatable2_wrapper" class="dataTables_wrapper form-inline table-responsive" role="grid">
                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover dataTable">
                                        <thead>
                                            <tr>
                                                <th class="center">站点名称</th>
                                                <th class="center">站点网址</th>
                                                <!--<th class="center">ftp</th>
                                                <th class="center">管理后台</th>-->
                                                <th class="center">创建时间</th>
                                                <th class="center">关键词数量</th>
                                                 <th class="center">站点状态</th>
                                                <!--<th class="center" >管理</th>-->
                                                <th class="center">工单</th>
												<th class="center">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                <td class="center">
                                                 <a href="javascript:;" onclick="dopen('查看详情','site_detail.php?id=862',480)" class="btn btn-link add_site_btn">565165204</a>
                                                </td>
                                                <td class="center">www.baidu.com</td>
                                                <!--<td class="center"></td>
                                                <td class="center"></td>-->
                                                <td class="center">2017-03-09</td>
												
												
												<td class="center"><a href="/admin/kw/list1.php?url=www.baidu.com">0</a></td>
                                                <td class="center">待审核<br>                                                
                                                  </td>
                                                <!--<td class="center">
                                                                                                <input class="btn btn-default btn-xs" type="button" name="addlanmu" onClick="dopen('修改站点','xgztd.php?id=862',480)" value="修改站点">
                                                
                                                <input  class="btn btn-default btn-xs" type="button" name="btn1" value="删除站点" onClick="if( !confirm('确定删除吗') ){return false;};location.href='list.php?id=862&action=del'">
                                                
                                                                                                <a href="txt.php?id=862" target="_blank">详情</a>
                                                </td>-->
                                                <td>
                                                                                                    </td>
												
												<td>
													   
														 <input type="button" class="btn btn-default btn-xs" name="addlanmu" onclick="dopen('修改','site_detail.php?id=862',480)" value="修改">
																   
                                                           
                                                                <a class="btn btn-default btn-xs" onclick="return confirm(&quot;确定删除 565165204 站点吗&quot;);" href="list.php?action=del&amp;id=862">删除</a>  
																									</td>
                                            </tr>
                                                <tr>
                                                <td class="center">
                                                 <a href="javascript:;" onclick="dopen('查看详情','site_detail.php?id=839',480)" class="btn btn-link add_site_btn">上海车展保洁公司</a>
                                                </td>
                                                <td class="center">www.shrcbjgs.com</td>
                                                <!--<td class="center"></td>
                                                <td class="center"></td>-->
                                                <td class="center">2017-03-07</td>
												
												
												<td class="center"><a href="/admin/kw/list1.php?url=www.shrcbjgs.com">0</a></td>
                                                <td class="center">待审核<br>                                                
                                                  </td>
                                                <!--<td class="center">
                                                                                                <input class="btn btn-default btn-xs" type="button" name="addlanmu" onClick="dopen('修改站点','xgztd.php?id=839',480)" value="修改站点">
                                                
                                                <input  class="btn btn-default btn-xs" type="button" name="btn1" value="删除站点" onClick="if( !confirm('确定删除吗') ){return false;};location.href='list.php?id=839&action=del'">
                                                
                                                                                                <a href="txt.php?id=839" target="_blank">详情</a>
                                                </td>-->
                                                <td>
                                                                                                    </td>
												
												<td>
													   
														 <input type="button" class="btn btn-default btn-xs" name="addlanmu" onclick="dopen('修改','site_detail.php?id=839',480)" value="修改">
																   
                                                           
                                                                <a class="btn btn-default btn-xs" onclick="return confirm(&quot;确定删除 上海车展保洁公司 站点吗&quot;);" href="list.php?action=del&amp;id=839">删除</a>  
																									</td>
                                            </tr>
                                                <tr>
                                                <td class="center">
                                                 <a href="javascript:;" onclick="dopen('查看详情','site_detail.php?id=179',480)" class="btn btn-link add_site_btn">停车棚</a>
                                                </td>
                                                <td class="center">www.sxtcp.com</td>
                                                <!--<td class="center">none</td>
                                                <td class="center">none</td>-->
                                                <td class="center">2016-09-23</td>
												
												
												<td class="center"><a href="/admin/kw/list1.php?url=www.sxtcp.com">15</a></td>
                                                <td class="center">优化中<br>                                                
                                                  </td>
                                                <!--<td class="center">
                                                                                                <a href="txt.php?id=179" target="_blank">详情</a>
                                                </td>-->
                                                <td>
                                                                                                    </td>
												
												<td>
															   
                                                     												</td>
                                            </tr>
                                        
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="dataTables_footer clearfix">
                                            <div class="col-md-12 ">
                                                <div class="dataTables_paginate paging_bs_full pull-right">
                                                    总记录数:<span style="color:red">3</span>个  总页数:<span style="color:red">1</span>  上一页  <span class="redfontB">1</span> | 下一页  跳转到 <input type="text" style="width:20px; border:1px solid #ccc;" value="1" onchange="location.href=&quot;list.php?page=&quot;+this.value+&quot;&quot;"> 页                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /BOX -->
                    </div>
                </div>
                <!--/我的站点-->



            </div>
        </div>
    </div>
</div>
<!--/PAGE -->
<!-- JAVASCRIPTS -->
<!-- JQUERY -->
<script src="../Public/js/jquery/jquery-2.0.3.min.js"></script>
<!-- /JAVASCRIPTS -->


</body></html>