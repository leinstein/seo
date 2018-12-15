<?php

/**
 * 模型层：文件存储模型类 
 * 
 * @copyright   Copyright 2016-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Action.Home
 * @version     20170410
 * @link        http://www.qisobao.com
 */

class FileModel extends BaseModel{

	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		
		//设置真实表名
		$this -> trueTableName= 'ts_sys_file';
		
	}
	
	/**
	 * 查询单个对象信息
	 *
	 * 根据查询条件查询数据库中的单条记录，并返回结果。
	 *
	 * @param array $map 查询条件，如果是整型值，则直接作为主键值进行查询
	 * @param boolean $relation 是否采用关系模型，当采用关系模型时，会查询和当前模型有关系的数据，并放入到返回结果中。
	 * @return mixed 如果查询成功则返回对象信息，如果失败则返回false
	 */
	public function selectOne($map, $relation = false) {
		
		//调用父类方法查询全部数据
		$data =  parent:: selectOne( $map, $relation );
		if( $data['filepath'] ){
			$data['file_server_path']  	='http://'. $_SERVER['HTTP_HOST'] . __ROOT__ .'/'. $data['filepath'];;
			$data['file_disk_path']    	= APP_PATH.$data['filepath'];;
		}
		
		return  $data;
	
	
	}
	
	/**
	 * 实现图片上传
	 */
	public function _upload( $file_type ='img'){
		//导入上传类
		import('ORG.Util.UploadFile');
		
		$upload = new UploadFile();
		
		//设置上传文件大小
		$upload->maxSize            = 10 * 1024 * 1024;
		
		//设置上传文件类型
		$upload->allowExts          = explode(',', 'jpg,gif,png,jpeg');
		
		//设置附件上传目录
		$sub_dir 	= 'Upload/oem/userid_' .$this -> getLoginUserId() .'/'.date('Ymd') .'/';
		$dir 		= './'. $sub_dir;
		// 判断文件夹是否存在不存在进创建文件夹
		if (! file_exists ( $dir )) {
			mkdir ( $dir, 0777, true );
		}
		// 设置附件上传目录
		$upload->savePath 			= $dir;
		//设置需要生成缩略图，仅对图像文件有效
		$upload->thumb              = true;
		// 设置引用图片类库包路径
		//$upload->imageClassPath     = '@.ORG.Image';
		//设置需要生成缩略图的文件后缀
		$upload->thumbPrefix        = 'm_,s_';  //生产2张缩略图
		//设置缩略图最大宽度
		$upload->thumbMaxWidth      = '300,210';
		//设置缩略图最大高度
		$upload->thumbMaxHeight     = '1320,104';
		//设置上传文件规则
		$upload->saveRule           = 'uniqid';
		//删除原图
		//$upload->thumbRemoveOrigin  = true;

	
		//如果上传不成功
		if (!$upload->upload()){
			//捕获上传异常
			$this-> error = $upload->getErrorMsg();
			return false;
		}else{
			//取得成功上传的文件信息
			$uploadList = $upload->getUploadFileInfo();

			//导入图片类
			import('ORG.Util.Image');
		
			$filetypes = array_keys($_FILES);
			
			/* dump($uploadList);
			dump($filetypes);exit; */
			// 循环上传成功的数组，入库
			foreach ( $uploadList as $key => $vo ){
				/* foreach ($_FILES as $key => $vo_file ){
					if( $vo['name'] == $vo_file['name']  && $vo['size'] == $vo_file['size'] ){
						
					}
				} */
				$data['filetype']      		= $filetypes[$key];
				//给m_缩略图添加水印, Image::water('原文件路径','水印图片地址')
				Image::water( $vo['savepath'] . 'm_' . $vo['savename'], APP_PATH.'Tpl/Public/img/logo.png');
				//图片名赋值给 字段image
				//保存当前数据对象
				$data['filename']      		= $vo['savename'];
				// 设附件额的相关参数
				$data['filepath']    		= $sub_dir . $vo['savename'];;
				//上传文件的原始名称
				$data['originalfilename'] 	= $vo['name']; ;
				//上传文件的格式化名称
				$data['formatfilename'] 	= $vo['savename']; ;
				//上传文件的大小转化成kb
				$data['filesize'] 			= $vo['size']; 
				// 哪个用户的附件
				$data['userid'] 			= $this -> getLoginUserId();
				// 最近使用业务
				$data['belongbiz'] 			= 'OEM';
				// 最近使用业务
				$data['recentbiz'] 			= 'OEM';
				// 获取登录用户信息
				$me = $this -> getloginUserInfo();
				// 最近使用业务
				$data['recentapp'] 			= !empty($me['oem_config']['product_name'])?$me['oem_config']['product_name']:'优站宝';
				
				$datas[] = $data;
			}

			$datas = $this->addRecords($datas);
		
			return $datas;
		}
	}
	
	
	
	
	/**
	 * 新增文件到数据库
	 * 
	 * @param array $data
	 * @return boolean
	 */
	function addRecord( $data ){
		
		//赋值
		$file   					=  $data;
		
		//当前文件组id
		$file['groupid'] 			= $data['filegroupid'];
		//当前应用id
		$file['appid'] 				= $data['appid'];
		
		//需要上传的文件的名称
		$file['filename'] 			= $data['attachname'];
		//需要上传的文件的类型
		$file['filetype'] 			= $data['attachtype']; ;
		//上传文件的原始名称
		$file['originalfilename'] 	= $data['name']; ;
		//上传文件的格式化名称
		$file['formatfilename'] 	= $data['savename']; ;
		//上传文件的大小转化成kb
		$file['filesize'] 			= $data['size']; ;
		//$file['md5code'] 			= ;
		//上传文件的相对路径
		$file['filepath'] 			= $data['filepath'];
		//使用次数
		$file['usetimes'] 			= 1;
		//最近使用时间
		$file['recenttime'] 		= date('Y-m-d H:i:s');
		//最近使用用户
		$file['recentusers'] 		= $data['userid'];
		//最近使用业务
		//$file['recentbusiness'] 	= //;
		//最近使用app
		$file['recentapp'] 			= $data['appid'];
		// 最近使用业务
		$data['belongbiz'] 			= 'OEM';
		// 最近使用业务
		$data['recentbiz'] 			= 'OEM';
		// 最近使用业务
		$data['recentapp'] 			= !empty($me['oem_config']['product_name'])?$me['oem_config']['product_name']:'优站宝';
		//$file['groupidftp']  		= $data['groupidftp'];
		
		
		//调用父类方法插入
		$result = $this -> insert($file);
	
		return $result;
	}
	
	/**
	 * 获取文件的服务器路径
	 *
	 * 根据附件的id获取附件的访问路径
	 * 
	 * @param array $data
	 * @return string
	 */
	function getStorageServerPath( $id ){
		
		//定义文件组模型
		$modelFileGroup = kernel_model("File/FileGroup") ;
	
		//当前文件组id
		$map['id'] 			= $id;
		
		//调用父类方法插入
		$data 		= $this ->  selectOne( $map );
		$filepath 	= $data['filepath'];
		
		//获取文件组的服务器路径
		$groupStorageServerPath =  $modelFileGroup -> getStorageServerPath( $data['groupid']);
		
		return $groupStorageServerPath.$filepath;
	}
	
	/**
	 * 获取文件的磁盘路径
	 *
	 * 根据附件的id获取附件的磁盘路径
	 *
	 * @param array $data
	 * @return string
	 */
	function getStorageDiskPath( $id ){
	
		//定义文件组模型
		$modelFileGroup = kernel_model("File/FileGroup") ;
		//当前文件组id
		$map['id'] 			= $id;
	
		//调用父类方法插入
		$data 		= $this ->  selectOne( $map );
		$filepath 	= $data['filepath'];
	
		//获取文件组的服务器路径
		$groupStorageDiskPath =  $modelFileGroup -> getStorageDiskPath( $data['groupid']);
	
		return $groupStorageDiskPath.$filepath;
	}
	
	/**
	 * 组合附件上传允许的后缀
	 * 
	 * @param unknown $suffix
	 * @return string
	 */
	function combineSuffix($suffix){
		//如果有后缀需要对后缀格式进行校验以及进行转换
		$suffix_array = explode(',' , $suffix );
		foreach($suffix_array as $vo ){

			if( $uppercase ){
				$uppercase = $uppercase .'|.'. strtoupper($vo);
			}else{
				$uppercase = '.' .  strtoupper($vo);
			}

			if( $lowercase ){
				$lowercase = $lowercase .'|.'. strtolower($vo);
			}else{
				$lowercase = '.' . strtolower($vo);
			}
		}

		$suffix = $lowercase .'|' . $uppercase;
		return $suffix;
	}
	
	/**
	 * 下载附件
	 * 
	 * 根据附件的id下载附件
	 * 
	 */
	function downloadFile( $id ){
		load('@.file');
		//获取附件的信息
		$file = $this -> selectOne( array('id' => $id ));
		//文件服务器路径
		$filepath = $file['file_server_path'];

		//文件原始文件名
		$filename =$file['originalfilename'];

		
		/* dump($filepath);
		 exit; */
		$exts = pathinfo($filepath,PATHINFO_EXTENSION);
		//if($exts=='zip'){
			//smartReadFile($filepath, $filename, 'application/x-rar-compressed',false);
		//}else{
		smart_read_file($filepath, $filename);
		//}
	}
	
	
	/**
	 * 上传成功后组合数组
	 *
	 * 附件上传成功后，调用该方法会生成上传成功文件的数组
	 *
	 * @param array $postData 客户端提交的附件POST信息
	 * @return array 文件数组
	 */
	function combineFiles( $postData ){
	
		$fileids            = $postData['fileid'];// 附件id
		$attachmentnames    = $postData['attachmentname'];// 上传域的名称
		$attachmenttypes    = $postData['attachmenttype'];// 附件类型
		$filepaths          = $postData['filepath'];// 附件相对路径
		$orifilenames       = $postData['orifilename'];// 文件原始文件名
	
		unset($files);
		// 如果附件中有允许一个类型的附件上传多个文件的附件类型，则需要对附件进行处理
		// 对附件类型字段进行去重处理
		$attachmenttypes_unique = array_unique( $attachmenttypes );
		// 循环附件类型，并组合成如下的结构
		/* array(3) {
		 [0] => array(2) {
		 ["value"] => string(12) "附件类型1"
		 ["key"] => array(3) {
		 [0] => int(0)
		 [1] => int(1)
		 [2] => int(2)
		 }
		 }
		 ...
		 */
		foreach ($attachmenttypes_unique as $key1 => $vo1 ){
			unset($array_key);
			foreach ($attachmenttypes as $key2 => $vo2 ){
				if($vo1 == $vo2 ){
					$array_value = $vo1;
					$array_key[] = $key2;
				}
			}
			$temp['value'] 	= $array_value;
			$temp['key'] 	= $array_key;
			$new_types[] = $temp;
		}
	
		// 循环最终的数组，组合成完整的附件信息数组，结构如下：
		/* array(3) {
		 [0] => array(3) {
		 ["attachmenttype"] => string(12) "附件类型1"
		 ["id"] => string(18) "15640,15641,15642,"
		 ["orifilename"] => string(69) "290137375233002800.jpg,290137375233002800.jpg,290137375233002800.jpg,"
		 }
		 [1] => array(3) {
		 ["attachmenttype"] => string(13) "附件类型2"
		 ["id"] => string(12) "15643,15644,"
		 ["orifilename"] => string(46) "290137375233002800.jpg,290137375233002800.jpg,"
		 }
			} */
		foreach ( $new_types as $key => $vo ){
			// 附件类型
			$file['attachmenttype'] 	= $vo['value'];
	
			// 附件上传域名称
			foreach ($attachmentnames as $key_name => $vo_name ){
				if( in_array( $key_name, $vo['key'] )){
					$attachmentname =  $vo_name;
				}
			}
			$file['attachmentname'] 		= $attachmentname;
	
			// 附件id
			$fileid = "";
			foreach ($fileids as $key_id => $vo_id ){
				if( in_array( $key_id, $vo['key'] )){
					$fileid .=  $vo_id . ',';
				}
			}
			// 过滤结尾的逗号
			$fileid =  rtrim($fileid, ',');
			$file['fileid'] 		= $fileid;
	
			// 附件原始文件名
			$orifilename = "";
			foreach ($orifilenames as $key_name => $vo_name ){
				if( in_array( $key_name, $vo['key'] )){
					$orifilename .=  $vo_name . ',';
				}
			}
			// 过滤结尾的逗号
			$orifilename =  rtrim($orifilename, ',');
			$file['orifilename'] 		= $orifilename;
	
			$files[] = $file;
		}
	
		return $files;
	
	}
}
	
?>