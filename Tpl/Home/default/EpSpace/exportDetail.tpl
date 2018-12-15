<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "业务管理台  |  研发项目确认";</php>
<head>
    <include file="../Public/header" />
	<script type="text/javascript" src="../Public/js/multiselect/jquery.multiselect2side.js"></script> 
	<script type="text/javascript" src="../Public/js/schedule.js"></script> 
	<link rel="stylesheet" type="text/css" href="../Public/js/multiselect/css/jquery.multiselect2side.css" /> 
	<script>
		$(function(){ 
			   $("#liOption").multiselect2side({ 
			        selectedPosition: 'right', 
			        moveOptions: false, 
			        labelsx: '待选区：', 
			        labeldx: '已选区：' 
			   }); 
			//确认窗口
			seajs.use(['arale/dialog/1.3.1/confirmbox'], function(ConfirmBox){
				var cb = new ConfirmBox({
					trigger: '.export_btn',
				    title: '确认导出数据',
				    message:'<span style="font-size:14px;">您确定要导出这些字段的数据吗？为减小系统运行压力，请在空闲时间段操作该功能！</span>',
	                onConfirm: function() {
		          	    this.hide();
		          	    var options = $(".ms2side__select:eq(1)").find("option");
		          	    var option_values = new Array();
		          	    var option_texts = new Array();
		          	    $(options).each(function(i,e){
				          	option_values.push($(this).val());
				          	option_texts.push($(this).text());
		           		});
		          	   $("#fields").val(option_values);
					   $("#field_labels").val(option_texts.join(','));
					   $("#sel_form").submit();

			   		seajs.use(['arale/dialog/1.3.1/dialog'], function(Dialog) {
		                    var d = new Dialog({
		                        height: '100px',
		                        width:'660px',
		                       	effect: 'fade',
		                        content: '<div id="dialog_div_point" style="color:#000;font-weight:bold;font-size:14px;line-height:100px;text-align:center;margin:0 auto;"><img alt="" src="{$PublicRes}/img/dialog_loading.gif" style="vertical-align: middle;width: 15px;margin-right:10px;">提示：正在导出数据，请勿关闭浏览器或重复操作此功能，并耐心等待导出结果！</div>'
		                    });
		                    d.activeTrigger = $('.export_btn');
		                    d.show();   
		               });
			 		setTimeout(function(){
							 $("#dialog_div_point").parent().parent().parent().hide();
						},5000);
						 setTimeout(function(){
							 //window.frameElement.trigger('close') 
						},1200);
				       }
				});
//				cb.before("show",function(){
//					//var fields = $("#liOption").val();
//					var length = $(".ms2side__select:eq(1)").find("option").length;
//					if( length == 0){
//						pageOverLay("#pageOverlay");
//						//关闭窗口
//						coolHint("请选择需要导出的字段！", function(){
//							$("#pageOverlay").hide();
//						}, '32px', '170px');
//						return false;
//					}
//				});
			});
		});
        
	</script>
	<style type="text/css">
		.ms2side__div select {
		width: 270px;
		float: left;
	}
	 .ui-text-des
	{
		margin: 5px 31px 5px 21px;
		text-indent: 2em;
		padding-left:5px;
		background: #F2F2F2	;
		border: 1px solid black;
		font-size: 120%;
	}
	</style>
</head>
<body>
        <!-- 全宽布局 begin -->
        <div class="ui-grid-row">
           	<!-- 字段信息 begin -->
            <div class="ui-box ui-box-section pb5">
                <div class="ui-box-head">
                    <h3 class="ui-box-head-title" style='font-size:16px;font-weight: bold;margin-left:10px'>请您选择需要导出的字段！</h3>
                </div>
                <div class = "ui-text-des">
                    您的<span herf="#" style="color:#0088cc">{$funname}数据导出功能</span>的使用授权截止到<span style="color:red">{$authtime}</span>，如果授权到期，您将不能使用此功能。
                </div>
                <form id="sel_form" action="__URL__/export/{$query_params}" method="post" style='padding-left:20px'>
                	<input type="hidden" name="fields" id="fields" />
                	<input type="hidden" name="field_labels" id="field_labels" />
	                <div id="sel">
		                <select name="liOption[]" id='liOption' multiple='multiple' height='300px' > 
		                	<volist name='SupProject'  id='vo'>
		                		<option value="{$vo['fieldname']}" <eq name="vo['columnTitle']" value="企业名称"> selected="selected"  class="data-disabled" data-disabled="disabled"</eq>>{$vo['columnTitle']}<eq name="vo['columnTitle']" value="企业名称">（必选）</eq></option>
		                	</volist>
						</select> 
					</div>
				    <input type="button" class="export_btn ui-button ui-button-mblue" style='margin-left:254px;' value="导出数据" />
     			 </form>
        	</div>
        	<!-- 字段信息 end -->
        </div>
        <!-- 全宽布局 end -->
</body>
</html>