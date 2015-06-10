<?php
	//获得系统的时间  

	header("connet_type:text/html;charset=utf-8");
	require_once('sqlhelper.php');
	$sqlhelper=new sqlrobot;
	
    //获取系统的时间，用于后面的检测是不是已经签到
	class timerobot{
		public function systemtime(){
			date_default_timezone_set("PRC");
			time();
			$t=date("Y-m-d G:i:s");
			//var_dump($t);

			if(strlen($t)==19){
				//echo '<br/>'.$t[11].$t[12];
				if($t[11]=='2'){
					//echo '晚上';
					return $t.' 晚上'.'3';
				}else if($t[11]=='1'){
					if($t[12]>'1'&&$t[12]<'9'){
						//echo '下午';
						return $t." 下午".'2';
					}elseif($t[12]<'2'){ 
						//echo'上午';
						return $t." 上午".'1';
					}else{
						return $t." 晚上".'3';
					}
				}
			}else if(strlen($t)==18){
				//echo '<br/>'.$t[11];
				//echo '上午';
				if($t[11]>'5'){
					return $t.' 上午'.'1';
				}elseif($t[11]<'6'){return $t.' 午夜'.'1';}
			}
		}
	}

	//打印签到表
	class printfrobot{

		public function signlog($m,$d,$y,$ds){

			$m2=$m;//备份得到的日期，后面需要用到
			$d2=$d;
			$y2=$y;
			$data=array();//定义三个组，存放签到表的内容，最后存放到tableclass里面，再返回
			$data2=array();
			$number=array();
			require_once('tableclass.php');
			$table=new table;
			//获得系统时间，打印最近$ds天的表头
			date_default_timezone_set("PRC");
			time();
			$t=date("Y-m-d");
			$table->y=$y;
			if(($y%100!=0&&$y%4==0)||$y%400==0){
				$y=1;
			}else{$y=0;}//判断是不是闰年

			//打印表头
			for($i=0;$i<$ds;$i++){
				$data[$i]=$m.'月'.$d.'号';
				$d--;
				if($d==0){
					//判断下一个月是31天还是30天   或者是28天
					$m--;
					if($m==2&&$y==1){$d=29;}
					elseif($m==2&&$y==0){$d=28;}
					elseif($m==0){$m=12;$d=31;}
					elseif($m%2==1&&$m<8){$d=31;}
					elseif($m%2==0&&$m<8){$d=30;}
					elseif($m%2==1&&$m>7){$d=30;}
					elseif($m%2==0&&$m>7){$d=31;}
				}
			}
			$data[$i]='总次数';
			//在列上添加标尺    $c_sign[$n]   在表格上建立坐标
			$m=$m2;
			$d=$d2;
			$y=$y2;
			for($i=0,$n=0;$i<$ds;$i++){
				$data2[$i][0]='上午';
				$c_sign[$n]="$m-$d-1";
				$data2[$i][1]='下午';
				$c_sign[$n+=1]="$m-$d-2";
				$data2[$i][2]='晚上';
				$c_sign[$n+=1]="$m-$d-3";
				$n++;
				$d--;
				if($d==0){
					//判断下一个月是31天还是30天   或者是28天
					$m--;
					if($m==2&&$y==1){$d=29;}
					elseif($m==2&&$y==0){$d=28;}
					elseif($m==0){$m=12;$d=31;}
					elseif($m%2==1&&$m<8){$d=31;}
					elseif($m%2==0&&$m<8){$d=30;}
					elseif($m%2==1&&$m>7){$d=30;}
					elseif($m%2==0&&$m>7){$d=31;}
				}
			}
			//提取signlog表
			$sql="select * from signlog;";
			global $sqlhelper;//全局变量
			$b=$sqlhelper->dql($sql);
			if($b==0){
				return 0;
			}

			//提取numbermessage表中的name
			$sql="select name from numbermessage;";
			$name=$sqlhelper->dql($sql);
			if($name==0){
				return 0;
			}

			$vv=0;//记录列数   列数-1
			$ms=0;//那个table里面记录表格行数
			$vvv=0;//记录读取到那个name了
			while(!empty($name[$vvv]['name'])){
				//从name里面得到一个成员名字，然后遍历signlog，发现该成员的签到信息，就记录下来
				//然后装进 $c_data[] 
				$s=0;//记录成员签到总次数
				$i=0;//记录得到几天的记录了
				$j=0;//$c_data的序列号【$j】
				$vv=0;//$number[$ms][$vv] 
				$vvvv=0;//读取name的标记
				$c_data[0]=0;//表格标尺
				while(!empty($b[$vvvv])&&$i<$ds){
					$row=$b[$vvvv];//提取一行log
					if($row['name']==$name[$vvv]['name']){
						$m1=$row['signdata'][5];$m2=$row['signdata'][6];$d1=$row['signdata'][8];$d2=$row['signdata'][9];
						$m=10*$m1+$m2;
						$d=10*$d1+$d2;//得到该行log的日期
						if($i==0){$d3=$d;}
						else if($d3<$d){
							$d3=$d;
							$i++;
						}
						if(strlen($row['signdata'])==26){
							$c_data[$j]=$m.'-'.$d.'-'.$row['signdata'][25];$j++;
						}
						elseif(strlen($row['signdata'])==27){
							$c_data[$j]=$m.'-'.$d.'-'.$row['signdata'][26];$j++;
						}
					}
					++$vvvv;
				}
				if($j>0){$j--;}
				$number[$ms][$vv]=$name[$vvv]['name'];
				++$vv;
				$v=0;
				for($i=0;$i<($ds*3);$i++){
					if(($i%3==0)&&(($j-$v)>0)){
						$j=$j-$v;
						$v=0;
					}
					if($c_sign[$i]==$c_data[$j]){
						$number[$ms][$vv]='√';
						++$s;++$v;++$vv;
					}else if(($j>0)&&($c_sign[$i]==$c_data[$j-1])){
						$number[$ms][$vv]='√';
						++$s;++$v;++$vv;
					}else if(($j>1)&&($c_sign[$i]==$c_data[$j-2])){
						$number[$ms][$vv]='√';
						++$s;++$v;++$vv;
					}else{
						$number[$ms][$vv]='';
						++$vv;
					}
				}
				$number[$ms][$vv]=$s;
				++$ms;
				++$vvv;
			}
			$table->cs=$vv-1;//列数-2
			$table->ms=$ms;//行数
			$table->data=$data;//表格第一行
			$table->data2=$data2;//表格第二行
			$table->number=$number;//成员的签到信息
			return $table;
		}


	}



	//打印历史签到次数
	/*class minimalrobot{
	
		public function mysigntimes($key,$c){


			//连接数据库
			$mysqli=new MySQLi("localhost","root","q662230399","meizhuosignsql");
			if($mysqli->connect_error){
				die("连接失败".$mysqli->connect_error);
			}

			$sql="select * from numbermessage where phone=$key;";
			$message=$mysqli->query($sql);
			$message2=$message->fetch_row();
			if(!$message2){
				echo '请求数据失败~~sorry！';
			}

			if($c==1){
				echo $message2[2];}
			else if($c==2){
				echo $message2[4];}

			$message->free();
			$mysqli->close();
		}
	}

	class welcomerobot{
	
		public function wwords($key){


			//连接数据库
			$mysqli=new MySQLi("localhost","root","q662230399","meizhuosignsql");
			if($mysqli->connect_error){
				die("连接失败".$mysqli->connect_error);
			}

			$sql="select wwords from numbermessage where phone=$key;";
			$message=$mysqli->query($sql);
			$message2=$message->fetch_row();
			if(!$message2){
				echo '请求数据失败~~sorry！';
			}
				echo $message2[0];
			$message->free();
			$mysqli->close();
		}
	}*/



	//签到  数据库的操作(no_ad)
	class signrobot{
	
		public function signsystem($key){
			header("connet_type:text/html;charset=utf-8");
			$a=new timerobot();
			$t=$a->systemtime();//得到系统时间

			//判断是否是袂卓成员
			$b=0;
			$sql="select phone from numbermessage;";
			global $sqlhelper;//全局变量
			$phone=$sqlhelper->dql($sql);
			if($phone==0){
				return 0;
			}
			$i=0;//跟踪现在name表读取到哪里
			while(!empty($phone[$i]['phone'])){
				if($phone[$i]['phone']==$key){
					$b=1;
					break;
				}
				++$i;
			}
			if($b==0){
				return 2;//返回 不是袂卓成员
			}

			//判断该成员是否已经签过到
			$b=0;
			$sql="select finaldata from numbermessage where phone='$key' limit 0,1;";
			$fdata=$sqlhelper->dql($sql);
			if($fdata==0){
				return 0;
			}
			$data=$fdata[0]['finaldata'];//得到表格中该成员最后签到的时间，下面进行比较，判断是否已经签过到
			if($data[5]==$t[5]&&$data[6]==$t[6]&&$data[8]==$t[8]&&$data[9]==$t[9]){
				if(strlen($data)==26){
					if(strlen($t)==26){
						if($data[25]==$t[25]){
							return $data;//已经签过到 返回最后一次签到时间
						}
					}
					if(strlen($t)==27){
						if($data[25]==$t[26]){
							return $data;//已经签过到  返回最后一次签到时间
						}
					}
				}
				if(strlen($data)==27){
					if(strlen($t)==26){
						if($data[26]==$t[25]){
							return $data;//已经签过到   返回最后一次签到时间
						}
					}
					if(strlen($t)==27){
						if($data[26]==$t[26]){
							//$fdata->free();
							//header("Refresh: 0;url=http://localhost/meizhuosignsystem/home.php");
							//die("<script type='text/javascript'>alert('已经签过到啦！                                                         上次签到时间：$data[0]')</script>");
							return $data;//已经签过到   返回最后一次签到时间
						}
					}
				}
			}

			//判断完毕，进行签到  回滚机制
			//获取名字  写入log
			$sql0="select name from numbermessage where phone='$key' limit 0,1;";
			$name=$sqlhelper->dql($sql0);
			if($name==0){
				return 0;
			}
			$m1=10*$t[5]+$t[6];
			$m2=10*$data[5]+$data[6];
			//当签到时间为每个月的最后一天的时候，会自动把本月的签到次数清理，添加到历史签到次数中
			if($m1>$m2){
				$sql1="update numbermessage set finaldata='$t',lmtimes=tmtimes,historyts=historyts+tmtimes+1,tmtimes=1 where phone='$key'";
			}elseif($m1==$m2){
				$sql1="update numbermessage set finaldata='$t',tmtimes=tmtimes+1,historyts=historyts+1 where phone='$key'";
			}
			$sql2="insert into signlog (name,signdata) value('{$name[0]['name']}','$t')";
			$sqlhelper->conn->autocommit(false);
			$b=$sqlhelper->dml($sql1);
			$b2=$sqlhelper->dml($sql2);
			if(!$b||!$b2){
				//echo "签到失败,3秒后自动返回".'<br/>'.$mysqli->error;
				$sqlhelper->conn->rollback();
				return 0;
			}else{
				$sqlhelper->conn->commit();
				return 1;
			}
		}
	
	}

	//增删改数据库中的各表
	class CRUDrobot{

		public function ad_insert($name,$password){
			//判断是否已经存在管理员
			global $sqlhelper;//全局变量
			$sql="select name from admin;";
			$ad_name=$sqlhelper->dql($sql);
			//判断是否已经存在该管理员
			$i=0;
			while(!empty($ad_name[$i])){
				if($ad_name[$i]['name']==$name){
					return 2;
				}
				++$i;
			}
			$password=md5($password);
			$sql="insert into admin (name,passw) values('$name','$password');";
			$ad_name=$sqlhelper->dml($sql);
			if($ad_name==0){
				return 0;
			}else{
				return 1;
			}
		}



		public function insert($name,$phone,$wwords){

			//$phone=1000*$phone[0]+100*$phone[1]+10*$phone[2]+$phone[3];
			global $sqlhelper;//全局变量
			$sql="select name from numbermessage;";
			$b=$sqlhelper->dql($sql);
			//判断是否已经存在该成员
			$i=0;
			while(!empty($b[$i]['name'])){
				if($b[$i]['name']==$name){
					return 2;
				}
				++$i;
			}
			$sql="insert into numbermessage ( name,phone,tmtimes,lmtimes,historyts,finaldata,wwords) values('$name',$phone,'0','0','0','0000-00-00 0:00:00 清空0','$wwords');";
			$b=$sqlhelper->dml($sql);
			if($b==0){
				return 0;
			}else{
				return 1;	
			}
		}

		public function ndelete($name){
			global $sqlhelper;//全局变量
			$sql="delete from numbermessage where name='$name';";
			$a=$sqlhelper->dml($sql);
			if($a==1){
				return 1;
			}else{
				return 0;			
			}
		}
		public function ad_delete($name){
			global $sqlhelper;//全局变量
			$sql="delete from admin where name='$name';";
			$a=$sqlhelper->dml($sql);
			if($a==1){
				return 1;
			}else{
				return 0;			
			}
		}


		//管理员信息修改模块
		public function ad_update($oldadmin,$nadmin,$npassword){
			global $sqlhelper;//全局变量
			$sql="select name from admin;";
			$ad_name=$sqlhelper->dql($sql);
			if($ad_name==0){
				return 0;
			}
			$npassword=md5($npassword);
			$sql="update admin set name='$nadmin',passw='$npassword' where name='$oldadmin';";
			$a=$sqlhelper->dml($sql);
			if($a==1){
				return 1;
			}else{
				return 0;
			}
		}

		public function update($oldname,$name,$phone,$wword){
			global $sqlhelper;//全局变量
			$sql="select name from numbermessage;";
			$mem_name=$sqlhelper->dql($sql);
			if($mem_name==0){
				return 0;
			}

			$sql="update numbermessage set name='$name',phone='$phone',wwords='$wword' where name='$oldname';";
			$a=$sqlhelper->dml($sql);
			if($a==0){
				return 0;
			}else{
				return 1;
			}
		}
	}


	class clear{

		public function clearlog(){
			global $sqlhelper;//全局变量
			$sql="delete from signlog where id>-1;";
			$b=$sqlhelper->dml($sql);
			if($b==0){
				return 0;
			}
			$sql="alter table signlog  AUTO_INCREMENT=0;";
			$b=$sqlhelper->dml($sql);
			if($b==0){
				return 0;
			}
			
			$sml="update numbermessage set finaldata='0000-00-00 0:00:00 清空0' where phone>0;";
			$b=$sqlhelper->dml($sml);
			if($b==0){
				return 1;
			}
		}

		public function clearsigntimes(){
			global $sqlhelper;//全局变量
			$sql="update numbermessage set tmtimes=0,lmtimes=0,historyts=0,finaldata='0000-00-00 0:00:00 清空0' where phone>0;";
			$a=$sqlhelper->dml($sql);
			if($a==1){
				return 1;
			}elseif($a==2){
				return 2;
			}else{
				return 0;
			}
		}

	}


	class showrobot{
		public function showlog(){
			global $sqlhelper;//全局变量
			$sql="select * from signlog;";
			$res=$sqlhelper->dql($sql);
			if ($res==0) {
				return 0;
			}

			$s=count($res);
			require_once('tableclass.php');
			$table=new table2;
			$table->cs=$s;
			$table->data=$res;
			return $table;
		}
		public function shownumber(){
			global $sqlhelper;//全局变量
			$sql="select * from numbermessage;";
			$res=$sqlhelper->dql($sql);
			if ($res==0) {
				return 0;
			}

			$s=count($res);
			require_once('tableclass.php');
			$table=new table2;
			$table->cs=$s;
			$table->data=$res;
			return $table;
		}

		public function showadmin(){
			global $sqlhelper;//全局变量
			$sql="select * from admin;";
			$res=$sqlhelper->dql($sql);
			if ($res==0) {
				return 0;
			}
			$s=count($res);
			require_once('tableclass.php');
			$table=new table2;
			$table->cs=$s;
			$table->data=$res;
			return $table;
		}
	}

	class cookie{
		public function cookie_ad(){
			if(empty($_COOKIE['adnumber'])){
				return "";
			}else{
				return "{$_COOKIE['adnumber']}";
			}
		}
	}

	//访问权限控制  利用session技术
	class session{
		public function session_ad(){
			session_start();
			if(empty($_SESSION['admin'])){
				return 0;
			}else{
				return 9;
			}
		}
		public function session_ad2(){
			session_start();
			if(!empty($_SESSION['admin'])){
				return 1;
			}
		}
		public function session_ad3(){
			if(empty($_SESSION['admin'])){
				return 0;
			}
		}
	}


	function sqlclose(){
		global $sqlhelper;
		$sqlhelper->sqliclose();
	}
?>