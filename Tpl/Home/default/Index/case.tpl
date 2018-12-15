<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<link rel="stylesheet" href="http://www.qisobao.com/public/templets/jiakang/css/case.css">
<script type="text/javascript">

	window.onload=function(){
		  //do something
		  layui.use(['form'], function(){
	  		var form = layui.form;
			});
		
		var keyword = "{$_GET['keyword']}";
		
		//$("#keyword").val( keyword );
		document.getElementById("keyword").value=keyword;
		
		var keyword = "{$_GET['keyword']}";
		$("#keyword").val( keyword );
		
		var website = "{$_GET['website']}";
		$("#website").val( website );
		
		var searchengine = "{$_GET['searchengine']}";
		$("#searchengine").val( searchengine );
		$("#loading").hide();
		$("#show").show();
	}

	$(function() {
		layui.use(['form'], function(){
	  		var form = layui.form;
		});
	var searchengine = "{$_GET['searchengine']}";
		
		$("#searchengine").val( searchengine );
	});
	
	
</script>
<style type="text/css">
.search_box{text-align:center}
.search_box input,.search_box select{height:36px;border-radius:10px;line-height:2;font-size:16px;color:#666}
.search_box .item{border:1px solid #e2e2e2;width:177px;background-color:#fff;margin-right:10px;text-indent:10px}
.search_box input.btn{width:77px;background-color:#febe33;color:#fff;border:none;cursor:pointer}
table{width:100%;border:1px solid #e2e2e2;text-align:center;font-size:16px;color:#868686}
table thead th{height:52px;font-size:16px !important;color:#868686;border:1px solid #e2e2e2;text-align:center !important;}
table tbody tr td{height:43px;font-size:16px !important;color:#868686;border:1px solid #e2e2e2;text-align:center !important;}
table tbody tr td a{color:#1c82ff}
table tbody tr td img{}

</style>
</head>
<tagLib name="html" />
<body>
<div id="loading"  style="width: 100%;height: 100%;line-height: 50%;text-align: center;padding-top:300px;">
	<img alt="" src="loading.gif">
</div>
<div id="show"  style="display: none;">
	<form name="form1" id="form1" method="get" action="__URL__" class="layui-form mt10">
		<input type="hidden" name="m" value="Index" /> 
		<input type="hidden" name="a" value="keyword_case" />
		<input type="hidden" name="g" value="Home" />
		
		<div class="layui-form-item">
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <input type="text" class="layui-input" id="keyword" name="keyword"  placeholder="关键词">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <input type="text" class="layui-input" id="website" name="website" placeholder="网址">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <div class="layui-input-inline" style="width: 100px;">
		       <select id="searchengine" name="searchengine">
			    	<option value="">选择渠道</option>
			        <option value="baidu">百度pc</option>
			        <option value="baidu_mobile">百度手机</option>
			        <option value="sougou">搜狗</option>
			        <option value="360">360</option>
			        <option value="shenma">神马</option>
			    </select> 
		      </div>
		    </div>
		    
	
		    <div class="layui-inline">
		      <div class="layui-input-inline">
		        <input type="submit" name="sub" value="查询" class="layui-btn">
		        <button type="reset" name="btn" onclick="location.href='__URL__/keyword_case'" class="layui-btn layui-btn-primary">重置</button>
		      </div>
		    </div>
		  </div>
		</form>
		
		<table class="layui-table">
		 	<thead>
			    <tr>
			      	<th>关键词</th>
	                <th>网址</th>
	                <th>渠道</th>
	                <th>初始排名</th>
	                <th>当前排名</th>
	                <!-- <th>排名变化</th>-->
	                <th>检测日期</th>
	                <!-- <th>快照</th> -->
			    </tr> 
		 	</thead>
			<tbody>
			
		 		<notempty name="list['data']">
				<volist name="list['data']" id="vo">
			    <tr>
					<!-- 关键词 -->
					<td>
						<a target="_balnk" href="{$vo['search_url']}">{$vo['keyword']}</a>
					</td>
					<!-- 网址 -->
					<td>{$vo['website']}</td>
					<!-- 搜索引擎 -->
					<td><img src="{$vo['img']}"></td>
					<!-- 初始排名 -->
					<td align="center" style="text-align: center;">
						{$vo['initialranking']|default='100+'}
					</td>
					<!--最新排名-->
					<td align="center" style="text-align: center;">
						<span>{$vo['rank']|default='100+'}</span>
						<eq name="vo['initialranking']" value="0">
							<!-- 如果初始排名为0  -->
							<gt name="vo['rank']" value="0">
								<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;float: right;">
							</gt>
						<else/>
							<eq name="vo['rank']" value="0">
								<img src="__PUBLIC__/img/down.gif" style="vertical-align: middle;;float: right;">
							<else/>
								<!-- 如果初始排名不为0  -->
								<gt name="vo['rank']" value="$vo['initialranking']">
									<img src="__PUBLIC__/img/down.gif" style="vertical-align: middle;;float: right;">
								<else/>
									<img src="__PUBLIC__/img/up.gif" style="vertical-align: middle;;float: right;">
								</gt>
							</eq>
						</eq>
					</td>
		
					<!--检测时间--
					<td align="center" style="text-align: center;">
					{$vo['diff']|default=0} 
					</td>
					
					<!--检测时间-->
					<td align="center" style="text-align: center;">
					{$vo['createtime']|format_date} 
					</td>
					
			    </tr>
			   </volist>
			<else/>
			<tr>
				<td colspan="15" align="center" class="layui-table-nodata">暂无相关数据</td>
			</tr>
		</notempty>
	 	</tbody>
	</table>
	<!-- 分页 begin -->		
	<div class="layui-box layui-laypage">
		{$list['html']}{$list['html']}
	</div>	
<!-- 分页 end -->	
</div>