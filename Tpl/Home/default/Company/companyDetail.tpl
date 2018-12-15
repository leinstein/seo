<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header"/>
<style>
.ui-table .no-border-btm{border-bottom:none;}
.ui-table-follow{
	border-top:none;
	border-left:none;
	border-right:none;
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
				<h2 class="ui-page-title">按企业查询>详情</h2>	
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
							                <td> 企业名称：</td>	
							                <td><if condition="$subsidy_overview.epname neq null">{$subsidy_overview.epname}<else />{$allowance ["entername"]}</if>
							                	<if condition="$suballowancestate eq 1">【补贴中】<elseif condition="$suballowancestate eq 0"/>【补贴完成】<elseif condition="$suballowancestate eq 2"/>【未补贴】</if>
							                </td>
							                <td >&nbsp;</td>
							            </tr>
							            <tr>
							                <td>注册时间：</td>
							                <td>{$subsidy_overview.regdate}</td>
							                <td>&nbsp;</td>
							            </tr>    
							            <tr>
							                <td>累计享受补贴面积（㎡）：</td>
							                <td>{$processdata.mallowancearea}</td>
							                <td>&nbsp;</td>
							            </tr>    
							            <!--  <tr>
							                <td>补贴期间：</td>
							                <td>{$subsidy_overview.preferentialstardate}&nbsp;至&nbsp;{$subsidy_overview.preferentialenddate}</td>
							                <td>&nbsp;</td>
							            </tr> -->
							             <!-- <tr>
							                <td>享受补贴总额（万元）：</td>
							                <td>{$subsidy_overview.mallowanceamount}</td>
							                <td>&nbsp;</td>
							            </tr> -->
							            <if condition="$subsidy_overview['mallowancesubsidizing'] eq 0">
							             <tr>
							                <td class="no-border-btm"> 已补贴金额（万元）：</td>
							                <td class="no-border-btm">{$processdata['mallowancesubsidized']	/10000|format_money4}</td>
							                <td class="no-border-btm">&nbsp;</td>
							            </tr>
							            <elseif condition="$subsidy_overview['mallowancesubsidizing'] neq 0"/>
							            <tr>
							                <td > 已补贴金额（万元）：</td>
							                <td>{$processdata['mallowancesubsidized']	/10000|format_money4}</td>
							                <td>&nbsp;</td>
							            </tr></if>

							            
							            <if condition="$subsidy_overview['mallowancesubsidizing'] neq 0">
							            	<tr>
							                <td class="no-border-btm">待补贴金额（万元）：</td>
							                <td class="no-border-btm">{$subsidy_overview['mallowancesubsidizing']/10000|format_money4}</td>
							                <td class="no-border-btm">&nbsp;</td>
							            	</tr>
							            </if>
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
								                <th width="12%">补贴面积（㎡）</th>
								                <th width="13%">全免时长（月）</th>
								                <th width="12%">减半时长（月）</th>
								                <th width="8%">政策状态 </th>
								            </tr>
								        </thead><!-- 表头可选 -->
								        <tbody>
								        	<volist name="policylist" id="v0" >
								        	<tr>	
								                <td>
								                	<if condition="$v0['documenttype'] eq '0'">招商例会  	
								              	    <elseif condition="$v0['documenttype'] eq '1'"/>领军特批
								              	    <elseif condition="$v0['documenttype'] eq '2'"/>领军项目
								              	    <elseif condition="$v0['documenttype'] eq '3'"/>其它
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
								                <td colspan="7">
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
				        	<volist name="subsidy_each" id="v1">
				        	<div class="ui-table-container">
							    <table class="ui-table ui-table-inbox">
							        <if condition="$v1['Data_applymaindetail'] neq null">
							               <p colspan ="6" style="margin-top:20px;"><if condition="$v1['allowancestate'] eq 1">【补贴中】<elseif condition="$v1['allowancestate'] eq 0"/>【补贴完成】<elseif condition="$v1['allowancestate'] eq 2"/>【未补贴】</if>
							               	载体：<if condition="$v1['carrierid'] eq '42bbc61a-a92a-4e16-90ee-a6e0c8017376'">科技公司<elseif condition ="$v1['carrierid'] eq '91442159-441b-45ad-a3c5-2c433f3b7bae'"/>生物公司<elseif condition="$v1['carrierid'] eq 'e97bd032-e477-4cdd-97d1-5ee6a17ac969'"/>纳米公司<elseif condition="$v1['carrierid'] eq 'ffbddc6f-db1f-486e-a176-8ef05702aacf'"/>纳米大学科技园<elseif condition="$v1['carrierid'] eq 'top9.15'"/>纳米大学科技园-西交大科技园<elseif condition="$v1['carrierid'] eq 'top9.17'"/>纳米大学科技园-中科大科技园<elseif condition="$v1['carrierid'] eq 'top9.10'"/>娄葑街道<elseif condition="$v1['carrierid'] eq 'top9.11'"/>唯亭街道<elseif condition="$v1['carrierid'] eq 'top9.12'"/>胜浦街道<elseif condition="$v1['carrierid'] eq 'top9.13'"/>斜塘街道<elseif condition="$v1['carrierid'] eq 'top9.2'"/>中新区<elseif condition="$v1['carrierid'] eq 'e3d26888-7458-49ee-bdff-2e50851da994'"/>CSSD<elseif condition="$v1['carrierid'] eq '19E7F926-C68C-45C1-B0E1-976F5A0202DA'"/>育成中心<elseif condition="$v1['carrierid'] eq '8fdf5614-828d-473b-8b07-428971d3f40a'"/>科技招商中心<elseif condition="$v1['carrierid'] eq 'a740607b-c9f6-41e7-9d72-5cfd33c20931'"/>招商局<elseif condition="$v1['carrierid'] eq 'dabb9676-7659-4973-8607-92c53e043d81'"/>云联盟<elseif condition="$v1['carrierid'] eq 'top9.16'"/>苏大科技园<elseif condition="$v1['carrierid'] eq 'top9.19'"/>原点创投<else/> </if> &nbsp; &nbsp;地址：{$v1.leaseaddress}</p>
							           
							            <thead>
								            <tr>
								                <th width="15%">租赁面积（㎡）</th>
								                <th width="20%">租赁期限</th>
								                <th width="13%">补贴面积（㎡）</th>
								                <th width="16%">开始补贴日期</th>
								                <th width="18%">已补贴金额（万元）</th>
								                <th width="18%">待补贴金额（万元）</th>
								            </tr>
								        </thead><!-- 表头可选 -->
								        <tbody>
								        	<tr class="ui-table-split"> 			
									                <if condition="$v1['leasetotalarea'] eq '0'"><td>/</td><elseif condition="$v1['leasetotalarea'] neq '0'"/><td>{$v1.leasetotalarea}</td> </if>
									                <td> {$v1.leasestardate} 至 {$v1.leaseenddate} </td>
 													<td> {$v1.preferential_subsidiesarea}</td>
 													<td>{$v1.starttime}</td>
 													<td align="right" style="padding-right:70px;">{$v1['sum']/10000|format_money4} </td>
 													<td align="right" style="padding-right:70px;">{$v1.remainingsubsidy}</td>
									        </tr>
							            <!-- <tr>
							                <td> 租赁面积(㎡)： </td>
							                <td> {$v1.leasetotalarea}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td> 租赁期限： </td>
							                <td> {$v1.leasestardate} 至 {$v1.leaseenddate} </td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td> 补贴面积(㎡)： </td>
							                <td> {$v1.preferential_subsidiesarea}</td>
							                <td>&nbsp;</td>
							            </tr>

							            <tr>
							                <td>开始补贴日期：</td>
							                <td>{$v1.starttime}</td>
							                <td>&nbsp;</td>
							            </tr>
							            <tr>
							                <td> 已补贴金额(万元)： </td>
							                <td>{$v1['sum']/10000|format_money4} </td>
							                <td>&nbsp;</td>
							            </tr>
							             <tr >
							                <td class="no-border-btm"> 待补贴金额(万元)：</td>
							                <td class="no-border-btm">{$v1.remainingsubsidy}</td>
							                <td class="no-border-btm">&nbsp;</td>
							            </tr> -->
							        </tbody>
							    </if>
							    </table>
							</div>
							</volist>
				        </div>
				    </div>
				</div>			
			</div>			
		</div>
		<!-- 全宽布局 end -->
	</div>
</body>
</html>


