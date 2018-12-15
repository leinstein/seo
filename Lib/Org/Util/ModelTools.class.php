<?php
/**
 * 模型层：业务模型的工具类
 *
 *
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model
 * @version     20141010
 * @link        http://www.qisobao.com
 */
load('@.list');
class ModelTools {

	/**
	 * 工具方法：获得当前登录的用户名称
	 *
	 * @param string $modelName 模型名称
	 * @return string 当前登录的用户名称
	 */
	static public function getloginUserName($modelName) {
		//返回当前用户名
		return D($modelName) -> getloginUserName();
	}

	/**
	 * 工具方法：获得当前登录的用户编号
	 *
	 * @param string $modelName 模型名称
	 * @return string 当前登录的用户编号
	 */
	static public function getLoginUserId($modelName) {
		//返回当前用户名
		return D($modelName) -> getLoginUserId();
	}

	/**
	 * 工具方法：获得当前登录的用户信息
	 *
	 * @param string $modelName 模型名称
	 * @return 当前登录的用户信息
	 */
	static public function getloginUserInfo($modelName) {
		//返回当前用户名
		return D($modelName) -> getloginUserInfo();
	}


	/**
	 * 工具方法：获得当前登录的用户epid
	 *
	 * @param string $modelName 模型名称
	 * @return 当前登录的用户信息
	 */
	static public function getloginUserEpid($modelName) {
		//返回当前用户名
		return D($modelName) -> getLoginEpid();
	}

	/**
	 * 工具方法：获得当前登录的用户类型
	 *
	 * @param string $modelName 模型名称
	 * @return 当前登录的用户信息
	 */
	static public function getloginUserType($modelName) {
		//返回当前用户名
		return D($modelName) -> getLoginUserType();
	}


	/**
	 * 工具方法：对象信息新增
	 *
	 * 对包含了对象信息的数组进行数据检查，判断是否有不符合验证规则的数据，如果有则返回false，并提示错误信息。
	 * 如果符合验证规则，则将对象信息增加到数据库中。成功写入则返回增加记录的主键值，如果失败则返回false并获得错误信息。
	 *
	 * @param object $model 所使用的模型
	 * @param array $data 对象信息数组
	 * @return mixed 如果增加成功，则返回增加记录的主键值，如果失败则返回false
	 */
	static public function insert( $model, $data = null ) {

		//如果输入为空，则
		if( $data == null ){
			$data = $_POST;
		}

		//数据验证
		$result = $model -> create($data);

		//增加
		if ( $result ){
			$result = $model -> add();
			if( false === $result ){
				$err_msg = $model->getDbError();
				$model -> error = "数据写入错误！详细信息:".$err_msg;
			}
			return $result;
		}else{
			return $result;
		}
	}

	/**
	 * 工具方法：查询单个对象信息
	 *
	 * 根据查询条件查询数据库中的单条记录，并返回结果。
	 *
	 * @param object $model 所使用的模型
	 * @param array $map 查询条件，如果是整型值，则直接作为主键值进行查询
	 * @param boolean $relation 是否采用关系模型，当采用关系模型时，会查询和当前模型有关系的数据，并放入到返回结果中。
	 * @return mixed 如果查询成功则返回对象信息，如果失败则返回false
	 */
	static public function selectOne($model, $map, $field, $relation = false) {
		if( $relation ){
			if( is_int($map) )
				return $model->relation( true )-> field( $field ) -> find( $map );
			else
				return $model->relation( true )-> where( $map )-> field( $field ) ->find();
		}else{
			if( is_int($map) )
				return $model-> field( $field ) ->find( $map );
			else
				return $model->where( $map )-> field( $field ) ->find ();
		}
	}

	/**
	 * 工具方法：查询单个对象信息用于详细信息页面
	 *
	 * 调用selectOne方法根据查询条件查询数据库中的单条记录，并返回结果。此处单独声明一个函数是便于子类进行重写。
	 *
	 * @param object $model 所使用的模型
	 * @param var $map 查询条件，如果是整型值，则直接作为主键值进行查询
	 * @param boolean $relation 是否采用关系模型，当采用关系模型时，会查询和当前模型有关系的数据，并放入到返回结果中。
	 * @return mixed 如果查询成功则返回对象信息，如果失败则返回false
	 */
	static public function selectOneDetail($model, $map, $relation = false) {
		return $model->selectOne($map, $relation = false );
	}

	/**
	 * 工具方法：修改单个对象信息
	 *
	 * 对包含了对象信息的数组进行数据检查，判断是否有不符合验证规则的数据，如果有则返回false，并提示错误信息。
	 * 如果符合验证规则，则根据主键将对象信息更新到数据库中。成功写入则返回增加记录的主键值，如果失败则返回false并获得错误信息。
	 *
	 * @param object $model 所使用的模型
	 * @param array $data 对象信息数组
	 * @return mixed 如果修改成功，则返回true，失败则返回false
	 */
    static public function update( $model, $data = null ) {

        //如果输入为空，则
        if( $data == null ){
            $data = $_POST;
        }

        //数据验证
        $result = $model -> create($data);

        if ( $result ){
            $result = $model -> save();
            if( $result === false ){
                $err_msg = $model->getDbError();
                $model -> error = "数据写入错误！详细信息:".$err_msg;
            }
            if( $result === 0 ) //当没有更新任何数据时，依然提示保存成功
                $result = 1;
            return $result;
        }else
            return $result;
    }
    /**
     * 工具方法：修改单个对象信息
     *
     * 对包含了对象信息的数组进行数据检查，判断是否有不符合验证规则的数据，如果有则返回false，并提示错误信息。
     * 如果符合验证规则，则根据主键将对象信息更新到数据库中。成功写入则返回增加记录的主键值，如果失败则返回false并获得错误信息。
     *
     * @param object $model 所使用的模型
     * @param array $data 对象信息数组
     * @return mixed 如果修改成功，则返回true，失败则返回false
     */
    static public function update_oem($model, $data = null)
    {
        //如果输入为空，则
        if ($data == null)
        {
            $data = $_POST;
        }
        //数据验证
        $result = $model->create($data);
        $Dao_oem    = D("Sys/OEM");

        // 需要更新的数据
        //或者：$resul t= $Dao->where($condition)->data($data)->save();
        if ($result)
        {
            // 更新的条件
            $condition['id'] = $result['id'];
            $result          = $Dao_oem->where($condition)->save($result);
            if ($result === false)
            {
                $err_msg      = $model->getDbError();
                $model->error = "数据写入错误！详细信息:" . $err_msg;
            }
            if ($result === 0) //当没有更新任何数据时，依然提示保存成功
                $result = 1;
            return $result;
        }
        else
            return $result;
    }


	/**
	 * 工具方法：删除对象信息
	 *
	 * 根据查询条件删除数据库中的对象信息。
	 *
	 * @param object $model 所使用的模型
	 * @param array $map 查询条件
	 * @param boolean $relation 是否采用关系模型，当采用关系模型时，会操作和当前模型有关系的数据。
	 * @return mixed  如果成功，则返回删除的记录数量
	 */
	static public function deleteRecord($model, $map, $relation = false) {
		if( $relation )
			return $model->relation( true )->where ( $map )->delete ();
		else
			return $model->where ( $map )->delete ();
	}


	/**
	 * 工具方法：根据查询条件查询符合条件的所有记录集合
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志以及最大记录数这几个条件对记录集进行过滤筛选并返回结果。
	 *
	 * @param object $model 所使用的模型
	 * @param array $map 查询条件
	 * @param string $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param boolean $Relation 表示是否采用关系模型来查询，可选值为:true,false，默认false。当采用关系模型时，会查询和当前模型有关系的数据，并放入到返回结果。
	 * @param int $maxCount 表示全部查询时取的最大记录数，一般情况为避免系统消耗太多性能，默认为10000，注意导出数据时修改此参数；
	 * @return mixed 查询结果
	 */
	static public function queryRecordAll($model, $map, $field = null, $order = null, $relation = false, $maxCount = 10000) {
		//获得结果
		if ( $relation )
			$list = $model->field( $field )->relation(true)->where ( $map )->order( $order )->limit ( '0,' . $maxCount )->select ();
		else
			$list = $model->field( $field )->where ( $map )->order( $order )->limit ( '0,' . $maxCount )->select ();
		//返回记录集
		return self::clearRow_number($list);
	}

	/**
	 * 工具方法：根据查询条件查询符合条件的所有记录集合，以翻页模式返回数据
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志，每页记录数，翻页参数这几个条件对记录集进行过滤筛选并返回结果。
	 *
	 * @param object $model 所使用的模型
	 * @param array $map 查询条件；
	 * @param string $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param array $queryOpts 查询参数配置，目前包括：'Relation', 'NumberPerPage', 'PageParameters'等等；
	 *  											Relation　表示是否采用关系模型来查询，可选值为:true,false，默认false;
	 *  											NumberPerPage  表示每页记录数，值为整数，默认读取配置文件中的NUM_PER_PAGE;
	 *  											PageParameters  表示翻页后的参数，字符串类型默认为空; 特别的：如果输入数值，那么直接表示每页个数；如果是真假值，那么表示关系；如果输入文本，那么表示PageParameters；
	 *
	 * @return mixed 查询结果
	 */
	static public function queryRecord($model, $map, $fields, $order = null, $queryOpts) {

		//引用分页库
		import("ORG.Util.Page");

		//分析查询配置；
		$queryOptions = self :: getQueryOptions( $queryOpts, $model ->pageNum );

		// 查询满足要求的总记录
		if ( $queryOptions['Relation'] ) {
			$count = $model->relation( $queryOptions['Relation'] )->where ( $map )->count ();
		}
		else
			$count = $model->where ( $map )->count ();

		// 实例化分页类传入总记录数和每页显示的记录数
		$Page = new Page ( $count, $queryOptions['NumberPerPage']);

		//在翻页时需要加入查询条件，此操作只需要进行一次，如果没有构造条件，则构造，使用qb标志来保存状态
		if ( $_GET["qb"] != 1 ){
			//开始构造查询条件
			$Page->parameter = "&qb=1&" . $queryOptions['PageParameters'];
		}

		// 分页显示输出
		$show = $Page->show ();

		//获得结果
		if ( $queryOptions['Relation'] )
			$list = $model->relation( $queryOptions['Relation'] )->field($fields)->where ( $map )->order( $order )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		else
			$list = $model->field($fields)->where ( $map )->order( $order )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();

		//拼接输出
		$result ['data'] = self::clearRow_number($list);
		$result ['html'] = $show;
		$result ['count'] = $count;
		$result ['pageCount'] = ceil($count/$queryOptions['NumberPerPage']);     //总页数 intval($Page->totalPages);
		return $result;
	}

	/**
	 * 工具方法：自定义查询记录集，用于复杂的查询需求
	 *
	 * 根据自定义查询语句来查询数据库记录集。
	 * 调用例子：　$model -> queryRecordBySql ("SELECT * FROM __TABLE__", "SELECT count(id) AS count FROM __TABLE__", $queryOpts);
	 *
	 * @param object $model 所使用的模型
	 * @param string $rsSql 查询SQL语句
	 * @param string $countSql 统计SQL语句
	 * @param $queryOpts 查询参数配置，目前包括：'Relation', 'NumberPerPage', 'PageParameters'等等，说明见方法queryRecord。
	 * @return mixed 如果成功，则返回查询结果
	 */
	static public function queryRecordBySql($model, $rsSql, $countSql, $queryOpts) {

		//引用分页库
		import("ORG.Util.Page");
		//分析查询配置；
		$queryOptions = self :: getQueryOptions( $queryOpts );

		//求记录个数
		$data = $model->query ( $countSql );
		if ( $data )
			$count = $data[0]["count"];
		else
			$count = 0;

		// 实例化分页类传入总记录数和每页显示的记录数
		$Page = new Page ( $count );
		// 分页显示输出
		$show = $Page->show ();

		//拼接语句
		$rsSql .= " LIMIT " . $Page->firstRow . ',' . $Page->listRows;

		//获得结果
		$list = $model->query ( $rsSql );

		//拼接输出
		$result ['data'] = $list;
		$result ['html'] = $show;
		$result ['count'] = $count;

		return $result;
	}

	/**
	 * 工具方法：根据页面查询域配置查询符合条件的所有记录集合，以翻页模式返回数据
	 *
	 * 根据页面查询域配置，排序设置，关系模型标志，每页记录数，翻页参数这几个条件对记录集进行过滤筛选并返回结果。
	 *
	 * @param object $model 所使用的模型
	 * @param array $query_fields 查询域数组（什么是查询域数组，请参见 BaseAction:: getQueryFields 注释）
	 * @param string $order 排序参数
	 * @param array $queryOpts 查询参数配置，目前包括：'Relation', 'NumberPerPage', 'PageParameters'等等，说明见方法queryRecord。
	 * @param array $condition 附加查询条件
	 * @return mixed 如果成功，则返回查询结果
	 */
	static public function queryRecordByPage($model, $query_fields, $order = null, $queryOpts, $condition = null) {

		//引用分页库
		import("ORG.Util.Page");
		//构造查询条件
		$map = array ();

		//构造查询条件

		//普通查询条件
		foreach ( $query_fields["fields"] as $key => $val ) {
			if ( empty( $val['modelname'] ) ){
				if ( $val['queryexp'] == 'LIKE' )
					$map[$val['fieldname']] = array($val['queryexp'], '%'.$val['fieldvalue'].'%');
				else{
					if(isset($map[$val['fieldname']])){
						//同一个字段的查询条件需要使用格式$map['name']  = array(array('egt','a'), array('elt','b'));
						$map[$val['fieldname']] = array($map[$val['fieldname']],array($val['queryexp'], $val['fieldvalue']));
					}else{
						$map[$val['fieldname']] = array($val['queryexp'], $val['fieldvalue']);
					}
				}
			}
		}

		//关联查询条件
		foreach ( $query_fields["keys"] as $key1 => &$val1 ) {
			$model = D( $val1['keyname'] );
			$inmap = array();
			foreach ( $query_fields["fields"] as $key2 => $val2 ) {
				if ( $val2['modelname'] == $val1['keyname'] ) {
					$inmap[$val2['fieldname']] = array( $val2['queryexp'], $val2['fieldvalue']);
				}
			}
			if( $inmap ) {
				$map['_string'] = ' AND ' . $map['_string'] .$model->getSelectInSql($inmap, $val1['keysourceid'], $val1['keytagertid']);
			}
		}
		if( $map['_string'] )
			$map['_string'] = substr($map['_string'], 5);

		//构造查询条件参数
		foreach ( $query_fields["fields"] as $key => $val ) {
			//拼接查询字段变量
			if( $val['modelname'] )
				$parameters .= $val['field_inputname']."=" . urlencode ( $val ['modelname']. '.' . $val ['fieldname'] ) . ',' . urlencode ( $val ['queryexp'] ) . "&";
			else
				$parameters .= $val['field_inputname']."=" . urlencode ( $val ['fieldname'] ) . ',' . urlencode ( $val ['queryexp'] ) . "&";
			//拼接查询值变量
			$parameters .= $val['value_inputname']."=" . urlencode ( $val['fieldvalue'] ) . "&";
		}

		//构造查询条件参数
		foreach ( $query_fields["keys"] as $key => $val ) {
			//拼接查询字段变量
			$parameters .= $val['key_inputname']."=" . urlencode ( $val ['keyname'].'='.$val ['keysourceid'].','.$val ['keytagertid'] ) . "&";
		}

		//分析查询配置；
		$queryOptions =self::getQueryOptions( $queryOpts );
		$queryOptions['PageParameters'] .= $parameters;

		//附加查询条件
		if ( $condition )
			$map = array_merge($map , $condition );

		//查询结果
		return $model -> queryRecord($map, null, $order, $queryOptions );
	}

	/**
	 * 工具方法：分析查询参数配置
	 *
	 * @param $queryOpts 查询参数配置，目前包括：'Relation', 'NumberPerPage', 'PageParameters'等等；
	 *  								Relation　表示是否采用关系模型来查询，可选值为:true,false，默认-1;
	 *  								NumberPerPage  表示每页记录数，值为整数，默认读取配置文件中的NUM_PER_PAGE;
	 *  								PageParameters  表示翻页后的参数，字符串类型默认为空;
	 *  								PageType  表示翻页模式;
	 *  								PageStyle  表示翻页风格;
	 * 　								特别的：如果输入数值，那么直接表示每页个数；如果是真假值，那么表示关系；如果输入文本，那么表示
	 * @param int $defaultPageNum 默认每页记录数
	 * @return array 解析结果　，是一个数组，包括　'Relation', 'NumberPerPage', 'PageParameters'
	 */
	static public function getQueryOptions( $queryOpts, $defaultPageNum = 10) {
		//选项；
		$options = array();
		//如果是数组
		if (is_array( $queryOpts )) {
			$options['Relation'] = $queryOpts['Relation'];
			$options['NumberPerPage'] = $queryOpts['NumberPerPage'];
			$options['PageParameters'] = $queryOpts['PageParameters'];
			$options['PageType'] = $queryOpts['PageType'];
			$options['PageStyle'] = $queryOpts['PageStyle'];
		};

		//如果是Bool型
		if (is_bool( $queryOpts )) {
			$options['Relation'] = $queryOpts;
		};

		//如果是数值
		if (is_int( $queryOpts )) {
			$options['NumberPerPage'] = $queryOpts;
		};

		//如果是文本
		if (is_string( $queryOpts )) {
			$options['PageParameters'] = $queryOpts;
		};

		//设置默认值
		if ( !$options['Relation'] )
			$options['Relation'] = false;

		if ( !$options['NumberPerPage'] )
			$options['NumberPerPage'] = $defaultPageNum;

		if ( !$options['PageParameters'] )
			$options['PageParameters'] = "";

		if ( !$options['PageType'] )
			$options['PageType'] = 1;

		if ( !$options['PageStyle'] )
			$options['PageStyle'] = 7;

		return $options;

	}

	/**
	 * 工具方法：将界面POST数据中的数组结构转换为便于存储的数据结构
	 *
	 * 界面POST数据结构
	 * 	$_POST['id'] = array( [0]=>"1", [1]=>"2", [2]=>"3" )
	 * 	$_POST['busregno'] = array( [0]=>"200101", [1]=>"200102", [2]=>"200103" )
	 *
	 * 经过初步转换获得：
	 * array(
	 *      [0] => array( 'pid'=>"1", 'name'=>"200101" ),
	 *      [1] => array( 'pid'=>"2", 'name'=>"200102" ),
	 *      [2] => array( 'pid'=>"3", 'name'=>"200103" )
	 *      )
	 *
	 * @param $postdata 提交数据
	 * @param $fields 需要进行转换的字段列表，一般采用逗号分隔，例如：id, username
	 * @param $keyField 关键字段，如果该字段为空，则此行不进行转换
	 * @return mixed 转换结果
	 */
	static public function transPostArray( $postdata, $fields, $keyField ) {
		$fieldarray = split(',', $fields);

		//循环$postdata
		for( $i = 0; $i < count($postdata[$keyField]); $i ++) {
			//设置交易列表字段
			if( trim( $postdata[$keyField][$i] ) != "" and trim( $postdata[$keyField][$i] ) != "" ) {
				foreach( $fieldarray as $vo ){
					if( $vo != "" )
						$return[$i][$vo]	=	$postdata[$vo][$i];
				}
			}
		}

		return $return;
	}

	/**
	 * 工具方法：利用XML字段对应配置将界面数组转换为存储XML结构
	 *
	 * 例子，
	 * 界面POST数据
	 * 	$_POST['id'] = array( [0]=>"1", [1]=>"2", [2]=>"3" )
	 * 	$_POST['busregno'] = array( [0]=>"200101", [1]=>"200102", [2]=>"200103" )
	 * 经过transPostArray函数初步转换获得：
	 * array(
	 *      [0] => array( 'pid'=>"1", 'name'=>"200101" ),
	 *      [1] => array( 'pid'=>"2", 'name'=>"200102" ),
	 *      [2] => array( 'pid'=>"3", 'name'=>"200103" )
	 *      )
	 * 转换配置：
	 * array(
	 * 		'id' 			=> array('caption'=>'自动编号','datatype'=>'int','fieldname'=>'id'),
	 * 		'busregno' 		=> array('caption'=>'企业注册号','datatype'=>'string','fieldname'=>'busregno'),
	 *      )
	 * 转换后：
	 * 		<?xml version='1.0' encoding='utf-8'?>
	 * 		<record>
	 * 			<id caption='自动编号' datatype='int' fieldname='id'>1</id>
	 * 			<busregno caption='企业注册号' datatype='string' fieldname='busregno'>200101</busregno>
	 * 		</record>
	 * 		<record>
	 * 			<id caption='自动编号' datatype='int' fieldname='id'>2</id>
	 * 			<busregno caption='企业注册号' datatype='string' fieldname='busregno'>200102</busregno>
	 * 		</record>
	 * 		<record>
	 * 			<id caption='自动编号' datatype='int' fieldname='id'>3</id>
	 * 			<busregno caption='企业注册号' datatype='string' fieldname='busregno'>200103</busregno>
	 * 		</record>
	 *
	 * @params $array 输入数组， $arrayConfig 数组配置, $valueKey 值域名字；
	 * @return string XML格式字符串.
	 */
	static public function dataArrayToXML( $array, $arrayConfig = null, $valueKey = '@value', $addRoot = false ) {
		$xmlStr = "<?xml version='1.0' encoding='utf-8'?>\n";
		if( (count($array) > 1) or ($addRoot) )
			$xmlStr = $xmlStr . "<dataset>\n";

		//遍历数组
		foreach( $array as $val1 ){
			$xmlStr = $xmlStr . "	<record>\n";
			foreach( $val1 as $key2 => $val2 ){
				$xmlStr = $xmlStr . "		<" . $key2;
				//如果是数组
				if( is_array($val2) ){
					foreach( $val2 as $key3 => $val3 ){
						if( $key3 != $valueKey )
							$xmlStr = $xmlStr . $key3 . "='" . $val3 . "'";
					}
					$xmlStr = $xmlStr . ">" . $val2[$valueKey];
				}else{
					if( $arrayConfig[$key2] ) {
						$xmlStr = $xmlStr . " caption='" . $arrayConfig[$key2]['caption']  . "'";
						$xmlStr = $xmlStr . " datatype='" . $arrayConfig[$key2]['datatype']  . "'";
						$xmlStr = $xmlStr . " fieldname='" . $arrayConfig[$key2]['fieldname']  . "'";
						$xmlStr = $xmlStr . " visible='" . $arrayConfig[$key2]['visible']  . "'";
					}
					$xmlStr = $xmlStr . ">" . $val2;
				}

				$xmlStr = $xmlStr . "</" . $key2 . ">\n";
			}
			$xmlStr = $xmlStr . "	</record>\n";
		}

		if( (count($array) > 1) or ($addRoot) )
			$xmlStr = $xmlStr . "</dataset>\n";

		return $xmlStr;
	}


	/**
	 * 工具方法：统计函数，可以用来统计XML存储格式转换后的数组
	 *
	 * @param array $array 包含了机构编号的数组
	 * @param array $condition 统计条件
	 * @return mixed 统计结果
	 */
	static public function count_xmldata_array( $array, $condition ){
		$count = 0;
		$condition_keys = array_keys($condition);
		//遍历
		foreach( $array as $vo ){
			foreach( $vo as $key1=>$val1 ){
				if( $condition_keys[0] == $key1 and $condition[$key1] == $val1["@value"] ){
					$count++;
					break;
				}
			}
		}
		//返回
		return $count;
	}

	/**
	 * 工具方法：查询函数，可以用来查询XML存储格式转换后的数组
	 *
	 * @param array $array 包含了机构编号的数组
	 * @param array $condition 统计条件
	 * @return mixed 统计结果
	 */
	static public function list_xmldata_array( $array, $condition ){
		$list = array();
		$condition_keys = array_keys($condition);
		//遍历
		foreach( $array as $vo ){
			foreach( $vo as $key1=>$val1 ){
				if( $condition_keys[0] == $key1 and $condition[$key1] == $val1["@value"] ){
					$list[] = $vo;
					break;
				}
			}
		}
		//返回
		return $list;
	}

	/**
	 * 工具方法：搜索函数，可以用来搜索XML存储格式转换后的数组
	 *
	 * @param array $array 包含了机构编号的数组
	 * @param array $condition 统计条件
	 * @return mixed 统计结果
	 */
	static public function search_xmldata_array( $array, $condition ){
		$i = 0;
		$condition_keys = array_keys($condition);
		//遍历
		foreach( $array as $vo ){
			foreach( $vo as $key1=>$val1 ){
				if( $condition_keys[0] == $key1 and $condition[$key1] == $val1["@value"] ){
					$result[$i] = $vo;
					$i++;
					break;
				}
			}
		}
		//返回
		return $result;
	}

	/**
	 * 工具方法：模型层外部通用接口之一：在某一个对象集合中加入与之有关系的数据
	 *
	 * 输入对象编号集合，给出相应的对象信息组合到数组中
	 *
	 * @param object $model 所使用的模型
	 * @param array $recordSet 包含了当前模型对象主键编号的数组；
	 * @param string $fieldObjId 指定$recordSet中模型主键编号的字段名
	 * @param string $attrField 为空则直接把当前模型对象信息组合到数组$recordSet中，否则将信息组合到$attrField这个成员中；
	 * @param string $getFields 获取的字段值
	 * @param boolean $relation 是否使用关系模式查询
	 * @return mixed 组合后的新数据
	 */
	static public function getObjectsByIds( $model, $recordSet, $fieldObjId = 'objid', $attrField = null, $getFields = null, $relation = false) {

		//获得输入集合；
		$i = 0;
		foreach( $recordSet as $vo ) {
			$ids[$i] = $vo[$fieldObjId] ;
			$i ++;
		}
		//根据id清单搜索目标对象列表
		$map['id'] = array("IN", $ids );
		if( $getFields ){
			$data = $model -> queryRecordAll($map, 'id as ' . $fieldObjId . ',' . $getFields, null, $relation);
			$pkField = $fieldObjId;
		}else{
			$data = $model -> queryRecordAll($map, null,  null, $relation);
			$pkField = 'id';
		}

		//拼接数组
		foreach( $recordSet as &$vo ) {
			//根据对象编号找到对象
			$org = list_search( $data, array( $pkField => $vo[$fieldObjId] ) );

			if ( is_array( $org[0] ) ) {
				//枚举所有查询出的字段
				foreach( array_keys($org[0]) as  $val){

					//如果是id，则跳出
					if( $val != 'id' ) {
						//如果指定了$attrField
						if( $attrField )
							$vo[$attrField][$val] = $org[0][$val];
						else
							$vo[$val] = $org[0][$val];
					}

				}

			}
		}
		//返回
		return $recordSet;
	}

	/**
	 * 工具方法：模型层外部通用接口之一
	 *
	 * 输入数据集，进行翻译，并返回翻译后的数据集
	 *
	 * @param array $recordSet 翻译目标记录集；
	 * @param string $dictName 字典1名称，取语言包里面的数组变量
	 * @param array $otherDict 字典2，是一个数组，可以与字典1的数据合并
	 * @return mixed 转换后的而结果
	 */
	static public function translateObjects($recordSet, $dictName, $otherDict = null) {
		//获取字典
		$dictData = L(	$dictName );
		if( $otherDict )
			$dictData = array_merge( $dictData, $otherDict );

		if( count( $dictData ) > 0 ) {
			//开始翻译
			foreach( $recordSet as &$vo ){
				foreach( $dictData as $key => $val ){
					if( isset($vo[$key]) )
						$newVo[$val] = $vo[$key];
				}
				$vo = $newVo;
				unset($newVo);
			}
		}
		//返回
		return $recordSet;
	}

	/**
	 * 工具方法：返回代码集类型的数据
	 *
	 * 根据查询条件，选取字段配置，排序设置这几个条件对记录集进行过滤筛选并返回代码集形式的结果。
	 *
	 * @param object $model 所使用的模型
	 * @param array $map 获取条件
	 * @param string $field 代码集字段，如需要取orgid, orgname, 则可以写成'orgid, orgname', 或者array('orgid','orgname');
	 * @param string $order 排序规则
	 * @param string $first 前置代码，作用是定制
	 * @return mixed 代码集形式的数据
	 */
	static public function getCodeSet( $model, $map = null, $field, $order = null, $first = null) {
		//返回值
		$codeSet = array();
		//数据
		$data = $model -> queryRecordAll($map, $field, $order);
		//获得
		$codeSet = list_to_codeset( $data, $first );
		//返回
		return $codeSet;
	}

	/**
	 * 工具方法：根据查询条件和查询字段构造in查询语句
	 *
	 * @param object $model 所使用的模型
	 * @param array $map 查询条件；
	 * @param string $sourceId in字段名。
	 * @param string $selectField 查询字段
	 * @return string  in查询语句。如 sourceid in (select selectField from 表 where 1=1)
	 */
	static public function getSelectInSql($model, $map, $sourceId ,$selectField = "id" ) {
		//如果没有定义字段，则不需要处理
		if( empty($sourceId) ){
			return null;
		}else{

			foreach( $map as $key => &$val ){
				if( is_array( $val ) ){
					if( strtolower($val[0]) == 'like' )
						$val[1] = '%'.$val[1].'%';
				}
			}

			$sql = $sourceId.' IN ('.'SELECT '.$selectField.' FROM '.$model->getTableName() . $model->praseWhere($map) .')';
			return $sql;
		}
	}

	/**
	 * 工具方法：对于mssql数据库来说，需要清理查询结果中ROW_NUMBER数据
	 *
	 * @param array $data 输入数据；
	 * @return array 返回清理后的结果
	 */
	static public function clearRow_number( $data ) {
		foreach( $data as &$vo ){
			unset($vo['ROW_NUMBER']);
		}
		return $data ;
	}

}
?>