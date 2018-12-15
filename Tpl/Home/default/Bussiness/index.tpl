<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<style>
/*选择框风格*/
.select-bar{	width:640px; top:32px; left:160px; }
</style>
</head>
<body>
	
	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner" />
	<!-- 页面顶部 logo & 菜单 end  -->
	
	<div class="wrapper">	
		<div class="ui-grid-row">			
			<!-- 右布局 begin -->
			<div class="ui-grid-25">
				
				<!--  顶部的查询条件 begin -->
				<div class="ui-box shadow">
					<div class="ui-box-head">
						<div class="ui-box-head-border">
							<h3 class="ui-box-head-title">房租补贴业务查询</h3>
							<span class="ui-box-head-text"></span><a href="__APP__/Rentsubsidy/index" class="ui-box-head-more">返回首页</a>
							<span class="ui-box-head-text"></span> <a  class="ui-box-head-more"  href="__URL__/index" >清除所有条件&nbsp;&nbsp;</a>
							
						</div>
					</div>
					<div class="ui-box-container">
						<ul class="ui-list ui-list-query">
							<li class="ui-list-item">
								<div class="ui-list-item-head">年度：</div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/p02/%/" class="item-param <if condition="$_GET['p02']==''||$_GET['p02']=='%'">selected</if>">不限</a>
										<volist name="Houserentprameter['p02']" id="v">
											<a href="__URL__/index{$query_params}/p02/{$v.batchyear}" class="item-param  <eq name="Think.get.p02" value="$v.batchyear">selected</eq>">{$v.batchyear}年</a>
										</volist>
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
					<!-- 		<li class="ui-list-item">
								<div class="ui-list-item-head">载体：</div>
								<div class="ui-list-item-body item-2-line">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/p03/%/" class="item-param <if condition="$_GET['p03']==''||$_GET['p03']=='%'">selected</if>">不限</a>
										<volist name="Houserentprameter['p03']" id="v">
											<a href="__URL__/index{$query_params}/p03/{$v.carrier}" class="item-param  <eq name="Think.get.p03" value="$v.carrier">selected</eq>">{$v.carrier}</a>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li> -->
							<li class="ui-list-item">
								<div class="ui-list-item-head">招商部门：</div>
								<div class="ui-list-item-body item-2-line">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/p04/%/" class="item-param <if condition="$_GET['p04']==''||$_GET['p04']=='%'">selected</if>">不限</a>
										<volist name="Houserentprameter['p04']" id="v">
											<a href="__URL__/index{$query_params}/p04/{$v.partment}" class="item-param  <eq name="Think.get.p04" value="$v.partment">selected</eq>">{$v.partment}</a>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li> 
							<li class="ui-list-item last">
								<div class="param-container">
									<div class="param-cont">
										<form name="form" method="get" action="__URL__">
											<input type="hidden" name="m" value="Bussiness"/>
											<input type="hidden" name="a" value="index"/>
											<input type="hidden" name="k03" value="{$_GET['k03']}"/>
											<input type="hidden" name="k04" value="{$_GET['k04']}"/>
											<input type="hidden" name="k06" value="{$_GET['k06']}"/>
											<input type="hidden" name="k01" value="{$_GET['k01']}"/>
											<input type="hidden" name="p01" value="{$_GET['p01']}"/>
											<input type="hidden" name="p02" value="{$_GET['p02']}"/>
											<input type="hidden" name="p03" value="{$_GET['p03']}"/>
											<input type="hidden" name="p04" value="{$_GET['p04']}"/>
											<input type="hidden" name="t1" value="{$_GET['t1']}"/>
											<input type="hidden" name="t2" value="{$_GET['t2']}"/>
											<input type="hidden" name="t3" value="{$_GET['t3']}"/>
											<input type="hidden" name="t4" value="{$_GET['t4']}"/>
											<input type="hidden" name="ord" value="{$_GET['ord']}"/>
											<label class="param-label" style="width: 100px;">企业名称： </label>
											<input type="text"  class="ui-input-small" name="t1" value="{$_GET['t1']}"/>											
											<label class="param-label" style="width: 100px;"> </label>
											<input type="submit" class="ui-button ui-button-sblue"  value="确定">
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
			    	<span class="ui-banner-text">企业数目共：<span class="c_red b">{$epcount}</span> 家 ，补贴金额：<span class="c_red b">{$Totaldata[0].totalmoney|format_money4}</span> 万元</span> 		    	
			    </div>
				<!-- 信息提示  end -->
				<div class="ui-box mt10 shadow">
				 
				</div>				
				<!--  查询结果 begin -->				
				<div class="ui-table-container shadow">
				    <table class="ui-table ui-table-follow">
				        <thead>
				            <tr>
				                <th width="35%">企业名称</th>
				                <th width="15%"> 年度 </th>
				                <th width="15%"> 批次数</th>
								<!-- <th width="13%"> 补贴期间</th>				                
				                <th width="12%"> 补贴面积（㎡）</th>
				                <th width="10%">补贴单价(元) </th>
				                <th width="11%"> 载体</th> -->
				                <th width="20%">补贴金额（万元）</th>
				                <th width="15%">操作</th>
				            </tr>
				        </thead><!-- 表头可选 -->
				        <tbody>
				        	<volist name="Bussinesss[data]" id="vo" mod="2">
				        	<eq name="mod" value="0">
				            <tr>
				            <else/>
				            <tr class="ui-table-split" style="z-index:2;">
				            </eq>
				                <td>{$vo.epname}</td>
				                <td>{$vo.batchyear}</td>
				                <td>{$vo.batchno}</td>
				                <!-- <td>{$vo.starttime|format_date='Ym'}-{$vo.endtime|format_date='Ym'}</td>
				                <td>{$vo.allowancearea} </td>
				                <td align="right" style="padding-right:30px;">{$vo[allowancemoney]/1}</td>
				                <td>{$vo.carrier}</td> -->
				                <td align="right" style="padding-right:100px;">{$vo[money5]/10000|format_money4}</td>	
				                <td><a href="__URL__/detail/epid/{$vo.epid}/batchyear/{$vo.batchyear}/entername/{$vo.epname}">详情</a></td>
				            </tr>
				            </volist>
				        </tbody>
				        <tfoot>
				            <tr>
				                <td colspan="5">
								    <if condition="$Bussinesss['html']">
								    <div class="ui-paging">
								    {$Bussinesss['html']}
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
	</div>
</body>
</html>