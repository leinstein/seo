<?php

/**
 * 模型层：文章模型类 
 * 
 * @copyright   Copyright 2010-2011 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Model.Biz
 * @version     201401011
 * @link        http://www.dejax.cn
 */

class UloanContractInfoAPI_V1Model extends Model{
	
	protected $tableName = 'data_uloanconinfo'; 
	
	protected $patchValidate = true;
	
	//自动验证
	protected $_validate = array(
			

		//放款信息提交接口
		array('pjbusinessprojectid','require','系统项目编号不能为空'),
		array('pjbusinesscontractid','require','系统放款信息编号不能为空'),
		array('organcode','require','组织机构代码不能为空'),
		array('signentername','require','签约企业名称不能为空'),
		array('loanyear','require','放款年度不能为空'),
		array('loanyear','is_year','放款年度格式不正确!',2,'function',3), //放款年度格式验证
		array('loandate','require','放款日期不能为空'),
		array('loandate','is_date','放款日期格式不正确!',2,'function',3), //放款日期格式验证
		array('loanamount','require','放款金额不能为空'),
		array('timelimit','require','贷款期限不能为空'),
		array('expdate','require','到期日期不能为空'),
		array('expdate','is_date','到期日期格式不正确!',2,'function',3), //到期日期格式验证
		array('repaydate','require','还款日不能为空'),
		array('loanbank','require','贷款银行不能为空'),
		array('arp','require','贷款利率（%）不能为空'),
		//不含百分号验证	
		array('repaystyle','require','还款方式不能为空'),
		array('loanstatus','require','状态不能为空'),
				
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
	public function postUloanContractInfo($json){
		
		$data_UloanContractInfo = json_decode($json,true);
		
		$map['pjbusinessprojectid'] = $data_UloanContractInfo['pjbusinessprojectid'];
		$map['pjbusinesscontractid'] = $data_UloanContractInfo['pjbusinesscontractid'];
		$result_find = $this ->where($map)->find();		
		//数据是否存在验证
		if( !$result_find ){
			if ( isset($data_UloanContractInfo['pjbusinessprojectid']) == false)
				$nomeetinfo['pjbusinessprojectid'] = "系统项目编号不能为空!";
			if ( isset($data_UloanContractInfo['pjbusinesscontractid']) == false)
				$nomeetinfo['pjbusinesscontractid'] = "系统放款信息编号不能为空!";
			if ( isset($data_UloanContractInfo['organcode']) == false)
				$nomeetinfo['organcode'] = "组织机构代码不能为空!";
			if( isset($data_UloanContractInfo['signentername']) == false)
				$nomeetinfo['signentername'] = "签约企业名称不能为空!";
			if( isset($data_UloanContractInfo['loanyear']) == false)
				$nomeetinfo['loanyear'] = "放款年度不能为空!";
			if( isset($data_UloanContractInfo['loandate']) == false)
				$nomeetinfo['loandate'] = "放款日期不能为空!";
			if( isset($data_UloanContractInfo['loanamount']) == false)
				$nomeetinfo['loanamount'] = "放款金额不能为空!";
			if( isset($data_UloanContractInfo['timelimit']) == false)
				$nomeetinfo['timelimit'] = "贷款期限不能为空!";
			if( isset($data_UloanContractInfo['expdate']) == false)
				$nomeetinfo['expdate'] = "到期日期不能为空!";
			if( isset($data_UloanContractInfo['repaydate']) == false)
				$nomeetinfo['repaydate'] = "还款日不能为空!";
			if( isset($data_UloanContractInfo['loanbank']) == false)
				$nomeetinfo['loanbank'] = "贷款银行不能为空!";
			if( isset($data_UloanContractInfo['arp']) == false)
				$nomeetinfo['arp'] = "贷款利率（%）不能为空!";
			if( isset($data_UloanContractInfo['repaystyle']) == false)
				$nomeetinfo['repaystyle'] = "还款方式不能为空!";
			if( isset($data_UloanContractInfo['loanstatus']) == false)
				$nomeetinfo['loanstatus'] = "状态不能为空!";
		}
		
		if( $nomeetinfo ){
			$return['nomeetinfo'] = $nomeetinfo;
			return $return;
		}
		
		//自动验证
		$result = $this->create($data_UloanContractInfo);
		if (!$result){
			$return['nomeetinfo'] = $this->getError();
			return $return;
			//如果创建成果 表示验证成功,进行其他操作 如果创建失败 表示验证没有通过 输出错误提示信息.
		}
		$model_epdir = M('dcv2_epdir',null);
		$map_epdir['organcode'] = $data_UloanContractInfo['organcode'];
		$result_epdir = $model_epdir ->where($map_epdir) ->find();
		if( $result_find ){
			//更新操作 通过ID进行查找
			if ($result_epdir){
				$data_UloanContractInfo['epid'] = $result_epdir['id'];
			}else {
				//$data_UloanContractInfo['desc'] = $data_UloanContractInfo['desc'].'-名录表中未找到该企业';
			}
			$map['id'] =  $result_find['id'];
			$data_UloanContractInfo['moddate'] = time();
			$data_UloanContractInfo['sourceinfo'] = '数据更新';
			return $this->where($map)->save($data_UloanContractInfo);
		}else{
			//新增操作 创建新的ID(GUID)
			if ($result_epdir){
				$data_UloanContractInfo['epid'] = $result_epdir['id'];
			}else {
				//$data_UloanContractInfo['desc'] = $data_UloanContractInfo['desc'].'-名录表中未找到该企业';
			}
			$data_UloanContractInfo['sourceinfo'] = '数据新增';
			$data_UloanContractInfo['id'] = create_guid();
			return $this->add($data_UloanContractInfo);
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
