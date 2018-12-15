<!-- 应用图标列表 begin -->
<div class="ui-icon-list ui-bigicon">
	<volist name="Mybiz" id="vo">
	<a href="{$RootUrl}/{$vo['appcode']}/index.php?s=/{$Think.const.GROUP_NAME}/BusinessManage/detail/id/{$vo.id}"  target="{$vo['programcode_json']['target']}" class="ui-list-item-link" id="{$vo['id']}" data_appcode ="{$vo['appcode']}">
		<!-- <gt name="vo['newcount']" value="0"><div class="top-hint-bigicon"></div></gt> -->
		<gt name="vo['newcount']" value="0">
		<div class="<gt name="vo['newcount']" value="99">top-hint-bigicon-num-big<else/>top-hint-bigicon-num</gt>" >
			{$vo['newcount']}
		</div>
		</gt>
		<div class="ui-item-icon">
			{$vo['themelogo']|default='<i class="icon techsub ico_kejishenbao_b">&#xe600;</i>'}
		</div>
		<div class="ui-item-content"><h2>{$vo['themename']}</h2><p>{$vo['tip']}</p></div>
		<div class="clear"></div>
	</a>
	</volist>
</div>
<!-- 应用图标列表 end -->