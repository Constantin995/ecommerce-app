<?php

class Login extends Database
{
    protected function checkIfUserExists($user_email_login, $user_password_login)
    {

        $query = $this->connect()->prepare('SELECT * FROM users WHERE user_email = ?');
        $query->bindValue(1, $user_email_login);
        $query->execute();

        if ($query->rowCount() == 0) {
            header('Location: ../frontend/signup.php?error2=nouserorpasswordfound');
            exit();
        }
        if ($query->rowCount() > 0) {
            $query = $this->connect()->prepare('SELECT * FROM users WHERE user_email = ? AND user_password = ?');
            $query->bindValue(1, $user_email_login);
            $query->bindValue(2, $user_password_login);
            $query->execute();
            $user_found = $query->fetch();

            if ($query->rowCount() == 0) {
                header('Location: ../frontend/signup.php?error2=nouserorpasswordfound');
                exit();
            } else {
                session_start();
                $_SESSION['id'] = $user_found['user_id'];
                $_SESSION['user_name'] = $user_found['user_name'];
                $_SESSION['user_second_name'] = $user_found['user_second_name'];
                $_SESSION['user_email'] = $user_found['user_email'];
                $_SESSION['user_admin'] = $user_found['user_admin'];
                $_SESSION['user_image'] = $user_found['user_image'];
            }
        }
    }
}
