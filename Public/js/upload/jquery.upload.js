/*
    通用文件上传类
    version 1.00
    code by chenfeng during 2013-03-12
    link 348018533@qq.com
    update by rain during 2014-03-07
    update by Richer 该插件需要和thinkphp标签 TablibUi配合试用
    update by Richer during 2016-01-08 修改插件的默认参数，增加代码的注释
	update by Richer during 2016-01-08  修改插件的获取上传域文件名称的方法：对于ie8和ie9进行特殊处理
	update by Richer during 2016-01-11  修改插件的获取上传域文件名称的方法：增加对IE10的处理
	update By Richer during 2016-06-27  修改删除按钮的功能：增加参数“islogicdel”，判断该附件是否为逻辑删除，若为逻辑删除，只将页面值清空，不删除相关附件
	update by Richer during 2016-10-28  增加参数issync：是否上传到ftp服务器
	
	
    Demo：
    $("#filepost1").Uploader({////上传控件的ID
        action: "/ajax/uploaderajax.ashx",//上传到服务器的路径 默认：/ajax/uploaderajax.ashx
        params: "action=uploadpic",//特殊参数 随同文件一起提交到后台,以&号分隔 默认：action=uploadpic
        maxsize: 1024 * 500,//文件最大尺寸  默认：500K
        datatype: "text", //回调的数据格式
        exts: ".jpg|.png|.gif|.jpeg",//文件格式限制 默认：.jpg|.png|.gif|.jpeg
        callback: function (data) { //上传完成之后回调函数 
        }
    });
 */
$(function() {
	var Uploader = function(file, options) {
		//设置默认参数
		var defaults = {
			action : "/ajax/uploaderajax.ashx",//默认提交action
			params : "",//特殊参数 随同文件一起提交到后台,以&号分隔 默认：action=uploadpic
			maxsize : 1024 * 500,//文件最大尺寸  默认：500K
			exts : ".jpg|.png|.gif|.jpeg|.pdf|.xls|.doc",//允许上传文件的后缀名
			datatype : "text",//Ajax返回数据格式回调的数据格式
			callback : function(file, data) {
			}
		};
		//判断参数如果是remove删除当前上传域
		if (options == "remove") {
			Uploader.Remove(file);
			return;
		}
		//合并options参数
		var opts = $.extend(defaults, options);
		//获取porams中的全部参数
		var params = opts.params.split("&");
		//console.log(params)
		var datatype = opts.datatype;
		//组合当前上传域对应的form表单
		var form = $('<form action="' + opts.action
				+ '" enctype="multipart/form-data" method="post" target="ifr_'
				+ $(file).attr("id") + '" name="form_' + $(file).attr("id")
				+ '" id="form_' + $(file).attr("id")
				+ '" style="display: none;"/>');
		//add By Richer 于20150619 将文件的最大限制传值到服务器端
		//$(form).append('<input type="hidden" name="maxsize" value="'+  opts.maxsize + '"/>');
		//将一些特殊参数放在隐藏域中
		for (var i = 0; i < params.length; i++) {
			var values = params[i].split("=");
			//console.log(values)
			$(form).append( '<input type="hidden" name="' + values[0] + '" value="' + values[1] + '"/>');
		}
		//生成iframe
		var iframe = $('<iframe name="ifr_' + $(file).attr("id") + '" id="ifr_' + $(file).attr("id") + '" style="position: absolute; top: -999px;"></iframe>');
		//修改change绑定事件 逻辑添加.. 防止change事件被覆盖
		$(file).live('change',function(e) {
			//如果当前上传域存在
			if ($(this).val() != "" && $(this) != undefined) {
				//上传之前对文件的合法性进行验证
				if (!Uploader.BeforeCheck(file, opts)) {
					return;
				}
				var pfile = $(this).parent();
				$(form).append($(this));
				$(form).submit();
				//add by Richer 于20140609 上传附件的时候显示层
				showOverlay();
				//
				$(pfile).append($(this));
			}
		});
		$(iframe).load(function() {
			var contents = $(this).contents().get(0);
			var data = $(contents).find('body').html();
			if (data == "") {
				return;
			}
			if (datatype == "json")
				data = window.eval('(' + data + ')');
			opts.callback(file, data);
		});
		$("body").append(form);
		$("body").append(iframe);

	}
	//上传之前对文件的合法性进行验证：验证文件的大小、文件的后缀
	Uploader.BeforeCheck = function(file, opts) {
			
		//判断上传文件的后缀是否合法
		var isExt = Uploader.checkFileExt(file, opts);
		if (!isExt) {
			alert(Uploader.getErrorTip("Ext",opts));
			return false;
		}
		
		//判断上传文件的大小是否合法
		var isSizeLegal = Uploader.checkFileSize(file, opts);
		if (!isSizeLegal) {
			alert(Uploader.getErrorTip("MaxSize",opts));
			return false;
		}
		
		return true;
	}
	//上传验证提示参数配置
	Uploader.getErrorTip = function(tip, opts) {
		var ErrorTip ="";
		switch (tip) {
			case 'MaxSize':
				ErrorTip = "文件超过尺寸，请上传小于" + opts.maxsize/(1024*1024) + "M的文件";
				break;
			case 'Ext':
				var exttip = Uploader.getExttip( opts );
				ErrorTip = "文件格式错误，请您上传" + exttip+ "格式的文件";
				break;
			case 'FileError':
				ErrorTip = "文件名获取失败";
				break;
		default:
			break;
		}
		return ErrorTip;
	}
	
	//获取可用上传后缀名的提示
	Uploader.getExttip = function( opts) {
		var exttip = "";
		var new_exts = new Array();
		var exts = opts.exts.split("|");
		for (var i = 0; i < exts.length; i++) {
			//将所有的后缀转换成小写字母。并且去点前面的“.”
			new_exts.push( exts[i].toLowerCase().substr(1) );
		}
		//jquery 数组去重复  $.unique不兼容ie
		//$.unique(new_exts);
		new_exts = uniqueArray(new_exts);
		//组合后缀
		for (var j = 0; j < new_exts.length; j++) {
			
			exttip += '、' + new_exts[j];
			
		}
		exttip = exttip.substr(1);
		return exttip;
	}	
	//验证上传文件的后缀名是否合法
	Uploader.checkFileExt = function( file,opts) {
		var fileName = "";//当前文件域上传的文件名
		var fileField = null;//当前文件域对象
		var fileSize = 0;//文件大小
		//如果是ie浏览器
		if ($.browser.msie) {
			fileField = document.getElementById($(file).attr("id"));
			//ie8 ie9 ie10需要特殊处理：附件的名称
			if( parseInt( $.browser.version ) <= 10 ){
				fileName =  fileField.value;
				//alert( fileField.fileSize)
			}else{
				fileName = fileField['name']; 
			}
		} else {
			fileField = document.getElementById($(file).attr("id")).files[0];
			fileName = fileField['name']; 
		}
		
		//如果当前文件名获取失败，提示错误
		if( !convertUndefinedToEmpty(fileName) ){
			//alert(Uploader.getErrorTip("FileError",opts));
			return false;
		}
		
		var fileNames = fileName.split('.');
		var ext = '.' + fileNames[fileNames.length-1];
		var exts = opts.exts.split("|");
		var isExt = false;
		for (var i = 0; i < exts.length; i++) {
			//if (ext.indexOf(exts[i]) >= 0) {
			if (ext == exts[i] ) {
				isExt = true;
				break;
			}
		}
		
		return isExt;
	}
	//验证上传文件的大小
	Uploader.checkFileSize = function( file,opts) {
		var fileField = null;//当前文件域对象
		var isLegal = false;//文件大小
		//如果是ie浏览器
		if ($.browser.msie) {
			fileField = document.getElementById($(file).attr("id"));
			//ie10以上需要判断文件的大小
			if( parseInt( $.browser.version ) >= 10 ){
				//如果不是ie低版本浏览器会判断当前文件的大小是否超过文件的限制
				if ( fileField.size <= opts.maxsize) {
					isLegal =  true;
				}
			}else{
				isLegal = true
			}
		} else {
			fileField = document.getElementById($(file).attr("id")).files[0];
			//如果不是ie低版本浏览器会判断当前文件的大小是否超过文件的限制
			if ( fileField.size <= opts.maxsize) {
				isLegal =  true;
			}
		}
		return isLegal;
	}

	Uploader.Remove = function(file) {
		$(file).remove()
		$("#form_" + $(file).attr("id")).remove();
		$("#ifr_" + $(file).attr("id")).remove();
	}
	$.fn.Uploader = function(options) {
		return new Uploader(this, options);
	}
})


/*=========================== 以下为插件的具体实现：需要结合上传标签 TagLibUi使用（位置：/Trunk/assemble/Core/Extend/Driver/TagLib/TagLibUi.class.php）==============>
/*=========================== 以下方法可能需要进行优化：如需优化请联系Richer	==============>	
 * 
 * update By Richer 于20160627 修改删除按钮的功能：增加参数“islogicdel”，判断该附件是否为逻辑删除，若为逻辑删除，只将页面值清空，不删除相关附件
 * update By Richer 于20161028 增加参数“issync”，是否需要上传到ftp服务器,参数“syncgroup”上传到哪个分组
 * 
 */

/**
 * 绑定上传事件
 */
function bindUploader( id, url, downloadurl, delurl, maxSize, suffix, type , filename , filetype , callbackfunc, beforeopefunc,attachmentType, sheettype, islogicdel, issync, syncgroup ){
	/*bingParas['url'] = url;
	bingParas['downloadurl'] = downloadurl;
	bingParas['delurl'] = delurl;
	bingParas['maxSize'] = maxSize;
	bingParas['suffix'] = suffix;
	bingParas['type'] = type;
	bingParas['filename'] = filename;
	bingParas['filetype'] = filetype;
	bingParas['callbackfunc'] = callbackfunc;
	bingParas['beforeopefunc'] = beforeopefunc;
	bingParas['attachmentType'] = attachmentType;
	bingParas['sheettype'] = sheettype;
*/
	var canOpr = true;
	if(beforeopefunc){
		//在绑定之前先判断是否有权限
		canOpr = executeBeforefunc( beforeopefunc );
	}
	//
	if( canOpr  ){
		
		$( "#" + id ).Uploader({
			action : url, // 上传到服务器的路径
			maxsize : 1024 * 1024 * maxSize, // 文件最大尺寸
			exts : suffix,// 文件格式限制 默认BMP、JPG、JPEG、PNG、GIF
			//params : "maxSize=" + maxSize,
			params : "action=uploadpic&suffix="+suffix+"&maxsize="+ maxSize+"&filename="+filename+"&filetype="+filetype+ "&beforeopefunc=" + beforeopefunc + "&issync=" + issync + "&syncgroup=" + syncgroup,
			// dataType : 'json',
			callback : function(file, data) { // 上传完成之后回调函数
				//alert(filename);
				//alert(data);
				// 隐藏遮罩层
				hideOverlay();

				// 转换数据为JSON格式
				var data_obj = eval('(' + data + ')');
				//console.log(data_obj);
				// 判断是否上传成功
				if (data_obj.status == 1) {

					// 提示上传成功
					alert("文件上传成功！");
					//设置上传成功的标记
					isSuccessUpload = 1;

					// 将当前上传区域对应的已上传标识打上标记
					$("#uploadflag_" + id).val("1");
					
					// 获取上传成功后的信息：主要是附件的信息
					var info = data_obj.info;
					// 获取上传文件存储路径
					var savepath = info['savepath'];
					// 获取上传文件存储的文件名
					var savename = info['savename'];
					// 文件原始的文件名
					var orifilename = info['name'];
					// 获取文件的下载路径
					var fileurl = info['fileurl'];
					//获取当前file的id:由于在clone后当前对象会变化，不能用parent方法获取，其他的所有元素可用根据定义的id来进行获取
					var id= $(file).attr("id") ;
					//如果当前上传的附件类型是图片
					if ( type == 'img' ) {
						
						/*-------------------2016/1/18 weiwei.lu 隐藏默认图片域   begin--------------------------*/
						//隐藏默认图片域 
						if($("#"+id).parent().children(".ui-uploader-form-img").length>0){
							$("#"+id).parent().children(".ui-uploader-form-img").hide();
						}
						/*--------------------------------隐藏默认图片域   end----------------------------------*/
						//显示图片域
						$(file).parent().children("div").children("img").show();
						//给img赋值
						$(file).parent().children("div").children("img").attr("src", fileurl);
						//显示图片域
						$("#child_div_" + id ).children('img').show();
						//给img赋值
						$("#child_div_" + id ).children('img').attr('src', fileurl);
					}else{
						//获取下载的路径
						var downurl  = downloadurl  + "/id/" + info["id"];
					
						// 对a标签进行赋值
						$(file).parent().children('div').children('a').attr('href', downurl);
						// 对a标签文本进行赋值
						$(file).parent().children('div').children('a').text(orifilename);
						// 对a标签进行赋值
						$("#child_div_" + id ).children('a').attr('href', downurl);
						// 对a标签文本进行赋值
						$("#child_div_" + id ).children('a').text(orifilename);
					}
					// 为隐藏域进行赋值
					$("#fileurl_" + id ).val(fileurl);
					$("#filepath_" + id ).val(info['filepath']);
					$("#savepath_" + id ).val(info['savepath']);
					$("#orifilename_" + id ).val(info['name']);
					$("#formatfilename_" + id ).val(info['savename']);
					$("#fileid_" + id ).val(info["id"]);
					$("#filegroupid_" + id ).val(info['filegroupid']);
					$("#isdeleted_" + id ).val(0);
					// 为隐藏域进行赋值
					/*$(file).parent().children('div').children('input[name="fileurl[]"]').attr('value', fileurl);
					$(file).parent().children('div').children('input[name="filepath[]"]').attr('value', info['filepath']);
					$(file).parent().children('div').children('input[name="savepath[]"]').attr('value', info['savepath']);
					
					$(file).parent().children('div').children('input[name="orifilename[]"]').attr('value', info['name']);
					$(file).parent().children('div').children('input[name="formatfilename[]"]').attr('value',info['savename']);
					$(file).parent().children('div').children('input[name="fileid[]"]').attr("value", info["id"]);
					$(file).parent().children('div').children('input[name="filegroupid[]"]').attr("value", info["filegroupid"]);
					$(file).parent().children('div').children('input[name="isdeleted[]"]').attr("value", 0);
				
					*/
					//将删除按钮显示
					//$(file).parent().parent().next().find('input').show();

					/* $(file).parent().children('div').children('span').text(info['name']); */
					$("#div_" + id ).show();
					$("#child_div_" + id ).show();
					$(file).parent().children('div').show();

					// 隐藏上传file域
					$(file).hide();
					// 隐藏上传file域
					$("#" + id ).hide();
					$(file).parent().children('span').hide();
					
					//上传成功后为删除按钮绑定click事件
					bindDelFunc( id, info["id"],delurl , callbackfunc,beforeopefunc,attachmentType ,sheettype,islogicdel );
					
					//如果有回调函数
					if( callbackfunc ){
						executeCallbackfunc( callbackfunc, attachmentType , sheettype, info["id"] ,id);
					}

				} else {

					$("#uploadflag_" + id).val("0");
					isSuccessUpload = 0;
					alert("文件上传失败！原因：" + data_obj.info);
					$("#" + id ).val("");
					$("#" + id ).text("");
				}
			}
		});
	}else{
		//绑定click函数
		$( "#" + id ).bind("change",function(){
			
			alert("文件上传失败，您暂时无法操作该申报单");
			
		});
		
	}
	
	
}

	/**
	 * 绑定删除事件
	 * 
	 * update By Richer 于20160627 修改删除功能：增加参数islogicdel，判断该附件是否为逻辑删除，若为逻辑删除，只将页面值清空，不删除相关附件
	 */
	function bindDelFunc( id , fileid, delurl,callbackfunc,beforeopefunc,attachmentType ,sheettype, islogicdel){
				
		//先解除绑定
		$( "#btn_del_" + id ).unbind("click");
		//先解除绑定
		$( "#btn_del_" + id ).removeAttr("onclick");
		
		//绑定click函数
		$( "#btn_del_" + id ).bind("click",function(){
			
			delFile(id,fileid,delurl, callbackfunc,beforeopefunc,attachmentType,sheettype, islogicdel);
			
		});
	}

	/**
	 * update By Richer 于20160627 修改删除功能：增加参数islogicdel，判断该附件是否为逻辑删除，若为逻辑删除，只将页面值清空，不删除相关附件
	 * 删除功能
	 * @param id
	 * @param fileid
	 * @param delurl
	 * @param callbackfunc
	 * @param beforeopefunc
	 * @param attachmentType
	 * @param sheettype
	 * @param islogicdel
	 * @returns {Boolean}
	 */
	function delFile(id,fileid,delurl , callbackfunc,beforeopefunc,attachmentType,sheettype, islogicdel){
		if( typeof fileid =="undefined" || fileid =="undefined" || fileid == null || fileid =="null"){
			alert("文件删除失败！");
			return false;
		}
		var casOpr =  true;
		if( beforeopefunc ){
			
			casOpr = executeBeforefunc( beforeopefunc );
		}
		if( casOpr  ){
			if (confirm("文件删除后不可恢复，您确认删除该附件？")) {
				var button =  $( "#btn_del_" + id );
				//add By Richer 于20160627 修改删除功能：增加参数islogicdel，判断该附件是否为逻辑删除，若为逻辑删除，只将页面值清空，不删除相关附件
			
				if( islogicdel ==1 ){
					//如果是逻辑删除
					/*-------------------2016/1/18 weiwei.lu 显示默认图片域   begin--------------------------*/
					//显示默认图片域
					if($(button).parent().parent().children(".ui-uploader-form-img").length>0){
						$(button).parent().parent().children(".ui-uploader-form-img").show();
					}
					/*--------------------------------显示默认图片域   end----------------------------------*/
					
					//将上传成功后的域隐藏
					$(button).parent().hide();
					$(button).parent().find("div[id^='child_div_']").hide();
					
					//清除按钮或者图片的值
					$(button).parent().find('a').text("");
					$(button).parent().find('a').removeAttr("href");
					$(button).parent().find('img').removeAttr("src");
					//重置上传附件域
					resetFileInput($(button).parent().parent().find('input[type="file"]'));
					//清除上传域的值
					$(button).parent().parent().find('input[type="file"]').show();
//					$(button).parent().parent().find('input[type="file"]').html("");
					$(button).parent().parent().find('input[type="file"]').attr('value', "");
//					$(button).parent().parent().find('input[type="file"]').text("");
					$(button).parent().find('input[type="hidden"]').attr('value', "");
					//$(button).parent().parent().find('input[name="isdeleted[]').val(1);
					//将删除标记设置为1
					$("#delflag_"+id).val(1);
					//
					$("#uploadflag_"+id).val(0);
					
					$("#div_" + id ).show();
					
					//如果有回调函数
					if( callbackfunc ){
						executeCallbackfunc( callbackfunc, attachmentType , sheettype, fileid ,id ,'del');
					}else{
						
						//window.location.href= window.location.href;//删除后刷新，解决IE8下无法重复上传的问题
					}
					
					
				}else{
					$.post( delurl , { id : fileid ,callbackfunc:callbackfunc}, function(text) {
						//alert( text );
						var result = eval("(" + text + ")");
						alert(result.info);
						if (result.status == 1) {
							
							/*-------------------2016/1/18 weiwei.lu 显示默认图片域   begin--------------------------*/
							//显示默认图片域
							if($(button).parent().parent().children(".ui-uploader-form-img").length>0){
								$(button).parent().parent().children(".ui-uploader-form-img").show();
							}
							/*--------------------------------显示默认图片域   end----------------------------------*/
							
							//将上传成功后的域隐藏
							$(button).parent().hide();
							$(button).parent().find("div[id^='child_div_']").hide();
							
							//清除按钮或者图片的值
							$(button).parent().find('a').text("");
							$(button).parent().find('a').removeAttr("href");
							$(button).parent().find('img').removeAttr("src");
							//重置上传附件域
							resetFileInput($(button).parent().parent().find('input[type="file"]'));
							//清除上传域的值
							$(button).parent().parent().find('input[type="file"]').show();
//							$(button).parent().parent().find('input[type="file"]').html("");
							$(button).parent().parent().find('input[type="file"]').attr('value', "");
//							$(button).parent().parent().find('input[type="file"]').text("");
							$(button).parent().find('input[type="hidden"]').attr('value', "");
							//$(button).parent().parent().find('input[name="isdeleted[]').val(1);
							//将删除标记设置为1
							$("#delflag_"+id).val(1);
							//
							$("#uploadflag_"+id).val(0);
							
							$("#div_" + id ).show();
							
							//如果有回调函数
							if( callbackfunc ){
								executeCallbackfunc( callbackfunc, attachmentType , sheettype, fileid ,id ,'del');
							}else{
								
								//window.location.href= window.location.href;//删除后刷新，解决IE8下无法重复上传的问题
							}
							
						} else {
							
						}
					});
				}
				
			}
		}else{
			alert("文件删除失败，您暂时无法操作该申报单");
		}
	}
	
	/**
	 *将file域清空
	 */
	function resetFileInput(file) {
		var sw = file.after(file.clone().val(""));
		//console.log(bingParas);
		//bindUploader( $(sw).attr("id") , bingParas["url"] ,bingParas['downloadurl'],bingParas['delurl'],bingParas['maxSize'],bingParas['suffix'],bingParas['type'],bingParas['filename'],bingParas['filetype'],bingParas['callbackfunc'],bingParas['beforeopefunc'],bingParas['attachmentType'],bingParas['sheettype']);
		//console.log($(sw).attr("id"));
		file.remove();
		
	}
	/**
	 * 验证文件是必传
	 */
	function checkRequire(){
		
		
	}
	
	
	/**
	 * 执行回调函数
	 */
	function executeCallbackfunc( callbackfunc , attachmentType ,sheettype, fileid,id ,operate ){
		
		var callbackfuncs 	= callbackfunc.split(";"); //字符分割  
		var funcname 		= callbackfuncs[0];
		var para 			= callbackfuncs[1];
		var paras			= para.split(","); //字符分割  callbackfunc = .splite()
		
		var url = URL+ "/" + funcname;
		//alert(url)
		var content =  {};	
		var paramstr="";
		//alert(paras.length);
		var reportid = "";
		for(var i=0;i<paras.length;i++){
			var paraarray= paras[i].split("="); //字符分割  callbackfunc = .splite()
			//alert(paraarray[0])
		//	alert(paraarray[1])
			content[paraarray[0]] = paraarray[1];
			if(paraarray[0]!="action"&&paraarray[0]!="reportid"){
				paramstr+="/"+paraarray[0]+"/"+paraarray[1];//拼接url参数
			}
			
			if(paraarray[0]=="reportid"){
				reportid = paraarray[1];
			}
		}
		content['sheettype'] 		= sheettype;
		content['attachmentType'] 	= attachmentType;
		content['fileid'] 			= fileid;
		
		if( operate == "del"){
			content['isdeleted'] 			= 1;
		}
		//	alert(url);
		$.get( url , content, function(text) {
			//alert(url);
			//alert( text );
			//alert( content['action'] );
			var result = eval("(" + text + ")");
			//alert(paramstr);
			if(result.isExcel == false){
				alert('对不起，您上传的附件版本不正确，请使用低版本的Excel编辑，并另存为.xls格式重新上传！谢谢合作！');
			}
			if ( result.status == 1) {
				//将页面上的
				if( result.info && !reportid){
				//if( result.info ){
					window.location.href= URL+ "/"+content['action']+paramstr+"/reportid/"+result.info+ "/refreshflag/1";
				}
				
			} 
		});
	}
		
	
	
	/**
	 * 执行上传前函数
	 */
	function executeBeforefunc( beforeopefunc  ){
		
		var beforeopefuncs 	= beforeopefunc.split(";"); //字符分割  
		var funcname 		= beforeopefuncs[0];
		var para 			= beforeopefuncs[1];
		var paras			= para.split(","); //字符分割  callbackfunc = .splite()
		
		var url = URL+ "/" + funcname;
		//alert(url)
		var content =  {};		
		//alert(paras.length);
		for(var i=0;i<paras.length;i++){
			var paraarray= paras[i].split("="); //字符分割  callbackfunc = .splite()
			content[paraarray[0]] = paraarray[1];
		}
		para = para.replace( /=/g ,"/") 
		para = para.replace( /,/g ,"/") 
		//console.log(para);
		//console.log(url);
		url += "/" + para;
		//alert(url);
		//console.log(url);
		var canOpr = false;
		 $.ajax({  
             async:false,//使用同步的Ajax请求  
             type: "GET",  
             url: url,  
             dataType:"json",
             success: function(data){ 
            	 if(data){
            		 var status = data['status'];
            		 if( status == 1 ){
            			 canOpr = true
            		 }
            	 }
             }  
         });  
		 
		 return canOpr;
	
	}
	
	//兼容ie的数组去重方法
	function uniqueArray(a){
	    temp = new Array();
	    for(var i = 0; i < a.length; i ++){
	        if(!contains(temp, a[i])){
	            temp.length+=1;
	            temp[temp.length-1] = a[i];
	        }
	    }
	    return temp;
	}
	function contains(a, e){
	    for(j=0;j<a.length;j++)if(a[j]==e)return true;
	    return false;
	}
		