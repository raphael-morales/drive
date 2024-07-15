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
    public function __construct()
    {
        $this->model = new Model();
        $this->msg = null;
        $this->title = "Liste des produits";
        $this->categories = $this->model->getCategories();
    }

    public function manage()
    {
        if(isset($_POST['searchQuery'])){
            $searchQuery = $_POST['searchQuery'];
            $this->products = $this->model->searchProducts($searchQuery);
        }elseif (isset($_GET["category"])){
            $category = $_GET["category"];
            if (isset($_POST["price"]) && $_POST["price"] == "DESC") {
                $this->products = $this->model->orderProductsByDescPriceByCategory($category);
            } else {
                $this->products = $this->model->orderProductsByAscPriceByCategory($category);
            }
        }else{
            if (isset($_POST["price"]) && $_POST["price"] == "DESC") {
                $this->products = $this->model->orderProductsByDescPrice();
            }elseif(isset($_POST["price"]) && $_POST["price"] == "ASC") {
                $this->products = $this->model->orderProductsByAscPrice();
            }else{
                $this->products = $this->model->getProducts();
            }
        }

        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/listProducts.php');
        include(__DIR__ . '/../view/footer.php');

    }
}