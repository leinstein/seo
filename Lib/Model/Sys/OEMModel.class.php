<?php
/**
 * 模型层：代理商OEM系统自定义模型
 *
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170518
 * @link        http://www.qisobao.com
 */
load('@.list');
class OEMModel extends BaseModel
{

    /**
     * 用户表名称
     */
    protected $trueTableName = 'ts_sys_oem';

    /**
     * 构造函数
     */
    function _initialize()
    {
        //执行父类构造函数
        parent::_initialize();
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
    function selectOne($map)
    {
        //调用父类方法获取数据
        $data = parent:: selectOne($map);
        //将数据的中的大字段格式转化成php数组
        //if( $data ){
        // 转码登录页面图片信息
        //if( $data['login_page_image']) {
        $login_page_image_arr                   = json_decode($data['login_page_image'], true);
        $login_page_image_arr['isimage']        = 1;//如果当前附件类型是图片
        $login_page_image_arr['maxsize']        = 10;
        $login_page_image_arr['attachmenttype'] = 'login_page_image';
        $login_page_image_arr['isrequire']      = 1;// 是否必传
        $login_page_image_arr['skin']           = 'simple';
        $login_page_image_arr['tagname']        = 'oem';
        $login_page_image_arr['attachmentdesc'] = '图片比例为：3000 × 1320';
        $data['login_page_image_arr'] = $login_page_image_arr;
        //}
        // 转码登录页面logo图片信息
        $loginpage_logo_image_arr                   = json_decode($data['loginpage_logo_image'], true);
        $loginpage_logo_image_arr['isimage']        = 1;//如果当前附件类型是图片
        $loginpage_logo_image_arr['maxsize']        = 10;
        $loginpage_logo_image_arr['attachmenttype'] = 'loginpage_logo_image';
        $loginpage_logo_image_arr['isrequire']      = 1;// 是否必传
        $loginpage_logo_image_arr['skin']           = 'simple';
        $loginpage_logo_image_arr['tagname']        = 'oem';
        $loginpage_logo_image_arr['attachmentdesc'] = '图片比例为：180 × 60';
        $data['loginpage_logo_image_arr'] = $loginpage_logo_image_arr;
        // 转码log图片信息
        //if( $data['logo_image']) {
        $logo_image_arr                   = json_decode($data['logo_image'], true);
        $logo_image_arr['isimage']        = 1;//如果当前附件类型是图片
        $logo_image_arr['maxsize']        = 10;
        $logo_image_arr['attachmenttype'] = 'logo_image';
        $logo_image_arr['isrequire']      = 1;// 是否必传
        $logo_image_arr['skin']           = 'simple';
        $logo_image_arr['tagname']        = 'oem';
        $logo_image_arr['attachmentdesc'] = '图片比例为：180 × 60';
        $data['logo_image_arr']           = $logo_image_arr;
        //}
        //}
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
    public function queryRecordAll($map, $field = null, $order = null, $relation = false, $maxCount = 10000)
    {
        $list = parent:: queryRecordAll($map, $field, $order, $relation, $maxCount);
        foreach ($list as &$vo)
        {
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
    public function queryRecord($map, $fields, $order = null, $queryOpts)
    {
        $list = parent:: queryRecord($map, $fields, $order, $queryOpts);
        //获取每页显示条数
        $numberPerPage = $queryOpts;//$queryOpts['NumberPerPage'];
        if (!$numberPerPage)
        {
            $numberPerPage = $this->pageNum;;
        }
        foreach ($list['data'] as $key => &$vo)
        {
            //计算序号
            //获取当前的分页参数
            $p        = !empty($_GET['p']) ? $_GET['p'] : 1;
            $No       = ($key + 1) + ($p - 1) * $numberPerPage;
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
     * @param int $num_per_page 表示每页记录数，值为整数，默认读取配置文件中的NUM_PER_PAGE;
     * @param string $url_param 表示翻页后的参数，字符串类型默认为空; 特别的：如果输入数值，那么直接表示每页个数；如果是真假值，那么表示关系；如果输入文本，那么表示PageParameters；
     *
     * @return mixed 查询结果
     */
    public function queryRecordEx($map, $fields, $order = null, $url_param = '', $num_per_page = 20)
    {
        $list = parent:: queryRecordEx($map, $fields, $order, $url_param, $num_per_page);
        foreach ($list['data'] as $key => &$vo)
        {
            //计算序号
            //获取当前的分页参数
            $p        = !empty($_GET['p']) ? $_GET['p'] : 1;
            $No       = ($key + 1) + ($p - 1) * $num_per_page;
            $vo['No'] = $No;
        }
        return $list;
    }

    /**
     * 组合附件
     *
     * @param unknown $data
     * @param unknown $files
     * @return unknown
     */
    function combineFiles($data, $files)
    {
        foreach ($files as $vo_file)
        {
            switch ($vo_file['attachmenttype'])
            {
                case 'login_page_image':
                    $login_page_images = $vo_file;
                    break;
                case 'loginpage_logo_image':
                    $loginpage_logo_image = $vo_file;
                    break;
                case 'logo_image':
                    $logo_images = $vo_file;
                    break;
                default:
                    ;
                    break;
            }
        }
        if ($login_page_images)
        {
            $data['login_page_image'] = my_json_encode($login_page_images);
        }
        if ($logo_images)
        {
            $data['logo_image'] = my_json_encode($logo_images);
        }
        if ($loginpage_logo_image)
        {
            $data['loginpage_logo_image'] = my_json_encode($loginpage_logo_image);
        }
        return $data;
    }

    /**
     * 注销后将用户的登录信息进行修改
     */
    function doAfterlogOut($userid)
    {
        $map['userid']       = $userid;
        $map['status']       = 1;
        $map['loginstatus']  = '已登录';
        $data                = $this->where($map)->field('id')->order('regtime desc')->find($data);
        $data['loginstatus'] = '已注销';
        $data['logouttime']  = date('Y-m-d H:i:s');
        return $this->update($data);
    }

    /**
     *
     */
    function isLoggedin($userid)
    {
        $map['userid']      = $userid;
        $map['status']      = 1;
        $map['loginstatus'] = '已登录';
        return $this->selectOne($map);
    }
    /**
     * 获取一个代理商的系统配置信息
     *
     * @param unknown $userid
     * @return unknown|boolean
     */
    public function getAgentSysConf($userid)
    {
        if (!$userid)
        {
            $userid = $this->getLoginUserId();
        }
        // 获取
        $map['userid'] = $userid;
        $map['status'] = 1;
        return $this->selectOne($map);
    }

    /**
     * 本地验证用户权限
     *
     * @return array 当前登录的用户信息
     */
    public function addRecord($postData, $t)
    {
        $data = $postData;
        $data = $this->combineFiles($data, $postData['files']);
        $me   = $this->getloginUserInfo();
        if (!$t)
        {
            $data['userid'] = $this->getLoginUserId();
            $data['epid']   = $me['epid'];
        }
        else
        {
            $data['bp_userid'] = $this->getLoginUserId();
            $data['bp_epid']   = $me['epid'];
            $data['bp_check']  = '3';
        }
        $result = $this->insert($data);
        return $result;
    }
    public function updateRecord($postData, $t)
    {
        $data = $postData;
        $data = $this->combineFiles($data, $postData['files']);
        $me   = $this->getloginUserInfo();
        if (!$t)
        {
            $data['epid'] = $me['epid'];
        }
        else
        {
            $data['bp_check'] = '3';
        }
        $result = self::update_oem($data);

        return $result;
    }
    public function updatebpxdRecord($postData, $t)
    {
        $data = $postData;
        $data = $this->combineFiles($data, $postData['files']);
        $me   = $this->getloginUserInfo();
        if (!$t)
        {
            $data['epid'] = $me['epid'];
        }
        else
        {
            $data['bp_check'] = '3';
        }
        $id       = $me['id'];
        $amount = $data['bp_price'];
        $Funds = M('funds');
        $Frr   = M('funds_recharge_record');
        $dataF = $Funds->query("SELECT *  FROM `ts_funds` WHERE userid = $id");
        if ($dataF)
        {
            //当前用户总金额
            $totalfunds = $dataF[0]['totalfunds'];
            //当前用户资金余额
            $balancefunds = $dataF[0]['balancefunds'];
            //当前用户可用资金
            $availablefunds = $dataF[0]['availablefunds'];
            if ($totalfunds < $amount || $balancefunds < $amount || $availablefunds < $amount)
            {
                return false;
            }

            $balancefunds         = $balancefunds - $amount;
            $availablefunds       = $availablefunds - $amount;
            $condition['userid']  = $id;

            $rs['balancefunds']   = $balancefunds;
            $rs['availablefunds'] = $availablefunds;

            $rs['createtime']     = date('Y-m-d H:i:s');

            //更新当前消费网址资金表
            $Funds->where($condition)->save($rs);
            //更新流水表
            $frr_rs['userid']     = $id;
            $frr_rs['amount']     = -$amount;
            $frr_rs['createtime'] = date('Y-m-d H:i:s');
            $frr_rs['readpriv'] = '1';

            $Frr->where($condition)->add($frr_rs);
            $data['bp_check'] = '3';

        $result = self::update_oem($data);
            return $result;
        }
        else
        {
            return false;
        }
        return $result;
    }
    //下单
    public function addbpxdRecord($postData, $t)
    {
        $data = $postData;
        $data = $this->combineFiles($data, $postData['files']);
        $me   = $this->getloginUserInfo();
        if (!$t)
        {
            $data['userid'] = $this->getLoginUserId();
            $data['epid']   = $me['epid'];
        }
        else
        {
            $data['bp_userid'] = $this->getLoginUserId();
            $data['bp_epid']   = $me['epid'];
            $data['bp_check']  = '3';
        }
            $data['bp_check'] = '3';
            $result           = $this->insert($data);
            return $result;
    }

    //霸屏提交扣费操作
    public function pbxdupdateRecord($postData, $t)
    {
        $data = $postData;
        $data = $this->combineFiles($data, $postData['files']);
        $me   = $this->getloginUserInfo();
        if (!$t)
        {
            $data['epid'] = $me['epid'];
        }
        else
        {
            $data['bp_check'] = '3';
        }
        $result = self::update_oem($data);
        return $result;
    }
    /**
     * 本地验证用户权限
     *
     * @return array 当前登录的用户信息
     */
    public function bpxdaddRecord($postData, $t)
    {
        $data = $postData;
        $data = $this->combineFiles($data, $postData['files']);
        $me   = $this->getloginUserInfo();
        if (!$t)
        {
            $data['userid'] = $this->getLoginUserId();
            $data['epid']   = $me['epid'];
        }
        else
        {
            $data['bp_userid'] = $this->getLoginUserId();
            $data['bp_epid']   = $me['epid'];
            $data['bp_check']  = '3';
        }
        $result = $this->insert($data);
        return $result;
    }
    /**
     * 审核霸屏下单
     *
     * @return array 当前登录的用户信息
     */
    public function updatecheckRecord($postData)
    {
        $Dao      = M('keyword');
        $Funds    = M('funds');
        $Frr      = M('funds_recharge_record');
        $datap    = $postData;
        $datap    = $this->combineFiles($datap, $postData['files']);
        $bp_check = $datap['bp_check'];
        $id       = $datap['id'];
        //审核驳回 进行退款操作
        if ($bp_check == '1')
        {
            $id   = $postData['id'];
            $data = $Dao->query("SELECT * FROM `ts_sys_oem` WHERE id=" . $id);
            $amount = $datap['bp_price'];

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


            $balancefunds         = $balancefunds - $amount;
            $availablefunds       = $availablefunds - $amount;
            if($availablefunds < 0){
                return false;
            }
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
        }
        $result = self::update_oem($datap);
        if ($result)
        {
            return true;
        }
        return $result;
    }

    static public function update_oem($data)
    {
        //如果输入为空，则
        if ($data == null)
        {
            $data = $_POST;
        }

        //数据验证
        $result  = $data;
        $Dao_oem = D("Sys/OEM");
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
    //获取当前子用户霸屏下单列表
    public function getbplist(){
        $userData = $this -> getloginUserInfo();
        $id = $userData['id'];
        $condition['bp_userid'] = $id;
        $rs  = $this-> where($condition) -> select();
        return $rs;
    }
}

?>