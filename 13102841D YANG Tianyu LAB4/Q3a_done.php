<?php

   
   $conn = mysqli_connect("localhost", "root", "","examtimetable1");
   if ($conn->connect_error)  {
	echo "Unable to connect to database";
   	exit;
   }
   
   $prog = $_GET["v"];

   $query = "select ProgramID, SubCode, NoStudents from ProgSubj";
   
   $query = "select ProgSubj.ProgramID, a.SubCode, a.totalEnrolledStudents from ProgSubj, (select ProgramID,SubCode, sum(NoStudents) as totalEnrolledStudents from ProgSubj group by SubCode) as a where a.SubCode=ProgSubj.SubCode and ProgSubj.ProgramID='".$prog."'";

   $result = $conn->query($query);

   print("<h1> " . $prog . "</h1>");

   if (!$result)  die ("");
   else {
	$result->data_seek(0);
	$j=0;


	print("<ul>");
	while ($row = $result->fetch_assoc())  {
		print("<li>".$row["SubCode"] . ": ". $row["totalEnrolledStudents"] ."</li>");
	 
	}
	print("</ul>");
/*
	print("<ul>");
	for ($i=0;$i<$j;$i++)   {
	     if ($c[$i] == 1)
		print("<li>". $a[$i] . ": ". $b[$i] ."</li>");
        }
	print("</ul>");
*/

   }

   
   $result->free();
   $conn->close();


?>