<?php

if(isset($_GET["v"])){
                    $hotel=$_GET["v"];
                    $database = "Hostmanagement";
                    $conn = mysqli_connect("localhost", "root","",$database);
                    if($conn->connect_error){
                        echo "Unable to connect to database";
                             exit;
                            }

                    $query = "SELECT roomType from Room,Hotel where Hotel.hotelID = Room.hotelID and name like '%".$hotel."%'";

                    $result = $conn->query($query);
                    if(!$result) die("");
                    else{
                    $result->data_seek(0);
                    echo " <form name='roomForm' >";
                    echo "<p>Select the Room:";
                    echo "<select name='roomType' id='roomType'>";
                     while ($row = $result->fetch_assoc()){       
                     echo "<option value = '".$row["roomType"]."'>".$row["roomType"]."</option>";
                }
                    echo "</select></form>";  
                    echo "<input type='button' value='showPrice' onclick='showPrice()'>";
                 }

}
if(isset($_GET["a"])&&isset($_GET["b"])){
                    $hotel=$_GET["a"];
                    $room=$_GET["b"];
                    $database = "Hostmanagement";
                    $conn = mysqli_connect("localhost", "root","",$database);
                    if($conn->connect_error){
                        echo "Unable to connect to database";
                             exit;
                            }

                    $query = "SELECT price from Room,Hotel where Hotel.hotelID = Room.hotelID and name like '%".$hotel."%' and roomType like '%".$room."%'";

                    $result = $conn->query($query);
                    if(!$result) die("");
                    else{
                    $result->data_seek(0);
                    
                     while ($row = $result->fetch_assoc()){       
                     echo "Price:".$row["price"];
                     echo "<p>Modify the price: <input type='text' id='newPrice'/></p>";
                     echo "<input type='button' value='Update' onclick='updatePrice()'>";
                }
                   
                 }
}
if(isset($_GET["c"])&&isset($_GET["d"])&&isset($_GET["e"])){
                    $hotel=$_GET["c"];
                    $room=$_GET["d"];
                    $price=$_GET["e"];
                    $database = "Hostmanagement";
                    $conn = mysqli_connect("localhost", "root","",$database);
                    if($conn->connect_error){
                        echo "Unable to connect to database";
                             exit;
                            }
             $query = "UPDATE Room,Hotel SET Price = '".$price."' WHERE roomType like '%".$room."%' and Room.hotelID=Hotel.hotelID and name like '%".$hotel."%'" ;

            $result = $conn->query($query);

            echo "Update Successfully!<br>";
            
}
          

?>