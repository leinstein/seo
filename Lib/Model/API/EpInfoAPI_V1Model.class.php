<?php

/**
 * 模型层：文章模型类 
 * 
 * @copyright   Copyright 2010-2011 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Model.Biz
 * @version     201401011
 * @link        http://www.dejax.cn
 */

class EpInfoAPI_V1Model {
	
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
	
	//企业基本信息
	public function getEpBaseList( $map){
		$model=M('dcv2_data_epreginfo',null);
		//$map['epid']=$orgcode;
		$field='epid,entername,ename,regdate,regaddress,regcapital,unit,currency,regtype,corpregnumber,corporate,epstatus';
		$data=$model->where($map)->field($field)->select();
		if($data)
			return $data;
		else
			return false;
	}
	
	/**
	 * 数据接口方法
	 * 根据用户请求发来的机构组织代码查询出企业的数据信息
	 * @access public
	 * @param string $orgcode 查询结果
	 * @return string  处理后的查询结果
	 */
	public function getEpinfo($orgcode){
		$map['epid']=$orgcode;
		$data['etpbaseinfo'] = $this -> getEpBase($map);
		if(!$data['etpbaseinfo']){
			return false; //机构组织代码不存在
		}
		
		//$data['etpbaseinfo'] = $this -> getEpBase($orgcode);
		//$data['contactinfo'] = $this -> getUnitcontact($orgcode);
		//$data['accountinfo'] = $this -> getUnitzjaccountinfo($orgcode);
		$data['financeinfo'] = $this -> getFinancereport($orgcode);
		$data['etpqualinfo'] = $this -> getEnterDeclare($orgcode);
		$data['prodqualinfo'] = $this -> getProdeclare($orgcode);
		$data['techprojectinfo'] = $this -> getProj($orgcode);
		$data['talentinfo'] = $this -> getTalent($orgcode);
		//dump($data);
		return $data;
	}
	
	//企业基本信息
	public function getEpBase( $map){
		$model=M('dcv2_data_epreginfo',null);
		//$map['epid']=$orgcode;
		$field='epid,entername,ename,regdate,regaddress,regcapital,unit,currency,regtype,corpregnumber,corporate,epstatus';
		$data=$model->where($map)->field($field)->find();
		if($data)
			return $data;
		else
			return false;
	}
	
	//企业联系信息
	public function getUnitcontact($orgcode){
		$lxmodel=M('dcv2_data_unitcontact',null);
		$lxmap['epid']=$orgcode;
		$lxfield='epid,contacts,defaultcontact,mobilephone,telephone,email,contactspost';
		$data=$lxmodel->where($lxmap)->field($lxfield)->select();
		return $data;
	}
	
	//企业账户信息
	public function getUnitzjaccountinfo($orgcode){
		$qyzhmodel=M('dcv2_data_zjaccountinfo',null);
		$qyzhmap['epid']=$orgcode;
		$qyfield='epid,type,bankname,accountapplyer,account,defaultaccount';
		$data=$qyzhmodel->where($qyzhmap)->field($qyfield)->select();
		return $data;
	}
	
	//国税财务信息
	public function getFinancereport($orgcode){
		$cwsjmodel=M('dcv2_data_gsfinancereport',null);
		$cwsjmap['organcode']=$orgcode;
		$cwsfield='year,assets,debtamount,longtermborrow,shortborrow,realitycapital,mainoperreceipt,opermargin,netmargin,unit,currency';
		$data=$cwsjmodel->where($cwsjmap)->field($cwsfield)->order('year asc')->select();
		return $data;
	}
	
	//企业资质信息
	public function getEnterDeclare($orgcode){
		$enterdeclaremodel=M('dcv2_data_enterprisesdeclareinfo',null);
		$enterdeclaremap['epid']=$orgcode;
		$enterdeclarefield='aptype,certyear,aptstatus';
		$data=$enterdeclaremodel->where($enterdeclaremap)->field($enterdeclarefield)->select();
		return $data;
	}
	
	//产品资质信息
	public function getProdeclare($orgcode){
		$prodeclaremodel=M('dcv2_data_productdeclareinfo',null);
		$prodeclaremap['epid']=$orgcode;
		$prodeclarefield='aptype,certyear,productname,aptstatus';
		$data=$prodeclaremodel->where($prodeclaremap)->field($prodeclarefield)->select();
		return $data;
	}
	
	//科技项目信息
	public function getProj($orgcode){
		$projmodel=M('dcv2_data_supprojectinfo',null);
		$projmap['epid']=$orgcode;
		$projfield='year,projectid,projectname,projectlevel,projecttype,subclass,pjstatus';
		$data=$projmodel->where($projmap)->field($projfield)->order('year asc,projecttype asc')->select();
		return $data;
	}
	
	//人才项目信息
	public function getTalent($orgcode){
		$talentmodel=M('dcv2_data_talentinfo',null);
		$talentmap['epid']=$orgcode;
		$talentfield='talentlevel,projecttype,projectclass,talentname,year';
		$data=$talentmodel->where($talentmap)->field($talentfield)->select();
		return $data;
	}
}
	
?>