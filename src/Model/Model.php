<?php

class Model
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function addProduct($name, $category, $picture, $description, $origin, $quantity, $price)
    {
        try {
            $request = $this->db->prepare('INSERT INTO products (
                product_name,
                product_category_id,
                product_picture,
                product_description,
                product_origin,
                product_quantity,
                product_price
            ) VALUES (?,?,?,?,?,?,?)');
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

    public function newOrder($user_id, $products)
    {

        try {

            $this->db->beginTransaction();

            $request = $this->db->prepare('INSERT INTO orders(orders_user_id) VALUE (?)');
            $request->execute([$user_id]);

            $order_id = $this->db->lastInsertId();

            $request = $this->db->prepare('INSERT INTO orders_products(
                order_products_order_id,
                order_products_product_id,
                order_products_product_quantity,
                order_products_product_price
            ) VALUE (?,?,?,?)');

            $subFromStock = $this->db->prepare('UPDATE products SET product_quantity = product_quantity - ? WHERE product_id = ?');

            for ($i = 0; $i < count($products); $i++) {
                $request->execute([$order_id, $products[$i]["product_id"], $products[$i]["quantity_ordered"], $products[$i]["product_price"]]);
                $subFromStock->execute([$products[$i]["quantity_ordered"], $products[$i]["product_id"]]);
            }

            $this->db->commit();
        } catch (Exception $e) {

            $this->db->rollBack();
            var_dump($e->getMessage());
        };
    }


    public function getProductById($productId)
    {
        try {
            $request = $this->db->prepare('SELECT * FROM products WHERE product_id = ?');
            $request->execute([$productId]);
            return $request->fetch(PDO::FETCH_ASSOC);
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

    public function updateProduct($productId, $name, $category, $picture, $description, $origin, $quantity, $price)
    {
        try {
            $request = $this->db->prepare(
                "UPDATE products SET
                product_name = ?,
                product_category_id = ?,
                product_picture = ?,
                product_description = ?,
                product_origin = ?,
                product_quantity = ?,
                product_price = ?
                WHERE product_id = ?"
            );
            return $request->execute([$name, $category, $picture, $description, $origin, $quantity, $price, $productId]);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return false;
        }
    }
}
