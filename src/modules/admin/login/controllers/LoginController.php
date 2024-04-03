<?php

namespace modules\admin\login\controllers;

use core;
use core\validation\validators;

use monolog\Level;


class LoginController extends core\BaseController
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

        $userNameValidator = new validators\UsernameValidator();

        $username = $_POST["username"] ?? "";
        $password = $_POST["password"] ?? "";

        $userIp = $_SERVER['REMOTE_ADDR'];

        $validationError = $userNameValidator->validate($username);

        if ($validationError) {
            $_SESSION["validation_errors"] = $validationError;
            include MODULE_PATH . "admin/login/views/login.html";
            exit;
        }

        $dbh = core\db\DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $auth = new core\Auth($dbc);

        if (!$auth->checkLogin($username, $password)) {
            $this->log(Level::Warning, "Failed login from IP $userIp");

            $_SESSION["validation_errors"] = "Username or password not correct.";
            include MODULE_PATH . "admin/login/views/login.html";
            exit;
        }

        $this->log(Level::Notice, "Admin has authenticated with IP  $userIp");

        $_SESSION["is_admin"] = true;
        header("Location: /admin/");
        exit;
    }
}
