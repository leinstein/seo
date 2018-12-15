<html lang="en"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>关键词扣费历史记录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- STYLESHEETS --><!--[if lt IE 9]>
    <script src="js/flot/excanvas.min.js"></script>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->

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
	<script type="text/javascript" src="../Public/js/easydialog/easydialog.min.js"></script>
	<link href="../Public/js/easydialog/easydialog.css" rel="stylesheet" type="text/css"><script>
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
</script>		 
<script type="text/javascript" src="../Public/js/My97DatePicker/WdatePicker.js"></script>
<link href="../Public/js/My97DatePicker/skin/WdatePicker.css" rel="stylesheet" type="text/css"><!-- FONTS -->
         <!-- tips插件 -->
         <link rel="stylesheet" href="../Public/css/tipso.min.css">

</head>
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
                                    <h3 class="content-title pull-left">
                                      站点效果                                    </h3>
                                </div>
                                <div class="description">WebSite Monitor</div>
                            </div>
                        </div>
                    </div>
                    <!-- /PAGE HEADER -->
                    <!--我的站点-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BOX -->
                            <div class="box border purple">
                                <div class="box-body">
                                    <div id="datatable2_wrapper" class="dataTables_wrapper form-inline table-responsive" role="grid">
                                        <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover dataTable">
                                            <thead>
                                              <tr role="row">
                                                  <th class="center">站点名称</th>
                                                  <th class="center">网址</th>
                                                  <th class="center">优化关键词数</th>
                                                  <th class="center">达标词数</th>
                                                  <th class="center">达标消费</th>
                                                  <th class="center">预付冻结金额</th>
                                                  <!-- <th class="center" >累计上首页数量</th> -->
                                                  <th class="center">累计消费</th>
                                                  <th class="center">添加时间</th>
                                                  <th class="center">历史数据</th>
                                              </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                                              		
                                            <tr class="gradeA odd">
                                            	<!-- 站点名称 -->
                                                <td class="center hidden-xs"><a href="javascript:void(0);" onclick="dopen('站点信息','/admin/userwz/site_detail_daili.php?uid=492',480);"> 停车棚  </a></td>

                                                <!-- 网址 -->
                                                <td class="center hidden-xs"> www.sxtcp.com   </td>
                                                
                                                


                                                <!-- 关键词数量 -->
                                                <td class="center hidden-xs">
                                                <a href="../Public/kw/list1.php?url=www.sxtcp.com">
													2                                                </a>
                                                </td>
                                                
                                                
												
												<!--昨日达标数-->
                                                <td class="center hidden-xs ">
                                                <a href="/admin/kw/list1.php?dab=1&amp;url=www.sxtcp.com">
                                                  1                                                  </a>
                                                </td>
												
												
												
												
												<!--昨日扣费-->
                                                <td class="center hidden-xs ">
                                                17
                                                </td>
												
												
												
												
												<!--累计上首页-->
                                              <!--   <td class="center hidden-xs ">
                                                  
                                                </td> -->
                                                
												   <td class="center hidden-xs"><span class="tip tipso_style">
                                                   
                                               0</span>
                                                                                               
                                                </td> 
												
												<!--累计扣费-->
                                                <td class="center hidden-xs ">
                                                  2890                                                
                                                </td>  
												
												
													<!--添加时间-->
                                                     <td class="center hidden-xs ">
                                                       2016-09-23                                                     </td>
													 
													 
													 
													 
													 <!---->
                                                     <td class="center hidden-xs">
                                                       <a href="detail2.php?siteid=179">查看详情</a>
                                                     </td>                                              
                                            </tr>
                                                                                        </tbody>
                                        </table>

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
</section>


<!--/PAGE -->
<!-- JAVASCRIPTS -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- JQUERY -->
<script src="../Public/js/jquery/jquery-2.0.3.min.js"></script>
<script src="../Public/js/tipso.min.js"></script>

<!-- /JAVASCRIPTS -->
<script type="text/javascript">
    $(function() {
    $('.tip').tipso({

    position: 'right'

  });
});
</script>






</body></html>