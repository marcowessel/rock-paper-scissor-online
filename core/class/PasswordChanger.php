<?php

require_once('User.php');
require_once('Validation.php');
require_once('UserController.php');
require_once('UserHelper.php');

class PasswordChanger
{
    public $Success;

    private $username;
    private $oldPassword;
    private $newPassword;
    private $newPasswordRepeat;

    public $OldPasswordValidation;
    public $NewPasswordValidation;
    public $NewPasswordRepeatValidation;


    public function __construct($username, $oldPassword, $newPassword, $newPasswordRepeat)
    {
        $this->Success = false;

        $this->username = $username;
        $this->oldPassword = $oldPassword;
        $this->newPassword = $newPassword;
        $this->newPasswordRepeat = $newPasswordRepeat;

        $this->OldPasswordValidation = new Validation("Altes Passwort", $oldPassword);
        $this->NewPasswordValidation = new Validation("Neues Passwort", $newPassword);
        $this->NewPasswordRepeatValidation = new Validation("Neues Passwort Wiederholung", $newPasswordRepeat);
    }


    public function Change()
    {
        $this->CheckInputsValid();

        if ($this->OldPasswordValidation->IsValid &&
            $this->NewPasswordValidation->IsValid &&
            $this->NewPasswordRepeatValidation->IsValid)
        {
            //UserHelper::ChangeUserPassword($this->username, $this->newPassword);
            $this->Success = true;
        }
        else {
            $this->Success = false;
        }
    }


    private function CheckInputsValid()
    {
        $this->IsOldPasswordValid();
        $this->IsNewPasswordValid();
        $this->IsNewPasswordRepeatValid();
    }


    private function IsOldPasswordValid()
    {
        $this->OldPasswordValidation
            ->IsNotEmpty()
            ->HasMinLength(8)
            ->HasNoWhiteSpaces()
            ->CustomRule(
                UserController::CheckPasswordCorrect(
                    $this->username,
                    $this->oldPassword
                ),
                "altes Passwort falsch"
            );
    }


    private function IsNewPasswordValid()
    {
        $this->NewPasswordValidation
            ->IsNotEmpty()
            ->HasMinLength(8)
            ->HasNoWhiteSpaces();
    }

    private function IsNewPasswordRepeatValid()
    {
        $this->NewPasswordRepeatValidation
            ->IsNotEmpty()
            ->HasMinLength(8)
            ->HasNoWhiteSpaces()
            ->IsSame(
                $this->newPassword);
    }
}