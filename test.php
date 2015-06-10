<?php
	//打印签到log表格
	header("connet_type:text/html;charset=utf-8");
	require('sqlhelper.php');
	$sqlhelper=new sqlrobot;
	$sql="select * from admin";
	$ad_name=$sqlhelper->dql($sql);
	var_dump($ad_name);
	exit();
	
?>