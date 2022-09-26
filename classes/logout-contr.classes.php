<?php
class LogoutContr extends Logout
{

    // properties
    private $email;



    // methods
    public function __construct($email)
    {

        $this->email = $email;
    }
    public function logUserOut()
    {
        $this->logout($this->email);
    }
}
