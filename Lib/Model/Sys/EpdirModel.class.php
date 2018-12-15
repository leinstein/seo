<?php

/**
 * 模型层：企业信息管理模型
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Sys
 * @version     20170518
 * @link        http://www.qisobao.com
 */

class EpdirModel extends BaseModel{
	
	/**
	 * 用户表名称
	 */
	protected $trueTableName = 'ts_sys_epdir';
	
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		
		//执行父类构造函数
		parent::_initialize();
		
	}

	/**
	 * 重写父类方法：获取单个申请单信息
	 *
	 * 根据查询条件查询数据库中的单条记录，并返回结果。
	 * 获取一个资金申请单的基本信息：
	 *   1、不包含明细信息；
	 *   2、将大字段进行转换。
	 *
	 * @param array $map 查询条件
	 * @return var 如果查询成功则返回对象信息，如果失败则返回false
	 */
	function selectOne( $map, $field ){
	
		//调用父类方法获取数据
		$data = parent:: selectOne( $map , $field );

		// 实例化系统产品的模型
		$model_product = D('Sys/Product');
		
		// 实例化系统产品的模型
		$model_user = D('User/User');
	
		//将数据的中的大字段格式转化成php数组
		if( $data ){
				
			// 获取当前用户的用户类型
			//$me = $this -> getloginUserInfo();

			// 获取用户的开通的产品
			$data['product_arr'] = json_decode( $data['product'], true ); 
			
			// 获取产品的信息
			foreach ( $data['product_arr'] as $vo_product ) {
	
				$products[] = $model_product -> selectOne( array('id' => $vo_product['id'] ) ,'id,product_guid,product_code,product_name,product_desc,product_status,module_name,entry_code,micontype,menuicon,miconcolor');

			}
			$productnames = "";
			foreach ( $products as $vo_product) {
				$productids[] = $vo_product['id'];
				$productnames .= $vo_product['product_name'] .',';
			}
			$productnames = rtrim($productnames,',');
			$data['products'] 	= $products;
			$data['productids'] = $productids;
			$data['productnames'] = $productnames;
			
			// 获取销售经理和销售员
			if( $data['seller_manager']){
				$data['seller_manager_name'] = $model_user -> selectOne ( array('id' => $data['seller_manager'] ));
			}
			if( $data['seller']){
				$data['seller_name'] = $model_user -> selectOne ( array('id' => $data['seller'] ));
			}

		}
		
	//	dump($data);
		return $data;
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

		// 获取当前用户的用户类型
		$me = $this -> getloginUserInfo();
		
		// 实例化系统产品的模型
		$model_product = D('Sys/Product');
		
		// 实例化系统产品的模型
		$model_user = D('User/User');
	
		foreach( $list as &$vo ){
			unset($products);
			unset($productids);
			// 获取用户的开通的产品
			$vo['product_arr'] = json_decode( $vo['product'], true );
			
			// 获取产品的信息
			foreach ( $vo['product_arr'] as $vo_product ) {
			
				$products[] = $model_product -> selectOne( array('id' => $vo_product['id'] ) ,'id,product_guid,product_code,product_name,product_desc,product_status,module_name,entry_code,micontype,menuicon,miconcolor');
			
			}
			
			$productnames = "";
			foreach ( $products as $vo_product) {
				$productids[] = $vo_product['id'];
				$productnames .= $vo_product['product_name'] .',';
			}
			$productnames = rtrim($productnames,',');
			$vo['products'] 	= $products;
			$vo['productids'] = $productids;
			$vo['productnames'] = $productnames;
			if( $vo['seller_manager'] ){
				$seller_manager_ids[] = $vo['seller_manager'] ;
			}
			if($vo['seller'] ){
				$seller_ids[] = $vo['seller'] ;
			}
		}
		
		$seller_manager_ids = array_unique( $seller_manager_ids );
		
		$seller_ids = array_unique( $seller_ids );
		
		// 获取销售经理和销售员
		if( $seller_manager_ids ){
			$map1['id'] = array('in',$seller_manager_ids);
			$seller_managers = $model_user -> queryRecordAll ( $map1,'id,username,truename' );
		}
		if( $seller_ids ){
			$map2['id'] = array('in',$seller_ids);
			$sellers = $model_user -> queryRecordAll ( $map2,'id,username,truename' );
		}
		
		foreach( $list as &$vo1 ){
			$seller_manager = list_search($seller_managers, array('id' => $vo1['seller_manager']));
			$seller 		= list_search($sellers, array('id' => $vo1['seller']));
			$vo1['seller_manager'] = $seller_manager[0];
			$vo1['seller'] = $seller[0];
		}
		//返回记录集
		return $list;
	}
	
	/**
	 * 重写父类方法：根据查询条件查询符合条件的所有记录集合，以翻页模式返回数据
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志，每页记录数，翻页参数这几个条件对记录集进行过滤筛选并返回结果。
	 *   1、调用父类方法获取查询结果
	 *   2、将数据中的json格式大字段转换成php数据
	 *   3、其他数据的转换
	 *
	 * @param array $map 查询条件；
	 * @param string $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param array $queryOpts 查询参数配置，目前包括：'Relation', 'NumberPerPage', 'PageParameters'等等；
	 *  Relation　表示是否采用关系模型来查询，可选值为:true,false，默认false;
	 *  NumberPerPage  表示每页记录数，值为整数，默认读取配置文件中的NUM_PER_PAGE;
	 *  PageParameters  表示翻页后的参数，字符串类型默认为空;
	 * 　特别的：如果输入数值，那么直接表示每页个数；如果是真假值，那么表示关系；如果输入文本，那么表示PageParameters；
	 * @return var 查询结果
	 */
	public function queryRecord($map, $fields, $order = null, $queryOpts) {
	
		// 实例化系统产品的模型
		$model_product = D('Sys/Product');
		
		$list = parent:: queryRecord($map, $fields, $order, $queryOpts);
		//获取每页显示条数
		$numberPerPage = $queryOpts;//$queryOpts['NumberPerPage'];
		if( !$numberPerPage ) {
			$numberPerPage = $this -> pageNum;;
		}

		// 获取当前用户的用户类型
		$me = $this -> getloginUserInfo();
		$usertype = $me['usertype'];
		
		switch ($usertype) {
			case 'admin':// 管理员
			case 'operation_manager':// 运维经理、
			case 'operation':// 运维经理
				$list['can_edit'] = 1; 
				break;
			
			default:
				# code...
				break;
		}
	
		foreach( $list['data'] as $key => &$vo ){
	
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $numberPerPage;
			$vo['No'] = $No;
			
			unset($products);
			unset($productids);
			
			// 获取用户的开通的产品
			$vo['product_arr'] = json_decode( $vo['product'], true );
			
			// 获取产品的信息
			foreach ( $vo['product_arr'] as $vo_product ) {
					
				$products[] = $model_product -> selectOne( array('id' => $vo_product['id'] ) ,'id,product_guid,product_code,product_name,product_desc,product_status,module_name,entry_code,micontype,menuicon,miconcolor');
					
			}
			foreach ( $products as $vo_product) {
				$productids[] = $vo_product['id'];
			}
			$vo['products'] 	= $products;
			$vo['productids'] = $productids;
		}
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
		// 实例化系统产品的模型
		$model_product = D('Sys/Product');
		
		$list = parent:: queryRecordEx($map, $fields, $order,  $url_param, $num_per_page);

		// 获取当前用户的用户类型
		$me = $this -> getloginUserInfo();
		$usertype = $me['usertype'];
	
		foreach( $list['data'] as  $key => &$vo ){
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $num_per_page;
			$vo['No'] = $No;
			
			unset($products);
			unset($productids);
			// 获取用户的开通的产品
			$vo['product_arr'] = json_decode( $vo['product'], true );
			
			// 获取产品的信息
			foreach ( $vo['product_arr'] as $vo_product ) {
					
				$products[] = $model_product -> selectOne( array('id' => $vo_product['id'] ) ,'id,product_guid,product_code,product_name,product_desc,product_status,module_name,entry_code,micontype,menuicon,miconcolor');
					
			}
			foreach ( $products as $vo_product) {
				$productids[] = $vo_product['id'];
			}
			$vo['products'] 	= $products;
			$vo['productids'] = $productids;
			
		}
	
		return $list;
	}

	/**
	 * 增加企业信息
	 */
	function addRecord( $postData ){

		$data  		= $postData;
		$epname = trim( $postData['epname']  ) ;

		// 目前只能根据企业的名称来判断企业
		if( $this -> selectOne ( array('epname' => $epname ) )){
			$this -> error ="改企业已经存在！";
			return false;
		}

		// 系统产品模型
        $model_product = D( 'Sys/Product' ); 

		$data['epid']  		= create_guid();
		$data['epname']  	= $epname;
		
		// 组合开通产品信息 
		$productid	= $postData['product'];
		if( $productid ){
			$map_product['id'] =  array( 'IN' ,$productid );
			$porducts = $model_product -> queryRecordAll( $map_product,'id,product_guid,product_code,product_name');
		}

		$data['product'] 		=  my_json_encode($porducts);

		$data['customer'] 		= $postData['customer_id'];
		$data['seller'] 		= $postData['seller_id'];
		$data['operationer'] 	= $postData['operation_id'];

		$result = $this -> insert( $data );
		return $result;
	}
	
	/**
	 * 增加企业信息
	 */
	function updateRecord( $id , $postData ){
		// 系统产品模型
		$model_product = D( 'Sys/Product' );
		
		$epname = trim( $postData['epname']  ) ;
		
		$data['id'] 	= $id;
		$data['epname'] = $epname;
		
		// 组合开通产品信息
		$productid	= $postData['product'];
		if( $productid ){
			$map_product['id'] =  array( 'IN' ,$productid );
			$porducts = $model_product -> queryRecordAll( $map_product,'id,product_guid,product_code,product_name');
		}
		$data['product'] 		=  my_json_encode($porducts);
		
		$data['customer'] 		= $postData['customer_id'];
		
		$data['seller'] 		= $postData['seller_id'];
		
		$data['operationer'] 	= $postData['operation_id'];
		
		$result = $this -> update( $data );
		
		return $result;
	}
	
}
	
?>