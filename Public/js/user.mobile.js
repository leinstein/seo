/*
 * 	项目公共函数库
 * author: Richer;
 * copyright: qiso;
 */
// 提交添加用户
function doSub() {

	// 用户名判断
	if( verify_element_exists("username")){
		var username = $.trim($("#username").val());
		if (!username) {
			$.toptip('请输入用户名', 'error');
			$("#username").focus();
			return false;
		}
	}
	

	// 公司名判断
	var epname = $.trim($("#epname").val());
	if (!epname) {
		$.toptip('请输入公司名', 'error');
		$("#epname").focus();
		return false;
	}

	// 联系人判断
	var contact = $.trim($("#contact").val());
	if (!contact) {
		$.toptip('请输入联系人', 'error');
		$("#contact").focus();
		return false;
	}

	// 联系电话判断
	var mobileno = $.trim($("#mobileno").val());
	if (!mobileno) {
		$.toptip('请输入联系电话', 'error');
		$("#mobileno").focus();
		return false;
	}
	if (!verifyTel(mobileno) && !verifyMobile(mobileno)) {
		$.toptip('联系电话格式不正确', 'error');
		$("#mobileno").focus();
		return false;
	}

	// QQ号码判断
	var QQnumber = $.trim($("#QQnumber").val());
	if (QQnumber) {
		if (!verifyTel(QQnumber) && !verifyMobile(QQnumber)) {
			$.toptip('QQ号码格式不正确', 'error');
			$("#QQnumber").focus();
			return false;
		}
	}

	document.form.submit();
}
