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
			action : "",//默认提交action
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
		$(file).bind('change',function(e) {
			//如果当前上传域存在
			if ($(this).val() != "" && $(this) != undefined) {
				//上传之前对文件的合法性进行验证
				if (!Uploader.BeforeCheck(file, opts)) {
					return;
				}
				var pfile = $(this).parent();
				$(form).append($(this));
				$(form).submit();
				// showOverlay();
				layer_load();
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
			layer_msg(Uploader.getErrorTip("Ext",opts),2);
			return false;
		}
		
		//判断上传文件的大小是否合法
		var isSizeLegal = Uploader.checkFileSize(file, opts);
		if (!isSizeLegal) {
			layer_msg(Uploader.getErrorTip("MaxSize",opts),2);
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
		if ( getBrowser() == 'ie') {
			fileField = document.getElementById($(file).attr("id"));
			//ie8 ie9 ie10需要特殊处理：附件的名称
			if( parseInt( getIEVersion() ) <= 10 ){
				fileName =  fileField.value;
				//layer_msg( fileField.fileSize)
			}else{
				fileName = fileField['name']; 
			}
			fileName =  fileField.value;
		} else {
			fileField = document.getElementById($(file).attr("id")).files[0];
			fileName = fileField['name']; 
		}
		
		//如果当前文件名获取失败，提示错误
		if( !convertUndefined2Empty(fileName) ){
			//layer_msg(Uploader.getErrorTip("FileError",opts));
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
		if ( getBrowser() == 'ie') {
			fileField = document.getElementById($(file).attr("id"));
			//ie10以上需要判断文件的大小
			if( parseInt( getIEVersion() ) >= 10 ){
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
 * update By Richer 于20170122 增加参数“appid”，组件使用的子系统名称
 * update By Richer 于20170122 增加参数“tagname”，用户自定义标签，用于不同业务存放附件
 * update By Richer 于20170213 增加参数“ismultiple”，同一类型的附件是否可以上传多个文件
 * 
 */

/**
 * 创建guid
 */
function createGUID( ){
	function S4() {
		return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
	}  
    return (S4()+S4()+S4()+S4()+S4()+S4()+S4()+S4());  
}

/**
 * 新增上传域
 * 
 * @returns
 */
var odernum_new = 0;
function addUploaderFiled( id, url, downloadurl, delurl, maxsize, suffix, isimage , filename , filetype , callbackfunc, beforeopefunc,attachmentType, sheettype, islogicdel, appid, groupname,tagname,truetablename,primarykey,primarykeyvalue,ismultiple,odernum,skin ){
	// 当前上传域的序号，默认是0
	if( odernum_new == 0 ){
		odernum_new = odernum ? odernum : 1;
	}
		
	//创建上传域
	var guid = createGUID();

	// 判断当前的模式，是否为simple模式
	if( skin == 'simple'){
		//创建上传域
        if (isimage == '1') {
            var html = '<li class="ui-uploader-form-li isimg" id="tr_' + guid + '">';
		}else{
            var html = '<li class="ui-uploader-form-li" id="tr_' + guid + '">';
		}

        if (filename) {
            html += '<span class="ui-uploader-form-filename">&nbsp;</span>';
            html += '<span class="ui-uploader-form-filefield-short">';
        }else{
            html += '<span class="ui-uploader-form-filefield-long">';
		}
        html += '<div id="div_' + guid + '" style="padding: 0; border: none; border-left: none; border-right: none; border-bottom: none">';
        // 判断上传的附件是否为图片
        if (isimage == '1') {
            // 如果是图片类型的附件
            html += '<div class="ui-uploader-form-img">';
            html += '<input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="' + guid + '"></div>';
            html += '<div class="ui-uploader-form-show-img" style="display: none">';
            html += '<img class="ui-img"><span id="btn_del_' + guid + '" class="ui-icon-delete"></span>';
            html += '</div>';

        } else {
            // 不是图片类型的图片
            html += '<div class="ui-uploader-form-other">';
            html += '<input name="uploadField[]" type="file" class="ui-input" id="' + guid + '">';
            html += '</div>';
            html += '<div style="display: none" id="child_div_' + guid + '">';
            html += '<input id="btn_del_' + guid + '" class="ui-uploader-form-button " type="button" value="删除">';
            html += '<a class="ui-uploader-form-a" target="_blank"></a>';
            html += '</div>';
        }

        // 设置隐藏域
        html += '<input type="hidden" name="fileurl[]" id="fileurl_' + guid + '">';
        html += '<input type="hidden" name="savepath[]" id="savepath_' + guid + '">';
        html += '<input type="hidden" name="filepath[]" id="filepath_' + guid + '">';
        html += '<input type="hidden" name="orifilename[]" id="orifilename_' + guid + '">';
        html += '<input type="hidden" name="formatfilename[]" id="formatfilename_' + guid + '">';
        html += '<input type="hidden" name="fileid[]" id="fileid_' + guid + '" value="">';
        html += '<input type="hidden" name="filegroupid[]" id="filegroupid_' + guid + '">';
        html += '<input type="hidden" name="uploadflag[]" id="uploadflag_' + guid + '" value="0">';
        html += '<input type="hidden" name="isdeleted[]" id="delflag_' + guid + '" value="0">';
        html += '<input type="hidden" name="isRequire[]" value="1" id="isRequire_' + guid + '">';
        html += '<input type="hidden" name="attachmentname[]" value="' + filename + '">';
        html += '<input type="hidden" name="attachmenttype[]" value="' + filetype + '">';
        html += '<input type="hidden" name="guid[]" value="' + guid + '">';
        html += '</div>';
        html += '</span>';
        // 删除上传域按钮区域
        html += '<span style="display: inline-block;inline-block;float: left;width:5%;">';
        html += '<div class="ui-uploader-form-minus" id="div_minus_' + guid + '"></div>';
        html += '<input type="hidden" name="odernum[]" value="' + odernum_new + '">';
        html += '</span>';
        // html	+= '<td valign="middle" align="left" width="30%"></td>';
        html += '</li>';
	}else {
        //创建上传域
        if (filename) {
            var html = '<tr valign="top" id="tr_' + guid + '"><td width="30%;" valign="middle" align="left"></td>';
        } else {
            var html = '<tr valign="top" id="tr_' + guid + '">';
        }
        html += '<td valign="middle" align="left" width="30%;" style="padding:5px 0;border:none;border-left: none;border-right: none;border-bottom:none">';
        html += '<div id="div_' + guid + '" style="padding: 0; border: none; border-left: none; border-right: none; border-bottom: none">';
        // 判断上传的附件是否为图片
        if (isimage == '1') {
            // 如果是图片类型的附件
            html += '<div class="ui-uploader-form-img">';
            html += '<input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="' + guid + '"></div>';
            html += '<div class="ui-uploader-form-show-img" style="display: none">';
            html += '<img class="ui-img"><span id="btn_del_' + guid + '" class="ui-icon-delete"></span>';
            html += '</div>';

        } else {
            // 不是图片类型的图片
            html += '<div class="ui-uploader-form-other">';
            html += '<input name="uploadField[]" type="file" class="ui-input" id="' + guid + '">';
            html += '</div>';
            html += '<div style="display: none" id="child_div_' + guid + '">';
            html += '<input id="btn_del_' + guid + '" class="ui-uploader-form-button " type="button" value="删除">';
            html += '<a class="ui-uploader-form-a" target="_blank"></a>';
            html += '</div>';
        }

        // 设置隐藏域
        html += '<input type="hidden" name="fileurl[]" id="fileurl_' + guid + '">';
        html += '<input type="hidden" name="savepath[]" id="savepath_' + guid + '">';
        html += '<input type="hidden" name="filepath[]" id="filepath_' + guid + '">';
        html += '<input type="hidden" name="orifilename[]" id="orifilename_' + guid + '">';
        html += '<input type="hidden" name="formatfilename[]" id="formatfilename_' + guid + '">';
        html += '<input type="hidden" name="fileid[]" id="fileid_' + guid + '" value="">';
        html += '<input type="hidden" name="filegroupid[]" id="filegroupid_' + guid + '">';
        html += '<input type="hidden" name="uploadflag[]" id="uploadflag_' + guid + '" value="0">';
        html += '<input type="hidden" name="isdeleted[]" id="delflag_' + guid + '" value="0">';
        html += '<input type="hidden" name="isRequire[]" value="1" id="isRequire_' + guid + '">';
        html += '<input type="hidden" name="attachmentname[]" value="' + filename + '">';
        html += '<input type="hidden" name="attachmenttype[]" value="' + filetype + '">';
        html += '<input type="hidden" name="guid[]" value="' + guid + '">';
        html += '</td>';
        // 删除上传域按钮区域
        html += '<td valign="middle" align="left" width="5%">';
        html += '<div class="ui-uploader-form-minus" id="div_minus_' + guid + '"></div>';
        html += '<input type="hidden" name="odernum[]" value="' + odernum_new + '">';
        html += '</td>';
        // html	+= '<td valign="middle" align="left" width="30%"></td>';
        html += '</tr>';
    }
	// 将内容增加到表格中
	$("#" + id ).parent().parent().parent().parent().parent().append(html);
	// 删除按钮绑定事件
	$("#div_minus_"+ guid ).bind('click',function(){
		$("#tr_" + guid ).remove();
		
		// 获取当前删除的上传域的odernum
		//var odernum_temp = $(this).parent().find("input[name^='odernum[]']").val();
		//temp_odernum_arra.push(odernum_temp);
		//layer_msg( temp_odernum_arra );
	});

	// 上传域绑定事件
	bindUploaderNew( guid, url, downloadurl, delurl, maxsize, suffix, isimage , filename , filetype , callbackfunc, beforeopefunc,attachmentType, sheettype, islogicdel, appid, groupname,tagname,truetablename,primarykey,primarykeyvalue,0,odernum_new);
	odernum_new ++;
}
/**
 * 绑定上传事件
 * 
 * 为了不和老的插件冲突，改变方法名
 */
function bindUploaderNew( id, url, downloadurl, delurl, maxsize, suffix, isimage , filename , filetype , callbackfunc, beforeopefunc,attachmentType, sheettype, islogicdel, appid, groupname,tagname,truetablename,primarykey,primarykeyvalue,ismultiple,odernum,skin){
	
	// 一个类型附件允许上传多个附件的时候，新增文件上传域按钮绑定点击事件
	$( "#div_add_" + id ).bind("click",function(){
		addUploaderFiled( id, url, downloadurl, delurl, maxsize, suffix, isimage , filename , filetype , callbackfunc, beforeopefunc,attachmentType, sheettype, islogicdel, appid, groupname,tagname,truetablename,primarykey,primarykeyvalue,ismultiple,odernum,skin);
	})
	
	
	var canOpr = true;
	if(beforeopefunc){
		//在绑定之前先判断是否有权限
		canOpr = executeBeforefuncNew( beforeopefunc );
	}
	//
	if( canOpr  ){
		
		$( "#" + id ).Uploader({
			action : url, // 上传到服务器的路径
			maxsize : 1024 * 1024 * maxsize, // 文件最大尺寸
			exts : suffix,// 文件格式限制 默认BMP、JPG、JPEG、PNG、GIF
			params : "suffix="+suffix+"&maxsize="+ maxsize+"&filename="+filename+"&filetype="+filetype+"&appid=" + appid + "&groupname=" + groupname + "&tagname=" + tagname + "&odernum="+ odernum +"&truetablename="+ truetablename +"&primarykey=" + primarykey+"&primarykeyvalue=" + primarykeyvalue,
			datatype : 'json',
			callback : function(file, data) { 
				
				//获取当前file的id:由于在clone后当前对象会变化，不能用parent方法获取，其他的所有元素可用根据定义的id来进行获取
				var id= $(file).attr("id") ;
				// 上传完成之后回调函数
				// 隐藏遮罩层
				layer_load_hide();
				// 判断是否上传成功
				if (data.status == 1) {
					// 提示上传成功
					layer_msg("文件上传成功！");
					
					//设置上传成功的标记
					isSuccessUpload = 1;
					// 将当前上传区域对应的已上传标识打上标记
					$("#uploadflag_" + id).val("1");
					
					// 获取上传成功后的信息：主要是附件的信息
					var info 		= data.info;
					// 获取上传文件存储路径
					var savepath 	= info['savepath'];
					// 获取上传文件存储的文件名
					var savename 	= info['savename'];
					// 文件原始的文件名
					var orifilename = info['name'];
					// 获取文件的下载路径
					var fileurl 	= info['fileurl'];
					
					//获取下载的路径
					var downurl  	= downloadurl  + "/id/" + info["id"];
					
					// 隐藏上传域：不能用$(file)
					$("#"+id).parent().hide();
					// 显示上传成功后区域
					$("#"+id).parent().next().show();
					// 对于可以上传多个文件的附件类型，将删除图片去掉
					$("#"+id).parent().parent().parent().next().find(".ui-uploader-form-minus").hide();
					
					//如果当前上传的附件类型是图片
					if ( isimage == '1' ) {
						//给img赋值
						$("#"+id).parent().next().find("img").attr("src", downurl);
					}else{
						
						if( verify_element_exists("layim_chat_a") ){
							$('#layim_chat_a').attr('href', downurl);
							$('#layim_chat_a').text(orifilename);
							$('#layim_chat').focus();
						}else{
							// 对a标签进行赋值
							$("#"+id).parent().next().find(".ui-uploader-form-a").attr('href', downurl);
							// 对a标签文本进行赋值
							$("#"+id).parent().next().find(".ui-uploader-form-a").text(orifilename);
						}
						
					}
					// 为公共隐藏域进行赋值
					$("#fileurl_" + id ).val(fileurl);
					$("#savepath_" + id ).val(info['savepath']);
					$("#filepath_" + id ).val(info['filepath']);
					$("#orifilename_" + id ).val(info['name']);
					$("#formatfilename_" + id ).val(info['savename']);
					$("#fileid_" + id ).val(info["id"]);
					$("#filegroupid_" + id ).val(info['filegroupid']);
					$("#isdeleted_" + id ).val(0);
					
				
					//上传成功后为删除按钮绑定click事件
					bindDelFuncNew( id, info["id"],delurl , callbackfunc,beforeopefunc,attachmentType ,sheettype,islogicdel );
					
					//如果有回调函数
					if( callbackfunc ){
						executeCallbackfuncNew( callbackfunc, attachmentType , sheettype, info["id"] ,id);
					}

				} else {

					$("#uploadflag_" + id).val("0");
					isSuccessUpload = 0;
					layer_msg("文件上传失败！原因：" + data.info,2);
					$("#" + id ).val("");
					$("#" + id ).text("");
				}
			}
		});
	}else{
		layer_load_hide();
		//绑定click函数
		$( "#" + id ).bind("change",function(){
			
			layer_msg("文件上传失败，您暂时无法操作",2);
			
		});
	}
}

	/**
	 * 绑定删除事件
	 * 
	 * update By Richer 于20160627 修改删除功能：增加参数islogicdel，判断该附件是否为逻辑删除，若为逻辑删除，只将页面值清空，不删除相关附件
	 */
	function bindDelFuncNew( id , fileid, delurl,callbackfunc,beforeopefunc,attachmentType ,sheettype, islogicdel){
				
		//先解除绑定
		$( "#btn_del_" + id ).unbind("click");
		//先解除绑定
		$( "#btn_del_" + id ).removeAttr("onclick");
		
		//绑定click函数
		$( "#btn_del_" + id ).bind("click",function(){
			
			delFileNew(id,fileid,delurl, callbackfunc,beforeopefunc,attachmentType,sheettype, islogicdel);
			
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
	function delFileNew(id,fileid,delurl,callbackfunc,beforeopefunc,attachmentType,sheettype, islogicdel){
		if( typeof fileid =="undefined" || fileid ==undefined || fileid == null || fileid =="null"){
			layer_msg("文件删除失败！",2);
			return false;
		}
		var casOpr =  true;
		if( beforeopefunc ){
			casOpr = executeBeforefuncNew( beforeopefunc );
		}
		if( casOpr  ){
			layer_confirm("文件删除后不可恢复，您确认删除该附件？",function(){
				var isSuccess = false;
				// 判断是否为逻辑删除
				if( islogicdel == 1 ){
					isSuccess = true;
				}else{
					// 非逻辑删除，ajax同步进行删除
					$.ajax({ 
						type : "post", 
						url : delurl, 
						data : { id : fileid ,callbackfunc:callbackfunc}, 
						async : false, 
						success : function(data){ 
				            data = eval("(" + data + ")"); 
				            if (data.status == 1) {
				            	isSuccess = true;
				            }
						} 
					}); 
				}
				
				// 如果删除成功
				if( isSuccess == true ){
					layer_msg('文件删除成功！');
					var button =  $( "#btn_del_" + id );
					// 将当前的域隐藏
					$(button).parent().hide();
					
					// 清除按钮或者图片的值
					$(button).parent().find('a').text("");
					$(button).parent().find('a').removeAttr("href");
					$(button).parent().find('img').removeAttr("src");
					
					// 将上传域显示
					$(button).parent().prev().show();
					
					// 重置上传附件域
					//resetFileInput($(button).parent().prev().find('input[type="file"]'));
					// 清除上传域的值
					$(button).parent().prev().find('input[type="file"]').show();
//					$(button).parent().parent().find('input[type="file"]').html("");
					$(button).parent().prev().find('input[type="file"]').attr('value', "");
					
					if( verify_element_exists("layim_chat_a") ){
						$('#layim_chat_a').removeAttr("href");
						$('#layim_chat_a').html("&nbsp;");
						$('#layim_chat').focus();
					}
//					$(button).parent().parent().find('input[type="file"]').text("");
					// 将所有的隐藏域清空
					$(button).parent().prev('input[type="hidden"]').attr('value', "");
					$(button).parent().find('input[type="hidden"]').attr('value', "");
					//$(button).parent().parent().find('input[name="isdeleted[]').val(1);
					// 将删除成功标记设置为1
					$("#delflag_"+id).val(1);
					// 将上传成功标记设置为0
					$("#uploadflag_"+id).val(0);
					
					// 显示整个上传区域
					$(button).parent().parent().show();

                    // 对于可以上传多个文件的附件类型，将删除图片显示
                    $(button).parent().parent().parent().next().find(".ui-uploader-form-minus").show();

					//如果有回调函数
					if( callbackfunc ){
						executeCallbackfuncNew( callbackfunc, attachmentType , sheettype, fileid ,id ,'del');
					}else{
						
						//window.location.href= window.location.href;//删除后刷新，解决IE8下无法重复上传的问题
					}
					
				}else{
					layer_msg('文件删除失败！',2);
				}
			})
			
		}else{
			layer_msg("文件删除失败，您暂时无法操作该申报单",2);
		}
	}
	
	/**
	 *将file域清空
	 */
	function resetFileInput(file) {
		var sw = file.after(file.clone().val(""));
		//console.log(bingParas);
		//bindUploader( $(sw).attr("id") , bingParas["url"] ,bingParas['downloadurl'],bingParas['delurl'],bingParas['maxsize'],bingParas['suffix'],bingParas['type'],bingParas['filename'],bingParas['filetype'],bingParas['callbackfunc'],bingParas['beforeopefunc'],bingParas['attachmentType'],bingParas['sheettype']);
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
	function executeCallbackfuncNew( callbackfunc , attachmentType ,sheettype, fileid,id ,operate ){
		
		var callbackfuncs 	= callbackfunc.split(";"); //字符分割  
		var funcname 		= callbackfuncs[0];
		var para 			= callbackfuncs[1];
		var paras			= para.split(","); //字符分割  callbackfunc = .splite()
		
		var url = URL+ "/" + funcname;
		//layer_msg(url)
		var content =  {};	
		var paramstr="";
		//layer_msg(paras.length);
		var reportid = "";
		for(var i=0;i<paras.length;i++){
			var paraarray= paras[i].split("="); //字符分割  callbackfunc = .splite()
			//layer_msg(paraarray[0])
		//	layer_msg(paraarray[1])
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
		//	layer_msg(url);
		$.get( url , content, function(text) {
			//layer_msg(url);
			//layer_msg( text );
			//layer_msg( content['action'] );
			var result = eval("(" + text + ")");
			//layer_msg(paramstr);
			if(result.isExcel == false){
				layer_msg('对不起，您上传的附件版本不正确，请使用低版本的Excel编辑，并另存为.xls格式重新上传！谢谢合作！',2);
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
	function executeBeforefuncNew( beforeopefunc  ){
		
		var beforeopefuncs 	= beforeopefunc.split(";"); //字符分割  
		var funcname 		= beforeopefuncs[0];
		var para 			= beforeopefuncs[1];
		var paras			= para.split(","); //字符分割  callbackfunc = .splite()
		
		var url = URL+ "/" + funcname;
		//layer_msg(url)
		var content =  {};		
		//layer_msg(paras.length);
		for(var i=0;i<paras.length;i++){
			var paraarray= paras[i].split("="); //字符分割  callbackfunc = .splite()
			content[paraarray[0]] = paraarray[1];
		}
		para = para.replace( /=/g ,"/") 
		para = para.replace( /,/g ,"/") 
		//console.log(para);
		//console.log(url);
		url += "/" + para;
		//layer_msg(url);
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

	/**
	 * 上传loading层。需要和layer框架进行结合使用
	 * @returns
	 */
	function layer_load(){
		//loading层
		var index = layer.load(1, { //0代表加载的风格，支持0-2
			shade: [0.4,'#000'], //0.1透明度的白色背景
		});
	}
	/**
	 * 上传loading层。需要和layer框架进行结合使用
	 * @returns
	 */
	function layer_load_hide(){
		//loading层
		$(".layui-layer-shade").hide();
		$(".layui-layer").hide(); 
		$(".layui-layer layui-layer-loading  layer-anim").hide(); 
	}