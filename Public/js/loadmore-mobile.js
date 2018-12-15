 /*
 * 	移动端项加载更多对象
 *  author: Richer;
 *  copyright: qisobao;
 */
var p = 2;
/**
 * 
 */
var loadmore = function ( url, pageCount, hintload, hintcomplete){ 
	
	//定义对象
	var obj = {}; 
	//设置链接地址
	obj.url 			= url + "/p/" + p; 
	//设置全部的页码
	obj.pageCount 		= pageCount; 
	//设置加载时的提示文字
	obj.hintload 		= hintload ? hintload : "正在加载..."; 
	//设置完成加载后的提示文字
	obj.hintcomplete 	= hintcomplete ? hintcomplete : "查看更多"; 
	
	//初始化加载更多
	obj.init = function( ){
		//如果只有一页数据，隐藏加载更多按钮
		if( this.pageCount <= 1 ){
			$("#loadmore_div").hide();
		}else{
			$("#loadmore_div").show();
		}
	}
	
	//加载更多数据
	obj.load = function(){ 
		var _this = this ;
		if( p > _this.pageCount ){
			return;
		}
		// 需要结合jquery-weui
		$.showLoading();
		_this.progStart();
		obj.url 		= url + "/p/" + p; 
		console.log(this.url);
		$.get( this.url , function( result ){
			//console.log(result);
			$("#content_div").append(result);
			//	如果已经加载到最后，隐藏加载更多按钮
		    if( p == _this.pageCount){
				$("#loadmore_div").hide();
			}
		    p++;
		    // 需要结合jquery-weui
	          $.hideLoading();
			//关闭加载进度条
		    _this.progStop();
		});
	}; 
		
	//显示加载进度条
	obj.progStart = function(  ){
		//进度提示
		$(".weui-loadmore__tips").text( this.hintload );
		$(".weui-loading").css("display","");
	}
	
	// 关闭加载进度条
	obj.progStop = function(  ){
		var _this = this ;
		setTimeout(function () {
			$(".weui-loading").css("display","none");
			$(".weui-loadmore__tips").text( _this.hintcomplete );
		}, 100);
	}
	
	//设置当前的页码
	obj.setPageCount = function(  ){
		
	}
	
	return obj; 
} 
