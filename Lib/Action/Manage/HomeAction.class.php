<?php

/**
 * 前台公共控制层类
 *
 * @category   业务控制类
 * @copyright   Copyright 2016-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Manage
 * @version     20170410
 * @link        http://www.mitong.com
 */
class HomeAction extends BaseAction {

	/*
	 * 公共函数，不接受权限检查，写法 array('index');
	 */
    public $public_functions = array ( 'logOut' ,'test','test2','morningsend','aftersend' );

	/**
	 * 初始化函数
	 *
	 * @return void
	 */
	public function _initialize() {

		// 将当前的路径存入session
		$_SESSION['GROUP_NAME'] = GROUP_NAME;
		$_SESSION['GROUP'] 		= __GROUP__;

		// 继承
		parent::_initialize ();
	}
	//上午发送请求(推送所有关键词)
    public function morningsend(){
        $Dao = M('testkeyword');
        $data = $Dao->query("SELECT id,keyword,website,searchengine FROM `ts_testkeyword`");

        foreach ($data as $value) {
            switch($value['searchengine'])
            {
                case 'baidu' :
                    $baidu_sType = '1010';
                    $baidu_keyword[] = $value['keyword'];
                    $baidu_url[] = $value['website'];
                    $baidu_id[] = $value['id'];
                    break;
                case 'baidu_mobile' :
                    $baidu_mobile_sType = '7010';
                    $baidu_mobile_keyword[] = $value['keyword'];
                    $baidu_mobile_url[] = $value['website'];
                    $baidu_mobile_id[] = $value['id'];
                    break;
                case '360':
                    $abc_sType = '1015';
                    $abc_keyword[] = $value['keyword'];
                    $abc_mobile_url[] = $value['website'];
                    $abc_mobile_id[] = $value['id'];
                    break;
                default:
                    $sougou_sType = '1030';
                    $sougou_keyword[] = $value['keyword'];
                    $sougou_mobile_url[] = $value['website'];
                    $sougou_mobile_id[] = $value['id'];
            }
        }
        $time = time();
        $baidu_param=json_encode(array("userId"=>106559,"time"=>$time,"apiExtend"=>1,"businessType"=>1006,"keyword"=>$baidu_keyword,"url"=>$baidu_url,"searchType"=>$baidu_sType));
        $baidu_mobile_param=json_encode(array("userId"=>106559,"time"=>$time,"apiExtend"=>1,"businessType"=>1006,"keyword"=>$baidu_mobile_keyword,"url"=>$baidu_mobile_url,"searchType"=>$baidu_mobile_sType));
        $abc_param=json_encode(array("userId"=>106559,"time"=>$time,"apiExtend"=>1,"businessType"=>1006,"keyword"=>$abc_keyword,"url"=>$abc_mobile_url,"searchType"=> $abc_sType));
        $sougou_param=json_encode(array("userId"=>106559,"time"=>$time,"apiExtend"=>1,"businessType"=>1006,"keyword"=>$sougou_keyword,"url"=>$sougou_mobile_url,"searchType"=>$sougou_sType));
        $this->requestest($sougou_param,$sougou_mobile_id);
        $this->requestest($baidu_param,$baidu_id);
        $this->requestest($baidu_mobile_param,$baidu_mobile_id);
        $this->requestest($abc_param,$abc_mobile_id);
    }
    //上午发送请求(推送10名以外关键词)
    public function aftersend(){
        $Dao = M('testkeyword');
        $data = $Dao->query("SELECT id,keyword,website,searchengine FROM `ts_testkeyword` WHERE latestranking > 10");

        foreach ($data as $value) {
            switch($value['searchengine'])
            {
                case 'baidu' :
                    $baidu_sType = '1010';
                    $baidu_keyword[] = $value['keyword'];
                    $baidu_url[] = $value['website'];
                    $baidu_id[] = $value['id'];
                    break;
                case 'baidu_mobile' :
                    $baidu_mobile_sType = '7010';
                    $baidu_mobile_keyword[] = $value['keyword'];
                    $baidu_mobile_url[] = $value['website'];
                    $baidu_mobile_id[] = $value['id'];
                    break;
                case '360':
                    $abc_sType = '1015';
                    $abc_keyword[] = $value['keyword'];
                    $abc_mobile_url[] = $value['website'];
                    $abc_mobile_id[] = $value['id'];
                    break;
                default:
                    $sougou_sType = '1030';
                    $sougou_keyword[] = $value['keyword'];
                    $sougou_mobile_url[] = $value['website'];
                    $sougou_mobile_id[] = $value['id'];
            }
        }
        $time = time();
        $baidu_param=json_encode(array("userId"=>106559,"time"=>$time,"apiExtend"=>1,"businessType"=>1006,"keyword"=>$baidu_keyword,"url"=>$baidu_url,"searchType"=>$baidu_sType));
        $baidu_mobile_param=json_encode(array("userId"=>106559,"time"=>$time,"apiExtend"=>1,"businessType"=>1006,"keyword"=>$baidu_mobile_keyword,"url"=>$baidu_mobile_url,"searchType"=>$baidu_mobile_sType));
        $abc_param=json_encode(array("userId"=>106559,"time"=>$time,"apiExtend"=>1,"businessType"=>1006,"keyword"=>$abc_keyword,"url"=>$abc_mobile_url,"searchType"=> $abc_sType));
        $sougou_param=json_encode(array("userId"=>106559,"time"=>$time,"apiExtend"=>1,"businessType"=>1006,"keyword"=>$sougou_keyword,"url"=>$sougou_mobile_url,"searchType"=>$sougou_sType));
        $this->requestest($sougou_param,$sougou_mobile_id);
        $this->requestest($baidu_param,$baidu_id);
        $this->requestest($baidu_mobile_param,$baidu_mobile_id);
        $this->requestest($abc_param,$abc_mobile_id);
    }
    public function requestest($wParam,$id){

        $url = "http://api.youbangyun.com/api/customerapi.aspx";
        $wAction='AddSearchTask';
        $api = 'A47201AEA88AD8236FB06A16BB416415';
        $wSign =md5($wAction.$api.$wParam);
        $post_data = array ("wAction" =>$wAction,"wParam" => $wParam,"wSign" =>$wSign );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// post数据
        curl_setopt($ch, CURLOPT_POST, 1);
// post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = json_decode(curl_exec($ch),true);
        curl_close($ch);
        header("Content-Type:text/html; charset=utf-8");
//打印获得的数据

        foreach ($output['xValue'] as $val){
            $outputId[] = $val[0];
        }
        $acombine = array_combine($id,$outputId);
        $display_order = $acombine;
        $ids = implode(',', array_keys($display_order));
        $sql = "UPDATE ts_testkeyword SET taskId = CASE id ";
        foreach ($display_order as $id => $ordinal) {
            $sql .= sprintf("WHEN %d THEN %d ", $id, $ordinal);
        }
        $sql .= "END WHERE id IN ($ids)";
        $Dao = M('testkeyword');
        $Dao->query("$sql");

// print_r($output);
        $news=$output['result']['data'];
// print_r($news);
        var_dump($news);
    }

//接受通知 更新关键词排行
    public function test(){
        $Dao = M('testkeyword');
        $dataxParam = $_POST["xParam"];
        $dataxSign = $_POST["xSign"];
        $dataTaskId = json_decode($dataxParam)->Value->TaskId;
        $dataRankFirst= json_decode($dataxParam)->Value->RankFirst;
        $dataRankLast= json_decode($dataxParam)->Value->RankLast;
     //   $dataRankLastChange= json_decode($dataxParam)->Value->RankLastChange;
        $dataUpdateTime= json_decode($dataxParam)->Value->UpdateTime;
        $nowTimeA = $Dao->execute("SELECT updateTime FROM `ts_testkeyword` where taskId LIKE  '$dataTaskId'");
        $nowTimeB = time();
        $ts = $nowTimeB-strtotime($nowTimeA);
        $param = $ts/3600;
        if($param<0.2){
            echo 1 ;
        }else{
            $ra = $Dao->execute("UPDATE `ts_testkeyword` set initialranking =  '$dataRankFirst' , latestranking =  '$dataRankLast' ,updateTime = '$dataUpdateTime' WHERE taskId ='$dataTaskId' ");

            if($ra){
                echo 1;
            }else{
                echo 2;
            }
//        }
        }
	}
    /**
	 * 首页
	 * @accesspublic
	 */
	public function home() {
		if( $this -> LoginUserName == '排名统计'){
			$this-> redirect('Keyword/effect');
		}

		// 实例化统计模型
		$model = D('Biz/Statistics');


		$modelFunds = D('Biz/Funds') ;

		// 获取该用户下面的全部客户信息
		$users =  $model -> getUsers( );

		// 获取用户id
		$userids 	= $users['userids'];
		// 获取用户所在企业id
		$epids 		= $users['epids'];

		// 获取首页的统计
		$page = $model -> getOptimize( $userids );
		//var_dump($page);
		// 获取系统产品
		$products = $model -> getProducts( $userids );


		foreach ($products as $key => &$value) {

			// 获取进入的达标消费，包含全的产品消耗
			$today_consumption = $model -> getConsumptionToday( $userids, $value['id']);

			$value['today_consumptions'] = $today_consumption ;
		}

		$page['products'] 	= $products;

		// 获取会员数量
		$members 	= $model  -> getMembers( $userids );

		$page['members'] 	= $members;

		$funds_balance = $modelFunds -> getAgentFundsBalance();

		foreach ($funds_balance as $vo){
			$days2[] =$vo['day'];
			$balances[] =$vo['balance'];
		}
		$page['days2'] = json_encode($days2) ;
		$page['balances'] = json_encode($balances) ;

		// 获取运维发布的通知公共
		$page['news'] = D('Biz/News') -> getListByOperationuser( 10);

		$me = $this -> loginUserInfo;
		// 获取哪些用户的消费不足一周、
		// 登录成功后，如果是子用户需要获取用的剩余金额是否足够：剩余金额要大于7天的达标消费
		if( $me['usertype']  == 'admin' ||  $me['usertype']  == 'operation_manager'){



			// 获取消费不足7天的用户
			$users_less = $model -> getLessConsumption();

			if( $users_less ){
				$page['userids_less'] = implode(',' , $userids_less);
				$page['users_less'] = $users_less;

				// $page['show_hint'] = 1;
			}
			$today_consumptions = $vo['today_consumptions'];
			$balancefunds 		= $vo['funds_pool']['balancefunds'];

			if( $balancefunds < 7 * $today_consumptions  ){
				$vo['hint'] =  '【'.$vo['product_name'].'】资金余额不足，请您及时续费';
				$hints[] = $vo['hint'];
				$page['show_hint'] = 1;
			}

		}

		$this -> assign($page);

		$this->display ();
	}

	/**
	 * 跳转到会员界面
	 */
	function member(){
		switch ( $_GET['usertype'] ) {
			case 'sub':
				$this-> redirect('UserManagement/sub_user_list');
			break;
			case 'agent2':
				$this-> redirect('UserManagement/sub_agent_list');
				break;

			default:
				;
			break;
		}
	}

}