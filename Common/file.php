<?php
/**
 * 项目公共函数库  -JSON处理类
 *
 * @copyright   Copyright 2010-2014 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Common
 * @version     20150516
 * @link        http://www.dejax.cn
 */


function remote_filesize($url) {
	static $regex = '/^Content-Length: *+\K\d++$/im';
	if (!$fp = @fopen($url, 'rb')) {
		return false;
	}
	if (
	isset($http_response_header) &&
	preg_match($regex, implode("\n", $http_response_header), $matches)
	) {
		return (int)$matches[0];
	}
	return strlen(stream_get_contents($fp));
}

//curl模式下载文件
function curl_file_get_contents($durl){
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $durl);
   curl_setopt($ch, CURLOPT_TIMEOUT, 5);
   curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
   curl_setopt($ch, CURLOPT_REFERER,_REFERER_);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $r = curl_exec($ch);
   curl_close($ch);
   return $r;
}

//下载文件
function smart_read_file($location, $filename, $mimeType='application/octet-stream', $remote = true){
	if( !$remote )
		if(!file_exists($location)){
			header ("HTTP/1.0 404 Not Found");
			return;
		}

	//如果是远程地址，则
	if( $remote )
		$size=remote_filesize($location);
	else
		$size=filesize($location);

	$time=date('r',filemtime($location));

	$fm=@fopen($location,'rb');
	if(!$fm){
		header ("HTTP/1.0 505 Internal server error");
		return;
	}

	$begin=0;
	$end=$size;

	if(isset($_SERVER['HTTP_RANGE'])){
		if(preg_match('/bytes=\h*(\d+)-(\d*)[\D.*]?/i', $_SERVER['HTTP_RANGE'], $matches)){
			$begin=intval($matches[0]);
			if(!empty($matches[1]))
				$end=intval($matches[1]);
		}
	}

	if($begin>0||$end<$size)
		header('HTTP/1.0 206 Partial Content');
	else
		header('HTTP/1.0 200 OK');

	header("Content-Type: $mimeType");
	header("Content-Range: bytes $begin-$end/$size");
	//缓存设置 begin
	header("Pragma: cache");
	header("Cache-Control: public"); 
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + 30*24*60*60) . " GMT"); 
	//缓存设置 end
	header('Accept-Ranges: bytes');
	header('Accept-Length:'.$size);
	//判断浏览器IE
	if( getBrowser() == 'ie' ){
		//将$filename中的中间空格去掉
		$filename = str_replace(' ', '', $filename );
		$filename = urlencode($filename);
	}
	header("Content-Disposition: inline; filename=$filename");
	header("Content-Transfer-Encoding: binary\n");
	header("Last-Modified: $time");

	//如果是远程地址，则调用file_get_contents下载
	if( $remote ){
		//新增下载方式配置
		if(C("file_get_methods")=="curl"){
			echo curl_file_get_contents($location);
		}else{
			echo file_get_contents($location);
		}
	}else{
		$cur=$begin;
		fseek($fm,$begin,0);
		while( !feof($fm) && $cur < $end && (connection_status()==0) ){
			print fread($fm, min(1024*16, $end-$cur) );
			$cur+=1024*16;
		}
	}

	fclose($rh);
}


/**
 * 检测文件是否存在
 *
 * 检测文件是否存在，可以同时检测本地文件和远程文件
 * @param string $file
 * @return boolean
 */
function is_file_exists($file){
	// 判断当前检测的文件是否是远程文件
	if(preg_match('/^http:\/\//',$file)){
		// 如果是远程文件
		// 判断php.ini是否开启了allow_url_fopen
		if(ini_get('allow_url_fopen')){
			if(@fopen($file,'r')) return true;
		}else{
			$parseurl=parse_url($file);
			$host=$parseurl['host'];
			$path=$parseurl['path'];
			$port=$parseurl['port'];
			$fp=fsockopen($host,$port, $errno, $errstr, 10);
			if(!$fp){
				return false;
			}
			
			fputs($fp,"GET {$path} HTTP/1.1 \r\nhost:{$host}\r\n\r\n");
			if(preg_match('/HTTP\/1.1 200/',fgets($fp,1024))) {
				return true;
			}
		}
		return false;
	}else{
		// 如果是本地文件，直接通过file_exists方法进行判断
		return file_exists($file);
	}
}

/**
 * 获取文件
 *
 * 获取文件的下地址：通过下载附件的控制类封装全部的文件下载操作
 *
 * @param $fileid
 * @return string
 */
function get_download_url( $fileid ){
    // 文件不存在返回
    if( !$fileid ){
        return '';
    }
    // 拼接下载路径
    return __GROUP__.'/Upload/downloadFile/id/' . $fileid;

}
?>