<?php

// INFO: Copy file add change it to from DEFAULT_Config.php => Config.php


abstract class Config{
    static private $configs = [
        'db' => [
            'kind' => 'KIND',
            'host' => 'HOST',
            'name' => 'NAME',
            'username' => 'USERNAME',
            'password' => 'PASSWORD'
        ],
        'scoreboard' => [
            'amountUsers' => 10
        ]
    ];


    static public function GetConfig($configType)
    {
        return isset(self::$configs[$configType]) ? self::$configs[$configType] : false;
    }
}




