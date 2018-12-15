<?php

/**
 * 模型层：资金充值记录模型层累
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170419
 * @link        http://www.qisobao.com
 */
class FundsRechargeRecordModel extends BaseModel{
	
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
		$this -> trueTableName= C('DB_PREFIX') . 'funds_recharge_record';
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
				
			// 从扩展信息中获取
			$data['expand_arr'] = json_decode($data['expand_info'], true );
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
			// 从扩展信息中获取
			if( $vo['expand_arr'] ){
				$vo['expand_arr'] = json_decode($vo['expand_info'], true );
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
	
		foreach( $list['data'] as $key => &$vo ){
	
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $numberPerPage;
			$vo['No'] = $No;
				
			// 从扩展信息中获取
			if( $vo['expand_arr'] ){
				$vo['expand_arr'] = json_decode($vo['expand_info'], true );
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
	
		foreach( $list['data'] as  $key => &$vo ){
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $num_per_page;
			$vo['No'] = $No;
				
			// 从扩展信息中获取
			if( $vo['expand_arr'] ){
				$vo['expand_arr'] = json_decode($vo['expand_info'], true );
			}
		}
	
		return $list;
	}
	
	
	/**
	 * 代理商用户充值
	 *
	 * 代理商用户进行充值
	 *
	 * @param float $amount
	 */
	function addRecord( $userid, $usertype,$amount ){
		$data['userid'] 	= $userid;
		$data['amount'] 	= $amount;
		$data['usertype'] 	= $usertype;
		
		return $this -> insert( $data );
		
	}
	
	
	/**
	 * 代理商用户充值
	 * 
	 * 代理商用户进行充值
	 * 
	 * @param float $amount
	 */
	function agentRecharge( $amount ){
		
	}
	
	/**
	 * 服务商用户充值
	 *
	 * 服务商用户进行充值
	 *
	 * @param float $amount
	 */
	function serverRecharge( $amount ){
	
	}
	
	/**
	 * 获取代理商用户充值记录
	 *
	 * 获取代理商用户充值记录
	 *
	 * @param int $id
	 */
	function getEntryRecords( $userid ){
		$model_user = D('User/User');
		if( $userid ){
			$map['userid'] 		= $userid;
		}
		$map['usertype'] =  array( array('EQ','agent'),array('EQ','agent2'),'OR');
		$list = $this -> queryRecordEx( $map,null,'regtime desc' );
		foreach ($list['data'] as $vo ){
			$userids[] = $vo['userid'];
		}
		$userids = array_unique( $userids );
		if( $userids ){
			$map_user['id'] = array('IN', $userids );
			$users = $model_user -> queryRecordAll( $map_user );
			foreach ($list['data'] as &$vo1 ){
				foreach ($users as $vo2 ){
					if( $vo1['userid'] == $vo2['id']){
						$vo1['username'] 	=  $vo2['username'];
						$vo1['truename'] 	=  $vo2['truename'];
						$vo1['epname'] 		=  $vo2['epname'];
					}
				}
			}
		}
		return $list;
	}
	
	/**
	 * 获取代理商用户为子用户充值记录
	 *
	 * 获取代理商用户为子用户充值记录
	 *
	 * @param int $id
	 */
	function getExpendRecords( $userid ){
		// 用户模型
		$model_user = D('User/User');
		
		if( !$userid ){
			$userid = $this -> getLoginUserId();
		}
		
		// $map_user['usertype'] 	= 'sub';
		$map_user['pid'] 		= $userid;
		$map_user['status']		= 1;
		$users = $model_user -> queryRecordAll( $map_user,'id,username,truename,epname,usertype,usertype_desc' );
		
		foreach ($users as $vo_user ){
			$userids[] = $vo_user['id'];
		}
		$userids = array_unique( $userids );
		if( $userids ){
			$map['userid'] 	= array('IN', $userids );
			$map['status']	= 1;
			$list = $this -> queryRecordEx( $map,null,'regtime desc');
		}
		foreach ($list['data'] as &$vo ){
			$user = list_search($users, array('id' => $vo['userid']));
			$vo['username'] = $user[0]['username'];
			$vo['usertype'] = $user[0]['usertype'];
			$vo['usertype_desc'] = $user[0]['usertype_desc'];
			$vo['truename'] = $user[0]['truename'];
			$vo['epname'] 	= $user[0]['epname'];
		}
		
		return $list;
	}

	/**
	 * 获取代理商的账户余额
	 *
	 * 获取最近5日的账户余额统计
	 * 从达标扣费中获取消费情况，然后通过总金额减去消费
	 *
	 * @param string $userid
	 * @param string $usertype
	 * @param float $amount
	 * @return boolean|mixed|unknown|number
	 */
	function getAgentFundsBalance( $userid ){
		// 关键词达标扣费
		$modelStandardfee = D('Biz/Standardfee');
	
		// 获取资金
		$funds_info = $this -> getFunsinfo();
		dump($funds_info);
		// 比较用户资金的创建时间是否在5天以内
		for($i=5;$i>=0;$i--){
			$dates[]=date('Y-m-d',strtotime("-{$i} days"));
		}
	
	
	
		// 获取账户的充值日期
		$list = $modelStandardfee -> getFeeForAgentUser( $userid, $dates );
		dump($list);
		foreach ($list as &$vo ){
			$consumption += $vo['consumption'];
			$vo['balance'] = $funds_info['totalfunds'] - $consumption;
		}
		// 如果没有充值记录
	
		return $list;
	
	}
	
}
	
?>