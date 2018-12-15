<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<style>
/*选择框风格*/
.select-bar{	width:580px; height:300px; top:32px; left:220px; overflow-y: auto; overflow-x:hidden; }
</style>
</head>
<body>
	
	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner" />
	<!-- 页面顶部 logo & 菜单 end  -->
	
	<div class="wrapper">	
	     	<!-- 右布局 begin -->
			<div class="ui-grid-25">
		        <!--  顶部的查询条件 begin -->
				<div class="ui-box  shadow">
					<div class="ui-box-head">
						<div class="ui-box-head-border">
							<h3 class="ui-box-head-title">按企业查询享受房租补贴情况 </h3>
							<span class="ui-box-head-text"></span><a href="__APP__/Rentsubsidy/index" class="ui-box-head-more">返回首页</a>
							<span class="ui-box-head-text"></span> <a class="ui-box-head-more" href="__URL__/adcompany" >清除所有条件&nbsp;&nbsp;</a>
						</div>
					</div>
					<div class="ui-box-container">
						<ul class="ui-list ui-list-query">
							<li class="ui-list-item last">
								<div class="param-container">
									<div class="param-cont">
										<form name="form" method="get" action="__URL__">
											<input type="hidden" name="m" value="Company"/>
											<input type="hidden" name="a" value="adcompany"/>
											<input type="hidden" name="t1" value="{$_GET['t1']}"/>
											<input type="hidden" name="t2" value="{$_GET['t2']}"/>
											<input type="hidden" name="t3" value="{$_GET['t3']}"/>
											<input type="hidden" name="t4" value="{$_GET['t4']}"/>
											<input type="hidden" name="t5" value="{$_GET['t5']}"/>
											<input type="hidden" name="t6" value="{$_GET['t6']}"/>
											<input type="hidden" name="t7" value="{$_GET['t7']}"/>											
											<input type="hidden" name="ord" value="{$_GET['ord']}"/>
											<label class="param-label" >企业名称/法定代表人： </label>
										<!-- 	<input type="text"  class="ui-input-small" style="width: 150px;" name="t1" value="{$_GET['t1']}"/> -->
											<input type="text" class="ui-input-small" style="margin-left:60px;width: 190px;" name="t1" value="{$_GET['t1']}">
											&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="param-label" style="margin-left:34px;">补贴期间： </label>
											<input type="text" class="ui-input-small" style="width:80px;" name="t2" value="{$_GET['t2']}"  onClick="WdatePicker()"/>
											<label class="param-label">至</label>
											<input type="text" class="ui-input-small" style="width:80px;" name="t3" value="{$_GET['t3']}" onClick="WdatePicker()"/>
											<label class="param-label"></label><br/></div>
											<div class="param-cont">
											<label class="param-label">已补贴金额（万元）： </label>
											<input type="text" class="ui-input-small" style="width:80px;margin-left:65px;" name="t4" value="{$_GET['t4']}"/>
											<label class="param-label">至</label>
											<input type="text" class="ui-input-small" style="width:80px;" name="t5" value="{$_GET['t5']}"/>
											
											<label class="param-label" style="margin-left:45px;">补贴面积： </label>
											<input type="text" class="ui-input-small" style="width:80px;" name="t6" value="{$_GET['t6']}"/>
											<label class="param-label">至</label>
											<input type="text" class="ui-input-small" style="width:80px;" name="t7" value="{$_GET['t7']}"/>
											
											<label class="param-label"  ></label>
											<input type="submit" class="ui-button ui-button-sblue" value="查询">
										</form>
									</div> 
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!--  顶部的查询条件 end -->
				
				<!-- 信息提示 begin  -->
			    <div class="ui-banner">
			    	<span class="ui-banner-text">共有 <span class="c_red b">{$Companys['count']}</span> 个符合条件的结果<eq name="searchepdir" value="true">(您选择了包含企业属性的搜索条件，系统将会过滤掉没有关联企业的数据)</eq> ，清单如下</span> 		    	
			    </div>
				<!-- 信息提示  end -->
				
				<!-- 排序工具 begin  -->
				<div class="ui-box mt10  shadow">
				    
				</div>
				<!-- 排序工具 end -->
				
				<!--  查询结果 begin -->				
				<div class="ui-table-container  shadow">
				    <table class="ui-table ui-table-follow">
				        <thead>
				            <tr>
				                <th width="30%">企业名称</th>
				                <th width="15%">补贴面积（㎡）</th>
				                <th width="20%">补贴期间</th>
				                <th width="15%"> 已补贴金额（万元）</th>
				                <th width="15%">待补贴金额（万元）</th>	 
				                <th width="5%"> 操作</th>    				                             
				            </tr>
				        </thead><!-- 表头可选 -->
				        <tbody>
				        	<volist name="Companys['data']" id="vo" mod="2">
				        	<eq name="mod" value="0">
			                  <tr>
				            <else/>
				            <tr class="ui-table-split" style="z-index:2;">
				            </eq>
				                <td>{$vo.epname}</td>
				                <td>{$vo.mallowancearea}</td>
				                <td>{$vo.mpreferentialstardate|format_date='Ymd'} - {$vo.mpreferentialenddate|format_date='Ymd'}</td>
				                <td align="right" style="padding-right:50px;"><if condition="$vo['mallowancesubsidized']">{$vo['mallowancesubsidized']/10000|format_money4}</if></td>
				                <td align="right" style="padding-right:50px;">{$vo['mallowancesubsidizing']/10000|format_money4}</td>			               
				                <td><a href="__URL__/companyDetail/epid/{$vo.epid}">详情</a></td>		              
				            </tr>
				            </volist>
				        </tbody>
				        <tfoot>
				            <tr>
				                <td colspan="6">
								    <if condition="$Companys['html']">
								    <div class="ui-paging">
								    {$Companys['html']}
								    <else />
								    <div align="center">
								    暂无数据
								    </if>
								    </div>
								</td>
				            </tr>
				        </tfoot><!-- 表尾可选 -->
				    </table>
				</div>
				<!--  查询结果 end -->			
			</div>
			<!-- 右布局 end -->
	</div>
</body>
</html>