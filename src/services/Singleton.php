<?php


class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host=mysql-drivem2i.alwaysdata.net;dbname=drivem2i_drive;charset=utf8', 'drivem2i', '1234@M2i');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log('Connection error: ' . $e->getMessage());
        }
    }
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    public function getConnection()
    {
        return $this->connection;
    }
}
