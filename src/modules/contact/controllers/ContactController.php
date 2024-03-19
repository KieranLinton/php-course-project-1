<?php

class ContactController extends BaseController
{

    function runBeforeAction()
    {
        if ($_SESSION["has_submitted_contact_form"] ?? false) {

            $dbh = DatabaseConnection::getInstance();
            $dbc = $dbh->getConnection();

            $pageObj = new Page($dbc);
            $pageObj->findBy("id", $this->entityId);
            $variables["pageObj"] = $pageObj;

            $template = new Template();
            $template->view("page/views/static-page", $variables);

            return false;
        }
        return true;
    }

    function defaultAction()
    {
        $template = new Template();
        $template->view("contact/views/contact-us");
    }


    function submitContactFormAction()
    {
        $_SESSION["has_submitted_contact_form"] = true;

        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findBy("id", 4);
        $variables["pageObj"] = $pageObj;

        $template = new Template();
        $template->view("page/views/static-page", $variables);
    }
}
