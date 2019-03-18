 

<html>

<head> <title> Manager </title>
<script type="text/javascript">
   
   function showRoom()  {
   		var a = document.getElementById("hotel");
   		var hotel = a.options[a.selectedIndex].value;
   		if(window.XMLHttpRequest){
   			xmlhttp = new XMLHttpRequest();
   		}
   		else{
   			xmlhttp = new ActiveXObject("MIcrosoft.XMLHTTP");

   		}
   		xmlhttp.onreadystatechange = function(){
   			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
   				var room = document.getElementById("room");
   		        room.innerHTML = xmlhttp.responseText;
   			}
   		}
   		xmlhttp.open("GET","manageHotel.php?v="+hotel,true);
   		xmlhttp.send();
   		
   }
  function showPrice(){
     var a = document.getElementById("hotel");
   		var hotel = a.options[a.selectedIndex].value;
     var b = document.getElementById("roomType");
   		var room = b.options[b.selectedIndex].value;
   		if(window.XMLHttpRequest){
   			xmlhttp = new XMLHttpRequest();
   		}
   		else{
   			xmlhttp = new ActiveXObject("MIcrosoft.XMLHTTP");

   		}
   		xmlhttp.onreadystatechange = function(){
   			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
   				var room = document.getElementById("price");
   		        room.innerHTML = xmlhttp.responseText;
   			}
   		}
   		xmlhttp.open("GET","manageHotel.php?a="+hotel+"&b="+room,true);
   		xmlhttp.send();

  }
    function updatePrice(){
     var a = document.getElementById("hotel");
   		var hotel = a.options[a.selectedIndex].value;
     var b = document.getElementById("roomType");
   		var room = b.options[b.selectedIndex].value;
    var price = document.getElementById("newPrice").value;
   		if(window.XMLHttpRequest){
   			xmlhttp = new XMLHttpRequest();
   		}
   		else{
   			xmlhttp = new ActiveXObject("MIcrosoft.XMLHTTP");

   		}
   		xmlhttp.onreadystatechange = function(){
   			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
   				var room = document.getElementById("price");
   		        room.innerHTML = xmlhttp.responseText;
   			}
   		}
   		xmlhttp.open("GET","manageHotel.php?c="+hotel+"&d="+room+"&e="+price,true);
   		xmlhttp.send();

  }
   
</script>
</head>

<body>

   <form name="myform" >
     <p> Select the Hotel:
        <select name="hotel" id="hotel">
	   <?php
                    $database = "Hostmanagement";
                    $conn = mysqli_connect("localhost", "root","",$database);
                    if($conn->connect_error){
                        echo "Unable to connect to database";
                             exit;
                            }

                    $query = "SELECT name from Hotel";

                    $result = $conn->query($query);
                    if(!$result) die("");
                    else{
                    $result->data_seek(0);
                     while ($row = $result->fetch_assoc()){       
                     echo "<option value = '".$row["name"]."'>".$row["name"]."</option>";
                }  
                 }
                
        
    		
 
   		$result->free();
   		$conn->close();

            ?>
        </select>
     </p>
     <p>  <input type="button" value="showRoomType" onclick="showRoom()" /> 
     </p>
   </form>

   <div name="room" id="room"> </div>
   <div name="price" id="price"> </div>

   <a href = 'login.html'>Logout</a>
</body>

</html>
