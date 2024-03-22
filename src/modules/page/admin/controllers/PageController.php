<?php

class PageController extends BaseController
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
            header("Location: /admin/index.php?module=page");
            return false;
        }

        return true;
    }
    public function defaultAction()
    {
        $this->template->view("page/admin/views/page-list");
    }
}
