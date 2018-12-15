<?php
/**
 * 项目公共函数库 
 *
 * @copyright   Copyright 2010-2014 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Common
 * @version     20141006
 * @link        http://www.dejax.cn
 */


/**
 * 把返回的标准数据集转换成树结构的数组
 *
 * @param array $list 要转换的数据集
 * @param string $pk 主键字段名称
 * @param string $pid 父节点字段名称
 * @param string $child 子节点字段名称
 * @param string $root 如果等于0表示父节点 
 *  
 * @return array 树结构
 */
function list_to_tree($list, $pk='id',$pid = 'pid',$child = '_child',$root=0)
{
    // 创建Tree
    $tree = array();
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 对查询结果集进行排序
 * 
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型，asc正向排序 desc逆向排序 nat自然排序
 * 
 * @return array 排序后的结果
 */
function list_sort_by($list,$field, $sortby='asc') {
   if(is_array($list)){
       $refer = $resultSet = array();
       foreach ($list as $i => $data)
           $refer[$i] = &$data[$field];
       switch ($sortby) {
           case 'asc': // 正向排序
                asort($refer);
                break;
           case 'desc':// 逆向排序
                arsort($refer);
                break;
           case 'nat': // 自然排序
                natcasesort($refer);
                break;
       }
       foreach ( $refer as $key=> $val)
           $resultSet[] = &$list[$key];
       return $resultSet;
   }
   return false;
}

/**
 * 在数据列表中搜索
 * 
 * @param array $list 数据列表
 * @param mixed $condition 查询条件， 支持 array('name'=>$value) 或者 name=$value
 * 
 * @return array 搜索后的结果
 */
function list_search($list,$condition) {
    if(is_string($condition))
        parse_str($condition,$condition);
    // 返回的结果集合
    $resultSet = array();
    foreach ($list as $key=>$data){
        $find   =   false;
        foreach ($condition as $field=>$value){
            if(isset($data[$field])) {
                if(0 === strpos($value,'/')) {
                    $find   =   preg_match($value,$data[$field]);
                }elseif($data[$field]==$value){
                    $find = true;
                }
            }
        }
        if($find)
            $resultSet[]     =   &$list[$key];
    }
    return $resultSet;
}

/**
 * 将界面POST数据中的数组结构转换为便于存储的数据结构
 *
 * 界面POST数据结构
 * 	$_POST['id'] = array( [0]=>"1", [1]=>"2", [2]=>"3" )
 * 	$_POST['busregno'] = array( [0]=>"200101", [1]=>"200102", [2]=>"200103" ) * 
 * 经过初步转换获得：
 * array( 
 *      [0] => array( 'pid'=>"1", 'name'=>"200101" ),	
 *      [1] => array( 'pid'=>"2", 'name'=>"200102" ),	
 *      [2] => array( 'pid'=>"3", 'name'=>"200103" )
 *      )
 *      
 * @param $postdata 提交数据
 * @param $fields 需要进行转换的字段列表，一般采用逗号分隔，例如：id, username
 * @param $keyField 关键字段，如果该字段为空，则此行不进行转换
 * @return 转换结果
 */	
function post_to_list( $postdata, $fields, $keyField ) {
	//字段列表
	$fieldarray = split(',', $fields);
	
	//循环$postdata
	for( $i = 0; $i < count($postdata[$keyField]); $i ++) {
		//设置交易列表字段
		if( trim( $postdata[$keyField][$i] ) != "" and trim( $postdata[$keyField][$i] ) != "" ) {
			foreach( $fieldarray as $vo ){
				if( $vo != "" )
					$return[$i][$vo]	=	$postdata[$vo][$i];
			}
		}
	}
	
	return $return;
}

/**
 * 将查询结果转换为代码集格式
 *
 * @param array $list 需要处理的数据集
 * @param array $first 能够加载数据集前面的数组
 * @return array 处理后的代码集
 */
function list_to_codeset($list, $first = null ){
	$data 		= array();
		
	foreach( $list as $vo ){
		$i = 0;
		foreach( $vo as $key=>$val ) {
			if( $i == 0 )
				$f = $val;
			if( $i == 1 )
				$data["$f"] = $val;
			if( $i > 1 )
				break;
			$i++;
		}
	}	
	
	if ( $first ){
		return $first + $data;
	}else
		return $data;
}

?>