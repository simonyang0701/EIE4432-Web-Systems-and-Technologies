<html>
<?php


if((!isset($_COOKIE['c']))||(!isset($_COOKIE['maxNo'])))
{
header("Location:settingA.html");
}
else{
header("Location:GuessingA.php");
}

?>

</html>