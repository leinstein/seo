<?php 
/**
 *===================================================================================================
 * if($data['type'] != 'category')
 *
 * 挂件：联合查询条件选择挂件
 * 参数：
 *           queryfield 需要进行分类查询的字段
 *	paramname 查询的参数名
 *           urlparams 要放在分类查询字段前面的url 
 *           caption 条件标题
 *           options 表示配置文件中的参数层级
 *           type 选择类型
 *
 * 调用： {:W('QueryParam',array('caption'=>'园区已配套金额','queryfield'=>'parkhavematchtotal','paramname'=>'p01','urlparams'=>$urlparams,'options'=>'techproject|p01','type'=>'single'))}
 *
 *===================================================================================================
 * elseif($data['type'] == 'category')
 *
 * 挂件：分类表bizcate下拉查询挂件
 * 参数：
 *           queryfield 需要进行分类查询的字段；
 *           urlparams 要放在分类查询字段前面的url 
 *           default 表示选择的文字
 *			 type 选择类型
 *
 * 调用：{:W('QueryParam',array('treedata'=>$data_bizcate,'queryfield'=>'d01','urlparams'=>$urlparams,'default'=>'选择项目类型','type'=>'category'))}
 *
 *===================================================================================================
 * @copyright   Copyright 2010-2015 @DEJAX (www.dejax.cn)
 * @package     Widget
 * @version     20150905
 * @link        http://www.dejax.cn
 * @author      Jn Wu
 */
class QueryParamWidget extends Widget{

	/**
	 * 渲染方法
	 *@param $data 挂件传入的数组
	 *@return $content 传出挂件模板的
	 */
	public function render($data){
		//分类表bizcate下拉查询
		if($data['type'] == 'category'){
			//传入data处理
			$data['paramname'] = $data['paramname']?$data['paramname']:__URL__.'/index';
			$data['default']   = $data['default']?$data['default']:'选择'.$data['caption'];
			$data['options']   = $data['options']?$data['options']:'';
			$data['output']    = '_index';
			//得到业务分类树结构
		}else{//联合查询条件选择挂件
			//传入data处理
			$data['queryfield'] = $data['queryfield']?$data['queryfield']:'';
			$data['paramname']  = $data['paramname']?$data['paramname']:'';
			$data['urlparams']  = $data['urlparams']?$data['urlparams']:'';
			$data['caption']    = $data['caption']?$data['caption']:'';
			$data['options']    = $data['options']?$data['options']:'';
			$data['type']   	= ($data['type'] == 'multi')?'multi':'single';
			$data['output']		= '';
		}
		//根据传入的index选择渲染模版
		$content =  $this -> renderfile('QueryParam'.$data['output'],$data);
		return $content;
	}
}

?>