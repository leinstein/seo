<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<!-- 引入layim css begin -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/layim.css">
<!-- 引入 layim css end -->

</head>
<!-- 引入上传组件标签库 begin -->
<taglib name="html,dupload" />
<!-- 引入上传组件标签库 end -->
<!-- 引入上传组件js和css文件 begin -->
<dupload:script name="dupload"/>
<script>
layui.use(['upload'], function(){
  layui.upload({
    url: '' //上传接口
    ,success: function(res){ //上传成功后的回调
      console.log(res)
    }
  });
  
  layui.upload({
    url: '/test/upload.json'
    ,elem: '#file' //指定原始元素，默认直接查找class="layui-upload-file"
    ,method: 'get' //上传接口的http类型
    ,success: function(res){
      LAY_demo_upload.src = res.url;
    }
  });
});

//保存
function btnAdd() {
	alert()
 var formData = new FormData($("#frm")[0]);
 
 $.ajax({
	    url: URL+'/upload',
	    type: 'POST',
	    cache: false,
	    data: new FormData($('#uploadForm')[0]),
	    processData: false,
	    contentType: false
	}).done(function(res) {
		alert(1)
		console.log()
	}).fail(function(res) {
		alert(2)
	}); 
 
 
 /* $.ajax({
  url: "/Admin/ContentManage/SaveEdit",
  type: "POST",
  data: formData,
  contentType: false, //必须false才会避开jQuery对 formdata 的默认处理 XMLHttpRequest会对 formdata 进行正确的处理 
  processData: false, //必须false才会自动加上正确的Content-Type
  success: function (data) {
   if (data == "OK") {
    alert("保存成功");
    $.iDialog("close"); //刷新父页面
   }
   else {
    alert("保存失败：" + data);
   }
  }
 }); */
}



$(function() {

	
	$(".layim-send-btn").bind("click",function(){
		  var url  =  URL+'/reply/type/ajax';
		  
		  var data = {};
		  var content = $.trim( $("#layim_chat").val() );
		  if( content ==""){
			  layer_msg("请输入内容",2);
			  return false;
		  }
		  data['workorderid'] 	= $("#workorderid").val();
		  data['content'] 		= content;
		  data['fileid'] 		= $("input[name='fileid[]']").val() ;
		  data['type'] 			=  'ajax';
		  $.post( url , data ,function(result){
			    //$("span").html(result);
			    if( result['status'] == 1 ){
			    	// 提示上传成功
					layer_msg("回复成功！");
					var t=setTimeout("window.location.reload()",2000);
			    }else{
			    	// 提示上传成功
					layer_msg("回复失败！");
			    }
		  },"json");
		  
		/*   $.ajax({
			    url: URL+'/reply',
			    type: 'POST',
			    cache: false,
			    data: new FormData($('#uploadForm')[0]),
			    processData: false,
			    contentType: false
			}).done(function(res) {
				alert(1)
				console.log()
			}).fail(function(res) {
				alert(2)
			}); 
		   */
	});
	
	$('.layim-chat-main').scrollTop( $('.layim-chat-main')[0].scrollHeight );
	
	$("#layim_chat").focus();
});
</script>

<body>


	<div id="layui-layim-chat" class="layui-layer-content">
		
		<div class="layim-chat-box">
			<div class="layim-chat layim-chat-friend layui-show">
				
				<div class="layim-chat-main">
					<ul>
						<volist name="data['reply_list']" id="vo">
						<eq name ="vo.is_mine" value ="1">
					  	<li class="{$vo.class_name}">
						  	<div class="layim-chat-user">
						  		<img src="__PUBLIC__/img/{$vo.icon}">
						  		<cite><i>{$vo['createtime']}</i>{$vo['createusername']}</cite>
						  	</div>
						  	<div class="layim-chat-text">
						  		{$vo['content']}
						  		<notempty name="vo['file_info']['id']">
						  		<div style="color: blue">
							  		相关附件：
							  		<php>load("@.file");</php>
							  		<a href="{$vo['file_info']['id']|get_download_url}" style="color: blue">{$vo['file_info']['originalfilename']}</a>
						  		</div>
						  		</notempty>
						  	</div>
					  	</li>
					  	<else/>
					  	<li>
					  		<div class="layim-chat-user">
								<img src="__PUBLIC__/img/{$vo.icon}">
								<cite>{$vo['createusername']}<i>{$vo['createtime']}</i></cite>
							</div>
							<div class="layim-chat-text">
								{$vo['content']}
							</div>
						</li>
					  	</eq>
					  	</volist>
					  	
					</ul>
				</div>
				<div class="layim-chat-footer">
					<div class="layui-unselect layim-chat-tool">
					
					<span class="layui-icon layim-tool-image" title="上传文件" layim-event="image" data-type="file" style="height: 30px;">
					<style>
						.ui-uploader-form {
						width: 30px !important;
						position: absolute;
						top: 0;
						left: 0;
						}
					</style>
						<dupload:upload 
							cannotedit = "upload_file['cannotedit']"
							isimage = "upload_file['isimage']"
							attachmentid = "upload_file['fileid']"
							maxsize="upload_file['maxsize']" 
							attachmentname="upload_file['attachmentname']"
							attachmenttype="upload_file['attachmenttype']" 
							attachmentdesc="upload_file['attachmentdesc']" 
							isrequire="upload_file['isrequire']" 
							skin ="upload_file['skin']"
							tagname="upload_file['tagname']">
						</dupload:upload>
					</span>
						<!-- <form id="uploadForm" enctype="multipart/form-data">
						<span class="layui-icon layim-tool-image" title="上传文件" layim-event="image" data-type="file">
						<input type="file" name="file" id="fil1e" class="pt5" onchange="btnAdd()">
						
						
		
						<input type="file" name="file" lay-type="file" class="layui-upload-file"></span>
						</form> -->
						<!-- <span class="layim-tool-log" layim-event="chatLog"><i class="layui-icon"></i>聊天记录</span> -->
					</div>
					<div class="layim-chat-textarea">
						<a id="layim_chat_a">&nbsp;</a>
						<textarea id="layim_chat"></textarea>
					</div>
					<div class="layim-chat-bottom">
						<div class="layim-chat-send">
							<!-- <span class="layim-send-close" layim-event="closeThisChat">关闭</span> -->
							<input type="hidden" id="workorderid" name="workorderid" value="{$data['id']}">
							<span class="layim-send-btn" layim-event="send" >发送</span>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="layui-tab-content">
		<form class="layui-form" name="form1" action="{:U('reply')}"
			method="post">

			<input type="hidden" name="workorderid" value="{$data['id']}">


		<input type="hidden" name="returnUrl" value="{$CURRENT_URL}">



			<!-- 工单详情 挂件 begin -->



			<!-- 回复列表 begin -->


			<!-- <blockquote class="layui-elem-quote"
				style="font-weight: bold; font-size: 15px; margin: 10px;">
				<div>标题：{$data['title']}</div>
				<div>内容：{$data['content']}</div>
			</blockquote>

			<volist name="data['reply_list']" id="vo">
			<div class="layui-field-box"
				style="font-weight: 100; font-size: 15px; margin: 10px; padding: 20px; display: table">
				<div style="display: table-cell; font-weight: bold;">{$vo['createusername']}：</div>
				<div style="display: table-cell">{$vo['content']}</div>
			</div>
			</volist> -->


			<!-- 工单详情 挂件 end -->


		</form>
	</div>


</body>
</html>