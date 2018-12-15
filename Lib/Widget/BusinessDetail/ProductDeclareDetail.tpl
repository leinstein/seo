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
            <td >证书企业名称：</td>
            <td >{$data['certentername']}</td>
        </tr>
        <tr >
            <td>资质类型：</td>
            <td>{$data['aptype']}</td>
        </tr>
        <tr>
            <td>产品类型：</td>
            <td>{$data['producttype']}</td>
        </tr>
        <tr >
            <td>认定年度：</td>
            <td>{$data['certyear']}</td>
        </tr>
        <tr >
            <td>产品名称：</td>
            <td>{$data['productname']}</td>
        </tr>
         <tr >
            <td>证书时间：</td>
            <td>{$data['certdate']}</td>
        </tr>
         <tr >
            <td>证书编号：</td>
            <td>{$data['certno']}</td>
        </tr>
        <tr >
            <td>发证机构：</td>
            <td>{$data['certorg']}</td>
        </tr>
        <tr>
            <td>有效期：</td>
            <td>{$data['valid']}</td>
        </tr>
        <tr>
            <td>状态：</td>
            <td>{$data['aptstatus']}</td>
        </tr>
        <tr>
            <td class="no-border-btm">说明：</td>
            <td class="no-border-btm">{$data['description']}</td>
        </tr>
    </tbody>
</table>