<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<style>
.ui-list-query .ui-list-item .ui-list-item-body2 {
        padding : 0 200px 0 166px;
    }
/*选择框风格*/
.select-bar{	width:580px; height:280px; top:32px; left:200px; overflow-y: auto; overflow-x:hidden; }
    .ui-list-item-body{
        height: auto !important;
    }
</style>
</head>
<script>
$(function(){
$("input[id$='multisubmit']").click(function() {
    var prt = $(this).parent();
    var nochecked = true;
    var inputName = '';
    $(prt.find("input[type='checkbox']")).each(function(index, item) {
        if($(item).attr("checked") == 'checked'){
            nochecked = false; return false;
        }
        if(inputName == '') {
            inputName = $(item).attr('name');
        }
    });
    if(nochecked) {
        inputName = inputName.replace(/\[\]/, '')
        $("input[name='"+inputName+"']").val('');
    }
    $("form").submit();
});
//企业筛选
$('#f2multi-btn').click(function(){ getChoice('f2',false)});
$('#f2multireset').click(function(){ cancelChoice('f2',false)});
//载体
$('#k02multi-btn').click(function(){ getChoice('k02',true)});
$('#k02multireset').click(function(){ cancelChoice('k02',true)});
//招商类型
$('#k23multi-btn').click(function(){ getChoice('k23',true)});
$('#k23multireset').click(function(){ cancelChoice('k23',true)});
//产业类型
$('#k03multi-btn').click(function(){ getChoice('k03',true)});
$('#k03multireset').click(function(){ cancelChoice('k03',true)});
//企业资质
$('#k08multi-btn').click(function(){ getChoice('k08',true)});
$('#k08multireset').click(function(){ cancelChoice('k08',true)});
//人才类型
$('#k09multi-btn').click(function(){ getChoice('k09',true)});
$('#k09multireset').click(function(){ cancelChoice('k09',true)});
//载体
$('#k02multi-btn').click(function(){ getChoice('k02',true)});
$('#k02multireset').click(function(){ cancelChoice('k02',true)});

    $('#k04submit').click(function() {
        return  checkInput("k04") && (checkInput2("k06") || checkInput("k06")) && (checkInput2("k05") || checkInput("k05"));
    });
    $('#k06submit').click(function(){
        return checkInput("k06") && (checkInput2("k04") || checkInput("k04")) && (checkInput2("k05") || checkInput("k05"));;
    });
    $('#k05submit').click(function(){
        return checkInput("k05") && (checkInput2("k04") || checkInput("k04")) && (checkInput2("k06") || checkInput("k06"));;
    });
    $('#lastsubmit').click(function(){
        return (checkInput2("k05") || checkInput("k05")) && (checkInput2("k04") || checkInput("k04")) && (checkInput2("k06") || checkInput("k06"));;
    });
});
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
			<elseif condition="($EpSpaces['count'] eq 0) OR ($EpSpaces['count'] gt C('EXPORT_NUM')) " />
				dialogwidth = '500';
		        dialogheight = '150px';
		        contentt = "__GROUP__/TransferTips/limitTips/num/{$EpSpaces['count']}";
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
function checkInput(str)
{
	var vmin = $("#"+str+"min").val();
	var vmax = $("#"+str+"max").val();
	var err = document.getElementById(str+"error");
	/*if(!vmin || !vmax)
	{
		err.innerHTML = " 请输入";
		return false
	}*/
	//if(!vmin.match(/[0-9]/) || !vmax.match(/[0-9]/))
    if(isNaN(vmin) || isNaN(vmax))
	{
		err.innerHTML = " 请输入数字";
		return false
	}

	if(vmin && vmax && parseInt(vmin) > parseInt(vmax))
	{
		err.innerHTML = " 输入范围不正确";
		return false			
	}
	err.innerHTML ="";
	// $("#"+str+"hidden").val(0);
	return true;
}
function checkInput2(str)
{
	var vmin = $("#"+str+"min").val();
	var vmax = $("#"+str+"max").val();
	if(vmin || vmax)
	{
		return false
	}
	return true;
}
function getChoice(field, multiLine)
{
    /*
     $(".k04multiselect input[type='checkbox']").each(function(index, item) {
     console.log($(item).attr('checked'))
     });
     */
    if(multiLine) {
        $("#"+field+"multiselect").attr("checked", false);
        //console.log("."+field+"single.selected")
        $("."+field+"single.selected").each(function(index, item) {
            var ckId = $(item).attr("cls2id");
            //console.log(ckId);
            $("#"+ckId).attr("checked", true);
        });
    }
	$('.'+field+'single').hide();
	$('.'+field+'multiselect').show();
	$('#'+field+'multisubmit').show();
	$('#'+field+'multireset').show();
}
function cancelChoice(field,multiLine)
{
	//if(multiLine) $('#'+field+'div').removeClass("item-2-line");
	$('.'+field+'single').show();
	$('.'+field+'multiselect').hide();
	$('#'+field+'multisubmit').hide();
	$('#'+field+'multireset').hide();
}
function setCustom(field)
{
	if($('#'+field+'div').hasClass("item-2-line"))
	{
		$('#'+field+'div').removeClass("item-2-line");
		$('#'+field+'custom').hide();
		$('#'+field+'href').text("自定义");
	}
	else
	{
		$('#'+field+'div').addClass("item-2-line");
		$('#'+field+'custom').show();	
		$('#'+field+'href').text("隐藏");
	}
}
</script>
<body>
	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner" />
	<!-- 页面顶部 logo & 菜单 end  -->
		
	<div class="wrapper">	
	
		<!-- 顶部栏目导航 begin -->
		<div  class="ui-grid-row">
			<div class="ui-grid-25">
				 <h2 class="ui-page-title">企业空间</h2>
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
						<form name="form" method="get"  action="__URL__">
						<input type="hidden" name="m" value="EpSpace"/>
						<input type="hidden" name="a" value="index"/>
                        <input type="hidden" name="k01" value="{$_GET['k01']}"/>
                        <input type="hidden" name="k02" value="{$_GET['k02']}"/>
                        <input type="hidden" name="k03" value="{$_GET['k03']}"/>
						<input type="hidden" name="k06" id="k06hidden" value="{$_GET['k06']}"/>
						<input type="hidden" name="k05" id="k05hidden" value="{$_GET['k05']}"/>
                        <input type="hidden" name="k08" value="{$_GET['k08']}"/>
                        <input type="hidden" name="k09" value="{$_GET['k09']}"/>
						<input type="hidden" name="k12" value="{$_GET['k12']}"/>
						<input type="hidden" name="f1" value="{$_GET['f1']}"/>
                        <input type="hidden" name="f2" value="{$_GET['f2']}"/>
                        <input type="hidden" name="f03" value="{$_GET['f03']}"/>
                        <input type="hidden" name="k21" value="{$_GET['k21']}"/>
                        <input type="hidden" name="k23" value="{$_GET['k23']}"/>
						<input type="hidden" name="k60" value="{$_GET['k60']}"/>
						<input type="hidden" name="ord" value="{$_GET['ord']}"/>
						<ul class="ui-list ui-list-query">
							<li class="ui-list-item">
								<div class="ui-list-item-head">企业筛选： </div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/f2/%#map" class="item-param <if condition="$_GET['f2']==''||$_GET['f2']=='%'">selected</if>">不限</a>
										<volist name="parameter['f2']" id="v">
											<a href="__URL__/index{$query_params}/f2/{$v.quotavalue|urlencode}#map" cls2id="f2-{$i}" class="item-param f2single <if condition="strstr($_GET['f2'],$v['quotavalue'])">selected</if>">{$v.quotavalue}</a>
											<a class="item-param f2multiselect" style="display:none">
                                                <input type="checkbox" id="f2-{$i}" name="f2[]" value="{$v.quotavalue|urldecode}">
                                                <label for="f2-{$i}">{$v.quotavalue}</label></a>
										</volist>
										<input type="button" id="f2multisubmit" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="确定">
										<input type="button" id="f2multireset" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="取消">
									</div> 
								</div>
								<!-- <div class="ui-list-item-tail f2single" id="f2multi-btn"><a href="javascript:void(0);" class="multi-btn">多选</a></div> -->
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">载体： </div>
								<div class="ui-list-item-body2  item-2-line">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k02/%#map" class="item-param <if condition="$_GET['k02']==''||$_GET['k02']=='%'">selected</if>">不限</a>
										<volist name="parameter['k02']" id="v">
											<a href="__URL__/index{$query_params}/k02/{$v.quotavalue|urldecode}#map" cls2id="k02-{$i}" class="item-param k02single <if condition="strstr($_GET['k02'],$v['quotavalue'])">selected</if>">{$v.quotavalue}</a>
											<a class="item-param k02multiselect" style="display:none">
                                                <input type="checkbox" id="k02-{$i}" name="k02[]" value="{$v.quotavalue}">
                                                <label for="k02-{$i}">{$v.quotavalue}</label></a>
										</volist>
										<input type="button" id="k02multisubmit" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="确定">
										<input type="button" id="k02multireset" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="取消">
									</div> 
								</div>
								<div class="ui-list-item-tail k02single" id="k02multi-btn"><a href="javascript:void(0);" class="multi-btn">多选</a></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">招商类型： </div>
								<div class="ui-list-item-body " id="k23div">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k23/%#map" class="item-param <if condition="$_GET['k23']==''||$_GET['k23']=='%'">selected</if>">不限</a>
										<volist name="parameter['k23']" id="v">
											<a href="__URL__/index{$query_params}/k23/{$v.quotavalue}#map" cls2id="k23-{$i}" class="item-param k23single <if condition="strstr($_GET['k23'],$v['quotavalue'])">selected</if>">{$v.quotavalue}</a>
											<a class="item-param k23multiselect" style="display:none">
                                                <input type="checkbox" id="k23-{$i}" name="k23[]" value="{$v.quotavalue}">
                                                <label for="k23-{$i}">{$v.quotavalue}</label></a>
										</volist>
										<br/>
										<input type="button" id="k23multisubmit" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="确定">
										<input type="button" id="k23multireset" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="取消">
									</div> 
								</div>
								<div class="ui-list-item-tail k23single" id="k23multi-btn"><a href="javascript:void(0);" class="multi-btn">多选</a></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">产业类型：</div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k03/%#map" class="item-param <if condition="$_GET['k03']==''||$_GET['k03']=='%'">selected</if>">不限</a>
										<volist name="tagOptions" id="v">
                                        <!--volist name="parameter['k03']" id="v"-->
											<a href="__URL__/index{$query_params}/k03/{$v.catename|urldecode}#map" cls2id="k03-{$i}" class="item-param k03single <if condition="strstr($_GET['k03'],$v['catename'])">selected</if>">{$v.catename}</a>
                                            <a class="item-param k03multiselect" style="display:none">
                                                <input type="checkbox" id="k03-{$i}" name="k03[]" value="{$v.catename|urldecode}">
                                                <label for="k03-{$i}">{$v.catename}</label>
                                            </a>
                                        </volist>
                                        <input type="button" id="k03multisubmit" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="确定">
                                        <input type="button" id="k03multireset" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="取消">
									</div> 
								</div>
                                <div class="ui-list-item-tail k03single" id="k03multi-btn"><a href="javascript:void(0);" class="multi-btn">多选</a></div>
							</li>

                            <li class="ui-list-item">
                                <div class="ui-list-item-head">产业特征：</div>
                                <div class="ui-list-item-body">
                                    <div class="param-cont">
                                        <a href="__URL__/index{$query_params}/f03/%#map" class="item-param <if condition="$_GET['f03']==''||$_GET['f03']=='%'">selected</if>">不限</a>
                                        <volist name="featureOptions" id="v">
                                            <a href="__URL__/index{$query_params}/f03/{$v.catename|urldecode}#map" cls2id="f03-{$i}" class="item-param f03single <if condition="strstr($_GET['f03'],$v['catename'])">selected</if>">{$v.catename}</a>
                                            <a class="item-param f03multiselect" style="display:none">
                                                <input type="checkbox" id="f03-{$i}" name="f03[]" value="{$v.catename|urldecode}">
                                                <label for="f03-{$i}">{$v.catename}</label>
                                            </a>
                                        </volist>
                                        <input type="button" id="f03multisubmit" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="确定">
                                        <input type="button" id="f03multireset" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="取消">
                                    </div>
                                </div>
                                <!--div class="ui-list-item-tail k03single" id="k03multi-btn"><a href="javascript:void(0);" class="multi-btn">多选</a></div-->
                            </li>


							<li class="ui-list-item">
								<div class="ui-list-item-head">企业资质：</div>
								<div class="ui-list-item-body  item-2-line">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k08/%#map" class="item-param <if condition="$_GET['k08']==''||$_GET['k08']=='%'">selected</if>">不限</a>
										<volist name="parameter['k08']" id="v">
											<a href="__URL__/index{$query_params}/k08/{$v.quotavalue}#map" cls2id="k08-{$i}" class="item-param k08single <if condition="strstr($_GET['k08'],$v['quotavalue'])">selected</if>">{$v.quotavalue}</a>
											<a class="item-param k08multiselect" style="display:none">
                                                <input type="checkbox" id="k08-{$i}" name="k08[]" value="{$v.quotavalue}">
                                                <label for="k08-{$i}">{$v.quotavalue}</label>
                                            </a>
										</volist>
										<input type="button" id="k08multisubmit" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="确定">
										<input type="button" id="k08multireset" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="取消">
									</div> 
								</div>
								<div class="ui-list-item-tail k08single" id="k08multi-btn"><a href="javascript:void(0);" class="multi-btn">多选</a></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">注册资本：</div>
								<div class="ui-list-item-body item-2-line" id="k04div">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k04/%/k04min/%/k04max/%/#map" class="item-param <if condition="$_GET['k04']==''||$_GET['k04']=='%'">selected</if>">不限</a>
										<volist name="parameter['k04']" id="v">
											<a href="__URL__/index{$query_params}/k04/{$v.quotavalue}/k04min/%/k04max/%/#map" class="item-param  <eq name="Think.get.k04" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
										<!-- <div id="k04custom"> -->
										<div>
											<input type="text" class="ui-input-small " style="width:50px;" name="k04min" id="k04min" value="<eq name="Think.get.k04min" value="%"><else/>{$_GET['k04min']}</eq>"/>&nbsp;-&nbsp;<input type="text" class="ui-input-small"  style="width:50px;" name="k04max" id="k04max" value="<eq name="Think.get.k04max" value="%"><else/>{$_GET['k04max']}</eq>"/>万元
											<input type="submit" id="k04submit" class="ui-button ui-button-swhite ui-button-vs" value="筛选"><span id="k04error" style="color:red;"></span>
										</div>
										<!-- </div>										 -->
									</div> 
								</div>
								<!-- <div class="ui-list-item-tail"><a href="javascript:void(0);" class="multi-btn" style="width:36px;text-align:center" onclick="setCustom('k04')" id="k04href">自定义</a></div> -->
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">成立年限：</div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k01/%#map" class="item-param <if condition="$_GET['k01']==''||$_GET['k01']=='%'">selected</if>">不限</a>
										<volist name="parameter['k01']" id="v">
											<a href="__URL__/index{$query_params}/k01/{$v.quotavalue}#map" class="item-param  <eq name="Think.get.k01" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">企业参保人数：</div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k06/%/k06min/%/k06max/%/#map" class="item-param <if condition="$_GET['k06']==''||$_GET['k06']=='%'">selected</if>">不限</a>
										<volist name="parameter['k06']" id="v">
											<a href="__URL__/index{$query_params}/k06/{$v.quotavalue}/k06min/%/k06max/%/#map" class="item-param  <eq name="Think.get.k06" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
										<input type="text" class="ui-input-small " style="width:50px;" name="k06min" id="k06min" value="<eq name="Think.get.k06min" value="%"><else/>{$_GET['k06min']}</eq>"/>&nbsp;-&nbsp;<input type="text" class="ui-input-small"  style="width:50px;" name="k06max" id="k06max" value="<eq name="Think.get.k06max" value="%"><else/>{$_GET['k06max']}</eq>"/>人
										<input type="submit" id="k06submit" class="ui-button ui-button-swhite ui-button-vs" value="筛选"><span id="k06error" style="color:red"></span>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">年度主营业务收入：</div>
								<div class="ui-list-item-body item-2-line">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k05/%/k05min/%/k05max/%/#map" class="item-param <if condition="$_GET['k05']==''||$_GET['k05']=='%'">selected</if>">不限</a>
										<volist name="parameter['k05']" id="v">
											<a href="__URL__/index{$query_params}/k05/{$v.quotavalue}/k05min/%/k05max/%/#map" class="item-param  <eq name="Think.get.k05" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
										<div>
											<input type="text" class="ui-input-small " style="width:50px;" name="k05min" id="k05min" value="<eq name="Think.get.k05min" value="%"><else/>{$_GET['k05min']}</eq>"/>&nbsp;-&nbsp;<input type="text" class="ui-input-small"  style="width:50px;" name="k05max" id="k05max" value="<eq name="Think.get.k05max" value="%"><else/>{$_GET['k05max']}</eq>"/>万元
											<input type="submit" id="k05submit" class="ui-button ui-button-swhite ui-button-vs" value="筛选"><span id="k05error" style="color:red;"></span>
										</div>
									</div>
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">人才类型：</div>
								<div class="ui-list-item-body item-2-line">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k09/%#map" class="item-param <if condition="$_GET['k09']==''||$_GET['k09']=='%'">selected</if>">不限</a>
										<volist name="parameter['k09']" id="v">
											<a href="__URL__/index{$query_params}/k09/{$v.quotavalue}#map" cls2id="k09-{$i}"
											class="item-param k09single <if condition="strstr($_GET['k09'],$v['quotavalue'])">selected</if>">{$v.quotavalue}</a>
											<a class="item-param k09multiselect" style="display:none"><input type="checkbox" id="k09-{$i}" name="k09[]" value="{$v.quotavalue}"><label for="k09-{$i}">{$v.quotavalue}</label></a>
										</volist>
										<input type="button" id="k09multisubmit" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="确定">
										<input type="button" id="k09multireset" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="取消">
									</div> 
								</div>
								<div class="ui-list-item-tail k09single" id="k09multi-btn"><a href="javascript:void(0);" class="multi-btn">多选</a></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">近三年获得园区科技资金： </div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k12/%#map" class="item-param <if condition="$_GET['k12']==''||$_GET['k12']=='%'">selected</if>">不限</a>
										<volist name="parameter['k12']" id="v">
											<a href="__URL__/index{$query_params}/k12/{$v.quotavalue}#map" class="item-param  <eq name="Think.get.k12" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">法人库状态： </div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k21/%#map" class="item-param <if condition="$_GET['k21']==''||$_GET['k21']=='%'">selected</if>">不限</a>
										<volist name="parameter['k21']" id="v">
											<a href="__URL__/index{$query_params}/k21/{$v.quotavalue}#map" class="item-param  <eq name="Think.get.k21" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item">
								<div class="ui-list-item-head">负面记录： </div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/f1/%#map" class="item-param <if condition="$_GET['f1']==''||$_GET['f1']=='%'">selected</if>">不限</a>
										<volist name="parameter['f1']" id="v">
											<a href="__URL__/index{$query_params}/f1/{$v.quotavalue}#map" cls2id="f1-{$i}" class="item-param f1single <if condition="strstr($_GET['f1'],$v['quotavalue'])">selected</if>">{$v.quotavalue}</a>
											<a class="item-param f1multiselect" style="display:none"><input type="checkbox" id="f1-{$i}" name="f1[]" value="{$v.quotavalue}">
                                                <label for="f1-{$i}">{$v.quotavalue}</label></a>
										</volist>
										<input type="button" id="f1multisubmit" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="确定">
										<input type="button" id="f1multireset" class="ui-button ui-button-swhite ui-button-vs" style="display:none" value="取消">
									</div> 
								</div>
								<!-- <div class="ui-list-item-tail f1single" id="f1multi-btn"><a href="javascript:void(0);" class="multi-btn">多选</a></div> -->
							</li>
							<li class="ui-list-item" style="display:none">
								<div class="ui-list-item-head">纳税状态： </div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k22/%#map" class="item-param <if condition="$_GET['k22']==''||$_GET['k22']=='%'">selected</if>">不限</a>
										<volist name="parameter['k22']" id="v">
											<a href="__URL__/index{$query_params}/k22/{$v.quotavalue}#map" class="item-param  <eq name="Think.get.k22" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<li class="ui-list-item" >
								<div class="ui-list-item-head">是否有贷款余额： </div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k60/%#map" class="item-param <if condition="$_GET['k60']==''||$_GET['k60']=='%'">selected</if>">不限</a>
										<volist name="parameter['k60']" id="v">
											<a href="__URL__/index{$query_params}/k60/{$v.quotavalue}#map" class="item-param  <eq name="Think.get.k60" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li>
							<!-- <li class="ui-list-item">
								<div class="ui-list-item-head">是否有负面记录： </div>
								<div class="ui-list-item-body">
									<div class="param-cont">
										<a href="__URL__/index{$query_params}/k20/%#map" class="item-param <if condition="$_GET['k20']==''||$_GET['k20']=='%'">selected</if>">不限</a>
										<volist name="parameter['k20']" id="v">
											<a href="__URL__/index{$query_params}/k20/{$v.quotavalue}#map" class="item-param  <eq name="Think.get.k20" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
										</volist>
									</div> 
								</div>
								<div class="ui-list-item-tail"></div>
							</li> -->
							<li class="ui-list-item last">
								<div class="param-container">
									<div class="param-cont">
										
										<label class="param-label">企业名称或法定代表人：</label>
										<input type="text"  class="ui-input-small" name="t1" value="{$_GET['t1']}"/>
										<label class="param-label">组织机构代码：  </label>
										<input type="text"  class="ui-input-small" name="t2" value="{$_GET['t2']}"/>
										<label class="param-label">注册地址： </label>
										<input type="text" class="ui-input-small" name="t3" value="{$_GET['t3']}"/>
										<label class="param-label"> </label>
										<input type="submit" class="ui-button ui-button-sblue" id="lastsubmit" value="确定" >
										
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
			    	<span class="ui-banner-text">符合条件的企业共 <span class="c_red b">{$EpSpaces['count']}</span> 家，清单如下</span> 
					<span class="ui-banner-tools"><a href="javascript:void(0)" class="serviceNodeTrigger ui-button ui-button-swhite">数据导出</a></span>
				</div>
				<!-- 信息提示  end -->
				
				<!-- 排序工具 begin  -->
				<div class="ui-box mt10 shadow">
				    <div class="ui-box-head">
				        <span class="ui-box-head-text">排序：<a name='order'></a><a href="__URL__/index{$query_params}/ord/%#order" class="ml5 <if condition="$_GET['ord']==''||$_GET['ord']=='%'">b</if>">默认排序</a>  <a href="__URL__/index{$query_params}/ord/k04#order" class="ml10 <eq name="Think.get.ord" value="k04">b</eq>">注册资本</a>  <a href="__URL__/index{$query_params}/ord/k01#order" class="ml10 <eq name="Think.get.ord" value="k01">b</eq>"> 成立年限</a> </span>
				        <a href="javascript:void(0)" class="ui-box-head-more"></a>
				    </div>
				</div>
				
				<!-- 排序工具 end -->
				
				<!--  查询结果 begin -->				
				<div class="ui-table-container shadow">
				    <table class="ui-table ui-table-follow">
				        <thead>
				            <tr>
				                <th width="28%">企业名称</th>
				                <th width="12%">组织机构代码</th>
				                <th width="17%">注册资本</th>
				                <th width="27%">注册地址</th>
				                <th width="10%">法人库状态</th>
				                <th width="6%">操作</th>
				            </tr>
				        </thead><!-- 表头可选 -->
				        <tbody>
				        	<volist name="EpSpaces['data']" id="vo" mod="2">
				        	<eq name="mod" value="0">
				            <tr>
				            <else/>
				            <tr class="ui-table-split">
				            </eq>
				                <td>{$vo.epname}</td>
				                <td>{$vo.organcode}</td>
				                <td>
				                	<if condition="$vo['regcapital']">{$vo.regcapital|format_money}<if condition="$vo['currency']=='美元'"><php>echo str_replace('元','',$vo['unit']);</php><else/>{$vo['unit']}</if>{$vo.currency}
				                	<else/>&nbsp;</if>
				                </td>
				                <td>{$vo.regaddress} </td>
				                <td>{$vo.epstatus}</td>
				                <td><a href="__URL__/detail/epid/{$vo.id}">详情</a></td>
				            </tr>
				            </volist>
				        </tbody>
				        <tfoot>
				            <tr>
				                <td colspan="6">
				                        
					                
									    <if condition="$EpSpaces['html']">
									    <div class="ui-paging">
									    {$EpSpaces['html']}
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