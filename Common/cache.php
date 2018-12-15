<?php
/**
 * 项目公共函数库 - 缓存相关
 *
 * @copyright   Copyright 2010-2014 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Common
 * @version     20141006
 * @link        http://www.dejax.cn
 */
 
/**
 * 快速文件数据读取和保存 针对简单类型数据 字符串、数组，不保存为Json格式
 *
 * @param name 名称
 * @param value 值
 * @param path 存储的数据路径
 * @return mixed 读取的结果 
 */
function FS($name,$value='',$path=DATA_PATH) {
    static $_cache = array();
    $filename   =   $path.$name.'.php';
    if('' !== $value) {
        if(is_null($value)) {
            // 删除缓存
            return unlink($filename);
        }else{
            // 缓存数据
            $dir   =  dirname($filename);
            // 目录不存在则创建
            if(!is_dir($dir))  mkdir($dir);
			//返回
			$result = file_put_contents($filename,"<?php\nreturn ".var_export($value,true).";\n?>");
			if( $result <= 100 or $result == false )
				log::write('error write to ---- less than '. $result.' vaule:'.var_export($value,true));
            return $result;
        }
    }
    if(isset($_cache[$name])) return $_cache[$name];
    // 获取缓存数据
    if(is_file($filename)) {
        $value   =  include $filename;
        $_cache[$name]   =   $value;
    }else{
        $value  =   false;
    }
    return $value;
}
?>