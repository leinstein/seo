
	<div class="ui-box {$statisticsStyle}  {$style}" id="{$type}">
		<div class="ui-box-head">
			<div class="ui-box-head-border">
				<h3 class="ui-box-head-title">{$title}</h3>
				<span class="ui-box-head-text"></span> 
				<eq name="page" value ="index">
				
				    <switch name="ACTION_NAME" >
					    <case value="techfunds">
					  		<a href="__URL__/techfundsDetail/type/{$type}/title/{$title|urlencode}#{$type}" class="ui-box-head-more-img"><img src="../Public/img/countanalyse/launch.png"></a>
					    </case>
					    <case value="nanometer">
							<a href="__URL__/nanometerDetail/type/{$type}/title/{$title|urlencode}#{$type}" class="ui-box-head-more-img"><img src="../Public/img/countanalyse/launch.png"></a>
						</case>
				   		<default />
				    </switch>
				    
				<else/>
							
				<a href="__URL__/index/actionName/{$Think.ACTION_NAME}#{$type}" class="ui-box-head-more-img"><img src="../Public/img/countanalyse/together.png"></a>
				</eq>
			</div>
		</div>
		
		<div class="ui-box-container">
			<if condition="$type != 'enterNum' AND $type != 'assets'"> 
			<neq name = "page" value="index"> 
			<form>
				<ul class="ui-list ui-list-query">
					<eq name="type" value ="year">
					<li class="ui-list-item">
						<div class="ui-list-item-head">业务类型：</div>
						<div class="ui-list-item-body">
							<div class="param-cont">
								<!-- <html:select id="businesstype" name="businesstype" options = "BusinesstypeOptions" selected="businesstypeid" first="全部业务类型" change="showQueryField(this)"/> -->
								<select id="businesstype" name="businesstype" >
									<option value="" <empty name="businesstypeid"> selected="selected" </empty>>全部业务类型</option>	
									<volist name="BusinesstypeOptions" id="vo">
									<option value="{$key}" <eq name="businesstypeid" value="$key"> selected="selected" </eq>>{$vo}</option>	
									</volist>
								</select>
							</div> 
						</div>
						<div class="ui-list-item-tail"></div>
					</li>
					</eq>
					
					<li class="ui-list-item">
						<div class="ui-list-item-head">年度选择：</div>
						<div class="ui-list-item-body">
							<div class="param-cont">
								<neq name="type" value="budgetexec"> 
								<!-- <input type="text" name="year1" id="year1" value="{$_GET['year1']}" class="Wdate"  onFocus="WdatePicker({dateFmt:'yyyy',maxDate:'#F{$dp.$D(year2)}'})" style="width: 100px;"/>&nbsp;&nbsp; -->
								<input type="text" name="year1" id="year1" value="{$_GET['year1']}" class="Wdate"  onFocus=WdatePicker({dateFmt:'yyyy',maxDate:"#F{$dp.$D('year2')||'$'}"}) style="width: 100px;"/>&nbsp;&nbsp;
								至&nbsp;&nbsp;
								<input type="text" name="year2" id="year2" value="{$_GET['year2']}" class="Wdate"  onFocus=WdatePicker({dateFmt:'yyyy',minDate:"#F{$dp.$D('year1')}",maxDate:'$'}) style="width: 100px;"/>&nbsp;&nbsp;
								<else/>
								<select id="year" name="year" onchange="query()">
									<volist name="YearOptions" id="vo">
									<option value="{$vo}" <eq name="_GET['year']" value = "$vo"> selected="selected" </eq>>{$vo}</option>	
									</volist>
								</select>
								
								<!-- <html:select id="year" name="year" options = "YearOptions" selected="_GET['year']"  change="query()"/> -->
								</neq>
							</div> 
						</div>
						<div class="ui-list-item-tail"></div>
					</li>
					
					<li class="ui-list-item last" style="text-align: center;">
						<div class="param-container">
							<div class="param-cont">
								<neq name="type" value="budgetexec"> 
								<input type="button" class="ui-button ui-button-sblue" value="查询" onclick="query()">
								</neq>
							</div> 
						</div>
					</li>
				</ul>
			</form>			
			</neq>
			</if>
			
			<div style="margin: 0 auto;text-align: right;font-size: 16px;margin-bottom: 20px;display: none">
				<form name="chartType_form" method="post" action="__URL__/doChangeChartType">
				<select name="chartType" id="chartType" onchange="document.chartType_form.submit()" style="font-weight: bold;padding: 5px;" >
					<neq name="data['statisticstype']" value="businesstype">
					<option value="MSColumn2D">柱形图</option>
					<option value="MSColumn3D">三维柱形图</option>
					<option value="MSLine2D">折线图</option>
					<!-- <option value="MSLine3D">三维折线图</option> -->
					
					<option value="Pie2D">饼状图</option>
					<option value="Pie3D">三维饼状图</option>
					<else/>
					<option value="MSColumn2D_all">柱形图</option>
					<option value="MSColumn3D_all">三维柱形图</option>
					<option value="Pie2D_all">饼状图</option>
					<option value="Pie3D_all">三维饼状图</option>
					</neq>
				</select>
				
				
				<div>
					<input type="hidden" name="title" value="{$data['title']}">
					<input type="hidden" name="statisticstype" value="{$data['statisticstype']}">
					<input type="hidden" name="statisticsdata"  id="statisticsdata" value="{$data['statistics_data']}">
					<input type="hidden" name="curbusinessstage"  id="curbusinessstage" value="{$Think.get.curbusinessstage}">
					
				
					<!-- <a><span class="btn_rounded mid"  style="" onclick="document.chartType_form.submit()">保 存</span> </a> -->
				</div>
				</form>
			</div>
			
			
			
			<!-- 图表区域 begin  -->
			<div class="clear"></div>
			<div class="statistics-chart">
				<notempty name="data['desc']">
				<div class="prompt-box" <eq name="page" value ="detail"> style="height:{$prompt_box_height}px;"</eq>>
					{$data['desc']|default="&nbsp;"}
				</div>
				</notempty>
				<!-- 如果是预算执行分析 就使用js进行生成图表 不用 该工具  -->
				<eq name="type" value="budgetexec"> 
					<table class="budgetexec-chart">
						<tr>
							<td class="nodename"></td>
							<td class="color-block" style="border: none;"></td>
							
							<!--已兑现 begin-->
							<td class="w1">
								<span class="b">已兑现</span>
							</td>
							<!--已兑现 end-->
							
							<td class="w2">	
								<span class="b">/</span>
							</td>
							<!--预算 begin-->
							<td class="w3">	
								<span class="b">预&nbsp;&nbsp;&nbsp;算</span>
							</td>	
							<!--预算 end-->
							<!--（占比） begin-->
							<td class="w4 hide">	
								<span class="b">(占比)</span> 
							</td>
							<!--（占比） end-->
						</tr>
						<notempty name="data['fact']['data']">
						<volist name="data['fact']['data']" id="fact">
						<tr>
							<td class="nodename" align="right">{$fact['nodename']}</td>
							<td class="color-block">
								<span class="color-fact" style="width:{$fact['width']}px;" title="{$fact['nodename']}已兑现{$fact['sumAppramount']}亿">
								&nbsp;
								</span>
								<gt name="fact['difference']" value='0'>
								<span class="color" style="width:{$fact['difference']}px;" title="{$data['budget']['data'][$key]['nodename']}预算为{$data['budget']['data'][$key]['sumAppramount']}亿">
								
								&nbsp;
								
								</span>
								</gt>
							</td>
							<!--已兑现 begin-->
							<td class="w1">
									{$fact['sumAppramount']|format_money1}亿
							</td>
							<!--已兑现 end-->
							
							<td class="w2">	
								/
							</td>
							<!--预算 begin-->
							<td class="w3">	
								{$data['budget']['data'][$key]['sumAppramount']|format_money1}亿
							</td>	
							<!--预算 end-->
							<!--（占比） begin-->
							<td class="w4 hide">	
								({$fact['ratio']}%)
							</td>
							<!--（占比） end-->
							<!-- <td class="desc">
								已兑现 begin
								
								<span class="w1">{$fact['sumAppramount']|format_money1}亿</span>
								
								已兑现 end
								
								<span class="w2">/</span>
								
								预算 begin
								<span class="w3">{$data['budget']['data'][$key]['sumAppramount']|format_money1}亿</span>
								预算 end
								
								（占比） begin
								<span class="w4">({$fact['ratio']}%)</span> 
								（占比） end
							</td> -->
						</tr>
						</volist>
						</notempty>
					</table>
				
					<ul class="budgetexec-chart hide">
						<li style="">
							<span class="nodename"></span>
							<span class="color-block" style="border: none;">
								<span>
								&nbsp;
								</span>
							</span>
								
							<div class="fr">
								<!--已兑现 begin-->
								<span class="w1 f14 b">已兑现</span>
								<!--已兑现 end-->
								
								<span class="w2 f14 b">/</span>
								
								<!--预算 begin-->
								<span class="w3 f14 b">预算</span>
								<!--预算 end-->
								
								<!--（占比） begin-->
								<!-- <span class="w4 f14 b hide" >(占比)</span> -->
								<!--（占比） end-->
							</div>
						</li>
						<notempty name="data['fact']['data']">
						<volist name="data['fact']['data']" id="fact">
						<li>
							<span class="nodename">{$fact['nodename']}</span>
							<span class="color-block">
								<span class="color-fact" style="width:{$fact['width']}px;" title="{$fact['nodename']}已兑现{$fact['sumAppramount']}亿">
								&nbsp;
								</span>
								<gt name="fact['difference']" value='0'>
								<span class="color" style="width:{$fact['difference']}px;" title="{$data['budget']['data'][$key]['nodename']}预算为{$data['budget']['data'][$key]['sumAppramount']}亿">
								
								&nbsp;
								
								</span>
								</gt>
							</span>
							
							<div class="fr">
								<!--已兑现 begin-->
								
								<span class="w1">{$fact['sumAppramount']|format_money1}亿</span>
								
								<!--已兑现 end-->
								
								<span class="w2">/</span>
								
								<!--预算 begin-->
								<span class="w3">{$data['budget']['data'][$key]['sumAppramount']|format_money1}亿</span>
								<!--预算 end-->
								
								<!--（占比） begin-->
								<!-- <span class="w4 hide">({$fact['ratio']}%)</span> -->
								<!--（占比） end-->
							</div>	
						</li>
						</volist>
						<else/>
						<li class="nodata">
							暂无相关图表数据
						</li>
						</notempty>
					</ul>
					<div class="clear"></div>
				
				<else/>
					<!-- 如果是饼图 就加上特殊样式  -->
					<if condition="strpos($data['charttype'],'Pie') === 0">
					<div class="{$pie_style}">
					<else/>
					<div style="text-align: center ;margin: 0 auto;">
					</if>
					
					
					<!-- 图表 begin  -->
					{$statisticsChart['showchart']}
					<!-- 图表 end  -->
					</div>
					<if condition="strpos($data['charttype'],'Pie') === 0">
					<!-- 色块文字提示 begin  -->
					<neq name="statisticsChart['isShowColorsBlock']" value="no">
					<div  class="{$color_block_style}" >
						<table>
							<tbody>
								<volist name="statisticsChart['colors']" id="vo1">
								<tr height="20px;">
									<td valign="middle" align="center" width="15" height="10px">
										<div style="background-color:{$vo1};" class="color">&nbsp;</div>
									</td>
									<td valign="middle" align="left" width="5" height="10px">&nbsp;</td>
									<td align="left">{$key}</td>
									<td valign="middle" align="left" width="5" height="10px">&nbsp;</td>
									<td align="right" style="white-space: nowrap;">
										{$data['numberPrefix']}
										<eq name="data['showType']" value="money">
										{$statisticsChart['values'][$key]|format_money1}
										<else/>
										{$statisticsChart['values'][$key]}
										</eq>
										{$data['numberSuffix']|default="万"}
									</td>
								</tr>
								</volist>						
							</tbody>
						</table>
					</div>
					<div class="clear"></div>
					</neq>
					</if>
					<!-- 色块文字提示 end  -->
				</eq>
					
				
			
				<!--  标题- begin --> 
				<h2 class="statistics-title">
					{$data['title']}
				</h2>
				<!--  标题- end --> 
				
			</div>
			<!-- 图表区域 end  -->
			
			
		</div>
	</div>
	
	
	
		
	<script>
	//初始化当前页面
 	
 	//页面加载执行
 	$(document).ready(function(){
 		$("#businesstype").val('{$Think.get.fundtypeid}');
 	}); 
	
	function query(){
		var type = '{$type}';
		//根据不同的交易来判断查询的交易
		var func = "nanometerDetail";
		var url = "";
		switch ("{$Think.ACTION_NAME}"){
			case "techfunds":
			case "techfundsDetail":
				func = "techfundsDetail";
				
				break;
			case "nanometer":
			case "nanometerDetail":	
				func = "nanometerDetail";
				
				break;		
				
		} 
	   
		if(type == "budgetexec"){
			var year = $("#year").val();
			url = URL +"/"+func +"/actionName/{$Think.ACTION_NAME}/type/{$type}/title/{$title|urlencode}/year/" + year;
		}else{
			
			var year1 = $("#year1").val();
			var year2 = $("#year2").val();
			url = URL +"/" + func + "/actionName/{$Think.ACTION_NAME}/type/{$type}/title/{$title|urlencode}/year1/" + year1 + "/year2/" + year2;
			
			if(type =="year"){
				var fundtypeid 	= $("#businesstype").val();
				var fundtype 	= $.trim($("#businesstype option:selected").text());
				if(!fundtypeid )
					fundtype = '';
				
				url += "/fundtypeid/" + fundtypeid +  "/fundtype/" + fundtype;
			}
		}
		
		url +=  "#"+type;
		window.location.href = url;
		
	}
	</script>	
	