<?php

class Model
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

    public function addProduct($name, $category, $picture, $description, $origin, $quantity, $price, $date)
    {
        try {
            $request = $this->db->prepare('INSERT INTO products (name, category, picture, description, origin, quantity, price, date) VALUES (?,?,?,?,?,?,?,?)');
            $request->execute([$name, $category, $picture, $description, $origin, $quantity, $price, $date]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log('Error : ' . $e->getMessage());
            return false;
        }
    }

    public function getCategories()
    {
        try {
            $request = $this->db->prepare('SELECT * FROM categories');
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }
}
