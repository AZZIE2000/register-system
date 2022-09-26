<?php

class Signup extends Dbh
{

    // properties
    public $taken;

    // methods
    protected function setUser($name, $email, $tel, $pwd, $dob)
    {
        $stmt = $this->connect()->prepare('INSERT INTO users (fullname,email,phone,user_pwd,dob) VALUES (?,?,?,?,?)');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($name, $email, $tel, $hashedPwd, $dob))) {
            $stmt = null;

            exit();
        }
        $stmt = null;
    }


    protected function checkEmail($email)
    {
        $stmt = $this->connect()->prepare('SELECT email FROM users WHERE email = ?');

        if (!$stmt->execute(array($email))) {
            $stmt = null;

            exit();
        }


        // check if we got any results "rows"

        if ($stmt->rowCount() > 0) {
            $this->taken = "The email already exist";
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }

    public function isTakenRes()
    {
        return $this->taken;
    }
}
