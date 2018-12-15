 <!-- 页面切换标签样式 begin -->
 <div class="ui-tab">
    <ul class="ui-tab-items">
        <li class="ui-tab-item" onClick="javascript:window.location.href='__URL__/baseInfo/id/{$_GET['id']}#tab-anchor' ">
            <i class="icon techsub f30 c_lightblue ">&#xe61e;</i>
            <a href="__URL__/baseInfo/id/{$_GET['id']}#tab-anchor">基本信息</a>
        </li>
        <li class="ui-tab-item" onClick="javascript:window.location.href='__URL__/workInfo/id/{$_GET['id']}#tab-anchor' ">
            <i class="icon techsub f30 c_lightblue ">&#xe61a;</i>
            <a href="__URL__/workInfo/id/{$_GET['id']}#tab-anchor">工作情况</a>
        </li>
         <li class="ui-tab-item" onClick="javascript:window.location.href='__URL__/educationInfo/id/{$_GET['id']}#tab-anchor' ">
            <i class="icon techsub f30 c_lightblue ">&#xe61c;</i>
            <a href="__URL__/educationInfo/id/{$_GET['id']}#tab-anchor">教育情况</a>
        </li>
         <li class="ui-tab-item" onClick="javascript:window.location.href='__URL__/investmentInfo/id/{$_GET['id']}#tab-anchor' ">
            <i class="icon techsub f30 c_lightblue ">&#xe61d;</i>
            <a href="__URL__/investmentInfo/id/{$_GET['id']}#tab-anchor">投资信息</a>
        </li>
         <li class="ui-tab-item" onClick="javascript:window.location.href='__URL__/guaranteeInfo/id/{$_GET['id']}#tab-anchor' ">
            <i class="icon techsub f30 c_lightblue ">&#xe61d;</i>
            <a href="__URL__/guaranteeInfo/id/{$_GET['id']}#tab-anchor">担保信息</a>
        </li>
         <li class="ui-tab-item" onClick="javascript:window.location.href='__URL__/businessInfo/id/{$_GET['id']}#tab-anchor' ">
            <i class="icon techsub f30 c_lightblue ">&#xe61f;</i>
            <a href="__URL__/businessInfo/id/{$_GET['id']}#tab-anchor">领军业务信息</a>
        </li>
    </ul>
</div>
 <a id="tab-anchor">
<!-- 页面切换标签样式 end -->
<script>

//加载
$(function(){
    //当前url
    var url = window.location.href;

    var strs = new  Array();
    //分割当前url
    strs = url.split ('/');
    for(items in strs){
        if(strs[items] == 'LeadingTalentSpace'){
            var action_index = items;
        }
    }
    var function_index =  parseInt(action_index) +1;
    var function_this = strs[function_index];
    var action_this = strs[action_index];
    //遍历tab内a连接
    $(".ui-tab-items a" ).each(function(){
        //遍历tab链接
        var link = $(this).attr('href');
        //拆分链接
        var linkstrs = link.split('/');
        //保存当前元素指针
        var self = $(this);
        $.each(linkstrs,function(i,n){
           //定位action来定位function
            if( n == action_this){
                var function_and_anchor = linkstrs[i+1];
                var function_str = function_and_anchor.split('#');
                var function_in_link = function_str[0];
                //定位function
                if(function_in_link == function_this  || function_this == function_and_anchor){
                    //addclass
                     self.parent().addClass(' ui-tab-item-current');
                }
            }
        });
    });   
});

</script>