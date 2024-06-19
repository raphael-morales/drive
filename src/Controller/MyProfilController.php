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


    public function __construct()
    {
        $this->model = new ModelUser();
        $this->msg = null;
        $this->title = "Mon Profil";
        $this->param = "index.php?page=myProfil";
        $this->altParam = "retour";
        $this->displayValue = "retour";

    }

    public function manage()
    {
        if (isset($_SESSION["user"]['id'])) {
            $this->profil = $this->model->getOneUser($_SESSION['user']['email']);
        }

        include(__DIR__ . "/../view/header.php");
        include(__DIR__ . "/../view/popUp.php");
        include(__DIR__ . "/../view/myProfil.php");
        include(__DIR__ . "/../view/footer.php");
    }
}
