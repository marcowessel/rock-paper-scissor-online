<?php

require_once('User.php');
require_once('Validation.php');
require_once('UserController.php');
require_once('UserHelper.php');


class Registration
{
    public $Success;

    private $username;
    private $password;
    private $passwordRepeat;

    public $UsernameValidation;
    public $PasswordValidation;
    public $PasswordRepeatValidation;


    public function __construct($username, $password, $passwordRepeat)
    {
        $this->Success = false;

        $this->username = $username;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;

        $this->UsernameValidation = new Validation("Username", $username);
        $this->PasswordValidation = new Validation("Passwort", $password);
        $this->PasswordRepeatValidation = new Validation("Passwort wiederholen", $passwordRepeat);
    }


    public function Register()
    {
        $this->CheckInputsValid();

        if ($this->UsernameValidation->IsValid &&
            $this->PasswordValidation->IsValid &&
            $this->PasswordRepeatValidation->IsValid)
        {
            $this->Success = UserController::InsertUser(
                new User(
                    $this->username,
                    $this->password
                )
            );
        }
        else {
            $this->Success = false;
        }

        if ($this->Success){
            UserHelper::SetLoggedUser($this->username);
        }
    }


    private function CheckInputsValid()
    {
        $this->IsUserValid();
        $this->IsPasswordValid();
        $this->IsPasswordRepeatValid();
    }


    private function IsUserValid()
    {
        $this->UsernameValidation
            ->IsNotEmpty()
            ->HasNoWhiteSpaces()
            ->HasMinLength(4)
            ->CustomRule(
                !UserController::UserExists($this->username),
                "existiert schon"
            );
    }


    private function IsPasswordValid()
    {
        $this->PasswordValidation
            ->IsNotEmpty()
            ->HasMinLength(8)
            ->HasNoWhiteSpaces();
    }


    private function IsPasswordRepeatValid()
    {
        $this->PasswordRepeatValidation
            ->IsSame($this->password);
    }
}