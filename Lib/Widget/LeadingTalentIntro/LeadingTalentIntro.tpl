 <!-- 空间头 - 企业名称，logo等 begin -->
<div class="ui-space-header">                           
    <div class="ui-space-header-logo">
        <img class="eplogo" src="__ROOT__/Upload/ltSpaceImg/{$data_baseinfo['picturepath']}" onerror="javascript:this.src='../Public/img/default-logo.png' ">
    </div>
    <div class="ui-space-header-epkey">
        <h2>
            {$data_baseinfo['name']} 
            <span class="f14 pl10" style="color:#1E90FF">
                <a href="{:U('EpSpace/detail', array('epid'=>$data_enterprise['organcode']))}" target="_blank">
                    {$data_enterprise['entername']}
                </a></span>
            <span class="f12 c_gray pl10">{$data_enterprise['position']}&nbsp;</span> </h2>
        <ul class="ui-space-epapts"> 
            <?php $talenttype = explode(',' , $model_property['k09']); ?>
            <neq name="talenttype " value="">
                <volist name="talenttype" id="v0">
                    <li class="ui-item-epapt b">{$v0 }</li> 
                </volist>
            </neq> 
        </ul>
    </div>
    <div class="ui-space-header-flag">
    </div>                          
</div>
<!-- 空间头 - 企业名称，logo等 end -->

<!-- 空间主体 begin -->
<div class="ui-space-body">
    
    <!-- 企业简介 begin -->
    <div class="ui-space-body-paragraph paragraph-epsummary">
            <div class="paragraph-head">
                <h3 class="paragraph-head-title">人才简介</h3>
            </div>
            <div class="paragraph-containe">
                <div class="paragraph-content">
                        <p>{$data_baseinfo['talentintro']}</p>
                        <button id="p1t">显示全部</button>
                </div>
            </div>
    </div>
    <!-- 企业简介 end -->

    <!-- 信息摘要和地图 begin -->
    <div class="ui-space-row">
        <!-- 信息摘要 begin -->
        <div class="ui-space-25">
            <div class="ui-space-body-paragraph paragraph-keyinfo">
                <div class="paragraph-head">
                    <h3 class="paragraph-head-title">关键指标</h3>
                    <span class="paragraph-head-text"></span>
                </div>
                <div class="paragraph-container">
                    <div class="paragraph-content">
                        <table class="ui-table ui-table-noborder ui-table-dashline">
                            <tbody>
                                <neq name="data_baseinfo" value="">
                                    <neq name="data_baseinfo['birthdate']" value="">
                                        <tr>
                                            <td style="width:20%;">年龄：</td>
                                            <td style="width:18%;">
                                                <?php echo(date('Y-m-d') - format_date($data_baseinfo['birthdate'])  ); ?>岁
                                            </td>
                                            <td style="width:62%;">
                                            </td>
                                        </tr>
                                    </neq>
                                    <neq name="data_baseinfo['specializedsubject']" value="">
                                     <tr>
                                        <td style="width:20%;">专业领域：</td>
                                        <td style="width:18%;">
                                            {$data_baseinfo['specializedsubject']}</td>
                                        <td style="width:62%;">
                                        </td>
                                    </tr>
                                    </neq>
                                    <neq name="data_baseinfo['highestedulevel']" value="">
                                        <tr>
                                            <td style="width:20%;">最高学历：</td>
                                            <td style="width:18%;">
                                                  {$data_baseinfo['highestedulevel']}</td>
                                            <td style="width:62%;">
                                            </td>
                                        </tr>
                                    </neq>
                                <else/>
                                    <tr>
                                        <td style="width:20%;">暂无数据</td>
                                        <td style="width:18%;"></td>
                                        <td style="width:62%;"></td>
                                    </tr>
                                </neq>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- 信息摘要 end -->
    </div>
    <!-- 信息摘要和地图 end -->
</div>
<!-- 空间主体 begin -->

<script>  
    $(window).load(function(){
        var txt=$(".paragraph-content > p").text();
        var len=txt.length;
        var sum="";

        /*字数大于400 */
        if(len>=100){
            for(i=0;i<100;i++){
                sum=sum+txt[i];
            }
            $(".paragraph-content > p").text(sum+"......");
        }
/*字数小于400 */
        if(len<100){
            $("#p1t").hide();
        }
/*点击显示全部和隐藏 */
        $("#p1t").click(function(){
            if($(this).text()=="显示全部"){
                $(".paragraph-content > p").text(txt);
                $(this).text("隐藏");
            }else{
                $(".paragraph-content > p").text(sum+"......");
                $(this).text("显示全部");
            }
        });
    });
</script>
<style type="text/css">
     #p1t {
        float: right;
        margin: 10px 15px 10px;
        padding: 3px 10px 3px 10px;
     }
</style>