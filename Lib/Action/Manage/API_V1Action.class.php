<?php

/**
 * 资金系统数据接口控制类
 *
 * @category	业务控制类
 * @package    fundmanage.Action.Manage
 * @copyright  Copyright 2010-2014 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @version    20141126
 * @link       http://www.dejax.cn 
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
	public function receiveKeywordsRank(){
		Log::write("============================== 关键词检测接口调试 ==============================");
		$modelKeyworddetectrecord 	= D('Biz/Keyworddetectrecord');
		Log::write("------------------------------ 原始数据POST：".json_encode($_POST));
		Log::write("------------------------------ 原始数据REQUEST：".json_encode($_REQUEST));
		$token 		= $_POST['token'];
		$task_id	= $_POST['task_id'];
		$keywords	= $_POST['keywords'];
		$type		= $_POST['type'];
		$rank		= $_POST['rank'];
		$url		= $_POST['url'];
		
		$token 		= $_REQUEST['token'];
		$task_id	= $_REQUEST['task_id'];
		$keywords	= $_REQUEST['keywords'];
		$type		= $_REQUEST['type'];
		$rank		= $_REQUEST['rank'];
		$url		= $_REQUEST['url'];
		
		//没有任务ID
		if( !$task_id ){
			$return['ret'] 		= -1;
			$return['message'] 	= '任务ID为空';
			exit(json_encode( $return ));
		}
		
		// 查询搜索任务
		$data = $modelKeyworddetectrecord -> selectOne( array('id' => $task_id ));
	
		//判断$token是否相同
		if( $token != $data['token']){
			$return['ret'] 		= -1;
			$return['message'] 	= 'token校验不正确';
			exit(json_encode( $return ));
		}
		
		switch ($type) {
			case 1:
				$data['rankbaidu']= $rank;
			break;
			case 2:
				$data['rankbaidumobile']= $rank;
			break;
			case 3:
				$data['rank360']= $rank;
			break;
			case 4:
				$data['ranksougou']= $rank;
			break;
			case 5:
				$data['rankshenma']= $rank;
			break;	
			default:
				$data['rankbaidu']= $rank;
			break;
		}
		
		$result = $modelKeyworddetectrecord -> where( array('id' => $task_id ) ) -> save($data); 
		//if( $result ){
			$return['ret'] 		= 1;
			$return['message'] 	= '成功';
			exit(json_encode( $return ));
		//}
		

	}
	
}