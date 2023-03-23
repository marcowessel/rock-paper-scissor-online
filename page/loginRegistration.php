<?php
    require_once '../core/Connection.php';
    require_once '../core/class/User.php';
    require_once '../core/class/Registration.php';
    require_once '../core/class/Login.php';

    session_start();

    if (isset($_POST['register']))
    {
        $registration = new Registration(
                $_POST['username'],
                $_POST['password'],
                $_POST['passwordRepeat']
        );

        $registration->Register();
    }


    if (isset($_POST['login'])) {
        $login = new Login(
            $_POST['username'],
            $_POST['password']
        );

        $login->Login();
    }

    if ((isset($registration) and $registration->Success) or
        (isset($login) && $login->Success))
    {
        header('Location: '. 'http://' . $_SERVER['HTTP_HOST'] . '/page/game.php');
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
    @import "../css/loginRegistration.css";
    @import "../css/animations.css";
    @import "../css/errors.css";
</style>

<div id="login-registration">
    <div id="login-registration-container">
        <div id="login-container">
            <h1>Login</h1>

            <form action="" method="post">
                <input type="hidden" name="login" value="1">

                Username:<br>
                <input class="form-control" type="text" placeholder="z. B. Noobmaster69" maxlength="50" name="username">
                <?php
                    if (isset($login->UsernameValidation->ErrorMessages)){
                        ShowErrorMessages($login->UsernameValidation->ErrorMessages);
                    }
                ?>
                <br>

                Passwort:<br>
                <input class="form-control" type="password" maxlength="100" name="password">
                <?php
                    if (isset($login->PasswordValidation->ErrorMessages)){
                        ShowErrorMessages($login->PasswordValidation->ErrorMessages);
                    }
                ?>
                <br>

                <input type="submit" class="btn btn-primary" value="Einloggen">
            </form>
        </div>

        <div id="registration-container">
            <h1>Registration</h1>

            <form action="" method="post">
                <input type="hidden" name="register" value="1">

                Username:<br>
                <input class="form-control" type="text" placeholder="z. B. Xlord315" maxlength="50" name="username">
                <?php
                    if (isset($registration->UsernameValidation->ErrorMessages)){
                        ShowErrorMessages($registration->UsernameValidation->ErrorMessages);
                    }
                ?>
                <br>

                Passwort:<br>
                <input class="form-control" type="password" maxlength="100" name="password">
                <?php
                    if (isset($registration->PasswordValidation->ErrorMessages)){
                        ShowErrorMessages($registration->PasswordValidation->ErrorMessages);
                    }
                ?>
                <br>

                Passwort wiederholen:<br>
                <input class="form-control" type="password" maxlength="100" name="passwordRepeat">
                <?php
                    if (isset($registration->PasswordRepeatValidation->ErrorMessages)){
                        ShowErrorMessages($registration->PasswordRepeatValidation->ErrorMessages);
                    }
                ?>
                <br>

                <input type="submit" class="btn btn-primary" value="Registrieren">
            </form>
        </div>
    </div>
</div>

<div style="position: absolute; bottom: 0; left: 0; color: grey">
    Bild von <a target="_blank" href="https://pixabay.com/de/users/composita-4384506/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amputm_content=2031539">composita</a>
    auf <a target="_blank" href="https://pixabay.com/de/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=2031539">Pixabay</a>
</div>


<?php include('../partial/bottom.partial.php'); ?>
