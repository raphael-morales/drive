<?php

class SignInController
{
    public $title;

    public function __construct()
    {
        $this->title = "Se connecter";
    }

    public function manage()
    {
        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/signIn.php');
    }
}