<?php

class ModelOrders
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    function getAllOrders()
    {
        try {
            $request = $this->db->query("SELECT orders_order_id AS 'Commande',
                orders_creation_date AS 'date'
                FROM orders");
            return $request->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e){
            error_log('Connection error: ' . $e->getMessage());
            return false;
        }
    }
}