<?php

/**
 * 模型层：用户角色模型类 
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20141010
 * @link        http://www.qisobao.com
 */

class UserRoleModel extends BaseModel{
	
	/**
	 * 用户表名称
	 */
	protected $trueTableName = 'ts_sys_userroleinfo';
	
	/**
	 * 自动处理数据
	 */
	protected $__auto 		= array (
		
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
	 * {@inheritDoc}
	 * @see BaseModel::insert()
	 */
	function insert( $postData ){
	
		
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
	 * 获取Manage分组的全部角色
	 */
	function getManageRole( $level ){
		$map['rolegroup'] 	= 'Manage';
		$map['status'] 		= 1;
		if( $level ){
			$map['rolelevel'] = $level;
		}
		
		return $this -> queryRecordAll($map);
	}
	
	/**
	 * 获取Manage分组的全部角色
	 */
	function getManageRoleCodeset(  $rolecode ){
		if( !$rolecode ){
			$level = 1;
		}
		$list = $this -> getManageRole( $level );
	
		$model_user = D('User/User');
		foreach ( $list as $vo ){
			if( $rolecode ){
				if( $vo['rolecode'] == $rolecode ){
					$userrole_options[$vo['rolecode']] = $vo['rolename'];
					// 如果添加的用户是2级角色。需要获取该角色上级据角色的所有用户
					//if( $vo['rolelevel'] > 1 ){
						
						//$p_rolecode = $this -> selectOne( array('id' => $vo['pid']));
						//$parents =  $model_user -> queryRecordAll(array('usertype' => $p_rolecode['rolecode']) );
						////dump($parents);
					//}
				}
				
				
			}else{
				$userrole_options[$vo['rolecode']] = $vo['rolename'];
			}
			
		}
		
		return $userrole_options;
	}
	
	/**
	 * 获取当前分组全部角色
	 */
	function getRole( $level ){
		$me = $this -> getloginUserInfo();
		$usergroup = !empty($me['usergroup']) ? $me['usergroup'] : GROUP_NAME;
		/* if( $usergroup == 'Agent2' ){
			$usergroup = 'Agent';
		} */
		
		$map['rolegroup'] 	= $usergroup;
		$map['status'] 		= 1;
		if( $level ){
			$map['rolelevel'] = $level;
		}
		
		return $this -> queryRecordAll($map);
	}
	
	/**
	 * 获取当前分组的全部角色
	 */
	function getRoleCodeset(  $rolecode ){
		if( !$rolecode ){
			//$level = 1;
		}
		$list = $this -> getRole( $level );
	
		$model_user = D('User/User');
		foreach ( $list as $vo ){
			if( $rolecode ){
				if( $vo['rolecode'] == $rolecode ){
					$userrole_options[$vo['rolecode']] = $vo['rolename'];
					// 如果添加的用户是2级角色。需要获取该角色上级据角色的所有用户
					//if( $vo['rolelevel'] > 1 ){
						
						//$p_rolecode = $this -> selectOne( array('id' => $vo['pid']));
						//$parents =  $model_user -> queryRecordAll(array('usertype' => $p_rolecode['rolecode']) );
						////dump($parents);
					//}
				}
				
				
			}else{
				$userrole_options[$vo['rolecode']] = $vo['rolename'];
			}
			
		}
		
		return $userrole_options;
	}
	
	
	/**
	 * 根据部门的编号来获取部门的全部角色
	 */
	function getCodeSetByDepart( $departno ){
		$model = D('Sys/UserRole');
		if( $departno ){
			$map['departno'] = $departno;
		}else{
			$map['rolegroup'] = GROUP_NAME;
			$map['rolecode'] = array(array('NEQ','agent'),array('NEQ','agent2'),'AND'); 
		}
		$map['status'] = 1;
		$list = $this -> queryRecordAll( $map );
		foreach ($list as $vo ){
			$codeset[$vo['roleno']] = $vo['rolename'];
		}
		return $codeset;
	}
	
	/**
	 * 根据部门的编号来获取部门的全部角色
	 */
	function getCodeSetByGroup( $rolegroup ){
		$model = D('Sys/UserRole');
		if( !$rolegroup ){
			$rolegroup = GROUP_NAME;
		}
		$map['rolegroup'] 	= $rolegroup;
		$map['rolecode'] 	= array(array('NEQ','agent'),array('NEQ','agent2'),'AND');
		$map['status'] 		= 1;
		$list = $this -> queryRecordAll( $map );
		foreach ($list as $vo ){
			$codeset[$vo['rolecode']] = $vo['rolename'];
		}
		return $codeset;
	}
}
	
?>