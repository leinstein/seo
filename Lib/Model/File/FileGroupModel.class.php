<?php

/**
 * 模型层：文件存储组模型类 
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20150625
 * @link        http://www.qisobao.com
 */

class FileGroupModel extends BaseModel{

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
		//设置真实表名
		$this -> trueTableName= 'ts_sys_filegroup';
		//加载数据库链接
		$this->setDbConn(C("SYS_CONFIG"));
	}
	
	
	/**
	 * 查询单个对象信息
	 *
	 * 根据查询条件查询数据库中的单条记录，并返回结果。
	 *
	 * @param array $map 查询条件，如果是整型值，则直接作为主键值进行查询
	 * @param boolean $relation 是否采用关系模型，当采用关系模型时，会查询和当前模型有关系的数据，并放入到返回结果中。
	 * @return mixed 如果查询成功则返回对象信息，如果失败则返回false
	 */
	public function selectOne($map, $relation = false) {
		
		//调用父类方法查询全部数据
		$data =  parent:: selectOne( $map );
	
		if($data){
			
			//获取磁盘路径
			$diskpath 		= $data['diskpath'];
			
			//获取服务器路径
			$serverpath 	= $data['serverpath'];
			
			//如果是默认的APP_PATH
			if( $diskpath == 'APP_PATH') {
				$diskpath 			= APP_PATH;
				$data['diskpath'] 	= $diskpath;
			}
			
			//如果是默认的APP_PATH
			if( $serverpath == 'APP_ROOT') {
				$serverpath 			= 'http://'. $_SERVER['HTTP_HOST'] . __ROOT__ .'/';
				$data['serverpath'] 	= $serverpath;
			}	
		}
	
		return  $data;
	}
	
	/**
	 * 根据查询条件查询符合条件的所有记录集合
	 *
	 * 根据查询条件，选取字段，排序设置，关系模型标志以及最大记录数这几个条件对记录集进行过滤筛选并返回结果。
	 *
	 * @param array $map 查询条件
	 * @param string $fields 获取字段列表，采用逗号分隔
	 * @param string $order 排序参数
	 * @param boolean $Relation 表示是否采用关系模型来查询，可选值为:true,false，默认false。当采用关系模型时，会查询和当前模型有关系的数据，并放入到返回结果。
	 * @param int $maxCount 表示全部查询时取的最大记录数，一般情况为避免系统消耗太多性能，默认为10000，注意导出数据时修改此参数；
	 * @return mixed 查询结果
	 */
	public function queryRecordAll($map, $field = null, $order = null, $relation = false, $maxCount = 10000) {
	
		//调用父类方法查询全部数据
		$list =  parent:: queryRecordAll( $map, $field, $order, $relation, $maxCount );
		
		//对数据进行转换
		foreach( $list as &$vo ){
	
		//获取磁盘路径
			$diskpath 		= $vo['diskpath'];
			
			//获取服务器路径
			$serverpath 	= $vo['serverpath'];
			
			//如果是默认的APP_PATH
			if( $diskpath == 'APP_PATH') {
				$diskpath 			= APP_PATH;
				$vo['diskpath'] 	= $diskpath;
			}
			
			//如果是默认的APP_PATH
			if( $serverpath == 'APP_ROOT') {
				$serverpath 			= 'http://'. $_SERVER['HTTP_HOST'] . __ROOT__ .'/';
				$vo['serverpath'] 	= $serverpath;
			}	
		}
		return $list;
	
	}
	
	
	/**
	 * 获取当前可用文件组
	 * 
	 * 获取规则：
	 *     1、首先存到序号小的文件组
	 *     2、文件组容量还未存满
	 * 
	 * @return array
	 */
	function getAvailableGroup( $grouptag ){
		
		$map['status'] 	= 1;
		$map['_string'] = ' usedcapacity is null or usedcapacity < maxcapacity';
		if( $grouptag ){
			$map['grouptag'] 	= $grouptag;
		}else{
			if(GROUP_NAME=="Manage"){
				$map['grouptag']  = "Manage";
			}else{
				$map['grouptag']  = "Service";
			}
		}
		
		$list = $this  -> queryRecordAll( $map, ' id, groupname, serverpath, diskpath' ,'storageorder',null, 1 );
		
		$data = $list[0];
		return $data;
	
	}
	
	/**
	 * 获取当前的文件组存储磁盘路径
	 */
	function getStorageDiskPath( $id ){
		
		$data = $this -> selectOne( array('id' => $id ));
		
		return $data['diskpath']; 
	}
	
	/**
	 * 获取当前的文件组存储的服务器路径
	 */
	function getStorageServerPath( $id ){
	
		$data = $this -> selectOne( array('id' => $id ));
	
		return $data['serverpath'];
	}
	
	
	/**
	 * 删除文件时更新附件组信息
	 */
	function setDecFile( $id, $filesize ){
			
		$map['id'] = $id;
			
		//将文件的数量减一
		$this -> where( $map )-> setDec('filenumber', 1 );
		//将已经使用的容量减少
		$this -> where( $map )-> setDec('usedcapacity', $filesize );
		
	}
	
	/**
	 * 新增文件时更新附件组信息
	 */
	function setIncFile( $id, $filesize ){
			
		$map['id'] = $id;
		
		//将文件的数量增加一
		$this -> where( $map )-> setInc('filenumber',1 ); 
		//将已经使用的容量增加
		$this -> where( $map )-> setInc('usedcapacity', $filesize ); 
	
	}
}
	
?>