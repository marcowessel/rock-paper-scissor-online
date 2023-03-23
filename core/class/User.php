<?php


class User
{
    public $name;
    public $password;

    public function __construct($username = null, $password = "")
    {
        $this->name = $username;
        $this->password = $password;
    }
}