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
        <tr>
            <td>投资年度：</td>
            <td>{$data['investyear']}</td>
        </tr>
        <tr>
            <td>投资总额：</td>
            <td><if condition="$data['investsum']">{$data['investsum']|format_money1}万元人民币</if></td>
        </tr>
        <tr>
            <td>投资股权份额：</td>
            <td><if condition="$data['stake']">{$data['stake']}%</if></td>
        </tr>
        <tr>
            <td>已出金额：</td>
            <td><if condition="$data['actfundsum']">{$data['actfundsum']|format_money1}万元人民币</if></td>
        </tr>
        <tr>
            <td >投后估值：</td>
            <td><if condition="$data['afterinvestval']">{$data['afterinvestval']|format_money1}万元人民币</if></td>
        </tr>
        <tr>
            <td>最近一次融资估值：</td>
            <td><if condition="$data['recentfinancing']">{$data['recentfinancing']|format_money1}万元人民币</if></td>
        </tr>
        <tr>
            <td>退出年度：</td>
            <td>{$data['quityear']}</td>
        </tr>
        <tr>
            <td>退出回收金额：</td>
            <td><if condition="$data['outsum']">{$data['outsum']|format_money1}万元人民币</if></td>
        </tr>
        <tr>
            <td>状态：</td>
            <td>{$data['pjstatus']}</td>
        </tr>
        <tr>
            <td class="no-border-btm">说明：</td>
            <td class="no-border-btm">{$data['description']}</td>
        </tr>
    </tbody>
</table>