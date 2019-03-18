<?php
if ($_COOKIE['studentName']){
    $visit = true;
}else{
    $vist = false;
    setcookie("studentName",1,time()+3600*24);
    setcookie("visit_time",date("Y-m-d H:i:s",time()));
}
if($visit){
    header('location: login.html');
}else{
    header('location: objectives.html');
}


?>
