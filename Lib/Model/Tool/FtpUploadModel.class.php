<?php
/**
 * 模型层：FTP文件操作模型类 
 *
 * @copyright   Copyright 2010-2011 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Tool
 * @version     20161025
 * @link        http://www.qisobao.com
 */

// 导入第三方类库
import('ORG.Util.Ftp');
class FtpUploadModel extends Model{
	
	// 必须支持xls xlxs doc docs jpg jpeg png gif bmp txt log
	private $allowType 	= 'xls|xlxs|doc|docs|txt|log|png|jpg|gif|jpeg';
		
	static $ftpHandler 	= null;
	
	// 连接ftp服务器配置
	static $config 		= null;
	
	
	/**
	 * 不检查数据库
	 */
	protected $autoCheckFields = false;
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
	
		if (self::$config === null) {
			self::$config = C ( 'FTP_CONFIG' );
		}
	}

	
	/**
	 * 连接ftp服务器
	 * 
	 * 链接ftp服务器，单例模式
	 * 1、初始化ftp服务器配置
	 * 2、判断当前是否已经有了实例
	 * 3、初始化新的对象，并赋值给全局静态变量
	 * 
	 * @param array $config
	 * @return boolean
	 */
	public function open( $config ) {
		
		//如果没有连接配置，获取默认配置
		if( $config ){
			self::$config = $config;
		}
		//判断是否已经有了实例
		if (self::$ftpHandler === null) {
			//如果没有主机地址
			if( !self::$config['hostname']){
				$this -> error ="ftp服务器地址不能为空";
				return false;
			}
			$ftp = new Ftp ( self::$config );
			$result = $ftp -> connect ();
			if( $result ){
				//设置对象
				self::$ftpHandler = $ftp;
				return true;
			}else{
				$this -> error = $ftp -> getError();
				return false;
			}
		}else {
			return true;
		}
	}
	
	
	/**
	 * 检测文件大小是否溢出
	 * 
	 * 检测上传的文件是否超过了配置的限制
	 *
	 * @param int $size  	
	 * @return bool
	 */
	function isSizeOver( $size ) {

		//上传文件大小默认设置为20M
		if(   empty ( self::$config ['maxsize'] )  ){
			self::$config ['maxsize'] = 20;
		}
		
		if(  $size > self::$config ['maxsize'] * 1024 * 1024  ){
			$this -> error = '上传文件不能超过'.self::$config ['maxsize'] .'MB';
			return false;
		}
		return true;
		//return ! empty ( self::$config ['maxsize'] ) && $size > self::$config ['maxsize'] ? true : false;
	}
	
	
	
	/**
	 * 输入本地的存放地址路径，输入远程的存放路径
	 *
	 * @param $localPath
	 * @param $savePath
	 *        	
	 * @return mixed
	 */
	function ftpUpload( $localfile, $remotefile) {
		
		//如果没有配置返回错
		if (! self::$config){
			return false;
		}
		
		//判断文件大小是否溢出
		if ( !$this -> isSizeOver( filesize( $localfile ))) {
			return false;
		}
	
		$result = self::$ftpHandler->upload ( $localfile, $remotefile );
		
		if( $result === false ){
			$this -> error = self::$ftpHandler -> getError();
			return false;
		}
		return true;
	}
	
	
	/**
	 * 自动上传
	 *
	 * 上传文件并且移动到另外的目录
	 * 	1、将文件上传到ftp服务器上的指定目录
	 * 	2、如果上传成功，将文件移动到指定的路径中
	 *
	 * @param $file
	 * @param string $localfile
	 * @param string $remotefile
	 * @param string $targetfile 移动到目标地址
	 * @return array
	 */
	public function uploadAndMove( $localfile, $remotefile, $targetfile ) {
	
		//判断文件大小是否溢出
		if ( !$this -> isSizeOver( filesize( $localfile ))) {
			return false;
		}
		
		//上传失败
		if ( !$this -> ftpUpload( $localfile, $remotefile ) ){
			
			$this -> error = self::$ftpHandler -> getError();
			return false;
			
		}
		if( $targetfile && $targetfile != $remotefile ){
			//上传成功后，移动文件到目标地址
			if( false == self::$ftpHandler -> move( $remotefile, $targetfile)){
				$this -> error = self::$ftpHandler -> getError();
				return false;
			}	
		}
		
		return true;
		
	}
	
	
	/**
	 * 上传 支持单个
	 *
	 * @param $file
	 * @param string $saveFolder
	 * @param string $allowType
	 *
	 * @return array
	 */
	/* public function autoUpload( $localfile, $remote = '', $allowType = '') {
	
		$ext = $this->getExt ( $localfile );
		//是否允许上传文件
		if (! $this->isAllowExt ( $ext, $allowType )) {
			return false;
		}
		//组合上传文件路径
		$remotepath = $this -> mkSavePath ( $remote, $ext );
	
		//上传文件
		if (! $this -> ftpUpload ( $localfile, $remote )) {
			//$this -> error = '文件上传失败，请联系管理员或重试！';
			$this -> error = self::$ftpHandler -> getError();
			return false;
		}
	
		return true;
	} */
	
	/**
	 * 先保存到本地 再上传到远程
	 * 
	 * @param unknown $savePath
	 * @param unknown $content
	 * @param string $locFolder
	 * @return boolean|mixed|boolean
	 */
	public function saveTxtFile($savePath, $content, $locFolder = 'uploads') {
		$locPath = $locFolder . $savePath;
		$arr = explode ( '/', dirname ( $locPath ) );
		$dir = '.';
		foreach ( $arr as $d ) {
			$comma = '/';
			$dir .= $comma . $d;
			if (! is_dir ( $dir ) && ! mkdir ( $dir ))
				return false;
		}
		
		// 保存文件失败
		if (empty ( $content ))
			$content = ' '; // 防止 file_put_content 保存失败
		if (! file_put_contents ( $locPath, $content )) {
			return false;
		}
		
		return $this->ftpUpload ( $locPath, $savePath );
	}
	

	/**
	 * 读取远程文件 
	 * 
	 * 先读取本地，否则读取远程
	 * 
	 * @param string $filePath
	 * @param string $locFolder
	 * @return string
	 */
	public function readTxtFile($filePath, $locFolder = 'uploads') {
		$content = '';
		$locPath = './' . $locFolder . $filePath;
		if (! (file_exists ( $locPath ) && is_file ( $locPath ))) {
			self::$ftpHandler->download ( $filePath, $locPath );
		}
		if (is_file ( $locPath ))
			$content = file_get_contents ( $locPath );
		
		return $content;
	}
	
	/**
	 * @description 删除本地 同时删除远程
	 *
	 * @param $path
	 * @param string $locFolder        	
	 * @param string $allowType        	
	 *
	 * @return bool
	 */
	public function delTxtFile($path, $locFolder = 'uploads', $allowType = '') {
		if (! empty ( $path )) {
			if (empty ( $allowType ))
				$allowType = $this->allowType;
			$ext = $this->getExt ( $path );
			if ($this->isAllowExt ( $ext, $allowType )) {
				$locPath = './' . $locFolder . $path;
				if (file_exists ( $locPath )) {
					@unlink ( $locPath );
				}
				
				return $this->ftpDelFile ( $path, $allowType );
			}
		}
		$this -> error = '文件' . $path . '删除失败，请联系管理员！' ;
		return  false;
	}
	
	/**
	 * 文件名中含有 至少2个数字表示非默认文件
	 *
	 * @param 	$filepath
	 *        	
	 * @return bool
	 */
	public function isDefaultFile($filepath) {
		return preg_match ( '/\d{2,}/', basename ( $filepath ) ) ? false : true;
	}
	
	/**
	 * 默认图片/文件是不允许删除！
	 *
	 * @param $filePath
	 * @param string $allowType        	
	 *
	 * @return array
	 */
	public function ftpDelFile($filePath, $allowType = '') {
		if (! self::$config){
			$this -> error = '未配置FTP登录信息' ;
			return  false;
		}
			
		// 是否是默认图片
		if ($this->isDefaultFile ( $filePath )) {
			$this -> error = '默认图片不允许删除！' ;
			return  false;
		}
		
		if (strpos ( $filePath, '..' ) !== false) {
			$this -> error = '文件或目录地址中不能包含 .. ！' ;
			return  false;
		}
		
		if (empty ( $allowType )){
			$allowType = $this->allowType;
		}
			
		$ext = $this->getExt ( $filePath );
		if (! $this->isAllowExt ( $ext, $allowType )) {
			$this -> error = '不允许的删除格式' ;
			return  false;
		}
		
		$result = self::$ftpHandler->delete_file ( $filePath );
		
		if ( !$result ){
			$this -> error = $ftpHandler -> gtError() ;
			return  false;
		}
		return true;
	}
	
	/**
	 *
	 * @param $filename
	 *        	
	 * @return string
	 */
	function getExt($filename) {
		if (false === strpos ( $filename, '.' )) {
			return '';
		}
		
		$x = explode ( '.', $filename );
		
		return '.' . strtolower ( end ( $x ) );
	}
	
	/**
	 * @description 输入的扩展名必须以.开头
	 *
	 * @param $ext
	 * @param string $allowType        	
	 *
	 * @return bool
	 */
	function isAllowExt($ext, $allowType = '') {
		//如果是全部
		if ($allowType == '*'){
			return true;
		}
			
		//如果为空则设作为默认的
		if (empty ( $allowType )){
			$allowType = $this->allowType;
		}
		
	
		//进行判断
		if( $ext && preg_match ( '/^\.(' . $allowType . ')$/i', $ext )  ){
			
			return true;
		}else{
			$this -> error = '上传文件的格式不正确，请上传'.$allowType .'类型的文件';
			return false;
		}
		
		//return $ext && preg_match ( '/^\.(' . $allowType . ')$/i', $ext ) ? true : false;
	}
	
	/**
	 * 生成上传地址 完整上传地址
	 * 
	 * 开头必须是 斜杠，包含完整扩展名
	 *
	 * @param string $folder        	
	 * @param string $ext        	
	 *
	 * @return mixed
	 */
	public function mkSavePath($folder = '', $ext = '') {
		$savePath = '/' . $folder . '/' . date ( 'ym' ) . '/' . date ( 'ymdHis_' ) . rand ( 10, 99 ) . $ext;
		
		return str_replace ( '//', '/', $savePath );
	}
	
	/**
	 * @description 检测是否是图片文件
	 *
	 * @param $filepath
	 * @param string $ext        	
	 *
	 * @return bool
	 */
	public function isImageFile($filepath, $ext = '') {
		$imginfo = getimagesize ( $filepath );
		if (empty ( $imginfo ) || ($ext == 'gif' && empty ( $imginfo ['bits'] ))) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * @description 通过保存路径获取网址
	 *
	 * @param $savePath
	 *        	
	 * @return string
	 */
	public function getUrl($savePath) {
		$url = '';
		if (preg_match ( '/^https?:/', $savePath )) {
			$url = $savePath;
		} else if (! empty ( $savePath )) {
			$url .= self::$config ['siteurl'];
			$url .= $savePath;
		}
		
		return $url;
	}
	
	
	/**
	 * 关闭FTP连接
	 */
	public function close() {
		if (self::$ftpHandler !== null) {
			self::$ftpHandler->close ();
		}
	}
	
}
?>