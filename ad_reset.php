<?php
	require_once('robot.php'); 
	$a=new session; 
	$b=$a->session_ad();
	if($b==0){
		header("Location:ad_denglu.php");
		//die("<script language='javascript'>window.alert('请先登录')</script>");
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
<?php
	if(!empty($_GET['adname'])){
		$admin=$_GET['adname'];
	}
?>
<h1>修改管理员信息</h1>
<div class="form" id="formchange">
	<fieldset class="fieldset">
		<legend><font color="green">Reset</font></legend>
		<form action="ad_reset_back.php" method="POST">
			<label for="key">管&nbsp;理&nbsp;员：</label><input type="text" id="key" name="admin" value="<?php echo $admin; ?>"/><br/><br/>
			<label for="newphone">新&nbsp;密&nbsp;码：</label><input type="text" id="newphone" name="password"/><br/><br/>
			<input type="hidden" name="oldadmin" value="<?php echo $admin; ?>"/>
			<input  type="submit" id="reset" value="修改"/>
		</form>
	</fieldset>
</div>
</body>
</html>
