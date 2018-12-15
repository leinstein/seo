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
	public function receiveKeywordsRank(){
		Log::write("============================== 关键词检测接口调试 ==============================");
		$modelKeyword 	= D('Biz/Keyword');
		$modelKeyworddetectrecord 	= D('Biz/Keyworddetectrecord');
		Log::write("------------------------------ 原始数据POST：".json_encode($_POST));
		//Log::write("------------------------------ 原始数据REQUEST：".json_encode($_REQUEST));
		//Log::write("------------------------------ input：".json_encode(file_get_contents("php://input")));
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
		
		// 没有任务ID
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
		
		//判断$token是否相同
		if( $keywords != $data['keyword']){
			$return['ret'] 		= -1;
			$return['message'] 	= '关键词校验不正确';
			exit(json_encode( $return ));
		}
		
// 		switch ($type) {
// 			case 1:
// 				$data['rankbaidu']= $rank;
// 			break;
// 			case 2:
// 				$data['rankbaidumobile']= $rank;
// 			break;
// 			case 3:
// 				$data['rank360']= $rank;
// 			break;
// 			case 4:
// 				$data['ranksougou']= $rank;
// 			break;
// 			case 5:
// 				$data['rankshenma']= $rank;
// 			break;	
// 			default:
// 				$data['rankbaidu']= $rank;
// 			break;
// 		}
		$record['rank']= $rank;
		$result = $modelKeyworddetectrecord -> where( array('id' => $task_id ) ) -> save($record); 
		
		//同时向对应的关键词中写入排名
		$kw['id'] = $data['keywordid'];
		$kw['latestranking'] = $rank;
		$kw['detectiondate'] = date('Y-m-d H:i:s');
		// 如果关键词达标
		if( $rank == 10 ){
			$kw['standarddate'] 	= date('Y-m-d H:i:s');
			$kw['standardstatus'] 	= '已达标'; 
			$kw['freezefunds'] 		= array('exp', "price * 30" );
			$kw['latestconsumption'] = array('exp', "price" );
			$kw['totalconsumption'] = array('exp', "price" ); 
			$kw['standarddays'] 	= 1;
			
		}
		$result = $modelKeyword -> update($kw);
		Log::write($modelKeyword -> _sql());
		
		$return['ret'] 		= 1;
		$return['message'] 	= '成功';
		exit(json_encode( $return ));
	}
	
}