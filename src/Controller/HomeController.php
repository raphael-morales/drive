<?php

class HomeController
{
    public $title;

    public function __construct()
    {
        $this->title = "Accueil";
    }

    public function manage()
    {
        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/home.php');
        include(__DIR__ . '/../view/footer.php');

    }
}