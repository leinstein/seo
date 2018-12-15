<!DOCTYPE html>
<html lang="zh-CN">
<php>//$page_title = "添加站点";</php>
<head>
<include file="../Public/header" />
<!--响应式css-->
<link rel="stylesheet" type="text/css" href="../Public/css/responsive.css">
<script>
$(function() {
     layui.use(['form'], function(){
   	 var form = layui.form;
   	  
   	  //自定义验证规则
   	  form.verify({
   		/* sitename: function(value){
   	      if(value.length < 5){
   	        return '标题也太短了吧';
   	      }
   	    }
   	    ,pass: [/(.+){6,12}$/, '密码必须6到12位'] */
   	  });
	
   		form.on('submit(*)', function(data){
   	    console.log(data)
   	    return false;
   	  });
   	  
   	  /* //事件监听
   	  form.on('select', function(data){
   	    console.log(data);
   	  });

   	  form.on('select(aihao)', function(data){
   	    console.log(data);
   	  });
   	  
   	  form.on('checkbox', function(data){
   	    console.log(data.elem.checked);
   	  });
   	  
   	  form.on('switch', function(data){
   	    console.log(data);
   	  });
   	  
   	  form.on('radio', function(data){
   	    console.log(data);
   	  });
   	  
   	  //监听提交
   	  form.on('submit(*)', function(data){
   	    console.log(data)
   	    return false;
   	  }); */
   	  
   	}); 
});
</script>
</head>
<body>

	<div class="layui-tab-content">
		<form class="layui-form" action="{:U('insert')}" method="post">
			<!-- 站点详情 挂件 begin -->
			{:W('SiteDetail', array( 'data'=>$data,'operate' => 'insert', 'returnUrl' => $_GET['returnUrl'] , 'me' => $LoginUserInfo  ))}
			<!-- 站点详情 挂件 end -->	
			
			
			<div class="layui-form-item">
				<div class="layui-input-block">
					<button class="layui-btn" lay-submit="" lay-filter="formDemo">立即提交</button>
					<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				</div>
			</div>
		</form>
	</div>
	
</body>
</html>