				<!--  左边的分类导航 begin -->
				<div class="ui-box ui-box-top shadow">
					<div class="ui-box-head">
						<div class="ui-box-head-border">
							<h3 class="ui-box-head-title">按照企业属性来过滤</h3>
							<span class="ui-box-head-text"></span> <a href="#" class="ui-box-head-more"></a>
						</div>
					</div>
				</div>

                {:w('TagsAndFeaturesOption', array("query_params"=>$query_params))}

				<div class="ui-box ui-box-follow shadow">
					<div class="ui-box-head">
						<div class="ui-box-head-border">
							<h3 class="ui-box-head-title">企业年限</h3>
							<span class="ui-box-head-text"></span> <a href="#" class="ui-box-head-more"></a>
						</div>
					</div>
					<div class="ui-box-container">
						<div class="ui-box-content">
							<ul class="ui-list">
								<li class="ui-list-item"><a href="__URL__/index{$query_params}/k01/%/" class="item-param <if condition="$_GET['k01']==''||$_GET['k01']=='%'">selected</if>">不限</a></li>
								<volist name="epparameter['k01']" id="v">
									<li class="ui-list-item"><a href="__URL__/index{$query_params}/k01/{$v.quotavalue}/" class="item-param  <eq name="Think.get.k01" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a></li>
								</volist>
							</ul>
						</div>
					</div>
				</div>
				<div class="ui-box ui-box-follow shadow">
					<div class="ui-box-head">
						<div class="ui-box-head-border">
							<h3 class="ui-box-head-title">注册资本</h3>
							<span class="ui-box-head-text"></span> <a href="#" class="ui-box-head-more"></a>
						</div>
					</div>
					<div class="ui-box-container">
						<div class="ui-box-content">
							<ul class="ui-list">
								<li class="ui-list-item"><a href="__URL__/index{$query_params}/k04/%/" class="item-param <if condition="$_GET['k04']==''||$_GET['k04']=='%'">selected</if>">不限</a></li>
								<volist name="epparameter['k04']" id="v">
									<li class="ui-list-item"><a href="__URL__/index{$query_params}/k04/{$v.quotavalue}/" class="item-param  <eq name="Think.get.k04" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a></li>
								</volist>
							</ul>
						</div>
					</div>
				</div>
				<div class="ui-box ui-box-follow shadow">
					<div class="ui-box-head">
						<div class="ui-box-head-border">
							<h3 class="ui-box-head-title">人员情况</h3>
							<span class="ui-box-head-text"></span> <a href="#" class="ui-box-head-more"></a>
						</div>
					</div>
					<div class="ui-box-container">
						<div class="ui-box-content">
							<ul class="ui-list">
								<li class="ui-list-item"><a href="__URL__/index{$query_params}/k06/%/" class="item-param <if condition="$_GET['k06']==''||$_GET['k06']=='%'">selected</if>">不限</a></li>
								<volist name="epparameter['k06']" id="v">
									<li class="ui-list-item"><a href="__URL__/index{$query_params}/k06/{$v.quotavalue}/" class="item-param  <eq name="Think.get.k06" value="$v.quotavalue">selected</eq>">{$v.quotavalue}</a></li>
								</volist>
							</ul>
						</div>
					</div>
				</div>
				<!--  左边的分类导航 end -->