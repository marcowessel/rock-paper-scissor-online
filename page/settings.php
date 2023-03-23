<?php
    require_once __DIR__ . '/../config/Constants.php';

    require_once ROOT_DIR . 'core/class/UserController.php';
    require_once ROOT_DIR . 'core/class/PasswordChanger.php';

    session_start();

    // if no user loggedin go back page
    if (!isset($_SESSION['user'])){
        header('Location: '. 'http://' . $_SERVER['HTTP_HOST']);
    }

    // delete user and logout
    if (isset($_POST['delete'])){
        UserController::DeleteUser($_SESSION['user']);
        session_destroy();
        header('Location: '. 'http://' . $_SERVER['HTTP_HOST']);
    }


    if (isset($_SESSION['user']) &&
        isset($_POST['oldPassword']) &&
        isset($_POST['newPassword']) &&
        isset($_POST['newPasswordRepeat']))
    {
        $passwordChanger = new PasswordChanger(
            $_SESSION['user'],
            $_POST['oldPassword'],
            $_POST['newPassword'],
            $_POST['newPasswordRepeat']);

        $passwordChanger->Change();
    }


    function ShowErrorMessages($errorMessages)
    {
        if ($errorMessages != null && count($errorMessages) > 0){
            echo '<div class="error-messages"><ul>';

            foreach ($errorMessages as $message) {
                echo '<li>' . $message . '</li>';
            }

            echo '</ul></div>';
        }
    }

?>

<?php include('../partial/top.partial.php'); ?>

<style>
    @import "../css/settings.css";
    @import "../css/errors.css";

    #settings {
        display: flex;
        flex-direction: column;
        padding: var(--spacing-top-bottom) var(--spacing-left-right);
        margin: auto;
        margin-top: 0;
    }

    #settings-container{
        display: flex;
    }

    #settings-container div:first-child{
        padding-right: 50px;
    }

    h1 {
        font-family: 'Pacifico', cursive;
        padding-bottom: 20px;
    }

    h2 {
        font-size: 1.5em;
    }

    form{
        display: flex;
        flex-direction: column;
        width: 250px;
    }

    /*------------------------------------*\
    # BUTTON
    \*------------------------------------*/

    .btn, .btn-primary{
        border-radius: 99px;
        height: 50px;
        font-weight: 900;
        border-bottom: #025ab9 4px solid;
        text-transform: uppercase;
        text-shadow: 1px 1px 1px #025ab9;
    }

    .btn-danger{
        border-radius: 99px;
        height: 50px;
        font-weight: 900;
        border-bottom: #b92e37 4px solid;
        text-transform: uppercase;
        text-shadow: 1px 1px 1px #b92e37;
    }
</style>

<div id="settings">
    <div>
        <div>
            <h1>Einstellungen</h1>
        </div>


        <div id="settings-container">
            <div>
                <form action="" method="post">
                    <h2>
                        Passwort ändern
                    </h2>

                    <input type="hidden" name="passwordChange" value="1">

                    altes Passwort:<br>
                    <input class="form-control" type="password" maxlength="100" name="oldPassword">
                        <?php
                            if (isset($passwordChanger->OldPasswordValidation->ErrorMessages)){
                                ShowErrorMessages($passwordChanger->OldPasswordValidation->ErrorMessages);
                            }
                        ?>
                    <br>

                    neues Passwort:<br>
                    <input class="form-control" type="password" maxlength="100" name="newPassword">
                        <?php
                            if (isset($passwordChanger->NewPasswordValidation->ErrorMessages)){
                                ShowErrorMessages($passwordChanger->NewPasswordValidation->ErrorMessages);
                            }
                        ?>
                    <br>

                    neues Passwort wiederholen:<br>
                    <input class="form-control" type="password" maxlength="100" name="newPasswordRepeat">
                        <?php
                            if (isset($passwordChanger->NewPasswordRepeatValidation->ErrorMessages)){
                                ShowErrorMessages($passwordChanger->NewPasswordRepeatValidation->ErrorMessages);
                            }
                        ?>
                    <br>

                    <h2>
                        Username ändern
                    </h2>

                    neuer Username:<br>
                    <input class="form-control" type="text" maxlength="50" name="newUsername">
                    <!--            --><?php
                    //            if (isset($login->UsernameValidation->ErrorMessages)){
                    //                ShowErrorMessages($login->UsernameValidation->ErrorMessages);
                    //            }
                    //            ?>
                    <br>

                    <input type="submit" class="btn btn-primary" value="speichern">
                </form>
            </div>

            <div>
                <form action="" method="post">
                    <h2>
                        Account löschen
                    </h2>

                    <input type="hidden" name="delete" value="1">

                    <input type="submit" class="btn btn-danger" value="löschen">
                </form>
            </div>
        </div>

    </div>
</div>

<?php include('../partial/bottom.partial.php'); ?>
