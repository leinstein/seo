<?php
/**
 * 企业端通知控制层类
 *
 * @copyright   Copyright 2010-2014 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Service
 * @version     20141010
 * @type		project
 * @link        http://www.mitong.com
 */

class NotifyAction extends BaseAction {
	
	//公共函数，不接受权限检查，写法 array('index');
	public $public_functions = array('index');
	
	/**
	 * 初始化函数
	 * @access public
	 */
	public function _initialize() {
		//继承
		parent::_initialize();
		
		$this->modelName = "Notify/Notify";
	}
	
	/**
	 * 首页
	 * @access public
	 */
	public function index() {
		//初始化模型
		$model =  D( $this -> modelName );
		
		//获得查询结果
		$list = $model -> get( $map );
		
		$page['list'] = $list;
		
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
				
			// 移动端数据渲染模板
			$tpl_data = 'tpl/'. $tpl;
				
			$page['tpl'] = $tpl_data;
		}
		
		// 输出模板
		$this -> assign( $page);
		 
		$this -> display( $tpl );
	}
	
	/**
	 * 根据通知中的内容进行跳转
	 * @access public
	 */
	public function goUrl() {
		//通知id
		$id = $_GET['id'];
		
		//调用模型
		$model_notify = D( $this->modelName );
		$notify = $model_notify -> readOne($id);
		$url = $this->rootUrl . $notify['gourl'];
		header("location:".$url);
	}
	
	/**
	 * Ajax - 设置当前通知为已读
	 * @access public
	 */
	public function readOne() {
		//通知id
		$id = $_GET['id'];
		
		//调用模型
		$model_notify = D( $this->modelName );
		$result = $model_notify -> readOne($id);
		if( $result ){
			$this->success("读取成功!");
		}else{
			$this->error("读取失败！");
		}
	}
	
	/**
	 * Ajax - 获得当前未读消息的个数
	 * @access public
	 */
	public function getNewCount() {
			
		//调用模型
		$model_notify = D( $this->modelName );
		$result = $model_notify -> getNewCount( $this->loginUserId);
		if( $result ){
			$this->success($result);
		}else{
			$this->error("0");
		}
	}
}