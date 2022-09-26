<?php

class SignupContr extends Signup
{

    // properties
    private $name;
    private $pwd;
    private $email;
    private $dob;
    private $tel;


    // methods
    public function __construct($name, $email, $tel, $pwd, $dob)
    {
        $this->name = $name;
        $this->pwd = $pwd;
        $this->email = $email;
        $this->dob = $dob;
        $this->tel = $tel;
    }
    // $name, $email, $tel, $pwd, $dob
    public function signupUser()
    {
        if ($this->emailTakenCheck() == false) {
            // exit();
            return;
        }

        $this->setUser($this->name, $this->email, $this->tel, $this->pwd, $this->dob);
    }
    private function emailTakenCheck()
    {
        if (!$this->checkEmail($this->email)) {

            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
