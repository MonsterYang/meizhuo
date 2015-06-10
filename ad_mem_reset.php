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

<?php
	if(!empty($_GET['name'])){
		$name=$_GET['name'];
		$phone=$_GET['phone'];
		$wword=$_GET['wwords'];
	}
?>


<h1>修改成员信息</h1>
<div class="form" id="formchange">
	<fieldset class="fieldset">
		<legend><font color="green">Reset</font></legend>
		<form action="ad_mem_reset_back.php" method="POST">
			<label for="key">成&nbsp;员&nbsp;姓&nbsp;名：</label><input type="text" id="key" name="name" value='<?php echo $name;?>'/><br/><br/>
			<label for="newphone">新四位号码：</label><input type="text" id="newphone" name="newphone" value='<?php echo $phone;?>'/><br/><br/>
			<label for="newwords">新&nbsp;欢&nbsp;迎&nbsp;语：</label><input type="text" id="newwords" name="newwwords" value='<?php echo $wword;?>'/><br/><br/>
			<input type='hidden' name='oldname' value="<?php echo $name; ?>" />
			<input  type="submit" id="reset" value="修改"/>
		</form>
	</fieldset>
</div>
</body>
</html>
