<?php

/**
 * 模型层：文章模型类 
 * 
 * @copyright   Copyright 2010-2011 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Model.Biz
 * @version     201401011
 * @link        http://www.dejax.cn
 */

class LjztProInfoAPI_V1Model extends Model{
	
	protected $tableName = 'data_ljztinvestproinfo'; 
	
	protected $patchValidate = true;
	
	//自动验证
	protected $_validate = array(
			
		//直投信息提交接口
		array('pjbusinessid','require','系统项目编号不能为空！'),
		array('entername','require','企业名称不能为空！'),
		array('organcode','require','组织机构代码不能为空！'),
		array('investyear','require','投资年度不能为空！'),
		array('investsum','require','跟投总额不能为空！'),
		array('stake','require','跟投股权份额(%)不能为空！'),
		array('maorgname','require','主投资方不能为空！'),
		array('unit','require','单位不能为空！'),
		array('currency','require','币种不能为空！'),
		array('pjstatus','require','状态不能为空！'),

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
	 * 审批信息提交接口
	 * 根据用户请求发来的机构组织代码,向接口地址提交用户名、密码、业务数据，服务器响应请求，并返回处理结果
	 * @access public
	 * @param string api_userid:接口调用者的用户名，由管理员分配,api_userpass:接口调用者的密码，用来验证访问身份，需要使用des加密,bizinfo=[json格式字符串]数据内容
	 * @return string  处理后的查询结果
	 */
	public function postLjztProInfo($json){
		
		$data_LjztProInfo = json_decode($json,true);
		
		$map['pjbusinessid'] = $data_LjztProInfo['pjbusinessid'];
		$result_find = $this ->where($map)->find();		
		//数据是否存在验证
		if( !$result_find ){
			if ( isset($data_LjztProInfo['pjbusinessid']) == false )
				$nomeetinfo['pjbusinessid'] = "系统项目编号不能为空!";
			if ( isset($data_LjztProInfo['entername']) == false )
				$nomeetinfo['entername'] = "企业名称不能为空!";
			if ( isset($data_LjztProInfo['organcode']) ==false)
				$nomeetinfo['organcode'] = "组织机构代码不能为空!";
			if( isset($data_LjztProInfo['investyear']) ==false)
				$nomeetinfo['investyear'] = "投资年度不能为空!";
			if( isset($data_LjztProInfo['investsum']) ==false)
				$nomeetinfo['investsum'] = "投资总额不能为空!";
			if( isset($data_LjztProInfo['stake']) ==false)
				$nomeetinfo['stake'] = "跟投股权份额(%)不能为空!";
			if( isset($data_LjztProInfo['maorgname']) ==false)
				$nomeetinfo['maorgname'] = "直投机构不能为空!";
			if( isset($data_LjztProInfo['unit']) ==false)
				$nomeetinfo['unit'] = "单位不能为空!";
			if( isset($data_LjztProInfo['currency']) ==false)
				$nomeetinfo['currency'] = "币种不能为空!";
			if( isset($data_LjztProInfo['pjstatus']) ==false)
				$nomeetinfo['pjstatus'] = "状态不能为空!";
		}
		
		if( $nomeetinfo ){
			$return['nomeetinfo'] = $nomeetinfo;
			return $return;
		}
		
		//自动验证
		$result = $this->create($data_LjztProInfo);
		if (!$result){
			$return['nomeetinfo'] = $this->getError();
			return $return;
			//如果创建成果 表示验证成功,进行其他操作 如果创建失败 表示验证没有通过 输出错误提示信息.
		}
		$model_epdir = M('dcv2_epdir',null);
		$map_epdir['organcode'] = $data_LjztProInfo['organcode'];
		$result_epdir = $model_epdir ->where($map_epdir) ->find();
		if( $result_find ){
			//更新操作 通过ID进行查找
			if ($result_epdir){
				$data_LjztProInfo['epid'] = $result_epdir['id'];
				
			}else {
				$data_LjztProInfo['desc'] = $data_LjztProInfo['desc'].'-名录表中未找到该企业';
			}
			$map['id'] =  $result_find['id'];
			$data_LjztProInfo['moddate'] = time();
			return $this->where($map)->save($data_LjztProInfo);
		}else{
			//新增操作 创建新的ID(GUID)
			if ($result_epdir){
				$data_LjztProInfo['epid'] = $result_epdir['id'];
				
			}else {
				$data_LjztProInfo['desc'] = $data_LjztProInfo['desc'].'-名录表中未找到该企业';
			}
			$data_LjztProInfo['id'] = create_guid();
			return $this->add($data_LjztProInfo);
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
	