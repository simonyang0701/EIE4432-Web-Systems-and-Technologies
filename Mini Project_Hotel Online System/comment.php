<?php
$comment = $_POST["comment"];
$database = "Hostmanagement"; 
$orderNo = $_GET["o"];
$conn = mysqli_connect("localhost", "root","",$database);
if($conn->connect_error){
    echo "Unable to connect to database";
    exit;
}

$query = "UPDATE BookHistory SET comment = '".$comment."' WHERE bookReference = '".$orderNo."'";

$result = $conn->query($query);

echo "Comment Successfully!<br>";
echo "<a href = 'historyOrderPage.php?v=".$orderNo."'>Return</a>";
?>