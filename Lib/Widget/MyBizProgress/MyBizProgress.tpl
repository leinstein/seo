<!-- 进度查询列表 begin -->
<style>

/*首页业务进度查询面板 */
.ui-bizprogress-panel{
	background-color:#FFFFFF;
	padding:0 5px 0 5px;	
	border: none;
	font-size:13px;
	box-shadow: 0 1px 2px rgba(0,0,0,0.05);
	border-radius: 2px;
	-webkit-transition: all 0.4s ease;
	transition: all 0.4s ease;
}
.ui-bizprogress-panel:hover{
    box-shadow:0 2px 3px rgba(0, 0, 0, 0.1);/*opera或ie9*/ 
}

/*首页业务进度查询表格样式（头部背景颜色和字体大小）*/
.ui-table-greybluetable{
	font-size: 13px;
}

.ui-table-greybluetable thead{
	background:rgb(220,230,242);
	font-size: 14px;
}

.ui-ellipsis{
	table-layout: fixed;
}
.ui-ellipsis td{
	text-overflow: ellipsis; 
	white-space: nowrap; 
	overflow: hidden;
}

</style>
<script>
//加载
$(function(){
	$("#top-usercenter-bizprogress-open").click(function(){
		$("#top-usercenter-bizprogress-open").hide();
		$("#top-usercenter-bizprogress-close").show();
		$("#allbizprogress").show();
		$("#somebizprogress").hide();
	});
	
	$("#top-usercenter-bizprogress-close").click(function(){
		$("#top-usercenter-bizprogress-open").show();
		$("#top-usercenter-bizprogress-close").hide();
		$("#allbizprogress").hide();
		$("#somebizprogress").show();
	});
	
});
</script>
<notempty name="MyBizProgress['data']">
<div class="ui-panel ui-bizprogress-panel mb10">
    <div class="ui-panel-container">
        <div class="ui-panel-content">
        	<table class="ui-table ui-table-noborder ui-table-greybluetable mt10 ui-ellipsis">
        	
        		<!-- 业务进度查询表格头部 begin -->
        		<thead>
        			<tr>
        				<th width="40%">业务信息</th>
        				<th width="10%">申请日期</th>
        				<th width="30%">进度提示</th>
        				<th width="20%">说明</th>
        			</tr>
        		</thead>
        		<!-- 业务进度查询表格头部 end -->
        		
        		<!-- 业务进度查询表格内容部分（3条进度信息内容部分） begin -->
        		<tbody id="somebizprogress">
        			<volist name="MyBizProgress['data']" id="vo" offset="0" length='3'>
        				<tr>
        					<td><span style="color:rgb(55,96,146);">[{$vo.themename}]</span>
        						<notempty name="vo.prodetailurl">
        						<a href="{$vo.prodetailurl}" target="_blank" title="{$vo.projectname}">&nbsp;&nbsp;{$vo.projname}</a>
        						<else/>
        						{$vo.projname}
        						</notempty>
        						</td>
        					<td>{$vo.applytime}</td>
        					<td><span style="color:rgb(239,134,10)">{$vo.bizprogresshint}</span></td>
        					<td style="overflow: visible;white-space: normal;">{$vo.bizprogressdesc}</td>
        				</tr>
        			</volist>
        		</tbody>
        		<!-- 业务进度查询表格内容部分（3条进度信息内容部分） end -->
        		
        		<!-- 业务进度查询表格内容部分（所有进度信息内容部分） begin -->
        		<tbody class="hide" id="allbizprogress">
        			<volist name="MyBizProgress['data']" id="vo">
        				<tr>
        					<td><span style="color:rgb(55,96,146);">[{$vo.themename}]</span><a href="{$vo.prodetailurl}" target="_blank" title="{$vo.projectname}">&nbsp;&nbsp;{$vo.projname}</a></td>
        					<td>{$vo.applytime}</td>
        					<td><span style="color:rgb(239,134,10)">{$vo.bizprogresshint}</span></td>
        					<td style="overflow: visible;white-space: normal;">{$vo.bizprogressdesc}</td>
        				</tr>
        			</volist>
        		</tbody>
        		<!-- 业务进度查询表格内容部分（所有进度信息内容部分） end -->
        		
        		<!-- 业务进度查询表格尾部 begin -->
        		<tfoot>
        			<tr>
        				<td class="ta_c" colspan="4">
        				
        					<!-- 业务进度点击展开所有进度信息 begin -->
        					<if condition="$MyBizProgress['count'] GT 3">
		    					<a href="javaScript:void(0);" class="bc_lightgray pb5 pt5 pr10 pl10" id="top-usercenter-bizprogress-open">
		    						<span class="c_white">更多信息，请点击展开</span>
		    					</a>
        					</if>
        					<!-- 业务进度点击展开所有进度信息 end -->
        					
        					<!-- 业务进度点击收起所有进度信息 begin -->
        					<if condition="$MyBizProgress['count'] LT 10">
	        					<a href="javaScript:void(0);" class="bc_lightgray pb5 pt5 pr10 pl10 hide" id="top-usercenter-bizprogress-close">
	        						<span class="c_white">点击收起</span>
	        					</a>
	        				<else/>
	        					<a href="javaScript:void(0);" class="bc_lightgray pb5 pt5 pr10 pl10 hide" id="top-usercenter-bizprogress-close">
	        						<span class="c_white">点击收起</span>
	        					</a>
	        				</if>
        					<!-- 业务进度点击收起所有进度信息 end -->
        					
        				</td>
        			</tr>
        		</tfoot>
        		<!-- 业务进度查询表格尾部 end -->
        		
        	</table>
        </div>
    </div>
</div> 
</notempty>
<!-- 进度查询列表 end -->