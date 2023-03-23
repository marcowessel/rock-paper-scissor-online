<?php

require_once __DIR__ . '/../../config/Constants.php';

require_once ROOT_DIR . 'core/Connection.php';
require_once ROOT_DIR . 'config/Config.php';


class Scoreboard
{
    private $amountUser;
    public $TopUsers;


    public function __construct()
    {
        $scoreboardConfig = Config::GetConfig('scoreboard');

        $this->amountUser = $scoreboardConfig['amountUsers'];
        $this->TopUsers = $this->GetTopUsers();
    }


    private function GetTopUsers()
    {
        if ($this->amountUser != null){
            $pdo = Connection::CreatePDO();
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $statement = $pdo->prepare("
                SELECT username, rounds, wins, draws, loses 
                FROM users
                ORDER BY wins DESC, rounds ASC, loses ASC, draws ASC 
                LIMIT :amount;");

            $statement->execute(array('amount' => $this->amountUser));

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return false;
        }
    }
}