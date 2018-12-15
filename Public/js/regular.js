/*
 * 	前台应用正则验证js
 * author: Richer;
 * date:20160411;
 * copyright:dejax;
 * 
 * update By Richer 于20161011 增加新的验证方法，用户名正则对象：用户名为字母、数字或下划线组合，不支持纯数字，5-20个字符
 */

/*
 * 全局参数js
 * author: Richer;
 * date:20160418;
 * copyright:dejax;
 * 
 * update By Richer 于20161011 增加新的正则，用户名正则对象：用户名为字母、数字或下划线组合，不支持纯数字，5-20个字符
 */
//=============== 正则对象，注：如果此处修改了验证规则，请同步修改 kernel\Conf\expand.php 中对应的正则对象 =============//
//金额正则对象：1、最多支持小数点前9位2、不允许为负数3、小数点最多为6位  
var REGEXP_MONEY = /^([1-9][\d]{0,8}|0)(\.[\d]{1,6})?$/;
//手机号码正则对象：11位数字，以1开头或者+86开头
var REGEXP_MOBILE = /^((\+?86)|(\(\+86\)))?1\d{10}$/;
//座机电话正则对象：验证规则：区号+号码，区号以0开头，3位或4位号码由7位或8位数字组成区号与号码之间可以无连接符，也可以“-”连接
var REGEXP_TEL = /^([0-9]{3,4}-)?[0-9]{7,8}$/;   // /^0\d{2,3}-?\d{7,8}$/;
//邮箱正则对象：1、第一部分：由字母、数字、下划线、短线“-”、点号“.”组成2、第二部分：为一个域名，域名由字母、数字、短线“-”、域名后缀组成，而域名后缀一般为.xxx或.xxx.xx，一区的域名后缀一般为2-4位，如cn,com,net，现在域名有的也会大于4位
var REGEXP_EMAIL = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//密码正则对象：1、长度必须大于等于8个字符2、必须至少有一个数字和字母
var REGEXP_PASSWORD = /(?!^[0-9]+$)(?!^[A-z]+$)(?!^[^A-z0-9]+$)^.{8,}$/;
//密码正则对象2：1、长度必须大于等于2个字符2、必须至少有一个数字和字母
var REGEXP_PASSWORD2 = /(?!^[0-9]+$)(?!^[A-z]+$)(?!^[^A-z0-9]+$)^.{2,}$/;
//企业组织机构代码正则对象：1、组织机构代码：全国组织机构代码由八位数字（或大写拉丁字母）本体代码和一位数字（或大写拉丁字母）校验码组成。2、社会信用代码：标准规定统一社会信用代码用18位阿拉伯数字或大写英文字母表示
var REGEXP_ORGANCODE = /(^[0-9A-Z]{9}$)|(^[0-9A-Z]{18}$)/;
//身份证号码正则对象：15位数字，或者18位，最后一个可以为X
var REGEXP_IDCARD =/(^[0-9]{17}[0-9X]{1}$)|(^[0-9]{15}$)/;
//用户名正则对象：用户名为字母、数字或下划线组合，不支持纯数字，5-20个字符
var REGEXP_LOGINACCOUNT = /^[0-9a-zA-Z_]\w{4,20}$/ ;///\d+[a-zA-Z_]+|[a-zA-Z_]+\d+ ;///^[A-Za-z][A-Za-z_][0-9_][A-Za-z0-9_]{5,20}$/;
// 取信息中的中国电话号码（包括移动和固定电话）:
var REGEXP_PHONE = /(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,14}$/;
// 正则QQ
var REGEXP_QQ =/^[1-9][0-9]{4,9}$/;
// 正则URL
var REGEXP_URL = '^((https|http|ftp|rtsp|mms)?://)'
	+ '?(([0-9a-z_!~*\'().&=+$%-]+: )?[0-9a-z_!~*\'().&=+$%-]+@)?' //ftp的user@ 
	+ '(([0-9]{1,3}.){3}[0-9]{1,3}' // IP形式的URL- 199.194.52.184 
	+ '|' // 允许IP和DOMAIN（域名） 
	+ '([0-9a-z_!~*\'()-]+.)*' // 域名- www. 
	+ '([0-9a-z][0-9a-z-]{0,61})?[0-9a-z].' // 二级域名 
	+ '[a-z]{2,6})' // first level domain- .com or .museum 
	+ '(:[0-9]{1,4})?' // 端口- :80 
	+ '((/?)|' // a slash isn't required if there is no file name 
	+ '(/[0-9a-z_!~*\'().;?:@&=+$,%#-]+)+/?)$'; 

/**
 * 金额正则验证
 * 规则：1、最多支持小数点前9位
 * 		2、不允许为负数
 *		3、小数点最多为6位  
 */
function verifyMoney( value ) {
	// var parnt = /-?\d+\.\d+/;//金额正则表达式
	//var parnt = /^([1-9][\d]{0,8}|0)(\.[\d]{1,6})?$/;
	if (REGEXP_MONEY.exec(value) || $.trim(value) == '') {
		return true;
	} else {
		return false;
	}
}

/**
 * 手机电话正则验证
 * 规则：11位数字，以1开头。
 */
function  verifyMobile( value ) {
   //var parnt = /^1\d{10}$/;
   //var parnt = /^((\+?86)|(\(\+86\)))?1\d{10}$/;
   if (REGEXP_MOBILE.exec( $.trim( value ) ) ) {
		return true;
	} else {
		return false;
	}
}
/**
 * 座机电话正则验证
 * 规则：验证规则：区号+号码，区号以0开头，3位或4位号码由7位或8位数字组成区号与号码之间可以无连接符，也可以“-”连接
 */
function verifyTel(value){
   //var parnt = /^0\d{2,3}-?\d{7,8}$/;
   //if ( parnt.exec(value) ) {
   if (REGEXP_TEL.test( $.trim( value ) ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * 座机电话正则验证
 * 规则：验证规则：区号+号码，区号以0开头，3位或4位号码由7位或8位数字组成区号与号码之间可以无连接符，也可以“-”连接
 */
function verifyPhone(value){
   //var parnt = /^0\d{2,3}-?\d{7,8}$/;
   //if ( parnt.exec(value) ) {
   if (REGEXP_PHONE.test( $.trim( value ) ) ) {
		return true;
	} else {
		return false;
	}
}


/**
 * 邮箱正则验证
 * 验证邮箱验证规则：
 * 邮箱地址分成“第一部分@第二部分”
 * 1、第一部分：由字母、数字、下划线、短线“-”、点号“.”组成
 * 2、第二部分：为一个域名，域名由字母、数字、短线“-”、域名后缀组成，而域名后缀一般为.xxx或.xxx.xx，一区的域名后缀一般为2-4位，如cn,com,net，现在域名有的也会大于4位
 */
function verifyEmail(value){
	//var parnt = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
	//var parnt = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
	//var parnt = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   //if ( parnt.exec(value) ) {
	if (REGEXP_EMAIL.test( $.trim( value ) ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * 企业组织机构代码正则验证
 * 企业组织机构代码验证规则:
 * 1、组织机构代码：全国组织机构代码由八位数字（或大写拉丁字母）本体代码和一位数字（或大写拉丁字母）校验码组成。
 * 2、社会信用代码：标准规定统一社会信用代码用18位阿拉伯数字或大写英文字母表示
 */
function verifyOrgancode( value){
	//var parnt = /(^[0-9A-Z]{9}$)|(^[0-9A-Z]{18}$)/; 
   //if ( parnt.exec(value) ) {
	if ( REGEXP_ORGANCODE.test( $.trim( value ) ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * 密码正则验证
 * 密码验证规则：
 * 1、长度必须大于8个字符
 * 2、必须至少有一个数字和字母
 */
//var parntPassword = /(?!^[0-9]+$)(?!^[A-z]+$)(?!^[^A-z0-9]+$)^.{8,}$/;
function verifyPassword( value){
   //if ( parnt.exec(value) ) {
	if ( REGEXP_PASSWORD.test( $.trim( value ) ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * 身份证号码验证
 */
function verifyIDCard( value){
   //if ( parnt.exec(value) ) {
	if ( REGEXP_IDCARD.test( $.trim( value ) ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * 登录帐号验证
 */
function verifyLoginAccount( value ){
   //if ( parnt.exec(value) ) {
	if ( REGEXP_LOGINACCOUNT.test( $.trim( value ) ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * QQ号码验证
 */
function verifyQQ( value ){
   //if ( parnt.exec(value) ) {
	if ( REGEXP_QQ.test( $.trim( value ) ) ) {
		return true;
	} else {
		return false;
	}
}
/**
 * QQ号码验证
 */
function verifyURL( value ){
   //if ( parnt.exec(value) ) {
	if ( REGEXP_URL.test( $.trim( value ) ) ) {
		return true;
	} else {
		return false;
	}
}
