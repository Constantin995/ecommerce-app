<?php

class Address extends Database
{
    public function checkForUserAddress($user_id, $address_city, $address_street, $address_country)
    {
        $query = $this->connect()->prepare('SELECT * FROM address WHERE user_id = ?');
        $query->bindValue(1, $user_id);
        $query->execute();

        if ($query->rowCount() > 0) {
            $this->updateAddress($address_city, $address_street, $address_country, $user_id);
        } else {
            $this->insertAddress($user_id, $address_city, $address_street, $address_country);
        }
    }

    private function insertAddress($user_id, $address_city, $address_street, $address_country)
    {
        $query = $this->connect()->prepare('INSERT INTO address(user_id, address_city, address_street, address_country) VALUES (?, ?, ?, ?)');
        $query->execute([$user_id, $address_city, $address_street, $address_country]);
    }

    private function updateAddress($address_city, $address_street, $address_country, $user_id)
    {
        $query = $this->connect()->prepare('UPDATE address SET address_city = ?, address_street = ?, address_country = ? WHERE user_id = ?');
        $query->execute([$address_city, $address_street, $address_country, $user_id]);
    }

    public function selectAddress($user_id)
    {
        $query = $this->connect()->prepare('SELECT * FROM address WHERE user_id = ?');
        $query->bindValue(1, $user_id);
        $query->execute();
        return $query->fetch();
    }
}
