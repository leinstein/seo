<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<link href="../Public/css/ui-list.css" rel="stylesheet" />
<link href="../Public/css/ui-panel.css" rel="stylesheet" />
<link href="../Public/css/ui-box.css" rel="stylesheet" />
<link href="../Public/css/icons/iconfont.css" rel="stylesheet" />
<!-- 引入页面header部分 begin -->
<include file="../Public/header" />
<!-- 引入页面header部分 end -->

<!-- 加入页面需要调用的风格或者js脚本 -->
<script>
//加载
$(function(){
    var toggle_multi_option = function( single, multi ){
        $(single).toggle();
        $(multi).toggle();
        $(multi+" .ui-list-query-item").bind("click",function(){
            if( $(this).children("input[type='checkbox']:checked").val() == "on" )
                $(this).children("input[type='checkbox']").attr("checked",false);
            else
                $(this).children("input[type='checkbox']").attr("checked","checked");
        });
    }

//弹出层
    var choice_dialog = null;
    seajs.use(['popup'], function(Popup){
        /*弹出选择项*/
        choice_dialog = new Popup({
            trigger: '#choice-projecttype',
            triggerType: 'click',
            element: '#bizcate-options',
            effect: 'fade',
            align: {
                baseXY: [0, 26]
            }       
        });
    });
});

</script>

<!-- 可以加入该页面需要调用的特有的样式 -->
<style>
    .ui-panel-popup{
        width: 300px;
    }
    .ui-paging span{
        position: relative;
        top:0.5px;
    }
    .ui-paging a{
        position: relative;
        top:-1px;
    }
    .ui-list-query .ui-list-item .ui-list-item-body {
        padding : 0 52px 0 186px;
    }
    .ui-box-category {
        display: inline-block;
        border: none;
    }
    .ui-list .ui-list-category{
        padding: 0;
    }
    .ui-biz-panel .ui-panel-head-title {
        color: #656565;
        font-size: 13px;
        padding: 5px;
    }
    .ui-biz-panel .ui-panel-head {
       color: #656565;
        font-size: 13px;
        padding: 0 0 15px 0 ;
    }
    .ui-list-query .ui-list-item .ui-list-item-head {
        position: absolute;
        left: 1px;
        top: 8px;
        color: #666;
    }
    .ui-list-query .ui-list-item .ui-list-item-body {
        padding: 0 52px 0 146px;
    }
    .ui-panel-container {
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }   
    .ui-panel {
        margin-top: 15px;
        background-color: #FFFFFF;
        padding: 0 ;
        border: none;
        font-size: 13px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        -webkit-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }
    .ui-list-query {
        list-style: none;
        padding: 0;
        margin: 0;
        border-bottom: none;
    }
    .ui-panel-content {
        padding: 9px 8px 0 8px;
    }
</style>
</head>
<body>
    
    <!-- 页面顶部 logo & 菜单 begin  -->
    <include file="../Public/top_banner" />
    <!-- 页面顶部 logo & 菜单 end  -->
    
    <!-- 页面主体内容 begin -->
    <div class="main-wrapper">
        <div class="wrapper">
        
            <!-- 应用顶栏 begin  -->
            <!-- 应用顶栏 end  -->
            
            <!-- 页面正文内容 begin -->
            <div class="ui-grid-row">
                <div class="ui-grid-25">
                    
                    <!-- 页面导航栏正文内容 begin -->
                    <div class="ui-panel ui-biz-panel" style="margin-top: 0;">
                        <!-- 正文区标题 begin -->
                        <div class="ui-panel-head">
                            <h3 class="ui-panel-head-title">
                                领军空间</h3>
                        </div>
                        <!-- 正文区标题 end -->

                        <!-- 正文区容器 begin-->
                        <div class="ui-panel-container">
                            <div class="ui-box-head">
                                <div class="ui-box-head-border">
                                    <h3 class="ui-box-head-title"><a name="map"></a>查询条件</h3>
                                    <span class="ui-box-head-text"></span> <a href="__URL__" class="ui-box-head-more">清除所有条件</a>
                                </div>
                            </div>

                            <div class="ui-panel-content">
                                

                                <!-- 表单 begin -->
                                <form method="get" action="__URL__" name="form">
                                    <!-- 分组 -->
                                    <input type="hidden" name="g" value="{$Think.const.GROUP_NAME}"/>
                                    <!-- 控制器 -->
                                    <input type="hidden" name="s" value="{$Think.const.MODULE_NAME}"/>
                                    <!-- 方法 -->
                                    <input type="hidden" name="a" value="{$Think.const.ACTION_NAME}"/> 
                                    <input type="hidden" name="m" value="LeadingTalentSpace"/>
                                    <input type="hidden" name="a" value="index"/>
                                    <input type="hidden" name="k04" value="{$_GET['k04']}"/>
                                    <input type="hidden" name="k01" value="{$_GET['k01']}"/>
                                    <input type="hidden" name="k09" value="{$_GET['k09']}"/>
                                    <input type="hidden" name="ord" value="{$_GET['ord']}"/>
                                    <!-- 综合查询条件样式 begin -->
                                    <ul class="ui-list ui-list-query">
                                        <div class="clear"></div>
                                        <!-- 最高学历 begin  ch-->
                                        {:W('QueryParam',array('caption'=>'最高学历','queryfield'=>'k04','paramname'=>'k04','urlparams'=>$urlparams,'options'=>$k04config,'type'=>'single'))}
                                        <!-- 最高学历 end -->
                                        <?php 
                                            $i = 0;
                                            foreach ($k09config as  $value) {
                                                $k09config_new[$i]['nodename'] = $value['quotavalue'];
                                                $i++;
                                            }
                                         ?>
                                        <!-- 人才类型 begin -->
                                        {:W('QueryParam',array('caption'=>'人才类型','queryfield'=>'k09','paramname'=>'k09','urlparams'=>$urlparams,'options'=>$k09config_new,'type'=>'category'))}
                                        <!-- 人才类型 end -->

                                        <!-- 年龄 begin -->
                                        {:W('QueryParam',array('caption'=>'年龄','queryfield'=>'k01','paramname'=>'k01','urlparams'=>$urlparams,'options'=>$k01config,'type'=>'single'))}
                                        <!-- 年龄 end -->


                                        <!-- 输入条件  begin -->
                                        <li class="ui-list-itemline">
                                            <div class="ui-list-item-query-container">
                                                <div class="ui-list-item-query-padding">
                                                    <label class="query-label">领军姓名:</label>
                                                    <input class="ui-input-small" type="text" name="t1" value="{$Think.get.t1}" />
                                                    <label class="query-label">企业名称:</label>
                                                    <input class="ui-input-small" type="text" name="t2" value="{$Think.get.t2}" />
                                                    <label class="query-label">毕业学校:</label>
                                                    <input class="ui-input-small" type="text" name="k03" value="{$Think.get.k03}" />
                                                    <input type="submit" class="ui-button ui-button-sblue" value="搜索">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- 输入条件  end -->

                                    </ul>
                                    <!-- 综合查询条件样式 end -->
                                <!-- 表单 end -->
                                                                        
                                <!-- 查询统计结果样式 begin -->
                                <!-- <div class="ui-panel ui-panel-gray noborder">
                                    <ul class="ui-list ui-list-query ui-list-none">
                                        <li class="ui-list-itemline">
                                            <div class="ui-list-item-query-container">
                                                <div class="ui-list-item-query-padding">
                                                    <label class="query-label pr20">统计企业数量：<span class="c_lightblue">{$countinfo['enterCount']}</span> 家</label>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div> -->
                                <!-- 查询统计结果样式 end -->
                            </div>
                        </div>


                        <!-- 查询结果数量样式 begin -->
                        <div class="ui-panel noborder" style="margin-top:5px;">
                            <div class="ui-panel-content">
                                <span> 共有 <span class="c_orange b" style="color:orange">{$data['count']}</span> 个符合条件的结果</span>
                            </div>
                        </div>
                        <!-- 查询结果数量样式 end -->

                        <!-- 查询结果列表显示 begin -->
                                <div class="ui-box ui-box-queryresult" style="margin-top:8px;">
                                    
                                    <!-- 排序 begin -->
                                    <div class="ui-box-head ">
                                        <span class="ui-box-head-text">排序：
                                            <a href="__URL__/index{$urlparams}/ord/%" class="ml5 <if condition="$_GET['ord'] eq '%'">b</if>">默认排序</a>
                                            <a href="__URL__/index{$urlparams}/ord/k01" class="ml10 <if condition="$_GET['ord'] eq 'k01'">b</if>">年龄 </a></span>
                                    </div>
                                    <!-- 排序 end -->
                                    
                                    <!-- 查询结果表格显示样式 begin -->
                                    <div class="ui-box-container">
                                        <table class="ui-table ui-table-inbox f13">
                                        

                                            
                                            <!-- 表格内容部分 begin -->
                                            <neq name="data['data'] " value="">
                                                <!-- 表格头部 begin -->
                                                <thead>
                                                <th width="8%">领军姓名</th>
                                                <th width="14%">企业名称</th>
                                                <th width="8%">最高学历</th>
                                                <th width="17%">人才类型</th>
                                                <th width="5%">年龄</th>
                                                <th width="6%">操作</th>
                                                </thead>
                                                <!-- 表格头部 end -->

                                                <tbody>
                                                    <volist name="data['data']" id="v4">
                                                        <tr>
                                                            <td>{$v4.name}</td>
                                                            <td>{$v4.k00}</td>
                                                            <td>{$v4.k04}</td>
                                                            <td>{$v4.k09}</td>
                                                            <td>{$v4.k01}</td>
                                                            <td><a href="__URL__/baseInfo/id/{$v4.pieid}">详情</a></td>
                                                        </tr>
                                                    </volist>
                                                </tbody>
                                                <!-- 表格内容部分 end -->
                                            
                                                <!-- 表格底部 begin -->
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="ui-paging">
                                                                {$data['html']}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            <else/>
                                                <thead>
                                                    <tr>
                                                        <td colspan="6">暂无数据</td>
                                                    </tr>
                                                </thead>
                                            </neq>
                                            <!-- 表格底部 end -->
                                            
                                        </table>
                                    </div>
                                    <div class="clear"></div>
                                </div>  
                                <!-- 查询结果列表显示 end -->

                    </div>
                    <!-- 页面导航栏正文内容 end -->
                    
                </div>
            </div>
            <!-- 页面正文内容 end -->
            
        </div>
    </div>
    <!-- 页面主体内容 end -->
    
    <!-- 页面底部 begin  -->
    <include file="$footer" />
    <!-- 页面底部 end  -->
    
</body>
</html>