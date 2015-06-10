function on_submit1(thisform){
	with(thisform){
		if (key.value.length<"4") {
			alert("你输入的号码小于四位数，请正确输入手机号后四位");
			return false;
		}
		if(key.value.length>"4") {
			alert("你输入的号码大于四位数，请正确输入手机号后四位");
			return false;
		}
	}
}
function on_submit2(thisform){
	with(thisform){
		if (admin.value.length == "0"||password.value.length == "0") {
			alert("请正确输入账号和密码！");
			return false;
		}
	}
}