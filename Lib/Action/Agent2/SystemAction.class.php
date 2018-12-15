<?php

/**
 * 前台公共控制层类
 *
 * @category   业务控制类：OEM系统设置
 * @copyright   Copyright 2016-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Home
 * @version     20170410
 * @link        http://www.mitong.com
 */
class SystemAction extends BaseAction
{
    /*
     * 公共函数，不接受权限检查，写法 array('index');
     */
    public $public_functions = array();

    /**
     * 初始化函数
     *
     * @return void
     */
    public function _initialize()
    {
        // 继承
        parent::_initialize();
        $this->modelName = "Sys/System";
    }

    /**
     * 首页
     * @accesspublic
     * 新增OEM配置：
     *    客户登录界面背景logo,
     *    后台logo修改，
     *    客服联系方式，
     *    用户协议（添加后设置代理端可自助修改）
     */
    public function index()
    {
        // 初始化用户模型
        $model = D($this->modelName);
        // 获取当前代理商的系统配置
        $data = $model->getAgentOEMConf();
        $page['data']                 = $data;
        $page['login_page_image_arr'] = $data['login_page_image_arr'];
        $page['logo_image_arr']       = $data['logo_image_arr'];
        $this->assign($page);
        $this->display();
    }

    //万词霸屏首页
    public function bpindex()
    {
        // 初始化用户模型
        $model = D($this->modelName);
        $this->display();
    }

    //霸屏申请列表
    public function bpxdlist()
    {
        $model = D($this->modelName);
        $rs    = $model->getAgent2userid();
        $rs = array_reverse($rs);
        $this->assign('data', $rs);
        $this->display();
    }

    //霸屏申请详细页面
    public function bpxdindex($id)
    {
        $model = D($this->modelName);
        // 获取当前代理商的系统配置
        $data = $model->getcheckAgentOEMConf($id);
        // 获取当前代理商的系统配置
        $page['data']                     = $data;
        $page['login_page_image_arr']     = $data['login_page_image_arr'];
        $page['loginpage_logo_image_arr'] = $data['loginpage_logo_image_arr'];
        $page['logo_image_arr']           = $data['logo_image_arr'];
        $this->assign($page);
        $this->display();
    }

    /**
     * 修改用户
     *
     * 根据不同的用户类型调用不同的模型增加新的用户
     * @accesspublic
     */
    public function update()
    {
        $model = D($this->modelName);
        $result = $model->updateAgentOEMConf($_POST);
        if ($result)
        {
            $this->success('修改系统配置成功！', U('index'));
        }
        else
        {
            $this->error('修改系统配置失败，原因' . $model->getError());
        }
    }

    /**
     * 新增文章户
     *
     * 根据不同的用户类型调用不同的模型增加新的用户
     * @accesspublic
     */
    public function insertNews()
    {
        $model = D($this->modelName);
        $result = $model->insertNews($_POST);
        if ($result)
        {
            $this->success('保存成功！', U('news_list'));
        }
        else
        {
            $this->error('保存失败，原因' . $model->getError());
        }
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
    public function news_list()
    {
        //初始化模型
        $model = D($this->modelName);
        //获得查询结果
        $page['list'] = $model->getNewsListAgent();
        // 输出模板
        $this->assign($page);
        $this->display();
    }

    //舆情
    protected function yq_index()
    {
        $this->display();
    }

    protected function gy_index()
    {
        $this->display();
    }
    public function caseShow(){
        $file = ('Upload/bpal/bpal.xls');
        $Dao = D('Tool/Excel');
        $rs = $Dao->readForDeclareConfig($file);
        $data = $rs['printfileconfig'];

        $this->assign('data',$data);
        $this->display();
    }
    public function caseShow_upload(){
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('xls');// 设置附件上传类型
        $upload->savePath =  './Upload/bpal/';// 设置附件上传目录
        $upload->uploadReplace = '1';
        if(!$upload->upload()) {// 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        }else{// 上传成功
            $this->success('上传成功！');
        }

    }
}