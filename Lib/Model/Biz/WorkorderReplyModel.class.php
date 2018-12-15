<?php

/**
 * 模型层：工单回复管理模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170707
 * @link        http://www.qisobao.com
 */
class WorkorderReplyModel extends BaseModel{
	
	/**
	 * 自动处理数据
	 */
	protected $__auto 		= array (
			array ('createuserid', 'getLoginUserId',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createusername', 'getloginUserName',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createtime','date',1,'function',array('Y-m-d H:i:s')), // 对createtime字
	);
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		// 真实表名称
		$this -> trueTableName= C('DB_PREFIX') . 'biz_workorder_reply';
		
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
	
		$me = $this -> getloginUserInfo();

		$model_file  = D( 'File/File' );
		$model_user  = D( 'User/User' );
		foreach( $list as &$vo ){
			if( $me['id'] == $vo['createuserid'] || (GROUP_NAME == 'Manage' && strpos($vo['createusername'] , '运维') > -1 )){
				$vo['class_name'] = 'layim-chat-mine';
				$vo['is_mine'] = 1;
			}
			
			$user = $model_user -> selectOne( array('id' => $vo['createuserid']));
			switch ( $user['usertype'] ) {
				case 'sub':
					$vo['icon'] = 'avatar_user.png';
					break;
				case 'operation_manager':
				case 'operation':
					$vo['icon'] = 'avatar_secretary.png';
					break;
				default:
					;
				break;
			}
			
			// 获取附件
			$file_arra = json_decode( $vo['file'], true );
			$file_arra['maxsize'] = 10;
			// $file_arra['isrequire'] = 1;// 是否必传
			$file_arra['skin'] = 'simple';
			$file_arra['cannotedit'] = 1; // 不能编辑
			$vo['file_arra'] = $file_arra;
			// 获取附件
			$file = $model_file -> selectOne( array('id' => $file_arra['fileid']));
			
			$vo['file_info'] = $file;
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

		foreach( $list['data'] as $key => &$vo ){
	
	
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
	function addRecord( $postData ){
		$postData['content'] = htmlspecialchars( $postData['content'] );
		//组合其他相关参数
		$data = $postData;

		//rtrim($str, ",");
		$model_file = D('File/File');
		if( $postData['type'] == 'ajax' ){
			$files = $model_file -> selectOne( array('id' => $postData['fileid']));
			$file['fileid'] = $files['id'];
			$file['attachmenttype'] = $files['attachmenttype'];
			$file['originalfilename'] = $files['originalfilename'];
			$data['file'] = my_json_encode($file);
		}else{
			$files = $model_file -> combineFiles( $postData );
			$data['file'] = my_json_encode($files[0]);
		}
		
	
		
		
	
		return $this -> insert($data);
	}
	
}
	
?>