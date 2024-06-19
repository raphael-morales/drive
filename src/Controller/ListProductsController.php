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
        $this->products = $this->model->getProducts();
    }

    public function manage()
    {

        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/listProducts.php');
        include(__DIR__ . '/../view/footer.php');

    }
}