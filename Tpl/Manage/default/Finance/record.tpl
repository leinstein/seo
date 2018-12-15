<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "财务管理 - 充值记录";</php>
<head>
<include file="../Public/header" />
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
                                    <h3 class="content-title pull-left">充值记录</h3>
                                </div>
                                <div class="description">recharge record</div>
                            </div>
                        </div>
                    </div>
                    <!-- /PAGE HEADER -->
	                <!-- <div class="row tip3" style="margin-bottom: 15px">
	                    <div class="col-md-12">
	                        <a href="/recharge.html"  class="btn btn-danger ">充值</a>
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
 -->

                    <!--财务管理-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BOX -->
                            <div class="box border">
                                <div class="box-body">
                                    <div id="datatable2_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                        <div class="row" style="margin-bottom:10px;">
                                            <div class="col-sm-12">
                                                <a href="javascript:;" class="btn btn-default   btn-primary ribao_btn">充值记录</a>
                                                <!-- <a href="javascript:;" class="btn btn-default  chongzhi_btn">充值报表</a>
                                                <a href="javascript:;" class="btn btn-default  dj_btn">冻结明细</a> -->
                                            </div>
                                        </div>

                                        <table cellpadding="0" cellspacing="0" border="0"class="datatable table table-striped table-bordered table-hover dataTable ribao_table">
                                            <thead>
                                            <tr >
                                           		<th class="center">代理商用户</th>
                                                <th class="center">金额</th>
                                                <th class="center">时间</th>
                                            </tr>
                                            </thead>
                                            <tbody>
	                                            <volist name="list['data']" id="vo">
	                                            <tr class="center">
											  		<td class="center">{$vo['username']}</td>
											  		<td class="center">{$vo['username']}</td>
											  		<td class="center">{$vo['createtime']}</td>
												</tr>
	                                            </volist>
                                            											
											 

                                            </tbody>
											
                                        </table>
										<div class="ribao_div">总记录数:<span style='color:red'>197</span>个  总页数:<span style='color:red'>7</span>  上一页  <span class='redfontB'>1</span> | <a href='caiwu.php?page=2&id=&pid='>2</a> | <a href='caiwu.php?page=3&id=&pid='>3</a> | <a href='caiwu.php?page=4&id=&pid='>4</a> | <a href='caiwu.php?page=5&id=&pid='>5</a> | <a href='caiwu.php?page=2&id=&pid='>下一页</a>  跳转到 <input type='text' style='width:20px; border:1px solid #ccc;' value=1 onchange='location.href="caiwu.php?page="+this.value+"&id=&pid="'> 页&nbsp;&nbsp; 分页:<a href="caiwu.php?pagesize=100&id=&tab=1">100</a>&nbsp; <a href="caiwu.php?pagesize=200&id=&tab=1">200</a>&nbsp; <a href="caiwu.php?pagesize=500&id=&tab=1">500</a></div>



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