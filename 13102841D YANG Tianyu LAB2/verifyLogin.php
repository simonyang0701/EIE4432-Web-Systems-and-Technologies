<html><head><title>Login</title>

<?php
function accessGranted ($n)  {
    printf("<h1> Welcome, $n </h1>");
    session_start();
    $_SESSION['views']=$n;

?>
<html>
<form method="post" action="answer.php">
<hr />
<h2>Article to be read</h2>
<p1>I am Mary Low. I am six years old. My english eacher is Miss Chan. I have a new friend. Hisname is John. </p1>
<p></p>
<p2>Question 1. What is the name of the girl?<br>
<input type="radio" name="name" value="Mary" checked>Mary<br>
<input type="radio" name="name" value="John" checked>John<br>
<input type="radio" name="name" value="Miss Chan" checked>Miss Chan<br>
<p></p><p></p><p></p>
<p3>Question 2. How old is Mary?<br>
<input type="radio" name="age" value="Five" checked>Five<br>
<input type="radio" name="age" value="Six" checked>Six<br>
<input type="radio" name="age" value="Seven" checked>Seven<br>
<p></p><p></p><p></p>
<p3>Question 2. What is the name of Mary&apos;s new friend?<br>
<input type="radio" name="friend" value="Mary" checked>Mary<br>
<input type="radio" name="friend" value="John" checked>John<br>
<input type="radio" name="friend" value="Miss Chan" checked>Miss Chan<br>
<p></p><p></p>
<button type="submit" value="Submit" name="Submit"/>Hand in your answer</button>
</form>
</html>
<?php


}
function accessDenied($s){ 
    printf("<h1>Access Denied</h1>");
    printf($s);
}
?>
</head>
<body>
    <?php
    $sch=$_POST[school];
    $stu=$_POST[student];
    $pwd=$_POST[password];
    if(!$sch || !$stu || !$pwd){accessDenied("Please fill in all form fields.");
        exit();
    }
    if (!(@$file=fopen("test.txt", "read")))  {
	   print("<h1> Error </h1>");     print("<h2> Cannot open the text file. </h2>");
	   exit();
   }
$userVerified = 0;
   while (!feof($file) && ($userVerified == 0))  {
	   $line = fgets($file);
	   rtrim($line);
	   $field = preg_split("/,/", $line);

	   if (($sch == $field[0]) && ($stu == $field[1]) && ($psw = $field[2]))  {  $userVerified=1;   } 
   }
   fclose($file);
 
   if ($userVerified ==1)  
   {accessGranted($stu); 
   
   }
   else	accessDenied("Incorrect username/password.");
?>
</body>  </html>