<?php
    session_start();

    function logout(){
        session_destroy();
        header('Location: '. 'http://' . $_SERVER['HTTP_HOST']);
        die();
    }

    logout();
?>

