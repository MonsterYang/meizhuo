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
<h1>管理员信息表</h1>
<?php
	//打印管理员表格
	header("connet_type:text/html;charset=utf-8");
	$a=new showrobot;
	$table=$a->showadmin();
	//var_dump($table);exit();
	sqlclose();
?>

<table id='tableBar' border=1 cellspacing=0>
<tr><th>管理员</th><th>密码</th><th></th><th></th></tr>

<?php
	if(is_object($table)){
		for($i=0;$i<$table->cs;$i++){
			echo "<tr>";
			echo '<td>'.$table->data[$i]['name'].'</td>';
			echo '<td>'.$table->data[$i]['passw'].'</td>';
			echo "<td><a href='ad_reset.php?adname={$table->data[$i]['name']}' >修改管理员信息</a></td>";
			echo "<td><a href='ad_delete.php?name={$table->data[$i]['name']}' onClick=".'"'."return confirm('确定移除管理员{$table->data[$i]['name']}？')".'"'.">移除</a></td>";
			echo "</tr>"; 
		}
	}
?>

<tr><td></td><td></td><td><a href='ad_add.php'>添加管理员</a></td><td></td></tr>
</table>
<?php
	if(isset($_GET['code'])){
		switch($_GET['code']){
			case 1: echo "<script language='javascript'>window.alert('已经存在该管理员')</script>";break;
			case 2: echo "<script language='javascript'>window.alert('数据库出错！')</script>";break;
			case 3: echo "<script language='javascript'>window.alert('添加成功')</script>";break;
		}
	}
?>
</body>
</html>
