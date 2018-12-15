<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<script>
		//加载
		$(function(){
			//查看页面弹出层
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
			<elseif condition="($Fundinfos['count'] eq 0) OR ($Fundinfos['count'] gt C('EXPORT_NUM')) " />
				dialogwidth = '500';
		        dialogheight = '150px';
		        contentt = "__GROUP__/TransferTips/limitTips/num/{$Fundinfos['count']}";
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
.select-bar{	width:580px; height:300px; top:32px; left:220px; overflow-y: auto; overflow-x:hidden; }
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
				<h2 class="ui-page-title">所有科技资金信息</h2>
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
				<div class="ui-box  shadow">
					<div class="ui-box-head">
						<div class="ui-box-head-border">
							<h3 class="ui-box-head-title">查询条件</h3>
							<span class="ui-box-head-text"></span> <a href="__URL__/index" class="ui-box-head-more">清除所有条件</a>
						</div>
					</div>
					<div class="ui-box-container">
						<ul class="ui-list ui-list-query">
							<li class="ui-list-item" style="z-index:1;">
								<div class="ui-list-item-head">资金类型：</div>
								<div class="ui-list-item-body">
									<div class="param-cont">
									{:w('BizcateChoose', array('queryfield'=>'prjtype', 'urlbefore'=>__URL__.'/index'.$query_params,'default' =>'选择资金类型','treename' =>'科技资金v1','rootnodepath' =>'/科技资金'))}
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">拨付年度：</div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/p02/%/" class="item-param <if condition="$_GET['p02']==''||$_GET['p02']=='%'">selected</if>">不限</a>
										<volist name="fundinfoprameter['p02']" id="v">
											<a href="__URL__/index{$query_params}/p02/{$v.quotavalue}" class="item-param  <eq name="Think.get.p02" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">拨付批次：</div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/p03/%/" class="item-param <if condition="$_GET['p03']==''||$_GET['p03']=='%'">selected</if>">不限</a>
										<volist name="fundinfoprameter['p03']" id="v">
											<a href="__URL__/index{$query_params}/p03/{$v.quota}/" class="item-param  <eq name="Think.get.p03" value="$v.quota">selected</eq>">{$v.quotavalue}</a>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item last">
								<div class="param-container">
									<div class="param-cont">
										<form name="form" method="get" action="__URL__">
											<input type="hidden" name="m" value="Fundinfo"/>
											<input type="hidden" name="a" value="index"/>
                                            <input type="hidden" name="k03" value="{$_GET['k03']}"/>
                                            <input type="hidden" name="f03" value="{$_GET['f03']}"/>
											<input type="hidden" name="k04" value="{$_GET['k04']}"/>
											<input type="hidden" name="k06" value="{$_GET['k06']}"/>
											<input type="hidden" name="k01" value="{$_GET['k01']}"/>
											<input type="hidden" name="p02" value="{$_GET['p02']}"/>
											<input type="hidden" name="p03" value="{$_GET['p03']}"/>
											<input type="hidden" name="prjtype" value="{$_GET['prjtype']}"/>
											<input type="hidden" name="t1" value="{$_GET['t1']}"/>
											<input type="hidden" name="t2" value="{$_GET['t2']}"/>
											<input type="hidden" name="t3" value="{$_GET['t3']}"/>
											<input type="hidden" name="t4" value="{$_GET['t4']}"/>
											<input type="hidden" name="t5" value="{$_GET['t5']}"/>
											<input type="hidden" name="ord" value="{$_GET['ord']}"/>
											<label class="param-label">企业名称：&nbsp;&nbsp;&nbsp;</label>
											<input type="text"  class="ui-input-small" name="t1" value="{$_GET['t1']}"/>
											<label class="param-label">组织机构代码： </label>
											<input type="text"  class="ui-input-small" name="t2" value="{$_GET['t2']}"/>
											<label class="param-label">拨付金额： </label>
											<input type="text" class="ui-input-small" style="width:60px;" name="t3" value="{$_GET['t3']}"/>
											<label class="param-label">至</label>
											<input type="text" class="ui-input-small" style="width:60px;" name="t4" value="{$_GET['t4']}"/>
											<label class="param-label">（万元）</label><br/></div>
											<div class="param-cont">
											<label class="param-label">申请人名称： </label>
											<input type="text"  class="ui-input-small" name="t5" value="{$_GET['t5']}"/>
											<label class="param-label"></label>
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
			    	<span class="ui-banner-text">共有 <span class="c_red b">{$Fundinfos['count']}</span> 个符合条件的结果<eq name="searchepdir" value="true">(您选择了包含企业属性的搜索条件，系统将会过滤掉没有关联企业的数据)</eq> ，清单如下</span> 
			    	<eq name='supproject' value='true'>
			    	   <span class="ui-banner-tools"><a href="javascript:void(0)" class="serviceNodeTrigger ui-button ui-button-swhite">数据导出</a></span> 
         			</eq>			    	
			    </div>
				<!-- 信息提示  end -->
				
				<!-- 排序工具 begin  -->
				<div class="ui-box mt10  shadow">
				    <div class="ui-box-head">
				        <span class="ui-box-head-text">排序：<a  href="__URL__/index{$query_params}/ord/%/" class="ml5 <if condition="$_GET['ord']==''||$_GET['ord']=='%'">b</if>">默认排序</a> 
				        							        <a href="__URL__/index{$query_params}/ord/appropriateyear/" class="ml10 <eq name="Think.get.ord" value="appropriateyear">b</eq>">拨付年度</a>  </span>
				        <a href="#" class="ui-box-head-more"></a>
				        <span class="ui-box-head-more" style="color:#808080">单位：万元人民币</span>
				    </div>
				</div>
				<!-- 排序工具 end -->
				
				<!--  查询结果 begin -->				
				<div class="ui-table-container  shadow">
				    <table class="ui-table ui-table-follow">
				        <thead>
				            <tr>
				                <th width="9%">拨付年度</th>
				                <th width="9%">拨付批次</th>
				                <th width="12%">拨付金额</th>
				                <th width="25%">企业名称</th>
				                <th width="20%">申请人名称</th>
				                <th width="19%">资金类型</th>
				                <th width="6%">操作</th>
				            </tr>
				        </thead><!-- 表头可选 -->
				        <tbody>
				        	<volist name="Fundinfos['data']" id="vo" mod="2">
				        	<eq name="mod" value="0">
				            <tr>
				            <else/>
				            <tr class="ui-table-split" style="z-index:2;">
				            </eq>
				                <td>{$vo.appropriateyear}</td>
				                <td>{$vo.appropriatebatch}</td>
				                <td align="right" style="padding-right:20px;">
				                {$vo.appropriateamount|format_money1}</td>
				                <td>{$vo.epname}</td>
				                <td>{$vo.entername}</td>
				                <td>{$vo.fundtype}</td>
				                <td><a href="__URL__/detail/id/{$vo.iid}">详情</a></td>
				            </tr>
				            </volist>
				        </tbody>
				        <tfoot>
				            <tr>
				                <td colspan="7">
								    <if condition="$Fundinfos['html']">
								    <div class="ui-paging">
								    {$Fundinfos['html']}
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