<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "������� - ��ֵ��¼";</php>
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
                                    <h3 class="content-title pull-left">��ֵ��¼</h3>
                                </div>
                                <div class="description">recharge record</div>
                            </div>
                        </div>
                    </div>
                    <!-- /PAGE HEADER -->
	                <!-- <div class="row tip3" style="margin-bottom: 15px">
	                    <div class="col-md-12">
	                        <a href="/recharge.html"  class="btn btn-danger ">��ֵ</a>
	                        <span>
	                         	  �ۼ�����: {$funs_info['total_consumption']|format_money}Ԫ
	                        </span>
	                        <span>
	                           	�������: {$funs_info['freezefunds']|format_money}Ԫ
	                        </span>
	                        <span>
	                           	�������: {$funs_info['availablefunds']|format_money}Ԫ
	                        </span>
	                        <span>
	                        	�˻����(����+����):{$funs_info['balancefunds']|format_money}Ԫ
	                        </span>
	                    </div>
	                </div>
 -->

                    <!--�������-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BOX -->
                            <div class="box border">
                                <div class="box-body">
                                    <div id="datatable2_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                        <div class="row" style="margin-bottom:10px;">
                                            <div class="col-sm-12">
                                                <a href="javascript:;" class="btn btn-default   btn-primary ribao_btn">��ֵ��¼</a>
                                                <!-- <a href="javascript:;" class="btn btn-default  chongzhi_btn">��ֵ����</a>
                                                <a href="javascript:;" class="btn btn-default  dj_btn">������ϸ</a> -->
                                            </div>
                                        </div>

                                        <table cellpadding="0" cellspacing="0" border="0"class="datatable table table-striped table-bordered table-hover dataTable ribao_table">
                                            <thead>
                                            <tr >
                                           		<th class="center">�������û�</th>
                                                <th class="center">���</th>
                                                <th class="center">ʱ��</th>
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
										<div class="ribao_div">�ܼ�¼��:<span style='color:red'>197</span>��  ��ҳ��:<span style='color:red'>7</span>  ��һҳ  <span class='redfontB'>1</span> | <a href='caiwu.php?page=2&id=&pid='>2</a> | <a href='caiwu.php?page=3&id=&pid='>3</a> | <a href='caiwu.php?page=4&id=&pid='>4</a> | <a href='caiwu.php?page=5&id=&pid='>5</a> | <a href='caiwu.php?page=2&id=&pid='>��һҳ</a>  ��ת�� <input type='text' style='width:20px; border:1px solid #ccc;' value=1 onchange='location.href="caiwu.php?page="+this.value+"&id=&pid="'> ҳ&nbsp;&nbsp; ��ҳ:<a href="caiwu.php?pagesize=100&id=&tab=1">100</a>&nbsp; <a href="caiwu.php?pagesize=200&id=&tab=1">200</a>&nbsp; <a href="caiwu.php?pagesize=500&id=&tab=1">500</a></div>



                                        <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover dataTable chongzhi_table">

                                            <thead>
                                                <tr >
                                                    <th class="center" >��ֵ���</th>
                                                    <th class="center" >��ֵʱ��</th>
                                                    <!-- <th class="center" >��ע</th> -->
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
<div class="chongzhi_div">�ܼ�¼��:<span style='color:red'>3</span>��  ��ҳ��:<span style='color:red'>1</span>  ��һҳ  <span class='redfontB'>1</span> | ��һҳ  ��ת�� <input type='text' style='width:20px; border:1px solid #ccc;' value=1 onchange='location.href="caiwu.php?fl=&page="+this.value+"&id=&pid="'> ҳ&nbsp;&nbsp; ��ҳ:<a href="caiwu.php?pagesize=100&id=&tab=2">100</a>&nbsp; <a href="caiwu.php?pagesize=200&id=&tab=2">200</a>&nbsp; <a href="caiwu.php?pagesize=500&id=&tab=2">500</a></div>


									<!--�����ʽ�-->
									 <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover dataTable dj_table">
                                            <thead>
                                            <tr >
                                                <th class="center">վ������</th>
                                                <th class="center">��ʼ����</th>
                                                <th class="center">�ۼ�����</th>
                                                <th class="center">��ǰ����</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                                                        <tr class="center">
                                         
											
												<td class="center">ͣ����</td>
												<td class="center">1350</td>
												<td class="center">1350</td>
												<td class="center">0</td>
											</tr>
                                                                                       
                                            </tbody>
                                       
										
                                    </table> 
                                    <div class="dj_div">
                                                �ܼ�¼��:<span style='color:red'>1</span>��  ��ҳ��:<span style='color:red'>1</span>  ��һҳ  <span class='redfontB'>1</span> | ��һҳ  ��ת�� <input type='text' style='width:20px; border:1px solid #ccc;' value=1 onchange='location.href="caiwu.php?fl=&page="+this.value+"&id=&pid="'> ҳ &nbsp;&nbsp; ��ҳ:<a href="caiwu.php?pagesize=100&id=&tab=3">100</a>&nbsp; <a href="caiwu.php?pagesize=200&id=&tab=3">200</a>&nbsp <a href="caiwu.php?pagesize=500&id=&tab=3">500</a>
                                            </div> 
                                    </div>
									
                                </div>
                            </div>
							
                            <!-- /BOX -->
                        </div>
                    </div>
                    <!--/�������-->
 

                </div>
            </div>
        </div>
    </div>
</section>


</body>
</html>


<script>
$('.dj_table').hide();
$('.dj_div').hide();
$('.chongzhi_div').hide();

    $(function () {
        //init Ĭ����ʾ�ձ���
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