<?php 
	session_start();
	$database = "Hostmanagement";
	$account = $_POST["username"];
	$password = $_POST["password"];
	$query = "SELECT name, account, password,authority from User where account = '".$account."'and password = '".$password."'";

	
	$conn = mysqli_connect("localhost", "root", "",$database);
	if ($conn->connect_error){
		echo "Unable to connect to database";
		exit;
	}

	$result = $conn->query($query);

	if(!$result) die("");
	else{
		$result->data_seek(0);
		$row = $result->fetch_assoc();
		if(empty($row)){  // Incorrect input
			echo "<br>The username or password is wrong!";
			echo "<br><a href='login.html'>Login again.</a>";
			echo "<br><a href='signup.html'>Sign up.</a>";
		}
		//Successfully login
		else if($row["authority"]!="user"){
			$_SESSION["name"] = $row["name"];
			$_SESSION["account"] = $account;
			echo "Manager, login successfully!<br>";
			echo "<a href='manager.php'>Click to continue.</a>";
		}
		else{

			$_SESSION["name"] = $row["name"];
			$_SESSION["account"] = $account;
			echo "Login successfully!<br>";
			echo "<a href='map.php'>Click to continue.</a>";
		}
	}
	
?>