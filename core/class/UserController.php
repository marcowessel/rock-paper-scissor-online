<?php

require_once('User.php');
require_once('../core/Connection.php');


class UserController
{
    static function UserExists($username)
    {
        $pdo = Connection::CreatePDO();

        $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $statement->execute(array('username' => $username));
        $user = $statement->fetch();

        Connection::Close($pdo);

        return ($user) ? true : false;
    }


    static function InsertUser($user)
    {
        if (UserController::UserExists($user->name)){
            return false;
        }

        if ($user->name != null){
            $pdo = Connection::CreatePDO();

            // hash password before db insert
            $passwordHashed = password_hash($user->password, PASSWORD_DEFAULT);

            $statement = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $result = $statement->execute(array('username' => $user->name, 'password' => $passwordHashed));

            Connection::Close($pdo);

            return $result;
        }
        else {
            return false;
        }
    }


    static function DeleteUser($username)
    {
        if (!UserController::UserExists($username)){
            return false;
        }

        if ($username != null){
            $pdo = Connection::CreatePDO();

            $statement = $pdo->prepare("DELETE FROM users WHERE username=:username;)");
            $result = $statement->execute(array('username' => $username));

            Connection::Close($pdo);

            return $result;
        }
        else {
            return false;
        }
    }


    static function CheckPasswordCorrect($username, $password)
    {
        if ($username != null && $password != null)
        {
            $fetchedUser = UserController::GetUser($username);

            return password_verify($password, $fetchedUser->password);
        }

        return false;
    }


    static function GetUser($username)
    {
        if ($username != null){
            $pdo = Connection::CreatePDO();

            $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $statement->execute(array('username' => $username));
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            return new User(
                $user['username'],
                $user['password']
            );
        }
        else{
            return false;
        }
    }
}