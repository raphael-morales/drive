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

    public function addProduct($name, $category, $picture, $description, $origin, $quantity, $price)
    {
        try {
            $request = $this->db->prepare('INSERT INTO products (product_name, product_category_id, product_picture, product_description, product_origin, product_quantity, product_price) VALUES (?,?,?,?,?,?,?)');
            $request->execute([$name, $category, $picture, $description, $origin, $quantity, $price]);
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

    public function orderProductsByAscPriceByCategory($category)
    {
        try {
            $request = $this->db->prepare('SELECT * FROM products WHERE product_category_id=?
                ORDER BY product_price ASC ');
            $request->execute([$category]);
            return $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }

    public function orderProductsByDescPriceByCategory($category)
    {
        try {
            $request = $this->db->prepare('SELECT * FROM products WHERE product_category_id=? 
                       ORDER BY product_price DESC');
            $request->execute([$category]);
            return $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }

    public function orderProductsByAscPrice()
    {
        try {
            $request = $this->db->prepare('SELECT * FROM products ORDER BY product_price ASC ');
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }

    public function orderProductsByDescPrice()
    {
        try {
            $request = $this->db->prepare('SELECT * FROM products ORDER BY product_price DESC');
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }

    public function searchProductByAscPrice($word)
    {
        try {
            $request = $this->db->prepare('SELECT * FROM products WHERE `product_name` LIKE ? ORDER BY product_price ASC;');
            $request->execute(["%$word%"]);
            return $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }

    public function searchProductByDescPrice($word)
    {
        try {
            $request = $this->db->prepare('SELECT * FROM products WHERE `product_name` LIKE ? ORDER BY product_price DESC;');
            $request->execute(["%$word%"]);
            return $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }

    public function orderProductsByCategory($category)
    {
        try {
            $request = $this->db->prepare('SELECT * FROM products 
                LEFT JOIN categories ON products.product_category_id = categories.category_id 
                WHERE product_category_id =?
                ORDER BY product_price ASC');
            $request->execute([$category]);
            return $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }

    public function getProducts()
    {
        try {
            $request = $this->db->prepare('SELECT * FROM products ORDER BY product_name ASC');
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }

    public function searchProducts($word)
    {
        try {
            $request = $this->db->prepare('SELECT * FROM products WHERE product_name LIKE ?');
            $request->execute(["%$word%"]);
            return $request->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return [];
        }
    }

    public function getProductById($productId)
    {
        try {
            $request = $this->db->prepare('SELECT * FROM products WHERE product_id = ?');
            $request->execute([$productId]);
            return $request->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return null;
        }
    }

    public function updateProduct($productId, $name, $category, $picture, $description, $origin, $quantity, $price)
    {
        try {
            $request = $this->db->prepare('UPDATE products SET
            product_name = ?,
            product_category_id = ?,
            product_picture = ?,
            product_description = ?,
            product_origin = ?,
            product_quantity = ?,
            product_price = ?
                WHERE product_id = ?');
            return $request->execute([$name, $category, $picture, $description, $origin, $quantity, $price, $productId]);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteProduct($productId)
    {
        try {
            $request = $this->db->prepare('DELETE FROM products WHERE product_id = ?');
            return $request->execute([$productId]);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return false;
        }
    }
}
?>