<?php

class DashboardController extends BaseController
{

    function runBeforeAction()
    {
        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';

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
        $username = $_POST["username"] ?? "";
        $password = $_POST["password"] ?? "";
    }
}
