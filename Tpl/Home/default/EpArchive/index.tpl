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
<script>
$(function(){
	//企业资质多选
	$('#epd01multi-btn').click(function(){
		$('.epd01single').hide();
		$('.epd01multiselect').show();
		$('#epd01multisubmit').show();
		$('#epd01multireset').show();
	});
	$('#epd01multireset').click(function(){
		$('.epd01single').show();
		$('.epd01multiselect').hide();
		$('#epd01multisubmit').hide();
		$('#epd01multireset').hide();
	});
	
	//状态
	$('#epd03multi-btn').click(function(){
		$('.epd03single').hide();
		$('.epd03multiselect').show();
		$('#epd03multisubmit').show();
		$('#epd03multireset').show();
	});
	$('#epd03multireset').click(function(){
		$('.epd03single').show();
		$('.epd03multiselect').hide();
		$('#epd03multisubmit').hide();
		$('#epd03multireset').hide();
	});
});
</script>
<body>
	
	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner" />
	<!-- 页面顶部 logo & 菜单 end  -->
	
	<div class="wrapper">
	
		<!-- 顶部栏目导航 begin -->
		<div  class="ui-grid-row">
			<div class="ui-grid-25">
				<h2 class="ui-page-title">所有企业档案</h2>	
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
						<form name="form" method="get" action="__URL__">
						<input type="hidden" name="m" value="EpDeclare"/>
						<input type="hidden" name="a" value="index"/>
						<input type="hidden" name="k03" value="{$_GET['k03']}"/>
						<input type="hidden" name="k04" value="{$_GET['k04']}"/>
						<input type="hidden" name="k06" value="{$_GET['k06']}"/>
						<input type="hidden" name="k01" value="{$_GET['k01']}"/>
						<input type="hidden" name="epd01" value="{$_GET['epd01']}"/>
						<input type="hidden" name="epd02" value="{$_GET['epd02']}"/>
						<input type="hidden" name="t1" value="{$_GET['t1']}"/>
						<input type="hidden" name="t2" value="{$_GET['t2']}"/>
						<input type="hidden" name="ord" value="{$_GET['ord']}"/>
						<ul class="ui-list ui-list-query">
							<li class="ui-list-item">
								<div class="ui-list-item-head">资质类型：</div>
								<div class="ui-list-item-body item-2-line" style="height:102px;">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/epd01/%/" class="item-param <if condition="$_GET['epd01']==''||$_GET['epd01']=='%'">selected</if>">不限</a>
										<volist name="pjtparameter['epd01']" id="v">
											<a href="__URL__/index{$query_params}/epd01/{$v.quotavalue}" 
												class="item-param epd01single <if condition="strstr($_GET['epd01'],$v['quotavalue'])">selected</if>">{$v.quotavalue}</a>
											<a class="item-param epd01multiselect" style="display:none"><input type="checkbox" id="{$v.quotavalue}" name="epd01[]" value="{$v.quotavalue}"><label for="{$v.quotavalue}">{$v.quotavalue}</label></a>
										</volist>
										<input type="submit" id="epd01multisubmit" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="确定">
										<input type="button" id="epd01multireset" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="取消">
									</div> 
								</div>
								<div class="ui-list-item-tail epd01single" id="epd01multi-btn"><a href="javascript:;" class="multi-btn">多选</a></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">发证时间：</div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/epd02/%/" class="item-param <if condition="$_GET['epd02']==''||$_GET['epd02']=='%'">selected</if>">不限</a>
										<volist name="pjtparameter['epd02']" id="v">
											<a href="__URL__/index{$query_params}/epd02/{$v.quotavalue}/" class="item-param  <eq name="Think.get.epd02" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">状态：</div>
								<div class="ui-list-item-body item-1-line" >
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/epd03/%/" class="item-param <if condition="$_GET['epd03']==''||$_GET['epd03']=='%'">selected</if>">不限</a>
										<volist name="pjtparameter['epd03']" id="v">
											<a href="__URL__/index{$query_params}/epd03/{$v.quotavalue}" 
												class="item-param epd03single <if condition="strstr($_GET['epd03'],$v['quotavalue'])">selected</if>">{$v.quotavalue}</a>
											<a class="item-param epd03multiselect" style="display:none"><input type="checkbox" id="{$v.quotavalue}" name="epd03[]" value="{$v.quotavalue}"><label for="{$v.quotavalue}">{$v.quotavalue}</label></a>
										</volist>
										<input type="submit" id="epd03multisubmit" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="确定">
										<input type="button" id="epd03multireset" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="取消">
									</div> 
								</div>
								<div class="ui-list-item-tail epd03single" id="epd03multi-btn"><a href="javascript:;" class="multi-btn">多选</a></div>
							</li>
							<li class="ui-list-item last">
								<div class="param-container">
									<div class="param-cont">
										
											<label class="param-label">企业名称： </label>
											<input type="text"  class="ui-input-small" name="t1" value="{$_GET['t1']}"/>
											<label class="param-label">组织机构代码： </label>
											<input type="text"  class="ui-input-small" name="t2" value="{$_GET['t2']}"/>
											<label class="param-label"> </label>
											<input type="submit" class="ui-button ui-button-sblue" value="确定">
										
									</div> 
								</div>
							</li>
						</ul>
						</form>
					</div>
				</div>
			
				<!--  顶部的查询条件 end -->
				
				<!-- 信息提示 begin  -->
			    <div class="ui-banner">
			    	<span class="ui-banner-text">共有 <span class="c_red b">{$EpDeclares['count']}</span> 个符合条件的结果 ，清单如下</span> 
			    	<span class="ui-banner-tools"><a href="javascript:;" class="ui-button ui-button-swhite">数据导出</a></span>			    	
			    </div>
				<!-- 信息提示  end -->
				
				<!-- 排序工具 begin  -->
				<div class="ui-box mt10 shadow">
				    <div class="ui-box-head">
				        <span class="ui-box-head-text">排序：<a  href="__URL__/index{$query_params}/ord/%/" class="ml5 <if condition="$_GET['ord']==''||$_GET['ord']=='%'">b</if>">默认排序</a> 
				        							        <a href="__URL__/index{$query_params}/ord/certdate/" class="ml10 <eq name="Think.get.ord" value="certdate">b</eq>">发证时间</a>  </span>
				        <a href="#" class="ui-box-head-more"></a>
				    </div>
				</div>
				<!-- 排序工具 end -->
				
				<!--  查询结果 begin -->				
				<div class="ui-table-container shadow">
				    <table class="ui-table ui-table-follow">
				        <thead>
				            <tr>
				                <th width="35%">企业名称</th>
				                <th width="32%">资质类型</th>
				                <th width="12%">发证时间</th>
				                <th width="9%">有效期</th>
				                <th width="6%">状态</th>
				                <th width="6%">操作</th>
				            </tr>
				        </thead><!-- 表头可选 -->
				        <tbody>
				        	<volist name="EpDeclares['data']" id="vo" mod="2">
				        	<eq name="mod" value="0">
				            <tr>
				            <else/>
				            <tr class="ui-table-split" style="z-index:2;">
				            </eq>
				                <td>{$vo.epname}</td>
				                <td>{$vo.aptype}</td>
				                <td>{$vo.certdate}</td>
				                <td>{$vo.valid}</td>
				                <td>{$vo.aptstatus} </td>
				                <td><a href="__URL__/detail/id/{$vo.iid}">详情</a></td>
				            </tr>
				            </volist>
				        </tbody>
				        <tfoot>
				            <tr>
				                <td colspan="6">
								    <if condition="$EpDeclares['html']">
								    <div class="ui-paging">
								    {$EpDeclares['html']}
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