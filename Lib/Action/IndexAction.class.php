<?php
/**
 * 默认控制类
 * 
 * 如果设置了分组，此控制类中的代码不会被执行
 * 
 * @category   业务控制类
 * @package    Action
 * @copyright  Copyright 2017-2017 上海米同网络科技有限公司(www.mitong.com)
 * @version    20141010
 */
class IndexAction extends Action {
	
	/**
	 * 默认操作
	 */
    public function index(){
    	echo "hello world!";
    }
}