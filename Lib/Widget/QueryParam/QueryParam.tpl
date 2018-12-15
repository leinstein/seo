<li class="ui-list-item">
    <div class="ui-list-item-head">{$caption}:
    </div>
    <div class="ui-list-item-body">
        <div class="ui-list-item-query-padding">
            
            <!-- 单选选项 begin -->
            <span class="single-option-{$queryfield}">
                <a class="ui-list-query-item <if condition="($_GET[$paramname] eq '%' || $_GET[$paramname] eq '')">selected</if>" href="__URL__/{$Think.const.ACTION_NAME}/{$urlparams}/{$paramname}/%">不限</a>
                 <volist name="options" id="v1">
                    <a class="ui-list-query-item <if condition="($_GET[$paramname] eq $v1['quotavalue']) || in_array($v1['quotavalue'],$_GET[$paramname])">selected</if>" href="__URL__/{$Think.const.ACTION_NAME}/{$urlparams}/{$paramname}/{$v1['quotavalue']}">{$v1.quotavalue}</a>
                </volist> 
            </span>
            <!-- 单选选项 end --> 
            
            <span class="multi-option-{$queryfield} hide">
                <!-- 多选选项 begin -->
                <volist name="options" id="v2">
                   <a class="ui-list-query-item" href="javascript:void(0);"><input type="checkbox" name="{$paramname}[]" value="{$v2.quotavalue}"/>{$v1.quotavalue}</a>
                </volist>
                <!-- 多选选项 end -->

                <!-- 确定和返回按钮 begin -->
                <input type="submit" class="ui-button ui-button-sorange" value="确定">
                <input type="button" class="ui-button ui-button-swhite" onclick="toggle_multi_option('.single-option-{$queryfield}','.multi-option-{$queryfield}')" value="取消">
            </span>
            <!-- 确定和返回按钮 end -->
        </div>
    </div>
    <eq name="type" value="multi">
        <div class="ui-list-item-tail single">
            <a href="javascript:void(0);" class="multi-btn" onclick="toggle_multi_option('.single-option-{$queryfield}','.multi-option-{$queryfield}')">多选</a>
        </div>
    </eq>
</li>