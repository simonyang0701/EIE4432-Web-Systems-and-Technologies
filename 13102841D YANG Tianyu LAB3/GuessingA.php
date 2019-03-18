<?php
   $c=$_COOKIE['c'];
   $maxNo=$_COOKIE['maxNo'];
   session_start();
   $success=0;
	$fail=0;
   if (!isset($_SESSION["ans"]))  {
	$_SESSION["ans"]=rand(0,255);
	$_SESSION["noGuess"]=$maxNo;

   $continue=true;
   } else 
   {
	$guessNo=$_POST['guess'];
   $_SESSION["noGuess"]-=1;
	   if($guessNo==$_SESSION["ans"])
	   {
	   $success=1;
	   $continue=false;
	   }
	   else{
	      if($guessNo<$_SESSION["ans"])
	      $compare="small";
	      if($guessNo>$_SESSION["ans"])
	      $compare="big";
	      $continue = true;
	      }
	   if($_SESSION["noGuess"]==0)
	   {
	      $continue=false;
	      $fail=1;
	   }
   }
   
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
   if($c=="red")
   echo"<input type='button' style='background-color:rgb(".$_SESSION['ans'].",100,100)'/>";
   if($c=="blue")
   echo"<input type='button' style='background-color:rgb(100,100,".$_SESSION['ans'].")'/>";
   
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
   
   if($_SESSION["noGuess"]==$maxNo)
   {echo"<p>You have $maxNo chances</p>";}
   else{
      if($c=="red")
      echo"<input type='button' style='background-color:rgb(".$guessNo.",100,100)'/>";
      if($c=="green")
      echo"<input type='button' style='background-color:rgb(100,".$guessNo.",100)'/>";
      if($c=="blue")
      echo"<input type='button' style='background-color:rgb(100,100,".$guessNo.")'/>";
      
      echo"</br>";
      if($success==1)
      echo "You win";
      else {
          echo $guessNo."is too ".$compare;
          echo"</br>";
          echo "You have ".$_SESSION["noGuess"]." chances remained";
      }
      if($fail==1)
      echo"You lost! The correct no is ".$_SESSION['ans'];
 
      }
   ?>


</body>
</html>