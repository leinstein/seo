<?php

/**
 * 模型层：文章模型类 
 * 
 * @copyright   Copyright 2010-2011 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Model.Biz
 * @version     201401011
 * @link        http://www.dejax.cn
 */

class ContactInfoAPI_V1Model extends Model{
	
	Protected $autoCheckFields = false;
	
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
	 * 企业联系信息查询以及数据整理(批量查询)
	 *
	 * @param
	 * @return string 数据处理标志
	 * @author Erdong
	 */
	public function getContactInfos($orgcode){
		
		$model_data = M('dcv2_data_unitcontact',null);
		$map['organcode'] = $orgcode;
		$data_ContactInfo = $model_data ->where($map)->select();
		
		foreach ($data_ContactInfo as $k => &$vo){
			$data[$k]['id'] = $vo['id'];
			$data[$k]['orgcode'] = $vo['organcode'];
			$data[$k]['contactname'] = $vo['contacts'];
			$data[$k]['mobilephone'] = $vo['mobilephone'];
			$data[$k]['telephone'] = $vo['telephone'];
			$data[$k]['email'] = $vo['email'];
			$data[$k]['contactspost'] = $vo['contactspost'];
			$data[$k]['contacttags'] = $vo['contacttags'];
			$data[$k]['contactnotes'] = $vo['contactnotes'];
			$data[$k]['activetime'] = $vo['contactsactivetime'];
			
		}
		
		return $data;
	}
	/**
	 * 企业联系信息查询以及数据整理(单笔查询)
	 *
	 * @param
	 * @return string 数据处理标志
	 * @author Erdong
	 */
	public function getContactInfo($orgcode,$id){
	
		$model_data = M('dcv2_data_unitcontact',null);
		$map['organcode'] = $orgcode;
		$map['id'] = $id;		
		$data_ContactInfo = $model_data ->where($map)->find();
		
		if( $data_ContactInfo ){
			$data['id'] = $data_ContactInfo['id'];
			$data['orgcode'] = $data_ContactInfo['organcode'];
			$data['contactname'] = $data_ContactInfo['contacts'];
			$data['mobilephone'] = $data_ContactInfo['mobilephone'];
			$data['telephone'] = $data_ContactInfo['telephone'];
			$data['email'] = $data_ContactInfo['email'];
			$data['contactspost'] = $data_ContactInfo['contactspost'];
			$data['contacttags'] = $data_ContactInfo['contacttags'];
			$data['contactnotes'] = $data_ContactInfo['contactnotes'];
			$data['activetime'] = $data_ContactInfo['contactsactivetime'];
			
			return $data;
		}else{
			$this ->error = '数据查询失败';		
			return false;
		}
	}
	/**
	 * 企业联系信息新增以及数据整理
	 *
	 * @param
	 * @return string 数据处理标志
	 * @author Erdong
	 */
	public function postContactInfo($Contactinfo){
		
		if(  trim($Contactinfo['orgcode']) == "" ){
			$this->error = "企业组织机构代码不能为空!";
			return false;
		}
		if(  trim($Contactinfo['contactname']) == "" ){
			$this->error = "联系人姓名不能为空!";
			return false;
		} 
		/*if(  trim($Contactinfo['mobilephone']) == "" and trim($Contactinfo['telephone']) == ""){
			$this->error = "联系人移动电话或企业联系电话至少一项不能为空!";
			return false;
		} */
		if(  trim($Contactinfo['mobilephone']) == ""){
			$this->error = "联系人移动电话不能为空!";
			return false;
		} 
		$model_data = M('dcv2_data_unitcontact',null);
		
		$data['id'] = create_guid();
		$data['organcode'] = $Contactinfo['orgcode'];
		$data['contacts'] = $Contactinfo['contactname'];
		$data['mobilephone'] = $Contactinfo['mobilephone'];
		$data['telephone'] = $Contactinfo['telephone'];
		$data['email'] = $Contactinfo['email'];
		$data['contactspost'] = $Contactinfo['contactspost'];
		$data['contacttags'] = $Contactinfo['contacttags'];
		$data['contactnotes'] = $Contactinfo['contactnotes'];
		$data['contactsactivetime'] = time();
		
		$map['contacts'] = $Contactinfo['contactname'];
		$map['mobilephone'] = $Contactinfo['mobilephone'];
		$mapdata = $model_data -> where($map) -> select();
		if($mapdata){
			$this->error = "该联系人已存在!";
			return false;
		}else{
			$result = $model_data ->add($data);
			if ($result){
				return $result;
			}else {
				$this->error = "数据新增失败!";
				return false;
			}
		}
	}
	/**
	 * 企业联系信息更新以及数据整理
	 *
	 * @param
	 * @return string 数据处理标志
	 * @author Erdong
	 */
	public function editContactInfo($Contactinfo){
	
		$model_data = M('dcv2_data_unitcontact',null);
		
		if(  trim($Contactinfo['id']) == "" ){
			$this->error = "联系人ID不能为空!";
			return false;
		}
		if(  trim($Contactinfo['contactname']) == "" ){
			$this->error = "联系人姓名不能为空!";
			return false;
		}
		/*if(  trim($Contactinfo['mobilephone']) == "" or trim($Contactinfo['telephone']) == ""){
			$this->error = "联系人移动电话或企业联系电话不能为空!";
			return false;
		}*/
		if(  trim($Contactinfo['mobilephone']) == ""){
			$this->error = "联系人移动电话不能为空!";
			return false;
		}
		
		$map['id'] = $Contactinfo['id'];
		$map['organcode'] = $Contactinfo['orgcode'];
		
		if( isset($Contactinfo['contactname']) )
			$data['contacts'] = $Contactinfo['contactname'];
		if( isset($Contactinfo['mobilephone']) )
			$data['mobilephone'] = $Contactinfo['mobilephone'];
		if( isset($Contactinfo['telephone']) )
			$data['telephone'] = $Contactinfo['telephone'];
		if( isset($Contactinfo['email']) )
			$data['email'] = $Contactinfo['email'];
		if( isset($Contactinfo['contactspost']) )
			$data['contactspost'] = $Contactinfo['contactspost'];
		if( isset($Contactinfo['contacttags']) )
			$data['contacttags'] = $Contactinfo['contacttags'];
		if( isset($Contactinfo['contactnotes']) )
			$data['contactnotes'] = $Contactinfo['contactnotes'];
		if( isset($Contactinfo['activetime']) )
			$data['contactsactivetime'] = time();
	
		$result = $model_data ->where($map)->save($data);
		if ($result){
			return $map['id'];
		}else {
			$this->error = "数据修改失败!";
			return false;
		}
	
	}
	/**
	 * 企业联系信息删除
	 *
	 * @param
	 * @return string 数据处理标志
	 * @author Erdong
	 */
	public function deleteContactInfo($orgcode,$id){
		
		$model_data = M('dcv2_data_unitcontact',null);
		
		$map['id'] = $id;
		$map['organcode'] = $orgcode;
		
		$result = $model_data -> where($map) ->delete();
		if ($result){
			return $result;
		}else {
			return false;
		}
		
	}
	/**
	 * 用户验证
	 *
	 * @param
	 * @return string 数据处理标志
	 * @author zhangss
	 */
	public function userValidate($api_userid, $api_userpasswd){
		$deb = L('FUND_INTERFACE_DEBUG');
		if($deb['status']=='debug'){
			if($api_userid == $deb['userid'] && $api_userpasswd ==$deb['userpass'])
				return true;
		}
		$api_user_model    = M('dcv2_api_user',null);
		$map['userid']     = $api_userid;
		$map['userpasswd'] = $api_userpasswd;
		$user              = $api_user_model->where($map)->find();
		if($user)
			return $user;
		return false;
	}
}

?>