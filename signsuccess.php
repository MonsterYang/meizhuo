<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" type="text/css" href="homestyle.css">
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
  var attime=years+"-"+monthes+"-"+data+"&nbsp;&nbsp;&nbsp;"+hours+":"+minutes+":"+seconds+"&nbsp;&nbsp;&nbsp;"+ww[nweek];
  document.getElementById("clock1").innerHTML=attime;
  document.getElementById("clock2").innerHTML=attime;
}
var timer=setInterval(clock,100);
</script>
<title>袂卓工作室</title>
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
	<div class="topBar">
		<h1>Welcome 签到成功！</h1>
		<p>查看签到记录</p>
	</div>
	<div class="linestyle"></div>	
    <?php     require_once('robot.php');  $a=new timerobot; $t=$a->systemtime(); $y=1000*$t[0]+100*$t[1]+10*$t[2]+$t[3]; $m=10*$t[5]+$t[6]; $d=10*$t[8]+$t[9];  ?>
    <div class="lookBar">
		<form action='ad_signtable.php' method='POST'><br />
			<input class="datenum" type="text" name="y" value="<?php  echo $y; ?>"/>年&nbsp;-
			<input class="datenum" type="text" name="m" value="<?php  echo $m; ?>"/>月&nbsp;-
			<input class="datenum" type="text" name="d" value="<?php  echo $d; ?>"/>日&nbsp;-
			前<input class="datenum" type="text" name="ds" value="7"/>天<br />
			<input class="inputstyle" type="submit" value="查看"/><br />
			<a href="index.php"><span class="inputstyle">返回</span></a>
		</form>		
    </div>
   	<div class="clockstyle">
		<div id="clock1" class="clock1"></div>
		<div id="clock2" class="clock2"></div>
	</div>
</div>
</body>
</html>