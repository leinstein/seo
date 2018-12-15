<!-- SEO百科列表 begin -->
<volist name="list['data']" id="vo">
	<article onclick="location.href='__URL__/baike_detail/id/{$vo['id']}'">
		
		<div class="left">
			<time>{$vo['pubdate_pre']}</time>
			<span>{$vo['pubdate_suf']}</span>				
		</div>
		<div class="right">
			<h3><a style="float:left; clear:both">{$vo['title']}</a></h3>
			<p style="float:left; clear:both">{$vo['description']}</p>
		</div>
			
	</article>
</volist>
<!-- SEO百科列表 end -->

