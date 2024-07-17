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
    }


    public function manage()
    {
        if (isset($_SESSION["user"])) {
            if (isset($_GET["valid"])) {
                $this->model->newOrder($_SESSION["user"]["id"], $_SESSION["user"]["basket"]);
            };
        } else {
            header("Location: index.php?page=signIn");
        };


        if (!empty($_POST)){
            if (isset($_POST["idProduct"])){
                $idProduct = intval($_POST["idProduct"]);
                foreach ($_SESSION["user"]["basket"] as $key => $productsBasket){
                    if ($productsBasket["product_id"] === $idProduct){
                        array_splice($_SESSION["user"]["basket"], $key, 1);
                    }
                }
            }
        }

        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/shoppingCart.php');
        include(__DIR__ . '/../view/footer.php');
    }
}
