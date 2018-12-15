<?php
/**
 * 模型层：邮件模型类 
 *
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Notify
 * @version     20170718
 * @link        http://www.qisobao.com
*/
 
class EmailModel {
	
	/**
	 * 发送邮件
	 *
	 *@param $address : 收件地址
	 *@param $title : 邮件标题
	 *@param $message : 邮件正文
	 *@return 发送结果
	 */
	function sendMail($address,$title,$message)
	{
		vendor('PHPMailer.class#phpmailer'); //从PHPMailer目录导class.phpmailer.php类文件
		$mail=new PHPMailer();
		// 设置PHPMailer使用SMTP服务器发送Email
		$mail->IsSMTP();
		// html邮件
		$mail->IsHTML(true);
		// 设置邮件的字符编码，若不指定，则为'UTF-8'
		$mail->CharSet='UTF-8';
		// 添加收件人地址，可以多次使用来添加多个收件人
		$mail->AddAddress($address);
		// 设置邮件正文
		$mail->Body=$message;
		// 设置邮件头的From字段。
		$mail->From=C('MAIL_ADDRESS');
		// 设置发件人名字
		$mail->FromName='njtech';
		// 设置邮件标题
		$mail->Subject=$title;
		// 设置SMTP服务器。
		$mail->Host=C('MAIL_SMTP');
		// 设置为“需要验证”
		$mail->SMTPAuth=true;
		// 设置用户名和密码。
		$mail->Username=C('MAIL_LOGINNAME');
		$mail->Password=C('MAIL_PASSWORD');
		// 发送邮件。
		return($mail->Send());
	}
}

?>