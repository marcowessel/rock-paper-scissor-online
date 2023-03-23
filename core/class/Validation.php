<?php

class Validation
{
    public $IsValid;
    public $ErrorMessages;
    public $FieldName;
    private $FieldValue;


    public function __construct($fieldName, $fieldValue)
    {
        $this->ErrorMessages = [];
        $this->IsValid = true;
        $this->FieldName = $fieldName;
        $this->FieldValue = $fieldValue;
    }


    public function HasMinLength($minLength)
    {
        if (strlen($this->FieldValue) < $minLength) {
            $this->IsValid = false;

            array_push($this->ErrorMessages,
                "mindestens {$minLength} Zeichen");
        }

        return $this;
    }


    public function IsNotEmpty()
    {
        if (strlen($this->FieldValue) < 1) {
            $this->IsValid = false;

            array_push($this->ErrorMessages,
                "darf nicht leer sein");
        }

        return $this;
    }


    public function IsSame($inputRepeat)
    {
        if ($this->FieldValue != $inputRepeat) {
            $this->IsValid = false;

            array_push($this->ErrorMessages,
                "stimmt nicht überein");
        }

        return $this;
    }


    public function HasNoWhiteSpaces()
    {
        if (count(explode(' ', $this->FieldValue)) > 1) {
            $this->IsValid = false;

            array_push($this->ErrorMessages,
                "keine Leerzeichen");
        }

        return $this;
    }


    public function CustomRule($isValid, $errorMessage)
    {
        if (!$isValid) {
            $this->IsValid = false;

            array_push($this->ErrorMessages,
                $errorMessage);
        }

        return $this;
    }


    public function PrintErrorMessages()
    {
        echo "$this->FieldName <br>";
        foreach ($this->ErrorMessages as $message){
            echo $message . "<br>";
        }
    }
}