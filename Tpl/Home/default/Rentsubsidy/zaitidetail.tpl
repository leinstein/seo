 <!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<style>
.ui-table {
    margin-top:40px;
    padding:35px 9px 7px;
    border-bottom:1px solid #d9d9d9;
    height:10px;
}
.table-font{
	font-size: 14px;
}
</style>
<script src="__PUBLIC__/js/echarts-all.js"></script>
<script>
    //加载
    $(function(){
        var myChart = echarts.init(document.getElementById("main2"), 'macarons');  
        var option = {
    tooltip : {
        trigger: 'axis',
        axisPointer : {           
            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
        },
    },
    toolbox: {
        show : true,
        feature : {
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    legend: {
        data:['补贴金额（万元）','企业数量（家）']

    },
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
         data : [{$yearnumberstr}]
        }
    ],
    yAxis : [
        { show: true,
       		/*min: 0,
            max: 4800,*/
            type : 'value',
            name : '金额',
            axisLabel : {
                formatter: '{value}万元'
            }
        },
        { show: true,
            type : 'value',
          /*min: 0,
            max: 400,*/
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
            data:[{$epmoneystr}]
        },

        {
            name:'企业数量（家）',
            type:'line',
            yAxisIndex: 1,
            data:[{$epnumstr}]

        }
    ]
};
        myChart.setOption(option);              
    });
</script>
<script>
    //加载
    $(function(){
        var zhaoshangnum = "{$staimgarr[0]}";
        var kezhaonum = "{$staimgarr[1]}";
        var zaitinum = "{$staimgarr[2]}";
        var othernum="{$staimgarr[3]}";
        var myChart = echarts.init(document.getElementById("main1"), 'macarons');  
        var option = {
    tooltip : {
        trigger: 'item',
        formatter: "{a}  ({d}%)"
    },
    toolbox: {
        show : true,
        x: 'right',               
        y: 'center',                              
    },
    calculable : true,
    series : [
        {
            name:'招商部门分布',
            type:'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:kezhaonum, name:'科技招商中心'},
                {value:zhaoshangnum, name:'招商局'},
                {value:zaitinum, name:'本载体'},
                {value:othernum, name:'其它'}
            ]
        }
    ]
};
        myChart.setOption(option);              
    });
</script>
<script type="text/javascript">
$(function(){

	//JS监听某个div
	 $(".search_input").bind("keydown",function(e){
       	 	// 兼容FF和IE和Opera    
    		var theEvent = e || window.event;    
    		var code = theEvent.keyCode || theEvent.which || theEvent.charCode;    
    		if (code == 13) {    
		        	//回车执行查询
		            $("#search_button").click();
	        }    
	});
});
function queryAll(){
	var date1 = $("select[name='date1']").val();
	var date2 = $("select[name='date2']").val();
	var url = URL + "/zaitidetail/carrierid/{$_GET['carrierid']}/date1/" + date1 + "/date2/" + date2;
	window.location.href = url;
}
</script>
</head>
<body>
	
	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner" />
	<!-- 页面顶部 logo & 菜单 end  -->
	<div class="wrapper">
		<!-- box1 begin -->	
			<div class="ui-box">
				<div class="ui-box-head">
	       			<h3 class="ui-box-head-title" >各载体房租补贴情况   &nbsp;&nbsp;{$carriername}</h3>
	       			<a href="__APP__/Rentsubsidy/index" class="ui-box-head-more">返回</a>
	    		</div>
	    		<div class="ui-box-container">
	        	<div class="ui-box-content">
	        		<div  class="ui-grid-row">
		        		<!--  入驻企业房租补贴情况 begin-->
		        		<!-- 左布局 begin -->
		        		<div  class="ui-grid-10" style="margin:5px 5px 5px 10px;">
		        			<img alt="" src="../Public/img/title.png">
		        			<div style="margin:-29px 5px 5px 20px;font-size:14px;">入驻企业房租补贴情况</div>
		        			<div class="ui-table-container" style="margin-left:40px;">
							    <table class="ui-table ui-table-inbox">
							        <tbody>
							            <tr>
							                <td class="table-font">补贴企业数 </td>
							                <td class="table-font">{$zaitisubsidynum} 家</td>
							            </tr>
							            <tr>
							                <td class="table-font">补贴面积</td>
							                <td class="table-font">{$zaitisubsidyarea/10000|format_money1} 万平米</td>
							            </tr>
							            <tr>
							                <td class="table-font">已补贴金额</td>
							                <td class="table-font">{$zaitisubsidysum/10000|format_money1} 万元</td>
							            </tr>						            
							            <tr>
							                <td class="table-font">待补贴金额</td>
							                <td class="table-font">{$daibusum/10000|format_money1} 万元</td>
							            </tr>
							        </tbody>
							    </table>
							</div>
						</div>
						<!-- 左布局 end -->
						<!-- 右布局 begin -->
                                             
    						<div class="ui-grid-12" style="margin:5px 5px 5px 10px;">
                                 <if condition="($_GET['carrierid'] neq '8fdf5614-828d-473b-8b07-428971d3f40a') AND ($_GET['carrierid'] neq 'a740607b-c9f6-41e7-9d72-5cfd33c20931') ">  
    							<div style="padding:20px 0px 0px 100px;">按招商部门统计：</div>
    							<div id="main1" style="width:400px;height:300px;margin-left:150px;margin-top:-60px;"> </div> 
                                </if>
    						</div>
                        
						<!-- 右布局 end -->
						<!--  入驻企业房租补贴情况 end-->						
		        	</div>		        		
						<!-- 历年补贴情况 begin -->
						<div style="margin:30px 5px 5px 10px;">
							<img alt="" src="../Public/img/title.png">
		        			<div style="margin:-29px 5px 5px 20px;font-size:14px;">历年补贴情况</div>
		        			<div style="margin-top:30px;margin-left:45px;">
			        			<ul>
			        				<li class="a-key"><span>年度选择： </span>  
									<select name="date1" style="width:80px;height:23px;">
									  <option value="2011" <if condition="$_GET['date1']==''||$_GET['date1']=='%'||$_GET['date2']=='2011'">selected="selected"</if>>2011</option>
									  <option value="2012" <if condition="$_GET['date1']=='2012'">selected ="selected"</if>>2012</option>
									  <option value="2013" <if condition="$_GET['date1']=='2013'">selected ="selected"</if>>2013</option>
									  <option value="2014" <if condition="$_GET['date1']=='2014'">selected ="selected"</if>>2014</option>
                                      <option value="2015" <if condition="$_GET['date1']=='2015'">selected ="selected"</if>>2015</option>
									</select> 
									至
									<select name="date2" style="width:80px;height:23px;">
									  <option value="2015" <if condition="$_GET['date2']==''||$_GET['date2']=='%'||$_GET['date2']=='2015'">selected ="selected"</if>>2015</option>
                                      <option value="2014" <if condition="$_GET['date2']=='2014'">selected ="selected"</if>>2014</option>
									  <option value="2013" <if condition="$_GET['date2']=='2013'">selected ="selected"</if>>2013</option>
									  <option value="2012"  <if condition="$_GET['date2']=='2012'">selected ="selected"</if>>2012</option>
									  <option value="2011"  <if condition="$_GET['date2']=='2011'">selected ="selected"</if>>2011</option>
									</select>
									<span style="margin-left:10px;"><input type="button" class="ui-button ui-button-sblue" value="确定" onclick="queryAll()"></span></li>
			        			</ul>
		        			</div>
		        			<!-- 图表 begin -->
		        			<div id="main2" style="width:800px;height:400px;margin-left:40px;margin-top:20px;"></div>
		        			<!-- 图表 end -->
						</div>
						<!-- 历年补贴情况 end -->
	        	</div>
	    		</div>
			</div>
		<!-- box1 end -->					
	</div>
</body>
</html>