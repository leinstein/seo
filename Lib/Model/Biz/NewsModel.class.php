<?php

/**
 * 模型层：新闻通知模型类
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170518
 * @link        http://www.qisobao.com
 */
class NewsModel extends BaseModel{
    /**
     * 构造函数
     */
    function _initialize() {
        // 执行父类构造函数
        parent::_initialize ();
        
        $this -> trueTableName= C('DB_PREFIX') . 'sys_news';
        
        //合并自动完成
        $this->setProperty("_auto", array_merge($this->_auto, $this->__auto));
    }
    
    /**
     * 自动处理数据
     */
    protected $__auto 		= array (
    		array ('pubuserid', 'getLoginUserId',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
    		array ('pubuser', 'getloginUserName',	Model::MODEL_INSERT , 'callback' ), // 登记时自动更新登记时间信息
    		array ('pubtime','date',1,'function',array('Y-m-d H:i:s')), // 对createtime字
    );
    
    /*重写父类selectOne()方法*/
    public function selectOne($map){
        
        //引用父类方法
        $data = parent::selectOne($map);
        
        //返回数据
        if($data){
        	if ($this-> getLoginUserId() == $data['pubuserid']){
        		$data['is_can_edit'] = 1;
        	}
            return $data;
        }else{
            return false;
        }
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
    		if( $me['usertype'] == 'sub' && $me['oem_config']['product_name']){
    			//dump($vo);
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
    	dump($me);
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
    		if ( $this-> getLoginUserId() == $vo['pubuserid']){
    			$vo['is_can_edit'] = 1;
    		}
    	}
    	
    
    	return $list;
    }
    
    /**
     * 代理商客户新增文章
     * 
     * @param array $postData
     * @return mixed
     */
    public function addRecordForAgent( $postData ) {
    	
    	$result = $this -> insert( $postData );
    	return $result;
    }
    
    /**
     * 获取代理商的文章列表
     * 
     * @param unknown $map
     * @param unknown $fields
     * @param unknown $url_param
     */
    function getListByAgent( $userid ){
    	if( !$userid ){
    		$userid = $this -> getLoginUserId();
    	}
    	$map['pubuserid'] 	= $userid;
    	//$map['newstype'] 	= array( array('EQ','protocol'),array('EQ','notice'),'OR') ;
    	$map['status'] 		= 1;
    	
    	$list =   $this -> queryRecordEx( $map, $fields, 'regtime desc',  $url_param) ;
    	return $list;
    }
    
    /**
     * 根据代理商用户ID获取文章列表
     */
	function getListByAgentuser( $userid, $num ){
		if( !$userid ){
			$userid = $this -> getLoginUserId();
		}
		$map['pubuserid'] 	= $userid;
		$map['status'] 		= 1;
		if( $num ){
			$list =  $this -> queryRecordAll($map, $fields, 'newstype desc,regtime desc',null,$num);
			return $list;
		}else{
			$list =   $this -> queryRecordEx( $map, $fields, 'newstype desc,regtime desc',  $url_param) ;
			return $list;
		}
		
	}
	
	/**
	 * 根据代理商用户ID获取文章列表
	 */
	function getListByOperationuser(  $num ){
	
		$map['pubuserid'] 	= 5;
		$map['status'] 		= 1;
		if( $num ){
			$list = $this -> queryRecordAll($map, $fields, 'newstype desc,regtime desc',null,$num);
		}else{
			$list = $this -> queryRecordEx($map, $fields, 'newstype desc,regtime desc');
		}
		
		return $list;
		
	
	}
	
	
	
	/**
	 * 根据用户id获取该用户的最新一条公告
	 * 
	 * @param string $userid
	 * @param int $num
	 */
	function getNoticeByUserid( $userid, $num = 1 ){
		if( !$userid ){
			$userid = $this -> getLoginUserId();
		}
		
		$map['pubuserid'] 	= $userid;
		$map['newstype'] 	= 'notice'; 
		$map['status'] 		= 1;
		$list = $this -> queryRecordAll($map, $fields, 'regtime desc',null, $num);
		return $list[0];
		
	
	}
	
	/**
	 * 根据用户id获取该用户的最新一条协议
	 *
	 * @param string $userid
	 * @param int $num
	 */
	function getProtocolByUserid( $userid, $num = 1 ){
		if( !$userid ){
			$userid = $this -> getLoginUserId();
		}
	
		$map['pubuserid'] 	= $userid;
		$map['newstype'] 	= 'protocol';
		$map['status'] 		= 1;
		$list = $this -> queryRecordAll($map, $fields, 'regtime desc',null, $num);
		return $list[0];
	
	
	}
	
	/**
	 * 代理商客户新增文章
	 *
	 * @param array $postData
	 * @return mixed
	 */
	public function updateNews ( $postData ) {
		 if( !$postData['id']){
		 	$result = $this -> addRecordForAgent( $postData ) ;
		 }else{
		 	$result = $this -> update( $postData );
		 }
		return $result;
	}
	
	
	
	

}
?>