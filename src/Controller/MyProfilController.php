<?php

class MyProfilController
{
    public $model;
    public $msg;
    public $title;
    public $param;
    public $altParam;
    public $displayValue;
    public $profil;

    public $profilsAdmin;

    public $servicesHtml;


    public function __construct()
    {
        $this->model = new ModelUser();
        $this->msg = null;
        $this->title = "Mon Profil";
        $this->param = "index.php?page=myProfil";
        $this->altParam = "retour";
        $this->displayValue = "retour";
        $this->servicesHtml = new Html();

    }

    public function manage()
    {
        if (isset($_SESSION["user"]['id'])) {
            $this->profil = $this->model->getOneUser($_SESSION['user']['email']);
        }

        if (isset($_SESSION["user"]['id']) && $_SESSION["user"]["role"] == "administrateur"){
            $this->profilsAdmin = $this->model->getAllUserAdmin();
            $this->profilsAdmin = $this->servicesHtml->CreateTableHtml($this->profilsAdmin);
        }

        include(__DIR__ . "/../view/header.php");
        include(__DIR__ . "/../view/popUp.php");
        include(__DIR__ . "/../view/myProfil.php");
        include(__DIR__ . "/../view/footer.php");
    }
}
