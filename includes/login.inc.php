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
$logina = new loginContr($emailreg, $passreg);
$logina->loginUser();
if ($logina->err) {
    echo $logina->err;
} else {

    // Send the user to welcome page
    // use echo to send it as a response to js

    echo $logina->location;
}
// echo $login->loginUser();
// if (!$login->loginUser()) {
//     echo "Email or Password is not correct";
// } else {
//     echo "home.html";
// }
