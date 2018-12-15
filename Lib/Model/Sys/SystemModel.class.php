<?php
/**
 * 模型层：系统管理模型
 *
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170518
 * @link        http://www.qisobao.com
 */

class SystemModel extends BaseModel
{
    /**
     * 用户表名称
     */
    /* protected $trueTableName = 'ts_sys_oem';  */
    /**
     * 不检查数据库
     */
    protected $autoCheckFields = false;

    /**
     * 构造函数
     */
    function _initialize()
    {
        //执行父类构造函数
        parent::_initialize();
    }

    /**
     * 获取一个代理商的系统配置信息
     *
     * @param unknown $userid
     * @return unknown|boolean
     */
    public function getAgentOEMConf($userid)
    {
        // 初始化OEM模型
        $modelOEM = D('Sys/OEM');
        if (!$userid)
        {
            $userid = $this->getLoginUserId();
        }
        // 获取
        $map['userid'] = $userid;
        $map['status'] = 1;
        return $modelOEM->selectOne($map);
    }

    public function getcheckAgentOEMConf($id)
    {
        // 初始化OEM模型
        $modelOEM = D('Sys/OEM');
        // 获取
        $map['id'] = $id;
        return $modelOEM->selectOne($map);
    }

    public function bpgetAgentOEMConf($userid)
    {
        // 初始化OEM模型
        $modelOEM = D('Sys/OEM');
        if (!$userid)
        {
            $userid = $this->getLoginUserId();
        }
        // 获取
        $map['bp_userid'] = $userid;
        return $modelOEM->selectOne($map);
    }

    /**
     * 获取一个代理商的系统配置信息
     *
     * @param unknown $userid
     * @return unknown|boolean
     */
    public function updateAgentOEMConf($postData, $t)
    {
        // 文件模型模型
        $model_file = D('File/File');
        // 文件模型模型
        $model_OEM               = D('Sys/OEM');
        $postData['files']       = $model_file->combineFiles($postData);
        $username                = $this->getloginUserName();
        $postData['bp_username'] = $username;
        if ($postData['id'])
        {
            $result = $model_OEM->updateRecord($postData, $t);
        }
        else
        {
            $result = $model_OEM->addRecord($postData, $t);
        }
        return $result;
    }

    //提交霸屏下单
    public function bpupdateAgentOEMConf($postData, $t)
    {
        // 文件模型模型
        $model_file = D('File/File');
        // 文件模型模型

        $model_OEM               = D('Sys/OEM');
        $postData['files']       = $model_file->combineFiles($postData);
        $username                = $this->getloginUserName();
        $postData['bp_username'] = $username;
        if ($postData['id'])
        {

            $result = $model_OEM->updatebpxdRecord($postData, $t);
        }
        else
        {

            $result = $model_OEM->addbpxdRecord($postData, $t);
        }
        return $result;
    }

    /**
     * 审核霸屏下单数据
     *
     * @param unknown $userid
     * @return unknown|boolean
     */
    public function updatecheckAgentOEMConf($postData)
    {
        // 文件模型模型
        $model_file = D('File/File');
        // 文件模型模型
        $model_OEM         = D('Sys/OEM');
        $postData['files'] = $model_file->combineFiles($postData);
        $result            = $model_OEM->updatecheckRecord($postData);
        return $result;
    }

    /**
     * 获取一个代理商的系统配置信息
     *
     * @param unknown $userid
     * @return unknown|boolean
     */
    public function insertNews($postData)
    {
        //初始化模型
        $model = D("Biz/News");
        //创建对象
        return $model->insert($postData);
    }

    /**
     * 获取一个代理商的系统配置信息
     *
     * @param unknown $userid
     * @return unknown|boolean
     */
    public function getNewsListAgent()
    {
        //初始化模型
        $model = D("Biz/News");
        //创建对象
        return $model->getListByAgent();
    }

    /**
     * 获取当前的系统公告
     *
     * @param string $userid
     * @return array|boolean
     */
    public function getNoticeByUserid($userid)
    {
        //初始化模型
        $model = D("Biz/News");
        //创建对象
        return $model->getNoticeByUserid($userid);
    }

    /**
     * 获取当前的系统公协议
     *
     * @param string $userid
     * @return array|boolean
     */
    public function getProtocolByUserid($userid)
    {
        //初始化模型
        $model = D("Biz/News");
        //创建对象
        return $model->getProtocolByUserid($userid);
    }

    /**
     * 获取当前的系统公协议
     *
     * @param string $userid
     * @return array|boolean
     */
    public function getNewsByUserid($newstype, $userid)
    {
        //初始化模型
        $model = D("Biz/News");
        switch ($newstype)
        {
            case 'notice':
                return $model->getNoticeByUserid($userid);
                break;
            case 'protocol':
                return $model->getProtocolByUserid($userid);
                break;
        }
    }

    /**
     * 获取一个代理商的系统配置信息
     *
     * @param unknown $userid
     * @return unknown|boolean
     */
    public function updateNews($postData)
    {
        //初始化模型
        $model = D("Biz/News");
        //创建对象
        return $model->updateNews($postData);
    }

    //获取admin下销售和运维 的子客id
    public function getuserid()
    {
        $Dao     = D("user/user");
        $Dao_Oem = M('sys_oem');
        $nowId   = $this->getLoginUserId();
        if ($nowId !== '2'&& $nowId !== '1')
        {
            //service id  admin下直接分配给销售的子客户
            $cont                   = array('seller_id' => $nowId, 'usergroup' => 'Service');
            $Manage_serviceId_Array = $Dao->where($cont)->select();
            foreach ($Manage_serviceId_Array as $v)
            {
                $Manage_serviceId_Array_id[] = $v['id'];
            }
            //Agent id  admin下直接分配给销售的代理商
            $cont                 = array('seller_id' => $nowId, 'usergroup' => 'Agent');
            $Manage_agentId_Array = $Dao->where($cont)->select();
            //获取当前代理商下所有子用户和二级代理商
            foreach ($Manage_agentId_Array as $v)
            {
                $Agent_agentId_Array[] = $v['id'];
            }
            if ($Agent_agentId_Array)
            {
                $contA['pid']          = array('in', $Agent_agentId_Array);
                $Agent_serviceId_Array = $Dao->where($contA)->select();
                foreach ($Agent_serviceId_Array as $v)
                {
                    if ($v['usergroup'] == 'Service')
                    {
                        $Agent_serviceId_Array_id[] = $v['id'];
                    }
                    else if ($v['usergroup'] == 'Agent2')
                    {
                        $Agent_serviceId_Array_Agent2[] = $v['id'];
                    }
                }
                if ($Agent_serviceId_Array_Agent2)
                {
                    //获取二级代理商下所有子用户id
                    $contB['pid']           = array('in', $Agent_serviceId_Array_Agent2);
                    $Agent2_serviceId_Array = $Dao->where($contB)->select();
                    foreach ($Agent2_serviceId_Array as $v)
                    {
                        $Agent2_serviceId_Array_id[] = $v['id'];
                    }
                }
            }
            if (!$Manage_serviceId_Array_id)
            {
                $Manage_serviceId_Array_id = array();
            }
            if (!$Agent_serviceId_Array_id)
            {
                $Agent_serviceId_Array_id = array();
            }
            if (!$Agent2_serviceId_Array_id)
            {
                $Agent2_serviceId_Array_id = array();
            }
            $data  = array_keys(array_flip($Manage_serviceId_Array_id) + array_flip($Agent_serviceId_Array_id));
            $dataB = array_keys(array_flip($data) + array_flip($Agent2_serviceId_Array_id));
            if ($dataB)
            {
                // 初始化用户模型
                $contC['bp_userid'] = array('in', $dataB);
                $rs                 = $Dao_Oem->where($contC)->select();
                return $rs;
            }
        }
        else
        {
            $rs = $Dao_Oem->query('SELECT * FROM  `ts_sys_oem` WHERE bp_epid is NOT NULL ');
            return $rs;
        }
    }

    //获取代理商下的子客id
    public function getAgentuserid()
    {
        $Dao       = D("user/user");
        $Dao_Oem   = M('sys_oem');
        $Dao_epdir = D('Sys_epdir');
        $nowId     = $this->getLoginUserId();
        $nowType   = $this->getloginUserType();
        if ($nowType == 'agent')
        {
            //获取当前账号id下的子客和二级代理商id
            $cont                  = array('pid' => $nowId, 'usergroup' => 'Service');
            $Agent_serviceId_Array = $Dao->where($cont)->select();
            foreach ($Agent_serviceId_Array as $v)
            {
                $Agent_serviceId_Array_id[] = $v['id'];
            }
            //获取当前二级代理商账号下的子用户id
            $cont                = array('pid' => $nowId, 'usergroup' => 'Agent2');
            $Agent_agentId_Array = $Dao->where($cont)->select();
            //获取当前代理商下所有子用户和二级代理商id
            foreach ($Agent_agentId_Array as $v)
            {
                $Agent_agentId_Array_id[] = $v['id'];
            }
            //获取所有二级代理商的子用户id
            if ($Agent_agentId_Array_id)
            {
                $contA['pid']           = array('in', $Agent_agentId_Array_id);
                $Agent2_serviceId_Array = $Dao->where($contA)->select();
                foreach ($Agent2_serviceId_Array as $v)
                {
                    $Agent2_serviceId_Array_id[] = $v['id'];
                }
            }
            if (!$Agent_serviceId_Array_id)
            {
                $Agent_serviceId_Array_id = array();
            }
            if (!$Agent2_serviceId_Array_id)
            {
                $Agent2_serviceId_Array_id = array();
            }
            $data = array_keys(array_flip($Agent_serviceId_Array_id) + array_flip($Agent2_serviceId_Array_id));
        }
        else if ($nowType == 'seller' || $nowType == 'sales_manager')
        {
            //如果是销售获取企业表下seller_manager相同的子客
            $cont                  = array('seller' => $nowId, 'epgroup' => 'Service');
            $epdir_serviceId_Array = $Dao_epdir->where($cont)->select();
            foreach ($epdir_serviceId_Array as $v)
            {
                $epdir_serviceId_Array_id[] = $v['id'];
            }
            if ($epdir_serviceId_Array_id)
            {
                $contD['epid']         = array('in', $epdir_serviceId_Array_id);
                $Agent_serviceId_Array = $Dao->where($contD)->select();
            }
            foreach ($Agent_serviceId_Array as $v)
            {
                $Agent_serviceId_Array_id[] = $v['id'];
            }
            //获取二级代理商的epid
            $cont                 = array('seller' => $nowId, 'epgroup' => 'Agent2');
            $epdir_agent2Id_Array = $Dao_epdir->where($cont)->select();
            foreach ($epdir_agent2Id_Array as $v)
            {
                $epdir_agent2Id_Array_id[] = $v['id'];
            }
            if ($epdir_agent2Id_Array_id)
            {
                $contD['epid']        = array('in', $epdir_agent2Id_Array_id);
                $user_serviceId_Array = $Dao->where($contD)->select();
            }
            foreach ($user_serviceId_Array as $v)
            {
                $user_serviceId_Array_id[] = $v['id'];
            }
            if ($user_serviceId_Array_id)
            {
                $contE['pid']          = array('in', $user_serviceId_Array_id);
                $user2_serviceId_Array = $Dao->where($contE)->select();
            }
            foreach ($user2_serviceId_Array as $v)
            {
                $user2_serviceId_Array_id[] = $v['id'];
            }
            if (!$Agent_serviceId_Array_id)
            {
                $Agent_serviceId_Array_id = array();
            }
            if (!$user2_serviceId_Array_id)
            {
                $user2_serviceId_Array_id = array();
            }
            $data = array_keys(array_flip($Agent_serviceId_Array_id) + array_flip($user2_serviceId_Array_id));
        }
        else
        {
        }
        if ($data)
        {
            // 初始化用户模型
            $contC['bp_userid'] = array('in', $data);
            $rs                 = $Dao_Oem->where($contC)->select();
            return $rs;
        }
    }

    //获取代理商下的子客id
    public function getAgent2userid()
    {
        $Dao       = D("user/user");
        $Dao_Oem   = M('sys_oem');
        $Dao_epdir = D('Sys_epdir');
        $nowId     = $this->getLoginUserId();
        $nowType   = $this->getloginUserType();
        if ($nowType == 'agent2')
        {
            //获取当前账号id下的子客id
            $cont            = array('pid' => $nowId);
            $Agent2_id_Array = $Dao->where($cont)->select();
            foreach ($Agent2_id_Array as $v)
            {
                $Agent2_id_Array_id[] = $v['id'];
            }
            if (!$Agent2_id_Array_id)
            {
                $Agent2_id_Array_id = array();
            }
            $data = array_keys(array_flip($Agent2_id_Array_id));
        }
        else if ($nowType == 'seller' || $nowType == 'sales_manager')
        {
            //如果是销售获取企业表下seller_manager相同的子客
            $cont                  = array('seller' => $nowId, 'epgroup' => 'Service');
            $Agent2_epdir_id_Array = $Dao_epdir->where($cont)->select();
            foreach ($Agent2_epdir_id_Array as $v)
            {
                $Agent2_epdir_id_Array_id[] = $v['id'];
            }
            if ($Agent2_epdir_id_Array_id)
            {
                $contE['epid']        = array('in', $Agent2_epdir_id_Array_id);
                $Agent2_user_id_Array = $Dao->where($contE)->select();
            }
            foreach ($Agent2_user_id_Array as $v)
            {
                $Agent2_user_id_Array_id[] = $v['id'];
            }
            if (!$Agent2_user_id_Array_id)
            {
                $Agent2_user_id_Array_id = array();
            }
            $data = array_keys(array_flip($Agent2_user_id_Array_id));
        }
        else
        {
        }
        if ($data)
        {
            // 初始化用户模型
            $contC['bp_userid'] = array('in', $data);
            $rs                 = $Dao_Oem->where($contC)->select();
            return $rs;
        }
    }
}

?>