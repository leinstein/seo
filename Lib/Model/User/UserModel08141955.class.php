<?php



/**

 * 模型层：用户组模型类 

 * 

 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.cn)

 * @package     Model.Biz

 * @version     20141010

 * @link        http://www.qisobao.cn

 */



class UserModel extends BaseModel{

	

	/**

	 * 用户表名称

	 */

	protected $trueTableName = 'ts_sys_user';

	

	/**

	 * 用户id的session名称

	 */

	protected $login_userid_session 	= 'LoginUserId';

	/**

	 * 用户名的session名称

	 */

	protected $login_username_session 	= 'LoginUserName';

	/**

	 * 用户信息的session名称

	 */

	protected $login_userinfo_session 	= 'LoginUserInfo';

	

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

		

		//按照配置重写设置session变量名

		$this ->login_userid_session 	= C('SESSION_PREFIX') .'LoginUserId';

		$this ->login_username_session 	= C('SESSION_PREFIX') .'LoginUserName';

		

		//不能覆盖用户信息的session，由于当从资金系统跳转到本系统时候，会将资金系统的用户登录信息覆盖，使得资金系统相关权限丢失

		$this ->login_userinfo_session 	= C('SESSION_PREFIX') .'LoginUserInfo';

	}

	

	

	

	/**

	 * 重写父类方法

	 * 

	 * 新增

	 * {@inheritDoc}

	 * @see BaseModel::insert()

	 */

	function insert( $postData ){

		load("@.des");

		//组合其他相关参数

		$data = $postData;

		$data['userpass'] = basic_encrypt('seo188');

		

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

	function selectOne( $map,$field ){
	
		//调用父类方法获取数据
		$data = parent:: selectOne( $map,$field );

		//将数据的中的大字段格式转化成php数组
		if( $data ){	
			// 获取当前用户的用户类型
			$me = $this -> getloginUserInfo();
			$usertype = $me['usertype'];
			switch ($usertype) {
				case 'admin':// 管理员
				case 'operation_manager':// 运维经理、
				case 'operation':// 运维经理
					$data['can_edit'] = 1; 
					break;
				
				default:
					# code...
					break;
			}
			
			
			switch ( $data['usertype'] ) {
				case 'admin':// 管理员
				case 'operation_manager':// 运维经理
				case 'operation':// 运维
				case 'agent':// 一级代理商
				case 'agent2':// 二级代理商
				//case 'sales_manager':// 销售经理
					// 可以添加员工
					$data['can_add_staff'] = 1;
					break;
				default:
					# code...
					break;
			}
			// 获取用户类型
			if( $data['usertype'] ){
				$model_role = D('Sys/UserRole');
				$map_role['rolecode'] 	= $data['usertype'];
				$map_role['status'] 	= 1;
				$role = $model_role -> selectOne( $map_role,'rolename' );
				$data['usertype_desc'] = $role['rolename'];
			}
			
			// 加载企业信息
			if( $data['epid'] && $data['usergroup'] != 'Manage'){
				// 系统企业模型
	        	$model_epdir = D( 'Sys/Epdir' ); 
	        	$epdir = $model_epdir -> selectOne( array('id' => $data['epid']),'id,epname,seller,operationer,customer,product,isopen_oem,isopen_subagent');
	        	$data['epdir']  		= $epdir;
	        	$data['epname']  		= $epdir['epname'];
	        	$data['isopen_oem']  	= $epdir['isopen_oem'];
	        	$data['isopen_subagent']  = $epdir['isopen_subagent'];
	        	$data["seller_id"] 		= $epdir['seller'];
  				$data["operation_id"]  	= $epdir['operationer'];
  				$data["customer_id"]  	= $epdir['customer'];
  				$data['product_arr'] 	= $epdir['product_arr'];
  				$data['products'] 		= $epdir['products'];
  				$data['productids'] 	= $epdir['productids'];
  				$data['productnames'] 	= $epdir['productnames']; 
  				// 获取销售、客服、运维人员名册
				if( $data['customer_id'] ){
					$customer = $this -> where( array('id' => $data['customer_id'] )) -> find();
					$data['customer_name'] = $customer['username'];
				}
					
				// 如果是代理用户，验证是否开通了OEM
				if( $data['usergroup'] =='Agent' && $data['isopen_oem'] ){
					// 获取域名或主机地址
					$host = $_SERVER['HTTP_HOST'];
					
					$mode_oem = D('Sys/OEM');
					$data_oem = $mode_oem -> selectOne ( array('epid' => $data['epid'] ));
					
					// 如果是在我们的域名中进行登录，则不需要查询OEM
					if(  !in_array($host,C('HostOptions')) ){
						
						$data['oem_config'] = $data_oem;
					}else{
						if( $data_oem['show_mode'] == 'customer'){
							$oem_config['QQnumber'] = $data_oem['QQnumber'];
							$oem_config['telephone'] = $data_oem['telephone'];
							$data['oem_config'] = $oem_config;
						}
					}		
				}
			}
			
			// 如果是子用户或者是子代理
			if( $data['usertype']  == 'sub' || $data['usertype']  == 'agent2'){
			
				// OEM 配置用户的id
				// $oem_pid = $data['pid'];

				// 获取当前用户的父用户信息
				$data_p1 = $this -> selectOne( array('id' =>  $data['pid'] ));
				
				// 获取epid
				$epid_p = $data_p1['epid'];
				
				// 如果父用户是二级代理，那么还需要获取二级代理的夫用户
				if( $data_p1['pid'] && $data_p1['usertype'] == 'agent2'){
					// 获取当前用户的父用户信息
					$data_p2 = $this -> selectOne( array('id' =>  $data_p1['pid'] ));
					$data_p1['parent'] = $data_p2;
					//$oem_pid = $data_p1['pid'];
					// 获取epid
					$epid_p = $data_p2['epid'];
				}
				// $user_info['parent'] = $data_p1;

				// 获取域名或主机地址
				$host = $_SERVER['HTTP_HOST'];
				
				$mode_oem = D('Sys/OEM');
				$data_oem = $mode_oem -> selectOne ( array('epid' => $epid_p ));
					
				// 如果是在我们的域名中进行登录，则不需要查询OEM
				if(  !in_array($host,C('HostOptions')) ){
				
					$data['oem_config'] = $data_oem;
				}else{
					if( $data_oem['show_mode'] == 'customer'){
						$oem_config['QQnumber'] = $data_oem['QQnumber'];
						$oem_config['telephone'] = $data_oem['telephone'];
						$data['oem_config'] = $oem_config;
					}
				}	
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

		// 调用方法进行转换

		$this -> transList( $list );

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

		

			switch ($usertype) {

				case 'admin':// 管理员

				case 'operation_manager':// 运维经理、

				case 'operation':// 运维经理

					$vo['can_edit'] = 1;

					break;

		

				default:

					# code...

					break;

			}

				

		}

		

		// 调用方法进行转换

		$this -> transList( $list['data'] );

		

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



		// 获取当前用户的用户类型

		$me = $this -> getloginUserInfo();

		$usertype = $me['usertype'];

		

		switch ( $me['usertype'] ) {

			case 'customer_manager':// 客服经理

			case 'customer':// 客服

				// 客服用户可以登录子用户

				$list['can_login_subuser'] = 1;

				break;

			case 'agent':// 代理商用户

				$list['can_add_agent2'] = 1;

				$list['can_add_subuser'] = 1;

			case 'agent2':// 代理商用户

				$list['can_login_subuser'] = 1;

				$list['can_edit_subuser'] = 1;

				$list['can_login_subagent'] = 1;

				break;

			case 'operation_manager':

			case 'operation':

				//$list['can_add_agent'] = 1;

				break;

			case 'admin':

				$list['can_add_agent'] = 1;

				break;

			default:

				;

				break;

		}

		

		

		switch ($usertype) {

			case 'admin':// 管理员

			case 'operation_manager':// 运维经理、

			case 'operation':// 运维经理

			case 'agent':// 运维经理

			case 'agent2':// 运维经理

				$list['can_add_user'] = 1; 

				break;

			

			default:

				# code...

				break;

		}

	

		foreach( $list['data'] as  $key => &$vo ){

			

			switch ($usertype) {

				case 'admin':// 管理员

				case 'operation_manager':// 运维经理、

				case 'operation':// 运维经理

					$vo['can_edit'] = 1; 

					break;

				

				default:

					# code...

					break;

			}

			

			if( $vo['epid'] ){

				$epids[] = $vo['epid'];

			}

		}

		// 调用方法进行转换

		$this -> transList( $list['data'] );

		

		return $list;

	}

	

	/**

	 * 将查询的结果集进行转换

	 * 

	 * @param arrar $list

	 */

	function transList( &$list ){

		

		foreach( $list as &$vo ){

			

			// 企业id

			if( $vo['epid'] ){

				$epids[] = $vo['epid'];

			}

			// 用户类型	

			if( $vo['usertype'] ){

				$usertypes[] = $vo['usertype'];

			}

		

			// 获取当前用户的用户类型

			switch ($usertype) {

				case 'admin':// 管理员

				case 'operation_manager':// 运维经理、

				case 'operation':// 运维经理

					$vo['can_edit'] = 1;

					break;

		

				default:

					# code...

					break;

			}

		}

		

		// 加载企业信息

		$epids = array_unique($epids);

		if( $epids ){

			// 系统企业模型

			$model_epdir = D( 'Sys/Epdir' );

			$map_ep['id'] = array('IN',$epids);

			$epdirs = $model_epdir -> queryRecordAll( $map_ep,'id,epname,seller,operationer,customer,product,isopen_oem,isopen_subagent');

		}

		// 加载用户类型

		$usertypes  = array_unique($usertypes);

		if( $usertypes ){

			// 系统角色模型

			$model_role = D('Sys/UserRole');

			$map_role['rolecode'] = array('IN',$usertypes);

			$roles = $model_role -> queryRecordAll( $map_role,'rolecode,rolename');

		}

		$mode_oem = D('Sys/OEM');

		foreach( $list as &$vo_user ){

			$epdir = list_search($epdirs, array('id' => $vo_user['epid']));

				

			$vo_user['epdir'] = $epdir[0];

			$vo_user['epname']  		= $epdir[0]['epname'];

			$vo_user['isopen_oem']  	= $epdir[0]['isopen_oem'];

			$vo_user['isopen_subagent']  = $epdir[0]['isopen_subagent'];

			$vo_user["seller_id"] 		= $epdir[0]['seller'];

			$vo_user["operation_id"]  	= $epdir[0]['operationer'];

			$vo_user["customer_id"]  	= $epdir[0]['customer'];

			$vo_user['product_arr'] 	= $epdir[0]['product_arr'];

			$vo_user['products'] 		= $epdir[0]['products'];

			$vo_user['productids'] 		= $epdir[0]['productids'];

			$vo_user['productnames'] 	= $epdir[0]['productnames'];

			if( $vo_user['customer_id'] ){

				$customer = $this -> where( array('id' => $vo_user['customer_id'] )) -> find();

				$vo_user['customer_name'] = $customer['username'];

			}

				

			// 验证是否开通了OEM

			if( $vo_user['isopen_oem'] ){

				// 获取域名或主机地址

				$host = $_SERVER['HTTP_HOST'];

				// 如果是在我们的域名中进行登录，则不需要查询OEM

				if(  !in_array($host,C('HostOptions')) ){

		

					$data_oem = $mode_oem -> selectOne ( array('epid' => $vo_user['epid'] ));

					$vo_user['oem_config'] = $data_oem;

				}

			}

				

				

			$role = list_search($roles, array('rolecode' => $vo_user['usertype']));

			

			$vo_user['usertype_desc'] = $role[0]['rolename'];

				

		}

		return $list;

	}

	

	

	/**

	 * 外部接口：获得当前登录的用户编号

	 *

	 * @return string 当前登录的用户编号

	 */

	public function getLoginUserId( ) {

		return $_SESSION[$this->login_userid_session];

	}

	

	/**

	 * 外部接口：获得当前登录的用户名

	 *

	 * @return string 当前登录的用户名

	 */

	public function getLoginUserName( ) {

		return $_SESSION[$this->login_username_session] ;

	}

	

	/**

	 * 外部接口：获得当前登录的用户信息

	 *

	 * @return array 当前登录的用户信息

	 */

	public function getLoginUserInfo( ) {

		$userInfo = unserialize($_SESSION[$this->login_userinfo_session]);

		return $userInfo;

	}

	

	/**

	 * 用户绑定微信，可以提供给子类继承

	 *

	 * @param $wxopenid  用户的微信openid

	 * @param $loginname 登录用户标示

	 * @param $loginpass 登录用户口令

	 *

	 * @return array 当前登录的用户信息

	 */

	public  function bindWechat( $wxinfo, $loginname, $loginpass, $usertype = null, $onlyUserName = false ) {

		//加载用户

		$loginUser = $this->checkUserLocal( $loginname, $loginpass, $usertype, $onlyUserName );

		//保存微信信息；

		return $this->saveWxInfo($wxinfo, $loginUser, $loginname );

	}

	

	/**

	 * 将微信信息

	 *

	 * @param $wxopenid  用户的微信openid

	 * @param $loginname 登录用户标示

	 * @param $loginpass 登录用户口令

	 *

	 * @return array 当前登录的用户信息

	 */

	protected function saveWxInfo( $wxinfo, $loginUser, $loginname ){

		 

		if( $loginUser ){

			//绑定微信信息

			$wxuserinfo["userid"] = $loginUser["id"];

			$wxuserinfo["usertype"] =  $loginUser['usertype'];

			$wxuserinfo["unionid"] =  $wxinfo['unionid'];

			$wxuserinfo["openid"] =  $wxinfo['openid'];

			$wxuserinfo["nickname"] =  $wxinfo['nickname'];

			$wxuserinfo["headimgurl"] =  $wxinfo['headimgurl'];

			$wxuserinfo["userinfo"] =  json_encode($wxinfo['headimgurl']);

			$wxuserinfo["status"] =  '1';

			$model = M("Sys_wxbindinfo");

			$map['userid'] = $loginUser["id"];

			// update By Richer 于20161125 一个企业可以绑定多个微信号，在进行查询的时候需要根据微信的openid来进行筛选

			$map['openid'] = $wxinfo["openid"];

			// update By Richer 于20161125 解除绑定的时候，不删除当前绑定信息，只将可用状态设置为0

			$map['status'] = 1;

			$wxdata = $model -> where($map) -> find();

			if( $wxdata ){

				$wxuserinfo['id'] = $wxdata['id'];

				$wxuserinfo["moduser"] =  $loginname;

				$wxuserinfo["modtime"] =  time();

				$result = $model -> save($wxuserinfo);

			}else{

				$wxuserinfo["reguser"] =  $loginname;

				$wxuserinfo["regtime"] =  time();

				$result = $model -> add($wxuserinfo);

			}

			if( $result ){

				$loginUser["wechatinfo"] = $wxuserinfo;

				return $loginUser;

			}

		}

		//返回

		return false;

	}

	

	/**

	 * 用户解除微信绑定，可以提供给子类继承

	 *

	 * @param $wxopenid  用户的微信openid

	 * @param $loginname 登录用户标示

	 * @param $loginpass 登录用户口令

	 *

	 * @return array 当前登录的用户信息

	 */

	public  function unBindWechat( $userid = null ) {

		$userid = $userid? $userid: $this->getLoginUserId();

		$loginUserInfo = $this->getLoginUserInfo();

		// dump($loginUserInfo);exit;

		//构造查询条件

		$map['userid'] = $userid;

		$map['openid'] = $loginUserInfo['wechatinfo']['openid'];

		$map['status'] = 1;

		//删除绑定信息

		//return M("Sys_wxbindinfo") -> where($map) -> delete();

		//update By Richer 于20161125 解除绑定的时候，不删除当前绑定信息，只将可用状态设置为0

		$data['status'] = 0;

		$result = M("Sys_wxbindinfo") -> where($map) -> save( $data );

		//	dump( M("Sys_wxbindinfo") ->  _sql());exit;

		return $result;

		//return M("Sys_wxbindinfo") -> where($map) -> delete();

	}

	

	/**

	 * 设置用户会话

	 *

	 * @return array 当前登录的用户信息

	 */

	public function setUserSession( $userid, $username, $userinfo ) {

	

		if( $userinfo ){

			

			$session_prefix = strtoupper( $userinfo['role_info']['rolegroup'] ) .'_SESSION_';

			/* //按照配置重写设置session变量名

			switch ( $userinfo['role_info']['rolegroup']) {

				case 'Service':

					

					$session_prefix = 'SERVICE_SESSION_';

					break;

			

				case 'Agent':

					$session_prefix = 'AGENT_SESSION_';

					// 由于代理端存在子代理

					if( $userinfo['role_info']['rolelevel'] > 1  ){

						$session_prefix = $session_prefix.$userinfo['role_info']['rolelevel'].'_';

					}

					break;

				case 'Manage':

					$session_prefix = 'MANAGE_SESSION_';

					break;

				default:

					//按照配置重写设置session变量名

					$session_prefix = 'SERVICE_SESSION_';

					break;

			}

			 */

			$this ->login_userid_session 	= $session_prefix .'LoginUserId';

			$this ->login_username_session 	= $session_prefix .'LoginUserName';

			$this ->login_userinfo_session 	= $session_prefix .'LoginUserInfo';

		} 

		

		$_SESSION[$this->login_userid_session] = $userid;

		//$_SESSION[$this->login_username_session] 	=  $userid ;

		$_SESSION[$this->login_username_session] 	=  $username ;

		$_SESSION[$this->login_userinfo_session] = serialize($userinfo);

		

	

		

		session(array('name'=>$this->login_userid_session,'expire'=>60));

		session(array('name'=>$this->login_username_session,'expire'=>60));

		session(array('name'=>$this->login_userinfo_session,'expire'=>60));

		

		$SESSION_Options = C('SESSION_Options');

		$_SESSION[$SESSION_Options['expired_para']] = time();

	

		return true;

	}

	

	/**

	 * 验证用户权限

	 *

	 * @return array 当前登录的用户信息

	 */

	public function checkUserRemote( $userid ) {

	

		//设置session

		$userinfo['useid'] = $userid;

		$userinfo['username'] = $userid;

		$userinfo['userlevel'] = 0; //默认用户级别

		$this->setUserSession($userid, $userid, $userinfo);

	

		//检查本地用户权限配置，如果存在本地用户，则取本地用户的配置

		$map['uname'] = $userid;

		$data_user = $this -> selectOne($map);

		if( $data_user ){

			$this->setUserSession($userid, $userid, $data_user);

			return $data_user;

		}else{

			return $userinfo;

		}

	

	}

	

	/**

	 * 本地验证用户权限

	 *

	 * @return array 当前登录的用户信息

	 */

	public function checkUserLocal( $username, $userpass ) {

		load("@.des");

		$map['username'] 	= $username;

		$map['userpass'] 	= basic_encrypt($userpass);

		$user_info = $this -> selectOne($map);

		$user_info = $this -> transData( $user_info );

		return  $user_info;

	}

	

	/**

	 * 本地验证子用户用户权限

	 *

	 * @return array 当前登录的用户信息

	 */

	public function checkUserLocalSub( $userid ) {

	

		$user_info = $this -> selectOne( array('id' => $userid ));



		$user_info = $this -> transData( $user_info );

		return  $user_info;

	}

	

	/**

	 * 用户登录成功后数据转换

	 *

	 * @return array 当前登录的用户信息

	 */

	public function transData( $user_info ) {

		

		if( $user_info ){

			//登录成功后写入登录日志

			$model = D('User/Login');

			//登录成功后判断当前用户是否已经登录

			$isLoggedin  = $model -> isLoggedin( $user_info['id'] );

			$user_info['isLoggedin'] = $isLoggedin;

			$log = $model -> addRecord( $user_info );

			$user_info["IPaddress"] = $log["IPaddress"];

			$user_info["city"] 		= $log["city"];

			$user_info["logintime"] = $log["logintime"];

				

	

			// 			switch ( $user_info['usertype'] ) {

			// 				case 'sub' :

			// 				case 'agent2' :

			// 					// OEM 配置用户的id

			// 					$oem_pid = $user_info['pid'];

				

			// 					// 获取当前用户的父用户信息

			// 					$data_p1 = $this -> selectOne( array('id' =>  $user_info['pid'] ));

				

			// 					if( $data_p1['pid'] && $data_p1['usertype'] == 'agent2'){

			// 						// 获取当前用户的父用户信息

			// 						$data_p2 = $this -> selectOne( array('id' =>  $data_p1['pid'] ));

			// 						$data_p1['parent'] = $data_p2;

			// 						$oem_pid = $data_p1['pid'];

			// 					}

			// 					$user_info['parent'] = $data_p1;

	

			// 					// 获取域名或主机地址

			// 					$host = $_SERVER['HTTP_HOST'];

			// 					// 如果是在我们的域名中进行登录，则不需要查询OEM

			// 					if(  !in_array($host,C('HostOptions')) ){

			// 						$mode_oem = D('Sys/OEM');

			// 						$data_oem = $mode_oem -> selectOne ( array('userid' => $oem_pid ));

			// 						$user_info['oem_config'] = $data_oem;

			// 					}

			// 				break;

	

			// 				case 'agent' :

			// 					// OEM 配置用户的id

			// 					$userid = $user_info['id'];

			// 					// 获取域名或主机地址

			// 					$host = $_SERVER['HTTP_HOST'];

			// 					// 如果是在我们的域名中进行登录，则不需要查询OEM

			// 					if(  !in_array($host,C('HostOptions')) ){

			// 						$mode_oem = D('Sys/OEM');

			// 						$data_oem = $mode_oem -> selectOne ( array('userid' => $userid ));

			// 						$user_info['oem_config'] = $data_oem;

			// 					}

				

			// 					break;

			// 				case 'seller' :

			// 				case 'sales_manager' :

				

			// 					// 如果是Agent分组，需要判断该代理商是否已经开通了OEM功能

				

			// 					if( $user_info['usergroup'] == 'Agent' || $user_info['usergroup'] == 'Agent2') {

			// 						// 获取企业基本信息

			// 					}

			// 					dump($user_info);exit;

			// 					// OEM 配置用户的id

			// 					$userid = $user_info['id'];

			// 					// 获取域名或主机地址

			// 					$host = $_SERVER['HTTP_HOST'];

			// 					// 如果是在我们的域名中进行登录，则不需要查询OEM

			// 					if(  !in_array($host,C('HostOptions')) ){

			// 						$mode_oem = D('Sys/OEM');

			// 						$data_oem = $mode_oem -> selectOne ( array('userid' => $userid ));

			// 						$user_info['oem_config'] = $data_oem;

			// 					}

	

			// 					break;

	

			// 				default:

			// 					;

			// 				break;

			// 			}

			// 登录成功后，如果是子用户需要获取该子用户代理的相关OEM配置

			// 			if( $user_info['usertype']  == 'sub' || $user_info['usertype']  == 'agent2'){

	

			// 				// OEM 配置用户的id

			// 				$oem_pid = $user_info['pid'];

	

			// 				// 获取当前用户的父用户信息

			// 				$data_p1 = $this -> selectOne( array('id' =>  $user_info['pid'] ));

	

			// 				if( $data_p1['pid'] && $data_p1['usertype'] == 'agent2'){

			// 					// 获取当前用户的父用户信息

			// 					$data_p2 = $this -> selectOne( array('id' =>  $data_p1['pid'] ));

			// 					$data_p1['parent'] = $data_p2;

			// 					$oem_pid = $data_p1['pid'];

			// 				}

			// 				$user_info['parent'] = $data_p1;

				

			// 				// 获取域名或主机地址

			// 				$host = $_SERVER['HTTP_HOST'];

			// 				// 如果是在我们的域名中进行登录，则不需要查询OEM

			// 				if(  !in_array($host,C('HostOptions')) ){

			// 					$mode_oem = D('Sys/OEM');

			// 					$data_oem = $mode_oem -> selectOne ( array('userid' => $oem_pid ));

			// 					$user_info['oem_config'] = $data_oem;

			// 				}

	

			// 			}

			// 获取登录用户的角色信息

			$map_role['rolecode'] 	= $user_info['usertype'];

			$map_role['rolegroup'] 	= $user_info['usergroup'];

			$map_role['status'] 	= 1;

			$user_info['role_info'] = D('Sys/UserRole') -> selectOne( $map_role );

				

				

			// 获取登录用户的角色信息

			$user_info['depart_info'] = D('Sys/Departinfo') -> selectOne( array('id' => $user_info['role_info']['departid']));

				

			/* // 登录成功后，如果是子用户需要获取该子用户代理的相关工单信息，主要是未处理的工单，或者有回复未读取的工单

			if( $user_info['usertype']  == 'sub'){

				$workorders_num = D('Biz/Workorder') -> getUntreatedNum( $user_info['id'] );

				$user_info['untreated_workorder_num'] = $workorders_num;

			} */

			$this->setUserSession($user_info['id'],$user_info['username'],$user_info);

	

			return $user_info;

		}else

			return false;

	}

	

	/**

	 * 本地验证用户权限

	 *

	 * @return array 当前登录的用户信息

	 */

	public function updateUserinfo( $postData ) {

		$me 		= $this->getLoginUserInfo();

		$data 		= $postData;

		$data['id'] = $me['id'];

		

		$result 	= $this-> update( $data );

		

		//重新获取用户信息

		$user_info = $this -> selectOne( array('id' => $me['id'] ));

	

		$this->setUserSession($user_info['id'],$user_info['username'],$user_info);

	

		return $result;

	}

	

	/**

	 * 本地验证用户权限

	 *

	 * @return array 当前登录的用户信息

	 */

	public function updatePassword( $postData ) {

		load("@.des");

		$me 		= $this->getLoginUserInfo();

		$map['id'] 	= $me['id'];

		$userpass 	= $postData['password'] ;

		//比较密码是否正确

		if( !$userpass ){

			$this -> error ="请您输入原始密码！";

			return false;

		}

		

		$userpass_old = $me['userpass'];

		if( basic_encrypt($userpass) != $userpass_old){

			$this -> error ="您输入的原始密码不正确！";

			return false;

		}

		

		if( $postData['newpassword1'] != $postData['newpassword2']){

			$this -> error ="您两次输入的密码不一致！";

			return false;

		}

		

		

		$data['userpass'] 	= basic_encrypt( $postData['newpassword1'] );

		$data['id'] 		= $me['id'];

		$result 			= $this-> update( $data );

		//重新获取用户信息

		$user_info = $this -> selectOne( array('id' => $me['id'] ));



		$this->setUserSession($user_info['id'],$user_info['username'],$user_info);

	

		return $result;

	}

	

	/**

	 * 修改子用户密码

	 *

	 * @return array 修改子用户密码

	 */

	public function updateSubUserPassword( $postData ) {

		load("@.des");

		// 用户id

		$userid 	= $postData['id'];

		// 用户输入原始密码

		$userpass 	= $postData['userpass_old'] ;



		// 比较是否输入了原始密码

// 		if( !$userpass ){

// 			$this -> error ="请您输入原始密码！";

// 			return false;

// 		}

		

// 		// 比较用户输入的密码是否正确

// 		$map['id'] 			= $userid;

// 		$map['userpass'] 	= basic_encrypt( $userpass );

// 		// 获取用户的信息

// 		if( !$this -> selectOne( $map )){

// 			$this -> error ="您输入的原始密码不正确！";

// 			return false;

// 		}



		// 比较两次输入的密码是否一致

		if( $postData['userpass_new1'] != $postData['userpass_new2']){

			$this -> error ="您两次输入的密码不一致！";

			return false;

		}

	

		// 更新用户密码

		$data['userpass'] 	= basic_encrypt( $postData['userpass_new1'] );

		$data['id'] 		= $userid;

		$result 			= $this-> update( $data );

		return $result;

	}

	

	/**

	 * 修改代理商用户密码

	 * 

	 * 管理账户修改代理商密码的时候不需要判断该用户的原始密码

	 *  

	 * @return array 修改代理商用户密码

	 */

	public function updateAgentUserPassword( $postData ) {

		load("@.des");

		// 用户id

		$userid 	= $postData['id'];

// 		// 用户输入原始密码

// 		$userpass 	= $postData['userpass_old'] ;

	

// 		// 比较是否输入了原始密码

// 		if( !$userpass ){

// 			$this -> error ="请您输入原始密码！";

// 			return false;

// 		}

	

		// 比较用户输入的密码是否正确

// 		$map['id'] 			= $userid;

// 		$map['userpass'] 	= basic_encrypt( $userpass );

// 		// 获取用户的信息

// 		if( !$this -> selectOne( $map )){

// 			$this -> error ="您输入的原始密码不正确！";

// 			return false;

// 		}

	

		// 比较两次输入的密码是否一致

		if( $postData['userpass_new1'] != $postData['userpass_new2']){

			$this -> error ="您两次输入的密码不一致！";

			return false;

		}

	

		// 更新用户密码

		$data['userpass'] 	= basic_encrypt( $postData['userpass_new1'] );

		$data['id'] 		= $userid;

		$result 			= $this-> update( $data );

		return $result;

	}

	

	

	/**

	 * 获取全部的代理商

	 *

	 * @param unknown $userid

	 */

	function getAgentUser( ){

		

	

		// 获取该代理商下面的全部子用户

		$map_user['usertype'] 	= 'agent';

		// $map_user['pid'] 		= $userid;

		$map_user['status']		= 1;

		$users = $this -> queryRecordAll( $map_user,'id,username,truename,email,telephone,contact,usertype,epid,mobileno,createtime' );

	

		return $users;

	}

	

	/**

	 * 获取代理商下面的全部子用户信息

	 * 

	 * @param unknown $userid

	 */

	function getSubUserForAgent( $userid ){

		if( !$userid ){

			$userid = $this -> getLoginUserId();

		}

		

		// 获取该代理商下面的全部子用户

		$map_user['usertype'] 	= 'sub';

		$map_user['pid'] 		= $userid;

		$map_user['status']		= 1;

		$users = $this -> queryRecordAll( $map_user,'id,username,truename,email,telephone,contact,usertype,epid,mobileno,createtime');

		

		return $users;

	}

	

	

	/**

	 * 获取代理商下面的子代理和子用户

	 *

	 * @param unknown $userid

	 */

	function getChildren( $check_id ,$id ){

		

		$me =$this -> getLoginUserInfo();

		if( !$id ){

			$id = $me['id'];

		}

		switch ( GROUP_NAME) {

			case 'Manage':// 管理端获取全部的代理商

				$agent_users = $model_user  -> getAgentUser( $this -> getLoginUserId() );

				foreach ($agent_users as $key => &$vo) {

				

					unset($children_subusers);

					$customer['id'] 	= $vo['id'];

					$customer_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;" value="'.$vo['id'].'" onclick=check_all(this) id="id_'.$vo['id'].'"' ;

					if( $vo['seller_id'] == $check_id ){

						$customer_name .= ' checked';

					}

					$customer_name .= '>&nbsp;&nbsp;<label for="id_'.$vo['id'].'">'. $vo['username'] .'<span style="margin-left:15px;font-size:12px;">(一级代理商)</span></label>' ;

					$customer['name']  = $customer_name;

				

					// 如果用户开启了二代的功能

					if( $vo['isopen_subagent'] == 1 ){

						$sub_agent_users = $model_user  ->getSubAgent($vo['id']);

						// 获取二代的全部子用户

						foreach ($sub_agent_users as  &$vo_sub_agent) {

				

							$children_subagent['id'] = $vo_sub_agent['id'];

							$children_subagent_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;" value="'.$vo_sub_agent['id'].'" onclick=check_all(this) id="id_'.$vo_sub_agent['id'].'"' ;

							if( $vo_sub_agent['seller_id'] == $check_id ){

								$children_subagent_name .= ' checked';

							}

							$children_subagent_name .= '>&nbsp;&nbsp;<label for="id_'.$vo_sub_agent['id'].'">'. $vo_sub_agent['username'] .'<span style="margin-left:15px;font-size:12px;">(二级代理商)</span></label>' ;

							$children_subagent['name']  = $children_subagent_name;

				

				

							$sub_agetn_subusers = $model_user  ->getSubUserForAgent($vo_sub_agent['id']);

							$vo_sub_agent['sub_users'] = $sub_agetn_subusers;

				

							unset($children_subagent_children);

							foreach ($sub_agetn_subusers as $vo_sub_agent_subuser) {

				

								$children_subagent_subuser['id'] = $vo_sub_agent_subuser['id'];

				

								$children_subagent_subuser_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;" value="'.$vo_sub_agent_subuser['id'].'" onclick=check_all(this) id="id_'.$vo_sub_agent_subuser['id'].'"' ;

								if( $vo_sub_agent_subuser['seller_id'] == $check_id ){

									$children_subagent_subuser_name .= ' checked';

								}

								$children_subagent_subuser_name .= '>&nbsp;&nbsp;<label for="id_'.$vo_sub_agent_subuser['id'].'">'. $vo_sub_agent_subuser['username'] .'<span style="margin-left:15px;font-size:12px;">(子用户)</span></label>' ;

				

								$children_subagent_subuser['name']  = $children_subagent_subuser_name;

								$children_subagent_children[] = $children_subagent_subuser;

							}

				

							$children_subagent['children'] = $children_subagent_children;

				

							$children_subusers[] = $children_subagent;

						}

						$vo['sub_agent_users'] = $sub_agent_users;

					}

				

					$sub_users = $model_user  ->getSubUserForAgent($vo['id']);

				

					foreach ($sub_users as $vo_sub_user) {

				

						$children_subuser['id'] = $vo_sub_user['id'];

						$children_subuser_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;"  value="'.$vo_sub_user['id'].'" onclick=check_all(this) id="id_'.$vo_sub_user['id'].'"' ;

						if( $vo_sub_user['seller_id'] == $check_id ){

							$children_subuser_name .= ' checked';

						}

				

						$children_subuser_name .= '>&nbsp;&nbsp;<label for="id_'.$vo_sub_user['id'].'">'. $vo_sub_user['username'] .'<span style="margin-left:15px;font-size:12px;">(子用户)</span></label>' ;

				

						$children_subuser['name']  = $children_subuser_name;

				

				

						$children_subusers[] = $children_subuser;

					}

					$vo['sub_users'] = $sub_users;

				

					$customer['children'] 	= $children_subusers;

					$customers[] 	= $customer;

				}

				break;

			case 'Agent':// 需要获取该代理商下面的全部子用户和子代理

				// 

				if( $me['usertype'] != 'agent' ){

					// 获取代理商id

					$map_u['epid'] 		= $me['epid'];

					$map_u['usertype'] = 'agent';

					$user = $this -> selectOne($map_u,'id');

					

					$id = $user['id'];

				}

				// 获取全部的子用户和子代理

				$map['usertype'] 	= array( array('EQ','sub'),array('EQ','agent2'),'OR');

				$map['pid'] 		= $id;

				$map['status']		= 1;

				$customers = $this -> queryRecordAll( $map,'id,epid,username,truename,mobileno,telephone,QQnumber,contact,epname,usertype,usertype_desc' );

		

				foreach ($customers as &$vo ){

					if($vo['epdir']['seller'] == $check_id){

						$vo['is_checked'] = 1;

					}

				}

				break;

			default:

				;

				break;

		}

		return $customers;

	}

	

	/**

	 * 获取代理商下面的子代理

	 *

	 * @param unknown $userid

	 */

	function getSubAgent( $userid ){

		if( !$userid ){

			$userid = $this -> getLoginUserId();

		}

	

		// 获取全部的子代理

		// 获取该代理商下面的全部子用户

		$map_user['usertype'] 	= 'agent2';

		$map_user['pid'] 		= $userid;

		$map_user['status']		= 1;

		$users = $this -> queryRecordAll( $map_user,'id,epid,username,truename,mobileno,telephone,QQnumber,contact,epname,usertype,usertype_desc' );

	

		return $users;

	}

	

	/**

	 * 获取代理商下面的子代理的全部全部子用户信息

	 *

	 * @param unknown $userid

	 */

	function getSubUserForAgent2( $userid ){

		if( !$userid ){

			$userid = $this -> getLoginUserId();

		}

	

		// 获取该代理商下面的全部子用户

		$map_user['usertype'] 	= 'sub';

		$map_user['pid'] 		= $userid;

		$map_user['status']		= 1;

		$users = $this -> queryRecordAll( $map_user,'id,epid,username,truename,mobileno,telephone,QQnumber,contact,epname,usertype,usertype_desc');

	

		return $users;

	}





	/**

	 * 获取代理商下面的子代理的全部全部子用户信息

	 *

	 * @param unknown $userid

	 */

	function getSubSubUserForAgent( $userid ){

		if( !$userid ){

			$userid = $this -> getLoginUserId();

		}



		$sub_agents = $this -> getSubAgent();



		foreach ( $sub_agents as $vo ) {

			$sub_agentids[] = $vo['id'];

		}

		

		// 获取全部的子代理

		// 获取该代理商下面的全部子用户

		

		if( $sub_agentids ) {

			$map_user['usertype'] 	= 'sub';

			$map_user['pid'] 		= array('IN',$sub_agentids);

			$map_user['status']		= 1;

			$users = $this -> queryRecordAll( $map_user,'id,username,truename,epname' );

		}

		

		

		foreach ($users_agent2 as $vo ){

			$userids[] = $vo['id'];

		}

		if( $userids ){

			// 获取该代理商下面的全部子用户

			$map_user['usertype'] 	= 'sub';

			$map_user['pid'] 		= array('IN',$userids);

			$map_user['status']		= 1;

			$users = $this -> queryRecordAll( $map_user,'id,username,truename,epname' );

		}

	

		return $users;

	}

	

	/**

	 * 获取会员数量

	 *

	 * 获取会员数量

	 *

	 * @return mixed 查询结果

	 */

	public function getMembersNum( $id ) {

		$me = $this -> getLoginUserInfo();

		if( !$id ){

			$id = $me['id'];

		}

		// 实例化服务用户模型

		$map['pid'] = $id;

		$serveruser_num = $this -> where($map) -> count();

		

		// 如果当前的代理商是开启了二级代理

		if( $me['isopen_subagent']){

			

		}

	 

		return $serveruser_num;

	}

	

	

	/**

	 * 获取代理商子用户数量

	 *

	 * 获取代理商子用户数量

	 *

	 * @return mixed 查询结果

	 */

	public function getSubUserNum( $id ) {

		$me = $this -> getLoginUserInfo();

		if( !$id ){

			$id = $me['id'];

		}

		// 实例化服务用户模型

		$map['pid'] = $id;

		$map['usertype'] = 'sub';

		$serveruser_num = $this -> where($map) -> count();

	

	

		return $serveruser_num;

	}

	



	/**

	 * 获取代理商子代理数量

	 *

	 * 获取代理商子代理数量

	 *

	 * @return mixed 查询结果

	 */

	public function getSubAgentNum( $id ) {

		$me = $this -> getLoginUserInfo();

		if( !$id ){

			$id = $me['id'];

		}

		// 实例化服务用户模型

		$map['pid'] = $id;

		$map['usertype'] = 'agent2';

		$serveruser_num = $this -> where($map) -> count();

	

	

		return $serveruser_num;

	}

	

	/**

	 * 获取每个角色的用户

	 *

	 */

	function getStaffCodeSet( $group = GROUP_NAME ){

		

		$list_sale = $this -> getDepartStaff( '/销售部', $group ) ;

		foreach ($list_sale as $vo_sale){

			$sale_codeSet[$vo_sale['id']] = $vo_sale['username'];

		}

		

		$list_customer = $this -> getDepartStaff( '/客服部', $group ) ;

		foreach ($list_customer as $vo_customer){

			$customer_codeSet[$vo_customer['id']] = $vo_customer['username'];

		}

		

		

		$list_operation = $this -> getDepartStaff( '/运维部', $group ) ;

		foreach ($list_operation as $vo_operation){

			$operation_codeSet[$vo_operation['id']] = $vo_operation['username'];

		}

		

		

		$data['operation_codeSet'] 	= $operation_codeSet;

		$data['sale_codeSet'] 		= $sale_codeSet;

		$data['customer_codeSet'] 	= $customer_codeSet;

		return $data;

	}

	

	/**

	 * 

	 * @param unknown $orgpath

	 * @return var

	 */

	function getDepartStaff( $orgpath ,$group){

		// 部门模型

		$model_departinfo = D('Sys/Departinfo');

		

		// 角色模型

		$model_role = D('Sys/UserRole');

		

		// 获取销售部门全部用户

		$map_depart['orgpath'] = array('LIKE' , $orgpath .'%');

		$map_depart['orggroup'] = $group;

		$data_depart = $model_departinfo -> selectOne( $map_depart );

		

		// 获取销售角色

		$map_role['departid'] = $data_depart['id'];



		$data_role = $model_role -> queryRecordAll( $map_role );

		

		foreach ($data_role as $vo ){

			$roles[] = $vo['rolecode'];

		}

		if( $roles ){

			$map_user['usertype'] 	= array('IN', $roles );

			$map_user['usergroup'] = $group;

			$map_user['status'] 		= 1;

			$list =  $this -> queryRecordAll( $map_user );

		}

		return $list;

	}

	

	/**

	 * 获取销售用户的全部客户

	 * 

	 * @param unknown $orgpath

	 * @return var

	 */

	function getUsersForSale( $loginUserInfo ){

		if( !$loginUserInfo ){

			$loginUserInfo = $this -> getloginUserInfo();

		}

		

		$role_info 		= $loginUserInfo['role_info'];

		$depart_info 	= $loginUserInfo['depart_info'];

		

		// 员工id

		$staffids[] =  $loginUserInfo['id'];

		

		// 如果是一级角色，获取该用户的全部子用户

		if(  $role_info ['rolelevel']  = 1 ){

			// 获取全部的子用户

			$map_staff['pid'] 	= $loginUserInfo['id'];

			$map_staff['status'] = 1;

		

			$staffs = $this -> queryRecordAll( $map_staff );

		

			foreach ($staffs as $vo_staff){

				$staffids[]= $vo_staff['id'];

			}

		}

		

		if( $staffids ){

			$map_user['seller_id'] 	= array('IN' , $staffids);

			$map_user['status'] 	= 1;

			$users = $this -> queryRecordAll( $map_user );

			foreach ($users as $vo ){

				if( $vo['usertype'] == 'agent'){

					$map_user1['pid'] 	=  $vo['id'];

					$map_user1['status'] = 1;

					$users1 = $this -> queryRecordAll( $map_user1 );

					foreach ($users1 as $vo_user1 ){

						$userids[] = $vo_user1['id'];

					}

				}else {

					$userids[] = $vo['id'];

				}

			}

			$userids = array_unique( $userids );

		}

		

		return $userids;

	}



	/**

	 * 获取下级用户

	 * 

	 * @param string $userid

	 */

	function getChildrenUsers( $userid ){

		

		//$map['pid'] 		= $this -> getLoginUserId();

		if( !$userid ){

			$userid = $this -> getLoginUserId();

		}

		$map['pid'] 	=  $userid;

		$map['status'] 	= 1;

		$list  =  $this -> queryRecordAll( $map );

		return  $list;

	}



	/**

	 * 根据销售员工的id获取全部的用户下级用户

	 *

	 * @param string $userid

	 */

	function getAgentBySeller( $userids ){

	

		$model_epdir 	= D ( 'Sys/Epdir' );

	

		//$map['pid'] 		= $this -> getLoginUserId();

		if( $userids ){

			$map_ep['seller'] = array('IN', $userids );

			$epdirs  =  $model_epdir -> queryRecordAll( $map_ep);

			foreach ($epdirs as $vo ){

				$epids[] = $vo['id'];

			}

				

			if( $epids ){

				$map['epid'] 		= array('IN', $epids );

				$map['usertype'] 	= array('EQ', 'agent' );

				$map['status'] 		= 1;

				$list = $this -> queryRecordAll($map,'id,username,usertype,epid,mobileno,createtime' );

			}

		}

	

		return  $list;

	}

	

	/**

	 * 根据销售员工的id获取全部的用户下级用户

	 *

	 * @param string $userid

	 */

	function getAgentByCustomer( $userids ){

	

		$model_epdir 	= D ( 'Sys/Epdir' );

	

		//$map['pid'] 		= $this -> getLoginUserId();

		if( $userids ){

			$map_ep['customer'] = array('IN', $userids );

			$epdirs  =  $model_epdir -> queryRecordAll( $map_ep);

			foreach ($epdirs as $vo ){

				$epids[] = $vo['id'];

			}

	

			if( $epids ){

				$map['epid'] 		= array('IN', $epids );

				$map['usertype'] 	= array('EQ', 'agent' );

				$map['status'] 		= 1;

				$list = $this -> queryRecordAll($map,'id,username,usertype,epid,mobileno,createtime' );

			}

		}

	

		return  $list;

	}

	

	

	

	/**

	 * 根据销售员工的id获取全部的用户下级用户

	 *

	 * @param string $userid

	 */

	function getUsersBySeller( $userids ){

		

		$model_epdir 	= D ( 'Sys/Epdir' );

	

		//$map['pid'] 		= $this -> getLoginUserId();

		if( $userids ){

			$map_ep['seller'] = array('IN', $userids );

			$epdirs  =  $model_epdir -> queryRecordAll( $map_ep);

			foreach ($epdirs as $vo ){

				$epids[] = $vo['id'];

			}

			

			if( $epids ){

				$map['epid'] 	= array('IN', $epids );

				$map['usertype'] = array( array('EQ', 'agent' ),array('EQ', 'agent2' ),array('EQ', 'sub' ),'OR');

				$map['status'] 	= 1;

				$list = $this -> queryRecordAll($map,'id,username,usertype,epid,mobileno,createtime' );

			}

		}

		

		return  $list;

	}

	

	/**

	 * 根据销售员工的id获取全部的用户下级用户

	 *

	 * @param string $userid

	 */

	function getUsersByCustomer( $userids ){

	

		$model_epdir 	= D ( 'Sys/Epdir' );

	

		//$map['pid'] 		= $this -> getLoginUserId();

		if( $userids ){

			$map_ep['customer'] = array('IN', $userids );

			$epdirs  =  $model_epdir -> queryRecordAll( $map_ep );

			foreach ($epdirs as $vo ){

				$epids[] = $vo['id'];

			}

				

			if( $epids ){

				$map['epid'] 	= array('IN', $epids );

				$map['usertype'] = array( array('EQ', 'agent' ),array('EQ', 'agent2' ),array('EQ', 'sub' ),'OR');

				$map['status'] 	= 1;

				$list = $this -> queryRecordAll($map,'id,username,usertype,epid,mobileno,createtime' );

			}

		}

	

		return  $list;

	}

	

	/**

	 * 根据销售员工的id获取全部的用户下级用户

	 *

	 * @param string $userid

	 */

	function getSUbUsersByManage( ){

	

	

		$map['usertype'] = array('EQ', 'sub' );

		$map['status'] 	= 1;

		$list = $this -> queryRecordAll($map,'id,username,usertype,epid,mobileno,createtime' );

		

	

		return  $list;

	}

	

	/**

	 * 获取子用户的全部的代理商

	 *

	 * @param unknown $userid

	 */

	function getAgentUserForSub( $userids ){

		

		if( !$userids){

			$userids[] = $this -> getLoginUserId();

		}

		

		if( $userids ){

			$map['id'] = array('IN',$userids);

			$list = $this -> queryRecordAll( $map,'id,pid' );

			foreach ($list as $vo1 ){

				$pids[] = $vo1['pid'];

			}

			$pids = array_unique( $pids );

			if( $pids ){

				$map['id'] = array('IN',$pids);

				$agents = $this -> queryRecordAll($map,'id,username' );

				foreach ($list as &$vo ){

					$agent = list_search($agents, array('id' => $vo['pid']));

					$vo['agent'] = $agent[0];

				}

			}

		}

	

		return $list;

	}

}

	

?>