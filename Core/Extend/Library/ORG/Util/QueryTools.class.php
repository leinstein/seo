<?php 
/**
 * 模型层 综合查询的工具类
 *
 * @copyright  Copyright  @DEJAX 2010-2015(www.dejax.cn)
 * @package    Model
 * @version    20150901
 * @link       http://www.dejax.cn
 * @author     Jn Wu
 */
class QueryTools{

	/**
	 * map条件
	 *
	 * @access protected
	 * @var array
	 */
	protected $map = array();

	/**
	 * 查询的字符串
	 *
	 * @access protected
	 * @var string 
	 */
	protected $url_params;

	/**
	 * 返回的url字符串
	 *
	 * @access protected
	 * @var string 
	 */
	protected $page_params;

	/**
	 * 返回的排序条件
	 *
	 * @access protected
	 * @var array 
	 */
	protected $order = array();

	/**
	 * 增加排序条件
	 * @param $param 参数
	 * @param $condition map条件
	 * @return null
	 */
	public function addParam($param = null ,$field, $exp = null){
		if( $field && $exp ){
			$con[$field] = $exp;
			$this->map = array_merge($this->map, $con);
		}
		$this->url_params .= ','.$param;
		$this->page_params .= "&".$param."=" . $_GET[$param];
	}

	/**
	 * 增加联合查询排序参数
	 * @param $param 参数
	 * @param $param_value order值
	 * @return null
	 */
	public function addOrder($param = null ,$param_value = null){
		$this->orders[$param] = $param_value;
		if(strstr('ord',$this->url_params)){
			$this->url_params .= ','.'ord';
		}else
			return ;
	}

	/**
	 * 增加联合查询默认排序
	 *
	 * @param $param_value 默认排序order值
	 * @return null
	 */
	public function addDefOrder($param_value){
		$this->orders['__Default__'] = $param_value;
		if(strstr('ord',$this->url_params)){
			$this->url_params .= ','.'ord';
		}else
			return ;
	}

	/**
	 * 判断参数值是否为空或者为'不限'('%')
	 *
	 * @param $param 查询的参数
	 * @return mixed true/false
	 */
	public function paramExist($param){
		//去掉空格
		//$_GET[$param] = trim($_GET[$param]);
		if($_GET[$param] == '' || $_GET[$param] == '%'){
			$this->url_params .= ','.$param;
			$this->page_params .= '&'.$param.'='.$_GET[$param];
			return false;
		}else 
			return true;
	}

	/**
	 * @return 返回$map
	 */
	public function getMap(){
		
		return $this->map;
	}

	/**
	 * @return 返回查询的字符串
	 */
	public function getUrlparam(){
		return combo_url_param($this->url_params);
	}

	/**
	 * @return 返回url字符串
	 */
	public function getPageparam(){
		return $this->page_params;		
	}

	/**
	 * @return 返回排序参数
	 */
	public function getOrder(){
		//判断排序参数值是否为空或者为'不限'('%')
		if( $_GET['ord'] and $_GET['ord']!='%' )
           		return $this->orders[$_GET['ord']];
        	else
            	return $this->orders['__Default__'];
	}

}

 ?>
