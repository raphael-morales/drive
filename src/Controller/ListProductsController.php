<?php

class ListProductsController
{
    public $model;
    public $msg;
    public $title;
    public $categories;
    public $param;
    public $altParam;
    public $displayValue;
    public $products;
    public $isAdmin;

    public function __construct()
    {
        $this->model = new Model();
        $this->msg = null;
        $this->title = "Liste des produits";
        $this->categories = $this->model->getCategories();
        $this->isAdmin = $this->checkAdmin();
    }

    private function checkAdmin()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'administrateur';
    }
    public function manage()
    {
        if (isset($_POST['searchQuery'])) {
            $searchQuery = $_POST['searchQuery'];
            $this->products = $this->model->searchProducts($searchQuery);
            $_SESSION["searchQuery"] = $_POST['searchQuery'];
        } elseif (isset($_GET["category"])) {
            $category = $_GET["category"];
            if (isset($_POST["price"]) && $_POST["price"] == "DESC") {
                $this->products = $this->model->orderProductsByDescPriceByCategory($category);
            } else {
                $this->products = $this->model->orderProductsByAscPriceByCategory($category);
            }
        } elseif (isset($_SESSION["searchQuery"])) {
            $searchQuery = $_SESSION["searchQuery"];
            if (isset($_POST["price"]) && $_POST["price"] == "DESC") {
                $this->products = $this->model->searchProductByDescPrice($searchQuery);
            } else {
                $this->products = $this->model->searchProductByAscPrice($searchQuery);
            }
        } else {
            if (isset($_POST["price"]) && $_POST["price"] == "DESC") {
                $this->products = $this->model->orderProductsByDescPrice();
            } elseif (isset($_POST["price"]) && $_POST["price"] == "ASC") {
                $this->products = $this->model->orderProductsByAscPrice();
            } else {
                $this->products = $this->model->getProducts();
            }
        }
        // unset($_SESSION["user"]["basket"]);

        if (isset($_POST['quantity_ordered'])) {
            if (isset($_SESSION['user']['basket'])) {
                foreach ($_SESSION['user']['basket'] as $key => $p) {
                    if ($p['product_id'] === $_POST["product_id"]) {
                        $_SESSION['user']['basket'][$key]['quantity_ordered'] = strval(+$_POST['quantity_ordered'] + +$p['quantity_ordered']);
                    } else {
                        array_push($_SESSION["user"]["basket"], [
                            'product_id' => $_POST["product_id"],
                            'product_price' => $_POST["product_price"],
                            'quantity_ordered' => $_POST["quantity_ordered"]
                        ]);
                    };
                };
            } else {
                $_SESSION["user"]["basket"] = [
                    [
                        'product_id' => $_POST["product_id"],
                        'product_price' => $_POST["product_price"],
                        'quantity_ordered' => $_POST["quantity_ordered"]
                    ],
                ];
            };
        };

        if (isset($_SESSION["user"]["basket"])) {
            var_dump($_SESSION["user"]["basket"]);
        };

        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/listProducts.php');
        include(__DIR__ . '/../view/footer.php');
    }
}
