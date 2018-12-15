<?php

/**
 * 挂件：统计查询 搜索 挂件
 * 
 * @copyright   Copyright 2010-2013 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Widget
 * @version     20140511
 * @link        http://www.dejax.cn
 */
class BusinessDetailWidget extends Widget{

	//渲染方法
    public function render($data){//dump($data);
    	$content = $this->renderFile($data['tplname'].'Detail',$data);
        return $content;
    } 
}
?>