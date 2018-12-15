<?php

/**
 *  海排宝-企业资料控制类
 *
 * @category    海排宝-计划控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Service
 * @version     20170629
 * @link        http://www.mitong.com
 */

class QREpinfoAction extends BaseAction {
	
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
		
		$this->modelName = "QR/Epinfo";
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index(){
		
		
		$model 		= D( $this->modelName);
		
		$page['data'] = $model -> getMyEpinfo();

		
		//传值到模板显示
		$this -> assign($page);

		$this->display();
	}
	
	
	/**
	 * 新增计划
	 */
	function maintain(){
		
		$model = D( $this->modelName );
	
		$result = $model -> maintain( $_POST );
	
		if( $result){
				
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '维护成功！',$returnUrl,false,true);
			}else{
				$this->success ( '维护成功！', U ( 'index'),false,true);
			}
				
				
		}else{
			$this->error ( '维护失败！' .$model  -> getError());
		}
	}
	
	
	/**
	 * 修改界面
	 *
	 * @accesspublic
	 */
	public function updatePage(){
		$model = D($this->modelName);
	
		$map['id'] = $_GET['id'];
	
		$data = $model -> selectOne( $map );
	
		$this -> assign('data', $data );
	
		$this->display();
	}
	
	/**
	 * 修改
	 *
	 * @accesspublic
	 */
	public function update(){
		$model = D($this->modelName);
	
		//dump($model);exit;
		$result = $model -> update( $_POST );
	
		if( $result ){
			
			$returnUrl = $_POST['returnUrl'];
			if( $returnUrl ){
				$this->success ( '修改成功！',$returnUrl,false,true);
			}else{
				$this->success ( '修改成功！', U ( 'index'),false,true);
			}
			
		}else{
			$this-> error('修改失败！');
		}
	}
	
	/**
	 * 删除购物车中的关键词
	 */
	function deleteRecord(){
		$model = D( $this->modelName );
		
		
		//判断当前是否可以删除
		$oldData = $model -> selectOne( array('id' => $_GET['id'] ));
		if( $oldData['isCanEdit'] != 1 ){
			$this->error ( '删除失败，您暂时不能删除该关键词！', U ( 'index' ) );
		}
		
		$data['id'] 	= $_GET['id'];
		$data['status'] = 0;
		$result = $model -> update( $data ); 
		
		if ($result) {
			$this->success ( '删除成功！', U ( 'index' ) );
		} else {
			$this->error ( '删除失败！' );
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