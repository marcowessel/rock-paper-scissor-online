<?php

    $pagePath = "../page/";
?>


<!doctype html>
<html lang="de">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- google font embeed-->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/layout.css">

    <title>Schere, Stein Papier - Online</title>
</head>

<body>
<nav id="top-bar">
    <div id="top-home">
        <a id="top-home-button" href="/">
            <i id="top-home-button-icon" class="fas fa-home"></i>
        </a>
    </div>

    <div id="top-titel">
        <span>
            <b>Schere, Stein, Papier - Online</b>
        </span>
    </div>

    <div id="top-user">
        <!-- switch begin-->
        <?php

        if (isset($_SESSION['user'])) {
            echo '
            <div class="dropdown">
                <button class="dropbutton">
                    <span id="top-user-name">'.
                        $_SESSION['user'].'
                    </span>
                    <i id="top-user-icon" class="fas fa-user-circle"></i>
                </button>
    
                <div class="dropdown-content">
                    <a href="'.$pagePath.'statistics.php">Statistik</a>
                    <a href="'.$pagePath.'settings.php">Einstellungen</a>
                    <a href="'.$pagePath.'logout.php" id="logout-link" >Logout</a>
                </div>
            </div>
            ';
        } else {
            echo '
            <a id="top-user-loginRegistration" href="'.$pagePath.'loginRegistration.php">
                <span id="top-user-loginRegistration-text">Login / Registrieren</span>
            </a>
            ';
        }

        ?>
        <!-- switch end-->
    </div>
</nav>