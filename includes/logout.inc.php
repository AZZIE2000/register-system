<?php
include "../classes/dbh.classes.php";
include "../classes/logout.classes.php";
include "../classes/logout-contr.classes.php";

session_start();
$out =   $_POST["logout"];
$email =   $_SESSION["email"];
if ($out == 1) {

    $logOut = new LogoutContr($email);
    $logOut->logUserOut();
    echo "register.html";
    session_destroy();
}
