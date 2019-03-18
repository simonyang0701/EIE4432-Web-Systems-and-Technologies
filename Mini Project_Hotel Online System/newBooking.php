<?php
     session_start();
     
	 $id=$_SESSION ['id'];
	 $start=$_SESSION['sDate'];
	 $end=$_SESSION['eDate'];
	 $userID=$_SESSION['account'];
	 

	 $database = "hostmanagement"; 

	 
	 $type=$_GET['type'];
	


	 
	 $conn = mysqli_connect("localhost", "root","",$database);
	 if($conn->connect_error){
		  echo "Unable to connect to database";
		  exit;
	 }
	 
	 $query1="SELECT count(*) as orderNo from bookhistory";
	  $result1 = $conn->query($query1);
	 if(!$result1) die("Oops");
 	 else{
 		$result1->data_seek(0);    
     	while ($row1 = $result1->fetch_assoc()){  
     	// print($row1["orderNo"]);
     	 $orderNum=$row1["orderNo"];
     }
}

	$query2="select name, userID from user where account=\"$userID\"";
	$result2 = $conn->query($query2);
	 if(!$result2) die("Oops");
 	 else{
 		$result2->data_seek(0);    
     	while ($row2 = $result2->fetch_assoc()){  
     	// print($row1["orderNo"]);
     	 $nameu=$row2["name"];
     	 $uID=$row2["userID"];
     }}
		


	 $random=rand(1,100000);
	 $referenceNo="".$orderNum."X"."".$userID."".$random;


	 $query = "INSERT INTO bookhistory (bookReference, userID, hotelID, Sdate, Edate, roomType)VALUES ('".$referenceNo."','".$uID."','".$id."','".$start."','".$end."','".$type."')";
     //$query = "INSERT INTO bookhistory (bookReference, userID, hotelID, Sdate, Edate, roomType)VALUES ('".$referenceNo."','223','0','2016-11-01','2016-11-02','hh')";

		if($conn->query($query) === true){
		print("<h1>Success!</h1>");
	}

	 $query2="SELECT name from hotel";
	  $result2 = $conn->query($query2);
	 if(!$result2) die("Oops");
 	 else{
 		$result2->data_seek(0);    
     	while ($row2 = $result2->fetch_assoc()){  
     	// print($row1["orderNo"]);
     	$name=$row2["name"];
     }
}



?>
<html>
<head>
<style>
table {
    border-collapse: collapse;
    border: 1px solid black;
}
</style>
<style type="text/css">
 body {

 background-image: url("background.jpg");
 background-repeat: repeat;
 background-position: left left;
 background-attachment: fixed;
 }
   h1 {
 color: red;
 text-align: center;
 text-decoration: underline;
 text-transform: uppercase;
 } 

 </style>

</head>
<body>
 <div align="center">
	<table>
  <tr>
    <th>Booking Record:</th>
 
  </tr>
  
  <tr>
    <td>User:<?php echo $nameu; ?></td>
  </tr>
   <tr>
   	<td>OrderNo:<?php echo $referenceNo; ?></td>
   </tr>
    <tr>
    <td>Booked date: From <?php echo $start; ?> To <?php echo $end; ?></td>
  </tr>

  <tr>
    <td>Hotel name: <?php echo $name; ?></td>
  </tr>

  <tr>
    <td>Room type: <?php echo $type; ?></td>
  </tr>

</table><a href='login.html'>Return to map</a>
</div>

</body>
</html>