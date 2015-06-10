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
		sqlcloss();
		header('Location:ad_membertable.php');
	}else{
		sqlcloss();
		header("Location:ad_membertable.php?code=0");
		//die("<script language='javascript'>window.alert('数据库出错！')</script>");
	}
	sqlcloss();
?>