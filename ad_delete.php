<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	$b=$a->ad_delete($name);
	if($b==1){
		sqlclose();
		header('Location:ad_admintable.php');
	}else{
		sqlclose();
		header("Location:ad_membertable.php?error=0");
		//die("<script language='javascript'>window.alert('数据库出错！')</script>");
	}
	sqlclose();
?>