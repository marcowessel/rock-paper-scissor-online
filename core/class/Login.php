<?php

require_once('User.php');
require_once('Validation.php');
require_once('UserController.php');
require_once('UserHelper.php');


class Login
{
    public $Success;

    private $username;
    private $password;

    public $UsernameValidation;
    public $PasswordValidation;


    public function __construct($username, $password)
    {
        $this->Success = false;

        $this->username = $username;
        $this->password = $password;

        $this->UsernameValidation = new Validation("Username", $username);
        $this->PasswordValidation = new Validation("Passwort", $password);
    }


    public function Login()
    {
        $this->CheckInputsValid();

        if ($this->UsernameValidation->IsValid &&
            $this->PasswordValidation->IsValid)
        {
            UserHelper::SetLoggedUser($this->username);
            $this->Success = true;
        }
        else {
            $this->Success = false;
        }
    }


    private function CheckInputsValid()
    {
        $this->IsUserValid();
        $this->IsPasswordValid();
    }


    private function IsUserValid()
    {
        $this->UsernameValidation
            ->IsNotEmpty()
            ->HasNoWhiteSpaces()
            ->HasMinLength(4)
            ->CustomRule(
                UserController::UserExists($this->username),
                "existiert nicht"
            );
    }


    private function IsPasswordValid()
    {
        $this->PasswordValidation
            ->IsNotEmpty()
            ->HasMinLength(8)
            ->HasNoWhiteSpaces()
            ->CustomRule(
                UserController::CheckPasswordCorrect(
                    $this->username,
                    $this->password
                ),
                "falsches Passwort"
            );
    }
}