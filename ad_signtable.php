<?php
	require_once('robot.php'); 
	$a=new session; 
	$b=$a->session_ad();
	if($b==0){
		header("Location:ad_denglu.php");
		//die("<script language='javascript'>window.alert('请先登录')</script>");
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
<?php     require_once('robot.php');  $a=new timerobot; $t=$a->systemtime(); $y=1000*$t[0]+100*$t[1]+10*$t[2]+$t[3]; $m=10*$t[5]+$t[6]; $d=10*$t[8]+$t[9];  ?>
<div class="lookBar">
	<form action='ad_signtable.php' method='POST'>
		<input class="datenum" type="text" name="y" value="<?php  echo $y; ?>"/>年&nbsp;-
		<input class="datenum" type="text" name="m" value="<?php  echo $m; ?>"/>月&nbsp;-
		<input class="datenum" type="text" name="d" value="<?php  echo $d; ?>"/>日&nbsp;-
		前<input class="datenum" type="text" name="ds" value="7"/>天&nbsp;&nbsp;
		<input class="inputstyle" type="submit" value="查看"/>
	</form>		
</div>

<?php

	header("connet_type:text/html;charset=utf-8");
	//调用robot，打印签到表,这里是打印近1周的
	date_default_timezone_set("PRC");
	time();
	$t=date("Y-m-d");
	$m=10*$t[5]+$t[6];
	$d=10*$t[8]+$t[9];
	$y=1000*$t[0]+100*$t[1]+10*$t[2]+$t[3];
	$ds=7;//--------------------------------------------设置默认打印的天数
	//如果接收到制定的打印参数，则接收参数并按制定的打印表格
	if(!empty($_POST['y'])&&!empty($_POST['m'])&&!empty($_POST['d'])&&!empty($_POST['ds'])){
		$y=$_POST['y'];
		$m=$_POST['m'];
		$d=$_POST['d'];
		$ds=$_POST['ds'];
	}
	$a=new printfrobot;
	$table=$a->signlog($m,$d,$y,$ds);//得到表格内容的打包 下面进行解析
	//为了前台方便使用CSS，所以表格在这里解析打印
	sqlclose();
	if(!is_object($table)){
		//header("Refresh: 0;url=http://localhost/meizhuosignsystem/ad_signlog.php");
		//die("<script language='javascript'>window.alert('签到日志为空')</script>");
		header("Location:ad_signlog.php?code=0");
	}
?>

<!--<?php echo $table->y;?>年-->
<br/><br/>
<table id='tableBar' border=1 cellspacing=0>
<tr><!--打印表格的第一行日期，因为打印的天数是动态的 所以用了for-->
<th rowspan=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<?php
	for($i=0;$i<$table->cs/3;$i++){
		echo "<th colspan=3>".$table->data[$i]."</th>";
	}
?>
<th rowspan=2>总次数</th>
</tr>
<tr><!--打印表格的二行上午中午晚上-->
<?php
	for($i=0;$i<$table->cs/3;$i++){
		echo "<th>".$table->data2[$i][0]."</th>";
		echo "<th>".$table->data2[$i][1]."</th>";
		echo "<th>".$table->data2[$i][2]."</th>";
	}
?>
</tr>
<?php
	//打印成员的签到情况，因为打印的行数受数据库中成员的数量而改变，所以只能用循环
	for($i=0;$i<$table->ms;$i++){
		$j=0;
		echo '<tr>';
		echo '<td><b>'.$table->number[$i][$j].'</b></td>';//打印姓名
		for($j=1;$j<$table->cs+1;$j++){
			echo '<td>'.$table->number[$i][$j].'</td>';
		}//输出勾或者空   即签到与没有签到
		echo '<td>'.$table->number[$i][$j].'</td>';//输出签到次数
		echo '</tr>';
	}
?>
</table>
</body>
</html>