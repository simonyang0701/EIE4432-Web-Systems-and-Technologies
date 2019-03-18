<?php
$database = "Hostmanagement";
$username = $_GET["v"];
$conn = mysqli_connect("localhost", "root", "",$database);
if ($conn->connect_error){
		echo "Unable to connect to database";
		exit;
	}
    $pattern="/^[a-zA-Z]+\d+$/";
 if(strlen($username)<6){
	 echo "The length should be longer than 6.";
 }
else if(preg_match($pattern,$username)){
    $query = "SELECT account from User where account = '".$username."'";
    $result = $conn->query($query);
	if(!$result) die("");
    else{
		$result->data_seek(0);
		$row = $result->fetch_assoc();
        if(!empty($row)){
            echo "The username has been used, please change the username or go back to <a href='login.html'>login.</a>.";
        }
        else{
            echo "<span style='color:green'>You can use this username.</span>";
        }
        }
}
else{
    echo "The field is not vaild!";
}


?>