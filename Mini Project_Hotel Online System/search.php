<?php
$database = "Hostmanagement"; 
$hotelName = $_GET["v"];

$conn = mysqli_connect("localhost","root","",$database);

$query = "select Room.hotelID, name, location ,(sum(totalNum))-(count(BookHistory.hotelID)) as remain from hotel, Room,BookHistory
                    where BookHistory.hotelID = Room.hotelID and Hotel.hotelID=Room.hotelID and  name like '%".$hotelName."%'
                    group by hotelID";

$result = $conn->query($query);
if(!$result) die("");
else{
    while ($row = $result->fetch_assoc()){
        echo $row["name"].",".$row["location"].",".$row["remain"].";";
    }
} 

?>