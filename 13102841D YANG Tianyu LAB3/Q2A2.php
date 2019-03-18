<?php
	   if (isset($_GET["q1"]))  {
	      if ($_GET["q1"]==1024)  $message1 = "Correct!";
 	      else $message1 = "The correct answer is 1024.";
	      echo $message1;
	   }
	   if (isset($_GET["q2"]))  {
	      if ($_GET["q2"]==6)  $message2 = "Correct!";
 	      else $message2 = "The correct answer is 6.";
	      echo $message2;
	   }
 	   if (isset($_GET["q3"]))  {
	      if ($_GET["q3"]==42)  $message3 = "Correct!";
 	      else $message3 = "The correct answer is 42.";
	      echo $message3;
	   }
	   
?>