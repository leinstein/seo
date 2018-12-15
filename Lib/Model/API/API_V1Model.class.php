<?php 
/**
 * 接口控制类
 *
 * @copyright   Copyright 2010-2016 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Action
 * @version     20160316
 * @type		project
 * @link        http://www.qisobao.com 
 */

class API_V1Model extends BaseModel{

    protected $host = "http://docker-registry.patsnap.com:18888";
//    protected $appendApi = "http://54.223.225.177:18888/dj-api/assignee/white_list/append";
    protected $baseProductApiUrl = "http://docker-registry.patsnap.com:18888/dj-api/patent";

    protected $pnApi = "/pn/";
    protected $apnoApi = '/detail.json?apno=';
    protected $searchApi = '/search/detail.json?name=';
    protected $appendApi = "/dj-api/assignee/white_list/append";

    /**
	 * 初始化函数
	 * @access public
	 */
	public function _initialize() {
		//继承
		parent::_initialize();
	}
	
	/** 
	 * 数据接口方法
	 * 根据用户请求发来的企业名称查询出企业的标签数据信息（是否高新技术企业，是否国家千人，是否省双创等）
	 * @access public
	 * @param string $epname 企业名称
	 * @return string  处理后的查询结果
	 */
	public function getEnterpriseTagInfo(){
		//返回错误代码
		$data['ErrorCode'] = '101';
		
		//判断用户请求是否正确
		if( !$_GET['epname'] ){
			//用户请求数据错误，则返回空
			$data['ResultData'] = '';
		}else{
			//如用户请求正确，则进行后续操作
			//初始化模型
			$V2_model = D('API/EpTagInfoAPI_V2');
			
			//获取企业标签信息
			$data['ResultData'] = $V2_model -> getEpTagInfo($_GET['epname']);
			
			//判断返回结果
			if($data['ResultData']){
				$data['ErrorCode'] = '0';
			}else{
				$data['ResultData'] = '';
			}
			
		}
		echo urldecode(json_encode(urlencodeAry($data)));
	}
	
	
	/**
	 * 调用接口获取企业的专利信息并存入数据库
	 * 根据用企业名称查询出企业的专利信息
	 * @access public
	 * @return string  处理后的查询结果
	 */
	/*public function getEpTalents(){
		set_time_limit(0);
		//utf8编码输出页面
		header("Content-type: text/html; charset=utf-8");
		
		//定义名录模型
		$model_dir = D("Biz/EpDir");
		 
		//页码
		$p = $_GET['p']?$_GET['p']:1;
		
		$data = $model_dir -> queryRecordEx(null,null,null,'',$num_per_page = 50);

		if($data["data"]){
			echo "开始获取...<br/>";
			//提示进度
			echo "第". $p . "/" . $data['pageCount']. "页.<br/>";
			foreach($data["data"] as $vo){
				//企业名称
				$result1=file_get_contents("http://w-ranking-elb-527924428.cn-north-1.elb.amazonaws.com.cn:8289/dj-api/patent/search/detail.json?name=".urlencode($vo['epname']));
				$result1=json_decode($result1);
				
				if(is_array($result1->data)){
					$talentinfo1=json_encode($result1->data);
				}else{
					$talentinfo1=$result1->data;
				}
	
				$data_talent1['epname']=$vo['epname'];
				$data_talent1['orgcode']=$vo['organcode'];
				$data_talent1['talentinfo']=$talentinfo1;
				$r1 = M("ep_talents",null)->add($data_talent1);
				if($r1){
					echo "获取企业【".$vo['epname']."】的专利信息成功！<br/>";
				}else{
					echo "获取企业【".$vo['epname']."】的专利信息失败！<br/>";
				}
				
				//曾用名匹配
				$bfnames = explode(",",$vo['bfname']);
				foreach($bfnames as $bfname){
					$data_talent2 = array();
					$result2=file_get_contents("http://w-ranking-elb-527924428.cn-north-1.elb.amazonaws.com.cn:8289/dj-api/patent/search/detail.json?name=".urlencode($bfname));
					$result2=json_decode($result2);
					
					if(is_array($result2->data)){
						$talentinfo2=json_encode($result2->data);
					}else{
						$talentinfo2=$result2->data;
					}
					
					$data_talent2['epname']=$vo['epname'];
					$data_talent2['orgcode']=$vo['organcode'];
					$data_talent2['talentinfo']=$talentinfo2;
					$r2 = M("ep_talents",null)->add($data_talent2);
					if($r2){
						echo "获取企业【".$bfname."】的专利信息成功！<br/>";
					}else{
						echo "获取企业【".$bfname."】的专利信息失败！<br/>";
					}
				}
			}
			
			
			if( $p < $data['pageCount']){
				echo "处理第". $p . "/" . $data['pageCount']. "页处理完成.请等待，马上跳转到下一页...";
				echo "<meta http-equiv='refresh' content='1;url=".__URL__."/getEpTalents/p/".($p+1)."'>";
			}else
				echo "全部处理完成.";
		}else{
			echo "企业名录为空！<br/>";
		}
	}*/

    /**
     * 中英文全半角转换
     * @param $names
     * @return array
     */
    protected function getAllNames($names)
    {
        $newNames = array();
        import("@.ORG.Util.FullHalfSwitch");
        array_map(function ($val) use (&$newNames) {
            $newNames = array_merge($newNames, FullHalfSwitch::StrArgs($val));
        }, $names);
        asort($newNames);
        return $newNames;
    }

    /**
     * 判断 追加智慧芽 接口 是否成功，并数据入库追加表
     * @param $epnames
     * @param $epid
     * @return bool
     */
    public function AppendEpnames($epnames, $epid){
        asort($epnames);
        $model = D("Biz/AppendedEpnames");

        $md5Data = md5(json_encode($epnames));
        $map = array('epid'=>$epid, 'md5data'=>$md5Data, 'status'=>1);
        $appended = $model->where($map)->find();

        $res = true;
        if(!$appended) {
            $result = $this->doappendEpNames( $epnames );

            $data['epid'] = $epid;
            $data['epnames'] = $epnames;
            $resultData = json_decode( $result );
            if($resultData->code == 200){
                $data['status'] = 1;
            } else {
                $res = false;
            }
            //追加的企业入库本地表ts_appended
            $model->append($data);
        }
        return $res;
    }

    /**
     * 追加企业名称到智慧芽数据库 用以获取企业的专利信息
     * @param $name 企业名称
     * @return array
     */
    protected function doappendEpNames($names)
    {
        $appendApi = $this->host . $this->appendApi;
        import("@.ORG.Util.HttpClient");
        if ($names) {
            $params = json_encode(array("company_list" => $names));
            $data = HttpClient::httpCurl($appendApi, $params);
        }
        return $data;
    }

    /**
     * 有企业名称循环每次15条获取智慧芽专利信息
     * @param $name 获取专利信息的企业名称
     * @param $epdir 获取专利信息的企业名录信息名录信息
     */
    protected function getEpTalents15($name, $epdir) {
        set_time_limit(0);
        $start = 0;
        $offset = 15;
        $i = 1;
        $model = D("Biz/Patent");
        import("@.ORG.Util.HttpClient");
        $searchApi = $this->baseProductApiUrl . $this->searchApi;
        do {
            $url = $searchApi . urlencode($name) . "&start={$start}&rows={$offset}";
            $res = HttpClient::httpCurl( $url );
            $result = json_decode($res, true);
            if($result['data']) {
                //入库专利信息
                $talentinfo = $result['data'];
                //逐条入库专利信息表
                if($talentinfo) {
                    foreach($talentinfo as $item){
                        $item['epid'] = $epdir['id'];
                        $item['epname'] = $name;
                        unset($item['id']);
                        $r1 = $model->OperateData($item);
                        $res_cont = '';
                        if($r1){
                            $res_cont = "获取企业【".$name."】的专利【".$item['applyno']."】信息成功！<br/>";
                        } else {
                            $res_cont = "获取企业【".$name."】的专利【".$item['applyno']."】信息失败！<br/>";
                        }
                        echo $res_cont;
                    }
                }
                //记录获取专利信息 日志
            } else {
                //异常记录 code
            }
            $start += 15;
            $i++;
        } while($result['data']);
    }

    public function getPatentinfoByEpname() {
        set_time_limit(0);
        ob_start();
        //定义名录模型
        $model_dir = D("Epdir");
        //设置页码
        $page = $_GET['page'] ? $_GET['page'] : 1;
        $start = ($page - 1) * 1;
        //每页数据条数
        $offset = 1;

        $data = $model_dir->queryRecordEx($start, $offset);
        if ($data["data"]) {
            echo "开始获取...<br/>";
            //提示进度
            echo "第" . $page . "/" . $data['pageCount'] . "页.<br/>";
            foreach ($data["data"] as $vo) {
                $names = array($vo['epname']);
                //曾用名
                $bfnames = explode(",", $vo['bfname']);
                $names = array_merge($names, $bfnames);
                //去掉空数据
                $names = array_filter(array_unique($names));
                //转换中英文标点符号，英文全半角
                $names = $this->getAllNames($names);
                //调用 append API
                $res = $this->AppendEpnames($names, $vo['id']);
                if($res){
                    foreach ($names as $name) {
                        $this->getEpTalents15($name, $vo);
                    }
                }
            }
        }
        if ($page < $data['pageCount']) {
            sleep(1);
            echo "处理第" . $page . "/" . $data['pageCount'] . "页处理完成.请等待，马上跳转到下一页...";
            header("Refresh: 1; url=" . U("getPatentinfoByEpname", array("page" => $page + 1)));
        } else {
            echo "数据全部处理完成。";
        }
        ob_flush();
    }

    /**
     * 专利申请号获取专利数据
     * @param $apno
     */
    public function getEpTalentsByApno($apno) {
        import("@.ORG.Util.HttpClient");
        if($apno){
            $url = $this->baseProductApiUrl . $this->apnoApi . $apno;
            $result = HttpClient::httpCurl( $url );
            $model = D("Biz/Patent");

            $talentinfo = json_encode($result['data']);

            foreach($talentinfo as $item){
                $r1 = $model->OperateData($item);
                if($r1){
                    echo "的专利【" . $item['applyno'] . "】信息成功！<br/>";
                } else {
                    echo "的专利【" . $item['applyno'] . "】信息失败！<br/>";
                }
            }
        } else {

        }
    }

    /**
     * 有专利公开号获取专利信息
     */
    public function getEpTalentsByPNFront(){
        $pn = $_REQUEST['pn'] ? $_REQUEST['pn'] : "";
        if($pn){
            $this->getEpTalentsByPn($pn);
        } else {

        }
    }

    /**
     * 有专利号获取专利信息
     */
    public function getEpTalentsByANFront(){
        $apno = $_REQUEST['apno'] ? $_REQUEST['apno'] : '';
        if($apno){
            $this->getEpTalentsByApno($apno);
        } else {

        }
    }

    /**
     * 有公开号获取专利信息
     */
    public function getEpTalentsByPn( $pn ){
        if($pn) {
            import("@.ORG.Util.HttpClient");
            $url = $this->baseProductApiUrl . $this->pnApi . $pn;
            $result = HttpClient::httpCurl( $url );
            $model = D("Biz/Patent");

            if(is_array($result['data'])){
                $talentinfo = json_encode($result['data']);
            } else {
                $talentinfo = $result['data'];
            }

            $r1 = $model->OperateData($talentinfo);
            if($r1){
                echo "的专利【".$talentinfo->applyno."】信息成功！<br/>";
            } else {
                echo "的专利【".$talentinfo->applyno."】信息失败！<br/>";
            }
        } else {

        }
    }

    /**
     * 轮询pn从智慧芽更新专利数据
     */
    public function SyncDataByPN(){
        set_time_limit(0);
        $logfile = "timerLogs/sync-by-applyno-lastid.log";

        $model = D("Biz/Patent");

        $offset = isset($_GET['offset']) && $_GET['offset'] ? $_GET['offset'] : 1000;

        $lastid = file_get_contents($logfile);
        if (!$lastid) $lastid = 0;
        $lastid = trim($lastid);
        $res = $model->order('id desc')->field('id')->limit(1)->find();
        if (empty($res) || !$res['id'] || $res['id'] <= $lastid) $lastid = 0;
        $map['id'] = array('gt', $lastid);
        $map['_string'] = "`announceno` IS NOT NULL AND `announceno` <> ''";

        $list = $model->where($map)
            ->order('id ASC')
            ->field('id, announceno')
            ->limit($offset)->select();

        if($list){
            foreach($list as $item){
                if($item['announceno']) {
                    $this->getEpTalentsByANFront( $item['announceno'] );
                }
            }
            file_put_contents($logfile, $item['id']);
        }
    }

}
?>