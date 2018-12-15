<?php

/**
 * 资金系统数据接口控制类
 *
 * @category	业务控制类
 * @package    fundmanage.Action.Manage
 * @copyright  Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @version    20141126
 * @link       http://www.mitong.com 
 */

class API_V1Action {
	
	/**
	 * 初始化函数
	 * @access public
	 */
	public function _initialize() {
		//继承
		parent::_initialize();
	}
	
	/**
	 * 提交资金申请信息-资金申请单笔提交接口
	 *
	 * @return string 资金申请信息处理结果
	 * @author zhangss
	 */
	public function postFundAppInfo(){
		$model = D("Biz/API_V1");
		$fundmodel = D('Biz/Fundingplan');
		$vali = $model->userValidate( $_POST['api_userid'], $_POST['api_userpass'] );
		
		if($vali){
			$data['fundapplication']['sourceappid']       = $_POST['sourceappid'];
			$data['fundapplication']['sourceappsys']      = $_POST['sourceappsys'];
			$data['fundapplication']['fundingplanid']     = $_POST['fundingplanid'];
			//if($data['fundapplication']['fundingplanid']=='-1')
				//$data['fundapplication']['fundingplanid'] = $fundmodel->getCurPlanid();
			$data['fundapplication']['businesstypeid']    = $_POST['businesstypeid'];
			$data['fundapplication']['applyamount']       = $_POST['applyamount'];
			$data['fundapplication']['approvedamount']    = $_POST['approvedamount'];
			$data['fundapplication']['applydate']         = $_POST['applydate'];
			$data['fundapplication']['applicant']         = $_POST['applicant'];
			$data['fundapplication']['applicanttype']     = $_POST['applicanttype'];
			$data['fundapplication']['appcerttype']       = $_POST['appcerttype'];
			$data['fundapplication']['appcertno']         = $_POST['appcertno'];
			$data['fundapplication']['applicantsourceid'] = $_POST['applicantsourceid'];
			$data['fundapplication']['accountapplyer']    = $_POST['accountapplyer'];
			$data['fundapplication']['bankname']          = $_POST['bankname'];
			$data['fundapplication']['account']           = $_POST['account'];
			$data['fundapplication']['accounttype']       = $_POST['accounttype'];
			$data['fundapplication']['contacts']          = $_POST['contacts'];
			$data['fundapplication']['mobilephone']       = $_POST['contactphone1'];
			$data['fundapplication']['telephone']         = $_POST['contactphone2'];
			$data['fundapplication']['email']             = $_POST['contactemail'];
			$data['fundapplication']['contactaddr']       = $_POST['contactaddr'];
			$data['fundapplication']['enterprisename']    = $_POST['orgname'];
			$data['fundapplication']['enterpriseguid']    = $_POST['orgcode'];
			$data['fundapplication']['delayflag']         = $_POST['delayflag'];
			$data['fundapplication']['attach']         	  = $_POST['attach'];
			if($_POST['delayflag']=='是')
				$data['fundapplication']['linkid']        = $_POST['linkid'];
			$data['fundapplication']['remarks']           = $_POST['memo'];
			$data['budgetinfo']                           = json_decode($_POST['budgetinfo'],true);
			$data['budgetdetailinfo']                     = json_decode($_POST['budgetdetailinfo'],true);
			$data['bizinfo']                              = json_decode($_POST['bizinfo'],true);
			
			//add 增加申请单的业务阶段、业务状态、业务流程和节点
			if($_POST['businesstypeid']=='SRC101101'){ //重大招商
				$data['fundapplication']['stagenum'] 			= 101;
				$data['fundapplication']['stagename'] 			= '中心审批';
				$data['fundapplication']['nodenum'] 			= 1002;
				$data['fundapplication']['nodename'] 			= '中小中心';
				$data['fundapplication']['pronum'] 				= 101;
				$data['fundapplication']['proname'] 			= '资金申请审批';
				$data['fundapplication']['businessstatus'] 		= '审批中';
				$data['fundapplication']['approvalconclusion'] 	= '';
			}
			if($_POST['businesstypeid']=='SRC101102'){ //创业创新
				$data['fundapplication']['fundingplanid']		= 0;//拨付计划编号默认为0
				$data['fundapplication']['stagenum'] 			= 105;
				$data['fundapplication']['stagename'] 			= '收据收取';
				$data['fundapplication']['nodenum'] 			= 1001;
				$data['fundapplication']['nodename'] 			= '申请人';
				$data['fundapplication']['pronum'] 				= 103;
				$data['fundapplication']['proname'] 			= '收据收取';
				$data['fundapplication']['businessstatus'] 		= '待确认打印';
				$data['fundapplication']['approvalconclusion'] 	= 'approved';
			}
			if(strstr($_POST['businesstypeid'],'SRC1210010')){ //知识产权
				//将附件信息放到业务说明大字段中
				$businessdescription = array();
				$businessdescription['data']['attachinfo']      = json_decode( $_POST['attach'],true );
				$data['fundapplication']['businessdescription'] = urldecode(json_encodeEOL(urlencodeAry( $businessdescription )));
				
				$data['fundapplication']['stagenum'] 			= 102;
				$data['fundapplication']['stagename'] 			= '科技局（处室）审批';
				$data['fundapplication']['nodenum'] 			= 1003;
				$data['fundapplication']['nodename'] 			= '科技局处室';
				$data['fundapplication']['pronum'] 				= 101;
				$data['fundapplication']['proname'] 			= '资金申请审批';
				$data['fundapplication']['businessstatus'] 		= '审批中';
				$data['fundapplication']['approvalconclusion'] 	= 'approved';
			}
			
			echo json_encode($model->postFundData( $data, $_POST['refused'] )); //对资金申请信息的入库处理
			//dump($model->postFundData($data));
		}else
			echo json_encode($model->dataEncapsulated('9','身份验证不通过'));
	}
	
	/**
	 * 提交资金申请信息-资金申请批量提交接口
	 *
	 * @return string 资金申请信息处理结果
	 * @author zhangss
	 */
	public function postFundAppInfos(){
		$model = D("Biz/API_V1");
		$vali  = $model->userValidate( $_POST['api_userid'], $_POST['api_userpass'] );
		
		if(!$vali)
			exit(json_encode($model->dataEncapsulated('9','身份验证不通过')));
		
		/*//验证“外部系统标识代码”、“拨付计划编号”、“业务类型代码”不为空
		if($_POST['refused']){
			if(!$_POST['sourceappsys'] || !$_POST['businesstypeid'])
				exit(json_encode($model->dataEncapsulated('1','提交的数据无效，必须提交外部系统标识代码、业务类型代码')));
		}else{
			if(!$_POST['sourceappsys'] || !$_POST['businesstypeid'] || !$_POST['fundingplanid'])
				exit(json_encode($model->dataEncapsulated('1','提交的数据无效，必须提交外部系统标识代码、业务类型代码、拨付计划编号')));
		}*/
		
		log::write('欧索提交的房租批量数据：'.$_POST['fundappinfos']);
		
		//验证$_POST['fundappinfos']数据不为空
		$allData = json_decode($_POST['fundappinfos'],true);
		if(!$allData){
			exit(json_encode($model->dataEncapsulated('1','提交的资金申请信息无效，数据为空')));
		}else{
			foreach ($allData as &$val) {
				$val['budgetinfo']       = json_decode($val['budgetinfo'],true);
				$val['budgetdetailinfo'] = json_decode($val['budgetdetailinfo'],true);
				$val['bizinfo']          = json_decode($val['bizinfo'],true);
			}
		}
		
		//验证数据有效性
		foreach ($allData as $key => $value) {
			$valiResult = $model->rentDataValidate( $value, $value['refused'], $_POST['sourceappsys'], $_POST['fundingplanid'], $_POST['businesstypeid'] );
			$valiResultCode = json_encode($valiResult);
			log::write('第'.++$key.'条记录数据有效性验证结果：'.$valiResultCode);
			log::write('第'.$key.'条记录数据有效性验证报错：'.$valiResult['ErrorMsg']); 
			
			if ($valiResult['ErrorCode']!='0') { 
				$valiResult['ErrorMsg'] = '第'.$key.'个申请单错误提示：'.$valiResult['ErrorMsg']; //错误提示
				exit(json_encode($valiResult));
			}
		}
		
		//数据入库
		$fundIds  = array();
		foreach ($allData as $key => $value) {
			//对资金申请信息的入库处理
			$result = $model->postFundData( $value, $value['refused'], true, $_POST['sourceappsys'], $_POST['fundingplanid'], $_POST['businesstypeid'] );
			
			$error['ErrorCode'] = $result['ErrorCode'];
			$error['ErrorMsg']  = $result['ErrorMsg'];
			
			if ($result['ErrorCode']=='0') {  //记录已入库申请单id
				$fundIds[$key] = array_merge(array('sourceappid'=>$value['sourceappid']), $result['ResultData']);
			}else{ //未正常入库
				$error['ErrorMsg'] = '第'.++$key.'个申请单错误提示：'.$result['ErrorMsg']; //修改错误提示
				if($fundIds){ //数据回滚
					foreach ($fundIds as $fundId) {
						M("fm_fundapplication",null)->where('iid='.$fundId['fundappid'])->delete(); //回滚资金申请表
						M("fm_fundapplicationdetail",null)->where('fundapplicationid='.$fundId['fundappid'])->delete(); //回滚资金申请明细表
				
						$budgetId = M("fm_budgetbook",null)->where('fundapplicationid='.$fundId['fundappid'])->getField('iid');
						if($budgetId){
							M("fm_budgetbook",null)->where('iid='.$budgetId)->delete(); //回滚预算表
							M("fm_budgetbookdetail",null)->where('budgetbookid='.$budgetId)->delete(); //回滚预算明细表
						}
					}
				}
				break;
			}
		}
		$error['ResultData'] = $fundIds; //返回ResultData为sourceappid和fundappid(退回申请单再提交，只返回sourceappid)
		if ($error['ErrorCode']!='0') //处理失败时，返回ResultData为null
			$error['ResultData'] = null;
		
		echo json_encode($error);
		//dump($error);
	}
	
	/**
	 * 预算书单笔提交接口
	 *
	 * @return string 预算书信息处理结果
	 * @author zhangss
	 */
	public function postBudgetInfo(){
		$model = D("Biz/API_V1");
		$vali = $model->userValidate( $_POST['api_userid'], $_POST['api_userpass'] );
		
		if($vali){
			$data['budgetinfo']       = json_decode($_POST['budgetinfo'],true);
			$data['budgetdetailinfo'] = json_decode($_POST['budgetdetailinfo'],true);
			echo json_encode($model->postBudgetData($data, $_POST['sourceappid'], $_POST['sourceappsys'], $_POST['fundingplanid'])); //对预算书信息的入库处理
			//dump($model->postBudgetData($data, $_POST['sourceappid'], $_POST['sourceappsys'], $_POST['fundingplanid']));
		}else
			echo json_encode($model->dataEncapsulated('9','身份验证不通过'));
	}
	
	/**
	 * 获取资金审批信息
	 *
	 * @return string 资金审批数据
	 * @author zhangss
	 */
	public function getFundReviewInfo(){
		$model = D("Biz/API_V1");
		$vali = $model->userValidate( $_POST['api_userid'], $_POST['api_userpass'] );
		
		if($vali)
			echo json_encode($model->getFundReviewData(false, $_POST['fundappid'], $_POST['sourceappid'], $_POST['sourceappsys'], $_POST['fundingplanid'])); //获取数据
			//dump($model->getFundReviewData(false, $_POST['fundappid'], $_POST['sourceappid'], $_POST['sourceappsys'], $_POST['fundingplanid']));
		else
			echo json_encode($model->dataEncapsulated('9','身份验证不通过'));
	}
	
	/**
	 * 获取执行中的资金拨付计划信息
	 *
	 * @return string 资金拨付计划数据
	 * @author zhangss
	 */
	public function getFundPlanInfo(){
		//$model = D("Biz/API_V1");
		//$data = $model ->transportReviewResult('125644,222543');dump($data);exit; //测试推送资金审批结果通知
		//$data = $model ->transportRentReviewResult('fundingplanid', 'applicant', 'applicantsourceid', 'approvednode', 'basedfunding', 'approvalopinion', 'approvalresult', array('1001','1002'));dump($data);exit; //测试推送房租业务资金审批退回消息
		//$data = $model ->transportBudgetInfo('sourceappid', 'sourceappsys', 'approvalopinion');dump($data);exit; //测试推送预算书调整通知
		//$data = $model ->transportBudgetReviewResult('125644,222543');dump($data);exit; //测试推送预算书审批结果通知
		$model = D("Biz/API_V1");
		$vali = $model->userValidate( $_POST['api_userid'], $_POST['api_userpass'] );
		
		if($vali)
			echo json_encode($model->getFundPlanData( $_POST['businesstypeid'] )); //获取数据
			//dump($model->getFundPlanData());
		else
			echo json_encode($model->dataEncapsulated('9','身份验证不通过'));
	}
	
	/**
	 * 更新明细
	 *
	 * @author zhangss
	 * @version 20150410
	 */
	public function up(){
		$_GET['typeid'] = '12100102';
		set_time_limit(0);
		//$map['_string'] = "id between ".$_GET['s']." and ".$_GET['e'];
	
		//if($_GET['typeid']=='12100102'){  //专利授权资助
			//echo '当前操作：更新“专利授权资助”明细的大字段信息！<br>';
			//$result = M('temp_zscqjl_sq',null)->field('id,sourceappid,patentno,patentname,patenttype,grantdate,annualfee,ismultiperson,hasagent,agentorg,agentname,memo,remarks')->where(1)->select();
			//echo M('temp_zscqjl_sq',null)->getLastSql().'<br>';
		//}
		//if($_GET['typeid']=='12100101'){ //申请
			//echo '当前操作：更新“专利申请资助”明细的大字段信息！<br>';
			//$result = M('temp_zscqjl_sq',null)->field('id,sourceappid,patentno,patentname,patenttype,acceptdate,ismultiperson,hasagent,agentorg,agentname,memo,remarks')->where(1)->select();
		//}
	
		if(!$result)
			exit('查询临时表里的明细信息失败！');
	
		echo '查询到临时表里有 '.count($result).' 条明细记录<br>';
	
		foreach($result as $k => $v){
			if($_GET['typeid']=='12100102') //专利授权资助
				$detail = $this->makeAuthorizeDataStruc($v);
			if($_GET['typeid']=='12100101') //申请
				$detail = $this->makeApplyDataStruc($v);
				
			$detail['moduser'] = 'up';
			$detail['modtime'] = time();
	
			$mapFundDetail = array();
			$mapFundDetail['businessoriginalsummary'] = array('like','%"patentno":"'.$v['patentno'].'"%');
	
			$detailId = M('fm_fundapplicationdetail',null)->field('iid')->where($mapFundDetail)->find();
				
			/*//查询授权的重复明细
				$detailId = M('fm_fundapplicationdetail',null)->field('iid')->where($mapFundDetail)->select();
			if(count($detailId)>1){
			$i++;
			echo json_encode($detailId).'<br>';
			}*/
				
			if($detailId){
				$updateResult = M('fm_fundapplicationdetail',null)->where($mapFundDetail)->save($detail);
				if($updateResult)
					echo '将临时表里的第 '.$v['id'].' 条记录 更新到 申请明细表的第 '.$detailId['iid'].' 条记录 成功！<br>';
				else
					echo '更新申请明细表的第 '.$detailId['iid'].' 条明细记录 失败！<br>';
			}else
				echo '临时表里的第'.$v['id'].'条记录在申请明细表里 不存在！<br>';
		}//echo $i++;
	}
	
	/**
	 * 提交资金申请信息-专利授权明细数据结构
	 *
	 * @param  array  $v_patentauthorize 待处理数据
	 * @return array  符合要求结构的数据
	 * @author zhangss
	 * @version 20150410
	 */
	public function makeAuthorizeDataStruc($v_patentauthorize){
		$businessoriginalsummary = array();
		$businessoriginalinfo = array();
		$detail = array();
	
		$businessoriginalsummary['data']['patentno'] = $v_patentauthorize['patentno'];
		$businessoriginalsummary['data']['patentname'] = $v_patentauthorize['patentname'];
		$businessoriginalsummary['data']['patenttype'] = $v_patentauthorize['patenttype'];
		$businessoriginalsummary['data']['grantdate'] = $v_patentauthorize['grantdate'];
		$businessoriginalsummary['data']['annualfee'] = $v_patentauthorize['annualfee'];
		$businessoriginalsummary['data']['ismultiperson'] = $v_patentauthorize['ismultiperson'];
		$businessoriginalsummary['data']['hasagent'] = $v_patentauthorize['hasagent'];
		$businessoriginalsummary['data']['agentorg'] = $v_patentauthorize['agentorg'];
		$businessoriginalsummary['data']['agentname'] = $v_patentauthorize['agentname'];
	
		$businessoriginalinfo[0]['title'] = '专利授权资助';
		$businessoriginalinfo[0]['data']['patentno'] = $v_patentauthorize['patentno'];
		$businessoriginalinfo[0]['data']['patentname'] = $v_patentauthorize['patentname'];
		$businessoriginalinfo[0]['data']['patenttype'] = $v_patentauthorize['patenttype'];
		$businessoriginalinfo[0]['data']['grantdate'] = $v_patentauthorize['grantdate'];
		$businessoriginalinfo[0]['data']['annualfee'] = $v_patentauthorize['annualfee'];
		$businessoriginalinfo[0]['data']['ismultiperson'] = $v_patentauthorize['ismultiperson'];
		$businessoriginalinfo[0]['data']['hasagent'] = $v_patentauthorize['hasagent'];
		$businessoriginalinfo[0]['data']['agentorg'] = $v_patentauthorize['agentorg'];
		$businessoriginalinfo[0]['data']['agentname'] = $v_patentauthorize['agentname'];
		$businessoriginalinfo[0]['data']['memo'] = $v_patentauthorize['memo'];
		$businessoriginalinfo[0]['data']['remarks'] = $v_patentauthorize['memo'];
	
		$detail['businessoriginalsummary'] = json_encode($businessoriginalsummary);
		$detail['businessoriginalinfo']    = json_encode($businessoriginalinfo);
	
		$detailarraysumdesc['displaymod'] 		= 'list'; //多记录显示
		$detailarrayinfodesc['displaymod'] 		= 'list'; //多记录显示
		$detailarraysumdesc['config'] 			= L('PatentAuthorizeSummaryOptions'); //有项目内容要显示。如产品类，有项目内容为软件产品的
		$detailarrayinfodesc['config'] 			= L('PatentAuthorizeInfoOptions'); //有项目内容要显示。如产品类，有项目内容为软件产品的
		$businessoriginalsummary['desc'] 		= $detailarraysumdesc;//
		$businessoriginalinfo[0]['desc'] 		= $detailarrayinfodesc;//
	
		$detail['businessoriginalsummary'] = urldecode(json_encodeEOL(urlencodeAry( $businessoriginalsummary )));
		$detail['businessoriginalinfo']    = urldecode(json_encodeEOL(urlencodeAry( $businessoriginalinfo )));
	
		return $detail;
	}
	
	/**
	 * 提交资金申请信息-专利申请明细数据结构
	 *
	 * @param  string $pid_apply 资金系统申请信息主键
	 * @param  array  $v_patentapply 待处理数据
	 * @return array  符合要求结构的数据
	 * @author zhangss
	 */
	public function makeApplyDataStruc($v_patentapply){
		$businessoriginalsummary = array();
		$businessoriginalinfo = array();
		$detail = array();
	
		$businessoriginalsummary['data']['patentno'] = $v_patentapply['patentno'];
		$businessoriginalsummary['data']['patentname'] = $v_patentapply['patentname'];
		$businessoriginalsummary['data']['patenttype'] = $v_patentapply['patenttype'];
		$businessoriginalsummary['data']['acceptdate'] = $v_patentapply['acceptdate'];
		$businessoriginalsummary['data']['ismultiperson'] = $v_patentapply['ismultiperson'];
		$businessoriginalsummary['data']['hasagent'] = $v_patentapply['hasagent'];
		$businessoriginalsummary['data']['agentorg'] = $v_patentapply['agentorg'];
		$businessoriginalsummary['data']['agentname'] = $v_patentapply['agentname'];
	
		$businessoriginalinfo[0]['title'] = '专利申请资助';
		$businessoriginalinfo[0]['data']['patentno'] = $v_patentapply['patentno'];
		$businessoriginalinfo[0]['data']['patentname'] = $v_patentapply['patentname'];
		$businessoriginalinfo[0]['data']['patenttype'] = $v_patentapply['patenttype'];
		$businessoriginalinfo[0]['data']['acceptdate'] = $v_patentapply['acceptdate'];
		$businessoriginalinfo[0]['data']['ismultiperson'] = $v_patentapply['ismultiperson'];
		$businessoriginalinfo[0]['data']['hasagent'] = $v_patentapply['hasagent'];
		$businessoriginalinfo[0]['data']['agentorg'] = $v_patentapply['agentorg'];
		$businessoriginalinfo[0]['data']['agentname'] = $v_patentapply['agentname'];
		$businessoriginalinfo[0]['data']['memo'] = $v_patentapply['memo'];
		$businessoriginalinfo[0]['data']['remarks'] = $v_patentapply['memo'];
	
	
		$detailarraysumdesc['displaymod'] 		= 'list'; //多记录显示
		$detailarrayinfodesc['displaymod'] 		= 'list'; //多记录显示
		$detailarraysumdesc['config'] 			= L('PatentApplySummaryOptions'); //有项目内容要显示。如产品类，有项目内容为软件产品的
		$detailarrayinfodesc['config'] 			= L('PatentApplyInfoOptions'); //有项目内容要显示。如产品类，有项目内容为软件产品的
		$businessoriginalsummary['desc'] 		= $detailarraysumdesc;//
		$businessoriginalinfo[0]['desc'] 		= $detailarrayinfodesc;//
	
		$detail['businessoriginalsummary'] = urldecode(json_encodeEOL(urlencodeAry( $businessoriginalsummary )));
		$detail['businessoriginalinfo']    = urldecode(json_encodeEOL(urlencodeAry( $businessoriginalinfo )));
	
		return $detail;
	}
}