<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "浼樼珯瀹濋椤�";</php>
<head>
<include file="../Public/header" />
<!-- tips鎻掍欢 begin -->
<link rel="stylesheet" href="../Public/css/tipso.min.css">
<script src="../Public/js/tipso.min.js"></script>
<!-- tips鎻掍欢 end -->
    
    <script type="text/javascript">
        function myBrowser(){
            var userAgent = navigator.userAgent; //鍙栧緱娴忚鍣ㄧ殑userAgent瀛楃涓�
            var isOpera = userAgent.indexOf("Opera") > -1;
            if (isOpera) {
                return "Opera"
            }; //鍒ゆ柇鏄惁Opera娴忚鍣�
            if (userAgent.indexOf("Firefox") > -1) {
                return "FF";
            } //鍒ゆ柇鏄惁Firefox娴忚鍣�
            if (userAgent.indexOf("Chrome") > -1){
          return "Chrome";
         }
            if (userAgent.indexOf("Safari") > -1) {
                return "Safari";
            } //鍒ゆ柇鏄惁Safari娴忚鍣�
            if (userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1 && !isOpera) {
                return "IE";
            }; //鍒ゆ柇鏄惁IE娴忚鍣�
        }
        //浠ヤ笅鏄皟鐢ㄤ笂闈㈢殑鍑芥暟
        var mb = myBrowser();
        if ("IE" == mb) {
            // alert("鎴戞槸 IE");
            window.location='/ie.html';
        }
        
    </script>

    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Yahei", "Hiragino Sans GB", "Heiti SC", "WenQuanYi Micro Hei", sans-serif;
        !important;
        }
        .iconfont{
        	font-size: 32px;
        }
    </style>
</head>
<body>

  

<!-- PAGE -->
<section id="page">
    <!-- SIDEBAR -->
	

    <!-- /SIDEBAR -->
    <div id="main-content" style=" margin-left: 0px;">
        <div class="container">
            <div class="row">
                <div id="content" class="col-md-12">
				  
				  <!--鏈嶅姟鏉℃-->
				    <!-- <div class="panel panel-danger">
						<div class="panel-heading">
						 <p class="panel-title">瀹樼綉閫� <span style="color:green">{$LoginUserName}</span> 鐢ㄦ埛锛屾偍濂斤紝涓轰簡纭繚鏇村ソ鐨勪紭鍖栨晥鏋滐紝璇疯鐪熼槄璇� <a href="/help_article.php?id=44" target="_blank">銆婂畼缃戦�氭湇鍔″崗璁��</a></p>
						</div>
					</div> -->
                   
                      <div class="row">
                        <div class="col-md-3">
                            <div class="dashbox panel panel-default">
                                <div class="panel-body">
                                    <div class="panel-left red">
                                        <i class="iconfont icon-zhandian"></i>
                                    </div>
                                    <div class="panel-right">
                                        <div class="number">{$siteNum|default= 0}</div>
                                        <div class="title">绔欑偣鎬绘暟</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="dashbox panel panel-default">
                                <div class="panel-body">
                                    <div class="panel-left blue">
                                        <i class="iconfont icon-guanjianci"></i>
                                    </div>
                                    <div class="panel-right">
                                        <div class="number">{$purchasedKeywordNum|default= 0}</div>
                                        <div class="title">鍏抽敭璇嶆�绘暟</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="dashbox panel panel-default">
                                <div class="panel-body">
                                    <div class="panel-left red">
                                        <i class="iconfont icon-xing"></i>
                                    </div>
                                    <div class="panel-right">
                                        <div class="number">{$stankeywordNum|default= 0}</div>
                                        <div class="title">鏈�鏂拌揪鏍囪瘝鏁�
                                        <span class="tip tipso_style" data-tipso="浠ユ渶鏂版娴嬫椂闂翠负鍑�">銑�</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="dashbox panel panel-default">
                                <div class="panel-body">
                                    <div class="panel-left red">
                                         <i class="iconfont icon-xing"></i>
                                    </div>
                                    <div class="panel-right">
                                        <div class="number">{$standardsFee|format_money}</div>
                                         <div class="title">鏈�鏂版秷璐�
                                         <span class="tip tipso_style" data-tipso="浠ユ渶鏂版娴嬫椂闂翠负鍑�">銑�</span>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dashbox panel panel-default">
                                <div class="panel-body">
                                    <div class="panel-left red">
                                         <i class="iconfont">&#xe65a;</i>
                                    </div>
                                    <div class="panel-right">
                                        <div class="number">{$freezefunds|format_money}</div>
                                        <div class="title">鍐荤粨璧勯噾</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="dashbox panel panel-default">
                                <div class="panel-body">
                                    <div class="panel-left red">
                                        <i class="iconfont icon-552cd445ad39f"></i>
                                    </div>
                                    <div class="panel-right">
                                        <div class="number">{$consumption_month|format_money}</div>
                                        <div class="title">鏈湀娑堣垂</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="dashbox panel panel-default">
                                <div class="panel-body">
                                    <div class="panel-left red">
                                        <i class="iconfont icon-552cd445ad39f"></i>
                                    </div>
                                    <div class="panel-right">
                                        <div class="number">{$consumptionfunds|format_money}</div>
                                        <div class="title"> 绱娑堣垂</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="dashbox panel panel-default">
                                <div class="panel-body">
                                    <div class="panel-left red">
                                        <i class="iconfont">&#xe60e;</i>
                                    </div>
                                    <div class="panel-right">
                                        <div class="number">{$compliance_rate}</div>
                                        <div class="title">鍏抽敭璇嶈揪鏍囩巼</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="divide-10"></div>                 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box border blue">
                                <div class="box-title">
                                    <h4><i class="fa fa-table"></i>娑堣垂缁熻</h4>
                                </div>
                                
                                <!-- 涓� ECharts 鍑嗗涓�涓叿澶囧ぇ灏忥紙瀹介珮锛夌殑 DOM -->
    							<div id="main" style="width:100%;height:400px;">
    							
    							</div>
                            </div>
                        </div>
                    </div>    
                    <!-- <div class="row">
                        <div class="col-md-12 center">
                            <div class="col-md-3">
                                <a class="btn btn-danger btn-icon input-block-level" href="{:U('Site/index')}">
                                    <i class="iconfont">&#xe633;</i>
                                    <div>娣诲姞绔欑偣</div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-warning btn-icon input-block-level" href="{:U('Keyword/add')}">
                                    <i class="iconfont">&#xe600;</i>
                                    <div>娣诲姞鍏抽敭璇�</div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{:U('Site/effect')}" class=" btn btn-info btn-icon input-block-level">
                                	<i class="iconfont">&#xe7b2;</i><div>绔欑偣鐩戞帶</div>
                               	</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{:U('Keyword/index')}" class=" btn btn-danger btn-icon input-block-level">
                                <i class="iconfont">&#xe7b2;</i><div>鍏抽敭璇嶇洃鎺�</div></a>
                            </div>
                        </div>
                    </div> -->


                </div>
            </div>
        </div>
    </div>
</section>





<!--/PAGE -->


   <script type="text/javascript">
        // 鍩轰簬鍑嗗濂界殑dom锛屽垵濮嬪寲echarts瀹炰緥
        var myChart = echarts.init(document.getElementById('main'));
		var consumptions = {$consumptions};
        // 鎸囧畾鍥捐〃鐨勯厤缃」鍜屾暟鎹�
        var option = {
            title: {
               // text: 'ECharts 鍏ラ棬绀轰緥'
            },
            tooltip: {
            	
            },
            legend: {
                data:['姣忔棩娑堣�楋紙鍏冿級']
            },
           
            toolbox: {
                show: true,
                feature: {
                    magicType: {show: true, type: ['stack', 'tiled']},
                    saveAsImage: {show: true}
                }
            },
            xAxis: {
                data:{$days}
            },
            yAxis: {
            	 type: 'value'
            },
            series: [{
                name: '姣忔棩娑堣�楋紙鍏冿級',
                type: 'line',
                smooth: true,
                data: consumptions,
                itemStyle : { normal: {label : {show: true}}},
            }]
        };

        // 浣跨敤鍒氭寚瀹氱殑閰嶇疆椤瑰拰鏁版嵁鏄剧ず鍥捐〃銆�
        myChart.setOption(option);

		$(function() {
			$('.tip').tipso({

				position : 'top',
				useTitle: false

			});
		});
	</script>
    </body>
    </html>