<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

	header("connet_type:text/html;charset=utf-8");
	if(!$admin=$_POST['admin']){
		header("Location:ad_denglu.php");
	}
	$key=$_POST['password'];

	setcookie("adnumber",$admin,time()+30*24*3600);

	//var_dump($key);

	$a='\'';
	$b='and';
	$c='or';
	//var_dump(strpos($key, $a));
	if(strpos($key, $a)!==false||strpos($key, $b)!==false||strpos($key, $c)!==false){
		die('黑客你好！');
	}
	if(strpos($admin, $a)!==false||strpos($admin, $b)!==false||strpos($admin, $c)!==false){
		die('黑客你好！');
	}


	$sql="select passw from admin where name='$admin';";

	require_once('sqlhelper.php');
	$sqlhelper=new sqlrobot;
	$res=$sqlhelper->dql($sql);
	if($res==0){
		header("Location:ad_denglu.php?error=2");
		exit();
	}
	//if($key==$res[0]['passw']){
	if(md5($key)==$res[0]['passw']){
		session_start();
		$_SESSION['admin']=$admin;
		header("Location:ad_home.php");
		exit();
	}else{
		header("Location:ad_denglu.php?error=1");
		exit();
	}

	/*$admin='meizhuosignadmin';
	$password=md5('meizhuo2015');
	$sql="insert into admin (name,passw) values('$admin','$password');";
	$a=$mysqli->query($sql);
	var_dump($a);
	echo $mysqli->error;*/




?>