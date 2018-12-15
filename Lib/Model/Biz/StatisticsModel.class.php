<?php

/**
 * 模型层：统计分析模型
 *
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20170611
 * @link        http://www.qisobao.com
 */
class StatisticsModel extends BaseModel{

    /**
     * 不检查数据库
     */
    protected $autoCheckFields = false;

    // 定义当前登录用户的信息
    protected $me = null;

    /**
     * 构造函数
     */
    function _initialize() {
        //执行父类构造函数
        parent::_initialize();

        $this -> me = $this -> getloginUserInfo();
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
    function selectOne( $map ){

        //调用父类方法获取数据
        $data = parent:: selectOne( $map );

        //将数据的中的大字段格式转化成php数组
        if( $data ){

        }
        return $data;
    }
    /**
     *  判断当前的用户是否已经开通了海排产品
     */
    function is_has_opened(){

        $me 		= $this -> me;
        $productids = $me['productids'];

        if( in_array(1,$productids)){
            $_SESSION['has_open_ow'] = 1;
            return true;
        }else{
            $_SESSION['has_open_qr'] = 0;
        }

        return false;

    }

    /**
     * 获取用户id和用户对应的企业id
     *
     * 获取用户id和用户对应的企业id
     * 根据当前登录用户的用户类型和对应的分组来查询该用户下面的全部子代理、子用户的信息
     *
     * @param number $mode 方式默认为1.不查询
     * @return 当前登录的用户信息
     */
    function getUsers( $mode = 1 ){

        $me = $this -> getloginUserInfo();
        $role_info 		= $me['role_info'];
        $depart_info 	= $me['depart_info'];

        switch (  $me ['usertype']  ) {
            case 'admin': // 管理员
            case 'operation_manager':// 运维
            case 'operation':// 运维
                $userids 	= 'all';
                $epids 		= 'all';
                if( $mode == 2 ){
                    $model_user = D('User/User');
                    // 获取全部的用户
                    $list = $model_user -> getSUbUsersByManage();
                    foreach ($list as $vo ){
                        /* $userids[] 	= $vo['id'];
                        $epids[] 	= $vo['epid']; */
                        if( $vo['id'] && $vo['username']){
                            $users[$vo['id']] 	= $vo['username'];
                        }

                    }
                }
                break;
            case 'sub':// 子用户
                $userids[] 	= $me['id'];
                $epids[] 	= $me['epid'];
                $users[$me['id']] 	= $me['username'];
                //
                break;
            case 'agent':// 一级代理
                unset($userids);
                unset( $epids );
                $model_user = D('User/User');
                // 获取全部子用户
                $sub_suers = $model_user -> getSubUserForAgent();

                foreach ($sub_suers as $vo_u1) {
                    $userids[] 	= $vo_u1['id'];
                    $epids[] 	= $vo_u1['epid'];
                }

                /* if( $me['isopen_subagent'] == 1 ){
                    //
                    $sub_suerss = $model_user -> getSubSubUserForAgent();

                    foreach ($sub_suerss as $vo_u2) {
                        $userids[] 	= $vo_u2['id'];
                        $epids[] 	= $vo_u2['epid'];
                        $users[$vo_u2['id']] 	= $vo_u2['username'];
                    }
                } */

                break;
            case 'agent2':// 二级代理：获取全部的子用户
                $model_user = D('User/User');
                $sub_suerss = $model_user -> getSubUserForAgent2();

                foreach ($sub_suerss as $vo_u2) {
                    $userids[] 	= $vo_u2['id'];
                    $epids[] 	= $vo_u2['epid'];
                    $users[$vo_u2['id']] 	= $vo_u2['username'];
                }


                //dump($sub_suerss);exit;
                break;
            //			case 'sales_manager':// 销售经理：获取自己的客户或者员工的客户
//				$model_user = D('User/User');
//
//				$list = $model_user -> getUsersBySellerManager( $me['id'] );
//				foreach ($list as $vo ){
//					$userids[] 	= $vo['id'];
//					$epids[] 	= $vo['epid'];
//					$users[$vo['id']] 	= $vo['username'];
//				}
            case 'sales_manager':// 销售经理：获取自己的客户
                $model_user = D('User/User');

                $list = $model_user -> getUsersBySellerManager( $me['id'] );
                foreach ($list as $vo ){
                    $userids[] 	= $vo['id'];
                    $epids[] 	= $vo['epid'];
                    $users[$vo['id']] 	= $vo['username'];
                }

                break;
            case 'customer_manager':// 客服经理：获取自己的客户或者员工的客户
                $model_user = D('User/User');

                $list = $model_user -> getUsersByCustomerManager( $me['id'] );
                foreach ($list as $vo ){
                    $userids[] 	= $vo['id'];
                    $epids[] 	= $vo['epid'];
                    $users[$vo['id']] 	= $vo['username'];
                }
                break;
            case 'seller':// 销售经理：获取自己的客户
                $model_user = D('User/User');
                $list = $model_user -> getUsersBySeller( $me['id'] );
                foreach ($list as $vo ){
                    $userids[] 	= $vo['id'];
                    $epids[] 	= $vo['epid'];
                    $users[$vo['id']] 	= $vo['username'];
                }
                break;
            case 'customer':// 客服：获取自己的客户
                $model_user = D('User/User');
                $list = $model_user -> getUsersByCustomer( $me['id'] );
                foreach ($list as $vo ){
                    $userids[] 	= $vo['id'];
                    $epids[] 	= $vo['epid'];
                    $users[$vo['id']] 	= $vo['username'];
                }
                break;

            default:
                $model_user = D('User/User');

                $staffids[] =  $me['id'];
                // 如果是一级角色，获取该用户的全部子用户
                if(  $role_info ['rolelevel']  = 1 ){
                    // 获取全部的子用户
                    $map_staff['pid'] 	= $me['id'];
                    $map_staff['status'] = 1;

                    $staffs = $model_user -> queryRecordAll( $map_staff );

                    foreach ($staffs as $vo_staff){
                        $staffids[]= $vo_staff['id'];
                    }
                }

                switch ( $depart_info['departname']) {
                    case '销售部':// 销售
                        $map_user['seller_id'] 	= array('IN' , $staffids);
                        $map_user['status'] 	= 1;
                        $users = $model_user -> queryRecordAll( $map_user );
                        foreach ($users as $vo ){
                            if( $vo['usertype'] == 'agent'){
                                $map_user1['pid'] 	=  $vo['id'];
                                $map_user1['status'] = 1;
                                $users1 = $model_user -> queryRecordAll( $map_user1 );
                                foreach ($users1 as $vo_user1 ){
                                    $userids[] = $vo_user1['id'];
                                }
                            }else {
                                $userids[] = $vo['id'];
                            }
                        }
                        $userids = array_unique( $userids );
                        if( $userids ){
                            $map['createuserid'] 	= array( 'IN', $userids );
                            $map['status'] 			= 1;
                        }
                        break;

                    default:
                        ;
                        break;
                }

                break;
        }
        if(is_array( $userids )){
            $userids 	= array_unique( $userids );
        }
        if(is_array( $epids )){
            $epids 	= array_unique( $epids );
        }

        $return['userids'] 	= $userids;
        $return['epids'] 	= $epids;
        $return['users'] 	= $users;
        //dump($data);
        return $return;
    }

    /**
     * 获取用户全部产品的统计
     *
     * @param array $type 统计的类型
     * @return var 如果查询成功则返回对象信息，如果失败则返回false
     */
// 	function getUserids( $type ){
// 		$me = $this -> getloginUserInfo();

// 		$role_info 		= $me['role_info'];
// 		$depart_info 	= $me['depart_info'];
// 		switch (  $me ['usertype']  ) {
// 			case 'admin': // 管理员
// 			case 'operation_manager':// 运维
// 			case 'operation':// 运维
// 				$userids = 'all';
// 				break;
// 			case 'sub':// 子用户
// 				$userids[] = $me['id'];
// 				break;
// 			case 'agent':// 一级代理
// 				unset($userids);
// 				$model_user = D('User/User');
// 				// 获取全部子用户以及二级代理下面的子用户
// 				$sub_suers = $model_user -> getSubUserForAgent();

// 				foreach ($sub_suers as $vo_u1) {
// 					$userids[] = $vo_u1['id'];
// 				}

// 				if( $me['isopen_subagent'] == 1 ){
// 					$sub_suerss = $model_user -> getSubUserForAgent2();
// 					foreach ($sub_suerss as $vo_u2) {
// 						$userids[] = $vo_u2['id'];
// 					}
// 				}

// 				break;
// 			case 'agent2':// 二级代理：获取全部的子用户
// 				$model_user = D('User/User');
// 				$sub_suerss = $model_user -> getSubUserForAgent2();
// 				foreach ($sub_suerss as $vo_u2) {
// 					$userids[] = $vo_u2['id'];
// 				}
// 				break;
// 			case 'sales_manager':// 销售经理：获取自己的客户或者员工的客户
// 			case 'customer_manager':// 客服经理：获取自己的客户或者员工的客户
// 				$model_user = D('User/User');
// 				$sellerids[] = $me['id'];
// 				// 获取我的全部员工
// 				$children = $model_user -> getChildrenUsers();
// 				foreach ($children as $vo ){
// 					$sellerids[] = $vo['id'];
// 				}
// 				$users = $model_user -> getUsersBySeller( $sellerids );
// 				foreach ($users as $vo ){
// 					$userids[] = $vo['id'];
// 				}
// 				break;
// 			case 'seller':// 销售经理：获取自己的客户
// 			case 'customer':// 客服：获取自己的客户
// 				$model_user = D('User/User');
// 				$users = $model_user -> getUsersBySeller( $me['id'] );
// 				foreach ($users as $vo ){
// 					$userids[] = $vo['id'];
// 				}
// 				break;

// 			default:
// 				$model_user = D('User/User');

// 				$staffids[] =  $me['id'];
// 				// 如果是一级角色，获取该用户的全部子用户
// 				if(  $role_info ['rolelevel']  = 1 ){
// 					// 获取全部的子用户
// 					$map_staff['pid'] 	= $me['id'];
// 					$map_staff['status'] = 1;

// 					$staffs = $model_user -> queryRecordAll( $map_staff );

// 					foreach ($staffs as $vo_staff){
// 						$staffids[]= $vo_staff['id'];
// 					}
// 				}

// 				switch ( $depart_info['departname']) {
// 					case '销售部':// 销售
// 						$map_user['seller_id'] 	= array('IN' , $staffids);
// 						$map_user['status'] 	= 1;
// 						$users = $model_user -> queryRecordAll( $map_user );
// 						foreach ($users as $vo ){
// 							if( $vo['usertype'] == 'agent'){
// 								$map_user1['pid'] 	=  $vo['id'];
// 								$map_user1['status'] = 1;
// 								$users1 = $model_user -> queryRecordAll( $map_user1 );
// 								foreach ($users1 as $vo_user1 ){
// 									$userids[] = $vo_user1['id'];
// 								}
// 							}else {
// 								$userids[] = $vo['id'];
// 							}
// 						}
// 						$userids = array_unique( $userids );
// 						if( $userids ){
// 							$map['createuserid'] 	= array( 'IN', $userids );
// 							$map['status'] 			= 1;
// 						}
// 						break;

// 					default:
// 						;
// 						break;
// 				}

// 				break;
// 		}

// 		//dump($data);
// 		return $userids;
// 	}


// 	/**
// 	 * 获取当期用户下面的全部企业id
// 	 *
// 	 * @param array $type 统计的类型
// 	 * @return var 如果查询成功则返回对象信息，如果失败则返回false
// 	 */
// 	function getEpids( $type ){

// 		$me = $this -> getloginUserInfo();

// 		$role_info 		= $me['role_info'];
// 		$depart_info 	= $me['depart_info'];

// 		switch (  $role_info ['rolecode']  ) {
// 			case 'admin':
// 			case 'operation_manager':
// 			case 'operation':
// 				$userids = 'all';
// 				break;
// 			case 'sub':// 子用户
// 				$epids[] = $me['epid'];
// 				break;
// 			case 'agent':// 一级代理
// 				unset($epids);
// 				$model_user = D('User/User');
// 				// 获取全部子用户以及二级代理下面的子用户
// 				$sub_suers = $model_user -> getSubUserForAgent();

// 				foreach ($sub_suers as $vo_u1) {
// 					$epids[] = $vo_u1['epid'];
// 				}

// 				if( $me['isopen_subagent'] == 1 ){
// 					$sub_suerss = $model_user -> getSubUserForAgent2();
// 					foreach ($sub_suerss as $vo_u2) {
// 						$epids[] = $vo_u2['epid'];
// 					}
// 				}
// 				// 获取子代理下面的全部自用或

// 				break;
// 			case 'agent2':// 二级代理
// 				$sub_suerss = $model_user -> getSubUserForAgent2();
// 				foreach ($sub_suerss as $vo_u2) {
// 					$epids[] = $vo_u2['epid'];
// 				}
// 				break;
// 			default:
// 				$model_user = D('User/User');

// 				$staffids[] =  $me['id'];
// 				// 如果是一级角色，获取该用户的全部子用户
// 				if(  $role_info ['rolelevel']  = 1 ){
// 					// 获取全部的子用户
// 					$map_staff['pid'] 	= $me['id'];
// 					$map_staff['status'] = 1;

// 					$staffs = $model_user -> queryRecordAll( $map_staff );

// 					foreach ($staffs as $vo_staff){
// 						$staffids[]= $vo_staff['id'];
// 					}
// 				}

// 				switch ( $depart_info['departname']) {
// 					case '销售部':// 销售
// 						$map_user['seller_id'] 	= array('IN' , $staffids);
// 						$map_user['status'] 	= 1;
// 						$users = $model_user -> queryRecordAll( $map_user );
// 						foreach ($users as $vo ){
// 							if( $vo['usertype'] == 'agent'){
// 								$map_user1['pid'] 	=  $vo['id'];
// 								$map_user1['status'] = 1;
// 								$users1 = $model_user -> queryRecordAll( $map_user1 );
// 								foreach ($users1 as $vo_user1 ){
// 									$userids[] = $vo_user1['id'];
// 								}
// 							}else {
// 								$userids[] = $vo['id'];
// 							}
// 						}
// 						$userids = array_unique( $userids );
// 						if( $userids ){
// 							$map['createuserid'] 	= array( 'IN', $userids );
// 							$map['status'] 			= 1;
// 						}
// 						break;

// 					default:
// 						;
// 						break;
// 				}

// 				break;
// 		}

// 		//dump($data);
// 		return $userids;
// 	}

    /**
     * 获取产品；获取开通的产品
     */
    function getProducts( $epids ) {
        // 如果当期用户是代理商或者二级代理商需要获取代理
        $me = $this -> me ;

        // 系统产品模型
        $model_epdir = D('Sys/Epdir');
        switch ( $me['usertype'] ) {
            case 'agent':
            case 'agent2':
                $epdir = $model_epdir -> selectOne( array('id' => $me['epid']));
                $products =  $epdir['products'];
                break;

            default:
                if( $epids ){

                    if( $epids == 'all'){
                        // 系统用户模型
                        $model_product = D('Sys/Product');
                        $products = $model_product -> getProducts();
                    }else{

                        $map['id'] 	= array( 'IN', $epids );

                        $map['epgroup'] =  array( array( 'EQ', 'Service' ),array( 'EQ', 'Agent' ),array( 'EQ', 'Agent2' ),'OR');
                        $map['status'] 			= 1;
                        $epdirs = $model_epdir -> queryRecordAll( $map );
                        foreach ($epdirs as $value) {

                            foreach ($value['product_arr'] as $vo_product) {
                                $products[] =  $vo_product;
                            }
                        }
                    }
                }

                // 二维数组去重复
                $products = array_unique_fb( $products );
                break;
        }

        return $products;

    }



    /**
     * 获取产品；获取开通的产品
     */
    function getSites( $userids ) {

        // 系统站点模型
        $model_site = D('Biz/Site');

        // 如果当期用户是代理商或者二级代理商需要获取代理
        $me = $this -> me ;

        if( $userids ){
            if( $userids != 'all'){
                $map['createuserid'] = array('IN', $userids );
            }
            $map['sitestatus'] 		= '优化中';
            $map['status'] 			= 1;
            $list = $model_site -> queryRecordAll( $map,'id,website,sitename' );
        }
        return $list;

    }


    /**
     * 获取优站宝产品首页统计
     *
     * @param array $userids 用户id
     * @return var 如果查询成功则返回对象信息，如果失败则返回false
     */
    function getOptimize( $userids ){

        // G('begin');

        // 1获取站点总数
        $site_num = $this -> getSiteNum( $userids );
        $data['siteNum'] 		= $site_num;


        // 2获取优化中关键词总数量：关键词总数
        $purchased_kw_num = $this -> getPurchasedKeywordNum( $userids );
        $data['purchasedKeywordNum']	= $purchased_kw_num;
        // 3获取最新达标关键词数量:最新达标词数
        $standard_kw_num = $this -> getStandardKeywordNum( $userids );
        $data['stankeywordNum'] 		= $standard_kw_num;

        //达标率
        if($purchased_kw_num == 0 || $standard_kw_num==0){$data['dabiaolv'] = 0;}else{
            $data['dabiaolv'] = round($standard_kw_num/$purchased_kw_num*100,1).'%';

        }


        // 4获取最新达标关键词消费：最新消费
        $standardsFee = $this -> getTodayFee( $userids );
        $data['standardsFee'] 			= $standardsFee;

        // 5获取本月消费:本月消费
        $consumption_month = $this -> getAllConsumptionMonth( $userids ,1);
        $data['consumption_month'] = $consumption_month;

        // 6获取累计消费:累计消费
        $consumptionfunds = $this -> getAllConsumption( $userids ,1);
        $data['consumptionfunds'] = $consumptionfunds;

        // 获取关键词达标率:关键词达标率
        $data['compliance_rate'] = round( $standard_kw_num / $purchased_kw_num ,2) * 100 .'%';

        // 7获取上个月的消费记录
        //G('begin1');
        $consumerdetails_last = $this -> getConsdetailsForLastMonth( $userids ,1);

        //G('end1');
        // 进行统计区间
        //echo G('begin1','end1').'s';
        foreach ($consumerdetails_last as $vo){
            //$days[]	 				= $vo['day'];
            $cons_last_month[] 		= $vo['consumption'];
        }

        $data['consumptions_last_month'] = json_encode($cons_last_month) ;

        // 8获取本月的消费统计
        $consumerdetails_this = $this -> getConsdetailsForThisMonth( $userids ,1);
        foreach ($consumerdetails_this as $vo){
            $cons_this_month[] =$vo['consumption'];
            $days[]	 		= $vo['day'];
        }

        $begin_day =  $days[0];
        $end_day =  $days[count($days) -1];
        $diff = 31 - $end_day;
        for($i = 1 ;$i<= $diff; $i++){
            $days[]= $end_day + $i;
        }

        $data['days'] = json_encode($days) ;
        $data['consumptions_this_month'] = json_encode($cons_this_month) ;

        // 9获取上个月的消费记录
        $standardNumsLast = $this -> getStandardNumForLastMonth( $userids ,1);
        foreach ($standardNumsLast as $vo){
            $standard_num_last_month[] 	= $vo['num'];
            $standard_rate_last_month[] = $vo['rate'];
        }
        $data['standard_num_last_month'] = json_encode($standard_num_last_month) ;
        $data['standard_rate_last_month'] = json_encode($standard_rate_last_month) ;

        // 10获取这个月的消费记录
        $standardNumsThis = $this -> getStandardNumForThisMonth( $userids,1 );
        foreach ($standardNumsThis as $vo){
            $standard_num_this_month[] 	= $vo['num'];
            $standard_rate_this_month[] = $vo['rate'];
        }
        $data['standard_num_this_month'] = json_encode($standard_num_this_month) ;
        $data['standard_rate_this_month'] = json_encode($standard_rate_this_month) ;

        // 如果是子用户需要统计最近10天的消费记录
        if( $role_info ['rolecode']  == 'sub'){

            $consumerdetails_10days = $this -> getConsdetailsForLast10Days( $userids,1 );

            foreach ($consumerdetails_10days as $vo){
                $consumerdetails[] 	= $vo['consumption'];
                $date[] = substr($vo['date'],5);
            }
            $data['consumptions_ten_days'] = json_encode($consumerdetails) ;
            $data['date'] = json_encode($date) ;
        }

        // 获取用户的资金池统计信息
        $funds_pool = $this -> getFundsPool( $userids, 1 );

        $data['funds_pool'] = $funds_pool;

        // 资金总额
        $data['totalfunds'] = $funds_pool['totalfunds'];

        // 资金余额
        $data['balancefunds'] = $funds_pool['balancefunds'];

        // 资金可用余额
        $data['availablefunds'] = $funds_pool['availablefunds'];

        // 资金总额
        $data['totalfunds'] = $funds_pool['totalfunds'];
        // 冻结资金
//        //如果是分运维登录只显示自己
//
//        $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
//        $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
//        if($usertype == 'operation'){
//            $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
//            $ids = array_map('current', $ids);
//            $ids = implode(',',$ids);
//            if($ids != ''){
//                $siteids['siteid'] = array('in',$ids);
//                $keyword_f = M('keyword');
//                $freezef = $keyword_f->sum('freezefunds');
//                //$freezef = $keyword_f->where($siteids)->sum('freezefunds');
//                $freeze_xiaofei = $keyword_f->field('id,price,standarddays')->select();
//                //$freeze_xiaofei = $keyword_f->field('id,price,standarddays')->where($siteids)->select();
//                $freezefunds_sum = 1;
//                foreach ($freeze_xiaofei as $v){
//                    $freezefunds_sum += $v['price'] * $v['standarddays'];
//                }
//
//            }else{
//                $map['status'] 			= 999;
//            }
//        }

        $data['freezefunds'] = $funds_pool['freezefunds'];
        // 初始冻结资金
        $data['initfreezefunds'] = $funds_pool['initfreezefunds'];

        // update By Richer 于2017年9月5日19:48:36 增加每个月的数据汇总
        $consumerdetails_months = $this -> getConsdetailsForMonths( $userids , 1 );

        foreach ($consumerdetails_months as $vo){
            $months[]	 		= $vo['month'];
            $cons_months[] 		= $vo['consumption'];
        }
        $data['months'] 		= json_encode($months) ;
        $data['cons_months'] 	= json_encode($cons_months) ;

        // ...其他代码段
        //G('end');
        // 进行统计区间
        //echo G('begin','end').'s';
        return $data;
    }

    /**
     * 获取用户全部产品的统计
     *
     * @param array $type 统计的类型
     * @return var 如果查询成功则返回对象信息，如果失败则返回false
     */
    function getIndexStatistics( $userids, $productid ){

        G('begin');

        // 获取站点总数
        $site_num = $this -> getSiteNum( $userids,$productid );
        $data['siteNum'] 		= $site_num;

        // 获取优化中关键词总数量：关键词总数
        $purchased_kw_num = $this -> getPurchasedKeywordNum( $userids );
        $data['purchasedKeywordNum']	= $purchased_kw_num;
        // 获取最新达标关键词数量:最新达标词数
        $standard_kw_num = $this -> getStandardKeywordNum( $userids );
        $data['stankeywordNum'] 		= $standard_kw_num;

        // 获取最新达标关键词消费：最新消费
        $standardsFee = $this -> getTodayFee( $userids );
        $data['standardsFee'] 			= $standardsFee;

        // 获取本月消费:本月消费
        $consumption_month = $this -> getAllConsumptionMonth( $userids );
        $data['consumption_month'] = $consumption_month;

        // 获取累计消费:累计消费
        $consumptionfunds = $this -> getAllConsumption( $userids );
        $data['consumptionfunds'] = $consumptionfunds;

        // 获取关键词达标率:关键词达标率
        $data['compliance_rate'] = round( $standard_kw_num / $purchased_kw_num ,2) * 100 .'%';

        // 获取上个月的消费记录
        G('begin1');
        $consumerdetails_last = $this -> getConsdetailsForLastMonth( $userids );
        G('end1');
        // 进行统计区间
        echo G('begin1','end1').'s';
        foreach ($consumerdetails_last as $vo){
            $days[]	 				= $vo['day'];
            $cons_last_month[] 		= $vo['consumption'];
        }
        $data['days'] = json_encode($days) ;
        $data['consumptions_last_month'] = json_encode($cons_last_month) ;

        // 获取本月的消费统计
        $consumerdetails_this = $this -> getConsdetailsForThisMonth( $userids );
        foreach ($consumerdetails_this as $vo){
            $cons_this_month[] =$vo['consumption'];
        }
        $data['consumptions_this_month'] = json_encode($cons_this_month) ;

        // 获取上个月的消费记录
        $standardNumsLast = $this -> getStandardNumForLastMonth( $userids );
        foreach ($standardNumsLast as $vo){
            $standard_num_last_month[] 	= $vo['num'];
            $standard_rate_last_month[] = $vo['rate'];
        }
        $data['standard_num_last_month'] = json_encode($standard_num_last_month) ;
        $data['standard_rate_last_month'] = json_encode($standard_rate_last_month) ;

        // 获取上个月的消费记录
        $standardNumsThis = $this -> getStandardNumForThisMonth( $userids );
        foreach ($standardNumsThis as $vo){
            $standard_num_this_month[] 	= $vo['num'];
            $standard_rate_this_month[] = $vo['rate'];
        }
        $data['standard_num_this_month'] = json_encode($standard_num_this_month) ;
        $data['standard_rate_this_month'] = json_encode($standard_rate_this_month) ;

        // 如果是子用户需要统计最近10天的消费记录
        if( $role_info ['rolecode']  == 'sub'){

            $consumerdetails_10days = $this -> getConsdetailsForLast10Days( $userids );

            foreach ($consumerdetails_10days as $vo){
                $consumerdetails[] 	= $vo['consumption'];
                $date[] = substr($vo['date'],5);
            }
            $data['consumptions_ten_days'] = json_encode($consumerdetails) ;
            $data['date'] = json_encode($date) ;
        }



        // 获取用户的资金池统计信息
        $funds_pool = $this -> getFundsPool( $userids );

        $data['funds_pool'] = $funds_pool;

        // 资金总额
        $data['totalfunds'] = $funds_pool['totalfunds'];

        // 资金余额
        $data['balancefunds'] = $funds_pool['balancefunds'];

        // 资金可用余额
        $data['availablefunds'] = $funds_pool['availablefunds'];

        // 资金总额
        $data['totalfunds'] = $funds_pool['totalfunds'];
        // 冻结资金
        $data['freezefunds'] = $funds_pool['freezefunds'];
        // 初始冻结资金
        $data['initfreezefunds'] = $funds_pool['initfreezefunds'];
        // ...其他代码段
        G('end');
        // 进行统计区间
        echo G('begin','end').'s';
        //dump($data);
        return $data;
    }


// 	/**
// 	 * 获取用户全部产品的统计
// 	 *
// 	 * @param array $type 统计的类型
// 	 * @return var 如果查询成功则返回对象信息，如果失败则返回false
// 	 */
// 	function getIndexStatistics( $type ){
// 		$me = $this -> getloginUserInfo();

// 		$role_info 		= $me['role_info'];
// 		$depart_info 	= $me['depart_info'];

// 		switch (  $role_info ['rolecode']  ) {
// 			case 'admin':
// 			case 'operation_manager':
// 			case 'operation':
// 				$userids = 'all';
// 				break;
// 			case 'sub':// 子用户
// 				$userids[] = $me['id'];
// 			case 'agent':// 一级代理
// 				unset($userids);
// 				$model_user = D('User/User');
// 				// 获取全部子用户以及二级代理下面的子用户
// 				$sub_suers = $model_user -> getSubUserForAgent();

// 				foreach ($sub_suers as $vo_u1) {
// 					$userids[] = $vo_u1['id'];
// 				}

// 				if( $me['isopen_subagent'] == 1 ){
// 					$sub_suerss = $model_user -> getSubUserForAgent2();
// 					foreach ($sub_suerss as $vo_u2) {
// 						$userids[] = $vo_u2['id'];
// 					}
// 				}
// 				// 获取子代理下面的全部自用或

// 				break;
// 			case 'agent2':// 二级代理

// 				break;
// 			default:
// 				$model_user = D('User/User');

// 				$staffids[] =  $me['id'];
// 				// 如果是一级角色，获取该用户的全部子用户
// 				if(  $role_info ['rolelevel']  = 1 ){
// 					// 获取全部的子用户
// 					$map_staff['pid'] 	= $me['id'];
// 					$map_staff['status'] = 1;

// 					$staffs = $model_user -> queryRecordAll( $map_staff );

// 					foreach ($staffs as $vo_staff){
// 						$staffids[]= $vo_staff['id'];
// 					}
// 				}

// 				switch ( $depart_info['departname']) {
// 					case '销售部':// 销售
// 						$map_user['seller_id'] 	= array('IN' , $staffids);
// 						$map_user['status'] 	= 1;
// 						$users = $model_user -> queryRecordAll( $map_user );
// 						foreach ($users as $vo ){
// 							if( $vo['usertype'] == 'agent'){
// 								$map_user1['pid'] 	=  $vo['id'];
// 								$map_user1['status'] = 1;
// 								$users1 = $model_user -> queryRecordAll( $map_user1 );
// 								foreach ($users1 as $vo_user1 ){
// 									$userids[] = $vo_user1['id'];
// 								}
// 							}else {
// 								$userids[] = $vo['id'];
// 							}
// 						}
// 						$userids = array_unique( $userids );
// 						if( $userids ){
// 							$map['createuserid'] 	= array( 'IN', $userids );
// 							$map['status'] 			= 1;
// 						}
// 						break;

// 					default:
// 						;
// 						break;
// 				}

// 				break;
// 		}

// 		if( $type != 'home'){
// 			// 获取站点的数量
// 			$site_num = $this -> getSiteNum( $userids );
// 			$data['siteNum'] 				= $site_num;

// 			// 获取最新达标关键词消费
// 			$standardsFee = $this -> getTodayFee( $userids );
// 			$data['standardsFee'] 			= $standardsFee;

// 			// 获取本月消费
// 			$consumption_month = $this -> getAllConsumptionMonth( $userids );
// 			$data['consumption_month'] = $consumption_month;

// 			// 获取累计消费
// 			$consumptionfunds = $this -> getAllConsumption( $userids );
// 			$data['consumptionfunds'] = $consumptionfunds;


// 			// 获取关键词达标率
// 			$data['compliance_rate'] = round( $standard_kw_num / $purchased_kw_num ,2) * 100 .'%';

// 			// 获取上个月的消费记录
// 			$consumerdetails_last = $this -> getConsdetailsForLastMonth( $userids );

// 			foreach ($consumerdetails_last as $vo){
// 				$days[]	 				= $vo['day'];
// 				$cons_last_month[] 		= $vo['consumption'];
// 			}
// 			$data['days'] = json_encode($days) ;
// 			$data['consumptions_last_month'] = json_encode($cons_last_month) ;

// 			// 获取本月的消费统计
// 			$consumerdetails_this = $this -> getConsdetailsForThisMonth( $userids );
// 			foreach ($consumerdetails_this as $vo){
// 				$cons_this_month[] =$vo['consumption'];
// 			}
// 			$data['consumptions_this_month'] = json_encode($cons_this_month) ;

// 			// 获取上个月的消费记录
// 			$standardNumsLast = $this -> getStandardNumForLastMonth( $userids );
// 			foreach ($standardNumsLast as $vo){
// 				$standard_num_last_month[] 	= $vo['num'];
// 				$standard_rate_last_month[] = $vo['rate'];
// 			}
// 			$data['standard_num_last_month'] = json_encode($standard_num_last_month) ;
// 			$data['standard_rate_last_month'] = json_encode($standard_rate_last_month) ;

// 			// 获取上个月的消费记录
// 			$standardNumsThis = $this -> getStandardNumForThisMonth( $userids );
// 			foreach ($standardNumsThis as $vo){
// 				$standard_num_this_month[] 	= $vo['num'];
// 				$standard_rate_this_month[] = $vo['rate'];
// 			}
// 			$data['standard_num_this_month'] = json_encode($standard_num_this_month) ;
// 			$data['standard_rate_this_month'] = json_encode($standard_rate_this_month) ;

// 			// 如果是子用户需要统计最近10天的消费记录
// 			if( $role_info ['rolecode']  == 'sub'){

// 				$consumerdetails_10days = $this -> getConsdetailsForLast10Days( $userids );

// 				foreach ($consumerdetails_10days as $vo){
// 					$consumerdetails[] 	= $vo['consumption'];
// 					$date[] = substr($vo['date'],5);
// 				}
// 				$data['consumptions_ten_days'] = json_encode($consumerdetails) ;
// 				$data['date'] = json_encode($date) ;
// 			}
// 		}


// 		// 获取优化中关键词总数量
// 			$purchased_kw_num = $this -> getPurchasedKeywordNum( $userids );
// 			$data['purchasedKeywordNum']	= $purchased_kw_num;
// 			// 获取最新达标关键词数量
// 			$standard_kw_num = $this -> getStandardKeywordNum( $userids );
// 			$data['stankeywordNum'] 		= $standard_kw_num;

// 		// 获取用户的资金池统计信息
// 		$funds_pool = $this -> getFundsPool( $userids );

// 		$data['funds_pool'] = $funds_pool;

// 		// 资金总额
// 		$data['totalfunds'] = $funds_pool['totalfunds'];

// 		// 资金余额
// 		$data['balancefunds'] = $funds_pool['balancefunds'];

// 		// 资金可用余额
// 		$data['availablefunds'] = $funds_pool['availablefunds'];

// 		// 资金总额
// 		$data['totalfunds'] = $funds_pool['totalfunds'];
// 		// 冻结资金
// 		$data['freezefunds'] = $funds_pool['freezefunds'];
// 		// 初始冻结资金
// 		$data['initfreezefunds'] = $funds_pool['initfreezefunds'];


// 		//dump($data);
// 		return $data;
// 	}


    /**
     * 获取会员数量
     *
     * 获取会员数量：一般是为代理商用户来获取他的子代理和子用户的数量
     */
    function getMembers( $userids ){

        // 初始化用户模型
        $user_model = D ( 'User/User' );

        $me = $this -> me ;
        // 获取用户的类型
        $usertype 	= $me['usertype'];
        // 获取用户的分组
        $usergroup 	= $me['usergroup'];
        // 获取用户id
        $userid 	= $me['id'];

        switch ( $usertype ) {
            case 'agent':// 代理商：获取全部的子用户和子代理
                $map['pid'] 			= $userid;
                $map['usertype'] 		= 'sub';
                $subuser_num 			= $user_model -> where($map) -> count();
                $member['usertype'] 	= 'sub';
                $member['usertype_desc'] = '子用户';
                $member['num'] 			= $subuser_num;
                $members[] = $member;
                // 如果当前的代理商是开启了二级代理
                if( $me['isopen_subagent'] ){
                    $map['usertype'] 		= 'agent2';
                    $subagent_num 			= $user_model -> where( $map ) -> count();
                    $member['usertype'] 	= 'agent2';
                    $member['usertype_desc'] = '子代理';
                    $member['num'] 			= $subagent_num;
                    $members[] = $member;
                }

                break;
            case 'agent2':// 子代理商：获取全部的子用户

                break;
            case 'sales_manager':// 销售经理：获取自己的客户或者员工的客户
            case 'customer_manager':// 客服经理：获取自己的客户或者员工的客户
            case 'seller':// 销售经理：获取自己的客户
            case 'customer':// 客服：获取自己的客户
                // 如果当前的代理商是开启了二级代理
                if( $me['isopen_subagent'] ){
                    if( $userids ){
                        $map['id'] 			= array('IN', $userids );
                        $map['usertype'] 		= 'agent2';
                        $subagent_num 			= $user_model -> where( $map ) -> count();
                        $member['usertype'] 	= 'agent2';
                        $member['usertype_desc'] = '子代理';
                        $member['num'] 			= $subagent_num;
                        $members[] = $member;
                    }
                }
                if( $userids ){
                    $map['usertype'] 		= 'sub';
                    $subuser_num 			= $user_model -> where($map) -> count();
                    $member['usertype'] 	= 'sub';
                    $member['usertype_desc'] = '子用户';
                    $member['num'] 			= $subuser_num;
                    $members[] = $member;
                }
                break;
            default:
                ;
                break;
        }

        //dump($members);exit;
        return $members;

    }
    /**
     * 根据用户角色获取该角色可见的数据
     */
    function getSiteNum( $userids ){
        //站点模型
        $model = D('Biz/Site');
        if( $userids ){
            if( $userids != 'all'){
                $map['createuserid'] 	= array( 'IN', $userids );
            }
            $map['status'] 			= 1;
            //如果是分运维登录只显示自己
            $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
            $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
            if($usertype == 'operation'){
                $map['site_manage'] = $username;
            }
            return $num = $model -> where( $map ) -> count();
        }
    }


    /**
     * 获取已购买关键词数量
     *
     * 优站宝:获取已经购买的关键词的数量
     * 快排宝：获取已经导入的关键词的数量
     * ...
     * ...
     */
    function getPurchasedKeywordNum( $userids , $productid = 1){

        switch ($productid) {
            case 1:
                // 关键词模型
                $model = D('Biz/Keyword');
                if( $userids ){
                    if( $userids != 'all'){
                        $map['createuserid'] 	= array( 'IN', $userids );
                    }
                    // $map['keywordstatus'] 	= array ( array('EQ','优化中'), array('EQ','合作停') ,'OR' );
                    $map['keywordstatus'] 	=  '优化中';
                    $map['status'] 			= 1;

                    //如果是分运维登录只显示自己
                    $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
                    $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
                    if($usertype == 'operation'){
                        $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
                        $ids = array_map('current', $ids);
                        $ids = implode(',',$ids);
                        if($ids != ''){
                            $map['siteid']  = array('in',$ids);
                        }else{
                            $map['status'] 			= 999;
                        }
                    }

                    $num = $model -> where( $map ) -> count();;
                    //dump($model -> _sql());
                    return $num;
                }
                break;
            case 2:
                // 关键词模型
                $model = D('QR/QRKeyword');
                if( $userids ){
                    if( $userids != 'all'){
                        $map['createuserid'] 	= array( 'IN', $userids );
                    }
                    // $map['keywordstatus'] 	= array ( array('EQ','优化中'), array('EQ','合作停') ,'OR' );
                    $map['keywordstatus'] 	=  '优化中';
                    $map['status'] 			= 1;
                    $num = $model -> where( $map ) -> count();;
                    //dump($model -> _sql());
                    return $num;
                }
                break;
            default:
                # code...
                break;
        }
    }


    /**
     * 达标关键词数量
     */
    function getStandardKeywordNum( $userids , $productid){
        // 关键词模型
        $model = D('Biz/Keyword');
        /*if( $userids ){
            if( $userids != 'all'){
                $map['createuserid'] 	= array( 'IN', $userids );
            }
            $map['standarddate'] 	= array('LIKE',date('Y-m-d') .'%');
            $map['standardstatus'] 	= '已达标';
            $map['status'] 			= 1;
            $num = $model -> where( $map ) -> count();;
            dump($model -> _sql());
            return $num;
        }*/


        // 达标消费模型
        $model = D('Biz/Standardfee');

        if( $userids ){
            if( $userids != 'all'){
                $map['ownuserid'] 	= array( 'IN', $userids );
            }
            if( $productid ){
                $map['productid'] 			= $productid;
            }
            $map['standarddate'] = array('LIKE',date('Y-m-d') .'%');
            $map['status'] 			= 1;
            //如果是分运维登录只显示自己
            $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
            $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
            if($usertype == 'operation'){
                $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
                $ids = array_map('current', $ids);
                $ids = implode(',',$ids);
                if($ids != ''){
                    $map['siteid']  = array('in',$ids);
                }else{
                    $map['status'] 			= 999;
                }
            }
            $num = $model -> where( $map ) -> count();;
            //dump($model -> _sql());
            return $num;
        }
    }

    /**
     * 获取今日的消费总额
     */
    function getTodayFee( $userids, $productid ){

        //站点模型
        $model = D('Biz/Standardfee');
        if( $userids ){
            if( $userids != 'all'){
                $map['ownuserid'] 	= array( 'IN', $userids );
            }
            $map['standarddate'] 	= array('LIKE',date('Y-m-d') .'%');
            if( $productid  ){
                $map['productid'] = $productid ;
            }
            $map['status'] 			= 1;
            //如果是分运维登录只显示自己
            $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
            $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
            if($usertype == 'operation'){
                $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
                $ids = array_map('current', $ids);
                $ids = implode(',',$ids);
                if($ids != ''){
                    $map['siteid']  = array('in',$ids);
                }else{
                    $map['status'] 			= 999;
                }
            }
            $price = $model -> where($map) -> sum( 'price ');
            //dump($model -> _sql());
            return $price;
        }

        return false;
    }


    /**
     * 资金池管理
     *
     * 获取当前资金池的总金额，已经消费金额 资金池金额充值总金额、消费金额、剩余金额
     */
    function getFundsPool( $userids, $productid ){

        // 资金账户模型
        $model_funds 		= D('Biz/Funds');
        $model_standardfee 	= D('Biz/Standardfee');
        $model_product 		= D('Sys/Product');
        if( $userids ){
            if( $userids != 'all'){
                $map['userid'] 	= array( 'IN', $userids );
            }
            $map['usertype'] = 'sub';
            //$map['createtime'] 	= array('LIKE',date('Y-m-d') .'%');
            $map['status'] 			= 1;

            if( $productid ){

                $map['productid'] = $productid;
                $list = $model_funds -> queryRecordAll($map,'id,userid,usertype,productid,totalfunds,balancefunds,availablefunds,initfreezefunds,freezefunds');

                foreach ( $list  as $vo_funds) {

                    // 总金额
                    $totalfunds 		+= $vo_funds['totalfunds'];
                    // 资金余额
                    $balancefunds		+= $vo_funds['balancefunds'];
                    // 可用余额
                    $availablefunds	 	+= $vo_funds['availablefunds'];
                    // 冻结金额
                    $freezefunds 		+= $vo_funds['freezefunds'];
                    // 冻结初始金额
                    $initfreezefunds 	+= $vo_funds['initfreezefunds'];
                }

                $funds['totalfunds'] 		= $totalfunds;
                $funds['balancefunds'] 		= $balancefunds;
                if( $availablefunds < 0 ){
                    $availablefunds = 0;
                }
                $funds['availablefunds']	= $availablefunds;
                $funds['freezefunds'] 		= $freezefunds;
                $funds['initfreezefunds'] 	= $initfreezefunds;
                $funds['total_consumption'] = $totalfunds - $balancefunds;
                return $funds;


            }else{
                $list = $model_funds -> queryRecordAll($map,'id,userid,usertype,productid,totalfunds,balancefunds,availablefunds,initfreezefunds,freezefunds');

                foreach ( $list  as $vo_funds) {
                    $productids[] = $vo_funds['productid'];
                }
                $productids = array_unique( $productids );
                foreach ($productids as $vo_productid) {
                    $map_product['id'] = $vo_productid;
                    $products[] =$model_product -> selectOne( $map_product );
                }

                foreach ($products as &$vo_product) {
                    unset($fundss);
                    // 总金额
                    $totalfunds 	= 0;
                    // 资金余额
                    $balancefunds	=  0;
                    // 可用余额
                    $availablefunds =   0;
                    // 冻结金额
                    $freezefunds 	=   0;
                    // 冻结初始金额
                    $initfreezefunds 	=  0;
                    foreach ( $list  as $vo_funds) {
                        if($vo_product['id'] == $vo_funds['productid']){
                            $fundss[] = $vo_funds;
                            // 总金额
                            $totalfunds 		+= $vo_funds['totalfunds'];
                            // 资金余额
                            $balancefunds		+= $vo_funds['balancefunds'];
                            // 可用余额
                            $availablefunds	 	+= $vo_funds['availablefunds'];
                            // 冻结金额
                            $freezefunds 		+= $vo_funds['freezefunds'];
                            // 冻结初始金额
                            $initfreezefunds 	+= $vo_funds['initfreezefunds'];
                        }
                    }

                    $vo_product['funds_list'] = $fundss;
                    $vo_product['totalfunds'] = $totalfunds;
                    $vo_product['balancefunds'] = $balancefunds;
                    if( $availablefunds < 0 ){
                        $availablefunds = 0;
                    }
                    $vo_product['availablefunds'] = $availablefunds;
                    $vo_product['freezefunds'] = $freezefunds;
                    $vo_product['initfreezefunds'] = $initfreezefunds;
                    $vo_product['total_consumption'] = $totalfunds - $balancefunds;
                }
            }
        }

        return $products;
    }

    /**
     * 获取所有关键词的本月消费
     */
    function getAllConsumptionMonth ( $userids ){
        $model_standardfee 	= D('Biz/Standardfee');
        if( $userids ){
            if( $userids != 'all'){
                $map['ownuserid'] 	= array( 'IN', $userids );
            }
            $begin_date=date('Y-m-01', strtotime(date("Y-m-d")));
            $end_date =  date('Y-m-d', strtotime("$begin_date +1 month"));

            $map['standarddate'] = array( array('EGT',$begin_date),array('LT',$end_date),'AND');
            $map['status'] 			= 1;
            //如果是分运维登录只显示自己
            $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
            $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
            if($usertype == 'operation'){
                $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
                $ids = array_map('current', $ids);
                $ids = implode(',',$ids);
                if($ids != ''){
                    $map['siteid']  = array('in',$ids);
                }else{
                    $map['status'] 			= 999;
                }
            }
            $price = $model_standardfee -> where($map) -> sum( 'price ');

        }

        return $price;
    }

    /**
     * 获取所总消费
     */
    function getAllConsumption( $userids ){

        $model_standardfee 	= D('Biz/Standardfee');
        if( $userids ){
            if( $userids != 'all'){
                $map['ownuserid'] 	= array( 'IN', $userids );
            }
            $map['status'] 			= 1;
            //如果是分运维登录只显示自己
            $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
            $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
            if($usertype == 'operation'){
                $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
                $ids = array_map('current', $ids);
                $ids = implode(',',$ids);
                if($ids != ''){
                    $map['siteid']  = array('in',$ids);
                }else{
                    $map['status'] 			= 999;
                }
            }
            $price = $model_standardfee -> where($map) -> sum( 'price ');
        }


        return $price;
    }



    /**
     * 获取所有关键词的上月消费
     */
    function getStandardNumForLastMonth( $userids ){
        $model_standardfee 	= D('Biz/Standardfee');
        $model_detect = D('Biz/Keyworddetectrecord');;

        $begin_date = date('Y-m-01', strtotime('-1 month'));
        $end_date 	=  date('Y-m-t', strtotime('-1 month'));
        // 获取本月第一天
        $BeginDate=date('Y-m-01', strtotime(date("Y-m-d")));
        // 获取上月最后一天
        $end_date = date('Y-m-d',strtotime('-1 day',strtotime($BeginDate)));  //2016-01-31
        $begin_date = date('Y-m-01', strtotime($end_date));
// 		// 计算时间的差值
// 		$diff = (strtotime( $end_date  ) - strtotime( $begin_date  ) )/86400;

// 		for($i = 0 ;$i<= $diff;$i++){
// 			$days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
// 		}

        // 如果userids存在
        if( $userids ){
            $map['status'] 			= 1;

            // 查询产品
            if( $productid ){
                $map['productid'] = $productid;
            }

            // 查询用户
            if( $userids != 'all'){
                $map['ownuserid'] 	= array( 'IN', $userids );
            }
            // 查询时间范围
            $map['standarddate'] = array ( array ('EGT',$begin_date ), array ('LT',date("Y-m-d",strtotime("$end_date   +1   day")) ),'AND');

            //如果是分运维登录只显示自己
            $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
            $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
            if($usertype == 'operation'){
                $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
                $ids = array_map('current', $ids);
                $ids = implode(',',$ids);
                if($ids != ''){
                    $map['siteid']  = array('in',$ids);
                }else{
                    $map['status'] 			= 999;
                }
            }
            // 批量统计查询
            $rss1 = $model_standardfee -> where( $map ) -> field('left(standarddate,10) as date,count( DISTINCT  `id` ) as count ') ->  group( 'left(standarddate,10)' ) -> select() ;

            $rss2 = $model_detect -> where( $map ) -> field('left(createtime,10) as date,count( DISTINCT  `id` ) as count ') ->  group( 'left(createtime,10)' ) -> select() ;

            foreach ($rss1 as &$vo1 ){
                $rs['date'] = $vo1['date'];
                $rs['day'] 	= intval( substr($vo1['date'],8) );
                $rs['num'] 	= intval( $vo1['count'] );

                foreach ($rss2 as &$vo2 ){
                    if( $vo1['date'] == $vo2['date']){
                        $rs['num_detect'] 	= $vo2['count'];
                        $rs['rate'] 		= round( $vo1['count'] / $vo2['count'] ,2) * 100;
                    }
                }

                $rss[] = $rs;
            }
        }



        if( $rss ){
            if( $rss[0]['date'] != $begin_date){
                $diff = (strtotime( $rss[0]['date']  ) - strtotime( $begin_date  ) )/86400;
                for($i = $diff-1 ;$i>= 0;$i--){
                    $days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
                    $rs_temp['date'] = date('Y-m-d',strtotime("$begin_date +$i days"));
                    $rs_temp['num'] = 0;
                    $rs_temp['num_detect'] = 0;
                    $rs_temp['rate'] = 0;
                    array_unshift($rss,$rs_temp);
                }
            }
        }


        // 如果未获取到结果
        if( !$rss){
            // 计算时间的差值
            $diff = (strtotime( $end_date  ) - strtotime( $begin_date  ) )/86400;

            for($i = 0 ;$i<= $diff;$i++){
                $days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
            }

            foreach ($days as $vo ){

                $rs['date'] = $vo;
                $rs['num'] = 0;
                $rs['num_detect'] = 0;
                $rs['rate'] = 0;
                $rss[] = $rs;
            }
        }
        /*$last_date = $rss[count($rss) - 1]['date'];
        if( substr($last_date,8) == 30 ){
            $last_rs['date'] 	= date('Y-m-d',strtotime("$last_date +1 days"));
            $last_rs['num'] 	=0;
            $last_rs['num_detect'] = 0;
            $last_rs['rate'] = 0;
            array_push($rss,$last_rs);
        }*/
        foreach ($rss as &$vo ){
            $vo['day'] =  intval( substr($vo['date'],8));
        }


        return $rss;
    }



    /**
     * 获取本月的达标任务数量统计
     *
     * SELECT COUNT(DISTINCT id) user_count, sum('price'),left(createtime,10) AS days FROM ts_standardfee GROUP BY days
     */
    function getStandardNumForThisMonth( $userids ){

        $model_standardfee 	= D('Biz/Standardfee');
        $model_detect = D('Biz/Keyworddetectrecord');

        $begin_date = date('Y-m-01');
        $end_date 	= date('Y-m-d');

        // 如果userids存在
        if( $userids ){
            $map['status'] 			= 1;

            // 查询产品
            if( $productid ){
                $map['productid'] = $productid;
            }

            // 查询用户
            if( $userids != 'all'){
                $map['ownuserid'] 	= array( 'IN', $userids );
            }
            //如果是分运维登录只显示自己
            $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
            $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
            if($usertype == 'operation'){
                $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
                $ids = array_map('current', $ids);
                $ids = implode(',',$ids);
                if($ids != ''){
                    $map['siteid']  = array('in',$ids);
                    $masp['siteid']  = array('in',$ids);
                }else{
                    $map['status'] 			= 999;
                }
            }
            // 查询时间范围
            $map['standarddate'] = array ( array ('EGT',$begin_date ), array ('LT',date("Y-m-d",strtotime("$end_date   +1   day")) ),'AND');
            // 查询达标的关键词
            $rss1 = $model_standardfee -> where( $map ) -> field('left(standarddate,10) as date,count( DISTINCT  `id` ) as count ') ->  group( 'left(standarddate,10)' ) -> select() ;

            // 查询时间范围
            $map['createtime'] = array ( array ('EGT',$begin_date ), array ('LT',date("Y-m-d",strtotime("$end_date   +1   day")) ),'AND');

            // 查询全部的关键词
            $rss2 = $model_detect -> where( $map ) -> field('left(createtime,10) as date,count( DISTINCT  `id` ) as count ') ->  group( 'left(createtime,10)' ) -> select() ;

            if( $_GET['test']){
                dump($model_detect -> _sql());
            }

            /* dump($model_detect -> _sql());
            // 查询达标的关键词
            $map['rank'] = array(array('EGT',1),array('ELT',10),'AND');
            $rss2 = $model_detect -> where( $map ) -> field('left(createtime,10) as date,count( DISTINCT  `id` ) as count ') ->  group( 'left(createtime,10)' ) -> select() ;
            dump($model_detect -> _sql());
            dump($rss1);
            dump($rss2);
            exit; */

            foreach ($rss1 as &$vo1 ){
                $rs['date'] = $vo1['date'];
                $rs['day'] 	= intval( substr($vo1['date'],8) );
                $rs['num'] 	= intval( $vo1['count'] );

                foreach ($rss2 as &$vo2 ){
                    if( $vo1['date'] == $vo2['date']){
                        $rs['num_detect'] 	= $vo2['count'];
                        $rs['rate'] 		= round( $vo1['count'] / $vo2['count'] ,2) * 100;
                    }
                }

                $rss[] = $rs;
            }
        }


        if( $_GET['test']){
            dump($rss);exit;
        }

        // 如果未获取到结果
        if( !$rss){
            // 计算时间的差值
            $diff = (strtotime( $end_date  ) - strtotime( $begin_date  ) )/86400;

            for($i = 0 ;$i<= $diff;$i++){
                $days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
            }

            foreach ($days as $vo ){

                $rs['date'] = $vo;
                $rs['num'] = 0;
                $rs['num_detect'] = 0;
                $rs['rate'] = 0;
                $rss[] = $rs;
            }
        }
        /*$last_date = $rss[count($rss) - 1]['date'];
        if( substr($last_date,8) == 30 ){
            $last_rs['date'] 	= date('Y-m-d',strtotime("$last_date +1 days"));
            $last_rs['num'] 	=0;
            $last_rs['num_detect'] = 0;
            $last_rs['rate'] = 0;
            array_push($rss,$last_rs);
        }*/
        foreach ($rss as &$vo ){
            $vo['day'] =  intval( substr($vo['date'],8));
        }
        return $rss;
    }


    /**
     * 获取子用户最近10天的消费记录
     *
     * 不包含今天的消耗
     */
    function getConsdetailsForLast10Days( $userids, $productid ){

        $model_standardfee 	= D('Biz/Standardfee');
        // 如果当前的时间是下午
        //设置【日期/时间】 默认时区
        date_default_timezone_set('Asia/Shanghai');

        //获取当前小时
        /* $hour=date("G");

        if( $hour > 12 ){
        for($i=10;$i>=0;$i--){
        $days[]=date('Y-m-d',strtotime("-{$i} days"));
        }
        }else{
        for($i=11;$i>0;$i--){
        $days[]=date('Y-m-d',strtotime("-{$i} days"));
        }
        } */
        for($i=10;$i>=0;$i--){
            $days[]=date('Y-m-d',strtotime("-{$i} days"));
        }


        //获取优化中的关键词，以及合作停的关键词
        // $map['_string'] = "(keywordstatus = '优化中' ) OR (keywordstatus = '合作停' AND cooperationstopdate > $days[0] )";

        // 如果userids存在
        if( $userids ){

            $map['status'] 			= 1;
            if( $productid ){
                $map['productid'] = $productid;
            }
            if( $userids != 'all'){
                $map['ownuserid'] 	= array( 'IN', $userids );
            }

            foreach ( $days as $vo ){
                $consumption = 0;
                $map['standarddate'] = array( 'LIKE', $vo .'%');

                $consumption = $model_standardfee -> where( $map ) -> sum( 'price' );
                if( !$consumption ){
                    $consumption = 0;
                }

                $rs['date'] = $vo;
                $rs['day'] =  intval( substr($vo,8));
                $rs['consumption'] = intval( $consumption );
                $rss[] = $rs;
            }
        }

        return $rss;
    }

    /**
     * 获取所有关键词的上月消费
     *
     * SELECT COUNT(DISTINCT id) user_count, sum('price'),left(createtime,10) AS days FROM ts_standardfee GROUP BY days
     *
     * SELECT SUM(`price`),left(createtime,10) FROM `ts_standardfee` group by  left(createtime,10)
     */
    function getConsdetailsForLastMonth( $userids , $productid ){

        $model_standardfee 	= D('Biz/Standardfee');

        $begin_date = date('Y-m-01', strtotime('-1 month'));
        $end_date 	=  date('Y-m-t', strtotime('-1 month'));
        // 获取本月第一天
        $BeginDate=date('Y-m-01', strtotime(date("Y-m-d")));
        // 获取上月最后一天
        $end_date = date('Y-m-d',strtotime('-1 day',strtotime($BeginDate)));  //2016-01-31
        $begin_date = date('Y-m-01', strtotime($end_date));
        // 如果userids存在
        if( $userids ){

            $map['status'] 			= 1;

            // 查询产品
            if( $productid ){
                $map['productid'] = $productid;
            }

            // 查询用户
            if( $userids != 'all'){
                $map['ownuserid'] 	= array( 'IN', $userids );
            }
            // 查询时间范围
            $map['standarddate'] = array ( array ('EGT',$begin_date ), array ('LT',date("Y-m-d",strtotime("$end_date   +1   day")) ),'AND');

            //如果是分运维登录只显示自己
            $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
            $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
            if($usertype == 'operation'){
                $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
                $ids = array_map('current', $ids);
                $ids = implode(',',$ids);
                if($ids != ''){
                    $map['siteid']  = array('in',$ids);
                }else{
                    $map['status'] 			= 999;
                }
            }

            // 批量统计查询
            $rss = $model_standardfee -> where( $map ) -> field('left(standarddate,10) as date,sum( `price` ) as consumption ') ->  group( 'left(standarddate,10)' ) -> select() ;

// 			foreach ( $days as $vo ){
// 				$consumption = 0;
// 				$map['createtime'] = array( 'LIKE', $vo .'%');

// 				if( $userids != 'all'){
// 					$map['ownuserid'] 	= array( 'IN', $userids );
// 				}
// 				$consumption = $model_standardfee -> where( $map ) -> sum( 'price' );
// 				dump($model_standardfee -> _sql());

// 				if( !$consumption ){
// 					$consumption = 0;
// 				}
// 				$rs['date'] = $vo;
// 				$rs['day'] =  intval( substr($vo,8));
// 				$rs['consumption'] = intval( $consumption );
// 				$rss[] = $rs;
// 			}
        }

        if( $rss ){
            if( $rss[0]['date'] != $begin_date){
                $diff = (strtotime( $rss[0]['date']  ) - strtotime( $begin_date  ) )/86400;
                for($i = $diff-1 ;$i>= 0;$i--){
                    $days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
                    $rs_temp['date'] = date('Y-m-d',strtotime("$begin_date +$i days"));
                    $rs_temp['consumption'] = 0;
                    array_unshift($rss,$rs_temp);
                    $rss_temp[] = $rs_temp;
                }
            }
        }

        // 如果未获取到结果
        if( !$rss){
            // 计算时间的差值
            $diff = (strtotime( $end_date  ) - strtotime( $begin_date  ) )/86400;

            for($i = 0 ;$i<= $diff;$i++){
                $days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
            }

            foreach ($days as $vo ){
                $rs['date'] = $vo;
                $rs['consumption'] = 0;
                $rss[] = $rs;
            }
        }
        /*$last_date = $rss[count($rss) - 1]['date'];
        if( substr($last_date,8) == 30 ){
            $last_rs['date'] 		= date('Y-m-d',strtotime("$last_date +1 days"));
            $last_rs['consumption'] = '-';
            array_push($rss,$last_rs);
        }*/
        foreach ($rss as &$vo ){
            $vo['day'] =  intval( substr($vo['date'],8));
        }

        return $rss;
    }


    /**
     * 获取所有关键词的本月消费
     */
    function getConsdetailsForThisMonth( $userids , $productid){

        $model_standardfee 	= D('Biz/Standardfee');


        $begin_date = date('Y-m-01');
        $end_date 	= date('Y-m-d');

        // 如果userids存在
        if( $userids ){

            $map['status'] 			= 1;

            // 查询产品
            if( $productid ){
                $map['productid'] = $productid;
            }

            // 查询用户
            if( $userids != 'all'){
                $map['ownuserid'] 	= array( 'IN', $userids );
            }
            // 查询时间范围
            $map['standarddate'] = array ( array ('EGT',$begin_date ), array ('LT',date("Y-m-d",strtotime("$end_date   +1   day")) ),'AND');

            //如果是分运维登录只显示自己
            $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
            $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
            if($usertype == 'operation'){
                $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
                $ids = array_map('current', $ids);
                $ids = implode(',',$ids);
                if($ids != ''){
                    $map['siteid']  = array('in',$ids);
                }else{
                    $map['status'] 			= 999;
                }
            }

            // 批量统计查询
            $rss = $model_standardfee -> where( $map ) -> field('left(standarddate,10) as date,sum( `price` ) as consumption ') ->  group( 'left(standarddate,10)' ) -> select() ;

// 			foreach ( $days as $vo ){
// 				$consumption = 0;

// 				$map['createtime'] = array( 'LIKE', $vo .'%');
// 				if( $userids != 'all'){
// 					$map['ownuserid'] 	= array( 'IN', $userids );
// 				}
// 				$consumption = $model_standardfee -> where( $map ) -> sum( 'price' );

// 				if( !$consumption ){
// 					$consumption = 0;
// 				}
// 				$rs['date'] = $vo;
// 				$rs['day'] = intval( substr($vo,8) );
// 				$rs['consumption'] = intval( $consumption );
// 				$rss[] = $rs;
// 			}
        }


        // 如果未获取到结果
        if( !$rss){
            // 计算时间的差值
            $diff = (strtotime( $end_date  ) - strtotime( $begin_date  ) )/86400;

            for($i = 0 ;$i<= $diff;$i++){
                $days[]= date('Y-m-d',strtotime("$begin_date +$i days"));
            }

            foreach ($days as $vo ){
                $rs['date'] = $vo;
                $rs['consumption'] = 0;
                $rss[] = $rs;
            }
        }
        /*$last_date = $rss[count($rss) - 1]['date'];
        if( substr($last_date,8) == 30 ){
            $last_rs['date'] 		= date('Y-m-d',strtotime("$last_date +1 days"));
            $last_rs['consumption'] = '-';
            array_push($rss,$last_rs);
        }*/

        foreach ($rss as &$vo ){
            $vo['day'] =  intval( substr($vo['date'],8));
        }

        return $rss;
    }

    /**
     * 获取所有产品今日消费
     *
     * 根据用户的类型来判断
     */
    function getConsumptionToday( $userids, $productid ){

        // 达标消费模型
        $model = D('Biz/Standardfee');

        if( $userids ){
            if( $userids != 'all'){
                $map['ownuserid'] 	= array( 'IN', $userids );
            }

            $map['productid'] = $productid;
            $map['standarddate'] 	= array('LIKE',date('Y-m-d') .'%');
            $map['status'] 		= 1;
            //如果是分运维登录只显示自己
            $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
            $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
            if($usertype == 'operation'){
                $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
                $ids = array_map('current', $ids);
                $ids = implode(',',$ids);
                if($ids != ''){
                    $map['siteid']  = array('in',$ids);
                }else{
                    $map['status'] 			= 999;
                }
            }
            $price = $model -> where($map) -> sum( 'price ');

        }

        return $price;

    }


    /**
     * 获取某个产品的所有消费
     *
     * 根据用户的类型来判断
     */
    function getConsumption( $userids, $productid ){

        // 达标消费模型
        $model = D('Biz/Standardfee');


        if( $userids ){
            if( $userids != 'all'){
                $map['ownuserid'] 	= array( 'IN', $userids );
            }
            $map['productid'] 	= $productid;
            $map['status'] 			= 1;
            $price = $model -> where($map) -> sum( 'price ');
        }

        return $price;

    }

    /**
     * 获取快排宝的计划数量
     */
    function getPlanNum( $userids ){

        // 达标消费模型
        $model = D('QR/QRPlan');

        if( $userids ){
            if( $userids != 'all'){
                $map['createuserid'] 	= array( 'IN', $userids );
            }
            $map['status'] 			= 1;
            $count = $model -> where($map) -> count( );
        }

        return $count;

    }

    /**
     * 获取系统中目前消耗只能维持一周的用户
     *
     * 获取系统中目前消耗只能维持一周的用户，并写入消息通知中提醒用户
     * 并
     */
    function getLessConsumption(){

        // 资金池模型
        $model_funds = D('Biz/Funds');
        // 达标消耗模型
        $model_standardfee = D('Biz/Standardfee');

        /*
            $sql ="SELECT ts_funds,ts_standardfee.id, FROM ts_standardfee LEFT JOIN ts_funds ON ts_standardfee.ownuserid = ts_funds.userid WHERE ts_keyword.status=1 AND ts_standardfee.status=1 AND ts_funds.status = 1 AND usertype = 'sub' AND balancefunds < 7 * ts_standardfee.price";
            $list = M() -> query($sql);

            dump($list);
            dump(M() ->  _sql());

            exit; */
        // 获取全部子用户的资金池 ，目前只获取优站宝
        $map_funds['usertype'] 	= 'sub';
        $map_funds['status'] 	= 1;
        $map_funds['balancefunds'] = array('LT',2000);
        $funds_list = $model_funds -> queryRecordAll ( $map_funds, 'userid,totalfunds,balancefunds,availablefunds,productid');

        foreach ($funds_list as $vo ){
            // 获取每个用户昨天的消耗
            $map_standardfee['status'] 		= 1;
            $map_standardfee['ownuserid'] 	= $vo['userid'];
            $map_standardfee['standarddate'] 	= array('LIKE' , date("Y-m-d",strtotime("-1 day")) .'%');
            $standardfee = $model_standardfee -> where( $map_standardfee ) -> sum( 'price' );
            if( $standardfee > 0 && $vo['balancefunds'] < 7 * $standardfee){
                $userids[] = $vo['userid'];
            }
        }

        if( $userids ){
            $map['id'] = array('IN',$userids);
            $users = D('User/User') -> where($map) -> field('username') ->  select();
            $_SESSION['users_less'] = $users;
            $_SESSION['userids_less'] = $userids;
            //dump($_SESSION['users_less']);exit;
        }
        return $users;
    }

    /**
     * 获取所有关键词的每个月的费用费
     *
     * SELECT COUNT(DISTINCT id) user_count, sum('price'),left(createtime,10) AS days FROM ts_standardfee GROUP BY days
     *
     * SELECT SUM(`price`),left(createtime,10) FROM `ts_standardfee` group by  left(createtime,10)
     */
    function getConsdetailsForMonths( $userids , $productid ){

        $model_standardfee 	= D('Biz/Standardfee');

        // 如果userids存在
        if( $userids ){
            // 查询用户
            if( $userids != 'all'){
                $map['ownuserid'] 	= array( 'IN', $userids );
            }
            $map['status'] 		= 1;

            //如果是分运维登录只显示自己
            $usertype = $_SESSION['MANAGE_SESSION_LoginUserType'];
            $username = $_SESSION['MANAGE_SESSION_LoginUserName'];
            if($usertype == 'operation'){
                $ids = M('Site')->field('id')->where(array('site_manage'=>$username))->select();
                $ids = array_map('current', $ids);
                $ids = implode(',',$ids);
                if($ids != ''){
                    $map['siteid']  = array('in',$ids);
                }else{
                    $map['status'] 			= 999;
                }
            }
            // 获取数据库中最老的数据
            $old = $model_standardfee -> field('standarddate') ->  where( $map ) -> order('standarddate') -> find();
            $first_month = substr( $old['standarddate'],0,7 );



            if( !$first_month ){
                $first_month = substr( date('Y-m-d'),0,7 );
                $months[] 	= $first_month;
            }else{
                $months[] 	= $first_month;
                // 获取月份的差值
                $diff 		= getMonthNum($old['standarddate'], date('Y-m-d'));
                for($i=1;$i<=$diff;$i++){
                    $months[]= date('Y-m',strtotime("+{$i} months",strtotime($first_month)));
                }
            }


            // 循环月份并进行汇总统计
            foreach ($months as $vo ){
                $map['standarddate'] = array('LIKE',$vo.'%');

                $consumption 		= $model_standardfee -> where( $map ) -> sum( 'price' );
                //$consumption 		= $model_standardfee -> where( $map ) -> count( );
                $rs['month'] = $vo;
                $rs['consumption'] 	= $consumption;
                //$rs['num'] 		   	= $consumption;
                $rss[] =$rs;
            }
        }

        return $rss;
    }

    /**
     * 获取系统的全部子用户
     *
     */
    function getSubUsers(){
        $model_user = D('User/User');
        // 从缓存中获取用户
        $sub_user_codeset = S('sub_user_codeset');
        // 从缓存中获取用户的数量
        //$sub_user_num = S('sub_user_num');
        // 如果在缓存中没有用户的信息
        if( !$sub_user_codeset){
            // 全部用户
            $map['usertype'] 	= 'sub';
            $map['status'] 	= 1;
            $users = $model_user -> where( $map ) -> field('id,username') -> select();

            foreach ($users as $vo_user ){
                $sub_user_codeset[$vo_user['id']] =  $vo_user['username'];
            }

            S('sub_user_codeset', $sub_user_codeset, 3600 );
        }else{
            // 如果有用户的信息，需要判断用户的数量是否一致
            $sub_user_num = count( $sub_user_codeset );

            // 全部用户
            $map['usertype'] 	= 'sub';
            $map['status'] 	= 1;
            $count = $model_user -> where( $map ) ->  count();
            if( $sub_user_num != $count){
                $users  = $model_user -> where( $map ) -> field('id,username') -> select();
                foreach ($users as $vo_user ){
                    $sub_user_codeset[$vo_user['id']] =  $vo_user['username'];
                }
                S('sub_user_codeset', $sub_user_codeset, 3600 );
            }
        }
        return $sub_user_codeset;
    }

}

?>