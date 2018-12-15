<?php

/**
 * 模型层：快排宝-关键词模型类型
*
* @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
* @package     Model.Biz
* @version     20141021
* @link        http://www.qisobao.com
*/
class QRKeywordModel extends BaseModel{

	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		$this -> trueTableName= C('DB_PREFIX') . 'qr_keyword';
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
				
			// 计算已经达标的天数
			if( $data['standarddate']) {
				//$data['standarddays'] = ( strtotime(date('Y-m-d')) - strtotime(format_date($data['standarddate'])))/ 86400 +1;
			}

			//判断时候能删除
			if( $data['keywordstatus'] == '待审核'){
				$data['isCanEdit'] = 1;
			}
			//计算达标总消费
			if( $data['standarddays'] >= 1 ){
				$data['total_consumption']  = $data['standarddays'] * $data['price'] ;
				$data['latest_consumption']  = $data['price'] ;
					
			}
			$SearchengineOptions = C('SearchengineOptions');
			$data['searchengine_ZH'] = $SearchengineOptions[$data['searchengine']];
			$data['searchengine_zh'] = $SearchengineOptions[$data['searchengine']];
			$data['consumption'] = $data['standarddays'] * $data['price'];
			$data['freezefunds_remain'] = $data['freezefunds'] - $data['consumption'] ;
			// 搜索引擎打开地址
			$SearchengineSiteOptions = C('SearchengineSiteOptions');
			$searchengine_url = $SearchengineSiteOptions[$data['searchengine']];
			// 替换关键词
			$data['searchengine_url'] = str_replace('{keyword}',$data['keyword'],$searchengine_url);


			$data['latestranking_show'] = $vo['latestranking'] ;
			// 最新排名达标后显示为红色字体
			if( $data['latestranking'] > 0 AND  $vo['latestranking'] <= 10 ){
				$data['latestranking_show'] = '<span style="color:#E04806;font-weight:bold;;">' .$data['latestranking'] . '</span>';
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
	
		foreach( $list as $key => &$vo ){
			$vo['No'] = $key + 1;
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
		$SearchengineOptions = C('SearchengineOptions');
		// 搜索引擎打开地址
		$SearchengineSiteOptions = C('SearchengineSiteOptions');
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
		
		if( !$num_per_page ){
			$num_per_page = $this -> pageNum;
		}
		$list = parent:: queryRecordEx($map, $fields, $order,  $url_param, $num_per_page);
		foreach( $list['data'] as  $key => &$vo ){
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $num_per_page;
			$vo['No'] = $No;
			
			if( $vo['planid'] ){
				$planids[] = $vo['planid'];
			}
		
		}
		$model = D('QR/QRPlan');
		// 获取计划信息
		$planids = array_unique( $planids );
		if( $planids ){
			$map_plan['id'] = array('IN', $planids);
			$plans = $model -> queryRecordAll( $map_plan );
		}
		unset( $vo );
		foreach( $list['data'] as  $key => &$vo ){
			
			$plan  = list_search($plans, array('id' => $vo['planid']));
			$vo['plan'] = $plan[0];
		
		}
		
		$usertype = $this-> getloginUserType();
		if( $usertype == 'sub'){
			$list['can_import'] = 1;
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
	function insert( $postData ){

		//组合其他相关参数
		$data = $postData;
		$data['createtime'] = date('Y-m-d H:i:s');
		$data['createuserid'] = $this -> getLoginUserId();
		$data['createusername'] = $this -> getloginUserName();
		$data['sitestatus'] = '待审核';

		return parent::insert($data);
	}

	
	/**
	 * 进入关键词详情
	 * 
	 * @accesspublic
	 */
	public function detail( $id ){
		
	
		$map['id'] = $id;
		$data = $this -> selectOne( $map );
		
		// 获取站点信息
		$data['site'] = D('Biz/Site') -> selectOne( array('id' => $data['siteid']) );
		
		// 获取资金池信息
		$data['funds'] = D('Biz/Funds') -> selectOne( array('userid' => $data['createuserid']) );
		
		return $data;
	}
	
	/**
	 * 导入关键词
	 *
	 * @accesspublic
	 */
	function import( $postData ){
		// excel 模型类
		$model_excel = D('Tool/Excel');
		// 关键词导入 模型类
		$model_importrecord = D('QR/Importrecord');
		// 计划 模型类
		$model_plan = D('QR/QRPlan');
		
		$planid 	= $postData['planid'];//计划id
		$fileid 	= $postData['fileid'][0];// 导入文件id
		$fileurl 	= $postData['fileurl'][0];// 导入文件路径
		$filepath 	= $postData['filepath'][0];// 导入文件路径
		
		
		// 验证导入文件是否和原来模板一致
		if( !$this -> verifyExcelMark( $filepath )){
			$this -> error ='您上传的文件与系统中模板不一致，请重新上传';	
			return false;
		}
		
		
		// 读取模板文件
		$return_data = $model_excel -> readMode1( 2, 'B' , $filepath , $sheetNum = 0, $strArray );
		
		// 获取全部的关键词
		$values = $return_data['value'] ;
		foreach ($values as $vo ){
			$keywords[] = $vo[0];
		}
		$count_kw = count($keywords);
		// 判断是否有重复的关键词
		// 如果有重复的值
		if( $count_kw > count( array_unique( $keywords ) ) ){
			$this -> error ='您上传的文件中有重复的关键词，请重新上传';
			return false;
		}
		
		// 如果获取到了文件的值
		if( $keywords ){
			$recordid = $model_importrecord -> addRecord( $planid, $fileid, $return_data );
		}
		
		// 判断是否和系统中已经有的关键词充重复了
		$repeats = $this -> removeDuplication( $planid,$keywords );

		// 如果有重复的值
		if( $count_kw == count( $repeats ) ){
			$this -> error ='您上传的文件中关键词和系统关键词完全重复，请重新上传';
			return false;
		}
		
			
		foreach ( $keywords as $vo_kw ){
			$data['planid'] 		= $planid;
			$data['recordid'] 		= $recordid;
			$data['keyword'] 		= $vo_kw;
			$data['keywordstatus'] 	= '待审核';
			$data['status'] 		= 1;
			$data['createtime'] 	= date('Y-m-d H:i:s');
			$data['createuserid'] 	= $this -> getLoginUserId();
			$data['createusername'] = $this -> getloginUserName();
			$datas[] = $data;
		}
		
	
		$result = $this -> addAll( $datas );
		
		if( $result ){
			// 更新计划信息。关键词信息
			$count_kw =  $this -> where( array('planid' => $planid)) -> count();
			$plan['id'] = $planid;
			$plan['keywordnumber'] = $count_kw;
			$model_plan -> update( $plan );
		}
		return $result;
		
	}
	
	/**
	 * 验证导入文件是否和系统中的模板一致
	 *
	 * @accesspublic
	 */
	function verifyExcelMark( $filepath ){
	
		$model_excel = D('Tool/Excel');
		
	
		// 读取上传文件的标识
		$file_mark = $model_excel -> readVerifyMark( $filepath );
		// 读取模板文件的标识
		//文件服务器路径
		$file = $this -> getImportTpl();
		$tpl_mark = $model_excel -> readVerifyMark( $file['filepath'] );
		if( $file_mark == $tpl_mark ){
			return true;
		}
		
		return false;
	
	}
	
	/**
	 * 验证导入文件中的关键词是否和系统中有重复的
	 * 如果有重复的关键词就将关键词从导入列表中去除不进行导入操作
	 *
	 * @param unknown $planid
	 * @param unknown $values
	 * @return boolean
	 */
	function removeDuplication( $planid, &$keywords ){
	
		$map['planid'] = $planid;
		$map['status'] = 1;
		$list = $this -> queryRecordAll($map,'keyword');
		foreach ( $list as $vo ){
			$kws[] = $vo['keyword'];
		}
		
		foreach ( $keywords as $key => $vo ){
			if( in_array($vo,$kws)){
				unset($keywords[$key]);
				$repeats[] = $vo;
			}
		}
		return $repeats;
	
	}
	
	function getImportTpl(){
		//文件服务器路径
		$return['fileurl'] = 'http://'. $_SERVER['HTTP_HOST'] . __ROOT__ .'/Upload/BizTpl/qr_keyword.xls';
		$return['filepath'] = APP_PATH .'Upload/BizTpl/qr_keyword.xls';
		$return['filename'] = '海排宝关键词批量导入模板.xls';
		return $return;
	}
	
	/**
	 * 获取关键词效果列表
	 */
	function getEffect( $map, $fields, $order,  $url_param,$num_per_page ){
		// 统计模型
		$model_statistics = D('QR/Statistics');
		
		// 关键词检测模型
		$model_detect 	= D('QR/Keyworddetectrecord');
		
		// 获取满足条件的全部用户id
		$userids = $model_statistics -> getUserids();
		
		if( $userids ){
			$map['userid'] = array('IN', $userids);
			$map['status'] = 1;
			$list = $model_detect -> queryRecordEx( $map, $fields, $order,  $url_param,$num_per_page );
		}
		return $list;
		
	}
	
}

?>