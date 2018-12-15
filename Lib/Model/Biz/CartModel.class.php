<?php

/**
 * 模型层：购物车模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170419
 * @link        http://www.qisobao.com
 */
class CartModel extends BaseModel{
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		$this -> trueTableName= C('DB_PREFIX') . 'cart';
	}
	
	/**
	 * 重写父类方法：根据查询条件查询符合条件的所有记录集合
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志以及最大记录数这几个条件对记录集进行过滤筛选并返回结果。
	 *   1、调用父类方法获取查询结果
	 *   2、将数据中的json格式大字段转换成php数据
	 *   3、其他数据的转换
	 *
	 * @param array $map 查询条件
	 * @param $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param boolean $Relation 表示是否采用关系模型来查询，可选值为:true,false，默认false。当采用关系模型时，会查询和当前模型有关系的数据，并放入到返回结果。
	 * @param int $maxCount 表示全部查询时取的最大记录数，一般情况为避免系统消耗太多性能，默认为10000，注意导出数据时修改此参数；
	 * @return var 查询结果
	 */
	public function queryRecordAll($map, $field = null, $order = null, $relation = false, $maxCount = 10000) {
	
		$list = parent:: queryRecordAll($map, $field, $order, $relation, $maxCount );
	
		$SearchengineOptions = C('SearchengineOptions');
		foreach( $list as &$vo ){
			$vo['searchengine_ZH'] = $SearchengineOptions[$vo['searchengine']];
		}
		//返回记录集
		return $list;
	}
	
	/**
	 * 根据查询条件查询符合条件的所有记录集合，以翻页模式返回数据
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志，每页记录数，翻页参数这几个条件对记录集进行过滤筛选并返回结果。
	 *
	 * @param array $map 查询条件；
	 * @param string $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param int $num_per_page  表示每页记录数，值为整数，默认读取配置文件中的NUM_PER_PAGE;
	 * @param string $url_param  表示翻页后的参数，字符串类型默认为空; 特别的：如果输入数值，那么直接表示每页个数；如果是真假值，那么表示关系；如果输入文本，那么表示PageParameters；
	 *
	 * @return mixed 查询结果
	 */
	public function queryRecordEx($map, $fields, $order = null,  $url_param = '', $num_per_page = 20) {
	
		if( !$num_per_page ){
			$num_per_page = $this -> pageNum;
		}
		$list = parent:: queryRecordEx($map, $fields, $order,  $url_param, $num_per_page);
		
		$SearchengineOptions = C('SearchengineOptions');
		
		foreach( $list['data'] as  $key => &$vo ){
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $num_per_page;
			$vo['No'] = $No;
			
			$vo['searchengine_zh'] = $SearchengineOptions[$vo['searchengine']];
			
		}
	
		return $list;
	}
	
	
	/**
	 * 重写父类方法
	 * 
	 * 新增
	 * {@inheritDoc}
	 * @see BaseModel::insert()
	 */
	function insert( $postData ){
		
		//组合其他相关参数
		$data = $postData;
		$data['createtime'] = date('Y-m-d H:i:s');
		$data['createuserid'] = $this -> getLoginUserId();
		$data['createusername'] = $this -> getloginUserName();
		$data['cartstatus'] = '待购买';
		
		
		return parent::insert($data);
	}
	
	/**
	 * 获取购物车中所有未购买的关键词清单
	 */
	function getKeywordsAll(  ){
		$map['status'] 			= 1;
		$map['cartstatus'] = '待购买';
		return $this -> queryRecordEx($map, $fields,'id desc,regtime desc');
	}
	
	/**
	 * 获取我的站点列表
	 */
	function getKeywords(  ){
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		$map['cartstatus'] = '待购买';
		
		
		
		return $this -> queryRecordAll($map, $fields,'regtime desc');
	}
	

	
	/**
	 * 获取我的站点列表
	 */
	function getMySitesNum(  ){
		
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}
	
	/**
	 * 获取我的站点列表
	 */
	function buy( $postData ){
	
		$modelKeyword 		= D('Biz/Keyword');
		$modelSite 			= D('Biz/Site');
		$modelFunds 		= D('Biz/Funds');
		$modelFundsfreeze 	= D('Biz/Fundsfreeze');
	
		$idstrs = $postData['id'];
		
		$ids = explode( ',',$idstrs );
		if( $ids ){
			$map['id'] = array('IN' ,  $ids );
			$map['cartstatus'] = '待购买';
			$carts = $this -> queryRecordAll( $map );
		}
		
		// 查询购买的关键词是否已经购买过了
		// 定义已经购买过的数组
		$already_buy_arra = array();
		$fail_id_arra = array();
		foreach ($carts as $key_cart =>  &$vo_cart ){
			
			$map_keyword['siteid'] 		= $postData['siteid'];
			$map_keyword['keyword'] 	= $vo_cart['keyword'];
			$map_keyword['searchengine']= $vo_cart['searchengine'];
			$map_keyword['status'] 		= 1;
			$data_keyword = $modelKeyword -> selectOne( $map_keyword );
			
			/* $map_cart['id'] 			= array('NEQ',$vo_cart['id']);
			$map_cart['keyword'] 		= $vo_cart['keyword'];
			$map_cart['keyword'] 		= $vo_cart['keyword'];
			$map_cart['searchengine'] 	= $vo_cart['searchengine'];
			$map_cart['cartstatus'] 	= '已购买';
			$map_cart['status'] 		= 1;
			$data_cart_old = $this -> selectOne( $map_cart ); */
			if( $data_keyword ){
				$already_buy_arra[] = $vo_cart;
				$fail_id_arra[] 	= $vo_cart['id'];
				unset($carts[$key_cart]);
			}
		}
	
		$site = $modelSite -> selectOne( array('id' => $postData['siteid'] ));
	
		//判断网站的状态。如果是
		if( $site['sitestatus'] == '合作停'){
			$this -> error = '您的网站已经合作停，不能购买关键词！';
			return false;
		}
		
		if( !count($carts) ){
			$this -> error = '您选择的关键词己经购买过了，请不要重复购买';
			return false;
		}
		
		// 比较提交的关键词是否重复了
		foreach ($carts as $key1 => $vo1){
			foreach ($carts as $key2 => $vo2){
					if( $vo1['keyword'] == $vo2['keyword'] && $vo1['searchengine'] == $vo2['searchengine'] && $key1 != $key2 ){
						unset($carts[$key1]);
					}
			}
		}
		
		if( !count($carts) ){
			$this -> error = '您选择的关键词中有重复的关键词，请不要重复购买';
			return false;
		}
		
		// 定义已经购买过的数组
		$id_new_arra = array();
		//组合多个关键词，并计算余额
		foreach ( $carts as $vo ){
			$data['cartid'] 		= $vo['id'];
			$data['keyword'] 		= $vo['keyword'];
			$data['searchengine'] 	= $vo['searchengine'];
			$data['price'] 			= $vo['price'];
			$data['unit'] 			= $vo['unit'];
			$data['unit2'] 			= $vo['unit2'];
			$data['siteid'] 		= $site['id'];
			$data['sitename'] 		= $site['sitename'];
			$data['website'] 		= $site['website'];
			$data['keywordstatus'] 	= '待审核';
			$data['createtime'] 	= date('Y-m-d H:i:s');
			$data['createuserid'] 	= $this -> getLoginUserId();
			$data['createusername'] = $this -> getloginUserName();
			$data['status'] = 1;
			$data['regtime'] = time();
			$data['reguser'] = $this -> getloginUserName();
			$datas[] = $data;
			$prices += $vo['price'];
			$id_new_arra[] =  $vo['id'];
		}
	
		//判断此网址上的关键词己经购买过了
		//$dataBySiteid = $modelKeyword -> getBySiteid( $postData['siteid'] );
		//if( $dataBySiteid ){
		//	$this -> error = '此网址上的关键词己经购买过了，请不要重复购买';
		//	return false;
		//}
	
		//获取帐号的可用余额
		$availablefunds = $modelFunds -> getAvailablefunds();
		
		// add By Richer 于2017年8月15日20:18:50 对于一些特殊的客户，只需要冻结10天的资金
		// TODO 暂行先写死为代理商用户的id
		$me = $this -> getloginUserInfo();
		if( $me['pid'] == 187){
			$days = 10;
		}else{
			$days = 30;
		}
		//这里是不是最少需提供30天的自今年
		// add By Richer 于2017年5月19日10:26:40 去掉对金额的限制
		if( $prices * $days > $availablefunds ){
			$this -> error = '你的余额不足，请先充值后在购买';
			return false;
		}
	
		//
		if( $datas ){
			$result = $modelKeyword -> addAll($datas);
		}
	
		if( $result ){
			//改变购物车中的关键词状态
			if( $id_new_arra ){
				$map['id'] = array('IN' ,  $id_new_arra );
				$data_cart['cartstatus'] = '已购买';
				$this -> where($map) ->save( $data_cart );
			}
			
			//冻结账户资金
			/*$modelFunds -> freezeFunds( $prices * 30 );
			
			//冻结明细表中增加记录
			$freeze['siteid'] 		= $postData['siteid'] ;
			$freeze['freezefunds'] 	= $prices * 30;
			$modelFundsfreeze -> addRecord( $freeze ); */
			
			$return['status'] = 1;
			$return['success'] 	= count( $id_new_arra);
			$return['fail'] 	= count( $fail_id_arra);
			$return['fail_ids'] 	= $fail_id_arra;
			
		}
		return $return;
	}
	
	/**
	 * 调整价格
	 *
	 * @accesspublic
	 */
	public function adjustPrice( $postData ){
	
	
		// 获取关键词id
		$ids = $postData['ids'];
		$id_arr = explode(',',$ids);
		if( $id_arr ){
			$map['id'] = array('IN' , $id_arr );
			$data['price'] = $postData['price'];
			$data['moduser'] =  $this -> getloginUserName();
			$data['modtime'] = time();
			$result = $this -> where( $map ) -> save( $data );
		}
		return $result;
	}
	
	
}
	
?>