<?php

class DashboardController extends AdminController
{

    function runBeforeAction()
    {
        // Stuff
        return parent::runBeforeAction();
    }
    public function defaultAction()
    {
        $this->template->view("admin/dashboard/views/dashboard");
    }
}
