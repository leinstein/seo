<?php

/**
 * 模型层：系统管理模型
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170518
 * @link        http://www.qisobao.com
 */

class SysPermissionModel extends BaseModel{
	
	
	/**
	 * 不检查数据库
	 */
	protected $autoCheckFields = false;
	
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		
		//执行父类构造函数
		parent::_initialize();
		
	}
	
	
	/**
	 * 获取全部的部门
	 * 
	 * @param unknown $userid
	 * @return unknown|boolean
	 */
	public function getDepartment( $userid ) {

		$me = $this -> getloginUserInfo();
		if( !$userid ){
			$userid = $this -> getloginUserId();
		}
		// 初始化部门模型
		$model_departinfo 	= D ( 'Sys/Departinfo' );
		
		// 初始化角色模型
		$model_userrole 	= D ( 'Sys/UserRole' );
		
		// 初始化角色模型
		$model_user 		= D ( 'User/User' );
	
		$usergroup = !empty($me['usergroup']) ? $me['usergroup'] : GROUP_NAME;
		/* if( $usergroup == 'Agent2' ){
			$usergroup = 'Agent';
		} */
		
		$map['orggroup'] 	= $usergroup;
		$map['status'] 		= 1;
		$list = $model_departinfo -> queryRecordAll($map);
		
		// 获取机构下面的全部角色
		foreach ( $list as &$vo ){
			$map_role['departid'] 	= $vo['id'];
			//$map_role['rolelevel'] 	= 1;
			$map_role['status'] 		= 1;
			$userroles = $model_userrole -> queryRecordAll($map_role);
			
			// 获取每个角色下面的全部用户
			foreach ( $userroles as &$vo_role ){
				$map_user['epid'] 			= $me['epid'];
				$map_user['usertype'] 		= $vo_role['rolecode'];
				$map_user['rolegroup'] 		= $usergroup;
				$map_user['status'] 		= 1;
				$user = $model_user -> queryRecordAll( $map_user );
				$vo_role['user_info'] 	= $user;
			}
			$vo['roles'] = $userroles;
		}
		return $list;
	}
	
	/**
	 * 获取全部的部门
	 *
	 * @param unknown $userid
	 * @return unknown|boolean
	 */
	public function getRole( ) {
		// 初始化OEM模型
		$model_userrole = D ( 'Sys/UserRole' );
	
		return $model_userrole -> queryRecordEx($map);
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
	public function getStaffList( $map, $fields, $order = null,  $url_param = '', $num_per_page = 20) {
		// 初始化部门模型
		$model_user = D ( 'User/User' );
	
		// 获取登录用户的角色
		$me  = $this -> getloginUserInfo();
		if( $me['usertype'] != 'admin' ){
			$map['pid'] = $me['id'];
		}
	
	
		if ( !$map['usertype'] ){
				
			switch (  $me['role_info'] ['rolecode']  ) {
				case 'admin':
				case 'operation_manager':
				case 'operation':
					// 获取管理端用户的角色
					$userrole_options =  D( 'Sys/UserRole' ) ->  getManageRoleCodeset();
						
					$userroles = array_keys($userrole_options );
						
					if( $userroles ){
						$map['usertype'] 	= array('IN', $userroles );
						$map['userstatus'] 	= '正常';
						$map['status'] 		= 1;
						$list =  $model_user -> queryRecordEx( $map, $fields, $order,  $url_param, $num_per_page);
						foreach ($list['data'] as &$vo ){
	
							$map_child['pid'] = $vo['id'];
							$map_child['status'] 		= 1;
							$vo['child'] =  $model_user -> queryRecordAll( $map_child);
						}
					}
					break;
						
				default:
					$list =  $model_user -> queryRecordEx( $map, $fields, $order,  $url_param, $num_per_page);;
						
			}
				
				
		}else{
			$map['userstatus'] 	= '正常';
			$map['status'] 		= 1;
			$list =  $model_user -> queryRecordEx( $map, $fields, $order,  $url_param, $num_per_page);
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
	public function getStaffs( $map, $fields, $order = null,  $url_param = '', $num_per_page = 20) {
		// 初始化部门模型
		$model_user = D ( 'User/User' );
	
		$list =  $model_user -> queryRecordEx( $map, $fields, $order,  $url_param, $num_per_page);;
		
		foreach ($list['data'] as &$vo1 ){
			if( $vo1['pid']){
				$pids[] = $vo1['pid'];
			}
		}
		$pids = array_unique( $pids );
		if( $pids ){
			$map1['id'] = array('IN',$pids);
			$parents = $model_user -> field('id,username') ->  where($map1) -> select();
		}
		
		//dump($this -> getloginUserType());
		foreach ($list['data'] as &$vo ){
			$can_edit = 0;
			$can_cancel = 0;
			$can_assign = 0;
			$can_login = 0;
			$can_update_pwd = 0;
			switch ($this -> getloginUserType()) {
				case 'agent':
					if($vo['userstatus'] == '正常'){
						$can_edit = 1;
						$can_cancel = 1;
						$can_assign = 1;
						$can_login = 1;
						$can_update_pwd = 1;
					}
				break;
				case 'customer_manager':
					if( $vo['userstatus'] == '正常' && $vo['usertype'] == 'customer'){
						$can_edit = 1;
						$can_cancel = 1;
						$can_assign = 1;
						$can_login = 1;
						$can_update_pwd = 1;
					}
					break;
				//case 'personnel_manager':
				//case 'operation_manager':
				//case 'develop_manager':
				case 'sales_manager':
					if( $vo['userstatus'] == '正常' && $vo['usertype'] == 'seller'){
						$can_edit = 1;
						$can_cancel = 1;
						$can_assign = 1;
						$can_login = 1;
						$can_update_pwd = 1;
					}
					break;
				default:
					;
				break;
			}
			
			$vo['can_edit'] 	= $can_edit;
			$vo['can_cancel'] 	= $can_cancel;
			$vo['can_assign'] 	= $can_assign;
			$vo['can_login'] 	= $can_login;
			$vo['can_update_pwd'] 	= $can_update_pwd;
			$parent = list_search($parents, array('id' => $vo['pid']));
			if( $parent ){
				$vo['parent'] = $parent[0];
			}
		}
		switch ($this -> getloginUserType()) {
			case 'agent':
			case 'customer_manager':
			case 'personnel_manager':
			case 'operation_manager':
			case 'develop_manager':
			case 'sales_manager':
				$list['can_add_staff'] = 1;
				break;
			default:
				;
				break;
		}
		
// 		dump($list);
// 		dump($model_user -> _sql());exit;
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
	public function getStaffDetail( $id ) {
		// 初始化部门模型
		$model_user = D ( 'User/User' );
		$data = $model_user -> selectOne( array('id' => $id));
		return $data;
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
	function insertStaff( $postData ){
		$model_user = D ( 'User/User' );
		// 判断当前的用户是否已经存在
		$map['username'] = $postData['username'];
		if( $model_user -> selectOne( $map )){
			$this -> error = '该用户名已经存在';
			return false;
		}
		$me  = $this -> getloginUserInfo();

	    $postData['epid'] = $me['epid'];
	    $postData['epname'] = $me['epname'];
	    $postData['usergroup'] = GROUP_NAME;
	    
		return $model_user -> insert($postData);
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
	function updateStaff( $postData ){
		$model_user = D ( 'User/User' );
		load("@.des");
                if(isset($postData['userpass'])){
                    $postData['userpass'] = basic_encrypt($postData['userpass']);
                }
		return $model_user -> update($postData);
	}
	
	
	/**
	 * 获取上级角色的全部用户
	 * 
	 * @param string $rolecode
	 */
	function getParentUsers( $rolecode ){
		$model_userrole =  D( 'Sys/UserRole' );
		$model_user 	= D ( 'User/User' );
		$me = $this -> getloginUserInfo();
		if( $rolecode ){
			$role = $model_userrole -> selectOne( array('rolecode' => $rolecode));
		
			$p_role = $model_userrole -> selectOne( array('id' => $role['pid']));
			
			$map['epid'] 		= $me['epid'];
			$map['usertype'] 	= $p_role['rolecode'];
			$parents =  $model_user -> queryRecordAll( $map );
		
		}
		foreach ($parents as $vo ){
			$code_set[$vo['id']]  =$vo['username'];
		}
		return  $code_set;
	}

	/**
	 * 获取还未分配销售的全部客户列表，
	 * 
	 * @param string $rolecode
	 */
	function getCustomers( $checked_userid ,$usertype){

		$model_user = D ( 'User/User' );
		
// 		$model_statistics = D ( 'Biz/Statistics' ); 
		
// 		$users = $model_statistics -> getUsers();
		
// 		$userids = $users['userids'];
		
// 		$agent_users = $model_user  -> getAgentUser( $userids );
// 		dump($userids);
// 		dump($agent_users);
		
// 		exit;
		$me = $this -> getloginUserInfo();
		
		switch ( $usertype) {
			case 'customer_manager':
				$type = 'customer_manager';
				$filed1 = 'customer_manager';
				$caption1 = '客服经理';
				$filed2 = 'customer';
				$caption2 = '客服';
				break;
			case 'customer':
				$type = 'customer';
				$filed1 = 'customer_manager';
				$caption1 = '客服经理';
				$filed2 = 'customer';
				$caption2 = '客服';
				break;
			case 'sales_manager':
				$type = 'seller_manager';
				$filed1 = 'seller_manager';
				$caption1 = '销售经理';
				$filed2 = 'seller';
				$caption2 = '销售员';
				break;
			case 'seller':
				$type = 'seller';
				$filed1 = 'seller_manager';
				$caption1 = '销售经理';
				$filed2 = 'seller';
				$caption2 = '销售员';
				break;
					
			default:
				break;
		}
	
		$id = $me['id'];
		switch (  $me ['usertype']  ) {
			case 'admin': // 管理员
			case 'operation_manager':// 运维
			case 'operation':// 运维
				// 获取全部的代理商
				$agent_users = $model_user  -> getAgentUser( $this -> getLoginUserId() );
				foreach ($agent_users as $key => &$vo) {
				
					unset($children_subusers);
					$customer['id'] 	= $vo['id'];
					$customer_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;" value="'.$vo['epid'].'" onclick=check_all(this) id="id_'.$vo['epid'].'"' ;
					if( $vo['seller_id'] == $checked_userid ){
						$customer_name .= ' checked';
					}
					$customer_name .= '>&nbsp;&nbsp;<label for="id_'.$vo['epid'].'">'. $vo['username'] .'<span style="margin-left:15px;font-size:12px;">(一级代理商)</span></label>' ;
					$customer['name']  = $customer_name;
				
					// 如果用户开启了二代的功能
					if( $vo['isopen_subagent'] == 1 ){
						$sub_agent_users = $model_user  ->getSubAgent($vo['id']);
						// 获取二代的全部子用户
						foreach ($sub_agent_users as  &$vo_sub_agent) {
				
							$children_subagent['id'] = $vo_sub_agent['id'];
							$children_subagent_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;" value="'.$vo_sub_agent['epid'].'" onclick=check_all(this) id="id_'.$vo_sub_agent['epid'].'"' ;
							if( $vo_sub_agent['seller_id'] == $checked_userid ){
								$children_subagent_name .= ' checked';
							}
							$children_subagent_name .= '>&nbsp;&nbsp;<label for="id_'.$vo_sub_agent['epid'].'">'. $vo_sub_agent['username'] .'<span style="margin-left:15px;font-size:12px;">(二级代理商)</span></label>' ;
							$children_subagent['name']  = $children_subagent_name;
				
				
							$sub_agetn_subusers = $model_user  ->getSubUserForAgent($vo_sub_agent['id']);
							$vo_sub_agent['sub_users'] = $sub_agetn_subusers;
				
							unset($children_subagent_children);
							foreach ($sub_agetn_subusers as $vo_sub_agent_subuser) {
				
								$children_subagent_subuser['id'] = $vo_sub_agent_subuser['id'];
				
								$children_subagent_subuser_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;" value="'.$vo_sub_agent_subuser['epid'].'" onclick=check_all(this) id="id_'.$vo_sub_agent_subuser['epid'].'"' ;
								if( $vo_sub_agent_subuser['seller_id'] == $checked_userid ){
									$children_subagent_subuser_name .= ' checked';
								}
								$children_subagent_subuser_name .= '>&nbsp;&nbsp;<label for="id_'.$vo_sub_agent_subuser['epid'].'">'. $vo_sub_agent_subuser['username'] .'<span style="margin-left:15px;font-size:12px;">(子用户)</span></label>' ;
				
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
						$children_subuser_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;"  value="'.$vo_sub_user['epid'].'" onclick=check_all(this) id="id_'.$vo_sub_user['epid'].'"' ;
						if( $vo_sub_user['seller_id'] == $checked_userid ){
							$children_subuser_name .= ' checked';
						}
				
						$children_subuser_name .= '>&nbsp;&nbsp;<label for="id_'.$vo_sub_user['epid'].'">'. $vo_sub_user['username'] .'<span style="margin-left:15px;font-size:12px;">(子用户)</span></label>' ;
				
						$children_subuser['name']  = $children_subuser_name;
				
				
						$children_subusers[] = $children_subuser;
					}
					$vo['sub_users'] = $sub_users;
				
					$customer['children'] 	= $children_subusers;
					$customers[] 	= $customer;
				}
				break;
			case 'agent':// 一级代理		
				// 获取全部的子用户和子代理
				$map['usertype'] 	= array( array('EQ','sub'),array('EQ','agent2'),'OR');
				$map['pid'] 		= $id;
				$map['status']		= 1;
				$customers = $model_user -> queryRecordAll( $map,'id,epid,username,truename,mobileno,telephone,QQnumber,contact,epname,usertype,usertype_desc' );
			
//                                echo json_encode($customers);exit;
				foreach ($customers as &$vo ){
					if($vo['epdir'][$type]['id'] == $checked_userid){
						$vo['is_checked'] = 1;
					}
					// 获取经理名称
					if( $vo['epdir'][$filed1] ){
						$user_temp = $model_user  -> where( array('id' => $vo['epdir'][$filed1]['id'] )) -> find();
						$vo['filed1'] = $user_temp['username'].'（'. $user_temp['truename'].'）';
					}
					
					// 获取员工名称
					if( $vo['epdir'][$filed2] ){
						$user_temp = $model_user  -> where( array('id' => $vo['epdir'][$filed2]['id'] )) -> find();
						$vo['filed2'] = $user_temp['username'].'（'. $user_temp['truename'].'）';
					}
					
				}
				break;
			case 'agent2':// 二级代理：获取全部的子用户
				$map['usertype'] 	= array('EQ','sub');
				$map['pid'] 		= $id;
				$map['status']		= 1;
				$customers = $model_user -> queryRecordAll( $map,'id,epid,username,truename,mobileno,telephone,QQnumber,contact,epname,usertype,usertype_desc' );
				
				foreach ($customers as &$vo ){
					if($vo['epdir'][$type] == $checked_userid){
						$vo['is_checked'] = 1;
					}
					
					// 获取经理名称
					if( $vo['epdir'][$filed1] ){
						$user_temp = $model_user  -> where( array('id' => $vo['epdir'][$filed1]['id'] )) -> find();
						$vo['filed1'] = $user_temp['username'].'（'. $user_temp['truename'].'）';
					}
					
					// 获取员工名称
					if( $vo['epdir'][$filed2] ){
						$user_temp = $model_user  -> where( array('id' => $vo['epdir'][$filed2]['id'] )) -> find();
						$vo['filed2'] = $user_temp['username'].'（'. $user_temp['truename'].'）';
					}
				}
				break;
			case 'sales_manager':// 销售经理：获取自己的客户
				// 获取我的全部用户
				$customers = $model_user -> getUsersBySellerManager( $me['id'] );
                            
				foreach ($customers as &$vo ){
					if($vo['epdir'][$filed2] == $checked_userid){
						$vo['is_checked'] = 1;
					}
						
					// 获取经理名称
					$vo['filed1'] = $me['username'].'（'. $me['truename'].'）';
						
					// 获取员工名称
					if( $vo['epdir'][$filed2] ){
						$user_temp = $model_user  -> where( array('id' => $vo['epdir'][$filed2]['id'] )) -> find();
						$vo['filed2'] = $user_temp['username'].'（'. $user_temp['truename'].'）';
					}
				}
				break;
			case 'seller':// 销售经理：获取自己的客户
				$sellerids[] 	= $id;
				switch ( $me['usergroup']) {
					case 'Manage':// 如果是管理端首先获取一级代理商
						// 获取全部的一级代理
						$agent_users = $model_user -> getAgentBySeller( $sellerids );
						
						foreach ($agent_users as $key => &$vo) {
						
							unset($children_subusers);
							$customer['id'] 	= $vo['id'];
							$customer_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;" value="'.$vo['epid'].'" onclick=check_all(this) id="id_'.$vo['epid'].'"' ;
							if( $vo['seller_id'] == $checked_userid ){
								$customer_name .= ' checked';
							}
							$customer_name .= '>&nbsp;&nbsp;<label for="id_'.$vo['epid'].'">'. $vo['username'] .'<span style="margin-left:15px;font-size:12px;">(一级代理商)</span></label>' ;
							$customer['name']  = $customer_name;
						
							// 如果用户开启了二代的功能
							if( $vo['isopen_subagent'] == 1 ){
								$sub_agent_users = $model_user  ->getSubAgent($vo['id']);
								// 获取二代的全部子用户
								foreach ($sub_agent_users as  &$vo_sub_agent) {
						
									$children_subagent['id'] = $vo_sub_agent['id'];
									$children_subagent_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;" value="'.$vo_sub_agent['epid'].'" onclick=check_all(this) id="id_'.$vo_sub_agent['epid'].'"' ;
									if( $vo_sub_agent['seller_id'] == $checked_userid ){
										$children_subagent_name .= ' checked';
									}
									$children_subagent_name .= '>&nbsp;&nbsp;<label for="id_'.$vo_sub_agent['epid'].'">'. $vo_sub_agent['username'] .'<span style="margin-left:15px;font-size:12px;">(二级代理商)</span></label>' ;
									$children_subagent['name']  = $children_subagent_name;
						
						
									$sub_agetn_subusers = $model_user  ->getSubUserForAgent($vo_sub_agent['id']);
									$vo_sub_agent['sub_users'] = $sub_agetn_subusers;
						
									unset($children_subagent_children);
									foreach ($sub_agetn_subusers as $vo_sub_agent_subuser) {
						
										$children_subagent_subuser['id'] = $vo_sub_agent_subuser['id'];
						
										$children_subagent_subuser_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;" value="'.$vo_sub_agent_subuser['epid'].'" onclick=check_all(this) id="id_'.$vo_sub_agent_subuser['epid'].'"' ;
										if( $vo_sub_agent_subuser['seller_id'] == $checked_userid ){
											$children_subagent_subuser_name .= ' checked';
										}
										$children_subagent_subuser_name .= '>&nbsp;&nbsp;<label for="id_'.$vo_sub_agent_subuser['epid'].'">'. $vo_sub_agent_subuser['username'] .'<span style="margin-left:15px;font-size:12px;">(子用户)</span></label>' ;
						
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
								$children_subuser_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;"  value="'.$vo_sub_user['epid'].'" onclick=check_all(this) id="id_'.$vo_sub_user['epid'].'"' ;
								if( $vo_sub_user['seller_id'] == $checked_userid ){
									$children_subuser_name .= ' checked';
								}
						
								$children_subuser_name .= '>&nbsp;&nbsp;<label for="id_'.$vo_sub_user['epid'].'">'. $vo_sub_user['username'] .'<span style="margin-left:15px;font-size:12px;">(子用户)</span></label>' ;
						
								$children_subuser['name']  = $children_subuser_name;
						
						
								$children_subusers[] = $children_subuser;
							}
							$vo['sub_users'] = $sub_users;
						
							$customer['children'] 	= $children_subusers;
							$customers[] 	= $customer;
						}
						
						
						/* foreach ($users as &$vo_agent ){
							$row = 0;
							unset($vo_agent['epdir']);
							unset($vo_agent['product_arr']);
							unset($vo_agent['products']);
							unset($vo_agent['productids']);
							unset($vo_agent['oem_config']);
							if($vo_agent['seller_id'] == $checked_userid){
								$vo_agent['is_checked'] = 1;
							}
										
							// 获取全部的子用户
							$sub_users = $model_user -> getSubUserForAgent( $vo_agent['id']);
							foreach ($sub_users as &$vo_user){
								$row ++;
								unset($vo_user['epdir']);
								unset($vo_user['product_arr']);
								unset($vo_user['products']);
								unset($vo_user['productids']);
								unset($vo_user['oem_config']);
							}
							$child = $sub_users;
							//$vo_agent['_child'] = $sub_users;
							
							
							// 获取全部的子代理
							if( $vo_agent['isopen_oem'] == 1 ){
								$sub_agents = $model_user -> getSubAgent( $vo_agent['id']);
								// 获取全部的子用户
								foreach ($sub_agents as &$vo_sub_agent){
									$row ++;
									unset($vo_sub_agent['epdir']);
									unset($vo_sub_agent['product_arr']);
									unset($vo_sub_agent['products']);
									unset($vo_sub_agent['productids']);
									unset($vo_sub_agent['oem_config']);
									if($vo_sub_agent['seller_id'] == $checked_userid){
										$vo_sub_agent['is_checked'] = 1;
									}
									$sub_agents_sub_users = $model_user -> getSubUserForAgent2( $vo_sub_agent['id']);
									foreach ($sub_agents_sub_users as &$vo_subsub ){
										$row ++;
										unset($vo_subsub['epdir']);
										unset($vo_subsub['product_arr']);
										unset($vo_subsub['products']);
										unset($vo_subsub['productids']);
										unset($vo_subsub['oem_config']);
										if($vo_subsub['seller_id'] == $checked_userid){
											$vo_subsub['is_checked'] = 1;
										}
									}
									
									$vo_sub_agent['_child'] = $sub_agents_sub_users;
									
								}
								
								
								if( $child && $sub_agents){
									$child = array_merge( $child,$sub_agents);
								}elseif($sub_agents){
									$child = $sub_agents;
								}
								
								dump($row);
								$vo_agent['row'] = $row;
								$vo_agent['_child'] = $child;	
								
							}
						}	 */		
						//dump($users);exit;
						break;
					case 'Agent': // 获取全部的子用户和代理商
					case 'Agent2':
						$customers = $model_user -> getUsersBySeller( $sellerids );
						
						foreach ($customers as &$vo ){
							if($vo['seller_id'] == $check_id){
								$vo['is_checked'] = 1;
							}
						}
						break;
					
					default:
						break;
				}
				
				break;
			case 'customer_manager':// 客服经理：获取自己的客户或者员工的客户				
				// 获取我的全部用户
				$customers = $model_user -> getUsersByCustomerManager( $me['id'] );
				foreach ($customers as &$vo ){
					if($vo['epdir'][$filed2] == $checked_userid){
						$vo['is_checked'] = 1;
					}
				
					// 获取经理名称
					$vo['filed1'] = $me['username'].'（'. $me['truename'].'）';
				
					// 获取员工名称
					if( $vo['epdir'][$filed2] ){
						$user_temp = $model_user  -> where( array('id' => $vo['epdir'][$filed2]['id'] )) -> find();
						$vo['filed2'] = $user_temp['username'].'（'. $user_temp['truename'].'）';
					}
				}
				break;
				
			case 'customer':// 客服：获取自己的客户
			
				$customerids[] 	= $id;
				
				switch ( $me['usergroup']) {
					case 'Manage':// 如果是管理端首先获取一级代理商
						// 获取全部的一级代理
						$agent_users = $model_user -> getAgentByCustomer( $customerids );
						
				
						foreach ($agent_users as $key => &$vo) {
				
							unset($children_subusers);
							$customer['id'] 	= $vo['id'];
							$customer_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;" value="'.$vo['epid'].'" onclick=check_all(this) id="id_'.$vo['epid'].'"' ;
							if( $vo['customer_id'] == $checked_userid ){
								$customer_name .= ' checked';
							}
							$customer_name .= '>&nbsp;&nbsp;<label for="id_'.$vo['epid'].'">'. $vo['username'] .'<span style="margin-left:15px;font-size:12px;">(一级代理商)</span></label>' ;
							$customer['name']  = $customer_name;
				
							// 如果用户开启了二代的功能
							if( $vo['isopen_subagent'] == 1 ){
								$sub_agent_users = $model_user  ->getSubAgent($vo['id']);
								// 获取二代的全部子用户
								foreach ($sub_agent_users as  &$vo_sub_agent) {
				
									$children_subagent['id'] = $vo_sub_agent['id'];
									$children_subagent_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;" value="'.$vo_sub_agent['epid'].'" onclick=check_all(this) id="id_'.$vo_sub_agent['epid'].'"' ;
									if( $vo_sub_agent['customer_id'] == $checked_userid ){
										$children_subagent_name .= ' checked';
									}
									$children_subagent_name .= '>&nbsp;&nbsp;<label for="id_'.$vo_sub_agent['epid'].'">'. $vo_sub_agent['username'] .'<span style="margin-left:15px;font-size:12px;">(二级代理商)</span></label>' ;
									$children_subagent['name']  = $children_subagent_name;
				
				
									$sub_agetn_subusers = $model_user  ->getSubUserForAgent($vo_sub_agent['id']);
									$vo_sub_agent['sub_users'] = $sub_agetn_subusers;
				
									unset($children_subagent_children);
									foreach ($sub_agetn_subusers as $vo_sub_agent_subuser) {
				
										$children_subagent_subuser['id'] = $vo_sub_agent_subuser['id'];
				
										$children_subagent_subuser_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;" value="'.$vo_sub_agent_subuser['epid'].'" onclick=check_all(this) id="id_'.$vo_sub_agent_subuser['epid'].'"' ;
										if( $vo_sub_agent_subuser['customer_id'] == $checked_userid ){
											$children_subagent_subuser_name .= ' checked';
										}
										$children_subagent_subuser_name .= '>&nbsp;&nbsp;<label for="id_'.$vo_sub_agent_subuser['epid'].'">'. $vo_sub_agent_subuser['username'] .'<span style="margin-left:15px;font-size:12px;">(子用户)</span></label>' ;
				
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
								$children_subuser_name =  '<input type="checkbox" name="ids[]" lay-skin="primary" style="display:inline-block ;"  value="'.$vo_sub_user['epid'].'" onclick=check_all(this) id="id_'.$vo_sub_user['epid'].'"' ;
								if( $vo_sub_user['customer_id'] == $checked_userid ){
									$children_subuser_name .= ' checked';
								}
				
								$children_subuser_name .= '>&nbsp;&nbsp;<label for="id_'.$vo_sub_user['epid'].'">'. $vo_sub_user['username'] .'<span style="margin-left:15px;font-size:12px;">(子用户)</span></label>' ;
				
								$children_subuser['name']  = $children_subuser_name;
				
				
								$children_subusers[] = $children_subuser;
							}
							$vo['sub_users'] = $sub_users;
				
							$customer['children'] 	= $children_subusers;
							$customers[] 	= $customer;
						}
				
						break;
					case 'Agent': // 获取全部的子用户和代理商
					case 'Agent2':
						$customers = $model_user -> getUsersByCustomer( $customerids );
				
						foreach ($users as &$vo ){
							if($vo['customer_id'] == $check_id){
								$vo['is_checked'] = 1;
							}
						}
						break;
							
					default:
						break;
				}
				
					
				break;
			
			default:
				
				break;
		}
		
		
		
		foreach ($customers as &$vo_c){
			unset($vo_c['epdir']['product_arr']);
			unset($vo_c['epdir']['products']);
			unset($vo_c['product_arr']);
			unset($vo_c['products']);
			
			
		}
		$list['data'] = $customers;
		$list['caption1'] = $caption1;
		$list['caption2'] = $caption2;
		return $list;

	}

	/**
	 * 为员工分配用户
	 * 
	 * 根据当前操作用户的类型来判断是为用户分配销售还是客服
 	 */
	function assignCustomer( $postData ){
		
		$model_user = D ( 'User/User' );
		$model_epdir = D ( 'Sys/Epdir' );
		
		// 员工的用户类型
		$usertype 	= $postData['usertype'];
		// 员工的id
		$userid 	= $postData['userid'];
		
		$user = $model_user -> selectOne( array('id' => $userid ),'usertype,pid');
		
		//exit;
		// 选中客户的id
		$ids 	= $postData['ids'];
		switch ( $usertype ) {
			case 'customer_manager':
				$user_level =1;
				$type 	= 'customer_manager';
				$filed1 = 'customer_manager';
				$filed2 = 'customer';
				break;
			case 'customer':
				$user_level = 2;
				$type = 'customer';
				$filed1 = 'customer_manager';
				$filed2 = 'customer';
				break;
			break;
			case 'sales_manager':
				$user_level =1;
				$type 	= 'seller_manager';
				$filed1 = 'seller_manager';
				$filed2 = 'seller';
				break;
			case 'seller':
				$user_level = 2;
				$type = 'seller';
				$filed1 = 'seller_manager';
				$filed2 = 'seller';
				break;
			
			default:
				$user_level = 2;
				$type = 'seller';
				$filed1 = 'seller_manager';
				$filed2 = 'seller';
			break;
		}
		
		$map_cs[$type] = $userid;

		// 获取该用户的原来的全部客户
		$list = $model_epdir  -> queryRecordAll( $map_cs );
	
		
		foreach ($list as $vo ) {
			$customerids[]  =  $vo['id'];
		}
		
		// 如果没有原始的客户，就直接更新全部的选中
		if( !$customerids ){
			if( $ids ){
				$map['id'] = array('IN',  $ids );
				$data[$type] = $userid;
				// 如果当前的员工类型是二级用户，需要获取他的上级用户，并将上级用户存储到经理中
				if( $user_level == 2 ){
					$pid = $user['pid'];
					//$user_p = $model_user -> selectOne( array('id' => $pid ),'usertype,username');
					$data[$filed1] = $pid;
				}
				//dump($data);
			
				$model_epdir -> where( $map ) -> save($data);
				//dump('1==='.$model_epdir -> _sql());
			}
		}else{
			// 如果有原始的客户，则将移除的用户筛选出来
			foreach ($customerids as $key =>  $vo_cs) {
				if( !in_array($vo_cs, $ids)){
					$remove_arra[] = $vo_cs;
				}
			}
			
			// 如果有原始的客户，则将移除的用户筛选出来
// 			foreach ($ids as $key =>  $vo_cs) {
// 				if( in_array($vo_cs, $customerids)){
// 					unset($ids[$key]);
// 				}
// 			}
			
			//dump($ids);
			//dump($remove_arra);
	
			// 如果有移除的id
			if($remove_arra){
				$map['id'] = array('IN',  $remove_arra );
				$data[$type] 	= 0;
				// 如果是一级用户，移除后，需要将二级用户的
				if( $user_level == 1 ){
					$data[$filed2] 	= 0;
				}
				$model_epdir -> where( $map ) -> save($data);
				//dump('2==='.$model_epdir -> _sql());
				
			}
			
			// 如果有新加的
			if( $ids ){
				$map['id'] 		= array('IN',  $ids );
				$data[$type] 	= $userid;
				
				// 如果当前的员工类型是二级用户，需要获取他的上级用户，并将上级用户存储到经理中
				if( $user_level == 2 ){
					$pid = $user['pid'];
					//$user_p = $model_user -> selectOne( array('id' => $pid ),'usertype,username');
					$data[$filed1] = $pid;
				}
				
				// 如果是一级用户，移除后，需要将二级用户的
				if( $user_level == 1 ){
					$data[$filed2] 	= 0;
				}
				
				$model_epdir -> where( $map ) -> save($data);
				//dump('3==='.$model_epdir -> _sql());
			}
		}
		
	
		// 获取两个数组的
		return true;
		
	}
	
	/**
	 * 注销用户
	 */
	function cancelRecord( $id ){
		$model_user = D ( 'User/User' );
		$data['id'] 		= $id;
		$data['userstatus'] = '注销';
		return $model_user -> update($data);
	}
	
	
	/**
	 * 获取每个分组的角色信息
	 *
	 * @param unknown $userid
	 * @return unknown|boolean
	 */
	public function getCodeSetByGroup( $rolegroup ) {
		// 初始化OEM模型
		$model_userrole = D ( 'Sys/UserRole' );
		
		$list = $model_userrole -> getCodeSetByGroup( $rolegroup );
		
		return $list;
	}
	
	/**
	 * 获取当前用户所在企业的全部销售经理
	 *
	 * @param unknown $userid
	 * @return unknown|boolean
	 */
	public function get_sales_managers( $epid ) {
		// 初始化OEM模型
		$model = D ( 'User/User' );
		
		$list = $model -> get_sales_managers( $epid );
		foreach ($list as $vo){
			$codeset[$vo['id']] = $vo['username'] .'（'.$vo['truename'] .'）'; 
		}
		
		return $codeset;
	}
	
	/**
	 * 获取当前用户所在企业的全部销售经理
	 *
	 * @param unknown $userid
	 * @return unknown|boolean
	 */
	public function get_customer_managers( $epid ) {
		// 初始化OEM模型
		$model = D ( 'User/User' );
	
		$list = $model -> get_customer_managers( $epid );
		foreach ($list as $vo){
			$codeset[$vo['id']] = $vo['username'] .'（'.$vo['truename'] .'）';
		}
	
		return $codeset;
	}
	
	
	
}
	
?>
