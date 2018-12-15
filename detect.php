<?php
// 关掉浏览器，PHP脚本也可以继续执行.
ignore_user_abort();
// 通过set_time_limit(0)可以让程序无限制的执行下去
set_time_limit(0);
// 间隔24个小时
$interval = 60 * 60  * 24;
//获取域名或主机地址
//echo $_SERVER['HTTP_HOST']."<br>"; #localhost

//获取网页地址
//echo $_SERVER['PHP_SELF']."<br>"; #/blog/testurl.php

//获取网址参数
//echo $_SERVER["QUERY_STRING"]."<br>"; #id=5

//获取用户代理
//echo $_SERVER['HTTP_REFERER']."<br>";

//获取完整的url
// echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."<br>";
// echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']."<br>";
#http://localhost/blog/testurl.php?id=5

//包含端口号的完整url
// echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]."<br>";
#http://localhost:80/blog/testurl.php?id=5

//只取路径
$url='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
echo dirname($url);
exit;
//$url =  http://it.sohu.com/7/1002/17/column20466721_3257.shtml);

do{
	
 	//	每天的早上8点开始执行
 	// 判断当前的时间是否大于8点，如果小于8点不执行
 	$run = include 'detect_config.php';
 	if(!$run) die('process abort');
   
 	//ToDo
 	// file_put_contents("detect.txt", date("Y-m-d H:i:s") . "\r\n<br>", FILE_APPEND);
 	$result = file_get_contents( $url );
 	// 
 	sleep($interval);// 等待5分钟
}
while(true);

?>


