<?php

	class sqlrobot{

		public $conn;
		public $dbname="meizhuosignsql";//数据库名字
		public $username="root";
		public $password="q662230399";//数据库密码
		public $host="localhost";
		public function __construct(){
			//连接数据库
			$this->conn=new MySQLi($this->host,$this->username,$this->password,$this->dbname);
			if($this->conn->connect_error){
				return $this->conn->connect_error;
			}
			$this->conn->query("set names utf8");
		}

		public function dql($sql){
			$arr = array();
			$i=0;
			$res=$this->conn->query($sql);
			$row=$res->fetch_assoc();
			if($row==NULL){
				return 0;
			}else{
				do{
					$arr[$i++]=$row;
				}while($row=$res->fetch_assoc());
				$res->free();
				return $arr;
			}
		}

		public function dml($sql){
			$a=$this->conn->query($sql);
			if(!$a){
				return 0;
			}else{
				if($this->conn->affected_rows>0){
					return 1;
				}else{
					return 2;
				}
			}
		}

		public function sqliclose(){
			$this->conn->close();
		}
		
	}
	//$a=new sqlrobot;
	//var_dump($a->conn);
	//$a->sqliclose();
?>