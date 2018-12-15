<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<script>
//加载
$(function(){
			var contentt = "__URL__/exportDetail&query_params={$query_params|base64_encode}";
			var dialogwidth = '640px';
	        var dialogheight = '480px';
			//查看页面弹出层
			<if condition=" $authtime eq '0000-00-00' ">
	            var dialogwidth = '500px';
	            var dialogheight = '240px';
			<elseif condition="$authtime lt date('Y-m-d')"/>
				var dialogwidth = '500px';
	            var dialogheight = '240px';
			<elseif condition="($SkLoans['count'] eq 0) OR ($SkLoans['count'] gt C('EXPORT_NUM')) " />
				dialogwidth = '500';
		        dialogheight = '150px';
		        contentt = "__GROUP__/TransferTips/limitTips/num/{$SkLoans['count']}";
			</if>

            //var query_params  = '/p01/'+'{$_GET['p01']?$_GET['p01']:'/'}'+'/t1/'+{$_GET['t1']?$_GET['t1']:'/'}+'/t2/'+{$_GET['t2']?$_GET['t2']:'/'}+'/t3/'+{$_GET['t3']?$_GET['t3']:'/'};
            
            $(".serviceNodeTrigger").bind('click',function(){
				//判断当前是否可用导出
            	//var queryparams_new = queryparams.replace('/query_view/data_view/','');
                seajs.use(['arale/dialog/1.3.1/dialog'], function(Dialog) {
                    var d = new Dialog({
                        width: dialogwidth,
                        height: dialogheight,
                        effect: 'fade',
                        content: contentt
                    });
                    d.activeTrigger = $(this);
                    d.show();   
                });
            });

});

</script>
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
		<!-- 顶部栏目导航 begin -->
		<div  class="ui-grid-row">
			<div class="ui-grid-25">
				<h2 class="ui-page-title">所有苏科贷信息</h2>	
			</div>
		</div>
		<!-- 顶部栏目导航 end -->
		
		<!-- 左右布局 begin -->
		<div class="ui-grid-row">
		
			<!-- 左布局 begin -->
			<div class="ui-grid-5">	
					
				<!--  左边的分类导航 begin -->
				<include file="../Public/ep_filter" />
				<!--  左边的分类导航 end -->
				
			</div>
			<!-- 左布局 end -->
			
			<!-- 右布局 begin -->
			<div class="ui-grid-20">
				
				<!--  顶部的查询条件 begin -->
				<div class="ui-box shadow">
					<div class="ui-box-head">
						<div class="ui-box-head-border">
							<h3 class="ui-box-head-title">查询条件</h3>
							<span class="ui-box-head-text"></span> <a href="__URL__/index" class="ui-box-head-more">清除所有条件</a>
						</div>
					</div>
					<div class="ui-box-container">
						<ul class="ui-list ui-list-query">
							<li class="ui-list-item">
								<div class="ui-list-item-head">贷款年度：</div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/p02/%/" class="item-param <if condition="$_GET['p02']==''||$_GET['p02']=='%'">selected</if>">不限</a>
										<volist name="SkLoanprameter['p02']" id="v">
											<a href="__URL__/index{$query_params}/p02/{$v.quotavalue}" class="item-param  <eq name="Think.get.p02" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item last">
								<div class="param-container">
									<div class="param-cont">
										<form name="form" method="get" action="__URL__">
											<input type="hidden" name="m" value="SkLoan"/>
											<input type="hidden" name="a" value="index"/>
											<input type="hidden" name="k03" value="{$_GET['k03']}"/>
                                            <input type="hidden" name="f03" value="{$_GET['f03']}"/>
											<input type="hidden" name="k04" value="{$_GET['k04']}"/>
											<input type="hidden" name="k06" value="{$_GET['k06']}"/>
											<input type="hidden" name="k01" value="{$_GET['k01']}"/>
											<input type="hidden" name="p02" value="{$_GET['p02']}"/>
											<input type="hidden" name="t1" value="{$_GET['t1']}"/>
											<input type="hidden" name="t2" value="{$_GET['t2']}"/>
											<input type="hidden" name="ord" value="{$_GET['ord']}"/>
											<label class="param-label">企业名称： </label>
											<input type="text"  class="ui-input-small" name="t1" value="{$_GET['t1']}"/>
											<label class="param-label">组织机构代码： </label>
											<input type="text"  class="ui-input-small" name="t2" value="{$_GET['t2']}"/>
											<label class="param-label"> </label>
											<input type="submit" class="ui-button ui-button-sblue" value="确定">
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
			    	<span class="ui-banner-text">共有 <span class="c_red b">{$SkLoans['count']}</span> 个符合条件的结果 ，清单如下</span> 
			    	<eq name='supproject' value='true'>
			    	   <span class="ui-banner-tools"><a href="javascript:void(0)" class="serviceNodeTrigger ui-button ui-button-swhite">数据导出</a></span> 			    	</eq>
			    </div>
				<!-- 信息提示  end -->
				
				<!-- 排序工具 begin  -->
				<div class="ui-box mt10 shadow">
				    <div class="ui-box-head">
				        <span class="ui-box-head-text">排序：<a  href="__URL__/index{$query_params}/ord/%/" class="ml5 <if condition="$_GET['ord']==''||$_GET['ord']=='%'">b</if>">默认排序</a> 
				        							        <a href="__URL__/index{$query_params}/ord/year/" class="ml10 <eq name="Think.get.ord" value="year">b</eq>">贷款年度</a>  </span>
				        <a href="#" class="ui-box-head-more"></a>
				        <span class="ui-box-head-more" style="color:#808080">单位：万元人民币</span>
				    </div>
				</div>
				<!-- 排序工具 end -->
				
				<!--  查询结果 begin -->				
				<div class="ui-table-container shadow">
				    <table class="ui-table ui-table-follow">
				        <thead>
				            <tr>
				                <th width="31%">企业名称</th>
				                <th width="9%">贷款年度</th>
				                <th width="12%">申报日期</th>
				                <th width="12%">贷款金额</th>
				                <th width="30%">贷款银行</th>
				                <th width="6%">操作</th>
				            </tr>
				        </thead><!-- 表头可选 -->
				        <tbody>
				        	<volist name="SkLoans['data']" id="vo" mod="2">
				        	<eq name="mod" value="0">
				            <tr>
				            <else/>
				            <tr class="ui-table-split" style="z-index:1;">
				            </eq>
				                <td>{$vo.epname}</td>
				                <td>{$vo.year}</td>
				                <td>{$vo.applydate}</td>
				                <td align="right" style="padding-right:20px;">
				                {$vo.actloanlimit|format_money1} </td>
				                <td>{$vo.recombank} </td>
				                <td><a href="__URL__/detail/id/{$vo.iid}">详情</a></td>
				            </tr>
				            </volist>
				        </tbody>
				        <tfoot>
				            <tr>
				                <td colspan="6">
								    <if condition="$SkLoans['html']">
								    <div class="ui-paging">
								    {$SkLoans['html']}
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
		<!-- 左右布局 end -->
	</div>
</body>
</html>