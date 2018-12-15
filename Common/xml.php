<?php
/**
 * 项目公共函数库 - XML处理相关
 *
 * @copyright   Copyright 2010-2014 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Common
 * @version     20141006
 * @link        http://www.dejax.cn
 */

/**
 * 将 simpleXML 类型的元素转换为数组，包括属性和其他元素.
 * You can choose to get your elements either flattened, or stored in a custom index that
 * you define.
 * For example, for a given element
 * <field name="someName" type="someType"/>
 * if you choose to flatten attributes, you would get:
 * $array['field']['name'] = 'someName';
 * $array['field']['type'] = 'someType';
 * If you choose not to flatten, you get:
 * $array['field']['@attributes']['name'] = 'someName';
 * Repeating fields are stored in indexed arrays. so for a markup such as:
 * <parent>
 * <child>a</child>
 * <child>b</child>
 * <child>c</child>
 * </parent>
 * you array would be:
 * $array['parent']['child'][0] = 'a';
 * $array['parent']['child'][1] = 'b';
 * ...And so on.
 * 
 * @param simpleXMLElement $xml the XML to convert
 * @param boolean $flattenValues    Choose wether to flatten values or to set them under a particular index. defaults to true;
 * @param boolean $flattenAttributes Choose wether to flatten attributes or to set them under a particular index. Defaults to true;
 * @param boolean $flattenChildren    Choose wether to flatten children  or to set them under a particular index.Defaults to true;
 * @param string $valueKey            index for values, in case $flattenValues was set to false. Defaults to "@value"
 * @param string $attributesKey        index for attributes, in case $flattenAttributes was set to false. Defaults to "@attributes"
 * @param string $childrenKey        index for children, in case $flattenChildren was set to false. Defaults to "@children"
 * @return array the resulting array.
 */
function simpleXMLToArray($xml,  $flattenValues=true, $flattenAttributes = true, $flattenChildren=true, $valueKey='@value',	$attributesKey='@attributes', $childrenKey='@children'){
	$return = array();
	if(!($xml instanceof SimpleXMLElement)){return $return;}
	$name = $xml->getName();
	$_value = trim((string)$xml);
	if(strlen($_value)==0){$_value = null;};

	if($_value!==null){
		if(!$flattenValues){$return[$valueKey] = $_value;}
		else{$return = $_value;}
	}

	$children = array();
	$first = true;
	foreach($xml->children() as $elementName => $child){
		$value = simpleXMLToArray($child, $flattenValues, $flattenAttributes, $flattenChildren, $valueKey, $attributesKey, $childrenKey);
		if(isset($children[$elementName])){
			if($first){
				$temp = $children[$elementName];
				unset($children[$elementName]);
				$children[$elementName][] = $temp;
				$first=false;
			}
			$children[$elementName][] = $value;
		}
		else{
			$children[$elementName] = $value;
		}
	}
	if(count($children)>0){
		if(!$flattenChildren){$return[$childrenKey] = $children;}
		else{$return = array_merge($return,$children);}
	}

	$attributes = array();
	foreach($xml->attributes() as $name=>$value){
		$attributes[$name] = trim($value);
	}
	if(count($attributes)>0){
		if(!$flattenAttributes){$return[$attributesKey] = $attributes;}
		else{$return = array_merge($return, $attributes);}
	}
	
	return $return;
}

/**
 * 利用XML字段对应配置将界面数组转换为存储XML结构
 *
 * 例子，
 * 界面POST数据 
 * 	$_POST['id'] = array( [0]=>"1", [1]=>"2", [2]=>"3" )
 * 	$_POST['busregno'] = array( [0]=>"200101", [1]=>"200102", [2]=>"200103" )
 * 经过transPostArray函数初步转换获得：
 * array( 
 *      [0] => array( 'pid'=>"1", 'name'=>"200101" ),	
 *      [1] => array( 'pid'=>"2", 'name'=>"200102" ),	
 *      [2] => array( 'pid'=>"3", 'name'=>"200103" )
 *      )
 * 转换配置：
 * array(
 * 		'id' 			=> array('caption'=>'自动编号','datatype'=>'int','fieldname'=>'id'),
 * 		'busregno' 		=> array('caption'=>'企业注册号','datatype'=>'string','fieldname'=>'busregno'),
 *      )
 * 转换后：
 * 		<?xml version='1.0' encoding='utf-8'?>
 * 		<record>
 * 			<id caption='自动编号' datatype='int' fieldname='id'>1</id>	
 * 			<busregno caption='企业注册号' datatype='string' fieldname='busregno'>200101</busregno>	 
 * 		</record>
 * 		<record>
 * 			<id caption='自动编号' datatype='int' fieldname='id'>2</id>	
 * 			<busregno caption='企业注册号' datatype='string' fieldname='busregno'>200102</busregno>	 
 * 		</record>
 * 		<record>
 * 			<id caption='自动编号' datatype='int' fieldname='id'>3</id>	
 * 			<busregno caption='企业注册号' datatype='string' fieldname='busregno'>200103</busregno>	 
 * 		</record>
 *
 * @param array  $array 输入数组
 * @ram array $arrayConfig 数组配置
 * @param string $valueKey 值域名字
 * @param boolean $addRoot 是否增加根节点
 * @param boolean $noHeader 没有头部
 * @return string XML格式字符串.
 */
function dataArrayToXML( $array, $arrayConfig = null, $valueKey = '@value', $addRoot = false, $noHeader = false ) {
	if( $noHeader == false )
		$xmlStr = "<?xml version='1.0' encoding='utf-8'?>\n";
	if( (count($array) > 1) or ($addRoot) )
		$xmlStr = $xmlStr . "<dataset>\n";
		
	//遍历数组
	foreach( $array as $val1 ){
		$xmlStr = $xmlStr . "	<record>\n";
		foreach( $val1 as $key2 => $val2 ){
			$xmlStr = $xmlStr . "		<" . $key2;
			//如果是数组
			if( is_array($val2) ){
				foreach( $val2 as $key3 => $val3 ){
					if( $key3 != $valueKey )
						$xmlStr = $xmlStr . $key3 . "='" . $val3 . "'";
				}
				$xmlStr = $xmlStr . ">" . $val2[$valueKey];
			}else{
				if( $arrayConfig[$key2] ) {
					$xmlStr = $xmlStr . " caption='" . $arrayConfig[$key2]['caption']  . "'";
					$xmlStr = $xmlStr . " datatype='" . $arrayConfig[$key2]['datatype']  . "'";
					$xmlStr = $xmlStr . " fieldname='" . $arrayConfig[$key2]['fieldname']  . "'";
					$xmlStr = $xmlStr . " visible='" . $arrayConfig[$key2]['visible']  . "'";
				}
				$xmlStr = $xmlStr . ">" . $val2;
			}
			
			$xmlStr = $xmlStr . "</" . $key2 . ">\n";
		}
		$xmlStr = $xmlStr . "	</record>\n";
	}
	
	if( (count($array) > 1) or ($addRoot) )
		$xmlStr = $xmlStr . "</dataset>\n";	
		
	return $xmlStr;
}
?>