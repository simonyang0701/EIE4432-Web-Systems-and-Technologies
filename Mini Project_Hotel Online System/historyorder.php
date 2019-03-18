<?php

$database = "Hostmanagement"; 
$account = $_GET["v"];

$conn = mysqli_connect("localhost", "root","",$database);
if($conn->connect_error){
    echo "Unable to connect to database";
    exit;
}

$query = "SELECT bookReference,Sdate,Edate,hotel.name from BookHistory,Hotel,User WHERE BookHistory.userID = User.userID and BookHistory.hotelID = Hotel.hotelID and account = '".$account."'";

$result = $conn->query($query);


if(!$result) die("");
else{
    $result->data_seek(0);
    $row = $result->fetch_assoc();
    if(empty($row)){
            echo "You don't have history order yet.";
        }
     else{
    while ($row = $result->fetch_assoc()){       
        echo "<a onmousemove = 'showHistory()' href = 'historyOrderPage.php?v=".$row["bookReference"]."' >OrderNo: ".$row["bookReference"]."</a><br onmousemove = 'showHistory()'>Date: ".$row["Sdate"]."-".$row["Edate"]."<br onmousemove = 'showHistory()'>Hotel: ".$row["name"]."<hr onmousemove = 'showHistory()'><br onmousemove = 'showHistory()'>";
        }  
    }
}



?>