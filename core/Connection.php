<?php

require_once __DIR__ . '/../' .'config/Constants.php';

require_once ROOT_DIR .'config/Config.php';


class Connection
{
    public static function CreatePDO()
    {
        $db_config = Config::GetConfig('db');

        return new PDO(
            $db_config['kind'].
            ':host='.$db_config['host'].
            ';dbname='.$db_config['name'],
            $db_config['username'],
            $db_config['password']
        );
    }

    public static function Close(&$pdo){
        $pdo = null;
    }
}