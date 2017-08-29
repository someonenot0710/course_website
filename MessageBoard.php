<?php
//header('Content-Type: application/json');
header('Content-type: text/json');

include_once('item.php');


class MessageBoard extends DB{
	var $messages = array();
	var $database = null;
	function __construct(){
//	        parent:: __construct();
		$db_server = parent::get_ip();
		$db_name = parent::get_name();
		$db_pwd = parent::get_pwd();
		$db_user = parent::get_user();
		$this->database= new mysqli($db_server,$db_user,$db_pwd,$db_name);
		if ($this->database->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        	}
//		else echo "connected";
	//	$this->receiveMessage();
//		$this->loadData();
	//	$this->showAllMessages();
	//	$this->showForm();
	}

	function receiveMessage(){
		if(count($_POST)!=0){
		$name = $_POST["name"];
                $content = $_POST["content"];
                $T=date("Y-m-d h:i:s",time());
		$this->saveData($name,$content,$T);
		}
		/*
		$name = $_POST["name"];
		$content = $_POST["content"];		
		date("Y-m-d h:i:s",time());
		$this->saveData();*/
	}

	function saveData($n,$t,$c){
		$sql = "INSERT INTO `Messages`(`name`, `time`, `content`,`thumb`) VALUES ('$n','$t','$c','0')";
//		echo $n."  ".$t."  ".$c."<br>";
		if(!$this->database) echo "why???";

		$this->database->query($sql);
	}

	function loadData(){
		$sql = "SELECT * FROM `Messages`";
		$result = $this->database->query($sql);
		while ($row = $result->fetch_assoc()){
			$myobj=NULL;
			$myobj->id=$row['ID'];	
			$myobj->username=$row["name"];
			$myobj->times=$row["time"];
			$myobj->contents=$row["content"];
			$myobj->thumbs=$row["thumb"];
		//	echo $myobj->username."<br>";
			array_push($this->messages,$myobj);
		//	break;

//			echo $this->messages."<br>";
		}
	}

	function save_thumb($id,$num){
		$sql = "UPDATE `Messages` SET `thumb`='$num' WHERE `ID`='$id'";
		$this->database->query($sql);
	}
	

	function showAllMessages(){
		foreach($this->messages as $m){
			$m->show();					
		}
	}

	function showForm(){

	}

}



$m = new MessageBoard();

$registration = $_POST['registration'];
//$id= $_POST['student_id'];
//$content= $_POST['contents'];
//$T=date("Y-m-d h:i:s",time());

//$m->saveData($id,$T,$content);
//$m->loadData();

if ($registration == "success"){
$id= $_POST['student_id'];
$content= $_POST['contents'];
$T=date("Y-m-d h:i:s",time());
$m->saveData($id,$T,$content);
$m->loadData();
$arr = $m->messages;
echo json_encode($arr);
}

else if ($registration == "thumb"){
$p_id= $_POST['para_id'];
$p_thumb= $_POST['para_thumb'];


$m->save_thumb($p_id,$p_thumb);
$m->loadData();
$arr = $m->messages;
echo json_encode($arr);
}


else{
$m->loadData();
$arr = $m->messages;
echo json_encode($arr);
}


//$name = $_POST["name"];
//$content = $_POST["content"];

//echo $name."<br>".$content."<br>";
//echo '<meta http-equiv=REFRESH CONTENT=2;url=course.html>';
/*
$myObj->name = "John";
$myObj->city = "New York";

$myJSON = json_encode($myObj);
*/
//echo $myJSON;

?>
