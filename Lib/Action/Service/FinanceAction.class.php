<?php

/**
 * 前台公共控制层类：用户财务控制类
 *
 * @category   业务控制类
 * @copyright   Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @package     Action.Service
 * @version     20170327
 * @link        http://www.mitong.com
 */
class FinanceAction extends BaseAction {
	
	/*
	 * 公共函数，不接受权限检查，写法 array('index');
	 */
	public $public_functions = array();
	
	/**
	 * 初始化函数
	 * 
	 * @return void
	 */
	public function _initialize() {
		//继承
		parent::_initialize();
		
		$this->modelName = "Biz/Finance";
	}
	
	/**
	 * 首页
	 * @accesspublic
	 */
	public function index(){
		
		
		$modelKeyword 		= D( 'Biz/Keyword' );
		$modelStandardfeel = D('Biz/Standardfee');
		
		//获取日报表
		$dailys= $modelStandardfeel -> getDaily();
		$this->assign( 'dailys', $dailys );
		
	
		$this -> display();
	
	}
	
	
	/**
	 * 资金池管理
	 *
	 * 获取当前资金池的总金额，已经消费金额 资金池金额充值总金额、消费金额、剩余金额
	 */
	function pool(){
	
		$model = D( $this->modelName );
	
		$data = $model -> getFundsPoolSub();
		$page['data'] 	= $data;
		$pie['name'] 	= '资金池余额';
		$pie['value'] 	= $data['balancefunds'];
		$pies[] = $pie;
	
		$pie['name'] 	= '资金池可用余额'	;
		$pie['value']	= $data['availablefunds'];
		$pies[] = $pie;
		$pie['name'] 	= '资金池初始冻结金额';
		$pie['value']	= $data['initfreezefunds'];
		$pies[] = $pie;
		$pie['name']	= '资金池剩余冻结金额';
		$pie['value']	= $data['freezefunds'];
		$pies[] = $pie;
		$page['pies'] 	= $pies;
	
		$page['days'] = json_encode($days) ;
		$page['pools'] = json_encode($pies) ; ;
		// 获取用户的分布情况
		//dump($page);
        //获取当前用户流水的记录
        $Dao     = D("user/user");
        $me   = $Dao->getloginUserInfo();
        $me['id'];
        $Dao_funds = D('funds_recharge_record');
        $cont = array('userid'=>$me['id'],'readpriv'=>'1');

        $rs = $Dao_funds->where($cont)->sum('amount');

        if($rs<=0)
        {
            $rs = -$rs;
            $page['data']['consumptionfunds'] = $page['data']['consumptionfunds']  + $rs;
        }
        //获取当前用户的可用余额

        $Dao_funds2 = D('funds');

        $rs2 = $Dao_funds2->query('SELECT * FROM ts_funds WHERE userid='.$me['id']);

        $page['data']['balancefunds'] = $rs2[0]['balancefunds'];

        //传值到模板显示

		$this -> assign($page);
	
		if( $this -> isMobile ){
			$tpl =  ACTION_NAME . ".mobile";
		}
		$this->display ( $tpl );
	
	}
	
	/**
	 * 财务明细
	 *
	 * 获取一级代理商的充值记录
	 */
	function details(){
	
		$model = D( $this->modelName );
		
		// 判断是否是手机浏览器
		if( $this -> isMobile ){
	
			// 获取代理商为子用户充值记录
			$list = $model -> getRechargeRecords();
			
			$page['list'] = $list;
			// dump($list);exit;
		
			$tpl =  ACTION_NAME . ".mobile";
				
			// 移动端数据渲染模板
			$tpl_data = 'tpl/'. $tpl;
		
			$page['tpl'] = $tpl_data;
				
			//传值到模板显示
			$this -> assign($page);
			//判断是否为第一页,如果不是第一页通过ajax返回数据
			if( $_GET['p'] >= 2 ){
				//exit(json_encode( $data['MyBizProgress']['data'] ));
				//通过fetch的方式进行渲染
				$content = $this->fetch( $tpl_data );
				exit($content);
			}
		}else{
			// 获取代理商为子用户充值记录
			$page['list'] = $model -> getRechargeRecords();
			
		
			//传值到模板显示
			$this -> assign($page);
		}
		// 获取代理商为子用户充值记录
		
		$this->display ( $tpl );
	}
	
}
?>