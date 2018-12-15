<?php
/**
 * 项目公共函数库 - 显示处理
 *
 * @copyright   Copyright 2010-2014 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Common
 * @version     20141006
 * @link        http://www.dejax.cn
 */
 
/**
 * 将某一个字符串里面的关键字标红色
 * 
 * @param $text 目标字符串
 * @param $keyword 关键字
 * @param $color 标记的颜色
 * @return string 返回标记后的结果
 */
function tag_text($text, $keyword, $color = 'red'){ 
	$keyword = trim($keyword);
    return str_replace( $keyword, "<font color='" . $color . "'>" . $keyword . "</font>", $text); 
}


/**
* 对包含了代码集的数据集进行批量的代码集转换
* 
* 比如查询出的结果里面有用户编号，此函数可以批量的把用户编号变为用户名，支持用户编号是多个，必须用逗号分隔。
* 
* @param array $datalist 被转换的标准数据集合
* @param string $fieldname 需要转换的字段名
* @param array $codeset 代码集数组，一般是array([1]=>'user1', [2]=>'user2')的形式；
* @return array 转换后的结果集合
*/
function trans_codeset($datalist, $fieldname, $codeset){
	//循环转换数据
	foreach( $datalist as &$vo ){
		$vals = split(",", $vo[$fieldname]);
		$val = '';
		foreach( $vals as $ko ){
			if( !empty($ko) ){
				$ko = $codeset[$ko];
				$val = $val . $ko . ',';
			}
		}
		$vo[$fieldname] = $val;
	}
	//返回处理结果
	return $datalist;
}

/**
 * 从页面变量或者语言包里面获得代码值的显示内容，模板常用方法
 * 
 * 例如,"10" 代表 "女", 那么调用方法：get_codename("10", "sexoptions")，比如有一个字段是sex，常用的方法是{$vo.sex|get_codename='sexoptions'}
 *
 * @param string $codevalue 代码值，支持逗号分隔如10, 20
 * @param string $codetype 代码类型
 * @return string 代码名称
 */
function get_codename($codevalue,$codetype){
	//根据代码类型获得代码集
	if( !is_array($codetype) )
		$codeData = L($codetype);
	else
		$codeData = $codetype;

	$arr = explode(',',$codevalue);

	if(!empty($codeData)){
		foreach($arr as $ak=>$av){
			$toValue = $toValue.'，'.$codeData[$av];
		}
	}

	if($toValue!=""){
		$toValue = substr($toValue, 3);
		if( strpos($toValue, "，") !== false )
			$toValue = trim($toValue, "，");
	}

	//返回
	return $toValue;

}
?>