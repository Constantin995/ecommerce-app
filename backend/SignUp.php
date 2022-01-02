<?php

class SignUp extends Database
{

    protected function insertUser($user_name, $user_second_name, $user_email, $user_password, $user_admin)
    {
        $querry = $this->connect()->prepare('INSERT INTO users(user_name, user_second_name, user_email, user_password, user_admin) VALUES(?,?,?,?,?)');

        $querry->execute([$user_name, $user_second_name, $user_email, $user_password, $user_admin]);
    }

    protected function checkIfEmailInDb($user_email)
    {
        $result = '';

        $querry = $this->connect()->prepare('SELECT * FROM users WHERE user_email = ?');
        $querry->bindValue(1, $user_email);
        $querry->execute();

        if ($querry->rowCount() > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
