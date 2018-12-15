<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header"/>
<style>
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
				<h2 class="ui-page-title"><a href="#">按企业查询</a>><a href="#">详情</a></h2>	
			</div>
		</div>
		<!-- 顶部栏目导航 end -->
		
		<!-- 全宽布局 begin -->
		<div class="ui-grid-row">		
			<!-- 全宽布局 begin -->
			<div class="ui-grid-25">
				<div class="ui-box" style="margin-bottom:10px">
				    <div class="ui-box-head">
				        <h3 class="ui-box-head-title"> 实际享受房租补贴情况 </h3>
				        <span class="ui-box-head-text"></span>
				        <a href="javascript:history.go(-1)" class="ui-box-head-more">返回</a>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content pt15">
				        	<div class="ui-table-container">
							    <table class="ui-table ui-table-inbox">
							        <tbody>
							            <tr>
							                <td width="18%"> 企业名称：   </td>
							                <td width="73%">{$unfinished_subsidy.epname}【补贴中】</td>
							                <td width="9%">&nbsp;</td>
							            </tr>
							            <tr>
							                <td>注册时间</td>
							                <td>{$unfinished_subsidy.regdate}</td>
							                <td>&nbsp;</td>
							            </tr>    
							            <tr>
							                <td>累计享受补贴面积：</td>
							                <td>{$unfinished_subsidy.allowancearea}（㎡）</td>
							                <td>&nbsp;</td>
							            </tr>    
							             <tr>
							                <td>补贴期间：</td>
							                <td>{$unfinished_subsidy.preferentialstardate}&nbsp;至&nbsp;{$unfinished_subsidy.preferentialenddate}</td>
							                <td>&nbsp;</td>
							            </tr>
							             <tr>
							                <td>享受补贴总额：</td>
							                <td>{$unfinished_subsidy.allowanceamount}</td>
							                <td>&nbsp;</td>
							            </tr>
							             <tr>
							                <td> 其中：</td>
							                <td>已补贴金额：{$unfinished_subsidy.allowancesubsidized}(元)</td>
							                <td>&nbsp;</td>
							            </tr>

							             <tr>
							                <td>待补贴金额：</td>
							                <td>{$unfinished_subsidy.remainingsubsidy}(元)</td>
							                <td>&nbsp;</td>
							            </tr>
							        </tbody>
							    </table>
							</div>
				        </div>
				    </div>
				</div>

				<div class="ui-box" style="margin-bottom:10px">
				    <div class="ui-box-head">
				        <h3 class="ui-box-head-title"> 企业享受的房租优惠政策 </h3>
				        <span class="ui-box-head-text"></span>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content pt15">
				        	<div class="ui-table-container">
				        		<div class="ui-table-container shadow">
								    <table class="ui-table ui-table-follow">
								        <thead>                                                                                                          
								            <tr>
								                <th width="11%">凭证类型</th>
								                <th width="23%">优惠凭证 </th>
								                <th width="17%">发文/批准日期</th>
								                <th width="13%">补贴面积(㎡)</th>
								                <th width="15%">全免时长(月)</th>
								                <th width="9%">减半时长(月)</th>
								                <th width="8%">政策状态 </th>
								            </tr>
								        </thead><!-- 表头可选 -->
								        <tbody>
								        	<volist name="policylist" id="v0" >
								        	<tr>	
								                <td>
								                	<if condition="$v0['documenttype'] eq '0'">招商例会  	
								              	    <elseif condition="$v0['documenttype'] eq '1'"/>领军项目 
								              		</if>	
								                <td>{$v0.precertificatename}</td>
								                <td>{$v0.approvedate} </td>
							                    <td>{$v0.supplementarea} </td>
							                    <td>{$v0.freeduration} </td>
								                <td>{$v0.halfduration} </td>
								                <td>
								                	<if condition="$v0['policystate'] eq '0'">正常  	
								              	    <elseif condition="$v0['policystate'] eq '1'"/>冻结
								              	     <elseif condition="$v0['policystate'] eq '2'"/>结束  
								              		</if>
								              	</td>
								            </tr>
								            </volist>
								        </tbody>
								        <empty name="policylist">
								        <tfoot>
								            <tr>
								                <td colspan="6">
												    <if condition="$SupProjects['html']">
												    <div class="ui-paging">
												    {$SupProjects['html']}
												    <else />
												    <div align="center">
												    暂无数据
												    </if>
												    </div>
												</td>
								            </tr>
								        </tfoot><!-- 表尾可选 -->
								        </empty>
								    </table>
								</div>
							</div>
						</div>
					</div>
				</div>	

				<div class="ui-box">
				    <div class="ui-box-head">
				        <h3 class="ui-box-head-title">企业享受房租补贴详细情况      </h3>
				        <span class="ui-box-head-text"></span>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content pt15">
				        	<div class="ui-table-container">
							    <table class="ui-table ui-table-inbox">
							        <tbody>
							            <tr>
							               <td colspan ="3">【补贴中】{$unfinished_subsidy.epname}</td>
							            </tr>
							            <tr>
							                <td width="18%">注册日期:</td>
							                <td width="73%">{$unfinished_subsidy.regdate}</td>
							                <td width="9%">&nbsp;</td>
							            </tr>
							            <tr>
							                <td> 累计享受补贴面积： </td>
							                <td> {$unfinished_subsidy.allowancearea}（㎡） </td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>补贴期间：</td>
							                <td>{$unfinished_subsidy.preferentialstardate}&nbsp;至&nbsp;{$unfinished_subsidy.preferentialenddate}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td> 已补贴金额： </td>
							                <td>{$unfinished_subsidy.allowancesubsidized}(元) </td>
							                <td>&nbsp;</td>
							            </tr>
							             <tr>
							                <td> 待补贴金额：</td>
							                <td>{$unfinished_subsidy.remainingsubsidy}(元)</td>
							                <td>&nbsp;</td>
							            </tr>
							        </tbody>
							    </table>
							</div>
							<notempty name="finished_subsidy">
				        	<div class="ui-table-container">
							    <table class="ui-table ui-table-inbox">
							        <tbody>
							            <tr>
							                <td colspan ="3">【补贴完成】 {$finished_subsidy.epname}</td>
							            </tr>
							            <tr>
							                <td width="18%">注册日期:</td>
							                <td width="73%">{$finished_subsidy.regdate}</td>
							                <td width="9%">&nbsp;</td>
							            </tr>
							            <tr>
							                <td> 累计享受补贴面积： </td>
							                <td> {$finished_subsidy.allowancearea} </td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr class="ui-table-split">
							                <td>补贴期间：</td>
							                <td><notempty name="finished_subsidy['leasestardate']">{$finished_subsidy.preferentialstardate}&nbsp;至&nbsp;{$finished_subsidy.preferentialenddate}</notempty></td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td> 已补贴金额： </td>
							                <td>{$finished_subsidy.allowancesubsidized}(元) </td>
							                <td>&nbsp;</td>
							            </tr>
							             <tr>
							                <td> 待补贴金额：</td>
							                <td>{$finished_subsidy.remainingsubsidy}(元)</td>
							                <td>&nbsp;</td>
							            </tr>
							        </tbody>
							    </table>
							</div>
							</notempty>
				        </div>
				    </div>
				</div>			
			</div>			
		</div>
		<!-- 全宽布局 end -->
	</div>
</body>
</html>


