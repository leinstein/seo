<?php

/**
 * 模型层：文章模型类 
 * 
 * @copyright   Copyright 2010-2011 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Model.Biz
 * @version     201401011
 * @link        http://www.dejax.cn
 */

class UloanContractRepayInfoAPI_V1Model extends Model{
	
	protected $tableName = 'data_uloanconinfo'; 
	
	protected $patchValidate = true;
	
	//自动验证
	protected $_validate = array(

		//放款信息提交接口
		array('pjbusinessprojectid','require','系统项目编号不能为空'),
		array('pjbusinesscontractid','require','系统放款信息编号不能为空'),
		array('haverepay','require','已还本金不能为空'),
		array('loanover','require','贷款余额不能为空'),
				
	); 
	
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
	 * 提交统贷放款信息
	 * 根据用户请求发来的机构组织代码,向接口地址提交用户名、密码、业务数据，服务器响应请求，并返回处理结果
	 * @access public
	 * @param string api_userid:接口调用者的用户名，由管理员分配,api_userpass:接口调用者的密码，用来验证访问身份，需要使用des加密,bizinfo=[json格式字符串]数据内容
	 * @return string  处理后的查询结果
	 */
	public function UloanContractRepayInfo($json){
		
		$data_UloanContractRepayInfo = json_decode($json,true);
		
		//自动验证
		$result = $this->create($data_UloanContractRepayInfo);
		if (!$result){
			$return['nomeetinfo'] = $this->getError();
			return $return;
			//如果创建成果 表示验证成功,进行其他操作 如果创建失败 表示验证没有通过 输出错误提示信息.
		}
		//查询对应的放款信息
		
		$map['pjbusinessprojectid'] = $data_UloanContractRepayInfo['pjbusinessprojectid'];
		$map['pjbusinesscontractid'] = $data_UloanContractRepayInfo['pjbusinesscontractid'];
		
		$result_find = $this ->where($map)->find();
		
		if( $result_find ){
			if($result_find['id']){
				$map['id'] =  $result_find['id'];
				return $this->where($map)->save($data_UloanContractRepayInfo);
			}else {
				$this->error = '未查询到对应的放款信息!';
				return false;
			}
		}else {
			$this->error = '数据处理失败!';
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
