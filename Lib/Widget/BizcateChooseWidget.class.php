<?php

/**
 * 挂件：分类表bizcate下拉查询挂件
 * 参数：
 *           queryfield 需要进行分类查询的字段；
 *           urlbefore 要放在分类查询字段前面的url 
 *           default 表示选择的文字
 *           treename 表示要选择的树
 *           treetype 表示树的类型
 *           rootnodepath 表示选择的根节点
 *           
 * 调用：{:w('BizcateChoose', array( 'queryfield'=>'prjtype', 'urlbefore'=>__URL__.'/index','default' =>'选择资金类型','treename' =>'科技资金v1','rootnodepath' =>'/科技资金','treetype' =>'科技业务分类',))}
 * 
 * @copyright   Copyright 2010-2013 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Widget
 * @version     20130226
 * @link        http://www.dejax.cn
 */
class BizcateChooseWidget extends Widget{

	//渲染方法
    public function render($data){
    	//默认值    	
    	$data['urlbefore'] = $data['urlbefore']?$data['urlbefore']:__URL__.'/index';
    	$data['treetype'] = $data['treetype']?$data['treetype']:'科技业务分类';
    	$data['default'] = $data['default']?$data['default']:'选择类型';
    	$data['rootnodepath'] = $data['rootnodepath']?$data['rootnodepath']:'';
    	
    	//分类条件
    	$model_cate = D("Biz/Bizcate");
    	$data_cate = $model_cate->getTreeNodes($data['treename'], $data['treetype'], $data['rootnodepath'],'yes',null,true);
    	$data['bizcate'] = $data_cate;
    	
        return $this->renderFile('BizcateChoose',$data);
    } 
}
?>