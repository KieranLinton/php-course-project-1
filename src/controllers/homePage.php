<?php

class HomeController extends BaseController {
    public function defaultAction() {

        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->getById(1);
        $variables["pageObj"] = $pageObj;

        $template = new Template();
        $template->view("home-page", $variables);
    }

}