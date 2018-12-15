<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>

<!-- 引入页面header部分 begin -->
<include file="../Public/header" />
<!-- 引入页面header部分 end -->
<link href="../Public/css/epspace.css" rel="stylesheet">
<style>

</style>
<script>
//加载
$(function(){
  
});

</script>
</head>
<body>
    <!-- 页面顶部 logo & 菜单 begin  -->
    <include file="$top_banner"/>
    <!-- 页面顶部 logo & 菜单 end  -->
        
    <!-- 页面主体内容 begin -->
    <div class="main-wrapper">
        <div class="wrapper">
        
            <!-- 应用顶栏 begin  -->
            <include file="../Public/LeadingTalentBanner" />
            <!-- 全宽布局 begin -->
            <div class="ui-grid-row">
                <div class="ui-grid-25">
                        
                        <!-- 页面导航栏正文内容 begin -->
                        <div class="ui-panel ui-biz-panel">
                            <!-- 正文区标题 begin -->
                            <div class="ui-panel-head">
                                <h3 class="ui-panel-head-title"><i class="icon techsub f16 b c_grayblue">|&nbsp;</i>领军空间</h3>
                                <input type = "button"   class="ui-button ui-button-mwhite fr" value="返回" onClick="window.location.href='__URL__/index' " />
                            </div>
                            <!-- 正文区标题 end -->

                            <!-- 正文区容器 begin-->
                            <div class="ui-panel-container">
                                <div class="ui-panel-content pt20">

                                    <!-- 1 begin -->
                                    <div id="epdata"> 

                                         <!-- 领军空间人才简介 begin -->
                                        {:w('LeadingTalentIntro')}
                                        <!-- 领军空间人才简介 end -->
                                        
                                            <!-- 页面切换标签样式 begin -->
                                             <include file="../Public/LeadingTalentTabs" /> 
                                            <!-- 页面切换标签样式 end -->

                                            <!-- 信息正文 begin  -->
                                            <div class="ui-space-row">

                                                <!-- 左侧正文内容 begin -->

                                                <!-- 企业基本信息 begin -->
                                               <!--  <div class="ui-space-body-paragraph paragraph-level1">
                                                    <div class="paragraph-head">
                                                        <h3 class="paragraph-head-title"><a name="baseinfo"></a><span class="title-no">1</span><span class="title-text">企业基本信息</span> </h3>
                                                    </div>
                                                    <div class="paragraph-container" style="display:none;">
                                                        <div class="paragraph-content">
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- 企业基本信息 begin -->

                                                <!-- 注册信息 begin -->
                                                <div class="ui-space-body-paragraph paragraph-level2">
                                                    <!-- <div class="paragraph-head">
                                                        <h3 class="paragraph-head-title"><a name="reg"></a>注册信息 </h3>
                                                    </div> -->
                                                    <div class="paragraph-container">
                                                        <div class="paragraph-content">
                                                            <!-- 两栏列表文字 begin -->
                                                            
                                                                <table class="ui-table ui-table-noborder">
                                                                    <neq name="data_Familyinfo" value="">
                                                                        <thead>
                                                                           <tr>
                                                                                <th>关系</th>
                                                                                <th>姓名</th>
                                                                                <th>年龄</th>
                                                                                <th>国籍</th>
                                                                                <th>所在单位</th>
                                                                                <th>职务</th> 
                                                                           </tr> 
                                                                        </thead>                                                                
                                                                        <tbody>
                                                                             <volist name='data_Familyinfo' id='v0'>
                                                                                <tr>
                                                                                <td>{$v0.relationship}</td>
                                                                                <td>{$v0.name}</td>
                                                                                <td>{$v0.age}</td>
                                                                                <td>{$v0.nationality}</td>
                                                                                <td>{$v0.unitname}</td>
                                                                                <td>{$v0.position}</td>
                                                                                </tr>
                                                                            </volist>
                                                                        </tbody>
                                                                    <else/>
                                                                        <thead>
                                                                             <tr>
                                                                                <td colspan="6">暂无数据</td>
                                                                             </tr>
                                                                        </thead>
                                                                    </neq>                                                           
                                                                </table>
                                                            
                                                            <!-- 两栏列表文字 end -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- 注册信息 end -->

                                                <!-- 左侧正文内容 end -->
                                            </div>
                                            <!-- 信息正文 end  -->
                                        </div>
                                        <!-- 空间主体 end -->
                                    </div>
                                    <!-- 2 end -->

                                </div>
                            </div>
                        </div>       
                        <!-- 页面导航栏正文内容 end -->

                 </div>
            </div>               
            <!-- 全宽布局 end -->
        </div>
    </div>
</body>
</html>