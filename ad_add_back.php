<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	header("connet_type:text/html;charset=utf-8");

	require_once('robot.php'); 
	$a=new session; 
	$b=$a->session_ad();
	if($b==0){
		header("Location:ad_denglu.php");
	}//权限判断，

	if(!$name=$_POST['addadmin']){
		header("Location:ad_add.php");
		exit();
	}
	$password=$_POST['password'];

	$a=new CRUDrobot;
	$b=$a->ad_insert($name,$password);

	if($b==2){
		header("Refresh: 0;url=http://localhost/meizhuosignsystem/ad_admintable.php");
		sqlclose();
		die("<script language='javascript'>window.alert('已经存在该管理员')</script>");
	}elseif($b==0){
		header("Refresh: 0;url=http://localhost/meizhuosignsystem/ad_admintable.php");
		sqlclose();
		die("<script language='javascript'>window.alert('数据库出错')</script>");
	}else{
		header("Refresh: 0;url=http://localhost/meizhuosignsystem/ad_admintable.php");
		sqlclose();
		die("<script language='javascript'>window.alert('添加成功')</script>");
	}

	sqlclose();


?>