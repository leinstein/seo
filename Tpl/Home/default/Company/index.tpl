<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<style>
/*选择框风格*/
.select-bar{	width:640px; top:32px; left:160px; }
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
</style>
<script type="text/javascript">



</script>
</head>
<body>
	
	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner" />
	<!-- 页面顶部 logo & 菜单 end  -->
	
	<div class="wrapper">	
		<!-- 顶部栏目导航 begin -->
		<div  class="ui-grid-row">
			<div class="ui-grid-1">
				<img alt="" src="../Public/img/rent.png">
			</div>
			<div class="ui-grid-24">
				<div class="ui-page-title" style="font-size:22px;padding:6px 20px;">房租补贴专题</div>
			</div>
		</div>
		<!-- 顶部栏目导航 end -->

		<!-- box1 begin -->
		<div class="ui-box" style="margin:5px 0px 20px 0px">
			<div class="ui-box-head">
       			<h3 class="ui-box-head-title" style="font-size:18px;margin-top:3px;">总体情况</h3>
    		</div>
    		<div class="ui-box-container">
        	<div class="ui-box-content">
        		<div>图表</div>
        		<div>
        			<ul class="ui-list" style="type:disc;">
					    <li  style="margin:10px 10px 5px 100px;" class="ui-list-item">如何申请认证？</li>
					    <li style="margin:-25px 10px 5px 450px;"class="ui-list-item">如何提现？</li>
					    <li style="margin:10px 10px 5px 100px;" class="ui-list-item">如何提现？</li>
					</ul>
        		</div>	
        	</div>
    		</div>
		</div>
		<!-- box1 end -->	
		<!-- box2 begin -->
		<div class="ui-box" style="margin:55px 0px 20px 0px">
			<div class="ui-box-head">
       			<h3 class="ui-box-head-title" style="font-size:18px;margin-top:3px;">各载体房租补贴情况 </h3>
    		</div>
    		<div class="ui-box-container">
	        	<div class="ui-box-content" style="height:500px;width:990px; background: url(../Public/img/yuanqu.png) no-repeat center;background-size:800px 490px;">
	        		<!-- 提示框1 begin -->
	        		<div class="ui-poptip">
    					<div class="ui-poptip-shadow" style="background:none;">
        					<div class="ui-poptip-container" style="width:350px;height:91px;margin-top:100px;margin-left:100px;border: 3px solid #4A7EBB;background-color:#ffffff">
            					<div class="ui-poptip-arrow ui-poptip-arrow-5" style="margin-right:180px;">
                				<em style="border-top-color:#4A7EBB;"></em>
                				<span style="border-top-color:#4A7EBB;"></span>
            					</div>
           					 	<div class="ui-poptip-content pointer" onclick="window.open('__URL__/zaitidetail/carrierid/42bbc61a-a92a-4e16-90ee-a6e0c8017376','_self')" style="color:#003366;">
              						<div><b>科技公司</b></div>
              						<div style="margin-top:4px;">入驻企业：{$count1} 家</div>
              						<div style="margin-top:4px;">补贴企业：{$subsidy1} 家 <span style="margin-left:70px;">补贴面积：</span></div>
					                <div style="margin-top:4px;">已补贴金额：{$allowancesubsidized1|format_money1} 万元<span style="margin-left:20px;">待补贴金额：{$daibusum1|format_money1} 万元</span></div>
					            </div>
					        </div>
					    </div>
					</div>
					<!-- 提示框1 end -->
					<!-- 提示框2 begin -->
	        		<div class="ui-poptip" >
    					<div class="ui-poptip-shadow" style="background:none;">
        					<div class="ui-poptip-container" style="width:350px;height:91px;margin-top:140px;margin-left:100px;border: 3px solid #8064A2;background-color:#ffffff">
            					<div class="ui-poptip-arrow ui-poptip-arrow-1" style="margin-right:20px;">
                				<em style="border-top-color:#8064A2;"></em>
                				<span style="border-bottom-color:#8064A2;"></span>
            					</div>
           					 	<div class="ui-poptip-content pointer" onclick="window.open('__URL__/zaitidetail/carrierid/91442159-441b-45ad-a3c5-2c433f3b7bae','_self')" style="color:#800080;">
              						<div><b>生物公司</b></div>
              						<div style="margin-top:4px;">入驻企业: {$count2} 家</div>
              						<div style="margin-top:4px;">补贴企业: {$subsidy2} 家 <span style="margin-left:70px;">补贴面积：</span></div>
					                <div style="margin-top:4px;">已补贴金额：{$allowancesubsidized2|format_money1} 万元<span style="margin-left:30px;">待补贴金额：{$daibusum2|format_money1} 万元</span></div>
					            </div>
					        </div>
					    </div>
					</div>
					<!-- 提示框2 end -->
					<!-- 提示框3 begin -->
	        		<div class="ui-poptip" >
    					<div class="ui-poptip-shadow" style="background:none;">
        					<div class="ui-poptip-container" style="width:350px;height:91px;margin-top:-400px;margin-left:500px;border: 3px solid #C0504D;background-color:#ffffff">
            					<div class="ui-poptip-arrow ui-poptip-arrow-7" style="margin-right:20px;">
                				<em style="border-top-color:#C0504D;"></em>
                				<span style="border-top-color:#C0504D;"></span>
            					</div>
           					 	<div class="ui-poptip-content pointer" onclick="window.open('__URL__/zaitidetail/carrierid/e97bd032-e477-4cdd-97d1-5ee6a17ac969','_self')" style="color:#FF0000;">
              						<div><b>纳米公司</b></div>
              						<div style="margin-top:4px;">入驻企业：{$count3} 家</div>
              						<div style="margin-top:4px;">补贴企业：{$subsidy3} 家 <span style="margin-left:70px;">补贴面积：</span></div>
					                <div style="margin-top:4px;">已补贴金额：{$allowancesubsidized3|format_money1} 万元<span style="margin-left:30px;">待补贴金额：{$daibusum3|format_money1} 万元</span></div>
					            </div>
					        </div>
					    </div>
					</div>
					<!-- 提示框3 end -->
					<!-- 提示框4 begin -->
	        		<div class="ui-poptip" >
    					<div class="ui-poptip-shadow" style="background:none;">
        					<div class="ui-poptip-container" style="width:350px;height:91px;margin-top:-180px;margin-left:500px;border: 3px solid #4BACC6;background-color:#ffffff">
            					<div class="ui-poptip-arrow ui-poptip-arrow-10" style="margin-right:20px;">
                				<em style="border-right-color:#4BACC6;"></em>
                				<span style="border-right-color:#4BACC6;"></span>
            					</div>
           					 	<div class="ui-poptip-content pointer" onclick="window.open('__URL__/zaitidetail/carrierid/ffbddc6f-db1f-486e-a176-8ef05702aacf','_self')" style="color:#33CCCC;">
              						<div><b>高教区</b></div>
              						<div style="margin-top:4px;">入驻企业：{$count4} 家</div>
              						<div style="margin-top:4px;">补贴企业：{$subsidy4} 家 <span style="margin-left:70px;">补贴面积：</span></div>
					                <div style="margin-top:4px;">已补贴金额：{$allowancesubsidized4|format_money1} 万元<span style="margin-left:30px;">待补贴金额：{$daibusum4|format_money1} 万元</span></div>
					            </div>
					        </div>
					    </div>
					</div>
					<!-- 提示框4 end -->
	        	</div>
    		</div>
		</div>	
		<!-- box2 end -->
		<!-- box3 begin -->
		<div class="ui-box" style="margin:55px 0px 20px 0px;">
			<div class="ui-box-head">
       			<h3 class="ui-box-head-title" style="font-size:18px;margin-top:3px;">享受房租补贴情况查询</h3>
    		</div>
    		<div class="ui-box-container">
	        	<div  class="ui-grid-row">
					<div class="ui-grid-13" style="margin:40px 0px 20px 50px;">
						<form style="font-size:18px;" action="__URL__" method="get">		
						<input type="hidden" name="m" value="Company"/>
						<input type="hidden" name="a" value="adcompany"/>					   企业查询：<input style="width:300px;height:35px;border:2px solid #dcdcdc;" type="text"  name="t1" />						
           				 <input style="height:35px;width:80px;margin-left:10px;margin-bottom:3px; border:2px solid #dcdcdc;" type="submit" class="ui-button ui-button-swhite" value="搜索" onclick=" search()" >
						</form>
                        <div style="margin:10px 0px 20px 100px;font-size:14px;">共收录享受房租补贴的企业  家，享受补贴的房屋  个</div>
					</div>
					<div class="ui-grid-10">
						<div style="margin:10px 0px 0px 50px;font-size:20px;">享受房租补贴排名前三位企业</div>
						<div style="margin-left:50px;"><img alt="" src="../Public/img/1.png"></div>
						<div style="margin-left:50px;"><img alt="" src="../Public/img/2.png"></div>
						<div style="margin-left:50px;"><img alt="" src="../Public/img/3.png"></div>
					</div>
				</div>
    		</div>
		</div>
		<!-- box3 end -->	
	</div>
</body>
</html>