<?php
	
	header("connet_type:text/html;charset=utf-8");
	require_once('robot.php'); 
	//先判断权限
	$a=new session; 
	$b=$a->session_ad();
	if($b==0){
		header("Location:ad_denglu.php");
	}
	$admin=$_POST['oldadmin'];
	$nadmin=$_POST['admin'];
	$npassword=$_POST['password'];

	$a='\'';
	$b='and';
	$c='or';
	if(strpos($admin, $a)!==false||strpos($admin, $b)!==false||strpos($admin, $c)!==false){
		die('黑客你好！');
	}
	if(strpos($nadmin, $a)!==false||strpos($nadmin, $b)!==false||strpos($nadmin, $c)!==false){
		die('黑客你好！');
	}
	if(strpos($npassword, $a)!==false||strpos($npassword, $b)!==false||strpos($npassword, $c)!==false){
		die('黑客你好！');
	}
	$a=new CRUDrobot;
	$b=$a->ad_update($admin,$nadmin,$npassword);
	if($b==1){
		sqlclose();
		header("Location:ad_admintable.php");
	}else{
		sqlclose();
		header("Refresh: 0;url=http://localhost/meizhuosignsystem/ad_admintable.php");
		die("<script language='javascript'>window.alert('数据库出错...')</script>");
	}

	sqlclose();

?>