<?php
/**
 * 模型层：短消息模型类 
 *
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Notify
 * @version     20170718
 * @link        http://www.qisobao.com
*/
 
/**
 * $ID   = date("YmdHis");           //ID号，要唯一
 * $UserName = "";                 //注册名
 * $Md5Key  = "";                    //密钥
 * $SendNum = "";                       //发送到的手机号
 * $Content = "";              //发送的字符串
 * $url  = "http://utf8.sms.webchinese.cn/?Uid=本站用户名&Key=接口安全密码&smsMob=手机号码&smsText=短信";  //提交接口
 */
class SMSModel {
	// 本系统接口
	protected $SMSKey = "XNfb3kc7xsxy3bSHNAKxvh3S2NFYB";
	protected $SMSApps = array (
			"declare",
			"hotline" 
	);
	protected $SMSPlatform = "sms.webchinese";
	
	// 接口
	protected $UserName = "summernightrain"; // 注册名
	protected $Md5Key = "40bbeb76039d70b06844"; // 密钥
	protected $send_url = "http://utf8.sms.webchinese.cn/?"; // 提交接口
	protected $query_url = "http://sms.powereasy.net/MessageGate/MessageReceive.aspx"; // 查询接口

	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
	
		//按照配置重写接口参数
		$SMSParameter=C('SMSParameter');
		if($SMSParameter){
			$this ->UserName = $SMSParameter['UserName'];
			$this ->Md5Key   = $SMSParameter['Md5Key'];
			$this ->send_url = $SMSParameter['send_url'];
		}
	}
	
	/**
	 * 发送短信
	 * @param unknown $msgNo
	 * @param unknown $msgContent
	 * @param unknown $sendTiming
	 * @param unknown $sendTime
	 * @param string $type
	 * @return Ambigous <mixed, void, string, unknown>
	 */
	public function send($msgNo, $msgContent,$type="GET") {
		// 赋值
		$url = $this->send_url . "Uid=" . $this->UserName . "&Key=" . $this->Md5Key . "&smsMob=" . $msgNo . "&smsText=" . urlencode ( $msgContent );
		if($type=="GET"){
			$result = $this->get_url ( $url );
		}else if($type=="POST"){
			$data['Uid']=$this->UserName;
			$data['Key']=$this->Md5Key;
			$data['smsMob']=$msgNo;
			$data['smsText']=urlencode ( $msgContent );
			$result = $this->posttohost($url, $data);
		}
		Log::write ( "SME Send result:" . $result );
		return $result;
	}
	/**
	 * 查询接口权限验证
	 */
	private function auth($appId, $msgNo, $msgContent, $SMSKeyString) {
		// 提交上来的MD5编码
		$md5string1 = $SMSKeyString; // MD5编码 等于MD5($appid.$SMSKey.$msgNo.$msgContent);
		                             // 判断应用标识权限
		if (in_array ( $appId, $this->SMSApps ) === false) {
			return false;
		}
		// 验证的MD5
		$md5string2 = MD5 ( $appId . $this->SMSKey . $msgNo . $msgContent ); // MD5编码
		if ($md5string1 != $md5string2)
			return false;
			// 验证通过
		return true;
	}
	
	/**
	 * 向主机提交post请求
	 */
	private function posttohost($url, $data) {
		$url = parse_url ( $url );
		if (! isset ( $url ['port'] )) {
			$url ['port'] = "";
		}
		if (! isset ( $url ['query'] )) {
			$url ['query'] = "";
		}
		$encoded = "";
		while ( list ( $k, $v ) = each ( $data ) ) {
			$encoded .= ($encoded ? "&" : "");
			$encoded .= rawurlencode ( $k ) . "=" . rawurlencode ( $v );
		}
		$fp = @fsockopen ( $url ['host'], $url ['port'] ? $url ['port'] : 80 );
		if (! $fp) {
			return "Failed to open socket to url."; // "Failed to open socket to $url[host]";
		}
		fputs ( $fp, sprintf ( "POST %s%s%s HTTP/1.0\n", $url ['path'], $url ['query'] ? "?" : "", $url ['query'] ) );
		fputs ( $fp, "Host: $url[host]\n" );
		fputs ( $fp, "Content-type: application/x-www-form-urlencoded\n" );
		fputs ( $fp, "Content-length: " . strlen ( $encoded ) . "\n" );
		fputs ( $fp, "Connection: close\n\n" );
		fputs ( $fp, "$encoded\n" );
		$line = fgets ( $fp, 1024 );
		if (! eregi ( "^HTTP/1\.. 200", $line ))
			return;
		$results = "";
		$inheader = 1;
		while ( ! feof ( $fp ) ) {
			$line = fgets ( $fp, 1024 );
			if ($inheader && ($line == "\n" || $line == "\r\n")) {
				$inheader = 0;
			}
			if (! $inheader) {
				$results .= $line;
			}
		}
		fclose ( $fp );
		return $results;
	}
	
	/**
	 * 向主机提交get请求
	 */
	function get_url($url) {
		if (function_exists ( 'curl_exec' )) {
			$ch = curl_init ();
			$timeout = 10;
			curl_setopt ( $ch, CURLOPT_URL, $url );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
			$file_contents = curl_exec ( $ch );
			Log::write ( 'curl_init' . $url . $file_contents );
			curl_close ( $ch );
		} else {
			$file_contents = file_get_contents ( $url . $file_contents );
			Log::write ( 'file_get_contents' . $url );
		}
		
		return $file_contents;
	}
}

?>