<?php
    require_once __DIR__ . '/../' .'config/Constants.php';

    require_once ROOT_DIR . "core/enum/ChoiceType.php";
    require_once ROOT_DIR . "core/enum/Winner.php";
    require_once ROOT_DIR . "core/class/Game.php";
    require_once ROOT_DIR . "core/class/Score.php";
    require_once ROOT_DIR . "core/class/ScoreController.php";

    session_start();


    //-------------------------------
    // 1. Get Score or create one
    //-------------------------------

    if (!isset($_SESSION['score']) && !isset($_SESSION['user'])){
        $_SESSION['score'] = new Score();
    }


    if (isset($_SESSION['user'])){
        $_SESSION['score'] = ScoreController::GetUserScore($_SESSION['user']);
    }


    //-------------------------------
    // 2. Get player choice
    //-------------------------------

    function GetPlayerChoice()
    {
        if (isset($_POST['rock'])) {
            return ChoiceType::rock;
        } else if (isset($_POST['paper'])) {
            return ChoiceType::paper;
        } else if (isset($_POST['scissor'])) {
            return ChoiceType::scissor;
        }

        return null;
    }

    $playerChoice = GetPlayerChoice();

    //-------------------------------
    // 3. Execute game logic
    //-------------------------------

    if ($playerChoice != null) {
        $game = new Game($playerChoice);
        $game->Start();
    }

    //-------------------------------
    // 4. Update Score
    //-------------------------------

    $score = $_SESSION['score'];

    if (isset($game)){
        $score->Rounds++;

        switch ($game->Winner){
            case Winner::computer:
                $score->Loses++;
                break;
            case Winner::player:
                $score->Wins++;
                break;
            case Winner::draw:
                $score->Draws++;
                break;
        }

        if (isset($_SESSION['user'])){
            ScoreController::UpdateScore($_SESSION['user'], $score);
        }
    }

?>


<?php include('../partial/top.partial.php'); ?>

<style>
    @import "../css/game.css";
    @import "../css/animations.css";
</style>

<div id="game">
    <div id="rounds-container">
        <span id="rounds-counter">
            Runde <?php echo $score->Rounds; ?>
        </span><br>
    </div>

    <div id="score-container">
        <div id="score-player-container-wrapper">
            <div id="score-player-container">
                <i class="score-icon fas fa-user"></i>

                <span class="score-text">
                    <?php
                        if (isset($_SESSION['user'])) {
                            echo $_SESSION['user'];
                        }
                        else { echo "Player"; }
                    ?>
                </span>
            </div>
        </div>

        <div id="score-counter-container">
            <div id="score-counter-player">
                <?php echo $score->Wins; ?>
            </div>

            <div id="score-counter-computer">
                <?php echo $score->Loses; ?>
            </div>
        </div>

        <div id="score-computer-container-wrapper">
            <div id="score-computer-container">
                <span class="score-text">Computer</span>

                <i class="score-icon fas fa-user-robot"></i>
            </div>
        </div>
    </div>

    <div id="game-button-container">
        <form action="" method="post">
            <input type="hidden" name="rock" value="1"/>

            <button id="rock-button" class="game-button" type="submit" name="rock">
                <i class="game-icon fas fa-hand-rock"></i>
            </button>
        </form>

        <form action="" method="post">
            <input type="hidden" name="paper" value="1"/>

            <button id="paper-button" class="game-button" type="submit" name="paper">
                <i class="game-icon fas fa-hand-paper"></i>
            </button>
        </form>

        <form action="" method="post">
            <input type="hidden" name="scissor" value="1"/>

            <button id="scissor-button" class="game-button" type="submit" name="scissor">
                <i class="game-icon fas fa-hand-scissors"></i>
            </button>
        </form>
    </div>

    <?php

    function GetRightIcon($choice){
        switch ($choice){
            case ChoiceType::scissor;
                return '<i class="far fa-hand-scissors"></i>';
                break;
            case ChoiceType::rock;
                return '<i class="far fa-hand-rock"></i>';
                break;
            default:
                return '<i class="far fa-hand-paper"></i>';
                break;
        }
    }

    $designs = [
        Winner::computer => "lose-design",
        Winner::player => "win-design",
        Winner::draw => "draw-design",
    ];

    $resultTexts = [
        Winner::computer => "YOU LOSE...",
        Winner::player => "YOU WIN!!!",
        Winner::draw => "DRAW!?",
    ];

    if(isset($game)){
        $designClass = $designs[$game->Winner];
        $playerChoiceIcon = GetRightIcon($playerChoice);
        $computerChoiceIcon = GetRightIcon($game->ComputerChoice);
        $resultText = $resultTexts[$game->Winner];

        echo '
            <div id="result-Container" class="'. $designClass .'">
                <div id="player-choice">'.
                    $playerChoiceIcon
                .'</div>
        
                <div id="result-text">'.
                    $resultText
                .'</div>
        
                <div id="computer-choice">'.
                    $computerChoiceIcon
                .'</div>
            </div>
        ';
    }

    ?>
</div>

<?php include('../partial/bottom.partial.php'); ?>
