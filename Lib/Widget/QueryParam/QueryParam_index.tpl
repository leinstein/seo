<style>
    .ui-box-category {
        float: left;
        display: inline-block;
    }
    .ui-list-query .query-label ,.ui-panel{
        color: rgb(102, 102, 102);
        font-family: tahoma, arial, 'Hiragino Sans GB';
        font-size: 12px;
    }
</style>

<li class="ui-list-item" style="z-index:1;">
    <div class="ui-list-item-head">{$caption}:
    </div>
    <div class="ui-list-item-body">
        <div class="ui-list-item-query-padding">

            <!-- 标题以及初始下拉按钮 begin -->
            <a class="ui-list-query-item <if condition="($_GET[$paramname] eq '%' || $_GET[$paramname] eq '')">selected</if>" href="__URL__/{$Think.const.ACTION_NAME}/{$urlparams}/{$query_params}/{$paramname}/%">不限</a>

            <a class="ui-list-query-item <if condition="$_GET[$queryfield] neq $default && $_GET[$queryfield] neq '' && $_GET[$queryfield] neq '%'">selected</if>" id="choice-projecttype" href="#">
                <if condition="$_GET[$queryfield]=='' || $_GET[$queryfield]=='%'">
                    {$default}<i class="icon techsub f9 c_lightblue pl5">&#xe601;</i>
                <else/>{$_GET[$queryfield]}</if>
            </a>
            <!-- 标题以及初始下拉按钮 begin -->

            <!-- 下拉选择区 begin -->
            <div id="bizcate-options" class="ui-panel-popup" style="z-index:999;position:absolute;">
                <div class="ui-panel-popup-container">
                    <div class="ui-panel-popup-closebtn">
                        <a href="javascript:void();" onclick="choice_dialog.hide();">X</a>
                    </div>

                        <!-- 类型筛选条件 begin -->
                        <volist name="options" id="v0">                                                                                               
                            <div class="ui-box-category">

                                <h2 class="ui-box-category-caption ">
                                    <a href="__URL__/{$Think.const.ACTION_NAME}/{$urlparams}/{$queryfield}/{$v0['nodename']}" class="<if condition="$_GET[$paramname] eq $v0['nodename']">selected</if>">{$v0.nodename}</a>
                                </h2>

                                <ul class="ui-list ui-list-category">
                                    <volist name="v0._child" id="v1">
                                        <li class="ui-list-item"><a href="__URL__/{$Think.const.ACTION_NAME}/{$urlparams}/{$queryfield}/{$v1['nodename']}" class="<if condition="$_GET[$paramname] eq $v1['nodename']">selected</if>">{$v1.nodename}</a></li>
                                    </volist>
                                </ul>

                                <div class="clear"></div>
                            </div>
                        </volist> 
                        <!-- 类型筛选条件 end -->

                </div>
            </div>
            <!-- 下拉选择区 end -->

        </div>
    </div>
    <div class="ui-list-item-tail"></div>
</li>