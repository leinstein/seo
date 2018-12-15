<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
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
				 <h2 class="ui-page-title">日志查询  > 系统操作日志查询</h2>
			</div>
		</div>
		<!-- 顶部栏目导航 end -->
			
			<!-- 右布局 begin -->
			<div class="ui-grid-25">
				
				<!--  顶部的查询条件 begin -->
				
				<div class="ui-box shadow">
					<div class="ui-box-head">
						<div class="ui-box-head-border">
							<h3 class="ui-box-head-title"><a name="map"></a>查询条件</h3>
							<span class="ui-box-head-text"></span> <a href="__URL__/index" class="ui-box-head-more">清除所有条件</a>
						</div>
					</div>
					<div class="ui-box-container">
						<form name="form" method="get" action="__URL__">
						<input type="hidden" name="m" value="Bizlog"/>
						<input type="hidden" name="a" value="index"/>
						<input type="hidden" name="k1" value="{$_GET['k1']}"/>
						<input type="hidden" name="k2" value="{$_GET['k2']}"/>
						<input type="hidden" name="k3" value="{$_GET['k3']}"/>
						<input type="hidden" name="ord" value="{$_GET['ord']}"/>
						<ul class="ui-list ui-list-query">
							<li class="ui-list-item">
								<div class="ui-list-item-head">客户端类型： </div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k1/%#map" class="item-param <if condition="$_GET['k1']==''||$_GET['k1']=='%'">selected</if>">不限</a>
										<volist name="parameter['p01']" id="v">
											<a href="__URL__/index{$query_params}/k1/{$v.quotavalue}#map" class="item-param  <eq name="Think.get.k1" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">操作时间：</div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<volist name="parameter['p02']" id="v">
										<if condition="$_GET['k2']==''">
											<a href="__URL__/index{$query_params}/k2/{$v.quotavalue}#map" class="item-param  <eq name="v.quotavalue" value="3个月以内">selected</eq>">{$v.quotavalue}</a>
										<else />
											<a href="__URL__/index{$query_params}/k2/{$v.quotavalue}#map" class="item-param  <eq name="Think.get.k2" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</if>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">客户端操作系统：</div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k3/%#map" class="item-param <if condition="$_GET['k3']==''||$_GET['k3']=='%'">selected</if>">不限</a>
										<volist name="parameter['p03']" id="v">
											<a href="__URL__/index{$query_params}/k3/{$v.quotavalue}#map" class="item-param  <eq name="Think.get.k3" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
										<a href="__URL__/index{$query_params}/k3/other#map" class="item-param <if condition="$_GET['k3']=='other'">selected</if>">其他</a>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item last">
								<div class="param-container">
									<div class="param-cont">
										
										<label class="param-label">用户名称：</label>
										<input type="text"  class="ui-input-small" name="t1" value="{$_GET['t1']}"/>
										<label class="param-label">姓名：  </label>
										<input type="text"  class="ui-input-small" name="t2" value="{$_GET['t2']}"/>
										<label class="param-label">操作描述关键字： </label>
										<input type="text" class="ui-input-small" name="t3" value="{$_GET['t3']}"/>
										<label class="param-label">&nbsp;&nbsp;&nbsp;</label>
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
			    	<span class="ui-banner-text">符合条件的记录共 <span class="c_red b">{$Bizlogs['count']}</span> 条，清单如下</span> 
			    </div>
				<!-- 信息提示  end -->
				
				<!-- 排序工具 begin  -->
				<div class="ui-box mt10 shadow">
				    <div class="ui-box-head">
				        <span class="ui-box-head-text">排序：<a name='order'></a>
				        <a href="__URL__/index{$query_params}/ord/%#order" class="ml5 <if condition="$_GET['ord']==''||$_GET['ord']=='%'">b</if>">默认排序</a>
				        <a href="javascript:void(0)" class="ui-box-head-more"></a>
				    </div>
				</div>
				<!-- 排序工具 end -->
				
				<!--  查询结果 begin -->				
				<div class="ui-table-container shadow">
				    <table class="ui-table ui-table-follow">
				        <thead>
				            <tr>
				                <th width="10%">用户</th>
				                <th width="15%">操作时间</th>
				                <th width="35%">操作描述</th>
				                <th width="10%">客户端类型</th>
				                <th width="6%">操作</th>
				            </tr>
				        </thead><!-- 表头可选 -->
				        <tbody>
				        	<volist name="Bizlogs['data']" id="vo" mod="2">
				        	<eq name="mod" value="0">
				            <tr>
				            <else/>
				            <tr class="ui-table-split">
				            </eq>
				                <td>{$vo.username}-{$vo.truename}</td>
				                <td>{$vo.actbegintime|substr=0,14|strtotime|date='Y-m-d H:i:s',###}</td>
				                <td>{$vo.actiondesc}</td>
				                <td>{$vo.clienttype} </td>
				                <td><a href="__URL__/detail/logid/{$vo.id}">详情</a></td>
				            </tr>
				            </volist>
				        </tbody>
				        <tfoot>
				            <tr>
				                <td colspan="5">
				                        
					                
									    <if condition="$Bizlogs['html']">
									    <div class="ui-paging">
									    {$Bizlogs['html']}
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