<!DOCTYPE html>
<html>
<head>
    <title> Question 2 </title>
    <style type="text/css">
	.ans {color:red; font-weight: bold}
    </style>
    <script type="text/javascript">
    
    
      function show()  {

	
	<?php
	   if (isset($_POST["q1"]))  {
	      if ($_POST["q1"]==1024)  $message1 = "Correct!";
 	      else $message1 = "The correct answer is 1024.";
	      echo "document.getElementById('m1').innerHTML = '$message1';";
	   }
	   if (isset($_POST["q2"]))  {
	      if ($_POST["q2"]==6)  $message2 = "Correct!";
 	      else $message2 = "The correct answer is 6.";
	      echo "document.getElementById('m2').innerHTML = '$message2';";
	   }
 	   if (isset($_POST["q3"]))  {
	      if ($_POST["q3"]==42)  $message3 = "Correct!";
 	      else $message3 = "The correct answer is 42.";
	      echo "document.getElementById('m3').innerHTML = '$message3';";
	   }
	?>

      }
    </script>

</head>
<body onload="show()" >


<form name="myForm1" action="Q2A.php" method="POST">
   <p> <label> Question 1. Given 1234x1234 = 1522756, find the last four digits of
	2468x2468 (from left to right).  </label> <br />
       <input type="text" name="q1" /> <span class="ans" id="m1"> </span>
   </p>
   <input type="submit" value="submit" />
</form>
<form name="myForm2" action="Q2A.php" method="POST">
   <p> <label> Question 2. Let a, b, c be positive integers such that a!xb!xc! = 25920.
	Find the greatest possible value of a.  </label> <br />
       <input type="text" name="q2" /> <span class="ans" id="m2"> </span>
   </p>
   <input type="submit" value="submit" />
</form>
<form name="myForm3" action="Q2A.php" method="POST">
   <p> <label> Question 3. Let p, q, r be prime numbers.  If pq+pr = 80 and pq+qr = 425,
	find the value of p+q+r. </label> <br />
       <input type="text" name="q3" /> <span class="ans" id="m3" > </span>
   </p>
   <input type="submit" value="submit" />
</form>

</body>
</html>