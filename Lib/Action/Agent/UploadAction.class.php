<?php

/**
 * 附件上传操作控制层基类类
 *
 * @copyright   Copyright 2010-2011 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action
 * @version     20150618
 * @type		project
 * @link        http://www.mitong.com
 */
class UploadAction extends BaseAction {
	

	
	// 公共函数，不接受权限检查
	public $public_functions = array ('*');
	/**
	 * 初始化函数
	 *
	 * @access public
	 */
	public function _initialize() {
		
		// 继承
		parent::_initialize ();
		
	}
	
	
	/**
	 * 上传附件
	 *
	 * add By Richer 于20170120 修改上传附件的方法，将所有上传的附件全部上传到指定的服务器上
	 * 通用上传附件功能
	 * 1、从附件组对象中获取当前可用的组，如果未获取到，提示用户
	 * 2、设置附件上传的相关信息
	 * 3、上传
	 * 4、上传成功后将数据存储到数据库中，并返回当前主键
	 */
	public function doUpload() {
		

		// 获取文件的相关参数 =========================>
		
		// 获取文件最大限制
		$maxSize = ! empty ( $_POST ['maxsize'] ) ? intval ( $_POST ['maxsize'] ) * 1024 * 1024 : 30 * 1024 * 1024;
		// 获取需要上传文件的名称
		$filename = ! empty ( $_POST ['filename'] ) ? $_POST ['filename'] : '';
		// 获取需要上传文件的类型
		$filetype = ! empty ( $_POST ['filetype'] ) ? $_POST ['filetype'] : '';
		// 获取需要上传文件的后缀
		$suffix = ! empty ( $_POST ['suffix'] ) ? $_POST ['suffix'] : '.xls|.xlsx|.txt|.doc|.docx|.png|.jpg|.jpeg|.bmp|.gif|.pdf'; // 默认的文件后缀类型
		  
		// 获取参数 ==============================>
		// 获取groupname
		$groupname 			= !empty( $_POST ['groupname'] )  ? $_POST ['groupname'] :'Service';
		// 获取tagname
		$tagname 			= $_POST ['tagname'];
		// add By Richer 于20170213增加参数odernum，当前上传
		$odernum 			= $_POST['odernum'];
		// 获取使用该附件的真实表名
		$truetablename  	= $_POST['truetablename'];
		// 分割
		$truetablenames 	= explode(',', $truetablename );
		//Log::write ( '==================== truetablename = ' . json_encode ( $truetablename ) );
		Log::write ( '==================== truetablenames = ' . json_encode ( $truetablenames ) );
		// 获取使用该附件的真实表对应的主键字段名
		$primarykey 		= $_POST['primarykey'];
		// 分割
		$primarykeys 		= explode(',', $primarykey );
		//Log::write ( '==================== primarykey = ' . json_encode ( $primarykeyvalue ) );
		Log::write ( '==================== primarykeys = ' . json_encode ( $primarykeyvalues ) );
		// 获取使用该附件的真实表对应的主键值
		$primarykeyvalue 	= $_POST['primarykeyvalue'];
		// 分割
		$primarykeyvalues 	= explode(',', $primarykeyvalue );
		//Log::write ( '==================== primarykeyvalue = ' . json_encode ( $primarykeyvalue ) );
		Log::write ( '==================== primarykeyvalues = ' . json_encode ( $primarykeyvalues ) );
		
		/* // 判断是否填写了tagname
		if (!$tagname) {
			$return ['status'] = 0;
			$return ['info'] = "参数tagname不能为空";
			exit ( json_encode ( $return ) );
		} */
		
// 		// 判断是否填写了attachmenttype
// 		if (!$filetype) {
// 			$return ['status'] = 0;
// 			$return ['info'] = "参数attachmenttype不能为空";
// 			exit ( json_encode ( $return ) );
// 		}
		
// 		// 判断是否填写了truetablename
// 		if (!$truetablename) {
// 			$return ['status'] = 0;
// 			$return ['info'] = "参数truetablename不能为空";
// 			exit ( json_encode ( $return ) );
// 		}
		
		
		// 文件存储子目录
		// $subdir = 'Upload/'.$groupname.'/Attachment/' . $appid . '/' . $tagname . '/' . date ( 'Ymd' ) . '/';
		
		$subdir 	= 'Upload/Attachment/' . $tagname . '/' . date ( 'Ymd' ) . '/';
		$root_url 	= "./".$subdir;
		
		// 组合完整的上传路径
		$dir = $root_path . $subdir;
		Log::write ( '==================== $dir = ' . json_encode ( $dir ) );
		
		$return ['path'] = $path;
		$return ['dir'] = $dir;
		// 定义文件模型
		$modelFile = D ( "File/File" );
		
		// 导入上传类
		import ( 'ORG.Net.UploadFile' );
		// 实例化上传类
		$upload = new UploadFile ();
		
		// 截取并进行转换成UploadFile可用识别的数组
		$suffixArray = explode ( '|', $suffix );
		foreach ( $suffixArray as $vo ) {
			$allowExts [] = str_replace ( '.', '', $vo );
		}
		$upload->allowExts = $allowExts; // 设置附件上传类型
		                                 // 设置附件上传大小
		$upload->maxSize = $maxSize;
		// 设置文件的命名规则
		$upload->saveRule = uniqid;
		
		//设置需要生成缩略图，仅对图像文件有效
		$upload->thumb              = true;
		// 设置引用图片类库包路径
		//$upload->imageClassPath     = '@.ORG.Image';
		//设置需要生成缩略图的文件后缀
		$upload->thumbPrefix        = 'm_,s_';  //生产2张缩略图
		//设置缩略图最大宽度
		$upload->thumbMaxWidth      = '300,100';
		//设置缩略图最大高度
		$upload->thumbMaxHeight     = '300,100';
		
		// 判断文件夹是否存在不存在进创建文件夹
		if (! file_exists ( $dir )) {
			mkdir ( $dir, 0777, true );
		}
		
		// 设置附件上传目录
		$upload->savePath = $dir;
		
		// 上传
		if (! $upload->upload ()) {
			
			// 上传错误提示错误信息
			$return ['stauts'] = 0;
			$return ['info'] = $upload->getErrorMsg ();
			Log::write ( '=====================> ' . $upload->getErrorMsg () );
			exit ( json_encode ( $return ) );
		} else {
			
			// 上传成功 获取上传文件信息
			$info = $upload->getUploadFileInfo ();
			
			// 设附件额的相关参数
			$filepath = $subdir . $info [0] ['savename'];
			
			// 文件组id
			$info [0] ['filegroupid'] = $fileGroup ['id'];
			// 设置返回参数
			
			$info [0] ['filepath'] = $filepath;
			
			// 获取当前文件的下载路径
			$fileurl = $root_url . $filepath;
			$info [0] ['fileurl'] = $fileurl;
			
			// 将文件进行保存
			$file = $info [0];
			
			// 设置当前附件上传域的名称
			$file ['attachname'] = $filename;
			// 设置当前附件上传域的类型
			$file ['attachtype'] = $filetype;
			// 设置当前系统的id
			$file ['appid'] 	= $this->appid;
			// 设置当前操作用户的id
			$file ['userid'] 	= $this->loginUserId;
			// add By Richer 于20170213增加参数odernum，当前上传
			$file['odernum'] 	= $odernum;
			
			// 组合附件完整信息大字段
			foreach ( $primarykeyvalues as $key => $vo ){
				$filedesc['appid'] 			= $this->appid;
				$filedesc['groupname'] 		= $groupname;
				$filedesc['tagname'] 		= $tagname;
				$filedesc['truetablename'] 	= !empty($truetablenames[$key]) ? $truetablenames[$key] : $truetablenames[0];
				$filedesc['primarykey'] 	= !empty($primarykeys[$key]) ? $primarykeys[$key] : $primarykeys[0];;
				$filedesc['primarykeyvalue'] = $vo;
				$filedescs[] = $filedesc;
			}
			load('json');
			Log::write ( '==================== $dir = ' . my_json_encode($filedescs));
			$file ['filedesc']  = my_json_encode($filedescs);
			
			// $file ['filedesc']  = json_encode($filedescs);
			
			//TODO 还需要进行扩展，增加数据库表名和主键值 ============================>
			
			
			// 调用模型层方法将附件入库
			$result = $modelFile->addRecord ( $file );
			$return ['file'] = $file;
			// 如果文件入库失败
			if (! $result) {
				
				$return ['status'] = 0;
				$return ['info'] = '文件保存到数据库失败！';
			} else {
				
				$info [0] ['id'] = $result;
				$return ['status'] = 1;
				$return ['info'] = $info [0];
			}
			
			// 保存日志
			// $bizlog->write("上传附件.", $this->tVar);
			
			exit ( json_encode ( $return ) );
		}
	}
	
	
	/**
	 * 上传附件
	 *
	 * add By Richer 于20170120 修改上传附件的方法，将所有上传的附件全部上传到指定的服务器上
	 * 通用上传附件功能
	 * 1、从附件组对象中获取当前可用的组，如果未获取到，提示用户
	 * 2、设置附件上传的相关信息
	 * 3、上传
	 * 4、上传成功后将数据存储到数据库中，并返回当前主键
	 */
	public function doUpload1() {
	
	
	
		$subdir 	= 'Upload/Attachment/' . date ( 'Ymd' ) . '/';
		$root_url 	= "./".$subdir;
		// 组合完整的上传路径
		$dir = $root_path . $subdir;

		// 定义文件模型
		$modelFile = D ( "File/File" );
	
		// 导入上传类
		import ( 'ORG.Net.UploadFile' );
		// 实例化上传类
		$upload = new UploadFile ();
	
		$upload->allowExts = array('jpg','jpeg','png','gif'); // 设置附件上传类型
		// 设置附件上传大小
		$upload->maxSize = 10 * 1024 * 1024;
		
		// 设置文件的命名规则
		$upload->saveRule = uniqid;
	
		//设置需要生成缩略图，仅对图像文件有效
		$upload->thumb              = true;
		// 设置引用图片类库包路径
	
		// 判断文件夹是否存在不存在进创建文件夹
		if (! file_exists ( $dir )) {
			mkdir ( $dir, 0777, true );
		}
	
		// 设置附件上传目录
		$upload->savePath = $dir;
	
		// 上传
		if (! $upload->upload ()) {
				
			// 上传错误提示错误信息
			$return ['code'] = 1;
			$return ['msg'] = $upload->getErrorMsg ();
			exit ( json_encode ( $return ) );
		} else {
				
			// 上传成功 获取上传文件信息
			$info = $upload->getUploadFileInfo ();
				
			// 设附件额的相关参数
			$filepath = $subdir . $info [0] ['savename'];
			
				
			$info [0] ['filepath'] = $filepath;
				
			// 获取当前文件的下载路径
			//$fileurl = $root_url . $filepath;
			
			// 如果文件入库失败
			$return ['code'] = 0;
			$return ['data']['src'] = $filepath;
			$return ['data']['title'] = $info [0] ['name'];;
			// 保存日志
			// $bizlog->write("上传附件.", $this->tVar);
				
			exit ( json_encode ( $return ) );
		}
	}
	
	/**
	 * 删除附件
	 *
	 * 步骤
	 * 1、从数据库中删除当前附件
	 * 2、更新文件组关于当前附件的信息
	 * 3、从本地磁盘中将该文件删除
	 */
	function delUploadFile() {
	
		// 文件模型
		$modelFile = D ( "File/File" );
		
		// 获取当前域文件的id
		$id 	= $_POST ['id'];
		$type 	= $_POST ['type'];
		// 获取当前文件的信息
		$map ['id'] = $id;
		$file = $modelFile->selectOne ( $map );
		
		// 删除该文件
		$result = $modelFile->deleteRecord ( $map );
	
		
		// 判断文件删除
		if ($result) {
			
		
			// 获取当前文件的磁盘路径
			$filediskpath = $diskpath . $file ['filepath'];
			// 将该文件从文件夹中删除
			$result = unlink ( $file['file_disk_path'] );
			// 记录步骤
			
			$return ['status'] = 1;
			$return ['info'] = '文件删除成功！';
		} else {
			
			$return ['status'] = 0;
			$return ['info'] = '文件删除失败！';
		}
		
		// 保存日志
		//$bizlog->write ( "删除上传的附件.", $this->tVar );
		
		if ($type == 'return') {
			return $return;
		} else {
			exit ( json_encode ( $return ) );
		}
	}
	
	/**
	 * 下载附件
	 *
	 * 根据附件的id下载附件
	 */
	function downloadFile() {
		
		// 定义文件模型
		$modelFile = D ( "File/File" );
		
		$modelFile->downloadFile ( $_GET ['id'] );
	}

/**
 * 显示图片
 *
 * 根据附件的id从远程服务器获取图片并且显示在本地
 */
	// function getImg() {
	
	// // 定义文件模型
	// $modelFile = kernel_model ( "File/File" );
	
	// $modelFile->getImg ( $_GET ['id'] );
	// }
}