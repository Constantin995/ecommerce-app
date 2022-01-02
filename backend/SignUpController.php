<?php

class SignUpController extends SignUp
{
    private $user_name;
    private $user_second_name;
    private $user_email;
    private $user_password;
    private $user_rep_password;
    private $user_admin;

    public function __construct($user_name, $user_second_name, $user_email, $user_password, $user_rep_password, $user_admin)
    {
        $this->user_name = $user_name;
        $this->user_second_name = $user_second_name;
        $this->user_email = $user_email;
        $this->user_password = $user_password;
        $this->user_rep_password = $user_rep_password;
        $this->user_admin = $user_admin;
    }

    public function checkUserInput()
    {

        if ($this->checkEmpty() == false) {
            header('Location: ../frontend/signup.php?error=empty');
            die();
        }
        if ($this->checkUserNameAndUserSecondName() == false) {
            header('Location: ../frontend/signup.php?error=unavailableName');
            die();
        }
        if ($this->checkEmail() == false) {
            header('Location: ../frontend/signup.php?error=unavailableEmail');
            die();
        }
        if ($this->checkPasswordLenght() == false) {
            header('Location: ../frontend/signup.php?error=shortPassword');
            die();
        }
        if ($this->checkPasswords() == false) {
            header('Location: ../frontend/signup.php?error=passwordsNotMatch');
            die();
        }
        if ($this->checkEmailInDb() == false) {
            header('Location: ../frontend/signup.php?error=emailUsed');
            die();
        }

        $this->insertUser($this->user_name, $this->user_second_name, $this->user_email, $this->user_password, $this->user_admin);
    }

    private function checkEmpty()
    {
        $result = '';
        if (empty($this->user_name) || empty($this->user_second_name) || empty($this->user_email) || empty($this->user_password) || empty($this->user_rep_password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function checkUserNameAndUserSecondName()
    {
        $result = '';

        if (!preg_match("/^[a-zA-Z]*$/", $this->user_name) && !preg_match("/^[a-zA-Z]*$/", $this->user_second_name)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function checkEmail()
    {
        $result = '';

        if (!filter_var($this->user_email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function checkPasswordLenght()
    {
        $result = '';

        if (strlen($this->user_password) < 5) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function checkPasswords()
    {
        $result = '';

        if ($this->user_password !== $this->user_rep_password) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function checkEmailInDb()
    {
        $result = '';

        if (!$this->checkIfEmailInDb($this->user_email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
