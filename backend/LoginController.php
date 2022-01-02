<?php

class LoginController extends Login
{
    private $user_email_login;
    private $user_password_login;

    public function __construct($user_email_login, $user_password_login)
    {
        $this->user_email_login = $user_email_login;
        $this->user_password_login = $user_password_login;
    }

    public function checkUserInputLogin()
    {

        if ($this->checkEmpty() == false) {
            header('Location: ../frontend/signup.php?error2=empty');
            die();
        }

        $this->checkIfUserExists($this->user_email_login, $this->user_password_login);
    }

    private function checkEmpty()
    {
        $result = '';

        if (empty($this->user_email_login) || empty($this->user_password_login)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
