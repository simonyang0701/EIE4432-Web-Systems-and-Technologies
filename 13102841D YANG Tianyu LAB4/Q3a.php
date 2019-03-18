<?php

   
   $conn = mysqli_connect("localhost", "root", "","examtimetable1");
   if ($conn->connect_error)  {
	echo "Unable to connect to database";
   	exit;
   }
   
   $prog = $_GET["v"];
   
   $query = "select ProgSubj.ProgramID, a.SubCode, a.totalEnrolledStudents from ProgSubj, (select ProgramID,SubCode, sum(NoStudents) as totalEnrolledStudents from ProgSubj group by SubCode) as a where a.SubCode=ProgSubj.SubCode and ProgSubj.ProgramID='".$prog."'";
   $query1 = "select SubTitle, EDate, VenueID, StartTime, duration from examdetails, subject where examdetails.ExamID=subject.ExamID and subject.SubCode=\"";
   
   $result = $conn->query($query);

   print("<h1> " . $prog . "</h1>");

   if (!$result)  die ("");
   else {
	$result->data_seek(0);



	print("<ul>");
	while ($row = $result->fetch_assoc())  {
		print("<li>".$row["SubCode"] . ": ". $row["totalEnrolledStudents"] ."</li>");
      
      //Details shows here

      $query2=$query1.$row["SubCode"]."\"";
      $result2=$conn->query($query2);
      if(!$result2) die ("");
      else{
         $row2=$result2->fetch_assoc();
         print("The examination of ".$row2["SubTitle"]." on ".$row2["EDate"]." at ".$row2["VenueID"].". It will start at ".$row2["StartTime"].". Its duration is ".$row2["duration"]."hrs.");
      }

	 
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