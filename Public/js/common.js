/*
 * 	项目公共函数库
 * author: Richer;
 * copyright: qiso;
 */

/**
 *获取浏览器类型
 */
function getBrowser(){

	var agent= navigator.userAgent;
	if ( agent.indexOf("MSIE") !=-1 ||  agent.indexOf("rv:11.0") != -1 ) //ie11判断
		return "ie";
	else if( agent.indexOf("Firefox") !=-1 )
		return "firefox";
	else if( agent.indexOf("Chrome") !=-1 )
		return "chrome";
	else if( agent.indexOf("Opera") !=-1 )
		return 'opera';
	else if( ( agent.indexOf("Chrome") ==-1 )&& agent.indexOf("Safari") != -1)
		return 'safari';
	else
		return 'unknown';
}

//判断是否是IE浏览器，包括Edge浏览器  
function getIEVersion()  {  

   var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串  
  // var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1 && !isOpera; //判断是否IE浏览器  
   var isEdge = userAgent.indexOf("Windows NT 6.1; Trident/7.0;") > -1 && !isIE; //判断是否IE的Edge浏览器  
   
   if( getBrowser() == "ie") {  
	   if (!document.all) {
		   return 11;
	   }else if (document.all && document.addEventListener && window.atob) {
		   return 10;
	   }else if (document.all && document.addEventListener && !window.atob) {
		   return 9;
	   }else if (document.all && document.querySelector && !document.addEventListener) {
		   return 8;
	   }else if (document.all && window.XMLHttpRequest && !document.querySelector) {
		   return 7;
	   }else if (document.all && document.compatMode && !window.XMLHttpRequest) {
		   return 6;
	   }else{
		   return 0;
	   }
   } else if(isEdge)  {  
	   return "Edge";  
   }  else  {  
       return "-1";//非IE  
   }  
}  

/**
 * 全选函数
 * 
 * choiceall_em 设置全选的checkbox的选择器；
 * check_em 需要设置为全选的checkbox的选择器
 */
var set_selectall=function(choiceall_em, check_em){	
	
	$(choiceall_em).click(function(event){
		//如果全选按钮被选中
		var choice_status = $(choiceall_em).attr("checked");
		if( choice_status ){
			 $(check_em).attr("checked",true);
		}else{
			 $(check_em).attr("checked",false);
		}
	});
}

/**
 * hover效果
 * 
 * hover_em hover控件选择器；
 * hover_class hover样式
 */
var set_hover=function(hover_em, hover_class){
	$(hover_em).each(function() {
        $(this).hover(
	        function() {
	            $(this).addClass(hover_class);
	        },
		    function() {
	        	$(this).removeClass(hover_class);
		    }
        );
    });
}

/**
 * 让一个面板收缩和展开
 * 
 * trigger_em 处罚选择器；
 * toggle_target 切换的目标
 */
var set_toggle_panel=function(trigger_em, text_expand, text_shrink, toggle_target){
	
	$(trigger_em).click(function(event){
		if( $(trigger_em).text() == text_expand){
			$(trigger_em).text(text_shrink);
		}else{
			$(trigger_em).text(text_expand);
		}
		$(toggle_target).slideToggle();
	});
}

	/**
	 * 转换对象将 undefined转化成 ""
	 */
	function convertUndefined2Empty(obj){
		if(typeof(obj) =="undefined" || obj =="undefined" || obj == null || obj =="null")
			obj ="";	
		return obj;	
	}
  
	/**
	 * 显示和隐藏下个元素
	 */
	function showOrHideNextElement(obj , tag_type ){
		
		var next_obj = $(obj).siblings( tag_type );
		//var next_obj = $(obj).next( tag_type );
		//console.log(next_obj)
		var display =  $( next_obj ).css('display');
		if( display == 'none' ){
			 $( next_obj ).show();	
		}else{
			 $( next_obj ).hide();	
		}
	} 
	
	/** 
	 * 全选
	 * 
	 * 参数 o     ：当前checkbox对象
	 *     level ： 层级，
	 *     objtype：
	 */
	function checkAll(o, level, objtype){
		
		
		var obj =null;
		
		for(var i = 1 ;i< level ; i ++){
			
		}
		
		switch(level){
	    	case 1:
	    		obj = $(o).parent().find('input[type="checkbox"]');
	    		
	    		if( objtype == 'next'){
	    			obj = $(o).parent().next().find('input[type="checkbox"]');	
	    		}else if( objtype == 'prev'){
	    			obj = $(o).parent().prev().find('input[type="checkbox"]');	
	    		}
	    		
	    	  break;
	    	case 2:
	    		obj = $(o).parent().parent().find('input[type="checkbox"]');	
	    		
	    		if( objtype == 'next'){
	    			obj = $(o).parent().parent().next().find('input[type="checkbox"]');
	    		}else if( objtype == 'prev'){
	    			obj = $(o).parent().parent().prev().find('input[type="checkbox"]');	
	    		}
	    	
	    	  break;
	    	case 3:
	    		obj = $(o).parent().parent().parent().find('input[type="checkbox"]');	
	    		
	    		if( objtype == 'next'){
	    			obj = $(o).parent().parent().parent().next().find('input[type="checkbox"]');
	    		}else if( objtype == 'prev'){
	    			obj = $(o).parent().parent().parent().prev().find('input[type="checkbox"]');	
	    		}
	    	
	    	  break;
	    	  
	    	case 4:
	    		obj = $(o).parent().parent().parent().parent().find('input[type="checkbox"]');
	    		if( objtype == 'next'){
	    			obj = $(o).parent().parent().parent().parent().next().find('input[type="checkbox"]');
	    		}else if( objtype == 'prev'){
	    			obj = $(o).parent().parent().parent().parent().prev().find('input[type="checkbox"]');	
	    		}
	    		
	    	  break;
	    	  
	    	case 5:
	    		obj = $(o).parent().parent().parent().parent().parent().find('input[type="checkbox"]');	
	    		if( objtype == 'next'){
	    			obj = $(o).parent().parent().parent().parent().parent().next().find('input[type="checkbox"]');
	    		}else if( objtype == 'prev'){
	    			obj = $(o).parent().parent().parent().parent().parent().prev().find('input[type="checkbox"]');	
	    		}
	    		
	    	  break;
	    	default:
//	    		if( objtype == 'next'){
//	    			obj = $(o).parent().parent().parent().parent().next().find('input[type="checkbox"]');
//	    		}else{
//	    			obj = $(o).parent().parent().parent().parent().find('input[type="checkbox"]');	
//	    		}
	    		
    	}
    	
    	
	    if( o.checked == true ){
//	    	$.each($(obj), function(i, e){
//				if ( $(e).css("display") !="none"){
//			  		 $(e).attr('checked','true');
//			  		 $(e).attr('checked','checked');
//			  	}	
//			});
	    	
	    	$(obj).attr('checked','checked');
	    	
	    }else{
	    	
//	    	$.each($(obj), function(i, e){
//				if ( $(e).css("display") !="none"){
//			  		 $(e).attr('checked','false');
//			  		 $(e).attr('checked','');
//			  	}	
//			});
	    	$(obj).removeAttr('checked');
	    	
	    	
	    }
	}
	
	//全选
	function checkAll1(o, level){
		var li = $(o).parent().parent().next();
		//alert($(obj).attr('class'))
		if( $(li).attr('class')  != level){
			var obj = $(li).find('input[type="checkbox"]');
			if( o.checked == true ){
	    		$(obj).attr('checked','true');;
		    }else{
	    		$(obj).removeAttr('checked');
			    
		    }
		}
	   
	}

  //选中
  /**
   * 参数o--当前对象
   *    id --一级对象id
   */
  function checkon(o, id){
	  if( o.checked == true ){
          $(o).parents('li').addClass('bg_on') ;
          if(id)
    		  $('#div_'+id+' input[name="checkbox"]').attr('checked',true);
      }else{
          $(o).parents('li').removeClass('bg_on') ;
          if(id)
    		  $('#div_'+id+' input[name="checkbox"]').attr('checked',false);
      }
  }
  
//选中
  /**
   * 参数o--当前对象
   *    id --一级对象id
   */
  function checkon(o, id){
	  if( o.checked == true ){
          $(o).parents('li').addClass('bg_on') ;
          if(id)
    		  $('#div_'+id+' input[name="checkbox"]').attr('checked',true);
      }else{
          $(o).parents('li').removeClass('bg_on') ;
          if(id)
    		  $('#div_'+id+' input[name="checkbox"]').attr('checked',false);
      }
  }

  /**
   * 获取选中
   */
  function getChecked( type ) {
      var ids = new Array();
      var id;
      if( type=='layui'){
    	  // 获取layui选中
    	  $.each($('tbody .layui-form-checked'), function(i, n){
        	  //console.log($(n).css("display"));
    		  id = $(this).prev().val();
          	
              if (id && id != "on") {
            	  ids.push(id);
              }
          }); 
      }else{
    	  $.each($('input:checked'), function(i, n){
        	  //console.log($(n).css("display"));
          	id = $(n).val();
              if (id  && $(n).css("display") !="none" && id != "on") ids.push(id);
          }); 
      }
      
      return ids;
  }
  
//获得选中:获取colorbox 选中
  function getCheckedForColorbox() {
      var ids = new Array();
      var id;
      $.each($('#cboxLoadedContent input:checked'), function(i, n){
      	id = $(n).val();
          if (id > 0 || id ) ids.push(id);
      });
      return ids;
  }
  
  /*
   * MAP对象，实现MAP功能
   *
   * 接口：
   * size()     获取MAP元素个数
   * isEmpty()    判断MAP是否为空
   * clear()     删除MAP所有元素
   * put(key, value)   向MAP中增加元素（key, value) 
   * remove(key)    删除指定KEY的元素，成功返回True，失败返回False
   * get(key)    获取指定KEY的元素值VALUE，失败返回NULL
   * element(index)   获取指定索引的元素（使用element.key，element.value获取KEY和VALUE），失败返回NULL
   * containsKey(key)  判断MAP中是否含有指定KEY的元素
   * containsValue(value) 判断MAP中是否含有指定VALUE的元素
   * values()    获取MAP中所有VALUE的数组（ARRAY）
   * keys()     获取MAP中所有KEY的数组（ARRAY）
   *
   * 例子：
   * var map = new Map();
   *
   * map.put("key", "value");
   * var val = map.get("key")
   * ……
   *
   */
  function Map() {
      this.elements = new Array();

      //获取MAP元素个数
      this.size = function() {
          return this.elements.length;
      };

      //判断MAP是否为空
      this.isEmpty = function() {
          return (this.elements.length < 1);
      };

      //删除MAP所有元素
      this.clear = function() {
          this.elements = new Array();
      };

      //向MAP中增加元素（key, value) 
      this.put = function(_key, _value) {
          this.elements.push( {
              key : _key,
              value : _value
          });
      };

      //删除指定KEY的元素，成功返回True，失败返回False
      this.remove = function(_key) {
          var bln = false;
          try {
              for (i = 0; i < this.elements.length; i++) {
                  if (this.elements[i].key == _key) {
                      this.elements.splice(i, 1);
                      return true;
                  }
              }
          } catch (e) {
              bln = false;
          }
          return bln;
      };

      //获取指定KEY的元素值VALUE，失败返回NULL
      this.get = function(_key) {
          try {
              for (i = 0; i < this.elements.length; i++) {
                  if (this.elements[i].key == _key) {
                      return this.elements[i].value;
                  }
              }
          } catch (e) {
              return null;
          }
      };

      //获取指定索引的元素（使用element.key，element.value获取KEY和VALUE），失败返回NULL
      this.element = function(_index) {
          if (_index < 0 || _index >= this.elements.length) {
              return null;
          }
          return this.elements[_index];
      };

      //判断MAP中是否含有指定KEY的元素
      this.containsKey = function(_key) {
          var bln = false;
          try {
              for (i = 0; i < this.elements.length; i++) {
                  if (this.elements[i].key == _key) {
                      bln = true;
                  }
              }
          } catch (e) {
              bln = false;
          }
          return bln;
      };

      //判断MAP中是否含有指定VALUE的元素
      this.containsValue = function(_value) {
          var bln = false;
          try {
              for (i = 0; i < this.elements.length; i++) {
                  if (this.elements[i].value == _value) {
                      bln = true;
                  }
              }
          } catch (e) {
              bln = false;
          }
          return bln;
      };

      //获取MAP中所有VALUE的数组（ARRAY）
      this.values = function() {
          var arr = new Array();
          for (i = 0; i < this.elements.length; i++) {
              arr.push(this.elements[i].value);
          }
          return arr;
      };

      //获取MAP中所有KEY的数组（ARRAY）
      this.keys = function() {
          var arr = new Array();
          for (i = 0; i < this.elements.length; i++) {
              arr.push(this.elements[i].key);
          }
          return arr;
      };
  }
  
  function clock(){
	  var t = null;
	  t = setTimeout(time,1000);//开始执行
	  function time()
	  {
	     clearTimeout(t);//清除定时器
	     dt = new Date();
	     var h=dt.getHours();
	     var m=dt.getMinutes();
	     var s=dt.getSeconds();
	     var  cur_time =  "现在的时间为："+h+"时"+m+"分"+s+"秒";
	     t = setTimeout(time,1000); //设定定时器，循环执行          
	     
	     return cur_time;
	  }  
	  
	  time();
  }
  
  /**
   * 通过layer 打开一个iframe层
   * 
   * @param title
   * @param src
   * @param width
   * @param height
   * @returns
   */
  function open_layer( title, src, width, height ){
		if( !width ){
			width = 500;
		}
		
		if( typeof width=='string' && width.indexOf('%') > -1  ){
			// 计算当前页面的宽度
			var iWidth = parseInt(width);
			if( iWidth > 100 ){
				iWidth = 100;
			}
			width = ($(window).width() -10) * ( iWidth / 100 ) ;
			
			height = $(window).height() -10 ;
		}
		// 增加标识，标识该页面是通过弹窗加载的，在刷新的时候不会加载该页面
		src += '&href_type=open_layer';
		// 初始化公共参数
		var iType 		= 2;
		var sSkin 		= ''; //加上边框
		var iAnim 		= 5;// 动画
		var bShadeClose = true;
		var aShade 		= [0.6,'#000'];
		var bMaxmin		= true;
	
		// 如果指定了高度
		if( height ){
			layui.use('layer', function(){
				var index = layui.layer.open({
					type: iType,
					skin: sSkin, //加上边框
					anim: iAnim,// 动画效果
					title: title,
	                //area: '700px',
	                area: [width+'px', height +"px"],
					shadeClose: bShadeClose,
					shade: aShade, //0.1透明度的白色背景
					maxmin: bMaxmin, //开启最大化最小化按钮
					content: [src , 'y'], //iframe的url，no代表不显示滚动条
				});
			});
			
		}else{
			
			
			layui.use('layer', function(){
				var index = layui.layer.open({
					type: iType,
					skin: sSkin, //加上边框
					anim: iAnim,// 动画
					offset: 'cm', // 居中弹窗
					title: title,
					area: ['600px', '60%'],
					shadeClose: bShadeClose,
					shade: aShade, //0.1透明度的白色背景
					maxmin: bMaxmin, //开启最大化最小化按钮
					content: [src, 'y'], //iframe的url，no代表不显示滚动条
					success: function (layero, index) {
						//layui.layer.iframeAuto(index)///////////这里是调用的地方
	                }
				});
			});
			return ;
			
			// 如果是ie浏览器，只要是ie8，ie9，ie10
			// var browser_type = getBrowser();
			var ie_version = getIEVersion();
			if( /*browser_type == 'ie' && */ie_version > 0 && ie_version < 11 ){
				layui.use('layer', function(){
					var index = layui.layer.open({
						type: iType,
						skin: sSkin, //加上边框
						anim: iAnim,// 动画
						offset: 'cm', // 居中弹窗
						title: title,
						area: ['600px', '60%'],
						shadeClose: bShadeClose,
						shade: aShade, //0.1透明度的白色背景
						maxmin: bMaxmin, //开启最大化最小化按钮
						content: [src, 'y'], //iframe的url，no代表不显示滚动条
						success: function (layero, index) {
							layui.layer.iframeAuto(index)///////////这里是调用的地方
		                }
					});
				});
			}else{
				layui.use('layer', function(){
					var index = layui.layer.open({
						type: iType,
						skin: sSkin, //加上边框
						anim: iAnim,// 动画
						offset: 'cm', // 居中弹窗
						title: title,
		                //area: '600px',
		                area: ['600px', '60%'],
						shadeClose: bShadeClose,
						shade: aShade, //0.1透明度的白色背景
						maxmin: bMaxmin, //开启最大化最小化按钮
						content: [src, 'y'], //iframe的url，no代表不显示滚动条
						success: function (layero, index) {
							// layui.layer.iframeAuto(index)///////////这里是调用的地方
		                }
						  /* end: function(){ //此处用于演示
						    layer.open({
						      type: 2,
						      title: '很多时候，我们想最大化看，比如像这个页面。',
						      shadeClose: true,
						      shade: false,
						      maxmin: true, //开启最大化最小化按钮
						      area: ['893px', '600px'],
						      content: '//fly.layui.com/'
						    });
						  } */
					});
				});
			}
			
			
		}
		
	}
  
  /**
   * 通过layer 打开一个iframe层
   * 
   * @param msg
   * @returns
   */
  function layer_alert( msg ){
	  layui.use('layer', function(){
		  layui.layer.alert(msg, {
			  icon: 2,
		  		shade: [0.4,'#000'], //0.1透明度的白色背景
		  });
	  });
	}
  
  /**
   * 通过layer 打开一个iframe层
   * 
   * @param msg
   * @returns
   */
  function layer_msg( msg, type ){
	  if( !type ){
		  type = 1; 
	  }
	  layui.use('layer', function(){
		  layui.layer.msg(msg, {
			  icon: type,
			  shade: [0.4,'#000'], //0.1透明度的白色背景
			  time: 2000, //2s后自动关闭
		  });
	  });
	}
  
  /**
   * 通过layer 打开一个confirm弹窗
   * 
   * @param msg
   * @returns
   */
  function layer_confirm(msg,  callback) {
	  layui.use('layer', function(){
		  layui.layer.confirm(msg, 
		  {
			  shade: [0.4,'#000'], //0.1透明度的白色背景
			  //shadeClose: true,
		  }, 
		  function () {
			  layui.layer.closeAll('dialog');
			  // 执行回调函数
				callback();
		  });
	  }); 
	}
  
  /**
   * 通过layer 打开一个tips弹窗
   * 
   * @param msg
   * @returns
   */
  function layer_tips(id, msg) {
	  layui.use('layer', function(){
		  
		  layer.layer.tips(msg, id, {
			  tips: [1, '#3595CC'],
			  shade: [0.4,'#000'], //0.1透明度的白色背景
			  time: 4000
		  });
		 
	  }); 
	}
  
  /**
   * 右下角提示框
   * @returns
   */
  function layer_tips_right( title, src, width, height ){
	  if(!src || typeof msg == 'undefined' ){
		  //src = 
	  }
	  
	 
	  
	  layui.use('layer', function(){
		  
		  layer.config({
			  extend: 'tips-right/layer.css' //同样需要加载新皮肤
			});
		  
		  layer.open({
			  type: 2,
			  title: title,
			  scrollbar: false,
			  skin: 'layer',
			  // closeBtn: 0, //不显示关闭按钮
			  //shade: [0],
			  shade: [0.4,'#000'], //0.1透明度的白色背景
			  area: ['340px', '180px'],
			  offset: 'rb', //右下角弹出
			  time: 5000, //3秒后自动关闭
			  anim: 2,
			  content: [src, 'no'], //iframe的url，no代表不显示滚动条
			 // content: msg
			  /*end: function(){ //此处用于演示
		      		layer.open({
			        type: 2,
			        title: '很多时候，我们想最大化看，比如像这个页面。',
			        shadeClose: true,
			        shade: false,
			        maxmin: true, //开启最大化最小化按钮
			        area: ['893px', '600px'],
			        content: '//fly.layui.com/'
		      	});
	    	}*/
		  }); 
	  });
  }
  
//小
  
  
//加法函数，用来得到精确的加法结果
//说明：javascript的加法结果会有误差，在两个浮点数相加的时候会比较明显。这个函数返回较为精确的加法结果。
//调用：accAdd(arg1,arg2)
//返回值：arg1加上arg2的精确结果
function accAdd(arg1,arg2){
  var r1,r2,m;
  try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}
  try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}
  m=Math.pow(10,Math.max(r1,r2))
  return (arg1*m+arg2*m)/m
}

//减法函数，用来得到精确的减法结果
//说明：javascript的加法结果会有误差，在两个浮点数相加的时候会比较明显。这个函数返回较为精确的减法结果。
//调用：accSub(arg1,arg2)
//返回值：arg1减去arg2的精确结果
function accSub(arg1,arg2){
  var r1,r2,m,n;
  try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}
  try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}
  m=Math.pow(10,Math.max(r1,r2));
  //last modify by deeka
  //动态控制精度长度
  n=(r1>=r2)?r1:r2;
  return ((arg1*m-arg2*m)/m).toFixed(n);
}
 
//除法函数，用来得到精确的除法结果
//说明：javascript的除法结果会有误差，在两个浮点数相除的时候会比较明显。这个函数返回较为精确的除法结果。
//调用：accDiv(arg1,arg2)
//返回值：arg1除以arg2的精确结果
function accDiv(arg1,arg2){
  var t1=0,t2=0,r1,r2;
  try{t1=arg1.toString().split(".")[1].length}catch(e){}
  try{t2=arg2.toString().split(".")[1].length}catch(e){}
  with(Math){
    r1=Number(arg1.toString().replace(".",""))
    r2=Number(arg2.toString().replace(".",""))
    return (r1/r2)*pow(10,t2-t1);
  }
}

//乘法函数，用来得到精确的乘法结果
//说明：javascript的乘法结果会有误差，在两个浮点数相乘的时候会比较明显。这个函数返回较为精确的乘法结果。
//调用：accMul(arg1,arg2)
//返回值：arg1乘以arg2的精确结果
function accMul(arg1,arg2) {
  var m=0,s1=arg1.toString(),s2=arg2.toString();
  try{m+=s1.split(".")[1].length}catch(e){}
  try{m+=s2.split(".")[1].length}catch(e){}
  return  Number(s1.replace(".",""))*Number(s2.replace(".",""))/Math.pow(10,m)
}

/**
 * 验证一个元素是否存在
 * 
 * @returns
 */
function verify_element_exists( id ){
	var len =$('#' + id).length; 
	
	if( len > 0 ) { 
		return true;
	} 
	return false;
}

$(function() {
  // 获取页面的高度
	//alert($(window).height() - 180); //浏览器当前窗口可视区域高度
	/*var nav_h 		= $(".nav").height();
	var footer_h 	= $(".footer").height();
	
	var h = $(window).height() - 260;
	if( h < 506 ){
		h = 506
	}
	$(".left-wrapper").height( h );
	$(".main-content").css("minHeight",h);*/

	//alert($(document).height()); //浏览器当前窗口文档的高度

	//alert($(document.body).height());//浏览器当前窗口文档body的高度

	//alert($(document.body).outerHeight(true));//浏览器当前窗口文档body的总高度 包括border padding margin

	//alert($(window).width()); //浏览器当前窗口可视区域宽度

	//alert($(document).width());//浏览器当前窗口文档对象宽度

	//alert($(document.body).width());//浏览器当前窗口文档body的高度

	//alert($(document.body).outerWidth(true));//浏览器当前窗口文档body的总宽度 包括border padding margin

});

//将主体的高度设置全屏模式
$(function() {
	
	// 隐藏父页面的加载进度层
	$('#loading_iframe', parent.document).hide();
	
	if ( $("#ui-content").length > 0 ) { 
		
        var minHeight = $(window).height() - $("#ui-content").offset().top - 20;
        if ($("#ui-content").height() < minHeight) {
            $("#ui-content").height(minHeight);
        }
	}
	
	
	 //浏览器不支持 placeholder 时才执行  
    if (!('placeholder' in document.createElement('input'))) {  
        $('[placeholder]').each(function () {  
            var $tag = $(this); //当前 input  
            var $copy = $tag.clone();   //当前 input 的复制  
            if ($copy.val() == "") {  
                $copy.css("color", "#999");  
                $copy.val($copy.attr('placeholder'));  
            }  
            $copy.focus(function () {  
                if (this.value == $copy.attr('placeholder')) {  
                    this.value = '';  
                    this.style.color = '#000';  
                }  
            });  
            $copy.blur(function () {  
                if (this.value=="") {  
                    this.value = $copy.attr('placeholder');  
                    $tag.val("");  
                    this.style.color = '#999';  
                } else {  
                    $tag.val(this.value);  
                }  
            });  
            $tag.hide().after($copy.show());    //当前 input 隐藏 ，具有 placeholder 功能js的input显示  
        });  
    }  
});
  