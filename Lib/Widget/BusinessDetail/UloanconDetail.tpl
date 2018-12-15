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
            <td>签约企业名称：</td>
            <td>{$data['signentername']}</td>
        </tr>
        <tr>
            <td>放款年度：</td>
            <td>{$data['loanyear']}</td>
        </tr>
        <tr>
            <td>放款序号：</td>
            <td>{$data['loanno']}</td>
        </tr>
        <tr>
            <td>放款金额：</td>
            <td>{$data['loanamount']|format_money1}万元人民币</if></td>
        </tr>
        <tr>
            <td>已还本金：</td>
            <td><if condition="$data['loanamount']">{$data['haverepay']|format_money1}万元人民币</if></td>
        </tr>
        <tr>
            <td>贷款余额：</td>
            <td><if condition="$data['loanover']">{$data['loanover']|format_money1}万元人民币</if></td>
        </tr>
        <tr>
            <td>贷款期限：</td>
            <td><if condition="$data['timelimit']">{$data['timelimit']}月</if></td>
        </tr>
        <tr >
            <td>到期日期：</td>
            <td>{$data['expdate']}</td>
        </tr>
        <tr>
        <tr>
            <td>贷款银行：</td>
            <td>{$data['loanbank']}</td>
        </tr>
        <tr>
            <td>贷款利率：</td>
            <td><if condition="$data['arp']">{$data['arp']}%</if></td>
        </tr>
        <tr>
            <td>还款方式：</td>
            <td>{$data['repaystyle']}</td>
        </tr>
        <tr>
            <td>状态：</td>
            <td>{$data['loanstatus']}</td>
        </tr>
        <tr>
            <td class="no-border-btm">说明：</td>
            <td class="no-border-btm">{$data['description']}</td>
        </tr>
    </tbody>
</table>