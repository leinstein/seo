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

class API_V1Model{

	/**
	 * 通知推送消息
	 *
	 * @param  string $msgCode 消息代码
	 * @param  string $msgInfo 消息内容说明
	 * @param  string $msgData 推送数据，JSON格式
	 * @param  string $host 主机地址
	 * @param  string $url url地址
	 * @return array  目标函数的处理结果
	 */
	static function httpClientPostData( $postData, $host, $url ,$accept = 'application/x-www-form-urlencoded', $contentType ='application/x-www-form-urlencoded; charset=utf-8' ){

		// 导入第三方类库
		import("@.Org.Util.HttpClient");
		 
		//目标主机的地址
		$client = new HttpClient('http://'.$host);

		$client->setDebug(false);
		//设置header
		$client->setAccept($accept);
		$client->setContenttype($contentType);
		//一定要设置 去掉前面的http方法fsockopen才可以正确执行
		$client->host       = $host;
		 
		$result['post']     = $client->post($url, $postData ,false);
		$result['response'] = $client->getContent();
		return $result;
	}


	/**
	 * 通过get方式获取远程服务器数据
	 *
	 * @param string $host 主机地址
	 * @param string $url url地址
	 * @param string $accept  HTTP请求头：代表发送端（客户端）希望接受的数据类型
	 * @param string $contentType HTTP实体头：代表发送端（客户端|服务器）发送的实体数据的数据类型
	 * @return array  目标函数的处理结果
	 */
	public function httpClientGetData( $host, $url, $accept = 'application/x-www-form-urlencoded', $contentType ='application/x-www-form-urlencoded; charset=utf-8'  ){

		// 导入第三方类库
		import("@.Org.Util.HttpClient");

		//目标主机的地址
		$client = new HttpClient('http://'.$host);
		$client->setDebug(false);
		//设置header
		$client->setAccept($accept);
		$client->setContenttype($contentType);
		//一定要设置 去掉前面的http方法fsockopen才可以正确执行
		$client->host       = $host;
	 //	$client->header[]   = $contentType['accept'] ? : $contentType['accept'] ;"Accept:application/json";
		//$client->header[]   = "Content-Type: application/json;charset=utf-8";
		$result['get']     = $client->get($url);
		$result['response'] = $client->getContent();
		return $result;
	}

}
?>