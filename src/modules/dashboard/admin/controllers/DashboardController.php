<?php

class DashboardController extends BaseController
{

    function runBeforeAction()
    {
        $action =  $_POST['action'] ?? $_GET['action'] ?? 'default';

        if ($action === "login") {
            return true;
        }

        if ($action === "submitLoginForm") {
            return true;
        }

        if ($_SESSION["is_admin"] !== true) {
            header("Location: /admin/index.php?module=dashboard&action=login");
            return false;
        }

        return true;
    }
    public function defaultAction()
    {
        echo "welcome";
    }

    function loginAction()
    {
        include VIEW_PATH . "admin/login.html";
    }

    function submitLoginFormAction()
    {

        $userNameValidator = new UsernameValidator();
        $passwordValidator = new PasswordValidator();

        $username = $_POST["username"] ?? "";
        $password = $_POST["password"] ?? "";

        $validationError = $userNameValidator->validate($username);
        $validationError = $validationError ?? $passwordValidator->validate($password);


        if ($validationError) {
            $_SESSION["validation_errors"] = $validationError;
            $this->loginAction();
            return;
        }


        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $auth = new Auth($dbc);

        if (!$auth->checkLogin($username, $password)) {
            $_SESSION["validation_errors"] = "Username or password not correct.";
            $this->loginAction();
            exit;
        }

        $_SESSION["is_admin"] = true;
        header("Location: /admin/");
        exit;
    }
}
