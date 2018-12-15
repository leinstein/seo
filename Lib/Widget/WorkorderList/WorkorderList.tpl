	<!-- tips插件 begin -->
	<link rel="stylesheet" href="../Public/css/tipso.min.css">
	<script type="text/javascript" src="../Public/js/tipso.min.js"></script>
	<!-- tips插件 end -->
	
	<script type="text/javascript">
	    $(function() {
	    	layui.use(['form'], function(){
				var form = layui.form;
			
			  form.on('select', function(data){
				  
				  // 如果选中的是产品下下拉框
				  if( $(data.elem).attr('name') == "productid" ){
					  if( data.value == 1){
						  // 如果是优站宝产品
						  $("#dom_site").css("display","inline-block");
					  }else {
						  $("#dom_site").hide();
					  }
				  }
				  
				  /* console.log(data.elem); //得到select原始DOM对象
				  console.log(data.value); //得到被选中的值
				  console.log(data.othis); //得到美化后的DOM对象 */
				});    
			  
			});
			
			
			if("{$_GET['productid']}" == 1 ){
				// 如果是优站宝产品
				  $("#dom_site").css("display","inline-block");
			}else {
				  $("#dom_site").hide();
			  }
			
			// 提示弹出初始化
			$('.tip').tipso({

				position : 'top',
				useTitle: false

			});
		});
	    
	    /**
	     * 关闭工单
	     */
	    function closeRecord(id) {
			layer_confirm('关闭工单后无法恢复，您确认关闭么？',
               function () {

                   window.location.href = "__URL__/closeRecord/id/" + id;

               });
		}
	    /**
	     * 删除工单
	     */
	    function deleteRecord(id) {
            layer_confirm('删除工单无法恢复，您确认删除么？',
                function () {

                    window.location.href = "__URL__/deleteRecord/id/" + id;

                });
        }
	</script>
	<eq name="list.can_add" value="1">
	<h3 class=" mb20">
 		<a class="layui-btn" href="javascript:;" onclick="open_layer('发起工单','{:U('insertPage')}/productid/{$Think.get.productid}/objecttype/{$Think.get.objecttype}/objectid/{$Think.get.objectid}/touserid/{$Think.get.touserid}/tousername/{$Think.get.tousername|urlencode}/level/2&returnUrl={$Think.get.returnUrl|urlencode}','50%')"><i class="iconfont">&#xe68b;</i> 发起工单</a>
 	</h3>	
	</eq>		 	
	<form name="form" id="form" method="get" action="__URL__" class="layui-form">
        <input type="hidden" name="m" value="{$Think.MODULE_NAME}" />
        <input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
        <input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
        <div class="layui-form-item">
        	<!-- 产品 -->
            <div class="layui-inline">
            	<div class="layui-input-inline" style="width: 90px">
                    <html:select options="products" first="产品" name="productid" lay_filter="productid" style="" selected="_GET['productid']" />
                </div>
			</div>
			<!-- 用户  -->
			<eq name="GROUP_NAME" value="Manage">
			<!-- <div class="layui-inline" style="width: 100px">
            	<div class="layui-input-inline" style="width: 100px">
                    <html:select options="users" first="用户" name="productid" lay_filter="productid" style="" selected="_GET['productid']" />
                </div>
			</div> -->
			</eq>
			<!-- 产品 -->
            <div class="layui-inline hide" id="dom_site">
            	<div class="layui-input-inline">
                    <html:select options="sites" first="站点" name="objectid" style="" selected="_GET['objectid']" lay_search="true"/>
                </div>
			</div>
            <div class="layui-inline">
                <!-- 标题 -->
                <div class="layui-input-inline">
                    <input type="text" name="title" class="layui-input" value="{$Think.get.title}" placeholder="工单标题">
                </div>
			</div>
            <div class="layui-inline" >
                <div class="layui-input-inline" style="width: 98px">
                    <html:select options="WorkorderStatusOptions" first="工单状态" name="bizstatus" style="" selected="_GET['bizstatus']" />
                </div>
			</div>
            <div class="layui-inline">
		      	<div class="layui-input-inline" style="width: 160px">
		        	<html:select options="PerPageOptions" first="默认每页显示20条" name="num_per_page"  style="" selected="_GET['num_per_page']" />
		      	</div>
			</div>
            <div class="layui-inline">
		      	<div class="layui-input-inline">
                    <input type="submit" name="sub" value="查询" class="layui-btn">
                    
                    <button type="reset" name="btn" onclick="location.href='__URL__/{$Think.ACTION_NAME}/productid/{$Think.get.productid}/siteid/{$Think.get.siteid}'" class="layui-btn layui-btn-primary"> 重置</button>
                </div>
		    </div>
        </div>
    </form>
	<table class="layui-table">
	    <thead>
	        <tr>
	            <th width="30">序号</th>
	            <th width=100 >工单标题</th>
	            <th width=200 >工单内容</th>
	            <th width="60">产品名称</th>
	            <th>站点网址 </th>
	            <th>相关附件</th>
	            <th width="60">回复数量</th>
	            <th width="60">创建用户</th>
	            <th width="80">创建时间</th>
	            <th width="60">工单状态</th>
	            <th style="max-width: 100px">操作 </th>
	        </tr>
	    </thead>
	    <tbody>
	    <style>
	    
	    </style>
	        <notempty name="list['data']">
	            <volist name="list['data']" id="vo">
	                <tr>
	                    <td align="center" <eq name="vo.can_show_badge" value="1">class="show_badge" </eq>>{$vo['No']}	                            
	                    </td>
	                    <td style="word-break:break-all;">{$vo['title']}</td>
	                    <td title="{$vo['content']}" style="word-break:break-all;"><!-- <span class="tip tipso_style" data-tipso="{$vo['content']}" style="width: 300px !important">㊟</span> --> {$vo['content']|title_show=100}</td>
	                    <td>{$vo['productname']}</td>
	                    <td>{$vo['sitename']}</td>
	                    <td>
	                    	<php>load("@.file");</php>
				  			<a href="{$vo['file_arra']['fileid']|get_download_url}">{$vo['file_arra']['orifilename']}</a>
				  		</td>
	                    <td>
	                    	<gt name="vo['reply_num']" value="0">
	                    	<a href="javascript:;" onclick="open_layer('查看工单回复','{:U('reply_list')}/id/{$vo['id']}','50%')" class="btn btn-link add_site_btn">{$vo['reply_num']|default=0}</a>
	                    	<else/>
	                    	0
	                    	</gt>
	                    </td>	                    
	                    <td>{$vo['createusername']}</td>
	                    <td>{$vo['createtime']|format_date}</td>
	                    <td>{$vo['bizstatus']}</td>
	                    <td>
	                    	<a href="javascript:;" onclick="open_layer('详情','{:U('detail')}/id/{$vo['id']}','50%')" class="layui-btn layui-btn-mini mt5">详情</a>
	                    	
	                    	<!-- <button class="layui-btn site-demo-layim" data-type="chat">自定义会话</button> -->
	                    	
	                    	<eq name="vo.can_edit" value="1">
	                    		<a href="javascript:;" onclick="open_layer('修改','{:U('updatePage')}/id/{$vo['id']}?returnUrl={$returnUrl|urlencode}','50%')" class="layui-btn layui-btn-mini mt5">修改</a>
	                    	<else/>
	                    		<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled mt5">修改</button>
	                    	</eq>
	                    	
	                    	<eq name="vo.can_reply" value="1">
	                    		<a href="javascript:;" onclick="open_layer('回复','{:U('replyPage')}/id/{$vo['id']}?returnUrl={$returnUrl|urlencode}','600',525)" class="layui-btn layui-btn-mini mt5">回复<gt name="vo['not_read_reply_num']" value="0"><span class="badge"  style="margin-top: -18px;margin-right: -10px;">{$vo['not_read_reply_num']}</span></gt></a>
	                    	<else/>
	                    		<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled mt5">回复</button>
	                    	</eq>
	                    	
	                    	
	                    	<!-- 可以关闭 -->
	                        <eq name="vo.can_close" value="1">
	                        	<a href="javascript:;" onclick="closeRecord({$vo['id']})" class="layui-btn layui-btn-danger layui-btn-mini mt5">关闭</a>
	                        <else/>
	                        	<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled mt5">关闭</button>
	                        </eq>
	                        
	                        <!-- 可以删除闭 -->
	                        <eq name="vo.can_delete" value="1">
	                        	<a href="javascript:;" onclick="deleteRecord({$vo['id']})" class="layui-btn layui-btn-danger layui-btn-mini mt5">删除</a>
	                        <else/>
	                        	<button type="button" class="layui-btn layui-btn-mini layui-btn-disabled mt5">删除</button>
	                        </eq>
	                    	
	                        
	                    </td>
	                </tr>
	            </volist>
	            <else/>
	            <tr>
	                <td colspan="11" align="center" class="layui-table-nodata">
	                	暂无相关数据
	                </td>
	            </tr>
	        </notempty>
	    </tbody>
	</table>
	
	<!-- 分页 begin -->
    <div class="layui-box layui-laypage">
        {$list['html']}
    </div>
    <!-- 分页 end -->
    
    <!-- 引入layim css begin -->
<!-- <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/layim.css">
引入 layim css end
    <div class="layui-layer layui-layer-page layui-box layui-layim-chat layer-anim" style="z-index: 19891017; width: 600px;  left: 659px; min-width: 500px; min-height: 420px; ">
	<div class="layui-layer-title" style="cursor: move;">​</div>
	<div id="layui-layim-chat" class="layui-layer-content">
		
		<div class="layim-chat-box">
			<div class="layim-chat layim-chat-friend layui-show">
				<div class="layui-unselect layim-chat-title">
					<div class="layim-chat-other">
						<img class="layim-friend1008612"
							src="//tva3.sinaimg.cn/crop.0.0.180.180.180/7f5f6861jw1e8qgp5bmzyj2050050aa8.jpg"><span
							class="layim-chat-username" layim-event="">小ss絲襪 </span>
						<p class="layim-chat-status"></p>
					</div>
				</div>
				<div class="layim-chat-main">
					<ul>
						<li class="layim-chat-mine"><div class="layim-chat-user">
								<img src="//res.layui.com/images/fly/avatar/00.jpg"><cite><i>2017-07-11
										10:04:42</i>纸飞机</cite>
							</div>
							<div class="layim-chat-text">
								<img alt="[拜拜]" title="[拜拜]"
									src="http://res.layui.com/layui/build/images/face/29.gif">
							</div></li>
							<li class="layim-chat-mine"><div class="layim-chat-user">
								<img src="//res.layui.com/images/fly/avatar/00.jpg"><cite><i>2017-07-11
										10:04:42</i>纸飞机</cite>
							</div>
							<div class="layim-chat-text">
								<img alt="[拜拜]" title="[拜拜]"
									src="http://res.layui.com/layui/build/images/face/29.gif">
							</div></li>
							
						<li><div class="layim-chat-user">
								<img
									src="//tva3.sinaimg.cn/crop.0.0.180.180.180/7f5f6861jw1e8qgp5bmzyj2050050aa8.jpg"><cite>小闲<i>2017-07-11
										10:04:43</i></cite>
							</div>
							<div class="layim-chat-text">
								你没发错吧？<img alt="[微笑]" title="[微笑]"
									src="http://res.layui.com/layui/build/images/face/0.gif">
							</div></li>
					</ul>
				</div>
				<div class="layim-chat-footer">
					<div class="layui-unselect layim-chat-tool"
						data-json="%7B%22name%22%3A%22%E5%B0%8F%E9%97%B2%22%2C%22type%22%3A%22friend%22%2C%22avatar%22%3A%22%2F%2Ftva3.sinaimg.cn%2Fcrop.0.0.180.180.180%2F7f5f6861jw1e8qgp5bmzyj2050050aa8.jpg%22%2C%22id%22%3A1008612%7D">
						<span class="layui-icon layim-tool-face" title="选择表情"
							layim-event="face"></span><span
							class="layui-icon layim-tool-image" title="上传图片"
							layim-event="image"><input type="file" name="file"></span><span
							class="layui-icon layim-tool-image" title="发送文件"
							layim-event="image" data-type="file"><input type="file"
							name="file"></span><span class="layui-icon layim-tool-audio"
							title="发送网络音频" layim-event="media" data-type="audio"></span><span
							class="layui-icon layim-tool-video" title="发送网络视频"
							layim-event="media" data-type="video"></span><span
							class="layui-icon layim-tool-code" title="代码"
							layim-event="extend" lay-filter="code"></span><span
							class="layim-tool-log" layim-event="chatLog"><i
							class="layui-icon"></i>聊天记录</span>
					</div>
					<div class="layim-chat-textarea">
						<textarea></textarea>
					</div>
					<div class="layim-chat-bottom">
						<div class="layim-chat-send">
							<span class="layim-send-close" layim-event="closeThisChat">关闭</span><span
								class="layim-send-btn" layim-event="send">发送</span><span
								class="layim-send-set" layim-event="setSend" lay-type="show"><em
								class="layui-edge"></em></span>
							<ul class="layui-anim layim-menu-box">
								<li class="layim-this" layim-event="setSend" lay-type="Enter"><i
									class="layui-icon"></i>按Enter键发送消息</li>
								<li layim-event="setSend" lay-type="Ctrl+Enter"><i
									class="layui-icon"></i>按Ctrl+Enter键发送消息</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<span class="layui-layer-setwin"><a class="layui-layer-min"
		href="javascript:;"><cite></cite></a><a
		class="layui-layer-ico layui-layer-max" href="javascript:;"></a><a
		class="layui-layer-ico layui-layer-close layui-layer-close1"
		href="javascript:;"></a></span><span class="layui-layer-resize"></span>
</div> -->


                    