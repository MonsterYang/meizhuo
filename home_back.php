<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	 //调用签到模块
 
  if(!empty($_POST['key'])){
  	$key=$_POST['key'];//得到home输入的内容
 
    //防止sql注入
    $a='\'';
    $b='and';
    $c='or';
    if(strpos($key, $a)!==false||strpos($key, $b)!==false||strpos($key, $c)!==false){
      die("<script language='javascript'>window.alert('黑客你好！')</script>");
    }
    require_once('robot.php'); 
		$a=new signrobot;
		$b=$a->signsystem($key);//调用服务进行签到
    if(is_string($b)){
      sqlclose();
      header("Refresh: 0;url=http://localhost/meizhuosignsystem/home.php");
      die("<script type='text/javascript'>alert('您已经签到啦！上次签到时间：$b')</script>");
    }elseif($b==0){
      sqlclose();
      header("Refresh: 0;url=http://localhost/meizhuosignsystem/home.php");
      die("<script type='text/javascript'>alert('数据库出错')</script>");
    }elseif($b==2){
      sqlclose();
      header("Refresh: 0;url=http://localhost/meizhuosignsystem/home.php");
      die("<script type='text/javascript'>alert('数据库找不到您的信息，请确定输入..')</script>");
    }elseif($b==1){
      sqlclose();
      header("Location:signsuccess.php");
    }

    sqlclose();//关闭sql连接

	}



?>
  