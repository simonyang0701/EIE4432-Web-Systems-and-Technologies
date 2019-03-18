<?php
//GET itemChosen / noGuess

$itemChosen=$_GET['itemChosen'];
$noGuess=$_GET['noGuess'];

//set two cookies c / maxNo
setCookie("c",$itemChosen,time()+60*60*24*365);
setCookie("maxNo",$noGuess,time()+60*60*24*365);

//redirect
header("Location:GuessingA.php");

?>