<?php

require_once('Score.php');
require_once('../core/Connection.php');


class ScoreController
{
    static function GetUserScore($username)
    {
        if ($username != null){
            $pdo = Connection::CreatePDO();

            $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username;");
            $statement->execute(array('username' => $username));
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            return new Score(
                $user['loses'],
                $user['wins'],
                $user['draws'],
                $user['rounds']
            );
        }
        else{
            return false;
        }
    }


    static function UpdateScore($username, $score)
    {
        if ($username != null && $score != null){
            $pdo = Connection::CreatePDO();

            $statement = $pdo->prepare("
                UPDATE users SET loses = :loses, wins = :wins, draws = :draws, rounds = :rounds 
                WHERE users.username = :username;
            ");

            return $statement->execute(array(
                'loses' => $score->Loses,
                'wins' => $score->Wins,
                'draws' => $score->Draws,
                'rounds' => $score->Rounds,
                'username' => $username,

            ));
        }
        else{
            return false;
        }
    }
}