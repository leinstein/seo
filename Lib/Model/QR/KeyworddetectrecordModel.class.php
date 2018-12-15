<?php

/**
 * 模型层：关键词检测记录表
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20141021
 * @link        http://www.qisobao.com
 */
class KeyworddetectrecordModel extends BaseModel{
	
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		$this -> trueTableName= C('DB_PREFIX') . 'qr_keyworddetectrecord';
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
			
			$SearchengineOptions = C('SearchengineOptions');
			$data['searchengine_zh'] = $SearchengineOptions[$data['searchengine']];
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
		$SearchengineOptions = C('SearchengineOptions');
		// 搜索引擎打开地址
		$SearchengineSiteOptions = C('SearchengineSiteOptions');
		
		foreach( $list as $key => &$vo ){
			
			$vo['No'] = $key + 1;
			
			$vo['searchengine_zh'] = $SearchengineOptions[$vo['searchengine']];

			$searchengine_url = $SearchengineSiteOptions[$vo['searchengine']];
			// 替换关键词
			$vo['searchengine_url'] = str_replace('{keyword}',$vo['keyword'],$searchengine_url);
				
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
				
			//计算序号
			//获取当前的分页参数
			$p = !empty( $_GET['p'] ) ? $_GET['p'] : 1 ;
			$No = ($key + 1) + ($p -1) * $numberPerPage;
			$vo['No'] = $No;
				
			$vo['searchengine_zh'] = $SearchengineOptions[$vo['searchengine']];
				
			$searchengine_url = $SearchengineSiteOptions[$vo['searchengine']];
			// 替换关键词
			$vo['searchengine_url'] = str_replace('{keyword}',$vo['keyword'],$searchengine_url);
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
		$SearchengineOptions = C('SearchengineOptions');
		foreach( $list['data'] as  $key => &$vo ){
			switch ($vo['searchengine']) {
				case 'baidu':
					$searchengine_img = '__PUBLIC__/img/baidu.png';
					break;
				case 'baiduphone':
				case 'baidu_mobile':
					$searchengine_img = '__PUBLIC__/img/baidu_mobile.png';
				break;
				case 'sougou':
					$searchengine_img = '__PUBLIC__/img/sougou.png';
					break;
				
				default:
					;
				break;
			}
			/* $vo['searchengine_zh'] = $SearchengineOptions[$vo['searchengine']];
			$searchengine_url = $SearchengineSiteOptions[$vo['searchengine']]; */
			// 替换关键词
			$vo['searchengine_img'] = $searchengine_img;
		}
	
		return $list;
	}
	
	/**
	 * 
	 * 新增
	 * {@inheritDoc}
	 * @see BaseModel::insert()
	 */
	function addRecords( $keywords ){
		
	
		// 判断该关键词今天是否已经建成过了
		foreach ($keywords as $vo ){
			$map['keyword'] 		= $vo['keyword'];
			$map['searchengine'] 	= $vo['searchengine'];
			$map['detecttime'] = array('LIKE',substr( $vo['detecttime'],0,10 ) .'%');
			$data = $this -> selectOne($map);
			if( $data ){
				$vo['id'] = $data['id'];
				$this -> update($vo);
			}else{
				$records[] = $vo;
			}
		}
		
		if( $records ){
			
			$this -> addAll($records);
		}
		
		return true;
	}
	
	
}
	
?>