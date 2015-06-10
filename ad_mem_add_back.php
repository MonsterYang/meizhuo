<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

	header("connet_type:text/html;charset=utf-8");
	require_once('robot.php'); 
	$a=new session; 
	$b=$a->session_ad();
	if($b==0){
		header("Location:ad_denglu.php");
	}//权限判断

	if(!$name=$_POST['addname']){
		header("Location:ad_mem_add.php");
		exit();
	}
	$phone=$_POST['phone'];
	$wwords=$_POST['wwords'];
	$a=new CRUDrobot;
	$b=$a->insert($name,$phone,$wwords);
	if($b==1){
		sqlclose();
		header("Refresh: 0;url=http://localhost/meizhuosignsystem/ad_membertable.php");
		die("<script language='javascript'>window.alert('添加成功！')</script>");
	}elseif($b==2){
		sqlclose();
		header("Refresh: 0;url=http://localhost/meizhuosignsystem/ad_membertable.php");
		die("<script language='javascript'>window.alert('他已经工作室成员啦！')</script>");
	}else{
		sqlclose();
		header("Refresh: 0;url=http://localhost/meizhuosignsystem/ad_membertable.php");
		die("<script language='javascript'>window.alert('数据库出错...')</script>");
	}

	sqlclose();

?>