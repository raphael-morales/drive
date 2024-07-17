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

    public function __construct()
    {
        $this->model = new Model();
        $this->msg = null;
        $this->title = "Mes produits";
        $this->categories = $this->model->getCategories();
        $this->products = $this->model->getProducts();
        $_SESSION["user"]["basket"] = [
            [
                "product_id" => 2,
                "product_price" => 6.99,
                "product_quantity_ordered" => 4,
            ],

            [
                "product_id" => 7,
                "product_price" => 5.70,
                "product_quantity_ordered" => 2,
            ]
        ];
    }


    public function manage()
    {
        // if (isset($_POST['searchQuery'])) {
        //     $searchQuery = $_POST['searchQuery'];
        //     $this->products = $this->model->searchProducts($searchQuery);
        //     $_SESSION["searchQuery"] = $_POST['searchQuery'];
        // } elseif (isset($_GET["category"])) {
        //     $category = $_GET["category"];
        //     if (isset($_POST["price"]) && $_POST["price"] == "DESC") {
        //         $this->products = $this->model->orderProductsByDescPrice($category);
        //     } else {
        //         $this->products = $this->model->orderProductsByAscPrice($category);
        //     }
        // } elseif (isset($_SESSION["searchQuery"])) {
        //     $searchQuery = $_SESSION["searchQuery"];
        //     if (isset($_POST["price"]) && $_POST["price"] == "DESC") {
        //         $this->products = $this->model->searchProducts($searchQuery);
        //     } else {
        //         $this->products = $this->model->searchProducts($searchQuery);
        //     }
        // } else {
        //     if (isset($_POST["price"]) && $_POST["price"] == "DESC") {
        //         $this->products = $this->model->orderProductsByDescPrice();
        //     } elseif (isset($_POST["price"]) && $_POST["price"] == "ASC") {
        //         $this->products = $this->model->orderProductsByAscPrice();
        //     } else {
        //         $this->products = $this->model->getProducts();
        //     }
        // }

        if (!empty($_POST)){
            if (isset($_POST["idProduct"])){
                $idProduct = intval($_POST["idProduct"]);
                foreach ($_SESSION["user"]["basket"] as $key => $productsBasket){
                    if ($productsBasket["product_id"] == $idProduct){
                        array_splice($_SESSION["user"]["basket"], $key);
                    }
                }
            }
        }

        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/shoppingCart.php');
        include(__DIR__ . '/../view/footer.php');
    }
}
