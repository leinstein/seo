<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>

<!-- 引入页面header部分 begin -->
<include file="../Public/header" />
<link href="../Public/css/ui-list.css" rel="stylesheet" />
<link href="../Public/css/ui-panel.css" rel="stylesheet" />
<link href="../Public/css/ui-box.css" rel="stylesheet" />
<link href="../Public/css/icons/iconfont.css" rel="stylesheet" />
<!-- 引入页面header部分 end -->
<link href="../Public/css/epspace.css" rel="stylesheet">
<style>

</style>
<script>
//加载
$(function(){
    seajs.use(['tabs'], function(Tabs) {
        var t = new Tabs({
            classPrefix: '',
            triggers: '.ui-tab-items li',                               //trigger pulled
            element: '#leadingdata',                                //most outer carousel            
            triggerType:'hover',
            activeTriggerClass:'ui-tab-item-current',       //class when selected
            panels: ' .paragraph-level2 .paragraph-container',                                     //content carousel
            activeIndex: 0,                                               //first child
            effect: 'fade'
        });
    });
});
</script>
</head>
<body>
    <!-- 页面顶部 logo & 菜单 begin  -->
    <include file="../Public/top_banner" />
    <!-- 页面顶部 logo & 菜单 end  -->
        
    <!-- 页面主体内容 begin -->
    <div class="main-wrapper">
        <div class="wrapper">
        
            <!-- 应用顶栏 begin  -->
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

                                    <!-- 领军空间人才简介 begin -->
                                    {:w('LeadingTalentIntro')}
                                    <!-- 领军空间人才简介 end -->

                                    <!-- 领军空间分类信息容器 begin -->
                                    <div id="leadingdata" style="min-height: 215px;"> 

                                         <!-- 领军空间人才简介 begin -->
                                        <div class="ui-tab">
                                            <ul class="ui-tab-items">
                                                <li class="ui-tab-item" onClick="javascript:window.location.href='__URL__/baseInfo/id/{$_GET['id']}#tab-anchor' ">
                                                    <i class="icon techsub f30 c_lightblue ">&#xe61e;</i>
                                                    <a href="__URL__/baseInfo/id/{$_GET['id']}#tab-anchor">基本信息</a>
                                                </li>
                                                <li class="ui-tab-item" onClick="javascript:window.location.href='__URL__/baseInfo/id/{$_GET['id']}#tab-anchor' ">
                                                    <i class="icon techsub f30 c_lightblue ">&#xe61a;</i>
                                                    <a href="__URL__/baseInfo/id/{$_GET['id']}#tab-anchor">工作情况</a>
                                                </li>
                                                 <li class="ui-tab-item" onClick="javascript:window.location.href='__URL__/baseInfo/id/{$_GET['id']}#tab-anchor' ">
                                                    <i class="icon techsub f30 c_lightblue ">&#xe61c;</i>
                                                    <a href="__URL__/baseInfo/id/{$_GET['id']}#tab-anchor">教育情况</a>
                                                </li>
                                                 <li class="ui-tab-item" onClick="javascript:window.location.href='__URL__/baseInfo/id/{$_GET['id']}#tab-anchor' ">
                                                    <i class="icon techsub f30 c_lightblue ">&#xe61d;</i>
                                                    <a href="__URL__/baseInfo/id/{$_GET['id']}#tab-anchor">投资信息</a>
                                                </li>
                                                 <li class="ui-tab-item" onClick="javascript:window.location.href='__URL__/baseInfo/id/{$_GET['id']}#tab-anchor' ">
                                                    <i class="icon techsub f30 c_lightblue ">&#xe61d;</i>
                                                    <a href="__URL__/baseInfo/id/{$_GET['id']}#tab-anchor">担保信息</a>
                                                </li>
                                                 <li class="ui-tab-item" onClick="javascript:window.location.href='__URL__/baseInfo/id/{$_GET['id']}#tab-anchor' ">
                                                    <i class="icon techsub f30 c_lightblue ">&#xe61f;</i>
                                                    <a href="__URL__/baseInfo/id/{$_GET['id']}#tab-anchor">领军业务信息</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- 领军空间人才简介 end -->
                                 
                                        
                                        <!-- 信息正文 begin  -->
                                        <div class="ui-space-row">
                                            <div class="ui-space-body-paragraph paragraph-level2">

                                                <!-- 注册信息 begin -->
                                                <div class="paragraph-container">
                                                    <div class="paragraph-content">
                                                        <!-- 两栏列表文字 begin -->
                                                        <dl class="ui-dlist ui-dlist-col1">
                                                            <dt class="ui-dlist-tit">人才姓名：</dt>
                                                            <dd class="ui-dlist-det">{$data_baseinfo['name']} &nbsp;</dd>
                                                            <dt class="ui-dlist-tit">英文名：</dt>
                                                            <dd class="ui-dlist-det">{$data_baseinfo['ename']} &nbsp;</dd>
                                                            <dt class="ui-dlist-tit">证件类型：</dt>
                                                            <dd class="ui-dlist-det">{$data_pieinfo['identytype'] } &nbsp;</dd>
                                                            <dt class="ui-dlist-tit">移动电话：</dt>
                                                            <dd class="ui-dlist-det">{$data_baseinfo['mobilephone']} &nbsp;</dd> 
                                                        </dl>
                                                        <dl class="ui-dlist ui-dlist-col2">
                                                            <dt class="ui-dlist-tit">性别：</dt>
                                                            <dd class="ui-dlist-det">{$data_baseinfo['sex']} &nbsp;</dd>
                                                            <dt class="ui-dlist-tit">国籍：</dt>
                                                            <dd class="ui-dlist-det">{$data_baseinfo['nationality']} &nbsp;</dd>
                                                            <dt class="ui-dlist-tit">证件号：</dt>
                                                            <dd class="ui-dlist-det">{$data_pieinfo['identynum']} &nbsp; </dd>
                                                            <dt class="ui-dlist-tit">固定电话：</dt>
                                                            <dd class="ui-dlist-det">{$data_baseinfo['telephone']}&nbsp;</dd>
                                                        </dl>
                                                        <dl class="ui-dlist ui-dlist-col1">
                                                           <dt class="ui-dlist-tit">地址：</dt> 
                                                           <dd class="ui-dlist-det">{$data_baseinfo['address']} &nbsp;</dd>
                                                        </dl>
                                                        <div class="clear"></div>
                                                        <!-- 两栏列表文字 end -->
                                                    </div>
                                                </div>
                                                <!-- 注册信息 end -->

                                                <!-- 工作情况 begin -->
                                                <div class="paragraph-container">
                                                    <div class="paragraph-content">
                                                        <table class="ui-table ui-table-noborder">
                                                            <neq name="data_workinfo['data']" value="">
                                                            <thead>
                                                                <tr>
                                                                    <th width="20%">开始时间-截止时间</th>
                                                                    <th width="25%">职务</th>
                                                                    <th width="45%">单位</th>
                                                                    <th width="10%">国家</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <volist name="data_workinfo['data']" id="vo">
                                                                    <tr>
                                                                    <td>{$vo.starttime}-{$vo.endtime}</td>
                                                                    <td>{$vo.position}</td>
                                                                    <td>{$vo.unitname}</td>
                                                                    <td>{$vo.country}</td>
                                                                    </tr>
                                                                </volist>
                                                            </tbody>
                                                            <else/>
                                                            <thead>
                                                                <tr>
                                                                        <td colspan="4">暂无数据</td>
                                                                </tr>
                                                            </thead>
                                                            </neq>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- 工作情况 end -->

                                                <!-- 教育情况 begin -->
                                                <div class="paragraph-container">
                                                    <div class="paragraph-content">
                                                          <table class="ui-table ui-table-noborder">
                                                                <neq name="data_education['data']" value="">
                                                                <thead>
                                                                  <tr>
                                                                    <th width="20%">开始时间-截止时间</th>
                                                                    <th width="30%">学校</th>
                                                                    <th width="20%">专业</th>
                                                                    <th width="20%">学位</th>
                                                                    <th width="10%">国家</th>
                                                                  </tr>
                                                                </thead>
                                                                <tbody>
                                                                  <volist name="data_education['data']" id="vo">
                                                                    <tr>
                                                                      <td>{$vo.starttime}-{$vo.endtime}</td>
                                                                      <td>{$vo.school}</td>
                                                                      <td>{$vo.specializedsubject}</td>
                                                                      <td>{$vo.degree}</td>
                                                                      <td>{$vo.country}</td>
                                                                    </tr>
                                                                  </volist>
                                                                </tbody>
                                                                    <else/>
                                                                        <thead>
                                                                            <tr>
                                                                                <td colspan="5">暂无数据</td>
                                                                            </tr>
                                                                        </thead>
                                                                    </neq>
                                                          </table>
                                                    </div>
                                                 </div>
                                                <!-- 教育情况 end -->

                                                <!-- 投资信息 begin -->
                                                <div class="paragraph-container">
                                                    <div class="paragraph-content">
                                                    
                                                        <table class="ui-table ui-table-noborder">
                                                            <neq name="data_investmentinfo['data'] " value="">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="20%">投资时间</th>
                                                                        <th width="20%">投资金额</th>
                                                                        <th width="40%">投资企业名称</th>
                                                                        <th width="20%">股份占比 %</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <volist name="data_investmentinfo['data']" id="vo">
                                                                        <tr>
                                                                            <td>{$vo.investmenttime}</td>
                                                                            <td>{$vo.investsum} {$vo.unit}{$vo.currency}</td>
                                                                            <td>{$vo.investorganname}</td>
                                                                            <td>{$vo.shareaccount}</td>
                                                                        </tr>
                                                                    </volist>
                                                                </tbody>
                                                             <else/>
                                                                <thead>
                                                                    <tr>
                                                                        <td colspan="4">暂无数据</td>
                                                                    </tr>
                                                                </thead>
                                                            </neq>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- 投资信息 end -->

                                                <!-- 担保情况 begin -->
                                                <div class="paragraph-container">
                                                    <div class="paragraph-content">
                                                    
                                                      <table class="ui-table ui-table-noborder">
                                                        <neq name="data_guarantinfo['data'] " value="">
                                                        <thead>
                                                          <tr>
                                                            <th width="10%">签约日期</th>
                                                            <th width="10%">合同金额</th>
                                                            <th width="9%">合同编号</th>
                                                            <th width="25%">被担保人</th>
                                                            <th width="15%">到期日期</th>
                                                            <th width="15%">合同状态</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                          <volist name="data_guarantinfo['data']" id="vo">
                                                            <tr>
                                                              <td>{$vo.condate}</td>
                                                              <td>{$vo['conamount']|format_money}元</td>
                                                              <td>{$vo.contractid}</td>
                                                              <td>{$vo.contractapplyer}</td>
                                                              <td>{$vo.expdate}</td>
                                                              <td>{$vo.constate}</td>
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
                                                    </div>
                                                </div>
                                                <!-- 担保情况 begin -->

                                                <!-- 领军业务信息 begin -->
                                                <div class="paragraph-container">
                                                    <div class="paragraph-content">
                                                         <table class="ui-table ui-table-inbox">
                                                            <neq name="data_businessinfo" value="">
                                                                <thead>
                                                                  <tr>
                                                                     <th>申报年度</th>
                                                                     <th>人才类型</th>
                                                                     <th>人才子类</th>
                                                                     <th>项目名称</th>
                                                                     <th>状态</th>
                                                                   </tr>
                                                                 </thead>

                                                                 <tbody>
                                                                     <volist name='data_businessinfo' id='vo'>
                                                                         <tr>
                                                                             <td>{$vo.applyyear}</td>
                                                                             <td>{$vo.projecttype}</td>
                                                                              <td>{$vo.projectclass}</td>
                                                                               <td>{$vo.projectname}</td>
                                                                               <td>{$vo.pjstatus}</td>
                                                                         </tr> 
                                                                    </volist>
                                                                 </tbody>
                                                             <else/>
                                                                <thead>
                                                                    <tr>
                                                                        <td colspan="4">暂无数据</td>
                                                                    </tr>
                                                                </thead>
                                                            </neq>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- 领军业务信息 begin -->
                                            </div>
                                        </div>
                                        <!-- 信息正文 begin  -->


                                    </div>
                                    <!-- 领军空间分类信息容器 end -->

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