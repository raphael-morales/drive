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

    function getOrder($idOrder)
    {
        try {
            $request = $this->db->prepare("SELECT 
                product_name,
                order_products_product_quantity,
                order_products_product_price
                FROM orders_products
                INNER JOIN products ON products.product_id = order_products_product_id
                WHERE order_products_order_id=?");
            $request->execute([$idOrder]);
            return $request->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e){
            error_log('Connection error: ' . $e->getMessage());
            return false;
        }
    }
}