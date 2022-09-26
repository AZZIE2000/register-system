<?php
// i send this------------

$n1 = $_POST["first_name"];
$n2 = $_POST["second_name"];
$n3 = $_POST["third_name"];
$n4 = $_POST["last_name"];
$email = $_POST["register_email"];
$pass = $_POST["register_password"];
$dob = $_POST["dob_reg"];
$tel = $_POST["tel_num"];
$fullname = $n1 . " " . $n2 . " " . $n3 . " " . $n4;
// echo json_encode($fullname);
// echo "<br>";
// print_r(json_encode($_POST));
// echo "<br>";
// echo ($tel);
// echo "<br>";
// die;



// instantiate signupContr class
include "../classes/dbh.classes.php";
include "../classes/signup.classes.php";
include "../classes/signup-contr.classes.php";
// $name, $email, $tel, $pwd, $dob
$signup = new SignupContr($fullname, $email, $tel, $pass, $dob);
// running error handlers and user signup
$signup->signupUser();
// $signup->isTakenRes();
$msg = $signup->isTakenRes();
if ($msg) {

    echo json_encode($msg);
} else {
    echo json_encode("home.html");
    session_start();
    $_SESSION["email"] = $email;
}

// echo json_decode($msg["mssg"]);
// print_r(json_decode($msg));

// echo $signup->isTakenRes();
