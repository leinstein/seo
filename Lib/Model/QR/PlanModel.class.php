<?php

/**
 * 模型层：快排宝-计划模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.QR
 * @version     20170629
 * @link        http://www.qisobao.com
 */
class PlanModel extends BaseModel{
	
	
	/**
	 * 自动处理数据
	 */
	protected $__auto 		= array (
			array ('createuserid', 'getLoginUserId',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createusername', 'getloginUserName',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
			array ('createtime','date',1,'function',array('Y-m-d H:i:s')), // 对createtime字
			array ('planstatus','待审核'), // 新增的时候把userstatus字段设置为正常
	);
	
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		$this -> trueTableName= C('DB_PREFIX') . 'qr_plan';
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
					case 'operation_manager':// 运维
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
		foreach( $list as $key => &$vo ){
			$vo['No'] = $key + 1;
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
				case 'operation_manager':// 运维
					
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
				case 'operation_manager':// 运维
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
		$me = $this -> getloginUserInfo();
		foreach( $list['data'] as  $key => &$vo ){
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $num_per_page;
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
				case 'operation_manager':// 运维
					if( $vo['planstatus'] == '待审核'){
						$vo['can_edit'] = 1;
						$vo['can_review'] = 1;
						$vo['can_delete'] = 1;
					}
					
					if( $vo['planstatus'] == '合作停'){
						$vo['can_review'] = 1;
					}
					if( $vo['planstatus'] == '优化中' ){
						$vo['can_import'] = 1; 
						$vo['can_export'] = 1;
					}
					$list['can_review'] = 1;
					$list['can_import'] = 1;
					$list['can_export'] = 1;
					break;
				default:
					;
				break;
			}
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
		//rtrim($str, ",");
		// 判断该计划的任务是否已经添加
		$postData['planname'] = trim( $postData['planname'] );
		if( $this -> selectOne( array('planname' => $postData['planname'] ))){
			$this -> error ="该计划已经存在";
			return false;
		}
		// 去掉结尾的/
		return $this -> insert($postData);
	}
	
	/**
	 * 获取我的站点列表
	 */
	function getMyPlansNum(  ){
	
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}
	
	/**
	 * 获取我的计划列表
	 * 
	 * 分页获取我的计划
	 */
	function getMyPlansByPage(){
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> queryRecordEx($map, $fields,'regtime desc');
	}
	
	/**
	 * 获取我的计划
	 * 
	 * 获取我的全部计划
	 */
	function getMyPlansAll(){
		$map['createuserid'] 	= $this-> getLoginUserId();
		$map['status'] 			= 1;
		return $this -> queryRecordAll($map, $fields,'regtime desc');
	}
	
	/**
	 * 获取全部的计划数量
	 */
	function getAllPlans(  ){
	
		$map['status'] 			= 1;
		return $this -> queryRecordAll($map, $fields,'regtime desc');
	}
	
	/**
	 * 获取全部的计划数量
	 */
	function getAllPlansNum(  ){
	
		$map['status'] 			= 1;
		return $this -> where( $map ) -> count();
	}
	
	/**
	 * 获取代理商的全部计划信息
	 *
	 * @accesspublic
	 */
	public function getListForAgent( $map, $fields, $order, $ageparam , $num_per_page){
		
		$model_user = D('User/User');

		$users  = $model_user  -> getSubUserForAgent();
		foreach ($users as $key => $value) {
			$userids[] = $value['id'];
		}
		if( $userids ){
			$map['createuserid'] 	= array('IN',$userids);
			$map['status'] = 1;
		
			//获得查询结果，传值到模板输出查询的结果
			$list= $this->queryRecordEx( $map, $fields, $order, $ageparam , $num_per_page );
		}
		
		return $list;
	
	}
	
	
	/**
	 * 进行站点的审批功能
	 *
	 * @param unknown $postData
	 * @return unknown
	 */
	function review( $postData ){
		
		//d
		$id 			= $postData['id'];
		//$conclusion 	= $postData['conclusion'];
		$data['id'] 			= $id;
		$data['reviewdate'] 	= date('Y-m-d H:i:s');
		$data['planstatus'] 	= $postData['planstatus'];
		$data['reviewopinion'] 	= $postData['reviewopinion'];
		$data['reviewuserid'] 	= $this -> getLoginUserId();
		$data['reviewusername'] = $this -> getloginUserName();
		$result =	$this -> update($data);
	
		if( $result ){
			// 审核完成后写入操作日志
			$postData['conclusion'] 	= $postData['sitestatus'];
			$model_operation_log = D('Biz/OperationLog');
			$model_operation_log -> addLog( 'QRPlan',MODULE_NAME,'审核计划',$postData );
		}
	
		return $result;
	}
	
	/**
	 * 导出关键词
	 * 
	 * 从计划中导出关键词到excel中
	 * 
	 * @param int $id
	 */
	function exportKeywords( $id ){
		
		// excel 模型类
		$model_excel 	= D('Tool/Excel');
		// 关键词模型
		$model_keyword 	= D("QR/QRKeyword");
		
		// 获取计划信息
		$plan = $this -> selectOne( array('id' => $id ));
		
		// 获取全部的关键词
		$map['planid'] 			= $id;
		$map['keywordstatus'] 	= '优化中';
		$map['status'] 			= 1;
		$keywords = $model_keyword -> queryRecordAll( $map,'keyword');
		/* dump($keywords);
		exit; */
		$filename 	='关键词_' .date('YmdHis').'.xls';
		$sheetTitle = '关键词';
		
		$model_excel -> writeMode1( $beginRow = 2, $beginColumn ='A' , $filePath , $sheetNum = 0, $keywords, C('QR_KEYWORD_EXPORT_CONFIG'),  $filename, $sheetTitle  );
		
	}
	
	/**
	 * 导入关键词
	 *
	 * @accesspublic
	 */
	function importReport( $postData ){
		
		ini_set('memory_limit',-1);
		// excel 模型类
		$model_excel 		= D('Tool/Excel');
		// 关键词导入 模型类
		$model_keyword 		= D('QR/QRKeyword');
		// 关键词导入 模型类
		$model_importrecord = D('QR/Importreportrecord');
		// 报表模型
		$model_report = D('QR/Report');
		
	
		$planid 	= $postData['planid'];//计划id
		$fileid 	= $postData['fileid'][0];// 导入文件id
		$fileurl 	= $postData['fileurl'][0];// 导入文件路径
		$filepath 	= $postData['filepath'][0];// 导入文件路径
		
		// 获取计划中的全部关键词
		$keywords = $model_keyword -> where( array('planid' => $planid))-> field('id as keywordid,keyword,createuserid as userid,planid') -> select();
		$keyword_num = count( $keywords );	
		$userid = $keywords[0]['userid'];
		// 验证导入文件是否和原来模板一致
// 		if( !$this -> verifyExcelMark( $filepath )){
// 			$this -> error ='您上传的文件与系统中模板不一致，请重新上传';
// 			return false;
// 		}

		// 读取模板文件
		$datas = $model_excel -> readMode1( 1, 'A' , $filepath , $sheetNum = 0, $strArray );
		if( $datas['value'] ){
			
			// 将导入的原始数据入库
			$recordid = $model_importrecord -> addRecord( $planid, $fileid, $datas );
			$standard_num = 0;
			$baidu_num = 0;
			$baidumobile_num = 0;
			foreach ( $keywords as &$vo ){
			
				$vo['recordid'] 	= $recordid; 
				$vo['searchengine'] = null;
				$vo['rank'] 		= null;
				$vo['snapshot'] 	= null;
				$vo['detecttime'] 	= null;
				foreach ($datas['value'] as $vo_v){
					if( $vo['keyword'] == $vo_v[0]){
						// 判断达标的数量
						$rank =  $vo_v[2];
						$ranks = explode('、',$rank);
						foreach ( $ranks as $vo_rank){
							if($vo_rank > 0 AND $vo_rank <= 10 ){
								$standard_num ++;
							}
						}
						$vo['searchengine'] = $vo_v[1];
						$vo['rank'] 		= $vo_v[2];
						$vo['snapshot'] 	= $vo_v[3];
						$vo['detecttime'] 	= $vo_v[4];
						
						switch ($vo['searchengine']) {
							case 'baidu':
								$baidu_num ++;
								break;
							case 'baiduphone':
								$baidumobile_num++;
								break;
						
							default:
								;
								break;
						}
						
						
					}
				}
					
				$vo['planid'] 		= $planid;
				$vo['createuserid'] 	= $this -> getLoginUserId();
				$vo['createusername'] 	= $this -> getloginUserName();
				$vo['createtime'] 	= date('Y-m-d H:i:s');
				$vo['status'] 	= 1;
				$vo['regtime'] 	= time();
				$vo['reguser'] 	= $this -> getloginUserName();
			}
			
			// 将检测的数据入库
			$result = D('QR/Keyworddetectrecord') -> addRecords( $keywords );

			if( !$result ){
				$recordid = $model_importrecord -> deleteRecord( array('id' => $recordid ) );
				$this -> error ='导入失败';
				return false;
			}
			
			// 像报表中增加记录
			$model_report -> addRecord( $userid, $planid, $keyword_num, $standard_num,$baidu_num,$baidumobile_num );
		}
		
		return $result;
		
	}
}
	
?>