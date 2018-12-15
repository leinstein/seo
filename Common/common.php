<?php
function array_sort($arr,$keys,$type='asc'){

    $keysvalue = $new_array = array();
    foreach ($arr as $k=>$v){
        $keysvalue[$k] = $v[$keys];
    }
    if($type == 'asc'){
        asort($keysvalue);
    }else{
        arsort($keysvalue);
    }
    reset($keysvalue);
    foreach ($keysvalue as $k=>$v){
        $new_array[$k] = $arr[$k];
    }
    return $new_array;
}
/**
 * like条件拼接
 *
 * @param     mixed $arr 组合条件的数据
 * @param     string $link 默认or
 * @return    mixed 查询条件
 * @author    zhangss
 * @copyright 上海启搜网络科技有限公司(www.qisobao.cn)
 * @package   Action
 * @version   20141120
 * @link      http://www.qisobao.cn
 */
function getMapLike($arr, $link = 'or'){
	foreach($arr as $v){
		$map[] = array("LIKE", "%".$v.",%");
	}
	$map[] = $link;
	return $map;
}

/**
 * like条件拼接 可自定义分隔符
 *
 * @param     mixed $arr 组合条件的数据
 * @param     string $link 默认or
 * @return    mixed 查询条件
 * @author    zhangss
 * @copyright 上海启搜网络科技有限公司(www.qisobao.cn)
 * @package   Action
 * @version   20141120
 * @link      http://www.qisobao.cn
 */
function getMapLikeCom($arr, $link = 'or', $ifs = ''){
    foreach($arr as $v){
        $map[] = array("LIKE", "%".$v."{$ifs}%");
    }
    $map[] = $link;
    return $map;
}

/**
 * eq条件拼接
 *
 * @param     mixed $arr 组合条件的数据
 * @param     string $link 默认or
 * @return    mixed 查询条件
 * @author    zhangss
 * @copyright 上海启搜网络科技有限公司(www.qisobao.cn)
 * @package   Action
 * @version   20141120
 * @link      http://www.qisobao.cn
 */
function getMapEq($arr, $link = 'or'){
	foreach($arr as $v){
		$map[] = array("eq", $v);
	}
	$map[] = $link;
	return $map;
}

/**
 * 项目公共函数库 
 *
 * @copyright   Copyright 2010-2014 上海启搜网络科技有限公司(www.qisobao.cn)
 * @package     Common
 * @version     20141006
 * @link        http://www.qisobao.cn
 */

/**
 * 获得今天的日期，并默认以2010-01-02的格式显示
 *
 * @param string $format 日期显示格式
 * @return string 当前日期
 */
function now_to_date( $format = 'Y-m-d'){
	return date($format);
}

/**
 * 获得当前时间，并以2010-01-02 12:32:12的格式显示
 *
 * @param string $format 日期时间显示格式
 * @return string 当前日期时间
 */
function now_to_time( $format = 'Y-m-d H:i:s' ){
	return date($format);
}


/**
 * 用于模版里面显示日期格式
 *
 * @param int $date Unix的日期
 * @param string $format 日期显示格式，如果是zh_cn，则直接返回中文的显示格式
 * @return string 格式化后的日期
 */
function format_date( $datetime, $format = 'Y-m-d' ){

	if( !$datetime || $datetime == '0000-00-00' || $datetime =='0000-00-00 00:00:00' )
		return "";
		switch ($format) {
			case 'Y-m-d':
				return date( $format, strtotime($datetime) );
			case 'minute'://精确到分钟
				return  date( 'Y-m-d H:i', strtotime($datetime) );
			case 'second'://精确到秒
				return date( 'Y-m-d H:i:s', strtotime($datetime) );
			case 'm_d'://精确到分钟
				return  substr(date( 'Y-m-d', strtotime($datetime)),5,6 );
			case 'zh_cn'://中文年月日
				$datetime_arr = explode(' ',$datetime);
				$date_arr = explode('-',$datetime_arr[0]);
				$date = '';
				if( is_array($date_arr) and $date_arr[0]){
					$date = $date_arr[0]."年";
					if($date_arr[1]){
						$date = $date . $date_arr[1]."月";
						if($date_arr[2]){
							$date = $date . $date_arr[2]."日";
						}
					}
				}
				return $date;
			default:
				return date( $format, strtotime($datetime) );
				break;
		}

}

/**
 * 格式化Unix时间格式
 *
 * @param int $ms Unix的日期时间显示格式
 * @return string 格式化后的日期时间
 */
function format_unixtime( $ms, $short = false ){
	if($ms == "" | $ms == 0){
		$result = "";		
	}else{
		if( $short )
			$result = strftime("%H:%M:%S",$ms);
		else
			$result = strftime("%y-%m-%d %H:%M:%S",$ms);
	}
	return $result;
}

/**
 * 当前时间，显示格式为20140101123030
 *
 * @return string 格式化后的日期时间
 */
function get_now_num(){
	$time = explode ( " ", microtime () );
	$time_sec = strftime("%y%m%d%H%M%S",time());
	$time_mic = $time[1]*1000;
	return $time_sec."-".$time_mic;
}

/**
 * 金额格式化，保留由参数指定的最大小数位数，如果输入数据中不保留小数，则输出也不保留。
 *
 * @param int $preci 需要保留的最大小数位数
 * @param number $money 金额参数
 * @return string 格式化后的金额
 */
function format_money($money, $preci = 2){
	$money = number_format($money, $preci, '.', '');
	$f1 = substr( $money, 0, strpos( $money, "." ) );
	$f2 = "";
	$money = (float)$money;
	if( strpos($money, ".") !== false )
		$f2 = substr( $money, strpos($money, ".") );
	$return = number_format($f1) . $f2;
    return $return;
}
function format_money2($money, $preci = 2 ,$zero = true){
    if($money === NULL or $money === "")
        return "";
    if($zero)
        return number_format($money, $preci, '.',',');
    else{
        $money = number_format($money, $preci, '.', '');
        $f1 = substr( $money, 0, strpos( $money, "." ) );
        $f2 = "";
        $money = (float)$money;
        if( strpos($money, ".") !== false )
            $f2 = substr( $money, strpos($money, ".") );
        return number_format($f1) . $f2;
    }
}

/**
 * 金额格式化，保留由参数指定的最大小数位数，如果输入数据中不保留小数，则输出也不保留。
 *
 * @param int $preci 需要保留的最大小数位数
 * @param number $money 金额参数
 * @return string 格式化后的金额
 */
function format_money1($money, $preci = 2 ,$zero = true){
	if($zero)
    	return number_format($money, $preci, '.',',');
	else{
		$money = number_format($money, $preci, '.', '');
		$f1 = substr( $money, 0, strpos( $money, "." ) );
		$f2 = "";
		$money = (float)$money;
		if( strpos($money, ".") !== false )
			$f2 = substr( $money, strpos($money, ".") );
		return number_format($f1) . $f2;
	}
}

/**
 * 金额格式化，保留由参数指定的最大小数位数，如果输入数据中不保留小数，则输出也不保留。
 *
 * @param int $preci 需要保留的最大小数位数
 * @param number $money 金额参数
 * @return string 格式化后的金额
 */
function format_money4($money, $preci = 4 ,$zero = true){
	if($zero)
    	return number_format($money, $preci, '.',',');
	else{
		$money = number_format($money, $preci, '.', '');
		$f1 = substr( $money, 0, strpos( $money, "." ) );
		$f2 = "";
		$money = (float)$money;
		if( strpos($money, ".") !== false )
			$f2 = substr( $money, strpos($money, ".") );
		return number_format($f1) . $f2;
	}
}

/**
 * 截取字符串，并在后面拼接...
 *
 * @param string $str 字符串
 * @param string $len 长度
 * @param string $add 后面补充的字符串，默认是"..."
 * @return string 格式化后的字符串
 */
function title_show($str, $len, $add='...') { 
	if(empty($len))
		$len = 10;
	if( mb_strlen($str,'utf-8') > $len )
		$str = mb_substr($str, 0, $len,'utf-8').$add;
    return $str;
}

/**
 * 根据搜索条件返回拼接的URL, prjtype,p01,p02,p03,t1,t2,t3,
 *
 * @param string $str 条件字符串，逗号分割
 * @param string $combo 连接符号符号，默认是/
 * @return string 拼接后的字符串
 */
function combo_url_param($str, $combo = "/") {
	$str_arr = explode(",", $str);
	$return = '';
	foreach( $str_arr as $vo ){
		if( $combo == "/")
			$return = $return . "/" . $vo . "/" .urlencode($_GET[$vo]);
		else 
			$return = $return . "&" . $vo . "=" .urlencode($_GET[$vo]);
	}
	return $return;
}

/**
 * 将金额全部转换成元 
 * 
 * @param string $amount
 * @param string $unit
 */
function change_money_unit($amount, $unit){
	
	if($unit == '万元' || $unit == '万')
		$amount  = 10000 * $amount;
	if($unit == '亿元' || $unit == '亿')
		$amount= 100000000 * $amount;
	
	return $amount ; 
}

/**
 * 判断ip是否为内网
 * 
 * @param unknown_type $ip
 */
function is_internal_ip($ip) {
	if( $ip == "::1" or $ip == "127.0.0.1" )
		return true;

	$ip = ip2long($ip);
	$net_a = ip2long('10.255.255.255') >> 24; //A类网预留ip的网络地址
	$net_b = ip2long('172.31.255.255') >> 20; //B类网预留ip的网络地址
	$net_c = ip2long('192.168.255.255') >> 16; //C类网预留ip的网络地址
	return $ip >> 24 === $net_a || $ip >> 20 === $net_b || $ip >> 16 === $net_c;
}

/*
 * 一维数据转码。gbk -> utf8
*/
function  oneArrayIconvBbkToUtf8($data){

	if(is_array($data)){

		foreach($data as $key => $val){

			if(!is_array($val))
				$data[$key] = iconv('gb2312','UTF-8',$val);

		}

	}
	return $data;

}

/*
 *json 转码
*/
function  urlencodeAry($data){

	if(is_array($data)){

		foreach($data as $key => $val){

			$data[$key] = urlencodeAry($val);

		}
		return $data;

	}else{

		return urlencode($data);

	}

}

/*
 * json_encode ，并处理特殊字符。如换行等。否则使用json_decode无法转换
*/
function  json_encodeEOL($data){

	if(is_array($data)){

		return str_replace(array('%0A%0D','%0D%0A','%0A','%0D'),'\r\n',json_encode($data));

	}else{

		return $data;

	}

}

/*
 *  判断一个数组中的元素是否都存在于json中
* para1:数组，有指定下标的。如array('certifino'=>'国药准字001号','saleyear'=>'2012')
* para2:json
*/
function  isArrayDataInJson($data,$jsonStr){

	$returnStr = true;

	if(!empty($jsonStr)){

		//转换json 为数组
		$jsonArray = json_decode($jsonStr,true);
		foreach($data as $key => $val){
			if($jsonArray[$key] <> $val)
				$returnStr = false;
		}

	}

	return $returnStr;
}

/**
 * 二维数组去掉重复值,并保留键值
 * @param array $array2D
 * @return array
 */
function array_unique_fb( $array2D ){
 	foreach ($array2D as $k=>$v){
 		
 		// 获取数组的键
 		$array_keys = array_keys( $v );
 		// 降维,也可以用implode,将一维数组转换为用逗号连接的字符串
  		$v=join(',',$v); 
  		// 组合成一维数组
  		$temp[$k]=$v;

 	}
	// 去掉重复的字符串,也就是重复的一维数组 
 	$temp=array_unique($temp); 
	// 循环处理
 	foreach ($temp as $k => $v){
		$array=explode(',',$v); //再将拆开的数组重新组装
		//下面的索引根据自己的情况进行修改即可

		foreach ($array_keys as $key_key => $vo_key ) {
			# code...
			$arra[$k][$vo_key] = $array[$key_key];
		}
	}
 	return $arra;
}


/**
 * 自定义转码
 * @param unknown $arr
 * @return unknown
 */
function my_json_encode( $arr ){
	
	return urldecode(json_encodeEOL(urlencodeAry( $arr )));
}

/**
 * 创建GUID方法
 *
 * @param
 * @return string 数据处理标志
 * @author Erdong
 */
  function create_guid(){
	$charid = strtoupper(md5(uniqid(mt_rand(), true)));
	$hyphen = chr(45);// "-"
	$uuid = substr($charid, 6, 2).substr($charid, 4, 2).substr($charid, 2, 2).substr($charid, 0, 2).$hyphen.substr($charid, 10, 2).substr($charid, 8, 2).$hyphen.substr($charid,14, 2).substr($charid,12, 2).$hyphen.substr($charid,16, 4).$hyphen.substr($charid,20,12);
	return $uuid;
}

/**
 * 清除数组中所有字符串的两端空格
 * 
 * 使用php独有的array_map函数遍历清除数组中所有字符串的两端空格。
 * 
 * @param array $array
 * @return array
 */
function trim_array( $array ){
	if (!is_array( $array )){
		return trim( $array );
	}
	return array_map('trim_array', $array);
}

/**
 * 去除字符串中的空格换行等特殊字符
 */
function my_trim( $str, $strArray){
	//去掉前后空格
	$str = trim($str);
	//去掉换行
	$str = preg_replace('/\r|\n/', '', $str);
	foreach($strArray as $vo){
		$str = str_replace($vo, '', $str);
	}

	return $str;
}


//下载文件 url:$remote = true
function smartReadFile($location, $filename, $mimeType='application/octet-stream', $remote = false){
	if( !$remote )
		if(!file_exists($location)){
		header ("HTTP/1.0 404 Not Found");
		return;
	}

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
	header('Cache-Control: public, must-revalidate, max-age=0');
	header('Pragma: no-cache');
	header('Accept-Ranges: bytes');
	/* if( $remote )
		header('Content-Length:'.($end-$begin)); */
	header("Content-Range: bytes $begin-$end/$size");
	header("Content-Disposition: inline; filename=$filename");
	header("Content-Transfer-Encoding: binary\n");
	header("Last-Modified: $time");
	header('Connection: close');

	if( $remote ){
		echo file_get_contents($location);
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
	//获取浏览器版本信息
	function getBrowser($Agent) {  
	    $agent  = $Agent;  
	    $browser  = '';  
	    $browser_ver  = '';  
	  
	    if (preg_match('/OmniWeb\/(v*)([^\s|;]+)/i', $agent, $regs)) {  
	      $browser  = 'OmniWeb';  
	      $browser_ver   = $regs[2];  
	    }  
	  
	    if (preg_match('/Netscape([\d]*)\/([^\s]+)/i', $agent, $regs)) {  
	      $browser  = 'Netscape';  
	      $browser_ver   = $regs[2];  
	    }  
	    if (preg_match('/Chrome\/(\d+)\..*/i', $agent, $regs)){
	    	$browser  = 'Chrome';
	    	$browser_ver   = $regs[1];
	    }
	    if (strpos($agent,'Chrome')==false&&preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {  
	      $browser  = 'Safari';  
	      $browser_ver   = $regs[1];  
	    }  
	  
	    if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {  
	      $browser  = 'Internet Explorer';  
	      $browser_ver   = $regs[1];  
	    }  
	  
	    if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {  
	      $browser  = 'Opera';  
	      $browser_ver   = $regs[1];  
	    }  
	  
	    if (preg_match('/NetCaptor\s([^\s|;]+)/i', $agent, $regs)) {  
	      $browser  = '(Internet Explorer ' .$browser_ver. ') NetCaptor';  
	      $browser_ver   = $regs[1];  
	    }  
	  
	    if (preg_match('/Maxthon/i', $agent, $regs)) {  
	      $browser  = '(Internet Explorer ' .$browser_ver. ') Maxthon';  
	      $browser_ver   = '';  
	    } 
		if (preg_match('/360SE/i', $agent, $regs)) {  
	      $browser       = '(Internet Explorer ' .$browser_ver. ') 360SE';  
	      $browser_ver   = '';  
	    } 
		if (preg_match('/SE 2.x/i', $agent, $regs)) {  
	      $browser       = '(Internet Explorer ' .$browser_ver. ') 搜狗';  
	      $browser_ver   = '';  
	    }  
	  
	    if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {  
	      $browser  = 'FireFox';  
	      $browser_ver   = $regs[1];  
	    }  
	  
	    if (preg_match('/Lynx\/([^\s]+)/i', $agent, $regs)) {  
	      $browser  = 'Lynx';  
	      $browser_ver   = $regs[1];  
	    }  
	  
	    if ($browser != '') {  
	       return $browser.' '.$browser_ver;  
	    }  
	    else {  
	      return 'Unknow browser';  
	    }  
	}  
	//获取操作系统信息
	function getSysPlatform($Agent) {
		$browserplatform == '';
		if (eregi ( 'win', $Agent ) && strpos ( $Agent, '95' )) {
			$browserplatform = "Windows 95";
		} elseif (eregi ( 'win 9x', $Agent ) && strpos ( $Agent, '4.90' )) {
			$browserplatform = "Windows ME";
		} elseif (eregi ( 'win', $Agent ) && ereg ( '98', $Agent )) {
			$browserplatform = "Windows 98";
		} elseif (eregi ( 'win', $Agent ) && eregi ( 'nt 5.0', $Agent )) {
			$browserplatform = "Windows 2000";
		} elseif (eregi ( 'win', $Agent ) && eregi ( 'nt 5.1', $Agent )) {
			$browserplatform = "Windows XP";
		} elseif (eregi ( 'win', $Agent ) && eregi ( 'nt 6.0', $Agent )) {
			$browserplatform = "Windows Vista";
		} elseif (eregi ( 'win', $Agent ) && eregi ( 'nt 6.1', $Agent )) {
			$browserplatform = "Windows 7";
		} elseif (eregi ( 'win', $Agent ) && ereg ( '32', $Agent )) {
			$browserplatform = "Windows 32";
		} elseif (eregi ( 'win', $Agent ) && eregi ( 'nt', $Agent )) {
			$browserplatform = "Windows NT";
		} elseif (eregi ( 'Mac OS', $Agent )) {
			$browserplatform = "Mac OS";
		} elseif (eregi ( 'linux', $Agent )) {
			$browserplatform = "Linux";
		} elseif (eregi ( 'unix', $Agent )) {
			$browserplatform = "Unix";
		} 
// 		elseif (eregi ( 'sun', $Agent ) && eregi ( 'os', $Agent )) {
// 			$browserplatform = "SunOS";
// 		} elseif (eregi ( 'ibm', $Agent ) && eregi ( 'os', $Agent )) {
// 			$browserplatform = "IBM OS/2";
// 		} elseif (eregi ( 'Mac', $Agent ) && eregi ( 'PC', $Agent )) {
// 			$browserplatform = "Macintosh";
// 		} elseif (eregi ( 'PowerPC', $Agent )) {
// 			$browserplatform = "PowerPC";
// 		} elseif (eregi ( 'AIX', $Agent )) {
// 			$browserplatform = "AIX";
// 		} elseif (eregi ( 'HPUX', $Agent )) {
// 			$browserplatform = "HPUX";
// 		} elseif (eregi ( 'NetBSD', $Agent )) {
// 			$browserplatform = "NetBSD";
// 		} elseif (eregi ( 'BSD', $Agent )) {
// 			$browserplatform = "BSD";
// 		} elseif (ereg ( 'OSF1', $Agent )) {
// 			$browserplatform = "OSF1";
// 		} elseif (ereg ( 'IRIX', $Agent )) {
// 			$browserplatform = "IRIX";
// 		} elseif (eregi ( 'FreeBSD', $Agent )) {
// 			$browserplatform = "FreeBSD";
// 		}
		if ($browserplatform == '') {
			$browserplatform = "Unknown";
		}
		return $browserplatform;
	}
	
	
	/*
	 *根据新浪IP查询接口获取IP所在地
	 */
	function getIPLoc_sina($queryIP){
		$url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$queryIP;
		$ch = curl_init($url);
		//curl_setopt($ch,CURLOPT_ENCODING ,'utf8');
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
		$location = curl_exec($ch);
		$location = json_decode($location);
		curl_close($ch);
		 
		$loc = "";
		if($location===FALSE) return "";
		if (empty($location->desc)) {
			$loc = $location->country.$location->province.($location->province?"省":"").$location->city.($location->city?"市":"");
		}else{
			$loc = $location->desc;
		}
		return $loc?$loc:"暂未取得";
	}
	/**
	 * 获取当前是星期几
	 * @return string
	 */
	function getWeek( $time ){
		if( !$time){
			$time = time();
		}
		$week = date("w" , $time );
		switch( $week ){
			case 1:
				return "周一";
				break;
			case 2:
				return "周二";
				break;
			case 3:
				return "周三";
				break;
			case 4:
				return "周四";
				break;
			case 5:
				return "周五";
				break;
			case 6:
				return "周六";
				break;
			case 0:
				return "周日";
				break;
		}
	}
/* 过滤输入 */	
function filterspecialchars($params){
	if( is_array($params) ){
		return array_map("htmlspecialchars", $params);
	}else{
		return htmlspecialchars($params);
	}
}


/**
 * 获取用户真实 IP
 */
function getIP()
{
	static $realip;
	if (isset($_SERVER)){
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
			$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
			$realip = $_SERVER["HTTP_CLIENT_IP"];
		} else {
			$realip = $_SERVER["REMOTE_ADDR"];
		}
	} else {
		if (getenv("HTTP_X_FORWARDED_FOR")){
			$realip = getenv("HTTP_X_FORWARDED_FOR");
		} else if (getenv("HTTP_CLIENT_IP")) {
			$realip = getenv("HTTP_CLIENT_IP");
		} else {
			$realip = getenv("REMOTE_ADDR");
		}
	}
	return $realip;
}

/**
 * 获取 IP  地理位置
 * 淘宝IP接口
 * @Return: array
 */
function getCity($ip = ''){
	
	//判断ip是否为内网或者ip不存在
	/*
	if( !$ip || isLocal($ip)){
		$url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";
	}else{
		$url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=" .$ip;
	}
	*/
	return "";
	return "http://pv.sohu.com/cityjson?ie=utf-8";
	

	
// 	if($ip == ''){
// 		$url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=112.22.235.223";
// 		$ip=json_decode(file_get_contents($url),true);
// 		$data = $ip;
// 	}else{
// 		$url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
// 		$ip=json_decode(file_get_contents($url));
// 		if((string)$ip->code=='1'){
// 			return false;
// 		}
// 		$data = (array)$ip->data;
// 	}
	$city	= json_decode(file_get_contents($url),true);
	return $city;
}

/*
 * PHP 判断是否内网访问
 * By Wuxiancheng.cn
 * @param $ip 待检查的IP
 * @return boolean
 */
function isLocal($ip){
	$long=ip2long($ip);
	$data=array(
			24=>'10.255.255.255',
			20=>'172.31.255.255',
			16=>'192.168.255.255'
	);
	foreach($data as $k=>$v){
		if($long >> $k === ip2long($v)>>$k){
			return true;
		}
	}
	return false;
}


/*
 * PHP 判断是否内网访问
 * @param $ip 待检查的IP
 */
function isLocal1($ip){
	return preg_match('%^127\.|10\.|192\.168|172\.(1[6-9]|2|3[01])%',$ip);
}

function get_ip_place(){
	$ip=file_get_contents("http://fw.qq.com/ipaddress");
	 
	$ip=str_replace('"',' ',$ip);
	$ip2=explode("(",$ip);
	$a=substr($ip2[1],0,-2);
	$b=explode(",",$a);
	return $b;
}

function is_url( $url ){
	// 正则URL
// 	$REGEXP_URL = '~^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?~i';
	
// 			preg_match( $REGEXP_URL,$url,$arr);
			
			
			
// 			$text = preg_match('@(http?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', $url, $text);
// 			//dump($text);
			
// 	$REGEXP_URL = '/http:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is';
	
// 	dump( preg_match( $REGEXP_URL,$url));
// 	preg_match('/http:\/\/[0-9a-z\.\/\-]+\/[0-9a-z\.\/\-]+\.([0-9a-z\.\/\-]+)/',$url,$arr);
// 	dump($arr);
	
	/**
	 匹配url
	 url规则：
	 例
	 协议://域名（www/tieba/baike...）.名称.后缀/文件路径/文件名
	 http://zhidao.baidu.com/question/535596723.html
	 协议://域名（www/tieba/baike...）.名称.后缀/文件路径/文件名?参数
	 www.lhrb.com.cn/portal.php?mod=view&aid=7412
	 协议://域名（www/tieba/baike...）.名称.后缀/文件路径/文件名/参数
	 http://www.xugou.com.cn/yiji/erji/index.php/canshu/11
	  
	 协议：可有可无，由大小写字母组成；不写协议则不应存在://，否则必须存在://
	 域名：必须存在，由大小写字母组成
	 名称：必须存在，字母数字汉字
	 后缀：必须存在，大小写字母和.组成
	 文件路径：可有可无，由大小写字母和数字组成
	 文件名：可有可无，由大小写字母和数字组成
	 参数:可有可无，存在则必须由?开头，即存在?开头就必须有相应的参数信息
	 */
	$rule = '/^(([a-zA-Z]+)(:\/\/))?([a-zA-Z]+)\.(\w+)\.([\w.]+)(\/([\w]+)\/?)*(\/[a-zA-Z0-9]+\.(\w+))*(\/([\w]+)\/?)*(\?(\w+=?[\w]*))*((&?\w+=?[\w]*))*$/';
	//preg_match($rule,$url,$result);
	//return $result[0];
	$result =  preg_match($rule,$url);
	return $result;
	
	//return $arr[1];
}

/**
 * 获取一个二维数组的最大值和最小值
 * @param unknown $begindate
 * @param unknown $enddate
 */
function get_min_and_max_in_array( $arr , $key_str ) {
	if(empty($arr)) {
		return array(10,10);
	}
	$arr_new = array();
	foreach($arr as $value) {
		$arr_new[] = floatval($value[$key_str]);
	}
	sort($arr_new);
	$resArr = !empty($arr_new) ? array($arr_new[0],$arr_new[count($arr_new)-1]) : array(10,10);
	foreach ($resArr as $vo ){
		unset( $day);
		foreach ($arr as $vo_ar ){
			if( $vo == $vo_ar[$key_str]){
				//$date[] = $vo_ar['date'];
				//$day[] = $vo_ar['day'];
				$date = $vo_ar['date'];
				$day = $vo_ar['day'];
			}
		}
		$return[$key_str] = $vo;
		$return['day'] = $day;
		$return['date'] = $date;
		$returns[] = $return;
	}
	return $returns;
}

/**
 * 组合查询日期的范围
 * @param unknown $begindate
 * @param unknown $enddate
 */
function combo_query_date($begindate,$enddate){
	// 如果选择了开始日期和结束日期
	if( $begindate && $enddate ){
		//$diff_begin = (strtotime(date('Y-m-d')) - strtotime($begindate))/86400;
		$diff = (strtotime($enddate) - strtotime($begindate))/86400;
		switch ($diff) {
			case 0:
				$days[]= $enddate;
				break;
			case 1:
				$days[]= $begindate;
				$days[]= $enddate;
				break;
			default:
				$days[]= $begindate;
				for($i=1;$i<$diff;$i++){
	
					$days[] = date('Y-m-d', strtotime ("+{$i} day", strtotime($begindate)));
				}
				$days[]= $enddate;
				break;
		}
	}else if($begindate){
		$diff = (strtotime(date('Y-m-d')) - strtotime($begindate))/86400;
		if( $diff <= 0){
			$days[]= date('Y-m-d');
		}else{
			$days[]= $begindate;
			for($i=1;$i<=$diff;$i++){
				$days[] = date('Y-m-d', strtotime ("+{$i} day", strtotime($begindate)));
			}
		}
	}else if($enddate){
		$diff = 9;
			
		for($i = $diff;$i>=1;$i--){
			$days[] = date('Y-m-d', strtotime ("-{$i} day", strtotime($enddate)));
		}
		$days[]= $enddate;
	}else {
		$diff = 9;
	
		for($i = $diff;$i>=0;$i--){
			$days[] = date('Y-m-d', strtotime ("-{$i} day"));
		}
	}
	
	return $days;
	
}


/**
 * 系统统一的代码集函数
 */
function get_codeset( $codekey, $codearray ){
	//调用代码集模型
	return $codearray[$codekey];
}

/**
 * @author Richer
 * @var date1日期1
 * @var date2 日期2
 * @var tags 年月日之间的分隔符标记,默认为'-'
 * @return 相差的月份数量
 * @example:
 $date1 = "2003-08-11";
 $date2 = "2008-11-06";
 $monthNum = getMonthNum( $date1 , $date2 );
 echo $monthNum;
 */
function getMonthNum( $date1, $date2, $tags='-' ){
	$date1 = explode($tags,$date1);
	$date2 = explode($tags,$date2);
	return abs($date1[0] - $date2[0]) * 12 + abs($date1[1] - $date2[1]);
}

?>