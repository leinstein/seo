<html lang = "en">
<head>
    <meta http-equiv = "content-type"
          content = "text/html; charset=UTF-8">
    <meta charset = "utf-8">
    <title>智能营销系统管理后台</title>
    <meta name = "viewport"
          content = "width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <!--系统css-->
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Public/css/cloud-admin.css">
    <!--主题css-->
    <link rel = "stylesheet"
          type = "text/css"
          href = "../Public/css/default.css"
          id = "skin-switcher">
    <!--图标字体-->
    <link href = "../Public/css/font-awesome.min.css"
          rel = "stylesheet">
    <include file = "../Public/header"/>
    <!-- 自定义正则验证js  -->
    <script src = "__PUBLIC__/js/regular.js"></script>
    <!-- FONTS -->
    <!--字体-->
</head>
<body>
<!-- 页面顶部 logo & 菜单 begin  -->
<include file = "../Public/top_banner"/>
<!-- 页面顶部 logo & 菜单 end  -->

<!-- 页面左侧菜单 begin  -->
<include file = "../Public/left_miriadekeyword"/>
<!-- 页面左侧菜单 end  -->
<div class = "ui-module">
    <div class = "ui-content"
         id = "ui-content">
        <div class = "ui-panel">

            <table cellpadding = "0"
                   cellspacing = "0"
                   border = "0"
                   class = "datatable table table-striped table-bordered table-hover dataTable">
                <thead>
                <tr>
                    <th class = "center">序号</th>
                    <th class = "center">网站名称</th>
                    <th class = "center">网站地址</th>
                    <th class = "center">套餐类型</th>
                    <th class = "center">审批状态</th>
                    <th class = "center">下单账户</th>
                    <th class = "center">联系方式</th>
                    <th class = "center">更新时间</th>
                    <th class = "center">效果监控入口</th>
                </tr>
                </thead>
                <tbody>
                <foreach name = "data"
                         key = "key"
                         item = "vo">
                    <tr>
                        <td class = "center">
                            {$key+1}
                        </td>
                        <td class = "center">
                            {$vo['bp_sitename']}
                        </td>
                        <td class = "center">
                            <a href = " {:U('System/bpxdindex', array('id' => $vo['id']))}">{$vo['bp_site_url']}</a>
                        </td>
                        <?php $vo['bp_combo'] == '1' ? $combo = $vo["bp_price"].'/季度' : ($vo['bp_combo'] == '2' ? $combo = $vo["bp_price"].'/半年' : $combo = $vo["bp_price"].'/年'); ?>
                        <td class = "center">{$combo}</td>
                        <?php $vo['bp_check'] == '1' ? $check = '审核通过' : ($vo['bp_check'] == '2' ? $check = '审核驳回' : $check = '待审核'); ?>
                        <td class = "center">{$check}</td>
                        <td class = "center">{$vo['bp_username']}</td>

                        <td class = "center">{$vo['bp_telephone']}</td>

                        <td class = "center">{$vo['bp_updatetime']}</td>
                        <td class = "center">

                            <a href = "http://{$vo['bp_mosite_url']} " target="_blank"><?php if($vo['bp_mosite_url']){?>点击进入<?php }else{ ?><?php } ?></a><?php if($vo['bp_mosite_url']){?>>><?php }else{ ?><?php } ?>


                        </td>

                    </tr>
                </foreach>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!--/PAGE -->
<!-- JAVASCRIPTS -->
<!-- JQUERY -->
<script src = "../Public/js/jquery/jquery-2.0.3.min.js"></script>
<!-- /JAVASCRIPTS -->

</body>
</html>