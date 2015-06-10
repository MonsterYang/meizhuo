<?php

	header("connet_type:text/html;charset=utf-8");
	require_once('robot.php'); 
	$a=new session; 
	$b=$a->session_ad();
	if($b==0){
		header("Location:ad_denglu.php");
	}//权限判断

	$name=$_GET['name'];
	
	$a=new CRUDrobot;
	$b=$a->ndelete($name);
	if($b==1){
		header('Location:ad_membertable.php');
	}else{
		header("Refresh: 0;url=http://localhost/meizhuosignsystem/ad_membertable.php");
		die("<script language='javascript'>window.alert('数据库出错！')</script>");
	}
	sqlcloss();
?>