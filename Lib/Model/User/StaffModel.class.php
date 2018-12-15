<?php

/**
 * 模型层：用户角色模型类 
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20141010
 * @link        http://www.qisobao.com
 */

class StaffModel extends BaseModel{
	
	/**
	 * 用户表名称
	 */
	protected $trueTableName = 'ts_sys_user';
	
	/**
	 * 自动处理数据
	 */
	protected $__auto 		= array (
			array ('userno','create_guid',1,'function') , // 对userno字段在新增的时候调用create_guid
			// array ('userpass','md5',1,'function',array('seo188')) , // 对userpass字段在新增的时候使md5函数处理
			array ('createuserid', 'getLoginUserId',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createusername', 'getloginUserName',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createtime','date',1,'function',array('Y-m-d H:i:s')), // 对createtime字
			array ('userstatus','正常'), // 新增的时候把userstatus字段设置为正常
	);

	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		
		//合并自动验证
		$this->setProperty("_validate", array_merge($this->_validate, $this->__validate));
		//合并自动完成
		$this->setProperty("_auto", array_merge($this->_auto, $this->__auto));
		
	}
	
	
	
	/**
	 * 重写父类方法
	 * 
	 * 新增
	 * 判断当前的用户名或者手机号码以及电子邮箱是否已经存在
	 * 
	 * {@inheritDoc}
	 * @see BaseModel::insert()
	 */
	function insert( $postData ){
		
		// 判断当前的用户是否已经存在
		$map['username'] = $postData['username'];
		if( $this -> selectOne( $map )){
			$this -> error = '该用户名已经存在';
			return false;
		}
		
		return parent::insert($data);
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
	
		//将数据的中的大字段格式转化成php数组
		if( $data ){
				
		}
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
	
		foreach( $list as &$vo ){

	
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
	
		$list = parent:: queryRecord($map, $fields, $order, $queryOpts);
		//获取每页显示条数
		$numberPerPage = $queryOpts;//$queryOpts['NumberPerPage'];
		if( !$numberPerPage ) {
			$numberPerPage = $this -> pageNum;;
		}
	
		foreach( $list['data'] as $key => &$vo ){
	
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $numberPerPage;
			$vo['No'] = $No;
			
	
	
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
	
		$list = parent:: queryRecordEx($map, $fields, $order,  $url_param, $num_per_page);
	
		foreach( $list['data'] as  $key => &$vo ){
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $num_per_page;
			$vo['No'] = $No;
	
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
	public function getStaffList($map, $fields, $order = null,  $url_param = '', $num_per_page = 20) {
	
		if ( !$map['usertype'] ){
			// 获取管理端用户的角色
			$userrole_options =  D( 'User/UserRole' ) ->  getManageRoleCodeset();
			
			$userroles = array_keys($userrole_options );
			
			if( $userroles ){
				$map['usertype'] 	= array('IN', $userroles );
				$map['userstatus'] 	= '正常';
				$map['status'] 		= 1;
				$list =  $this -> queryRecordEx( $map, $fields, $order,  $url_param, $num_per_page);
			}
		}else{
			$map['userstatus'] 	= '正常';
			$map['status'] 		= 1;
			$list =  $this -> queryRecordEx( $map, $fields, $order,  $url_param, $num_per_page);
		}
		return $list;
	}
	
	
	/**
	 * 获取代理商用户信息列表
	 */
	function detail( $id ){

		// 获取一级代理商用户
		$data 	= $this -> selectOne( array('id' => $id ));
	
	
		return $data;
	}
	
	/**
	 * 删除用户
	 * 
	 * 将用户的status设置为0
	 * 
	 */
	function delete( $id ){
		$data['id'] 	= $id;
		$data['status'] = 0;
		return $this -> update( $data );
	}
	
	/**
	 * 获取每个角色的用户
	 * 
	 */
	function getStaffCodeSet(  ){
		// 部门模型
		$model_departinfo = D('Sys/Departinfo');
		
		// 角色模型
		$model_role = D('Sys/UserRole');
		
		// 获取销售部门全部用户
		$map_depart['orgpath'] = array('LIKE' ,'/销售部%');
		$data_depart = $model_departinfo -> selectOne( $map_depart );
		
		// 获取销售角色
		$map_role['departid'] = $data_depart['id'];
		$data_role = $model_role -> queryRecordAll( $map_role );
		
		foreach ($data_role as $vo ){
			$sales[] = $vo['rolecode'];
		}
		if( $sales ){
			$map_sale['usertype'] 	= array('IN', $sales );
			$map_sale['status'] 		= 1;
			$list_sale =  $this -> queryRecordAll( $map_sale );
			foreach ($list_sale as $vo_sale){
				$operation_codeSet[$vo_sale['id']] = $vo_sale['username'];
			}
		}
		
		dump($operation_codeSet);
		
		$userroles = array('operation','sale','customer');
		$map['usertype'] 	= array('IN', $userroles );
		$map['status'] 		= 1;
		$list =  $this -> queryRecordAll( $map );
		foreach ( $list as $vo ){
			if( $vo['usertype'] =='operation' ) {
				
			}
			switch ( $vo['usertype'] ) {
				case 'operation':
					$operation_codeSet[$vo['id']] = $vo['username'];
					break;
				case 'sale':
					$sale_codeSet[$vo['id']] = $vo['username'];
					break;
				case 'customer':
					$customer_codeSet[$vo['id']] = $vo['username'];
					break;
				default:
					;
				break;
			}
			
		}
		$data['operation_codeSet'] 	= $operation_codeSet;
		$data['sale_codeSet'] 		= $sale_codeSet;
		$data['customer_codeSet'] 	= $customer_codeSet;
		
		return $data;
	}
}
	
?>