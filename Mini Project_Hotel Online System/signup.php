<?php
session_start();
	$database = "Hostmanagement";
	$name = $_POST["userName"];
	$password = $_POST["password"];
	$account = $_POST["account"];
	$conn = mysqli_connect("localhost", "root", "",$database);
	if ($conn->connect_error){
		echo "Unable to connect to database";
		exit;
	}
	$sql = "select max(userID) as max from user";

	$result = $conn->query($sql);
	if(!$result) die("");
	else{
		$result->data_seek(0);
		$row = $result->fetch_assoc();
		$userID = $row["max"];
		$userID = $userID+1;
		
	}

	$query = "INSERT INTO User (userID, name, account, password,authority)VALUES ('".$userID."','".$name."','".$account."','".$password."','user')"; 

	if($conn->query($query) === true){
		$_SESSION["name"] = $name;
		$_SESSION["account"] = $account;
		echo "<br>Signup successfully!<br>";
		echo "<a href='map.php'>Click to continue.</a>";
	}


?>