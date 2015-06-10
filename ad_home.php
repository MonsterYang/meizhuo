<?php
	require_once('robot.php'); 
	$a=new session; 
	$b=$a->session_ad();
	if($b==0){
		header("Refresh: 0;url=http://localhost/meizhuosignsystem/ad_denglu.php");
		die("<script language='javascript'>window.alert('请先登录')</script>");
	}//权限判断
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" type="text/css" href="homestyle.css">
<script src="jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="jquery-ui-1.9.2.min.js" type="text/javascript"></script>
<title>袂卓工作室签到管理</title>
<script type="text/javascript">
var attime ;
function clock(){
  var time=new Date();
  var years=time.getFullYear();
  var monthes=time.getMonth()+1;
  var data=time.getDate();
  var hours=time.getHours();
  var minutes=time.getMinutes();
  var seconds=time.getSeconds();
  var ww=["星期日","星期一","星期二","星期三","星期四","星期五","星期六"];
  var nweek=time.getDay();
  if (eval(hours) <10) {hours="0"+hours}
  if (eval(minutes) < 10) {minutes="0"+minutes}
  if (seconds < 10) {seconds="0"+seconds}
  var attime=years+"-"+monthes+"-"+data+"<br>"+hours+":"+minutes+":"+seconds+"<br>"+ww[nweek];
  document.getElementById("clock1").innerHTML=attime;
  document.getElementById("clock2").innerHTML=attime;
}
var timer=setInterval(clock,100);
	$(function(){
	$(".message").accordion();
	});
</script>
</head>
<body style="z-index:-2;">
<canvas id="christmasCanvas" style="top: 0px; left: 0px; z-index:-1; position: fixed; pointer-events: none;" ></canvas>
 <script>
     var snow = function() {
    if(1==1) {
      var b = document.getElementById("christmasCanvas"), a = b.getContext("2d"), d = window.innerWidth, c = window.innerHeight;
      b.width = d;
      b.height = c;
      for(var e = [], b = 0;b < 70;b++) {
        e.push({x:Math.random() * d, y:Math.random() * c, r:Math.random() * 4 + 1, d:Math.random() * 70})
      }
      var h = 0;
      window.intervral4Christmas = setInterval(function() {
        a.clearRect(0, 0, d, c);
        a.fillStyle = "rgba(140, 201, 219, 0.6)";
        a.shadowBlur = 5;
        a.shadowColor = "rgba(255, 255, 255, 0.9)";
        a.beginPath();
        for(var b = 0;b < 70;b++) {
          var f = e[b];
          a.moveTo(f.x, f.y);
          a.arc(f.x, f.y, f.r, 0, Math.PI * 2, !0)
        }
        a.fill();
        h += 0.01;
        for(b = 0;b < 70;b++) {
          if(f = e[b], f.y += Math.cos(h + f.d) + 1 + f.r / 2, f.x += Math.sin(h) * 2, f.x > d + 5 || f.x < -5 || f.y > c) {
            e[b] = b % 3 > 0 ? {x:Math.random() * d, y:-10, r:f.r, d:f.d} : Math.sin(h) > 0 ? {x:-5, y:Math.random() * c, r:f.r, d:f.d} : {x:d + 5, y:Math.random() * c, r:f.r, d:f.d}
          }
        }
      }, 70)
    }
  }
  snow();
</script>
<div style="z-index:0;">
	<div class="leftBar">
		<span>管理成员信息</span><hr/>
		<div class="message">
			<div class="header"><a href="#">查看签到情况</a></div>
			<ul>
			  <li><a href="http://localhost/meizhuosignsystem/ad_signtable.php" target="iframe1">查看签到表</a></li>     
			  <li><a href="http://localhost/meizhuosignsystem/ad_signlog.php" target="iframe1">查看签到日志</a></li>
			</ul>
			<div class="header"><a href="#">袂卓成员信息</a></div>
			<ul>
			  <li><a href="http://localhost/meizhuosignsystem/ad_admintable.php" target="iframe1">管理员列表</a></li>
			  <li><a href="http://localhost/meizhuosignsystem/ad_membertable.php" target="iframe1">成员信息列表</a></li>
			</ul>
			<div class="return"><a href="#">返回签到页面</a></div>
			<ul><li><a href="home.php">返回首页</a></li></ul>
		</div>
		<div class="clockBar"> 
			<div id="clock1" class="clock1"></div>
			<div id="clock2" class="clock2"></div>
		</div>
    </div>
	<div class="rightBar">
		<div class="topBar">
			<script language="JavaScript">
				var text = "联袂追求卓越 技术创造未来"; //显示的文字
				var color1 = "blue"; //文字的颜色
				var color2 = "red"; //转换的颜色 
				var i = 0;
				document.write("<div id=a style='font-size:36px; font-weight: bold; line-height: 50px;padding-top:80px;'></div>");
				function changeCharColor() {
				var k=0;
				if (k==0) {
				str = "<center><font><font color=" + color1 + ">";
				for (var j = 0; j < text.length; j++) {
				if( j == i) {
				str += "<font color=" + color2 + ">" + text.charAt(i) + "</font>";
				}
				else {
				str += text.charAt(j);
				}
				}
				str += "</font></font></center>";
				a.innerHTML = str;
				}
				(i == text.length) ? i=0 : i++;
				}
				setInterval("changeCharColor()", 300);
			</script>
		</div>
		<iframe src="right.html" width="100%" height="476px" name="iframe1" frameborder="no"></iframe>
	</div>
</div>
</body>
</html>        