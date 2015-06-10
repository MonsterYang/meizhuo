<?php

	header("connet_type:text/html;charset=utf-8");
	require_once('robot.php'); 

	$a=new session; 
	$b=$a->session_ad();
	if($b==0){
		header("Location:ad_denglu.php");
	}//权限判断
	$oldname=$_POST['oldname'];
	$name=$_POST['name'];

	$phone=$_POST['newphone'];
	$wword=$_POST['newwwords'];

	$a='\'';
	$b='and';
	$c='or';
	//var_dump(strpos($key, $a));
	if(strpos($name, $a)!==false||strpos($name, $b)!==false||strpos($name, $c)!==false){
		die('黑客你好！');
	}
	if(strpos($phone, $a)!==false||strpos($phone, $b)!==false||strpos($phone, $c)!==false){
		die('黑客你好！');
	}
	if(strpos($wword, $a)!==false||strpos($wword, $b)!==false||strpos($wword, $c)!==false){
		die('黑客你好！');
	}

	$a=new CRUDrobot;
	$b=$a->update($oldname,$name,$phone,$wword);
	if($b==1){
		sqlclose();
		header('Location:ad_membertable.php');
	}else{
		sqlclose();
		header("Location:ad_membertable.php?code=0");
		//die("<script language='javascript'>window.alert('数据库出错')</script>");
	}
	sqlclose();
?>