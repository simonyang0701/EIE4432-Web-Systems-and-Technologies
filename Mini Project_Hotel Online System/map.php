<?php 
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>map</title>
    </head>
    <style>


    #nav {
    line-height:30px;
    background-color:#eeeeee;
    width:200px;
    float:left;
    padding:5px;	      
}
#section {
    width:700px;
    float:left;
    padding:10px;	 	 
}
#logout{
    float:right;
}
</style>

    <script>
        
       function searchDate(){
          var result = "";
          var today = new Date();
           var Sdate = document.getElementById("Sdate").value;
            var Edate = document.getElementById("Edate").value;
            if(Sdate==""){
                document.getElementById("SdateInfo").innerHTML="This field cannot be empty";
            }
            else if(Sdate<today){
              document.getElementById("SdateInfo").innerHTML="";
                 document.getElementById("EdateInfo").innerHTML="The start day cannot be earlier than today.";
            }
            else if(Edate==""){
                document.getElementById("SdateInfo").innerHTML="";
                 document.getElementById("EdateInfo").innerHTML="This field cannot be empty";

            }
           
            else if(Sdate>Edate){
                document.getElementById("SdateInfo").innerHTML="";
                 document.getElementById("EdateInfo").innerHTML="The end day should be after the start day.";
            }
            else{
                document.getElementById("SdateInfo").innerHTML="";
                document.getElementById("EdateInfo").innerHTML="";
                     if(window.XMLHttpRequest){
   			xml = new XMLHttpRequest();
               
   		}
   		else{
   			xml = new ActiveXObject("MIcrosoft.XMLHTTP");
   		}
           
   		xml.onreadystatechange = function(){
               
   			if(xml.readyState == 4 && xml.status == 200){
   		        result = xml.responseText;
                  
                var sperateResult = result.split(";");
                for(var i = 0 ; i<sperateResult.length;i++){
        var singleResult = sperateResult[i];
        var row = singleResult.split(",");
        showLabel(1,row[1],row[2],row[0],row[3]);
       
               }
               }
   		}
   		xml.open("GET","searchByDate.php?s="+Sdate+"&e="+Edate,true);
   		xml.send();   
            }
       } 
       function locate()  {
           var result = "";
            var search = document.getElementById("search").value;
            
            if (search==""){
                document.getElementById("nameInfo").innerHTML="This field cannot be empty!";
            }
            else {
                document.getElementById("nameInfo").innerHTML="";
            if(window.XMLHttpRequest){
   			xml = new XMLHttpRequest();
               
   		}
   		else{
   			xml = new ActiveXObject("MIcrosoft.XMLHTTP");
   		}
           
   		xml.onreadystatechange = function(){
               
   			if(xml.readyState == 4 && xml.status == 200){
   		        result = xml.responseText;
                   
                var sperateResult = result.split(";");
                for(var i = 0 ; i<sperateResult.length;i++){
        var singleResult = sperateResult[i];
        var row = singleResult.split(",");
        showLabel(0,row[1],row[2],row[0],row[3]);
       
               }
               }
   		}
   		xml.open("GET","search.php?v="+search,true);
   		xml.send();
            }
        
   }
    
            
     function showHistory()  {
       var username = document.getElementById("username").innerHTML;
       var account = <?php echo "'".$_SESSION["account"]."'"; ?>;
   		if(window.XMLHttpRequest){
   			xmlhttp = new XMLHttpRequest();
   		}
   		else{
   			xmlhttp = new ActiveXObject("MIcrosoft.XMLHTTP");
   		}
   		xmlhttp.onreadystatechange = function(){
   			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
   		       document.getElementById("history").innerHTML = xmlhttp.responseText;
   			}
   		}
   		xmlhttp.open("GET","historyorder.php?v="+account,true);
   		xmlhttp.send();
   		
   }

        function noShowHistory(){
            document.getElementById("history").innerHTML = "";
        }
    </script>

    <body>
        <h1><?php echo "<span id='username'>".$_SESSION["name"]."</span>";?>, Welcome and select the hotel you like!</h1>
      
        <div id="nav" onmousemove = "showHistory()" onmouseout = "noShowHistory()" >
            <p>History orders</p>
            <div id="history" ></div>
         </div>
         <span id="logout"><a href = 'login.html'>logout</a></span>
         <div id="section">
            <form name="searchByDate">
            Select the start date:<input type="date" name="Sdate" id="Sdate"><span id="SdateInfo" style="color:red"></span><br>
                Select the end date:<input type="date" name="Edate" id="Edate"><span id="EdateInfo" style="color:red"></span>
                </form>
                <button type="button" value="search" onclick = "searchDate()">search date</button>
                
             <form name="search" >
                <input type="text" name="search" id="search" list="ListSub"/><span id="nameInfo" style="color:red"></span>
                <datalist id="ListSub"> 
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
                     echo "<option value = '".$row["name"]."'></option>";
                }  
                 }
                
            ?>
                        </datalist>
            </form>
            <button type="button" value="search" onclick="locate()">search name</button>
            
            </div>
             
             
             
        <script src='https://maps.googleapis.com/maps/api/js?libraries=place&key=AIzaSyD-Jx_2wBX5ZitWshgWtQy4cnFdkw_veIY'></script>
        <div style='overflow:hidden;height:600px;width:1000px; float:right;'><div id='gmap_canvas' style='height:600px;width:1000px;float:right;'></div>
        
        <style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div>
        <script type='text/javascript'>
            function init_map(){
                var myOptions = {zoom:11,center:new google.maps.LatLng(22.356428,114.10949700000003),mapTypeId: google.maps.MapTypeId.ROADMAP};
                 map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);


                 <?php 
                $database = "Hostmanagement";
                    $conn = mysqli_connect("localhost", "root","",$database);
                    if($conn->connect_error){
                        echo "Unable to connect to database";
                             exit;
                            }
                    $date = date("Y-m-d");
                    $query = "select Room.hotelID, name, location ,(sum(totalNum))-(count(BookHistory.hotelID)) as remain from hotel, Room,BookHistory
                    where BookHistory.hotelID = Room.hotelID and Hotel.hotelID=Room.hotelID and Sdate < '".$date."' and Edate>'".$date."'
                    group by hotelID";
                    $_SESSION["sDate"]=$date;
                    $_SESSION["eDate"]=$date;
                    $result = $conn->query($query);
                    if(!$result) die("");
                    else{
                    $result->data_seek(0);
                     while ($row = $result->fetch_assoc()){       
                     $location = explode(',',$row["location"]);
                     
                     echo "showLabel(1,".$location[0].",".$location[1].",'".trim($row["name"])."','".$row["remain"]."',".$date.",".$date.");"; 
                }  
                 }

                 ?>
    
                 
            }
            function showLabel(f,x,y,name,remain,sDate,eDate){

                var image = '';
               if(f==1){
                if(remain<=500){
                    image = 'redhouse.png';
                }
                else if(remain>500&&remain<=1000){
                    image = 'yellowhouse.png';
                }
                else{
                    image = 'greenhouse.png';
                }
               }
               else if(f==0){
                   image = 'locate.png'
               }
                 var hotel = name;
                 var remainNo = remain;
                 var marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(x,y),draggable: true, animation: google.maps.Animation.DROP,icon: image});
                 var infowindow = new google.maps.InfoWindow({content:"<strong><a href='roominformation.php?v="+hotel+"'>"+hotel+'</a></strong><br>'+remainNo+'<br>'});
                 google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});
            }
          
            google.maps.event.addDomListener(window, 'load', init_map);
            
            </script>
        </div>
       

    </body>
</html>