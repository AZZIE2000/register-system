<?php
class Logout extends Dbh
{

    protected function logout($email)
    {
        $stmt = $this->connect()->prepare('UPDATE users
        SET user_status = "inactive"
        WHERE email = ?');
        if (!$stmt->execute(array($email))) {
            $stmt = null;

            exit();
        }
        $stmt = null;
    }
}
