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
<h1>成员信息表</h1>
<?php
	//打印成员信息表格
	header("connet_type:text/html;charset=utf-8");
	$a=new showrobot;
	$table=$a->shownumber();
	sqlclose();
?>

<table id='tableBar' border=1 cellspacing=0>
<tr><th>姓名</th><th>号码后四位</th><th>本月签到次数</th><th>上月签到次数</th><th>历史签到总次数</th><th>上次签到时间</th><th>欢迎语</th><th></th><th></th></tr>

<?php
	if(is_object($table)){
		for($i=0;$i<$table->cs;$i++){
			echo "<tr>";
			echo '<td>'.$table->data[$i]['name'].'</td>';
			echo '<td>'.$table->data[$i]['phone'].'</td>';
			echo '<td>'.$table->data[$i]['tmtimes'].'</td>';
			echo '<td>'.$table->data[$i]['lmtimes'].'</td>';
			echo '<td>'.$table->data[$i]['historyts'].'</td>';
			echo '<td>'.$table->data[$i]['finaldata'].'</td>';
			echo '<td>'.$table->data[$i]['wwords'].'</td>';
			echo "<td><a href='http://localhost/meizhuosignsystem/ad_mem_reset.php?name={$table->data[$i]['name']}&phone={$table->data[$i]['phone']}&wwords={$table->data[$i]['wwords']}'>修改成员信息</a></td>";
			echo "<td><a href='http://localhost/meizhuosignsystem/ad_mem_delete.php?name={$table->data[$i]['name']}' onClick=".'"'."return confirm('确定移除成员&nbsp;&nbsp;{$table->data[$i]['name']}?')".'"'."  >移除成员</a></td>";
			echo "</tr>";
		}
	}
?>
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><a href="http://localhost/meizhuosignsystem/ad_mem_add.php">增加成员</a></td><td><a href="http://localhost/meizhuosignsystem/ad_cleansigntimes.php" onClick="return confirm('确定清空签到次数？')">清空签到次数</a></td></tr>

</table>
</body>
</html>
