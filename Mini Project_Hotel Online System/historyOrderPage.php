<?php
$orderNo = $_GET["v"];
$database = "Hostmanagement"; 

$conn = mysqli_connect("localhost", "root","",$database);
if($conn->connect_error){
    echo "Unable to connect to database";
    exit;
}

$query = "SELECT bookReference, name, Sdate,Edate, roomType, comment from BookHistory ,Hotel where Hotel.hotelID = BookHistory.hotelID and BookReference = '".$orderNo."'";

$result = $conn->query($query);


if(!$result) die("");
else{
    $result->data_seek(0);    
    while ($row = $result->fetch_assoc()){    

        if($row["comment"]==null||$row["comment"]==""){
            echo "<h1>OrderNo: ".$row["bookReference"]."</h1>"."<p>Hotel Name: ".$row["name"]."</p><p>Date: ".$row["Sdate"]."-".$row["Edate"]."</p><p>Room type: ".$row["roomType"]."</p>";
            echo "<p>You don't have comment on this order.</p>";
            echo "<p>Comment Now</p>";
            echo "<form name='form' id='form' method = 'POST' action = 'comment.php?o=".$orderNo."'>";
            echo "<input type='text' name='comment'>";
            echo "<button type = 'submit' value='submit'>Submit</button>";
            echo "</form>";
            

        }

        else{
            echo "<h1>OrderNo: ".$row["bookReference"]."</h1>"."<p>Hotel Name: ".$row["name"]."</p><p>Date: ".$row["Sdate"]."-".$row["Edate"]."</p><p>Room type: ".$row["roomType"]."</p><p>Comment: ".$row["comment"]."</p>";
        }
        }  
    }
    echo "<br><a href = 'map.php'>Return</a>";


?>