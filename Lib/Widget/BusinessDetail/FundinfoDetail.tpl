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
            <td>申请人名称：</td>
            <td>{$data['entername']}</td>
        </tr>
        <tr>
            <td>申请资金类型：</td>
            <td>{$data['fundtype']}</td>
        </tr>
        <tr>
            <td>拨付金额：</td>
            <td><if condition="$data['appropriateamount']">{$data['appropriateamount']|format_money1}万元人民币</if></td>
        </tr>
        <tr>
            <td>拨付年度：</td>
            <td>{$data['appropriateyear']}</td>
        </tr>
         <tr>
            <td>拨付批次：</td>
            <td>{$data['appropriatebatch']}</td>
        </tr>
        <tr>
            <td class="no-border-btm">拨款依据：</td>
            <td class="no-border-btm">{$data['appropriateaccord']}</td>
    </tbody>
</table>