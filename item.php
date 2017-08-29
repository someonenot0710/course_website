<?php

class Message{

	var $name;
	var $time;
	var $content;


	function __construct($n,$t,$c){
	
		$this->name = $n;
		$this->time = $t;
		$this->content = $c;
	}

	function show(){
		echo "Name: ".$this->name."<br>";
		echo "Time: ".$this->time."<br>";
		echo "Content: ".$this->content."<br>";
		echo "=========================="."<br>";	
	}

}

class DB{
	var $database = null;
	
//	function __construct(){
	//connect
	//資料庫設定
	//資料庫位置
	var $db_server = "140.114.77.130";
	//資料庫名稱
	var $db_name = "nmsl";
	//資料庫管理者帳號
	var $db_user = "course";
	//資料庫管理者密碼
	var $db_passwd = "nmsl";
	//對資料庫連線

//	$database= new mysqli($db_server,$db_user,$db_passwd,$db_name);
	
	public function get_ip(){
		return $this->db_server;
	}

	public function get_name(){
                return $this->db_name;
        }

	public function get_user(){
                return $this->db_user;
        }

	public function get_pwd(){
                return $this->db_passwd;
        }

/*	
	$this->database = mysqli_connect($db_server,$db_user,$db_passwd,$db_name);
	$result=mysqli_select_db("nmsl",$this->database);
*/	

//	echo $database;
	/*

	if ($database->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}	
	else {
		echo "connected";
	}	
	
	if($result) echo "data";
	else echo "no data";
	*/	
//	echo $this->database;	

}

// $db = new DB();

//	$m = new Message("Jerry","2016-9-28","Hi here");

//	$m->show();

?>
