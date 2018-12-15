<?php

/**
 * 前台公共控制层测试类
 *
 * @category   业务控制类
 * @copyright   Copyright 2010-2014 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Action.Home
 * @version     20141010
 * @link        http://www.dejax.cn
 */

import('@.Org.ThinkPHPUnit.ThinkPHPUnitAction');
load('list');

class TestIndexAction extends ThinkPHPUnitAction {
	
	
	protected $_message_render = self::MESSAGE_RENDER_ECHO;
	
	/**
	 * 测试数据处理模型
	 */
	protected function _testPlan1() {
				
		$model_case = M("testcase","sys_");
		$map_case['caseid'] = array("BETWEEN", '2001,2999');
		//$map_case['status'] = 1;
		$data_case = $model_case->where($map_case)->select();
		
		//开始测试
		foreach( $data_case as $vo){
			
			//初始化被测试的程序
			$codetype = $vo['codetype'];
			if( $codetype == "Action" ){
				$obj = R($vo['initcode']);
			}else{
				$obj = D($vo['initcode']);
			}
			
			//准备数据
			if( !empty($vo['datascript']) ){
				$datascripts = split(";",$vo['datascript']);
				$model = M('');
				foreach ( $datascripts as $ko){
					if( $model ->execute($ko) === false ){
						echo "测试用例:".$vo['caseid']."数据准备失败，错误信息：".$model->getDbError();
						break;
					}
				}
			}
			
			//验证结果
			$method_name = $vo['funcname'];
			$params = json_decode($vo['inputparam'],true);
			$result = call_user_method_array($method_name, $obj, $params);
			echo '测试用例:'.$vo['caseid']." - ".$vo['caseinfo']."\n";
			//echo '数据脚本:'.$vo['datascript'];
			
			if( $vo['jagetype'] == 'noresult'){
				$model_checkResult = D("Test/UnitTest");
				if( empty($vo['assertfunc']) ){
					echo '测试用例:'.$vo['caseid']."没有输入判断检查结果的函数，无法测试！";
				}else{					
					$result = $model_checkResult->$vo['assertfunc']();
					dump($result);
					$this->assertSame($result, true, '测试用例:'.$vo['caseid'].' - 测试失败，错误原因'.$model_checkResult->getError());
					echo 'OK!';
				}
			}else{
				$expectresult = $vo['expectresult'];
				if( $expectresult != null && $expectresult != ''){
					switch ($vo['expectresulttype']) {
						case 'int':
							$expectresult = (int)$vo['expectresult'];
							break;
						case 'float':
							$expectresult = (float)$vo['expectresult'];
							break;
						case 'string':
						default:
							$expectresult = (string)$vo['expectresult'];
							break;
					}
				}
				$this->assertSame($result, $expectresult, '测试用例:'.$vo['caseid'].' - 测试失败，返回值不是'.$vo['expectresult'].'，而是'.$result);
				dump($result);dump($expectresult);echo "\n\n";
			}
			
			//清理数据
			if( !empty($vo['clearscript']) ){				
				$clearscripts = split(";",$vo['clearscript']);
				$model = M('');
				foreach ( $clearscripts as $ko){
					if( $model ->execute($ko) === false ){
						echo "测试用例:".$vo['id']."数据清理失败，错误信息：".$model->getDbError();
						break;
					}
				}
			}else{
				if( !empty($vo['datascript']) )
					echo "测试用例:".$vo['id']."有数据准备脚本，但是没有清理脚本，可能有问题.";
			}
			
		}
	}
}