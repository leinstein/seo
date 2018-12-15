 <?php

/**
 * 前台公共控制层类:海排产品用户管理控制类
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Manage
 * @version     20171012
 * @link        http://www.mitong.com
 */
class QRUserAction extends BaseAction {
	
	public $public_functions = array ();
	
	/**
	 * 初始化函数
	 *
	 * @return void
	 */
	public function _initialize() {
		// 继承
		parent::_initialize ();
		
		$this->modelName = "QR/QRUserView";
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index() {
		
		$model 		= D( $this->modelName);
		
		
		//引入查询工具类
		import('ORG.Util.QueryTools');
		
		//实例化联合查询工具类
		$querytools = new QueryTools();
		
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			if( $_GET['keyword'] ){
				$map['username'] = array('like', '%'.$_GET['keyword'].'%');
			}
			
			$page['list']  = $model -> queryRecordEx( $map, $fields, $querytools->getOrder(), $querytools->getPageparam() );
		
			// 高亮关键词
			foreach ($page['list']['data'] as &$vo ){
				$vo['username'] = str_replace($_GET['keyword'],'<span style="color: #c00">'.$_GET['keyword'] .'</span>' , $vo['username']);
			}
		
		
			$tpl =  ACTION_NAME . ".mobile";
			//传值到模板显示
			$this -> assign($page);
			//判断是否为第一页,如果不是第一页通过ajax返回数据
			if( $_GET['p'] >= 2 ){
				//通过fetch的方式进行渲染
				$content = $this->fetch( 'tpl/'. $tpl  );
				exit($content);
			}
		}else{
		
			// 查询用户名
			if($querytools->paramExist('username')){
				//拼接exp条件
				$exp = array('like', '%'.$_GET['username'].'%');
				$querytools ->addParam('username','username',$exp);
			}
			
			// 查询用户名
			if($querytools->paramExist('epname')){
				//拼接exp条件
				$exp = array('like', '%'.$_GET['epname'].'%');
				$querytools ->addParam('epname','epname',$exp);
			}
		
			// 查询关键词状态
			if($querytools->paramExist('userstatus')){
				//拼接exp条件
				$exp = array('eq', $_GET['userstatus']);
				$querytools ->addParam('userstatus','userstatus',$exp);
			}
		
			// 查询所属的计划
			if($querytools->paramExist('epnbame')){
				//拼接exp条件
				$exp = array('eq', $_GET['planid']);
				$querytools ->addParam('planid','planid',$exp);
			}
		
			//翻页后仍能按照某字段排序
			$querytools ->addParam('order');
		
			//组合查询条件
			$query_params = 'username,num_per_page';
			$this->assign('query_params', combo_url_param($query_params));
			//添加默认排序参数-组织机构代码
			$querytools->addDefOrder('id desc');
		
			//将map条件重新赋值
			$map = $querytools->getMap();
			
			//获得查询结果，传值到模板输出查询的结果
			$page['list'] = $model->getUserList( $map, $fields, $querytools->getOrder(), $querytools->getPageparam() , $_GET['num_per_page']);
			
			//查询的参数字符串
			$page['urlparams'] = $querytools ->getUrlparam();
			
		
			//传值到模板显示
			$this -> assign($page);
		}
		
		$this->display ( $tpl );
		
	}
	
}