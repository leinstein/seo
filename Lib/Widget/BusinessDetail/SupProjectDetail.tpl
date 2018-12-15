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
            <td>申报年度：</td>
            <td>{$data['applyyear']}</td>
        </tr>
        <tr>
            <td>立项年度：</td>
            <td>{$data['year']}</td>
        </tr>
        <tr>
            <td>立项文号：</td>
            <td>{$data['projectdocid']}</td>
        </tr>
        <tr>
            <td>立项编号：</td>
            <td>{$data['projectid']}</td>
        </tr>
        <tr>
            <td>项目级别：</td>
            <td>{$data['projectlevel']}</td>
        </tr>
        <tr>
            <td>项目名称：</td>
            <td>{$data['projectname']}</td>
        </tr>
        <tr>
            <td>项目类型：</td>
            <td>{$data['projecttype']}</td>
        </tr>
        <tr>
            <td>项目子类：</td>
            <td>{$data['subclass']}</td>
        </tr>
        <tr>
            <td>项目执行期（起始时间）：</td>
            <td>{$data['projectstarttime']}</td>
        </tr>
        <tr>
            <td>项目执行期（截止时间）：</td>
            <td>{$data['projectendtime']}</td>
        </tr>
        <tr>
            <td>项目新增投入：</td>
            <td><if condition="$data['addfunding']">{$data['addfunding']|format_money1}万元人民币</if></td>
        </tr>
        <tr>
            <td>项目状态：</td>
            <td>{$data['pjstatus']}</td>
        </tr>
        <tr>
            <td>主管单位：</td>
            <td>{$data['headunit']}</td>
        </tr>
        <tr>
            <td>上级资金拨款总额：</td>
            <td><if condition="$data['highfunding']">{$data['highfunding']|format_money1}万元人民币</if></td>
        </tr>
        <tr>
            <td>上级已拨款金额：</td>
            <td><if condition="$data['highhavefunding']">{$data['highhavefunding']|format_money1}万元人民币</if></td>
        </tr>
        <tr>
            <td>园区确认配套金额：</td>
            <td><if condition="$data['parkmatchtotal']">{$data['parkmatchtotal']|format_money1}万元人民币</if></td>
        </tr>
        <tr>
            <td class="no-border-btm">园区已配套金额：</td>
            <td class="no-border-btm"><if condition="$data['parkhavematchtotal']">{$data['parkhavematchtotal']|format_money1}万元人民币</if></td>
        </tr>
    </tbody>
</table>