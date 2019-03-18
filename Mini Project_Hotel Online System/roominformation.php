<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <title>Room Information</title>
   <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.7.2/jquery.min.js"></script>
    <link href="css/jquery.fancybox.css" rel="stylesheet" />
    <script src="js/jquery.fancybox.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {    	        
			$('.fancybox').fancybox();
			 
		});
		
 function show(t)  {
	
    var xmlHttp=null;
    if(window.XMLHttpRequest){
      xmlHttp=new XMLHttpRequest();
    }
    else if(window.ActiveXObject){
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    if(xmlHttp!=null){

      xmlHttp.onreadystatechange=function()
      {
        if(xmlHttp.readyState==4)
        {
         
          document.getElementById(t).innerHTML="haha"+xmlHttp.responseText;
        }
      }
      url="checkRemainingRooms.php?type="+t;
      xmlHttp.open("GET",url,true);
      xmlHttp.send(null);
    }
  }		

	</script>
</head>
<title>Hotel Room </title> </head>
<body>
 <h1>Room Information</h1>
<form name="myForm" id="myForm" method="get" action="newBooking.php">
   
 
 

<?php
     session_start();
     
	 $name=$_GET ['v'];
	 $start=$_SESSION['sDate'];
	 $end=$_SESSION['eDate'];
	 

	 $database = "hostmanagement"; 

	 

	

	
    $query = "select roomType as type from room, hotel where hotel.hotelID = room.hotelID and name like '%".$name."%'";    
   $conn = mysqli_connect("localhost", "root","",$database);
	 if($conn->connect_error){
		  echo "Unable to connect to database";
		  exit;
	 }

	 $result = $conn->query($query);

	 if(!$result) die("Oops");

	 else{
   	 $result->data_seek(0);    
     while ($row = $result->fetch_assoc()){  
	     $type = trim($row["type"]);
     	echo " <div class='p'> ";
		echo "<input name='type' id='type' type='radio'  value='".$type."' onclick='show(this.value)' />".$type;
               
		echo "</br>";
        echo "<a class='fancybox' href='".$type.".jpg' data-fancybox-group='gallery' title=".$type."><img src='".$type.".png' width='110' height='80' alt='' /></a>";
        echo"<a class='fancybox' href='".$row["type"]."1.jpg' data-fancybox-group='gallery' title=".$row["type"]."></a>";
        echo"<a class='fancybox' href='".$row["type"]."2.jpg' data-fancybox-group='gallery' title=".$row["type"]."></a>";
        echo" <p name='".$type."' id='".$type."'>  </p>";
        echo"</div>";
     

     }
	 }
   $query2="SELECT hotelID from hotel where name like '%$name%'" ;
   $conn2 = mysqli_connect("localhost", "root","",$database);
   if($conn2->connect_error){
      echo "Unable to connect to database";
      exit;
   }

   $result2 = $conn2->query($query2);

   if(!$result2) die("Oops");

   else{
     $result2->data_seek(0);    
     while ($row2 = $result2->fetch_assoc()){  
      $_SESSION["id"] = $row2["hotelID"];
     }
   }

	 ?>
<style type="text/css"> 
 body {
 background-color: red;
 background-image: url("background.jpg");

 background-repeat: repeat;


 } 
  h1 {
 color: red;
 letter-spacing: 0.5cm;
 text-align: center;
 text-decoration: underline;
 text-transform: uppercase;
 } 
.p{
 border: 3px double blue; 
 margin-right: 45%;
 margin-left: 30%;
 padding-right: 3%;
padding-bottom: 3%;
padding-left: 3%;
 }

 </style>
 <div style="text-align:center">
 <p> <input type="submit"  value="Submit" />
 </div>
 </form>

</body>
  </html> 