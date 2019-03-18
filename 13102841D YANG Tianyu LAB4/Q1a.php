<html>

<head> <title> Test 3 </title>
<script type="text/javascript">
   
   function show()  {

   }
  
   
</script>
</head>

<body>

   <form name="myform" method="GET" action="Q1a.php">
     <p> Select the Program:
        <select name="program">
	   <?php

      		$conn = mysqli_connect("localhost", "root", "","examtimetable1");
   		if ($conn->connect_error)  {
			echo "Unable to connect to database";
		   	exit;
		}

   		

    		$query = "select ProgramID from Programme";
    
    		$result = $conn->query($query);

		$result->data_seek(0);
		while ($row = $result->fetch_assoc())  {
			echo "<option value='" . $row["ProgramID"]  . "'>" . $row["ProgramID"] . "</option>";
		}


    		
 
   		$result->free();
   		$conn->close();

            ?>
        </select>
     </p>
     <p>  <input type="button" value="show" onclick="show()" /> 
     </p>
   </form>

   <div name="info" id="info"> </div>
</body>

</html>
