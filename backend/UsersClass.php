<?php

class UsersClass extends Database
{

    public function setPicture($picture, $user_id)
    {
        $query = $this->connect()->prepare('UPDATE users SET user_image = ? WHERE user_id = ?');
        $query->execute([$picture, $user_id]);
    }

    public function updateUserPersonalDetails($user_name, $user_second_name, $user_email, $user_id)
    {

        $query = $this->connect()->prepare('UPDATE users SET user_name = ?, user_second_name = ?, user_email = ? WHERE user_id = ?');
        $query->execute([$user_name, $user_second_name, $user_email, $user_id]);
    }

    public function findAllUsers()
    {
        $query = $this->connect()->prepare('SELECT * FROM users');
        $query->execute();
        return $query->fetchAll();
    }

    public function findUserById($user_id)
    {
        $query = $this->connect()->prepare('SELECT * FROM users WHERE user_id = ?');
        $query->bindValue(1, $user_id);
        $query->execute();
        return $query->fetch();
    }
}
