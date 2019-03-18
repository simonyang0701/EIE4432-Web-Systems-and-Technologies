<?php
     session_start();
     
	 $id=$_SESSION ['id'];
	 $start=$_SESSION['sDate'];
	 $end=$_SESSION['eDate'];

	$type=$_GET["type"];
	 

	 $database = "hostmanagement"; 

	 

	 $totalRooms;
	 $occupied;
	 
	 $conn = mysqli_connect("localhost", "root","",$database);
	 if($conn->connect_error){
		  echo "Unable to connect to database";
		  exit;
	 }
	//	Get total number of rooms
	 $query1= "SELECT totalNum FROM hotel, room WHERE hotel.hotelID=room.hotelID AND hotel.hotelID=$id AND roomType like \"%".$type."%\""; 
	 // Get occupied rooms
	 $query2="SELECT count(*) as c FROM bookhistory WHERE hotelID=$id AND ((Sdate<='$start' AND Edate>='$start') OR (Sdate<'$start' AND Sdate<='$end'))  AND roomType like \"%".$type."%\""; 
	 //Get comment ib descending order of Date
	 $query3="SELECT Edate, comment from bookhistory WHERE hotelID=$id AND  roomType like \"%".$type."%\" ORDER BY Edate DESC";
	 $query4="SELECT Price from room WHERE hotelID=$id AND  roomType like \"%".$type."%\""; 
	 $query6="SELECT roomType from room,hotel where hotel.hotelID=room.hotelID AND hotel.hotelID=$id";


	 //print($query1."<br>");
	 $result1 = $conn->query($query1);
	 $result2 = $conn->query($query2);
	 $result3 = $conn->query($query3);
	 $result4 = $conn->query($query4);

	 if(!$result1) die("Oops");

	 else{
   	 $result1->data_seek(0);    
     while ($row1 = $result1->fetch_assoc()){  
     	 //print($row1["totalNum"]."<br/>");
     	 $totalRooms=$row1["totalNum"];

     }
 	} 


 	if(!$result2) die("Oops2");
 	else{
 		$result2->data_seek(0);    
     	while ($row2 = $result2->fetch_assoc()){  
     	 //print($row2["c"]."<br/>");
     	 $occupied=$row2["c"];
     }
 	}

 	$_SESSION['availableRoom']=$totalRooms-$occupied;
 	print("Remaining Rooms: ".$_SESSION['availableRoom']);
	if($_SESSION['availableRoom']<10){
		print("<p style='color:red; font-style: italic'>Act now ! It's selling out!</p>");
	}


	if(!$result4) die("Oops4");
 	else{
 		$result4->data_seek(0);    
     	while ($row4 = $result4->fetch_assoc()){  
     		print("<br/>Price: $".$row4["Price"]."</br>");
     		$price=$row4["Price"];
     }
 	}

	print("<br/>Here are the comments from other customers:");
 	if(!$result3) die("Oops3");
 	else{
 		$result3->data_seek(0);    
     	while ($row3 = $result3->fetch_assoc()){  
     	 if($row3["comment"]!=NULL) print("<li>".$row3["Edate"].": ".$row3["comment"]."</li>");
     }
 	}

 	

 	//Get hotel with similar prices
	 $query5="SELECT name,Price from hotel,room WHERE hotel.hotelID=room.hotelID AND roomType like\"%".$type."%\" AND Price<=($price*1.05) AND Price>=($price*0.95) AND hotel.hotelID<>$id";

	 $result5 = $conn->query($query5);
	 print("<br>The following is the hotels you may be interested in:");
	 if(!$result5) die("Oops5");
 	 else{
 		$result5->data_seek(0);    
     	while ($row5 = $result5->fetch_assoc()){  
     	 print("<li>".$row5["name"].": "."$".$row5["Price"]."</li>");
     }
 	}
?>