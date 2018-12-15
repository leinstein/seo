<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "业务管理台  |  研发项目确认";</php>
<head>
    <include file="../Public/header" />
	<script type="text/javascript" src="../Public/js/multiselect/jquery.multiselect2side.js"></script> 
	<script type="text/javascript" src="../Public/js/schedule.js"></script> 
	<link rel="stylesheet" type="text/css" href="../Public/js/multiselect/css/jquery.multiselect2side.css" /> 
	<style type="text/css">
		.ms2side__div select {
		width: 270px;
		float: left;
	}
    .ui-text-des
    {
        margin-left:auto;
        margin-right:auto;
        margin-top: 10px;
        text-indent: 2em;
        width: 80%;
        background: #F2F2F2 ;
        border: 1px solid black;
        padding: 10px;
        font-size: 120%;
    }
    .ui-text-link
    {
        margin-top: 20px;
        margin-left: 180px;
    }
    </style>
	</style>
</head>
<body>
        <!-- 全宽布局 begin -->
        <div class="ui-grid-row">
           	<!-- 字段信息 begin -->
            <div class="ui-box ui-box-section pb5">
                <div class="ui-box-head">
                    <h3 class="ui-box-head-title" style='font-size:16px;font-weight: bold;margin-left:10px'>数据导出向导</h3>
                </div>
        	</div>
            <div class = "ui-text-des">
                    您尚未申请<span herf="#" style="color:#0088cc">{$funname}数据导出功能</span>的使用授权，先完成申请，待审批通过后即可使用该功能。
            </div>
            <div class = "ui-text-link">
        	    <a class="ui-button ui-button-mblue text-center" href="{:C('funauthApplyUrl')}" target="_parent">申请功能授权</a>
        	</div><!-- 字段信息 end -->
        </div>
        <!-- 全宽布局 end -->
</body>
</html>