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
        include(__DIR__ . '/../view/home.php');
    }
}