<?php
/**
 * 项目公共函数库 - 数组相关
 *
 * @copyright   Copyright 2010-2014 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Common
 * @version     20141006
 * @link        http://www.dejax.cn
 */
 
/**
* 根据映射关系将数组中的字段下标转化为字段名称。
* 
* 该函数对两个数组的键做了判断，如果只是简单的组合请采用PHP自带的函数array_combine。
* keys：转化数组。如：array('a' => 'green', 'b' =>'blue')                                                             
* vals: 映射关系。如：array('a' => '绿色',  'b' => '蓝色' )
* 返回结果：array('green' =>'绿色', 'blue'=>'蓝色')
* 
* @param array $keys 被转化的数组
* @param array $vals 映射关系
* @return array 组合后的结果 
*/
function array_combine2($keys, $vals){
	//循环映射关系
	foreach($vals as  $key => $val){
	    //如果该值存在，则
		if(!empty($keys[$key])){
			//新增数组元素
			$keys[$val] = $keys[$key];
			//删除对应的数组元素
			unset($keys[$key]);
		}
	}
	return $keys;
}

/**
 * 求一个数组中字符串元素长度的最大值
 * 
 * @param array $arr 数组
 * @return int 最大值
 */
function maxlen_in_array($arr){
	//获得所有的值			
	$vals = array_values($arr);
	//求值的长度
	foreach( $vals as $key => $vo )
		$k[$key] = mb_strlen($vo, "utf-8");
	//求最大值	
	return max($k);
}

/**
 * 扩展函数，可以将数组转换为json格式，解决系统函数转换后的编码问题
 * 
 * @param array $array 目标数组
 * @return string 转换后的结果
 */
function ex_json_encode($array) {
	//替换数组
	static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
	//替换特殊字符串，避免汉字转码之后，\u3c44 被替换成 u3c44
	return str_replace($jsonReplaces[0], $jsonReplaces[1], json_encode($array) );
}


/**
 * 删除数组特定值的元素
 * 
 * @param array $arr 目标数组
 * @param string $delval 删除元素的值
 * @return array 删除后的结果
 */
function clear_array($arr, $delval = "") {
	foreach($arr as $key=>$val){
		if( $val == $delval )
			unset($arr[$key]);
	}
	return $arr;
}
?>