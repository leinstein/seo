<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title="科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<style>
/* 选择框风格 */
.select-bar{    width:640px; top:32px; left:160px; }
</style>
</head>
<!--<script>
$(function(){     
    //产品资质多选
    $('#p01multi-btn').click(function(){         
        $('.p01single').hide();       
        $('.p01multiselect').show();
        $('#p01multisubmit').show();  
        $('#p01multireset').show();
    });
    $('#p01multireset').click(function(){
        $('.p01single').show();
        $('.p01multiselect').hide();
        $('#p01multisubmit').hide();
        $('#p01multireset').hide();               
    });
});
</script>-->
<body>
	<!-- 页面顶部 logo & 菜单 begin  -->
    <include file="../Public/top_banner" />
    <!-- 页面顶部 logo & 菜单 end  -->

    <div class="wrapper">
    	<!-- 顶部栏目导航 begin -->
    	<div class="ui-grid-row">
    		<div class="ui-grid-25">
    			<h2 class="ui-page-title">所有专利项目</h2>
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
                            <form name="form" method="get" action="__URL__">
                            <input type="hidden" name="m" value="Patentinfo"/>           
                            <input type="hidden" name="a" value="index"/>
                            <input type="hidden" name="k03" value="{$_GET['k03']}"/>
                            <input type="hidden" name="k04" value="{$_GET['k04']}"/>
                            <input type="hidden" name="k06" value="{$_GET['k06']}"/>
                            <input type="hidden" name="k01" value="{$_GET['k01']}"/>
                            <input type="hidden" name="p01" value="{$_GET['p01']}"/>
                            <input type="hidden" name="p02" value="{$_GET['p02']}"/>
                            <input type="hidden" name="t1" value="{$_GET['t1']}"/>
                            <input type="hidden" name="t2" value="{$_GET['t2']}"/>
                            <input type="hidden" name="t3" value="{$_GET['t3']}"/>
                            <input type="hidden" name="t4" value="{$_GET['t4']}"/>
                            <input type="hidden" name="ord" value="{$_GET['ord']}"/> 
    						
    					   <ul class="ui-list ui-list-query">                          
                            <li class="ui-list-item">
                                <div class="ui-list-item-head">专利类型：</div>
                                <div class="ui-list-item-body item-2-line" style="height:50px;">
                                    <div class="param-cont">
                                        <a href="__URL__/index{$query_params}/p01/%/" class="item-param <if condition="$_GET['p01']==''||$_GET['p01']=='%'">selected</if>">不限</a>
                                        <volist name="patenparameter['p01']" id="v">
                                            <a href="__URL__/index{$query_params}/p01/{$v.quotavalue}" 
                                                class="item-param  <eq name="Think.get.p01" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>                                           
                                        </volist>
                                    </div> 
                                </div>
                                
                            </li>  
                            <li class="ui-list-item">
                                <div class="ui-list-item-head">有效状态：</div>
                                <div class="ui-list-item-body item-2-line" style="height:50px;">
                                    <div class="param-cont">
                                        <a href="__URL__/index{$query_params}/p03/%/" class="item-param <if condition="$_GET['p03']==''||$_GET['p03']=='%'">selected</if>">不限</a>
                                        <volist name="patenparameter['p03']" id="v">
                                            <a href="__URL__/index{$query_params}/p03/{$v.quotavalue}" class="item-param  <eq name="Think.get.p03" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
                                        </volist>
                                    </div> 
                                </div>
                                <div class="ui-list-item-tail"></div>
                            </li>
                            <li class="ui-list-item">
                                <div class="ui-list-item-head">专利申请年度：</div>
                                <div class="ui-list-item-body item-2-line" style="height:50px;">
                                    <div class="param-cont">
                                        <a href="__URL__/index{$query_params}/p02/%/" class="item-param <if condition="$_GET['p02']==''||$_GET['p02']=='%'">selected</if>">不限</a>
                                        <volist name="patenparameter['p02']" id="v">
                                            <a href="__URL__/index{$query_params}/p02/{$v.quotavalue}" class="item-param  <eq name="Think.get.p02" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a>
                                        </volist>
                                    </div> 
                                </div>
                                <div class="ui-list-item-tail"></div>
                            </li> 

                            <li class="ui-list-item last">
                                <div class="param-container">
                                    <div class="param-cont">
                                        
                                            <label class="param-label">申请专利企业：</label>
                                            <input type="text"  class="ui-input-small" name="t1" value="{$_GET['t1']}"/>
                                            <label class="param-label">专利申请号：</label>
                                            <input type="text"  class="ui-input-small" name="t2" value="{$_GET['t2']}"/>
                                            <label class="param-label">专利发明人：</label>
                                            <input type="text" class="ui-input-small" name="t3" value="{$_GET['t3']}"/>
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
                    
                    <span class="ui-banner-text">共有 <span class="c_red b">{$Patentinfos['count']}</span> 个符合条件的结果<eq name="searchepdir" value="true">(您选择了包含企业属性的搜索条件，系统将会过滤掉没有关联企业的数据)</eq> ，清单如下</span> 
                    <span class="ui-banner-tools"><a href="javascript:;" class="ui-button ui-button-swhite">数据导出</a></span>                 
                </div>
                <!-- 信息提示  end -->
                
                <!-- 排序工具 begin  -->
                <div class="ui-box mt10  shadow">
                    <div class="ui-box-head">
                        <span class="ui-box-head-text">排序：<a  href="__URL__/index{$query_params}/ord/%/" class="ml5 <if condition="$_GET['ord']==''||$_GET['ord']=='%'">b</if>">默认排序</a> 
                                                            <a href="__URL__/index{$query_params}/ord/mainlegalpubdate/" class="ml10 <eq name="Think.get.ord" value="mainlegalpubdate">b</eq>">认定年度</a>  </span>
                        <a href="#" class="ui-box-head-more"></a>
                    </div>
                </div>
                <!-- 排序工具 end -->
                
                <!--  查询结果 begin -->                
                <div class="ui-table-container  shadow">
                    <table class="ui-table ui-table-follow">
                        <thead>
                            <tr>
                                <th width="20%">专利名称</th>
                                <th width="25%">申请专利企业名称</th>
                                <th width="15%">专利发明人</th>
                                <th width="10%">专利法律公布日</th>
                                <th width="14%">专利申请号</th>
                                <th width="10%">专利类型/有效状态</th>
                                <th width="6%">操作</th>
                            </tr>
                        </thead><!-- 表头可选 -->
                        <tbody>
                            <volist name="Patentinfos['data']" id="vo" mod="2">
                            <eq name="mod" value="0">
                            <tr>
                            <else/>
                            <tr class="ui-table-split" style="z-index:2;">
                            </eq>
                                <td>{$vo.title}</td>
                                <td>{$vo.applyer}</td>
                                <td>{$vo.inventor}</td>
                                <td>{$vo.mainlegalpubdate}</td>
                                <td>{$vo.applyno}</td>
                                <td>{$vo.patenttype}<br/>{$vo.mainlegalstatus}</td>
                                <td><a href="__URL__/detail/id/{$vo.iid}">详情</a></td>
                            </tr>
                            </volist>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <if condition="$Patentinfos['html']">
                                    <div class="ui-paging">
                                    {$Patentinfos['html']}
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