<?php

	require_once('robot.php'); 
	$a=new session; 
	$b=$a->session_ad();
	if($b==0){
		header("Location:ad_denglu.php");
	}//权限判断

	$a=new clear;
	$a->clearlog();
	if($a==1){
		sqlclose();
		header("Location:ad_signlog.php");
	}else{
		sqlclose();
		header("Refresh: 0;url=http://localhost/meizhuosignsystem/ad_signlog.php");
		die("<script language='javascript'>window.alert('数据库出错...')</script>");
	}

	sqlclose();

?>