<?php

# 引入文件
require 'include.php';

# 配置参数
$config = array(
    'token'          => '',
    'appid'          => 'wx71e00a3b3931e76f',
    'appsecret'      => '1e1d4ad7e808b1c236e006bb326ac75e',
    'encodingaeskey' => '',
);

# 加载对应操作接口
$wechat = & \Wechat\Loader::get('User', $config);
$userlist = $wechat->getUserList();

//var_dump($userlist);
var_dump($wechat->errMsg);
var_dump($wechat->errCode);
