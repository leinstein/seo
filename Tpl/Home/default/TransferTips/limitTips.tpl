<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "数据导出";</php>
<head>
    <include file="../Public/header" />
	<style type="text/css">
    .ui-text-des
    {
        margin-left:10px;
        margin-right:20px;
        margin-top: 10px;
        text-indent: 2em;
        background: #F2F2F2 ;
        border: 1px solid black;
        padding: 5px;
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
                    <h3 class="ui-box-head-title" style='font-size:16px;font-weight: bold;margin-left:10px'>数据导出提示</h3>
                </div>
        	</div>
            <div class = "ui-text-des">
                <eq name="Think.get.num" value="0">
                    对不起，符合筛选条件的记录数为<span style="color:red">0</span>条，无法导出！
                <else />
                    对不起，本系统支持数据导出的最大记录数为<span style="color:red"> {:C('EXPORT_NUM')}</span> 条，请您重新选择筛选条件！
                </eq>
            </div>
        </div>
        <!-- 全宽布局 end -->
</body>
</html>