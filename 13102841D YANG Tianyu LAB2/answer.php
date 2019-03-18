<?php
session_start();
$aaa=$_SESSION['views'];
if (!$_POST[name]){
    ?>
    <html>
    Please go to <a href='login.html'>Login page</a> first
    </html><?php
}else{
if ($_SESSION['studentName'])
{
     printf("<h1> Hello, $aaa</h1>");
     ?>
        <html>
            <hr />
            <p1>You cannot submit your answer twice.</p1>
            <p2>the system will log you out automatically</p2>
            </html>
            <?php
}
else{
    session_start();
    $_SESSION['studentName']=$aaa;
    printf("<h1> Hello, $aaa </h1>");
    ?>
    <html>
    <hr />
    <p1>You have finish today's excise</p1>
    <p2>the system will log you out automatically</p2>
    </html>
    <?php
    $name=$_POST[name];
    $age=$_POST[age];
    $friend=$_POST[friend];
    $txtname= $aaa."_".date("d")."_".date("m");
    $myfile = fopen("$txtname","w");
    $txt = "question 1:";
    fwrite($myfile,$txt);
    $txt = $name;
    fwrite($myfile,$txt);
    $txt = "\n";
    fwrite($myfile,$txt);
    
    $txt = "question 2:";
    fwrite($myfile,$txt);
    $txt = $age;
    fwrite($myfile,$txt);
    $txt = "\n";
    fwrite($myfile,$txt);
    
    $txt = "question 3:";
    fwrite($myfile,$txt);
    $txt = $age;
    fwrite($myfile,$txt);
    $txt = "\n";
    fwrite($myfile,$txt);
    }
}
?>