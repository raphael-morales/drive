<?php

class SignUpController
{
    public $title;

    public function __construct()
    {
        $this->title = "S'inscrire";
    }

    public function manage()
    {
        include(__DIR__ . '/../view/signUp.php');
    }
}