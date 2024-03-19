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

        $template = new Template();
        $template->view("page/views/static-page", $variables);
    }
}
