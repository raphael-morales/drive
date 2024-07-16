<?php

class ModelUser
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    public function addNewUser($firstname, $lastname, $email, $password,$address, $zipcode, $city, $phone, $birthday)
    {

        try {

            $request = $this->db->prepare("INSERT INTO users (user_firstname, user_lastname, user_email, 
                user_password, user_address, user_zipcode, user_city, user_phone, user_birthday) 
                VALUES (?,?,?,?,?,?,?,?,?)");
            $request->execute([
                $firstname,
                $lastname,
                $email,
                $password,
                $address,
                $zipcode,
                $city,
                $phone,
                $birthday
            ]);

            return $this->db->lastInsertId();

        } catch (Exception $e) {

            var_dump($e->getMessage());
            return false;
        }

    }

    public function getOneUser($email)
    {

        try {
            $request = $this->db->prepare("SELECT * FROM users LEFT JOIN roles ON users.user_role_id = roles.role_id WHERE user_email = ?");

            $request->execute([$email]);

            return $request->fetch();

        } catch (Exception $e) {

            var_dump("Erreur : " . $e->getMessage());
            return null;

        }
    }
}