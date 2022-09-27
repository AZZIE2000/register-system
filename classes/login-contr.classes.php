<?php
class loginContr extends Login
{
    private $email;
    private $password;


    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function loginUser()
    {

        $this->getUser($this->email, $this->password);

        if ($this->admin) {
            $this->location = "admin.php";
        } else {

            $this->location = "home.html";
        }
    }
    // ----------------------------------
    // private $email;
    // private $pass;

    // public function __construct($email, $pass)
    // {

    //     $this->email = $email;
    //     $this->pass = $pass;
    // }

    // public function logUserIn()
    // {
    //     if (!$this->checkMatchPass($this->email, $this->pass)) {
    //         // return "Email or Password is not correct";
    //         $result = false;
    //         // exit();
    //     } else {
    //         $result = true;
    //         $this->activeLogin($this->email);
    //     }
    //     return $result;
    // }
}
