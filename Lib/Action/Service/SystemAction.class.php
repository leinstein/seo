<?php

/**
 * 前台公共控制层类
 *
 * @category   业务控制类：OEM系统设置
 * @copyright   Copyright 2016-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Manage
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
        $this->modelOME  = "Sys/OEM";
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
        $data                         = $model->getAgentOEMConf();
        $page['data']                 = $data;
        $page['login_page_image_arr'] = $data['login_page_image_arr'];
        $page['logo_image_arr']       = $data['logo_image_arr'];
        $this->assign($page);
        $this->display();
    }

//万词霸屏首页
    public function bpindex()
    {
        $this->display();
    }

    //霸屏申请列表
    public function bpxdlist()
    {
        $model = D($this->modelOME);
        $rs    = $model->getbplist();
        $rs = array_reverse($rs);
        $this->assign('data', $rs);
        $this->display();
    }

    //霸屏申请详细页面
    public function bpxdindex($id = null)
    {
        if ($id)
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
        }
        $this->display();
    }

//更新霸屏下单数据
    public function bpupdate()
    {
        $model                      = D($this->modelName);
        $_POST['attachmenttype'][0] = 'login_page_image';
        $_POST['attachmenttype'][1] = 'loginpage_logo_image';
        $_POST['attachmenttype'][2] = 'logo_image';
        $t                      = 1;
        $_POST['bp_updatetime'] = date("Y-m-d h:i:s");
        $result = $model->bpupdateAgentOEMConf($_POST, $t);
        if ($result)
        {
            $this->success('提交成功！等待管理员审核...', U('bpindex'));
        }
        else
        {
            $this->error('提交失败，账户余额不足' . $model->getError());
        }
    }

    /**
     * 修改用户
     *
     * 根据不同的用户类型调用不同的模型增加新的用户
     * @accesspublic
     */
    public function update()
    {
        $model                      = D($this->modelName);
        $_POST['attachmenttype'][0] = 'login_page_image';
        $_POST['attachmenttype'][1] = 'loginpage_logo_image';
        $result                     = $model->updateAgentOEMConf($_POST);
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
     * 维护公告界面
     *
     * @accesspublic
     */
    public function updateNoticePage()
    {
        $model        = D($this->modelName);
        $page['data'] = $model->getNoticeByUserid();
        // 输出模板
        $this->assign($page);
        $this->display();
    }

    /**
     * 维护协议界面
     *
     * @accesspublic
     */
    public function updateNewsPage()
    {
        $model        = D($this->modelName);
        $page['data'] = $model->getNewsByUserid($_GET['newstype'], 5);
        // 输出模板
        $this->assign($page);
        $this->display();
    }

    /**
     * 维护公告和协议
     *
     * @accesspublic
     */
    public function updateNews()
    {
        $model  = D($this->modelName);
        $result = $model->updateNews($_POST);
        if ($result)
        {
            $this->success('保存成功！', U('updateNewsPage', array('newstype' => $_POST['newstype'])));
        }
        else
        {
            $this->error('保存失败，原因' . $model->getError());
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
        $model  = D($this->modelName);
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

    /**
     * 退单
     *
     * @return array 当前登录的用户信息
     */
    public function tuitecheckRecord()
    {
        $Dao      = M('keyword');
        $Funds    = M('funds');
        $Frr      = M('funds_recharge_record');

        $id       = $_GET['id'];
        //审核驳回 进行退款操作(通过，进行扣款操作)

        $data = $Dao->query("SELECT * FROM `ts_sys_oem` WHERE id=" . $id);
        $amount = $data[0]['bp_price'];

        // 更新的条件
        $userid              = $data[0]['bp_userid'];
        $condition['userid'] = $userid;
        $data                = $Funds->query("SELECT *  FROM `ts_funds` WHERE userid = $userid");
        //当前用户总金额
        $totalfunds = $data[0]['totalfunds'];
        //当前用户资金余额
        $balancefunds = $data[0]['balancefunds'];
        //当前用户可用资金
        $availablefunds = $data[0]['availablefunds'];

        $balancefunds         = $balancefunds + $amount;
        $availablefunds       = $availablefunds + $amount;

        $condition['userid']  = $userid;

        $rs['balancefunds']   = $balancefunds;
        $rs['availablefunds'] = $availablefunds;
        $rs['availablefunds'] = $availablefunds;
        $rs['createtime']     = date('Y-m-d H:i:s');

        //g更新当前消费网址资金表
        $Funds->where($condition)->save($rs);
        //更新流水表
        $frr_rs['userid']     = $userid;
        $frr_rs['amount']     = +$amount;
        $frr_rs['createtime'] = date('Y-m-d H:i:s');
        $frr_rs['readpriv'] = '1';
        $Frr->where($condition)->add($frr_rs);

        $result = M('sys_oem')->save(array('id'=>$id,'bp_check'=>3));

        if($result){
            $this->success('退单成功！', U('bpxdlist'));
        }else{
            $this->success('退单失败！', U('bpxdindex'));
        }
    }
}