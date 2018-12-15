<!-- 2014-11-28 跟黄经理确认，数据表里金额类数据的单位都是“万元人民币” -->
<style>
.ui-table .no-border-btm{border-bottom:none;}
</style>
<table class="ui-table ui-table-inbox"><!-- 可以在class中加入ui-table-inbox或ui-table-noborder分别适应不同的情况 -->
    <tbody>
    	<tr>
            <td width="20%">企业名称：</td>
            <td width="80%">{$data['epname']}</td>
        </tr>
         <tr>
            <td >贷款年度：</td>
            <td >{$data['year']}</td>
        </tr>
         <tr>
            <td>项目编号：</td>
            <td>{$data['projectid']}</td>
        </tr>
        <tr class="ui-table-split">
            <td>贷款项目名称：</td>
            <td>{$data['projectname']}</td>
        </tr>
       <tr>
            <td>贷款企业名称：</td>
            <td>{$data['entername']}</td>
        </tr>
        <tr>
            <td>组织机构代码：</td>
            <td>{$data['organcode']}</td>
        </tr>
        <tr>
            <td>申报日期：</td>
            <td>{$data['applydate']}</td>
        </tr>
        <tr>
            <td>贷款银行：</td>
            <td>{$data['recombank']}</td>
        </tr>
        <tr>
            <td>贷款金额：</td>
            <td><if condition="$data['actloanlimit']">{$data['actloanlimit']|format_money1}万元人民币</if></td>
        </tr>
         <tr>
            <td class="no-border-btm">说明：</td>
            <td class="no-border-btm">{$data['description']}</td>
        </tr>     
    </tbody>
</table>