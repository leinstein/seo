<?php

/**
 * 模型层：日志管理模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170707
 * @link        http://www.qisobao.com
 */
class RemarkModel extends BaseModel{
	
	
	/**
	 * 自动处理数据
	 */
	protected $__auto 		= array (
			array ('createuserid', 'getLoginUserId',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createusername', 'getloginUserName',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createtime','date',1,'function',array('Y-m-d H:i:s')), // 对createtime字
			array ('bizstatus','未处理'), // 新增的时候把业务状态字段设置为正常
	);
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		// 真实表名称
		$this -> trueTableName= C('DB_PREFIX') . 'biz_remark';
		
		//合并自动验证
		$this->setProperty("_validate", array_merge($this->_validate, $this->__validate));
		//合并自动完成
		$this->setProperty("_auto", array_merge($this->_auto, $this->__auto));
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
	function selectOne( $map ){
	
		//调用父类方法获取数据
		$data = parent:: selectOne( $map );
		
		$list[] = $data;
		
		// 对数据进行转换
		$this -> myTransData( $list);
		
		$data = $list[0] ;
	
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
		
		// 对数据进行转换
		$this -> myTransData( $list );
		
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
	
		$list = parent:: queryRecord($map, $fields, $order, $queryOpts);
		
		// 对数据进行转换
		$this -> myTransData( $list['data'] );
		
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
	
		$list = parent:: queryRecordEx($map, $fields, $order,  $url_param, $num_per_page);
		
		// 对数据进行转换
		$this -> myTransData( $list['data'] );
	
		return $list;
	}
	
	/**
	 * 转换数据
	 */
	function myTransData( &$list ){
		
		// 附件模型
		// $model_file = D('File/File');
		// 回复模型
		$model = D('Biz/WorkorderReply') ;
		
		$userid = $this -> getLoginUserId();
		$me = $this -> getloginUserInfo();
		foreach( $list as $key => &$vo ){
			
			// 获取附件
			$file_arra = json_decode( $vo['file'], true );
			$file_arra['maxsize'] = 10;
			// $file_arra['isrequire'] = 1;// 是否必传
			$file_arra['skin'] = 'simple';
			$file_arra['cannotedit'] = 1; // 不能编辑
			$vo['file_arra'] = $file_arra;
				
			
			// 产品id
			if( $vo['productid'] ){
				$productids[] = $vo['productid'];
			}
		
			// 根据不同的工单对象来组合不同的对象id
			switch ( $vo['objecttype'] ) {
				case 'user':
					if( $vo['objectid'] ){
						$siteids[] = $vo['objectid'];
					}
					break;
						
				default:
					;
					break;
			}
			
			
		}
		
		unset( $vo );
		
		// 去重
		$productids = array_unique( $productids );
		if( $productids ){
			// 系统产品模型
			$model_product = D('Sys/Product');
			$map['id'] = array('IN', $productids );
			$products = $model_product -> queryRecordAll( $map,'id,product_name');
		}
		
		// 去重
		$siteids = array_unique( $siteids );
		if( $siteids ){
			// 站点模型
			$model_site = D('Biz/Site');
			$map['id'] = array('IN', $siteids );
			$sites = $model_site -> queryRecordAll( $map,'id,sitename,website' );
		}
		
		foreach( $list  as &$vo ){
			$product = list_search($products, array('id' => $vo['productid']));
			$vo['productname'] = $product[0]['product_name'];
	
		
		}
	}
	
	
	/**
	 * 重写父类方法
	 * 
	 * 新增
	 * {@inheritDoc}
	 * @see BaseModel::insert()
	 */
	function addRecord( $postData ){
		
		//rtrim($str, ",");
		$model_file = D('File/File');
		
		$files = $model_file -> combineFiles( $postData );
		//组合其他相关参数
		$data['file'] 		= my_json_encode($files[0]);
		$data["productid"] 	= $postData["productid"];
		$data["objectid"] 	= $postData["objectid"];
		$data["remarktype"] = $postData["remarktype"];
		$data["remarkmode"] = $postData["remarkmode"];
		$data["content"] 	= $postData["content"];
		$data["objecttype"] = $postData["objecttype"];
		$data["touserid"] 	= $postData["touserid"];
		$data["tousername"] = $postData["tousername"];
		
		
		if( !$data['touserid'] ){
			switch ( $data['objecttype'] ) {
				case 'user':
					$model_user = D( 'User/User' );
					$user_info = $model_user -> selectOne( array('id' => $data["objectid"]),'username');
					$data["touserid"] 	= $data["objectid"];
					$data['tousername'] = $user_info['username'];
				break;
				// TODO 其他产品补充
				default:
					;
				break;
			}
		}
		return $this -> insert($data);
	}
	
	
}
	
?>