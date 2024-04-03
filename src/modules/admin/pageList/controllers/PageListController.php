<?php


namespace modules\admin\pageList\controllers;

use core\AdminController;
use core\db\DatabaseConnection;
use modules\page\models\Page;
use modules\admin\pageList\models\PageSummaryView;

use Monolog\Level;


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

    public function deletePageAction()
    {
        $pageId = $_GET['id']; // Not sure how to implement DELETE 

        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);

        $pageObj->deleteBy("id", $pageId);

        header("Location: /admin/index.php?module=pageList");
    }

    public function editPageAction()
    {
        $pageId = $_GET['id'] ?? null;

        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);

        if ($pageId !== null && !$pageObj->findBy("id", $pageId)) {
            echo 404;
            return;
        }

        $variables["page"] = $pageObj;

        $this->template->view("admin/pageList/views/page-item-edit", $variables);
    }

    public function submitEditPageFormAction()
    {
        $id = $_POST["id"] ?? null;

        var_dump($id);

        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $page = new Page($dbc);

        if ($id !== null && !$page->findBy("id", $id)) {
            echo 404;
            return;
        }

        $page->setValues($_POST);
        $page->save();

        if ($id !== null) {
            $this->log(Level::Info, "Admin modified page $id");
        } else {
            $this->log(Level::Info, "Admin created a new page");
        }

        header("Location: /admin/index.php?module=pageList");
    }
}
