<?php
session_start();
$database = "Hostmanagement"; 
$sDate = $_GET["s"];
$eDate = $_GET["e"];
$_SESSION["sDate"]=$sDate;
$_SESSION["eDate"]=$eDate;
$conn = mysqli_connect("localhost","root","",$database);

$query = "select Room.hotelID, name, location ,(sum(totalNum))-(count(BookHistory.hotelID)) as remain from hotel, Room,BookHistory
                    where BookHistory.hotelID = Room.hotelID and Hotel.hotelID=Room.hotelID and ((Sdate <= '".$sDate."' and Edate>'".$eDate."') or (Sdate<'".$sDate."' and Sdate<='".$eDate."'))
                    group by hotelID";

$result = $conn->query($query);
if(!$result) die("");
else{
    while ($row = $result->fetch_assoc()){
        echo $row["name"].",".$row["location"].",".$row["remain"].";";
    }
} 

?>