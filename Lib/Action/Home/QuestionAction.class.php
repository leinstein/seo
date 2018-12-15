<?php

/**
 * 问题管理控制类
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Home
 * @version     20141010
 * @link        http://www.mitong.com
 */
class QuestionAction extends BaseAction {

    //公共函数，不接受权限检查，写法 array('index');
    public $public_functions = array();
 
    /**
     * 初始化函数
     * @access public
    */
    public function _initialize() {

        //继承
        parent::_initialize();

        //初始化
      	$this -> modelName = "Sys/Question";
    }
    
    /**
     * 默认的首页，一般提供项目对象列表查询功能
     *
     * 第一步，获得用户输入的查询域信息。
     * 第二步，根据查询域信息，排序条件以及列表显示设置调用对应模型层的queryRecordByPage方法，获得查询结果。
     * 第三步，对查询结果进行进一步处理，主要是进行代码集转换、信息拼接等操作。
     * 第四步，将处理后查询结果提交界面层进行处理。
     *
     * @param void
     * @return void
     */
    public function index(){
        
     	//初始化模型
        $model =  D( $this -> modelName );
      
		//获得查询结果
		$page['list'] =   $model -> queryRecordAll($map) ;
		// 输出模板
		$this -> assign( $page );
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this -> display ( $tpl );
    }

    
    /**
     * 调用增加页面模板，显示增加功能界面
     *
     * @param string $pageTmpl 显示模板名称
     * @return void
     */
    public function insertPage() {
    
        // 输出模板
        $this -> display();
    }
    
    /**
     * 模板信息新增功能
     *
     * 调用模型层新增方法insert，将页面数据保存到数据库中。如果增加成功，则给出相应的提示，否则提示出错原因。
     *
     * @param 无 
     * @return mixed 如果增加成功，则返回增加记录的主键值，如果失败则返回false
     */
    public function insert() {

        //初始化模型
        $model =  kernel_model('Biz/News');
       
        //创建对象
        $result = $model -> insert( $_POST );    
        
        //判断结果
        if ($result) {
        	
        	//如果成功后需要推送消息
        	$this -> pubNotify( $result, $_POST['newstitle'], $_POST['checks_p'], $_POST['checks_c'] );

            //显示提示
            $this -> assign('jumpUrl', __URL__ . '/' . 'index');
            $successHint = L('save_success');
            $this -> success($successHint, $ajax);
        } else {
            $this -> error($model -> getError());
        }
    }
    
    
    /**
     * 进行新通知的发布
     *
     * 目前只针对新应用上线进行发布消息
     *
     */
    function pubNotify( $id , $title, $checks_p, $checks_c ){
    
    	//机构模型
    	$modelGovOrgInfo =  kernel_model('Biz/GovOrgInfo');
    
    	//实例化管理端用户信息模型
    	$modelGovUserInfo =  get_usermodel();
    	 
    	//实例化管理端用户模型
    	$modelGovUser =  kernel_model('Biz/User');
    	 
    	//消息通知模型对象
    	$modelNotify = kernel_model( "Biz/Notify" );
    	 
    	$notifyTplid = $_POST['notifyTplid'];
    	 
    	//选中的一级机构
    	//$checks_p = $_POST['checks_p'];
    	//选中的二级机构 -出师
    	//$checks_c = $_POST['checks_c'];
    	//dump($checks_c);
    	//获取选中机构下面的全部用户
    	/*foreach ( $checks_p as $vo ){
    		$map['orgno'] = $vo;
    		$user_info = $modelGovUserInfo -> field('userid,deptno,truename') -> where( $map )  -> find();
    		if( $user_info ){
    			$GovUserInfo[] = $user_info;
    		}
    
    	}
    	//获取选中机构下面的全部用户
    	foreach ( $checks_c as $key_c => $vo_c ){
    		foreach ( $GovUserInfo as $vo_user ){
    			if( $vo_c == $vo_user['deptno']){
    				unset($checks_c[$key_c]);
    			}
    		}
    	}
    	 
    	foreach ( $checks_c as $vo ){
    		$map_c['deptno'] = $vo;
    		$user_info = $modelGovUserInfo -> field('userid,deptno,truename') -> where( $map_c )  -> find();
    		//dump($modelGovUserInfo -> getLastSql());
    		if( $user_info ){
    			$GovUserInfo[] = $user_info;
    		}
    	}
    	*/
    	$map['usertype'] = 'gov';
    	$GovUserInfo = $modelGovUser -> queryRecordAll( $map, 'id');
    	//dump( $modelGovUser -> getLastSql());
    	//
    	foreach ( $GovUserInfo as $vo ){
    		$userid[] = $vo['id'];
    	}
    	
    	
    	/*foreach ( $GovUserInfo as $vo ){
    		$userid[] = $vo['userid'];
    	}*/
    	//dump($userid);
    	$userid = array_unique( $userid) ;
    	$userids = implode(',', $userid );
    	//dump($userids);
    	//exit;
    	$content = array('{newstitle}'=> $title);
    	$gourl = '/portal/index.php?s=/Manage/NewsManage/detail/id/' . $id;
    	//$gourl 	= __GROUP__ .'/NewsManage/detail/id/' . $id;
    	$tpl = 'new_apps_online';

    	//进行消息的推送
    	$result = $modelNotify -> send( $userids, $content, $target, $gourl, $tpl );
    	
    }
    
    /** 
     * 模板信息删除功能
     *
     * 调用模型层删除方法deleteRecord，根据页面传递过来的主键数据删除相关对象信息。如果删除成功，则给出相应的提示，否则提示出错原因。
     * 
     */
    public function delete(){

        //初始化模型
       // $model = D($this -> modelName);
        $model =  kernel_model('Biz/News');
        //删除记录
        $result = $model -> deleteRecord($this -> getPKMap($model));

        //判断结果
        if ($result) {

            //显示提示
            $this -> assign('jumpUrl', __URL__ . '/' . '');
            $successHint = L('delete_success');
            $this -> success($successHint, $ajax);
        } else {
            $this -> error($model -> getError());
        }
    }

    /**
     * 模板信息修改界面
     *
     * 调用模型层新增方法updatePage，将页面数据($_POST)保存到数据库中。如果修改成功，则给出相应的提示，否则提示出错原因。
     *
     * @param string $pageTmpl 显示模板名称
     * @param boolean $pkValue 主键值，用来查询某一个对象的信息
     * @return mixed $data 返回查询的对象信息
     */
    public function updatePage() {

        //模板状态选择条件
        $notifyTpl_status_options = L('notifyTpl_status_options');
        $this -> assign('notifyTpl_status_options',$notifyTpl_status_options);

        //初始化模型
        //$model = D($this -> modelName);
        $model =  kernel_model('Biz/News');
             
        //查询单条记录
            $data = $model -> selectOne($this -> getPKMap($model));

        //判断结果
        if ($data) {
             $this->assign($model -> getModelName(), $data);
            $this -> display('update');
        } else {
            $this -> error('此信息不存在！');
        }
        
    }

    /**
     * 模板信息修改功能
     *
     * 调用模型层修改方法update，将页面数据保存到数据库中。如果修改成功，则给出相应的提示，否则提示出错原因。
     *
     * @param string $returnPage 返回时跳转的页面地址
     * @param boolean $ajax 是否采用Ajax方式调用
     * @param string $successHint 修改成功提示文字
     * @return mixed 如果修改成功则返回修改记录数，否则返回false
     */
    public function update() {

        //初始化模型
       // $model = D($this->modelName);
        $model =  kernel_model('Biz/News');
        
        $_POST['keywords']  = str_replace('，' , ',' , $_POST['keywords'] );
        //创建对象
        $result = $model->update(); 

        //判断结果
        if ($result) {

            //显示提示
            $this->assign('jumpUrl', __URL__);
            $successHint = L('save_success');
            $this->success($successHint);
        } else {
            $this->error($model->getError());
        }
    }

    /**
     * 模板详细信息显示功能
     *
     * 调用模型层的查询方法selectOneDetail，根据页面传递过来的主键数据查询相关对象的信息，并将结果传递给显示页面显示具体内容。
     * 如果查询失败，则提示出错原因。
     */
    public function detail(){

        //初始化模型
        $model = D($this->modelName);
        
        $model->where('id='.$_GET['id'])->setInc('viewcount',1); // 浏览次数加一
        
        //查询单条记录
        if ($pkValue == null)
            $data = $model->selectOneDetail($this->getPKMap($model));
        else
            $data = $model->selectOneDetail(intval($pkValue));     
		
        //将浏览数加一
      //  $model ->setInr
       
        //显示结果
        $failedHint = '此信息不存在！';

        //判断结果
        if ($data) {
            $this->assign($model -> getModelName(), $data);
            $this->display();
        } else {
            $this->error($failedHint);
        }

        //返回
        return $data;
    }
    
    
}