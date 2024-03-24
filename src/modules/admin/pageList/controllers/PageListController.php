<?php

class PageListController extends AdminController
{
    public function defaultAction()
    {
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new PageSummaryView($dbc);
        $results = $pageObj->findAll();
        $variables["pageObj"]["pageSumaries"] = $results;

        $this->template->view("admin/pageList/views/page-list", $variables);
    }
}
