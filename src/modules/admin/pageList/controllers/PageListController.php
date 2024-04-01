<?php


namespace modules\admin\pageList\controllers;

use core\AdminController;
use core\db\DatabaseConnection;
use modules\page\models\Page;
use modules\admin\pageList\models\PageSummaryView;

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

    public function editPageAction()
    {

        $pageId = $_GET['id'];

        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findBy("id", $pageId);
        $variables["page"] = $pageObj;

        $this->template->view("admin/pageList/views/page-item-edit", $variables);
    }

    public function submitEditPageFormAction()
    {
        var_dump($_POST);
    }
}
