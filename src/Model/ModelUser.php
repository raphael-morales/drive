<?php

class ModelUser
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=mysql-drivem2i.alwaysdata.net;dbname=drivem2i_drive;charset=utf8', 'drivem2i', '1234@M2i');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log('Connection error: ' . $e->getMessage());
        }
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
            $request = $this->db->prepare("SELECT * FROM users WHERE email_user = ?");

            $request->execute([$email]);

            return $request->fetch();

        } catch (Exception $e) {

            var_dump("Erreur : " . $e->getMessage());
            return null;

        }
    }
}