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
            $request = $this->db->prepare("SELECT * FROM users LEFT JOIN roles ON users.user_role_id = roles.role_id WHERE user_email = ?");

            $request->execute([$email]);

            return $request->fetch();

        } catch (Exception $e) {

            var_dump("Erreur : " . $e->getMessage());
            return null;

        }
    }

    public function getAllUserAdmin(){
        try {
            $request =  $this->db->query("SELECT user_lastname AS Nom ,
                user_firstname AS Prenom,
                user_email AS Email,
                user_address AS Adresse,
                user_zipcode AS Code_postal,
                user_city AS Ville,
                user_phone AS Téléphone,
                user_birthday AS Anniversaire,
                user_creation_date AS Inscription,
                role_name AS Role
                FROM users 
                LEFT JOIN roles ON `user_role_id` = roles.role_id
                WHERE user_role_id=1");
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $e) {

            var_dump("Erreur : " . $e->getMessage());
            return null;

        }
    }

    public function getAllUsers(){
        try {
            $request =  $this->db->query("SELECT user_lastname AS Nom ,
                user_firstname AS Prenom,
                user_email AS Email,
                user_address AS Adresse,
                user_zipcode AS Code_postal,
                user_city AS Ville,
                user_phone AS Téléphone,
                user_birthday AS Anniversaire,
                user_creation_date AS Inscription,
                role_name AS Role
                FROM users 
                LEFT JOIN roles ON `user_role_id` = roles.role_id
                WHERE user_role_id=2");
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $e) {

            var_dump("Erreur : " . $e->getMessage());
            return null;

        }
    }

    public function getAllUsersEmployee(){
        try {
            $request =  $this->db->query("SELECT user_lastname AS Nom ,
                user_firstname AS Prenom,
                user_email AS Email,
                user_address AS Adresse,
                user_zipcode AS Code_postal,
                user_city AS Ville,
                user_phone AS Téléphone,
                user_birthday AS Anniversaire,
                user_creation_date AS Inscription,
                role_name AS Role
                FROM users 
                LEFT JOIN roles ON `user_role_id` = roles.role_id
                WHERE user_role_id=3");
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $e) {

            var_dump("Erreur : " . $e->getMessage());
            return null;

        }
    }

    function getAllRoles(){
        try {
            $request =  $this->db->query("SELECT role_name AS Role FROM roles ");
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $e) {

            var_dump("Erreur : " . $e->getMessage());
            return null;

        }
    }

    function getRoleId($role)
    {
        try {
            $request =  $this->db->prepare("SELECT role_id FROM roles WHERE role_name=? ");
            $request->execute([$role]);
            return $request->fetch();
        }catch (Exception $e) {

            var_dump("Erreur : " . $e->getMessage());
            return null;

        }
    }

    function updateUser($role,$email){
        try {
            $request =  $this->db->prepare("UPDATE users 
                                                SET user_role_id=?
                                                WHERE user_email=?");
            $request->execute([
                $role,
                $email
            ]);
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $e) {

            var_dump("Erreur : " . $e->getMessage());
            return null;

        }
    }
}