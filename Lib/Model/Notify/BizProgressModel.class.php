<?php

/**
 * 模型层：获取业务数据模型
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Notify
 * @version     20170718
 * @link        http://www.qisobao.com
*/


class BizProgressModel extends BaseModel{
  
  /**
   * 不检查数据库
   */
  protected $autoCheckFields = false;
  
   /**
   * 不检查模型
   */
  protected $model = null;
  
  /*自动处理数据*/
  protected $__auto     = array (
      
  );
  /*
   * 自动验证设置
  */
  protected $__validate  =   array(
  );
  
  /**
   * 构造函数
  */
  function _initialize() {
    //执行父类构造函数
    parent::_initialize();
    
    //初始化模型
    $this->model  = dcexchange_model()  -> getInstance('dc_bizprogress');
  }
  
  /**
   * 获取获取业务进度数据
   *
   * @return array 符合条件的业务进度信息数据
   */
  public function getMy() {
  	
    //获得我的信息
    $loginUser = $this->getLoginUserInfo();
    
    //判断主题类型是企业还是个人
    if($loginUser['usertype']=="ep"){
    	$map['bodyid'] = $loginUser['epid'];
    }else{
    	$map['bodyid'] = $loginUser['userid'];
    }
	
    //只获取有效的数据
    $map['status'] = 1;
	//查询结果
    $list = $this->model -> queryRecordEx( $map, null, "regtime desc");
    
    //返回结果
    return  $list ;

  }
  
  /**
   * 写入或更新业务进度数据
   *
   * @param $body 主体,分为：$body['type'] *主体类型,$body['id'] *主体编号
   * @param $theme 主题,分为：$theme['name'] *主题名称,$theme['code'] 主题代码
   * @param $project 项目，分为：$project['id'] *项目编号，$project['name'] *项目名称，$project['applydate'] *申请日期， $project['url'] *项目链接
   * @param $progress 进度，分为：$progress['hint'] *进度提示，$progress['desc'] 进度说明
   * 
   * @return boolean 
   */
  public function write($body, $theme, $project, $progress){
  	
  	if( empty( $project['id'] ) ){
  		$this->error = "项目编号不能为空";
  		return false;
  	}
	
	if( empty( $progress['hint'] ) ){
  		$this->error = "进度提示不能为空";
  		return false;
  	}
	  	 	
  	//判断是否存在该项目编号
	$biz_map['projectid'] = $project['id'];
	$biz_data['projectname'] = $project['name'];			//项目名称
	$biz_data['bizprogresshint'] = $progress['hint'];
	$biz_data['modtime'] = time();
	$result =  $this->model -> where($biz_map) -> save($biz_data);
	  	
  	//如果成功更新
  	if( $result ){
  		return $result;
	}else{
		//必填验证
	  	if( empty( $body['type'] ) ){
	  		$this->error = "主体类型不能为空";
	  		return false;
	  	}
	  	
	  	if( empty( $body['id'] ) ){
	  		$this->error = "主体编号不能为空";
	  		return false;
	  	}
	  	
	  	if( empty( $theme['name'] ) ){
	  		$this->error = "主题名称不能为空";
	  		return false;
	  	}	  	
	  	
	  	if( empty( $project['name'] ) ){
	  		$this->error = "项目名称不能为空";
	  		return false;
	  	}
	  	
	  	if( empty( $project['applydate'] ) ){
	  		$this->error = "申请日期不能为空";
	  		return false;
	  	}
	  	
	  	if( empty( $project['url'] ) ){
	  		$this->error = "项目链接不能为空";
	  		return false;
	  	}
		
		//获取新增的数据
  
	  	$biz_data['bodytype'] = $body['type'];					//主题类型数据
	  	
	  	//判断用户类型是企业用户还是个人用户
	  	if($body['type'] == 'ep'){								//主体编码
	  		$biz_data['bodyid'] = $body['id'];
	  	}else{
	  		$biz_data['bodyid'] = $body['id'];
	  	}
	  	
		$biz_data['themename'] = $theme['name'];				//业务主题名称
		$biz_data['projectid'] = $project['id'];				//项目编号
		$biz_data['projectname'] = $project['name'];			//项目名称
		$biz_data['prodetailurl'] = $project['url'];			//项目链接
		$biz_data['applytime'] = $project['applydate'];			//申请时间
		$biz_data['bizprogresshint'] = $progress['hint'];		//进度提示
		$biz_data['bizprogressdesc'] = $progress['desc'];		//进度说明
		
		return $this->model -> insert($biz_data);
	}
	  	
  }
}
  
?>