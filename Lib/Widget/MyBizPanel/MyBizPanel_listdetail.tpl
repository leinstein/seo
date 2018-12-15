<!-- 应用图标列表 begin -->
<div class="ui-icon-list ui-listdetail">
	<volist name="Mybiz" id="vo">
	<a href="{$RootUrl}/{$vo['appcode']}/index.php?s=/{$Think.const.GROUP_NAME}/BusinessManage/detail/id/{$vo.id}" class="ui-list-item-link" target="{$vo['programcode_json']['target']}">
		<gt name="vo['newcount']" value="0"><div class="top-hint-bigicon"></div></gt>
		<div class="ui-item-icon">
			{$vo['themelogo']|default='<i class="icon techsub ico_kejishenbao_b">&#xe600;</i>'}
		</div>
		<div class="ui-item-content">
			<h2>{$vo['themename']}</h2>
			<p>{$vo['tip']}</p>
			<p><notempty name="vo['newnotify']['body']"><span class="c_grayblue">最新：</span>{$vo['newnotify']['body']}</notempty></p>
 		</div>
        <div class="clear"></div>
	</a>
	</volist>
</div>
<!-- 应用图标列表 end -->