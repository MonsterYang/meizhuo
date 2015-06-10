<?php
	require_once('robot.php'); 
	$a=new session; 
	$b=$a->session_ad();
	if($b==0){
		header("Location:ad_denglu.php");
	}//权限判断

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>
袂卓工作室签到管理系统
</title>
</head>

<body>

<?php

	header("connet_type:text/html;charset=utf-8");

	$a=new clear;
	$b=$a->clearsigntimes();
	if($b==0){
		sqlclose();
		//header("Refresh: 0;url=http://localhost/meizhuosignsystem/ad_membertable.php");
		//die("<script language='javascript'>window.alert('数据库出错.....')</script>");
		header("Location:ad_membertable.php?code=0");
	}else{
		sqlclose();
		header("Location:ad_membertable.php");
	}
	sqlclose();
?>

</body>
</html>