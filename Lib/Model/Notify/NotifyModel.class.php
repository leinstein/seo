<?php
/**
 * 模型层：通知提醒模型类 
 *
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Notify
 * @version     20170718
 * @link        http://www.qisobao.com
*/
 
class NotifyModel extends BaseModel {
	
	/**
	 * 数据表名称
	 */
	protected $tableName = 'sys_notify';
	
	/*自动处理数据*/
	protected $__auto 		= array (
	);
	
	/*
	 * 自动验证设置
	*/
	protected $__validate	 =	 array(
			
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
		
	}
	
	
	/**
	 * 重写父类方法 根据查询条件查询符合条件的所有记录集合，以翻页模式返回数据
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
			
			if($vo['pubtime']){
				$vo['pubtime_trans'] = format_date( strtotime ( $vo['pubtime'] ) );
			}
	
		}
	
		return $list;
	}
	
	
	
	
	
	/**
	 * 新增通知提醒
	 * 
	* @param string $receive - 接收人ID 多个时以英文的","分割或传入数组；
	* @param string $content - 发送的正文内容，是一个数组；
	* @param array  $target - 是为了那个对象提醒的，需要说明$target['type'] - 类型；  $target['id'] -编号；
	* @param string $gourl - 
	* @param string $tpl - 使用模板的代码；
	* @param string $from - 发送者，省略表示系统发送；
	 * 
	 * @return boolean 是否成功
	 */
	function send($receive, $content, $target, $gourl, $tpl = '', $from = null) {
		
		if( $content == null ){
			$this -> error = "发送的内容不能为空！";
			return false;	
		}
		
		$data['isread'] = 0;
		$data['isshow'] = 0;
		//$data['fortype'] = $this->_getObjPath($target['type'],  $target['id']);
		$data['forid'] = $target['id'];
		$data['gourl'] = $gourl;
		
		if( $from == null ){
			$data['pubuserid'] = '';
			$data['pubusername'] = '[__SYSTEM__]';
		}else{
			$data['pubuserid'] = $from['userid'];
			$data['pubusername'] = $from['username'];
		}
		$data['pubtime'] = now_to_time();
		
		//套模板
		if( $tpl ){
			$data['tpltype'] = $tpl;
			$data['ncontent'] = addslashes(serialize( $content ));
		}else{
			$this->error = "没有指定模板！";
			return false;
		}
		
		//发送的过程
		if( is_array($receive) ){
			$recvids = $receive;
		}else{
			//根据逗号分隔符来分解
			if( strpos($receive, ",") ){
				$recvids = explode(",", $receive);
			}else{
				$recvids[0] = $receive;
			}		
		}
		
		//如果有收件人
		if( $receive ){
			//循环发送
			foreach( $recvids as $vo ){
				$data['recvuserid'] = $vo;
				$data['status'] = '1';
				$data['reguser'] = $this->getLoginUserId();
				$data['regtime'] = time();
				$notifys[] = $data;
			}
		}else{
			$this->error = "没有指定收件人！";
			return false;
		}
		//批量增加
		return $this -> addAll($notifys);
	}
	
	/**
	 * 获得通知提醒清单
	 *
	 * @param	array $map - 查询条件；
	 * @param $recvuserid - 接受者，如果等于 ALL_USER，表示获取所有用户的消息
	 * @param	int $pagecount - 每页记录数；
	 * @param	boolean $mark_is_read - 标记为已读；
	 *
	 * @return array 通知提醒清单
	 */
	function get($map, $recvuserid=null, $pagecount =10, $mark_is_read = false) {
		//获得通知列表
		if( $recvuserid != "ALL_USER")
			$map['recvuserid'] = $recvuserid;
		
		$notifys = $this->queryRecordEx($map, null, 'pubtime desc', '', $pagecount);
		//获得通知涉及的模板类型
		foreach( $notifys['data'] as &$vo){
				$tpls[] = $vo['tpltype'];
		}
		
		//如果找到模板
		if( $tpls ){
			
			$map['tplcode'] = array( "IN", $tpls );
		
			//获得所有相关的模板
			$model_tpl  = M("sys_notify_tpl");
			$data_tpl = $model_tpl -> where($map) ->select();
			
			//循环获得
			foreach( $notifys['data'] as &$vo){
				$tpl = list_search($data_tpl, array('tplcode'=>$vo['tpltype']));
				$return = $this->_parseTemplate($vo, $tpl[0]);
				$vo['title'] = $return['title'];
				$vo['body'] = $return['body'];
			}
		}
		
		return $notifys;
	}
	
	/**
	 * 读取某条通知，并设置为已读状态
	 *
	 * @param	array $map - 查询条件；
	 *
	 * @return	boolean 是否成功
	 */
	function readOne($id) {
		$map['id'] = $id;
		$data = $this -> where($map) -> field('ncontent', true)->find();
		if( $data ){
			$data['isread'] = 1;
			$data['isshow'] = 1;
			// 替换链接
			$data['gourl'] = str_replace('{group}', GROUP_NAME, $data['gourl']);
			
			$this->update($data);
		}
		return $data;
	}
	
	/**
	 * 获得未读通知提醒的个数
	 *
	 * @param	string $mid - 我的用户编号
	* @param	string $targettype - 目标类型
	* @param	string $targetid - 目标编号
	* @param	array $con - 附加条件
	* 
	* @return	int 新消息的个数
	 */
	function getNewCount($mid, $targettype = null, $targetid = null, $con=null) {
		$map['recvuserid'] = $mid;
		$map['isread'] = 0;
		if( $targettype ){
			$map['fortype'] = array("LIKE", $targettype . "%");
		}
		if( $targetid ){
			$map['forid'] = $targetid;
		}
		return $this->where($map)->count();
	}
	
	/**
	 * 模板解析
	 *
	 * @param	array $notify_data - 通知数据
	 * @param	array $tpl_data - 模板数据
	 *
	 * @return	string 解析后的数据
	 */
	function _parseTemplate($notify_data, $tpl_data) {
		if( $notify_data['ncontent'] == false ){
			$replace = array();
		}else{
			$replace = unserialize(stripslashes($notify_data['ncontent']));
		}
		if( $replace ){
			$return['title']    = str_replace(array_keys($replace), array_values($replace), $tpl_data['titletpl']);
			$return['body']    = str_replace(array_keys($replace), array_values($replace), $tpl_data['contenttpl']);
		}
		return $return;
	}
	
	/**
	 * 寻找对象分类路径
	 *
	 * 根据对象的从属关系，获得对象的路径信息，比如说：主题下面是任务，任务下面是报送单，那么完整的路径
	 * 就是：declare.businesstheme:1 ; declare.task:1; declare.report;  这表示
	 * 业务主题1下面的任务1下面的所有申报单；
	 *
	 * @return	string 路径信息
	 */
	function _getObjPath( $objclass, $objid ) {
		switch ($objclass) {
			case "declare.report":
				
				//找申报单
				$model_report = D("declare://Biz/Report");
				$map_report ['id'] = $objid;
				$data_report  = $model_report -> selectOne($map_report );
				
				//找任务
				$map_task ['id']  = $data_report['taskid'];
				$model_task = D("declare://Biz/Task");
				$data_task  = $model_task -> selectOne($map_task );
				
				//找主题
				$map_them ['id']  = $data_task['themeid'];
				$model_them = D("declare://Biz/Businesstheme");
				$data_them  = $model_them -> selectOne($map_them );
				return "declare.businesstheme:".$data_them['id']." ; declare.task:".$data_task['id']."; declare.report";
			
			case "finance.requireapply":
				
				$model_apply = D("finance://Biz/RequireAbutment");
				$data_apply  = $model_apply -> getdetail($objid );
				
				$map_th['themecode']  = '131012';
				$model_th = D("finance://Biz/Businesstheme");
				$data_th  = $model_th -> selectOne($map_th );
				return "finance.businesstheme:".$data_th['id']."; finance.requireapply";
			
			case "siptalent.report": //领军
				
				//找申报单
				$model_report = D("siptalent://Biz/Report");
				$map_report ['id'] = $objid;
				$data_report  = $model_report -> selectOne($map_report );
				
				//找任务
				$map_task ['id']  = $data_report['taskid'];
				$model_task = D("siptalent://Biz/Task");
				$data_task  = $model_task -> selectOne($map_task );
				
				//找真实的主题
				//$map_them1 ['id']  = $data_task['themeid'];
				//$model_them1 = D("siptalent://Biz/Businesstheme");
				//$data_them1  = $model_them1 -> selectOne($map_them1 );
				
				//找科技申报里面的主题，因为挂在领军下面了。
				$map_them2 ['themecode']  = "101215";
				$model_them2 = D("declare://Biz/Businesstheme")->getInstance("declare_businesstheme");
				$data_them2  = $model_them2 -> selectOne($map_them2 ); 
				return "declare.businesstheme:".$data_them2['id']." ; declare.task:".$data_task['id']."; declare.report";
				
			default:
				return  $objclass;
		}
	}
	
}

?>