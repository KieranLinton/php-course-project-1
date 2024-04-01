<?php

namespace modules\page\controllers;


use core\BaseController;
use core\db\DatabaseConnection;
use modules\page\models\Page;


class PageController extends BaseController
{
    public function defaultAction()
    {
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findBy("id", $this->entityId);
        $variables["pageObj"] = $pageObj;

        $this->template->view("page/views/static-page", $variables);
    }
}
