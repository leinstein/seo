<?php

/**
 * 模型层：文章模型类 
 * 
 * @copyright   Copyright 2010-2011 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Model.Biz
 * @version     201401011
 * @link        http://www.dejax.cn
 */

class AccountInfoAPI_V1Model extends Model{
	
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
	/**
	 * 企业账户信息查询以及数据整理(批量查询)
	 *
	 * @param
	 * @return string 数据处理标志
	 * @author Erdong
	 */
	public function getAccountInfos($orgcode){
		
		$model_data = M('dcv2_data_zjaccountinfo',null);
		$map['organcode'] = $orgcode;
		$data_AccountInfo = $model_data ->where($map)->select();
		
		foreach ($data_AccountInfo as $k => &$vo){
			$data[$k]['id'] = $vo['id'];
			$data[$k]['type'] = $vo['type'];
			$data[$k]['bankname'] = $vo['bankname'];
			$data[$k]['accountapplyer'] = $vo['accountapplyer'];
			$data[$k]['account'] = $vo['account'];
		}
		return $data;
	}
	/**
	 * 企业账户信息查询以及数据整理(单笔查询)
	 *
	 * @param
	 * @return string 数据处理标志
	 * @author Erdong
	 */
	public function getAccountInfo($orgcode,$id){
	
		$model_data = M('dcv2_data_zjaccountinfo',null);
		$map['organcode'] = $orgcode;
		$map['id'] = $id;		
		$data_AccountInfo = $model_data ->where($map)->find();
		
		if( $data_AccountInfo ){
			$data['id'] = $data_AccountInfo['id'];
			$data['type'] = $data_AccountInfo['type'];
			$data['bankname'] = $data_AccountInfo['bankname'];
			$data['accountapplyer'] = $data_AccountInfo['accountapplyer'];
			$data['account'] = $data_AccountInfo['account'];
			
			return $data;
		}else{		
			$this->error = "数据查询失败!";
			return false;
		}
	}
	/**
	 * 企业账户信息新增以及数据整理
	 *
	 * @param
	 * @return string 数据处理标志
	 * @author Erdong
	 */
	public function postAccountInfo($AccountInfo){
		
		if(  trim($AccountInfo['orgcode']) == "" ){
			$this->error = "企业组织机构代码不能为空!";
			return false;
		}
		if(  trim($AccountInfo['type']) == "" ){
			$this->error = "账户类型不能为空!";
			return false;
		}
		if(  trim($AccountInfo['bankname']) == "" ){
			$this->error = "开户行不能为空!";
			return false;
		}
		if(  trim($AccountInfo['accountapplyer']) == "" ){
			$this->error = "开户名不能为空!";
			return false;
		}
		if(  trim($AccountInfo['account']) == "" ){
			$this->error = "账户不能为空!";
			return false;
		}
		$model_data = M('dcv2_data_zjaccountinfo',null);
		
		$data['id'] = create_guid();
		$data['organcode'] = $AccountInfo['orgcode'];
		if ($AccountInfo['type'] == '1'||$AccountInfo['type'] == '监管账户'){	
			$data['type'] = '监管账户';
		}else {
			$data['type'] = '普通账户';
		}
		$data['bankname'] = $AccountInfo['bankname'];
		$data['accountapplyer'] = $AccountInfo['accountapplyer'];
		$data['account'] = $AccountInfo['account'];
		
		$map['account'] = $AccountInfo['account'];
		$mapdata = $model_data -> where($map) -> select();
		if($mapdata){
			$this->error = "该账号已存在!";
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
	 * 企业账户信息更新以及数据整理
	 *
	 * @param
	 * @return string 数据处理标志
	 * @author Erdong
	 */
	public function editAccountInfo($AccountInfo){
	
		$model_data = M('dcv2_data_zjaccountinfo',null);
		
		if(  trim($AccountInfo['orgcode']) == "" ){
			$this->error = "企业组织机构代码不能为空!";
			return false;
		}
		if(  trim($AccountInfo['id']) == "" ){
			$this->error = "账户编号不能为空!";
			return false;
		}
		if(  trim($AccountInfo['type']) == "" ){
			$this->error = "账户类型不能为空!";
			return false;
		} 
		if(  trim($AccountInfo['bankname']) == "" ){
			$this->error = "开户行不能为空!";
			return false;
		}
		if(  trim($AccountInfo['accountapplyer']) == "" ){
			$this->error = "开户名不能为空!";
			return false;
		}
		if(  trim($AccountInfo['account']) == "" ){
			$this->error = "账户不能为空!";
			return false;
		}
		
		
		$map['id'] = $AccountInfo['id'];
		$map['organcode'] = $AccountInfo['orgcode'];
		
		if( isset($AccountInfo['type']) )
			if ($AccountInfo['type'] == '1'||$AccountInfo['type'] == '监管账户'){	
					$data['type'] = '监管账户';
				}else {
					$data['type'] = '普通账户';
				}
		if( isset($AccountInfo['bankname']) )
			$data['bankname'] = $AccountInfo['bankname'];
		if( isset($AccountInfo['accountapplyer']) )
			$data['accountapplyer'] = $AccountInfo['accountapplyer'];
		if( isset($AccountInfo['account']) )
			$data['account'] = $AccountInfo['account'];
	
		$result = $model_data ->where($map)->save($data);
		if ($result){
			return $map['id'];
		}else {
			$this->error = "数据修改失败!";
			return false;
		}
	
	}
	/**
	 * 企业账户信息删除
	 *
	 * @param
	 * @return string 数据处理标志
	 * @author Erdong
	 */
	public function deleteAccountInfo($orgcode,$id){
		
		$model_data = M('dcv2_data_zjaccountinfo',null);
		
		$map['id'] = $id;
		$map['organcode'] = $orgcode;
		
		$result = $model_data -> where($map) ->delete();
		if ($result){
			return $result;
		}else {
			return false;
		}
		
	}
	
}

?>