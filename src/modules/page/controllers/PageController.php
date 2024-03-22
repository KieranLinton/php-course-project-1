<?php

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
