<?php
	require_once('robot.php'); 
	$a=new session; 
	$b=$a->session_ad();
	if($b==0){
		header("Location:ad_denglu.php");
	}//权限判断
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" type="text/css" href="management.css">
<title>袂卓工作室签到管理</title>
</head>
<body>
<?php
	//打印签到log表格
	header("connet_type:text/html;charset=utf-8");
	$a=new showrobot;
	$table=$a->showlog();//得到数据包  下面进行解析
	sqlclose();
?>
<h1>签到日志</h1>
<!--打印签到日志-->
<table id='tableBar' border=1 cellspacing=0>
<tr><th>姓名</th><th>签到时间</th></tr>
<?php
	if(is_object($table)){
		for($i=0;$i<$table->cs;$i++){
			echo "<tr>";
			echo '<td>'.$table->data[$i]['name'].'</td>';
			echo '<td>'.$table->data[$i]['signdata'].'</td>';
			echo "</tr>";
		}
	}

?>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><a href="http://localhost/meizhuosignsystem/ad_cleansignlog.php" onClick="return confirm('确定清空签到日志？')">清空签到日志</a></td></tr>
</table>



</body>
</html>