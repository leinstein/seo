<?php
/**
 * 控制层：所有控制类的基类
 * 
 * @category   业务控制类
 * @package    Action
 * @copyright  Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @version   20141010
 */
abstract class BaseAction extends Action {

	/**
	 * 当前登录的用户id
	 */
	public $loginUserId = null;

	/**
	 * 当前登录的用户名
	 */
	public $loginUserName = null;

	/**
	 * 当前登录的开发者账号
	 */
	public $loginDeveloperName = null;

	/**
	 * 当前登录的用户信息
	 */
	public $loginUserInfo = null;
	
	/**
	 * 当前登录的企业id
	 */
	public $loginEpid = null;
	
	/**
	 * 当前登录的用户类型
	 */
	public $loginUserType = null;
	

	/**
	 * 模型名称
	 */
	public $modelName = "";
	
	/**
	 * 是否为手机端
	 */
	public $isMobile = false;
	
	
	/**
	 * 操作平台代码 
	 */
	public $platformCode 	= "Service";	

	/**
	 * 基类构造函数，完成对类实例的初始化
	 */
	function _initialize() {
		
		$this -> isMobile = $this -> isMobile();
		// TODO 测试
		//$this -> isMobile = true ;
		
		if( $this -> isMobile ){
			//动态设置跳转界面参数
			//TODO 该代码可以基类
			//C('TMPL_ACTION_SUCCESS',C('TMPL_ACTION_SUCCESS').'.mobile');
			//C('TMPL_ACTION_ERROR',C('TMPL_ACTION_ERROR').'.mobile');
			
			C('TMPL_ACTION_SUCCESS', APP_PATH.'Public/success.mobile.tpl');
			C('TMPL_ACTION_ERROR', APP_PATH.'Public/error.mobile.tpl');
		}
		
		//dump( $_SESSION);exit;
		// 特殊判断，如果当前是从iframe框架中的
		if( $_GET['from'] == 'iframe' ){
			
			if( $_SESSION['C_URL'] ){
				
				// $this-> redirect( $_SESSION['GROUP_NAME'].'/Index/index');
				
				$this-> redirect( $_SESSION['C_URL']);
				
			//	echo('<iframe src="'.$_SESSION['GROUP'].'/Index/index" width="100%" height="100%" border="0" noresize="" style="padding: 0; margin: 0, border:0" frameborder="0" marginheight="0" marginwidth="0"></iframe>');
			}else{
				$this-> redirect('Service/Index/login');
			}
			
			
			
			//if( $_SESSION['CURRENT_URL'] )
			// echo('<iframe src="'.$_SESSION['CURRENT_URL'].'" width="100%" height="100%" border="0" noresize="" style="padding: 0; margin: 0, border:0" frameborder="0" marginheight="0" marginwidth="0"></iframe>');
		}
	
		if( $_GET['href_type'] !='open_layer' &&  $_GET['request_type'] != 'ajax' &&  $_GET['open_type'] != 'blank' ){
			$_SESSION['C_URL'] = GROUP_NAME .'/'.MODULE_NAME .'/'. ACTION_NAME;
		}
		
		
		// session 过期参数配置
		$SESSION_Options = C('SESSION_Options');
		
		// 设置SESSION过期时间，如果超过时间未进行操作，那么系统会清空当前的SESSIOn
		if( $_SESSION[$SESSION_Options['expired_para']] ){
			if((time()-$_SESSION[$SESSION_Options['expired_para']])> $SESSION_Options['expired_time']){
				$_SESSION = null;
			}else{
				$_SESSION[$SESSION_Options['expired_para']] = time();
			}
		}
			
		
		
		//如果是开发平台，则采用特殊的用户验证
		if ($this -> platformCode == 'Dev') {
			//开发者账号模型类型
			$loginUserModel = D('Dev/Developer');

			//登录用户名
			$this->loginDeveloperName = $loginUserModel->getLoginUserName();
			$this->assign('LoginDeveloperName', $this->loginDeveloperName);
		} else {
			//普通模型类
			// 根據不同的分組來
			switch (GROUP_NAME){
				case 'Service':// 服务端
					$loginUserModel = D('User/ServerUser');
				break;
				case 'Manage':// 管理端
					$loginUserModel = D('User/AdminUser');
				break;
				case 'Agent':// 代理端
				case 'Agent2':// 代理端
					$loginUserModel = D('User/User');
				break;
				default:
					$loginUserModel = D('User/User');
			}

			//登录用户id
			$this->loginUserId = $loginUserModel->getLoginUserId();
			$this->assign('LoginUserId', $this->loginUserId);

			//登录用户名
			$this->loginUserName = $loginUserModel->getLoginUserName();
			$this->assign('LoginUserName', $this->loginUserName);

			//登录用户信息
			$this->loginUserInfo = $loginUserModel->getLoginUserInfo();
			$this->assign('LoginUserInfo', $this->loginUserInfo);
			
			//登录用户id
			$this->loginEpid = $loginUserModel->getLoginEpid();
			$this->assign('LoginEpid', $this->loginEpid); 
			
			// 登录用户类型
			$this->loginUserType = $loginUserModel->getLoginUserType();
			$this->assign('loginUserType', $this->loginUserType);
		}

		//网站名称
		$this->assign('SITE_NAME', C('SITE_NAME'));

		//当前url
		$url = $_SERVER['REQUEST_URI'] . (strpos($_SERVER['REQUEST_URI'], '?') ? '' : "?");
		$this->assign('CURRENT_URL', $url);
		
		// 将当前的路径存入session
		$_SESSION['CURRENT_URL'] = $url;
		

		//以前的url
		$preurl = $_SERVER['HTTP_REFERER'] . (strpos($_SERVER['HTTP_REFERER'], '?') ? '' : "?");
		$this->assign('PRE_URL', $preurl);

		//登录地址
		$login_url = C('LOGIN_URL') ? C('LOGIN_URL') : 'Service/Index/login';
		
		// 获取当前的产品
		$products = D('Sys/Product') -> queryRecordAll( );
		$this->assign('sys_products', $products);

		//权限检查过程
		//如果是开发者平台，直接采用LOGIN方式判断，不根据权限设置
		if( $this->platformcode == 'Dev' ){
			//开发者平台时判断 $this -> loginDeveloperName 变量
			if (empty ($this->loginDeveloperName)) {
				if (!in_array(ACTION_NAME, $this->public_functions)) {
					$this->assign('jumpUrl', __APP__ . '/' . $this->platformCode . '/' . $login_url);
					$this->error('对不起，访问此页面需要登录，系统正在为您跳转，请稍候...');
				}
			}
		}else{
			//根据config.php的配置来定义权限检查
			switch (C('PERMISSISON_MODE')) {
				
				//登录模式
				case 'LOGIN' :
									
					//非开发者平台时判断 $this -> loginUserName 变量
					if (empty ($this->loginUserName)) {					
						if (!in_array(ACTION_NAME, $this->public_functions)) {
							$this->assign('jumpUrl',  U($login_url));
							//$this->error('对不起，访问此页面需要登录，系统正在为您跳转，请稍候...',U($login_url),0);
							redirect(U($login_url), 0, '');

						}
					}else{
						$me = $this->loginUserInfo ;
						// 如果是子用户需要，获取当前page_title，并设置每个页面
						
						if( $me['oem_config']['id']){
							$this -> setTitle($me['oem_config']['page_title']);
						}
						
						
						// 登录成功后，如果是子用户需要获取该子用户代理的相关工单信息，主要是未处理的工单，或者有回复未读取的工单
						if( $me['usertype']  == 'sub' || $me['usertype']  == 'operation_manager' || $me['usertype']  == 'operation'){
							$workorders_num = D('Biz/Workorder') -> getUntreatedNum( $me['id'] );
							$this->assign('untreated_workorder_num', $workorders_num);
						}
						
					}
					break;
					
				//交易权限检查模式	
				case 'CHECK' :
							
					//用户交易权限验证
					if ($this->right_check( $this->platformCode . '.' . MODULE_NAME . 'Action', ACTION_NAME, $this->loginUserInfo[$loginUserModel->field_permission]) == false) {
		
						//如果没有登录则跳转到登录窗口，登录窗口的地址可以从配置文件中获取
						if (empty ($this->loginUserName)) {
							$login_url = C('LOGIN_URL') ? C('LOGIN_URL') : 'Service/Index/login';
							$this->assign('jumpUrl',  U($login_url));
							$error_hint = '对不起，访问此页面需要登录，系统正在为您跳转，请稍候...';
						} else {
							$error_hint = '对不起，您不具备此页面功能的访问权限';
						}
						
						//如果没有权限，在调试模式时会给出详细提示
						if (C('APP_DEBUG'))
							$this->error('对不起，您没有功能[' . MODULE_NAME . 'Action.' . ACTION_NAME . ']的使用权限!');
						else
							$this->error($error_hint);
					}
					break;
			}
			
			
		}
	}		

	/** 
	 * 获得当前Url
	 */
	protected static function getCurrentUrl() {
		return $_SERVER['REQUEST_URI'] . (strpos($_SERVER['REQUEST_URI'], '?') ? '' : "?");
	}

	/** 
	 * 默认的首页，一般提供对象列表查询功能
	 * 
	 * 第一步，获得用户输入的查询域信息。
	 * 第二步，根据查询域信息，排序条件以及列表显示设置调用对应模型层的queryRecordByPage方法，获得查询结果。
	 * 第三步，对查询结果进行进一步处理，主要是进行代码集转换、信息拼接等操作。
	 * 第四步，将处理后查询结果提交界面层进行处理。
	 *
	 * @param string $pageTmpl 显示模板的名称
	 * @param string $orderBy 排序条件，一般用逗号来分隔，例如'pubdate, hits desc'
	 * @param array $condition 附加查询条件，支持Thinkphp的标准条件
	 * @return void
	 */
	protected function index($pageTmpl = "index", $orderBy = null, $condition = null) {
		
		//初始化模型
		$model = D($this->modelName);	
		//获得查询域信息
		$queryFields = $this->getQueryFields();	
		//查询设置，设置显示类型
		if (C($this->platformCode . '_PAGE_TYPE'))
			$queryOptions['PageType'] = intval(C($this->platformCode . '_PAGE_TYPE'));
		//查询设置，设置显示样式	
		if (C($this->platformCode . '_PAGE_STYLE'))
			$queryOptions['PageStyle'] = intval(C($this->platformCode . '_PAGE_STYLE'));	
		
		//获得查询结果
		$data =   $model->queryRecordByPage($queryFields, $orderBy, $queryOptions, $condition);
				
		//进一步处理数据
		$data = $this->transDataForIndex($data);
		
		// 输出模板
		$this->assign($model->getModelName() . 's', $data);
		$this->display($pageTmpl); 
		
	}

	/** 
	 * index交易的数据处理过程，提供给子类重载调用
	 * 
	 * @param array $data 需要处理的数组
	 * @return array $data 处理后的查询结果
	 */
	protected function transDataForIndex($data) {
		//处理数据
		return $data;
	}

	/** 
	 * 调用增加页面模板，显示增加功能界面
	 * 
	 * @param string $pageTmpl 显示模板名称
	 * @return void
	 */
	protected function insertPage($pageTmpl = "insert") {
		// 输出模板
		$this->display($pageTmpl);
	}

	/** 
	 * 对象信息新增功能
	 *
	 * 调用模型层新增方法insert，将页面数据保存到数据库中。如果增加成功，则给出相应的提示，否则提示出错原因。
	 * 
	 * @param string $returnPage 返回时跳转的页面地址
	 * @param boolean $ajax 是否采用Ajax方式调用
	 * @param string $successHint 增加成功提示文字
	 * @return mixed 如果增加成功，则返回增加记录的主键值，如果失败则返回false
	 */
	protected function insert($returnPage = "index", $ajax = false, $successHint = null) {
		//初始化模型
		$model = D($this->modelName);
		//创建对象
		$result = $model->insert();		
		//判断结果
		$this->setResult($result, $returnPage, $ajax, $successHint);
	}

	/** 
	 * 调用修改页面模板，显示修改功能界面
	 *
	 * 调用模型层的查询方法selectOne，根据页面传递过来的主键数据查询相关对象的信息，并将结果传递给修改页面显示具体内容。
	 * 如果查询失败，则提示出错原因。
	 *
	 * @param string $pageTmpl 显示模板名称
	 * @param mixed $pkValue 主键值，用来查询某一个对象的信息
	 * @return mixed $data 返回查询的对象信息
	 */
	protected function updatePage($pageTmpl = "update", $pkValue = null) {
		//初始化模型
		$model = D($this->modelName);		
		//查询单条记录
		if ($pkValue == null)
			$data = $model->selectOne($this->getPKMap($model));
		else
			$data = $model->selectOne(intval($pkValue));		
		//显示结果
		$this->showResult($data, $model->getModelName(), $pageTmpl);
		//返回
		return $data;
	}

	/** 
	 * 对象信息修改功能
	 *
	 * 调用模型层修改方法update，将页面数据保存到数据库中。如果修改成功，则给出相应的提示，否则提示出错原因。
	 * 
	 * @param string $returnPage 返回时跳转的页面地址
	 * @param boolean $ajax 是否采用Ajax方式调用
	 * @param string $successHint 修改成功提示文字
	 * @return mixed 如果修改成功则返回修改记录数，否则返回false
	 */
	protected function update($returnPage = "index", $ajax = false, $successHint = null) {
		//初始化模型
		$model = D($this->modelName);
		//创建对象
		$result = $model->update();		
		//判断结果
		$this->setResult($result, $returnPage, $ajax, $successHint);
	}

	/** 
	 * 对象信息删除功能
	 *
	 * 调用模型层删除方法deleteRecord，根据页面传递过来的主键数据删除相关对象信息。如果删除成功，则给出相应的提示，否则提示出错原因。
	 * 
	 * @param string $returnPage 返回时跳转的页面地址
	 * @param boolean $ajax 是否采用Ajax方式调用
	 * @param string $successHint 删除成功提示文字
	 * @return mixed 如果修改成功则返回删除记录数，否则返回false
	 */
	protected function delete($returnPage = "index", $ajax = false, $successHint = null) {
		//初始化模型
		$model = D($this->modelName);
		//删除记录
		$result = $model->deleteRecord($this->getPKMap($model));
		//判断结果
		$this->setResult($result, $returnPage, $ajax, $successHint);
	}

	/** 
	 * 对象详细信息显示功能
	 *
	 * 调用模型层的查询方法selectOneDetail，根据页面传递过来的主键数据查询相关对象的信息，并将结果传递给显示页面显示具体内容。
	 * 如果查询失败，则提示出错原因。
	 * 
	 * @param string $pageTmpl 显示页面模板
	 * @param mixed $pkValue 主键值，用来查询某一个对象的信息
	 * 
	 * @return mixed $data 返回查询的对象信息e
	 */
	protected function detail($pageTmpl = "detail", $pkValue = null) {
		//初始化模型
		$model = D($this->modelName);
		//查询单条记录
		if ($pkValue == null)
			$data = $model->selectOneDetail($this->getPKMap($model));
		else
			$data = $model->selectOneDetail(intval($pkValue));		
		//显示结果
		$this->showResult($data, $model->getModelName(), $pageTmpl);				
		//返回
		return $data;
	}

	/**
	 * 获得主键查询条件
	 *
	 * @param object $model 查询条件 
	 * @return array 主键查询条件
	 */
	protected function getPKMap($model) {
		//获得主键字段
		$pkName = $model->getPk();
		$pkValue = $_REQUEST[$pkName];
		
		//如果是数组，则构造IN条件
		if (is_array($pkValue)) {
			$map[$pkName] = array (
				"IN",
				$pkValue
			);
		} else {
			$map[$pkName] = array (
				"EQ",
				$pkValue
			);
		}
		//返回
		return $map;
	}

	/**
	 * 获得查询域信息，可以把界面上类似这样以下的域的结构保存到数据组中。
	 * 
	 * 查询域示例1 -- 简单模式
	 * <span>机构名称：</span>
	 * <input type="hidden" name="query_field1" value="orgname,LIKE"/>
	 * <input type="text" name="query_value1" id="query_value1" value="{$query_value1}"/>
	 * 
	 * 查询域示例2 -- 包含了关联查询
	 * <input type="hidden" name="r_key1" value="Coorgan=orgid,id"/>
	 * <select name="query_field1" id="query_field1">
	 * 	 <option value="orgname,LIKE" selected>机构名称</option>
	 *	 <option value="shortname,LIKE">机构简称</option>
	 * </select>
	 * <input type="text" name="query_value1" id="query_value1" value="{$query_value1}"/>
	 * 
	 * 查询域可以罗列多个，但是必须以query_field 和 query_value 开头，最后以数字结尾，保存到数组以后的结构是：
	 * 		$queryFields {"查询字段域名称", "字段名称", "条件", "值域名", "值"} 
	 * 例子：
	 * 		$queryFields = array(
	 *			'keys'	=>	array( 
	 * 				'key_inputname' 	=> "r_key1",
	 *				'keyname' 			=> "Product",
	 *				'keysourceid' 		=> "prodid,id",
	 *				'keytagertid' 		=> "id",
	 *			),
	 *			'fields'	=>	array( 
	 * 				'field_inputname' 	=> "query_field1",
	 *				'modelname' 		=> "Product",
	 * 				'fieldname' 		=> "orgname",
	 * 				'queryexp' 			=> "LIKE",
	 * 				'value_inputname' 	=> "query_value1",
	 * 				'fieldvalue' 		=> "",
	 *			),
	 *		)
	 *
	 * @param array $context 页面上下文 
	 * @return array 查询域数组
	 */
	protected function getQueryFields(& $context = null) {

		//查询域信息
		$queryFields = array (
			"keys" => array (),
			"fields" => array ()
		);

		//根据规则构造查询条件；		
		foreach ($_REQUEST as $key => $val) {

			//query_field表示查询域，其值为，分割字符串，如orgname,LIKE
			if (substr($key, 0, 11) == "query_field") {

				// 查询条件字段域名称
				$query_field_inputname = $key;
				// 查询条件值域名称
				$query_value_inputname = 'query_value' . substr($query_field_inputname, 11);

				// 查询条件拆分
				$field_exp = split(',', $_REQUEST[$query_field_inputname]);
				if (count($field_exp) < 2) {
					$field_exp[0] = $_REQUEST[$query_field_inputname];
					$field_exp[1] = 'EQ';
				}

				// 查询字段的值				
				$field_value = $_REQUEST[$query_value_inputname];

				//放入数组 保存，数组结构见注释；
				if (trim($field_value) != "") {
					//输入域的值
					$queryFields['fields'][$query_field_inputname]['field_inputname'] = $query_field_inputname;
					//如果有模型名
					if (strpos($field_exp[0], '.') > 0) {
						$temp_str = split('\.', $field_exp[0]);
						$queryFields['fields'][$query_field_inputname]['modelname'] = $temp_str[0];
						$queryFields['fields'][$query_field_inputname]['fieldname'] = $temp_str[1];
					} else {
						$queryFields['fields'][$query_field_inputname]['fieldname'] = $field_exp[0];
					}
					//表达式
					$queryFields['fields'][$query_field_inputname]['queryexp'] = strtoupper($field_exp[1]);
//输入域的名称
					$queryFields['fields'][$query_field_inputname]['value_inputname'] = $query_value_inputname;
					//输入域的值
					$queryFields['fields'][$query_field_inputname]['fieldvalue'] = trim($field_value);
				}

				//设置默认回显
				if (isset ($context)) {
					$context[$query_field_inputname] = $_REQUEST[$query_field_inputname];
					$context[$query_value_inputname] = $_REQUEST[$query_value_inputname];

				} else {
					$this->assign($query_field_inputname, $_REQUEST[$query_field_inputname]);
					$this->assign($query_value_inputname, $_REQUEST[$query_value_inputname]);
				}
			}
		}

		//根据规则构造查询条件；		
		foreach ($_REQUEST as $key => $val) {

			//query_field表示查询域，其值为，分割字符串，如orgname,LIKE
			if (substr($key, 0, 5) == "r_key") {

				// 查询条件字段域名称
				$key_inputname = $key;
				// 关联设置的值				
				$key_value = $_REQUEST[$key_inputname];
				//放入数组 保存，数组结构见注释；
				if (trim($key_value) != "") {
					//表达式
					$queryFields['keys'][$key_inputname]['key_inputname'] = $key_inputname;
					//分割＝号
					$sstr = split("=", $key_value);
					//输入域的名称
					$queryFields['keys'][$key_inputname]['keyname'] = $sstr[0];
					//分割,号
					$sstr = split(",", $sstr[1]);
					//输入域的值
					$queryFields['keys'][$key_inputname]['keysourceid'] = $sstr[0];
					//输入域的值
					$queryFields['keys'][$key_inputname]['keytagertid'] = $sstr[1];
				}
			}
		}
		return $queryFields;
	}

	
	/**
	 * 设置文章标题
	 * 
	 * @param string $page_title 标题
	 * @return void
	 */
	protected function setTitle($page_title) {
		$this->assign('page_title', $page_title);
	}

	/**
	 * 处理结果
	 * 
	 * @param mixed $result 结果类型
	 * @param string $returnPage 返回页面
	 * @param string $ajax 是否采用Ajax方式返回结果
	 * @param string $successHint 成功提示
	 * @param string $failedHint 错误提示
	 * 
	 * @return void
	 */
	protected function setResult($result, $returnPage, $ajax= false, $successHint = null, $failedHint = null ) {
		//判断结果
		if ($result) {
			//显示提示
			$this->assign('jumpUrl', __URL__ . '/' . $returnPage);
			if ($successHint == null)
				$successHint = L('save_success');
			$this->success($successHint, $ajax);
		} else {
			if( $failedHint )
				$this->error($failedHint);
			else
				$this->error($model->getError());
		}
	}
	
	
	/**
	 * 显示结果
	 * 
	 * @param mixed $result 需要显示的结果数据
	 * @param string $pageVar 页面变量名
	 * @param string $pageTmpl 页面模板
	 * @param string $failedHint 错误提示
	 * 
	 * @return void
	 */
	protected function showResult($result, $pageVar=null, $pageTmpl=null, $failedHint = '此信息不存在！' ) {
		//判断结果
		if ($result) {
			$this->assign($pageVar, $result);
			$this->display($pageTmpl);
		} else {
			$this->error($failedHint);
		}
	}
	
	/**
	 * 权限验证
	 * 
	 * @param string $classname 类名
	 * @param string $funcname 函数名称
	 * @param string $function_array 拥有权限的数组
	 * @return boolean 检查是否通过，true 通过，false 不通过
	 */
	protected function right_check($classname, $funcname, $function_array) {
		//判断是否是公共交易
		$class_arr = explode('.', $classname); //如果是有分组的，则需要取点后面的
		$true_class_name = array_pop($class_arr);
		$class_vars = get_class_vars($true_class_name);
		foreach ($class_vars['public_functions'] as $vo)
			$public_functions[] = strtolower($vo);

		if (array_search(strtolower($funcname), $public_functions) !== false)
			return true;

		//权限判断
		if (array_search(strtolower($classname . "." . $funcname), $function_array) !== false)
			return true;
		else
			return false;
	}
	protected function userfuncontrol($userfuncname){
		//用户功能模块权限判断
		$usermodel=D("Biz/User");
		$loginUserInfo=$usermodel->getloginUserInfo();
		$levelstr=$loginUserInfo['funcontrol'];
		$levelcontrol_arr=(explode(",", $levelstr));
		if(in_array($userfuncname,$levelcontrol_arr))
			return true;
		else 
			return false;
	}
	
	protected function isMobile() {
	
		// 如果有HTTP_X_WAP_PROFILE则一定是移动设备
		if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
			return true;
		}
		// 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
		if (isset($_SERVER['HTTP_VIA'])) {
			// 找不到为flase,否则为true
			return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
		}
		// 脑残法，判断手机发送的客户端标志,兼容性有待提高。其中'MicroMessenger'是电脑微信
		if (isset($_SERVER['HTTP_USER_AGENT'])) {
			$clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile','MicroMessenger');
			// 从HTTP_USER_AGENT中查找手机浏览器的关键字
			if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
				return true;
			}
		}
		// 协议法，因为有可能不准确，放到最后判断
		if (isset ($_SERVER['HTTP_ACCEPT'])) {
			// 如果只支持wml并且不支持html那一定是移动设备
			// 如果支持wml和html但是wml在html之前则是移动设备
			if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
				return true;
			}
		}
		return false;
	}
	
	protected function isWeixin() {
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
			return true;
		} else {
			return false;
		}
	}
	
	
}