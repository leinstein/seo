<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2010-2015 苏州德融嘉信信用管理技术有限公司(www.dejax.cn) All rights reserved.
// +----------------------------------------------------------------------
// | Link (http://www.dejax.cn )
// +----------------------------------------------------------------------
// | Author: Richer
// +----------------------------------------------------------------------
// $Id: TagLibDupload.class.php 20150623 $

/**
 * +-------------------------------
 * Dupload 标签库驱动
 * +-------------------------------
 */

/**
 * +-------------------------------
 * 更新日志
 * update by Richer 于20170411 增加参数 skin，通过该参数来根据不同的标签进行渲染，simple为简单默认，通过ul和li标签进行渲染，默认为复杂方式，通过table进行渲染
 * +-------------------------------
 */

/**
 * 自定义标签控制层类
 *
 * @copyright Copyright 2010-2014 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package TagLib
 * @version 20150623
 * @type project
 * @link http://www.dejax.cn
 */
class TagLibDupload extends TagLib {
	protected $tags = array (
			// 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1）
			'script'   => array('attr'=>'name','close'=>0),
			// 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1）
			'overlay' => array (
					'attr' => 'type,showtext',
					'close' => 1 
			), // 遮罩层
			'upload' => array (
					'attr' => 'cannotedit,callbackfunc,maxsize,attachmentname,attachmenttype,attachmentdesc,suffix,isrequire,required-msg,isimage,islogicdel,appid,groupname,tagname,ismultiple,truetablename,primarykey,primarykeyvalue,skin',
					'close' => 1 
			) // 上传控件
	); 

	
	/**;
	 +----------------------------------------------------------
	 * script标签解析
	 * 格式： <dupload:script />
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @param string $attr 标签属性
	 +----------------------------------------------------------
	 * @return string|void
	 +----------------------------------------------------------
	 */
	public function _script($attr) {
		$tag      = $this->parseXmlAttr($attr,'script');
		$name       = $tag['name'];
		$array = split (",", $name); ;
		if(in_array("dupload",$array)){
			$parseStr = '<script type="text/javascript" src="__PUBLIC__/js/upload/upload.js"></script>';
			$parseStr .= '<link rel="stylesheet" href="__PUBLIC__/css/upload/upload.css"/>';
		}
		return $parseStr;
	}
	
	/**
	 * 遮罩层标签
	 *
	 * 使用方法
	 * <ui:overlay showtext="附件上传中，请稍后！" type="upload"></ui:overlay>
	 *
	 * 参数说明：
	 * showtext：该遮罩层显示的提示文字，默认为“正在处理，请稍后...”;
	 *
	 * @param string $attr        	
	 * @param string $content        	
	 * @return string
	 */
	public function _overlay($attr, $content) {
		
		// 获取并转换标签数组
		$tag = $this->parseXmlAttr ( $attr, 'overlay' );
		
		// 获取标签的值
		$showtext = ! empty ( $tag ['showtext'] ) ? $tag ['showtext'] : '正在处理，请稍后...';
		
		$parseStr = '<div id="overlay" class="ui-overlay" style="display: none;border:none;border-left: none;border-right: none;border-bottom:none">';
		$parseStr .= '<div id="showLoading" class="ui-overlay-showloading" style="border:none;border-left: none;border-right: none;border-bottom:none">';
		$parseStr .= '<img alt="" src="__PUBLIC__/js/upload/loading.gif">';
		$parseStr .= '<div style="border:none;border-left: none;border-right: none;border-bottom:none">' . $showtext . '</div>';
		$parseStr .= '</div>';
		$parseStr .= '</div>';
		return $parseStr;
	}
	
	/**
	 * 附件上传标签:所有的参数必须是变量的形式来传递
	 *
	 * 使用方法
	 * <ui:upload maxsize="10" attachmentname ="其他附件" attachmenttype="" attachmentdesc = "附件的相关描述一" suffix ="jpg,gif,doc" isrequire ="1" type="img"></ui:upload>
	 * 参数说明：
	 * maxsize：允许上传附件的最大值已M为单位，比如上传附件限制为20M，该参数为“20”;
	 * attachmentname：允许上传附件的名称，比如上传附件的名称为企业营业执照，该参数为“企业营业执照”;
	 * attachmenttype：允许上传附件的类型，保留值；
	 * attachmentdesc：允许上传附件的相关描述，存储对该上传文件的描述，为字段串;
	 * suffix：允许上传附件的后缀，比如上传附件限制文档，该参数可以为“doc,docs“每个值用逗号进行分隔;
	 * isrequire：该文件是否是必传的文件，默认为非必传，如果是必传，该参数为“1”;
	 * isimage：对于图片类型的文件请将该参数设置为“1”否则不填，通过该参数来判断附件是否为图片，如果是图片就在上传成功后显示缩略图（我们在此处不根据文件的后缀名进行判断是图片还是其他的文件，如果需要可以）;
	 * islogicdel：是否逻辑删除，默认为0，不是逻辑删除，如果为1该附件在点击删除按钮的时候不会将该附件从数据库和磁盘中上传该附件，只是将页面中该附件的ID以及其他的相关信息至为空
	 * appid: 上传附件的子系统，该参数必填
	 * groupname：当前所在的分组，默认为Service
	 * tagname:用户上传时候，自定义的标记，该参数也必填
	 * ismultiple：附件是否支持多个文件，默认为否
     * skin ：当前文件上传域渲染的模式。simple为简单模式，此时样式会通过ul 和li进行渲染，只显示简单的附件的名称和附件的上传内容，默认为复杂模式，通过table标签进行渲染
	 *
	 * @param string $attr        	
	 * @param string $content        	
	 * @return string
	 */
	public function _upload($attr, $content) {
		
		// 获取并转换标签数组
		$tag = $this->parseXmlAttr ( $attr, 'upload' );
		
		// $guid 			= $tag ['guid']; // 文件上传域的唯一表示，由于在页面通过循环方式的时候会出现问题
		$attachmentid 	= $tag['attachmentid']; // 文件主键ID，需要从数据库中获取到当前附件的相关信息
		$cannotedit 	= $tag['cannotedit']; // 当前附件是否能被编辑删除
		$maxsize 		= $tag['maxsize']; // 文件大小最大限制，默认为30M
		$attachmentname = $tag['attachmentname']; // 需要上传附件名称
		$attachmenttype = $tag['attachmenttype']; // 需要上传附件类型
		$attachmentdesc = $tag['attachmentdesc']; // 需要上传附件的相关描述
		$suffix 		= $tag['suffix']; // 允许上传附件类型
		$isRequire 		= $tag['isrequire']; // 是否必须上传 1 是 0 否
		$required_msg	= $tag['required-msg'] ? $tag['required-msg'] : "必填字段";//必填的验证提示
		$isimage		= $tag['isimage']; // 是否为图片，默认为非图片，如果是1则该附件为图片，系统会显示图片上传的相关样式
		$sheettype 		= $tag['sheettype']; // 对应的excle 的sheet
		$callbackfunc 	= $tag['callbackfunc']; // 获取当前上传标签在上传成功的回调函数
		$beforeopefunc 	= $tag['beforeopefunc']; // 获取当前上传标签在上传之前函数
		$islogicdel 	= $tag['islogicdel']; // add By Richer 于20160627 增加参数：是否逻辑删除 isLogicdel 当前上传域获是否逻辑删除，默认为0，如果为1则删除操作不会将该附件删除，只是将该上传域的附件隐藏，同时显示file标签。该参数主要是为了解决多个上传域对应同一个附件，如果有其中的一个上传域需要删除文件，如果是物理删除，那么会导致其他的上传域会清空上传的文件
		$appid 			= $tag['appid']; // 上传该附件子系统，如果参数未传，系统会获取当前子系统的SYS_NAME
		$groupname 		= $tag['groupname']; // 上传附件所在的分组，如果参数未传，系统会获取当前子系统的GROUP_NAME
		$tagname 		= $tag['tagname']; // 该附件的标签，用户自定义，比如一个对于一个业务的附件可以定义一个标识，如果参数未传，系统会获取当前操作的MODULE_NAME.'_'. ACTION_NAME
		$ismultiple 	= $tag['ismultiple']; // 是否可以上传多个文件，1 是 0 否
		$truetablename 	= $tag['truetablename']; // 使用该附件的数据库真实表名，多个用逗号进行分割：通过该字段可以很方便的做附件清理
		$primarykey 	= $tag['primarykey']; // 使用该附件的数据库表对应的主键字段名，多个用逗号进行分割 ，要和truetablename顺序一一对应
		$primarykeyvalue = $tag['primarykeyvalue']; // 使用该附件的数据库表对应的主键值，多个用逗号进行分割 ，要和primarykey顺序一一对应
		$style 			= $tag['style']; // 自定义样式：用户可以自定义上传组件的界面样式，样式的写法可以参照/kernel/Public/css/upload/upload.css样式的结构
        $skin           = $tag['skin'];// 通过该参数来根据不同的标签进行渲染，simple为简单默认，通过ul和li标签进行渲染，默认为复杂方式，通过table进行渲染

		// 设置附件上传的action以及方法
		$uploadurl 		= __GROUP__.'/Upload/doUpload';
		// 设置附件删除的方法
		$delurl 		= __GROUP__.'/Upload/delUploadFile';
		// 设置附件下载方法
		$downloadurl 	=__GROUP__.'/Upload/downloadFile';
		// 初始化模型
		/* $parseStr = '<?php $modeFile = kernel_model("File/File"); ?>';*/

        $parseStr = '';
        // 判断当前的渲染方式
        if ($skin) {
            $parseStr = '<?php $skin =$' . $skin . '; ?>';
        }
		// 判断是否存在自定义样式
		if ($style) {
			$parseStr .= '<?php $style =$' . $style . '; ?>'; 
		}

        // 判断是否存在附件的id
        if ($attachmentid) {
            $parseStr .= '<?php $attachmentid =$' . $attachmentid . '; ?>';
        }

        // 判断是否存允许上传多个文件
        if ($ismultiple) {
            $parseStr .= '<?php $ismultiple =$' . $ismultiple . '; ?>';
        }
        // 清空查询结果集
        $parseStr .= '<?php unset($attainfos); ?>';
        $parseStr .= '<?php unset($attachmentids); ?>';
        $parseStr .= '<?php if( $attachmentid ){ ?>';
        // 如果存在附件的id
        /*$parseStr .= '<?php if( $ismultiple == 1 ){ ?>';*/
        // 如果当前的附件是允上传多个文件
        // 将id字符串进行拆分，为了兼容一个附件支持上传多个文件
        $parseStr .= '<?php $attachmentids=  explode("," , $attachmentid); ?>';
        /*$parseStr .= '<?php }else{ ?>';
        // 如果当前的附件不可以上传多个文件
            $parseStr .= '<?php $attachmentids[]=   $attachmentid; ?>';
        $parseStr .= '<?php } ?>';*/
        // 查询附件信息
        $parseStr .= '<?php if( $attachmentids ){ ?>';
        $parseStr .= '<?php $map["id"] 	= array("IN",$attachmentids);';
        // 查询附件信息
        $parseStr .= '$attainfos	=  D("File/File") -> queryRecordAll($map,null,"odernum");'; // 查询语句
        //获取最大的 ordernum
        $parseStr .= '$ordernum_max	=  $attainfos[count($attainfos)-1]["odernum"] + 1;';
        $parseStr .= '} ?>';

        $parseStr .= '<?php }else{ ?>';
        // 如果不存在附件的id

        $parseStr .= '<?php } ?>';

        // 如果没获取附件信息
        $parseStr .= '<?php if( !$attainfos){ $atta["nofile"]="1";$attainfos[0] = $atta;} ?>';

        // 是否有当前附件的上传名称 =====================================>
        if ($attachmentname) {
            $parseStr .= '<?php $attachmentname = $' . $attachmentname . '; ?>';
        }
        // 判断当前附件是否必传的 =====================================>
        if ($isRequire) {
            $parseStr .= '<?php $isRequire = $' . $isRequire . '; ?>';
        }

        // 生成guid唯一标识 =====================================>
        $parseStr .= '<?php load("encode"); $guid = create_guid(); $guid = str_replace("-","",$guid ); ?>';
        // 赋值
        $guid = '<?php  echo($guid); ?>';

        // 判断当前的文件上传文件的类型 =====================================>
        if ($isimage) {
            // 如果当前附件的类型是img并且当前的后缀为空
            $parseStr .= '<?php $isimage =$' . $isimage . '; ?>';
        }

        // 判断当前的文件后缀 =====================================>
        if ($suffix) {
            $parseStr .= '<?php $suffix_temp =$' . $suffix . '; ?>';
        }
        //判断是否有参数
        $parseStr .= '<?php if(!$suffix_temp){ ?>';
        // 如果当前的后缀为空，判断当前附件是否是图片
        $parseStr .= '<?php if( $isimage == 1 ){ ?>';
        // 如果是图片
        $parseStr .= '<?php $suffix_temp ="png,jpg,gif,jpeg,bmp"; ?>';
        $parseStr .= '<?php }else{ ?>';
        // 如果不是图片
        $parseStr .= '<?php $suffix_temp ="zip,rar,xls,xlsx,txt,doc,docx,png,jpg,jpeg,pdf,bmp"; ?>';
        $parseStr .= '<?php } ?>';

        $parseStr .= '<?php } ?>';
        // 组合后缀
        $parseStr .= '<?php $suffix = D("File/File") -> combineSuffix($suffix_temp); ?>';

        // 设置附件的大小 =====================================>
        if ($maxsize) {
            // 如果当前附件的类型是img并且当前的后缀为空
            $parseStr .= '<?php $maxsize =$' . $maxsize . '; ?>';
        }
        $parseStr .= '<?php if( !$maxsize ){ ?>';
        $parseStr .= '<?php $maxsize =  30;  ?>';
        $parseStr .= '<?php } ?>';

        if( $attachmenttype ){
        	// 如果当前附件的类型是img并且当前的后缀为空
        	$parseStr .= '<?php $attachmenttype =$' . $attachmenttype . ';?>';
        }
        // 判断是否可以进行编辑 =====================================>
        if ($cannotedit) {
            $parseStr .= '<?php $cannotedit = $' . $cannotedit . '; ?>';
        }

        // 是否有appid，默认获取当前子系统的SYS_NAME =====================================>
        if ($appid) {
            $parseStr .= '<?php $appid = $' . $appid . '; ?>';
        }
        $parseStr .= '<?php if( !$appid ){ ?>';
        $parseStr .= '<?php $appid =  "'.SYS_NAME.'";  ?>';
        $parseStr .= '<?php } ?>';

        // 是否有$groupname，默认获取当前的分组 =====================================>
        if ($groupname) {
            $parseStr .= '<?php $groupname = $' . $groupname . '; ?>';
        }
        $parseStr .= '<?php if( !$groupname ){ ?>';
        $parseStr .= '<?php $groupname =  "'.GROUP_NAME.'";  ?>';
        $parseStr .= '<?php } ?>';

        // 是否有$tagname，默认获取当前的MODULE_NAME.'_'. ACTION_NAME =====================================>
        if ($tagname) {
            $parseStr .= '<?php $tagname = $' . $tagname . '; ?>';
        }
        $parseStr .= '<?php if( !$tagname ){ ?>';
        // 为指定标签的时候，将标签设置为当前的MODULE_NAME
        /*$parseStr .= '<?php $tagname =  "' . MODULE_NAME.'_'. ACTION_NAME . '";  ?>';*/
        $parseStr .= '<?php $tagname =  "' . MODULE_NAME. '";  ?>';
        $parseStr .= '<?php } ?>';

        // 使用该附件的数据库真实表名 =====================================>
        if ($truetablename) {
            $parseStr .= '<?php $truetablename = $' . $truetablename . '; ?>';
        }
        $parseStr .= '<?php if( $truetablename ){ ?>';
        // 将真实表名字符串进行拆分
        $parseStr .= '<?php $truetablenames =  explode("," , $truetablename); ?>';
        $parseStr .= '<?php } ?>';

        // 使用该附件的数据库表对应的主键值字段名=====================================>
        if ($primarykey) {
            $parseStr .= '<?php $primarykey = $' . $primarykey . '; ?>';
        }
        $parseStr .= '<?php if( $primarykey ){ ?>';
        // 将真实表名字符串进行拆分
        $parseStr .= '<?php $primarykeys =  explode("," , $primarykey); ?>';
        $parseStr .= '<?php } ?>';

        // 使用该附件的数据库表对应的主键值 =====================================>
        if ($primarykeyvalue) {
            $parseStr .= '<?php $primarykeyvalue = $' . $primarykeyvalue . '; ?>';
        }
        $parseStr .= '<?php if( $primarykeyvalue ){ ?>';
        // 将真实表名字符串进行拆分
        $parseStr .= '<?php $primarykeyvalues =  explode("," , $primarykeyvalues); ?>';
        $parseStr .= '<?php } ?>';

		// 生成HTML界面和JavaScript代码 =====================================>
		$parseStr .= '<div class="ui-uploader-form <?php  echo($style); ?>" style="padding: 2px;border:none;border-left: none;border-right: none;border-bottom:none">';

            // 判断当前的附件渲染方式是否为simple begin ============>
            $parseStr .= '<?php if( $skin =="simple" ){ ?>';
                // 如果是简单模式 ===========================>
                // 创建上传的ul
                $parseStr .= '<ul class="ui-uploader-form-ul ui-attachment-list">';
                // 循环查询到文件列表
                $parseStr .= '<?php foreach( $attainfos as $key_dupload => $vo_dupload ){ ?>';
                //获取当前上传域对应的ordernum
                $parseStr .= '<?php $ordernum	=  $vo_dupload["odernum"]; ?>';
                    // 循环生成tr =====================================>
                    $parseStr .= '<li class="ui-uploader-form-li <?php if( $isimage == "1"){ ?>isimg<?php } ?>">';

                        // 生成文件名显示td =====================================>
                        $parseStr .= '<?php if( $attachmentname ){ ?>';
                        $parseStr .=  '<span class="ui-uploader-form-filename">';
                        $parseStr .= '<?php if($key_dupload ==0 ) { ?>';
                        $parseStr .= '<?php echo($attachmentname); ?>';
                            // 如果当前附件是必传的
                            $parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                            $parseStr .= '<span class="ui-form-required">*</span>';
                            $parseStr .= '<?php } ?>';
                            $parseStr .= ':';
                        $parseStr .= '<?php } ?>';
                        $parseStr .= '</span>';
                        $parseStr .= '<?php } ?>';

                    // 创建上传文件名列 =====================================>
                    $parseStr .= '<?php if( $attachmentname ){ ?>';
                        $parseStr .= '<span class="ui-uploader-form-filefield-short">';
                    $parseStr .= '<?php }else{ ?>';
                        $parseStr .= '<span class="ui-uploader-form-filefield-long">';
                    $parseStr .= '<?php } ?>';

                    // 判断是否已经上传了文件 begin ============>
                    $parseStr .= '<?php if( $vo_dupload["id"] ){ ?>';

                        // 判断是否为图片类型附件 begin ============>
                        $parseStr .= '<?php if( $isimage == "1"){ ?>';
                            //如果是上传图片，上传样式重新优化
                            $parseStr .= '<div class="ui-uploader-form-img" style="display:none">';
                            
                            	$parseStr .= '<input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="'.$guid.'" '; // 文件域
                           	 	$parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                           		//$parseStr .= 'lay-verify="required"';
                           		$parseStr .= '<?php } ?>';
                           		$parseStr .= '/>';
                            
                                
                            $parseStr .= '</div>';
                            $parseStr .= '<div class="ui-uploader-form-show-img">'; // 图片类附件显示区域
                                $parseStr .= '<img class="ui-img" src="' . $downloadurl . '/id/<?php  echo($vo_dupload["id"]) ?>">'; // 图片类附件显示区域

                                // 判断是否可以对附件进行编辑 begin ============>
        $parseStr .= '<?php  if( $cannotedit != "1" && $model_name !== "Manage" && $data["bp_check"] !== "1" || $model_name == "Manage" && $LoginUserInfo["role_info"]["id"] == "2" && $data["bp_check"] !== "1") { ?>';
                                    // 如果可以进行编辑，就显示删除的按钮
                                    $parseStr .= '<span  id="btn_del_'.$guid.'" class="ui-icon-delete" onclick=delFileNew("'.$guid.'",<?php echo($vo_dupload["id"]) ?>,"' . $delurl . '","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span>'; // 删除当前附件按钮
                                $parseStr .= '<?php } ?>';
                                // 判断是否可以对附件进行编辑 begin ============>

                           /* $parseStr .= '</div>';*/

                        $parseStr .= '<?php }else{ ?>';

                            // 其他附件类型
                            $parseStr .= '<div class="ui-uploader-form-other" style="display:none">';
                            
                            $parseStr .= '<input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="'.$guid.'" '; // 文件域
                            $parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                            //$parseStr .= 'lay-verify="required"';
                            $parseStr .= '<?php } ?>';
                            $parseStr .= '/>';
                            
                            $parseStr .= '</div>';
                            $parseStr .= '<div  id="child_div_'.$guid.'" >'; // 上传成功后显示区域
                            // 判断是否可以进行编辑，如果可以进行编辑，就显示删除的按钮
                            $parseStr .= '<?php  if( $cannotedit != "1") { ?>';
                                $parseStr .= '<input  id="btn_del_'.$guid.'" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("'.$guid.'",<?php echo($vo_dupload["id"]) ?>,"' . $delurl . '","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  />'; // 删除当前附件按钮
                            $parseStr .= '<?php } ?>';
                            $parseStr .= '<a class="ui-uploader-form-a" id="a_'.$guid.'" target="_blank" href="' . $downloadurl . '/id/<?php  echo($vo_dupload["id"]) ?>" >';
                            $parseStr 	.= '<?php  echo($vo_dupload["originalfilename"]) ?>';
                            $parseStr 	.= '</a>';//其他附件类型下载区域
                        $parseStr .= '<?php } ?>';
                        // 判断是否为图片类型附件 end ============>
                    $parseStr .= '<?php }else{ ?>';

                        // 如果未获取到附件信息 =====================================>
                        $parseStr .= '<div id="div_'.$guid.'" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none">';

                        // 判断是否可以对附件进行编辑 begin ============>
                        $parseStr .= '<?php if( $cannotedit ==1){ ?>';
                            // 如果当前不可以进行编辑
                            $parseStr .= '<span class="nofile">还未上传相关附件</span>';
                            
                            $parseStr .= '<input name="uploadField[]" type="file" class="ui-input hide"  id="'.$guid.'"  disabled '; // 文件域
                            $parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                            //$parseStr .= 'lay-verify="required"';
                            $parseStr .= '<?php } ?>';
                            $parseStr .= '/>';
                            
                        $parseStr .= '<?php }else{ ?>';
                            // 如果当前可以进行编辑
                            // 判断是否为图片类型附件 begin ============>
                            $parseStr .= '<?php if( $isimage == "1"){ ?>';
                                // 如果是上传图片，上传样式重新优化
                                $parseStr .= '<div class="ui-uploader-form-img">';
                                
                                    $parseStr .= '<input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="'.$guid.'" '; // 文件域
                                    $parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                                   // $parseStr .= 'lay-verify="required"';
                                    $parseStr .= '<?php } ?>';
                                    $parseStr .= '/>';
                                                                      
                                    
                                $parseStr .= '</div>';
                                $parseStr .= '<div class="ui-uploader-form-show-img" style="display: none" >'; // 图片类附件显示区域
                                    $parseStr .= '<img class="ui-img" />'; // 图片类附件显示区域
                                    $parseStr .= '<span  id="btn_del_'.$guid.'" class="ui-icon-delete"></span>'; // 删除当前附件按钮
                                /*$parseStr .= '</div>';*/
                            $parseStr .= '<?php }else{ ?>';
                                // 其他附件类型
                                $parseStr .= '<div class="ui-uploader-form-other">';
                                
                                $parseStr .= '<input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="'.$guid.'" '; // 文件域
                                $parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                               // $parseStr .= 'lay-verify="required"';
                                $parseStr .= '<?php } ?>';
                                $parseStr .= '/>';
                                                            
                                $parseStr .= '</div>';
                                $parseStr .= '<div style="display: none" id="child_div_'.$guid.'" >'; // 上传成功后显示区域
                                $parseStr .= '<input  id="btn_del_'.$guid.'" class="ui-uploader-form-button " type="button" value="删除"/>'; // 删除当前附件按钮
                                $parseStr .= '<a class="ui-uploader-form-a" target="_blank"></a>';
                            $parseStr .= '<?php } ?>';
                            // 判断是否为图片类型附件 end ============>
                        $parseStr .= '<?php } ?>';
                        // 判断是否可以对附件进行编辑 end ============>
                    $parseStr .= '<?php } ?>';
                    // 判断是否已经上传了文件 end ============>

                    // 设置隐藏域 =====================================>
                    $parseStr .= '<input type="hidden" name="fileurl[]" id="fileurl_'.$guid.'" value="<?php echo($vo_dupload["fileurl"]) ?>"/>'; // 文件完整路径
                    $parseStr .= '<input type="hidden" name="filepath[]" id="filepath_'.$guid.'" value="<?php echo($vo_dupload["filepath"]) ?>"/>'; // 文件相对路径
                    $parseStr .= '<input type="hidden" name="savepath[]" id="savepath_'.$guid.'" value="<?php echo($vo_dupload["savepath"]) ?>"/>'; // 文件的完整磁盘路径
                    $parseStr .= '<input type="hidden" name="orifilename[]" id="orifilename_'.$guid.'" value="<?php echo($vo_dupload["originalfilename"]) ?>"/>'; // 文件原始文件名
                    $parseStr .= '<input type="hidden" name="formatfilename[]" id="formatfilename_'.$guid.'" value="<?php echo($vo_dupload["formatfilename"]) ?>" />'; // 文件存储文件名

                    //必填验证
                    $parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                    $parseStr .= '<input type="hidden" name="fileid[]" id="fileid_'.$guid.'" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="'.$required_msg.'"/>'; // 文件存储数据库id
                    $parseStr .= '<?php }else{ ?>';
                    $parseStr .= '<input type="hidden" name="fileid[]" id="fileid_'.$guid.'" value="<?php echo($vo_dupload["id"]) ?>" />'; // 文件存储数据库id
                    $parseStr .= '<?php } ?>';


                    $parseStr .= '<input type="hidden" name="filegroupid[]" id="filegroupid_'.$guid.'" value="<?php echo($vo_dupload["groupid"]) ?>" />'; // 文件存储组数据库id
                    $parseStr .= '</div>';
                        // 上传成功标识
                        $parseStr .= '<input type="hidden" name="uploadflag[]" id="uploadflag_'.$guid.'" value="0" />';
                        // 文件删除标识
                        $parseStr .= '<input type="hidden" name="isdeleted[]" id="delflag_'.$guid.'"  value="0">'; // 文件是否删除
                        // 是否是必填隐藏域
                        $parseStr .= '<input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_'.$guid.'" />'; // 当前附件是否为必传
                        // 需要上传附件的名称隐藏域
                        $parseStr .= '<input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" >';
                        // 需要上传附件的类型隐藏域
                        $parseStr .= '<input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" />';
                        $parseStr .= '<input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" />';
                        // 需要上传附件的的guid =====================================>
                        $parseStr .= '<input type="hidden" name="guid[]" value="'.$guid.'" />';
                        $parseStr .= '<div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div>';
                   /* $parseStr .= '</div>';*/

                    $parseStr .= '</span>';

                        // add By Richer 于20170213 增加判断是否可以上传多个文件 =====================================>
                        //如果是上传图片，上传样式重新优化
                        $parseStr .= '<span style="display: inline-block;inline-block;float: left;width:5%;">';
                            $parseStr .= '<?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?>';

                            // 判断是否可以进行编辑，如果可以进行编辑，就显示删除的按钮
                            $parseStr .= '<div class="ui-uploader-form-add" id="div_add_'.$guid.'" ></div>';
                            $parseStr .= '<input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>">';
                            $parseStr .= '<?php }else{ ?>';

                            $parseStr .= '<div class="ui-uploader-form-add" id="div_add_'.$guid.'" style="visibility: hidden"></div>';
                            $parseStr .= '<input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>">';
                            $parseStr .= '<?php }?>';
                        $parseStr .= '</span>';

                        $parseStr .= '<script type="text/javascript">';
                        $parseStr .= '$(function($) {';
                        // 上传域绑定事件 为了不和老的插件冲突，改变方法名 =====================================>
                        $parseStr .= 'bindUploaderNew( "'. $guid .'", "' . $uploadurl . '" ,"' . $downloadurl . '", "' . $delurl . '" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>", "<?php echo($skin) ?>" );';
                        // 一个附件可以上传多个文件按钮绑定事件
                        $parseStr .= '})';

                        $parseStr .= '</script>';
                    $parseStr .= '</li>';

                $parseStr .= '<?php  } ?>';
                $parseStr .= '</ul>';

            $parseStr .= '<?php  }else{ ?>';
                // 如果是复杂模式 ===========================>
                // 创建上传的表格
                $parseStr .= '<table class="ui-table ui-table-noborder ui-attachment-list" style="padding: 5px;border:none;border-left: none;border-right: none;border-bottom:none">';

                // 循环查询到文件列表
                $parseStr .= '<?php foreach( $attainfos as $key_dupload => $vo_dupload ){ ?>';
                    //获取当前上传域对应的ordernum
                    $parseStr .= '<?php $ordernum	=  $vo_dupload["odernum"]; ?>';
                    // 循环生成tr =====================================>
                    $parseStr .= '<tr valign="top">';


                    // 生成文件名显示td =====================================>
                    $parseStr .= '<?php if( $attachmentname ){ ?>';
                    $parseStr 	.=  '<td width="30%;" valign="middle" align="left">';
                    $parseStr 	.= '<?php if($key_dupload ==0 ) { ?>';
                        $parseStr 	.= '<?php echo($attachmentname); ?>';
                        // 如果当前附件是必传的
                        $parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                        $parseStr .= '<span class="ui-form-required">*</span>';
                        $parseStr .= '<?php } ?>';
                    $parseStr .= ':';
                    $parseStr 	.= '<?php } ?>';
                    $parseStr .= '</td>';
                    $parseStr 	.= '<?php } ?>';


                    // 创建上传文件名列 =====================================>
                    $parseStr .= '<td valign="middle" align="left" width="30%;" style="padding:5px 0;border:none;border-left: none;border-right: none;border-bottom:none">';

                    //判断是否有附件 =====================================>
                    $parseStr .= '<?php if( $vo_dupload["id"] ){ ?>';
                        // 判断是否为图片类型的附件
                        $parseStr .= '<?php if( $isimage == "1"){ ?>';
                            //如果是上传图片，上传样式重新优化
                            $parseStr .= '<div class="ui-uploader-form-img" style="display:none">';
                               
                                $parseStr .= '<input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="'.$guid.'" '; // 文件域
                                $parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                               // $parseStr .= 'lay-verify="required"';
                                $parseStr .= '<?php } ?>';
                                $parseStr .= '/>';
                                
                            $parseStr .= '</div>';
                            $parseStr .= '<div class="ui-uploader-form-show-img">'; // 图片类附件显示区域
                                $parseStr .= '<img class="ui-img" src="' . $downloadurl . '/id/<?php  echo($vo_dupload["id"]) ?>">'; // 图片类附件显示区域
                                // 判断是否可以进行编辑，如果可以进行编辑，就显示删除的按钮
                                $parseStr .= '<?php  if( $cannotedit != "1") { ?>';
                                $parseStr .= '<span  id="btn_del_'.$guid.'" class="ui-icon-delete" onclick=delFileNew("'.$guid.'",<?php echo($vo_dupload["id"]) ?>,"' . $delurl . '","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")></span>'; // 删除当前附件按钮
                                $parseStr .= '<?php } ?>';
                            /*$parseStr .= '</div>';*/
                        $parseStr .= '<?php }else{ ?>';
                            // 其他附件类型
                            $parseStr .= '<div class="ui-uploader-form-other" style="display:none">';
                            
                            $parseStr .= '<input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field" id="'.$guid.'" '; // 文件域
                            $parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                            //$parseStr .= 'lay-verify="required"';
                            $parseStr .= '<?php } ?>';
                            $parseStr .= '/>';
                            
                            
                            $parseStr .= '</div>';
                            $parseStr .= '<div  id="child_div_'.$guid.'" >'; // 上传成功后显示区域
                            // 判断是否可以进行编辑，如果可以进行编辑，就显示删除的按钮
                            $parseStr .= '<?php  if( $cannotedit != "1") { ?>';
                            $parseStr .= '<input  id="btn_del_'.$guid.'" class="ui-uploader-form-button" type="button" value="删除" onclick=delFileNew("'.$guid.'",<?php echo($vo_dupload["id"]) ?>,"' . $delurl . '","<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>","<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>")  />'; // 删除当前附件按钮
                            $parseStr .= '<?php } ?>';
                            $parseStr .= '<a class="ui-uploader-form-a" id="a_'.$guid.'" target="_blank" href="' . $downloadurl . '/id/<?php  echo($vo_dupload["id"]) ?>" >';
                            $parseStr 	.= '<?php  echo($vo_dupload["originalfilename"]) ?>';
                            $parseStr 	.= '</a>';//其他附件类型下载区域
                        $parseStr .= '<?php } ?>';
                    $parseStr .= '<?php }else{ ?>';
                        // 如果未获取到附件信息 =====================================>
                        $parseStr .= '<div id="div_'.$guid.'" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none">';
                        // 判断是否可以进行编辑
                        $parseStr .= '<?php if( $cannotedit ==1){ ?>';
                            // 如果当前不可以进行编辑
                            $parseStr .= '<span class="nofile">还未上传相关附件</span>';
                            
                            $parseStr .= '<input name="uploadField[]" type="file" class="ui-input hide" id="'.$guid.'" disabled '; // 文件域
                            $parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                            //$parseStr .= 'lay-verify="required"';
                            $parseStr .= '<?php } ?>';
                            $parseStr .= '/>';
                            
                        $parseStr .= '<?php }else{ ?>';
                            // 如果当前可以进行编辑
                            $parseStr .= '<?php if( $isimage == "1"){ ?>';
                                //如果是上传图片，上传样式重新优化
                                $parseStr .= '<div class="ui-uploader-form-img">';
                                
                                $parseStr .= '<input name="uploadField[]" type="file" class="ui-uploader-form-field" accept="image/*" id="'.$guid.'" '; // 文件域
                                $parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                               // $parseStr .= 'lay-verify="required"';
                                $parseStr .= '<?php } ?>';
                                $parseStr .= '/>';
                                                                                            
                                $parseStr .= '</div>';
                                $parseStr .= '<div class="ui-uploader-form-show-img" style="display: none" >'; // 图片类附件显示区域
                                    $parseStr .= '<img class="ui-img">'; // 图片类附件显示区域
                                    $parseStr .= '<span  id="btn_del_'.$guid.'" class="ui-icon-delete"></span>'; // 删除当前附件按钮
                               /* $parseStr .= '</div>';*/
                            $parseStr .= '<?php }else{ ?>';
                                // 其他附件类型
                                $parseStr .= '<div class="ui-uploader-form-other">';
                               
                                $parseStr .= '<input name="uploadField[]" type="file" class="ui-input ui-uploader-form-field"  id="'.$guid.'" '; // 文件域
                                $parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                               // $parseStr .= 'lay-verify="required"';
                                $parseStr .= '<?php } ?>';
                                $parseStr .= '/>';
                                
                                $parseStr .= '</div>';
                                $parseStr .= '<div style="display: none" id="child_div_'.$guid.'" >'; // 上传成功后显示区域
                                $parseStr .= '<input  id="btn_del_'.$guid.'" class="ui-uploader-form-button " type="button" value="删除"/>'; // 删除当前附件按钮
                                $parseStr .= '<a class="ui-uploader-form-a" target="_blank"></a>';
                            $parseStr .= '<?php } ?>';
                        $parseStr .= '<?php } ?>';
                    $parseStr .= '<?php } ?>';

                    // 设置隐藏域 =====================================>
                    $parseStr .= '<input type="hidden" name="fileurl[]" id="fileurl_'.$guid.'" value="<?php echo($vo_dupload["fileurl"]) ?>"/>'; // 文件完整路径
                    $parseStr .= '<input type="hidden" name="filepath[]" id="filepath_'.$guid.'" value="<?php echo($vo_dupload["filepath"]) ?>"/>'; // 文件相对路径
                    $parseStr .= '<input type="hidden" name="savepath[]" id="savepath_'.$guid.'" value="<?php echo($vo_dupload["savepath"]) ?>"/>'; // 文件的完整磁盘路径
                    $parseStr .= '<input type="hidden" name="orifilename[]" id="orifilename_'.$guid.'" value="<?php echo($vo_dupload["originalfilename"]) ?>"/>'; // 文件原始文件名
                    $parseStr .= '<input type="hidden" name="formatfilename[]" id="formatfilename_'.$guid.'" value="<?php echo($vo_dupload["formatfilename"]) ?>" />'; // 文件存储文件名

                    //必填验证
                    $parseStr .= '<?php if( $isRequire == 1 ) { ?>';
                    $parseStr .= '<input type="hidden" name="fileid[]" id="fileid_'.$guid.'" value="<?php echo($vo_dupload["id"]) ?>" class="mustvalidate" required="true"  required-msg="'.$required_msg.'"/>'; // 文件存储数据库id
                    $parseStr .= '<?php }else{ ?>';
                    $parseStr .= '<input type="hidden" name="fileid[]" id="fileid_'.$guid.'" value="<?php echo($vo_dupload["id"]) ?>" />'; // 文件存储数据库id
                    $parseStr .= '<?php } ?>';


                    $parseStr .= '<input type="hidden" name="filegroupid[]" id="filegroupid_'.$guid.'" value="<?php echo($vo_dupload["groupid"]) ?>" />'; // 文件存储组数据库id
                    $parseStr .= '</div>';
                    // 上传成功标识
                    $parseStr .= '<input type="hidden" name="uploadflag[]" id="uploadflag_'.$guid.'" value="0" />';
                    // 文件删除标识
                    $parseStr .= '<input type="hidden" name="isdeleted[]" id="delflag_'.$guid.'"  value="0">'; // 文件是否删除
                    // 是否是必填隐藏域
                    $parseStr .= '<input type="hidden" name="isRequire[]" value="<?php echo($isRequire) ?>"  id="isRequire_'.$guid.'" />'; // 当前附件是否为必传
                    // 需要上传附件的名称隐藏域
                    $parseStr .= '<input type="hidden" name="attachmentname[]" value="<?php  echo($attachmentname) ?>" >';
                    // 需要上传附件的类型隐藏域
                    $parseStr .= '<input type="hidden" name="attachmenttype[]" value="<?php  echo($attachmenttype) ?>" />';
                    $parseStr .= '<input type="hidden" name="sheettype[]" value="<?php  echo($sheettype) ?>" />';
                    // 需要上传附件的的guid =====================================>
                    $parseStr .= '<input type="hidden" name="guid[]" value="'.$guid.'" />';
                    $parseStr .= '<div class="clear" style="padding: 0;border:none;border-left: none;border-right: none;border-bottom:none"></div></div></td>';

                    // add By Richer 于20170213 增加判断是否可以上传多个文件 =====================================>
                    $parseStr .= '<td valign="middle" align="left" width="5%">';
                    //如果是上传图片，上传样式重新优化
                    $parseStr .= '<?php if( $ismultiple == 1 && $key_dupload ==0 && $cannotedit != "1"){ ?>';
                    // 判断是否可以进行编辑，如果可以进行编辑，就显示删除的按钮
                    $parseStr .= '<div class="ui-uploader-form-add" id="div_add_'.$guid.'" ></div>';
                    $parseStr .= '<input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>">';
                    /*$parseStr .= '<script type="text/javascript">';
                    $parseStr .= '$(".ui-uploader-form-add").bind("click",function(){';
                    // 一个附件可以上传多个文件按钮绑定事件 =====================================>
                    $parseStr .= 'addUploaderFiled( "'. $guid .'", "' . $uploadurl . '" ,"' . $downloadurl . '", "' . $delurl . '" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>" , "<?php echo($ismultiple) ?>", "<?php echo($ordernum_max) ?>");';
                    $parseStr .= '})';
                    $parseStr .= '</script>';*/
                    $parseStr .= '<?php }else{ ?>';
                        //设置一个默认宽度，使得td撑开
                        /*$parseStr .= '<div style="width:90px;"></div>';*/
                        $parseStr .= '<div class="ui-uploader-form-add" id="div_add_'.$guid.'" style="visibility: hidden"></div>';
                        $parseStr .= '<input type="hidden" name="odernum[]"  value="<?php  echo($ordernum) ?>">';
                        $parseStr .= '<?php }?>';
                    $parseStr .= '</td>';

                    // 是否有附件的说明 =====================================>
                    // 判断是否可以进行编辑 =====================================>
                    if ($attachmentdesc) {
                        $parseStr .= '<?php $attachmentdesc = $' . $attachmentdesc . '; ?>';
                    }

                    $parseStr .= '<td valign="middle" align="left" width="30%">';
                    $parseStr .= '<?php if( $attachmentdesc ){ ?>';
                    $parseStr .= '<?php if($key_dupload ==0 ) { echo($attachmentdesc); } ?>';
                    $parseStr .= '<?php }?>';
                    $parseStr .= '</td>';

                    $parseStr .= '</tr>';
                    $parseStr .= '<script type="text/javascript">';
                        $parseStr .= '$(function($) {';
                            // 上传域绑定事件 为了不和老的插件冲突，改变方法名 =====================================>
                            $parseStr .= 'bindUploaderNew( "'. $guid .'", "' . $uploadurl . '" ,"' . $downloadurl . '", "' . $delurl . '" , "<?php  echo($maxsize); ?>" , "<?php  echo($suffix); ?>" ,"<?php  echo($isimage); ?>"  ,"<?php  echo($attachmentname) ?>" , "<?php  echo($attachmenttype) ?>" ,"<?php echo($callbackfunc) ?>","<?php echo($beforeopefunc) ?>","<?php echo($attachmenttype) ?>" ,"<?php echo($sheettype) ?>","<?php echo($islogicdel) ?>","<?php echo($appid) ?>","<?php echo($groupname) ?>","<?php echo($tagname) ?>", "<?php echo($truetablename) ?>", "<?php echo($primarykey) ?>", "<?php echo($primarykeyvalue) ?>", "<?php echo($ismultiple) ?>", "<?php echo($ordernum) ?>" );';
                            // 一个附件可以上传多个文件按钮绑定事件
                        $parseStr .= '})';
                    $parseStr .= '</script>';
                    $parseStr .= '</div>';

                $parseStr .= '<?php  } ?>';
                $parseStr .= '</table>';
            $parseStr .= '<?php  } ?>';
            // 判断当前的附件渲染方式是否为simple end ============>
		$parseStr .= '</div>';
		
		//结束时 初始化(释放)参数，使多个插件间参数不冲突
		foreach($tag as $k=>$v){
			$parseStr .='<?php unset($' . ($k=='required-msg'?'required_msg':$k) . '); ?>';
		}
		
		return $parseStr;
	}
}