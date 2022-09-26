<?php
class Login extends Dbh
{
    public $location;
    protected $admin;

    protected function getUser($email, $password)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE email = ?;');


        if (!$stmt->execute(array($email))) {
            $stmt = null;
            // header("location: ../welcome.php?error=stmtfailed");
            $this->location = "welcome.php?error=stmtfailed";
            return "stmtfailed";
        }


        if ($stmt->rowCount() == 0) {
            $stmt = null;
            // header("location: ../welcome.php?error=usernotfound");
            $this->location = "welcome.php?error=usernotfound";
            return "usernotfound";
        }

        $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($password, $userInfo[0]['user_pwd']);

        if ($checkPwd == false) {
            $stmt = null;
            // header("location: ../welcome.php?error=wrongpassword");
            $this->location = "welcome.php?error=wrongpassword";
            return "wrongpassword";
        } else {


            // change user status
            $stmt1 = $this->connect()->prepare("UPDATE users SET user_status = 'active' WHERE email = ? ;");


            if (!$stmt1->execute(array($email))) {
                $stmt1 = null;
                // header("location: ../welcome.php?error=stmtfailed");
                // $this->location = "welcome.php?error=stmtfailed";
                return "stmtfailed";
            }


            $stmt1 = null;

            // if ($userInfo[0]['role'] == 'admin') {
            //     $this->admin = true;
            // } else {
            //     $this->admin = false;
            // }

            // session_start();
            // $_SESSION['email'] = $userInfo[0]['email'];

            $stmt = null;
        }


        $stmt = null;
        return true;
    }
    // -----------------------------------------------------
    // protected function checkLoginData($email)
    // {
    //     $stmt = $this->connect()->prepare('SELECT * FROM users WHERE email = ?');

    //     if (!$stmt->execute(array($email))) {
    //         $stmt = null;

    //         return;
    //     }

    //     if ($stmt->rowCount() == 1) {

    //         $resultCheck = true;
    //         $stmt = null;
    //     } else {

    //         $resultCheck = false;
    //         return;
    //     }
    //     return $resultCheck;
    // }

    // protected function checkMatchPass($email, $pass)
    // {
    //     $stmt = $this->connect()->prepare('SELECT * FROM users WHERE email = ?');

    //     if (!$stmt->execute(array($email))) {
    //         $stmt = null;

    //         return;
    //     }
    //     if ($this->checkLoginData($email)) {


    //         $allData = $stmt->fetchAll();

    //         $cPass = $allData["user_pwd"];

    //         if (password_verify($pass, $cPass)) {

    //             $resultCheck = true;
    //         } else {
    //             $resultCheck = false;
    //         }
    //         return $resultCheck;
    //     }
    // }

    // protected function activeLogin($email)
    // {
    //     $stmt = $this->connect()->prepare('UPDATE users
    //     SET user_status = "active"
    //     WHERE email = ?');
    //     if (!$stmt->execute(array($email))) {
    //         $stmt = null;
    //         $result = false;
    //         return;
    //     }
    //     $result = true;
    //     $stmt = null;
    //     return $result;
    // }

}
