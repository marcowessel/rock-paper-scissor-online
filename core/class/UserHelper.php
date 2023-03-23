<?php


class UserHelper
{
    static function SetLoggedUser($username)
    {
        $_SESSION['user'] = $username;
    }
}