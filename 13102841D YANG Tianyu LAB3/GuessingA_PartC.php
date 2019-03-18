<?php
   session_start();
   if (!isset($_SESSION["ans"]))  {
	$_SESSION["ans"]=rand(0,255);
	$c=$_COOKIE['c'];
   $maxNo=$_COOKIE['maxNo'];
   } else {
	
   }
   $continue = true;
   
   
?>



<!DOCTYPE html>
<html>
<head>
   <title> Guessing game </title>
</head>
<body>
   <h1> Welcome </h1>

<?php
echo"<p> You have chosen the ".$c." channel for  guessing</p>";
?>
   <h2> The answer </h2>
   <?php
   
   if($c=="green")
   echo"<input type='button' style='background-color:rgb(100,".$_SESSION['ans'].",100)'/>";
   
   ?>
   
   <form method="post" action="<?php print htmlspecialchars($_SERVER['PHP_SELF'])?>">
   <p>
      Type your guess here: <input type="text" name="guess" />
      <input type="submit" value="submit"
         <?php if (!$continue) { print("disabled=\"disabled\""); } ?>
      />
   </p>
   </form>

   <h2> Your guess: </h2>
   <?php
   echo"<p>You have $maxNo chances</p>";
   ?>


</body>
</html>