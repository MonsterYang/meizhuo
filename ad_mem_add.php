<?php
	require_once('robot.php'); 
	$a=new session; 
	$b=$a->session_ad();
	if($b==0){
		header("Location:ad_denglu.php");
	}//权限判断
	sqlclose();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" type="text/css" href="management.css">
<title>
袂卓工作室签到管理
</title>
</head>
<body>
<h1>添加成员</h1>
<div class="form">
	<fieldset class="fieldset">
		<legend><font color="green">Add members</font></legend>
		<form action="ad_mem_add_back.php" method="post">
			<label for="addname">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</label><input type="text" id="addname" name="addname" /><br/><br/>
			<label for="phone">电话后四位：</label><input type="text" id="phone" name="phone" /><br/><br/>
			<label for="wwords">欢&nbsp;&nbsp;&nbsp;&nbsp;迎&nbsp;&nbsp;&nbsp;&nbsp;语：</label><input type="text" id="wwords" name="wwords" /><br/><br/>
			<input type="submit" id="reset" value="添加"/>
		</form>
	</fieldset>
</div>

</body>
</html>


