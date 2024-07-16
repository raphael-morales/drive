<?php

class HomeController
{
    public $title;
    public $products;

    public function __construct()
    {
        $this->title = "Accueil";
        $this->products = ["test1","test2"];
    }

    public function manage()
    {
        
        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/home.php');
        include(__DIR__ . '/../view/footer.php');

    }
}