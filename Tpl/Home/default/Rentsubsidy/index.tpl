<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<script type="text/javascript" src="__PUBLIC__/js/fusioncharts/JS/jquery.fusioncharts.debug.js"></script>
<script src="__PUBLIC__/js/echarts-all.js"></script>
<script>
    //加载
    $(function(){
        var myChart = echarts.init(document.getElementById("main1"), 'macarons');  
        var option = {
    tooltip : {
        trigger: 'axis',
        axisPointer : {           
            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
        },
    },
    legend: {
        data:['补贴金额（万元）','企业数量（家）']

    },
    toolbox: {
        show : true,
        feature : {     
            saveAsImage : {show: true}
        }
    },
    calculable : false,
    xAxis : [
        {
           show: true,
           axisLine : {    // 轴线
                show: false,              
            },
           axisTick : {    // 轴标记
                show:false,
                },
            type : 'category',
          data : function (){
                var list = [2011,2012,2013,2014,2015]
                return list;
            }()
        }
    ],
    yAxis : [
        { show: true,
            min: 0,
            max: 15000,
            type : 'value',
            name : '金额',
            axisLabel : {
                formatter: '{value}万元'
            }
        },
        { show: true,
            type : 'value',
            min: 600,
            max: 900, 
            name : '企业数量',
            axisLabel : {
                formatter: '{value} 家'
            }
        }
    ],
    series : [

        
        {
            name:'补贴金额（万元）',
            type:'bar',
            barCategoryGap:'60%',
            barWidth:'40',
            data:function (){
                var list = [{$subsidymoneydatastr}]
                return list;
            }(),
            
        },

        {
            name:'企业数量（家）',
            type:'line',
            yAxisIndex: 1,
            data:function (){
                var list = [{$subsidynumdatastr}]
                return list;
            }()

        }
    ]
};

    myChart.setOption(option);          
    var ecConfig = echarts.config;
    function eConsole(param) { 
    if (typeof param.seriesIndex != 'undefined'){
        var year = param.dataIndex+2011;
        window.location.href="__APP__/Bussiness/index/p02/"+year;
    }  
}
    myChart.on(ecConfig.EVENT.CLICK, eConsole);
    myChart.on(ecConfig.EVENT.DBLCLICK, eConsole);
    //myChart.on(ecConfig.EVENT.HOVER, eConsole);
    myChart.on(ecConfig.EVENT.DATA_ZOOM, eConsole);
    myChart.on(ecConfig.EVENT.LEGEND_SELECTED, eConsole);
    myChart.on(ecConfig.EVENT.MAGIC_TYPE_CHANGED, eConsole);
    myChart.on(ecConfig.EVENT.DATA_VIEW_CHANGED, eConsole);

    });
</script>
<script type="text/javascript">
$(function(){
 $(".search_input").bind("keydown",function(e){
            // 兼容FF和IE和Opera    
            var theEvent = e || window.event;    
            var code = theEvent.keyCode || theEvent.which || theEvent.charCode;
            if (code == 13) { 
               // alert(code);
                //回车执行查询
                $("#seach_button").click();
            }    
    });
});
function serch(){
    var t1 = $("input[name='entername']").val();
    window.location.href = "__APP__/Company/adcompany/t1/"+t1;
}
</script>
<script type="text/javascript">
  if( !('placeholder' in document.createElement('input')) ){   
  
    $('input[placeholder],textarea[placeholder]').each(function(){    
      var that = $(this),    
      text= that.attr('placeholder');    
      if(that.val()===""){    
        that.val(text).addClass('placeholder');    
      }    
      that.focus(function(){    
        if(that.val()===text){    
          that.val("").removeClass('placeholder');    
        }    
      })    
      .blur(function(){    
        if(that.val()===""){    
          that.val(text).addClass('placeholder');    
        }    
      })    
      .closest('form').submit(function(){    
        if(that.val() === text){    
          that.val('');    
        }    
      });    
    });    
  } 
</script>

<link href="../Public/css/special/count-analyse.css" rel="stylesheet">
<style>
/*选择框风格*/
.select-bar{    width:640px; top:32px; left:160px; }
.ui-poptip {
    color: #00009c;
    z-index: 101;
    font-size: 12px;
    line-height: 1.5;
    zoom: 1;
}
.ui-poptip-arrow-5 {
    right: 11px;
    bottom: -2px;
}
.ui-poptip-arrow-1 {
    right: 44px;
    top: -8px;
}
.ui-poptip-arrow-7 {
    left: 44px;
    bottom: -2px;
}
.ui-poptip-arrow-10  {
    left: -8px;
    border-width: 6px 6px 6px 0;    
} 
.ui-list {
    list-style: disc inside;
}
.background{
    margin:0 auto;
    margin-top:40px;
    margin-bottom:40px;
    height:400px;width:900px; 
    background: url(../Public/img/yuanqu.png) no-repeat top;
}
.ui-box-noborder {
   
    zoom: 1;
    font-size: 12px;
    margin: 0;
    padding: 0;
    border-bottom: none;
}
.ui-box-head{
    border-bottom: 1px solid #ccc;
    position: relative;
    padding: 10px;
    height: 16px;
    line-height: 16px;
    background: -webkit-gradient(linear, left top, left bottom, from(#f9f9f9), to(#fcfcfc));
    background: -moz-linear-gradient(top, #f9f9f9, #fcfcfc);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fcfcfc', endColorstr='#f9f9f9');
    background: -o-linear-gradient(top, #f9f9f9, #fcfcfc);
    background: linear-gradient(top, #f9f9f9, #fcfcfc);
    zoom: 1;
}
.ui-box-container {
    background: #fff;
    border-bottom: 0px solid #000;
}
.ui-box-container1 {
    background: #fff;
}
.font{
    font-family:'微软雅黑';
}
</style>
</head>

<body>
    <!-- 页面顶部 logo & 菜单 begin  -->
    <include file="../Public/top_banner" />
    <!-- 页面顶部 logo & 菜单 end  -->
    <div class="wrapper">
        <!-- 顶部栏目导航 begin -->
        <div  class="ui-grid-row">
            <div class="ui-grid-25">
                <h2 class="ui-page-title" > 房租补贴专题分析</h2>
            </div>
        </div>
        <!-- 顶部栏目导航 end -->
        <div  class="ui-grid-row">  
            <!-- 右布局 begin -->
            <div class="ui-grid-25">
                <div class="ui-box-cs">
                    <div class="ui-box-cs-head">
                        <div class="ui-box-cs-head-border">
                            <img alt="" src="../Public/img/countanalyse/title.png">
                            <span class="font-style top">房租</span>
                            <span class="font-style bottom">补贴</span>
                            <h3 class="ui-box-cs-head-title">房租补贴专题</h3>
                            <span class="ui-box-cs-head-text">数据范围：2011年后的数据</span>
                        </div>
                        
                    </div>
                    <div class="ui-box-container" >                                          
                        <div class="ui-box-noborder" style="margin:0px 0px 0px 0px;">
                            <div class="ui-box-head">
                                <div class="ui-box-head-border">
                                    <h3 class="ui-box-head-title" >实际拨付情况</h3>                                   
                                </div>
                            </div>                           
                            <div class="ui-box-container">                                 
                                <div>
                                    <ul class="ui-list" style="type:disc;">
                                        <li  style="margin:20px 10px 5px 30px;font-family:'微软雅黑';font-size:14px; " class="ui-list-item">累计支持企业<span style="color:#08c;">{$epnumall}</span>家 ，补贴面积超过 <span style="color:#08c;">{$allarea/10000|format_money} </span>万平方米</li>
                                        <li style="margin:-25px 10px 5px 430px;font-family:'微软雅黑';font-size:14px;"class="ui-list-item">补贴总额达<span style="color:#08c;">{$subsidymoneyall/10000|format_money}</span>亿，占园区科技发展资金总额的<span style="color:#08c;">{$percent|format_money}</span>%</li>
                                        <li style="margin:10px 10px 5px 30px;font-family:'微软雅黑';font-size:14px;" class="ui-list-item">平均每家企业补贴<span style="color:#08c;">{$allarea/$epnumall|format_money1}</span>平方米，补贴 <span style="color:#08c;">{$subsidymoneyall/$epnumall|format_money}</span>万元</li>
                                    </ul>
                                    <div  class="font" style="margin-left:400px;font-family:'微软雅黑';background-color:#ececec;width:120px;padding:6px 12px 6px 12px;    ">点击柱形图可查看详情</div>
                                </div>
                                <div id="main1" style="width:700px;height:400px;margin-left:150px;margin-top:20px;"> </div> 
                                <div style="margin-left:750px;margin-top:-55px;width:50px;font-family:'微软雅黑';">拨付年度</div>         
                            </div>
                        </div>
                    </div>                                       
                       
                        <!-- box2 begin -->
                    <div class="ui-box-noborder " style="margin:40px 0px 10px 0px;bottom:0px;">
                        <div class="ui-box-head">
                            <h3 class="ui-box-head-title">各载体房租补贴情况 </h3>
                        </div>
                        <div class="ui-box-container" >
                            <div class="ui-box-content background">
                                <!-- 提示框1 begin -->
                                 <div class="font" style="margin-left:90px;margin-top:22px;"><b class="font-color"><font color="#656565">科技公司</font></b><a style="margin-left:233px;" href="__URL__/zaitidetail/carrierid/42bbc61a-a92a-4e16-90ee-a6e0c8017376">详情>></a></div>
                                <div class="font" style="margin-top:12px;margin-left:90px;"><font color="#656565">补贴企业：{$subsidy1} 家</font><span style="margin-left:30px;"><font color="#656565">补贴面积：{$zaitisubsidyarea1/10000|format_money}万平米 </font></span></div>
                                <div class="font" style="margin-top:8px;margin-left:90px;"><font color="#656565">已补贴金额：{$allowancesubsidized1/10000|format_money1} 万元</font></div>
                                <div class="font" style="margin-top:8px;margin-left:90px;"><font color="#656565">待补贴金额：{$daibusum1/10000|format_money1} 万元</font></div>
                                <!-- 提示框1 end -->
                                <!-- 提示框2 begin -->
                                <div  class="font" style="margin-left:471px;margin-top:-98px;"><b><font color="#656565">生物公司</font></b><a style="margin-left:230px;" href="__URL__/zaitidetail/carrierid/91442159-441b-45ad-a3c5-2c433f3b7bae">详情>></a></div>
                                <div  class="font" style="margin-top:12px;margin-left:471px;"><font color="#656565">补贴企业：{$subsidy2} 家</font><span style="margin-left:30px;"><font color="#656565">补贴面积：{$zaitisubsidyarea2/10000|format_money}万平米 </font></span></div>
                                <div  class="font" style="margin-top:8px;margin-left:471px;"><font color="#656565">已补贴金额：{$allowancesubsidized2/10000|format_money1} 万元</font> </div>
                                <div  class="font" style="margin-top:8px;margin-left:471px;"><font color="#656565">待补贴金额：{$daibusum2/10000|format_money1} 万元</font></div>
                                <!-- 提示框2 end -->
                                <!-- 提示框3 begin -->
                                <div  class="font" style="margin-left:146px;margin-top:30px;"><b><font color="#656565">纳米大学科技园</font></b><a style="margin-left:195px;" href="__URL__/zaitidetail/carrierid/ffbddc6f-db1f-486e-a176-8ef05702aacf">详情>></a></div>
                                <div  class="font" style="margin-left:146px;margin-top:10px;"><font color="#656565">补贴企业：{$subsidy4} 家 </font><span style="margin-left:30px;"><font color="#656565">补贴面积：{$zaitisubsidyarea4/10000|format_money}万平米 </font></span></div>
                                <div  class="font" style="margin-left:146px;margin-top:8px;"><font color="#656565">已补贴金额：{$allowancesubsidized4/10000|format_money1} 万元 </font></div>
                                <div  class="font" style="margin-left:146px;margin-top:8px;"><font color="#656565">待补贴金额：{$daibusum4/10000|format_money1} 万元</font></div>  
                                </div>                                       
                                <!-- 提示框3 end -->
                                <!-- 提示框4 begin --> 
                                <div  class="font" style="margin-left:564px;margin-top:-290px;"><b><font color="#656565">纳米公司</font></b><a style="margin-left:230px;" href="__URL__/zaitidetail/carrierid/e97bd032-e477-4cdd-97d1-5ee6a17ac969">详情>></a></div>
                                <div  class="font" style="margin-left:564px;margin-top:10px;"><font color="#656565">补贴企业：{$subsidy3} 家</font><span style="margin-left:30px;"><font color="#656565">补贴面积：{$zaitisubsidyarea3/10000|format_money}万平米</font> </span></div>
                                <div  class="font" style="margin-left:564px;margin-top:8px;"><font color="#656565">已补贴金额：{$allowancesubsidized3/10000|format_money1} 万元</font> </div>
                                <div   class="font" style="margin-left:564px;margin-top:8px;"><font color="#656565">待补贴金额：{$daibusum3/10000|format_money1} 万元</font></div> 
                                </div> 
                                <!-- 提示框4 end -->
                                <div style="margin:190px 0px 0px 380px;font-family:'微软雅黑';background-color:#ececec;width:220px;padding:6px 12px 6px 12px;">如需了解其它载体详情，请点击以下链接</div>
                                <div style="margin:20px 0px 0px 105px;font-family:'微软雅黑';background-color:#ececec;width:30px;padding:6px 12px 6px 12px;"><a href="__URL__/zaitidetail/carrierid/e3d26888-7458-49ee-bdff-2e50851da994/">CSSD</a></div>
                                <div style="margin:-30px 0px 0px 170px;font-family:'微软雅黑';background-color:#ececec;width:72px;padding:6px 12px 6px 12px;"><a href="__URL__/zaitidetail/carrierid/8fdf5614-828d-473b-8b07-428971d3f40a/">科技招商中心</a></div>
                                <div style="margin:-30px 0px 0px 278px;font-family:'微软雅黑';background-color:#ececec;width:49px;padding:6px 12px 6px 12px;"><a href="__URL__/zaitidetail/carrierid/top9.19/">原点创投</a></div>
                                <div style="margin:-30px 0px 0px 363px;font-family:'微软雅黑';background-color:#ececec;width:50px;padding:6px 12px 6px 12px;"><a href="__URL__/zaitidetail/carrierid/top9.13/">斜塘街道</a></div>
                                <div style="margin:-30px 0px 0px 450px;font-family:'微软雅黑';background-color:#ececec;width:50px;padding:6px 12px 6px 12px;"><a href="__URL__/zaitidetail/carrierid/top9.11/">唯亭街道</a></div>
                                <div style="margin:-30px 0px 0px 537px;font-family:'微软雅黑';background-color:#ececec;width:60px;padding:6px 12px 6px 12px;"><a href="__URL__/zaitidetail/carrierid/top9.16/">苏大科技园</a></div> 
                                <div style="margin:-30px 0px 0px 633px;font-family:'微软雅黑';background-color:#ececec;width:50px;padding:6px 12px 6px 12px;"><a href="__URL__/zaitidetail/carrierid/19E7F926-C68C-45C1-B0E1-976F5A0202DA">育成中心</a></div>
                                <div style="margin:-30px 0px 0px 721px;font-family:'微软雅黑';background-color:#ececec;width:50px;padding:6px 12px 6px 12px;"><a href="__URL__/zaitidetail/carrierid/top9.10/">娄葑街道</a></div> 
                                <div style="margin:-30px 0px 0px 808px;font-family:'微软雅黑';background-color:#ececec;width:36px;padding:6px 12px 6px 12px;"><a href="__URL__/zaitidetail/carrierid/a740607b-c9f6-41e7-9d72-5cfd33c20931">招商局</a></div>    
                            </div>
                            <div class=".ui-box-noborder" style="margin:30px 0px 10px 0px;">
                        <div class="ui-box-head">
                            <h3 class="ui-box-head-title">享受房租补贴情况查询</h3>
                        </div>
                        <div class="ui-box-container">
                            <div  class="ui-grid-row">
                                <div class="ui-grid-13" style="margin:50px 0px 20px 50px;">
                                    <font style="font-size:16px;font-family:'微软雅黑';"> 企业查询：</font>
                                        <input placeholder="请输入企业名称或法定代表人" class="search_input" name="entername" style="width:300px;height:35px;border:2px solid #dcdcdc;font-size:14px;" type="text" />                  
                                     <input  id="seach_button" style="height:35px;width:80px;margin-left:10px;margin-bottom:3px;" type="button" class="ui-button ui-button-lwhite" value="搜索" onclick="serch()">
                                    
                                    <div style="margin:10px 0px 20px 100px;font-size:14px;font-family:'微软雅黑';">共收录享受房租补贴的企业{$epsum}家</div>
                                </div>
                                <div class="ui-grid-10">
                                    <div style="margin:40px 0px 0px 50px;font-size:20px;font-family:'微软雅黑';">享受房租补贴排名前三位企业</div>
                                    <div style="margin-left:50px;margin-top:15px;"><img alt="" src="../Public/img/1.png"><p style="margin-left:40px;margin-top:-30px;font-family:'微软雅黑';font-size:14px;"><a href="__APP__/Company/companyDetail/epid/{$toppereparray[0]["epid"]}"><font color="#000000">{$toppereparray[0]["entername"]}</font></a></p></div>
                                    <div style="margin-left:50px;margin-top:10px;"><img alt="" src="../Public/img/2.png"><p style="margin-left:40px;margin-top:-25px;font-family:'微软雅黑';font-size:14px;"><a href="__APP__/Company/companyDetail/epid/{$toppereparray[1]["epid"]}"><font color="#000000">{$toppereparray[1]["entername"]}</font></a></p></div>
                                    <div style="margin-left:50px;margin-top:10px;"><img alt="" src="../Public/img/3.png"><p style="margin-left:40px;margin-top:-25px;font-family:'微软雅黑';font-size:14px;margin-bottom:10px;"><a href="__APP__/Company/companyDetail/epid/{$toppereparray[2]["epid"]}"><font color="#000000">{$toppereparray[2]["entername"]}</font></a></p></div>
                                </div>
                            </div>
                        </div>
                    </div>

                        </div>
                    </div>  </div>
                    <!-- box2 end -->                        
                </div>  
                
            </div>
            <!-- 右布局 end -->
        </div>      
    </div>
    <!-- 左右布局 end -->
</body>
</html>