	<script type="text/javascript">
	    $(function() {
	    	layui.use(['form'], function(){
				var form = layui.form;
			
			  form.on('select', function(data){
				  
				});    
			  
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
	<form name="form" id="form" method="get" action="__URL__" class="layui-form">
        <input type="hidden" name="m" value="{$Think.MODULE_NAME}" />
        <input type="hidden" name="a" value="{$Think.ACTION_NAME}" />
        <input type="hidden" name="g" value="{$Think.GROUP_NAME}" />
        <div class="layui-form-item">
        	<!-- 产品 -->
            <div class="layui-inline" style="width: 100px">
            	<div class="layui-input-inline" style="width: 100px">
                    <html:select options="products" first="产品" name="productid" lay_filter="productid" style="" selected="_GET['productid']" />
                </div>
			</div>
			<!-- 用户  -->
            <div class="layui-inline">
            	<div class="layui-input-inline">
                    <html:select options="users" first="用户" name="objectid" style="" selected="_GET['objectid']" lay_search="true"/>
                </div>
			</div>
			<div class="layui-inline" >
                <div class="layui-input-inline" style="width: 98px">
                    <html:select options="RemarkTypeOptions" first="日志类型" name="remarktype" style="" selected="_GET['remarktype']" />
                </div>
			</div>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <input type="text" name="content" class="layui-input" value="{$Think.get.content}" placeholder="日志内容">
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
                    
                    <button type="reset" name="btn" onclick="location.href='__URL__/{$Think.ACTION_NAME}'" class="layui-btn layui-btn-primary">重置</button>
                </div>
		    </div>
        </div>
    </form>
	<table class="layui-table">
	    <thead>
	        <tr>
	            <th width="30">序号</th>
	            <th width="200">内容</th>
	            <th>产品名称</th>
	            <th>用户 </th>
	            <th>相关附件</th>
	            <th>日志类型</th>
	            <th>创建用户</th>
	            <th>创建时间</th>
	            <th>操作 </th>
	        </tr>
	    </thead>
	    <tbody>
	        <notempty name="list['data']">
	            <volist name="list['data']" id="vo">
	                <tr>
	                    <td align="center">{$vo['No']}</td>
	                    <td title="{$vo['content']|title_show}">{$vo['content']|title_show=100}</td>
	                    <td>{$vo['productname']}</td>
	                    <td>{$vo['tousername']}</td>
	                    <td>
	                    	<php>load("@.file");</php>
				  			<a href="{$vo['file_arra']['fileid']|get_download_url}">{$vo['file_arra']['orifilename']}</a>
				  		</td>
	                    <td>{$vo['remarktype']}</td> 
	                    <td>{$vo['createusername']}</td>
	                    <td>{$vo['createtime']|format_date}</td>
	                    <td>
	                    	<a href="javascript:;" onclick="open_layer('详情','{:U('detail')}/id/{$vo['id']}','50%')" class="layui-btn layui-btn-mini">详情</a>	                        
	                    </td>
	                </tr>
	            </volist>
	            <else/>
	            <tr>
	                <td colspan="10" align="center" class="layui-table-nodata">
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


                    