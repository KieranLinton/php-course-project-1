<?php

class PageListController extends AdminController
{
    public function defaultAction()
    {
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new PageSummaryView($dbc);
        $results = $pageObj->getAll();
        $variables["pageObj"]["pageSumaries"] = $results;

        $this->template->view("admin/pageList/views/page-list", $variables);
    }
}
