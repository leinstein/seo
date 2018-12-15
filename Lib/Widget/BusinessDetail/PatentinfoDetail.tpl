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
            <td>专利名称：</td>
            <td>{$data.title}</td>
        </tr>
        <tr>
            <td>专利类型：</td>
            <td>{$data.patenttype}</td>
        </tr>
        <tr >
            <td>专利申请号：</td>
            <td>{$data.applyno}</td>
        </tr>
        <!-- <tr>
            <td>项目名称：</td>
            <td>{$data.projectname}</td>
        </tr>-->
        <tr >
            <td>专利申请日：</td>
            <td>{$data.applydate}</td>
        </tr>
        <tr >
            <td>专利授权日：</td>
            <td>{$data.authorizedate}</td>
        </tr>
        <tr >
            <td>专利申请人：</td>
            <td>{$data.applyer}</td>
        </tr>
        <tr >
            <td>专利申请人组织机构代码：</td>
            <td>{$data.applyerepid}</td>
        </tr>
        <tr >
            <td>发明人：</td>
            <td>{$data.inventor}</td>
        </tr>
        <tr >
            <td>主法律公布日期：</td>
            <td>{$data.mainlegalpubdate}</td>
        </tr>
        <tr >
            <td>代理人：</td>
            <td>{$data.agent}</td>
        </tr>
         <tr>
            <td>代理机构：</td>
            <td>{$data.agentinstitution}</td>
        </tr> 
        <tr>
            <td>最新主法律状态：</td>
            <td>{$data.mainlegalstatus}</td>
        </tr> 
    </tbody>
</table>

