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
    }

    public function manage()
    {
        var_dump($_GET);
        if(isset($_GET['searchQuery'])){
            $searchQuery = $_GET['searchQuery'];
            $this->products = $this->model->searchProducts($searchQuery);
            header('Location: index.php?page=listProducts&searchQuery='.$searchQuery);
        }else{
            
            $this->products = $this->model->getProducts();
        }

        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/listProducts.php');
        include(__DIR__ . '/../view/footer.php');

    }
}