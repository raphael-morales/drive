<?php

class ShoppingCartController
{


    public $model;
    public $msg;
    public $title;
    public $categories;
    public $param;
    public $altParam;
    public $displayValue;
    public $products;
    public $total2pay;

    public function __construct()
    {
        $this->model = new Model();
        $this->msg = null;
        $this->title = "Mes produits";
        $this->categories = $this->model->getCategories();
        $this->products = $this->model->getProducts();
        $this->total2pay = 0;
    }


    public function manage()
    {
        if (isset($_SESSION["user"]["basket"])) {
            foreach (($_SESSION["user"]["basket"]) as $product) {
                $this->total2pay += floatval($product["product_price"]) * floatval($product["quantity_ordered"]);
            }
        }

        if (isset($_SESSION["user"])) {
            if (isset($_GET["valid"])) {
                $this->model->newOrder($_SESSION["user"]["id"], $_SESSION["user"]["basket"]);
            };
        } else {
            header("Location: index.php?page=signIn");
        };


        if (!empty($_POST)) {
            if (isset($_POST["idProduct"])) {
                $idProduct = intval($_POST["idProduct"]);
                foreach ($_SESSION["user"]["basket"] as $key => $productsBasket) {
                    if ($productsBasket["product_id"] === $idProduct) {
                        array_splice($_SESSION["user"]["basket"], $key, 1);
                    }
                }
            }
        }

        if (isset($_POST['product_quantity_ordered'])) {
            if (isset($_SESSION['user']['basket'])) {
                $match = false;
                foreach ($_SESSION['user']['basket'] as $key => $p) {
                    if ($p['product_id'] == $_POST["product_id"]) {
                        $_SESSION['user']['basket'][$key]['quantity_ordered'] = $_POST['product_quantity_ordered'];
                        $match = true;
                    }
                };
                if ($match === false) {
                    array_push($_SESSION["user"]["basket"], [
                        'product_id' => +$_POST["product_id"],
                        'product_price' => +$_POST["product_price"],
                        'quantity_ordered' => +$_POST["product_quantity_ordered"]
                    ]);
                }
            } else {
                $_SESSION["user"]["basket"] = [
                    [
                        'product_id' => +$_POST["product_id"],
                        'product_price' => +$_POST["product_price"],
                        'quantity_ordered' => +$_POST["product_quantity_ordered"]
                    ],
                ];
            };
        };

        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/shoppingCart.php');
        include(__DIR__ . '/../view/footer.php');
    }
}
