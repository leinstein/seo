<?php

/**
 * 模型层：快排宝-报表统计模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.QR
 * @version     20170629
 * @link        http://www.qisobao.com
 */
class ReportModel extends BaseModel{
	
	
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
		$this -> trueTableName= C('DB_PREFIX') . 'qr_report';
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
			$me = $this -> getloginUserInfo();
			// 根据用户的角色判断该用户对该计划的权限
			switch ( $me['role_info']['rolecode']) {
				case 'sub':// 子用户
					if( $data['planstatus'] == '待审核'){
						$data['can_edit'] = 1;
						$data['can_delete'] = 1;
					}
					break;
				case 'agent':// 代理商用户
					if( $data['planstatus'] == '待审核'){
						$data['can_edit'] = 1;
						$data['can_delete'] = 1;
					}
					break;
				case 'operation':// 运维
					if( $data['planstatus'] == '待审核'){
						$data['can_edit'] = 1;
						$data['can_review'] = 1;
						$data['can_delete'] = 1;
					}
						
					if( $data['planstatus'] == '合作停'){
						$data['can_review'] = 1;
					}
					break;
				default:
					;
					break;
			}
			
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
		foreach( $list as &$vo ){
			// 根据用户的角色判断该用户对该计划的权限
			switch ( $me['role_info']['rolecode']) {
				case 'sub':// 子用户
					if( $vo['planstatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_delete'] = 1;
					}
					break;
				case 'agent':// 代理商用户
					if( $vo['planstatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_delete'] = 1;
					}
					break;
				case 'operation':// 运维
					if( $vo['planstatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_review'] = 1;
						$vo['can_delete'] = 1;
					}
						
					if( $vo['planstatus'] == '合作停'){
						$vo['can_review'] = 1;
					}
					$list['can_review'] = 1;
					break;
				default:
					;
					break;
			}
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
		$me = $this -> getloginUserInfo();
		foreach( $list['data'] as $key => &$vo ){
	
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $numberPerPage;
			$vo['No'] = $No;
			// 根据用户的角色判断该用户对该计划的权限
			switch ( $me['role_info']['rolecode']) {
				case 'sub':// 子用户
					if( $vo['planstatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_delete'] = 1;
					}
					break;
				case 'agent':// 代理商用户
					if( $vo['planstatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_delete'] = 1;
					}
					break;
				case 'operation':// 运维
					if( $vo['planstatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_review'] = 1;
						$vo['can_delete'] = 1;
					}
						
					if( $vo['planstatus'] == '合作停'){
						$vo['can_review'] = 1;
					}
					$list['can_review'] = 1;
					break;
				default:
					;
					break;
			}
	
	
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
		// 获取我的全部计划
		$model = D('QR/Plan');
		foreach( $list['data'] as  $key => &$vo ){
			$plan = $model -> where( array('id' => $vo['planid']) ) -> find();
			$vo['planname'] = $plan['planname'];
			
		}
	
		return $list;
	}
	
	
	/**
	 * 增加导入记录
	 *
	 * 为每次关键词导入增加导入的记录
	 * 1、判断天数差是否大于0，如果大于0说明还有未增加的消费记录
	 * 2、循环天数，增加消费记录
	 * 
	 * @param unknown $userid 
	 * @param unknown $planid
	 * @param unknown $keyword_num
	 * @param unknown $standard_num
	 */
	function addRecord( $userid, $planid, $keyword_num, $standard_num,$baidu_num,$baidumobile_num   ){
	
		// 判断今天有没有记录
		$map['planid'] 			= $planid;
		$map['createtime'] 		= array('LIKE', date('Y-m-d') .'%');
		
		$data = $this -> selectOne($map);
	
		if( $data ){
			$data['keyword_number'] 	=  $keyword_num;
			$data['standard_number'] 	=  $standard_num;
			$data['baidu_number'] 		=  $baidu_num;
			$data['baidumobile_number'] =  $baidumobile_num;
			$return = $this -> update( $data );
		}else{
			//组合其他相关参数
			$data['planid'] 			= $planid;
			$data['userid'] 			= $userid;
			$data['keyword_number'] 	=  $keyword_num;
			$data['standard_number'] 	=  $standard_num;
			$data['baidu_number'] 		=  $baidu_num;
			$data['baidumobile_number'] =  $baidumobile_num;
			$return =$this -> insert($data);
		}
		
		return $return;
	}
	
	
	
}
	
?>