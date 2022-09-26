<?php
// include "././classes/dbh.classes.php";
// include "././classes/login/login.classes.php";
// include "././classes/login/login-contr.classes.php";

include "../classes/dbh.classes.php";
include "../classes/login.classes.php";
include "../classes/login-contr.classes.php";

$emailreg = $_POST["email"];
$passreg = $_POST["pass"];
// echo $emailreg;
$login = new loginContr($emailreg, $passreg);
$login->loginUser();
echo $login->loginUser();
// if (!$login->loginUser()) {
//     echo "Email or Password is not correct";
// } else {
//     echo "home.html";
// }
