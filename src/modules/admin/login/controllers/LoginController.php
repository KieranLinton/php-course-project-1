<?php

class LoginController extends BaseController
{
    protected function runBeforeAction()
    {
        if ($_SESSION["is_admin"] ?? false === true) {
            header("Location: /admin/");
            return false;
        }

        return true;
    }

    function defaultAction()
    {
        $_SESSION["validation_errors"] = null;
        include MODULE_PATH . "admin/login/views/login.html";
    }

    function submitLoginFormAction()
    {

        $userNameValidator = new UsernameValidator();

        $username = $_POST["username"] ?? "";
        $password = $_POST["password"] ?? "";

        $validationError = $userNameValidator->validate($username);

        if ($validationError) {
            $_SESSION["validation_errors"] = $validationError;
            include MODULE_PATH . "admin/login/views/login.html";
            exit;
        }

        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $auth = new Auth($dbc);

        if (!$auth->checkLogin($username, $password)) {
            $_SESSION["validation_errors"] = "Username or password not correct.";
            include MODULE_PATH . "admin/login/views/login.html";
            exit;
        }

        $_SESSION["is_admin"] = true;
        header("Location: /admin/");
        exit;
    }
}
