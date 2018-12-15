<div class="ui-box ui-box-follow shadow">
    <div class="ui-box-head">
        <div class="ui-box-head-border">
            <h3 class="ui-box-head-title">产业分类</h3>
            <span class="ui-box-head-text"></span> <a href="#" class="ui-box-head-more"></a>
        </div>
    </div>
    <div class="ui-box-container">
        <div class="ui-box-content">
            <ul class="ui-list">
                <li class="ui-list-item"><a href="__URL__/index{$query_params}/k03/%/" class="item-param <if condition="$_GET['k03']==''||$_GET['k03']=='%'">selected</if>">所有产业</a></li>

                <volist name="tagOptions" id="v">
                    <li class="ui-list-item"><a href="__URL__/index{$query_params}/k03/{$v.catename|urlencode}/" class="item-param  <eq name="Think.get.k03" value="$v['catename']">selected</eq>">{$v.catename}</a></li>
                </volist>
            </ul>
        </div>
    </div>
</div>

<div class="ui-box ui-box-follow shadow">
    <div class="ui-box-head">
        <div class="ui-box-head-border">
            <h3 class="ui-box-head-title">产业特征</h3>
            <span class="ui-box-head-text"></span> <a href="#" class="ui-box-head-more"></a>
        </div>
    </div>
    <div class="ui-box-container">
        <div class="ui-box-content">
            <ul class="ui-list">
                <li class="ui-list-item"><a href="__URL__/index{$query_params}/f03/%/" class="item-param <if condition="$_GET['f03']==''||$_GET['f03']=='%'">selected</if>">所有产业特征</a></li>

                <volist name="featureOptions" id="v">
                    <li class="ui-list-item"><a href="__URL__/index{$query_params}/f03/{$v.catename|urlencode}/" class="item-param <eq name="Think.get.f03" value="$v['catename']">selected</eq>">{$v.catename}</a></li>
                </volist>
            </ul>
        </div>
    </div>
</div>