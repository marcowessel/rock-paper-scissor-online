<?php
    require_once 'core/class/Scoreboard.php';

    session_start();

    $scoreboard = new Scoreboard();

?>

<?php include('partial/top.partial.php'); ?>


<style>
    @import 'css/index.css';

    #homepage {
        display: flex;
        padding: var(--spacing-top-bottom) var(--spacing-left-right);
    }

    #homepage-left, #homepage-right {
        width: 50%;
    }

    #homepage-left {

    }

    #homepage-right {

    }

    .headerFont{
        font-family: 'Pacifico', cursive;
    }

    table, td, th {
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 10px 15px;
    }

    th {
        background: #e6e6e6;
        border-bottom: none;
    }

    .btn, .btn-primary{
        display: inline-block;
        border-radius: 99px;
        height: 50px;
        font-weight: 900;
        border-bottom: #025ab9 4px solid;
        text-transform: uppercase;
        text-shadow: 1px 1px 1px #025ab9;
        width: 250px;
        padding-top: 10px;
    }
</style>

<div id="homepage">
    <div id="homepage-left">
        <h1 class="headerFont">
            Bist du bereit für das<br>
            Glücksspiel der Extralative?
        </h1>

        <p>
            Du gegen den Computer! Beweise dich und steige in<br>
            der Bestenliste auf, um die Nummer 1 zu werden!
        </p>

        <a href="page/game.php">
            <div class="btn btn-primary">
                SPIELEN
            </div>
        </a>
    </div>

    <div id="homepage-right">
        <h1 class="headerFont">
            Bestenliste
        </h1>

        <table>
            <tbody>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Siege</th>
                <th>Remis</th>
                <th>Niederlagen</th>
                <th>Runden</th>
            </tr>

            <?php
                $position = 1;

                foreach ($scoreboard->TopUsers as $user){
                    echo '
                        <tr>
                            <td>' . $position . '</td>
                            <td>' . $user['username'] . '</td>
                            <td>' . $user['wins'] . '</td>
                            <td>' . $user['draws'] . '</td>
                            <td>' . $user['loses'] . '</td>
                            <td>' . $user['rounds'] . '</td>
                        </tr>
                    ';

                    $position++;
                }
            ?>

            </tbody>
        </table>
    </div>
</div>


<?php include('partial/bottom.partial.php'); ?>

