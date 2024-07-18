<?php

class HomeController
{
    public $title;
    public $products;
    public $msg;
    public $param;
    public $altParam;
    public $displayValue;

    public function __construct()
    {
        $this->title = "Accueil";
        $this->msg = "";
        $this->param = "";
        $this->altParam = "";
        $this->displayValue = "";
    }

    public function manage()
    {
        if(isset($_GET["thanks"]) && $_GET["thanks"] === "true") {
            $this->msg = "Merci pour votre commande<br/>Vous recevrez une notification dès que celle-ci sera prête.<br/>A très vite dans nos rayons !!!";
            $this->param = "index.php?page=home";
            $this->altParam = "Fermer";
            $this->displayValue = "Fermer";
        }

        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/popUp.php');
        include(__DIR__ . '/../view/home.php');
        include(__DIR__ . '/../view/footer.php');
    }
}
