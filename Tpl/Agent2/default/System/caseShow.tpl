<html lang = "en">
<head>
    <meta http-equiv = "content-type"
          content = "text/html; charset=UTF-8">
    <meta charset = "utf-8">
    <title>米同智能营销系统管理后台</title>
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
<!-- 面包屑导航 end --><div class = "ui-module">
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
                    <th class = "center">公司名称</th>
                    <th class = "center">公司网址</th>
                    <th class = "center">效果链接</th>

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
                            {$vo['name']}
                        </td>
                        <td class = "center">
                            {$vo['require']}
                        </td>
                        <td class = "center"><a href = "{$vo['needaudit']} "
                                                target="_blank">点击进入</a>>></td>
                    </tr>
                </foreach>

                </tbody>
            </table>
            <?php if ($LoginUserInfo['role_info']['id'] == '1' || $LoginUserInfo['role_info']['id'] == '2'){ ?>
                <div style="float: right">
                    <h3><span style="color: red">*</span>上传文件名改为bp.xls才可生效</h3>
                    <form id="upload" method='post' action="/Manage/System/caseShow_upload" enctype="multipart/form-data">
                        <input name="image" type="file" />
                        <input  type="submit" value="提交" >
                    </form>
                </div>
            <?php } ?>
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