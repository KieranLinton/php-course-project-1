<?php

require_once ROOT_PATH . "core/BaseController.php";

class AdminController extends BaseController
{
    protected function runBeforeAction()
    {
        if ($_SESSION["is_admin"] !== true) {
            header("Location: /admin/index.php?module=login");
            return false;
        }

        return true;
    }
}
