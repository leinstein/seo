<style>
.ui-table .no-border-btm{border-bottom:none;}
</style>
<table class="ui-table ui-table-inbox"><!-- 可以在class中加入ui-table-inbox或ui-table-noborder分别适应不同的情况 -->
    <tbody>
        <tr>
            <td width="20%">企业名称：</td>
            <td width="80%">{$data.epname}</td>
        </tr>
        <tr class="ui-table-split">
            <td>人才名称：</td>
            <td>{$data.talentname}</td>
        </tr>
        <tr>
            <td>人才类型：</td>
            <td>{$data.projecttype}</td>
        </tr>
        <tr >
            <td>人才子类：</td>
            <td>{$data.projectclass}</td>
        </tr>
        <!-- <tr>
            <td>项目名称：</td>
            <td>{$data.projectname}</td>
        </tr>-->
         <tr>
            <td>认定年度：</td>
            <td>{$data.year}</td>
        </tr> 
        <tr>
            <td class="no-border-btm">状态：</td>
            <td class="no-border-btm">{$data.pjstatus}</td>
    </tbody>
</table>