
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>优站宝--财务数据</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <!--系统css-->
    <link rel="stylesheet" type="text/css" href="../Public/css/cloud-admin.css">
    <!--主题css-->
    <link rel="stylesheet" type="text/css" href="../Public/css/default.css" id="skin-switcher">
   <!--  <script src="//cdn.bootcss.com/jquery/2.2.0/jquery.js"></script>
    <script src="../Public/js/highcharts/highcharts.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <link rel="stylesheet" href="../Public/css/caiwu.css">
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
                                    <h3 class="content-title pull-left">财务管理</h3>
                                </div>
                                <div class="description">financial management</div>
                            </div>
                        </div>
                    </div>
                    <!-- /PAGE HEADER -->

  


	                <div class="row tip3" style="margin-bottom: 15px">
	                    <div class="col-md-12">
	                        <!-- <a href="/recharge.html"  class="btn btn-danger ">充值</a> -->
	                        <span>
	                         	  累计消费: {$funs_info['total_consumption']|format_money}元
	                        </span>
	                        <span>
	                           	冻结费用: {$funs_info['freezefunds']|format_money}元
	                        </span>
	                        <span>
	                           	可用余额: {$funs_info['availablefunds']|format_money}元
	                        </span>
	                        <span>
	                        	账户余额(冻结+可用):{$funs_info['balancefunds']|format_money}元
	                        </span>
	                    </div>
	                </div>


                    <!--财务管理-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BOX -->
                            <div class="box border">
                                <div class="box-body">
                                    <div id="datatable2_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                        <div class="row" style="margin-bottom:10px;">
                                            <div class="col-sm-12">
                                                <a href="javascript:;" class="btn btn-default   btn-primary ribao_btn">日报表</a>
                                                <a href="javascript:;" class="btn btn-default  chongzhi_btn">充值报表</a>
                                                 <a href="javascript:;" class="btn btn-default  dj_btn">冻结明细</a>
                                            </div>
                                        </div>

                                        <table cellpadding="0" cellspacing="0" border="0"class="datatable table table-striped table-bordered table-hover dataTable ribao_table">
                                            <thead>
                                            <tr >
                                                <th class="center">日期</th>
                                                <th class="center">达标关键词数</th>
                                                <th class="center">总计费</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <notempty name="dailys['data']">
                                            <volist name="dailys['data']" id="vo">
                                            <tr class="center">
											  <td class="center">{$vo.day}</td>
											  <td class="center"><a href="../Public/kw/list1.php?dab=1">{$vo.keyword_num}</a></td>
											  <td class="center">{$vo.price}</td>
											</tr>
                                            </volist>
                                            <else/>
                                            </notempty>										
											 
                                            </tbody>
											
                                        </table>
										<div class="ribao_div">
										{$dailys['html']}
										</div>



                                        <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover dataTable chongzhi_table">

                                            <thead>
                                                <tr >
                                                    <th class="center" >充值金额</th>
                                                    <th class="center" >充值时间</th>
                                                    <!-- <th class="center" >备注</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                                                            
                                                        <tr>
                                                            <td class="center" >5000</td>
                                                            <td class="center" >2016-08-09 14:18:28</td>
                                                            
                                                        </tr>
                                                                                                        
                                                        <tr>
                                                            <td class="center" >5000</td>
                                                            <td class="center" >2016-08-02 16:03:32</td>
                                                            
                                                        </tr>
                                                                                                        
                                                        <tr>
                                                            <td class="center" >5000</td>
                                                            <td class="center" >2016-07-15 15:59:54</td>
                                                            
                                                        </tr>
                                                                                                    </tbody>
                                        </table>
<div class="chongzhi_div">总记录数:<span style='color:red'>3</span>个  总页数:<span style='color:red'>1</span>  上一页  <span class='redfontB'>1</span> | 下一页  跳转到 <input type='text' style='width:20px; border:1px solid #ccc;' value=1 onchange='location.href="caiwu.php?fl=&page="+this.value+"&id=&pid="'> 页&nbsp;&nbsp; 分页:<a href="caiwu.php?pagesize=100&id=&tab=2">100</a>&nbsp; <a href="caiwu.php?pagesize=200&id=&tab=2">200</a>&nbsp; <a href="caiwu.php?pagesize=500&id=&tab=2">500</a></div>


									<!--冻结资金-->
									 <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover dataTable dj_table">
                                            <thead>
                                            <tr >
                                                <th class="center">站点名称</th>
                                                <th class="center">初始冻结</th>
                                                <th class="center">累计消费</th>
                                                <th class="center">当前冻结</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                                                        <tr class="center">
                                         
											
												<td class="center">停车棚</td>
												<td class="center">1350</td>
												<td class="center">1350</td>
												<td class="center">0</td>
											</tr>
                                                                                       
                                            </tbody>
                                       
										
                                    </table> 
                                    <div class="dj_div">
                                                总记录数:<span style='color:red'>1</span>个  总页数:<span style='color:red'>1</span>  上一页  <span class='redfontB'>1</span> | 下一页  跳转到 <input type='text' style='width:20px; border:1px solid #ccc;' value=1 onchange='location.href="caiwu.php?fl=&page="+this.value+"&id=&pid="'> 页 &nbsp;&nbsp; 分页:<a href="caiwu.php?pagesize=100&id=&tab=3">100</a>&nbsp; <a href="caiwu.php?pagesize=200&id=&tab=3">200</a>&nbsp <a href="caiwu.php?pagesize=500&id=&tab=3">500</a>
                                            </div> 
                                    </div>
									
                                </div>
                            </div>
							
                            <!-- /BOX -->
                        </div>
                    </div>
                    <!--/财务管理-->
 

                </div>
            </div>
        </div>
    </div>
</section>





<!--/PAGE -->
<!-- JQUERY -->
<script src="../Public/js/jquery/jquery-2.0.3.min.js"></script>

</body>
</html>


<script>
$('.dj_table').hide();
$('.dj_div').hide();
$('.chongzhi_div').hide();

    $(function () {
        //init 默认显示日报表
        $('.chongzhi_table').hide();

        $('.ribao_btn').click(function () {
            $('.chongzhi_table').hide();
            $('.dj_table').hide();
            $('.ribao_table').show();

            $('.dj_div').hide();
            $('.chongzhi_div').hide();
            $('.ribao_div').show();

            $(this).addClass('btn-primary');
            $('.chongzhi_btn').removeClass('btn-primary');
            $('.dj_btn').removeClass('btn-primary');

           
        });
        $('.chongzhi_btn').click(function () {
            $('.ribao_table').hide();
            $('.dj_table').hide();
            $('.chongzhi_table').show();

            $('.ribao_div').hide();
            $('.dj_div').hide();
            $('.chongzhi_div').show();

            $(this).addClass('btn-primary');
            $('.ribao_btn').removeClass('btn-primary');
            $('.dj_btn').removeClass('btn-primary');

           
            
        })
      

        $('.dj_btn').click(function () {
            $('.ribao_table').hide();
            $('.chongzhi_table').hide();
            $('.dj_table').show();

            $('.ribao_div').hide();
            $('.chongzhi_div').hide();
            $('.dj_div').show();

            $(this).addClass('btn-primary');
            $('.ribao_btn').removeClass('btn-primary');
            $('.chongzhi_btn').removeClass('btn-primary');
        })		

           
            
        })
</script>