<?php 
/**
 * 模型层：模型类 
 * 
 * @copyright   Copyright 2010-2016 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Model.Biz
 * @version     20160316
 * @link        http://www.dejax.cn
 */

class EpTagInfoAPI_V2Model{
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		//合并自动完成
		$this->setProperty("_auto", array_merge($this->_auto, $this->__auto));		
	}
	
	/*自动处理数据*/
	protected $__auto 		= array (
		
	);
	
	/**
	 * 数据接口方法
	 * 根据用户请求发来的企业名称查询出企业的数据信息
	 * @access public
	 * @param string $epname 查询结果
	 * @return string  处理后的查询结果
	 */
	public function getEpTagInfo($epname){
		//根据企业名称，查询企业名录表，获取企业的组织机构代码
		//初始化名录表
		$model=M('dcv2_epdir',null);
		$map_ep['epname'] = array('LIKE','%'.$epname.'%');
		$map_ep['bfname'] = array('LIKE','%'.$epname.'%');
		$map_ep['_logic'] = 'OR';
		$field = 'organcode';
		$data_orgcode = $model -> where($map_ep) -> field($field) -> find();
		$orgcode = $data_orgcode['organcode'];
		
		if($orgcode){
			//根据组织机构代码查询企业属性表，判断该企业是否为高新技术企业
			$data_eptag['isHighEp'] = $this -> getIsHighEp($orgcode);
			//根据组织机构代码查询企业属性表，判断该企业是否有国家千人
			$data_eptag['isNationThousands'] = $this -> getNationThousands($orgcode);
			//根据组织机构代码查询企业属性表，判断该企业是否为省双创人才
			$data_eptag['isEI'] = $this -> getEI($orgcode);
			//根据组织机构代码查询企业属性表，判断该企业是否为姑苏领军人才
			$data_eptag['isGusuleading'] = $this -> getGusuleading($orgcode);
			//根据组织机构代码查询企业属性表，判断该企业是否为园区领军人才
			$data_eptag['isYQleading'] = $this -> getYQleading($orgcode);
			//根据组织机构代码查询企业属性表，判断该企业是否为云计算企业
			$data_eptag['isMetaComputing'] = $this -> getMetaComputing($orgcode);
			//根据组织机构代码查询企业属性表，判断该企业是否为纳米技术应用
			$data_eptag['isNanoTechnology'] = $this -> getNanoTechnology($orgcode);
			//根据组织机构代码查询企业属性表，判断该企业是否为生物医药
			$data_eptag['isBiomedicine'] = $this -> getBiomedicine($orgcode);
			//根据组织机构代码查询企业属性表，获取企业所属街道
			$data_eptag['carrier'] = $this -> getCarrier($orgcode);
			
			return $data_eptag;
		}else{
			return false;
		}
	}
	
	/**
	 * 数据接口方法
	 * 根据企业组织机构代码查询出企业是否为国家高新技术企业
	 * @access public
	 * @param string $orgcode 企业组织机构代码
	 * @return string  处理后的查询结果
	 */
	public function getIsHighEp($orgcode){
		//初始化企业名录表
		$epproperty_model = M('dcv2_epproperty',null);
		
		//查询条件
		$map['epid'] = $orgcode;
		$map['k08'] = array('LIKE','%'.'高新技术企业,'.'%');
		$field = 'k08';
		
		//获取结果
		$data = $epproperty_model -> where($map) ->field($field) -> find();
		
		//返回数据
		if($data){
			return '是';
		}else{
			return '否';
		}
	}
	
	/**
	 * 数据接口方法
	 * 根据企业组织机构代码查询出企业是否有国家千人
	 * @access public
	 * @param string $orgcode 企业组织机构代码
	 * @return string  处理后的查询结果
	 */
	public function getNationThousands($orgcode){
		//初始化企业名录表
		$epproperty_model = M('dcv2_epproperty',null);
		
		//查询条件
		$map['epid'] = $orgcode;
		$map['k09'] = array('LIKE','%'.'国家千人计划,'.'%');
		$field = 'k09';
		
		//获取结果
		$data = $epproperty_model -> where($map) ->field($field) -> find();
		
		//返回数据
		if($data){
			return '是';
		}else{
			return '否';
		}
	}
	
	/**
	 * 数据接口方法
	 * 根据企业组织机构代码查询出企业是否有省双创人才
	 * @access public
	 * @param string $orgcode 企业组织机构代码
	 * @return string  处理后的查询结果
	 */
	public function getEI($orgcode){
		//初始化企业名录表
		$epproperty_model = M('dcv2_epproperty',null);
		
		//查询条件
		$map['epid'] = $orgcode;
		$map['k09'] = array('LIKE','%'.'江苏省高层次创新创业人才,'.'%');
		$field = 'k09';
		
		//获取结果
		$data = $epproperty_model -> where($map) ->field($field) -> find();
		
		//返回数据
		if($data){
			return '是';
		}else{
			return '否';
		}
	}
	
	/**
	 * 数据接口方法
	 * 根据企业组织机构代码查询出企业是否为姑苏领军人才
	 * @access public
	 * @param string $orgcode 企业组织机构代码
	 * @return string  处理后的查询结果
	 */
	public function getGusuleading($orgcode){
		//初始化企业名录表
		$epproperty_model = M('dcv2_epproperty',null);
		
		//查询条件
		$map['epid'] = $orgcode;
		$map['k09'] = array('LIKE','%'.'姑苏创新创业领军人才,'.'%');
		$field = 'k09';
		
		//获取结果
		$data = $epproperty_model -> where($map) ->field($field) -> find();
		
		//返回数据
		if($data){
			return '是';
		}else{
			return '否';
		}
	}
	
	/**
	 * 数据接口方法
	 * 根据企业组织机构代码查询出企业是否为园区领军人才
	 * @access public
	 * @param string $orgcode 企业组织机构代码
	 * @return string  处理后的查询结果
	 */
	public function getYQleading($orgcode){
		//初始化企业名录表
		$epproperty_model = M('dcv2_epproperty',null);
		
		//查询条件
		$map['epid'] = $orgcode;
		$map['k09'] = array('LIKE','%'.'苏州工业园区科技领军人才,'.'%');
		$field = 'k09';
		
		//获取结果
		$data = $epproperty_model -> where($map) ->field($field) -> find();
		
		//返回数据
		if($data){
			return '是';
		}else{
			return '否';
		}
	}
	
	/**
	 * 数据接口方法
	 * 根据企业组织机构代码查询出企业是否为云计算企业
	 * @access public
	 * @param string $orgcode 企业组织机构代码
	 * @return string  处理后的查询结果
	 */
	public function getMetaComputing($orgcode){
		//初始化企业名录表
		$epproperty_model = M('dcv2_epproperty',null);
		
		//查询条件
		$map['epid'] = $orgcode;
		$map['k03'] = array('LIKE','%'.'云计算'.'%');
		$field = 'k03';
		
		//获取结果
		$data = $epproperty_model -> where($map) ->field($field) -> find();
		
		//返回数据
		if($data){
			return '是';
		}else{
			return '否';
		}
	}
	
	/**
	 * 数据接口方法
	 * 根据企业组织机构代码查询出企业是否为纳米技术应用企业
	 * @access public
	 * @param string $orgcode 企业组织机构代码
	 * @return string  处理后的查询结果
	 */
	public function getNanoTechnology($orgcode){
		//初始化企业名录表
		$epproperty_model = M('dcv2_epproperty',null);
		
		//查询条件
		$map['epid'] = $orgcode;
		$map['k03'] = array('LIKE','%'.'纳米技术应用'.'%');
		$field = 'k03';
		
		//获取结果
		$data = $epproperty_model -> where($map) ->field($field) -> find();
		
		//返回数据
		if($data){
			return '是';
		}else{
			return '否';
		}
	}
	
	/**
	 * 数据接口方法
	 * 根据企业组织机构代码查询出企业是否为生物医药企业
	 * @access public
	 * @param string $orgcode 企业组织机构代码
	 * @return string  处理后的查询结果
	 */
	public function getBiomedicine($orgcode){
		//初始化企业名录表
		$epproperty_model = M('dcv2_epproperty',null);
		
		//查询条件
		$map['epid'] = $orgcode;
		$map['k03'] = array('LIKE','%'.'生物医药'.'%');
		$field = 'k03';
		
		//获取结果
		$data = $epproperty_model -> where($map) ->field($field) -> find();
		
		//返回数据
		if($data){
			return '是';
		}else{
			return '否';
		}
	}
	
	/**
	 * 数据接口方法
	 * 根据企业组织机构代码查询出企业是否为生物医药企业
	 * @access public
	 * @param string $orgcode 企业组织机构代码
	 * @return string  处理后的查询结果
	 */
	public function getCarrier($orgcode){
		//初始化企业名录表
		$epproperty_model = M('dcv2_epproperty',null);
		
		//查询条件
		$map['epid'] = $orgcode;
		$map['k02'] = array('LIKE','%街道%');
		$field = 'k02';
		
		//获取结果
		$data = $epproperty_model -> where($map) ->field($field) -> find();
		
		//返回数据
		if($data['k02']){
			return $data['k02'];
		}else{
			return "其他";
		}
	}
}
?>