<?php
/**
 * 前台公共控制层类：购物车控制类
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Service
 * @version     20170425
 * @link        http://www.mitong.com
 */
class CartAction extends BaseAction {
	
	/*
	 * 公共函数，不接受权限检查，写法 array('index');
	 */
	public $public_functions = array();
	
	/**
	 * 初始化函数
	 * 
	 * @return void
	 */
	public function _initialize() {
		//继承
		parent::_initialize();
		
		$this->modelName = "Biz/Cart";
	}
	
	
	
	
	/**
	 * 显示页面
	 * @accesspublic
	 */
	public function index(){
		
		$model = D( $this->modelName );
		
		$modelSite = D('Biz/Site');
	
		$list = $model -> getKeywords();
		$this -> assign('list', $list);
		
		//获取我的全部的站点
		$sites  = $modelSite -> getMySitesAll( );

		foreach ($sites as $vo ){
			$sitesOptions[$vo['id']] = $vo['website'];
		}
		$this -> assign('sitesOptions', $sitesOptions);
		
		// 判断该用户的代理商是否开通了OE，并且是否设置相关的信息
		$me = $this ->  loginUserInfo;
		
		if( $me['oem_config']['id'] ){
			
			// 获取该代理商设置的服务条款
			
			$news = D('Biz/News') -> getProtocolByUserid( $me['pid']);
			$this -> assign('news', $news);
		}
		
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );
	}

	
	/**
	 * 购买关键词
	 */
	function buy(){
		
		$model = D( $this->modelName );
	
		$result = $model -> buy($_REQUEST);
		
		if( $_GET['type'] == 'ajax'){
			// 购买成成功
			if( $result['status'] == 1 && $result['success'] > 0 ){
				$return['status'] 	= 1;
				$return['success'] 	= $result['success'];
				$return['fail'] 	= $result['fail'];
				$return['fail_ids'] 	= $result['fail_ids'];
			}else{
				$return['status'] = 0;
				$return['info'] = $model  -> getError();
			}
		
			exit(json_encode($return));
		}
	}
	
	/**
	 * 删除购物车中的关键词
	 */
	function delete(){
		$model = D( $this->modelName );
		$idstr = $_GET['id'];
		$ids = explode( ',',$idstr );
		
		if( $ids ){
			$map['id'] = array('IN' ,  $ids );
			$data['status'] = 0;
			$result = $model -> where( $map ) -> save( $data );
		}
		
		if( $_GET['type'] == 'ajax'){
			if( $result ){
				$return['status'] = 1;
			}else{
				$return['status'] = 0;
				$return['info'] = $model  -> getError();
			}
		
			exit(json_encode($return));
		}else {
			if ($result) {
			
				$this->success ( '删除成功！', U ( 'index' ) );
			} else {
				$this->error ( '删除失败！' );
			}
		}
		
		
	
	}
	
	/**
	 * 删除购物车中的关键词
	 */
	function keywordList(){
	
		
		$list = $model -> getListByPage();
		$this -> assign('list', $list);
		$this->display();
	
	}
	
}
?>